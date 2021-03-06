<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_gallery_tag}}".
 *
 * @property integer $gallery_id
 * @property integer $tag_id
 * @property integer $deleted
 */
class GalleryTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_gallery_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_id', 'tag_id'], 'required'],
            [['gallery_id', 'tag_id', 'deleted'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gallery_id' => Yii::t('app', 'Gallery ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }
}
