<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $datetime
 * @property string $status
 */
class ProductsOrders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_orders';
    }

    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id_product' => 'id_product']);
    }

    public function getOrders()
    {
        return $this->hasOne(ProductsOrders::Orders(), ['id' => 'id_order']);
    }
}
