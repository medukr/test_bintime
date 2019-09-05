<?php

$this->title = 'Users';

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="user-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить подльзователя', ['user/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'login',
            'password',
            [
                    'attribute' => 'name',
                    'value' => function ($data){
                        return ucfirst($data->name);
                    },
                    'format' => 'text'

            ],
            'last_name',
            'sex',
            'created_ad',
            'email:email',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                            Url::to(['user/view', 'id' => $model->id])
                        );
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                            Url::to(['user/update', 'id' => $model->id])
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>',
                            Url::to(['user/delete', 'id' => $model->id])
                        );
                    },
                ]
            ]
        ],
    ]); ?>
