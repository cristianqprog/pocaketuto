<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Usuarios</h2>
        </div>
        <div class="table-responsive">
        <a href="#top"><p align=center><strong>Ir al cielo</strong></a></p>
            <table class="table table-striped table-hover">
               
            <thead>
            <tr>
                
                <th><?= $this->Paginator->sort('first_name', ['Nombre']) ?></th>
                <th><?= $this->Paginator->sort('last_name', ['Apellidos']) ?></th>
                <th><?= $this->Paginator->sort('email', ['Correo electrónico']) ?></th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
               
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td>
                    <?= $this->Html->link('Ver', ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-info']) ?>
                    <?= $this->Html->link('Editar', ['action' => 'edit', $user->id], ['class' => 'btn btn-sm btn-primary']) ?>
                    <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $user->id], ['confirm' => 'Eliminar usuario ?', 'class' => 'btn btn-sm btn-danger']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
            </tbody>
            </table>
        </div>
<a href="#top"><p align=center><strong>Ir al cielo</strong></a></p>
        <div class="paginator">
            <ul class="pagination">
            <?php
              $this->Paginator->templates([
                'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                'current' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
            ]); ?>
                <?= $this->Paginator->prev('< Anterior') ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                <?= $this->Paginator->next('Siguiente >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>


   
    </div>
</div>