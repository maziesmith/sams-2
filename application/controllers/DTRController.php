<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DTRController extends CI_Controller {
    private $Data = array();
    private $user_id = 0;

    public function __construct()
    {
        parent::__construct();
        // $this->validated();

        $this->load->model('DTRLog', '', TRUE);
        $this->load->model('Member', '', TRUE);

        $this->user_id = $this->session->userdata('id');

        $this->Data['Headers'] = get_page_headers();
    }

    public function validated()
    {
        $this->session->set_flashdata('error', "You are not logged in");
        if(!$this->session->userdata('validated')) redirect('login');
    }

    public function tap()
    {
        //
    }

}