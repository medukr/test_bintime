<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Add  User Address: ' .$user->name;
$this->params['breadcrumbs'][] = ['label' => 'User: ' . $user->name, 'url' => ['user/view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Create address';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>* - обязательные для заполнения поля</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
