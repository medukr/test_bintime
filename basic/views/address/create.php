<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Добавить адрес пользователя: ' .$user->name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователь: ' . $user->name, 'url' => ['user/view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Добавить адрес';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>* - обязательные для заполнения поля</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
