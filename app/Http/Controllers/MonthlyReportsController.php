<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\MonthlyExpenses;
use App\Traits\UtilsAwareTrait;
use Illuminate\Http\Request;

class MonthlyReportsController extends Controller
{
    use UtilsAwareTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = ExpenseCategory::all();
        $data['monthlyExpenses'] = MonthlyExpenses::filterBy(\request()->all())->get();
        $data['totalSpentAmount'] = MonthlyExpenses::filterBy(\request()->all())->sum('amount');

        return view('monthly-reports.index', compact('data'));
    }

    /**
     * @param ExpenseCategory $category
     */
    public function showByCategory(ExpenseCategory $category)
    {
        $data['category'] = $category;
        $data['categoryExpenses'] = $category->getMonthlyExpenses(\request());
        return view('monthly-reports.category', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
