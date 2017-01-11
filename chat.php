<?php

session_start();

if(isset($_SESSION) && !empty($_SESSION['prenom']) && !empty($_SESSION['nom'])){

$prenom = htmlspecialchars($_SESSION['prenom']);
$nom = htmlspecialchars($_SESSION['nom']);
}

else{

	$prenom = null;
    $nom = null;
}
	

try{
	
	$pdo = new PDO('mysql:dbname=chat;host=localhost', 'root', '');

}

catch(Exception $e){

	die('Erreur : ' . $e->getMessage());

}


?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" name="Tom" content="chat" />
        <title>chat!</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="/chat/chat.css" rel="stylesheet" >       
    </head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
<h1>RIP MSN!</h1>
</nav>
<div class="container">


<form method="post" action="traitement.php">

<label>Votre prénom:</label><input type="textarea" name="prenom" value="<?= $prenom ?>"> </br>
<label>Votre nom:</label><input type="textarea" name="nom" value="<?= $nom ?>"> </br>
<label>Votre mail:</label><input type="textarea" class="mail" name="mail"> </br>
<label>Votre message:</label><input type="textarea" class="commentaire" name="commentaire">
</br><input class="envoyer" type="submit" value="Envoyer">

</form>


<?php
$reponse = $pdo->query(' SELECT prenom,nom,commentaire,date FROM chat ORDER BY ID ');

while ($donnees = $reponse->fetch())

{

    echo '<div class="conteneur"><div class="date">' . $donnees['date'] . '</div><div class="prenom">' . htmlspecialchars($donnees['prenom']) . '</div><div class="nom">'. htmlspecialchars($donnees['nom']) . ':</div><div class="commentaire">' . htmlspecialchars($donnees['commentaire']) . '</div></div>';

}

$reponse->closeCursor();
?>
</div>
</body>
</html>