<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;

$this->title = 'Bicycles';
?>

<div class="content-page">
  <div class="poplar-bikes">  
    <div class="container">
      <h2>Fixed / single speed</h2>
      <div class="row">
        <?php foreach ($Bicycles as $Bic): ?>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <img class="bikes-img" src="/images/bikes/1.jpg">
          <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-5">
              <h3><?= BaseStringHelper::truncate($Bic->title_product, 13, '..') ?></h3>
              $<?= $Bic->price ?>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-7">
              <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-7 popular-bikes-sel">
                  <select class="form-control selector">
                    <option class="active">White</option>
                    <option>Red</option>
                    <option>Black</option>
                  </select>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5">
                  <button class="btn-grey">BUY</button>
                </div>
              </div>
            </div>    
          </div>
        </div>
        <?php endforeach ?>

        <!--****** Pagination ******-->
        <div class="super-slim-container">
          <!-- maxButtonCount - количество видимых кнопок -->
          <?php echo LinkPager::widget(['pagination' => $pages, 'maxButtonCount' => 5]); ?>
          </ul>
        </div>

      </div>
    </div>
  </div>
</div>  
