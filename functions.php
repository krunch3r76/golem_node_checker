<?php
function compose_query_for_ipaddress($ipaddr) {
    // pre: $ipaddr is sql safe (soft requirement, since sha1 is used)
    $ipaddr= sha1($ipaddr);
    $query = "SELECT id, ipaddress, lasttime FROM yagna_pings WHERE ipaddress = '$ipaddr'";
    return $query;
}

function select_on_ipaddr($dbc, $ipaddr) {
    $query = compose_query_for_ipaddress($ipaddr);
    $ipaddr=sha1($ipaddr);
    if (!$result = mysqli_query($dbc, $query)) {
	print "a database error occurred on query: $query!";
	exit();
    }
//    print_r($result);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
	$row = mysqli_fetch_array($result);
    } else {
	$row = NULL;
    }

    return $row;
}

function insert_or_update_on_ipaddr($dbc, $ipaddr) {
    $ipaddr = mysqli_real_escape_string($dbc, trim(strip_tags($ipaddr)));
    $ipaddr = sha1($ipaddr);
    $query = "INSERT INTO yagna_pings (ipaddress, lasttime) VALUES ('$ipaddr', UNIX_TIMESTAMP()) ON DUPLICATE KEY UPDATE lasttime = UNIX_TIMESTAMP()";
    mysqli_query($dbc, $query);
    $affected_rows = mysqli_affected_rows($dbc); // should == 1
    // print $affected_rows;
    // print $query;
}
