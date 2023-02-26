<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardCotroller extends Controller
{
    public function __invoke()
    {
        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereBetween('created_at', [Carbon::now()->subMonths(11), Carbon::now()])
            ->groupBy(DB::raw("created_at"))
            ->orderBy(DB::raw("created_at"))
            ->pluck('count', 'month_name');

        $labels = $users->keys();
        $data = $users->values();

        return view('dashboard', compact('labels', 'data'));
    }
}
