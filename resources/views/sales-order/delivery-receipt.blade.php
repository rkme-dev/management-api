<!DOCTYPE html>
<html>
<head>
    <title style="color: blueviolet">Enco Group Delivery Receipt</title>
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
    .copy {
        font-size: 15px !important;
        font-weight: lighter;
        font-style: italic;
        margin-top: 10px;
        margin-right: 30px;
        position: absolute;
        top: 75px;
        right: 0px;
    }
    .page-break {
        page-break-after: always;
    }
</style>
<body>
@foreach($copies as $key=>$copy)
    @include('includes.header')
    <div class="mt-10 text-bold w-50" style="position:absolute; left: 600px;top: -10px;">
        {!! DNS2D::getBarcodeHTML((string) $order['qr_code'] ?? '', 'QRCODE', 3,3) !!}
    </div>
    <div class="head-title">
        <h2 class="text-center mt-1 p-0">DELIVERY RECEIPT</h2>
        <span class="mt-1 p-0 copy"> {{ ucfirst($copy->value) }} Copy </span>
    </div>

    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">Customer: <span class="gray-color">{{$order['customer']['name']}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">Address: <span class="gray-color">{{$order['address'] ?? ''}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">SO Date: <span class="gray-color">{{$order['created_at']}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">SO Status: <span class="gray-color">{{strtoupper(str_replace('_',' ', $order['status']))}}</span></p>
        </div>
        <div class="w-50 float-right mt-10">
            <p class="m-0 pt-5 text-bold w-100">Terms: <span class="gray-color">{{$order['term']['description'] ?? ''}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">DR No: <span class="gray-color">{{$order['sales_dr_number'] ?? ''}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">Plate No: <span class="gray-color">{{$order['plate_number']}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">Date: <span class="gray-color">{{$order['created_at']}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">Salesman 1: <span class="gray-color">{{$order['salesman1']['salesman_name'] ?? 'N/A'}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">Salesman 2: <span class="gray-color">{{$order['salesman2']['salesman_name'] ?? 'N/A'}}</span></p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">Item</th>
                <th class="w-15">Qty</th>
                <th class="w-15">Unit Price</th>
                <th class="w-50 border-top">Total</th>
                <div style="clear: both;"></div>
            </tr>
            @foreach($order['order_items'] as $item)
                <tr align="center">
                    <td>{{ $item['product_id'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>PHP {{ $item['total_amount'] }}</td>
                    <div style="clear: both;"></div>
                </tr>
            @endforeach
            <tr>
                <td colspan="7">
                    <div class="total-part">
                        <div class="total-left w-95 float-left text-bold" align="right" style="margin-left:195px">
                            <p>Sub Total:</p>
                        </div>
                        <div class="total-right w-25 float-right text-bold" align="right">
                            <p>PHP {{ $order['amount'] }}</p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    @if($key != 2)
    <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>
