<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * Classe représéntant l'application Web
 * Contrôleur frontal
 */
class Application {

    /**
     * unique instance
     * @var Application
     */
    private static $_instance = null;

    /**
     * configuration de l'application
     * @var Configuration
     */
    private $configuration = null;

    /**
     * nom du contrôleur courant
     * @var string
     */
    private $currentController;

    /**
     * nom de l'action courante
     * @var string 
     */
    private $currentAction;

    /**
     * nom du contrôleur par defaut
     * @var string
     */
    private $defaultController;

    /**
     * Constructeur privé (singleton)
     * 
     * @param string $fichierIni : chemin du fichier ini
     * 
     */
    private function __construct($fichierIni) {
        $this->configuration = Configuration::getIinstance($fichierIni);
    }

    /**
     * Fabrique et/ou retourne l'unique instance d'application
     * 
     * @param string $fichierIni : chemin du ficheir ini
     * @return Application
     */
    public static function getInstance($fichierIni = '') {
        if (self::$_instance === NULL) {
            self::$_instance = new Application($fichierIni);
        }
        return self::$_instance;
    }

    /**
     * Lance l'exécution de l'application
     */
    public function run() {
        $controllerName = Request::get('controller', $this->defaultController);
        if (empty($controllerName)) {
            $controllerName = $this->defaultController;
        }
        $this->currentController = $controllerName;
        $className = '\\' . APPLICATION_NAMESPACE . '\\' . ucfirst($controllerName) . 'Controller';
        $controller = new $className();
        $actionName = Request::get('action', $controller->getDefaultActionName());
        $this->currentAction = $actionName;
        $controller->execute($actionName);
        $page = Page::getInstance();
        $page->render();
    }

    /**
     * Retourne la configuration chargée par l'application
     * 
     * @return Configuration
     */
    public static function getConfig() {
        if (isset(self::$_instance)) {
            return self::$_instance->configuration;
        }
        return NULL;
    }

    /**
     * Retourne la connexion à la base de donnée
     * 
     * @return \PDO
     */
    public static function getDB() {
        return Database::getInstance(
                        self::$_instance->configuration->db_hostname,
                        self::$_instance->configuration->db_login,
                        self::$_instance->configuration->db_password,
                        self::$_instance->configuration->db_database
        );
    }

    /**
     * Retourne la page à afficher
     * 
     * @return Page
     */
    public static function getPage() {
        return Page::getInstance();
    }

    /**
     * Setter pour le contrôleur par défaut
     * 
     * @param string $controller
     */
    public function setDefaultController($controller) {
        $this->defaultController = $controller;
    }

    /**
     * Retourne le nom du contrôlleur courrant
     * 
     * @return string
     */
    public static function getCurrentController() {
        return self::getInstance()->currentController;
    }

    /**
     * Retourne le nom de l'action courante
     * 
     * @return string
     */
    public static function getCurrentAction() {
        return self::getInstance()->currentAction;
    }

    /**
     * Initialise l'authentification
     * 
     * @param string $delegateClass
     */
    public function setAuthenticationDelegate($delegateClass) {
        $cls = '\\' . APPLICATION_NAMESPACE . '\\' . $delegateClass;
        Authentication::getInstance(new $cls);
    }

}
