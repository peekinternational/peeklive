<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Wosom Chat History</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- styles -->
    <link rel="stylesheet" href="{{asset('css/styles.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Styles -->
    <script src="{{ asset('js003/app.js') }}" defer></script>
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
      .user-avatar.no-border.tiny {
        width: 40px;
        height: 40px;
      }
      .chat-widget-conversation .chat-widget-speaker.left {
          padding: 0 26px 0 50px;
      }
      .chat-widget-conversation .chat-widget-speaker.left p:first-child{
        font-weight: 600;
        margin-bottom: .5rem;
      }
      .chat-widget-wrap .chat-widget .chat-widget-conversation {
          height: 635px;
      }
      .delete-chat{
        right: 0;
        top: 12px;
        cursor: pointer;
        position: absolute;
      }
      .delete-chat .fa{
        color: red;
        padding-right: 5px;
      }
    </style>
  </head>
  <body>
    <div id="app">
      
        <history-component></history-component>
    </div>

    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mainmenu.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
  </body>
</html>
