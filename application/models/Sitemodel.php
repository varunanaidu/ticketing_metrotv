<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class Sitemodel extends CI_Model{
/*
$table = String
$join = Array
$select = String
$where = Array
$order_by = String
*/
function view($table, $select, $where=false, $join=false, $order_by=false, $limit=false, $ex_select = true, $group_by=false){
	$this->db->select($select, $ex_select);
	$this->db->from($table);
	if ( $where )
		$this->db->where($where);

	if ( $order_by )
		$this->db->order_by($order_by);

	if ( $join ){
		foreach($join as $key => $value){
			$exp = explode(',', $value);
			$this->db->join($key, $exp[0], $exp[1]);
		}
	}

	if ( $limit ){
		$this->db->limit($limit);
	}

	if ( $group_by )
		$this->db->group_by($group_by);

	$q = $this->db->get();
	if ( $q->num_rows() > 0 )
		return $q->result();
	else
		return '0';
}

function custom_query($sql, $where=false){
	if ( $where )
		$q = $this->db->query($sql, $where);
	else
		$q = $this->db->query($sql);

	if ( $q->num_rows() > 0 )
		return $q->result();
	else
		return '0';
}

function insert($table, $data){
	$this->db->insert($table, $data);
	$ret = $this->db->insert_id();
	return $ret;
}

function update($table, $data, $where){
	$this->db->trans_start();
	$this->db->where($where);
	$this->db->update($table, $data);
	$this->db->trans_complete();

	if ( $this->db->trans_status() === FALSE )
		return '0';
	else
		return '1';
}

function delete($table, $where){
	$this->db->trans_start();
	$this->db->where($where);
	$this->db->delete($table);
	$this->db->trans_complete();

	if ( $this->db->trans_status() === FALSE )
		return '0';
	else
		return '1';
}
}