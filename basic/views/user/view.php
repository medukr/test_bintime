<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'User: ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Измеить данные пользователя',
        Url::to(['user/update', 'id' => $model->id]),
        ['class' => 'btn btn-success']
    ); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
//            'password',
            'name',
            'last_name',
            'sex',
            'created_ad',
            'email:email',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'post_index',
            'country',
            'city',
            'street',
            'house',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                            Url::to(['address/update', 'id' => $model->id]),
                                ['class' => 'btn btn-success']
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::beginForm(['address/delete', 'id' => $model->id], 'post', ['enctype' => 'multipart/form-data'])
                            . Html::input('hidden', 'id', $model->id)
                            . Html::submitButton('<i class="glyphicon glyphicon-trash"></i>', ['class' => 'btn btn-danger',
                                'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить этот адрес'
                                ]])
                            . Html::endForm();
                    },
                ]
            ]
        ],
    ]); ?>

    <p>
        <?= Html::a('Добавить адресс', ['address/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
</div>
