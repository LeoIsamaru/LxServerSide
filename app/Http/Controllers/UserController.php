<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

public function allUsers() {  //nome de função que nos damos
    $usersWDB = $this->loadUsersWDB();

    // $usersFromDB = DB::table('users')
    $usersFromDB = User::select('id','name','address','email','nif')

    // ->where('name','Leo')
    // ->select('id','name','address','email','nif')
    // ->where('id',3)
    // ->whereNotNull('updated_at')
    ->get();// retorna tudo em array

    // ->first();//retorna o apenas o primeiro resultado, sem formatação
    // ->last();//retorna o apenas o ultimo resultado, sem formatação
    // dd($usersFromDB); //confirma que valores estamos a receber

    // return view('users.allusers'); // 'nome_da_pasta.nome_do_ficheiro'
        return view('users.allusers', compact('usersWDB','usersFromDB'));
}



public  function addUsers() {
// $usersWDB=$this
        $usersWDB = $this->loadUsersWDB();
        return view('users.addusers', compact('usersWDB'));
    // return view('users.addusers'); // 'nome_da_pasta.nome_do_ficheiro'
}




    public function deleteUsers(int $id){

    // exemplo: posso fazer um pedaço de codigo que por exemplo atribui a tarefa a apagar a outro user

        Task::where('user_id',$id)->delete(); //apaga tarefas do user a apagar
        User::where('id', $id)->delete(); //apagar o user
        return back();
    }



 public function editUsers(int $id){
        $userInfo = User::where('id', $id)->select('name','email', 'id', 'address','nif')->first();

        // dd( $userInfo);

        return view('users.edituser', compact('userInfo'));
    }




   public function storeUser(Request $request){
        // dd($request->all()); //testa receber dados no backend, para ver a info que esta a ser recebida

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password'=> 'min:8|required'
        ]);






    //depois de validados, inserir na bd
        User::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

      return redirect()->route('users.all')->with('message', 'utilizador adicionado com sucesso!');

    }








    private function loadUsersWDB()
    {
        $usersWithoutDB = [
            ['id'=>1, 'name' => 'Sara', 'email' => 'sara@gmail.com'],
            ['id'=>2, 'name' => 'Bruno', 'email' => 'Bruno@gmail.com'],
            ['id'=>3, 'name' => 'Marco', 'email' => 'Marco@gmail.com'],
            ['id'=>4, 'name' => 'António', 'email' => 'António@gmail.com']
        ];

        return $usersWithoutDB;
    }






public function  updateUSer(Request $request){

        $request->validate([
            'name' =>'required|max:50'
        ]);

        User::where('id', $request->id)->update([
            'name'=> $request->name,
            'address'=> $request->address,
            'nif'=> $request->nif,
        ]);

        return redirect()->route('users.all')->with('message', 'user actualizado com sucesso!');

}









}
