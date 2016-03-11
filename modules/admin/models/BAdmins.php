<?php

namespace app\modules\admin\models;

use Yii;
/**
 * This is the model class for table "b_admins".
 *
 * @property integer $id
 * @property string $name
 * @property string $password
 */
class BAdmins extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	public $rememberMe = true;
	
	private $_user = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'password'], 'required'],
			['rememberMe', 'boolean'],
            [['name', 'password'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }
	
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return findOne(['access_token' => $token]);
    }
    /**
     * Finds user by name
     *
     * @param  string      $name
     * @return static|null
     */
    public static function findByUsername($name)
    {
        return self::find()->where(['name' => $name])->one();
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = self::findByUsername($this->name);
        }

        return $this->_user;
    }
    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}
