<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
        @media print {
            @page {
                /* size: 80mm;  */
                margin: 0;
            }

            body {
                /* padding: 5mm; */
                size: 80mm;
                ;
                font-size: small !important;
            }

            #dateId,
            #titleId {
                display: none !important;
            }

            .page-break {
                page-break-after: always;
            }
        }

        p {
            margin: 0;
            font-size: smaller;
        }

        .h5,
        h5 {
            font-size: unset;
        }

        .fontsize {
            font-size: x-small;
        }

        .row>* {
            padding-right: 0px;
            padding-left: 0px;
        }
    </style>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</head>

<body onload="printDiv('printableArea')">
    <div class="" id="printableArea" style="padding: 5mm; width: 100mm;">
        @php
            $final_price = [];
            $i = 0;
        @endphp
        @foreach ($Allproducts as $key => $products)
            @if ($i != 0)
                <div class="page-break"></div>
            @endif
            @php
                $i++;
            @endphp
            <table style="background-color: #d9d9d9;">
                @php
                    $b_total_amount = [];
                @endphp
                @foreach ($Gstproducts as $gstkey => $Gstproduct)
                    @foreach ($Gstproduct as $item)
                        @php
                            $b_total_amount[] += $item->total_amount;
                        @endphp
                    @endforeach
                @endforeach
                <div class="card" style="background-color: #d9d9d9;margin-top: 20px">
                    <div class="card-body">
                        <div class="row" style="border-bottom: 2px solid #6c6c6c;text-align: center">
                            <div id="logo" style="text-align: center">
                                <img src="{{ asset('invoice/Group 8398.png') }}" width="200px">
                            </div>
                            <!--<div class="col-12">-->
                            <!--    <h4>Kahnaiya Dairy</h4>-->
                            <!--</div>-->
                        </div>
                        <div class="row" style="text-align: center">
                            <h1>&#8377;{{ array_sum($b_total_amount) }}</h1>
                        </div>
                    </div>
                </div>

            </table>
        @endforeach

        <div class="page-break"></div>
    </div>
    {{-- <script>
        function printDiv() {
            var printContents = document.getElementById("printableArea").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        printDiv();
    </script> --}}
</body>

</html>
