<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "buyers".
 *
 * @property integer $id_user
 * @property string $name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 */
class Buyers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buyers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'last_name', 'phone', 'email'], 'required'],
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
            'name' => 'Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email',
        ];
    }
}
