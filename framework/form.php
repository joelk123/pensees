<?php

namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 * Classe représantant un formulaire
 */
abstract class Form {

    const CREATE_MODE = 1;
    const EDIT_MODE = 2;

    /**
     * Tableau des champs
     * @var array
     */
    protected $_fields = array();

    /**
     * État de validation du formulaire
     * @var boolean
     */
    protected $_valid;

    /**
     * messages d'erreurs
     * @var array
     */
    protected $_messages = array();

    /**
     * mode de fonctionnement
     * @var int 
     */
    protected $_mode;

    /**
     * destination du formulaire
     * @var String 
     */
    protected $_destination;

    /**
     * Constructeur
     * 
     * @param String $destination
     * @param int $mode
     */
    public function __construct($destination,$mode = Form::CREATE_MODE) {
        $this->_destination = $destination;
        $this->_mode = $mode;
    }

    /**
     * Méthode magique pour accéder à une valeur d'un champ
     * 
     * @param String $name
     * @return mixed
     * @throws Error
     */
    public function __get($name) {
        if (isset($this->_fields[$name])) {
            return $this->_fields[$name]->value;
        }
        throw new Error("Champ non définit : " . $name);
    }

    /**
     * Méthode magique pour tester la présence d'un champ
     * 
     * @param String $name
     * @return boolean
     */
    public function __isset($name) {
        return isset($this->_fields[$name]);
    }

    /**
     * Ajoute un champ au formulaire
     * 
     * @param Field $field
     */
    protected function addFormField($field) {
        if (isset($this->_fields[$field->name])) {
            throw new Error("Champ déjà définit");
        }
        $this->_fields[$field->name] = $field;
    }

    /**
     * Ajoute un message d'erreur
     * 
     * @param String $name
     * @param String $message
     */
    public function addMessage($name, $message) {
        array_push($this->_messages, ['name' => $name, 'message' => $message]);
    }

    public function _createValidate() {
        $valid = TRUE;
        foreach ($this->_fields as $field) {
            if ($field->required && $field->value == '') {
                $valid = FALSE;
                $this->addMessage($field->name,
                        'Erreur sur le champ ' . $field->label);
            }
            $sp_val_name = $field->name . 'Validate';
            if (method_exists($this, $sp_val_name)) {
                $fieldValid = $this->$sp_val_name();
            } elseif (!empty($field->phpValidator)) {
                $fieldValid = filter_var($field->value, $field->phpFilter);
            } else {
                $fieldValid = $this->defaultValidator($field->value);
            }
            $valid = $fieldValid && $valid;
        }
        $this->_valid = $valid;
        return $valid;
    }

    /**
     * validateur par défaut
     * 
     * @param String $name 
     * @return boolean
     */
    public function defaultValidator($name) {
        return TRUE;
    }

    public function _editValidate() {
        return $this->_createValidate();
    }

    /**
     * Retourne toutes les valeurs des champs
     * 
     * @return array
     */
    public function getData() {
        $data = array();
        foreach ($this->_fields as $name => $field) {
            $data[$name] = $field->value;
        }
        return $data;
    }

    /**
     * Retourne le tableau de message d'erreur
     * 
     * @return array
     */
    public function getMessages() {
        return $this->_messages;
    }

    /**
     * Lit $source et déclenche le filtrage
     * 
     * @param array $source
     */
    public function loadData($source) {
        foreach ($this->_fields as $name => $field) {
            if (isset($source[$name])) {
                $val = $source[$name];
            } else {
                $val = $field->defaultValue;
            }
            $sp_filtr_name = $name . 'Filter';
            if (method_exists($this, $sp_filtr_name)) {
                $field->value = $this->$sp_filtr_name($val);
            } elseif ($field->phpFilter != '') {
                $field->value = filter_var($val, $field->phpFilter);
            } else {
                $field->value = $val;
            }
        }
    }

    /**
     * Méthode d'affichage du formulaire
     */
    public abstract function render();

    /**
     * Valide le formulaire
     * 
     * @return boolean
     * @throws Error
     */
    public function validate() {
        if ($this->_mode === self::CREATE_MODE) {
            $this->_valid = $this->_createValidate();
        } elseif ($this->_mode === self::EDIT_MODE) {
            $this->_valid = $this->_editValidate();
        } else {
            throw new Error("Mode de formulaire inconnue");
        }
        return $this->_valid;
    }

}
