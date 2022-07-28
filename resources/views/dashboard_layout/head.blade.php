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

  <link id="pagestyle" href="{!! asset('css/argon-dashboard.css') !!}" rel="stylesheet" />
  <link id="pagestyle" href="{!! asset('css/core.css') !!}" rel="stylesheet" />

  <!-- include Vue.js -->
  @if (env('APP_ENV') == 'PRODUCTION')
  <script src="{!! asset('js/libraries/vue/vue.global.prod.js') !!}"></script>
  @else
  <script src="{!! asset('js/libraries/vue/vue.global.js') !!}"></script>
  @endif

  <script src="{!! asset('js/libraries/vue/vue3-sfc-loader.js') !!}"></script>


  <!-- include Vue Datepicker -->
  <script src="{!! asset('js/vuedatepicker.min.js') !!}"></script>

  <!-- include CKEditor 5 (vanilla) -->
  <script src="//cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
  <script src="//cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- viewer js --->
  <script src="{!! asset('js/libraries/viewerjs/viewer.min.js') !!}"></script>
  <link href="{!! asset('css/libraries/viewerjs/viewer.min.css') !!}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <script src="{!! asset('js/toast.js') !!}"></script>
  <script src="{!! asset('js/loading.js') !!}"></script>
  <script src="{!! asset('js/httpClient.js') !!}"></script>
  <script src="{!! asset('js/navigator.js') !!}"></script>
  <script src="{!! asset('js/vue_initial.js') !!}"></script>
  <script src="{!! asset('js/ckeditor_initial.js') !!}"></script>