<!DOCTYPE html>
<html>
<head>
    <title style="color: blueviolet">Enco Group Customer Aging</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }
    .title {
        color: #0070c0;
    }
    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .p-10 {
        padding: 10px;
    }

    .p-20 {
        padding: 20px;
    }

    .p-30 {
        padding: 20px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 45px;
        height: 45px;
        padding-top: 30px;
    }

    .logo span {
        margin-left: 8px;
        top: 19px;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr, th, td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 13px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .sm-text {
        font-size: 75% ! important;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>
<body>

@include('includes.header')
{{-- <div class="mt-10 text-bold w-50" style="position:absolute; left: 20px;top: -10px;">
    <img src="../public/enco.png" height="60px" alt="Image"/>
</div> --}}
<div class="head-title">
    <h2 class="text-center mt-1 p-0">Accounts Receivable {{ $title }}</h2>
</div>


@if($all_customers == true) 
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10 sm-text">
        <tr>
            <th class="w-85">Customer Name</th>
            <th class="w-50">Current</th>
            <th class="w-50">1-30</th>
            <th class="w-50">31-60</th>
            <th class="w-50">61-90</th>
            <th class="w-50">91-120</th>
            <th class="w-50">121-150</th>
            <th class="w-50">151-180</th>
            <th class="w-50">180 ></th>
            <th class="w-50">Total</th>
            <div style="clear: both;"></div>
        </tr>
        @foreach($order as $key => $item)
            <tr align="center">
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['current'] }}</td>
                <td>{{ $item['one_thirty_total'] }}</td>
                <td>{{ $item['thirtyone_sixty_total'] }}</td>
                <td>{{ $item['sixtyone_ninety_total'] }}</td>
                <td>{{ $item['ninetyone_htwenty_total'] }}</td>
                <td>{{ $item['htwentyone_hfifty_total'] }}</td>
                <td>{{ $item['hfiftyone_heighty_total'] }}</td>
                <td>{{ $item['heightyone_above_total'] }}</td>
                <td>{{ $item['total_currency'] }}</td>
                <div style="clear: both;"></div>
            </tr>
        @endforeach
        <tr>
            <td colspan="11">
                <div class="total-part">
                    <div class="total-left w-80 float-left text-bold" align="left" style="margin-left:50px">
                        <p>Total:</p>
                    </div>
                    <div class="total-right w-50 float-right text-bold" align="right"  style="margin-right:30px">
                        <p>PHP {{ $total }}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</div>
@endif

@if($all_customers == false) 
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10 sm-text">
        <tr>
            <th class="w-85">Date</th>
            <th class="w-50">DR No</th>
            <th class="w-50">Terms</th>
            <th class="w-50">1-30</th>
            <th class="w-50">31-60</th>
            <th class="w-50">61-90</th>
            <th class="w-50">91-120</th>
            <th class="w-50">121-150</th>
            <th class="w-50">151-180</th>
            <th class="w-50">180 ></th>
            <th class="w-50">Total</th>
            <div style="clear: both;"></div>
        </tr>
        @foreach($order as $key => $item)
            <tr align="center">
                <td>{{ $item['date_posted'] }}</td>
                <td>{{ $item['sales_dr_number'] }}</td>
                <td>{{ $item['term'] ? $item['term']['code'] : 'N/A' }}</td>
                <td>{{ $item['one_thirty'] }}</td>
                <td>{{ $item['thirtyone_sixty'] }}</td>
                <td>{{ $item['sixtyone_ninety'] }}</td>
                <td>{{ $item['ninetyone_htwenty'] }}</td>
                <td>{{ $item['htwentyone_hfifty'] }}</td>
                <td>{{ $item['hfiftyone_heighty'] }}</td>
                <td>{{ $item['heightyone_above'] }}</td>
                <td>{{ $item['remaining_balance'] }}</td>
                <div style="clear: both;"></div>
            </tr>
        @endforeach
        <tr>
            <td colspan="12">
                <div class="total-part">
                    <div class="total-left w-80 float-left text-bold" align="left" style="margin-left:50px">
                        <p>Total:</p>
                    </div>
                    <div class="total-right w-50 float-right text-bold" align="right"  style="margin-right:30px">
                        <p>PHP {{ $total }}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</div>
@endif





</html>
