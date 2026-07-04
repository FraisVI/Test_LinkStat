<?php

return [
    'label' => 'Навигация по страницам',
    'overview' => '{1} Показана 1 запись|[2,*] Показаны записи с :first по :last из :total',
    'fields' => [
        'records_per_page' => [
            'label' => 'На странице',
            'options' => [
                'all' => 'Все',
            ],
        ],
    ],
    'actions' => [
        'first' => [
            'label' => 'Первая',
        ],
        'go_to_page' => [
            'label' => 'Перейти на страницу :page',
        ],
        'last' => [
            'label' => 'Последняя',
        ],
        'next' => [
            'label' => 'Следующая',
        ],
        'previous' => [
            'label' => 'Предыдущая',
        ],
    ],
];
