<?php
defined('__PENSEES__') or die('Acces interdit');
?>
<div class="jumbotron">
    <h1><?php echo $this->aleatoire['pensee'];?></h1>
    <p><?php echo $this->aleatoire['pseudo'];?></p>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Les 5 dernières pensées
    </div>
    <div class="panel-body">
        <ul>
            <?php foreach($this->pensees as $P):?>
            <li><?php echo $P['pensee'];?> <small>[<?php echo $P['pseudo'];?>]</small></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

