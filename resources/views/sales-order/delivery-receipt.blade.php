<!DOCTYPE html>
<html>
<head>
    <title style="color: blueviolet">Enco Group Delivery Receipt</title>
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
@foreach($copies as $key=>$copy)
    @include('includes.header')
    <div class="mt-10 text-bold w-50" style="position:absolute; left: 600px;top: -10px;">
        {!! DNS2D::getBarcodeHTML((string) $order['qr_code'] ?? '', 'QRCODE', 3,3) !!}
    </div>
    <div class="head-title mt-50">
        <h2 class="text-center mt-1 p-0">DELIVERY RECEIPT</h2>
        <span class="mt-1 p-0 copy"> {{ ucfirst($copy->value) }} Copy </span>
    </div>

    <div class="mt-10 font-10">
        <div class="nextline">
            <div class="inline w-40">
                <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Customer:</span> <span class="gray-color">{{$order['customer']['name']}}</span></p>
            </div>
            <div class="inline w-20">
                <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Date:</span> <span class="gray-color">{{date("M d, Y", strtotime($order['date_posted']))}}</span></p>
            </div>
            <div class="inline w-30">
                <p class="m-0 pt-5 w-100 pd-10 text-right"><span class="text-bold">DR No:</span> <span class="gray-color">{{$order['sales_dr_number'] ?? ''}}</span></p>
            </div>
        </div>
        <div class="nextline">
            <div class="inline w-40">
                <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Address:</span> <span class="gray-color">{{$order['address'] ?? ''}}</span></p>
            </div>
            <div class="inline">
                <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Plate No:</span> <span class="gray-color">{{$order['plate_number']}}</span></p>
            </div>
        </div>
        <div class="nextline">
            <div class="inline w-60">
                <p class="m-0 pd-10"><span class="text-bold">Terms:</span> <span class="gray-color"> {{ $order['term']['code'] }}</span></p>
            </div>
            <div class="inline w-30">
                <p class="m-0 pt-5 w-100 pd-10 text-right pl-7"><span class="text-bold">Sales Agent:</span> <span class="gray-color">{{$order['salesman1']['salesman_name'] ?? 'N/A'}}</span></p>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-30">SO No.</th>
                <th class="w-30">Particulars</th>
                <th class="w-15">Qty</th>
                <th class="w-15">Unit Price</th>
                <th class="w-20 border-top">Total</th>
                <div style="clear: both;"></div>
            </tr>
            @foreach($order['legit_order_items'] as $item)
                <tr align="center">
                    <td>{{ $item['sales_order_number'] }}</td>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>PHP {{ $item['total_amount'] }}</td>
                    <div style="clear: both;"></div>
                </tr>
            @endforeach
        </table>

        <div>
            <p class="total-part float-right text-bold">Total: PHP {{ $order['amount'] }}</p>
        </div>
    </div>
    <div class="nextline pt-50">
        <p class="m-0 pt-5 text-bold float-left">Remarks: <span class="gray-color">{{strtoupper(str_replace('_',' ', $order['remarks']))}}</span></p>
    </div>
    <p class="font-i text-bold text-center pt-130 font-9 pl-40 pr-40">
        The undersigned herein states that he/she has inspected the goods upon deliver and hereby acknowledges Receipt of items listed in this deliver receipt found to be in good order.
    </p>
    <div class="inline w-20 pt-130">
        <p class="font-i font-9">
            Accounting Prepared:
        </p>
    </div>
    <div class="inline w-15 pt-130">
        <p class="font-i font-9">
            Sales Checked:
        </p>
    </div>
    <div class="inline w-20 pt-130">
        <p class="font-i font-9">
            Warehouse Verified:
        </p>
    </div>
    <div class="inline w-20 pt-130">
        <p class="font-i font-9">
            Logistics Released:
        </p>
    </div>
    <div class="inline w-15 pt-130">
        <p class="font-i font-9">
            Received By:
        </p>
    </div>
    <div class="footer">
        @include('includes.footer')
    </div>
    @if($key != 2)
    <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>
