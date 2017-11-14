<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Products */

$this->title = $model->title_product;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $img = $model->getImage(); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_product',
            'title_product',
            //'id_category',
            [
                'attribute' => 'Category',
                'value' => function ($data) {
                    return $data->categories->title;
                },
            ],
            [
                'attribute' => 'Image',
                'value' => "<img src='{$img->getUrl('250x')}'>",
                'format' => 'html',
            ],
            'description:ntext',
            'price',
            //'rent_sale',
            [
                'attribute' => 'rent_sale',
                'value' => function ($data) {
                    if ($data->rent_sale == 0) {
                        return 'sale';
                    }
                    if ($data->rent_sale == 1) {
                        return 'rent';
                    }
                    if ($data->rent_sale == 2) {
                        return 'rent + sale';
                    }
                },
            ],
            'count',
            'view',
        ],
    ]) ?>


       <?php $Details = $model->detailvalue;?>

        <table id="w0" class="table table-striped table-bordered detail-view">
            <tbody>
                <?php foreach ($Details as $Det):
                   $DetailAttr = $Det->detailattribute;
                ?>
                <tr><th><?= $DetailAttr['title'] ?></th><td><?= $Det['value'] ?></td><td><a href="/admin/detailvalue/view?id=<?= $Det['id_detail_value'] ?>" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> <a href="/admin/detailvalue/update?id=<?= $Det['id_detail_value'] ?>" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> <a href="/admin/detailvalue/delete?id=<?= $Det['id_detail_value'] ?>&id_product=<?= Yii::$app->request->get('id') ?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
                <?php endforeach ?>
            </tbody>
        </table>


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_product], ['class' => 'btn btn-info btn-fill btn-wd']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_product], [
            'class' => 'btn btn-danger btn-fill btn-wd',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
