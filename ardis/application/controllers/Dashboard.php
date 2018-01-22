<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->auth->restrict();
        $this->load->model('m_dashboards');
}


	public function index()
	{
        // total siswa aktif
        $wt = "s_is_deleted = 'false' AND s_is_active = 'Aktif'";
        $data['total'] = count($this->m_dashboards->total($wt));

        // Persentasi belum ada data
        $wb = "s_status = 'Belum Ada Data' AND s_is_deleted = 'false' AND s_is_active = 'Aktif'";
        $belum = $this->m_dashboards->belum($wb);
        $data['totalb'] = count($belum);

        if ($data['totalb'] < 1) {
            $data['persenb'] = 0;
        } else {
            $data['persenb'] = substr(($data['totalb'] / $data['total'] * 100), 0, 5);
        }

        // Persentasi kurang
        $wk = "s_status = 'Kurang' AND s_is_deleted = 'false' AND s_is_active = 'Aktif'";
        $kurang = $this->m_dashboards->kurang($wk);
        $data['totalk'] = count($kurang);

        if ($data['totalk'] < 1) {
            $data['persenk'] = 0;
        } else {
            $data['persenk'] = substr(($data['totalk'] / $data['total'] * 100), 0, 5);
        }

        // Persentasi lengkap
        $wl = "s_status = 'Lengkap' AND s_is_deleted = 'false' AND s_is_active = 'Aktif'";
        $lengkap = $this->m_dashboards->lengkap($wl);
        $data['totall'] = count($lengkap);

        if ($data['totall'] < 1) {
            $data['persenl'] = 0;
        } else {
            $data['persenl'] = substr(($data['totall'] / $data['total'] * 100), 0, 5);
        }

        $data['title'] = "Admin &minus; Arsip Digital Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['content'] = 'dashboard/home';
		$this->load->view('dashboard/index', $data);
	}
}
