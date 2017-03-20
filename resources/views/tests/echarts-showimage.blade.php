@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('content')
    <img src="{!! $base64Image !!}">
@endsection

@section('page-level-scripts')
@endsection