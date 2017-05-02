<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reporte;

/**
 * ReporteSearch represents the model behind the search form about `app\models\Reporte`.
 */
class ReporteSearch extends Reporte
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reportador_id', 'reportado_id', 'publicacion_id'], 'integer'],
            [['cuerpo'], 'safe'],
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
        $query = Reporte::find();

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
            'reportador_id' => $this->reportador_id,
            'reportado_id' => $this->reportado_id,
            'publicacion_id' => $this->publicacion_id,
        ]);

        $query->andFilterWhere(['like', 'cuerpo', $this->cuerpo]);

        return $dataProvider;
    }
}
