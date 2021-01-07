<?php

namespace App\Http\Controllers;

use App\Models\GoalAction;
use Illuminate\Http\Request;

class GoalActionController extends Controller
{
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
        $data = $this->validateData($request);

        $goalAction = GoalAction::create($data);
        if ($goalAction->exists) {
            return back()->with('success', __('success-create-goal-action'));
        }
        return back()->with('error', __('error-create-goal-action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\GoalAction $goalAction
     * @return \Illuminate\Http\Response
     */
    public function edit(GoalAction $goalAction)
    {
        $data['goalAction'] = $goalAction;

        return view('goal-action.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GoalAction $goalAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoalAction $goalAction)
    {
        $data = $this->validateData($request);
        if ($goalAction->update($data)) {
            return back()->with('success', __('success-update-item'));
        }
        return back()->with('error', __('error-update-item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\GoalAction $goalAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoalAction $goalAction)
    {
        if ($goalAction->exists && $goalAction->delete()) {
            return back()->with('success', __('success-delete-goal-action'));
        }
        return back()->with('error', __('error-delete-goal-action'));
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|min:3|max:100',
            'goalId' => 'required|numeric',
            'weekDays' => 'required',
            'addToTodoList' => 'required',
            'startDateTime' => 'nullable',
        ]);
    }
}
