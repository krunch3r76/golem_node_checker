<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>golem node checker result</title>
</head>
<body>
<?php
// this code i adapted for a simple udp socket client was taken off the web
// .. when i find the source again i will include it
/*
	Simple php udp socket client
*/

//Reduce errors
//error_reporting(~E_WARNING);
//
include('./functions.php');

function timeout_ok($dbc, $ipaddr) {
    // returns true if at least 5 seconds has passed since last successful ping
    $row = select_on_ipaddr($dbc, $ipaddr);
    $lasttime = time() - 5;
    if ($row != NULL) {
	$lasttime = $row['lasttime'];
    }

    return time() - $lasttime >=5;
}

function validate_ip($server, $port) {
    if (!filter_var($server, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
	    die("Not a valid IP address! Maybe it is a non-public IP address?");
    }

    if (!filter_var($port, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>65535)))) {
	    die("Invalid port. Please use a number in the range of 1-65535");
    }
}

function ping_yagna($server="", $port=-1) {
    $success = false;

    if(!($sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)))
    {
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);

	    die("Couldn't create socket: [$errorcode] $errormsg \n");
    }

    # echo "Socket created \n";

    //$input = "\x12\x10\x4b\x72\x3d\xef\x3e\x1c\xbb\x2b\x84\xff\xc5\x1c\xa7\xbe\x52\x43\x1a\x07\x08\xf7\xcb\x01\x82\x05\x00";
    $ping_msg_hex = "12104b723def3e1cbb2b84ffc51ca7be52431a0708f7cb01820500";
    $ping_msg = hex2bin($ping_msg_hex);

    //Send the message to the server
    if( ! socket_sendto($sock, $ping_msg, 27, 0, $server, $port))
    {
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);

	    die("Could not send data: [$errorcode] $errormsg \n");
    }


    //Communication loop
    // while(1)
    // {
	    //Take some input to send
	    // echo 'Enter a message to send : ';
	    // $input = fgets(STDIN);


	    /*
	    */
    // }


    socket_set_option($sock,SOL_SOCKET,SO_RCVTIMEO,array("sec"=>5,"usec"=>0));
    // https://stackoverflow.com/a/16098614

    //Now receive reply from server and print it
    if(socket_recv ( $sock, $reply, 2045, MSG_WAITALL ) == FALSE)
    {
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);

	    die("Did not receive response from $server:$port (udp): error code [$errorcode] $errormsg \n</br>looks like golemsp is either not running or the port is not forwarded on the public ip!");

    }
    else {
    // \0x12\0x10\0x4b\0x72\0x3d\0xef\0x3e\0x1c\0xbb\0x2b\0x84\0xff\0xc5\0x1c\0xa7\0xbe\0x52\0x43\0x22\0x0a\0x08\0xf7\0xcb\0x01\0x10\0xc8\0x01\0x82\0x05
	    $reply_test="12104b723def3e1cbb2b84ffc51ca7be5243220a08f7cb0110c8018205";
	    $bytelen = strlen($reply_test)/2;
	    $bytelen = strlen($reply_test)/2;

	    echo "Success! Yagna was successfully pinged! The port is open!";
	    $success = true;
	    if(!strcmp($reply,$reply_test)) {
		    echo "</br>however, the data signature was not typical of golemsp. Are you sure golemsp is running?</br>";
		    echo "</br>if golemsp is running, then the response signature may have changed. This is okay and is still";
		    echo " confirmation that $server:$port (udp) is listening.";
	    }
    }
# header("location:/golem/index.php?ipaddr=$server");
    return $success;
}

// ini_set('display_errors',1);
// error_reporting(E_ALL);
include('../../mysqli_connect.php'); // this declares $dbc, the mysqli object
/* an example mysqli_connect.php
<?php
$dbc = mysqli_connect('localhost', 'username', 'password', 'database');
mysqli_set_charset($dbc, 'utf8');
EOF
*/

$server = strip_tags(trim($_POST["ipaddr"]));
$port = strip_tags($_POST["port"]);

validate_ip($server, $port);

$success=false;
if ( timeout_ok($dbc, $server) ) {
    $success = ping_yagna($server, $port);
    }
else {
    print "<p>Please wait at least 5 seconds between pings!</p>";
}
if ($success) {
    insert_or_update_on_ipaddr($dbc, $server);
}
?>

</body>
</html>
