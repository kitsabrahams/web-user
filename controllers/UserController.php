<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\AuthAssignment;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ConsoleUsersController implements the CRUD actions for ConsoleUsers model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view','delete','update','create'],
                'rules' => [
                    [
                        'actions' => ['index', 'view','delete','update','create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ConsoleUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ConsoleUsers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ConsoleUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {         
            $data = Yii::$app->request->post();
            $model->username = strtolower($data['User']['username']);
            $passwd = $data['User']['password'];
            $model->setPassword($passwd);
            $model->save(false);
            $model->setAuthAssignment($model->user_level, $model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

     public function actionChange()
    {
        $model=$this->findModel(Yii::$app->user->id);
        $model->scenario = 'change';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {         
            $data = Yii::$app->request->post();
            $passwd = $data['User']['new_pass'];
            $model->setPassword($passwd);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else {
            return $this->render('change_pass', [
                'model' => $model,
            ]);
        }
    }

    public function actionReset($id)
    {
        // if(Yii::$app->user->can('super_admin')){
        $model=$this->findModel($id);
        $model->scenario = 'change';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {         
            $data = Yii::$app->request->post();
            $passwd = $data['User']['new_pass'];
            $model->setPassword($passwd);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else {
            return $this->render('reset_pass', [
                'model' => $model,
            ]);
        }

      //   } else {
      //   throw new ForbiddenHttpException('Insufficient privileges to access this area.');
      // }
    }



    /**
     * Updates an existing ConsoleUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $data = Yii::$app->request->post();
                if(isset($data['User']['username'])){
                $model->username = strtolower($data['User']['username']);
                }
                $model->save(false);
                $model->setAuthAssignment($model->user_level, $model->id);
                return $this->redirect(['view', 'id' => $model->id]); 
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing ConsoleUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ConsoleUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConsoleUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
