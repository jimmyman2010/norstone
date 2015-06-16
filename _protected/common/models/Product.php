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
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_description
 * @property integer $published_date
 * @property integer $created_date
 * @property string $created_by
 * @property integer $activated
 * @property integer $deleted
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 'draft';
    const STATUS_WAITING = 'waiting';
    const STATUS_PUBLISHED = 'published';

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
            [['category_id', 'image_id', 'percent', 'viewed', 'published_date', 'created_date', 'activated', 'deleted'], 'integer'],
            [['general', 'info_tech', 'status'], 'string'],
            [['price', 'price_new'], 'number'],
            [['name', 'seo_description'], 'string', 'max' => 256],
            [['slug', 'seo_title', 'seo_keyword'], 'string', 'max' => 128],
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
            'category_id' => Yii::t('app', 'Category'),
            'image_id' => Yii::t('app', 'Image'),
            'description' => Yii::t('app', 'Description'),
            'general' => Yii::t('app', 'General'),
            'info_tech' => Yii::t('app', 'Info Tech'),
            'price' => Yii::t('app', 'Price'),
            'price_new' => Yii::t('app', 'Price New'),
            'percent' => Yii::t('app', 'Percent'),
            'viewed' => Yii::t('app', 'Viewed'),
            'status' => Yii::t('app', 'Status'),
            'seo_title' => Yii::t('app', 'Seo Title'),
            'seo_keyword' => Yii::t('app', 'Seo Keyword'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'published_date' => Yii::t('app', 'Published Date'),
            'created_date' => Yii::t('app', 'Created Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'activated' => Yii::t('app', 'Activated'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategories()
    {
        return Category::find()->where(['deleted' => 0])->all();
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->hasOne(File::className(), ['id' => 'image_id']);
    }

    /**
     * Returns the array of possible gallery status values.
     *
     * @return array
     */
    public function getStatusList()
    {
        $statusArray = [
            self::STATUS_PUBLISHED    => 'Published',
            self::STATUS_WAITING   => 'Waiting',
            self::STATUS_DRAFT => 'Draft'
        ];

        return $statusArray;
    }

    /**
     * Returns the gallery status in nice format.
     *
     * @param null|integer $status Status integer value if sent to method.
     * @return string              Nicely formatted status.
     */
    public function getStatusName($status = null)
    {
        $status = (empty($status)) ? $this->status : $status ;

        if ($status === self::STATUS_PUBLISHED)
        {
            return "Published";
        }
        elseif ($status === self::STATUS_WAITING)
        {
            return "Waiting";
        }
        else
        {
            return "Draft";
        }
    }

    /**
     * @param string $slug
     * @param int $id
     * @return string
     */
    public function getSlug($slug, $id = 0)
    {
        $result = $slug;
        $i = 0;
        while (true) {
            if($i > 0)
                $result = $slug . $i;
            if ($id === 0) {
                $exist = Product::findOne(['slug' => $result]);
            }
            else {
                $exist = Product::findOne(['AND', ['=', 'slug', $result], ['<>', 'id', $id]]);
            }
            if($exist === null) {
                break;
            }
            $i++;
        }
        return $result;
    }
}
