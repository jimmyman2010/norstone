<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_gallery}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $product_id
 * @property integer $color_id
 * @property integer $application
 * @property string $intro
 * @property string $description
 * @property string $lean_more_link
 * @property string $seo_keyword
 * @property string $seo_description
 * @property string $status
 * @property integer $publish_date
 * @property integer $created_date
 * @property string $created_by
 * @property integer $deleted
 */
class Gallery extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 'draft';
    const STATUS_WAITING = 'waiting';
    const STATUS_PUBLISHED = 'published';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_gallery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'product_id', 'color_id', 'status', 'created_date', 'created_by'], 'required'],
            [['product_id', 'color_id', 'application', 'publish_date', 'created_date', 'deleted'], 'integer'],
            [['description', 'status'], 'string'],
            [['name', 'seo_description'], 'string', 'max' => 256],
            [['intro'], 'string', 'max' => 1024],
            [['lean_more_link', 'seo_keyword'], 'string', 'max' => 128],
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
            'product_id' => Yii::t('app', 'Product name'),
            'color_id' => Yii::t('app', 'Colour'),
            'application' => Yii::t('app', 'Application'),
            'intro' => Yii::t('app', 'Intro'),
            'description' => Yii::t('app', 'Description'),
            'lean_more_link' => Yii::t('app', 'Lean More Link'),
            'seo_keyword' => Yii::t('app', 'SEO Keyword'),
            'seo_description' => Yii::t('app', 'SEO Description'),
            'status' => Yii::t('app', 'Status'),
            'publish_date' => Yii::t('app', 'Publish Date'),
            'created_date' => Yii::t('app', 'Created Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

    /**
     * Returns the array of possible gallery status values.
     *
     * @return array
     */
    public function getStatusList()
    {
        $statusArray = [
            self::STATUS_PUBLISHED     => 'Published',
            self::STATUS_WAITING    => 'Waiting',
            self::STATUS_DRAFT => 'Draft'
        ];

        return $statusArray;
    }

    /**
     * Returns the gallery status in nice format.
     *
     * @param  null|integer $status Status integer value if sent to method.
     * @return string               Nicely formatted status.
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
}
