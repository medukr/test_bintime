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

}