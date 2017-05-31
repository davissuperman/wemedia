<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PublisherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publishers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publisher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Publisher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fromurl:url',
            'title',
            'readmax',
            'starttime',
            // 'endtime',
            // 'createtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
