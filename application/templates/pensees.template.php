<?php
    defined('__PENSEES__') or die('Acces interdits');
    
    $currentAction = \F3il\Application::getCurrentAction();    
    $accueilActive = ($currentAction == 'index') ? ' class="active" ' : '';
    $nouvelleActive = ($currentAction == 'creer') ? ' class="active" ' : '';
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pensées du jour</title>
        <meta charset="utf-8">
        <link href="library/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-inverse">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li <?php echo $accueilActive;?>><a href="?controller=pensees&action=index">Accueil</a></li>
                    <li <?php echo $nouvelleActive;?>><a href="?controller=pensees&action=creer">Nouvelle</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">            
            <h1>Les pensées du jour</h1>
            <div>                
                <?php $this->insertView(); ?>
            </div>        
        </div>
        <script src="library/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="library/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>

