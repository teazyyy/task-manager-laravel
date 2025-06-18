<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Iegūst pašreiz autentificēto lietotāju
    $user = auth()->user();

    // Ja lietotājs ir admins, viņš redz visus uzdevumus
    if ($user->role->name === 'admin') {
        $tasks = Task::latest()->get(); // Pēc jaunākajiem
    } else {
        // Visi pārējie redz tikai savus uzdevumus
        $tasks = Task::where('user_id', $user->id)->latest()->get();
    }

    // Atgriež skatījumu ar attiecīgajiem uzdevumiem
    return view('tasks.index', compact('tasks'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        $task = new Task($validated);
        $task->user_id = auth()->id();
        $task->save();

        return redirect()->route('tasks.index')->with('success', __('messages.task_created'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
{
    $this->authorize('update', $task);

    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable|string',
    ]);

    $task->update($validated);

    return redirect()->route('tasks.index')->with('success', __('messages.task_updated'));
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', __('messages.task_deleted'));
    }
}
