<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * Singleton représantant la configuration de l'application 
 * depuis un fichier ini 
 */
class Configuration {

    /**
     * unique instance
     * @var Configuration
     */
    private static $_instance = NULL;

    /**
     * Tableau des propriété du fichier ini
     * @var Array
     */
    private $data;

    /**
     * Constructeur privé (singleton)
     * 
     * @param string $fichierIni : chemin du fichier ini
     * 
     */
    private function __construct($fichierIni) {
        if (!is_readable($fichierIni)) {
            throw new Error("fichier ini inrouvable : $fichierIni");
        }
        $data = parse_ini_file($fichierIni);
        if (!$data) {
            throw new Error("fichier de configuration invalide : $fichierIni");
        }
        $this->data = $data;
    }

    /**
     * Crée ou récupere l'unique instance de configuration
     * 
     * @param string $fichierIni : chemin du fichier ini
     * @return configuration
     */
    public static function getIinstance($fichierIni = '') {
        if (self::$_instance === NULL) {
            self::$_instance = new self($fichierIni);
        }
        return self::$_instance;
    }

    /**
     * Méthode magique pour la lecture d'une propriété
     * 
     * @param string $name
     * @return string
     */
    public function __get($name) {
        if (!isset($this->data[$name])) {
            throw new error("propriété inconnue : $name");
        }
        return $this->data[$name];
    }

}
