<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class DTRLog extends CI_Model {
    private $table = 'dtr_log';
    private $column_id = 'id';
    private $default_timezone = 'Asia/Manila';

    function __construct()
    {
        parent::__construct();
    }

    public function get_config()
    {
        date_default_timezone_set($this->default_timezone);
        // $mm = new MessagingModel('Messaging');
        // $json   = new Services_JSON();
        $d = date("Y-m-d");
        $q = $this->db->query("SELECT MAX(timelog) FROM $this->table WHERE timelog LIKE '{$d}%';");

        $config['date'] = ($q[0]) ? date("Ymd", strtotime($q[0])) : date("Ymd");
        $config['time'] = ($q[0]) ? date("His", strtotime($q[0])) : "030000";
        return json_encode($config);
    }
}
 ?>