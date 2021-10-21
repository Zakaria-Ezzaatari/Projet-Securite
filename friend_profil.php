<?php 
include 'inc/header.php'; 
$id_utilisateur = $_SESSION['id_utilisateur'];
$friend_id=$_GET['id'];
$requete="SELECT * from utilisateur where id_utilisateur ='$friend_id' and statut_utilisateur ='1'";
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
        <u><label class="col-form-label">Photos</label></u>
        <!-- affichages des images -->
        <div style="border: solid 1px ;"  >                   
        <?php 
        $requete =mysqli_query($bdd,"SELECT * from photo where id_gallerie is null and id_utilisateur = '$friend_id'");
        $verification_amitier=mysqli_query($bdd,"SELECT * from liste_ami where id_utilisateur = '$friend_id' and id_ami='$id_utilisateur' ");
        $reponse_verification_ami=mysqli_fetch_array($verification_amitier);

        echo '<div class='."shadow d-flex flex-nowrap".'>';
            while($reponse=mysqli_fetch_array($requete)){ 
                
                if($reponse_verification_ami['id_utilisateur']==""){

                }else{
                    if($reponse['confidentialite_photo']=="Ami"){
                        echo '<img  class='."photo_gallerie".' src="data:image/jpeg;base64,'.base64_encode( $reponse['photo'] ).'"/>'; 
                    }

                }

                if($reponse['confidentialite_photo']=="Public"){
                    echo '<img  class='."photo_gallerie".' src="data:image/jpeg;base64,'.base64_encode( $reponse['photo'] ).'"/>'; 
                }
                               
            } 
        echo '</div>';                                              
        ?>
        </div>
        <!-- Fin de l'affichage des images-->
       
           
        
       
    </div>

    






</div>




<?php include 'inc/footer.php'; ?>