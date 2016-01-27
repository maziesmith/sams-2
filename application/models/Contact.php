<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contact extends CI_Model {

    private $table = 'contacts';
    private $column_id = 'contacts_id';
    public $validations = array(
        array( 'field' => 'contacts_firstname', 'label' => 'First Name', 'rules' => 'required|trim' ),
        array( 'field' => 'contacts_lastname', 'label' => 'Last Name', 'rules' => 'required|trim' ),

        // array( 'field' => 'contacts_level', 'label' => 'Level', 'rules' => 'required' ),
        // array( 'field' => 'contacts_type', 'label' => 'Type', 'rules' => 'required' ),
        // array( 'field' => 'contacts_group', 'label' => 'Group', 'rules' => 'required' ),

        array( 'field' => 'contacts_street', 'label' => 'Street', 'rules' => 'required|trim' ),
        array( 'field' => 'contacts_brgy', 'label' => 'Subdivision / Brgy', 'rules' => 'required|trim' ),
        array( 'field' => 'contacts_city', 'label' => 'Town / City', 'rules' => 'required|trim' ),

        array( 'field' => 'contacts_mobile', 'label' => 'Mobile', 'rules' => 'required' ),
        array( 'field' => 'contacts_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email' )
    );

    function __construct()
    {
        parent::__construct();
    }

    public function validate($is_first_time=false, $id=null, $value=null)
    {
        $this->load->library('form_validation');

        foreach ($this->validations as $validation)
        {
            $this->form_validation->set_rules( $validation['field'], $validation['label'], $validation['rules'] );
        }

        /**
         * If the Validation is running
         * on the Add Function
         */
        if($is_first_time)
        {
            $this->form_validation->set_message('is_unique', 'The %s is already in use');
            $this->form_validation->set_rules( 'contacts_email', 'Email', 'trim|required|valid_email|is_unique[contacts.contacts_email]' );
        }
        else
        {
            $original = $this->db->where('contacts_id', $id)->get($this->table)->row()->contacts_email;

            /**
             * Only reset the rules if the
             * Original value is not equal to
             * the current value
             */
            if( $value != $original ) {
                $this->form_validation->set_message('is_unique', 'The %s is already in use');
                $this->form_validation->set_rules( 'contacts_email', 'Email', 'trim|required|valid_email|is_unique[contacts.contacts_email]' );
            }
        }

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        } else {
            return true;
        }
    }

    public function all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_all($start_from=0, $limit=0)
    {
        $query = $this->db->limit( $limit, $start_from )->get($this->table);
        return $query;
    }

    public function find($id)
    {
        $query = $this->db->where($this->column_id, $id)->get($this->table);
        return $query->row();
    }

    public function like($wildcard='', $start_from=0, $limit=0)
    {
        $first = ''; $last='';
        if(preg_match('/\s/', $wildcard))
        {
            $name = explode(" ", $wildcard);
            $first = $name[0];
            $last = $name[1];
        }
        $this->db->where('contacts_firstname LIKE', '%'. $wildcard . '%')
                ->or_where('contacts_middlename LIKE', '%'. $wildcard . '%')
                ->or_where('contacts_lastname LIKE', '%'. $wildcard . '%')

                ->or_where('contacts_middlename', $wildcard)

                ->or_where('contacts_id LIKE', $wildcard . '%')
                ->or_where('contacts_level LIKE', $wildcard . '%')
                ->or_where('contacts_type LIKE', $wildcard . '%')
                ->or_where('contacts_blockno LIKE', $wildcard . '%')
                ->or_where('contacts_street LIKE', $wildcard . '%')
                ->or_where('contacts_brgy LIKE', $wildcard . '%')
                ->or_where('contacts_city LIKE', $wildcard . '%')
                ->or_where('contacts_zip LIKE', $wildcard . '%')
                ->or_where('contacts_telephone LIKE', $wildcard . '%')
                ->or_where('contacts_mobile LIKE', $wildcard . '%')
                ->or_where('contacts_email LIKE', $wildcard . '%')
                ->or_where('contacts_group LIKE', $wildcard . '%')

                ->or_where('contacts_firstname', $first)
                ->or_where('contacts_lastname', $last)
                ->or_where('contacts_firstname', $last)
                ->or_where('contacts_lastname', $first)

                ->from($this->table)
                ->select('*')
                ->limit( $limit, $start_from );
        return $this->db->get();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->column_id, $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function delete($id)
    {
        if( is_array($id) )
        {
          $this->db->where_in($this->column_id, $id)->delete($this->table);
          return $this->db->affected_rows() > 0;
        }

        $this->db->where($this->column_id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows() > 0;
    }

    public function where($where, $start_from=0, $limit=0)
    {
        $this->db->select('*')->from($this->table);
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->limit($limit, $start_from);
        return $this->db;
    }

}
 ?>