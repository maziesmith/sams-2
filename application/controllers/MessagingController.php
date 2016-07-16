<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MessagingController extends CI_Controller {

    private $Data = array();
    private $user_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->validated();
        $this->user_id = $this->session->userdata('id');

        $this->load->model('Message', '', TRUE);
        $this->load->model('Outbox', '', TRUE);
        $this->load->model('Member', '', TRUE);
        $this->load->model('Group', '', TRUE);
        $this->load->model('GroupMember', '', TRUE);
        $this->load->model('Scheduler', '', TRUE);
        $this->Data['Headers'] = get_page_headers();


        $this->Data['Headers']->CSS = '<link rel="stylesheet" href="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.css').'">';
        $this->Data['Headers']->JS  = '<script src="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/bootstrap-growl/bootstrap-growl.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/moment/min/moment.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<link rel="stylesheet" href="'.base_url('assets/vendors/selectize.js/dist/css/selectize.bootstrap3.css').'">';

        $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css').'">';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js').'"></script>';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/selectize.js/dist/js/standalone/selectize.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/jquery.validate/dist/jquery.validate.min.js').'"></script>';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/messaging.js').'"></script>';
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
        if ($this->input->is_ajax_request()) {
            $contacts = $this->Member->all(false, 'id, CONCAT(firstname, " ", lastname) AS name, msisdn');
            $c = [];
            foreach ($contacts as $contact) {
                $c[$contact->msisdn][] = $contact;
            }
            $d = [];
            $i = 0;
            foreach ($c as $msisdn => $cc) {
                $d[$i]['id'] = $msisdn;
                $fullname = [];
                foreach ($cc as $ccc) {
                    $fullname[] = "$ccc->firstname $ccc->lastname";
                }
                $d[$i]['name'] = implode(",", $fullname);
                $d[$i]['msisdn'] = $msisdn;
                $i++;
            }
            echo json_encode($d); exit();
        }
        // $this->Data['contacts'] = $this->Contact->all();
        $this->Data['form']['contacts_list'] = dropdown_list($this->Member->dropdown_list('id, CONCAT(firstname, " ", lastname) AS fullname, msisdn')->result_array(), ['id', 'fullname'], 'No Contacts');
        $this->Data['form']['contacts_json'] = json_encode($this->Member->dropdown_list('id, CONCAT(firstname, " ", lastname) AS fullname, msisdn')->result_array());

        $this->Data['form']['groups_json'] = json_encode($this->Group->dropdown_list('groups_id, groups_name')->result_array());

        $this->load->view('layouts/main', $this->Data);
    }

    public function groups()
    {
        echo json_encode($this->Group->dropdown_list('groups_id AS msisdn, groups_name AS name')->result_array()); exit();
    }

    public function bulk_send()
    {
        if (is_array($this->input->post('msisdn'))) {
            $body = $this->input->post('body');
            $msisdns = $this->input->post('msisdn');
            if ( array_key_exists('members', $msisdns) ) {
                foreach ($msisdns['members'] as $msisdn) {

                    $message = array(
                        'message' => $body,
                        'msisdn' => $msisdn,
                        'by' => $this->user_id,
                    );
                    $message_id = $this->Message->insert( $message );
                    $members = $this->Member->find_member_via_msisdn($msisdn);

                    $outbox_id = null;
                    if (null != $members) {
                        foreach ($members as $member) {
                            $outbox = array(
                                'message_id' => $message_id,
                                'msisdn' => $msisdn,
                                'status' => 'pending',
                                'member_id' => $member->id,
                                'smsc' => 'auto',
                                'created_by' => $this->user_id,
                            );
                            $outbox_id = $this->Outbox->insert( $outbox );
                        }
                    } else {
                        $outbox = array(
                            'message_id' => $message_id,
                            'msisdn' => $msisdn,
                            'status' => 'pending',
                            'member_id' => NULL,
                            'smsc' => 'auto',
                            'created_by' => $this->user_id,
                        );
                        $outbox_id = $this->Outbox->insert( $outbox );
                    }

                    # This is the Kannel SHIT
                    # This sends the shit of the messagfe to the kannel server
                    $this->Message->send($outbox_id, $msisdn, 'auto', $body);

                } // endforeach
            }
            # Groups
            if (array_key_exists('groups', $msisdns)) {
                $group_members = [];
                foreach ($msisdns['groups'] as $group_id) {
                    $group_members = $this->GroupMember->lookup('group_id', $group_id)->result_array();
                    foreach ($group_members as $member) {
                        $member = $this->Member->find($member['member_id']);
                        $message = array(
                            'message' => $body,
                            'msisdn' => $member->msisdn,
                            'by' => $this->user_id,
                        );
                        $message_id = $this->Message->insert( $message );

                        $outbox = array(
                            'message_id' => $message_id,
                            'msisdn' => $member->msisdn,
                            'status' => 'pending',
                            'member_id' => $member->id,
                            'smsc' => 'auto',
                            'created_by' => $this->user_id,
                        );
                        $outbox_id = $this->Outbox->insert( $outbox );

                        # This is the Kannel SHIT
                        # This sends the shit of the messagfe to the kannel server
                        $this->Message->send($outbox_id, $msisdn, 'auto', $body);
                    }
                }
            }
            $data = array(
                'type' => 'success',
                'message' => "Message successfully sent",
                'msisdns' => $msisdns,
            );
            echo json_encode($data); exit();
        } else {
            $this->send();
        }
    }

    public function send()
    {
        $body = $this->input->post('body');
        $msisdn = $this->input->post('msisdn');

        $message = array(
            'message' => $body,
            'msisdn' => $msisdn,
            'by' => $this->user_id,
        );
        $message_id = $this->Message->insert( $message );

        $members = $this->Member->find_member_via_msisdn($msisdn);
        // echo json_encode($members); exit();

        $outbox_id = null;
        if (null != $members) {
            foreach ($members as $member) {
                $outbox = array(
                    'message_id' => $message_id,
                    'msisdn' => $msisdn,
                    'status' => 'pending',
                    'member_id' => $member->id,
                    'smsc' => 'auto',
                    'created_by' => $this->user_id,
                );
                $outbox_id = $this->Outbox->insert( $outbox );
            }
        } else {
            $outbox = array(
                'message_id' => $message_id,
                'msisdn' => $msisdn,
                'status' => 'pending',
                'member_id' => NULL,
                'smsc' => 'auto',
                'created_by' => $this->user_id,
            );
            $outbox_id = $this->Outbox->insert( $outbox );
        }

        # This is the Kannel SHIT
        # This sends the shit of the messagfe to the kannel server
        $this->Message->send($outbox_id, $msisdn, 'auto', $body);

        $data = array(
            'type' => 'success',
            'body' => $body,
            'date' => date('m/d/Y \a\t h:ia'),
            'msisdn' => $msisdn,
        );
        echo json_encode($data); exit();
    }

    public function outbox()
    {
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/outbox.js').'"></script>';
        $this->Data['trash']['count'] = $this->Outbox->get_all(0, 0, null, true)->num_rows();
        $this->load->view('layouts/main', $this->Data);
    }

    public function listing()
    {
        /**
         * AJAX List of Data
         * Here we load the list of data in a table
         */
        if ( $this->input->is_ajax_request() ) {
            $bootgrid_arr = [];
            $current      = $this->input->post('current');
            $limit        = $this->input->post('rowCount') == -1 ? 0 : $this->input->post('rowCount');
            $page         = $current !== null ? $current : 1;
            $start_from   = ($page-1) * $limit;
            $sort         = null != $this->input->post('sort') ? $this->input->post('sort') : null;
            $wildcard     = null != $this->input->post('searchPhrase') ? $this->input->post('searchPhrase') : null;
            $removed_only = null !== $this->input->post('removedOnly') ? $this->input->post('removedOnly') : false;
            $total        = $this->Outbox->get_all(0, 0, null, $removed_only)->num_rows();

            if( null != $wildcard ) {
                $outboxs = $this->Outbox->like($wildcard, $start_from, $limit, $sort, $removed_only)->result_array();
                $total   = $this->Outbox->like($wildcard, 0, 0, null, $removed_only)->num_rows();
            } else {
                $outboxs = $this->Outbox->get_all($start_from, $limit, $sort, $removed_only)->result_array();
            }

            foreach ($outboxs as $key => $outbox) {

                $bootgrid_arr[] = array(
                    'count_id'           => $key + 1 + $start_from,
                    'id'        => $outbox['id'],
                    'message' => $this->Message->find($outbox['message_id'])->message,
                    'msisdn' => $outbox['msisdn'],
                    'smsc' => $outbox['smsc'],
                    'status' => $outbox['status'],
                );
            }

            $data = array(
                "current"       => intval($current),
                "rowCount"      => $limit,
                "searchPhrase"  => $wildcard,
                "total"         => intval( $total ),
                "rows"          => $bootgrid_arr,
                "trash"         => array(
                    "count" => $this->Outbox->get_all(0, 0, null, true)->num_rows(),
                )
                // "debug" => $outbox['type'],
            );

            echo json_encode( $data );
            exit();
        }
    }

    public function scheduler()
    {
        $msisdn = $this->input->post('msisdn');
        $body = $this->input->post('body');
        $date = str_replace('/', '-', $this->input->post('send_at_date'));
        $time = $this->input->post('send_at_time');
        $datetime = date("Y-m-d H:i:s", strtotime($date . " " . $time));

        if (!$this->Scheduler->validate(true)) {
            $data = array(
                "title" => "Error",
                'message'=>$this->form_validation->toArray(),
                'type'=>'danger',
            );
            echo json_encode($data); exit();
        }

        // echo "<pre>";
        //     var_dump( $datetime ); die();
        // echo "</pre>";

        if( $msisdn && array_key_exists("members", $msisdn) ) {
            foreach ($msisdn["members"] as $number) {
                $data = array(
                    'message' => $body,
                    'member_ids' => $number,
                    'group_ids' => "",
                    "smsc" => $this->Message->get_network($number)->network ? $this->Message->get_network($number)->network : "auto",
                    "created_by" => $this->user_id,
                    "status" => "pending",
                    "interval" => "",
                    "send_at" => $datetime,
                );
                $this->Scheduler->insert($data);
            }
        }
        if( $msisdn && array_key_exists("groups", $msisdn) ) {
            foreach ($msisdn["groups"] as $group_id) {
                $group_members = $this->GroupMember->lookup('group_id', $group_id)->result_array();
                foreach ($group_members as $member) {
                    $member = $this->Member->find($member['member_id']);
                    $data = array(
                        'message' => $body,
                        'member_ids' => $member->msisdn,
                        'group_ids' => $group_id,
                        "smsc" => count($this->Message->get_network($member->msisdn)) > 0 ? $this->Message->get_network($member->msisdn)->network : "auto",
                        "created_by" => $this->user_id,
                        "status" => "pending",
                        "interval" => "",
                        "send_at" => date("Y-m-d H:i:s", strtotime($datetime)),
                    );
                    $this->Scheduler->insert($data);
                }

            }
        }
        if ($this->input->is_ajax_request()) {
            $data = array(
                'title' => 'Success',
                'type' => 'success',
                'message' => 'Message successfully scheduled',
            );
            echo json_encode($data); exit();
        }
    }

}