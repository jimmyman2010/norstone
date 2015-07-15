<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 7/15/2015
 * Time: 2:23 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UtilHelper;
use yii\helpers\Json;
use common\helpers\CurrencyHelper;

/* @var $product common\models\Product */

?>

<div class="product product__product-grid-item columns-3 col-sm-4 <?php if($index%3 === 0) echo 'item_alpha'; elseif($index%3 === 2) echo 'item_omega'; ?>">
    <div class="product_img">
        <?php if($product->is_discount) { ?>
            <span class="discount"></span>
        <?php } ?>
        <?php if($product->is_hot) { ?>
            <span class="hot"></span>
        <?php } ?>
        <a href="<?= Url::toRoute(['product/view', 'id' => $product->id, 'slug' => $product->slug]) ?>">
            <?= UtilHelper::getPicture($product->image_id, 'thumbnail') ?>
        </a>
    </div>
    <h2 class="product_name">
        <?= Html::a($product->name, ['product/view', 'id' => $product->id, 'slug' => $product->slug]) ?>
    </h2>
    <div class="product_links">
        <?= Html::a(intval($product->price) === 0 ? 'Liên hệ' : CurrencyHelper::formatNumber($product->price), ['product/view', 'id' => $product->id, 'slug' => $product->slug], ['class'=>'btn btn-cart price-current']) ?>
        <?php if(!empty($product->price_string)) {
         $priceArray = Json::decode($product->price_string);
            if(intval($priceArray['month3']['old']) !== 0) { ?>
            <?= Html::a($priceArray['month3']['old'], ['product/view', 'id' => $product->id, 'slug' => $product->slug], ['class'=>'btn price-old']) ?>
        <?php } } ?>
    </div>
</div>