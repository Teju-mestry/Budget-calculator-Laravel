<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class incomeController extends Controller
{
    function addedIncome(Request $request){

        $incomeReason = $request->input('incomeReason');
        $incomeAmount = $request->input('incomeAmount');
        
        $noOfRecords = DB::table('incomes')->count();

        $income= new income;
        $expense = new Expense;

        if($noOfRecords == 0){
            $income->remaining_amount  = $incomeAmount;
            $expense->remaining_amount = $incomeAmount;
            $expense->expense_reason = 'Initial Amount Added';
            $expense->expense_amount = 0;
       }
       else{

        $remainingAmountIncome = DB::table('incomes')->get()->last()->remaining_amount;
        $remainingAmountExpense = DB::table('expenses')->get()->last()->remaining_amount;

        $income->remaining_amount  = $remainingAmountIncome + $incomeAmount ;
        $expense->remaining_amount = $remainingAmountExpense + $incomeAmount;
        $expense->expense_reason = 'Income Amount Added';
        $expense->expense_amount = 0;
       }
      

        $income->income_reason = $incomeReason;
        $income->income_amount = $incomeAmount;



        $income->save();
        $expense->save();

        return $income;


    }
}
