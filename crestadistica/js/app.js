
  $(".ajaxMensaje").hide();

  $("a#activar").click(function(event){
    var href = $(this).attr("href");
    var userId = $(this).attr("data-usuario-id");
    var status = $(this).attr("data-usuario-status");

    status == 1 ? status = 0: status = 1;

    var postData = {
        'id': userId,
        'status': status
      
    };

    //var postData = 'id='+userId+'&status='+status;
      $.ajax({
           type: "POST",
           url:href, 
           data: postData,
           dataType: "html",
           success: function(m) {
            
              if(status==1)
              {
                $("a.activo_"+userId).attr("data-usuario-status","1");
                $("#status_"+userId).html('Activo');
                $("#status_"+userId).removeClass('inactivo');
                $("#status_"+userId).addClass('activo');
                $("a.activo_"+userId).html('Desactivar');

                  location.reload();
              }else{
                $("a.activo_"+userId).attr("data-usuario-status","0");
                $("#status_"+userId).html('Inactivo');
                $("#status_"+userId).removeClass('activo');
                $("#status_"+userId).addClass('inactivo');
                $("a.activo_"+userId).html('Activar');
              }

              //$(".ajaxMensaje").show('slow');

           
            }
           
        });
      return false;  

       event.defaultPrevented();
  });

//Delete Users

 $("a#eliminar").click(function(event){
    var href = $(this).attr("href");
    var userId = $(this).attr("data-usuario-id");

    var postData = {
        'id': userId,
      
    };

    //var postData = 'id='+userId+'&status='+status;
      $.ajax({
           type: "POST",
           url:href, 
           data: postData,
           dataType: "html",
           success: function(m) {
            
              $(".ajaxMensaje").html(m);
              $(".ajaxMensaje").show('slow');
              $("li.usuario_"+userId).remove();
      
            }
           
        });
      return false;  

       event.defaultPrevented();
  });


  //Delete Módulos

  $("a#eliminar_modulo").click(function(event){
      var href = $(this).attr("href");
      var moduloId = $(this).attr("data-modulo-id");

      var postData = {
          'id': moduloId,

      };

      //var postData = 'id='+userId+'&status='+status;
      $.ajax({
          type: "POST",
          url:href,
          data: postData,
          dataType: "html",
          success: function(m) {

              $(".ajaxMensaje").html(m);
              $(".ajaxMensaje").show('slow');
              $("li.modulo_"+moduloId).remove();

          }

      });
      return false;

      event.defaultPrevented();
  });


