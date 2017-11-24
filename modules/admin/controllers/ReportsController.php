<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Users;
use app\modules\admin\models\Orders;
use app\modules\admin\models\Rent;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class ReportsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        
    }

    public function actionOrderreports()
    {
        $users = Users::find()->all();
        $categories = Category::find()->all();

        return $this->render('orders', compact('users', 'categories'));
    }

    public function actionRestreports()
    {
        $categories = Category::find()->all();

        return $this->render('rest', compact('users', 'categories'));
    }

    public function actionRentsreports()
    {
        $users = Users::find()->all();
        $categories = Category::find()->all();

        return $this->render('rents', compact('users', 'categories'));
    }


    public function formattingDate($date)
    {
        $d = explode(' ', $date);
        $date = explode('.',$d[0]);
        $ndate = array_reverse($date);
        $newdate = "";
        foreach ($ndate as $n) {
            $newdate .= $n.'.';
        }
        
        return $newdate = substr($newdate, 0,10).' '.$d[1].':00';
    }

    public function actionOrder(){

        if(isset($_GET['time_start'])){
            $timeStart = $this->formattingDate($_GET['time_start']);
        }
        
        if(isset($_GET['time_end'])){
            $timeEnd = $this->formattingDate($_GET['time_end']);
        }
        
        if(isset($_GET['title'])){
            $title = $_GET['title'];
        }else{ $title = null; }

        if(isset($_GET['user'])){
            $user = $_GET['user'];
            if($user == 0){
                $user = null;
            }
        }

        if(isset($_GET['category'])){
            $category = $_GET['category'];
            if($category == 0){
                $category = null;
            }
        }


        $OrderReportCount = Orders::orderReportCount($timeStart, $timeEnd, $title, $user, $category);
        $pages = new Pagination(['totalCount' => $OrderReportCount[0]['counter'], 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $OrderReport = Orders::orderReport($pages->offset, $pages->limit, $timeStart, $timeEnd, $title, $user, $category);

        $users = Users::find()->all();
        $categories = Category::find()->all();

        $_SESSION['OrderReport'] = $OrderReport;

        return $this->render('order-report', compact('OrderReport', 'pages', 'users', 'categories'));
    }

    public function actionRest(){
        
        if(isset($_GET['title'])){
            $title = $_GET['title'];
        }else{ $title = null; }

        if(isset($_GET['user'])){
            $user = $_GET['user'];
            if($user == 0){
                $user = null;
            }
        }

        if(isset($_GET['price_from'])){
            $price_from = $_GET['price_from'];
            if($price_from == 0){
                $price_from = null;
            }
        }

        if(isset($_GET['price_to'])){
            $price_to = $_GET['price_to'];
            if($price_to == 0){
                $price_to = null;
            }
        }

        if(isset($_GET['category'])){
            $category = $_GET['category'];
            if($category == 0){
                $category = null;
            }
        }


        $OrderRestCount = Orders::orderRestCount($price_from, $price_to, $title, $category);
        $pages = new Pagination(['totalCount' => $OrderRestCount[0]['counter'], 'pageSize' => 10, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $OrderRest = Orders::orderRest($pages->offset, $pages->limit, $price_from, $price_to, $title, $category);

        $categories = Category::find()->all();

        $_SESSION['OrderRest'] = $OrderRest;

        return $this->render('rest-report', compact('OrderRest', 'pages', 'categories'));
    }

    public function actionRent(){

        if(isset($_GET['time_start'])){
            $timeStart = $this->formattingDate($_GET['time_start']);
        }
        
        if(isset($_GET['time_end'])){
            $timeEnd = $this->formattingDate($_GET['time_end']);
        }
        
        if(isset($_GET['title'])){
            $title = $_GET['title'];
        }else{ $title = null; }

        if(isset($_GET['user'])){
            $user = $_GET['user'];
            if($user == 0){
                $user = null;
            }
        }


        $OrderRentCount = Rent::orderRentCount($timeStart, $timeEnd, $title, $user);
        $pages = new Pagination(['totalCount' => $OrderRentCount[0]['counter'], 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $OrderRent = Rent::orderRent($pages->offset, $pages->limit, $timeStart, $timeEnd, $title, $user);

        $users = Users::find()->all();

        $_SESSION['OrderRent'] = $OrderRent;

        return $this->render('rents-report', compact('OrderRent', 'pages', 'users'));
    }

    public function actionOrderexcel(){
        //==============================EXCEL==============================

        $objPHPExcel = new \PHPExcel();
        
        $sheet=0;
                  
        $objPHPExcel->setActiveSheetIndex($sheet);
        
        $foos = array();

        foreach ($_SESSION['OrderReport'] as $OrdRep) {
            $tmp = 
                ['Order'=>$OrdRep['id'],
                'Product'=>$OrdRep['title_product'],
                'User'=>$OrdRep['username'],
                'Category'=>$OrdRep['title_category'],
                'Date'=>$OrdRep['datetime'],
                'Product_Price'=>$OrdRep['price'],
                'Count'=>$OrdRep['count'],
                'Sum'=>$OrdRep['sum']];
            array_push($foos, $tmp);

        }
                 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
                
        $objPHPExcel->getActiveSheet()->setTitle('Page report')                     
         ->setCellValue('A1', 'Order')
         ->setCellValue('B1', 'Product')
         ->setCellValue('C1', 'User')
         ->setCellValue('D1', 'Category')
         ->setCellValue('E1', 'Date')
         ->setCellValue('F1', 'Product Price')
         ->setCellValue('G1', 'Count')
         ->setCellValue('H1', 'Sum');
                 
        $row=2;
                                
        foreach ($foos as $foo) {  
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['Order']); 
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo['Product']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['User']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$foo['Category']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['Date']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$foo['Product_Price']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$foo['Count']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$foo['Sum']);
            $row++ ;
        }
        
        header('Content-Type: application/vnd.ms-excel');
        $filename = "OrdersReport_".date("d-m-Y-H:i:s").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        //=============================EXCEL(end)=========================
    }

    public function actionRestexcel(){
        //==============================EXCEL==============================

        $objPHPExcel = new \PHPExcel();
        
        $sheet=0;
                  
        $objPHPExcel->setActiveSheetIndex($sheet);
        
        $foos = array();

        foreach ($_SESSION['OrderRest'] as $OrdRest) {
            $tmp = 
                ['ProductId'=>$OrdRest['id_product'],
                'Title'=>$OrdRest['title_product'],
                'Category'=>$OrdRest['title'],
                'Price'=>$OrdRest['price'],
                'Count'=>$OrdRest['count']];
            array_push($foos, $tmp);

        }
                 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
                
        $objPHPExcel->getActiveSheet()->setTitle('Page report')                     
         ->setCellValue('A1', 'ProductId')
         ->setCellValue('B1', 'Title')
         ->setCellValue('C1', 'Category')
         ->setCellValue('D1', 'Price')
         ->setCellValue('E1', 'Count');
                 
        $row=2;
                                
        foreach ($foos as $foo) {  
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['ProductId']); 
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo['Title']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['Category']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$foo['Price']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['Count']);
            $row++ ;
        }
        
        header('Content-Type: application/vnd.ms-excel');
        $filename = "RestReport_".date("d-m-Y-H:i:s").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        //=============================EXCEL(end)=========================
    }

    public function actionRentexcel(){
        //==============================EXCEL==============================

        $objPHPExcel = new \PHPExcel();
        
        $sheet=0;
                  
        $objPHPExcel->setActiveSheetIndex($sheet);
        
        $foos = array();

        foreach ($_SESSION['OrderRent'] as $OrdRent) {
            $tmp = 
                ['id_rent'=>$OrdRent['id_rent'],
                'title_product'=>$OrdRent['title_product'],
                'username'=>$OrdRent['username'],
                'rent_begin'=>$OrdRent['rent_begin'],
                'rent_end'=>$OrdRent['rent_end']];
            array_push($foos, $tmp);

        }
                 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
                
        $objPHPExcel->getActiveSheet()->setTitle('Page report')                     
         ->setCellValue('A1', 'Id Rent')
         ->setCellValue('B1', 'Title Product')
         ->setCellValue('C1', 'User')
         ->setCellValue('D1', 'Rent begin')
         ->setCellValue('E1', 'Rent end');
                 
        $row=2;
                                
        foreach ($foos as $foo) {  
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['id_rent']); 
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo['title_product']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['username']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$foo['rent_begin']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['rent_end']);
            $row++ ;
        }
        
        header('Content-Type: application/vnd.ms-excel');
        $filename = "RentReport_".date("d-m-Y-H:i:s").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        //=============================EXCEL(end)=========================
    }


}
