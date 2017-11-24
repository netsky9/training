<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OrderReport';
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
        <h4 class="report-title">The orders report</h4>

                <form method="GET" action="/admin/reports/rest">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        Title product
                        <input id="title" type="text" name="title" class="form-control" />
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        Category
                        <br><select id="category" name="category" class="selector">
                            <option value="0">All categories</option>
                            <? foreach ($categories as $cat): ?>
                                <option value="<?= $cat->id_category ?>"><?= $cat->title ?></option>
                            <? endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          Price from 
                          <br><input type="text" name="price_from" class="form-control" />
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          Price to
                          <br><input type="text" name="price_to" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-fill btn-info" name="submit">Submit</button>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 create-excel" style="margin-top: 30px;">
                    </div>
                </form>
                <div class="col-md-6 col-sm-6 col-xs-6 create-excel" style="margin-top: 30px; margin-bottom: 30px;">
                    <a href="/admin/reports/restexcel"><button class="btn btn-success btn-fill btn-wd" style="float: right;">Create Excel</button></a>
                </div>


        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                      <tr><th>Product №</th>
                                      <th>Title</th>
                                      <th>Category</th>
                                      <th>Price</th>
                                      <th>Count</th>
                                    </tr></thead>
                                    <tbody>
                                      <? foreach($OrderRest as $OrdRest): ?>
                                        <tr>
                                          <td><?= $OrdRest['id_product'] ?></td>
                                          <td><?= $OrdRest['title_product'] ?></td>
                                          <td><?= $OrdRest['title'] ?></td>
                                          <td><?= $OrdRest['price'] ?></td>
                                          <td><?= $OrdRest['count'] ?></td>
                                        </tr>
                                      <? endforeach ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="paginator">
              <?php echo LinkPager::widget(['pagination' => $pages, 'maxButtonCount' => 5]); ?>
            </div>
</div>