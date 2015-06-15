<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductRelated;

/**
 * ProductRelatedSearch represents the model behind the search form about `common\models\ProductRelated`.
 */
class ProductRelatedSearch extends ProductRelated
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'related_id', 'sorting', 'deleted'], 'integer'],
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
        $query = ProductRelated::find();
        $query->where('deleted = 0');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'product_id' => $this->product_id,
            'related_id' => $this->related_id,
            'sorting' => $this->sorting,
            'deleted' => $this->deleted,
        ]);

        return $dataProvider;
    }
}
