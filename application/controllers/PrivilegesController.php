<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrivilegesController extends CI_Controller {
    private $Data = array();
    private $user_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->validated();

        $this->load->model('Privilege', '', TRUE);
        $this->load->model('PrivilegesLevel', '', TRUE);

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

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/privileges.js').'"></script>';
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
        $this->Data['privileges'] = $this->Privilege->all();
        // $this->Data['form']['groups_list'] = dropdown_list($this->Group->dropdown_list('groups_id, groups_name')->result_array(), ['groups_id', 'groups_name'], '', false);
        $this->Data['form']['privileges_list'] = dropdown_list($this->Privilege->dropdown_list('id, name')->result_array(), ['id', 'name'], '', false);
        $this->Data['form']['privileges_levels_list'] = dropdown_list($this->PrivilegesLevel->dropdown_list('id, name')->result_array(), ['id', 'name'], '', false);
        // $this->Data['form']['types_list']  = dropdown_list($this->Type->dropdown_list('types_id, types_name')->result_array(), ['types_id', 'types_name'], '', false);
        $this->Data['trash']['count'] = $this->Privilege->get_all(0, 0, null, true)->num_rows();
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
            $removed_only = null != $this->input->post('removedOnly') ? $this->input->post('removedOnly') : false;
            $total        = $this->Privilege->get_all(0, 0, null, $removed_only)->num_rows();

            if( null != $wildcard ) {
                $privileges = $this->Privilege->like($wildcard, $start_from, $limit, $sort, $removed_only)->result_array();
                $total   = $this->Privilege->like($wildcard, 0, 0, null, $removed_only)->num_rows();
            } else {
                $privileges = $this->Privilege->get_all($start_from, $limit, $sort, $removed_only)->result_array();
            }

            foreach ($privileges as $key => $privilege) {
                $bootgrid_arr[] = array(
                    'count_id'  => $key + 1 + $start_from,
                    'id'        => $privilege['id'],
                    'name'      => $privilege['name'],
                    'code'      => $privilege['code'],
                    'description' => $privilege['description'],
                    'level'     => $this->PrivilegesLevel->find($privilege['level'])->name,
                );
            }

            $data = array(
                "current"       => intval($current),
                "rowCount"      => $limit,
                "searchPhrase"  => $wildcard,
                "total"         => intval( $total ),
                "rows"          => $bootgrid_arr,
                "trash"         => array(
                    "count" => $this->Privilege->get_all(0, 0, null, true)->num_rows(),
                ),
            );

            echo json_encode( $data );
            exit();
        }
    }

    public function add()
    {
        # Validation
        if( $this->Privilege->validate(true) ) {
            // $data = array(
            //     'message'=> arraytoimplode($this->input->post('modules')),
            //     'type'=>'danger',
            // );
            // echo json_encode( $data ); exit();

            # Save
            $privilege = array(
                'name'    => $this->input->post('name'),
                'code'   => $this->input->post('code'),
                'description'     => $this->input->post('description'),
                'level'        => $this->input->post('level'),
                'created_by'     => $this->user_id,
            );

            $this->Privilege->insert($privilege);

            # Response
            $data = array(
                'message' => 'Privilege was successfully added',
                'type'    => 'success',
                // 'debug'   => $this->input->post('groups'),
            );

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
            redirect( base_url('privileges') );
        }
    }

    public function edit($id)
    {
        $privilege = $this->Privilege->find( $id );
        if( $this->input->is_ajax_request() ) {
            echo json_encode( $privilege ); exit();
        } else {
            $this->Data['privilege'] = $privilege;
            $this->load->view('layouts/main', $this->Data);
        }
    }

    /**
     * Updates the resource
     *
     * @param  INT $id
     * @return JSON or Redirect
     */
    public function update($id)
    {
        if( $this->Privilege->validate(false, $id, $this->input->post('code')) ) {
            # Update
            $privilege = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description'),
                'level' => arraytoimplode( $this->input->post('level') ),
                'updated_by' => $this->user_id,
            );
            $this->Privilege->update($id, $privilege);

            # Response
            $data = array(
                'message' => 'Privilege was successfully updated',
                'type' => 'success',
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
        $this->Data['privileges'] = $this->Privilege->all(true);

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/privilegesTrash.js').'"></script>';
        $this->load->view('layouts/main', $this->Data);
    }

    public function remove($id=null)
    {
        // if( !$this->Auth->can() ) {
        //     $this->Data['Headers']->Page = 'errors/403';
        //     $this->load->view('layouts/errors', $this->Data);
        //     echo json_encode( [
        //         'title' => 'Access Denied',
        //         'message' => "You don't have permission to Remove this resource",
        //         'type' => 'error',
        //     ] ); exit();
        // }

        $remove_many = 0;
        if( null === $id ) $remove_many = 1;
        if( null === $id ) $id = $this->input->post('id');

        if( $this->Privilege->remove($id) ) {
            if( 1 == $remove_many ) {
                $data['message'] = 'Privileges were successfully removed';
            } else {
                $data['message'] = 'Privilege was successfully removed';
            }
            $data['title'] = "Removed";
            $data['type'] = 'success';
        } else {
            $data['title'] = "Error";
            $data['message'] = 'An error occured while removing the resource';
            $data['type'] = 'error';
        }

        if( $this->input->is_ajax_request() ) {
            echo json_encode( $data ); exit();
        } else {
            $this->session->set_flashdata('message', $data );
            redirect('privileges');
        }
    }

    public function restore($id=null)
    {
        if( null === $id ) $id = $this->input->post('id');

        if( $this->Privilege->restore($id) ) {
            $data['message'] = 'Privilege was successfully restored';
            $data['type'] = 'success';
        } else {
            $data['message'] = 'An error occured while trying to restore the resource';
            $data['type'] = 'error';
        }

        if( $this->input->is_ajax_request() ) {
            echo json_encode( $data ); exit();
        } else {
            $this->session->set_flashdata('message', $data );
            redirect('privileges');
        }
    }
}