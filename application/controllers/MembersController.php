<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MembersController extends CI_Controller {

    private $Data = array();
    private $user_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->validated();

        $this->load->model('Member', '', TRUE);
        $this->load->model('Group', '', TRUE);
        $this->load->model('GroupMember', '', TRUE);
        $this->load->model('Level', '', TRUE);
        $this->load->model('Type', '', TRUE);

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
        if( !$this->Auth->can(['members/listing']) ) {
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
        }

        $this->Data['members'] = $this->Member->all();
        $this->Data['form']['groups_list'] = dropdown_list($this->Group->dropdown_list('groups_id, groups_name')->result_array(), ['groups_id', 'groups_name'], '', false);
        $this->Data['form']['levels_list'] = dropdown_list($this->Level->dropdown_list('levels_id, levels_name')->result_array(), ['levels_id', 'levels_name'], '', false);
        $this->Data['form']['types_list']  = dropdown_list($this->Type->dropdown_list('types_id, types_name')->result_array(), ['types_id', 'types_name'], '', false);
        $this->Data['trash']['count'] = $this->Member->get_all(0, 0, null, true)->num_rows();
        $this->load->view('layouts/main', $this->Data);
    }

    public function listing()
    {
        /**
         * AJAX List of Data
         * Here we load the list of data in a table
         */
        if( $this->input->is_ajax_request() ) {
            $bootgrid_arr = [];
            $current      = $this->input->post('current');
            $limit        = $this->input->post('rowCount') == -1 ? 0 : $this->input->post('rowCount');
            $page         = $current !== null ? $current : 1;
            $start_from   = ($page-1) * $limit;
            $sort         = null != $this->input->post('sort') ? $this->input->post('sort') : null;
            $wildcard     = null != $this->input->post('searchPhrase') ? $this->input->post('searchPhrase') : null;
            $removed_only = null !== $this->input->post('removedOnly') ? $this->input->post('removedOnly') : false;
            $total        = $this->Member->get_all(0, 0, null, $removed_only)->num_rows();

            if( null != $wildcard ) {
                $members = $this->Member->like($wildcard, $start_from, $limit, $sort, $removed_only)->result_array();
                $total   = $this->Member->like($wildcard, 0, 0, null, $removed_only)->num_rows();
            } else {
                $members = $this->Member->get_all($start_from, $limit, $sort, $removed_only)->result_array();
            }

            foreach ($members as $key => $member) {
                $group = null;
                if( null != $member['groups'] ) $group = $this->Group->find( explodetoarray($member['groups']) );
                $groups_name_arr = [];
                $groups_id_arr = [];
                if( is_array( $group ) ) {
                    foreach ($group as $group_single) {
                        $groups_name_arr[] = $group_single->groups_name;
                        $groups_id_arr[] = $group_single->groups_id;
                    }
                }

                if( null !== $member['level'] ) $level = $this->Level->find( explodetoarray($member['level']) );
                $levels_name_arr = [];
                $levels_id_arr = [];
                if( is_array( $level ) )
                {
                    foreach ($level as $level_single) {
                        $levels_name_arr[] = $level_single->levels_name;
                        $levels_id_arr[] = $level_single->levels_id;
                    }
                }

                if( null !== $member['type'] ) $type = $this->Type->find( explodetoarray($member['type']) );
                $types_name_arr = [];
                $types_id_arr = [];
                if( is_array( $type ) )
                {
                    foreach ($type as $type_single) {
                        $types_name_arr[] = $type_single->types_name;
                        $types_id_arr[] = $type_single->types_id;
                    }
                }

                $bootgrid_arr[] = array(
                    'count_id'           => $key + 1 + $start_from,
                    'id'        => $member['id'],
		    'stud_no'   => $member['stud_no'],
                    'fullname' => arraytostring([$member['firstname'], $member['middlename'] ? substr($member['middlename'], 0,1) . '.' : '', $member['lastname']], ' '),
                    'level'     => $levels_name_arr ? arraytostring($levels_name_arr, ", ") : '',
                    'levels_id'          => $levels_id_arr ? $levels_id_arr : '',
                    'type'      => $types_name_arr ? arraytostring($types_name_arr, ", ") : '',
                    'types_id'          => $types_id_arr ? $types_id_arr : '',
                    'address'   => arraytostring([$member['address_blockno'], $member['address_street'], $member['address_brgy'], $member['address_city'], $member['address_zip']]),
                    'telephone' => $member['telephone'],
                    'msisdn'    => $member['msisdn'],
                    'email'     => $member['email'],
                    'groups'    => $groups_name_arr ? arraytostring($groups_name_arr, ", ") : '', //isset($group->groups_name) ? $group->groups_name : '',
                    'groups_id'          => $groups_id_arr ? $groups_id_arr : '',//isset($group->groups_id) ? $group->groups_id : '',
                );
            }

            $data = array(
                "current"       => intval($current),
                "rowCount"      => $limit,
                "searchPhrase"  => $wildcard,
                "total"         => intval( $total ),
                "rows"          => $bootgrid_arr,
                "trash"         => array(
                    "count" => $this->Member->get_all(0, 0, null, true)->num_rows(),
                )
                // "debug" => $member['type'],
            );

            echo json_encode( $data );
            exit();
        }
    }

    public function check($can=null)
    {
        $can = (null == $can) ? $this->input->post('can') : $can;
        if( !$this->Auth->can($can) ) {
            if ($this->input->is_ajax_request()) {
                echo json_encode( [
                    'title' => 'Access Denied',
                    'message' => "You don't have permission to Add to this resource",
                    'type' => 'error',
                ] ); exit();
            } else {
                $this->Data['Headers']->Page = 'errors/403';
                $this->load->view('layouts/errors', $this->Data);
                return false;
            }
        }
    }

    public function add()
    {
        if( !$this->Auth->can(['members/add']) ) {
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
            echo json_encode( [
                'title' => 'Access Denied',
                'message' => "You don't have permission to Remove this resource",
                'type' => 'error',
            ] ); exit();
        }
        # Validation
        if( $this->Member->validate(true) ) {

            # Save
            $member = array(
                'stud_no' => $this->input->post('stud_no'),
                'firstname'    => $this->input->post('firstname'),
                'middlename'   => $this->input->post('middlename'),
                'lastname'     => $this->input->post('lastname'),
                'level'        => arraytoimplode($this->input->post('level')),
                'type'         => arraytoimplode($this->input->post('type')),
                'address_blockno'      => $this->input->post('address_blockno'),
                'address_street'       => $this->input->post('address_street'),
                'address_brgy'         => $this->input->post('address_brgy'),
                'address_city'         => $this->input->post('address_city'),
                'address_zip'          => $this->input->post('address_zip'),
                'telephone'    => $this->input->post('telephone'),
                'msisdn'       => $this->input->post('msisdn'),
                'email'        => $this->input->post('email'),
                'groups'        => arraytoimplode($this->input->post('groups')),
                'created_by'            => $this->user_id,
            );

            $this->Member->insert($member);
            $member_id = $this->db->insert_id();

            # Response
            $data = array(
                'message' => 'Member was successfully added',
                'type'    => 'success',
                // 'debug'   => $this->input->post('groups'),
            );

            # Save the Groups id in another table
            if( null !== $this->input->post('groups') ) {
                $groups = $this->input->post('groups');
                $data['debug'] = $groups;
                foreach ($groups as $group_id) {
                    $group_member = array(
                        'group_id' => $group_id,
                        'member_id' => $member_id,
                    );
                    $this->GroupMember->insert($group_member);
                }
            }

        } else {

            # Negative Response
            $data = array(
                'message'=>$this->form_validation->toArray(),
                'type'=>'danger',
            );
        }

        if( $this->input->is_ajax_request() ) {
            echo json_encode( $data ); exit();
        } else {
            $this->session->set_flashdata('message', $data);
            redirect( base_url('members') );
        }
    }

    /**
     * Retrieve the resource for editing
     * @param  int $id
     * @return AJAX
     */
    public function edit($id)
    {
        if( !$this->Auth->can() ) {
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
            echo json_encode( [
                'title' => 'Access Denied',
                'message' => "You don't have permission to Edit this resource",
                'type' => 'error',
            ] ); exit();
        }

        $member = $this->Member->find( $id );
        if( $this->input->is_ajax_request() ) {
            echo json_encode( $member ); exit();
        } else {
            $this->Data['member'] = $member;
            $this->load->view('layouts/main', $this->Data);
        }
    }

    public function update($id)
    {
        # Validation
        if( null != $this->input->post('updating_groups') ) {
            $member = $this->Member->find($id);
            $member_groups = [];
            if( !empty($member->groups) ) $member_groups = explode(",", $member->groups);

            # If we're Adding a Group
            if( "add" == $this->input->post('action') ) {
                # Check if the value is already in the resource,
                # add to array if not.
                if( !in_array($this->input->post('value'), $member_groups) ) {
                    $member_groups[] = $this->input->post('value');
                } else {
                    $data = array(
                        'message' => 'Member is already in this groups',
                        'type' => 'danger',
                        // 'debug' => $member_groups,
                        // "input" => $this->input->post('value'),
                    );
                    echo json_encode( $data );
                    exit();
                }
            }

            # If we're Removing a Group
            if( "remove" == $this->input->post('action') ) {
                # Remove the value if in the resource
                if( in_array($this->input->post('value'), $member_groups) ) {
                    $index = array_search($this->input->post('value'), $member_groups);
                    unset( $member_groups[$index] );
                } else {
                    $data = array(
                        'message' => 'Member is already not in this groups',
                        'type' => 'danger',
                        // 'debug' => $member_groups,
                        // "input" => $this->input->post('value'),
                    );
                    echo json_encode( $data );
                    exit();
                }
            }

            # Prepare data
            $member_groups = arraytoimplode($member_groups);   // stringify the array E.g. `array("1", "2")` will be `"1,2"`
            $member_data = array(
                $this->input->post('updating_groups') => $member_groups,
            );

            # Update
            $this->Member->update($id, $member_data);

            # Update the group_members
            $group_ids = explodetoarray($member_groups);
            $members_groups = $this->GroupMember->lookup('member_id', $id)->result_array();
            $this->GroupMember->delete_member($id);
            foreach ($group_ids as $group_id) {
                $this->GroupMember->insert( array('group_id' => $group_id, 'member_id' => $id ) );
            }

            # Response
            $data = array(
                'message' => 'Member was successfully updated',
                'type' => 'success',
                // 'debug' => $member_groups,
                // "input" => $this->input->post('value'),
            );
            echo json_encode( $data );
            exit();

        }

        if( null != $this->input->post('updating_level') ) {
            $member = $this->Member->find($id);
            $member_level = [];
            if( !empty($member->level) )$member_level = explode(",", $member->level);

            # If we're Adding a Group
            if( "add" == $this->input->post('action') ) {
                # Check if the value is already in the resource,
                # add to array if not.
                if( !in_array($this->input->post('value'), $member_level) ) {
                    $member_level[] = $this->input->post('value');
                } else {
                    $data = array(
                        'message' => 'Member is already in this level',
                        'type' => 'danger',
                        // 'debug' => $member_level,
                        // "input" => $this->input->post('value'),
                    );
                    echo json_encode( $data );
                    exit();
                }
            }

            # If we're Removing a Group
            if( "remove" == $this->input->post('action') ) {
                # Remove the value if in the resource
                if( in_array($this->input->post('value'), $member_level) ) {
                    $index = array_search($this->input->post('value'), $member_level);
                    unset( $member_level[$index] );
                } else {
                    $data = array(
                        'message' => 'Member is already not in this level',
                        'type' => 'danger',
                        // 'debug' => $member_level,
                        // "input" => $this->input->post('value'),
                    );
                    echo json_encode( $data );
                    exit();
                }
            }

            # Prepare data
            $member_level = implode(",", $member_level);   // stringify the array E.g. `array("1", "2")` will be `"1,2"`
            $member_data = array(
                $this->input->post('updating_level') => $member_level,
            );

             # Update
            $this->Member->update($id, $member_data);

            # Response
            $data = array(
                'message' => 'Member was successfully updated',
                'type' => 'success',
                // 'debug' => $member_level,
                // "input" => $this->input->post('value'),
            );
            echo json_encode( $data );
            exit();

        }

        if( null != $this->input->post('updating_type') ) {
            $member = $this->Member->find($id);
            $member_type = [];
            if( !empty($member->type) ) $member_type = explode(",", $member->type);

            # If we're Adding a Type
            if( "add" == $this->input->post('action') ) {
                # Check if the value is already in the resource,
                # add to array if not.
                if( !in_array($this->input->post('value'), $member_type) ) {
                    $member_type[] = $this->input->post('value');
                } else {
                    $data = array(
                        'message' => 'Member is already in this type',
                        'type' => 'danger',
                        'debug' => $member_type,
                        // "input" => $this->input->post('value'),
                    );
                    echo json_encode( $data );
                    exit();
                }
            }

            # If we're Removing a Type
            if( "remove" == $this->input->post('action') ) {
                # Remove the value if in the resource
                if( in_array($this->input->post('value'), $member_type) ) {
                    $index = array_search($this->input->post('value'), $member_type);
                    unset( $member_type[$index] );
                } else {
                    $data = array(
                        'message' => 'Member is already not in this type',
                        'type' => 'danger',
                        // 'debug' => $member_type,
                        // "input" => $this->input->post('value'),
                    );
                    echo json_encode( $data );
                    exit();
                }
            }

            # Prepare data
            $member_type = implode(",", $member_type);   // stringify the array E.g. `array("1", "2")` will be `"1,2"`
            $member_data = array(
                $this->input->post('updating_type') => $member_type,
            );

             # Update
            $this->Member->update($id, $member_data);

            # Response
            $data = array(
                'message' => 'Member was successfully updated',
                'type' => 'success',
                // 'debug' => $member_type,
                // "input" => $this->input->post('value'),
            );
            echo json_encode( $data );
            exit();

        }

        if( $this->Member->validate(false, $id, $this->input->post('email')) ) {

            # Update
            $member = array(
                'stud_no' => $this->input->post('stud_no'),
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'level' => arraytoimplode( $this->input->post('level') ),
                'type' => arraytoimplode( $this->input->post('type') ),
                'address_blockno' => $this->input->post('address_blockno'),
                'address_street' => $this->input->post('address_street'),
                'address_brgy' => $this->input->post('address_brgy'),
                'address_city' => $this->input->post('address_city'),
                'address_zip' => $this->input->post('address_zip'),
                'telephone' => $this->input->post('telephone'),
                'msisdn' => $this->input->post('msisdn'),
                'email' => $this->input->post('email'),
                'groups' => arraytoimplode( $this->input->post('groups') ),
                'updated_by' => $this->user_id,
            );
            $this->Member->update($id, $member);

            # Update the group_members
            $group_ids = $this->input->post('groups');
            $members_groups = $this->GroupMember->lookup('member_id', $id)->result_array();
            $this->GroupMember->delete_member($id);
            if( null !== $group_ids ) {
                foreach ($group_ids as $group_id) {
                    $this->GroupMember->insert( array('group_id' => $group_id, 'member_id' => $id ) );
                }
            } else {
                $this->GroupMember->delete_member($id);
            }

            # Response
            $data = array(
                'message' => 'Member was successfully updated',
                'type' => 'success',
                'debug'=>$member,
            );
        } else {
            $data = array(
                'message'=>$this->form_validation->toArray(),
                'type'=>'error',
            );
        }

        if( $this->input->is_ajax_request() ) {
            echo json_encode( $data ); exit();
        } else {
            $this->session->set_flashdata('message', $data);
        }
    }

    public function trash()
    {
        if( !$this->Auth->can(['members/export']) ) {
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
            return false;
        }

        $this->Data['members'] = $this->Member->all(true);

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/membersTrash.js').'"></script>';
        $this->load->view('layouts/main', $this->Data);
    }

    public function remove($id=null)
    {
        if( !$this->Auth->can() ) {
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
            echo json_encode( [
                'title' => 'Access Denied',
                'message' => "You don't have permission to Remove this resource",
                'type' => 'error',
            ] ); exit();
        }

        $remove_many = 0;
        if( null === $id ) $remove_many = 1;
        if( null === $id ) $id = $this->input->post('id');

        if( $this->Member->remove($id) ) {
            # Also update the TABLE `groups_members`
            $this->GroupMember->delete_member($id);

            if( 1 == $remove_many ) {
                $data['member']['message'] = 'Members were successfully removed';
            } else {
                $data['member']['message'] = 'Member was successfully removed';
            }
            $data['member']['type'] = 'success';
        } else {
            $data['message'] = 'An error occured while removing the resource';
            $data['type'] = 'error';
        }

        if( $this->input->is_ajax_request() ) {
            echo json_encode( $data ); exit();
        } else {
            $this->session->set_flashdata('message', $data );
            redirect('members');
        }
    }

    public function restore($id=null)
    {
        if( null === $id ) $id = $this->input->post('id');

        if( $this->Member->restore($id) ) {
            # Also update the TABLE `group_members`
            $member = $this->Member->find($id);
            $groups = explodetoarray($member->groups);
            foreach ($groups as $group_id) {
                $this->GroupMember->insert( array(
                    'group_id' => $group_id,
                    'member_id' => $id,
                ) );
            }
            $data['message'] = 'Member was successfully restored';
            $data['type'] = 'success';
        } else {
            $data['message'] = 'An error occured while trying to restore the resource';
            $data['type'] = 'error';
        }

        if( $this->input->is_ajax_request() ) {
            echo json_encode( $data ); exit();
        } else {
            $this->session->set_flashdata('message', $data );
            redirect('members');
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
                $ids = $this->input->post('id');
                if( $this->Member->delete($ids) )
                {
                    $data['message'] = 'Members were successfully deleted';
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
            if( $this->Member->delete($id) )
            {
                $data['message'] = 'Member was successfully deleted';
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
        if( !$this->Auth->can(['members/import']) ) {
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
            return false;
        }

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
                if( $this->Member->import( $this->upload->data()['full_path'] ) )
                {
                    # Delete uploaded file
                    clean_upload_folder( $full_path );

                    # Response
                    $data = array('message' => 'Members successfully imported.', 'type'=>'success');

                    # Also import on TABLE `group_members`
                    $members = $this->Member->all();
                    foreach ($members as $member) {

                        $group_ids = explodetoarray($member->groups);
                        $members_groups = $this->GroupMember->lookup('member_id', $member->id)->result_array();
                        $this->GroupMember->delete_member($member->id);
                        foreach ($group_ids as $group_id) {
                            $this->GroupMember->insert( array('group_id' => $group_id, 'member_id' => $member->id ) );
                        }
                    }

                } else {
                    $data = array('message' => 'Something went wrong importing the file', 'type'=>'error');
                }

            }
            echo json_encode( $data );
            exit();

        }

        $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/dropzone/dropzone.css').'"></link>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/dropzone/dropzone.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/membersImport.js').'"></script>';

        $this->load->view('layouts/main', $this->Data);

    }

    /**
     * Export Page for this controller
     * @return [type] [description]
     */
    public function export()
    {
        if( !$this->Auth->can(['members/export']) ) {
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
            return false;
        }

        if( null != $this->input->post('export_start') )
        {
            $export = $this->Member->export( false, date('Y-m-d', strtotime($this->input->post('export_start'))), date('Y-m-d', strtotime($this->input->post('export_end') . ' +1 day')), $this->input->post('export_level') );
            /*
            | ---------------------------------------------
            | # Validation
            | ---------------------------------------------
            */
            $result = $this->Member->export( false, date('Y-m-d', strtotime($this->input->post('export_start'))), date('Y-m-d', strtotime($this->input->post('export_end') . ' +1 day')), $this->input->post('export_level') )->result();
            if( empty( $result ) ) {
                $this->Data['messages']['error'] = 'No Record was found in the Dates or Level specified';
            } else
            {
                # Export
                #// Load the DB Utility
                $this->load->dbutil();
                switch ( $this->input->post('export_format') ) {
                    case 'CSV':
                        $CSV =  $this->dbutil->csv_from_result( $export );
                        $csv_name = 'Members_' . date('Y-m-d-H-i') . '.export.csv';
                        force_download($csv_name, $CSV);
                        // $data = array('message' => 'Export was successful', 'type'=>'success');
                        break;

                    case 'SQL':
                        $SQL = $this->dbutil->backup(['tables'=>'{PRE}members']);
                        $sql_name = 'Members_' . date('Y-m-d-H-i') . '.export.zip';
                        force_download($sql_name, $SQL);
                        break;

                    case 'PDF':
                        die('PDF is not available on your user level');
                        break;
                    default:
                        break;
                }


                # Response
                # -- No response yet --
                $this->session->set_flashdata('message', array('type'=>'success', 'message'=>"Export completed"));
            }
        }

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/membersExport.js').'"></script>';
        $this->Data['form']['levels_list'] = dropdown_list($this->Level->dropdown_list('levels_id, levels_name')->result_array(), ['levels_id', 'levels_name'], 'All Levels', "0");
        $this->load->view('layouts/main', $this->Data);
    }
}
