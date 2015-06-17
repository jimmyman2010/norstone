<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_content_element}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $content_id
 * @property string $content_type
 * @property string $content
 * @property integer $hide
 * @property integer $deleted
 */
class ContentElement extends \yii\db\ActiveRecord
{
    const TYPE_TEXT = 'text';
    const TYPE_IMAGE = 'image';
    const TYPE_TEXTAREA = 'textarea';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_content_element}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content_id', 'content_type', 'content'], 'required'],
            [['content_id', 'hide', 'deleted'], 'integer'],
            [['content_type', 'content'], 'string'],
            [['title'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content_id' => Yii::t('app', 'Content ID'),
            'content_type' => Yii::t('app', 'Content Type'),
            'content' => Yii::t('app', 'Content'),
            'hide' => Yii::t('app', 'Hide'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }

    /**
     * Returns the array of possible type element values.
     *
     * @return array
     */
    public function getTypeList()
    {
        $typeArray = [
            self::TYPE_TEXT    => 'Text',
            self::TYPE_IMAGE   => 'Image',
            self::TYPE_TEXTAREA => 'Textarea'
        ];

        return $typeArray;
    }
}
