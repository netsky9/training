<?php

namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    /*
    * Указываем, к какой таблице обращаться, через модель Product
    */
    public static function tableName()
    {
        return 'products';
    }
}
