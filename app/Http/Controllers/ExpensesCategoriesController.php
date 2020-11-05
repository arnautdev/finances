<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpensesCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = ExpenseCategory::orderBy('id', 'DESC')->get();

        return view('expenses-categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses-categories.create');
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
        $expenseCategory = ExpenseCategory::create($data);
        if ($expenseCategory->exists) {
            $redirectUrl = route('expenses-categories.edit', [$expenseCategory->id]);
            return redirect($redirectUrl)->with('success', __('success-create-item'));
        }
        return back()->with('error', __('error-create-item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expenses_category)
    {
        $data['category'] = $expenses_category;

        return view('expenses-categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expenses_category)
    {

        $data = $this->validateData($request);
        if ($expenses_category->update($data)) {
            return back()->with('success', __('success-update-item'));
        }
        return back()->with('error', __('error-update-item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenses_category)
    {
        if ($expenses_category->exists && $expenses_category->delete()) {
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
            'title' => 'required|min:3'
        ]);
    }
}
