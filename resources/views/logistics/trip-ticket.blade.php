<!DOCTYPE html>
<html>
<head>
    <title style="color: blueviolet">Enco Group Trip Ticket</title>
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
    .mt-40 {
        margin-top: 40px;
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
    .w-45 {
        width: 45%;
    }
    .w-50 {
        width: 50%;
    }
    .w-55 {
        width: 55%;
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
    .w-28 {
        width: 28%;
    }
    .w-30 {
        width: 30%;
    }
    .w-35 {
        width: 35%;
    }
    .font-8 {
        font-size: 8;
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
        top: 120px;
        right: 0px;
        color: #DC3444;
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
<div class="mt-40">
    <h2 class="text-center mt-1 p-0">TRIP TICKET</h2>
    <span class="mt-1 p-0 copy"> {{$ticket['trip_ticket_number']}} </span>
</div>

<div class="mt-10 font-10">
    <div class="nextline">
        <div class="inline w-50">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Driver:</span> <span class="gray-color"> {{$ticket['driver']}} </span></p>
        </div>
        <div class="inline w-30">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Vehicle:</span> <span class="gray-color"> {{ $ticket['truck'] }} </span></p>
        </div>
        <div class="inline">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Date:</span>  <span class="gray-color"> {{ date('M d, Y', strtotime($ticket['date_posted'])) }} </span></p>
        </div>
        
    </div>
    <div class="nextline">
        <div class="inline w-30">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Warehouse:</span> <span class="gray-color"> </span></p>
        </div>
        <div class="inline w-20">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Plate No:</span> <span class="gray-color"> {{ $ticket['plate_number'] }} </span></p>
        </div>
        <div class="inline">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Departure Date:</span> <span class="gray-color"> {{ date('M d, Y', strtotime($ticket['departed_at'])) }} </span></p>
        </div>
    </div>
    <div class="nextline">
        <div class="inline w-30">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Area:</span> <span class="gray-color">{{ $ticket['area'] }}</span></p>
        </div>
        <div class="inline w-20">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Mileage:</span> <span class="gray-color"> </span></p>
        </div>
        <div class="inline">
            <p class="m-0 pt-5 w-100 pd-10"><span class="text-bold">Departure Time:</span> <span class="gray-color"> {{ date('h:i:s A', strtotime($ticket['departed_at'])) }} </span></p>
        </div>
    </div>

    
    <div style="clear: both;"></div>
</div>

<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-30">Date.</th>
            <th class="w-30">DR No.</th>
            <th class="w-40">Customer</th>
            <th class="w-15">Total Amount</th>
            <th class="w-15">Remaining Balance</th>
            <th class="w-20">Time of Arrival</th>
            <div style="clear: both;"></div>
        </tr>
        @foreach($salesDr as $key => $item)
            <tr align="center">
                <td>{{ date('M d, Y h:i A', strtotime($item['date_posted'])) }}</td>
                <td>{{ $item['sales_dr_number'] }}</td>
                <td>{{ $item['customer']['name'] }}</td>
                <td>P {{ number_format($item['amount']) }}</td>
                <td>P {{ number_format($item['remaining_balance']) }}</td>
                <td></td>
                <div style="clear: both;"></div>
            </tr>
        @endforeach
    </table>
</div>
<div class="nextline pt-20">
    <p class="m-0 pt-5 text-bold float-left">Remarks: <span class="gray-color">{{strtoupper(str_replace('_',' ', $ticket['remarks']))}}</span></p>
</div>

<div class="text-center pt-130 font-10 pl-20 pr-20">
<div class="inline w-30 pt-130">
    <p class="font-i">
        Released By:
    </p>
    <br/>
    <span class="font-8 font-i text-center pt-50 gray-color">
        Signature Over Printed Name | Date
    </span>
</div>
<div class="inline w-30 pl-10 pt-130">
    <p class="font-i">
        Checked By:
    </p>
    <br/>
    <span class="font-8 font-i pt-50 gray-color">
        Signature Over Printed Name | Date
    </span>
</div>
<div class="inline pl-10 pt-130">
    <p class="font-i">
        Driver's Signature:
    </p>
    <br/>
    <span class="font-8 font-i pt-50 gray-color">
        Signature Over Printed Name | Date
    </span>
</div>
</div>

<div class="footer">
    <div style="padding-left: 7%">
    
    </div>
    @include('includes.footer')
    <p class="font-10 gray-color text-center m-0">
        Timestamp: {{ $ticket['date_posted'] }} {{ $ticket['timestamp'] }}
    </p>
</div>
</html>
