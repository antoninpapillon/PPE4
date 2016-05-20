<?php

session_start();
require('connexion.php');

function Messager($titre, $description) {
    $_SESSION['titre_message'] = $titre;
    $_SESSION['description_message'] = $description;
    header("Location: message.php");
    
     $to      = 'salarieppe4@yopmail.com';
     $subject = 'Votre demande d\'autorisation d\'absence';
     $message = 'Bonjour !
         Je vous informe que votre demande d\'autorisation d\'absence à été validée.
         Vous pouvez maintenant imprimer et apporter votre demande en version papier à votre supérieur.
         
         Bonne journée';
     $headers = 'From: no-reply@fyctive.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $message, $headers);
}

if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idAuto'])) {
        $idAuto = $_POST['idAuto'];
        $verif = $bdd->query('SELECT verif FROM autorisation WHERE id=' . $idAuto . '')->fetch()[0];

        if ($idAuto > 0 && $verif == 0) {
            $req = $bdd->prepare('UPDATE autorisation SET verif = 1 WHERE id=' . $idAuto . '');
            $req->execute();

            // gestion des sorties
            Messager("AUTORISATION VALIDÉE !", "Un email à été envoyé, la version papier va arriver.");
        } else {
            Messager("AUTORISATION DÉJÀ VALIDÉE", "On ne peut valider une autorisation qu'une seule fois");
        }
    } else {
        Messager("ERREUR", "Le formulaire n'a pas envoyé la variable idAuto");
    }
} else {
    Messager("ERREUR", "Le traitement ne peut se faire qu'en POST");
}
?>
