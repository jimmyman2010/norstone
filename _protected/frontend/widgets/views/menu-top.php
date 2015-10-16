<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/16/2015
 * Time: 1:27 PM
 */
?>

<?= \yii\widgets\Menu::widget([
    'items' => [
        ['label' => 'TRANG CHỦ', 'url' => ['site/index']],
        ['label' => 'GIỚI THIỆU', 'url' => ['page/view', 'slug' => 'gioi-thieu']],
        ['label' => 'BẢNG GIÁ', 'url' => ['page/view', 'slug' => 'bang-gia']],
        ['label' => 'BLOG', 'url' => ['news/index']],
        ['label' => 'HƯỚNG DẪN MUA HÀNG', 'url' => ['page/view', 'slug' => 'huong-dan-mua-hang']],
        ['label' => 'LIÊN HỆ', 'url' => ['site/contact']],
    ]
]) ?>
