<?php
/**
 * Created by andrii
 * Date: 05.09.19
 * Time: 12:05
 */

namespace app\controllers;


use app\models\Address;
use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AddressController extends Controller
{

    public function actionCreate($id){
        $model = new Address();
        $user = $this->findUserModel($id);

        if (!empty($user) && $model->load(Yii::$app->request->post())){
            print_r('address Create');
            die;
        }
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->save()){
                Yii::$app->session->setFlash('success', 'Адресс успешно обновлен');
                return $this->redirect(['user/view', 'id' => $model->id]);
            }else {
                Yii::$app->session->setFlash('success', 'Ошибка при обновлении адресса');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
//have to be POST
    public function actionDelete($id){

        $model = $this->findModel($id);

        if (!empty($model)){

            if  ($model->disable()) {
                Yii::$app->session->setFlash('success', 'Адресс успешно удален');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка! Действие не удалось');
            }


        }
        return $this->redirect(['user/view' , 'id' => $model->user_id]);

    }


    protected function findUserModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findModel($id)
    {
        if (($model = Address::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}