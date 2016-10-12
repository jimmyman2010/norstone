<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_gallery_file}}".
 *
 * @property integer $gallery_id
 * @property integer $file_id
 * @property integer $deleted
 */
class GalleryFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_gallery_file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_id', 'file_id'], 'required'],
            [['gallery_id', 'file_id', 'deleted'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gallery_id' => Yii::t('app', 'Gallery ID'),
            'file_id' => Yii::t('app', 'File ID'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }
}
