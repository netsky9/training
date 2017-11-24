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

        <form method="GET" action="/admin/reports/rent">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  The beginning of the rent period:
                  <div class="form-group">
                    <div class="input-group date" id="datetimepicker1">
                      <input type="text" name="time_start" class="form-control" />
                      <span class="input-group-addon calendar-btn">
                        <span class="glyphicon-calendar glyphicon"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  The end of the rent period:
                  <div class="form-group">
                    <div class="input-group date" id="datetimepicker2">
                      <input type="text" name="time_end" class="form-control" />
                      <span class="input-group-addon calendar-btn">
                        <span class="glyphicon-calendar glyphicon"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    Title product
                    <input id="title" type="text" name="title" class="form-control" />
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    User
                    <br><select id="user" name="user" class="selector">
                        <option value="0">All users</option>
                        <? foreach ($users as $us): ?>
                            <option value="<?= $us->id_user ?>"><?= $us->username ?></option>
                        <? endforeach ?>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6" style="margin-top: 30px;">
                    <button type="submit" class="btn btn-fill btn-info" name="submit" >Submit</button>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 create-excel" style="margin-top: 30px;">
                </div>
            </form>
                <div class="col-md-6 col-sm-6 col-xs-6 create-excel" style="margin-top: 30px; margin-bottom: 30px;">
                    <a href="/admin/reports/rentexcel"><button class="btn btn-success btn-fill btn-wd" style="float: right;">Create Excel</button></a>
                </div>


        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                      <tr><th>Rent №</th>
                                      <th>Product</th>
                                      <th>User</th>
                                      <th>Rent start</th>
                                      <th>Rent end</th>
                                    </tr></thead>
                                    <tbody>
                                      <? foreach($OrderRent as $OrdRent): ?>
                                        <tr>
                                          <td><?= $OrdRent['id_rent'] ?></td>
                                          <td><?= $OrdRent['title_product'] ?></td>
                                          <td><?= $OrdRent['username'] ?></td>
                                          <td><?= $OrdRent['rent_begin'] ?></td>
                                          <td><?= $OrdRent['rent_end'] ?></td>
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