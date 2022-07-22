<!--
=========================================================
* Argon Dashboard 2 - v2.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('img/apple-icon.png') !!}">
  <link rel="icon" type="image/png" href="{!! asset('img/favicon.png') !!}">
  <title>
    DNT - Core
  </title>
  <!--     Fonts and icons     -->
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{!! asset('css/nucleo-icons.css') !!}" rel="stylesheet" />
  <link href="{!! asset('css/nucleo-svg.css') !!}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="//kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{!! asset('css/nucleo-svg.css') !!}" rel="stylesheet" />
  <!-- CSS Files -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script> -->
  <script src="//cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{!! asset('css/argon-dashboard.css') !!}" rel="stylesheet" />

  <!-- include Vue.js -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script> -->
  <script src="//unpkg.com/vue@3"></script>
  <script src="//cdn.jsdelivr.net/npm/vue3-sfc-loader/dist/vue3-sfc-loader.js"></script>

  <!-- include Vue Datepicker -->
  <script src="{!! asset('js/vuedatepicker.min.js') !!}"></script>

  <!-- include CKEditor 5 (vanilla) -->
  <script src="//cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
  <script src="//cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="rootToast" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div id="rootAlertMessage" class="toast-body">
          Hello, world! This is a toast message.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <script src="{!! asset('js/toast.js') !!}"></script>
  <script src="{!! asset('js/httpClient.js') !!}"></script>
  <script src="{!! asset('js/navigator.js') !!}"></script>
  <script src="{!! asset('js/vue_initial.js') !!}"></script>
  <script src="{!! asset('js/ckeditor_initial.js') !!}"></script>
  <script>
    // function for ckeditor, editor attribute picker
    

    
  </script>