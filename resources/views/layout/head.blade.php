<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('img/apple-icon.png') !!}">
    <link rel="icon" type="image/png" href="{!! asset('img/favicon.png') !!}">

    <title>
        Juno
    </title>

    <!-- Fonts and icons -->
    <script src="{!! asset('js/plugins/webfont/webfont.min.js') !!}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{!! asset('css/fonts.min.css') !!}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- Load CSS assets with Vite -->
    <script>
        const BASE_URL = "{{ url('') }}"
    </script>
    @vite(['resources/js/app.js', 'resources/scss/dnt-core.scss'])

    <!-- include CKEditor 5 (vanilla) -->
    <script src="//cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--- APP CSS --->
    <link id="pagestyle" href="{!! asset('css/app.css') !!}" rel="stylesheet" />

    <script>
        const webBasePath = "{{ env('BASE_PATH') }}"
    </script>
</head>
