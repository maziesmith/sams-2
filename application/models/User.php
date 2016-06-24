<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Model {

    private $table = 'users';
    private $column_id = 'id';
    public $validate = array(
        array( 'field' => 'username', 'label' => 'Username', 'rules' => 'required|trim|is_unique[users.username]' ),
        // array( 'field' => 'password', 'label' => 'Code', 'rules' => 'trim' ),
    );

    function __construct()
    {
        parent::__construct();
    }

    public function validate($is_first_time=false, $id=null, $value=null)
    {
        $this->load->library('form_validation');

        foreach ($this->validate as $key => $validate)
        {
            $this->form_validation->set_rules( $validate['field'], $validate['label'], $validate['rules'] );
        }

        if($is_first_time)
        {
            $this->form_validation->set_message('is_unique', 'The %s is already in use');
            $this->form_validation->set_rules( 'groups_code', 'Code', 'is_unique[groups.groups_code]' );
        }
        else
        {
            $original_value = $this->db->where('groups_id', $id)->get($this->table)->row()->groups_code;
            if( $value != $original_value ) {
                $this->form_validation->set_message('is_unique', 'The %s is already in use');
                $this->form_validation->set_rules( 'groups_code', 'Code', 'is_unique[groups.groups_code]' );
            }
        }

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_all($start_from=0, $limit=0, $sort=null)
    {
        if( null != $sort )
        {
            foreach ($sort as $field_name => $order) {
                $this->db->order_by($field_name, $order);
            }
        }

        $this->db->limit( $limit, $start_from );

        return $this->db->get($this->table);
    }

    public function debug()
    {

    }

    public function fullname($id, $format=1)
    {
        $query = $this->db->where($this->column_id, $id)->get($this->table);
        switch ($format) {
            case 1:
                return $query->firstname . " " . $query->middlename . " " . $query->lastname;
                break;

            default:
                return $query->firstname . " " . $query->middlename . " " . $query->lastname;
                break;
        }
        return $query->firstname . " " . $query->middlename . " " . $query->lastname;
    }

}
 ?>