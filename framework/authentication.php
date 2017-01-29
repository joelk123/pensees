<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * 
 * 
 */
class Authentication {

    protected $user;

    /**
     *
     * @var AuthenticationDelegate 
     */
    protected $authModel;
    private static $_instance;

    const SESSION_KEY = 'f3il.authentication';

    private function __construct(AuthenticationDelegate $authModel) {
        $this->authModel = $authModel;
    }

    public static function getInstance(AuthenticationDelegate $authModel = NULL) {
        if (self::$_instance === NULL) {
            if ($authModel === NULL) {
                throw new Error("le modèle d'authentification doit être renseigné");
            }
            self::$_instance = new Authentication($authModel);
        }
        self::$_instance->loadUserData();
        return self::$_instance;
    }

    /**
     * Méthode de hachage des mots de passes
     * 
     * @param string $password
     * @param string $salt
     * @return string
     */
    public static function hash($password, $salt) {
        return hash('sha256', hash('sha256', $salt) . $password);
    }

    /**
     * Méthode de vérification de l'identité
     *
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public static function login($login, $password) {
        $saltCol = self::$_instance->authModel->auth_getSaltColumn();
        $passwordCol = self::$_instance->authModel->auth_getPasswordColumn();
        $idCol = self::$_instance->authModel->auth_getIdColumn();
        $user = self::$_instance->authModel->auth_getUserByLogin($login);
        if (self::hash($password, $user[$saltCol]) !== $user[$passwordCol]) {
            return FALSE;
        }
        $_SESSION[self::SESSION_KEY] = $user[$idCol];
        return TRUE;
    }

    /**
     * Charge les données de l'utilisateur
     * 
     * @return array
     */
    public function loadUserData() {
        $userId = Request::session(self::SESSION_KEY);
        if ($userId === NULL) {
            return;
        }
        $this->user = $this->authModel->auth_getUserById($userId);
    }

    /**
     * Déconnecte l'utilisateur
     */
    public static function logout() {
        self::$_instance->user = null;
        unset($_SESSION[self::SESSION_KEY]);
    }

    /**
     * Vérifie si l'utilisateur est connecté
     * 
     * @return boolean
     */
    public static function isAuthenticated() {
        return self::$_instance->user !== NULL;
    }

    /**
     * retourne les donées de l'utilisateur courant
     * 
     * @return array
     */
    public static function getUserData() {
        return self::$_instance->user;
    }

    /**
     * Retourne l'id de l'utlisateur courant
     * 
     * @return int
     */
    public static function getUserId() {
        $idCol = self::$_instance->authModel->auth_getIdColumn();
        return self::$_instance->user[$idCol];
    }

}
