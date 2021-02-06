<?php
namespace App\Controllers;
date_default_timezone_set("Asia/Jakarta");

use App\Models\mainModel;

class Pages extends BaseController
{ 
	protected $mainModel;
	public function __construct()
	{
		$this->mainModel = new mainModel();
	}

	public function index()
	{
		echo view('pages/index');
	}

	// Arus
	public function arus()
	{
		return view('pages/arus');
	}
	public function save_arus($data_arus, $data_tegangan)
	{
		// echo "arus: $data_arus, tegangan: $data_tegangan";
		$date = time();
		$kirimdata['data_arus'] = $data_arus;
		$kirimdata['data_tegangan'] = $data_tegangan;
		$kirimdata['tanggal'] = date("Y-m-d", $date);
		$kirimdata['jam'] = date("h:i:sa");
		// $this->mainModel->save($kirimdata);
		// if (isset($data_arus) && isset($data_tegangan)) {
			
			$this->mainModel->addArus($kirimdata);
			return redirect()->to('/');
		// }
	}

	// Tegangan
	public function tegangan()
	{
		return view('pages/tegangan');
	}
	public function laporan_arus()
	{
		return view('welcome_message');
	}
	public function laporan_tegangan()
	{
		return view('welcome_message');
	}
}
