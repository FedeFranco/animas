<?php

$this->title = "Filtro"

?>
<div class="site-filtro">

<?= $filter->setFilter([
    [
        'property' => 'categoria_id',
        'caption' => 'Categorias',
        'values' => [
            '1',
            '2',
            '3',
            '4'
        ],
        'class' => 'horizontal'
    ],
    [
        'property' => 'titulo',
        'caption' => 'Titulo',
        'values' => [
            'dfghjklñ',
            'OUBLBLOBLB',
        ]
    ]

]); ?>
<div class="text">
    textoooooooooooo
</div>
<?=$filter->renderAjaxView($ajaxViewFile) ?>
</div>
