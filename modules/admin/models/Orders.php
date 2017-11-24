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

    //report
    public function orderReport($pages_offset, $pages_limit, $timeStart, $timeEnd, $title, $user, $category){
        
        $query = "
                SELECT products_orders.*, orders.*, products.title_product, products.id_category, products.price, 
                products_orders.count*products.price as sum,
                (SELECT title FROM categories WHERE id_category = products.id_category) as title_category,
                (SELECT username FROM users WHERE id_user = orders.id_user) as username
                FROM products_orders
                INNER JOIN orders ON products_orders.id_order = orders.id
                INNER JOIN products ON products_orders.id_product = products.id_product
                WHERE orders.status = 'payed'
                AND orders.datetime > :timeStart AND orders.datetime < :timeEnd 
                ";

        $pdo = array(':timeStart' => $timeStart, ':timeEnd' => $timeEnd);
        if($title != null){
            $query .= ' AND products.title_product LIKE :title';
            $pdo += [':title' => '%'.$title.'%'];
        }
        if($user != null){
            $query .= ' AND orders.id_user = :user';
            $pdo += [':user' => $user];
        }
        if($category != null){
            $query .= ' AND products.id_category = :category';
            $pdo += [':category' => $category];
        }

            //$query .= 'GROUP BY products_orders.id_product';

            $query .= ' LIMIT :offset, :limit';
            $pdo += [':offset' => $pages_offset];
            $pdo += [':limit' => $pages_limit];



        $Details = Yii::$app->db->createCommand($query, $pdo)->queryAll();

        return $Details;
    }

    //report count
    public function orderReportCount($timeStart, $timeEnd, $title, $user, $category){
        
        $query = "
                SELECT products_orders.*, orders.*, COUNT(*) as counter
                FROM products_orders
                INNER JOIN orders ON products_orders.id_order = orders.id
                INNER JOIN products ON products_orders.id_product = products.id_product
                WHERE orders.status = 'payed'
                AND orders.datetime > :timeStart AND orders.datetime < :timeEnd
                ";

        $pdo = array(':timeStart' => $timeStart, ':timeEnd' => $timeEnd);
        if($title != null){
            $query .= ' AND products.title_product LIKE :title';
            $pdo += [':title' => '%'.$title.'%'];
        }
        if($user != null){
            $query .= ' AND orders.id_user = :user';
            $pdo += [':user' => $user];
        }
        if($category != null){
            $query .= ' AND products.id_category = :category';
            $pdo += [':category' => $category];
        }

            //$query .= 'GROUP BY products_orders.id_product';

        $orderReport = Yii::$app->db->createCommand($query, $pdo)->queryAll();

        return $orderReport;
    }



    //report
    public function orderRest($pages_offset, $pages_limit, $price_from, $price_to, $title, $category){
        
        $query = "
                SELECT products.*, categories.title
                FROM products
                INNER JOIN categories ON products.id_category = categories.id_category
                WHERE rent_sale = 0 
                ";

        $pdo = array();
        if($price_from != null){
            $query .= ' AND products.price > :price_from ';
            $pdo += [':price_from' => $price_from];
        }
        if($price_to != null){
            $query .= ' AND products.price < :price_to ';
            $pdo += [':price_to' => $price_to];
        }
        if($title != null){
            $query .= ' AND products.title_product LIKE :title';
            $pdo += [':title' => '%'.$title.'%'];
        }
        if($category != null){
            $query .= ' AND products.id_category = :category';
            $pdo += [':category' => $category];
        }
            $query .= ' LIMIT :offset, :limit';
            $pdo += [':offset' => $pages_offset];
            $pdo += [':limit' => $pages_limit];

        $orderRest = Yii::$app->db->createCommand($query, $pdo)->queryAll();

        return $orderRest;
    }

    //report count, COUNT(*) as counter
    public function orderRestCount($price_from, $price_to, $title, $category){
        
        $query = "
                SELECT products.*, categories.title, COUNT(*) as counter
                FROM products
                INNER JOIN categories ON products.id_category = categories.id_category
                WHERE rent_sale = 0 
                ";

        $pdo = array();
        if($price_from != null){
            $query .= ' AND products.price > :price_from ';
            $pdo += [':price_from' => $price_from];
        }
        if($price_to != null){
            $query .= ' AND products.price < :price_to ';
            $pdo += [':price_to' => $price_to];
        }
        if($title != null){
            $query .= ' AND products.title_product LIKE :title';
            $pdo += [':title' => '%'.$title.'%'];
        }
        if($title != null){
            $query .= ' AND products.title_product LIKE :title';
            $pdo += [':title' => '%'.$title.'%'];
        }
        if($category != null){
            $query .= ' AND products.id_category = :category';
            $pdo += [':category' => $category];
        }

        $orderRest = Yii::$app->db->createCommand($query, $pdo)->queryAll();

        return $orderRest;
    }
}
