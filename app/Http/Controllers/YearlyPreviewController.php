<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\MonthlyExpenses;
use App\Utilities\YearlyDataAggregator;
use Illuminate\Http\Request;

class YearlyPreviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aggregator = new YearlyDataAggregator();
        $data['aggregator'] = $aggregator;

        $request = \request();
        if (!$request->exists('toDate')) {
            $request->merge([
                'toDate' => date('Y-01-01') . ' - ' . date('Y-m-d')
            ]);
        }

        $data['categoriesSelectedOptions'] = (new ExpenseCategory())->getSelectedOptions();
        $data['expenses'] = MonthlyExpenses::filterBy($request->all())->paginate(15);

        return view('yearly-preview.index', compact('data'));
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
}
