<!DOCTYPE html>
<html>
<head>
    <title>Enco Group Sales Order</title>
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
    <h2 class="text-center mt-1 p-0">TRIP TICKET</h2>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Trip Ticket Number: <span class="gray-color">{{$order['trip_ticket_number']}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Area: <span class="gray-color">{{$order['area']}}</span></p>
    </div>
    <div class="w-50 float-right mt-10">
        <p class="m-0 pt-5 text-bold w-100">Driver: <span class="gray-color">{{$order['driver']}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Plate Number: <span class="gray-color">{{$order['plate_number']}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Truck: <span class="gray-color">{{$order['truck'] ?? 'N/A'}}</span></p>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">DR Number</th>
            <th class="w-50">Customer</th>
            <th class="w-50">Item</th>
            <th class="w-15">Quantity</th>
            <th class="w-15">Unit</th>
            <div style="clear: both;"></div>
        </tr>
        @foreach($order['sales_dr_items'] as $key => $item)
            <tr align="center">
                <td>{{ $item['sales_dr']['sales_dr_number'] }}</td>
                <td>{{ $item['sales_dr']['customer']['name'] }}</td>
                <td>{{ $item['dr_order_item']['product']['name'] }}</td>
                <td>{{ $item['dr_order_item']['actual_quantity'] }}</td>
                <td>{{ $item['dr_order_item']['unit'] }}</td>
                <div style="clear: both;"></div>
            </tr>
        @endforeach
    </table>
</div>
</html>
