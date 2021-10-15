<?php
    include 'inc/header.php'; 
    include 'inc/connect.php';
    session_start();
    $_SESSION['id']=1;
    if (!isset($_SESSION['id'])){
    header('location:index.php');
    }

?>

<div class="container homeContainer">
    
    <?php
        include 'inc/connect.php';
        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
        $stmt->execute(array($_SESSION['id']));
        $result=$stmt->fetch();
    ?>
        <h1>Profile </h1>
        <div class='profile'>
        <table class='table table-bordered'>
        <tbody>
        <tr><td>Nom: </td><td> <?php echo $result['nom_utilisateur']?></td></tr>
        <tr><td>Prenom:  </td><td><?php echo $result['prenom_utilisateur']?></td></tr>
        <tr><td>Adresse:  </td><td><?php echo $result['adresse_utilisateur']?></td></tr>
        <tr><td>Numéro de téléphone:  </td><td><?php echo $result['telephone_utilisateur']?></td></tr>
        <tr><td>Adresse de courriel:  </td><td><?php echo $result['email_utilisateur']?></td></tr>
        <tr><td>Description:  </td><td><?php echo $result['description_utilisateur']?></td></tr>
        </tbody>
        </table>
        <a class="btn btn-primary" href ='modifier_profile.php' role="button">Modifier Profil</a>
    </div>
        
        
        
    
    <div class='liste_amis'>
        <?php

            
            $idUser=$_SESSION['id'];

            $stmt = $conn->prepare("SELECT id_ami FROM liste_damis WHERE id_utilisateur = ?");
            $stmt->execute(array($idUser));
            $result=$stmt->fetchAll();

            foreach($result as $ami)
            {
                $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
                $stmt->execute(array($ami['id_ami']));
                $res=$stmt->fetch();
            
                echo "<div class='ami'>";
                    
                    echo "<table class='table table-bordered'>";
                    echo "<tbody>";
                    echo " <tr><td>Nom: </td><td> ".$res['nom_utilisateur']."</td></tr>";
                    echo " <tr><td>Prenom: </td><td> ".$res['prenom_utilisateur']."</td></tr>";
                    echo " <tr><td>Adresse de courriel: </td><td>".$res['email_utilisateur']."</td></tr>";
                    echo " <tr><td>Description: </td><td>".$res['description_utilisateur']."</td></tr>"; 
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
            }

        ?>
        
    </div>

    <form action="gestion_ami.php" method="POST">
        <label for="email">Ajouter/Supprimer un ami</label>
        <input type="email" class="form-control" name="email" id="email">
        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="gestion_ami">
            <option value="ajouter"  selected="selected">Ajouter ami</option>
            <option value="supprimer">Supprimer ami</option>
     
        </select>
        <input type="submit" value="Confirmer Ami" class="btn btn-primary" role="button">
    </form>
</div>


<?php include 'inc/footer.php'; ?>