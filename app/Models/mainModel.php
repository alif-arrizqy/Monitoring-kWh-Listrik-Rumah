<?php
namespace App\Models;

use CodeIgniter\Model;

class mainModel extends Model 
    {
        protected $table = 'listrik';
        protected $useTimestamps = true;
        protected $allowedFields = ['data_arus', 'data_daya'];

        public function addArus($kirimdata)
        {
            $query = $this->db->table($this->table)->insert($kirimdata);
            return $query;
        }
        
        public function addToken($kirimdata)
        {
            $query = $this->db->table('token')->insert($kirimdata);
            return $query;
        }

        public function addToken_temp($kirimdata)
        {
            $query = $this->db->table('token_temp')->insert($kirimdata);
            return $query;
        }

        public function getDataListrik()
        {
            $query = $this->db->query("SELECT * FROM listrik");
            return $query;
        }

        public function kwh_bulan($bulan)
        {
            $query = $this->db->query("SELECT SUM(data_daya) AS total_kwh_bulan FROM listrik WHERE bulan = '$bulan'");
            return $query;
        }
        
        public function biaya_bulan($bulan)
        {
            $query = $this->db->query("SELECT SUM(jumlah) AS total_jumlah FROM token WHERE bulan = '$bulan'");
            return $query;
        }
    }
