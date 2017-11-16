<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id_user
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'auth_key', 'name', 'last_name', 'phone', 'email'], 'required'],
            [['username'], 'string', 'max' => 200],
            [['password', 'auth_key'], 'string', 'max' => 500],
            [['name', 'last_name', 'phone', 'email'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email',
        ];
    }
}
