<?php
namespace App\Models;

use CodeIgniter\Model;

class mainModel extends Model 
    {
        protected $table = 'arus';
        protected $useTimestamps = true;
        protected $allowedFields = ['data_arus', 'data_tegangan'];

        public function addArus($kirimdata)
        {
            $query = $this->db->table($this->table)->insert($kirimdata);
            return $query;
        }
    }
