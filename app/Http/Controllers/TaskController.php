<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $lastUser = Auth::user();

        if (Auth::check()) {
            // Si el usuario está logueado, mostrar solo sus tareas
            $tasks = Task::with('tags')->latest()->paginate(10);
        } else {
            // Mostrar todas las tareas si no hay usuario logueado
          
            $tasks = Task::with('tags')->where('user_id', Auth::id())->latest()->paginate(10);
        }

        return view('tasks.index', compact('tasks', 'lastUser'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('tasks.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:baja,media,alta',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'priority' => $request->priority,
            'completed' => false,
            'user_id' => Auth::id(),
        ]);

        if ($request->tags) {
            $task->tags()->attach($request->tags);
        }

        return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente.');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        // Verificar si el usuario logueado es el creador de la tarea
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Acción no autorizada');
        }

        $tags = Tag::all();
        return view('tasks.edit', compact('task', 'tags'));
    }

    public function update(Request $request, Task $task)
    {
        // Verificar si el usuario logueado es el creador de la tarea
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Acción no autorizada');
        }

        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:baja,media,alta',
            'completed' => 'required',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $task->update([
            'title' => $request->title,
            'priority' => $request->priority,
            'completed' => $request->completed,
        ]);

        $task->tags()->sync($request->tags);

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Task $task)
    {
        // Verificar si el usuario logueado es el creador de la tarea
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Acción no autorizada');
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
    }

    public function complete(Task $task)
    {
        // Verificar si el usuario logueado es el creador de la tarea
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Acción no autorizada');
        }

        $task->update(['completed' => true]);
        return redirect()->route('tasks.index')->with('success', 'Tarea marcada como completada.');
    }
}
