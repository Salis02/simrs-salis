<?php

namespace App\Models;

use CodeIgniter\Model;

class PrescriptionItemModel extends Model
{
    protected $table = 'prescription_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = [
        'prescription_id', 'drug_id', 'quantity', 'dosage_instruction', 'price_per_unit', 'subtotal'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Validation Rules
    protected $validationRules = [
        'prescription_id' => 'required|integer',
        'drug_id' => 'required|integer',
        'quantity' => 'required|integer|greater_than[0]',
        'dosage_instruction' => 'required|max_length[255]',
        'price_per_unit' => 'required|numeric|greater_than_equal_to[0]',
        'subtotal' => 'required|numeric|greater_than_equal_to[0]',
    ];
    
    // Model detail tidak memerlukan timestamps 'created_at' dan 'updated_at'
    protected $useTimestamps = false;
}
