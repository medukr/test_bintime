<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Update User Address: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User: ' . $model->user_id, 'url' => ['user/view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update address';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
