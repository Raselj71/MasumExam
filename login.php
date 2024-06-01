<?php include 'navbar.php'; 
  session_start();
  include("db.php");
	include("function.php");
  
  check_login_redirect($con);

  if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($password))
		{

			//read from database
			$query = "select * from users where email = '$email' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['id'] = $user_data['id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>




 
<section class="login-container">
   <form class="form-container" method="POST">
    <p class="form-heading">Welcome back</p>
       <div>
         <input class="login-input" type="email" name="email" id="email" placeholder="email">
       </div>
         <div>
         <input class="login-input" type="password" name="password" id="password" placeholder="password">
       </div>
        <input class="login-input login-button" type="submit" value="Login">
         <p class="signup-text">Don't have an Account? <a href="signup.php">signup</a></p>
   </form>
</section> 