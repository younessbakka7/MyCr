<?php 
session_start();
	if(isset($_SESSION["ID_UT"]) && isset($_SESSION["Role"]))
	{
		if(!empty($_SESSION["ID_UT"]) && !empty($_SESSION["Role"]))
		{
			if($_SESSION["Role"] == "Utilisateur")
			header('Location:'.'../index.php');
			elseif($_SESSION["Role"] == "Admin")
			header('Location:'.'../ADMIN/index.php');
			
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form action="Connection.php" method="POST">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="Login" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="Password" class="input">
            	   </div>
				   
            	</div>
				<?php 
				if(isset($_GET["er"]))
				{
					if(!empty($_GET["er"]))
					{
						if($_GET["er"] == "LOGINC")
						{
				echo "<span style='color: red;margin-left:-40px;'> Login or Password Incorrect </span>";
				
						}
				elseif($_GET["er"] == "OBCN")
				{
				echo "<span style='color: red;margin-left:-40px;'> Obligatoire de Connexion </span>";
				}
				elseif($_GET["er"] == "Banned")
				{
				echo "<span style='color: red;margin-left:-40px;'> Votre Compte est Blocker </span>";
				}
					}
				}
				
				 ?>
            	<a href="#" style="z-index: 100;float: right;">Forgot Password?</a>
            	<input type="submit" name="Loginbtn" class="btn" value="Login">
            	<input type="submit" name="Register" class="btn" value="Register">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
	
</body>
</html>
