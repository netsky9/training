<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use app\models\Image;

$this->title = 'Bicycles';
?>

<div class="content-page">
  <div class="poplar-bikes">  
    <div class="container">
      <h2><?= $ActiveCategory->title ?></h2>
      <div class="row">
        <?php foreach ($Bicycles as $Bic): ?>
        <div class="col-md-4 col-sm-4 col-xs-12">

          <?php $Img = Image::find()->where('itemId = :itemId', [':itemId' => $Bic['id_product']])->one();
          if (isset($Img)) {
              echo '<img class="bikes-img" src="/web/upload/store/'.$Img->filePath.'">';
          } else {
              echo '<img class="bikes-img" src="/web/upload/store/no-image.jpg">';
          }
          ?>
          
          <?php if ($ActiveCategory->id_parent == 1): ?>
          <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-5">
              <a id="title-<?= $Bic['id_product'] ?>" href="<?= Url::to(['bicycles/view', 'id_product' => $Bic['id_product']]) ?>"><h3><?= BaseStringHelper::truncate($Bic['title_product'], 13, '..') ?></h3></a>
              $<?= $Bic['price'] ?>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-7">
              <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-7 popular-bikes-sel">
                  <select class="form-control selector"  data-idfirst="<?= $Bic['id_product'] ?>">
                    <?php foreach ($Color as $Key => $Val) {
                      if ($Key == $Bic['id_product']) {
                          foreach ($Val as $V) {
                              if ($V['id_product'] == $Bic['id_product']) {
                                  $Active = 'selected';
                              } else {
                                  $Active = '';
                              }
                              echo '<option '.$Active.' value="'.$V['id_product'].'">'.$V['value'].'</option>';
                          }
                      }
                  } ?>
                  </select>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5">
                  <button id="button-<?= $Bic['id_product'] ?>" class="btn-grey sender" value="<?= $Bic['id_product'] ?>">BUY</button>
                </div>
              </div>
            </div>    
          </div>
        <?php endif ?>

        <?php if ($ActiveCategory->id_parent != 1): ?>
          <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-9">
              <a id="title-<?= $Bic['id_product'] ?>" href="<?= Url::to(['bicycles/view', 'id_product' => $Bic['id_product']]) ?>"><h3><?= BaseStringHelper::truncate($Bic['title_product'], 13, '..') ?></h3></a>
              $<?= $Bic['price'] ?>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-3">
              <div class="row">
                <div class="col-md-12 col-sm-5 col-xs-12">
                  <button id="button-<?= $Bic['id_product'] ?>" class="btn-grey sender" value="<?= $Bic['id_product'] ?>">BUY</button>
                </div>
              </div>
            </div>    
          </div>
        <?php endif ?>


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
