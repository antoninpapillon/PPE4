<?php

require('connexion.php');

if (isset($_SERVER['REQUEST_URI'])) {
    $generate = isset($_GET['make_pdf']);
    $nom = isset($_GET['nom']) ? $_GET['nom'] : '';
    $prenom = isset($_GET['prenom']) ? $_GET['prenom'] : '';
    $dateDebut = isset($_GET['dateDebut']) ? $_GET['dateDebut'] : '';
    $dateFin = isset($_GET['dateFin']) ? $_GET['dateFin'] : '';
    $motif = isset($_GET['motif']) ? $_GET['motif'] : '';
} else {
    $generate = true;
    $nom = '';
}

$mail = 'antonin.papillon@bts-malraux.net';

//Prévention des éventuels problème lié aux retours à la ligne selon le serveur.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}

$message_txt = "TEST MICRO UN DEUX TROIS";

$boundary = "-----=".md5(rand());

$sujet = "Hey mon ami !";

$header = "From: \"AUTO_PDF\"<antonin.papillon@bts-malraux.net>".$passage_ligne;
$header .= "Reply-to: \"AUTO_PDF\" <antonin.papillon@bts-malraux.net>".$passage_ligne;
$header .= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

$message = $passage_ligne."--".$boundary.$passage_ligne;

$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;

$message.= $passage_ligne."--".$boundary.$passage_ligne;

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

//mail($mail,$sujet,$message,$header);

//Préparation de la requête SQL
$req = $bdd->prepare('INSERT INTO autorisation(nomSal, prenomSal, dateDebut, dateFin, motif) '
        . 'VALUES(:nomSal, :prenomSal, :dateDebut, :dateFin, :motif)') 
        or exit(print_r($bdd->errorInfo()));



//Ce qui va être affiché dans le PDF
$pdf = 
'<style>
    h1 {
        text-align: center;
    }
    
    .align1 {
        float: left;
    }
    
    .align2 {
        margin-left: 50px;
    }
    
    .signatureRes {
        margin-left: 400px;
    }
    
    .image {
        display: block;
        margin-left: 100px;
        margin-right: auto;
        width: 500px;
	height: 200px;
    }
    
</style>

<img src="assets/img/Fyctive.jpg" class="image"/>
<br><br>
<h1>Autorisation d\'absence</h1>
<br><br>
<h2>Salarié</h2>
<br>
<p><span class="align1">Nom : '.$nom.'</span><span class="align2">Prénom : '.$prenom.'</span></p>
<br><br>
<h2>Dates</h2>
<br>
<p><span class="align1">Date de début : '.$dateDebut.'</span><span class="align2">Date de Fin : '.$dateFin.'</span></p>
<br><br>
<h2>Motif</h2>
<br>
<p>'.$motif.'</p>
<br><br>
<h2>Signatures</h2>
<br>
<p><span class="align1">Signature salarié : </span><span class="signatureRes">Signature resonsable : </span></p>

';

if ($generate) {
    //Exécution de la requête SQL
$req->execute(array(
    'nomSal' => $nom,
    'prenomSal' => $prenom,
    'dateDebut' => $dateDebut,
    'dateFin' => $dateFin,
    'motif' => $motif
));
    ob_start();
} 
else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <title>Exemple d'auto génération de PDF</title>
    </head>
    <body>
<?php
}
?>
        <form method="get" action="">
            <input type="hidden" name="make_pdf" value="">
            Ton nom : <input type="text" name="nom" value="">
            Prénom : <input type="text" name="prenom" value="">
            <br><br>
            Date de début : <input type="text" name="dateDebut" value="">
            Date de fin : <input type="text" name="dateFin" value="">
            <br><br>
            Motif : <input type="text" name="motif" value="">
            <br><br>
            <input type="submit" value="Generer le PDF" >
        </form>
    </body>
</html>

<?php
    if ($generate) {
        $content = ob_get_clean();
        require_once(dirname(__FILE__).'/assets/vendor/autoload.php');
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->writeHTML($pdf);
            $html2pdf->Output('absence.pdf');
            exit;
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
?>