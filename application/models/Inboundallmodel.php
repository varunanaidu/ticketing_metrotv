<?php defined('BASEPATH') OR exit("No direct script access allowed");

class Inboundallmodel extends CI_Model{

    /*** DATATABLE SERVER SIDE FOR OUTBOUND ***/
    function _get_applicant_query(){
        $log  = $this->session->userdata('idocs-itdev');
        $dept = $log->log_dept;

        $__order 			= array('tr_id' => 'DESC');
        $__column_search    = array('ticket_id', 'tr_id', 'ticket_description', 'recipient_dept', 'status_name', 'prirority_name', 'request_by', 'request_solved_date',  'create_date');
        $__column_order     = array('ticket_id', 'tr_id', 'ticket_description', 'recipient_dept', 'status_name', 'prirority_name', 'request_by', 'request_solved_date',  'create_date');

        $this->db->select('*');
        $this->db->from('vw_last_ticket');
        $this->db->where_in('status_id', [2, 3, 4]);

        $i = 0;
        $search_value = $this->input->post('search')['value'];
        foreach ($__column_search as $item){
           if ($search_value){
                if ($i === 0){ // looping awal
                	$this->db->group_start(); 
                	$this->db->like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                else{
                	$this->db->or_like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                if (count($__column_search) - 1 == $i) $this->db->group_end(); 
            }
            $i++;
        }

        /* order by */
        if ($this->input->post('order') != null){
        	$this->db->order_by($__column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if (isset($__order)){
        	$order = $__order;
        	$this->db->order_by(key($order), $order[key($order)]);
        }

    }

    function get_applicant(){
        $this->_get_applicant_query();
        if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function get_applicant_count_filtered(){
    	$this->_get_applicant_query();
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function get_applicant_count_all(){
    	$this->db->from('vw_last_ticket');
    	return $this->db->count_all_results();
    }
}