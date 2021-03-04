<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\ExpensesSettings;
use App\Traits\UtilsAwareTrait;
use Illuminate\Http\Request;

class ExpensesSettingsController extends Controller
{
    use UtilsAwareTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['expenses'] = ExpensesSettings::orderBy('id', 'DESC')->get();

        return view('expenses.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = auth()->id();
        $data['categories'] = (new ExpenseCategory)->getSelectedOptions($userId);

        return view('expenses.create', compact('data'));
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
        $expense = ExpensesSettings::create($data);
        if ($expense->exists) {
            $redirectUrl = route('expenses-settings.edit', $expense->id);
            return redirect($redirectUrl)->with('success', __('success-create-message'));
        }
        return back()->with('error', __('error-create-message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpensesSettings $expenses_setting)
    {
        $userId = auth()->id();

        $data['expense'] = $expenses_setting;
        $data['categories'] = (new ExpenseCategory)->getSelectedOptions($userId);

        return view('expenses.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpensesSettings $expenses_setting)
    {
        $data = $this->validateData($request);
        if ($expenses_setting->update($data)) {
            return back()->with('success', __('success-update-message'));
        }
        return back()->with('error', __('error-update-message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensesSettings $expenses_setting)
    {
        if ($expenses_setting->exists && $expenses_setting->delete()) {
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
        $data = $request->validate([
            'title' => 'required|min:3|string',
            'categoryId' => 'required|numeric',
            'expenseType' => 'required',
            'dynamicAmount' => 'nullable',
            'isAutoAdd' => 'nullable',
            'amount' => 'required',
        ]);
        $data['amount'] = $this->floatToInt($data['amount']);
        return $data;
    }
}
