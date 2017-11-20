<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Category;
use app\models\Details;
use app\models\Image;
use app\models\User;
use Yii;

use app\modules\admin\models\Orders;
use app\modules\admin\models\ProductsOrders;

use yii\data\Pagination;

define("COOCKIE_TIME", "+3 days");

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
        $Bicycles = Product::getProductsByCategory($pages->offset, $pages->limit, $category);

        //Select all colors of product
        $Color = Product::getColorsForProduct($Bicycles);

        //get active category
        $ActiveCategory = Category::find()->where('id_category = :id_category', [':id_category' => $category])->one();

        //compact => передача в модель mian
        return $this->render('main', compact('Bicycles', 'pages', 'ActiveCategory', 'Color'));
    }

    public function actionView($id_product)
    {
        $Product = Product::find()->where('id_product = :id_product', [':id_product' => $id_product])->one();

        //select all details for every product
        $query = 'SELECT detail_value.value as value, detail_attribute.title as title
            FROM detail_value
            INNER JOIN detail_attribute ON detail_value.id_detail_attribute = detail_attribute.id_detail_attribute
            WHERE detail_value.id_product = :id_product';

        $Details = Yii::$app->db->createCommand($query, [':id_product' => $Product->id_product])->queryAll();

        //compact => передача в модель mian
        return $this->render('view', compact('id_product', 'Product', 'Details'));
    }

    /*
     ********************************************************************
     *                  AJAX request processing                         *
     ********************************************************************
     */

    //Ajax: delete from cart
    public function actionDeletefromcart()
    {
        if (isset($_GET['id_product'])) {
            foreach ($_COOKIE as $id => $value) {
                if ($id == $_GET['id_product']) {
                    setcookie($id, '', strtotime('-60 days'), "/");
                    //setcookie($id,'');//удаление куки

                    if (isset($_COOKIE['count_product'])) {
                        $Count = $_COOKIE['count_product'];
                        $Count--;
                    
                        //обновлям куки
                        setcookie('count_product', '', strtotime('-60 days'), "/");
                        setcookie('count_product', $Count, strtotime(COOCKIE_TIME), "/");
                        $CountUpdate = $_COOKIE['count_product'];

                        //return count products in the cart
                        echo $CountUpdate-1;
                    }
                }
            }
        }
    }

    //Ajax: update counter of products
    public function actionCountupdate()
    {
        if (isset($_GET['counter'])) {
            foreach ($_COOKIE as $id => $value) {
                if ($id == $_GET['id_product']) {
                    $Prod = unserialize($value);
                    $Prod['counter'] = $_GET['counter'];
                
                    $new_value = serialize($Prod);
                
                    //обновлям куки
                    setcookie('count_product', '', strtotime('-60 days'), "/");
                    setcookie($id, $new_value, strtotime(COOCKIE_TIME), "/");
                }
            }
        }
    }

    //Ajax: add to cart
    public function actionAddtocart()
    {
        if (isset($_GET['id_product'])) {

            //the product is already in the cart?
            if (!array_key_exists($_GET['id_product'], $_COOKIE)) {
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

                setcookie($Product['id_product'], serialize($Product), strtotime(COOCKIE_TIME), "/");
                
                foreach ($_COOKIE as $id => $value) {
                    if ($id > 0) {
                        $Prod = $value;
                    }
                }
                
                if (isset($_COOKIE['count_product'])) {
                    $Count = $_COOKIE['count_product'];
                    $Count++;
                    
                    //обновлям куки
                    setcookie('count_product', '', strtotime('-60 days'), "/");
                    setcookie('count_product', $Count, strtotime(COOCKIE_TIME), "/");
                    $CountUpdate = $_COOKIE['count_product'];

                    //return count products in the cart
                    echo $CountUpdate+1;
                }
            } else {
                echo 'is_exist';
            }
        }
    }

    //Ajax: get all buyed products to the cart
    public function actionGetcart()
    {
        $flag = 0;
        foreach ($_COOKIE as $id => $value) {
            if ($id > 0) {
                $flag = 1;
                $Prod = unserialize($value);
                $Img = Image::find()->where('itemId = :itemId', [':itemId' => $Prod['id_product']])->one();
                if (isset($Img)) {
                    $Image = '<img class="bikes-img" src="/web/upload/store/'.$Img->filePath.'" style="padding: 0;">';
                } else {
                    $Image = '<img class="bikes-img" src="/web/upload/store/no-image.jpg" style="padding: 0;">';
                }
                echo '
                    <div class="row cart-item">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          '.$Image.'
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span class="cart-title">'.substr($Prod['title_product'], 0, 18).'<a href="#" class="delete-from-cart" onclick="deleteFromCart('.$Prod['id_product'].');"><span aria-hidden="true"> × </span></a></span>
                          <p><span class="cart-subtitle">'.substr($Prod['description'], 0, 70).'</span></p>
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

    public function generateRandomStr($countStr = 10){
      $str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
      for($i = 0; $i < $countStr; $i++){
        $newPass .= $str[rand(0, strlen($str))];
      }
      return $newPass; 
    }

    //Ajax:
    public function actionAddtodb()
    {
        $cookieCountProd = 0;
        foreach ($_COOKIE as $id => $value) {
             if($id > 0){
                $cookieCountProd++;
             }
        }

        
        if($cookieCountProd == 0){
            echo 'Your order will be processed soon!';
            exit();
        }

        //проверка на количество товаров
        foreach ($_COOKIE as $id => $value) {
             if($id > 0){
                $Prod = unserialize($value);
                $Product = Product::find()->where('id_product = :id_product', [':id_product' => $Prod['id_product']])->one();
                if($Product->count < $Prod['counter']){
                    setcookie('count_product', '', strtotime('-60 days'), "/");
                    setcookie('count_product', $cookieCountProd, strtotime(COOCKIE_TIME), "/");
                    echo 'We have only '.$Product->count.' products "'.$Prod['title_product'].'"';
                    exit();
                }
             }
        }


      //сначала добавляем пользователя
      if(isset($_GET['name']) && $_GET['name']!='' 
          && isset($_GET['surname']) && $_GET['surname']!=''
          && isset($_GET['email']) && $_GET['email']!=''
          && isset($_GET['phone']) && $_GET['phone']!=''){

          $user['name'] = $_GET['name'];
          $user['surname'] = $_GET['surname'];
          $user['email'] = $_GET['email'];
          $user['phone'] = $_GET['phone'];

          //проверка на существование емейла
          $newUser = User::find()->where('email = :email', [':email' => $user['email']])->one();
          if($newUser){
                $userId = $newUser->id_user;            
          }else{
              $user['login'] = $user['name'];

              $user['pass'] = $this->generateRandomStr();

              $model = new User;
              $model->username = $user['login'];
              $model->password = Yii::$app->security->generatePasswordHash($user['pass']);
              $model->name = $user['name'];
              $model->last_name = $user['surname'];
              $model->phone = $user['phone'];
              $model->email = $user['email'];

              $model->insert();

              $addedUser = User::find()->where('username = :username', [':username' => $user['login']])->one();
              //назначаем роль новому пользователю
              $userRole = Yii::$app->authManager->getRole('user');
              Yii::$app->authManager->assign($userRole, $addedUser->id_user);

              $userId = $addedUser->id_user;
          }
          /*
           * Тут нужно реализовать отправку пароля (логин = емайл) пользователю на почту 
           */
          //echo 'Your new login is: '.$user['login'].' and password: '.$user['pass'];

        }else{
          echo 'Fill in all the fields!';
          exit();
        }


        //создаем заказ
        $modelOrder = new Orders;
        $modelOrder->id_user = $userId;
        $modelOrder->datetime = date('Y-m-d H:i:s');
        $modelOrder->status = 'not payed';
        $modelOrder->insert();
        $idOrder = Yii::$app->db->getLastInsertID();
        
       
        //выбираем товары из кук и добавляем в базу
        foreach ($_COOKIE as $id => $value) {

             if($id > 0){
                $Prod = unserialize($value);

                $modelProdOrd = new ProductsOrders;
                $modelProdOrd->id_product = $Prod['id_product'];
                $modelProdOrd->id_order = $idOrder;
                $modelProdOrd->count = $Prod['counter'];
                $modelProdOrd->insert();

                //отнимаем у продукта количество заказанных товаров
                $modelProduct = Product::findOne($Prod['id_product']);
                $modelProduct->count = $Prod['count']-$Prod['counter'];
                $modelProduct->update();

             }
             
            setcookie($id," ",strtotime('-60 days'),"/");

            //передача обратно в скрипт
            
        }
        echo 'Your order will be processed soon!';
    }

    /*
    ********************************************************************
    *                  AJAX request processing(end)                    *
    ********************************************************************
    */
}
