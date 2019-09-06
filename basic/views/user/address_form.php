<?php

use app\models\Users;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm


 * This is the model class for table "address".
 *
 * @property int $id
 * @property int $user_id
 * @property string $post_index
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $house
 * @property int $office
 */

?>

<div class="users-form">

    <?php $form = ActiveForm::begin( ['method' => 'post']); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('login').':') ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('password').':') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('name').':') ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('last_name').':') ?>

    <?= $form->field($model, 'sex')->radioList($model->getUserModel()->getUserSexConstant())->label('*Укажите пол:') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('*'. $model->getAttributeLabel('email').':') ?>

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
