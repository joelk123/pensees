<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * Classe singleton représentant la base de donnée
 */
class Database {

    /**
     * unique instance
     * @var Database 
     */
    private static $_instance;

    /**
     * Connexion à la bdd
     * @var \PDO
     */
    private $db;

    /**
     * constructeur privé
     * 
     * @param String $hostname  nom d'hôte
     * @param String $login     login
     * @param String $password  mot de passe
     * @param String $database  nom de la base
     */
    private function __construct($hostname, $login, $password, $database) {
        try {
            $this->db = new \PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $login, $password);
        } catch (\PDOException $exc) {
            throw new Error('Erreur de connexion à la base de données : ' . $exc->getMessage());
        }
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Fabrique et/ou retourne l'unique instance de la bdd
     * 
     * @param String $hostname  nom d'hôte
     * @param String $login     login
     * @param String $password  mot de passe
     * @param String $database  nom de la base
     *
     * @return \PDO             connexion à la base de données
     * @throws Error            en cas déchec de connexion
     */
    public static function getInstance($hostname = '', $login = '', $password = '', $database = '') {
        if (self::$_instance === NULL) {
            self::$_instance = new Database($hostname, $login, $password, $database);
        }
        return self::$_instance->db;
    }

}
