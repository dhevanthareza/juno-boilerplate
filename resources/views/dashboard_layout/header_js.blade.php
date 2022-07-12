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
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
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
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

  <script>
    const showToast = ({
      message,
      type //primary, secondary, succes, danger, info, warning, light,dark
    }) => {
      // configure color
      const alertContainer = document.getElementById("rootToast");
      const classForAlertContainer = `toast align-items-center text-white bg-${type} border-0`;
      alertContainer.className = classForAlertContainer;

      // configure title and message
      // const rootTitleAlert = document.getElementById("rootAlertTitle");
      const rootMessageAlert = document.getElementById("rootAlertMessage");
      // rootTitleAlert.innerHTML = title;
      rootMessageAlert.innerHTML = message;

      const rootToast = document.getElementById("rootToast");
      const toast = new bootstrap.Toast(rootToast);
      toast.show();
    }
    // to load Vue files from Modules
    const options_loadModule = {
      moduleCache: {
        vue: Vue
      },
      async getFile(url) {
        const res = await fetch(url);
        if (!res.ok)
          throw Object.assign(new Error(res.statusText + ' ' + url), {
            res
          });
        return {
          getContentData: asBinary => asBinary ? res.arrayBuffer() : res.text(),
        }
      },
      addStyle(textContent) {
        const style = Object.assign(document.createElement('style'), {
          textContent
        });
        const ref = document.head.getElementsByTagName('style')[0] || null;
        document.head.insertBefore(style, ref);
      },
    }
    const {
      loadModule
    } = window['vue3-sfc-loader'];

    // to map component for each modules
    function componentMap(basepath, components) {
      var generatedComponents = {};
      components.forEach(component => {
        generatedComponents[component] = Vue.defineAsyncComponent(() => loadModule(basepath + component + '.vue', options_loadModule));
      });
      return generatedComponents;
    }

    function commonComponentMap(components) {
      var generatedComponents = {};
      components.forEach(component => {
        generatedComponents[component] = Vue.defineAsyncComponent(() => loadModule("/js/vue_component/" + component + '.vue', options_loadModule));
      });
      return generatedComponents;
    }

    // function for ckeditor, editor attribute picker
    function updateCkeditor(form, datas) {
      datas.forEach(data => {
        form.set(data[1], window[
          editorGetAttr(data[0], data[1])
        ].getData());
      });
    }

    function editorGetAttr(identifier, name) {
      return 'editor_' + identifier + '_' + name;
    }

    const httpClient = axios.create({
      timeout: 10000,
      headers: {
        'X-CSRF-TOKEN': "{!! csrf_token() !!}"
      }
    });
  </script>