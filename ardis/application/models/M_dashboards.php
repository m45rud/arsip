<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboards extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'students';

	public function total($wt)
	{
		return $this->db->where($wt)->get(self::$table)->result();
	}

	public function belum($wb)
	{
		return $this->db->where($wb)->get(self::$table)->result();
	}

	public function kurang($wk)
	{
		return $this->db->where($wk)->get(self::$table)->result();
	}

	public function lengkap($wl)
	{
		return $this->db->where($wl)->get(self::$table)->result();
	}

	public function belumx($wbx)
	{
		return $this->db->where($wbx)->get(self::$table)->result();
	}

	public function kurangx($wk)
	{
		return $this->db->where($wk)->get(self::$table)->result();
	}

	public function lengkapx($wl)
	{
		return $this->db->where($wl)->get(self::$table)->result();
	}
}
