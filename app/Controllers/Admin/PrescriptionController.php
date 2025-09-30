<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PrescriptionModel;
use App\Models\PrescriptionItemModel;
use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\DrugModel;

class PrescriptionController extends BaseController
{
    protected $prescriptionModel;
    protected $itemModel;
    protected $patientModel;
    protected $doctorModel;
    protected $drugModel;
    protected $currentUserId;

    public function __construct()
    {
        $this->prescriptionModel = new PrescriptionModel();
        $this->itemModel = new PrescriptionItemModel();
        $this->patientModel = new PatientModel();
        $this->doctorModel = new DoctorModel();
        $this->drugModel = new DrugModel();
        
        // Asumsi kita sudah punya User/Auth untuk mendapatkan ID admin yang sedang login
        // Untuk saat ini, kita hardcode user_id = 1
        $this->currentUserId = session()->get('user_id');
    }

    // --- READ (Index) ---
    public function index()
    {
        $data = [
            'title' => 'Daftar Resep & Penjualan Obat',
            'prescriptions' => $this->prescriptionModel->getFullPrescriptionData(),
        ];

        return view('admin/prescriptions/index', $data);
    }

    // --- VIEW (Detail) ---
    public function view(int $id)
    {
        $prescription = $this->prescriptionModel->find($id);

        if (!$prescription) {
            session()->setFlashdata('error', 'Resep tidak ditemukan.');
            return redirect()->to(base_url('admin/prescriptions'));
        }

        // Ambil data detail item resep beserta nama obat
        $items = $this->itemModel
                    ->select('prescription_items.*, drugs.name as drug_name, drugs.unit')
                    ->join('drugs', 'drugs.id = prescription_items.drug_id')
                    ->where('prescription_id', $id)
                    ->findAll();

        $data = [
            'title' => 'Detail Resep #'. $id,
            'prescription' => $prescription,
            'patient' => $this->patientModel->find($prescription['patient_id']),
            'doctor' => $this->doctorModel->find($prescription['doctor_id']),
            'user' => ['username' => 'AdminDummy'], // Dummy user data
            'items' => $items,
        ];

        return view('admin/prescriptions/view', $data);
    }

    // --- CREATE (Transaksi Baru) ---
    public function create()
    {
        // Ambil data obat yang tersedia
        $drugs = $this->drugModel->select('id, name, unit, price, stock')->findAll();

        $data = [
            'title' => 'Buat Resep Baru',
            'patients' => $this->patientModel->select('id, name, phone')->findAll(),
            'doctors' => $this->doctorModel->getActiveDoctors(),
            'drugs' => $drugs,
            // BARIS PENTING: Mengubah array obat menjadi JSON string untuk JavaScript
            'drugsJson' => json_encode($drugs), 
            'validation' => \Config\Services::validation(),
        ];

        if ($this->request->is('post')) {
            $db = \Config\Database::connect();
            $db->transBegin(); // Mulai transaksi DB

            try {
                $postData = $this->request->getPost();
                $items = json_decode($postData['items_json'] ?? '[]', true);

                if (empty($items)) {
                    session()->setFlashdata('error', 'Item resep tidak boleh kosong.');
                    return redirect()->back()->withInput();
                }

                // 1. Validasi Header Resep
                $headerData = [
                    'patient_id' => $postData['patient_id'],
                    'doctor_id' => $postData['doctor_id'],
                    'user_id' => $this->currentUserId,
                    'prescription_date' => date('Y-m-d H:i:s'),
                    'notes' => $postData['notes'] ?? null,
                    'total_amount' => 0, // Akan dihitung ulang
                    'status' => 'COMPLETED', // Langsung Completed jika ini adalah penjualan
                ];

                if (!$this->prescriptionModel->validate($headerData)) {
                    // Set error ke session untuk ditampilkan di form
                    session()->setFlashdata('errors', $this->prescriptionModel->errors());
                    throw new \Exception('Validasi Header Resep Gagal.');
                }
                
                $prescriptionId = $this->prescriptionModel->insert($headerData, true);
                $totalAmount = 0;

                // 2. Proses Item Resep
                foreach ($items as $item) {
                    $drug = $this->drugModel->find($item['drug_id']);
                    
                    if (!$drug) {
                        throw new \Exception("Obat dengan ID {$item['drug_id']} tidak ditemukan.");
                    }
                    if ($drug['stock'] < $item['quantity']) {
                        throw new \Exception("Stok {$drug['name']} tidak mencukupi. Tersedia: {$drug['stock']}, Diminta: {$item['quantity']}.");
                    }
                    
                    // Gunakan harga dari database, bukan dari input hidden user (demi keamanan)
                    $pricePerUnit = $drug['price'];
                    $subtotal = $pricePerUnit * $item['quantity'];
                    $totalAmount += $subtotal;

                    $itemData = [
                        'prescription_id' => $prescriptionId,
                        'drug_id' => $item['drug_id'],
                        'quantity' => $item['quantity'],
                        'dosage_instruction' => $item['dosage_instruction'],
                        'price_per_unit' => $pricePerUnit,
                        'subtotal' => $subtotal,
                    ];

                    if (!$this->itemModel->validate($itemData)) {
                        throw new \Exception('Validasi Item Resep Gagal.');
                    }
                    
                    $this->itemModel->insert($itemData);

                    // 3. Kurangi Stok Obat (Inventory Update)
                    $newStock = $drug['stock'] - $item['quantity'];
                    $this->drugModel->update($item['drug_id'], ['stock' => $newStock]);
                }

                // 4. Update Total Header
                $this->prescriptionModel->update($prescriptionId, ['total_amount' => $totalAmount]);

                $db->transCommit();

                session()->setFlashdata('success', 'Resep dan Penjualan obat berhasil dicatat! Total: Rp. ' . number_format($totalAmount, 0, ',', '.'));
                return redirect()->to(base_url('admin/prescriptions/view/' . $prescriptionId));

            } catch (\Exception $e) {
                $db->transRollback();
                session()->setFlashdata('error', 'Transaksi Gagal: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        }

        return view('admin/prescriptions/form', $data);
    }

    // --- DELETE (Hapus) ---
    public function delete(int $id)
    {
        $db = \Config\Database::connect();
        $db->transBegin(); 
        
        try {
            $prescription = $this->prescriptionModel->find($id);

            if (!$prescription) {
                throw new \Exception('Resep tidak ditemukan.');
            }

            // 1. Kembalikan Stok Obat (Hanya jika status COMPLETED)
            if ($prescription['status'] === 'COMPLETED') {
                $items = $this->itemModel->where('prescription_id', $id)->findAll();
                foreach ($items as $item) {
                    $drug = $this->drugModel->find($item['drug_id']);
                    if ($drug) {
                        $newStock = $drug['stock'] + $item['quantity'];
                        $this->drugModel->update($item['drug_id'], ['stock' => $newStock]);
                    }
                }
            }

            // 2. Hapus Header (Items akan otomatis terhapus karena CASCADE)
            if (!$this->prescriptionModel->delete($id)) {
                 throw new \Exception('Gagal menghapus header resep.');
            }

            $db->transCommit();
            session()->setFlashdata('success', 'Resep berhasil dihapus dan stok obat telah dikembalikan.');

        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', 'Gagal menghapus resep: ' . $e->getMessage());
        }

        return redirect()->to(base_url('admin/prescriptions'));
    }
}
