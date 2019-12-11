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
		
		<main>
			<article id="presentation">
				<p class='title'> ChatOns ? Késako ! </p>

				<div id='description'>
				
					<p id='definition'>
						<b>ChatOns</b> <i>(Application)</i> <b>1.a</b><br/>
						/ʃatɔn/ 
					</p>
					
					<p id='arguments'>
					  Accessible sur moblie (mais n'essayez pas, on est pas setup pour l'instant).
					  <i><u>Ex</u></i>: Plus d'1 Million d'émojis.<br/>Un design modifiable sur demande en un click.
					  <br/>Aide une IA a comprendre le langage.<br/>
					  <b style="margin-left:-25px;">1.b</b> De nouvelles features très bientot en place et
					  plus de <?php echo'NOMBRE_UTILISATEURS'; ?> utilisateurs chez vous !
				  </p>
				
				</div>

				<div id="inscriptionBtn">
				
					<?php if(!isset($_SESSION["logged_in"])) {?>
						<a href="inscription.php">Inscription</a>
						<a href="connexion.php">Connexion</a>
					<?php } else { ?>
						<a href="discussion.php">Discussion</a>
						<a href="profil.php">Profil</a>
						<a href="index.php?deco=true">Déconnexion</a>
					<?php } ?>
				
				</div>
				
			</article>
			
		</main>
	</body>

</html>