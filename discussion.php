
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

<?php   if(!isset($_SESSION["logged_in"])) 
		{?>
			<div class="greyScreen">
				<p class="err">Vous devez etre connecté pour accéder a cette partie du site<a href="connexion.php"><img src="Images/closeBtn.png"/></a></p>
			</div>
<?php	}
		else
		{
			$conn = mysqli_connect("localhost","root","","discussion");
			$request = "SELECT message, utilisateurs.login, date_format(date,\"%d\%m\%y\"), time, utilisateurs.image, messages.date FROM messages 
						INNER JOIN utilisateurs ON messages.id_utilisateur = utilisateurs.id  
						ORDER BY messages.id DESC ";
			$query = mysqli_query($conn,$request);
			$msgs = mysqli_fetch_all($query);
			$count = 0;
			
			foreach($msgs as $message=>$infos)
			{
				if($count%2 == 0)
				{?>
					<div class="bubble">
		<?php	}
				else
				{?>
					<div class="bubbleLeft">
		<?php	} ?>
					<div class="info_auteur">
						<p> <img src="<?php echo $infos[4]; ?>" alt="profilImgDisc" id="profilPicDisc"/><b><?php echo $infos[1]; ?></b> le <?php echo $infos[2]." a ".$infos[3]; ?></p>
					</div>
					<p class="msg">
						<?php echo $infos[0]; ?>
					</p>
				</div>
		<?php
				$count++;
			}
		}?>
		<main id="discussion-form">
			<form action="" method="post" >
				<textarea type="text" name="message" rows="3" cols="45" maxlength="140"></textarea>
				<input type="submit" value="Envoyer" name="sendBtn"/>
			</form>
		</main>
	</body>

</html>
		

<?php 	
	if(isset($_POST["sendBtn"]))
	{
		if(strlen($_POST["message"]) > 0)
		{
			$request = "INSERT INTO `messages` (`id`, `message`, `id_utilisateur`, `date`, `time`) VALUES (NULL, '".htmlspecialchars($_POST["message"])."',
			'".$_SESSION["id"]."', CURRENT_DATE, NOW())";
			$query = mysqli_query($conn, $request);
			header("location:discussion.php");			
		}
	}
?>



