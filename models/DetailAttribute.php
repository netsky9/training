<?php

namespace app\models;
use yii\db\ActiveRecord;

class Details extends ActiveRecord
{
    public static function tableName()
    {
        return 'detail_value';
    }
}
