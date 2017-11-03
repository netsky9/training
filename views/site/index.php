<?php

/* @var $this yii\web\View */

$this->title = 'Bicycle shop';
?>

  <!--*************************** Category ***************************-->
  <div class="categories">
    <div class="slim-container">
      <h2>CATEGORIES</h2>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 category-area">
          <div class="category-block first-cat">
            <span class="header-text-cat">FIXED / SINGLE SPEED</span>
            <br><span class="descr-text-cat">Are You ready for the 27.5 Revolution?</span>
          </div> 
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 category-area">
          <div class="category-block second-cat">
            <span class="header-text-cat">PREMIUM SERIES</span>
            <br><span class="descr-text-cat">Exclusive  Bike Components</span>
            <br><button class="transp-btn">GO TO STORE</button>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 category-area">
          <div class="category-block third-cat">
            <span class="header-text-cat">CITY BIKES</span>
            <br><span class="descr-text-cat">Street Playground</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--*************************** END Category ***************************-->


  <!--*************************** Popular bikes ***************************-->
  <div class="poplar-bikes">  
    <div class="container">
      <h2>POPULAR BIKES</h2>
      <div class="row">
        <?/*
        $i = 0; 
        foreach($ProductList as $ProdL): 
            $i++;
            if($i == 4){break;}*/
        ?>
        <div class="col-md-4 col-sm-4 col-xs-12" id="bikes-item">
          <img class="bikes-img" src="/images/bikes/1.jpg">
          <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-5">
              <h3><? /*echo substr($ProdL['title_product'], 0,13); */?></h3>
              $<? /*echo $ProdL['price'];*/ ?>
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
                  <button class="btn-grey sender" value="<? /*echo $ProdL['id_product'];*/ ?>">BUY</button>
                </div>
              </div>
            </div>    
          </div>
        </div>
        <? /*endforeach*/ ?>
      </div>
    </div>
  </div>  
  <!--*************************** END Popular bikes ***************************-->
