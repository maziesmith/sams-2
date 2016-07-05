<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {
    private $Data = array();

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
        // $this->session->set_flashdata('error', "");
        if(!$this->session->userdata('validated')) redirect('login');
    }

    public function debug()
    {
        $this->load->model('Auth', '', TRUE);
        if( $this->Auth->can('members/update') ) {
            echo "can";
        } else {
            $data = array(
                'message' => 'Restricted access.',
                'type' => 'warning',
            );
            $this->session->set_flashdata('message', $data);
            $this->Data['Headers'] = get_page_headers();
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
        }
        // if( $this->Auth->can() )
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