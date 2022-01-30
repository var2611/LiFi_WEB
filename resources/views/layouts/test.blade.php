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
<html>
<head>
    {{-- meta tags --}}
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>LiFi - {{ $title ?? config('app.name', 'Laravel') }}</title>

    {{-- lang supports inclusion --}}
    <style type="text/css">
        {{--@font-face {--}}
        {{--    font-family: 'Hind';--}}
        {{--    src: url({{ asset('vendor/webkul/ui/assets/fonts/Hind/Hind-Regular.ttf') }}) format('truetype');--}}
        {{--}--}}
        {{--@font-face {--}}
        {{--    font-family: 'Noto Sans';--}}
        {{--    src: url({{ asset('vendor/webkul/ui/assets/fonts/Noto/NotoSans-Regular.ttf') }}) format('truetype');--}}
        {{--}--}}
    </style>

    @php
        /* main font will be set on locale based */
        $mainFontFamily = app()->getLocale() === 'ar' ? 'DejaVu Sans' : 'Noto Sans';
    @endphp

    {{-- main css --}}
    <style type="text/css">
        .page-break {
            page-break-after: always;
        }

        * {
            font-family: '{{ $mainFontFamily }}';
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
            background: #F4F4F4;
        }

        .table thead th:last-child {
            border-right: solid 1px #d3d3d3;
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
            margin-top: 40px;
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

        .merchant-details {
            margin-bottom: 5px;
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
                <div class="col-12">
                    <h1 class="text-center">Payslip</h1>
                </div>
            </div>

            {{--        @if (core()->getConfigData('sales.invoice_setttings.invoice_slip_design.logo'))--}}
            {{--            <div class="image">--}}
            {{--                <img class="logo" src="{{ Storage::url(core()->getConfigData('sales.invoice_setttings.invoice_slip_design.logo')) }}"/>--}}
            {{--            </div>--}}
            {{--            @endif--}}
        </div>

        <div class="invoice-summary">
            <div class="row">
                <span class="label">Payment slip for the month of </span>
                <span class="value">{{ $data_salary_slip->salary_month . ' ' . $data_salary_slip->salary_year }}</span>
            </div>

            <div class="row">
                <span class="label">Working Branch :-</span>
                <span class="value">{{ ucfirst($data_salary_slip->departmentType) }}</span>
            </div>

            <div class="row">
                <span class="label">EMP Code -</span>
                <span class="value">{{ $data_salary_slip->emp_code }}</span>
            </div>

            <div class="row">
                <span class="label">EMP Name -</span>
                <span class="value">{{ $data_salary_slip->name }}</span>
            </div>

            <div class="row">
                <span class="label">Salary Month -</span>
                <span class="value">{{ $data_salary_slip->salary_month . ' ' . $data_salary_slip->salary_year }}</span>
            </div>

            <div class="row">
                <span class="label">PF No. -</span>
                <span class="value">{{ $data_salary_slip->pf_number ?? ucfirst('nil') }}</span>
            </div>

            <div class="row">
                <span class="label">Mode of Pay -</span>
                <span class="value">{{ ucfirst('nil') }}</span>
            </div>

            <div class="row">
                <span class="label">Designation -</span>
                <span class="value">{{ ucfirst($data_salary_slip->departmentType) }}
                                                        ({{ $data_salary_slip->description}})</span>
            </div>

            <div class="row">
                <span class="label">UAN. -</span>
                <span class="value">{{ $data_salary_slip->uan ?? ucfirst('nil') }}</span>
            </div>

            <div class="table items">
                <table>
                    <thead>
                    <tr>
                        <th class="text-center">Earnings</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Deductions</th>
                        <th class="text-center">Amount</th>
                    </tr>
                    </thead>

                    <tbody>
                    @for($i = 0; $i < $row_count; $i++)
                        <tr>
                            <td class="text-center">{{ $earning_data[$i]->name ?? '' }}</td>

                            <td class="text-center">
                                {{ getFormattedAmountCurrency($earning_data[$i]->amount ?? 0.00) }}
                            </td>

                            <td class="text-center">{{ $deduction_data[$i]->name ?? '' }}</td>

                            <td class="text-center">{{ getFormattedAmountCurrency($deduction_data[$i]->amount ?? 0.00) }}</td>

                        </tr>
                    @endfor
                    <tr>
                        <td class="text-center">Total Earning</td>

                        <td class="text-center">
                            {{ $data_salary_slip->salary_total }}
                        </td>

                        <td class="text-center">Total Deductions</td>

                        <td class="text-center">{{ $data_salary_slip->salary_gross_deduction }}</td>

                    </tr>
                    </tbody>
                </table>
            </div>


            <table class="sale-summary">
                <tr>
                    <td>Net Pay :</td>
                    <td>-</td>
                    <td>{{ ($data_salary_slip->salary_net_pay) }}</td>
                </tr>

                <tr>
                    <td>In Words</td>
                    <td>-</td>
                    <td>{{ strtoupper($data_salary_slip->salary_net_pay_in_words) }}</td>
                </tr>

                <tr>
                    <td>For Paarth Clothing Pvt. Ltd</td>
                    <td>-</td>
                    <td>Authorised Signatory</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="page-break"></div>
@endforeach
</body>
</html>
