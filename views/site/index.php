<?php
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use app\models\Image;

$this->title = 'Bicycle shop';
?>

  <!--*************************** Category ***************************-->
  <div class="categories">
    <div class="slim-container">
      <h2>CATEGORIES</h2>
      <div class="row">
        <a href="<?= Url::to(['bicycles/index', 'category' => 4]) ?>">
          <div class="col-md-4 col-sm-4 col-xs-12 category-area">
              <div class="category-block first-cat">
                <span class="header-text-cat">FIXED / SINGLE SPEED</span>
                <br><span class="descr-text-cat">Are You ready for the 27.5 Revolution?</span>
              </div> 
          </div>
        </a>
        <a href="<?= Url::to(['bicycles/index', 'category' => 5]) ?>">
          <div class="col-md-4 col-sm-4 col-xs-12 category-area">
              <div class="category-block second-cat">
                <span class="header-text-cat">PREMIUM SERIES</span>
                <br><span class="descr-text-cat">Exclusive  Bike Components</span>
                <br><button class="transp-btn">GO TO STORE</button>
              </div>
          </div>
        </a>
        <a href="<?= Url::to(['bicycles/index', 'category' => 6]) ?>">
          <div class="col-md-4 col-sm-4 col-xs-12 category-area">
              <div class="category-block third-cat">
                <span class="header-text-cat">CITY BIKES</span>
                <br><span class="descr-text-cat">Street Playground</span>
              </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <!--*************************** END Category ***************************-->


  <!--*************************** Popular bikes ***************************-->
  <div class="poplar-bikes">  
    <div class="container">
      <h2>POPULAR BIKES</h2>
      <div class="row">
        <? foreach ($Bicycles as $Bic): ?>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <? $Img = Image::find()->where('itemId = :itemId', [':itemId' => $Bic['id_product']])->one(); 
          if(isset($Img)) echo '<img class="bikes-img" src="/web/upload/store/'.$Img->filePath.'">';
          else  echo '<img class="bikes-img" src="/web/upload/store/no-image.jpg">';
          ?>
          <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-5">
              <a id="title-<?= $Bic['id_product'] ?>" href="<?= Url::to(['bicycles/view', 'id_product' => $Bic['id_product']]) ?>"><h3><?= BaseStringHelper::truncate($Bic['title_product'],13,'..') ?></h3></a>
              <?= $Bic['id_product'] ?>$<?= $Bic['price'] ?>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-7">
              <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-7 popular-bikes-sel">
                  <select class="form-control selector"  data-idfirst="<?= $Bic['id_product'] ?>">
                    <? foreach($Color as $Key => $Val){
                        if($Key == $Bic['id_product']){
                          foreach ($Val as $V) {
                              if($V['id_product'] == $Bic['id_product']){ 
                                  $Active = 'selected'; 
                                }else{
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
        </div>
        <? endforeach ?>
      </div>
    </div>
  </div>  
  <!--*************************** END Popular bikes ***************************-->
