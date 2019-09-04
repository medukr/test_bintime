<?php
/**
 * Created by andrii
 * Date: 04.09.19
 * Time: 22:12
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Добавить пользователя';

?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('address_form', [
        'model' => $model,
    ]) ?>

</div>