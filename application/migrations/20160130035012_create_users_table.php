<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_users_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'firstname' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'middlename' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'lastname' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'remember_token' => array(
                'type' => 'INT'
            ),
            'privilege' => array(
                'type' => 'INT'
            ),
        ));

        $this->dbforge->add_field('created_by INT');
        $this->dbforge->add_field('updated_by INT');
        $this->dbforge->add_field('removed_by INT');

        $this->dbforge->add_field('created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->add_field('updated_at TIMESTAMP DEFAULT "0000-00-00 00:00:00" ON UPDATE CURRENT_TIMESTAMP');
        $this->dbforge->add_field('removed_at TIMESTAMP NULL');

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
        $this->pdo = $this->load->database('pdo', true);
        $this->db->query('ALTER TABLE `'.$this->pdo->dbprefix.'users` ADD UNIQUE INDEX (`username`)');
    }

    public function down()
    {
        $this->dbforge->drop_table('users', TRUE);
    }

}