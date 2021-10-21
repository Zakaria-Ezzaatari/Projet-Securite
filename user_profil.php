<?php 
include 'inc/header.php'; 
$id_utilisateur = $_SESSION['id_utilisateur'];
$requete="SELECT adresse_utilisateur, mot_de_passe_utilisateur, nom_utilisateur, prenom_utilisateur, login_utilisateur, telephone_utilisateur, email_utilisateur, description_utilisateur, photo_profil from utilisateur where id_utilisateur ='$id_utilisateur'";
$query=mysqli_query($bdd,$requete);
//echo mysqli_error($bdd);
$reponse=mysqli_fetch_array($query); 


?>

<div class="container" >
      
        <div class="row">
            <div class="col col-md-4">
                <?php  
                if ($reponse['photo_profil']==""){
                    ?> <img id="profil_img" src="public/images/user.jpg" alt=""> <?php
                }else{
                    echo '<img id='."profil_img".' src="data:image/jpeg;base64,'.base64_encode( $reponse['photo_profil'] ).'"/>'; 
                    }
                ?> 
                
                <br>
                
                
            </div>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><u>Nom:</u></td>
                            <td><?php echo @$reponse['nom_utilisateur']; ?></td>
                        </tr>
                        <tr>
                            <td><u>Prénom:</u></td>
                            <td><?php echo @$reponse['prenom_utilisateur']; ?></td>
                        </tr>
                        <tr>
                            <td><u>Email:</u></td>
                            <td><?php echo @$reponse['email_utilisateur']; ?></td>
                        </tr>
                        <tr>
                            <td><u>Tel:</u></td>
                            <td><?php echo @$reponse['telephone_utilisateur']; ?></td>
                        </tr>
                        <tr>
                            <td><u>Adresse:</u></td>
                            <td><?php echo @$reponse['adresse_utilisateur']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <u><label class="col-form-label">Description</label></u>

        <div class=" card container-fluid">
            
            <p class="text-break">
                <?php echo $reponse['description_utilisateur']; ?>
            </p> 
        </div> 
        <br>
        <center>
            <a href="update_user_profil.php"  class="btn btn-primary " >
            Modifier les information du profil
            </a>
        </center>
           
        
       
    </div>

    






</div>




<?php include 'inc/footer.php'; ?>