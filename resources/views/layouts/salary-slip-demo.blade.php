<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
@php
    use App\Models\FormModels\DataSalarySlip;
        use App\Models\SalaryDetail;


            /* @var $data_salary_slips DataSalarySlip[] */
            /* @var $data_salary_slip DataSalarySlip */
            /* @var $earning_data SalaryDetail*/
            /* @var $deduction_data SalaryDetail*/
            /* @var $row_count int*/

    $nill = ucfirst('nil');
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
@for($j = 1; $j <= sizeof($data_salary_slips); $j++)
    {{--@foreach($data_salary_slips as $data_salary_slip)--}}

    @php
        $data_salary_slip = $data_salary_slips[$j-1];

        $earning_data = $data_salary_slip->getEarningData();
        $deduction_data = $data_salary_slip->getDeductionData();

        $row_count = max(count($earning_data), count($deduction_data));

        $salary_month = $data_salary_slip->salary_month;
        $salary_year = $data_salary_slip->salary_year;
        $emp_code = $data_salary_slip->emp_code;
        $emp_name = $data_salary_slip->name;
        $pf_number = $data_salary_slip->pf_number ?? $nill;
        $departmentType = ucfirst($data_salary_slip->departmentType);
        $description = $data_salary_slip->description;
        $uan = $data_salary_slip->uan ?? ucfirst('nil');
        $total_days = $data_salary_slip->total_days;
        $present_days = $data_salary_slip->present_days;
        $absent_days = $data_salary_slip->absent_days;
        $salary_total = $data_salary_slip->salary_total;
        $salary_gross_deduction = $data_salary_slip->salary_gross_deduction;
        $salary_net_pay = $data_salary_slip->salary_net_pay;
        $salary_net_pay_in_words = strtoupper($data_salary_slip->salary_net_pay_in_words);

    @endphp
    <div class="container">
        <div class="header">
            <div class="row">
                <div class="col-12" style="text-align: center">
                    <h1 class="text-center" style="margin: 0">Payslip</h1>
                    <span
                        class="text-center">Payment slip for the month of {{ $salary_month . ' ' . $salary_year }}</span>
                </div>
            </div>

            <div class="invoice-summary">
                <span class="merchant-details-title" style="float: right">Working Branch : Paarth</span>
            </div>

            <div class="invoice-summary">

                <table style="width: 50%">
                    <thead>
                    <tr>
                        <td style="width: 50%"><b>EMP Code: </b>{{ $emp_code }}</td>
                        <td style="width: 50%"><b>EMP Name: </b>{{ $emp_name }}</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 50%"><b>PF No.: </b>{{ $pf_number }}</td>
                        <td style="width: 50%"><b>Mode of Pay: </b>{{ $nill }}</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 50%"><b>Designation: </b>{{ $departmentType }}
                            ({{ $description }})
                        </td>
                        <td style="width: 50%"><b>UAN.: </b>{{ $uan }}</td>
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
                        <td style="width: 50%">{{ $total_days }}</td>
                        <td style="width: 50%">{{ $present_days }}</td>
                        <td style="width: 50%">{{ $absent_days }}</td>
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
                        @php
                            $earning_name = $earning_data[$i]->name ?? '';
                            $earning_amount = getFormattedAmountCurrency($earning_data[$i]->amount ?? 0.00);
                            $deduction_name = $deduction_data[$i]->name ?? '';
                            $deduction_amount = getFormattedAmountCurrency($deduction_data[$i]->amount ?? 0.00);

                        @endphp
                        <tr>
                            <td style="width: 50%">{{ $earning_name }}</td>
                            <td style="width: 50%">{{ $earning_amount }}</td>
                            <td style="width: 50%">{{ $deduction_name }}</td>
                            <td style="width: 50%">{{ $deduction_amount }}</td>
                        </tr>
                    @endfor
                    </tbody>
                    <tbody>
                    <tr>
                        <td style="width: 50%">Total Earning</td>
                        <td style="width: 50%">{{ $salary_total }}</td>
                        <td style="width: 50%">Total Deductions</td>
                        <td style="width: 50%">{{ $salary_gross_deduction }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <table class="mt-10" style="width: 100%">
                <thead>
                <tr>
                    <td class="label" style="width: 50%">Net Pay: {{ ($salary_net_pay) }}</td>
                    <td class="border-th" style="width: 50%">In Words<br/>
                        {{ $salary_net_pay_in_words }}
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
    @if(($j%2) == 0)
        <div class="page-break"></div>
    @endif
@endfor
</body>
</html>
