<?php

namespace app\modules\admin\models;

use yii\web\Controller;
use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id_product
 * @property string $title_product
 * @property integer $id_category
 * @property string $description
 * @property integer $price
 * @property integer $rent_sale
 * @property integer $count
 * @property integer $view
 */
class Products extends \yii\db\ActiveRecord
{
    public $image;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    public function getCategories()
    {
        return $this->hasOne(Categories::className(), ['id_category' => 'id_category']);
    }

    public function getDetailvalue()
    {
        return $this->hasMany(Detailvalue::className(), ['id_product' => 'id_product']);
    }

    /*public function getProductsOrders()
    {
        return $this->hasMany(ProductsOrders::className(), ['id_product' => 'id_product']);
    }*/
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_product', 'id_category', 'description', 'price', 'rent_sale', 'count', 'view'], 'required'],
            [['id_category', 'price', 'rent_sale', 'count', 'view'], 'integer'],
            [['description'], 'string'],
            [['title_product'], 'string', 'max' => 300],

            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'title_product' => 'Title Product',
            'id_category' => 'Id Category',
            'description' => 'Description',
            'price' => 'Price',
            'rent_sale' => 'Rent Sale',
            'count' => 'Count',
            'view' => 'View',
            'image' => 'Image',
        ];
    }

    //Image
    public function upload()
    {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->removeImages();
            $this->attachImage($path);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }
}
