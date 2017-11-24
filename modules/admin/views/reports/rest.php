<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report on the balance of goods';
?>
<div class="users-index">
        <h4 class="report-title"><?= Html::encode($this->title) ?></h4>
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
</div>