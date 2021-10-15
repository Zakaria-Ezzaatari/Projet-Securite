<?php
    include 'inc/header.php'; 
    include 'inc/connect.php';
    session_start();
    if (!isset($_SESSION['id'])){
    header('location:index.php');
    }

?>

<div class="container homeContainer">
    <h1>Modifier Profile</h1>
    <div class='profile'>
        <form action="inserer_profile.php" method="POST">
        <?php
            include 'inc/connect.php';
            $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
            $stmt->execute(array($_SESSION['id']));
            $result=$stmt->fetch();
            echo "<table class='table table-bordered'>";
            echo "<tbody>";
            echo " <tr><td>Nom:   </td><td><input class='form-control' name='nom' id='nom' value=".$result['nom_utilisateur']."></td></tr>";
            echo " <tr><td>Prenom:  </td><td><input class='form-control' name='prenom' id='prenom' value=".$result['prenom_utilisateur']."></td></tr>";
            echo " <tr><td>Adresse:  </td><td><input class='form-control' name='adresse' id='adresse' value=".$result['adresse_utilisateur']."></td></tr>";
            echo " <tr><td>Numéro de téléphone </td><td><input class='form-control' name='telephone' id='telephone' value=".$result['telephone_utilisateur']."></td></tr>";
            echo " <tr><td>Adresse de courriel </td><td><input class='form-control' name='courriel' id='courriel' value=".$result['email_utilisateur']."></td></tr>";
            echo " <tr><td>Description: </td><td><textarea class='form-control' name='description' id='description' rows='8' columns='20'>".$result['description_utilisateur']."</textarea></td></tr>";
            echo "</tbody>";
            echo "</table>";      
            
        ?>
        <input type="submit" value="Confirmer Modification Profil" class="btn btn-primary" role="button">
        </form>
    </div>
</div>


<?php include 'inc/footer.php'; ?>