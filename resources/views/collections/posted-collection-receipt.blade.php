<!DOCTYPE html>
<html>
<head>
    <title>Enco Bottling Corporation</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
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
</style>
<body>

@include('includes.header')
<div class="mt-10 text-bold w-50" style="position:absolute; left: 20px;top: -10px;">
    {{-- {!! DNS2D::getBarcodeHTML((string) $order['qr_code'] ?? '', 'QRCODE', 3,3) !!} --}}
    <img src="../public/enco.png" height="60px" alt="Image"/>
</div>
<div class="mt-10 text-bold w-50" style="position:absolute; left: 600px;top: -10px;">
    {!! DNS2D::getBarcodeHTML((string) $order['qr_code'] ?? '', 'QRCODE', 3,3) !!}
</div>
<div class="head-title">
    <h2 class="text-center mt-1 p-0">COLLECTION RECEIPT</h2>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Customer Name: <span class="gray-color">{{$order['customer']['name']}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Address: <span class="gray-color">{{$order['customer']['address']}}</span></p>
    </div>
    <div class="w-50 float-right mt-10">
        <p class="m-0 pt-5 text-bold w-100">CR No: <span class="gray-color">{{$order['collection_order_number']}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Status: <span class="gray-color">{{$order['status']}}</span></p>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Remarks: </p>
    </div>
    <div class="w-50 float-right mt-10">
        <p class="m-0 pt-5 text-bold w-100">Total Amount Due: <span class="gray-color">Php {{ $order['amount'] }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Total Amount Collected: <span class="gray-color">Php {{ $order['amount_collected'] }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Balance: <span class="gray-color">Php {{ $order['balance'] }}</span></p>
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
                        <p>Total Total:</p>
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


<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Acctg Prepared:</th>
            <th class="w-50">Received By:</th>
            <div style="clear: both;"></div>
        </tr>
        <tr align="center">
            <td class="p-30"></td>
            <td class="p-30"></td>
            <div style="clear: both;"></div>
        </tr>
    </table>
</div>



</html>
