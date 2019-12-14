<html lang='fr'>

	<head>
		<meta charset='utf-8'>
		<link rel='stylesheet' href="style.css" type='text/css'>
		<title>ChatOns</title>
	</head>
	
	<body>
		
		<header>
			<?php include('header.php'); ?>
		</header>
		
		<main id="inscription">
			<form id="subForm" action="" method="post">
				<p>Rejoignez ChatOns ! </p>
				<div class="inputZone">
					<label for="login">Login</label>
					<input type="text" name="login"/>
				</div>
				
				<div class="inputZone">
					<label for="password">Mot de passe</label>
					<input type="password" name="password"/>
				</div>
				
				<div class="inputZone">
					<label for="passwordV">Vérifier Mdp </label>
					<input type="password" name="passwordV"/>
				</div>
				
				<div class="inputZone submitZone">
					<input type="submit" name="submitBtn" value="S'inscrire"/>
					<input type="reset" />
				</div>
			</form>
		</main>
		
	</body>
</html>




<?php

	if(isset($_SESSION['logged_in'])) 
	{
		header('location:index.php?error=3');
	}
	
	if(isset($_POST["submitBtn"]))
	{
		if($_POST["password"] != $_POST["passwordV"])
		{
			header("location:inscription.php?error=0");
		}
		else
		{
			$conn     = mysqli_connect("localhost","root","","discussion");
			$request  = "SELECT login FROM utilisateurs WHERE login = '".htmlspecialchars($_POST["login"])."'";
			$query    = mysqli_query($conn,$request);
			$response = mysqli_fetch_row($query);
			
			if(empty($response))
			{
				$request = "INSERT INTO utilisateurs (`id`,`login`,`password`,`image`) VALUES (NULL,'".htmlspecialchars($_POST["login"])."','".password_hash(htmlspecialchars($_POST["password"]),PASSWORD_BCRYPT)."','ProfilPics/default.png');";
				if(mysqli_query($conn, $request))
				{
					header("location:connexion.php");
				}				
			}
			else
			{
				header("location:inscription.php?error=1");
			}
		}
	} 
?>