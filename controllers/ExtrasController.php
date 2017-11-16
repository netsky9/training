<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Category;
use app\models\Details;
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
}
