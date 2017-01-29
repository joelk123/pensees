<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * Fonctions pour passer des messages entre deux pages
 */
abstract class Messenger {

    const SESSION_KEY = 'f3il.messenger';

    /**
     * Insère un message
     * 
     * @param String $message
     */
    public static function setMessage($message) {
        $_SESSION[self::SESSION_KEY] = htmlspecialchars($message);
    }
    /**
     * Vérifie l'existance d'un message
     * 
     * @return boolean
     */
    public static function hasMessage() {
        return isset($_SESSION[self::SESSION_KEY]);
    }
    /**
     * Retourne et supprime le message
     * 
     * @return String
     */
    public static function getMessage() {
        $msg = $_SESSION[self::SESSION_KEY];
        unset($_SESSION[self::SESSION_KEY]);
        return $msg;
    }

}
