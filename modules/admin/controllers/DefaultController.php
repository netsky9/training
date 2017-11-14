<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class DefaultController extends AppAdminController
{
    public function actionIndex()
    {
        return $this->redirect(['/admin/orders']);
        //return $this->render('index');
    }
}
