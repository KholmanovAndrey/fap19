<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\modules\admin\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'position', 'publication'], 'integer'],
            [['id_product', 'name', 'alias', 'condition', 'bodywork', 'number', 'engine', 'age', 'l_r', 'f_r', 'u_d', 'color', 'noticy', 'price', 'image', 'status', 'authenticity'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'position' => $this->position,
            'publication' => $this->publication,
        ]);

        $query->andFilterWhere(['like', 'id_product', $this->id_product])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'bodywork', $this->bodywork])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'engine', $this->engine])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'l_r', $this->l_r])
            ->andFilterWhere(['like', 'f_r', $this->f_r])
            ->andFilterWhere(['like', 'u_d', $this->u_d])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'noticy', $this->noticy])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'authenticity', $this->authenticity]);

        return $dataProvider;
    }
}
