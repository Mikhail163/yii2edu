<?php

namespace app\controllers;

use Yii;
use app\models\TaskUser;
use app\models\Task;
use app\models\User;
use app\models\search\TaskUser as TaskUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * TaskUserController implements the CRUD actions for TaskUser model.
 */
class TaskUserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        	'access' => [
        		'class' => AccessControl::className(),
        		'rules' => [
        			[
        				'allow' => true,
        				'roles' => ['@'],
        			],
        		],
        	],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TaskUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaskUser model.
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
     * Creates a new TaskUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($taskId)
    {
    	$task = Task::findOne($taskId);
    	
    	// Настраиваем параметры безопасности
    	if (!$task || $task->creator_id != Yii::$app->user->id) {
    		throw new ForbiddenHttpException();
    	}
    	
        $model = new TaskUser();
        $model->task_id = $taskId;

        // После загрузки данных редеректим на страницу просмотра задач
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	// Выводим сообщение что все ок
        	Yii::$app->session->setFlash('success', 'Доступ предоставлен');
            return $this->redirect(['task/my']);
        }
        
        // Достаем пользователей - у которых уже есть доступ к задаче $taskId
        $usersOnTask = Task::getTaskUsersId($taskId);
        
        // Получаем пользователей - у которых нет доступа к задаче $taskId
        $users = User::find()
        	->select('username')
        	->andWhere(['not in', 'user_id',  $usersOnTask])
        	->andWhere(['<>', 'user_id', Yii::$app->user->id])
        	->indexBy('user_id')
        	->column();
   
        
        return $this->render('create', [
            'model' => $model,
        	'users' => $users,
        ]);
    }
    
    public function actionUnshareAll($taskId)
    {
    	$task = Task::findOne($taskId);
    	
    	// Настраиваем параметры безопасности
    	if (!$task || $task->creator_id != Yii::$app->user->id) {
    		throw new ForbiddenHttpException();
    	}
    	
    	$task->unlinkAll(Task::RELATION_SHARED_USERS, true);
    	
    	Yii::$app->session->setFlash('success', 'Доступ для всех пользователей удален');
    	
    	return $this->redirect(['task/shared']);
    }

    /**
     * Updates an existing TaskUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->task_user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaskUser model.
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
     * Finds the TaskUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
