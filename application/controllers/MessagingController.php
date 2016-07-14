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
        $this->Data['Headers'] = get_page_headers();

        $this->Data['Headers']->JS  = '<script src="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/bootstrap-growl/bootstrap-growl.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/moment/min/moment.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<link rel="stylesheet" href="'.base_url('assets/vendors/selectize.js/dist/css/selectize.bootstrap3.css').'">';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/selectize.js/dist/js/standalone/selectize.min.js').'"></script>';

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
        $this->load->view('layouts/main', $this->Data);
    }

    public function bulk_send()
    {
        if (is_array($this->input->post('msisdn'))) {
            $body = $this->input->post('body');
            foreach ($this->input->post('msisdn') as $number) {
                $msisdn = $number;

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
                // $this->Message->send($outbox_id, $msisdn, 'auto', $body);

                $data = array(
                    'type' => 'success',
                    'body' => $body,
                    'date' => date('m/d/Y \a\t h:ia'),
                    'msisdn' => $msisdn,
                );
                echo json_encode($data); exit();
            }
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
        // $this->Message->send($outbox_id, $msisdn, 'auto', $body);

        $data = array(
            'type' => 'success',
            'body' => $body,
            'date' => date('m/d/Y \a\t h:ia'),
            'msisdn' => $msisdn,
        );
        echo json_encode($data); exit();
    }

}