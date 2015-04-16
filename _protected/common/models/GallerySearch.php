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
            [['id', 'application', 'publish_date', 'created_date', 'created_by', 'deleted'], 'integer'],
            [['name', 'product_id', 'color_id', 'intro', 'description', 'lean_more_link', 'seo_keyword', 'seo_description', 'status'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Gallery::find();
        if(isset($params['gallery_id'])) {
            $query->innerJoin('tbl_gallery_related', 'tbl_gallery.id = tbl_gallery_related.related_id');
            $query->where(['tbl_gallery.deleted' => 0,
                'tbl_gallery_related.deleted' => 0,
                'tbl_gallery_related.gallery_id' => intval($params['gallery_id'])
            ]);
        } else {
            $query->joinWith(['product', 'color']);
            $query->where('tbl_gallery.deleted = 0');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['product'] = [
            'asc' => ['tbl_product.name' => SORT_ASC],
            'desc' => ['tbl_product.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['color'] = [
            'asc' => ['tbl_color.name' => SORT_ASC],
            'desc' => ['tbl_color.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'application' => $this->application,
            'publish_date' => $this->publish_date,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'tbl_gallery.name', $this->name])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'lean_more_link', $this->lean_more_link])
            ->andFilterWhere(['like', 'seo_keyword', $this->seo_keyword])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'tbl_product.name', $this->product_id])
            ->andFilterWhere(['like', 'tbl_color.name', $this->color_id]);

        return $dataProvider;
    }
}
