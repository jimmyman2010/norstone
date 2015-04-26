<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = Yii::t('app', Yii::$app->name);

/**
 * @param string $type
 * @param int $id
 * @param array|null $request
 * @param bool $remove
 * @return string
 */
function getUrl($type, $id, $request, $remove = false)
{
    if($type === 'tag' && isset($request['tag'])) {
        $arrTmp = explode(',', $request['tag']);
        if($remove) {
            foreach ($arrTmp as $index => $value) {
                if(intval($value) === $id){
                    unset($arrTmp[$index]);
                }
            }
        }
        else {
            $arrTmp[] = $id;
        }

        if(count($arrTmp) > 0) {
            $id = implode(',', $arrTmp);
        }
        else {
            $id = null;
        }
    }
    return Url::current([$type => $id, 'page' => null, 'per-page' => null]);
}
?>
<section class="welcome text-center">
    <h2><span>Norstone Image Gallery</span> When images speak louder than words</h2>
    <p>Welcome to our Norstone image gallery. We are excited to show you how can our eco friendly stone products contribute to a better aesthetics of architecture and spaces that surrounds us. Stone is universal material suitable for various applications. Use our <a href="javascript:;">"Choose the products"</a> searching tool to find inspiration you are looking for.</p>
</section><!--end welcome-->
<section class="gallery-list">

    <div class="filter-gallery">
        <div class="text-center"><span id="drop-view" data-target="drop-content">Choose the product</span></div>
    </div>
    <?php Pjax::begin(['id' => 'galleries']) ?>
    <div class="filter-gallery">
        <div class="filter-content" id="drop-content" data-dropdown-content aria-hidden="true" tabindex="-1"
            <?= (isset($request['color']) || isset($request['product']) || isset($request['application'])) ? ' style="display:block"' : '' ?>
            >
            <div class="row text-left">
                <div class="small-12 medium-12 large-4 columns text-center">
                    <div class="dropdown" data-dropdown="drop1" aria-expanded="false">
                        <?php
                        $flag = true;
                        foreach ($products as $product) {
                            if(isset($request['product']) && $product->id === intval($request['product'])) {
                                echo $product->name;
                                $flag = false;
                                break;
                            }
                        }
                        if($flag){
                            echo Yii::t('app', 'Product name');
                        }
                        ?>
                        <span class="ti-angle-down"></span>
                    </div>
                    <ul id="drop1" class="f-dropdown text-left" data-dropdown-content aria-hidden="true" tabindex="-1">
                        <li><a href="<?= getUrl('product', null, $request) ?>">&nbsp;</a></li>
                        <?php foreach ($products as $product) { ?>
                            <li <?= (isset($request['product']) && $product->id === intval($request['product'])) ? 'class="active"' : '' ?>>
                                <a href="<?= getUrl('product', $product->id, $request) ?>" data-id="<?= $product->id ?>"><?= $product->name ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="small-12 medium-12 large-4 columns text-center">

                    <div class="dropdown" data-dropdown="drop2" aria-expanded="false">
                        <?php
                        $flag = true;
                        foreach ($colors as $color) {
                            if(isset($request['color']) && $color->id === intval($request['color'])) {
                                echo $color->name;
                                $flag = false;
                                break;
                            }
                        }
                        if($flag){
                            echo Yii::t('app', 'Select the colour');
                        }
                        ?>
                        <span class="ti-angle-down"></span>
                    </div>
                    <ul id="drop2" class="f-dropdown text-left" data-dropdown-content aria-hidden="true" tabindex="-1">
                        <li><a href="<?= getUrl('color', null, $request) ?>">&nbsp;</a></li>
                        <?php foreach ($colors as $color) { ?>
                            <li <?= (isset($request['color']) && $color->id === intval($request['color'])) ? 'class="active"' : '' ?>>
                                <a href="<?= getUrl('color', $color->id, $request) ?>" data-id="<?= $color->id ?>"><?= $color->name ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="small-12 medium-12 large-4 columns type-show text-center application-filter">
                    <a <?= (!isset($request['application'])) ? 'class="active"' : '' ?> href="<?= getUrl('application', null, $request) ?>">
                        <?= Yii::t('app', 'Show all') ?>
                    </a>
                    <a <?= (isset($request['application']) && intval($request['application']) === 1) ? 'class="active"' : '' ?> href="<?= getUrl('application', 1, $request) ?>">
                        <?= Yii::t('app', 'Internal') ?>
                    </a>
                    <a <?= (isset($request['application']) && intval($request['application']) === 0) ? 'class="active"' : '' ?> href="<?= getUrl('application', 0, $request) ?>">
                        <?= Yii::t('app', 'External') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <p class="line text-center"><span></span></p>
    <div class="tags text-center">
        <?php foreach ($tags as $tag) {
            $active = isset($request['tag']) && in_array($tag->id, explode(',', $request['tag']));
            ?>
            <a href="<?= getUrl('tag', $tag->id, $request, $active) ?>"
               class="tag-name <?= ($active) ? 'active' : '' ?>" data-id="<?= $tag->id ?>"><?= $tag->name ?></a>
        <?php } ?>
    </div>

    <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
        <?php
            $galleries = $dataProvider->getModels();
            if(count($galleries) === 0) {
        ?>
            <li class="text-center"><em><?= Yii::t('app', 'No results.') ?></em></li>
        <?php
            }
            else {
                foreach ($galleries as $index => $item) { ?>
                    <li class="gallery-thumb">
                        <?= $this->render('../gallery/_item_details', ['model' => $item]) ?>
                    </li>
                <?php }
            }
        ?>
    </ul>
    <nav class="text-center pagination-wrapper">
        <?= LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
            'nextPageLabel' => Yii::t('app', 'Newer') . '&nbsp; <span class="ti-arrow-right"></span>',
            'prevPageLabel' => '<span class="ti-arrow-left"></span> &nbsp;' . Yii::t('app', 'Previous'),
        ]) ?>
    </nav><!--end pagination-->
    <?php Pjax::end() ?>
</section><!--end gallery list-->


