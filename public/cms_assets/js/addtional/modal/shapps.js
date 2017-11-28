$(document).ready(function(){
  // BEGIN ACT MODAL
  $(document).on('click', '#actButton', function(e){
    $('#hiddenID').empty();
    $('#hiddenState').empty();
    $('#currState').empty();	
    $('#nextState').empty();
    e.preventDefault();
    
    var uid = $(this).data('id');
    var active = $(this).data('active');

    if(active == 1){
      curr = "Enabled";
      next = "Disabled";
    } else if (active == 0){
      curr = "Disabled";
      next = "Enabled";
    }

    $('#hiddenID').val(uid);
    $('#hiddenState').val(active);
    $('#currState').append(curr);
    $('#nextState').append(next);
   
  });
  // END ACT MODAL

  // BEGIN DEL MODAL
  $(document).on('click', '#delButton', function(e){
    $('#hiddenID2').empty();
    e.preventDefault();
    
    var uid = $(this).data('id');

    $('#hiddenID2').val(uid);
     
  });
  // END DEL MODAL

  // BEGIN PARAM MODAL
  $(document).on('click', '#paramButton', function(e){
    $('#appid').empty();

    e.preventDefault();
    
    var appid = $(this).data('id');    

    $('#appid').val(appid);

    console.log(appid);

    $(document).on('click', '#submitHeaderButton', function(e){
      $('#appid').empty();
      e.preventDefault();
      
      var data = $('#headerForm').serializeArray();
      var appid = $('#appid').val();

      data.push({
        name: "app_id",
        value: appid
      },
      {
        name: "type",
        value: "header"
      });

      $.ajax({
        type: "POST",
        url: "/mod/appparams",
        data: data,
        dataType: "json",
        success: function(resp) {
          console.log(resp);
        },
        error: function() {
          alert('error handing here');
        }
      });
      
       
    });

    $(document).on('click', '#submitBodyButton', function(e){
      $('#appid').empty();
      e.preventDefault();
      
      var data = $('#bodyForm').serializeArray();
      var appid = $('#appid').val();

      data.push({
        name: "app_id",
        value: appid
      },
      {
        name: "type",
        value: "body"
      });

      $.ajax({
        type: "POST",
        url: "/mod/appparams",
        data: data,
        dataType: "json",
        success: function(resp) {
          console.log(resp);
        },
        error: function() {
          alert('error handing here');
        }
      });
     
    });

  });
  // END PARAM MODAL

});