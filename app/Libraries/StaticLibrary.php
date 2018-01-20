<?php

namespace App\Libraries;

class StaticLibrary
{
	public function getListPenghasilan(){
		$penghasilan = [
			1 => "Kurang dari Rp. 2.000.000,-",
			2 => "Rp. 2.000.000,- sampai Rp. 5.000.000,-",
			3 => "Lebih dari Rp. 5.000.000,-"
		];

		return $penghasilan;
	}

	public function getListPekerjaan(){
		$pekerjaan = [
			1 => "Karyawan",
			2 => "Wiraswasta"
		];

		return $pekerjaan;
	}

	public function getListPengeluaran(){
		$pengeluaran = [
			1 => "Kurang dari Rp. 2.000.000,-",
			2 => "Rp. 2.000.000,- sampai Rp. 5.000.000,-",
			3 => "Lebih dari Rp. 5.000.000,-"
		];

		return $pengeluaran;
	}

	public function getListStatusKawin(){
		$status = [
			1 => "Menikah",
			2 => "Belum Menikah"
		];

		return $status;
	}

	public function getPenghasilan($id){
		$penghasilan = $this->getListPenghasilan();
		return $penghasilan[$id];
	}

	public function getPekerjaan($id){
		$pekerjaan = $this->getListPekerjaan();
		return $pekerjaan[$id];
	}

	public function getPengeluaran($id){
		$pengeluaran = $this->getListPengeluaran();
		return $pengeluaran[$id];
	}

	public function getStatusKawin($id){
		$status = $this->getListStatusKawin();
		return $status[$id];
	}
}