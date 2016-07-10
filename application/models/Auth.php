<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Auth extends CI_Model {

    private $table = 'users';
    private $column_id = 'id';
    public $validations = array(
        array( 'field' => 'username', 'label' => 'username', 'rules' => 'required|trim' ),
        array( 'field' => 'password', 'label' => 'password', 'rules' => 'required|trim' ),
        array( 'field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email' ),
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function validate($value=null)
    {
        $this->load->library('form_validation');

        foreach ($this->validations as $validation) {
            $this->form_validation->set_rules( $validation['field'], $validation['label'], $validation['rules'] );
        }

        $original = $this->db->where('username', $value)->get($this->table)->row()->username;
        /**
         * Only reset the rules if the
         * Original value is not equal to
         * the current value
         */
        if( null != $original && ($value != $original) ) {
            $this->form_validation->set_message('is_unique', 'The %s is already in use');
            $this->form_validation->set_rules( 'email', 'Email', 'trim|valid_email|is_unique['.$this->table.'.email]' );
        }

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public function check($username, $password, $remember_me=false)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows() == 1 && ($row = $query->row()) ) {

            if( password_verify($password, $row->password) ) {
                $data = array(
                    'id' => $row->id,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'username' => $row->username,
                    'validated' => true,
                    'privilege' => $row->privilege,
                    'privilege_level' => $row->privilege_level,
                    'isSuperAdmin' => false,
                );
                $this->session->set_userdata($data);
                return true;
            }
            return false;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }

    public function can($url=null, $id=null)
    {
        $this->load->model('PrivilegesLevel', '', TRUE);
        $this->load->model('Module', '', TRUE);

        if( $this->session->isSuperAdmin ) return true;

        if( null == $id ) $id = $this->session->privilege_level;
        if( null == $url ) $url = preg_replace('/(\/[0-9]+)/', '', $this->uri->uri_string);

        $privilege = $this->PrivilegesLevel->find( $id );
        $modules_ids = explode(",", $privilege->modules);
        $slugs = null;
        foreach ($modules_ids as $module_id) {
            $module = $this->Module->find($module_id);
            $slugs[] = $module->slug;
        }
        if( is_array($url) ) {
            $can = array_diff($url, $slugs);
            if( count($can) == 0 ) return true;
            else return false;
        }
        if( !in_array($url, $slugs) ) {
            return false;
        } else {
            return true;
        }
    }

    public function find($id)
    {
        $query = $this->db->where($this->column_id, $id)->get($this->table);
        return $query->row();
    }

}