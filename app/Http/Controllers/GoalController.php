<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['goals'] = Goal::filterBy(request()->all())->get();

        return view('goal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goal.create');
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

        $row = Goal::create($data);
        if ($row->exists) {
            return redirect(route('goal.edit', $row->id))->with('success', __('success-create-goal'));
        }
        return back()->with('error', __('error-create-goal'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Goal $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Goal $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        if (!$goal->exists) {
            return back()->with('warning', __('item-not-available'));
        }

        $data['goal'] = $goal;
        $data['goalActions'] = $goal->goalAction()->get();

        return view('goal.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Goal $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        $data = $this->validateData($request);

        if ($goal->update($data)) {
            return back()->with('success', __('success-update-goal'));
        }
        return back()->with('error', __('error-update-goal'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Goal $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        if ($goal->exists && $goal->delete()) {
            return back()->with('success', __('success-delete-goal'));
        }
        return back()->with('error', __('error-delete-goal'));
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'isDone' => 'required',
            'title' => 'required|min:3|max:250',
            'description' => 'nullable',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);
    }
}
