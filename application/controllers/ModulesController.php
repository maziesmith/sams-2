<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModulesController extends CI_Controller {
    private $Data = array();
    private $user_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->validated();

        $this->load->model('Module', '', TRUE);

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
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/fileinput/fileinput.min.js').'"></script>';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/modules.js').'"></script>';
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
        # Override the default layout, which was `users/modules` based on the route
        $this->Data['modules'] = $this->Module->all();
        // $this->Data['form']['groups_list'] = dropdown_list($this->Group->dropdown_list('groups_id, groups_name')->result_array(), ['groups_id', 'groups_name'], '', false);
        $this->Data['form']['modules_list'] = dropdown_list($this->Module->dropdown_list('id, name')->result_array(), ['id', 'name'], '', false);
        // $this->Data['form']['types_list']  = dropdown_list($this->Type->dropdown_list('types_id, types_name')->result_array(), ['types_id', 'types_name'], '', false);
        $this->Data['trash']['count'] = $this->Module->get_all(0, 0, null, true)->num_rows();
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
            $total        = $this->Module->get_all(0, 0, null, $removed_only)->num_rows();

            if( null != $wildcard ) {
                $modules = $this->Module->like($wildcard, $start_from, $limit, $sort, $removed_only)->result_array();
                $total   = $this->Module->like($wildcard, 0, 0, null, $removed_only)->num_rows();
            } else {
                $modules = $this->Module->get_all($start_from, $limit, $sort, $removed_only)->result_array();
            }

            foreach ($modules as $key => $module) {
                $bootgrid_arr[] = array(
                    'count_id'  => $key + 1 + $start_from,
                    'id'        => $module['id'],
                    'name'      => $module['name'],
                    'slug'      => $module['slug'],
                    'description' => $module['description'],
                );
            }

            $data = array(
                "current"       => intval($current),
                "rowCount"      => $limit,
                "searchPhrase"  => $wildcard,
                "total"         => intval( $total ),
                "rows"          => $bootgrid_arr,
                "trash"         => array(
                    "count" => $this->Module->get_all(0, 0, null, true)->num_rows(),
                ),
            );

            echo json_encode( $data );
            exit();
        }
    }

    public function seed()
    {
        $modules = array(
            '0' => array(
                'name' => '[Members] Add',
                'description' => 'Members add function',
                'slug' => 'members/add',
            ),
            '1' => array(
                'name' => '[Members] Edit',
                'description' => 'Members edit function',
                'slug' => 'members/edit',
            ),
            '2' => array(
                'name' => '[Members] Remove',
                'description' => 'Members remove function',
                'slug' => 'members/remove',
            ),
            '3' => array(
                'name' => '[Members] Restore',
                'description' => 'Members restore function',
                'slug' => 'members/restore',
            ),
        );
        foreach ($modules as $module) {
            if( $this->Module->validate(true) ) {
                $this->Module->insert($module);
                echo "success" . "<br>";
            } else {
                print_r( $this->form_validation->toArray() );
            }
        }
    }
}