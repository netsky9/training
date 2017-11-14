<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id_order
 * @property integer $id_product
 * @property integer $id_user
 * @property string $datetime
 * @property integer $count
 * @property integer $sum
 * @property integer $id_discount
 * @property string $status
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id_product' => 'id_product']);
    }

    public function getBuyers()
    {
        return $this->hasOne(Buyers::className(), ['id_user' => 'id_user']);
    }


    /*public function getProductsById($id)
    {
        return $this->find();
    } */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_user', 'datetime', 'count', 'sum', 'id_discount', 'status'], 'required'],
            [['id_product', 'id_user', 'count', 'sum', 'id_discount'], 'integer'],
            [['datetime'], 'safe'],
            [['status'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'id_product' => 'Product',
            'id_user' => 'User',
            'datetime' => 'Datetime',
            'count' => 'Count',
            'sum' => 'Sum',
            'id_discount' => 'Id Discount',
            'status' => 'Status',
        ];
    }
}
