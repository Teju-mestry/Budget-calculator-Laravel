<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense ;
use App\Models\income;
use Illuminate\Support\Facades\DB;



class expenseController extends Controller
{
    function addedExpense(Request $request){

        $expenseReason = $request->input('expenseReason');
        $expenseAmount = $request->input('expenseAmount');
        $remainingAmountIn = 0;
        $remainingAmountEx = 0;


        $remainingAmountIncome = DB::table('incomes')->get()->last()->remaining_amount;
        $remainingAmountExpense = DB::table('expenses')->get()->last()->remaining_amount;
        
        $expense = new Expense;
        $income = new income;

        $remainingAmountEx = $remainingAmountExpense - $expenseAmount;
        $remainingAmountIn = $remainingAmountIncome - $expenseAmount;

        $income->income_reason = 'Expense amount deducted';
        $income->income_amount = 0;



        $expense->expense_reason = $expenseReason;
        $expense->expense_amount = $expenseAmount;
        $expense->remaining_amount= $remainingAmountEx;
        $income->remaining_amount = $remainingAmountIn;


        $income->save();
        $expense->save();

        return $expense;


    }
}