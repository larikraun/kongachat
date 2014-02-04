<?php
session_start();
$uri = explode('public/', $_SERVER['REQUEST_URI']);
$uri = $uri[1];

$header = file_get_contents("header.html");
$footer = file_get_contents("footer.html");

switch($uri){
	case "login":
	case "login/":
		$main = file_get_contents("login.html");
		break;
	case "sign-up":
	case "sign-up/":
		$main = file_get_contents("signup.html");
		break;
	case "welcome":
	case "welcome/":
		$main = file_get_contents("welcome.html");
		break;
	case "chat":
	case "chat/":
		$main = file_get_contents("chat.html");
		$main = str_replace('/users/', $_SESSION['konga']['users']['status'], $main);
		break;
	default:
		$main = file_get_contents("none.html");
}

//print $uri;

print $header;
print $main;
print $footer;