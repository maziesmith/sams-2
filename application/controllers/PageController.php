<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {
    private $Data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
        $this->load->model('Module', '', TRUE);
        $this->load->model('Level', '', TRUE);
        $this->load->model('PrivilegesLevel', '', TRUE);
        $this->load->model('Privilege', '', TRUE);
        $this->load->model('User', '', TRUE);
    }

    /**
     * Index for this controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->validated();
        $Data['Headers'] = get_page_headers();
        $Data['Headers']->Page = "dashboard";
        $this->load->view('layouts/main', $Data);
    }

    public function validated()
    {
        // $this->session->set_flashdata('error', "");
        if(!$this->session->userdata('validated')) redirect('login');
    }

    public function debug()
    {
        $this->validated();
        $this->load->model('Auth', '', TRUE);
        if( $this->Auth->can('members/update') ) {
            echo "can";
        } else {
            $data = array(
                'message' => 'Restricted access.',
                'type' => 'warning',
            );
            $this->session->set_flashdata('message', $data);
            $this->Data['Headers'] = get_page_headers();
            $this->Data['Headers']->Page = 'errors/403';
            $this->load->view('layouts/errors', $this->Data);
        }
        // if( $this->Auth->can() )
    }

    /**
     * View for this controller.
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function view($page)
    {
        $this->validated();
        $Data['Headers'] = get_page_headers();
        $this->load->view('layouts/main', $Data);
    }

    public function install($version=NULL)
    {
        set_time_limit(600); // for longer execution time if needed
        # Check if migration already exists
        // if ($this->db->table_exists('migrations')) redirect('login');

        // Migrate
        if(isset($version) && ($this->migration->version($version) === FALSE))
        {
          show_error($this->migration->error_string());
        }

        elseif(is_null($version) && $this->migration->latest() === FALSE)
        {
          show_error($this->migration->error_string());
        }

        else
        {
          echo 'The migration has concluded successfully.';
        }

        // Seed
        // $this->seed();
    }

    public function undo($version=null)
    {
        $migrations = $this->migration->find_migrations();
        $migration_keys = array();
        foreach($migrations as $key => $migration)
        {
            $migration_keys[] = $key;
        }
            if  (isset($version) && array_key_exists($version,$migrations) && $this->migration->version($version))
        {
            echo 'The migration was reset to the version: '.$version;
            exit;
        }
        elseif(isset($version) && !array_key_exists($version,$migrations))
        {
            echo 'The migration with version number '.$version.' doesn\'t exist.';
        }
        else
        {
            $penultimate = (sizeof($migration_keys)==1) ? 0 : $migration_keys[sizeof($migration_keys) - 2];
            if($this->migration->version($penultimate))
            {
                echo 'The migration has been rolled back successfully.';
                exit;
            }
            else
            {
                echo 'Couldn\'t roll back the migration.';
                exit;
            }
        }
    }
    public function reset()
    {
        if($this->migration->current()!== FALSE)
        {
            echo 'The migration was reset to the version set in the config file.';
            return TRUE;
        }
        else
        {
            echo 'Couldn\'t reset migration.';
            show_error($this->migration->error_string());
            exit;
        }
    }

    public function seed()
    {
        // $modules = array();
        $modules[1] = array(
            'name' => 'List Members',
            'description' => 'Members list function',
            'slug' => 'members/listing',
        );
        $modules[2] = array(
            'name' => 'Add Members',
            'description' => 'Members add function',
            'slug' => 'members/add',
        );
        $modules[3] = array(
            'name' => 'Edit Members',
            'description' => 'Members edit function',
            'slug' => 'members/edit',
        );
        $modules[4] = array(
            'name' => 'Update Members',
            'description' => 'Members update function',
            'slug' => 'members/update',
        );
        $modules[5] = array(
            'name' => 'Remove Members',
            'description' => 'Members remove function',
            'slug' => 'members/remove',
        );
        $modules[6] = array(
            'name' => 'Restore Members',
            'description' => 'Members restore function',
            'slug' => 'members/restore',
        );
        $modules[7] = array(
            'name' => 'Export Members',
            'description' => 'Members export function',
            'slug' => 'members/export',
        );
        $modules[8] = array(
            'name' => 'Import Members',
            'description' => 'Members import function',
            'slug' => 'members/import',
        );

        /*
        | -----------------
        | # Groups
        | -----------------
        */
        $modules[9] = array(
            'name' => 'List Groups',
            'description' => 'Groups list function',
            'slug' => 'groups/listing',
        );
        $modules[10] = array(
            'name' => 'Add Groups',
            'description' => 'Groups add function',
            'slug' => 'groups/add',
        );
        $modules[11] = array(
            'name' => 'Edit Groups',
            'description' => 'Groups edit function',
            'slug' => 'groups/edit',
        );
        $modules[12] = array(
            'name' => 'Update Groups',
            'description' => 'Groups update function',
            'slug' => 'groups/update',
        );
        $modules[13] = array(
            'name' => 'Remove Groups',
            'description' => 'Groups remove function',
            'slug' => 'groups/remove',
        );
        $modules[14] = array(
            'name' => 'Restore Groups',
            'description' => 'Groups restore function',
            'slug' => 'groups/restore',
        );
        $modules[15] = array(
            'name' => 'Export Groups',
            'description' => 'Groups export function',
            'slug' => 'groups/export',
        );
        $modules[16] = array(
            'name' => 'Import Groups',
            'description' => 'Groups import function',
            'slug' => 'groups/import',
        );

        /*
        | -----------------
        | # Types
        | -----------------
        */
        $modules[17] = array(
            'name' => 'List Types',
            'description' => 'Types list function',
            'slug' => 'types/listing',
        );
        $modules[18] = array(
            'name' => 'Add Types',
            'description' => 'Types add function',
            'slug' => 'types/add',
        );
        $modules[19] = array(
            'name' => 'Edit Types',
            'description' => 'Types edit function',
            'slug' => 'types/edit',
        );
        $modules[20] = array(
            'name' => 'Update Types',
            'description' => 'Types update function',
            'slug' => 'types/update',
        );
        $modules[21] = array(
            'name' => 'Remove Types',
            'description' => 'Types remove function',
            'slug' => 'types/remove',
        );
        $modules[22] = array(
            'name' => 'Restore Types',
            'description' => 'Types restore function',
            'slug' => 'types/restore',
        );
        $modules[23] = array(
            'name' => 'Export Types',
            'description' => 'Types export function',
            'slug' => 'types/export',
        );
        $modules[24] = array(
            'name' => 'Import Types',
            'description' => 'Types import function',
            'slug' => 'types/import',
        );

        /*
        | -----------------
        | # Levels
        | -----------------
        */
        $modules[25] = array(
            'name' => 'List Levels',
            'description' => 'Levels list function',
            'slug' => 'levels/listing',
        );
        $modules[26] = array(
            'name' => 'Add Levels',
            'description' => 'Levels add function',
            'slug' => 'levels/add',
        );
        $modules[27] = array(
            'name' => 'Edit Levels',
            'description' => 'Levels edit function',
            'slug' => 'levels/edit',
        );
        $modules[28] = array(
            'name' => 'Update Levels',
            'description' => 'Levels update function',
            'slug' => 'levels/update',
        );
        $modules[29] = array(
            'name' => 'Remove Levels',
            'description' => 'Levels remove function',
            'slug' => 'levels/remove',
        );
        $modules[30] = array(
            'name' => 'Restore Levels',
            'description' => 'Levels restore function',
            'slug' => 'levels/restore',
        );
        $modules[31] = array(
            'name' => 'Export Levels',
            'description' => 'Levels export function',
            'slug' => 'levels/export',
        );
        $modules[32] = array(
            'name' => 'Import Levels',
            'description' => 'Levels import function',
            'slug' => 'levels/import',
        );

        /*
        | -----------------
        | # Messaging
        | -----------------
        */
        $modules[33] = array(
            'name' => 'List Messaging',
            'description' => 'Messaging list function',
            'slug' => 'messaging/listing',
        );
        $modules[34] = array(
            'name' => 'Add Messaging',
            'description' => 'Messaging add function',
            'slug' => 'messaging/add',
        );
        $modules[35] = array(
            'name' => 'Edit Messaging',
            'description' => 'Messaging edit function',
            'slug' => 'messaging/edit',
        );
        $modules[36] = array(
            'name' => 'Update Messaging',
            'description' => 'Messaging update function',
            'slug' => 'messaging/update',
        );
        $modules[37] = array(
            'name' => 'Remove Messaging',
            'description' => 'Messaging remove function',
            'slug' => 'messaging/remove',
        );
        $modules[38] = array(
            'name' => 'Restore Messaging',
            'description' => 'Messaging restore function',
            'slug' => 'messaging/restore',
        );
        $modules[39] = array(
            'name' => 'Export Messaging',
            'description' => 'Messaging export function',
            'slug' => 'messaging/export',
        );
        $modules[40] = array(
            'name' => 'Import Messaging',
            'description' => 'Messaging import function',
            'slug' => 'messaging/import',
        );

        /*
        | -----------------
        | # Privileges
        | -----------------
        */
        $modules[41] = array(
            'name' => 'List Privilege',
            'description' => 'Privilege list function',
            'slug' => 'privileges/listing',
        );
        $modules[42] = array(
            'name' => 'Add Privilege',
            'description' => 'Privilege add function',
            'slug' => 'privileges/add',
        );
        $modules[43] = array(
            'name' => 'Edit Privilege',
            'description' => 'Privilege edit function',
            'slug' => 'privileges/edit',
        );
        $modules[44] = array(
            'name' => 'Update Privilege',
            'description' => 'Privilege update function',
            'slug' => 'privileges/update',
        );
        $modules[45] = array(
            'name' => 'Remove Privilege',
            'description' => 'Privilege remove function',
            'slug' => 'privileges/remove',
        );
        $modules[46] = array(
            'name' => 'Restore Privilege',
            'description' => 'Privilege restore function',
            'slug' => 'privileges/restore',
        );
        $modules[47] = array(
            'name' => 'Export Privilege',
            'description' => 'Privilege export function',
            'slug' => 'privileges/export',
        );
        $modules[48] = array(
            'name' => 'Import Privilege',
            'description' => 'Privilege import function',
            'slug' => 'privileges/import',
        );

        /*
        | -----------------
        | # Privileges Levels
        | -----------------
        */
        $modules[49] = array(
            'name' => 'List Privileges Level',
            'description' => 'Privileges Level list function',
            'slug' => 'privileges-levels/listing',
        );
        $modules[50] = array(
            'name' => 'Add Privileges Level',
            'description' => 'Privileges Level add function',
            'slug' => 'privileges-levels/add',
        );
        $modules[51] = array(
            'name' => 'Edit Privileges Level',
            'description' => 'Privileges Level edit function',
            'slug' => 'privileges-levels/edit',
        );
        $modules[52] = array(
            'name' => 'Update Privileges Level',
            'description' => 'Privileges Level update function',
            'slug' => 'privileges-levels/update',
        );
        $modules[53] = array(
            'name' => 'Remove Privileges Level',
            'description' => 'Privileges Level remove function',
            'slug' => 'privileges-levels/remove',
        );
        $modules[54] = array(
            'name' => 'Restore Privileges Level',
            'description' => 'Privileges Level restore function',
            'slug' => 'privileges-levels/restore',
        );
        $modules[55] = array(
            'name' => 'Export Privileges Level',
            'description' => 'Privileges Level export function',
            'slug' => 'privileges-levels/export',
        );
        $modules[56] = array(
            'name' => 'Import Privileges Level',
            'description' => 'Privileges Level import function',
            'slug' => 'privileges-levels/import',
        );

        foreach ($modules as $module) {
            $this->Module->insert($module);
            echo "success" . "<br>";
        }


        # Priveleges Levels
        $mod = $this->Module->all();
        $mm = [];
        foreach ($mod as $m) {
            $mm[] = $m->id;
        }
        $privileges_leves[] = array(
            'name' => 'Level -1',
            'code' => 'super-admin-level',
            'description' => 'Super Admin Privilege Level',
            'modules' => implode(",", $mm),
            'created_by' => 1,
        );
        $privilege_level_id=1;
        foreach ($privileges_leves as $pl) {
            $privilege_level_id = $this->PrivilegesLevel->insert($pl);
            echo "Privilege Level Added" . "<br>";
        }
        # Privileges
        $privileges[] = array(
            'name' => 'Super Admin',
            'code' => 'super-admin',
            'description' => 'Super Admin Privilege',
            'level' => $privilege_level_id,
            'created_by' => 1,
        );
        $privilege_id = 1;
        foreach ($privileges as $pl) {
            $privilege_id = $this->Privilege->insert($pl);
            echo "Privilege Added" . "<br>";
        }
        # Users
        $data = null;
        $data = array(
            'username'    => 'admin',
            'password'   => password_hash('admin', PASSWORD_BCRYPT),
            'email'     => 'john.dionisio1@gmail.com',
            'firstname'        => 'John Lioneil',
            'middlename'         => 'Palanas',
            'lastname'      => 'Dionisio',
            'remember_token'       => 1,
            'privilege' => $privilege_id,
            'privilege_level' => $privilege_level_id,
        );
        $this->User->insert($data);
        $data = null;
        $data = array(
            'username'    => 'foxtrot',
            'password'   => password_hash('foxtrot', PASSWORD_BCRYPT),
            'email'     => 'ferdiesan060116@gmail.com',
            'firstname'        => 'Ferdie',
            'middlename'         => '',
            'lastname'      => 'Santiago',
            'remember_token'       => 1,
            'privilege' => $privilege_id,
            'privilege_level' => $privilege_level_id,
        );
        $this->User->insert($data);
        $data = null;
        $data = array(
            'username'    => 'tango',
            'password'   => password_hash('tango', PASSWORD_BCRYPT),
            'email'     => 'amacalawi@gmail.com',
            'firstname'        => 'Aliudin',
            'middlename'         => '',
            'lastname'      => 'Macalawi',
            'remember_token'       => 1,
            'privilege' => $privilege_id,
            'privilege_level' => $privilege_level_id,
        );
        $this->User->insert($data);
        echo "Alright."; exit();
    }

}