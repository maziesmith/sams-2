<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactsController extends CI_Controller {

    private $Data = array();
    private $hidden;

    public function __construct()
    {
        parent::__construct();
        $this->hidden = rand();
        $this->load->model('Contact', '', TRUE);
        $this->load->model('Group', '', TRUE);

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

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/contacts.js').'"></script>';
    }
    /**
     * Index Page for this controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->Data['contacts'] = $this->Contact->all();
        $this->Data['form']['groups_list'] = dropdown_list($this->Group->dropdown_list('groups_id, groups_name')->result_array(), ['groups_id', 'groups_name'], 'No Group');
        $this->load->view('layouts/main', $this->Data);
    }

    public function listing()
    {
        /**
         * AJAX List of Data
         * Here we load the list of data in a table
         */
        if( $this->input->is_ajax_request() )
        {
            $bootgrid_arr = [];
            $current      = $this->input->post('current');
            $limit        = $this->input->post('rowCount') == -1 ? 0 : $this->input->post('rowCount');
            $page         = $current !== null ? $current : 1;
            $start_from   = ($page-1) * $limit;
            $sort         = null != $this->input->post('sort') ? $this->input->post('sort') : null;
            $wildcard     = null != $this->input->post('searchPhrase') ? $this->input->post('searchPhrase') : null;
            $total        = $this->Contact->get_all()->num_rows();

            if( null != $wildcard )
            {
                $contacts = $this->Contact->like($wildcard, $start_from, $limit, $sort)->result_array();
                $total    = $this->Contact->like($wildcard)->num_rows();
            }
            else
            {
                $contacts = $this->Contact->get_all($start_from, $limit, $sort)->result_array();
            }

            foreach ($contacts as $key => $contact) {

                if( null !== $contact['contacts_group'] ) $group = $this->Group->find( $contact['contacts_group'] );

                $bootgrid_arr[] = array(
                    'count_id'           => $key + 1 + $start_from,
                    'contacts_id'        => $contact['contacts_id'],
                    'contacts_firstname' => arraytostring([$contact['contacts_firstname'], $contact['contacts_middlename'] ? substr($contact['contacts_middlename'], 0,1) . '.' : '', $contact['contacts_lastname']], ' '),
                    'contacts_level'     => $contact['contacts_level'],
                    'contacts_type'      => $contact['contacts_type'],
                    'contacts_address'   => arraytostring([$contact['contacts_blockno'], $contact['contacts_street'], $contact['contacts_brgy'], $contact['contacts_city'], $contact['contacts_zip']]),
                    'contacts_telephone' => $contact['contacts_telephone'],
                    'contacts_mobile'    => $contact['contacts_mobile'],
                    'contacts_email'     => $contact['contacts_email'],
                    'contacts_group'     => isset($group->groups_name) ? $group->groups_name : '',
                    'groups_id'          => isset($group->groups_id) ? $group->groups_id : '',
                );
            }
            $data = array(
                "current"       => intval($current),
                "rowCount"      => $limit,
                "searchPhrase"  => $wildcard,
                "total"         => intval( $total ),
                "rows"          => $bootgrid_arr,
            );
            echo json_encode( $data );
            exit();
        }
    }

    public function add()
    {
        if( $this->input->is_ajax_request() )
        {
            /*
            | --------------------------------------
            | # Validation
            | --------------------------------------
            */
            if( $this->Contact->validate(true) )
            {
                /*
                | --------------------------------------
                | # Save
                | --------------------------------------
                */
                $contact = array(
                    'contacts_firstname'    => $this->input->post('contacts_firstname'),
                    'contacts_middlename'   => $this->input->post('contacts_middlename'),
                    'contacts_lastname'     => $this->input->post('contacts_lastname'),
                    'contacts_level'        => $this->input->post('contacts_level'),
                    'contacts_type'         => $this->input->post('contacts_type'),
                    'contacts_blockno'      => $this->input->post('contacts_blockno'),
                    'contacts_street'       => $this->input->post('contacts_street'),
                    'contacts_brgy'         => $this->input->post('contacts_brgy'),
                    'contacts_city'         => $this->input->post('contacts_city'),
                    'contacts_zip'          => $this->input->post('contacts_zip'),
                    'contacts_telephone'    => $this->input->post('contacts_telephone'),
                    'contacts_mobile'       => $this->input->post('contacts_mobile'),
                    'contacts_email'        => $this->input->post('contacts_email'),
                    'contacts_group'        => $this->input->post('contacts_group'),
                );
                $this->Contact->insert($contact);

                /*
                | ----------------------------------------
                | # Response
                | ----------------------------------------
                */
                $data = array(
                    'message' => 'Contact was successfully added',
                    'type'    => 'success'
                );
                echo json_encode( $data ); exit();
            }
            else
            {
                echo json_encode(['message'=>$this->form_validation->toArray(), 'type'=>'danger']); exit();
            }

        }
        else
        {
            redirect( base_url('contacts') );
        }
    }

    /**
     * Retrieve the resource for editing
     * @param  int $id
     * @return AJAX
     */
    public function edit($id)
    {
        if( $this->input->is_ajax_request() )
        {
            $contact = $this->Contact->find( $id );
            echo json_encode( $contact );
            exit();
        }
    }

    public function update($id)
    {
        if( $this->input->is_ajax_request() )
        {
            /*
            | --------------------------------------
            | # Validation
            | --------------------------------------
            */
            if( null != $this->input->post('updating') )
            {
                $contact_data = array(
                    $this->input->post('updating') => $this->input->post('value'),
                );
                $this->Contact->update($id, $contact_data);
                $data = array(
                    'message' => 'Contact was successfully updated',
                    'type' => 'success'
                );
                echo json_encode( $data );
                exit();
            }
            if( $this->Contact->validate(false, $id, $this->input->post('contacts_email')) )
            {
                /*
                | --------------------------------------
                | # Update
                | --------------------------------------
                */
                $contact = array(
                    'contacts_firstname' => $this->input->post('contacts_firstname'),
                    'contacts_middlename' => $this->input->post('contacts_middlename'),
                    'contacts_lastname' => $this->input->post('contacts_lastname'),
                    'contacts_level' => $this->input->post('contacts_level'),
                    'contacts_type' => $this->input->post('contacts_type'),
                    'contacts_blockno' => $this->input->post('contacts_blockno'),
                    'contacts_street' => $this->input->post('contacts_street'),
                    'contacts_brgy' => $this->input->post('contacts_brgy'),
                    'contacts_city' => $this->input->post('contacts_city'),
                    'contacts_zip' => $this->input->post('contacts_zip'),
                    'contacts_telephone' => $this->input->post('contacts_telephone'),
                    'contacts_mobile' => $this->input->post('contacts_mobile'),
                    'contacts_email' => $this->input->post('contacts_email'),
                    'contacts_group' => $this->input->post('contacts_group'),
                );
                $this->Contact->update($id, $contact);

                $data = array(
                    'message' => 'Contact was successfully updated',
                    'type' => 'success'
                );
                echo json_encode( $data );
                exit();
            }
            else
            {
                echo json_encode(['message'=>$this->form_validation->toArray(), 'type'=>'error']); exit();
            }
        }
    }

    public function delete($id=null)
    {
        if( $this->input->is_ajax_request() )
        {
            /**
             * If $id is null
             * then it's a POST request not DELETE.
             * POST will delete many records
             */
            if( null == $id || !isset($id) )
            {
                $ids = $this->input->post('contacts_id');
                if( $this->Contact->delete($ids) )
                {
                    $data['message'] = 'Contacts were successfully deleted';
                    $data['type'] = 'success';
                }
                else
                {
                    $data['message'] = 'An unhandled error occured. Record was not deleted';
                    $data['type'] = 'error';
                }
                echo json_encode( $data );
                exit();
            }

            $data = array();
            if( $this->Contact->delete($id) )
            {
                $data['message'] = 'Contact was successfully deleted';
                $data['type'] = 'success';
            }
            else
            {
                $data['message'] = 'An unhandled error occured. Record was not deleted';
                $data['type'] = 'error';
            }
            echo json_encode( $data );
            exit();
        }
    }

    /**
     * Import Page for this controller
     * @return [type] [description]
     */
    public function import()
    {

        if( $this->input->is_ajax_request() )
        {
            $this->load->library('upload', ['upload_path'=>'./uploads/', 'allowed_types'=>'csv']);

            if ( !$this->upload->do_upload('file'))
            {
                $data = array('message' => $this->upload->display_errors(), 'type'=>'error');
            }
            else
            {
                # Import
                $full_path = $this->upload->data()['full_path'];
                if( $this->Contact->import( $this->upload->data()['full_path'] ) )
                {
                    # Delete uploaded file
                    clean_upload_folder( $full_path );

                    # Response
                    $data = array('message' => 'Contacts successfully imported.', 'type'=>'success');

                } else {
                    $data = array('message' => 'Something went wrong importing the file', 'type'=>'error');
                }


            }
            echo json_encode( $data );
            exit();

        }

        $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/dropzone/dropzone.css').'"></link>';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/dropzone/dropzone.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/contactsImport.js').'"></script>';

        $this->load->view('layouts/main', $this->Data);

    }

    /**
     * Export Page for this controller
     * @return [type] [description]
     */
    public function export()
    {
        if( null != $this->input->post('export_start') )
        {
            # Load the DB Utility
            $this->load->dbutil();

            $export = $this->Contact->export($this->input->post('export_start'), $this->input->post('export_end'));

            if( empty($export->result()) )
            {
                $data = array('message' => 'export is empty', 'type'=>'danger');
                echo json_encode( $data );
                exit();
            }

            switch ( $this->input->post('export_format') ) {
                case 'CSV':
                    $CSV =  $this->dbutil->csv_from_result( $export );
                    $csv_name = 'Contacts_' . date('YmdHi') . '.csv';
                    force_download($csv_name, $CSV);
                    break;

                case 'SQL':
                    break;

                case 'PDF':
                    break;

                default:
                    break;
            }



            if( $this->input->is_ajax_request() )
            {
                $data = array('message' => 'exports/'.$csv_name, 'type'=>'success');
                echo json_encode( $data );
                exit();
            }
        }

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/contactsExport.js').'"></script>';
        $this->load->view('layouts/main', $this->Data);
    }

    public function download()
    {
        echo "yeahdasd";
    }
}