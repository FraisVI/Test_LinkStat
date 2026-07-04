<?php

return [
    'column_toggle' => [
        'heading' => 'Колонки',
    ],
    'columns' => [
        'actions' => [
            'label' => 'Действие|Действия',
        ],
        'text' => [
            'actions' => [
                'collapse_list' => 'Показать на :count меньше',
                'expand_list' => 'Показать еще :count',
            ],
            'more_list_items' => 'и еще :count',
        ],
    ],
    'fields' => [
        'bulk_select_page' => [
            'label' => 'Выбрать или снять выбор со всех записей для массовых действий.',
        ],
        'bulk_select_record' => [
            'label' => 'Выбрать или снять выбор с записи :key для массовых действий.',
        ],
        'bulk_select_group' => [
            'label' => 'Выбрать или снять выбор с группы :title для массовых действий.',
        ],
        'search' => [
            'label' => 'Поиск',
            'placeholder' => 'Поиск',
            'indicator' => 'Поиск',
        ],
    ],
    'actions' => [
        'disable_reordering' => [
            'label' => 'Завершить сортировку записей',
        ],
        'enable_reordering' => [
            'label' => 'Изменить порядок записей',
        ],
        'filter' => [
            'label' => 'Фильтр',
        ],
        'group' => [
            'label' => 'Группировать',
        ],
        'open_bulk_actions' => [
            'label' => 'Массовые действия',
        ],
        'toggle_columns' => [
            'label' => 'Настроить колонки',
        ],
    ],
    'empty' => [
        'heading' => ':model не найдены',
        'description' => 'Создайте :model, чтобы начать.',
    ],
    'filters' => [
        'actions' => [
            'apply' => [
                'label' => 'Применить фильтры',
            ],
            'remove' => [
                'label' => 'Удалить фильтр',
            ],
            'remove_all' => [
                'label' => 'Удалить все фильтры',
                'tooltip' => 'Удалить все фильтры',
            ],
            'reset' => [
                'label' => 'Сбросить',
            ],
        ],
        'heading' => 'Фильтры',
        'indicator' => 'Активные фильтры',
        'multi_select' => [
            'placeholder' => 'Все',
        ],
        'select' => [
            'placeholder' => 'Все',
        ],
    ],
    'selection_indicator' => [
        'selected_count' => 'Выбрана :count запись|Выбрано :count записи|Выбрано :count записей',
        'actions' => [
            'select_all' => [
                'label' => 'Выбрать все :count',
            ],
            'deselect_all' => [
                'label' => 'Снять выбор',
            ],
        ],
    ],
    'sorting' => [
        'fields' => [
            'column' => [
                'label' => 'Сортировать по',
            ],
            'direction' => [
                'label' => 'Направление сортировки',
                'options' => [
                    'asc' => 'По возрастанию',
                    'desc' => 'По убыванию',
                ],
            ],
        ],
    ],
];
