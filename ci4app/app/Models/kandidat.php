<?php namespace App\Models;

use CodeIgniter\Model;

class Kandidat extends Model
{
    protected $table = 'kandidat';
    protected $allowedFields = ['nama_kandidat', 'prodi_kandidat', 'foto'];

    public function load()
    {
        $db = \Config\Database::connect();
        $result = $this->db->table('kandidat')->get()->getResultArray();

        return $result;
    }

    public function jumlah()
    {
        $db = \Config\Database::connect();
        $result = $this->db->table('kandidat')->countAllResults();

        return $result;
    }


}