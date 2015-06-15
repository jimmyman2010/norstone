<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'image_id', 'percent', 'viewed', 'published_date', 'created_date', 'deleted'], 'integer'],
            [['name', 'slug', 'description', 'seo_keyword', 'seo_description', 'general', 'info_tech', 'status', 'created_by'], 'safe'],
            [['price', 'price_new'], 'number'],
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
        $query = Product::find();
        if(isset($params['product_id'])) {
            $query->innerJoin('tbl_product_related', 'tbl_product.id = tbl_product_related.related_id');
            $query->where(['tbl_product.deleted' => 0,
                'tbl_product_related.deleted' => 0,
                'tbl_product_related.product_id' => intval($params['product_id'])
            ]);
            $query->orderBy('sorting');
        } else {
            $query->joinWith(['category']);
            $query->where('tbl_product.deleted = 0');
        }

        if($published) {
            $this->status = Product::STATUS_PUBLISHED;
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);

        $dataProvider->sort->attributes['category'] = [
            'asc' => ['tbl_category.name' => SORT_ASC],
            'desc' => ['tbl_category.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'image_id' => $this->image_id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'price_new' => $this->price_new,
            'percent' => $this->percent,
            'viewed' => $this->viewed,
            'published_date' => $this->published_date,
            'created_date' => $this->created_date,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'seo_keyword', $this->seo_keyword])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'general', $this->general])
            ->andFilterWhere(['like', 'info_tech', $this->info_tech])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
