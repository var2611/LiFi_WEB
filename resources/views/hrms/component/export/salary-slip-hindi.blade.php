<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
@php
    use App\Models\FormModels\DataSalarySlip;
    use App\Models\SalaryDetail;


        /* @var $data_salary_slips DataSalarySlip[] */
        /* @var $data_salary_slip DataSalarySlip */
        /* @var $earning_data SalaryDetail*/
        /* @var $deduction_data SalaryDetail*/

@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LiFi - {{ $title ?? config('app.name', 'Laravel') }}</title>
    <style type="text/css">
        .page-break {
            page-break-after: always;
        }

        {{--@font-face {--}}
        {{--    font-family: "Poppins";--}}
        {{--    src: url('{{public_path()}}/fonts/Poppins-Regular.ttf') format("truetype");--}}
        {{--    font-weight: 400;--}}
        {{--    font-style: normal;--}}
        {{--}--}}

        @font-face {
            font-family: "kruti-dev";
            src: url('{{public_path()}}/fonts/kruti-dev.ttf') format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        * {
            font-family: "kruti-dev", serif;
        }

        body, th, td, h5 {
            font-size: 12px;
            color: #000;
        }

        .container {
            padding: 20px;
            display: block;
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .column {
            float: left;
        }

        .invoice-summary {
            margin-bottom: 20px;
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

        .sale-summary tr td {
            padding: 3px 5px;
        }

        .sale-summary tr.bold {
            font-weight: 600;
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
    @php
        $data_salary_slip = $data_salary_slips[$j-1];

        $earning_data = $data_salary_slip->getEarningData();
        $deduction_data = $data_salary_slip->getDeductionData();
    @endphp
    <div class="container">
        <div class="header">
            <div class="row">
                <div class="col-12" style="text-align: center">
                    <h1 class="text-center" style="margin: 0; font-weight: 800">PAARTH CLOTHING PVT. LTD</h1>
                    <h3
                        class="text-center" style="font-weight: 800">PLOT NO. 7, Govt. Industrial Estate,Behind Masat
                        Police
                        Station
                        Silvassa-396230 </h3>
                </div>
            </div>
            <div style="margin-bottom: 2px">
                <span class="merchant-details-title">FORM IV B [ Rule 26(2)]</span>
            </div>
            <div style="width: 100%; border: solid 2px #000000"></div>

            <div class="invoice-summary">
                <div class="text-center" style="margin-top: 20px">
                    <span><b>Wages Slip for the Month Of : </b>{{ $data_salary_slip->salary_month . ' ' . $data_salary_slip->salary_year }}</span>
                </div>
                <div class="row" style="width: 100%">
                    <div class="column" style="width: 50%">
                        <table style="width: 100%">
                            <thead>
                            <tr>
                                <td style="width: 20%"><b>EMP Code</b></td>
                                <td style="width: 20%;text-align: start"><b>{{getEnglishToHindi("EMP Code")}}</b></td>
                                <td style="width: 5%"><b>:</b></td>
                                <td style="width: 55%">{{ $data_salary_slip->emp_code }}</td>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <td style="width: 20%"><b>EMP Name</b></td>
                                <td style="width: 20%;text-align: start"><b>{{getEnglishToHindi("Name")}}</b></td>
                                <td style="width: 5%"><b>:</b></td>
                                <td style="width: 55%;text-align: start">{{ $data_salary_slip->name }}</td>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <td style="width: 20%"><b>Designation</b></td>
                                <td style="width: 20%"><b>{{getEnglishToHindi("Designation")}}</b></td>
                                <td style="width: 5%"><b>:</b></td>
                                <td style="width: 55%">{{ ucfirst($data_salary_slip->departmentType) }}
                                    ({{ $data_salary_slip->description}})
                                </td>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <td style="width: 20%"><b>UAN.</b></td>
                                <td style="width: 20%"><b>{{getEnglishToHindi("UAN")}}</b></td>
                                <td style="width: 5%"><b>:</b></td>
                                <td style="width: 55%">{{ $data_salary_slip->uan ?? ucfirst('nil') }}</td>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <td style="width: 20%"><b>PF No.</b></td>
                                <td style="width: 20%"><b>{{getEnglishToHindi("PF No")}}</b></td>
                                <td style="width: 5%"><b>:</b></td>
                                <td style="width: 55%">{{ $data_salary_slip->pf_number ?? ucfirst('nil') }}</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="column" style="width: 50%">
                        <table style="width: 100%;">
                            <thead>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <th><b>Attendance</b></th>
                                <th>AP</th>
                                <th>PH</th>
                                <th>PL</th>
                                <th>CL</th>
                                <th>SL</th>
                                <th>W/O</th>
                                <th>AB</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <td>{{getEnglishToHindi("Attendance")}}</td>
                                <th>{{$data_salary_slip->present_days}}</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>{{$data_salary_slip->week_off_days}}</th>
                                <th>{{$data_salary_slip->absent_days}}</th>
                                <th>{{$data_salary_slip->month_days}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div style="width: 100%; border: solid 1px #000000"></div>
            <div style="margin-top: 10px; margin-bottom: 10px">
                <table style="width: 100%">
                    <thead>
                    <tr>
                        <th style="width: 18%; text-align: start"><b>Earnings</b></th>
                        <th style="width: 18%; text-align: start"><b></b></th>
                        <th style="width: 7%; text-align: start"><b></b></th>
                        <th style="width: 7%; text-align: start"><b>Amount (Rs)</b></th>
                        <th style="width: 18%; text-align: start"><b>Deductions</b></th>
                        <th style="width: 18%; text-align: start"><b></b></th>
                        <th style="width: 7%; text-align: start"><b>Amount (Rs)</b></th>
                        <th style="width: 7%; text-align: start"><b>Net Payable</b></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div style="width: 100%; border: solid 1px #000000"></div>
            <div style="margin-top: 10px; margin-bottom: 10px">
                <table style="width: 100%">
                    <thead>
                    <tr>
                        <td style="width: 18%; text-align: start">Basic Salary + DA</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("Basic")}}
                            + {{getEnglishToHindi("DA")}}</td>
                        <td style="width: 7%; text-align: start">{{$data_salary_slip->salary_contract_basic}}</td>
                        <td style="width: 7%; text-align: start">{{$data_salary_slip->salary_basic}}</td>
                        <td style="width: 18%; text-align: start">PF</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("PF")}}</td>
                        <td style="width: 7%; text-align: start">{{$data_salary_slip->pf_amount}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 18%; text-align: start">Spl.Allow</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("Allow")}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 18%; text-align: start">PT</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("PT")}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 18%; text-align: start">HRA</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("HRA")}}</td>
                        <td style="width: 7%; text-align: start">{{$data_salary_slip->salary_contract_hra}}</td>
                        <td style="width: 7%; text-align: start">{{$data_salary_slip->salary_hra}}</td>
                        <td style="width: 18%; text-align: start">Loan</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("Loan")}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 18%; text-align: start">Conveyance</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("Conveyance")}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 18%; text-align: start">Advance</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("Advance")}}</td>
                        <td style="width: 7%; text-align: start">{{$data_salary_slip->advance_amount}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 18%; text-align: start">OT</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("OT")}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 18%; text-align: start">ESIC</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("ESIC")}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 18%; text-align: start">&nbsp;</td>
                        <td style="width: 18%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 18%; text-align: start">TDS</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("TDS")}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <td style="width: 18%; text-align: start">&nbsp;</td>
                        <td style="width: 18%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 18%; text-align: start">LWF</td>
                        <td style="width: 18%; text-align: start">{{getEnglishToHindi("LWF")}}</td>
                        <td style="width: 7%; text-align: start">&nbsp;</td>
                        <td style="width: 7%; text-align: start">{{getEnglishToHindi("Net Payable")}}</td>
                    </tr>
                    </thead>
                </table>
            </div>
            <div style="width: 100%; border: solid 1px #000000"></div>
            <div style="margin-top: 10px; margin-bottom: 10px">
                <table style="width: 100%">
                    <thead>
                    <tr>
                        <th style="width: 18%; text-align: start"><b>Gross Salary</b></th>
                        <th style="width: 18%; text-align: start"><b>{{getEnglishToHindi("Gross Salary")}}</b></th>
                        <th style="width: 7%; text-align: start"><b>{{$data_salary_slip->salary_contract_total}}</b>
                        </th>
                        <th style="width: 7%; text-align: start"><b>{{$data_salary_slip->salary_total}}</b></th>
                        <th style="width: 18%; text-align: start"><b>Deductions</b></th>
                        <th style="width: 18%; text-align: start"><b>{{getEnglishToHindi("Deductions")}}</b></th>
                        <th style="width: 7%; text-align: start"><b>{{$data_salary_slip->salary_gross_deduction}}</b>
                        </th>
                        <th style="width: 7%; text-align: start"><b>{{$data_salary_slip->salary_net_pay}}</b></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div style="width: 100%; border: solid 1px #000000"></div>
            <table style="width: 100%; margin-top: 8px">
                <thead>
                <tr>
                    <th style="width: 33%; text-align: start">ESIC No :</th>
                    <th style="width: 33%; text-align: start">PAYMENT BY :</th>
                    <th style="width: 34%; text-align: start">A/C No :</th>
                </tr>
                </thead>
            </table>
            <table style="width: 100%; margin-top: 40px">
                <thead>
                <tr>
                    <th style="width: 50%; text-align: start">Employee Signature</th>
                    <th style="width: 50%; text-align: end">Employer's Signature</th>
                </tr>
                </thead>
            </table>
            <div style="width: 100%; border: solid 2px #000000"></div>
        </div>
    </div>
    @if(($j%2) == 0)
        <div class="page-break"></div>
    @endif
@endfor
</body>
</html>
