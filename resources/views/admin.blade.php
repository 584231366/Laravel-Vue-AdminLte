<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>后台管理</title>
        <link rel="stylesheet" href="{{ mix('css/admin/app.css') }}">
    </head>
    <body class="skin-blue sidebar-mini">
        <div id="app"></div>
        <script type="text/javascript" src="{{ mix('js/admin/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/admin/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/admin/app.js') }}"></script>
    </body>
</html>
