<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboards extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'documents';

	public function get_documents()
	{
		return $this->db->get(self::$table)->result();
	}

	public function get_maps($wm)
	{
		return $this->db->where($wm)->get(self::$table)->result();
	}

	public function get_bi($whi)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->where($whi)
					->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function get_bs($whs)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->where($whs)
					->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function get_mwi($mwi)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->where($mwi)
					->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function get_mws($mws)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->where($mws)
					->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}
}
