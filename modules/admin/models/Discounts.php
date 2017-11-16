<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "discounts".
 *
 * @property integer $id_discount
 * @property integer $id_product
 * @property integer $percent
 * @property string $discount_start
 * @property string $discount_end
 */
class Discounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'percent', 'discount_start', 'discount_end'], 'required'],
            [['id_product', 'percent'], 'integer'],
            [['discount_start', 'discount_end'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_discount' => 'Id Discount',
            'id_product' => 'Id Product',
            'percent' => 'Percent',
            'discount_start' => 'Discount Start',
            'discount_end' => 'Discount End',
        ];
    }
}
