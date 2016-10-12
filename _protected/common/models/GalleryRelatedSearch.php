<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GalleryRelated;

/**
 * GalleryRelatedSearch represents the model behind the search form about `common\models\GalleryRelated`.
 */
class GalleryRelatedSearch extends GalleryRelated
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_id', 'related_id', 'sorting', 'deleted'], 'integer'],
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
        $query = GalleryRelated::find();
        $query->where('deleted = 0');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'gallery_id' => $this->gallery_id,
            'related_id' => $this->related_id,
            'sorting' => $this->sorting,
        ]);

        return $dataProvider;
    }
}
