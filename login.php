<?php

session_start();
$ini=false;

if (isset($_SESSION['user_id'])) {
    header('Location: /proyectosed');
  }
require 'database.php';
$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $records = $conn->prepare('SELECT id, email, password,name FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    if($records->execute()){
		$results = $records->fetch(PDO::FETCH_ASSOC);
	}
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
	  header("Location: /proyectosed");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
}

if (!empty($_POST['email_r']) && !empty($_POST['password_r']) && !empty($_POST['name_r'])) {
    $sql = "INSERT INTO users (email,password,name) VALUES (:email,:password,:name)";
    $stmt = $conn->prepare($sql);
	$email =$_POST['email_r'];
    $stmt->bindParam(':email', $email);
    $password = password_hash($_POST['password_r'], PASSWORD_BCRYPT);
	$stmt->bindParam(':password', $password);
	$name =$_POST['name_r'];
	$stmt ->bindParam(':name',$name);
	$slquery = $conn->prepare("SELECT * FROM users WHERE email = :email_r");
	$slquery->bindParam(':email_r', $_POST['email_r']);
    $slquery->execute();
    $rees = $slquery->fetch(PDO::FETCH_ASSOC);
    if(false)
    {
         $message = 'Email already exists';
    }
    else if($_POST['password_r'] == $_POST['confirm_password']){
        if ($stmt->execute()) {
        $message = 'Successfully created new user';
        } else {
        $message = 'Sorry there must have been an issue creating your account';
        }
	}
}

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
  <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
 <?php endif; ?>
    <a href="index.php">Inicio</a>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="login.php" method="POST">
			<h1>Create Account</h1>
			<span>or use your email for registration</span>
			<input name ="name_r" type="text" placeholder="Name" />
			<input name="email_r" type="email" placeholder="Email" />
			<input name="password_r" type="password" placeholder="Password" />
			<input name="confirm_password" type="password" placeholder="Confirm Password" />
			<button>Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="login.php" method="POST">
			<h1>Sign in</h1>
			<span>or use your account</span>
			<input name="email" type="email" placeholder="Email" />
			<input name="password" type="password" placeholder="Password" />
			<button>Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<footer>
	<p>
		Created with <i class="fa fa-heart"></i> by
		<a target="_blank" href="https://florin-pop.com">Florin Pop</a>
		- Read how I created this and how you can join the challenge
		<a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
	</p>
</footer>
  </body>
  <script src="js/login.js"></script>
</html>
