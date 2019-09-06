<?php

$this->title = 'Users';

use app\models\Users;
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
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'login',
            [
                    'attribute' => 'name',
                    'value' => function ($data){
                        return ucfirst($data->name);
                    },
                    'format' => 'text'
            ],
            'last_name',
            [
                'attribute' => 'sex',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'sex',
                    array_merge(['' => 'без фильтра'], $searchModel->getUserSexConstant())
                    , ['class' => 'dropdown btn btn-secondary'])

            ],
            'email:email',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '<div class="col col-12">{view} {update} {delete}</div>',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                            Url::to(['user/view', 'id' => $model->id]),
                                ['class' => 'btn btn-info']
                        );
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                            Url::to(['user/update', 'id' => $model->id]),
                                ['class' => 'btn btn-success']
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::beginForm(['user/delete', 'id' => $model->id], 'post', ['enctype' => 'multipart/form-data'])
                            . Html::input('hidden', 'id', $model->id)
                            . Html::submitButton('<i class="glyphicon glyphicon-trash"></i>', ['class' => 'btn btn-danger p-0',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить этого пользователя?'
                                ]])
                            . Html::endForm();
                    },
                ]
            ]
        ],
    ]); ?>
