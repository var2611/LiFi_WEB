<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
@php
    use App\Models\FormModels\DataSalarySlip;
        use App\Models\SalaryDetail;


            /* @var $data_salary_slips DataSalarySlip[] */
            /* @var $data_salary_slip DataSalarySlip */
            /* @var $earning_data SalaryDetail*/
            /* @var $deduction_data SalaryDetail*/
            /* @var $row_count int*/
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LiFi - {{ $title ?? config('app.name', 'Laravel') }}</title>
    {{--    <style type="text/css">--}}
    {{--        @font-face {--}}
    {{--            font-family: 'Hind';--}}
    {{--            src: url({{ asset('vendor/webkul/ui/assets/fonts/Hind/Hind-Regular.ttf') }}) format('truetype');--}}
    {{--        }--}}
    {{--        @font-face {--}}
    {{--            font-family: 'Noto Sans';--}}
    {{--            src: url({{ asset('vendor/webkul/ui/assets/fonts/Noto/NotoSans-Regular.ttf') }}) format('truetype');--}}
    {{--        }--}}
    {{--    </style>--}}

{{--    @php--}}
{{--        /* main font will be set on locale based */--}}
{{--        $mainFontFamily = app()->getLocale() === 'ar' ? 'DejaVu Sans' : 'Noto Sans';--}}
{{--    @endphp--}}

    {{-- main css --}}
    <style type="text/css">
        .page-break {
            page-break-after: always;
        }

        * {
            {{--font-family: '{{ $mainFontFamily }}';--}}
            font-family: "DejaVu Sans", sans-serif;
        }

        body, th, td, h5 {
            font-size: 12px;
            color: #000;
        }

        .container {
            padding: 20px;
            display: block;
        }

        .invoice-summary {
            margin-bottom: 20px;
        }

        .table {
            margin-top: 20px;
        }

        .table table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            table-layout: fixed;
        }

        .table thead th {
            font-weight: 700;
            border-top: solid 1px #d3d3d3;
            border-bottom: solid 1px #d3d3d3;
            border-left: solid 1px #d3d3d3;
            padding: 5px 10px;
            background: #000000;
        }

        .table thead th:last-child {
            border-right: solid 1px #d3d3d3;
        }

        .font-color {
            color: white;
        }

        .table tbody td {
            padding: 5px 10px;
            border-bottom: solid 1px #d3d3d3;
            border-left: solid 1px #d3d3d3;
            color: #3A3A3A;
            vertical-align: middle;
        }

        .table tbody td p {
            margin: 0;
        }

        .table tbody td:last-child {
            border-right: solid 1px #d3d3d3;
        }

        .sale-summary {
            margin-top: 10px;
            float: right;
        }

        .border-th {
            border: solid 1px #d3d3d3;
        }

        .justify-content-end {
            float: right;
        }

        .sale-summary tr td {
            padding: 3px 5px;
        }

        .sale-summary tr.bold {
            font-weight: 600;
        }

        .label {
            color: #000;
            font-weight: bold;
        }

        .logo {
            height: 70px;
            width: 70px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .merchant-details-title {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body style="background-image: none; background-color: #fff;">
@foreach($data_salary_slips as $data_salary_slip)

    @php

        $earning_data = $data_salary_slip->getEarningData();
        $deduction_data = $data_salary_slip->getDeductionData();

        $row_count = count($earning_data) >= count($deduction_data) ? count($earning_data) : count($deduction_data);
    @endphp
    <div class="container">
        <div class="header">
            <div class="row">
                <div class="col-12" style="text-align: center">
                    <h1 class="text-center" style="margin: 0">Payslip</h1>
                    <span
                        class="text-center">Payment slip for the month of {{ $data_salary_slip->salary_month . ' ' . $data_salary_slip->salary_year }}</span>
                </div>
            </div>

            <div class="invoice-summary">
                <span class="merchant-details-title" style="float: right">Working Branch : Paarth</span>
            </div>

            <div class="invoice-summary">

                <table style="width: 50%">
                    <thead>
                    <tr>
                        <td style="width: 50%"><b>EMP Code: </b>{{ $data_salary_slip->emp_code }}</td>
                        <td style="width: 50%"><b>EMP Name: </b>{{ $data_salary_slip->name }}</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 50%"><b>PF No.: </b>{{ $data_salary_slip->pf_number ?? ucfirst('nil') }}</td>
                        <td style="width: 50%"><b>Mode of Pay: </b>{{ ucfirst('nil') }}</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 50%"><b>Designation: </b>{{ ucfirst($data_salary_slip->departmentType) }}
                            ({{ $data_salary_slip->description}})
                        </td>
                        <td style="width: 50%"><b>UAN.: </b>{{ $data_salary_slip->uan ?? ucfirst('nil') }}</td>
                    </tr>
                    </thead>
                </table>
            </div>

            <div class="table attendance">
                <table>
                    <thead>
                    <tr>
                        <th class="font-color" style="width: 50%">Working Day</th>
                        <th class="font-color" style="width: 50%">Absent Day</th>
                        <th class="font-color" style="width: 50%">Present Day</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 50%">{{ $data_salary_slip->total_days }}</td>
                        <td style="width: 50%">{{ $data_salary_slip->present_days }}</td>
                        <td style="width: 50%">{{ $data_salary_slip->absent_days }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="table address">
                <table>
                    <thead>
                    <tr>
                        <th class="font-color" style="width: 50%">Earnings</th>
                        <th class="font-color" style="width: 50%">Amount</th>
                        <th class="font-color" style="width: 50%">Deductions</th>
                        <th class="font-color" style="width: 50%">Amount</th>

                    </tr>
                    </thead>

                    <tbody>
                    @for($i = 0; $i < $row_count; $i++)
                        <tr>
                            <td style="width: 50%">{{ $earning_data[$i]->name ?? '' }}</td>
                            <td style="width: 50%">{{ getFormattedAmountCurrency($earning_data[$i]->amount ?? 0.00) }}</td>
                            <td style="width: 50%">{{ $deduction_data[$i]->name ?? '' }}</td>
                            <td style="width: 50%">{{ getFormattedAmountCurrency($deduction_data[$i]->amount ?? 0.00) }}</td>
                        </tr>
                    @endfor
                    </tbody>
                    <tbody>
                    <tr>
                        <td style="width: 50%">Total Earning</td>
                        <td style="width: 50%">{{ $data_salary_slip->salary_total }}</td>
                        <td style="width: 50%">Total Deductions</td>
                        <td style="width: 50%">{{ $data_salary_slip->salary_gross_deduction }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <table class="mt-10" style="width: 100%">
                <thead>
                <tr>
                    <td class="label" style="width: 50%">Net Pay: {{ ($data_salary_slip->salary_net_pay) }}</td>
                    <td class="border-th" style="width: 50%">In Words<br/>
                        {{ strtoupper($data_salary_slip->salary_net_pay_in_words) }}
                    </td>
                </tr>
                </thead>

            </table>
            <div class="sale-summary mt-10">
                <span style="font-weight: bolder">For Paarth Clothing Pvt. Ltd</span>
                <div style="margin-top: 20px">
                    <span>Authorised Signatory</span>
                </div>
            </div>


        </div>
    </div>
    <div class="page-break"></div>
@endforeach
</body>
</html>
