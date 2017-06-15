<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fund', 'sex', 'status'], 'integer'],
            [['openid', 'nickname', 'telephone', 'birthday', 'age', 'industry', 'position', 'hobbies', 'habits', 'residence', 'trip', 'educational', 'marital', 'auth_key'], 'safe'],
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
        $query = Users::find();

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
            'fund' => $this->fund,
            'birthday' => $this->birthday,
            'sex' => $this->sex,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'industry', $this->industry])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'hobbies', $this->hobbies])
            ->andFilterWhere(['like', 'habits', $this->habits])
            ->andFilterWhere(['like', 'residence', $this->residence])
            ->andFilterWhere(['like', 'trip', $this->trip])
            ->andFilterWhere(['like', 'educational', $this->educational])
            ->andFilterWhere(['like', 'marital', $this->marital])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}
