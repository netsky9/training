<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Image;

use app\modules\admin\models\Products;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1>Order №<?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_user',
            'datetime',
            'status',
        ],
    ]) ?>
    <? $Orders = $model->productsOrders; ?>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr>
                <tr>
                    <td>Id Product</td>
                    <td>Image</td>
                    <td>Title</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total Price</td>
                </tr>
            </tr>
            <?php foreach ($Orders as $Ord):?>
                <?
                    $OrdProduct = Products::find()->where('id_product = :id_product', [':id_product' => $Ord['id_product']])->one(); 
                ?>
            <tr>
                <tr><td><?= $OrdProduct['id_product'] ?></td><td>
                    <?php $Img = Image::find()->where('itemId = :itemId', [':itemId' => $OrdProduct['id_product']])->one();
                      if (isset($Img)) {
                          echo '<img class="bikes-img" src="/web/upload/store/'.$Img->filePath.'" style="width: 130px;">';
                      } else {
                          echo '<img class="bikes-img" src="/web/upload/store/no-image.jpg" style="width: 130px;">';
                      }
                    ?>
                </td><td><a href="/bicycles/view?id_product=<?= $OrdProduct['id_product'] ?>"><? echo $OrdProduct['title_product'] ?></a></td>

                <td><?= $OrdProduct['price'] ?></td>
                <td><?= $Ord['count'] ?></td>
                <td><?= $OrdProduct['price']*$Ord['count'] ?></td>

                </tr>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-info btn-fill btn-wd']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-fill btn-wd',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
