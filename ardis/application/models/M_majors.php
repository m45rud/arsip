<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_majors extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'majors';
	private static $pk = 'm_id';

	public function is_exist($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function add($data)
	{
    	return $this->db->insert(self::$table, $data);
	}

	public function get_majors($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function edit($data, $m_id)
	{
		return $this->db->set($data)->where(self::$pk, $m_id)->update(self::$table);
	}

	public function delete($data, $m_id)
	{
		return $this->db->set($data)->where(self::$pk, $m_id)->update(self::$table);
	}

	public function restore($data, $m_id)
	{
		return $this->db->set($data)->where(self::$pk, $m_id)->update(self::$table);
	}
}
