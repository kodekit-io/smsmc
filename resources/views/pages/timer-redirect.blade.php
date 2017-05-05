<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sinar Mas Social Media Center</title>

    <link href="{!! asset('assets/img/favicon.png') !!}" rel="shortcut icon">

    <link rel="stylesheet" href="{!! asset('assets/css/main.css') !!}" />
    @section('page-level-styles')
    @show
    <script src="{!! asset('assets/js/lib/jquery.min.js') !!}"></script>
</head>
<body>
<script>
    function redirect(){
        this.location.href = '{!! $nextUrl !!}';
    }
    setTimeout(redirect, {!! $timeOut !!});
</script>