<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use app\models\User;
use app\models\TaskUser;
use app\models\search\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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
     * Lists all Task models.
     * @return mixed
     */
    /*
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    */
    
    public function actionMy()
    {
    	$searchModel = new TaskSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	/** @var $query TaskQuery */
    	$query = $dataProvider->query;
    	$query->byCreator(Yii::$app->user->id);
    	
    	return $this->render('my', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    }
    
    public function actionShared()
    {
    	$searchModel = new TaskSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	/** @var $query TaskQuery */
    	$query = $dataProvider->query;
    	$query->byCreator(Yii::$app->user->id)
    		  ->innerJoinWith(Task::RELATION_TASK_USERS);
    	
    	return $this->render('shared', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    }
    
    public function actionAccessed()
    {
    	$searchModel = new TaskSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	/** @var $query TaskQuery */
    	$query = $dataProvider->query;
    	
    	
    	
    	$query->innerJoinWith(Task::RELATION_TASK_USERS)
    		  ->where(['user_id' => Yii::$app->user->id]);
    	
    	return $this->render('accessed', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	
    	$model = $this->findModel($id);
    	
    	$query = $model->getTaskUsers();
    	
    	$userTable = User::tableName();
    	$taskUserTable = TaskUser::tableName();
    	
    	$query->innerJoinWith($userTable, ["{$userTable}.user_id" => "{$taskUserTable}.user_id"]);
    	$query->select(["{$userTable}.user_id", "{$userTable}.username", "{$userTable}.name"]);
    	
    	$dp = new ActiveDataProvider([
    			'query' => $query,
    	]);
    	
        return $this->render('view', [
        		'model' => $model,
        		'dp' => $dp,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post())) {
        	
        	$model->creator_id = Yii::$app->user->id;
        	$model->created_at = time();
        	$model->scenario = Task::SCENARIO_CREATE;
        	
        	if(!$model->save()) {
        		print_r($model->errors);
        		exit();
        	}
        	else
            	return $this->redirect(['view', 'id' => $model->task_id]);
        }

        
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
        	$model->updater_id = Yii::$app->user->id;
        	$model->updated_at = time();
        	$model->scenario = Task::SCENARIO_UPDATE;
        	
        	if(!$model->save()) {
        		print_r($model->errors);
        		exit();
        	}
        	else
        		return $this->redirect(['view', 'id' => $model->task_id]);
        	
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    

    /**
     * Deletes an existing Task model.
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
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
