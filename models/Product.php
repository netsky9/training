<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

class Product extends ActiveRecord
{
    /*
    * Указываем, к какой таблице обращаться, через модель Product
    */
    public static function tableName()
    {
        return 'products';
    }

    public static function getNewsByCategory($pages_offset, $pages_limit, $category)
    {
    	$bikes = '
            SELECT *
            FROM products
            WHERE id_category = :id_category
            GROUP BY title_product
            LIMIT :offset, :limit';

        $Bicycles = Yii::$app->db->createCommand($bikes, [':offset' => $pages_offset, ':limit' => $pages_limit, ':id_category' => $category])->queryAll();

        return $Bicycles;
    }

    /**
    * Get Colors
    * @param $Bicycles <p>array of all Bicecles on page </p> 
    * @return $Color <p>Array of colors for every Bicycle</p>
    */
    public static function getColorsForProduct($Bicycles)
    {
    	$query = 'SELECT * 
            FROM detail_value
            WHERE title = :title AND id_detail_attribute = (SELECT id_detail_attribute FROM detail_attribute WHERE title = "Color")
            GROUP BY value';

        $Color = array();
        foreach ($Bicycles as $Bic) {
            $Color[$Bic['id_product']] = Yii::$app->db->createCommand($query, [':title' => $Bic['title_product']])->queryAll();
        }

        return $Color;
    }


    public static function getPopularProduct()
    {
    	$query = 'SELECT orders.*, COUNT(orders.id_product) as count_order, products.*
                  FROM orders
                  INNER JOIN products ON orders.id_product = products.id_product
                  GROUP BY orders.id_product
                  ORDER BY count_order DESC
                  LIMIT 3
                  ';
        $Product = Yii::$app->db->createCommand($query)->queryAll();

        return $Product;
    }
}
