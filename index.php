<!DOCTYPE html>
<html style="font-size:20px" lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="mystyle.css">
	<title>golem node checker</title>
	<h1>test whether your golem node is reachable</h1>
</head>

<body>
<p>this website will ping the yagna node at the given ip address on the specified udp port (default 11500) to test whether the golem service provider (golemsp) node is reachable from outside its local network, i.e. from the internet where other nodes are running. if the test passes, you are running golemsp at maximum network efficiency!</p>
<p>note, your browser's public ip address is <b><?php echo $_SERVER['REMOTE_ADDR']?></b></p>
<p>if you are browsing to this page from the same computer as the node, <b><?php echo $_SERVER['REMOTE_ADDR']?></b> is the address you want to ping</p>
<br>
<FORM ACTION="udpclient.php" METHOD=POST style=margin-left:10%>
<div>
	<TABLE class="mytable">
	<TR>
		<TD style="border:0px">ip address:</TD>
		<TD style="border:0px"><INPUT required TYPE="TEXT" NAME="ipaddr" SIZE=15 VALUE=<?php echo $_GET["ipaddr"]?>></TD>
	</TR>
	<TR>
		<TD style="border:0px">udp port:</TD>
		<TD style="border:0px"><INPUT required TYPE="TEXT" NAME="port" VALUE="11500" SIZE=5></TD>
	</TR>
	<TR></TR>
	<TR></TR>
		<TR padding=10px><TD></TD><TD><BUTTON class="ping-button" TYPE="SUBMIT">ping yagna</button></TD></TR>
	</TABLE>
</div>
</FORM>
</body>
<footer style="margin-top:50%">
I developed this page for the golem community to help test golem network's latest rendition of the golem service provider. For more information about golem please visit https://www.golem.network. See my other golem related developments at my github: https://www.github.com/krunch3r76
</html>

