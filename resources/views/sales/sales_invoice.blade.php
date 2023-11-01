<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="Content-Type" charset="utf-8" content="text/html"> -->
    <meta charset="utf-8">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Sale Invoice</title>
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 12px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 0px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        table .allBorder{
            border: 1px solid #ddd;
            padding: 0px;
            font-size: 10px;
        }

        .heading {
            font-size: 20px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #d8d8d8;
            color: #000000;
        }

        .bg-black {
            background-color: #0c0b0b;
            color: #ffffff;
        }

        p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    {{-- Invoice  Head  --}}
    <table class="order-details">
        <thead>
            <tr class="bg-black">
                <th width="50%" colspan="2">
                    <div id="logo">
                        {{-- <img src="{{ asset('/images/250X80logo.png') }}"  alt="Logo" style="width: fit-content;"> --}}
                        {{-- <img src="/images/250X80logo.png"   alt="Logo"> --}}
                        <h2>Vintage Motors</h2>
                    </div>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Address: 357,D.I.T Road,Rampura,Dhaka-1219.</span> <br>
                    <span>Phone: +8801869-089857, +8801316-347866.</span> <br>
                </th>
            </tr>
            <tr class="text-center">
                <th width="30%" colspan="1">
                    <span>Invoice Id: {{ $sales[0]->sales_invoice_no }} </span>
                </th>
                <th width="40%" colspan="1">
                    <h3>Sales Receipt</h3>
                    {{-- <h3>Purchase Receipt</h3> --}}
                </th>
                <th width="30%" colspan="2"><span>Date: {{ date('Y-m-d h:i:s') }} </span></th>
            </tr>
            <tr class="bg-blue">
                <th width="100%" colspan="4">Customer Details</th>
            </tr>
        </thead>
    </table>

    {{-- seller Details  --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col"> Name</th>
                <th scope="col">FatherName</th>
                <th scope="col">Phone</th>
                <th scope="col">NID</th>
                <th scope="col">DOB</th>
                <th scope="col">Address</th>
                <th scope="col">Mediator</th>
                <th scope="col">Med Phone</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                {{-- <th scope="row">1</th> --}}
                <td style="width: 90px">{{ $customers[0]->customer_name }}</td>
                <td style="width: 70px">{{ $customers[0]->father_name }}</td>
                {{-- <td>{{$customers[0]->email}}</td> --}}
                <td>{{ $customers[0]->phone }}</td>
                <td>{{ $customers[0]->nid }}</td>
                <td style="width: 60px">{{ $customers[0]->dob }}</td>
                <td style="width: 90px">{{ $customers[0]->address }}</td>
                <td style="width: 80px">{{ $customers[0]->mediator_name }}</td>
                <td style="width: 90px">{{ $customers[0]->mediator_phone }}</td>
            </tr>

        </tbody>
    </table>

    {{-- Product Details  --}}
    <table class="table">
        <thead>
            <tr class="bg-blue">
                <th width="100%" colspan="12">Bike Details</th>
            </tr>
            <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">Name</th>
                <th scope="col">Regi No</th>
                <th scope="col">Chassis No</th>
                <th scope="col">Engine No</th>
                <th scope="col">Manufacturer</th>
                <th scope="col">Model</th>
                <th scope="col">CC</th>
                <th scope="col">color</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                {{-- <th scope="row">1</th> --}}
                <td style="width: 90px">{{ $products[0]->name }}</td>
                <td style="width: 70px">{{ $products[0]->reg_number }}</td>
                <td style="width: 100px">{{ $products[0]->chassis_number }}</td>
                <td style="width: 70px">{{ $products[0]->engine_number }}</td>
                <td>{{ $products[0]->manufacturer }}</td>
                <td>{{ $products[0]->model }}</td>
                <td>{{ $products[0]->cubic_capacity }}</td>
                <td>{{ $products[0]->color }}</td>
            </tr>

        </tbody>
    </table>

    {{-- Order Info --}}
    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Bill Info
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Product ID</th>
                <th>QTY</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Vat</th>
                <th>Discount</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10%"> {{ $sales[0]->product_id }} </td>
                <td width="10%"> {{ $sales[0]->sales_quantity }} </td>
                <td width="10%"> {{ $sales[0]->sale_price }} </td>
                <td width="10%"> {{ $sales[0]->sales_amount }} </td>
                <td width="10%"> {{ $sales[0]->sales_vat }} </td>
                <td width="10%"> {{ $sales[0]->sales_discount }} </td>
                <td width="10%"> {{ $sales[0]->sales_amount_paid }} </td>
                <td width="10%"> {{ $sales[0]->sales_balance_due }} </td>
                <td width="10%"> {{ $sales[0]->sales_total_amount }} </td>

            </tr>

            <tr class="allBorder">
                <td colspan="4" class="grand total">GRAND TOTAL</td>
                <td class="grand total"> = {{ $sales[0]->sales_total_amount }} TK</td>
            </tr>

            <tr class="allBorder" >
                <td colspan="4">Paid</td>
                <td class="total"> = {{ $sales[0]->sales_amount_paid }} TK</td>
            </tr>

            <tr class="allBorder">
                <td colspan="4">(-) Due</td>
                <td class="total"> = {{ isset($sales[0]->sales_balance_due) ? $sales[0]->sales_balance_due : 0 }} TK </td>
            </tr>

        </tbody>
    </table>
    <hr>
    <p>
        <strong>Note:</strong>
        From today {{ date('Y-m-d') }}, All liability for the motorcycle will be borne by the buyer. The motorcycle was
        fully operational with blue-book, tax token, sale receipt and all the documents I understood the buyer. If the
        buyer does not transfer ownership of the motorcycle within 21 days, the authority will not be responsible.
    </p>
    <strong>Comment: </strong>
    <hr>

    <table>
        <tr class="">
            <th width="30%" colspan="3">
                </br> </br> <span>Signature of witnesses:</span>
            </th>
            <th width="30%" colspan="2">  </br>  </br> Buyer's signature </th>
            <th width="30%" colspan="2"> </br>  </br> Seller's signature</th>
        </tr>
    </table>

    <br>
    <p class="text-center bg-blue" style="padding: 7px;">
        Thank you | Buy & Sell & Exchange
    </p>
</body>

</html>
