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
    <?= $this->Html->css('font-awesome.min') ?>
    <?= $this->Html->script(['jquery-3.3.1.min','bootstrap.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
   



<style type="">
  *{ Margin:0px Padding:0px;} 
  .nav-item  {
    color: white;

  }

</style>
  
    


  <!-- Page Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container"  ">
        <div class="navbar-header">
           
            <?= $this->Html->link('App Enlaces Favoritos', ['controller' => 'Users', 'action' => 'index'], ['class' => 'navbar-brand']) ?>
           
        </div>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <?php if(isset($current_user)): ?> 

              <?php if($current_user['role'] == 'admin'): ?>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                   <?=   $this->Html->link('Listar Usuarios', ['controller' => 'Users', 'action' => 'index'],['class' => 'btn btn-outline-info']);?>
                   <br>
                   
                </li>
                
                <li class="nav-item active">
                   <?=   $this->Html->link('Agregar Usuarios', ['controller' => 'Users', 'action' => 'add'],['class' => 'btn btn-outline-info']);?>
                </li>
        </ul>
        <?php endif; ?>
         <ul class="nav navbar-nav navbar-left">
                     <li>
                        <?= $this->Html->link('Mi lista', ['controller' => 'bookmarks', 'action' => 'index'],['class' => 'btn btn-outline-info']) ?>
                        <br>

                    </li>
                </ul>
       </div>  
              
                
            <ul class="nav navbar-nav navbar-left">
              <li>
                   <?= $this->Html->link('Salir', ['controller' => 'Users', 'action' => 'logout'],['class' => 'btn btn-outline-danger']) ?>
              </li>
            </ul>
            
           
            
              <?php endif; ?>       
       
    </div >
  </nav>


    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>


<!-- Footer -->
<style type="text/css">
 html {
  min-height: 100%;
  position: relative;
}
body {
  margin: 0;
  margin-bottom: 40px;
}
footer {
   position:absolute;
   left:0px;
   bottom:0px;
   height:54px;
   width:100%;
   background:#aace9e;
}


</style>

<footer  >

  <!-- Copyright -->
  <div  class="footer-copyright text-center py-3">Enlaces Favoritos:
    <a  href="https://mdbootstrap.com/education/bootstrap/"> Final Programación 3</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

</body>
</html>
