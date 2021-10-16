<?php
session_start();
include 'inc/connect.php';
if (!isset($_SESSION['id_utilisateur'])){
header('location:index.php');
}
$nom=htmlspecialchars($_POST['nom']);
$prenom=htmlspecialchars($_POST['prenom'];
$adresse=htmlspecialchars($_POST['adresse']);
$telephone=htmlspecialchars($_POST['telephone']);
$description=htmlspecialchars($_POST['description']);

$stmt = $conn->prepare("SELECT email_utilisateur FROM utilisateur WHERE email_utilisateur = ?");
$stmt->execute(array(htmlspecialchars($_POST['courriel'])));
$result=$stmt->fetch();

if($stmt->rowCount() == 0) 
{
    $courriel=htmlspecialchars($_POST['courriel']);
    $stmt = $conn->prepare("UPDATE utilisateur
    SET
    email_utilisateur = ?
    WHERE
    id_utilisateur = ?");
    $stmt->execute(array($courriel,$_SESSION['id']));
}




$stmt = $conn->prepare("UPDATE utilisateur 
SET
    nom_utilisateur = ?,
    prenom_utilisateur = ?,
    adresse_utilisateur = ?,
    telephone_utilisateur = ?,
    description_utilisateur = ?

WHERE 
    id_utilisateur = ?"
);
$stmt->execute(array($nom,$prenom,$adresse,$telephone,$description,$_SESSION['id']));


header('location:profile.php');


?>