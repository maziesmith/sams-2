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


		$this->curl_to_monitor("http://www.monitor-dtr.edu.ph/read?stud_no=$stud_no&e_date=$e_date&e_time=$e_time&e_mode=$e_mode");

		$data = array(
		   "member_id" => $member->id,//$stud_no,
		   "timelog" => $timelog,
		   "mode" => $e_mode,
		);

		$this->DTRLog->insert($data);

		# DTR
		$dtr_data = $this->DTR->find($member->id, "member_id");
		$is_timein=false;
		$is_timeout=false;
		if ($dtr_data) {
		    $dateout = date("Y-m-d", strtotime($e_date));
		    $timeout = date("H:i:s", strtotime($e_time));
		    $this->DTR->update($dtr_data->id, array('dateout'=>$dateout, 'timeout'=>$timeout));
		    $is_timeout = true;
		} else {
			$is_timein = true;

		    $member_id = $member->id;
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
		    "time" => date("H:i:s", strtotime($e_time)),
		    "msisdn" => $this->Member->find($stud_no, "stud_no", "msisdn")->msisdn,
		    "is_timein" => $is_timein,
		    "is_timeout" => $is_timeout,
		    "schedule_id" => $this->Member->find($stud_no, "stud_no", "schedule_id")->schedule_id,
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
		$schedule_id = (null != $data['schedule_id'] && 0 != $data['schedule_id']) ? $data['schedule_id'] : 1;

		if ($data['is_timeout']) {
		    $times = $this->db->query("SELECT * FROM dtr_time_settings WHERE name LIKE '%OUT%' AND schedule_id = $schedule_id AND '$e_time' BETWEEN time_from AND time_to")->row();
		} elseif ($data['is_timein']) {
			$times = $this->db->query("SELECT * FROM dtr_time_settings WHERE name LIKE '%IN%' AND schedule_id = $schedule_id AND '$e_time' BETWEEN time_from AND time_to")->row();
		} else {
			$times = $this->db->query("SELECT * FROM dtr_time_settings WHERE schedule_id = $schedule_id AND '$e_time' BETWEEN time_from AND time_to")->row();
		}

		if (empty($times)) {
			echo "WARNING | Out too Early | Must have been a double tap. No Message will be sent."; exit();
		}

		$template = $this->db->query("SELECT * FROM preset_messages WHERE id='$times->presetmsg_id'")->row();

		$detokenized = $this->Message->detokenize($template->name, $data);

		$body = $detokenized;
		$msisdn = $data['msisdn'];

		# Check table str_sending_config which config is enabled
		# for sending
		$sending = $this->db->select('config')->where('enabled', 1)->limit(1)->get('dtr_sending_config')->row();

		echo "$sending->config | $times->name | $body";
		$message_id = null;

		if ($sending && !empty($sending->config)) {
			# Compose message
			$message = array(
			    "message" => $body,
			    "msisdn" => $msisdn,
			    "by" => $this->user_id,
			);
			switch ($sending->config) {
				case 'A':
					$message_id = $this->Message->insert($message);
					echo "MODE A | A message will be sent";
					break;

				case 'B':
					$today_is_a_weekend = in_array(date('D'), array('Sat', 'Sun')) ? 1 : 0;
					$time_inLate_or_outEarly = in_array($times->name, array('LATE_IN', 'LATE_OUT', 'EARLY_OUT')) ? 1 : 0;
					if (1 == $today_is_a_weekend || 1 == $time_inLate_or_outEarly) {
						$message_id = $this->Message->insert($message);
						echo "MODE B was used. A message will be sent...";
					} else {
						echo "MODE B | NORMAL_IN/OUT so we did not send any messages";
					}
					break;

				case 'C':
					echo "Mode C | All card tap are sent.";
					$message_id = $this->Message->insert($message);
					break;

				# default here is actually useless & just for completion
				# since we've checked that $sending->config
				# should not be empty.
				default:
					echo "No Mode";
					exit();
					break;
			}
		} else {
			echo "No Mode/config was found/specified. No messages will be sent upon tapping card.";
			exit();
		}

		# Send to $msisdn if we have a message
		if (null != $message_id) {
			$members = $this->Member->find_member_via_msisdn($msisdn);
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
			    echo "Message was sent to $msisdn";
			}
		}

    }

}
