<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_students extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'students';
	private static $pk = 's_id';

	public function is_exist($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function get_students($where)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->join('majors', 'majors.m_id = students.s_mid', 'left')
					->where($where)
					->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function get_majors()
	{
		return $this->db->get('majors')->result_array();
	}

	public function add($data)
	{
    	return $this->db->insert(self::$table, $data);
	}

	public function do_import($data)
	{
        return $this->db->insert(self::$table, $data);
	}

	public function edit($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}

	public function status($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}

	public function active($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}

	public function delete($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}

	public function restore($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}
}
