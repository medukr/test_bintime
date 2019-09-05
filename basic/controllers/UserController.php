<?php
/**
 * Created by andrii
 * Date: 05.09.19
 * Time: 12:09
 */

namespace app\controllers;


use app\models\UserAndAddressForm;
use app\models\Users;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{


    public function actionCreate(){

        $model = new UserAndAddressForm();

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            Yii::$app->session->setFlash('success', 'Пользователь успешно добавлен');
            return $this->redirect(['view', 'id' => $model->user_id]);
        }else {
            Yii::$app->session->setFlash('error', 'Ошибка при добавленни пользователя');
        }

        return $this->render('una_create', [
            'model' => $model,
        ]);
    }

    public function actionView($id){
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getAddress(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Пользователь успешно обновлен');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при обновлении пользователя');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(){

    }

    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}