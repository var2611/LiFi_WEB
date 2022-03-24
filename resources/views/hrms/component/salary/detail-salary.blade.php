@php
    use App\Models\Salary;

        /* @var $salary Salary */

//$salary = Salary::first();
@endphp

<div class="text-sm">
    <div class="flex flex-row md:items-center md:flex-row border-b border-gray-200">
        <div class="flex-1 border-b border-gray-200 md:border-none py-2">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Days in month
            </div>
            <div class="px-2 md:px-4">
                {{ $salary->total_days }}
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Present Days
            </div>
            <div class="px-2 md:px-4">
                {{ $salary->present_days}}
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Absent Days
            </div>
            <div class="px-2 md:px-4">
                {{ $salary->absent_days }}
            </div>
        </div>

    </div>

    <div class="font-semibold text-1xl text-gray-900">
        Contract Salary Detail
    </div>
    <div class="flex flex-row md:items-center md:flex-row border-b border-gray-200">
        <div class="flex-1 border-b border-gray-200 md:border-none py-2">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Basic
            </div>
            <div class="px-2 md:px-4">
                {{ $salary->salary_contract_basic }}
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                HRA
            </div>
            <div class="px-2 md:px-4">
                {{ ucfirst($salary->salary_contract_hra) }}
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Total
            </div>
            <div class="px-2 md:px-4">
                {{ ucfirst($salary->salary_contract_total) }}
            </div>
        </div>

    </div>

    <div class="font-semibold text-1xl text-gray-900">
        Salary Detail
    </div>

    <div class="flex flex-row md:items-center md:flex-row border-b border-gray-200">
        <div class="flex-1 border-b border-gray-200 md:border-none py-2">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Total Earning
            </div>
            <div class="px-2 md:px-4">
                {{ $salary->salary_total }}
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Total Deduction
            </div>
            <div class="px-2 md:px-4">
                {{ ucfirst($salary->salary_gross_deduction) }}
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Gross Earning
            </div>
            <div class="px-2 md:px-4">
                {{ ucfirst($salary->salary_gross_earning) }}
            </div>
        </div>
    </div>
</div>

<div class="font-semibold text-1xl text-gray-900">
    Salary Earning in Detail {{--List--}}
</div>

@livewire("$salary_detail_class", ['salary_id'=>$salary->id])

<div class="font-semibold text-1xl text-gray-900">
    Overtime Attendance Detail
</div>

@livewire("$attendance_overtime_class", ['salary'=>$salary])
