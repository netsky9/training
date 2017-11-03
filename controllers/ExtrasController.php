<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Category;

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
    	
        return $this->render('main');
    }
}
