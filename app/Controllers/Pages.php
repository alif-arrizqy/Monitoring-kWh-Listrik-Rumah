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
		$date = time();
		$bulan = date("m", $date);
		$data['kwh'] = $this->mainModel->kwh_bulan($bulan);
		$data['jumlah'] = $this->mainModel->biaya_bulan($bulan);
		$data['token'] = $this->mainModel->getDataToken();
		return view('pages/index', $data);
	}

	// Token
	public function token()
	{
		return view('pages/token');
	}

	public function save_token()
	{
		// $jumlah = $this->request->getPost('inputJumlah');
		$date = time();
		$tarif = 1467.28;
		$jumlah = $this->request->getPost('inputJumlah');
		round($kwh = $jumlah / $tarif);

		$kirimdata = [
			'jumlah' => $jumlah,
			'kwh' => $kwh,
			'tanggal' => date("d", $date),
			'bulan' => date("m", $date)
		];
		$this->mainModel->addToken_temp($kirimdata);
		$success = $this->mainModel->addToken($kirimdata);
		if ($success) {
			session()->setFlashData('sukses', 'Data berhasil disimpan');
			return redirect()->to('/pages/token');
		} else {
			session()->setFlashData('gagal', 'Data gagal disimpan');
			return redirect()->to('/pages/token');
		}
	}
	
	// Arus
	public function arus()
	{
		return view('pages/arus');
	}
	public function save_arus($data_arus, $data_daya)
	{
		// echo "arus: $data_arus, tegangan: $data_tegangan";
		$date = time();
		$kirimdata['data_arus'] = $data_arus;
		$kirimdata['data_daya'] = $data_daya;
		$kirimdata['bulan'] = date("m", $date);
		// $kirimdata['jam'] = date("h:i:sa");
		$this->mainModel->addArus($kirimdata);
		return redirect()->to('/');
	}

	// Tegangan
	public function daya()
	{
		return view('pages/daya');
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
