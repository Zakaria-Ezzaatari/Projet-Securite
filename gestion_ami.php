<?php
session_start();
include "inc/connect.php";
if (!isset($_SESSION['id'])){
header('location:index.php');
}
$stmt = $conn->prepare("SELECT id_utilisateur FROM utilisateur WHERE email_utilisateur = ?");
$stmt->execute(array($_POST['email']));
$result=$stmt->fetch();
if($stmt->rowCount() !== 0) 
{
    $idAmi=$result['id_utilisateur'];
}

$idUser=$_SESSION['id'];


if (($_POST['gestion_ami']=='ajouter') && (isset($idAmi)))
{
    $stmt = $conn->prepare("INSERT INTO liste_damis (id_utilisateur,id_ami) VALUES(?,?)");
    $stmt->execute(array($idUser,$idAmi));
    
}

else if (($_POST['gestion_ami']=='supprimer') && (isset($idAmi)))
{
    $stmt = $conn->prepare("DELETE FROM liste_damis WHERE id_utilisateur=? AND id_ami=?");
    $stmt->execute(array($idUser,$idAmi));
}

header('location:profile.php');
