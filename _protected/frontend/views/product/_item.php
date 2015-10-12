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

<article class="col-xs-12 col-sm-4 col-lg-3">
    <figure>
        <a href="<?= Url::toRoute(['product/view', 'id' => $product->id, 'slug' => $product->slug]) ?>">
            <?= UtilHelper::getPicture($product->image_id, 'thumbnail') ?>
        </a>
        <figcaption>
            <span class="hot"></span>
            <span class="discount"></span>
        </figcaption>
    </figure>
    <h3><?= Html::a($product->name, ['product/view', 'id' => $product->id, 'slug' => $product->slug]) ?></h3>
    <p class="price">
        <strong><nobr><?= intval($product->price) === 0 ? 'Liên hệ' : CurrencyHelper::formatNumber($product->price) ?></nobr></strong>
        &nbsp;&nbsp;
        <?php if(!empty($product->price_string)) {
            $priceArray = Json::decode($product->price_string);
            if(intval($priceArray['month3']['old']) !== 0) { ?>
        <em><nobr><?= $priceArray['month3']['old'] ?></nobr></em>
            <?php } } ?>
    </p>
</article>