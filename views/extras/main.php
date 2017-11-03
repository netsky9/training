<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Extras';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-page">

    <div class="categories extras">
      <div class="slim-container">
        <h2>Bike rentals</h2>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 category-area">
            <span class="text-rent-header">You have just found the cheapest bicycle rental! We have bikes for every purpose and budget.</span>
            <p class="text-rent">Capacity 500 bicycles. Rental for longer periods possible. If 20 bicycles or more are hired, they can be delivered free to the starting point. Organised trips: start at the beginning of the Leie area route, 500 metres from the River Leie.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="poplar-bikes">  
      <div class="container">
        <h2>Choose a Bike That Meets Your Needs</h2>
        <div class="row">

          <div class="col-md-4 col-sm-4 col-xs-12">
            <img class="bikes-img" src="/images/bikes/1.jpg">
            <div class="row rate-price">
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  1 hour
                  <span class="rate-money">$12.0</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  6 hour
                  <span class="rate-money">$65.0</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  12 hour
                  <span class="rate-money">$100.0</span>
                </div>  
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  1 week
                  <span class="rate-money">$250.0</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 col-sm-12 col-xs-5">
                <h3>Fixed gear</h3>
              </div>
              <div class="col-md-5 col-sm-12 col-xs-7">
                <button class="btn-grey" data-toggle="modal" data-target="#rent-1">RENT</button>
              </div>    
            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <img class="bikes-img" src="/images/bikes/2.jpg">
            <div class="row rate-price">
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  1 hour
                  <span class="rate-money">$12.0</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  6 hour
                  <span class="rate-money">$65.0</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  12 hour
                  <span class="rate-money">$100.0</span>
                </div>  
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  1 week
                  <span class="rate-money">$250.0</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 col-sm-12 col-xs-5">
                <h3>Big boy ultra</h3>
              </div>
              <div class="col-md-5 col-sm-12 col-xs-7">
                <button class="btn-grey">RENT</button>
              </div>    
            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <img class="bikes-img" src="/images/bikes/3.jpg">
            <div class="row rate-price">
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  1 hour
                  <span class="rate-money">$12.0</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  6 hour
                  <span class="rate-money">$65.0</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  12 hour
                  <span class="rate-money">$100.0</span>
                </div>  
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="rate-time">
                  1 week
                  <span class="rate-money">$250.0</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 col-sm-12 col-xs-5">
                <h3>Sanchaez</h3>
              </div>
              <div class="col-md-5 col-sm-12 col-xs-7">
                <button class="btn-grey">RENT</button>
              </div>    
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!--*************************** Modal ***************************-->
  <div class="modal fade" id="rent-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Rent FIXED GEAR</h4>
            <span class="cart-subtitle">Fill out the form to contact us </span>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  The beginning of the rent:
                  <div class="form-group">
                    <div class="input-group date" id="datetimepicker1">
                      <input type="text" class="form-control" />
                      <span class="input-group-addon calendar-btn">
                        <span class="glyphicon-calendar glyphicon"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  The end of the rent:
                  <div class="form-group">
                    <div class="input-group date" id="datetimepicker2">
                      <input type="text" class="form-control" />
                      <span class="input-group-addon calendar-btn">
                        <span class="glyphicon-calendar glyphicon"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control contact-input" placeholder="Name" pattern="[A-Za-z]{3,}" required>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control contact-input" placeholder="Surname" pattern="[A-Za-z]{3,}" required>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control contact-input" placeholder="Phone number" pattern="{7}" required>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email" class="form-control contact-input" placeholder="Email" required>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <textarea class="form-control contact-input mess-placehold" placeholder="Message.."></textarea>
                </div>
              </div>
          </div>
          <!--****** Modal footer ******-->
          <div class="modal-footer modal-rent">
            <button class="btn-black">SEND</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--*************************** END Modal ***************************-->