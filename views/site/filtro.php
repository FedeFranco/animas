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
        'property' => 'tipo_animal_id',
        'caption' => 'Tipo',
        'values' => [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7'
        ]
    ]

]); ?>
<?=$filter->renderAjaxView($ajaxViewFile) ?>
</div>
