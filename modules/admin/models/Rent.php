<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "rent".
 *
 * @property integer $id_rent
 * @property integer $id_product
 * @property integer $id_user
 * @property string $rent_begin
 * @property string $rent_end
 */
class Rent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_user', 'message', 'rent_begin', 'rent_end'], 'required'],
            [['id_product', 'id_user'], 'integer'],
            [['rent_begin', 'rent_end', 'message'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rent' => 'Id Rent',
            'id_product' => 'Id Product',
            'id_user' => 'Id User',
            'message' => 'Message',
            'rent_begin' => 'Rent Begin',
            'rent_end' => 'Rent End',
        ];
    }
}
