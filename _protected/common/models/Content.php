<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_content}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $image_id
 * @property string $content_type
 * @property string $status
 * @property integer $using_page_builder
 * @property string $content
 * @property integer $parent_id
 * @property integer $published_date
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_description
 * @property integer $show_in_menu
 * @property integer $updated_date
 * @property integer $created_date
 * @property string $created_by
 * @property integer $deleted
 */
class Content extends \yii\db\ActiveRecord
{
    const TYPE_PAGE = 'page';
    const TYPE_NEWS = 'news';

    const STATUS_DRAFT = 'draft';
    const STATUS_WAITING = 'waiting';
    const STATUS_PUBLISHED = 'published';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_date', 'created_by', 'content_type'], 'required'],
            [['content_type', 'status', 'content'], 'string'],
            [['image_id', 'published_date', 'show_in_menu', 'parent_id', 'using_page_builder', 'updated_date', 'created_date', 'deleted'], 'integer'],
            [['name', 'seo_description'], 'string', 'max' => 256],
            [['slug', 'seo_title', 'seo_keyword'], 'string', 'max' => 128],
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
            'image_id' => Yii::t('app', 'Image'),
            'content_type' => Yii::t('app', 'Content Type'),
            'status' => Yii::t('app', 'Status'),
            'published_date' => Yii::t('app', 'Published Date'),
            'using_page_builder' => Yii::t('app', 'Using page builder'),
            'content' => Yii::t('app', 'Content'),
            'parent_id' => Yii::t('app', 'Parent'),
            'seo_title' => Yii::t('app', 'SEO Title'),
            'seo_keyword' => Yii::t('app', 'SEO Keyword'),
            'seo_description' => Yii::t('app', 'SEO Description'),
            'show_in_menu' => Yii::t('app', 'Show In Menu'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'created_date' => Yii::t('app', 'Created Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }

    /**
     * Returns the array of possible type content values.
     *
     * @return array
     */
    public function getTypeList()
    {
        $typeArray = [
            self::TYPE_PAGE    => 'Page',
            self::TYPE_NEWS    => 'News',
        ];

        return $typeArray;
    }

    /**
     * Returns the array of possible content status values.
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
     * Returns the content status in nice format.
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
                $exist = Content::findOne(['slug' => $result]);
            }
            else {
                $exist = Content::findOne(['AND', ['=', 'slug', $result], ['<>', 'id', $id]]);
            }
            if($exist === null) {
                break;
            }
            $i++;
        }
        return $result;
    }
}
