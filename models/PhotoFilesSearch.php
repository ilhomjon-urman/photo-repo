<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PhotoFiles;

/**
 * PhotoFilesSearch represents the model behind the search form of `app\models\PhotoFiles`.
 */
class PhotoFilesSearch extends PhotoFiles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'album_id', 'created_at'], 'integer'],
            [['original_name', 'changed_name'], 'safe'],
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
        $query = PhotoFiles::find();

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
            'album_id' => $this->album_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'original_name', $this->original_name])
            ->andFilterWhere(['like', 'changed_name', $this->changed_name]);

        return $dataProvider;
    }
}
