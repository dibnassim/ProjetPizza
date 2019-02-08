<?php
$message = '';

// Condition : Si le champ de texte ID de livraison contient un chiffre 
// et que la variable bouton est non NULL alors le code suivant est exécuté :
if(isset($_GET['submit']) && $_GET['idLivraison'] != "Aucune" )
{
        //Déclaration et assignation des variables suivantes :
        $idLivraison = $_GET['idLivraison'];
        $telLivreur = $_GET['telLivreur'];

        //Déclaration et assignation de la chaîne de connexion.
        $db_host     = "sl-eu-gb-p02.dblayer.com";
        $db_username = "admin";
        $db_password = "NPHBWPATUXNHFCQK";   
        $db_name = "pizza"; 
        $db_port = "17329";

        //Tentative de connexion à la base de données.
        $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name, $db_port);
        if (!$connection) {
            $message = '<div class="errorMessage"> <p>Connexion avec le serveur distant impossible</p></div>';
        }
        //Écriture de la requête SQL préparée 
        $sql = $connection->prepare("UPDATE Livraison SET refTelLivreur='$telLivreur' WHERE idLivraison=$idLivraison");
        //Si la requête est valide alors elle est exécutée.
        if ($sql) {
            $sql->execute();
            $message = '<div class="errorMessage"> <p>Livraison n°'.$idLivraison. ' réservée avec succès.</p></div>';
        //Sinon, un message d'erreur s'affiche.
        } else {
            $message = '<div class="errorMessage"> <p>Erreur de réservation. </p></div>';
        }

        mysqli_close($connection);
    }
    // Sinon si aucune livraison n'est disponnible et que le champ de texte ID livraison
    // affiche "Aucune", alors la requête n'est pas exécutée et le message suivant s'affiche.
    else if ($_GET['idLivraison'] == "Aucune") {
        $message = '<div class="errorMessage"> <p>Aucune livraison à effectuer.</p></div>';
    }

?>