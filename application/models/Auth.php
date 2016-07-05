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

            if( password_verify($password, $row->password) ) {
                $data = array(
                    'id' => $row->id,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'username' => $row->username,
                    'validated' => true,
                    'privilege' => $row->privilege,
                    'privilege_level' => $row->privilege_level,
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

        if( null == $id ) $id = $this->session->privilege_level;
        if( null == $url ) $url = $this->uri->uri_string;

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