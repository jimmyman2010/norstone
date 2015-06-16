<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_description
 * @property integer $parent_id
 * @property integer $cat_type
 * @property integer $sorting
 * @property integer $activated
 * @property integer $deleted
 */
class Category extends \yii\db\ActiveRecord
{
    const CAT_TYPE_PRODUCT = 0;
    const CAT_TYPE_ARTICLE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['cat_type', 'sorting', 'activated', 'deleted'], 'integer'],
            [['name', 'seo_description'], 'string', 'max' => 256],
            [['slug', 'seo_title', 'seo_keyword'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 2048],
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
            'description' => Yii::t('app', 'Description'),
            'seo_title' => Yii::t('app', 'SEO Title'),
            'seo_keyword' => Yii::t('app', 'SEO Keyword'),
            'seo_description' => Yii::t('app', 'SEO Description'),
            'cat_type' => Yii::t('app', 'Type'),
            'parent_id' => Yii::t('app', 'Parent'),
            'sorting' => Yii::t('app', 'Sorting'),
            'activated' => Yii::t('app', 'Activated'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @param int $id
     * @param int $type
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getParents($id = 0, $type = 0)
    {
        if($id && $id > 0) {
            return Category::find()->where("cat_type = '$type' AND deleted = 0 AND parent_id = 0 AND id != '$id'")->all();
        }
        else {
            return Category::find()->where(['cat_type' => $type, 'deleted' => 0, 'parent_id' => 0])->all();
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
                $exist = Category::findOne(['slug' => $result]);
            }
            else {
                $exist = Category::findOne(['AND', ['=', 'slug', $result], ['<>', 'id', $id]]);
            }
            if($exist === null) {
                break;
            }
            $i++;
        }
        return $result;
    }

    /**
     * @param int $type
     * @return array
     */
    public static function getTree($type = 0)
    {
        $result = [];
        $parent = self::getParents(0, $type);
        foreach($parent as $papa) {
            $tmp['id'] = $papa->id;
            $tmp['name'] = $papa->name;
            $tmp['activated'] = $papa->activated;
            $result[] = $tmp;
            foreach(Category::find()->where(['deleted' => 0, 'parent_id' => $papa->id])->all() as $child) {
                $tmp['id'] = $child->id;
                $tmp['name'] = ' |__ ' . $child->name;
                $tmp['activated'] = $papa->activated;
                $result[] = $tmp;
            }
        }
        return $result;
    }
}
