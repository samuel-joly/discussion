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
				<p>ChatOns Log in! </p>
				<div class="inputZone">
					<label for="login">Login</label>
					<input type="text" name="login" required/>
				</div>
				
				<div class="inputZone">
					<label for="password">Mot de passe</label>
					<input type="password" name="password" required/>
				</div>
				
				<div class="inputZone  submitZone">
					<input type="submit" name="submitBtn" value="Se connecter"/>
					<input type="reset" />
				</div>
			</form>
		</main>
		
	</body>
</html>



<?php

	if(isset($_SESSION['logged_in'])) 
	{
		header('location:index.php?error=7');
	}
	
	if(isset($_POST["submitBtn"]))
	{
		if(!isset($_SESSION["BLOCK"]))
		{
			$conn = mysqli_connect("localhost","root","","discussion");
			$request = "SELECT login, password , id FROM utilisateurs";
			$query = mysqli_query($conn,$request);
			$result = mysqli_fetch_all($query);
					
			$count = 0;
			$validator = false;
			while($count < count($result))
			{
				if($_POST["login"] == $result[$count][0] && password_verify($_POST["password"], $result[$count][1]))
				{
					$_SESSION["logged_in"] = true;
					$_SESSION["login"] = $_POST["login"];
					$_SESSION["id"] = $result[$count][2];
					
					$validator = true;
					mysqli_close($conn);
					break;
				}
				$count++;
			}		
			if($validator)
			{
				header("location:index.php");			
			}
			else
			{	
				if(!isset($_SESSION["try"]))
				{
					$_SESSION["try"] = 3;				
				}
				else
				{
					$_SESSION["try"] -= 1;
						
					if ($_SESSION["try"] <= 0)
					{
						$_SESSION["try"] = 3;
						$_SESSION["BLOCK"] = time();
					}
				}
				header("location:connexion.php?error=2");
			}
		}
	}
?>