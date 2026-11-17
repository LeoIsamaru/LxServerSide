<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilController;
use Illuminate\Support\Facades\Route;


// URL alvo
Route::get('/', [UtilController::class, 'loadWelcome'])->name('welcome');


Route::get('/teste', function () {
    return view('welcome');
});


// Route::get('/hello', function () {
//     return '<h1>Hello</h1>';
// });


// rotas com parametros
Route::get('/hello/{message}', function ($message) {
    return '<h1>Hello '.$message.'</h1>';
});



//rota de homepage
 Route::get('/homepage',[UtilController::class, 'loadHomepage'])->name('home');


// URL alvo
Route::get('/', function () {   //caminho do browser
    return view('welcome'); //nome do ficheiro nas views
})->name('welcome'); //nome que quisermos dar ha rota, para garantir que é chamada a correta. apenas usado para programação


###########################################

// URL alvo
// Route::get('/users', function () {
//     return view('users.allusers'); // 'nome_da_pasta.nome_do_ficheiro'
// })->name('users.all');
// versão updated:
Route::get('/users', [UserController::class, 'allUsers'])->name('users.all');


// exercicio pag 20 add users
// Route::get('/addusers', function () {
//     return view('users.addusers'); // 'nome_da_pasta.nome_do_ficheiro'
// })->name('users.add');
// versão updated:
Route::get('/addusers', [UserController::class, 'addUsers' ])->name('users.add');




//rota fallback do exercicio pagina 20
Route::fallback(function(){
    return view('users.fallbackusers');
});









//rota de apagar users
 Route::get('/delete-users/{id}',[UserController::class, 'deleteUsers'])->name('users.delete');




//rota de ver / editar users
 Route::get('/edit-users/{id}',[UserController::class, 'editUsers'])->name('users.edit');




//rota de registar users
Route::post('/store-users', [UserController::class, 'storeUser'])->name('users.store');


//rota de update users
Route::put('/update-user', [UserController::class, 'updateUser'])->name('users.update');

###########################################





//rota exercicio Tasks (pag 49 SDBE_MVC.pdf)
 Route::get('/tasks',[TasksController::class, 'allTasks'])->name('tasks.all');




//rota de ver / editar tasks
 Route::get('/edit-tasks/{id}',[TasksController::class, 'editTasks'])->name('tasks.edit');



//rota de apagar tasks
 Route::get('/delete-tasks/{id}',[TasksController::class, 'deleteTasks'])->name('tasks.delete');



//rota de registar tarefas
Route::post('/store-tasks', [TasksController::class, 'storeTasks'])->name('tasks.store');


//rota de adicionar tarefas
Route::get('/addtasks', [TasksController::class, 'addTasks' ])->name('tasks.add');








//=================================== Tarefa Intermedia Laravel ===================================
//=================================== Prendas de Natal ===================================


//rota gifts
Route::get('/gifts',[GiftController::class, 'allGifts'])->name('gifts.all');


//rota de ver / editar gifts
Route::get('/edit-gifts/{id}',[GiftController::class, 'editGifts'])->name('gifts.edit');


//rota de apagar gifts
Route::get('/delete-gifts/{id}',[GiftController::class, 'deleteGifts'])->name('gifts.delete');


//rota de registar gifts
Route::post('/store-gifts', [GiftController::class, 'storeGifts'])->name('gifts.store');


//rota de adicionar gifts
Route::get('/addgifts', [GiftController::class, 'addGifts' ])->name('gifts.add');


//rota de atualizar gifts
Route::put('/updategifts', [GiftController::class, 'updateGifts'])->name('gifts.update');

//===================================================================================================



//rota fallback - usar sempre no fim de modo a garantir que passa por todos os outros links antes de entrar
Route::fallback(function(){
    return '<h1>Esta rota não existe</h1>';
});

