@php
    use App\Models\Salary;

        /* @var $salary Salary */

$salary = Salary::first();
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
        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-pink-50 text-pink-500">
          {{ ucfirst($salary->salary_contract_hra) }}
        </span>
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Total
            </div>
            <div class="px-2 md:px-4">
        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-pink-50 text-pink-500">
          {{ ucfirst($salary->salary_contract_total) }}
        </span>
            </div>
        </div>

    </div>

    <div class="font-semibold text-1xl text-gray-900">
        Salary Detail
    </div>

    <div class="flex flex-row md:items-center md:flex-row border-b border-gray-200">
        <div class="flex-1 border-b border-gray-200 md:border-none py-2">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Basic
            </div>
            <div class="px-2 md:px-4">
                {{ $salary->salary_basic }}
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                HRA
            </div>
            <div class="px-2 md:px-4">
        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-pink-50 text-pink-500">
          {{ ucfirst($salary->salary_hra) }}
        </span>
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Total
            </div>
            <div class="px-2 md:px-4">
        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-pink-50 text-pink-500">
          {{ ucfirst($salary->salary_total) }}
        </span>
            </div>
        </div>
    </div>

    <div class="font-semibold text-1xl text-gray-900">
        Deduction Detail
    </div>

    <div class="flex flex-row md:items-center md:flex-row border-b border-gray-200">
        <div class="flex-1 border-b border-gray-200 md:border-none py-2">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Deduction
            </div>
            <div class="px-2 md:px-4">
                {{ $salary->salary_gross_deduction }}
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                HRA
            </div>
            <div class="px-2 md:px-4">
        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-pink-50 text-pink-500">
          {{ ucfirst($salary->salary_gross_earning) }}
        </span>
            </div>
        </div>
        <div class="flex-1 py-2 md:py-0">
            <div class="text-gray-500 font-medium px-2 md:px-4">
                Total
            </div>
            <div class="px-2 md:px-4">
        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-pink-50 text-pink-500">
          {{ ucfirst($salary->salary_total) }}
        </span>
            </div>
        </div>
    </div>
</div>
