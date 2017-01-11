<?php
session_start();

try{
	$pdo = new PDO('mysql:dbname=chat;host=localhost', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

if(isset($_POST) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['commentaire'])){

$req = $pdo->prepare('INSERT INTO chat (prenom,nom,mail,commentaire) VALUES(?, ?,?,?)');
$req->execute(array($_POST['prenom'], $_POST['nom'],$_POST['mail'],$_POST['commentaire']));

$prenom = htmlspecialchars($_POST['prenom']);
$commentaire = htmlspecialchars($_POST['commentaire']);

mail("thomas.roche1987@laposte.net","$prenom", "$commentaire");

}
else{
	echo "Il est nécessaire de compléter tous les champs pour continuer!";
	echo "<meta http-equiv='Refresh' content='5;URL=chat.php'>";
	}

if(!empty($_POST['prenom']) && !empty($_POST['nom'])){

$_SESSION['prenom'] = $_POST['prenom'];
$_SESSION['nom'] = $_POST['nom'];

}

header('Location: chat.php');