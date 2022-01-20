@php
    use App\Models\Attendance;
            /* @var $model Attendance */

$hours_worked = number_format((float)$model->hours_worked ?? 0, 2, '.', '');
@endphp
<div class="flex items-center space-x-4">
    <div class="w-12 relative">
        <span>{{ $model->id }}</span>
        {{--            @dd($model)--}}
    </div>
    <div class="flex-1">
        <span>{{ $model->date . ' (' . date('l', strtotime($model->date)) }})</span>
    </div>

    <div class="flex-1">
        <span>{{ $hours_worked }} H</span>
    </div>

    <div class="flex-1 lg:inline">
            <span class="flex text-xs">
      <i data-feather="log-in" class="w-4 h-4 mr-2"></i> {{ $model->in_time }}
            </span>
        <span class="flex text-xs">
      <i data-feather="log-out" class="w-4 h-4 mr-2"></i> {{ $model->out_time }}
            </span>
    </div>

    <x-lv-actions :actions="$actions" :model="$model" />
</div>
