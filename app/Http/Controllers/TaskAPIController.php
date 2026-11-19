<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all(); //mostra todas as tarefas na BD   get http://127.0.0.1:8000/api/task
        // return Task::paginate(); //mostra todas as tarefas na BD, separados por "paginas"   get http://127.0.0.1:8000/api/task
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // no postman: POST http://127.0.0.1:8000/api/task   permite criar e enviar dados para a BD
    {
        $request->validate([
            'name'=>'required',
            'user_id'=>'required'
        ]);


        Task::create($request->all()); //arruma os dados recebidos

        return response()->json('Tarefa inserida com sucesso!');
    }

    /**
     * Display the specified resource.*/
    //  id tambem era ok...para ver se o postman recebe o que esta na tabela, exemplo GET http://127.0.0.1:8000/api/task/5
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)  // PUT http://127.0.0.1:8000/api/task/7 - RAW: {"name":"fazer compras de natal para 2027!"}   ... atualiza o campo na BD

    {
       $task->update($request->all());


        return response()->json('tarefa actualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
       $task->delete(); // DELETE http://127.0.0.1:8000/api/task/10


        return response()->json('tarefa apagada com sucesso!');

    }
}
