<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller {

    private $Data = array();

    public function __construct()
    {
        parent::__construct();
        // $this->validated();

        $this->load->model('User', '', TRUE);

        $this->Data['Headers'] = get_page_headers();
        $this->Data['Headers']->CSS = '<link rel="stylesheet" href="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.css').'">';
        // $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/chosen/chosen.min.css').'">';
        $this->Data['Headers']->CSS.= '<link rel="stylesheet" href="'.base_url('assets/vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css').'">';

        $this->Data['Headers']->JS  = '<script src="'.base_url('assets/vendors/bootgrid/jquery.bootgrid.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/chosen/chosen.jquery.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/moment/min/moment.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/bootstrap-growl/bootstrap-growl.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/autosize/dist/autosize.min.js').'"></script>';
        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/vendors/jquery.validate/dist/jquery.validate.min.js').'"></script>';

        $this->Data['Headers']->JS .= '<script src="'.base_url('assets/js/specifics/users.js').'"></script>';
    }

    public function validated()
    {
        $this->session->set_userdata('error', "You are not logged in");
        if(!$this->session->userdata('validated')) redirect('login');
    }

    /**
     * Index Page for this controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->Data['users'] = $this->User->all();
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
            $total        = $this->User->get_all()->num_rows();

            if( null != $wildcard )
            {
                $users = $this->User->like($wildcard, $start_from, $limit, $sort)->result_array();
                $total  = $this->User->like($wildcard)->num_rows();
            }
            else
            {
                $users = $this->User->get_all($start_from, $limit, $sort)->result_array();
            }

            foreach ($users as $key => $user) {
                $bootgrid_arr[] = array(
                    'count_id'           => $key + 1 + $start_from,
                    'users_id'          => $user['id'],
                    'username'        => $user['username'],
                    'fullname' => arraytostring([
                                                $user['firstname'],
                                                $user['middlename'] ? substr($user['middlename'], 0,1) . '.' : '',
                                                $user['lastname']], ' '),
                    'email'        => $user['email'],
                    'role'        => '',
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
            if( $this->User->validate(true) )
            {
                /*
                | --------------------------------------
                | # Save
                | --------------------------------------
                */
                $user = array(
                    'users_name'    => $this->input->post('users_name'),
                    'users_description' => $this->input->post('users_description'),
                    'users_code'     => $this->input->post('users_code')
                );
                $user_id = $this->User->insert($user);
                /*
                | --------------------------------------
                | # Save the Contacts Users
                | --------------------------------------
                */
                if( null !== $this->input->post('users_contacts') && $contacts_ids = $this->input->post('users_contacts') )
                {
                    $users_contacts = explode(",", $contacts_ids);
                    foreach ($users_contacts as $contact_id) {
                        $contact = $this->Contact->find($contact_id);
                        $contact_user = explode( ",", $contact->contacts_user);

                        # Check if the value is already in the resource,
                        # add to array if not.
                        if( !in_array($user_id, $contact_user) ) {
                            $contact_user[] = $user_id;
                        } else {
                            $data = array(
                                'message' => 'Contact is already in this user',
                                'type' => 'danger',
                                // 'debug' => $contact_user,
                                // "input" => $this->input->post('value'),
                            );
                            echo json_encode( $data );
                            exit();
                        }

                        $contact_user = arraytoimplode($contact_user);
                        $this->Contact->update($contact_id, array('contacts_user'=> $contact_user));
                    }
                }

                /*
                | ----------------------------------------
                | # Response
                | ----------------------------------------
                */
                $data = array(
                    'message' => 'User was successfully added',
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
            redirect( base_url('users') );
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
            $user = $this->User->find( $id );
            echo json_encode( $user );
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
            // $data['message'] = $this->input->post('users_contacts');
            // $data['type'] = 'success';
            // echo json_encode($data); exit();
            /*
            | --------------------------------------
            | # Validation
            | --------------------------------------
            */
            if( $this->User->validate(false, $id, $this->input->post('users_code')) )
            {
                /*
                | --------------------------------------
                | # Update
                | --------------------------------------
                */
                $user = array(
                    'users_name'    => $this->input->post('users_name'),
                    'users_description'   => $this->input->post('users_description'),
                    'users_code'     => $this->input->post('users_code')
                );
                $this->User->update($id, $user);
                /*
                | --------------------------------------
                | # Update the Contacts Users
                | --------------------------------------
                */
                if( null !== $this->input->post('users_contacts') && $contacts_ids = $this->input->post('users_contacts') )
                {
                    $users_contacts = explode(",", $contacts_ids);

                    foreach ($users_contacts as $contact_id) {
                        $this->Contact->update($contact_id, array('contacts_user'=> $id));
                    }
                }

                $data = array(
                    'message' => 'User was successfully updated',
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
                $ids = $this->input->post('users_ids');
                if( $this->User->delete($ids) )
                {
                    $data['message'] = 'Users were successfully deleted';
                    $data['type'] = 'success';

                    /*
                    | --------------------------------
                    | # Update Many Contacts
                    | --------------------------------
                    | All Contacts with this Users ID
                    */
                    foreach ($ids as $contacts_id) {
                        $contacts = $this->Contact->where(['contacts_user'=>$contacts_id])->get()->result_array();
                        foreach ($contacts as $contact) {
                            $this->Contact->update($contact['contacts_id'], ['contacts_user'=>'']);
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
            if( $this->User->delete($id) )
            {
                $data['message'] = 'User was successfully deleted';
                $data['type'] = 'success';

                /*
                | --------------------------------
                | # Update Contacts
                | --------------------------------
                | All Contacts with this Users ID
                */
                $contacts = $this->Contact->where(['contacts_user'=>$id])->get()->result_array();
                foreach ($contacts as $contact) {
                    $this->Contact->update($contact['contacts_id'], ['contacts_user'=>'']);
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

    public function seed()
    {
        // $this->load->library('PasswordHash', array(8, FALSE));
        // $check = $this->PasswordHash->CheckPassword($password, $actualPassword);
        $data = array(
            'username'    => 'admin',
            'password'   => password_hash('admin', PASSWORD_BCRYPT),
            'email'     => 'john.dionisio1@gmail.com',
            'firstname'        => 'John Lioneil',
            'middlename'         => 'Palanas',
            'lastname'      => 'Dionisio',
            'remember_token'       => 0,
        );
        $this->User->insert($data);
        echo "alright"; exit();
    }
}