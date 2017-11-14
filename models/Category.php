<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    /*
    * Указываем, к какой таблице обращаться, через модель
    */
    public static function tableName()
    {
        return 'categories';
    }
}
