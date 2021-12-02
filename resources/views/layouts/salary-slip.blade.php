@extends('layouts.main_hr')
@php
    use App\Models\FormModels\DataSalarySlip;
    use App\Models\SalaryDetail;

        /* @var $data_salary_slip DataSalarySlip */
        /* @var $earning_data SalaryDetail*/
        /* @var $deduction_data SalaryDetail*/
        /* @var $row_count int*/

    $earning_data = $data_salary_slip->getEarningData();
    $deduction_data = $data_salary_slip->getDeductionData();

    $row_count = count($earning_data) >= count($deduction_data) ? count($earning_data) : count($deduction_data);

@endphp
@section('container')
    <div class="container mt-5 mb-5">
        <div class="row flex-column">
            <div class="col-md-12">
                <div class="text-center lh-1 mb-2">
                    <h6 class="font-weight-bold">Payslip</h6> <span
                        class="fw-normal">Payment slip for the month of {{ $data_salary_slip->salary_month . ' ' . $data_salary_slip->salary_year }}</span>
                </div>
                <div class="d-flex justify-content-end"><span>Working Branch : {{ ucfirst($data_salary_slip->departmentType) }}</span></div>
                <div class="row flex-column">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">EMP Code</span> <small
                                        class="ms-3">{{ $data_salary_slip->emp_code }}
                                        ({{ $data_salary_slip->salary_month . ' ' . $data_salary_slip->salary_year }}
                                        )</small></div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">EMP Name</span> <small
                                        class="ms-3">{{ $data_salary_slip->name }}</small></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">PF No.</span> <small
                                        class="ms-3">{{ $data_salary_slip->pf_number ?? ucfirst('nil') }}</small></div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">Mode of Pay</span> <small
                                        class="ms-3">{{ ucfirst('nil') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">Designation</span> <small
                                        class="ms-3">{{ ucfirst($data_salary_slip->departmentType) }}
                                        ({{ $data_salary_slip->description}})</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">UAN.</span> <small
                                        class="ms-3">{{ $data_salary_slip->uan ?? ucfirst('nil') }}</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="mt-4 table table-bordered">
                            <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">Earnings</th>
                                <th scope="col">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < $row_count; $i++)
                                <tr>
                                    <th scope="row">{{ $earning_data[$i]->name ?? '' }}</th>
                                    <td>{{ getFormattedAmountCurrency($earning_data[$i]->amount ?? 0.00) }}</td>
                                </tr>
                            @endfor
                            <tr class="border-top">
                                <th scope="row">Total Earning</th>
                                <td>{{ $data_salary_slip->salary_total }}</td>
                            </tr>
                            </tbody>

                        </table>
                        <table class="mt-4 table table-bordered">
                            <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">Deductions</th>
                                <th scope="col">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < $row_count; $i++)
                                <tr>
                                    <td>{{ $deduction_data[$i]->name ?? '' }}</td>
                                    <td>{{ getFormattedAmountCurrency($deduction_data[$i]->amount ?? 0.00) }}</td>
                                </tr>
                            @endfor
                            <tr class="border-top">
                                <td>Total Deductions</td>
                                <td>{{ $data_salary_slip->salary_gross_deduction }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><br> <span
                            class="font-weight-bold">Net Pay : {{ ($data_salary_slip->salary_net_pay) }}</span></div>
                    <div class="border col-md-8">
                        <div class="d-flex flex-column"><span>In Words</span>
                            <span>{{ strtoupper($data_salary_slip->salary_net_pay_in_words) }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="d-flex flex-column mt-2"><span class="font-weight-bold">For Paarth Clothing Pvt. Ltd</span>
                        <span class="mt-4">Authorised Signatory</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection
