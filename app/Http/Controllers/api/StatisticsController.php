<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function statistics()
    {
        $adminCount = User::all()->count();
        $transactionCount = Transaction::all()->count();
        $unpaidDebt = Transaction::where('status', 'Belum Lunas')->count();
        $totalIncome = Transaction::all()->sum('total_paid');

        return response()->json([
            'success' => true,
            'message' => 'Data Statistic',
            'admin' => $adminCount,
            'transaction' => $transactionCount,
            'unpaidDebt' => $unpaidDebt,
            'income' => $totalIncome
        ]);
    }
}
