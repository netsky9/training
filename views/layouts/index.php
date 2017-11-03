<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;


AppAsset::register($this);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>
  <?php $this->beginBody() ?>
    
  <!--*************************** Slider ***************************-->
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators hidden-sm hidden-xs">
        <li  data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol> 
    <div class="carousel-inner">
      <div class="item active">
        <img src="/images/1.jpg" alt="">
      </div>
      <div class="item">
        <img src="/images/2.jpg" alt="">
      </div>
    </div>
    <a class="left carousel-control hidden-sm hidden-xs" href="#carousel-example-generic" data-slide="prev">
      <img src="/images/slider-icon.png" alt="" class="carousel-icon" id="left-carousel-icon">
    </a>
    <a class="right carousel-control hidden-sm hidden-xs" href="#carousel-example-generic" data-slide="next">
      <img src="/images/slider-icon.png" alt="" class="carousel-icon">
    </a>
  </div>
  <div class="main-text">

    <!--****** Navbar ******-->
    <div class="slim-container">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">

            <!--****** Logo ******-->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" id="navbar-mob">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">
                <img alt="Brand" class="logo" src="/images/logo.png" width="100" height="31">
              </a>
            </div>

            <!--****** Menu ******-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="menu-item">BICYCLES</a>
                  <ul class="dropdown-menu">
                    <?
                      if(isset($this->context->menuCatBicycle) && $this->context->menuCatBicycle != null)
                      {
                        foreach ($this->context->menuCatBicycle as $CatBicycle){
                          echo '
                            <li><a href="'. Url::to(['bicycles/index', 'category' => $CatBicycle['id_category']]) .'" id="menu-item">'.$CatBicycle['title'].'</a></li>
                          ';
                        }
                      }
                    ?>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="menu-item">PARTS</a>
                  <ul class="dropdown-menu">
                    <?
                      if(isset($this->context->menuCatParts) && $this->context->menuCatParts != null)
                      {
                        foreach ($this->context->menuCatParts as $CatParts){
                          echo '
                            <li><a href="'. Url::to(['bicycles/index', 'category' => $CatParts['id_category']]) .'" id="menu-item">'.$CatParts['title'].'</a></li>
                          ';
                        }
                      }
                    ?>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="menu-item">ACCESSORIES</a>
                  <ul class="dropdown-menu">
                    <?
                      if(isset($this->context->menuCatAccessories) && $this->context->menuCatAccessories != null)
                      {
                        foreach ($this->context->menuCatAccessories as $CatAccessories){
                          echo '
                            <li><a href="'. Url::to(['bicycles/index', 'category' => $CatAccessories['id_category']]) .'" id="menu-item">'.$CatAccessories['title'].'</a></li>
                          ';
                        }
                      }
                    ?>
                  </ul>
                </li>
                <li><a href="<?= '/extras' ?>" id="menu-item">EXTRAS</a></li>
                <li><a href="#" id="basket" data-toggle="modal" data-target="#myModal">
                  <? 
                  //количество товаров в корзине
                  if(!isset($_COOKIE['count_product'])){
                      $count = 0;
                      setcookie('count_product',$count, strtotime( '+30 days' ));
                      $Count = '';
                  }else{
                      if($_COOKIE['count_product'] > 0){
                        $Count = $_COOKIE['count_product'];
                      }
                  }
                  ?>
                  <span class="counter-product" style="margin-left: 25px;"><? echo $Count ?></span>
                  </a>
                </li>
              </ul>
            </div>

          </div>
        </nav>
      </div>
    </div>

    <!--****** Text ******-->
    <div class="col-md-12 text-center">
      <h1>HANDMADE BICYCLE</h1>
      <span class="slogan">You <span class="yellow">create</span> the <span class="yellow">journey,</span> we supply the <span class="yellow">parts.</span> </span>
      <div class="">
        <a class="btn btn-default btn-sm btn-black" href="" id="btn-slider">SHOP BIKES</a>
      </div>
    </div>
  </div>
  <!--*************************** END Slider ***************************-->

  <!--*************************** Modal ***************************-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Your cart</h4>
          <span class="cart-subtitle">You have 2 items for a total of US$60.80 in your basket. </span>
        </div>
        <div class="modal-body">

          <!--****** There output AJAX products ******-->
          ваша корзина пуста
        </div>
        <!--****** Modal footer ******-->
        <div class="modal-footer">
          <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-6"></div>
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6 mod-footer-text">
                  Total
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 money-right" id="total">
                  $0
                </div>
              </div>
              <button class="btn-cart checkout"> Checkout</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--*************************** END Modal ***************************-->

  <?= $content ?>

  <!--*************************** Contact us ***************************-->
  <div class="contact-us">
    <div class="super-slim-container">
      <h2>CONTACT US</h2>
      <span class="descr-text-cont">Please contact us for all inquiries and purchase options.</span>
        <form>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control contact-input" id="exampleInputEmail1" placeholder="NAME" pattern="[A-Za-z]{3,}" required>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control contact-input" id="exampleInputPassword1" placeholder="SURNAME" pattern="[A-Za-z]{3,}" required>
            </div>
          </div>
          <input type="email" class="form-control contact-input" id="exampleInputPassword2" placeholder="USER@DOMAIN.COM" required>
          <textarea class="form-control contact-input" rows="5" placeholder="MESSAGE"></textarea>
          <button type="submit" class="btn-grey btn-send" id="send">SEND</button>
        </form>
    </div>
  </div> 
  <!--*************************** END Contact us ***************************-->

  <!--*************************** Footer ***************************-->
  <div class="footer">

    <!--****** Navbar ******-->
    <div class="slim-container">
        <nav class="navbar navbar-default footer-nav">
          <div class="container-fluid">

            <!--****** Logo ******-->
            <div class="navbar-header hidden-xs">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" id="navbar-mob">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand footer-brand" href="#">
                <img alt="Brand" class="logo" src="/images/logo-black.png" width="100" height="31">
              </a>
            </div>

            <!--****** Menu ******-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropup">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="menu-item">BICYCLES</a>
                  <ul class="dropdown-menu" id="footer-nav-ul">
                    <li><a href="#" id="menu-item">FIXED / SINGLE SPEED</a></li>
                    <li><a href="#" id="menu-item">CITY BIKES</a></li>
                    <li><a href="#" id="menu-item">PREMIUM SERIES</a></li>
                  </ul>
                </li>
                <li class="dropdown dropup">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="menu-item">parts</a>
                  <ul class="dropdown-menu" id="footer-nav-ul">
                    <li><a href="#" id="menu-item">saddles</a></li>
                    <li><a href="#" id="menu-item">handlebars</a></li>
                    <li><a href="#" id="menu-item">pedals</a></li>
                    <li><a href="#" id="menu-item">wheels</a></li>
                  </ul>
                </li>
                <li><a href="#" id="menu-item">ACCESSORIES</a></li>
                <li><a href="#" id="menu-item">EXTRAS</a></li>
              </ul>
            </div>

          </div>
        </nav>
    </div>

  </div>
  <!--*************************** END Footer ***************************--> 

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <!-- Hidden static text -->
  <script type="text/javascript">
    var flag = 0;
    $("#navbar-mob").bind("click", function() {
      if(flag == 0){
        flag = 1;
        $(".text-center").hide();
      }else{
        $(".text-center").show();
        flag = 0;
      }
    });
  </script>

 <!-- Input Counter in the Cart -->
  <script type="text/javascript">

    //обновление счетчика товаров
    function Total(){
      var total = 0;
      $('.price-text').each(function(){
        tot =  $(this).text();
        tot = Number(tot);
        total += tot;
      });
      $('#total').text(total);
    }


    //обновление количества товара в куках
    function CountUpdate(count, id_product){
      //добавить 1 если будет работать не так как надо
      count++;
      $.ajax({
        type: "GET",
        url: "/bicycles/countupdate",
        data:{'counter':count, 'id_product':id_product},
        response:'html',
        success:function(data){
          //alert(data);
          //$('.modal-body').html(data);
          //Total();
        }
      });
    }


    var min = 1, max = 10;

    $('body').on('click', '.number .number_controls > button', function() {
      var input = $(this).closest('.number').find('input');
      var value = parseInt(input.val());
      if ($(this).hasClass('nc-minus')) {
        if(value>min){
          //находим id элемаента plus(оно содержит начальную цену)
          var id = $(this).attr('id');
          id = Number(id);

          var subtotal = $('.' + id).text();
          //переводим в число
          subtotal = Number(subtotal);
          var subtotal = subtotal - id;

          //выводим результат, id у Counter и у Subtotal одинаковые, чтобы легче инициилизировать
          $('.' + id).text(subtotal);
          value = value - 1;


          //получаем значение count, для умножения
          var c = $('input[name="'+id+'"]').val();
          //разница (для инкремента нумерация идет с 0, поэтому количество товаров 0+1, для декремента тоже самое, только - 0+1)
          c-=2;
          //пересчет суммы всех товаров
          Total();

          //вычисляем id продукта, чтобы изменить записив куках
          var id_product = $(this).val();
          CountUpdate(c,id_product);
        }
      }
      if ($(this).hasClass('nc-plus')) {
        if(value<max){
          //Суть скрипта в том, что он берет значения с одинаковыми id (это id товара) и для них производит вычисления

          //находим id элемаента plus
          var id = $(this).attr('id');

          //получаем значение count, для умножения
          var c = $('input[name="'+id+'"]').val();

          //Цена subtotal
          id = Number(id);
          var newprice = (id * c)+id;

          //выводим результат
          $('.' + id).text(newprice);
          value = value + 1;

          //пересчет суммы всех товаров
          Total();

          //вычисляем id продукта, чтобы изменить записив куках
          var id_product = $(this).val();
          CountUpdate(c,id_product);
        }
      }
      input.val(value).change();
    });


  </script>
  <!-- Работа с корзиной -->
  <script>
      function getCart(){
        $.ajax({
            type: "GET",
            url: "/bicycles/getcart",
            response:'html',
            success:function(data){
              $('.modal-body').html(data);
              Total();
            }
          });
      }

      function deleteFromCart(id_product){
        $.ajax({
            type: "GET",
            url: "/bicycles/deletefromcart",
            data:{'id_product':id_product},
            response:'html',
            success:function(data){
              getCart();
              alert('The product was a deleted from cart!');
              if(Number(data) == 0){
                $('.counter-product').text('');
              }else{
                $('.counter-product').text(data);
              }
            }
          });
      }


        //обработка нажатия на кнопку "купить"
        $('.sender').click(function(){
          //получаем значение id
          var id_product = $(this).val();

          //скрываем кнопку
          $(this).attr('disabled',true);
          $(this).text('BUYED');

          $.ajax({
            type: "GET",
            url: "/bicycles/addtocart",
            data: {'id_product':id_product},
            response:'html',
            success:function(data){
              if(data != 'is_exist'){
                $('.counter-product').text(data);
                alert('The product was added to the cart!');
              }else{
                alert('You are is already added product in the cart!');
              }
            }
          });
        });

        $('#basket').click(function(){
          getCart();
        });

      $('.checkout').click(function(){
        $.ajax({
            type: "GET",
            url: "/bicycles/addtodb",
            response:'html',
            success:function(data){
              alert('Your order will be processed soon!');
              //getCart();
              
              //$('.counter-product').text(data);
              //alert('Товар был успешно добавлен в корзину!');
            }
          });
      });
  </script>


  </body>
</html>
<?php $this->endPage() ?>