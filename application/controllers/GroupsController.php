<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupsController extends CI_Controller {

    private $Data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Group', '', TRUE);
        $this->load->model('Contact', '', TRUE);

        $this->Data['Headers'] = get_page_headers();
        $this->Data['Headers']->CSS = '<link rel="stylesheet" href="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.css').'">';
        // $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/chosen/chosen.min.css').'">';
        $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css').'">';

        $this->Data['Headers']->JS  = '<script src="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.js').'"></script>';
        // $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/chosen/chosen.jquery.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/moment/min/moment.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/bootstrap-growl/bootstrap-growl.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/autosize/dist/autosize.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/jquery.validate/dist/jquery.validate.min.js').'"></script>';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/groups.js').'"></script>';
    }
    /**
     * Index Page for this controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->Data['groups'] = $this->Group->all();
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
            $current      = null != $this->input->post('current') ? $this->input->post('current') : 1;
            $limit        = $this->input->post('rowCount') == -1 ? 0 : $this->input->post('rowCount');
            $page         = $current !== null ? $current : 1;
            $start_from   = ($page-1) * $limit;
            $sort         = null != $this->input->post('sort') ? $this->input->post('sort') : null;
            $wildcard     = null != $this->input->post('searchPhrase') ? $this->input->post('searchPhrase') : null;
            $total        = $this->Group->get_all()->num_rows();

            if( null != $wildcard )
            {
                $groups = $this->Group->like($wildcard, $start_from, $limit, $sort)->result_array();
                $total  = $this->Group->like($wildcard)->num_rows();
            }
            else
            {
                $groups = $this->Group->get_all($start_from, $limit, $sort)->result_array();
            }

            foreach ($groups as $key => $group) {
                $bootgrid_arr[] = array(
                    'count_id'           => $key + 1 + $start_from,
                    'groups_id'          => $group['groups_id'],
                    'groups_name'        => $group['groups_name'],
                    'groups_description' => $group['groups_description'],
                    'groups_code'        => $group['groups_code'],
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
            | -------------------------------------
            | # Debug
            | -------------------------------------
            */
            // $data['message'] = $this->input->post();
            // $data['type'] = 'success';
            // echo json_encode($data); exit();
            /*
            | --------------------------------------
            | # Validation
            | --------------------------------------
            */
            if( $this->Group->validate(true) )
            {
                /*
                | --------------------------------------
                | # Save
                | --------------------------------------
                */
                $group = array(
                    'groups_name'    => $this->input->post('groups_name'),
                    'groups_description'   => $this->input->post('groups_description'),
                    'groups_code'     => $this->input->post('groups_code')
                );
                $group_id = $this->Group->insert($group);
                /*
                | --------------------------------------
                | # Save the Contacts Groups
                | --------------------------------------
                */
                if( null !== $this->input->post('groups_contacts') && $contacts_ids = $this->input->post('groups_contacts') )
                {
                    $groups_contacts = explode(",", $contacts_ids);

                    foreach ($groups_contacts as $contact_id) {
                        $this->Contact->update($contact_id, array('contacts_group'=> $group_id));
                    }
                }

                /*
                | ----------------------------------------
                | # Response
                | ----------------------------------------
                */
                $data = array(
                    'message' => 'Group was successfully added',
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
            redirect( base_url('groups') );
        }
    }

    /**
     * Retrieve the resource for editing
     * @param  int $id
     * @return JSON
     */
    public function edit($id)
    {
        if( $this->input->is_ajax_request() )
        {
            $group = $this->Group->find( $id );
            echo json_encode( $group );
            exit();
        }
    }

    public function update($id)
    {
        if( $this->input->is_ajax_request() )
        {
            /*
            | -------------------------------------
            | # Debug
            | -------------------------------------
            */
            // $data['message'] = $this->input->post('groups_contacts');
            // $data['type'] = 'success';
            // echo json_encode($data); exit();
            /*
            | --------------------------------------
            | # Validation
            | --------------------------------------
            */
            if( $this->Group->validate(false, $id, $this->input->post('groups_code')) )
            {
                /*
                | --------------------------------------
                | # Update
                | --------------------------------------
                */
                $group = array(
                    'groups_name'    => $this->input->post('groups_name'),
                    'groups_description'   => $this->input->post('groups_description'),
                    'groups_code'     => $this->input->post('groups_code')
                );
                $this->Group->update($id, $group);
                /*
                | --------------------------------------
                | # Update the Contacts Groups
                | --------------------------------------
                */
                if( null !== $this->input->post('groups_contacts') && $contacts_ids = $this->input->post('groups_contacts') )
                {
                    $groups_contacts = explode(",", $contacts_ids);

                    foreach ($groups_contacts as $contact_id) {
                        $this->Contact->update($contact_id, array('contacts_group'=> $id));
                    }
                }

                $data = array(
                    'message' => 'Group was successfully updated',
                    'type' => 'success'
                );
                echo json_encode( $data );
                exit();
            }
            else
            {
                echo json_encode(['message'=>$this->form_validation->toArray(), 'type'=>'danger']); exit();
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
                $ids = $this->input->post('groups_ids');
                if( $this->Group->delete($ids) )
                {
                    $data['message'] = 'Groups were successfully deleted';
                    $data['type'] = 'success';

                    /*
                    | --------------------------------
                    | # Update Many Contacts
                    | --------------------------------
                    | All Contacts with this Groups ID
                    */
                    foreach ($ids as $contacts_id) {
                        $contacts = $this->Contact->where(['contacts_group'=>$contacts_id])->get()->result_array();
                        foreach ($contacts as $contact) {
                            $this->Contact->update($contact['contacts_id'], ['contacts_group'=>'']);
                        }
                    }
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
            if( $this->Group->delete($id) )
            {
                $data['message'] = 'Group was successfully deleted';
                $data['type'] = 'success';

                /*
                | --------------------------------
                | # Update Contacts
                | --------------------------------
                | All Contacts with this Groups ID
                */
                $contacts = $this->Contact->where(['contacts_group'=>$id])->get()->result_array();
                foreach ($contacts as $contact) {
                    $this->Contact->update($contact['contacts_id'], ['contacts_group'=>'']);
                }


            }
            else
            {
                $data['message'] = 'An unhandled error occured. Record was not deleted';
                $data['type'] = 'danger';
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
        $this->load->view('layouts/main', $this->Data);
    }

    /**
     * Export Page for this controller
     * @return [type] [description]
     */
    public function export()
    {
        $this->load->view('layouts/main', $this->Data);
    }
}