<?php
namespace Pensees;

defined('__PENSEES__') or die('Acces interdit');

use \F3il\Form;
use \F3il\Field;

class PenseesForm extends Form 
{
    public function __construct($destination,$mode=Form::CREATE_MODE) {
        parent::__construct($destination,$mode);
                
        $this->addFormField(new Field('pensee','Pensée','',true,FILTER_SANITIZE_STRING));
        $this->addFormField(new Field('pseudo','Pseudo','Anonyme',false,FILTER_SANITIZE_STRING));                
    }
    
    public function penseeValidate() {
        $valid = (strlen($this->pensee)<140);
        if(!$valid) {
            $this->addMessage('pensee', 'Pensée trop longue, 140 caractères maximum');
        }        
        return $valid;
    }
    
    public function pseudoValidate() {
        $valid = (strlen($this->pseudo<64));
        if(!$valid) {
            $this->addMessage('pseudo', 'Pseudo trop long, 64 caractères maximum');
        }        
        return $valid;
    }
    
    public function render() {
        if(count($this->_messages)>0):
        ?>
        <div class="alert alert-danger"><?php echo $this->_messages[0]['message'];?></div>
        <?php
        endif;
    ?>        
<div class="panel panel-default">
    <div class="panel-body">
        <form action="<?php echo $this->_destination;?>" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="pensee" class="col-sm-2 control-label">Pensée : </label>
                <div class="col-sm-6">
                    <textarea id="pensee" name="pensee" class="form-control" placeholder="Votre pensée"><?php echo $this->pensee;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="pseudo" class="col-sm-2 control-label">Pseudo : </label>
                <div class="col-sm-6">
                    <input type="text" id="pseudo" name="pseudo" value="<?php echo $this->pseudo;?>" class="form-control" placeholder="Votre pseudo"/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                Envoyer
            </button>
        </form>
    </div>
</div>
    <?php
    }
}