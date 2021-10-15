<?php
session_start();
include 'inc/connect.php';
if (!isset($_SESSION['id'])){
header('location:index.php');
}
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$adresse=$_POST['adresse'];
$telephone=$_POST['telephone'];
$description=$_POST['description'];

$stmt = $conn->prepare("SELECT email_utilisateur FROM utilisateur WHERE email_utilisateur = ?");
$stmt->execute(array($_POST['courriel']));
$result=$stmt->fetch();

if($stmt->rowCount() == 0) 
{
    $courriel=$_POST['courriel'];
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