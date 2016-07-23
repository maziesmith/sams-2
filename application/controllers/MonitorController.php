<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitorController extends CI_Controller {

    private $Data = array();
    private $user_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->validated();

        $this->load->model('Monitor', '', TRUE);

        $this->user_id = $this->session->userdata('id');

        $this->Data['Headers'] = get_page_headers();

        $this->Data['Headers']->CSS = '<link rel="stylesheet" href="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.css').'">';
        $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css').'">';
        $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/chosen/chosen.min.css').'">';

        $this->Data['Headers']->JS  = '<script src="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/bootstrap-growl/bootstrap-growl.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/moment/min/moment.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/jquery.validate/dist/jquery.validate.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/chosen/chosen.jquery.min.js').'"></script>';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/members.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/monitor.js').'"></script>';
    }

    public function validated()
    {
        $this->session->set_flashdata('error', "You are not logged in");
        if(!$this->session->userdata('validated')) redirect('login');
    }

    /**
     * Index Page for this controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
    
    }

    public function dtr()
    {   
        $this->Data['Headers']->Page = 'monitor/dtr';
        $this->load->view('layouts/main', $this->Data);
    }

    public function fetch_contact($generate = null)
    {   
        $data['results'] = $this->Monitor->all_members();
        $this->load->view('monitor/fetch_contact', $data);
    }
    public function fetch_level($generate = null)
    {    
        $data['results'] = $this->Monitor->all_levels();
        $this->load->view('monitor/fetch_level', $data);
    }
    public function fetch_group($generate = null)
    {   
        $data['results'] = $this->Monitor->all_groups();
        $this->load->view('monitor/fetch_group', $data);
    }
    public function fetch_csv($generate = null)
    {   
        $this->load->helper('download');
        $row  = $this->Monitor->generate_csv($_GET['date_from'],$_GET['date_to'],$_GET['category'],$_GET['category_level'],$_GET['type'],$_GET['type_order'],$_GET['time_from'],$_GET['time_to']);
        $filename = strtotime("now").'.csv';
        force_download($filename,$row);
    }

    public function generate($generate = null)
    {   
        $this->Data['results'] = $this->Monitor->generate_dtr($_GET['date_from'],$_GET['date_to'],$_GET['category'],$_GET['category_level'],$_GET['type'],$_GET['type_order'],$_GET['time_from'],$_GET['time_to']);
        $this->load->view('layouts/main', $this->Data);
    }
}   