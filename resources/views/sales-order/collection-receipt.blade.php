<!DOCTYPE html>
<html>
<head>
    <title>Enco Group Delivery Receipt</title>
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
<div class="head-title">
    <h2 class="text-center mt-1 p-0">COLLECTION RECEIPT</h2>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Customer: <span class="gray-color">{{$order['customer']['name']}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Address: <span class="gray-color">{{$order['customer']['delivery_address']}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">CRNo: <span class="gray-color">000203</span></p>
        <p class="m-0 pt-5 text-bold w-100">SO Date: <span class="gray-color">{{$order['created_at']}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Status: <span class="gray-color">Paid</span></p>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-85">Particulars</th>
            <th class="w-15">Amount Due</th>
            <div style="clear: both;"></div>
        </tr>
        @foreach($order['order_items'] as $item)
            <tr align="center">
                <td>{{ $item['product_id'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <div style="clear: both;"></div>
            </tr>
        @endforeach
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Total Amount Due</p>
                        <p>Total Amount Collected</p>
                        <p>Balance</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>{{ $order['amount'] }}</p>
                        <p>{{ $order['amount'] }}</p>
                        <p>$0.00</p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</div>
<div>
    <table class="table w-100 mt-10">

    <tr>
        <th class="w-15">Type</th>
        <th class="w-50">Particulars</th>
        <th class="w-50">Amount</th>
    </tr>
    <tr align="center">
        <td>{{ $item['product_id'] }}</td>
        <td>{{ $item['quantity'] }}</td>
        <td>{{ $item['quantity'] }}</td>
    </tr>
    </table>
</div>
</html>
