<?php

namespace App\Http\Controllers;

use App\Models\ExpensesSettings;
use App\Models\MonthlyExpenses;
use App\Traits\UtilsAwareTrait;
use Illuminate\Http\Request;

class AddExpenseController extends Controller
{
    use UtilsAwareTrait;

    /**
     * @param Expenses $expense
     */
    public function setAmountModal(ExpensesSettings $expense)
    {
        $data['expense'] = $expense;
        return view('add-expenses.set-amount-modal', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $monthlyExpense = MonthlyExpenses::create($data);
        if ($monthlyExpense->exists) {
            return back()->with('success', __('success-create-message'));
        }
        return back()->with('error', __('error-create-message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyExpenses $add_expense)
    {
        if ($add_expense->exists && $add_expense->delete()) {
            return back()->with('success', __('success-delete-message'));
        }
        return back()->with('error', __('error-delete-message'));
    }


    /**
     * @param Request $request
     * @return array
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            'userId' => 'required|numeric',
            'expenseId' => 'nullable',
            'categoryId' => 'required|numeric',
            'amount' => 'required|numeric',
            'toDate' => 'nullable',
            'title' => 'nullable',
        ]);
    }
}
