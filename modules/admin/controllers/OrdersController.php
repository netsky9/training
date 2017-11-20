<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Orders;
use app\modules\admin\models\ProductsOrders;
use app\modules\admin\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Orders::find(),
        ]);
        $orders = Orders::find()->where('status = :status', [':status' => 'not payed'])->all();
        foreach ($orders as $ord) {
            //echo $ord['datetime'];
            $d = explode(' ',$ord->datetime);
            $date = explode('-', $d[0]);
            $time = explode(':', $d[1]);
            
            $year = (int) $date[0]; $month = (int) $date[1]; $day = (int) $date[2]; $hour = (int) $time[0]; $minute = (int) $time[1]; $second = (int) $time[2]; 
            
            $day +=3; //добавляем время

            if($day<9) $day = '0'.$day; 
            if($month<9) $month = '0'.$month; 
            if($hour<9) $hour = '0'.$hour; 
            if($minute<9) $minute = '0'.$minute; 
            if($second<9) $second = '0'.$second;

            $date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.$second;

            $dateNow = date("Y-m-d H:i:s");

            //сравниваем даты
            if($date < $dateNow){
                //добавляем зарезервированнное количество товаров обратно
                $Product = $ord->productsOrders;
                foreach ($Product as $product):
                    echo $product->count;
                    $modelProd = Products::find()->where('id_product = :id_product', [':id_product' => $product->id_product])->one();
                    $modelProd->count = $modelProd->count + $product->count;
                    $modelProd->update();
                endforeach;

                //удаление просроченных заявок
                //echo $ord->id.') '.$date. ' и ' .$dateNow.'<br>';  
                $modelOrd = Orders::find()->where('id = :id', [':id' => $ord->id])->one();
                $modelOrd->delete();
                $modelProdOrd = ProductsOrders::find()->where('id_order = :id_order', [':id_order' => $ord->id])->all();
                foreach ($modelProdOrd as $m) {
                    $m->delete();
                }
            }
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        $Product = ProductsOrders::find()->where('id_order = :id_order', ['id_order' => $id])->all();
        foreach ($Product as $product):
            //echo $product->count;
            $modelProd = Products::find()->where('id_product = :id_product', [':id_product' => $product->id_product])->one();
            $modelProd->count = $modelProd->count + $product->count;
            $modelProd->update();
        endforeach;

        $this->findModel($id)->delete();
        $ProdOrders = ProductsOrders::find()->where('id_order = :id_order', [':id_order' => $id])->all();
        foreach ($ProdOrders as $prodOrd) {
            $prodOrd->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
