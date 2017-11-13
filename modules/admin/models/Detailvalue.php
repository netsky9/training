<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "detail_value".
 *
 * @property integer $id_detail_value
 * @property integer $id_detail_attribute
 * @property integer $id_product
 * @property string $title
 * @property string $value
 */
class Detailvalue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_value';
    }

    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id_product' => 'id_product']);
    }

    public function getDetailattribute()
    {
        return $this->hasOne(Detailattribute::className(), ['id_detail_attribute' => 'id_detail_attribute']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_detail_attribute', 'id_product', 'title', 'value'], 'required'],
            [['id_detail_attribute', 'id_product'], 'integer'],
            [['value'], 'string'],
            [['title'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_detail_value' => 'Id Detail Value',
            'id_detail_attribute' => 'Id Detail Attribute',
            'id_product' => 'Id Product',
            'title' => 'Title',
            'value' => 'Value',
        ];
    }
}
