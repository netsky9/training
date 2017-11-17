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
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function getProductsOrders()
    {
        return $this->hasMany(ProductsOrders::className(), ['id_order' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'datetime', 'status'], 'required'],
            [['id_user'], 'integer'],
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
            'id' => 'ID',
            'id_user' => 'Id User',
            'datetime' => 'Datetime',
            'status' => 'Status',
        ];
    }
}
