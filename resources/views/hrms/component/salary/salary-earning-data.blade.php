@php
    use App\Models\SalaryDetail;

        /* @var $model SalaryDetail */

// $salary_detail = SalaryDetail::whereSalaryId('7')->first();

$type = $model->type == 'E' ? 'success' : 'warning'
@endphp
<div class="flex items-center space-x-4">
    <div class="w-12 relative">
        <span>{{ $model->id }}</span>
    </div>
    <div class="flex-1">
        <span>{{ $model->name }}</span>
    </div>

    <div class="flex-1 text-left lg:text-left">
            <span
                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ variants('badges.'. $type) }}">
  {{ ucfirst($model->type == 'E' ? 'Earning' : 'Deduction') }}
</span>
    </div>

    <div class="flex-1 lg:inline">
        <i>{{ $model->amount }}</i>
        <span class="flex text-xs text-gray-400">
      <i data-feather="percent" class="w-4 h-4 mr-2"></i> {{ $model->percentage }}
    </span>
    </div>
</div>
