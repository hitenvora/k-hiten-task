{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice V1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    /*
Theme Name: Invoice V1
Theme URI: https://templatesjungle.com/
Author: TemplatesJungle
Author URI: https://templatesjungle.com/
Description: Invoice V1 is specially designed product packaged for Invoice.
Version: 1.1
*/

    /*--------------------------------------------------------------
Styles
--------------------------------------------------------------*/

    /* Fonts */
    :root {
        --body-font: 'Poppins', sans-serif;
    }

    /* Bootstrap Override */
    body {
        --bs-font-sans-serif: 'Poppins', sans-serif;
        --bs-body-font-family: var(--bs-font-sans-serif);
        --bs-body-font-size: 1rem;
        --bs-body-font-weight: 400;
        --bs-body-line-height: 2;
        --bs-body-color: #41403E;
        --bs-primary: #0070E4;
        --bs-primary-rgb: 0, 112, 228;
        --bs-border-color: #eeeeee;
    }
</style>

<body >

    <section id="invoice">
        <div class="container my-5 py-5">
            <div class="text-center">
                <img src="images/logo_dark.png" alt="">
            </div>
            <div class="text-center border-top border-bottom my-5 py-3">
                <h2 class="display-5 fw-bold">Invoice </h2>
                <p class="m-0">Invoice No: {{$invoice->id ?? ''}}</p>
                <p class="m-0">Invoice Date: {{ \Carbon\Carbon::parse($invoice->created_at)->format('d F Y') }}</p>
            </div>

            <div class="d-md-flex justify-content-between">
                <div>
                    <p class="text-primary">Invoice To</p>
                    <h4>Roger Y. Will</h4>
                    <ul class="list-unstyled">
                        <li>XYZ Company</li>
                        <li>info@xyzcompany.com</li>
                        <li>123 Main Street</li>
                    </ul>
                </div>
                <div class="mt-5 mt-md-0">
                    <p class="text-primary">Invoice From</p>
                    <h4>William Peter</h4>
                    <ul class="list-unstyled">
                        <li>ABC Company</li>
                        <li>info@abccompany.com</li>
                        <li>456 Main Street</li>
                    </ul>
                </div>
            </div>

            <table class="table border my-5">
                <thead>
                    <tr class="bg-primary-subtle">
                        {{-- <th scope="col">No.</th> --}}
{{-- <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Taxes</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($invoice->GetAdminCart->count() != 0)
                    @foreach ($invoice->GetAdminCart as $item)
                    <tr>
                     
                        <td>{{$item->Product->product_name ?? ''}} &#8377;</td>
                        <td>{{$item->product_price ?? ''}} &#8377;</td>
                        <td>{{$item->taxes ?? ''}} &#8377;</td>
                        <td>{{$item->product_quntity ?? ''}} &#8377;</td>
                        <td>{{$item->sub_total ?? ''}} &#8377;</td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td class="">Sub-Total</td>
                        <td>{{$invoice->sub_total}} &#8377;</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td class="">Discount</td>
                        <td class="">{{$invoice->discount}} &#8377;</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td class="">TAX</td>
                        <td>{{$invoice->total_text}} &#8377;</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td class="text-primary fw-bold">Grand-Total</td>
                        <td class="text-primary fw-bold">{{$invoice->total}} &#8377;</td>
                    </tr>
                </tbody>
            </table> --}}

{{-- <div class="d-md-flex justify-content-between my-5">
                <div>
                    <h5 class="fw-bold my-4">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="mdi:location"
                                style="vertical-align:text-bottom"></iconify-icon> 30 E Lake St, Chicago, USA</li>
                        <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="solar:phone-bold"
                                style="vertical-align:text-bottom"></iconify-icon> (510) 710-3464</li>
                        <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="ic:baseline-email"
                                style="vertical-align:text-bottom"></iconify-icon> info@worldcourse.com</li>
                    </ul>
                </div>
                <div>
                    <h5 class="fw-bold my-4">Payment Info</h5>
                    <ul class="list-unstyled">
                        <li><span class="fw-semibold">Account No: </span> 102 3345 56938</li>
                        <li><span class="fw-semibold">Account Name: </span> William Peter</li>
                        <li><span class="fw-semibold">Branch Name: </span> XYZ </li>

                    </ul>
                </div>


            </div> --}}

{{-- </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

</body>

</html>  --}}









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .head {
        position: relative;
        max-width: 100%;
    }

    .logo {
        position: absolute;
        left: 20px;
        top: 20px;
    }

    .invoice h1 {
        color: #DDA927;
        margin-top: 50px;
        font-size: 64px;
        font-weight: 600;

    }

    .invoice .nub {
        display: flex;
        gap: 10px;
    }

    .customer {
        margin-top: 50px;
    }

    .customer h4 {
        color: #DDA927;
    }

    .customer h2 {
        color: #5D0C05;
        font-weight: 700;
    }

    .table {
        margin-top: 50px;
        --bs-table-border-color: black;
    }

    .table thead th {
        font-size: 22px;
        text-align: center;

    }

    .table tbody td {
        text-align: center;
    }

    .table .amt {
        display: flex;
        justify-content: space-around;
    }

    .table .total {
        font-weight: bold;
    }

    .payment {
        margin-top: 50px;
        margin-bottom: 200px;
    }

    .payment h2 {
        color: #5D0C05;
    }



    @media screen and (max-width: 991px) and (min-width: 768px) {
        .invoice .col-lg-6 {
            width: 50%;
        }

        .invoice h1 {
            margin-top: 0px;
        }

        .customer .col-lg-6 {
            width: 50%;
        }
    }

    @media screen and (max-width: 767px) and (min-width: 425px) {
        .invoice .col-lg-6 {
            width: 50%;
        }

        .invoice h1 {
            margin-top: 0px;
            font-size: 40px;
        }

        .invoice h5 {
            font-size: 16px;
        }

        .customer .col-lg-6 {
            width: 50%;
        }
    }
</style>

<body>
    <div class="invoice">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img class="head" src="{{ asset('invoice/logo2.png') }}" alt="">

                    <!-- <img class="logo" src="./image/Untitled-1 5.png" alt=""> -->
                </div>
                <div class="col-lg-6">
                    <h1>INVOICE</h1>
                    <div class="nub">
                        <h5>Invoice Number: </h5>
                        <h5>{{ $invoice->id ?? '' }}</h5>
                    </div>
                    <div class="nub">
                        <h5>Invoice Date: </h5>
                        <h5>{{ \Carbon\Carbon::parse($invoice->created_at)->format('d F Y') }}</h5>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="customer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                    <h4>Invoice To:</h4>
                    @if ($orders->isNotEmpty())
                        @php
                            $firstOrder = $orders->first(); // Get the first order to access customer details
                        @endphp
                        <h2>{{ $firstOrder->Customer->first_name }} {{ $firstOrder->Customer->last_name }}</h2>
                        <h5>Add: {{ $firstOrder->Customer->address }}</h5>
                        <h5>Phone: +91{{ $firstOrder->Customer->contact_number }}</h5>
                        <h5>Email: {{ $firstOrder->Customer->email }}</h5>
                    @endif
                </div>
                <div class="col-lg-6">
                    <h4>Invoice From:</h4>
                    <h2>Kanaiya Dairy</h2>
                    <h5>Managing Director, Kanaiya Dairy & Sweets</h5>
                    <h5>Add: G/16,Laksh Plaza, Chhaprabhatha Rd Amroli Char Rasta,Amroli Surat-394107</h5>
                    <h5>Phone: +91 99786 46421</h5>
                    <h5>Email: kanaiya123@gmail.com </h5>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div style="overflow-x:auto;">
            <table class="table table-bordered">
                <thead>

                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Product Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty.</th>
                        <th scope="col">Total</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($invoice->GetAdminCart->count() != 0)
                        @foreach ($invoice->GetAdminCart as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                {{-- <td>Milk (500ml, 100pkts)</td>
                                <td>&#x20b9; 40</td>
                                <td>100</td>
                                <td>&#x20b9; 4000</td> --}}

                                <td>{{ $item->Product->product_name ?? '' }} </td>
                                <td>{{ $item->product_price ?? '' }} &#8377;</td>
                                <td>{{ $item->product_quntity ?? '' }} </td>
                                <td>{{ $item->sub_total ?? '' }} &#8377;</td>
                            </tr>
                        @endforeach
                    @endif
                    {{-- <tr>
                        <td scope="row">02</td>
                        <td>Butter (250g, 10pkts)</td>
                        <td>&#x20b9; 120</td>
                        <td>10</td>
                        <td>&#x20b9; 1200</td>
                    </tr>
                    <tr>
                        <td scope="row">03</td>
                        <td>Cheese (500g, 20pkts)</td>
                        <td>&#x20b9; 250</td>
                        <td>20</td>
                        <td>&#x20b9; 5000</td>
                    </tr>
                    <tr>
                        <td scope="row">04</td>
                        <td>Ghee (1kg, 50pkts)</td>
                        <td>&#x20b9; 500</td>
                        <td>50</td>
                        <td>&#x20b9; 25000</td>
                    </tr>
                    <tr>
                        <td scope="row">05</td>
                        <td>Milkcake (1kg, 80 boxes)</td>
                        <td>&#x20b9; 500</td>
                        <td>80</td>
                        <td>&#x20b9; 24000</td>
                    </tr> --}}

                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <td>CGST</td>
                            <td>SGST</td>
                            <td>Cess</td>
                        </tr>
                        @foreach ($orders as $item)
                            @php
                                $gstData = json_decode($item->Product->gst, true);
                            @endphp
                            <tr>
                                <td>
                                    <div class="amt">
                                        <div>
                                            @foreach ($gstData as $data)
                                                @if (isset($data['GST']))
                                                    {{ $data['GST'] ?? '0' }}%
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>
                                </td>


                                <td>
                                    <div class="amt">
                                        <div>
                                            @foreach ($gstData as $data)
                                                @if (isset($data['SESS']))
                                                    {{ $data['SESS'] ?? '0' }}%
                                                @endif
                                            @endforeach


                                        </div>
                                        {{-- <div>Amt</div> --}}
                                    </div>
                                </td>
                                <td>
                                    <div class="amt">
                                        <div>
                                            @foreach ($gstData as $data)
                                                @if (isset($data['CESS']))
                                                    {{ $data['CESS'] ?? '0' }}%
                                                @endif
                                            @endforeach
                                        </div>
                                        {{-- <div>Amt</div> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <table class="table table-bordered">
                    @php
                        $total_price = [];
                        $total_qty = [];
                        $total_taxes = [];
                        $total_amount = [];
                        $total_discount = [];
                        $gst = [];
                        $cess = [];
                    @endphp

                    <tbody>
                        @foreach ($orders as $item)
                            @php
                                $total_price[] += $item->sub_total;
                                $total_discount[] += $item->discount;
                                $total_taxes[] += $item->taxes;
                                $total_amount[] += $item->total_amount;
                            @endphp
                        @endforeach
                        <tr>
                            <td>Subtotal</td>
                            <td>&#x20b9;{{ array_sum($total_price) ?? '0' }} </td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>{{ array_sum($total_discount) ?? '0' }}</td>
                        </tr>
                        <tr>
                            <td>Tax </td>
                            <td>&#x20b9; {{ array_sum($total_taxes) ?? '0' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="total">&#x20b9;
                                {{ array_sum($total_price) - array_sum($total_discount) + array_sum($total_taxes) ?? '0' }}
                            </td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="payment">
        <div class="container">
            <h2>Payment Info:</h2>
            <h4>Scan code to pay online</h4>
            <img src="{{ asset('invoice/QR.png') }}" alt="">
        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
