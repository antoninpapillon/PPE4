<?php

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