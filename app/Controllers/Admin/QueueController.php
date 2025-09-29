<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\QueueModel;

class QueueController extends BaseController
{
    protected $queueModel;

    public function __construct()
    {
        $this->queueModel = new QueueModel();
    }

    public function index()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $date = $this->request->getGet('date') ?? date('Y-m-d');
        
        $data = [
            'title' => 'Kelola Antrian',
            'queues' => $this->queueModel->getTodayQueuesWithPatients($date),
            'current_queue' => $this->queueModel->getCurrentQueue($date),
            'filter_date' => $date
        ];

        return view('admin/queues/index', $data);
    }

    public function updateStatus($id)
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $status = $this->request->getPost('status');
        
        if (!in_array($status, ['serving', 'completed', 'cancelled'])) {
            return $this->errorResponse('Status tidak valid');
        }

        $updateData = ['status' => $status];
        
        if ($status === 'serving') {
            // Set other serving queues to waiting
            $this->queueModel->where('status', 'serving')
                ->where('queue_date', date('Y-m-d'))
                ->set(['status' => 'waiting'])
                ->update();
            
            $updateData['served_at'] = date('Y-m-d H:i:s');
        } elseif ($status === 'completed') {
            $updateData['completed_at'] = date('Y-m-d H:i:s');
        }

        if ($this->queueModel->update($id, $updateData)) {
            return $this->successResponse('Status antrian berhasil diupdate');
        } else {
            return $this->errorResponse('Gagal mengupdate status antrian');
        }
    }

    public function callNext()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $date = date('Y-m-d');
        
        // Get next waiting queue
        $nextQueue = $this->queueModel->where('queue_date', $date)
            ->where('status', 'waiting')
            ->orderBy('queue_number', 'ASC')
            ->first();

        if (!$nextQueue) {
            return $this->errorResponse('Tidak ada antrian yang menunggu');
        }

        // Set current serving to waiting
        $this->queueModel->where('status', 'serving')
            ->where('queue_date', $date)
            ->set(['status' => 'waiting'])
            ->update();

        // Set next queue to serving
        if ($this->queueModel->update($nextQueue['id'], [
            'status' => 'serving',
            'served_at' => date('Y-m-d H:i:s')
        ])) {
            return $this->successResponse('Antrian berikutnya berhasil dipanggil', [
                'queue_number' => $nextQueue['queue_number']
            ]);
        } else {
            return $this->errorResponse('Gagal memanggil antrian berikutnya');
        }
    }
}