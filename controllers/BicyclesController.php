<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Category;
use app\models\Details;
use Yii;

use yii\data\Pagination;

class BicyclesController extends Controller
{
    //Create public virable for print categories in layout
    public $menuCatBicycle;
    public $menuCatParts;
    public $menuCatAccessories;

    public function __construct($id, $module, $config = [])
    {
        //get all categories in the menu
        $this->menuCatBicycle = Category::find()->where('id_parent = 1')->all();
        $this->menuCatParts = Category::find()->where('id_parent = 2')->all();
        $this->menuCatAccessories = Category::find()->where('id_parent = 3')->all();

        parent::__construct($id, $module, $config);
    }

    /**
     * Displays Products page.
     */
    public function actionIndex($category)
    {

        //считаем количество всех записей по данной категории
        $Bicycles_count = Product::find()->where('id_category = :id_category', [':id_category'=>$category]);


        //создаем объект класса Pagination и передаем ему количество записей и количество, которое нужно выводить на одной странице
        $pages = new Pagination(['totalCount' => $Bicycles_count->count(), 'pageSize' => 6, 'forcePageParam' => false, 'pageSizeParam' => false]);

        //Select All news by category with pagination
        $Bicycles = Product::getNewsByCategory($pages->offset, $pages->limit, $category);

        //Select all colors of product
        $Color = Product::getColorsForProduct($Bicycles);

        //get active category
        $ActiveCategory = Category::find()->where('id_category = :id_category', [':id_category' => $category])->one();

        //compact => передача в модель mian
        return $this->render('main',compact('Bicycles', 'pages', 'ActiveCategory', 'Color'));
    }

    public function actionView($id_product)
    {
        $Product = Product::find()->where('id_product = :id_product', [':id_product' => $id_product])->one();

        //update count of view for every product
        /*$Count = $Product->view + 1;
        Yii::$app->db->createCommand()
        ->update('products', ['view' => $Count], 'id_product = :id_product', [':id_product' => $id_product])
        ->execute();*/

        //select all details for every product
        $query = 'SELECT detail_value.value as value, detail_attribute.title as title
            FROM detail_value
            INNER JOIN detail_attribute ON detail_value.id_detail_attribute = detail_attribute.id_detail_attribute
            WHERE detail_value.id_product = :id_product';

        $Details = Yii::$app->db->createCommand($query, [':id_product' => $Product->id_product])->queryAll();

        //compact => передача в модель mian
        return $this->render('view',compact('id_product', 'Product', 'Details'));
    }

   /*
    ********************************************************************
    *                  AJAX request processing                         *
    ******************************************************************** 
    */

    //Ajax: delete from cart
    public function actionDeletefromcart()
    {

        if(isset($_GET['id_product'])){
            foreach ($_COOKIE as $id => $value) {
            if($id == $_GET['id_product']){
                setcookie($id, '', strtotime('-60 days'),"/");
                //setcookie($id,'');//удаление куки

                if(isset($_COOKIE['count_product'])){
                    $Count = $_COOKIE['count_product'];
                    $Count--;
                    
                    //обновлям куки
                    setcookie('count_product','');
                    setcookie('count_product', $Count, strtotime('+30 days'),"/");
                    $CountUpdate = $_COOKIE['count_product'];

                    //return count products in the cart
                    echo $CountUpdate;
                }
                }
            }
        }
    }

    //Ajax: update counter of products
    public function actionCountupdate()
    {
        if(isset($_GET['counter'])){
            foreach ($_COOKIE as $id => $value) {
            if($id == $_GET['id_product']){
                $Prod = unserialize($value);
                $Prod['counter'] = $_GET['counter'];
                
                $new_value = serialize($Prod);
                
                //обновлям куки
                setcookie($id,"");
                setcookie($id,$new_value, strtotime('+30 days'),"/");
                }
            }
        }
    }

    //Ajax: add to cart
    public function actionAddtocart()
    {
        if(isset($_GET['id_product'])){

            //the product is already in the cart?
            if(!array_key_exists($_GET['id_product'], $_COOKIE)){
                
                $product = Product::findOne($_GET['id_product']);
                //инициализация количества товаров
                
                $Product['id_product'] = $product['id_product'];
                $Product['title_product'] = $product['title_product'];
                $Product['id_category'] = $product['id_category'];
                $Product['description'] = $product['description'];
                $Product['price'] = $product['price'];
                $Product['rent_sale'] = $product['rent_sale'];
                $Product['count'] = $product['count'];
                $Product['counter'] = 1;

                setcookie($Product['id_product'],serialize($Product), strtotime('+30 days'),"/");
                
                foreach ($_COOKIE as $id => $value) {
                if($id > 0){
                    $Prod = $value;
                    }
                }
                
                if(isset($_COOKIE['count_product'])){
                    $Count = $_COOKIE['count_product'];
                    $Count++;
                    
                    //обновлям куки
                    setcookie('count_product',' ',time()-3600,"/");
                    setcookie('count_product', $Count, strtotime('+30 days'),"/");
                    $CountUpdate = $_COOKIE['count_product'];

                    //return count products in the cart
                    echo $CountUpdate+1;
                }

            }else{
                echo 'is_exist';
            }
        }
    }

    //Ajax: get all buyed products to the cart
    public function actionGetcart()
    {
        $flag = 0;
        foreach ($_COOKIE as $id => $value) {
            if($id > 0){
                $flag = 1;
                $Prod = unserialize($value);
                echo '
                    <div class="row cart-item">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <img src="/tamplates/site/images/bikes/1.jpg" width="100%">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span class="cart-title">'.substr($Prod['title_product'], 0,18).'<a href="#" class="delete-from-cart" onclick="deleteFromCart('.$Prod['id_product'].');"><span aria-hidden="true"> × </span></a></span>
                          <p><span class="cart-subtitle">'.substr($Prod['description'], 0,70).'</span></p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 quantity">
                          <span class="cart-title">Quantity</span>
                          <div class="number">
                            <div class="number_controls num_control_left">
                              <button class="nc-minus" id="'.$Prod['price'].'" value="'.$Prod['id_product'].'">-</button>
                            </div>
                            <input name="'.$Prod['price'].'" type="number" value="1">
                            <div class="number_controls">
                              <button class="nc-plus" id="'.$Prod['price'].'" value="'.$Prod['id_product'].'">+</button>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-6 money-right">
                          <span class="cart-title">Subtotal</span>
                          <br>$<span class="price-text '.$Prod['price'].'">'.$Prod['price'].'</span>
                        </div>
                      </div>
                ';
            }
        }
    }

    //Ajax: 
    public function actionAddtodb()
    {
       /* foreach ($_COOKIE as $id => $value) {

            if($id>0){
                $Prod = unserialize($value);

                $Prod['price'] = $Prod['counter'] * $Prod['price'];

                $Discount = Admin::getDiscount($Prod['id_product']);
                if(isset($Discount['percent'])){
                    $Prod['id_discount'] = $Discount['id_discount'];
                }else{
                    $Prod['id_discount'] = 0;
                }
                $Prod['status'] = 'not payed';
                $Prod['id_user'] = 0;
                //echo 'Продукт: '.$Prod['id_product'].'; '.$Prod['title_product'].'; '.$Prod['price'].'; Количество ('.$Prod['counter'].') ';
                Admin::AddOrder($Prod);
            }
            setcookie($id,"test",time()-3600,"/");
        }*/
    }

    /*
    ********************************************************************
    *                  AJAX request processing(end)                    *
    ******************************************************************** 
    */

}
