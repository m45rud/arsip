<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

	public $CI;

	public function __construct() {
		$this->CI = &get_instance();
	}

	public static $table = 'users';

	public function login($u_name, $u_pass)
	{
		$where = [
			'u_name' => $u_name,
			'u_is_active' => 'Aktif'
		];

		$result = $this->CI->db->where($where)->limit(1)->get(self::$table);

		if ($result->num_rows() === 1) {
			$data = $result->row();
			if (password_verify($u_pass, $data->u_pass)) {
				$session_data = [];
				$session_data['u_id'] = $data->u_id;
				$session_data['u_name'] = $data->u_name;
				$session_data['u_fname'] = $data->u_fname;
				$session_data['u_level'] = $data->u_level;
				$session_data['is_logged_in'] = TRUE;
				$this->CI->session->set_userdata($session_data);
				$this->last_logged_in();
				return TRUE;
			}
			return FALSE;
		} else {
			return FALSE;
		}
	}

	private function last_logged_in()
	{
		$data = [
			'u_last_logged_in' => date('Y-m-d H:i:s'),
			'u_ip_address' => $_SERVER['REMOTE_ADDR'],
		];
		$this->CI->db
			->where('u_name', $this->CI->session->userdata('u_name'))
			->update(self::$table, $data);
	}

	public function is_logged_in()
	{
		return $this->CI->session->userdata('is_logged_in');
	}

	public function auth()
	{
		if ($this->is_logged_in() == TRUE) {
			redirect('dashboard');
		}
	}

	public function restrict()
	{
		if (!$this->is_logged_in()) {
			redirect(site_url());
		}
	}

	public function is_admin()
	{
		return $this->CI->session->userdata('u_level');
	}

	public function admin()
	{
		if ($this->is_admin() != "Administrator") {
			redirect('dashboard');
		}
	}

	public function not_admin()
	{
		if ($this->is_admin() != "Administrator") {
			redirect('student');
		}
	}
}
