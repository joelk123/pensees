<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

class Page {

    private static $_instance = null;
    protected $template = '';
    protected $view = '';
    protected $data = array();
    protected $script = array();

    /**
     * Constructeur privé
     */
    private function __construct() {
        
    }

    /**
     * Retourne l'instance de la classe Page
     * @return self
     */
    public static function getInstance() {
        if (self::$_instance===NULL) {
            self::$_instance = new Page();
        }
        return self::$_instance;
    }

    /**
     * Spécifie le nom du template à utiliser
     * @param string $templateName
     */
    public function setTemplate($templateName) {
        $templatePath = APPLICATION_PATH . "/templates/$templateName.template.php";
        if (!\is_readable($templatePath)) {
            throw new Error('fichier de template introuvable ou illisible');
        }
        $this->template = $templatePath;
    }

    /**
     * Spécifie le nom de la vue à utiliser
     * @param s $viewName
     */
    public function setView($viewName) {
        $viewPath = APPLICATION_PATH . "/views/$viewName.view.php";
        if (!\is_readable($viewPath)) {
            throw new Error('fichier de vue introuvable ou illisible');
        }
        $this->view = $viewPath;
    }

    /**
     * Insère la vue dans le template
     */
    private function insertView() {
        if (!empty($this->view)) {
            require $this->view;
        }
    }

    /**
     * Déclenche le rendu du template
     */
    public function render() {
        if ((!empty($this->template)) and ( !empty($this->view))) {
            require $this->template;
        }
    }

    /**
     * Méthode magique pour l'ajout de propriété
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    /**
     * Méthode magique pour la lecture d'une propriété
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (!isset($this->data[$name])) {
            throw new Error("la propriete $name est introuvable");
        }
        return $this->data[$name];
    }

    /**
     * Méthode magique pour les tests avec isset
     * @param string $name
     * @return booleane
     */
    public function __isset($name) {
        return isset($this->data[$name]);
    }

    /**
     * Méthode de transfert d'un tableau vers des propriétés
     * @todo écrire le code de la méthode
     * @param array $data
     */
    public function loadData(array $data) {
        
    }

    public function addScript($url) {
        if (!is_readable($url)) {
            throw new Error("Le fichier $url est introuvable ou illisible");
        }
        if (!in_array($url, $this->script)) {
            array_push($this->script, $url);
        }
    }

    public function insertScripts() {
        foreach ($this->script as $url):
            ?><script src="<?php echo $url; ?>" type="text/javascript"></script><?php
        endforeach;
    }

}
