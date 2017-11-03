<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = $Product->title_product;
?>

<div class="content-page">
  <div class="poplar-bikes">  
    <div class="slim-container">
      <h2><?= $Product->title_product ?></h2>
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <img class="bikes-img" src="/images/bikes/1.jpg">
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">

          <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-2 col-sm-4 col-xs-4 center-block">
              <span class="detail-price">$23423</span>
              <span class="detail-text">price</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 center-block">
              <span class="detail-quantity"><?= $Product->count ?></span>
              <span class="detail-text">quantity</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 center-block">
              <button class="btn btn-default btn-sm btn-black sender" value="<?= $Product->id_product ?>">BUY</button>
            </div>
          </div>

          <? foreach ($Details as $Det): ?>
          <div class="row">
            <div class="col-md-6">
              <p class="detail-back"><?= $Det['title']; ?></p>
            </div>
            <div class="col-md-6">
              <p class="detail-back"><?= $Det['value']; ?></p>
            </div>     
          </div>
          <? endforeach ?>

          <?= $Product->description ?>

        </div>
      </div>
    </div>
  </div>
</div>  
