<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "extras_price".
 *
 * @property integer $id
 * @property integer $id_product
 * @property integer $one_hour
 * @property integer $six_hour
 * @property integer $twelve_hours
 * @property integer $one_week
 */
class ExtrasPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'extras_price';
    }

    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id_product' => 'id_product']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'one_hour', 'six_hour', 'twelve_hours', 'one_week'], 'required'],
            [['id_product', 'one_hour', 'six_hour', 'twelve_hours', 'one_week'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'one_hour' => 'One Hour',
            'six_hour' => 'Six Hour',
            'twelve_hours' => 'Twelve Hours',
            'one_week' => 'One Week',
        ];
    }
}
