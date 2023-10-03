<?php

namespace App\Models;

use CodeIgniter\Model;

class Penyakit extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penyakit';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kodepenyakit',
        'namapenyakit',
        'jenistanaman',
        'kulturteknis',
        'fisikmekanis',
        'kimiawi',
        'hayati',
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
        return $this->db->table('penyakit')
            ->select('
                penyakit.*,
                jenistanaman.jenistanaman as nama_tanaman
            ')
            ->join('jenistanaman', 'penyakit.jenistanaman = jenistanaman.id')
            ->get()
            ->getResultArray();
    }

    function findAllAssociatedByID($id) 
    {
        return $this->db->table('penyakit')
            ->select('
                penyakit.*,
                jenistanaman.jenistanaman as nama_tanaman
            ')
            ->join('jenistanaman', 'penyakit.jenistanaman = jenistanaman.id')
            ->where('penyakit.kodepenyakit', $id)
            ->get()
            ->getResultArray();
    }
}
