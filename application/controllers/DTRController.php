<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DTRController extends CI_Controller {
    private $Data = array();
    private $user_id = 0;

    public function __construct()
    {
	date_default_timezone_set('Asia/Singapore');
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
    
    public function dtr() {
	echo "-- You have contacted us --------";
	$stud_no = $this->input->get('stud_no');
	$e_date = $this->input->get('e_date');
	$e_time = $this->input->get('e_time');
	$e_mode = $this->input->get('e_mode');
	$timelog = date("Y-m-d H:i:s", strtotime($e_date . " " . $e_time));
	//$timelog = $this->input-get('timelog');
	$data = array(
	   "member_id" => $stud_no,
	   "timelog" => $timelog,
	   "mode" => $e_mode,
	);

	$this->DTRLog->insert($data);

	# DTR
	// $dtr_data = 
	$member_id = $stud_no;
	$datein = date("Y-m-d", strtotime($e_date));
	$timein = date("H:i:s", strtotime($e_time));
	// $dateout = ;
	// $timeout = ;
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

        $this->Message->send();
    }

}
