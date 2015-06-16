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
 * @property integer $parent_id
 * @property integer $sorting
 * @property integer $deleted
 */
class Category extends \yii\db\ActiveRecord
{
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
            [['sorting', 'deleted'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['slug'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 2048]
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
            'parent_id' => Yii::t('app', 'Parent'),
            'sorting' => Yii::t('app', 'Sorting'),
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
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getParents($id = 0)
    {
        if($id && $id > 0) {
            return Category::find()->where("deleted = 0 AND parent_id = 0 AND id != '$id'")->all();
        }
        else {
            return Category::find()->where(['deleted' => 0, 'parent_id' => 0])->all();
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

    public static function getTree()
    {
        $result = [];
        $parent = self::getParents();
        foreach($parent as $papa) {
            $tmp['id'] = $papa->id;
            $tmp['name'] = $papa->name;
            $result[] = $tmp;
            foreach(Category::find()->where(['deleted' => 0, 'parent_id' => $papa->id])->all() as $child) {
                $tmp['id'] = $child->id;
                $tmp['name'] = ' |__ ' . $child->name;
                $result[] = $tmp;
            }
        }
        return $result;
    }
}
