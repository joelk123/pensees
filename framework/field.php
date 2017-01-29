<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * Classe représentant un champ d'un formulaire
 */
class Field {

    /**
     * nom du champ
     * @var String 
     */
    public $name;

    /**
     * 
     * @var String 
     */
    public $label;

    /**
     * 
     * @var boolean 
     */
    public $required;

    /**
     * valeur
     * @var String 
     */
    public $value;

    /**
     * valeur par défaut
     * @var String 
     */
    public $defaultValue;

    /**
     * Filtre utilisé
     * @var int 
     */
    public $phpFilter;

    /**
     * Validateur
     * @var int 
     */
    public $phpValidator;

    /**
     * Constructeur
     * 
     * @param String $name
     * @param String $label
     * @param String $defaultValue
     * @param boolean $required
     * @param int $phpFilter
     * @param int $phpValidator
     */
    public function __construct($name, $label, $defaultValue = null,
            $required = false, $phpFilter = "", $phpValidator = "") {
        $this->name = $name;
        $this->label = $label;
        $this->defaultValue = $defaultValue;
        $this->required = $required;
        $this->phpFilter = $phpFilter;
        $this->phpValidator = $phpValidator;
    }

}
