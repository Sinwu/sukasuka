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

  // BEGIN PARAM MODAL
  $(document).on('click', '#paramButton', function(e){
    $('#appid').empty();
    $('#headerName').empty();
    $('#headerValue').empty();
    $('#bodyName').empty();
    $('#bodyValue').prop('selectedIndex',0);

    e.preventDefault();
    
    var appid = $(this).data('id');    

    $('#appid').val(appid);

    $.ajax({
      type: "GET",
      url: "/mod/appparams/"+appid,
      dataType: "json",
      success: function(resp) {
        console.log(resp);
        if(resp.ok == "true") {

          // $('#headerTable > tbody:last-child').append('<tr>'+
          //   '<td>'+resp.data.name+'</td>'+
          //   '<td>'+resp.data.value+'</td>'+
          //   '<td class="text-center"><button id="delButton" type="button" class="btn ink-reaction btn-raised btn-danger" data-toggle="modal" data-target="#delModal" data-id="'+resp.id+'">Delete</button></td>'+              
          // '</tr>');

        } else {
          
          toastr.clear();
          
          var message = 'Failed to fetch data.';
          toastr.info(message, '');
        }
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
              '<td class="text-center"><button id="delButton" type="button" class="btn ink-reaction btn-raised btn-danger" data-toggle="modal" data-target="#delModal" data-id="'+resp.id+'">Delete</button></td>'+              
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
              '<td class="text-center"><button id="delButton" type="button" class="btn ink-reaction btn-raised btn-danger" data-toggle="modal" data-target="#delModal" data-id="'+resp.id+'">Delete</button></td>'+              
            '</tr>');

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

  });
  // END PARAM MODAL

});