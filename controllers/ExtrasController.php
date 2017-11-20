<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Category;
use app\models\Details;

use app\modules\admin\models\Rent;
use app\models\User;

use Yii;

use yii\data\Pagination;

class ExtrasController extends Controller
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
     * Displays homepage.
     */
    public function actionIndex()
    {
        //считаем количество всех записей по данной категории
        $Bicycles_count = Product::find()->where('rent_sale > 0');


        //создаем объект класса Pagination и передаем ему количество записей и количество, которое нужно выводить на одной странице
        $pages = new Pagination(['totalCount' => $Bicycles_count->count(), 'pageSize' => 6, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $Bicycles = Product::getRentProductsByCategory($pages->offset, $pages->limit);

        return $this->render('main', compact('Bicycles', 'pages'));
    }

    public function generateRandomStr($countStr = 10)
    {
      $str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
      for($i = 0; $i < $countStr; $i++){
        $newPass .= $str[rand(0, strlen($str))];
      }
      return $newPass; 
    }

    public function formattingDate($date)
    {
        $d = explode(' ', $date);
        $date = explode('.',$d[0]);
        $ndate = array_reverse($date);
        foreach ($ndate as $n) {
            $newdate .= $n.'.';
        }
        
        return $newdate = substr($newdate, 0,10).' '.$d[1].':00';
    }

    public function actionRent()
    {
        //проверки на пустоту данных
        /*if(isset($_GET['id']) && isset($_GET['name']) && $_GET['name']!=null 
            && isset($_GET['surname']) && $_GET['surname']!=null 
            && isset($_GET['phone']) && $_GET['phone']!=null 
            && isset($_GET['email']) && $_GET['email']!=null 
            && isset($_GET['message']) && $_GET['message']!=null 
            && isset($_GET['time_start']) && $_GET['time_start']!=null 
            && isset($_GET['time_end']) && $_GET['time_end']!=null){
            echo $_GET['time_start'];
        }*/

        

        //проверка на существование емейла
        $newUser = User::find()->where('email = :email', [':email' => $_GET['email']])->one();
        if($newUser){
            $id = $newUser->id_user;            
        }else{
            $user['name'] = $_GET['name'];
            $user['surname'] = $_GET['surname'];
            $user['email'] = $_GET['email'];
            $user['phone'] = $_GET['phone'];

            //возможна нужна проверка на существование такого пользователя, хотя вероятность очеьн мала
            $user['login'] = $user['name'].$this->generateRandomStr(5);

            $user['pass'] = $this->generateRandomStr();

            $model = new User;
            $model->username = $user['login'];
            $model->password = Yii::$app->security->generatePasswordHash($user['pass']);
            $model->name = $user['name'];
            $model->last_name = $user['surname'];
            $model->phone = $user['phone'];
            $model->email = $user['email'];

            $model->insert();
            $id = Yii::$app->db->getLastInsertID();
            $userRole = Yii::$app->authManager->getRole('user');
            Yii::$app->authManager->assign($userRole, $id);
        }
        

        $model = new Rent;
        $model->id_product = $_GET['id'];
        $model->id_user = $id;
        $model->message = $_GET['message'];
        $model->rent_begin = $this->formattingDate($_GET['time_start']);
        $model->rent_end = $this->formattingDate($_GET['time_end']);
        $model->status = 'not payed'; 
        $model->insert();

        //echo 'id: '.$model->id_product.'; '.'id: '.$model->id_user.'; '.'message: '.$model->message.'; '.'rent_begin: '.$model->rent_begin.'; '.'rent_end: '.$model->rent_end;
    }
}
