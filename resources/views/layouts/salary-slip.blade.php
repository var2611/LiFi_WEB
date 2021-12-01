@extends('layouts.main_hr')
@php
    /* @var $data_salary_slip DataSalarySlip */use App\Models\FormModels\DataSalarySlip;
@endphp
@section('container')
    <div class="container mt-5 mb-5">
        <div class="row flex-column">
            <div class="col-md-12">
                <div class="text-center lh-1 mb-2">
                    <h6 class="font-weight-bold">Payslip</h6> <span class="fw-normal">Payment slip for the month of October 2021</span>
                </div>
                <div class="d-flex justify-content-end"><span>Working Branch:ROHINI</span></div>
                <div class="row flex-column">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">EMP Code</span> <small
                                        class="ms-3">{{ $data_salary_slip->emp_code }}</small></div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">EMP Name</span> <small
                                        class="ms-3">{{ $data_salary_slip->name }}</small></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">PF No.</span> <small
                                        class="ms-3">{{ $data_salary_slip->pf_number }}</small></div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">NOD</span> <small class="ms-3">28</small></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">ESI No.</span> <small class="ms-3"></small></div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">Mode of Pay</span> <small class="ms-3">SBI</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">Designation</span> <small
                                        class="ms-3">{{ $data_salary_slip->departmentType ?? '' }}
                                        ({{ $data_salary_slip->description ?? '' }})</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="font-weight-bold">UAN.</span> <small
                                        class="ms-3">{{ $salary_pf_detail->EmpPfDetail->uan }}</small></div>
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
                            <tr>
                                <th scope="row">Basic</th>
                                <td>16250.00</td>
                            </tr>
                            <tr class="border-top">
                                <th scope="row">Total Earning</th>
                                <td>25970.00</td>
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
                            <tr>
                                <td>PF</td>
                                <td>1800.00</td>
                            </tr>
                            <tr class="border-top">
                                <td>Total Deductions</td>
                                <td>2442.00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><br> <span class="font-weight-bold">Net Pay : 24528.00</span></div>
                    <div class="border col-md-8">
                        <div class="d-flex flex-column"><span>In Words</span> <span>Twenty Five thousand nine hundred seventy only</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="d-flex flex-column mt-2"><span class="font-weight-bold">For Kalyan Jewellers</span>
                        <span class="mt-4">Authorised Signatory</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection
