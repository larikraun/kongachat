<?php

switch($_GET['action']){
	case "signup":
		$data = file_get_contents("http://192.168.1.3/core/user/signup?email={$_POST['email']}&password={$_POST['password']}&c_password={$_POST['c_password']}");
		$data  = json_decode($data);
		session_start();
		$_SESSION['konga']['user']['id'] = $data->response->user->user_id;
		$_SESSION['konga']['user']['email'] = $data->response->user->email;
		header("Location: /public/welcome");
		break;
	case "signin":
		$data = file_get_contents("http://192.168.1.3/core/user/auth?email={$_POST['email']}&password={$_POST['password']}");
		$data = json_decode($data);
		$user = (array)$data->response->user;
		session_start();
		$_SESSION['konga']['user']['id'] = $user['user_id'];
		$_SESSION['konga']['user']['email'] = $user['email'];
		$users = $data->response->users;
		$users = json_encode($users);
		$_SESSION['konga']['users']['status'] = $users;
		header("Location: /public/chat");
		break;
	default:
		null;
}