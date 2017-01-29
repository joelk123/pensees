<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * Classe de base de gestion des erreurs de l'application
 */
class Error extends \Exception {

    /**
     * Construit une Erreur avec un message
     * 
     * @param String $message  message d'erreur
     */
    public function __construct($message) {
        parent::__construct($message);
    }

    /**
     * Méthode d'affichage de l'erreur
     * 
     * @return String
     */
    public function render() {
        require_once __DIR__ . '/error/error_debug.php';
        return '';
    }

    /**
     * Méthode magique de conversion en chaine,
     * utilisée pour l'affichage de l'erreur.
     * Met fin à l'execution avec die().
     */
    public function __toString() {
        $conf = Application::getConfig();
        $prod = TRUE;
        if ($conf !== NULL) {
            $prod = $conf->debugMode === 'production';
        }
        if ($prod) {
            readfile(__DIR__ . '/error/error_prod.php');
        } else {
            echo $this->render();
        }
        die();
    }

}
