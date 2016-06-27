<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Auth extends CI_Model {

    private $table = 'users';
    private $column_id = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function check($username, $password, $remember_me=false)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows() == 1 && ($row = $query->row()) ) {
            // $this->db->where('password', $password);
            // If there is a user, then create session data
            // $row = $query->row();

            if( password_verify($password, $row->password) ) {
                $data = array(
                        'id' => $row->userid,
                        'firstname' => $row->firstname,
                        'lastname' => $row->lastname,
                        'username' => $row->username,
                        'validated' => true
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

    public function find($id)
    {
        $query = $this->db->where($this->column_id, $id)->get($this->table);
        return $query->row();
    }

}