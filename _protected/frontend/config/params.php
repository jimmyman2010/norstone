<?php

Yii::setAlias('@uploads', __DIR__ . '/../../../uploads');

return [
    'adminEmail' => 'admin@example.com',
    'image_sizes' => [
        'thumbnail' => [318, 212],
        'thumbnail-slide' => [130, 85],
        'slide' => [650, 432]
    ]
];
