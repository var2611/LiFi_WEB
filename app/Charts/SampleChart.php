<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Attendance;
use Arr;
use Auth;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $company_id = Auth::user()->getCompanyId();

        $data = Attendance::selectRaw('date, count(date) as count')
            ->with(['User.UserEmployee:id,user_id,company_id'])
            ->whereHas('User.UserEmployee', function ($q) use ($company_id) {
                $q->where('company_id', '=', $company_id);
//                $q->where('user_id', '=', 'users.id');
            })
            ->groupBy('date')
            ->limit(30)
            ->orderByDesc('date')
            ->get()
            ->reverse();

        return Chartisan::build()
            ->labels(Arr::pluck($data, 'date'))
            ->dataset('User Punched In', Arr::pluck($data, 'count'));
//            ->dataset('Sample 2', [3, 2, 1]);
    }
}
