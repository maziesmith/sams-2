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
        // $this->Data['contacts'] = $this->Contact->all();
        // $this->Data['form']['groups_list'] = dropdown_list($this->Group->dropdown_list('groups_id, groups_name')->result_array(), ['groups_id', 'groups_name'], 'No Group');
        // $this->Data['form']['levels_list'] = dropdown_list($this->Level->dropdown_list('levels_id, levels_name')->result_array(), ['levels_id', 'levels_name'], 'No Level');
        // $this->Data['form']['types_list']  = dropdown_list($this->Type->dropdown_list('types_id, types_name')->result_array(), ['types_id', 'types_name'], 'No Type');
        $this->load->view('layouts/main', $this->Data);
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

}