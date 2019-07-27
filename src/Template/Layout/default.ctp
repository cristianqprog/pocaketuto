<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min') ?>
    <?= $this->Html->script(['jquery-3.3.1.min','bootstrap.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
   




  
    


  <!-- Page Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">CakePHP 3.6</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                   <?=   $this->Html->link('Listar Usuarios', ['controller' => 'Users', 'action' => 'index'],['class' => 'btn btn-outline-secondary']);?>
                   <br>
                 </li>
                
                <li class="nav-item active">
                   <?=   $this->Html->link('Agregar Usuarios', ['controller' => 'Users', 'action' => 'add'],['class' => 'btn btn-outline-secondary']);?>


                </li>
            </ul>
            <div class="my-2 my-lg-0">
                <?php
                   
                   echo  $this->Html->link('Salir', ['controller' => 'Users', 'action' => 'logout'],['class' => 'btn btn-danger']);
                    echo '&nbsp';
                    echo  $this->Html->link('Loguearse', ['controller' => 'Users', 'action' => 'login'],['class' => 'btn btn-success']);
                ?>
            </div>
        </div>
    </nav>
    <br>

    <?= $this->Flash->render() ?>
    <div class="container">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
