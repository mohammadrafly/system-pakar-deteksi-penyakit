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
            ->orderBy('penyakit.kodepenyakit', 'ASC')
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

    function findAllAssociatedByIDs($id) 
    {
        return $this->db->table('penyakit')
            ->select('
                penyakit.*,
                jenistanaman.jenistanaman as nama_tanaman
            ')
            ->join('jenistanaman', 'penyakit.jenistanaman = jenistanaman.id')
            ->where('penyakit.id', $id)
            ->get()
            ->getResultArray();
    }

    public function getPenyakitByCode($id)
    {
        return $this->db->table('penyakit as p')
            ->select('
                j.jenistanaman as nama_tanaman,
                p.*,
                gejala.*
            ')
            ->join('basispengetahuan', 'p.namapenyakit = basispengetahuan.namapenyakit', 'left')
            ->join('jenistanaman as j', 'p.jenistanaman = j.id', 'left')
            ->join('gejala', 'basispengetahuan.gejala = gejala.id', 'left')
            ->where('p.kodepenyakit', $id)
            ->get();
    }

    public function getPenyakitByName($id)
    {
        return $this->db->table('penyakit as p')
            ->select('
                j.jenistanaman as nama_tanaman,
                p.*,
                gejala.*
            ')
            ->join('basispengetahuan', 'p.namapenyakit = basispengetahuan.namapenyakit', 'left')
            ->join('jenistanaman as j', 'p.jenistanaman = j.id', 'left')
            ->join('gejala', 'basispengetahuan.gejala = gejala.id', 'left')
            ->where('p.namapenyakit', $id)
            ->get();
    }
}
