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
	$this->load->model('DTR', '', TRUE);
	$this->load->model('Outbox', '', TRUE);
        $this->user_id = $this->session->userdata('id');

        $this->Data['Headers'] = get_page_headers();
    }

    public function validated()
    {
        $this->session->set_flashdata('error', "You are not logged in");
        if(!$this->session->userdata('validated')) redirect('login');
    }
    
    public function dtr() {
	$stud_no = $this->input->get('stud_no');
	$e_date = $this->input->get('e_date');
	$e_time = $this->input->get('e_time');
	$e_mode = $this->input->get('e_mode');
	$timelog = date("Y-m-d H:i:s", strtotime($e_date . " " . $e_time));
	
	$member = $this->Member->find($stud_no, "stud_no");
	if (!$member) { echo "**!! STUDENT No. IS NOT REGISTERED !!**"; exit(); }
	else { echo "-- STUDENT IS REGISTERED --"; }	

	
	//$cu = curl_init();
	//curl_setopt($cu, CURLOPT_URL, "http://www.monitor-dtr.edu.ph/read?stud_no=$stud_no&e_date=$e_date&e_time=$e_time&e_mode=$e_mode");
	//curl_setopt($cu, CURLOPT_URL, "http://www.monitor-dtr.edu.ph/read?stud_no=$stud_no&e_date=$e_date&e_time=$e_time&e_mode=$e_mode");
	//curl_setopt($cu, CURLOPT_HEADER, 0);
	//curl_exec($cu);
	//curl_close($cu);	
	echo $this->curl_to_monitor("http://www.monitor-dtr.edu.ph/read?stud_no=$stud_no");
	
	//curl_setopt($cu, CURLOPT_HEADER, 0);

	//$timelog = $this->input-get('timelog');
	$data = array(
	   "member_id" => $stud_no,
	   "timelog" => $timelog,
	   "mode" => $e_mode,
	);

	$this->DTRLog->insert($data);

	# DTR
	$message_template=0;
	$dtr_data = $this->DTR->find($stud_no, "member_id");
	if ($dtr_data) {
	    $dateout = date("Y-m-d", strtotime($e_date));
	    $timeout = date("H:i:s", strtotime($e_time));
	    $this->DTR->update($dtr_data->id, array('dateout'=>$dateout, 'timeout'=>$timeout));

	    //if ($dateout)	

	} else {
	    // $dtr_data = 
	    $member_id = $stud_no;
	    $datein = date("Y-m-d", strtotime($e_date));
	    $timein = date("H:i:s", strtotime($e_time));
	    $data = array(
	    	"member_id" => $member_id,
	    	"datein" => $datein,
	        "timein" => $timein,
	    );
	    $this->DTR->insert($data);
	}

	# Send
	$send_data = array(
	    "stud_no" => $stud_no,
	    "stud_name" => $this->Member->find($stud_no, "stud_no", "CONCAT(firstname, ' ', lastname) AS fullname")->fullname,
	    "mode" => $e_mode,
	    "date" => date("M-d-y", strtotime($e_date)),
	    "time" => date("h:ia", strtotime($e_time)),
	    "msisdn" => $this->Member->find($stud_no, "stud_no", "msisdn")->msisdn,
	);
	echo $this->execute($send_data);
    }

    public function curl_to_monitor($url)
    {
	$sock = @fopen($url, 'r');
	if ($sock) {
	    $str = fread($sock, 4096);
	    fclose($sock);
	    return $str;
	}
	return;

	$ch = curl_init($url);
	ob_start();
	curl_exec($ch);
	$str = ob_get_contents();
	ob_end_clean();
	curl_close($ch);
	return $str;
    }

    public function get_dtr()
    {
	echo $this->DTRLog->get_config();
    }

    /**
     * Execute
     *
     *
     * @return [type] [description]
     */
    public function execute($data=null)
    {
	$e_time = $data['time'];
	$e_mode = $data['mode'];
        $times = $this->db->query("SELECT * FROM dtr_time_settings WHERE '$e_time' BETWEEN time_from AND time_to")->row();
	$template = $this->db->query("SELECT * FROM preset_messages WHERE id='$times->presetmsg_id'")->row();
	$detokenized = $this->Message->detokenize($template->name, $data);
	
	$body = $detokenized;
	$msisdn = $data['msisdn'];
	$message = array(
	    "message" => $body,
	    "msisdn" => $msisdn,
	    "by" => $this->user_id,
	);
	$message_id = $this->Message->insert($message);
	
	$members = $this->Member->find_member_via_msisdn($msisdn);
	
	$outbox_id = null;
	foreach ($members as $member) {
	    $outbox = array(
	    	'message_id' => $message_id,
		'msisdn' => $msisdn,
		'status' => 'pending',
		'member_id' => $member->id,
		'smsc' => $smsc = $this->Message->get_network($msisdn),
		'created_by' => $this->user_id,
   	    );
	    $outbox_id = $this->Outbox->insert($outbox);
	    $this->Message->send($outbox_id, $msisdn, $smsc, $body);
	    echo "Message sent to $msisdn upon tapping of Card.";
	}
	
    }

}
