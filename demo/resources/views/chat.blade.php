<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Zeeshan Masood">
    <title>PeekChat</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- styles -->
    <link rel="stylesheet" href="{{asset('css/styles.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
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
        top: 6px;
      }
    </style>
  </head>
  <body>
    <?php 
      // $user_info = Request::get('user_info');
      $user_name = Request::get('user_name');
      $user=Session::get('sender_data');
      // print_r($user);die();
      ?>
      
    <div id="app" class="{{ session()->get('sender_data') }}">
      
        <demo-component  userdata="{{$user_info->id}}" user_name="{{$user_info->sender_name}}"></demo-component>
      
    </div>

    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mainmenu.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
      $('select').select2({
        placeholder: 'This is my placeholder',
        allowClear: true
      });
    </script>
  </body>
</html>
