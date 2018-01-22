<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_cabinets extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'cabinets';
	private static $pk = 'c_id';

	public function is_exist($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function add($data)
	{
    	return $this->db->insert(self::$table, $data);
	}

	public function get_cabinets($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function edit($data, $c_id)
	{
		return $this->db->set($data)->where(self::$pk, $c_id)->update(self::$table);
	}

	public function delete($data, $c_id)
	{
		return $this->db->set($data)->where(self::$pk, $c_id)->update(self::$table);
	}

	public function restore($data, $c_id)
	{
		return $this->db->set($data)->where(self::$pk, $c_id)->update(self::$table);
	}
}
