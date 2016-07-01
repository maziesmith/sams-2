<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->validated();
    }

    /**
     * Index for this controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $Data['Headers'] = get_page_headers();
        $Data['Headers']->Page = "dashboard";
        $this->load->view('layouts/main', $Data);
    }

    public function validated()
    {
        $this->session->set_flashdata('error', "You are not logged in");
        if(!$this->session->userdata('validated')) redirect('login');
    }

    /**
     * View for this controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function view($page)
    {
        $Data['Headers'] = get_page_headers();
        $this->load->view('layouts/main', $Data);
    }
}