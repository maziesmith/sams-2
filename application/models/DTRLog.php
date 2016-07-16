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
        $q = $this->db->query("SELECT MAX(timelog) AS timelog FROM $this->table WHERE timelog LIKE '{$d}%';")->row();

        $config['date'] = (null != $q) ? date("Ymd", strtotime($q->timelog)) : date("Ymd");
        $config['time'] = (null != $q) ? date("His", strtotime($q->timelog)) : "030000";
        return json_encode($config);
    }
}
 ?>