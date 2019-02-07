<?php
include('script.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Livraison</title>
    <link rel="stylesheet" href="style.css">
    <script language="javascript" type="text/javascript">
    window.history.forward();
    </script>
</head>
<body>

        <?php
            
            
            //Tentative de connexion à la base de données.
            $connection = new PDO('mysql:host=127.0.0.1;dbname=Dbpizza;charset=utf8', 'userxx', '123');

            //Écriture de la requête SQL.
            $sql = mysqli_query($connection, "SELECT numéroLivraison FROM Livraison WHERE refLivreur IS NULL");
            //Si la requête est valide alors la boucle s'exécute.
            if($sql){
                //Lecture des données tant qu'il y en a puis stockage dans un tableau.
                while($row = mysqli_fetch_array($sql)) {
                    $livraisons[] = $row['numéroLivraison'];
                }
            }
            //Si la requête échoue, un message s'affiche.
            else{
                $message = '<div class="errorMessage"> <p>Erreur : le serveur n\'a pas répondu.</p></div>';
            }
        ?>

        <div class="container">
        <form action="" method="GET">
            <label> ID de la livraison : </label>
            <input name="numéroLivraison" type="text" required placeholder="ID de la livraison" oninvalid="this.setCustomValidity('ID de livraison non renseigné')"
            oninput="this.setCustomValidity('')" value=
                
            <?php
                //Affichage de la première valeur du tableau dans le champ ID livraison.
                if(!empty($livraisons)) {
                    $tableau = array_values($livraisons)[0];
                    echo $tableau; 
                //Si le tableau est vide, le message suivant s'affiche dans le champ ID livraison.
                } else {
                    echo "Aucune";
                }
            ?>
            readonly>

            <label> Liste des livreurs </label>
            <?php
                //Tentative de connexion à la base de données.
                $connection = new PDO('mysql:host=127.0.0.1;dbname=Dbpizza;charset=utf8', 'userxx', '123');
                //Écriture de la requête SQL. 
                $sql = mysqli_query($connection, "SELECT telLivreur, prenomLivreur FROM Livreur");
                //Création de la liste déroulante.
                echo '<select name="telLivreur" required placeholder>';
                //Si la requête est valide alors la boucle s'exécute.
                if($sql){
                    //Lecture des données puis affichage des données récupérées dans la liste déroulante.
                    while($row = mysqli_fetch_array($sql)) {
                        echo '<td style=color:#404040;> <option value='.$row['telLivreur'].'>'.$row['nomLivreur'].'</option>';
                    }
                }
                //Si la requête échoue, un message s'affiche.
                else{
                    $message = '<div class="errorMessage"> <p>Erreur : le serveur n\'a pas répondu.</p></div>';
                }
                echo '</select>';
            ?>
            <div class="container2"><input name="submit" type="submit" value="Valider"></div>
            <span><?php echo $message; ?></span>
        </form>
        </div>
</div>
</body>
</html>





</body>
</html>