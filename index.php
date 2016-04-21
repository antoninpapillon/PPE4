<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

    <title>Index</title>
    
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/bootsrap/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="assets/bootsrap/css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/bootsrap/css/creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        
    </head>
    
    <?php
//if(isset($_POST['dateDebut'])){
//    $dateDebut = $_POST['dateDebut'];
//    echo $dateDebut;
//} else {
//    echo 'Bonjour';
//} ?>

    
    <body>
        <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Index</h1>
                <hr>
                <p>Plateforme interne de l'entreprise</p>
                <a href="pdf.php" class="btn btn-primary btn-xl page-scroll">Fiche d'autorisation d'absence</a><br><br><br>
                <a href="liste.php" class="btn btn-primary btn-xl page-scroll">Liste des autorisation (responsable seulement)</a>
            </div>
        </div>
        </header>
        
<!--        <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    
                        <form method="post" action="index.php"> 
                        <h2 class="section-heading">Formulaire</h2>
                        <hr class="light">
                        
                        <div class="col-lg-6 col-md-6 text-center">
                            <p class="text-faded">Date de début</p>
                            <input type="text" class="form-control" id="dateDebut" name="dateDebut" /><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 text-center">
                            <p class="text-faded">Date de fin</p>
                            <input type="text" class="form-control" id="dateFin"/><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <p>Nom de famille</p>
                            <input type="text" class="form-control" id="nom"/><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <p>Raison de l'absence </p>
                            <input type="text" class="form-control" id="raison"/><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <button type="submit" class="btn btn-default btn-xl"><a>Valider !</a></button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        </section>-->
        
        <!-- jQuery -->
    <script src="assets/bootsrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/bootsrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="assets/bootsrap/js/jquery.easing.min.js"></script>
    <script src="assets/bootsrap/js/jquery.fittext.js"></script>
    <script src="assets/bootsrap/js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/bootsrap/js/creative.js"></script>

    </body>
</html>
