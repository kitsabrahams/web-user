<?php

namespace app\controllers;

use Yii;
use app\models\InsuranceCompanies;
use app\models\InsuranceCompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\web\ForbiddenHttpException;
/**
 * InsuranceController implements the CRUD actions for InsuranceCompanies model.
 */
class InsuranceController extends Controller
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
     * Lists all InsuranceCompanies models.
     * @return mixed
     */
    public function actionIndex()
    {
            $searchModel = new InsuranceCompaniesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $model = new InsuranceCompanies();
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model'=>$model,
            ]);
    }

    /**
     * Displays a single InsuranceCompanies model.
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
     * Creates a new InsuranceCompanies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

        public function actionCreate()
        {
             if (Yii::$app->request->isAjax) {
                $this->layout = false;
             }

            $model = new InsuranceCompanies();
            $searchModel = new InsuranceCompaniesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
            if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                            return ActiveForm::validate($model);
                }

            $model->attributes = $_POST['InsuranceCompanies'];

            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
            else
                return $this->render('index', [
                    'model' => $model,'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    ]);
                
            } else {
                return $this->render('index', [
                    'model' => $model,'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                ]);
            }
    }

    /**
     * Updates an existing InsuranceCompanies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new InsuranceCompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        if ($model->load(Yii::$app->request->post())) {
        if (Yii::$app->request->isAjax) {
                        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return ActiveForm::validate($model);
            }

        $model->attributes = $_POST['InsuranceCompanies'];

        if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        else
            return $this->render('index', [
                'model' => $model,'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                ]);
            
        } else {
            return $this->render('index', [
                'model' => $model,'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing InsuranceCompanies model.
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
     * Finds the InsuranceCompanies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InsuranceCompanies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsuranceCompanies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
