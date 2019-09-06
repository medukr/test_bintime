<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Изменить адрес пользователя: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователь: ' . $model->user_id, 'url' => ['user/view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Изменить адрес';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>* - обязательные для заполнения поля</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
