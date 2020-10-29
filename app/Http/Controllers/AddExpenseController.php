<?php

namespace App\Http\Controllers;

use App\Models\MonthlyExpenses;
use Illuminate\Http\Request;

class AddExpenseController extends Controller
{
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthlyExpenses $add_expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthlyExpenses $add_expense)
    {
        //
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
            'expenseId' => 'required|numeric',
            'amount' => 'required|numeric',
            'toDate' => 'nullable',
        ]);
    }
}
