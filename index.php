<?php
// include header
include "header.php";
// set the tpl page
$page = "index.tpl";

// get the variable method
$module = $_GET['module'];
$act = $_GET['act'];

// function for validation from injection
function injection($data){
	$filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter;
}

if ($module == 'login' && $act == 'submit')
{
	$username = injection($_POST['username']);
	$password = injection(md5($_POST['password']));
	
	// injection
	$usernameInjection = mysqli_real_escape_string($connect, $username);
	$passwordInjection = mysqli_real_escape_string($connect, $password);
	
	// find the account
	$queryLogin = "SELECT * FROM as_staffs WHERE email = '$usernameInjection' AND password = '$passwordInjection' AND status = 'Y'";
	$sqlLogin = mysqli_query($connect, $queryLogin);
	
	// count 
	$numLogin = mysqli_num_rows($sqlLogin);
	$dataLogin = mysqli_fetch_array($sqlLogin);
	
	if ($numLogin > 0)
	{
		session_start();
		
		// create the session variable
		$_SESSION['staffID'] = $dataLogin['staffID'];
		$_SESSION['level'] = $dataLogin['level'];
		$_SESSION['email'] = $dataLogin['email'];
		$_SESSION['staffName'] = $dataLogin['staffName'];
		$_SESSION['staffCode'] = $dataLogin['staffCode'];
		$_SESSION['staffNickName'] = $dataLogin['staffNickName'];
		$_SESSION['position'] = $dataLogin['position'];
		$_SESSION['lastLogin'] = date('Y-m-d H:i:s'); 
		
		// redirect to the dashboard
		header("Location: home.php?msg=Login berhasil");
	}
	
	else
	{
		header("Location: index.php?msg=Login salah, silahkan coba lagi");
	}
}

$smarty->assign("msg", $_GET['msg']);

// include footer
include "footer.php";
?>