$(function(){
      $('input').change(function(){
          var Input = $(this);
          if(this.checkValidity()){
            Input.addClass("input-right").removeClass("input-wrong");
          }else{
            Input.addClass("input-wrong").removeClass("input-right");
          }
      });
      $('textarea').change(function(){
          var Text = $(this);
          if(this.checkValidity()){
            Text.addClass("input-right").removeClass("input-wrong");
          }else{
            Text.addClass("input-wrong").removeClass("input-right");
          }
      });
    });