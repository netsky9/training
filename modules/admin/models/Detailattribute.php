<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "detail_attribute".
 *
 * @property integer $id_detail_attribute
 * @property integer $id_category
 * @property string $title
 */
class Detailattribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_attribute';
    }

    public function getCategories()
    {
        return $this->hasOne(Categories::className(), ['id_category' => 'id_category']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'title'], 'required'],
            [['id_category'], 'integer'],
            [['title'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_detail_attribute' => 'Id Detail Attribute',
            'id_category' => 'Id Category',
            'title' => 'Title',
        ];
    }
}
