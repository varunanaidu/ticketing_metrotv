<?php defined('BASEPATH') OR exit("No direct script access allowed");
class History_inboundmodel extends CI_Model{
    function find($key=""){
        $this->db->select("*");
        if ( empty($key) == FALSE )
            $this->db->where("id", $key);
        $q = $this->db->get("tab_ticket");
        if ( $q->num_rows() == 0 )
            return FALSE;
        return $q->result();
    }


    /*** DATATABLE SERVER SIDE FOR OUTBOUND ***/
    function _get_applicant_query($data=''){
        $log  = $this->session->userdata('idocs-itdev');
        $dept = $log->log_dept;
        $__order 			= array('tab_ticket.ticket_id' => 'ASC');
        $__column_search 	= array('tab_ticket.ticket_id', 'ticket_description', 'sender', 'recipient', 'create_date', 'solved_date', 'create_name', 'solved_by');
        $__column_order     = array('tab_ticket.ticket_id', 'ticket_description', 'sender', 'recipient', 'create_date', 'solved_date', 'create_name', 'solved_by');

        $this->db->select('tab_ticket.ticket_id, ticket_description, sender, recipient, create_date, solved_date, create_name, solved_by');
        $this->db->from('tab_ticket');
        $this->db->join('tr_ticketing', 'tr_ticketing.ticket_id = tab_ticket.ticket_id', 'left');
        $this->db->where('ticket_status', 2);
        $this->db->where('recipient', $dept);

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

    function get_applicant($data=''){
        if ($data != '') {
            $this->_get_applicant_query($data);
        }else{
            $this->_get_applicant_query();
        }
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
    	$this->db->from('tab_ticket');
     $this->db->where('ticket_status', 2);
     $query = $this->db->get();
     return $query->num_rows();
 }
}