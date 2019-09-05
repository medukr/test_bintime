<?php

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

    <?= $form->field($model, 'login')->textInput(['maxlength' => true])->label('* Логин:') ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->radioList([1 => 'Мужской', 2 => 'Женский'])->label('Укажите пол') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_index')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'house')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'office')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
