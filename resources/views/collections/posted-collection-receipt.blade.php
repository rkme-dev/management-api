<!DOCTYPE html>
<html>
<head>
    <title>Enco Bottling Corporation</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }
    .title {
        color: #0070c0;
    }
    .font-i {
        font-style: italic;
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
    .pt-50 {
        padding-top: 50px;
    }
    .pt-130 {
        padding-top: 130px;
    }

    .pd-10 {
        padding-bottom: 10px;
    }
    .pl-7 {
        padding-left: 7px;
    }
    .pl-40 {
        padding-left: 40px;
    }
    .pr-40 {
        padding-right: 40px;
    }

    .mt-10 {
        margin-top: 10px;
    }
    .mt-50 {
        margin-top: 50px;
    }

    .text-center {
        text-align: center !important;
    }
    .text-right {
        text-align: right !important;
    }

    .w-100 {
        width: 100%;
    }
    .w-40 {
        width: 40%;
    }
    .w-50 {
        width: 50%;
    }
    .w-60 {
        width: 60%;
    }
    .w-80 {
        width: 80%;
    }

    .w-85 {
        width: 85%;
    }

    .w-10 {
        width: 10%;
    }
    .w-15 {
        width: 15%;
    }
    .w-20 {
        width: 20%;
    }
    .w-25 {
        width: 20%;
    }
    .w-28 {
        width: 28%;
    }
    .w-30 {
        width: 30%;
    }
    .font-9 {
        font-size: 9;
    }

    .font-10 {
        font-size: 10;
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
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
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
    .copy {
        font-size: 15px !important;
        font-weight: lighter;
        font-style: italic;
        margin-top: 10px;
        margin-right: 30px;
        position: absolute;
        top: 118px;
        right: 0px;
    }
    .inline{
        display: inline-block;
    }
    .nextline{
        display: block;
    }
    .bd-none {
        border-left: none;
        border-bottom: none;
        border-right: none;
    }
    .footer {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
    }
    .page-break {
        page-break-after: always;
    }
    
</style>
<body>

@include('includes.header')
<div class="head-title">
    <h2 class="text-center mt-50">COLLECTION RECEIPT</h2>
</div>

<div class="mt-10 font-10">
    <div class="nextline">
        <div class="inline w-50">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Customer Name:</span> <span class="gray-color"> {{$order['customer']['name']}} </span></p>
        </div>
        <div class="inline w-30">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">CR No:</span> <span class="gray-color">{{$order['collection_order_number']}}</span></p>
        </div>
    </div>
    <div class="nextline">
        <div class="inline w-50">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Address:</span> <span class="gray-color"> {{$order['customer']['address']}} </span></p>
        </div>
        <div class="inline w-30">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Status:</span> <span class="gray-color"> {{$order['status']}} </span></p>
        </div>
    </div>
    
    <div style="clear: both;"></div>
</div>

<div class="mt-10 font-10">
    <div class="nextline">
        <div class="inline w-50">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Remarks:</span>  <span class="gray-color">{{strtoupper(str_replace('_',' ', $order['remarks']))}}</span></p>
        </div>
        <div class="inline w-30">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Total Amount Due</span> <span class="gray-color"> Php {{ $order['amount'] }} </span></p>
        </div>
    </div>
    <div class="nextline">
        <div class="inline w-50">
            {{-- <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Total Amound Collected:</span> <span class="gray-color"> </span></p> --}}
        </div>
        <div class="inline w-30">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Total Collected:</span> <span class="gray-color"> Php {{ $order['amount_collected'] }} </span></p>
        </div>
    </div>
    <div class="nextline">
        <div class="inline w-50">
            {{-- <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Total Amound Collected:</span> <span class="gray-color"> </span></p> --}}
        </div>
        <div class="inline w-30">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Balance:</span> <span class="gray-color"> Php {{ $order['balance'] }} </span></p>
        </div>
    </div>
    
    <div style="clear: both;"></div>
</div>

<div class="head-title mt-10">
    <h3 class="text-center mt-1 p-0">PAYMENT BREAKDOWN</h3>
</div>

<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Date</th>
            <th class="w-50">Type</th>
            <th class="w-50">Amount</th>
            <div style="clear: both;"></div>
        </tr>
        @foreach($order['payments'] as $key => $item)
            <tr align="center">
                <td>{{ $item['payment_date'] }}</td>
                <td>{{ $item['payment_type'] }}</td>
                <td>{{ $item['amount'] }}</td>
                <div style="clear: both;"></div>
            </tr>
        @endforeach
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-80 float-left text-bold" align="left" style="margin-left:70px">
                        <p>Total:</p>
                    </div>
                    <div class="total-right w-50 float-right text-bold" align="right"  style="margin-right:50px">
                        <p>PHP {{ $order['total_amount'] }}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</div>

<div class="add-detail mt-10">
    <div class="w-100 text-center mt-10">
        <p class="m-0 pt-5 w-100" style="font-style:italic">The undersigned herein states that he/she has inspected the goods upon delivery and hereby acknowledges
            Receipt of items listed in this delivery receipt found to be in good order.</p>
    </div>
    <div style="clear: both;"></div>
</div>




<div class="table-section bill-tbl w-100 pt-130">
    <table class="table w-100 mt-10">
        <tr  style="border-style: none" align="center">
            <td class="p-30" style="border-style: none">Acctg Prepared:</td>
            <td class="p-30" style="border-style: none">Received By:</td>
        </tr>
    </table>
</div>



</html>
