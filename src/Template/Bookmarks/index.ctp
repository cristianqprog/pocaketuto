<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2>
                Mi lista
                <?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['controller' => 'Bookmarks', 'action' => 'add'], ['class' => 'btn btn-primary pull-right', 'escape' => false]); ?>
            </h2>
        </div>
        <ul class="list-group">
            <?php foreach ($bookmarks as $bookmark): ?>
            <li class="list-group-item">
                <h4 class="list-group-item-heading"><?= h($bookmark->title) ?></h4>
                <p>
                    <strong class="text-info">
                        <small>
                            <?= $this->Html->link($bookmark->url, null, ['target' => '_blank']) ?>
                        </small>
                    </strong>
                </p>
                <p class="list-group-item-text">
                    <?= h($bookmark->description) ?>
                </p>
                <br>
                <?= $this->Html->link('Editar', ['controller' => 'Bookmarks', 'action' => 'edit', $bookmark->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?= $this->Form->postLink('Eliminar', ['controller' => 'Bookmarks', 'action' => 'delete', $bookmark->id], ['confirm' => 'Eliminar enlace ?', 'class' => 'btn btn-sm btn-danger']) ?>
            </li>
            <?php endforeach ?>
        </ul>
       <a  href="#top"><p align=center><strong>Ir arriba</strong></a></p>
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