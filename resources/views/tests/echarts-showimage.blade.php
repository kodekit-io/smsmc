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
                font-family: 'Arial';
                color: #585858;
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                font-family: 'Arial';
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
            }
            table h6 {
                text-align: center;
                margin-bottom: 0;
            }
            .nomargin {
                margin: 0;
            }
            @page {
                margin: 0;
            }
            .page {
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
                text-align: center;
                position: relative;
                page-break-after: always;
            }
            .page-title {
                position: absolute;
                width: 150mm;
                top: 50%;
                left: 50%;
                margin-left: -75mm;
            }
        </style>
        </head>
    <body class="white">
        <div class="cover">
            <div class="page-title">
                <h1>Sinar Mas Social Media Report</h1>
                <h5>Date : </h5>
            </div>
        </div>
        <div class="page">
            <div class="subpage">
                <table>
                    <tr>
                        <td width="50%">
                            <h6>Brand Equity</h6>
                            <img src="{{ $firstChart }}" />
                        </td>
                        <td width="50%">
                            <h6>Brand Equity</h6>
                            <img src="{{ $secondChart }}" />
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <h6>Brand Equity</h6>
                            <img src="{{ $thirdChart }}" />
                        </td>
                        <td width="50%">
                            <h6>Brand Equity</h6>
                            <img src="{{ $fourthChart }}" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
