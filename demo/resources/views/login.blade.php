<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Peek Chat</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- styles -->
    <link rel="stylesheet" href="{{asset('css/styles.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Styles -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
      @media(min-width: 767px){
        .content-grid{
          min-height: 100vh;
        }
      }
      @media screen and (max-width: 960px){
        .chat-widget-wrap .chat-widget:first-child, .chat-widget-wrap .chat-widget:last-child {
          width: 100% !important;
        }
        .content-grid .account-hub-content .section-header:first-child {
            margin-top: 0;
            margin-bottom: 10px;
        }
      }
      .chat-widget-wrap .chat-widget:first-child {
        width: 35.438914%;
      }
      .chat-widget-wrap .chat-widget:last-child {
        width: 64.561086%;
      }
      .user-status .user-status-timestamp.floaty {
        top: 15px;
      }
    </style>
  </head>
  <body>
    <div id="app"> 
      <div class="container vh-100">
        <div class="row justify-content-center py-5 align-items-center h-100">
          <div class="col-md-6">
            <h4 class="text-center mb-4">Please login to Demo</h4>
            <!-- <form method="post"> -->
              <div class="form-group">
                <input type="text" name="sender_name" id="sender_name" placeholder="Enter your name" class="form-control">
                <input type="hidden" name="receiver_id" value="0">
                <input type="hidden" name="sender_id" value="0">
                <input type="hidden" name="message_id" value="0">
              </div>
              <div class="form-group">
                <button id="add_friend" class="btn btn-success btn-lg">Login</button>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mainmenu.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
      $( document ).ready(function() {
          $('#add_friend').click(function(){
        var sender_name = $("#sender_name").val();
          // alert(sender_name);
          $.ajax({
               type: 'POST',
               url: "{{url('add-friend')}}",
               data:{"_token": "{{ csrf_token() }}",sender_name:sender_name},
               xhrFields: {withCredentials: true},
               success:function(data){
                 console.log(data);
                 window.location.href = "{{url('/')}}";
               }
             });
      });
      });
    </script>
  </body>
</html>
