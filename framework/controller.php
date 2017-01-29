<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * Classe de base des contrôleurs
 */
abstract class Controller {

    /**
     * Action par défaut du contrôleur
     * @var string
     */
    protected $defaultActionName = '';

    /**
     * Spécifit l'action par défaut
     * @param string $actionName : nom de l'action
     */
    public function setDefaultActionName($actionName) {
        $action = $actionName . 'Action';
        if (!method_exists($this, $action)) {
            throw new Error("Action inexistante : $actionName");
        }
        $this->defaultActionName = $actionName;
    }

    /**
     * Renvoi le nom de l'action par défaut
     * @return string
     */
    public function getDefaultActionName() {
        return $this->defaultActionName;
    }

    /**
     * Execute une action du contrôleur
     * @param string $actionName : nom de l'action
     */
    public function execute($actionName) {
        $action = $actionName . 'Action';
        if (!method_exists($this, $action)) {
            throw new Error("Action inexistante : $actionName");
        }
        $this->$action();
    }

}
