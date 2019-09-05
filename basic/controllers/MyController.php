<?php
/**
 * Created by andrii
 * Date: 04.09.19
 * Time: 21:50
 */

namespace app\controllers;



use app\models\Users;
use app\models\UsersSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MyController extends Controller
{

    public function actionIndex(){
        $searchModel = new UsersSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}