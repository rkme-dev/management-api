<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Barcode</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    /* Layout: */

    .col-flex {
        flex: 1;
    }

    /* etc */

    body {
        margin: 1.5em;
    }

    .container {
        max-width: 60em;
        margin-right: auto;
        margin-left: auto;
    }

    .col {
        padding: 1em;
        margin: 0 2px 2px 0;
    }


</style>
<body>
<div class="container">
    <div class="row">
        @for ($i = 1; $i <= $count; $i++)
            <div class="col col-flex">
                <img
                     src="data:image/png;base64,{{DNS1D::getBarcodePNG(\sprintf('%s-%s', $barcode, $i), 'C39E+',3,33,array(0,0,0), true)}}"
                     alt="barcode"/>
            </div>
        @endfor
    </div>
</div>
</body>
</html>
