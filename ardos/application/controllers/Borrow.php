<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Borrow extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->auth->restrict();
        $this->load->model('m_borrows');
    }

    public function index()
    {
        $wbri = "d_ijazah = 'Ada' AND d_ijazah_borrowed_at != 'NULL' AND d_is_deleted = 'FALSE'";
        $data['bri'] = $this->m_borrows->get_bri($wbri);

        $wbrs = "d_skhun = 'Ada' AND d_skhun_borrowed_at != 'NULL' AND d_is_deleted = 'FALSE'";
        $data['brs'] = $this->m_borrows->get_brs($wbrs);

        $data['title'] = "Rekap Pinjaman Ijazah & SKHUN &minus; Arsip Digital Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['content'] = "dashboard/borrow";
        $this->load->view('dashboard/index', $data);
    }
}
