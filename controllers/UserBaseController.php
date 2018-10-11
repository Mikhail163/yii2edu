<?php

namespace app\controllers;

use Yii;
use app\models\UserBase;
use app\models\search\UserBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Task;
use app\models\TaskUser;

/**
 * UserBaseController implements the CRUD actions for UserBase model.
 */
class UserBaseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Учебный класс тест.
     * @return mixed
     */
    public function actionTest()
    {
    	// Создаем новый объект User
    	$model = new UserBase();   	
    	$model->load(
    		[
    			'username' => 'тестовый пользователь',
    			'password_hash' => 'hash',
    			'access_token' => 'token',
    			'creator_id' => 0,
    			'created_at' => time(),
    		]
    	);
    	$model->save();
    	
    	/*
    	 * Прочитать из базы все записи из User применив жадную подгрузку 
    	 * связанных данных из Task, с запросами без JOIN.
    	 */
    	
    	$models = Task::find()->with(UserBase::RELATION_USERS_CREATED)->all();
    	
    	
    	
    	/*
         * Прочитать из базы все записи из User применив жадную подгрузку 
         * связанных данных из Task, с запросом содержащим JOIN.
    	 */
    }
    
    /**
     * Lists all UserBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserBaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserBase model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserBase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserBase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
