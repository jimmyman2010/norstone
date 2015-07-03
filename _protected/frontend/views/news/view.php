<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 7/1/2015
 * Time: 3:16 PM
 */

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\UtilHelper;
use frontend\assets\ProductAsset;
use yii\widgets\Breadcrumbs;
use common\models\Config;

/* @var $this yii\web\View */
/* @var $model common\models\Content */

$this->title = ucfirst($model->name) . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->params['breadcrumbs'][] = $model->name;

ProductAsset::register($this);

$this->title = !empty($model->seo_title) ? $model->seo_title : $model->name . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => !empty($model->seo_keyword) ? $model->seo_keyword : Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => !empty($model->seo_description) ? $model->seo_description : Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

?>

<div id="main_content" class="col-sm-9">
    <ul class="breadcrumb">
        <li class="firstItem"><a href="<?= Yii::$app->homeUrl ?>" class="homepage-link" title="<?= Yii::t('app', 'Back to the homepage') ?>"><?= Yii::t('app', 'Home') ?></a></li>
        <li><a href="<?= Url::toRoute(['news/index']) ?>">Tin tức</a></li>
        <li class="lastItem"><span class="page-title"><?= $model->name ?></span></li>
    </ul>
    <div class="page-scope">
        <div class="page_header">
            <h1 class="page_heading"><?= $model->name ?></h1>
        </div>
        <div class="page_content">
            <div class="rte">
                <?= $model->content ?>
            </div>
            <?php if(count($tags) > 0) { ?>
            <div class="blog-article_meta-tags">
                <span>Tags: </span>
                <?php
                }
                foreach ($tags as $index => $tag) {
                    if($index > 0)
                        echo ', ';
                    echo Html::a($tag->name, ['news/tag', 'slug' => $tag->slug]);
                }
                ?>
            <?php if(count($tags) > 0) { ?>
            </div>
            <?php } ?>

            <div class="widget widget__related-products">

                <div class="widget_header">
                    <h3>Phản hồi</h3>
                </div>
                <div class="widget_content">
                    <div id="disqus_thread"><iframe id="dsq-2" data-disqus-uid="2" allowtransparency="true" frameborder="0" scrolling="no" tabindex="0" title="Disqus" width="100%" src="http://disqus.com/embed/comments/?base=default&amp;version=2fd469d8025ef2cff25569832e5cbb1d&amp;f=mantrantddev&amp;t_u=http%3A%2F%2Fcomputer.theme%2Fproduct-detail.php&amp;t_d=DUY%20T%C3%82N%20COMPUTER&amp;t_t=DUY%20T%C3%82N%20COMPUTER&amp;s_o=default#2" style="width: 100% !important; border: none !important; overflow: hidden !important; height: 321px !important;" horizontalscrolling="no" verticalscrolling="no"></iframe></div>
                    <noscript>Please enable JavaScript to view the &lt;a href="https://disqus.com/?ref_noscript" rel="nofollow"&gt;comments powered by Disqus.&lt;/a&gt;</noscript>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("

/* * * CONFIGURATION VARIABLES * * */
var disqus_shortname = '" . Config::findOne(['key' => 'DISQUS'])->value . "';

/* * * DON'T EDIT BELOW THIS LINE * * */
(function() {
    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
})();

");