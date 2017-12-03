$(document).ready(function(){

  // Toastr Option          
  toastr.options.closeButton = false;
  toastr.options.progressBar = false;
  toastr.options.debug = false;
  toastr.options.positionClass = 'toast-top-right';
  toastr.options.showDuration = 333;
  toastr.options.hideDuration = 333;
  toastr.options.timeOut = 0;
  toastr.options.extendedTimeOut = 1000;
  toastr.options.showEasing = 'swing';
  toastr.options.hideEasing = 'swing';
  toastr.options.showMethod = 'slideDown';
  toastr.options.hideMethod = 'slideUp';

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

  // BEGIN EDIT APP MODAL
  $(document).on('click', '#editApp', function(e){
    $('#appID2').empty();
    e.preventDefault();
    
    var uid = $(this).data('id');
    $('#appID2').val(uid);

    alert(uid);

    $.ajax({
      type: "GET",
      url: "/mod/apps/"+uid,
      dataType: "json",
      success: function(resp) {
        if(resp.ok == true) {
          $('#appname2').val(resp.apps[0].name);
          $('#appurl2').val(resp.apps[0].url);
          $('#appdesc2').val(resp.apps[0].description);

          console.log(resp);

          // location.reload();
        } else {
          
          toastr.clear();
          
          var message = 'Failed to get data.';
          toastr.info(message, '');
        }
      },
      error: function() {
        alert('error handing here');
      }
    });
     
  });
  // END EDIT APP MODAL

  // BEGIN PARAM MODAL
  $(document).on('click', '#paramButton', function(e){
    $('#appid').empty();
    $('#headerName').empty();
    $('#headerValue').empty();
    $('#bodyName').empty();
    $('#bodyValue').prop('selectedIndex',0);

    $('#headerTable > tbody:last-child').empty();
    $('#bodyTable > tbody:last-child').empty();

    e.preventDefault();
    
    var appid = $(this).data('id');    

    $('#appid').val(appid);

    $.ajax({
      type: "GET",
      url: "/mod/appparams/"+appid,
      dataType: "json",
      success: function(resp) {
        var stringDataHeader = "";
        var stringDataBody = "";

        console.log(resp);
        setTimeout(function(){
          for (i=0; i < resp.params.length; i++){
            switch(resp.params[i].type){
              case "header":
                  stringDataHeader += '<tr>'+
                    '<td class="text-center">'+resp.params[i].name+'</td>'+
                    '<td class="text-center">'+resp.params[i].value+'</td>'+
                    '<td class="text-right">'+
                    // '<button id="editParam" type="button" class="btn ink-reaction btn-raised btn-warning" data-toggle="modal" data-target="#editParamModal" data-id="'+resp.params[i].id+'"><i class="md md-border-color"></i></button>'+
                    '<button id="delParam" type="button" class="btn ink-reaction btn-raised btn-danger" data-toggle="modal" data-target="#delParamModal" data-id="'+resp.params[i].id+'"><i class="md md-delete"></i></button>'+                      
                    '</td>'+ 
                  '</tr>';
                break;
              case "body":
                  stringDataBody += '<tr>'+
                    '<td class="text-center">'+resp.params[i].name+'</td>'+
                    '<td class="text-center">'+resp.params[i].value+'</td>'+
                    '<td class="text-right">'+
                    // '<button id="editParam" type="button" class="btn ink-reaction btn-raised btn-warning" data-toggle="modal" data-target="#editParamModal" data-id="'+resp.params[i].id+'"><i class="md md-border-color"></i></button>'+
                    '<button id="delParam" type="button" class="btn ink-reaction btn-raised btn-danger" data-toggle="modal" data-target="#delParamModal" data-id="'+resp.params[i].id+'"><i class="md md-delete"></i></button>'+                      
                    '</td>'+              
                  '</tr>';
                break;
              default:
                console.log(resp.params.type);
            }
          }

          $('#headerTable > tbody:last-child').append(stringDataHeader);
          $('#bodyTable > tbody:last-child').append(stringDataBody);

        },2000);
        //  else {
          
        //   toastr.clear();
          
        //   var message = 'Failed to fetch data.';
        //   toastr.info(message, '');
        // }
      },
      error: function() {
        alert('error handing here');
      }
    });

    console.log(appid);

    $(document).on('click', '#submitHeaderButton', function(e){
      $('#appid').empty();
      e.preventDefault();
      
      var data = $('#headerForm').serializeArray();
      var appid = $('#appid').val();

      data.push({
        name: "apps_id",
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
          if(resp.ok == "true") {

            toastr.clear();

            var message = 'Data saved.';
            toastr.info(message, '');

            $('#headerTable > tbody:last-child').append('<tr>'+
              '<td class="text-center">'+resp.data.name+'</td>'+
              '<td class="text-center">'+resp.data.value+'</td>'+
              '<td class="text-right">'+
              // '<button id="editParam" type="button" class="btn ink-reaction btn-raised btn-warning" data-toggle="modal" data-target="#editParamModal" data-id="'+resp.data.id+'"><i class="md md-border-color"></i></button>'+
              '<button id="delParam" type="button" class="btn ink-reaction btn-raised btn-danger" data-toggle="modal" data-target="#delParamModal" data-id="'+resp.data.id+'"><i class="md md-delete"></i></button>'+                      
              '</td>'+ 
              '</tr>');

            $('#headerModal').modal('hide');

            // location.reload();
          } else {
            
            toastr.clear();
            
            var message = 'Failed to save data.';
            toastr.info(message, '');
          }
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
        name: "apps_id",
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
          if(resp.ok == "true") {

            toastr.clear();

            var message = 'Data saved.';
            toastr.info(message, '');

            $('#bodyTable > tbody:last-child').append('<tr>'+
              '<td class="text-center">'+resp.data.name+'</td>'+
              '<td class="text-center">'+resp.data.value+'</td>'+
              '<td class="text-right">'+
              // '<button id="editParam" type="button" class="btn ink-reaction btn-raised btn-warning" data-toggle="modal" data-target="#editParamModal" data-id="'+resp.data.id+'"><i class="md md-border-color"></i></button>'+
              '<button id="delParam" type="button" class="btn ink-reaction btn-raised btn-danger" data-toggle="modal" data-target="#delParamModal" data-id="'+resp.data.id+'"><i class="md md-delete"></i></button>'+                      
              '</td>'+ 
              '/tr>');

            $('#bodyModal').modal('hide');

            // location.reload();
          } else {
            
            toastr.clear();
            
            var message = 'Failed to save data.';
            toastr.info(message, '');
          }
        },
        error: function() {
          alert('error handing here');
        }
      });
     
    });

    // BEGIN DEL MODAL
    $(document).on('click', '#delParam', function(e){
      $('#paramID').empty();

      e.preventDefault();
      
      var uid = $(this).data('id');
      $('#paramID').val(uid);      
      
      $(document).on('click', '#delParamButton', function(e){

        e.preventDefault();
        
        var data = $('#delParamForm').serializeArray();      

        $.ajax({
          type: "POST",
          url: "/mod/delappparams",
          data: data,
          dataType: "json",
          success: function(resp) {
            console.log(resp);

            var message = 'Data deleted.';
            toastr.info(message, '');

            $('#delParamModal').modal('hide');
            $('#paramModal').modal('hide');

          },
          error: function(resp) {
            alert('error handing here');
          }
        });

      });
      
    });
    // END DEL MODAL

  });
  // END PARAM MODAL

});