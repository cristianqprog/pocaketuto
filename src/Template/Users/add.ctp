
       
<div class="container-fluid">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="page-header">
            <h2>Crear usuario</h2>
        </div>
        <?= $this->Form->create($user, ['novalidate']) ?>
        <fieldset>
            <?php
            echo $this->Form->control('first_name', ['label'=>'Nombre']);
            echo $this->Form->control('last_name',['label'=>'Apellido']);
            echo $this->Form->control('email',['label'=>'Correo']);
            echo $this->Form->control('password',['label'=>'Contraseña']);
           
        ?>
        </fieldset>
        <?= $this->Form->button('Crear',['class' => 'btn btn-outline-primary']) ?>
        <style type="text/css">
            .btn {
                color: black;
            }
        </style>
        <?= $this->Form->end() ?>
    </div>
</div> 
</div>   
   

