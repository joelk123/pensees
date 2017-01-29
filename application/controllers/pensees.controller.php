<?php
namespace Pensees;

defined('__PENSEES__') or die('Acces interdit');

class PenseesController extends \F3il\Controller 
{
    public function __construct() {
        $this->setDefaultActionName('index');
    }
    
    public function indexAction() {
        $page = \F3il\Application::getPage();
        $page->setTemplate('pensees');
        $page->setView('index');
        
        $model = new PenseesModel();
        $page->pensees = $model->dernieres();
        $page->aleatoire = $model->aleatoire();

    }
    
    public function creerAction() {
        $page = \F3il\Application::getPage();
        $page->setTemplate('pensees');
        $page->setView('penseeForm');
        
        $form = new PenseesForm('?controller=pensees&action=creer');
        $page->form = $form;
        
        if(!\F3il\Request::isPost()) return;
        
        $form->loadData($_POST);
        
        if(!$form->validate()) return;
        
        $model = new PenseesModel();
        $model->creer($form->getData());
        
        \F3il\HttpHelper::redirect('?controller=pensees&action=index');
    }
}

