<?php
/**
 * Created by andrii
 * Date: 04.09.19
 * Time: 21:50
 */

namespace app\controllers;


use app\models\Address;
use app\models\UserAndAddressForm;
use app\models\Users;
use app\models\UsersSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MyController extends Controller
{


    public function actionIndex(){
        $searchModel = new UsersSearch();

        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate(){

        $model = new UserAndAddressForm();

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('una_create', [
            'model' => $model,
        ]);
    }


    public function actionView($id)
    {

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
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}