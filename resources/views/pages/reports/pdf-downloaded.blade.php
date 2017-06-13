<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sinar Mas Social Media Center</title>
        <style strong="text/css">
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background-color: #ffffff;
                font-family: 'Arial',sans-serif;
                color: #585858;
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                font-family: 'Arial',sans-serif;
                color: #585858;
            }
            .page {
                padding: 0;
                margin: 0;
                background: white;
            }
            .subpage {
                margin: 20mm;
            }
            table {
                margin: 0;
                padding: 0;
                border: 0;
                width: 100%;
            }
            .nomargin {
                margin: 0;
            }
            @page {
                margin: 0;
            }
            .page {
                width: 210mm;
                height: 297mm;
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
            .cover {
                width: 210mm;
                height: 297mm;
                text-align: center;
                position: relative;
                page-break-after: always;
            }
            .page-title {
                position: absolute;
                width: 150mm;
                top: 50%;
                left: 50%;
                transform: translate3d(-50%, -50%, 0px);
            }
            img {
                width: 80mm;
                height: auto;
            }
        </style>
        </head>
    <body class="white">
        <div class="cover">
            <div class="page-title">
                <h1>Sinar Mas Social Media Report</h1>
                <h4>Project : {{ $projectName }}</h4>
                <h4>Date : {{ $reportStart }} - {{ $reportEnd }}</h4>
            </div>
        </div>
        <div class="page">
            <div class="subpage">
                <table>
                    <tr>
                        <td width="50%">
                            @if(isset($brandEquity))<img src="{{ $brandEquity }}" />@endif
                        </td>
                        <td width="50%">
                            @if(isset($sentiment))<img src="{{ $sentiment }}" />@endif
                        </td>
                    </tr>
                    <tr>
                        {{-- <td width="50%">
                            @if(isset($sentimentTrend))<img src="{{ $sentimentTrend }}" />@endif
                        </td> --}}
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
        </div>
        <div class="page">
            <div class="subpage">
                <table>
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
                        {{--
                        <td width="50%">
                            <h6>Topic Distribution</h6>
                            @if(isset($topicDist))<img src="{{ $topicDist }}" />@endif
                        </td> --}}
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
        </div>
    </body>
</html>
