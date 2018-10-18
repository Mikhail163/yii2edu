<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $username Настоящие имя пользователя
 * @property string $password_hash
 * @property string $access_token
 * @property int $creator_id
 * @property int $updater_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Task[] $tasksCreated
 * @property Task[] $tasksUpdated
 * @property TaskUser[] $taskUsers
 * @property Task[] $sharedTasks
 * @mixin TimestampBehavior
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	public $password;
	public $password2;
	
	const RELATION_TASKS_CREATED = 'tasksCreated';
	const RELATION_TASKS_UPDATED = 'tasksUpdated';
	const RELATION_TASKS_USERS = 'taskUsers';
	const RELATION_TASKS_SHARED = 'sharedTasks';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
    
    public function behaviors()
    {
    	return [
    			[
    					'class' => TimestampBehavior::class,
    					'updatedAtAttribute' => false,
    			],
    			[
    					'class' => BlameableBehavior::class,
    					'createdByAttribute' => 'creator_id',
    					'updatedByAttribute' => 'updater_id',
    			],
    	];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        	[['username', 'name', 'password', 'password2'], 'required'],
        	['password2', 'compare', 'compareAttribute' => 'password', 'message' => "Пароли не совпадают"],
            [['creator_id', 'updater_id', 'created_at', 'updated_at'], 'integer'],
        	[['username', 'name', 'password', 'password2', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'access_token' => 'Access Token',
            'creator_id' => 'Creator ID',
            'updater_id' => 'Updater ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        	'password' => 'Пароль',
        	'password2' => 'Повторите ввод пароля',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksCreated()
    { 
        return $this->hasMany(Task::className(), ['creator_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksUpdated()
    {
        return $this->hasMany(Task::className(), ['updater_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskUsers()
    {
    	return $this->hasMany(TaskUser::className(), ['user_id' => 'user_id']);
    }
    
    public function getSharedTasks() 
    {
        //ini_set('memory_limit', '1024M');
    	//return 0;
    	return $this->hasMany(Task::className(), ['task_id' => 'task_id'])
    		->via(self::RELATION_TASKS_USERS);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
    	return User::findOne(['username' => $username]);
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
    	return 
    		Yii::$app->getSecurity()->validatePassword(
    			$password,
    			$this->password_hash
    	    );
    }
    
    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
    	return static::findOne($id);
    }
    
    
    public function beforeSave($insert)
    {
    	if (!parent::beforeSave($insert)) {
    		return false;
    	}
    	
    	if ($this->password !== $this->password2)
    		return false;
    	
    	if($insert) {
    		// новая модель
    		$this->auth_key = \Yii::$app->security->generateRandomString();
    	}
    	if ($this->password) {
    		$this->password_hash = \Yii::$app->security
    			->generatePasswordHash($this->password);
    	}
    	
    	return true;
    }
    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	return static::findOne(['access_token' => $token]);
    }
    
    /**
     * @return int|string current user ID
     */
    public function getId()
    {
    	return $this->user_id;
    }
    
    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
    	return $this->auth_key;
    }
    
    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
    	return $this->getAuthKey() === $authKey;
    }
}
