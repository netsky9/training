<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report on rent';
?>
<div class="users-index">
        <h4 class="report-title"><?= Html::encode($this->title) ?></h4>
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
</div>