<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="users-form">

    <?php $form = ActiveForm::begin( ['method' => 'post']); ?>

    <?= $form->field($model, 'post_index')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('post_index').':') ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('country').':')?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('city').':') ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('street').':') ?>

    <?= $form->field($model, 'house')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('house').':') ?>

    <?= $form->field($model, 'office')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
