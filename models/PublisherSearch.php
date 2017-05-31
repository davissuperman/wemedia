<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Publisher;

/**
 * PublisherSearch represents the model behind the search form about `app\models\Publisher`.
 */
class PublisherSearch extends Publisher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'readmax'], 'integer'],
            [['fromurl', 'title', 'starttime', 'endtime', 'createtime'], 'safe'],
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
        $query = Publisher::find();

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
            'readmax' => $this->readmax,
            'starttime' => $this->starttime,
            'endtime' => $this->endtime,
            'createtime' => $this->createtime,
        ]);

        $query->andFilterWhere(['like', 'fromurl', $this->fromurl])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
