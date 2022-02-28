<?php

namespace App\Exports;

use App\Models\salary;
use Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SalaryExport implements FromQuery, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{

    protected $year;
    protected $month;

    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    /**
     * @var Salary $salary
     */
    public function map($salary): array
    {
        return [
            $salary->User->adhar_number, //A
            $salary->UserEmployee->EmpDepartmentData->EmpDepartmentType->name, //B
            $salary->User->name . ' ' . ($salary->User->middle_name ? $salary->User->middle_name . ' ' : '') . $salary->User->last_name, //C
            $salary->UserEmployee->EmpDepartmentData->description, //D
            $salary->salary_contract_basic, //E
            $salary->salary_contract_hra, //F
            $salary->salary_contract_total, //G
            $salary->total_days, //H
            $salary->present_days, //I
            $salary->absent_days, //J
            $salary->salary_basic, //K
            $salary->salary_hra, //L
            $salary->salary_total, //M
            $salary->salary_gross_deduction, //N
            $salary->salary_gross_earning, //O
            $salary->UserEmployee->EmpPfDetail ? $salary->UserEmployee->EmpPfDetail->uan ?? null : null, //P
            $salary->UserEmployee->EmpPfDetail ? $salary->UserEmployee->EmpPfDetail->pf_number ?? null : null, //Q
            $salary->UserEmployee->EmpPfDetail ? $salary->UserEmployee->EmpPfDetail->abry_eligible ? 'ABRY' : null : null, //R
            Date::dateTimeToExcel($salary->created_at), //S

        ];
    }

    public function query()
    {
        $company_id = Auth::user()->getCompanyId();
        $data = salary::query()
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->with(['User',
                'UserEmployee',
                'UserEmployee.EmpDepartmentData.EmpDepartmentType',
                'UserEmployee.EmpPfDetail'
            ]);

        if ($company_id != 1) {
            $data->whereHas('UserEmployee', function ($q) use ($company_id) {
                $q->where('company_id', '=', $company_id);
//                $q->where('user_id', '=', 'users.id');
            });
        }

//        echo json_encode($data->get()) . '<br>';
//        dd($data->get());
        return $data;
    }


    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER,
            'M' => NumberFormat::FORMAT_NUMBER,
            'N' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    public function headings(): array
    {
        return [
            'EMP_CODE', //A
            'DEPARTMENT',//B
            'EMPLOYEE_NAME',//C
            'CATEGORY',//D
            ['ACTUAL_SALARY', 'BASIC'],//E
            'HRA',//F
            'GROSS',//G
            'TOTAL_WRK_DAY',//H
            'P_TOTAL',//I
            'A_DAY',//J
            ['SALARY_PAYABLE', 'BASIC'],//K
            'HRA',//L
            'GROSS',//M
            'PF',//N
            'NET_PAYABLE',//O
            'UAN',//P
            'PF Number',//Q
            'ABRY',//R
            '',//S
        ];
    }
}
