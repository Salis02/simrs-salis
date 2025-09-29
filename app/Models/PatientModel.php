<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'name', 'phone', 'address', 'birth_date', 'gender'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'phone' => 'required|min_length[10]|max_length[20]',
        'address' => 'permit_empty',
        'birth_date' => 'permit_empty|valid_date',
        'gender' => 'required|in_list[male,female]',
    ];

    public function findOrCreateByPhone(array $data)
    {
        $existing = $this->where('phone', $data['phone'])->first();
        
        if ($existing) {
            return $existing;
        }
        
        $id = $this->insert($data);
        return $this->find($id);
    }
}