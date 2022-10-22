<!DOCTYPE html>
<html>
<head>
    <title>Enco Group Purchase Order</title>
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

<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Order Id: <span class="gray-color">{{$orderNumber}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date: <span class="gray-color">{{$order['created_at']}}</span></p>
    </div>
    <div class="w-50 float-left logo mt-10">
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">From</th>
            <th class="w-50">To</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p>{{ $supplier['name'] }}</p>
                    <p>{{ $supplier['address'] }}</p>
                    <p>Contact Person : {{$supplier['contact_person']}}</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p>ENCO BOTTLING CORPORATION</p>
                    <p>Calata Warehouse Plaridel-Pulilan Diversion Rd. </p>
                    <p>Banga 1st Plaridel,</p>
                    <p>Bulacan 3004</p>
                    <p>Contact : (02) 7217 8106</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Supplier Name</th>
            <th class="w-50">Supplier Contact Name</th>
            <th class="w-50">Shipper Name</th>
            <th class="w-50">Shipping Number</th>
            <th class="w-50">Bank Name</th>
            <th class="w-50">Bank Account</th>
            <th class="w-50">Bank Location</th>
        </tr>
        <tr>
            <td>Cash On Delivery</td>
            <td>{{ $supplier['name'] }}</td>
            <td>{{ $supplier['contact_person'] }}</td>
            <td>{{ $supplier['address'] }}</td>
            <td>{{ $supplier['bank_account_name'] }}</td>
            <td>{{ $supplier['bank_account_no'] }}</td>
            <td>{{ $supplier['bank_account_address'] }}</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">Container Number</th>
            <th class="w-50">Shipper Name</th>
            <th class="w-50">Shipping Number</th>
        </tr>
        <tr>
            <td>Cash On Delivery</td>
            <td>{{ $order['container_number'] }}</td>
            <td>{{ $order['courier_name'] }}</td>
            <td>{{ $order['courier_number'] }}</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Raw Material</th>
            <th class="w-50">Qty</th>
            <div style="clear: both;"></div>
        </tr>
        @foreach($items as $item)
            <tr align="center">
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <div style="clear: both;"></div>
            </tr>
        @endforeach
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Total Payable</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>{{ $order['subtotal'] }}</p>
                        <p>{{ $order['total'] }}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</div>
</html>
