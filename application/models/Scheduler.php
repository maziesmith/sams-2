<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scheduler extends CI_Model {
    private $table = 'scheduler';
    private $column_id = 'id';
    private $column_softDelete = 'removed_at';
    private $column_softDeletedBy = 'removed_by';
    public $validations = array(
        array( 'field' => 'msisdn[]', 'label' => 'Mobile Number', 'rules' => 'required' ),
        array( 'field' => 'body', 'label' => 'Mobile Number', 'rules' => 'required' ),
        array( 'field' => 'send_at_date', 'label' => 'Date', 'rules' => 'required' ),
        array( 'field' => 'send_at_time', 'label' => 'Time', 'rules' => 'required' ),
    );

    function __construct()
    {
        parent::__construct();
    }

    public function validate($is_first_time=false, $id=null, $value=null)
    {
        $this->load->library('form_validation');

        foreach ($this->validations as $validation) {
            $this->form_validation->set_rules( $validation['field'], $validation['label'], $validation['rules'] );
        }

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function all($removed_only=false, $select="*")
    {
        if( $removed_only ) return $this->db->select($select)->where($this->column_softDelete ." != ", NULL)->get($this->table)->result();
        $query = $this->db->where($this->column_softDelete, NULL)->get($this->table);
        return $query->result();
    }

    public function get_all($start_from=0, $limit=0, $sort=null, $removed_only=false)
    {
        if( null != $sort )
        {
            foreach ($sort as $field_name => $order) {
                $this->db->order_by($field_name, $order);
            }
        }

        $this->db->limit( $limit, $start_from );

        if( $removed_only ) return $this->db->where($this->column_softDelete . " != ", NULL)->get($this->table);
        return $this->db->where($this->column_softDelete, NULL)->get($this->table);
    }

    public function find($id, $column=null)
    {
        if (null != $column) {
            $query = $this->db->where($column, $id)->get($this->table);
            return $query->row();
        }

        if ( is_array($id) ) return $this->db->where_in($this->column_id, $id)->get($this->table);

        $query = $this->db->where($this->column_id, $id)->get($this->table);
        return $query->row();
    }

    public function like($wildcard='', $start_from=0, $limit=0, $sort=null, $removed_only=false)
    {
        $this->db->where('message_id LIKE ', '%'. $wildcard . '%')
                ->or_where('member_id LIKE ', '%'. $wildcard . '%')

                ->or_where('group_id', '%'. $wildcard)

                ->or_where('msisdn LIKE ', '%'. $wildcard . '%')
                ->or_where('sms LIKE ', '%'. $wildcard . '%')
                ->or_where('status LIKE ', '%'. $wildcard . '%')

                ->from($this->table)
                ->select('*');

        if( null != $sort ) {
            foreach ($sort as $field_name => $order) {
                $this->db->order_by($field_name, $order);
            }
        }

        $this->db->limit( $limit, $start_from );

        if( $removed_only ) return $this->db->where($this->column_softDelete . " !=", NULL)->get();
        return $this->db->where($this->column_softDelete, NULL)->get();
    }

    public function send()
    {
        //
    }

}
 ?>