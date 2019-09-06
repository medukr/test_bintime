<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="users-form">

    <?php $form = ActiveForm::begin( ['method' => 'post']); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('login').':') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('name').':') ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('last_name').':') ?>

    <?= $form->field($model, 'sex')->radioList($model->getUserSexConstant())->label('*Укажите пол:') ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('email').':') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
