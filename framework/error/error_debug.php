<?php
    defined('__F3IL__') or die('Acces interdit'.__FILE__);    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Erreur dans l'application</title>
        <meta charset='utf-8'>
    </head>
    <body>
        <?php require 'error_base.php'; ?>
        <hr>
        <h3>GET data</h3>
        <pre><?php print_r($_GET); ?></pre>
        <h3>POST data</h3>
        <pre><?php print_r($_POST); ?></pre>
    </body>
</html>

