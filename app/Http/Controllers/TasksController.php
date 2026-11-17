<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TasksController extends Controller
{


public function allTasks() {  //nome de função que nos damos
    $tasksWDB = $this->loadTasksWDB();

    $getAllTasks = DB::table('tasks')
    ->select('id','name','description','due_at','user_id')




    ->get();// retorna tudo em array
    // dd($getAllTasks); //confirma que valores estamos a receber

    // return view('tasks.all_tasks'); // 'nome_da_pasta.nome_do_ficheiro'
        return view('tasks.all_tasks', compact('tasksWDB','getAllTasks'));
}




// public  function addUsers() {
// // $usersWDB=$this


//     return view('tasks.all_tasks'); // 'nome_da_pasta.nome_do_ficheiro'
// }




// valores para testes
    private function loadTasksWDB()
    {
        $tasksWithoutDB = [
            ['id'=>2, 'name' => 'Dormir', 'user_id' => '2'],
            ['id'=>3, 'name' => 'Jogar', 'user_id' => '1'],
            ['id'=>4, 'name' => 'Programar', 'user_id' => '3']
        ];

        return $tasksWithoutDB;
    }







protected function getAllTasks(){
//   $getAllTasks = DB::table('tasks')
//   $getAllTa = DB::table('tasks')
    $tasks = Task::join('users', 'tasks.user_id', 'users.id')
//         ->join('users', 'tasks.user_id', 'users.id')
        ->select('tasks.id', 'tasks.due_at', 'tasks.status', 'tasks.name','users.name as user_name')
        ->get();// retorna tudo em array

return $tasks;
}






 public function editTasks(int $id){
        // $taskInfo = Task::where('id', $id)->select('id','name','confirmed', 'due_at', 'user_id')->first();


                $taskInfo = Task::join('users', 'tasks.user_id','=' ,'users.id')->where('tasks.id', $id)->select('tasks.id', 'tasks.description','tasks.due_at', 'tasks.confirmed', 'tasks.name','users.name as user_name')->first();


        // dd( $taskInfo);

        return view('tasks.edittasks', compact('taskInfo'));
    }



    public function deletetasks(int $id){

    // exemplo: posso fazer um pedaço de codigo que por exemplo atribui a tarefa a apagar a outro user

        Task::where('id',$id)->delete(); //apaga tarefas do user a apagar
        return back();
    }



    //meu errado???
// public  function addTasks() {
// $usersWDB=$this
//         $tasksWDB = $this->loadTasksWDB();
//         return view('tasks.addtasks', compact('tasksWDB'));
// }



    public function addTasks()
    {
        $users = $this->getAllUsers();
        return view('tasks.addtasks', compact('users'));
    }





    private function getAllUsers(){
        $users = User::select('id','name')->get();
        return $users;
    }





   public function storeTasks(Request $request){
        // dd($request->all()); //testa receber dados no backend, para ver a info que esta a ser recebida

        //validar os dados no servidor
$request->validate([
    'name'        => 'required|string|max:50',
    'description' => 'required|max:500',
    'user_id'     => 'required|integer|exists:users,id',
]);






    //depois de validados, inserir na bd
    //coluna BD => nome recebido no site
Task::insert([
    'name'        => $request->name,
    'description' => $request->description,
    'user_id'     => $request->user_id,
]);
      return redirect()->route('tasks.all')->with('message', 'tarefa adicionada com sucesso!');

    }





}


