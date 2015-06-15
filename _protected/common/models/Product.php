<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_product}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $category_id
 * @property integer $image_id
 * @property string $description
 * @property string $general
 * @property string $info_tech
 * @property string $price
 * @property string $price_new
 * @property integer $percent
 * @property integer $viewed
 * @property string $status
 * @property string $seo_keyword
 * @property string $seo_description
 * @property integer $published_date
 * @property integer $created_date
 * @property string $created_by
 * @property integer $deleted
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'category_id', 'created_date', 'created_by'], 'required'],
            [['category_id', 'image_id', 'percent', 'viewed', 'published_date', 'created_date', 'deleted'], 'integer'],
            [['general', 'info_tech', 'status'], 'string'],
            [['price', 'price_new'], 'number'],
            [['name', 'seo_description'], 'string', 'max' => 256],
            [['slug', 'seo_keyword'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 1024],
            [['created_by'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'category_id' => Yii::t('app', 'Category ID'),
            'image_id' => Yii::t('app', 'Image ID'),
            'description' => Yii::t('app', 'Description'),
            'general' => Yii::t('app', 'General'),
            'info_tech' => Yii::t('app', 'Info Tech'),
            'price' => Yii::t('app', 'Price'),
            'price_new' => Yii::t('app', 'Price New'),
            'percent' => Yii::t('app', 'Percent'),
            'viewed' => Yii::t('app', 'Viewed'),
            'status' => Yii::t('app', 'Status'),
            'seo_keyword' => Yii::t('app', 'Seo Keyword'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'published_date' => Yii::t('app', 'Published Date'),
            'created_date' => Yii::t('app', 'Created Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }
}
