<?php
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends CI_Model {
    private $table = 'inbox';
    private $outbox_table = 'outbox';
    private $contacts_table = 'members';
    private $column_id = 'id';
    private $column_softDelete = 'removed_at';
    private $column_softDeletedBy = 'removed_by';
    public $validate = array(
        array( 'field' => 'msisdn', 'label' => 'Name', 'rules' => 'trim' ),
    );

    function __construct()
    {
        parent::__construct();
    }

    private static function SEND_URL() {
        return "http://localhost:13013/cgi-bin/sendsms?username=foo&password=bar&dlr-mask=24";
    }

    private static function DLR_URL()
    {
        return "http://localhost/MCS-SMS/cgi/dlr.php?type=%d&answer=%A";
    }

    function send($id, $msisdn, $smsc, $body, $member_id, $group_id) {
        $d = Array();
        $d['message_id'] = $id;
        $d['msisdn']     = $msisdn;
        $d['member_id']  = $member_id;
        $d['group_id']   = $group_id;
        $d['smsc']       = ($smsc) ? $smsc : 'globe';
        $d['created_on'] ="NOW()";
        $d['status'] ='pending';
        $id = $this->insert('outbox', $d);

        $dlr = self::DLR_URL() . '&outbox_id=' . $id;
        $smsc = ""; //DISABLE SMSC USE RAMDOM SENDING;
        $url = self::SEND_URL() . '&to=' . $msisdn . '&text=' . urlencode($body) . '&smsc=' . $smsc . '&dlr-url=' . urlencode($dlr);

        $ch = curl_init ($url);
        ob_start();
        curl_exec($ch);
        $str = ob_get_contents();
        ob_end_clean();
        curl_close ($ch);
        $this->query("update outbox set extra = '$str' where id='$id'");
    }
}
 ?>