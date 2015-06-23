<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
            [['id', 'image_id', 'percent', 'viewed', 'published_date', 'created_date', 'activated', 'deleted'], 'integer'],
            [['name', 'slug', 'description', 'seo_title', 'seo_keyword', 'seo_description', 'general', 'info_tech', 'status', 'created_by'], 'safe'],
            [['price_init', 'price', 'price_sell'], 'number'],
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
    public function search($params, $pageSize = 15, $published = false)
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
            $query->where('tbl_product.deleted = 0');
        }

        if($published) {
            $this->status = Product::STATUS_INSTOCK;
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'image_id' => $this->image_id,
            'price_init' => $this->price_init,
            'price' => $this->price,
            'price_sell' => $this->price_sell,
            'percent' => $this->percent,
            'viewed' => $this->viewed,
            'published_date' => $this->published_date,
            'created_date' => $this->created_date,
            'activated' => $this->activated,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keyword', $this->seo_keyword])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'general', $this->general])
            ->andFilterWhere(['like', 'info_tech', $this->info_tech])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
