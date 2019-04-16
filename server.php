<?php
	session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
	// variable declaration
	$username = "";
	$email    = "";
	$name = "";
	$dob = "";
	$errors = array();
	$_SESSION['success'] = "";
  // unset($_SESSION['booking_id']);
  // unset($_SESSION['seat']);
	// connect to database
	$db = mysqli_connect('localhost', 'root', 'root', 'booking');

	function getId($username){
		global $db;
	  $query = 'SELECT `id` FROM `users` WHERE `username` = "'.$username.'"';
	  $result = mysqli_query($db, $query);
	  $row = mysqli_fetch_assoc($result);
		// echo('hellooo');
	  return $row['id'];
	}

  function ifExists($username){
    global $db;
    $query = 'SELECT `id` FROM `users` WHERE `username` = "'.$username.'"';
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) == 0){
      return FALSE;
    }
    else{
      return TRUE;
    }
  }

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($name)) { array_push($errors, "Name is required"); }
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
    if(ifExists($username)){array_push($errors,"Username already taken");}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password, name)
					  VALUES('$username', '$email', '$password', '$name')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['userId'] = getId($username);
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// ...

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);
			$row=mysqli_fetch_assoc($results);
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['name'] = $row['name'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['userId'] = getId($username);
				$_SESSION['success'] = "You are now logged in";
				header('location: user/index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>
