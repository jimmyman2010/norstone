<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_gallery_related}}".
 *
 * @property integer $gallery_id
 * @property integer $related_id
 * @property integer $sorting
 * @property integer $deleted
 */
class GalleryRelated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_gallery_related}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_id', 'related_id'], 'required'],
            [['gallery_id', 'related_id', 'sorting', 'deleted'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gallery_id' => Yii::t('app', 'Gallery ID'),
            'related_id' => Yii::t('app', 'Related ID'),
            'sorting' => Yii::t('app', 'Sorting'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }
}
