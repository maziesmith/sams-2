<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupsController extends CI_Controller {

    private $Data = array();

    public function __construct()
    {
        parent::__construct();
        $this->validated();

        $this->load->model('Group', '', TRUE);
        $this->load->model('Member', '', TRUE);
        $this->load->model('GroupMember', '', TRUE);

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
            if( $this->Group->validate(true) ) {
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
                $this->Group->insert($group);
                $group_id = $this->db->insert_id();
                /*
                | --------------------------------------
                | # Save the Members Groups
                | --------------------------------------
                */
                if( null !== $this->input->post('groups_members') && $members_ids = $this->input->post('groups_members') )
                {
                    $groups_members = explode(",", $members_ids);
                    foreach ($groups_members as $member_id) {
                        $member = $this->Member->find($member_id);
                        $member_group = explode( ",", $member->groups);

                        # Check if the value is already in the resource,
                        # add to array if not.
                        if( !in_array($group_id, $member_group) ) {
                            $member_group[] = $group_id;
                        } else {
                            $data = array(
                                'message' => 'Member is already in this group',
                                'type' => 'danger',
                                // 'debug' => $member_group,
                                // "input" => $this->input->post('value'),
                            );
                            echo json_encode( $data );
                            exit();
                        }

                        $member_group = arraytoimplode($member_group);
                        $this->Member->update($member_id, array('groups'=> $member_group));

                    }

                    # Add data to group_members
                    foreach ($groups_members as $member_id) {
                        $this->GroupMember->insert( array(
                            'group_id' => $group_id,
                            'member_id' => $member_id,
                        ) );
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
            } else {
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
            // $data['message'] = $this->input->post('groups_members');
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
                | # Update the Members Groups
                | --------------------------------------
                */
                if( null !== $this->input->post('groups_members') && $members_ids = $this->input->post('groups_members') )
                {
                    $groups_members = explode(",", $members_ids);

                    foreach ($groups_members as $member_id) {
                        $this->Member->update($member_id, array('groups'=> $id));

                        /*
                        |---------------------------
                        | # Update the group_members
                        |---------------------------
                        */
                        $this->GroupMember->remove_member($member_id);
                        $this->GroupMember->insert( array(
                            'group_id' => $id,
                            'member_id' => $member_id,
                        ) );
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
                    | # Update Many Members
                    | --------------------------------
                    | All Members with this Groups ID
                    */
                    foreach ($ids as $members_id) {
                        $members = $this->Member->where(['groups'=>$members_id])->get()->result_array();
                        foreach ($members as $member) {
                            $this->Member->update($member['members_id'], ['groups'=>'']);
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
                | # Update Members
                | --------------------------------
                | All Members with this Groups ID
                */
                $members = $this->Member->where(['groups'=>$id])->get()->result_array();
                foreach ($members as $member) {
                    $this->Member->update($member['members_id'], ['groups'=>'']);
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