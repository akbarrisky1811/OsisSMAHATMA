<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    <?php  
      if (!empty($_GET["page"])) {
        $page = $_GET["page"]; 
        $admin_page = array("home","blog","post","kabinet");
        if  (in_array($page, $admin_page)) {
          echo "OSIS SMA Hang Tuah 5| ".ucfirst($page);
        }else{echo "OSIS SMA Hang Tuah 5 Sidaorjo | 404 Not Found";}
      }
      else{ echo "OSIS SMA Hang Tuah 5 | Home"; }   
    ?>
    </title>
  <link rel="shortcut icon" href="favicon.png" />
  <link rel="stylesheet" href="assets/css/bootloader.css">
  <div id="loader-wrapper">
    <div id="loader">
    </div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right">
    </div>
  </div>
  <!-- Libs CSS -->
  <link rel="stylesheet" href="assets/fonts/Feather/feather.css">
  <link rel="stylesheet" href="assets/libs/%40fancyapps/fancybox/dist/jquery.fancybox.min.css">
  <link rel="stylesheet" href="assets/libs/aos/dist/aos.css">
  <link rel="stylesheet" href="assets/libs/choices.js/public/assets/styles/choices.min.css">
  <link rel="stylesheet" href="assets/libs/flickity-fade/flickity-fade.css">
  <link rel="stylesheet" href="assets/libs/flickity/dist/flickity.min.css">
  <link rel="stylesheet" href="assets/libs/highlightjs/styles/vs2015.css">
  <link rel="stylesheet" href="assets/libs/jarallax/dist/jarallax.css">
  <link rel="stylesheet" href="assets/libs/quill/dist/quill.core.css" />
  <!-- Theme CSS -->
  <link rel="stylesheet" href="assets/css/theme.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/brands.min.css">
  <link rel="stylesheet" href="assets/css/regular.min.css">
  <link rel="stylesheet" href="assets/css/solid.min.css">
  <link rel="stylesheet" href="assets/css/fontawesome.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap">
  <!-- Custom Style -->
  <style type="text/css">
    .bg-dark {background-color: #273A5A!important;}
    .bg-warning {background-color: #FFD52B!important;}
    .text-dark {color: #273A5A!important;}
    .text-warning {color: #FFD52B!important;}
    .btn-warning {color: #273A5A;background-color: #FFD52B;border-color: #FFD52B;box-shadow: none;}
    .navbar-nav .nav-link {font-weight: 400;font-size: 14px;padding-right: 16px;padding-left: 16px;}
    .text-elipsis{white-space: nowrap; overflow: hidden;text-overflow: ellipsis;}
    .post img, .post p img {max-width: 100%; margin-bottom: 20px; border-radius: 5px}


  </style>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-156446909-2"></script>
  <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag("js", new Date());gtag("config", "UA-156446909-2");</script> -->
</head>