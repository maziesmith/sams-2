<?php


// MySQL config parameters
$config['mysql_host'] = 'localhost';
$config['mysql_user'] = 'root';
$config['mysql_pass'] = 'root';
//$config['mysql_db'] = 'sams';
$config['mysql_db'] = 'sams_db';
$config['enrollment_db'] = 'mcsv3';
$config['debug'] = false;


define('SEND_URL', 'http://localhost:13013/cgi-bin/sendsms?username=foo&password=bar&dlr-mask=31');
//define('DLR_URL','http://localhost/dlr/dlr.php?type=%d');
define('DLR_URL','http://sjsp-sams.edu/cgi/dlr.php?type=%d&answer=%A');

define('PARSER', '/home/altair/projects/smspolling/smsparser/received.php');
?>
