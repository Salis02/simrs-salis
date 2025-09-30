<?php

namespace App\Models;

use CodeIgniter\Model;

class DrugModel extends Model
{
    protected $table = 'drugs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false; // Kita tidak menggunakan soft delete untuk data obat
    protected $protectFields = true;
    protected $allowedFields = [
        'name', 'generic_name', 'unit', 'stock', 'price', 'description'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]|is_unique[drugs.name,id,{id}]',
        'unit' => 'required|max_length[50]',
        'stock' => 'required|integer|greater_than_equal_to[0]',
        'price' => 'required|numeric|greater_than_equal_to[0]',
        'generic_name' => 'permit_empty',
        'description' => 'permit_empty',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}
