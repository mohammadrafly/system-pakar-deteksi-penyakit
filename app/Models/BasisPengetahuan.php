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

    function findAllAssociatedByID($id) 
    {
        return $this->db->table('basispengetahuan')
            ->select('
                basispengetahuan.*,
                gejala.gejala as nama_gejala
            ')
            ->join('gejala', 'basispengetahuan.gejala = gejala.id')
            ->where('basispengetahuan.id', $id)
            ->get()
            ->getResultArray();
    }

    public function getPengetahuanByCode($id)
    {
        return $this->db->table('basispengetahuan')
            ->select('
                j.jenistanaman as nama_tanaman,
                p.*,
                gejala.*
            ')
            ->join('penyakit as p', 'p.namapenyakit = basispengetahuan.namapenyakit')
            ->join('jenistanaman as j', 'p.jenistanaman = j.id')
            ->join('gejala', 'basispengetahuan.gejala = gejala.id')
            ->where('p.kodepenyakit', $id)
            ->get();
    }

    public function getPengetahuanByName($id)
    {
        return $this->db->table('basispengetahuan')
            ->select('
                j.jenistanaman as nama_tanaman,
                p.*,
                gejala.*
            ')
            ->join('penyakit as p', 'p.namapenyakit = basispengetahuan.namapenyakit')
            ->join('jenistanaman as j', 'p.jenistanaman = j.id')
            ->join('gejala', 'basispengetahuan.gejala = gejala.id')
            ->where('p.namapenyakit', $id)
            ->get();
    }

    public function getSymptomDetailsByID($id)
    {
       return $this->db->table('basispengetahuan')
            ->select('
                basispengetahuan.*,
                gejala.*
            ')
            ->join('gejala', 'basispengetahuan.gejala = gejala.id')
            ->where('basispengetahuan.gejala', $id)
            ->get()->getResultArray();
    }
}
