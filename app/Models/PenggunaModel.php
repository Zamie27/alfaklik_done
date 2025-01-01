<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $allowedFields = ['username', 'nama_lengkap', 'email', 'no_telp', 'password', 'alamat', 'role', 'status', 'foto_profil', 'nama_lengkap'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function verifyLogin($identity, $password)
    {
        $builder = $this->db->table($this->table);
        $builder->where('status', 'aktif');
        $builder->groupStart()
            ->where('username', $identity)
            ->orWhere('email', $identity)
            ->orWhere('no_telp', $identity)
            ->groupEnd();

        $user = $builder->get()->getRowArray();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
