<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\ExpensesSettings;
use App\Models\MonthlyExpenses;
use App\Models\SystemSettings;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemSettings = new SystemSettings();
        $systemSettings->addSettingsKey('startUseDate', date('Y-m-d'));

        $data['expensesList'] = (new ExpensesSettings())->getExpensesList();
        $data['addedToday'] = (new MonthlyExpenses())->getTodayAdded();
        $data['averagePerDay'] = (new MonthlyExpenses())->getAveragePerDay();

        $data['todoList'] = (new TodoList())->getTodoList();

        $data['categories'] = (new ExpenseCategory)->getSelectedOptions();

        return view('dashboard.index', compact('data'));
    }
}
