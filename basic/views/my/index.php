<?php

$this->title = 'Users';

use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="user-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить подльзователя', ['create'], ['class' => 'btn btn-success']) ?>
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
                'template' => '{view} {update}',
            ]
        ],
    ]); ?>
