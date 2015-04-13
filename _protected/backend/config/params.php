<?php

Yii::setAlias('@uploads', __DIR__ . '/../../../uploads');

return [
    'adminEmail' => 'admin@example.com',
    'image_maximum_size' => 1600,
    'image_sizes' => [
        'thumb-upload' => [300, 220],
        'thumb-list' => [120, 90],
        'thumbnail' => [308, 206]
    ]
];
