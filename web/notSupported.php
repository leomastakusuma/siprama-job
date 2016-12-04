<?php
$s = base64_encode("NotSupported"); 
$j = base64_encode("JSOff") ;
$x = base64_decode($_GET['x']);
if ($x=="NotSupported")
{
	$msg = "<h2>Browser not supported!</h2>
        <p>Your browser is not supported for this system.</p>
		<p>Please , Download the last version of <a href='https://www.google.com/chrome/'>Google Chrome</a></p>
		<p>Thanks</p>";
}
else if ($x=="JSOff")
{
	$msg = "<h2>Browser not supported!</h2>
        <p>Your browser was disabled javascript.</p>
		<p>Please enabled javascript</p>
		<p>Thanks</p>";
}
else if ($x=="Mobile")
{
	$msg = "<h2>Browser not supported!</h2>
        <p>Your browser is not supported for this system.</p>
		<p>Thanks</p>";
}
else if ($x=="dont have permission")
{
	$msg = "<h2>You don't have permission!</h2>
        <p>Please follow the rule of this system.</p>
		<p>Thanks</p>";
}
else
{
	$msg = "<h2>Please don't disturb this system :)</h2>
		<p>Thanks</p>";
}

?>

<html>
<head>
<link rel="shortcut icon" href="favicon.ico">
<style>
span, div, select, input, textarea, td, legend, body, a, font{
	font-family: verdana, arial, tahoma, times;
	font-size: 11px;
}

a{color:red; text-decoration:underline;}

.normal{
	color: #000000;
	font-weight: normal;
}

body{
	background-color: #FFFFFF;
}

legend, .legend{
	font-size: 13px;
	color: #4a497d;
	font-weight: bold;
}

.PageTitle{
	font-size: 15px;
	font-weight: bold;
}
.Title{
	font-size: 13px;
	color: #4a497d;
	font-weight: bold;
}
.Help{
	font-size: 10px;
	padding-top:5px;
	padding-bottom:5px;
}
.icon, .iconmenu{
	border-width: 0px;
	border-color: #316AC5;
	border-style: solid;
	cursor: pointer;
	cursor: hand;
}
.clsTitle{
	font-size: 13px;
	font-weight: bold;
	color: #000000;
	padding-bottom: 10px;
}

</style>

	    <title>Spotlight - Browser not supported!</title>
    </head>
    <body style="background-color:#ffffff">
        
		<?php echo $msg; ?>
		
	</body>
</html>