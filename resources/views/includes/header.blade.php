<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@if(isset($pageTitle)) {!! $pageTitle !!} -  @endif Sinar Mas Social Media Center</title>

        <link href="{!! asset('assets/img/favicon.png') !!}" rel="shortcut icon">

        <link rel="stylesheet" href="{!! asset('assets/css/lib/uikit.css') !!}" />
        <link rel="stylesheet" href="{!! asset('assets/css/main.css') !!}" />
        {{-- <link rel="stylesheet" href="{!! asset('assets/css/lib/offline-theme-default.css') !!}" /> --}}
        {{-- <link rel="stylesheet" href="{!! asset('assets/css/lib/offline-theme-default-indicator.css') !!}" /> --}}
		@section('page-level-styles')
	    @show
        <script src="{!! asset('assets/js/lib/jquery.min.js') !!}"></script>
        <script src="{!! asset('assets/js/lib/uikit.js') !!}"></script>
        <script src="{!! asset('assets/js/lib/uikit-icons.js') !!}"></script>
        {{-- <script src="{!! asset('assets/js/lib/offline.min.js') !!}"></script> --}}
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-97329185-1', 'auto');
          ga('send', 'pageview');

        </script>
    </head>
    <body>
