<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Update User: ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'User: ' . $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>* - обязательные для заполнения поля</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
