<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['todolist'] = TodoList::filterBy(\request()->all())->orderBy('id', 'DESC')->get();

        return view('todolist.index', compact('data'));
    }

    /**
     * @param TodoList $todo
     * @return bool[]|false[]
     */
    public function markAsDone(TodoList $todo)
    {
        if (!$todo->exists) {
            return [
                'status' => false
            ];
        }

        $isDone = \request()->get('isDone', 'yes');
        if ($todo->update(['isDone' => $isDone])) {
            return [
                'status' => true
            ];
        }
        return [
            'status' => false
        ];
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
        $todoTask = TodoList::create($data);
        if ($todoTask->exists) {
            return back()->with('success', __('success-create-item'));
        }
        return back()->with('error', __('error-create-item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TodoList $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoList $todo)
    {
        $data['todo'] = $todo;
        return view('todolist.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TodoList $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoList $todo)
    {
        $data = $this->validateData($request);
        if ($todo->update($data)) {
            return back()->with('success', __('success-update-item'));
        }
        return back()->with('error', __('error-update-item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TodoList $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $todo)
    {
        if ($todo->exists && $todo->delete()) {
            if (\request()->ajax()) {
                return ['status' => true];
            }
            return back()->with('success', __('success-delete-message'));
        }
        return back()->with('error', __('error-delete-message'));
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function validateData(Request $request)
    {
        return $request->validate([
            'description' => 'required|min:5|max:500'
        ]);
    }
}
