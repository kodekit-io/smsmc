<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sinar Mas Social Media Report</title>
    <meta name="author" content="Sinar Mas">
    <meta name="subject" content="Sinar Mas Social Media Report">
    <meta name="keywords" content="report">
    <meta name="date" content="<?php echo date('d-m-Y'); ?>">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: 'Arial',sans-serif;
            color: #333333;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            font-family: 'Arial',sans-serif;
            color: #333333;
        }
        @page {
            size: A4 portrait;
            margin: 0;
        }
        .page {
            padding: 20mm 10mm 10mm 20mm;
        }
        .cover {
            page-break-after: always;
        }
        table {
            width: 180mm;
        }
        table td {
            border: 1px solid #eee;
        }
        table img {
            width: 85mm;
            height: auto;
        }
        .page-title {
            padding-top: 100mm;
        }
    </style>
</head>

<body>
    <div class="page cover">
        <div class="logo"><img src="{!! asset('assets/img/logo.png') !!}" alt="Sinar Mas" height="50px"></div>
        <div class="page-title">
            <h1>Sinar Mas Social Media Report</h1>
            <p>Project : {{ $projectName }}<br>
            Date : {{ $reportStart }} - {{ $reportEnd }} (UTC)</p>
        </div>
    </div>
    <div class="page">
        <table cellspacing="10">
            <tr>
                <td width="50%">
                    @if(isset($brandEquity))<img src="{{ $brandEquity }}" />@endif
                </td>
                <td width="50%">
                    @if(isset($sentiment))<img src="{{ $sentiment }}" />@endif
                </td>
            </tr>
            <tr>
                <td width="50%">
                    @if(isset($postTrend))<img src="{{ $postTrend }}" />@endif
                </td>

                <td width="50%">
                    @if(isset($buzzTrend))<img src="{{ $buzzTrend }}" />@endif
                </td>
            </tr>
            <tr>
                <td width="50%">
                    @if(isset($reachTrend))<img src="{{ $reachTrend }}" />@endif
                </td>
                <td width="50%">
                    @if(isset($intTrend))<img src="{{ $intTrend }}" />@endif
                </td>
            </tr>
            <tr>
                <td width="50%">
                    @if(isset($postPie))<img src="{{ $postPie }}" />@endif
                </td>

                <td width="50%">
                    @if(isset($buzzPie))<img src="{{ $buzzPie }}" />@endif
                </td>
            </tr>
        </table>
    </div>
    <div class="page">
        <table cellspacing="10">
            <tr>
                <td width="50%">
                    @if(isset($intPie))<img src="{{ $intPie }}" />@endif
                </td>
                <td width="50%">
                    @if(isset($uniqueUser))<img src="{{ $uniqueUser }}" />@endif
                </td>
            </tr>
            <tr>
                <td width="50%">
                    @if(isset($intRate))<img src="{{ $intRate }}" />@endif
                </td>
                <td width="50%">
                    @if(isset($som))<img src="{{ $som }}" />@endif
                </td>
            </tr>
            <tr>
                <td width="50%">
                    @if(isset($ontology))<img src="{{ $ontology }}" />@endif
                </td>
                <td width="50%">
                    @if(isset($wordcloud))<img src="{{ $wordcloud }}" />@endif
                </td>
            </tr>
        </table>
    </div>
</body>
