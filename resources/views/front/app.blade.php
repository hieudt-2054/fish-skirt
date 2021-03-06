
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <title>Fish Skirt Project</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
     <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">
 
     <link rel="stylesheet" href="/fonts/icomoon/style.css">
     <link rel="stylesheet" href="/css/bootstrap.min.css">
     <link rel="stylesheet" href="/css/magnific-popup.css">
     <link rel="stylesheet" href="/css/jquery-ui.css">
     <link rel="stylesheet" href="/css/owl.carousel.min.css">
     <link rel="stylesheet" href="/css/owl.theme.default.min.css">
     <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
     <link rel="stylesheet" href="/fonts/flaticon/font/flaticon.css">
     <link rel="stylesheet" href="/css/aos.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 
     <link rel="stylesheet" href="/css/style.css">
     <link rel="stylesheet" href="/css/new-age.min.css">
     <link rel="stylesheet" href="/css/main.css">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://md-aqil.github.io/images/swiper.min.css">
   </head>
   <body>
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v7.0'
        });
      };
  
      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  
    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat"
      attribution=setup_tool
      page_id="105993704462484"
  theme_color="#0084ff"
  logged_in_greeting="Chào bạn chúng tôi có thể giúp gì cho bạn"
  logged_out_greeting="Chào bạn chúng tôi có thể giúp gì cho bạn">
    </div>
  
  <!-- Back to top button -->
  <a id="button"></a>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"
      nonce="WxNHVrsz"></script>
    <div id="loader-wrapper">
      <div id="loader"></div>
  
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  
    </div>
   <div class="site-wrap">
 
     <div class="site-mobile-menu">
       <div class="site-mobile-menu-header">
         <div class="site-mobile-menu-close mt-3">
           <span class="icon-close2 js-menu-toggle"></span>
         </div>
       </div>
       <div class="site-mobile-menu-body"></div>
     </div>
     
     @include('front.header')
     
     @yield('content')
     
     @include('front.footer')
     
   </div>
 
   <script src="/js/jquery-3.3.1.min.js"></script>
   <script src="/js/jquery-migrate-3.0.1.min.js"></script>
   <script src="/js/jquery-ui.js"></script>
   <script src="/js/popper.min.js"></script>
   <script src="/js/bootstrap.min.js"></script>
   <script src="/js/owl.carousel.min.js"></script>
   <script src="/js/jquery.stellar.min.js"></script>
   <script src="/js/jquery.countdown.min.js"></script>
   <script src="/js/jquery.magnific-popup.min.js"></script>
   <script src="/js/bootstrap-datepicker.min.js"></script>
   <script src="/js/aos.js"></script>
   <script src="/js/mainop.js"></script>
   <script src="/js/main.js"></script>
 
 
   </body>
 </html>