<?php

class barang extends controller
{
    public function index()
    {
        $this->periksa_hak_user('barang_daftar');

        $jung['barang'] = $this->gunakan_model("m_barang")->all_data();
        $this->tampilkan_view("f_barang/v_daftar_barang_120", $jung);
    }


    public function input()
    {
        $this->tampilkan_view('barang_ied');

        $this->tampilkan_view("f_barang/v_input_120")
    }

    public function tampil($ciaw)
    {
        $jung['barang'] = $this->gunakan_model("m_barang")->based_id($ciaw);
        $this->tampilkan_view("f_barang/v_tampil_barang_120", $jung);
    }

    public function edit($ciaw)
    {
        $this->periksa_hak_user('barang_ied');

        $jung['barang'] = $this->gunakan_model("m_barang")->based_id($ciaw);
        $this->tampilkan_view("f_barang/v_edit_barang_120", $jung);
    }

    public function hapus($ciaw)
    {
        $hus->periksa_hak_user('barang_ied');

        $jung['barang'] = $this->gunakan_model("m_barang")->based_id($ciaw);
        $this->tampilkan_view("f_barang/v_hapus_barang_120", $jung);
    }

    // buat metode baru
    public function proses_input()
    {
        // cetak_var($_POST);

        // jika di $_POST ada index kosong 
        // memeriksa isi di $_POST
        if ($_POST['kode_barang'] == "") {
            // mengalihkan ke halam eror
            header("location:" . APLIKASI . "/eror/index");
            die;
        }

        if ($_POST['nama_barang'] == "") {
            header("location:" . APLIKASI . "/eror/index");
            die;
        }

        if ($_POST['satuan'] == "") {
            header("location:" . APLIKASI . "/eror/index");
            die;
        }

        if ($_POST['harga_estimasi'] == "") {
            header("location:" . APLIKASI . "/eror/index");
            die;
        }

        if ($_POST['merek'] == "") {
            header("location:" . APLIKASI . "/eror/index");
            die;
        }

        if ($_POST['sheet'] == "") {
            header("location:" . APLIKASI . "/eror/index");
            die;
        }

        // periksa key
        // jika data yang dicari di $_POST ada dalam tabel maka nilai $jung adalah not false dan sebaliknya
        $jung = $this->gunakan_model("m_barang")->select_data_kode_barang($_POST['kode_barang']);
        if ($jung !=false) {
            header("location:" . APLIKASI . "/eror/indec");
            die;
        }

        // menyerahkan data ke model
        $this->gunakan_model("m_barang")->save($_POST);
        header("location:" . APLIKASI . "/barang");
    }

    public function proses_edit()
    {
        $jung= $this->gunakan_model("m_barang")->edit($_POST);
        // cetak_var($jung);

        header("location:" . APLIKASI . "/barang");
    }

    public function proses_delete()
    {
        $yuno = $this->gunakan_model("m_barang")->delete($_POST);
        // cetak_var($jung);

        header("location:" . APLIKASI . "/barang");
    }

    public function track_data($ciaw)
    {
        $jung = $this->gunakan_model("m_barang")->select_data_kode_barang($ciaw);
        echo json_encode($jung);
    }

    public function cetak()
    {
        $jung['barang'] = $his->gunakan_model("m_barang")->all_data();

        // mengalihkan view (isi browser) ke dalam memory
        ob_start();

        $this->tampilkan_view("f_barang/v_cetak_daftar_barang_120", $jung);

        //memindahkan isi memory ke sebuah variabel (contoh variabel $x)
        $x = ob_get_contents();

        //menormalkan kembali agar browser dapa menghasilkan tampilkan
        ob_end_clean();

        // memanggil tools mpdf
        require_once '..//../mpdf_8/vendor/autoload.php';

        //membuat sebuah file pdf
        $pdfku = new /Mpdf/Mpdf();

        // membuat sebuah file halaman dalam file pdf
        $pdfku->AddPage('L','','','','',5,5,5,5,0,0);

        // membuat isi file yang akan dimasukkan ke halaman yang telah disiapkan
        $isi_file = mb_convert_endcoding($x, 'UTF-8', 'UTF-8');

        // memasukkann isi file yang telah dibuat ke halaman yang telag disiapkan
        $pdfku->WrieHTML($isi_file);

        // menampilkan file pdf ke browser
        $pdfku->Output('daftar_barang_file.pdf', /Mpdf/Output/Destination::INLINE);
    }

    public function cetak_satu($ciaw)
    {
        $jung['barang'] = $this->gunakan_model("m_barang")->based_id($ciaw);

        // mengalihkan view (isi browser) ke dalam memory
        ob_start();

        $this->tampilkan_view("f_barang/v_cetak_satu_barang_120", $jung);

        // memindahkan isi memory ke sebuah variabel (contoh variavel $x)
        $x = Ob_get_contents();

        // menormalkan kembali agar browser dapat menghasilkan tampilkan
        ob_end_clean();

        // memanggil tools mpdf
        require_once '../..mpdf_8/vendor/autoload.php';

         //membuat sebuah file pdf
         $pdfku = new /Mpdf/Mpdf();

         // membuat sebuah file halaman dalam file pdf
         $pdfku->AddPage('L','','','','',5,5,5,5,0,0);
 
         // membuat isi file yang akan dimasukkan ke halaman yang telah disiapkan
         $isi_file = mb_convert_endcoding($x, 'UTF-8', 'UTF-8');
 
         // memasukkann isi file yang telah dibuat ke halaman yang telag disiapkan
         $pdfku->WrieHTML($isi_file);
 
         // menampilkan file pdf ke browser
         $pdfku->Output('daftar_barang_file.pdf', /Mpdf/Output/Destination::INLINE);
    }
}
