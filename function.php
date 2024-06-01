<?php

function check_login($con)
{

	if(isset($_SESSION['id']))
	{

		$id = $_SESSION['id'];
		$query = "select * from users where id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

function check_admin_login($con)
{

	if(isset($_SESSION['adminid']))
	{

		$adminid = $_SESSION['adminid'];
		$query = "select * from admin where adminid = '$adminid' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$admin_data = mysqli_fetch_assoc($result);
			return $admin_data;
		}
	}

	//redirect to login
	header("Location: adminlogin.php");
	die;

}

function check_login_redirect($con) {
    
    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
        $result = mysqli_query($con, $query);

       
        if($result && mysqli_num_rows($result) > 0) {
           
            header("Location: index.php");
            die;
        }
    }
   
}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}