<?php 
include 'inc/header.php'; 
$id_utilisateur = $_SESSION['id_utilisateur'];

?>


<div class="container" >
    <button type="button" onclick="Function_affichage_images()" class="btn btn-primary" >
        Vos photos
    </button>
    <button type="button" onclick="Function_affichage_album()" class="btn btn-primary" >
        Vos albums
    </button>
    <br><br>
    
</div>
<div class="container">
    <div id="images" >
        <!-- Bouton pour Afficher le modal-->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
            Ajouter une image
        </button>
        <!-- Fin du bouton -->
        <br>
        <br>
        <!-- Traitement pour l'ajout d'une image -->
        <?php
                if (isset($_POST['valider'])){
                    
                    $id_utilisateur=$_SESSION['id_utilisateur'];
                    $privilege=mysqli_real_escape_string($bdd,$_POST['privilege']);
                    $taille_maxi = 1000000;
                    $extensions = array('.png', '.jpg', '.jpeg','.PNG', '.JPG', '.JPEG');
                    $fichier="metaimage.jpg";
                    if($privilege==""){
                        $errors[]='Veuillez remplir tous les champs.';
                    }

                            
                    if(!empty(basename($_FILES['photo_img']['name']))){
                    $fichier = basename($_FILES['photo_img']['name']);
                    
                    $taille=$_FILES['photo_img']['size'];        
                    
                    $extension = strrchr($_FILES['photo_img']['name'], '.');
                    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                    {
                    $errors[]='Votre photo doit etre de type png,  jpg, jpeg';
                    }
                    if($taille>$taille_maxi)
                    {
                    $errors[]="La taille de votre photo doit etre inférieur ou égale à 1 mo";
                    }
                    if ($photo  = $_FILES['photo_img']['tmp_name'] )            
                    {
                    $photo_img=addslashes(file_get_contents($photo));
                    }else{
                        $errors[]="Votre photo n'a pas pu être télécharger !";    
                    }

                    }else{
                        $errors[]="Aucune image n'a été sélestionnée !";
                    }

                    if (!empty($errors)){

                        foreach($errors as $error){
                            ?>
                            <script>
                                var img = document.getElementById("images");
                                img.style.display = "block";
                            </script>
                            <?php 
                                             
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                            echo "<strong>Erreur! </strong>".$error;
                            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                            echo "</div>";                            
                        }

                    }else{
                        $requete="Insert into photo(photo, date_ajout_photo, id_utilisateur, confidentialite_photo) values ('$photo_img',now(),'$id_utilisateur', '$privilege')";
                        if(mysqli_query($bdd,$requete)){

                            ?>
                            <script > 
                            swal({
                                title: "Ajout d'une photo.",
                                text: "Ajout éffectué avec succès. " ,
                                icon: "success",
                                button: "OK",
                                }).then(function(){
                                    window.location="gallerie.php";
                                    });
                            </script>
                            <?php

                        }else{
                            ?>
                            <script > 
                            swal({
                                title: "Ajout d'une photo.",
                                text: "Erreur lors de l'ajout de la photo. " ,
                                icon: "error",
                                button: "OK",
                                }).then(function(){
                                    window.location="gallerie.php";
                                    });
                            </script>
                            <?php
                        }
                    }


                }
        ?>
        <!-- Fin du traitement pour l'ajout d'une image -->
        <!-- affichages des images -->
        <div style="border: solid 1px ;"  >                   
                <?php 
                $requete =mysqli_query($bdd,"SELECT * from photo where id_gallerie is null and id_utilisateur = '$id_utilisateur'");
                echo '<div class='."shadow d-flex flex-nowrap".'>';
                    while($reponse=mysqli_fetch_array($requete)){                
                        echo '<img  class='."photo_gallerie".' src="data:image/jpeg;base64,'.base64_encode( $reponse['photo'] ).'"/>';                
                    } 
                echo '</div>';                                              
                ?>
        </div>
        <!-- Fin de l'affichage des images-->
        <br>
            
        <!-- debut modal pour l'ajout d'une image -->        
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modification de la photo de profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <input type="file" class="form-control" name="photo_img" >                                
                            </div>
                            <br>
                            <div class="form-group">
                                <select name="privilege" class="form-control" id="" required>
                                    <option value="">-----------------</option>
                                    <option value="Public">Public</option>
                                    <option value="Privée">Privée</option>
                                    <option value="Ami">Ami</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn col-md-12  btn-primary" name="valider" id="btn-login">
                                    ENREGISTRER
                                </button> 
                            </div>
                            

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>                    
                    </div>
                </div>
            </div>
        </div>
        <!-- fin modal-->

    </div>
   
    <div  id="album" >                   
        <div>

        </div>        
    </div>
</div>


<script>
    
 function Function_affichage_images() {
    var y = document.getElementById("album");
    var x = document.getElementById("images");  
   
    y.style.display = "none";
  
    x.style.display = "block";
  
}

function Function_affichage_album() {
    var y = document.getElementById("images");
    var x = document.getElementById("album");  

    y.style.display = "none";
  
    x.style.display = "block";
  
}
</script>

<?php include 'inc/footer.php'; ?>