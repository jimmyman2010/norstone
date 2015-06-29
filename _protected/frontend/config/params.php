<?php

Yii::setAlias('@uploads', __DIR__ . '/../../../uploads');

return [
    'adminEmail' => 'admin@example.com',
    'image_sizes' => [
        'thumbnail' => [240, 240],
        'thumbnail-search' => [130, 85],
        'thumbnail-slide' => [160, 160],
        'slide' => [400, 400]
    ]
];
