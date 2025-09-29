<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\PatientModel;
use App\Models\WorkingHourModel;

class ReservationController extends BaseController
{
    protected $reservationModel;
    protected $patientModel;
    protected $workingHourModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->patientModel = new PatientModel();
        $this->workingHourModel = new WorkingHourModel();
    }

    public function create()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $data = $this->request->getJSON(true);

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'patient_name' => 'required|min_length[3]|max_length[100]',
            'patient_phone' => 'required|min_length[10]|max_length[20]',
            'patient_address' => 'permit_empty',
            'patient_birth_date' => 'permit_empty|valid_date',
            'patient_gender' => 'required|in_list[male,female]',
            'working_hour_id' => 'required|integer',
            'reservation_time' => 'required',
        ]);

        if (!$validation->run($data)) {
            return $this->errorResponse('Data tidak valid', 400, $validation->getErrors());
        }

        try {
            // Find or create patient
            // $patient = $this->patientModel->findOrCreateByPhone([
            //     'name' => $data['patient_name'],
            //     'phone' => $data['patient_phone'],
            //     'address' => $data['patient_address'] ?? '',
            //     'birth_date' => $data['patient_birth_date'] ?? null,
            //     'gender' => $data['patient_gender']
            // ]);

            $newPatientData = [
                'name' => $data['patient_name'],
                'phone' => $data['patient_phone'],
                'address' => $data['patient_address'] ?? '',
                'birth_date' => $data['patient_birth_date'] ?? null,
                'gender' => $data['patient_gender']
            ];
            // Gunakan metode insert() untuk menyimpan data pasien baru
            $patientId = $this->patientModel->insert($newPatientData);

            // Jika insert gagal, lempar exception
            if (!$patientId) {
                throw new \Exception('Gagal menyimpan data pasien baru.');
            }

            // Ambil data pasien yang baru dibuat, jika diperlukan
            $patient = $this->patientModel->find($patientId);
            
            // Get working hour details
            $workingHour = $this->workingHourModel->find($data['working_hour_id']);
            if (!$workingHour) {
                return $this->errorResponse('Jadwal dokter tidak ditemukan');
            }

            // Check if slot is still available
            $availableSlots = $this->workingHourModel->getAvailableSlots($data['working_hour_id']);
            if (!in_array($data['reservation_time'], $availableSlots)) {
                return $this->errorResponse('Slot waktu sudah terisi');
            }

            // Create reservation
            $reservationData = [
                'patient_id' => $patient['id'],
                'doctor_id' => $workingHour['doctor_id'],
                'working_hour_id' => $data['working_hour_id'],
                'reservation_date' => $workingHour['date'],
                'reservation_time' => $data['reservation_time'],
                'status' => 'pending',
                'notes' => $data['notes'] ?? ''
            ];

            $reservationId = $this->reservationModel->insert($reservationData);

            if ($reservationId) {
                return $this->successResponse('Reservasi berhasil dibuat. Menunggu konfirmasi admin.', [
                    'reservation_id' => $reservationId
                ]);
            } else {
                return $this->errorResponse('Gagal membuat reservasi');
            }
        } catch (\Exception $e) {
            return $this->errorResponse('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
