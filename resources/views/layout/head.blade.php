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

  <!-- Fonts and icons -->
	<script src="{!! asset('js/plugins/webfont/webfont.min.js') !!}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{!! asset("css/fonts.min.css") !!}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

  <!-- CSS Files -->
  <!-- Load CSS assets with Vite -->
  @vite
  
  <!-- include Vue.js -->
  @if (env('APP_ENV') == 'PRODUCTION')
  <script src="{!! asset('js/libraries/vue/vue.global.prod.js') !!}"></script>
  @else
  <script src="{!! asset('js/libraries/vue/vue.global.js') !!}"></script>
  @endif

  <script src="{!! asset('js/libraries/vue/vue3-sfc-loader.js') !!}"></script>


  <!-- include Vue Datepicker https://vue3datepicker.com -->
  {{-- <script src="https://unpkg.com/@vuepic/vue-datepicker@latest"></script> --}}
  <script src="{!! asset('js/libraries/vuedatepicker/vuedatepicker.js') !!}"></script>
  {{-- <link rel="stylesheet" href="https://unpkg.com/@vuepic/vue-datepicker@latest/dist/main.css"> --}}
  <link href="{!! asset('css/libraries/vuedatepicker/vdpmain.css') !!}" rel="stylesheet" />

  <!-- include CKEditor 5 (vanilla) -->
  <script src="//cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
  <script src="//cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- viewer js --->
  <script src="{!! asset('js/libraries/viewerjs/viewer.min.js') !!}"></script>
  <link href="{!! asset('css/libraries/viewerjs/viewer.min.css') !!}" rel="stylesheet" />

  <!---- SELECT ---->
  <script src="{!! asset('js/libraries/multiselect/multiselect.global.js') !!}"></script>
  <link href="{!! asset('css/libraries/multiselect/multiselect.css') !!}" rel="stylesheet" />
  <link id="pagestyle" href="{!! asset('css/app.css') !!}" rel="stylesheet" />
</head>
  