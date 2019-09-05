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
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AddressController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionCreate($id){
        $model = new Address();
        $user = $this->findUserModel($id);

        if ($model->load(Yii::$app->request->post())){

            $model->user_id = $user->id;

            if ($model->save()){
                Yii::$app->session->setFlash('success', 'Адресс успешно добавлен');
                return $this->redirect(['user/view', 'id' => $model->user_id]);
            }else {
                Yii::$app->session->setFlash('success', 'Ошибка при добавления адресса');
            }
        }

        return $this->render('create', ['model' => $model,
            'user' => $user]);
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()){
                Yii::$app->session->setFlash('success', 'Адресс успешно обновлен');
                return $this->redirect(['user/view', 'id' => $model->user_id]);
            }else {
                Yii::$app->session->setFlash('success', 'Ошибка при обновлении адресса');
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(){

        if (Yii::$app->request->post() && Yii::$app->request->validateCsrfToken()) {

            $model = $this->findModel(Yii::$app->request->post('id'));

            if ($model->disable()) {
                Yii::$app->session->setFlash('success', 'Адресс успешно удален');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка! Не удалось удалить');
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