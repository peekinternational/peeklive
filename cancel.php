<?php

include "vendor/autoload.php";
include "payment.php";

use Payment\Payment;
$payment = new Payment;

// ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO meta tags -->
    <meta name="author" content="Peek International">
    <meta name="description" content="Peek Chat - premium live chat software for business. Realtime messenger to make your communication with customers as easy and enjoyable while chatting.">
    <meta name="keywords" content="chat, live, realtime, system, application, messenger, chatting, integration, plugin, library, wordpress, laravel, buddypress, joomla, php, moosocial, codeigniter, community builder, xenforo,real time chat system in laravel, laravel Chat, socket chat, live chat,real-time messaging, real-time,real-time chat">
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:standard">

    <!-- Favicon icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">

    <!-- Canonicals -->
    <link rel="canonical" href="https://www.peekchat.live/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Best Live Chat | Realtime Chat System | Peek Chat">
    <meta property="og:description" content="Peek Chat is specially designed as a Realtime messenger to make your communication with customers as easy and enjoyable while chatting.">
    <meta property="og:url" content="https://www.peekchat.live/">
    <meta property="og:site_name" content="Peek Chat">
    <meta property="article:modified_time" content="2021-07-01T11:52:56+00:00">
    <meta property="og:image" content="https://www.peekchat.live/img/logo.png">

    <!-- Vendor CSS -->
    <link rel="stylesheet" media="screen" href="./vendor/tiny-slider/dist/tiny-slider.css">
    <link rel="stylesheet" media="screen" href="./vendor/lightgallery.js/dist/css/lightgallery.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" media="screen" href="./css/theme.min.css">

    <!-- Title -->
    <title>Peek Chat | PayPal Transaction Cancel</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EH0R2515VS"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-EH0R2515VS');
    </script>
  </head>
  <body>
    <!-- Navbar with topbar -->
    <header class="header navbar-floating">
      <!-- Topbar -->
      <div class="navbar navbar-topbar navbar-expand navbar-light pb-0">
        <div class="container">
          <!-- Nav -->
          <ul class="navbar-nav flex-shrink-0">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="https://wa.me/923315333899">
                <span class="text-muted me-1">
                  <svg style="width: 14px;" xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24"><title>WhatsApp</title><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                </span>
                +92 (331) 533 3899
              </a>
            </li>
            <li class="nav-item text-nowrap d-none d-md-block">
              <a class="nav-link border-start ms-3 ps-3" href="mailto:info@peekchat.live">
                <i class="si-mail me-1"></i>
                info@peekchat.live
              </a>
            </li>
          </ul>
          <!-- End Nav -->

          <!-- Nav -->
          <ul class="navbar-nav align-items-center flex-shrink-0 ms-3">
            <li class="nav-item d-none d-md-block">
              <a class="nav-link border-end me-3 pe-3" href="#contactUs" data-scroll>
                <i class="si-help-circle me-1"></i>
                Help
              </a>
            </li>
            <li class="nav-item text-muted me-2">Follow us:</li>
            <li class="nav-item">
              <a class="btn btn-xs btn-icon btn-vision-secondary me-2" href="https://www.facebook.com/peekchat">
                <i class="si-facebook"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="btn btn-xs btn-icon btn-vision-secondary me-2" href="https://twitter.com/peek_intr">
                <i class="si-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="btn btn-xs btn-icon btn-vision-secondary" href="https://www.linkedin.com/in/peek-international-091861120?trk=hp-identity-name">
                <i class="si-linkedin"></i>
              </a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
      </div>
      <!-- End Topbar -->

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light navbar-sticky" data-scroll-header data-fixed-element>
        <div class="container">
          <!-- Logo -->
          <a class="navbar-brand order-lg-1 me-0 pe-xl-2 me-lg-4" href="#">
            <img width="72" src="./img/logo/logo.svg" alt="Peek chat">
            <span class="h5 d-none d-sm-inline-block mb-0 ms-1">PeekChat</span>
          </a>
          <!-- End Logo -->

          <!-- Responsive Toggle Button -->
          <button class="navbar-toggler ms-auto me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCollapseMenu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- End Responsive Toggle Button -->


          <!-- Contact Button -->
          <div class="order-lg-3">
            <a class="btn btn-primary" href="#contactUs" data-scroll>Contact us</a>
          </div>
          <!-- End Contact Button -->

          <!-- Offcanvas Collapsible Menu -->
          <div class="offcanvas offcanvas-start offcanvas-collapse order-lg-2" id="offcanvasCollapseMenu">
            <!-- Offcanvas header -->
            <div class="offcanvas-header shadow-xs">
              <h5 class="offcanvas-title h4">Menu</h5>
              <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
            </div>
            <!-- Offcanvas header -->

            <!-- Main Menu -->
            <ul class="offcanvas-body navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="#home" data-scroll>Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#overview" data-scroll>Overview</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#features" data-scroll>Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://peekchat.live/demo/login" data-scroll>Demo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pricing" data-scroll>Pricing</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#contactUs" data-scroll>Contacts</a>
              </li> -->
            </ul>
            <!-- End Main Menu -->
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
    </header>

    <!-- Main Content -->
    <main>
      <section class="position-relative bg-secondary pt-7 pb-5 pb-md-6 pb-lg-7 overflow-hidden" id="home">
				<h1>Your PayPal transaction has been canceled.</h1>
			</section>
    </main>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="footer bg-dark pt-5 pt-md-6">
      <div class="container pt-3 pt-md-0">
        <div class="row pb-3">
          <div class="col-md-4 mt-n2 pb-3 pb-md-0 mb-4">
            <a class="d-flex align-items-center mb-3" href="index.html" style="width: 153px;">
              <img width="72" src="./img/logo/logo.svg" alt="Peek chat">
              <span class="h5 text-white d-none d-sm-inline-block mb-0 ms-2">PeekChat</span>
            </a>
            <p class="fs-sm text-light opacity-60 pb-2 pb-sm-3">Stunning ,amazing , reliable ,responsive chat sytem</p>
            <a class="btn btn-icon btn-sm btn-outline-light btn-facebook me-2 mb-2" href="https://www.facebook.com/peekchat"><i class="si-facebook"></i></a>
            <a class="btn btn-icon btn-sm btn-outline-light btn-twitter me-2 mb-2" href="https://twitter.com/peek_intr"><i class="si-twitter"></i></a>
            <a class="btn btn-icon btn-sm btn-outline-light btn-linkedin me-2 mb-2" href="https://www.linkedin.com/in/peek-international-091861120?trk=hp-identity-name"><i class="si-linkedin"></i></a>
          </div>
          <div class="col-md-3 col-sm-5 ms-md-auto pb-1 mb-4">
            <h4 class="h5 text-white">Useful links</h4>
            <div>
              <ul class="nav nav-light nav-vertical fs-sm">
                <li><a class="nav-link" href="#home" data-scroll>Home</a></li>
                <li><a class="nav-link" href="#overview" data-scroll>Overview</a></li>
                <li><a class="nav-link" href="#features" data-scroll>Features</a></li>
                <li><a class="nav-link" href="#demo" data-scroll>Demo</a></li>
                <li><a class="nav-link" href="#pricing" data-scroll>Pricing</a></li>
                <li><a class="nav-link" href="#contactUs" data-scroll>Contacts</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 pb-1 mb-4">
            <h4 class="h5 text-white mb-4">Contacts</h4>
            <div class="d-flex pb-3 mb-2">
              <span class="text-success">
                <svg style="width: 18px;" xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24"><title>WhatsApp</title><path fill="currentColor" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
              </span>
              <div class="ps-3">
                <a class="d-block link-light fs-sm fw-medium" href="tel:+923315333899">+92 (331) 5333899</a>
              </div>
            </div>
            <div class="d-flex">
              <i class="si-mail fs-lg text-warning"></i>
              <div class="ps-3">
                <a class="d-block link-light fs-sm fw-medium" href="mailto:info@peekchat.live">info@peekchat.live</a>
              </div>
            </div>
          </div>
        </div>
        <hr class="my-0 border-light">
        <div class="text-center mt-3 py-4">
          <p class="fs-sm mb-0">
            <span class="text-light opacity-50 me-1">© All rights reserved.</span>
          </p>
        </div>
      </div>
    </footer>
    <!-- End Footer -->

    <!-- Scroll To Top Button -->
    <a class="btn btn-scroll-top" href="#top" data-scroll>
      <i class="si-arrow-up"></i>
    </a>
    <!-- End Scroll To Top Button -->
    
    <!-- Vendor scripts: JS libraries and plugins -->
    <script src="./vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="./vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="./vendor/lightgallery.js/dist/js/lightgallery.min.js"></script>
    <script src="./vendor/lg-fullscreen.js/dist/lg-fullscreen.min.js"></script>
    <script src="./vendor/lg-zoom.js/dist/lg-zoom.min.js"></script>
    <script src="./vendor/lg-video.js/dist/lg-video.min.js"></script>

    <!-- Theme JS -->
    <script src="./js/theme.min.js"></script>
  </body>

</html>