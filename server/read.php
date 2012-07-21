<?php
session_start();
if (!isset($_SESSION['h'])) {
	echo ("cacafuti");
}else{
	header('Content-type: application/json');
	echo "{\n";
	echo '	"h":'.$_SESSION['h'].",\n" ;
	echo '	"l":'.$_SESSION['l'].",\n";
	echo '	"s":'.$_SESSION['s'].",\n";
	echo '	"t":'.$_SESSION['t'].",\n";
	echo "}";
}
?>