<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    private $Data = array();
    private $hidden;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Contact', '', TRUE);
        $this->load->model('Group', '', TRUE);

        $this->Data['Headers'] = get_page_headers();
        $this->Data['Headers']->CSS = '<link rel="stylesheet" href="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.css').'">';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/bootstrap-growl/bootstrap-growl.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/jquery.validate/dist/jquery.validate.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/login.js').'"></script>';
        $this->Data['Headers']->bodyClass = 'login-content';
    }
    /**
     * GET Login controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        return $this->load->view('auth/login', $this->Data);
    }

    /**
     * POST perform login
     *
     * @return
     */
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        echo json_encode(['asd'=>$username]); exit();
    }
}