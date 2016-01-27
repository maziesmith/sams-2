<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {

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