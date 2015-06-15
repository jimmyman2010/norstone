<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Gallery;

/**
 * GallerySearch represents the model behind the search form about `common\models\Gallery`.
 */
class GallerySearch extends Gallery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'application', 'image_id', 'publish_date', 'created_date', 'created_by', 'deleted'], 'integer'],
            [['name', 'slug', 'product_id', 'intro', 'description', 'lean_more_link', 'seo_keyword', 'seo_description', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param int $pageSize
     * @param bool $published
     *
     * @return ActiveDataProvider
     */
    public function search($params, $pageSize = 10, $published = false)
    {
        $query = Gallery::find();
        if(isset($params['gallery_id'])) {
            $query->innerJoin('tbl_gallery_related', 'tbl_gallery.id = tbl_gallery_related.related_id');
            $query->where(['tbl_gallery.deleted' => 0,
                'tbl_gallery_related.deleted' => 0,
                'tbl_gallery_related.gallery_id' => intval($params['gallery_id'])
            ]);
            $query->orderBy('sorting');
        } else {
            $query->joinWith(['product']);
            $query->where('tbl_gallery.deleted = 0');
        }

        if($published) {
            $this->status = Gallery::STATUS_PUBLISHED;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
        $dataProvider->sort->attributes['product'] = [
            'asc' => ['tbl_product.name' => SORT_ASC],
            'desc' => ['tbl_product.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'slug' => $this->slug,
            'application' => $this->application,
            'image_id' => $this->image_id,
            'publish_date' => $this->publish_date,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_gallery.name', $this->name])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'lean_more_link', $this->lean_more_link])
            ->andFilterWhere(['like', 'seo_keyword', $this->seo_keyword])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
