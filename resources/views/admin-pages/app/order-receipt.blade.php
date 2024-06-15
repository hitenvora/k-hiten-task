<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('html2pdf.bundle.min.js') }}"></script>
    <style>
        @media print {

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
                        </div>
                        <div class="row" style="text-align: center">
                            <h1>&#8377;{{ array_sum($b_total_amount) }}</h1>
                        </div>
                    </div>
                </div>

                <div class="page-break"></div>
                <div class="card" style="background-color: #d9d9d9;margin-top: 20px;" id="">
                    <div class="card-body">
                        <div class="row" style="border-bottom: 2px solid #6c6c6c;text-align: center">
                            <div id="logo" style="text-align: center">
                                <img src="{{ asset('invoice/Group 8398.png') }}" width="200px">
                            </div>
                            <!--<div class="col-12">-->
                            <!--    <h5>Kahnaiya Dairy</h5>-->
                            <!--</div>-->
                        </div>
                        <div class="row" style="border-bottom: 2px solid #6c6c6c;text-align: center">
                            <div class="col-12">
                                <p>GSTIN :- 24DΧΟΡK2946B1ZI</p>
                                <p>FSSAI NO. :- 10721031000133</p>
                            </div>
                        </div>
                        <div class="row" style="border-bottom: 2px solid #6c6c6c;text-align: center">
                            <div class="col-12">
                                <p>G/16,Laksh Plaza Chhaprabhatha Rd, Amroli</p>
                                <p>Surat-394107</p>
                                <h5>Phone : +91 99786 46421</h5>
                            </div>
                        </div>
                        @php
                            $jj = 0;
                        @endphp
                        @foreach ($Gstproducts as $gstkey => $Gstproduct)
                            @if ($jj == 0)
                                @php
                                    $BILL_OF_SUPPLY = isset($Gstproducts[0]);
                                    $TAX_INVOICE = $gstkey != '0';
                                    $jj++;
                                @endphp
                            @endif
                        @endforeach
                        <div class="row" style="text-align: center;">
                            <div class="col-12">
                                @if ($TAX_INVOICE && $BILL_OF_SUPPLY)
                                    <h5>TAX INVOICE CUM BILL OF SUPPLY</h5>
                                @else
                                    @if ($TAX_INVOICE)
                                        <h5>TAX INVOICE</h5>
                                    @endif
                                    @if ($BILL_OF_SUPPLY)
                                        <h5>BILL OF SUPPLY</h5>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h5>Bill No :- {{ $order->id }}</h5>
                            </div>
                            <div class="col-8" style="text-align: end;">
                                <h5>Date :- {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y h:i a') }}</h5>
                            </div>
                        </div>
                        <div class="row" style="text-align: center; border-top: 2px solid #6c6c6c;">
                            <div class="col-12">
                                <h5>Products</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 " style="font-size: 15px;
               font-weight: bolder; ">
                                Particulars
                            </div>
                            <div class="col-2 " style="text-align: center;font-size: 13px;font-weight: bolder;">Qty.
                            </div>
                            <div class="col-2 " style="text-align: center; font-size: 11px;   font-weight: bolder;">Rate
                            </div>
                        </div>
                        @php
                            $a_total_price = [];
                            $a_total_qty = [];
                            $a_total_taxes = [];
                            $a_total_amount = [];
                            $a_gst = [];
                            $a_cess = [];
                            $a_final_price = [];
                            $a_mrp_amount = [];
                        @endphp
                        @php
                            $j = 0;
                            $G = 1;
                        @endphp
                        @foreach ($Gstproducts as $gstkey => $Gstproduct)
                            @if ($j == 0)
                                @php
                                    $BILL_OF_SUPPLY = isset($Gstproducts[0]);
                                    $TAX_INVOICE = $gstkey != 0;
                                @endphp
                            @endif
                            <div class="row">
                                @if ($gstkey == null &&  empty($gstkey) && $gstkey == '' )
                            @php
                               $gstkey = 0;
                            @endphp
                            <div class="col-8 fontsize" style="padding: 0;"><b>{{ $G }} ) CGST @
                                {{ intval($gstkey) / 2 }} %, SGST @ {{ intval($gstkey) / 2 }} %,</b></div>   
                        </div>
                         @else
                            <div class="col-8 fontsize" style="padding: 0;"><b>{{ $G }} ) CGST @
                                {{ intval($gstkey) / 2 }} %, SGST @ {{ intval($gstkey) / 2 }} %,</b></div>   
                    </div>
                    @endif
                            @foreach ($Gstproduct as $item)
                                <div class="row">
                                    <div class="col-8 fontsize" style="padding: 0;">
                                        <b>{{ $item->Product->hsn_cod }}</b>
                                        {{ \Illuminate\Support\Str::limit($item->Product->product_name, 20) }} <b>(
                                            ₹{{ $item->Product->per_kg_price }} )</b>
                                    </div>
                                    <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                        @if ($item->product_weight == null)
                                            {{ $item->product_quntity ?? '1' }}
                                        @else
                                            {{ $item->product_weight ?? '1' }}
                                        @endif
                                    </div>
                                    <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                        ₹{{ $item->total_amount }}</div>
                                </div>
                                @php
                                    $a_taxesList = json_decode($item->gst);
                                    $a_cess[] += $taxesList->CESS ?? 0;
                                    $a_gst[] += $taxesList->GST ?? 0;

                                    $a_final_price[] += $item->total_amount;
                                    $a_total_amount[] += $item->total_amount;
                                    if ($item->Product->lush == '1') {
                                        $gram_value = explode(' ', $item->product_weight);
                                        if (isset($gram_value[1]) && $gram_value[1] == 'grams') {
                                            $kg_convert = $item->Product->mrp / 1000;
                                            $kg_convert = $kg_convert * $gram_value[0];
                                            $a_mrp_amount[] += $kg_convert;
                                        } else {
                                            $a_mrp_amount[] += $item->Product->mrp * $gram_value[0];
                                        }
                                    } else {
                                        $a_mrp_amount[] += $item->Product->mrp * $item->product_quntity;
                                    }
                                    $a_total_taxes[] += $item->taxes ?? 1;
                                    $a_total_qty[] += $item->product_quntity ?? 1;
                                    $a_total_price[] += $item->sub_total;
                                @endphp

                                @php
                                    $j++;
                                @endphp
                            @endforeach
                            @php
                                $G++;
                            @endphp
                        @endforeach
                        <div class="row" style="border-top: 2px solid #6c6c6c;">
                            <div class="col-8">
                                <h5>ITEM: {{ $j }}</h5>
                            </div>
                            <div class="col-2" style="text-align: center">
                                <h5>Qty: {{ array_sum($a_total_qty) }}</h5>
                            </div>
                            <div class="col-2" style="text-align: center">
                                <h5>&#8377;{{ array_sum($a_total_amount) }}</h5>
                            </div>
                        </div>

                        <div class="row" style=" border-top: 2px solid #6c6c6c;">
                            <div class="col-2 fontsize" style="text-align: center;">Gst IND</div>
                            <div class="col-2 fontsize" style="text-align: center;">Goods Value</div>
                            <div class="col-2 fontsize" style="text-align: center;">CGST</div>
                            <div class="col-2 fontsize" style="text-align: center;">SGST</div>
                            <div class="col-2 fontsize" style="text-align: center;">CESS</div>
                            <div class="col-2 fontsize" style="text-align: center;">Total Amount</div>
                        </div>
                        @php
                            $GG = 1;
                            $b_gst = [];
                            $b_cess = [];
                        @endphp
                        @foreach ($Gstproducts as $gstkey => $Gstproduct)
                            @php
                                $total_price = [];
                                $total_qty = [];
                                $total_taxes = [];
                                $total_amount = [];
                                $gst = [];
                                $cess = [];
                                $final_price = [];
                            @endphp
                            @foreach ($Gstproduct as $item)
                                @php
                                    $taxesList = json_decode($item->gst);
                                    $cess[] += $taxesList->CESS ?? 0;
                                    $gst[] += $taxesList->GST ?? 0;

                                    $b_cess[] += $taxesList->CESS ?? 0;
                                    $b_gst[] += $taxesList->GST ?? 0;

                                    $final_price[] += $item->total_amount;
                                    $total_amount[] += $item->total_amount;
                                    $total_taxes[] += $item->taxes ?? 1;
                                    $total_qty[] += $item->product_quntity ?? 1;
                                    $total_price[] = $item->sub_total;
                                @endphp
                            @endforeach
                            <div class="row">
                                @php
                                @endphp
                                <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                    <b>{{ $GG }}</b>
                                </div>
                                <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                    ₹{{ array_sum($total_price) }}</div>
                                <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                    ₹{{ array_sum($gst) / 2 }}</div>
                                <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                    ₹{{ array_sum($gst) / 2 }}</div>
                                <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                    ₹{{ array_sum($cess) }}</div>

                                <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                    ₹{{ array_sum($final_price) }}</div>
                            </div>
                            @php
                                $GG++;
                            @endphp
                        @endforeach
                        <div class="row" style="border-top: 2px solid #6c6c6c;">
                            <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                <b>{{ $GG }}</b>
                            </div>
                            <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                ₹{{ array_sum($a_total_price) }}</div>
                            <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                ₹{{ array_sum($b_gst) / 2 }}</div>
                            <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                ₹{{ array_sum($b_gst) / 2 }}</div>
                            <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                ₹{{ array_sum($b_cess) }}</div>

                            <div class="col-2 fontsize" style="text-align: center; padding: 0;">
                                ₹{{ array_sum($a_final_price) }}</div>
                        </div>
                        @if (array_sum($a_final_price) - array_sum($a_mrp_amount) != 0)
                            <div class="row">
                                <div class="col-12 mt-2" style="text-align: center; padding: 0;">
                                    Saved Rs. {{ array_sum($a_final_price) - array_sum($a_mrp_amount) }} /- On MRP
                                </div>
                            </div>
                            @endif
                            <div class="row ">
                                <div class="col-12 mt-2 fontsize" style="text-align: center; padding: 0;">This is
                                    computer
                                    generated invoice does not require&nbsp;signature.
                                </div>
                            </div>
                    </div>
                </div>
            </table>
        @endforeach
    </div>
</body>

</html>
