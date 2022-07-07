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
    Argon Dashboard 2 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{!! asset('css/nucleo-icons.css') !!}" rel="stylesheet" />
  <link href="{!! asset('css/nucleo-svg.css') !!}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{!! asset('css/nucleo-svg.css') !!}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{!! asset('css/argon-dashboard.css') !!}" rel="stylesheet" />
  
  <!-- include Vue.js -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script> -->
  <script src="https://unpkg.com/vue@3"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue3-sfc-loader/dist/vue3-sfc-loader.js"></script>

  <!-- include Vue Datepicker -->
  <link rel="stylesheet" href="https://unpkg.com/@vuepic/vue-datepicker@latest/dist/main.css">
  <script src="https://unpkg.com/@vuepic/vue-datepicker@latest"></script>

  <!-- include CKEditor 5 (vanilla) -->
  <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
  
</head>

<body class="g-sidenav-show bg-gray-100">
  
<script>
  // to load Vue files from Modules
  const options_loadModule = {
      moduleCache: {
          vue: Vue
      },
      async getFile(url) {
          const res = await fetch(url);
          if ( !res.ok )
              throw Object.assign(new Error(res.statusText + ' ' + url), { res });
          return {
              getContentData: asBinary => asBinary ? res.arrayBuffer() : res.text(),
          }
      },
      addStyle(textContent) {
          const style = Object.assign(document.createElement('style'), { textContent });
          const ref = document.head.getElementsByTagName('style')[0] || null;
          document.head.insertBefore(style, ref);
      },
  }
  const { loadModule } = window['vue3-sfc-loader'];

  // to map component for each modules
  function componentMap(basepath, components){
    var generatedComponents = {};
    components.forEach(component => {
      generatedComponents[component] = Vue.defineAsyncComponent( () => loadModule(basepath+component+'.vue', options_loadModule) );
    });
    return generatedComponents;
  }
</script>