<?php

class home extends controller{
	public function index()
	{
		$this->tampilkan_view("selamat_datang");
	}
	public function kosong()
	{
		$this->tampilkan_view("halaman_kosong");
	}

}
?>