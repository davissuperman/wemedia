<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Telephone */

$this->title = 'Create Telephone';
$this->params['breadcrumbs'][] = ['label' => 'Telephones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telephone-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
