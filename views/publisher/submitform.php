<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publisher */
/* @var $form ActiveForm */
?>
<div class="submitform">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fromurl') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'readmax') ?>
        <?= $form->field($model, 'starttime') ?>
        <?= $form->field($model, 'endtime') ?>
        <?= $form->field($model, 'createtime') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- submitform -->
