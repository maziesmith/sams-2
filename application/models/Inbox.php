<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends CI_Model {
    private $table = 'inbox';
    private $outbox_table = 'outbox';
    private $contacts_table = 'members';
    private $column_id = 'id';
    private $column_softDelete = 'removed_at';
    private $column_softDeletedBy = 'removed_by';
    public $validate = array(
        array( 'field' => 'msisdn', 'label' => 'Name', 'rules' => 'trim' ),
    );

    function __construct()
    {
        parent::__construct();
    }

    public function validate($id=null, $value=null)
    {
        $this->load->library('form_validation');

        foreach ($this->validate as $key => $validate) {
            $this->form_validation->set_rules( $validate['field'], $validate['label'], $validate['rules'] );
        }

        return ($this->form_validation->run() == FALSE) ? false : true;
    }

    public function all($removed_only=false)
    {
        if( $removed_only ) return $this->db->where($this->column_softDelete ." != ", NULL)->get($this->table)->result();
        $query = $this->db->where($this->column_softDelete, NULL)->get($this->table);
        return $query->result();
    }

    public function messages($compare='members.msisdn = inbox.msisdn', $table=null, $select="*")
    {
        if( null == $table ) $table = $this->contacts_table;
        $query = $this->db->select($select);
        $query->join($table, $compare);
        $query->join($this->outbox_table, 'outbox.msisdn = inbox.msisdn');
        return $query->get( $this->table )->result();
    }
}