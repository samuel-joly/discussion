<?php 
	session_start(); 
	if(isset($_SESSION["logged_in"]))
	{
		if(isset($_GET["deco"]))
		{
			if(!isset($_SESSION["BLOCK"]))
			{
				session_destroy();
				header("location:index.php");
			}
		}
	}
	
	if(isset($_SESSION["BLOCK"]))
	{
		if(time() - $_SESSION["BLOCK"] >= 60)
		{
			unset($_SESSION["BLOCK"]);
			header("location:connexion.php");
		}?>
		<div class="greyScreen">
			<p class="err"> Vous etes bloqué pour 60 secondes, désolé les correcteurs  :'(</p>
		</div>
<?php
	}
	
	if(isset($_GET["error"]))
	{
		if($_GET["error"] == 0)
		{?>
			<div class="greyScreen">
				<p class="err">Les mots de passes ne correspondent pas <a href="inscription.php"><img src="Images/closeBtn.png"/></a></p>
			</div>
<?php
		}
		else if($_GET["error"] == 1)
		{?>
			<div class="greyScreen">
				<p class="err">Login déja pris <a href="inscription.php"><img src="Images/closeBtn.png"/></a></p>	
			</div>
<?php
		}
		else if($_GET['error'] == 2)
		{?>
			<div class="greyScreen">
				<p class="err"> Mauvais login ou mot de passe <br/><b><?php echo $_SESSION["try"]; ?> essaies restants</b>
				<a href="connexion.php"><img src="Images/closeBtn.png"/></a></p>
			</div>
<?php	
		}
		else if($_GET['error'] == 3)
		{?>
			<div class="greyScreen">
				<p class="err">Vous etes déja inscrit<a href="index.php"><img src="Images/closeBtn.png"/></a></p>	
			</div>
<?php	}
		else if($_GET["error"] == 4)
		{ ?>
			<div class="greyScreen">
				<p class="err">Photo non conforme<a href="profil.php"><img src="Images/closeBtn.png"/></a></p>	
			</div>
<?php 	}
		else if($_GET["error"] == 5)
		{ ?>
			<div class="greyScreen">
				<p class="err">Login déja pris <a href="profil.php"><img src="Images/closeBtn.png"/></a></p>	
			</div>
<?php	}
		else if($_GET["error"] == 6)
		{ ?>
			<div class="greyScreen">
				<p class="err"> Mauvais mot de passe <a href="connexion.php"><img src="Images/closeBtn.png"/></a></p>
			</div>
<?php	}
	}
?>


<ul>
	<li>
		<a href="index.php"><img src="Images/logo.png"></a>
	</li>
	
	<li>
		<a href="index.php">Accueil</a>
	</li>				
	
	<li>
		<a href="discussion.php">Discussion</a>
	</li>
	
	<?php if(isset($_SESSION['logged_in'])) { ?>
		<li>
			<a href="profil.php">Profil</a>
		</li>
		
		<li>
			<a href="index.php?deco=true">Déconnexion</a>
		</li>
	<?php }else {?>
	
		<li>
			<a href="inscription.php">Inscription</a>
		</li>

		<li>
			<a href="connexion.php">Connexion</a>
		</li>
	<?php } ?>
</ul>
