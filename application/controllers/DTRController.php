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
        $this->load->model('Message', '', TRUE);

        $this->user_id = $this->session->userdata('id');

        $this->Data['Headers'] = get_page_headers();
    }

    public function validated()
    {
        $this->session->set_flashdata('error', "You are not logged in");
        if(!$this->session->userdata('validated')) redirect('login');
    }

    /**
     * Execute
     *
     *
     * @return [type] [description]
     */
    public function execute()
    {
        $stud_no = $this->input->post('stud_no');
        $e_date = $this->input->post('e_date');
        $e_time = $this->input->post('e_time');

        $this->Message->send()
    }

}