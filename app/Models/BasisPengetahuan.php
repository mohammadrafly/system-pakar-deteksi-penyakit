<?php

namespace App\Models;

use CodeIgniter\Model;

class BasisPengetahuan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'basispengetahuan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'namapenyakit',
        'gejala',
        'nilaibobot',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function findAllAssociated() 
    {
        return $this->db->table('basispengetahuan')
            ->select('
                basispengetahuan.*,
                gejala.gejala as nama_gejala
            ')
            ->join('gejala', 'basispengetahuan.gejala = gejala.id')
            ->get()
            ->getResultArray();
    }
}
