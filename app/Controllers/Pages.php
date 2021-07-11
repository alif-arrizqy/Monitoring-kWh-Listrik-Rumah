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
		helper('form');
	}

	public function index()
	{
		$date = time();
		$bulan = date("m", $date);
		$data['kwh'] = $this->mainModel->kwh_bulan($bulan);
		$data['jumlah'] = $this->mainModel->biaya_bulan($bulan);
		$data['token'] = $this->mainModel->getDataToken();
		$data['rekap_kwh'] = $this->mainModel->getDataKwh();
		$data['rekap_jumlah_biaya'] = $this->mainModel->getDataJumlahBiaya();
		return view('pages/index', $data);
	}

	// Token
	public function token()
	{
		$data['token'] = $this->mainModel->getAllDataToken();
		return view('pages/token', $data);
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
			'bulan' => date("m", $date),
			'waktu' => date("H:i:s", $date)
		];
		$success = $this->mainModel->addToken($kirimdata);
		if ($success) {
			session()->setFlashData('sukses', 'Data berhasil disimpan');
			return redirect()->to('/pages/token');
		} else {
			session()->setFlashData('gagal', 'Data gagal disimpan');
			return redirect()->to('/pages/token');
		}
	}

	public function edit_token($id)
	{
		$date = time();
		$tarif = 1467.28;
		$jumlah = $this->request->getPost('inputJumlah');
		round($kwh = $jumlah / $tarif);

		$kirimdata = [
			'id' => $id,
			'jumlah' => $jumlah,
			'kwh' => $kwh,
			'tanggal' => date("d", $date),
			'bulan' => date("m", $date),
			'waktu' => date("H:i:s", $date)
		];
		$this->mainModel->editToken($kirimdata);
		session()->setFlashData('sukses', 'Data berhasil disimpan');
		return redirect()->to('/pages/token');
	}

	public function delete_token($id)
	{
		$kirimdata = [
			'id' => $id
		];
		$this->mainModel->deleteToken($kirimdata);
		session()->setFlashData('hapus', 'Data berhasil dihapus');
		return redirect()->to('/pages/token');
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

	public function save_sampah_organik($tinggi, $metana, $status)
	{
		$date = time();
		$kirimdata['tinggi'] = $tinggi;
		$kirimdata['metana'] = $metana;
		$kirimdata['status'] = $status;
		$kirimdata['bulan'] = date("m", $date);
		// $kirimdata['jam'] = date("h:i:sa");
		$this->mainModel->add_sampah_organik($kirimdata);
		return redirect()->to('/');
	}
}
