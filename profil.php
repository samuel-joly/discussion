<?php
	$conn = mysqli_connect("localhost","root","","discussion");
	
		if(!isset($_SESSION["logged_in"])) 
		{
			header("location:connexion.php");
		} 
?>
<html lang='fr'>

	<head>
		<meta charset='utf-8'>
		<link rel='stylesheet' href="style.css" type='text/css'>
		<title>ChatOns - Discussion</title>
	</head>
	<body>

		<header>
			<?php include('header.php'); ?>
		</header>

<?php	$profilImg = mysqli_fetch_row(mysqli_query($conn,"SELECT image FROM utilisateurs WHERE id = '".$_SESSION["id"]."'"));
		?>
		<main id="profil">
			<img src="<?php echo $profilImg[0]; ?>" alt="profilImg" id="profilPic"/>
			<form action="" method="post" enctype="multipart/form-data">
			
				<div class="inputZone">
					<label for="profilePic">Photo profil</label>
					<input type="file" name="profilPic" value="<?php echo $profilImg[0]; ?>"/>
				</div>
			
				<div class="inputZone">
					<label for="login">Login</label>
					<input type="text" name="login" value="<?php echo $_SESSION["login"]; ?>"/>
				</div>
				
				<div class="inputZone">
					<label for="password">Password</label>
					<input type="password" name="password" required/>
				</div>
				
				<div class="inputZone">
					<label for="passwordV">Confrimez Mdp</label>
					<input type="password" name="passwordV"/>
				</div>
				
				<div class="inputZone">
					<label for="nPassword">Nouveau Mdp</label>
					<input type="password" name="nPasswordV"/>
				</div>
				
				<div class="inputZone submitZone">
					<input type="submit" value="Changer" name="submitBtn"/>
					<input type="reset" value="Effacer"/>
				</div>
			
			</form>
		</main>
	</body>
	
</html>



<?php

	if(isset($_POST["submitBtn"]))
	{
		if(!empty($_POST["password"]) && !empty($_POST["passwordV"]))
		{
			if($_POST["password"] == $_POST["passwordV"])
			{
				$request = "SELECT password FROM utilisateurs WHERE id =".$_SESSION["id"];
				$query = mysqli_query($conn,$request);
				$res = mysqli_fetch_row($query);
				
				if(password_verify($_POST["password"],$res[0]))
				{
					if(strlen($_FILES["profilPic"]["name"]) != 0)
					{
						$imgPath = "ProfilPics/".basename($_FILES["profilPic"]["name"]);
						$imgType = strtolower(pathinfo($imgPath,PATHINFO_EXTENSION));
						$newName = "ProfilPics/".$_SESSION["id"].".".$imgType;
						
						if(file_exists($newName))
						{
							unlink($newName);
						}
						
						move_uploaded_file($_FILES["profilPic"]["tmp_name"], $imgPath);
						rename($imgPath,$newName);
						
						$requestImg = "UPDATE utilisateurs SET image ='".$newName."' WHERE id =".$_SESSION["id"];
						$queryImg = mysqli_query($conn,$requestImg);
					}
				
					if($_POST["login"] != $_SESSION["login"])
					{
						$requestLogin = "SELECT login FROM utilisateurs WHERE login = '".htmlspecialchars($_POST["login"])."'";
						$loginTest = mysqli_fetch_row( mysqli_query($conn, $requestLogin));
						
						if(!empty($loginTest[0]))
						{
							header("location:profil.php?error=5");
						}
						else
						{
							$_SESSION["login"] = $_POST["login"];
							$requestLogin = "UPDATE utilisateurs SET login = '".htmlspecialchars($_POST["login"])."' 
							WHERE id = '".$_SESSION["id"]."'";
							mysqli_query($conn,$requestLogin);
						}

					}
					if(!empty($_POST["nPassword"]))
					{
						$requestNPassword .= "UPDATE utilisateurs SET password = '".password_hash($_POST["nPassword"], PASSWORD_BCRYPT)."'
						WHERE id = '".$_SESSION["id"]."'";
						mysqli_query($conn,$requestNPassword);
					}
					
					header("location:profil.php");
				}
				else
				{
					header("location:profil.php?error=6");
				}
			}
			else
			{
				header("location:profil.php?error=0");
			}
		}
	}
?>