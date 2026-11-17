<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{

    public function loadWelcome() { //nome de função que nos damos
    return view('welcome'); //'nome_da_pasta.nome_do_ficheiro'
    }



    public function loadHomepage() {


//dados que no futuro estarão definidos no controller e vem da base de dados
    $courseName = 'SD'; //se nao estiver declarado vai dar erro total na pagina


  //simulo que vou à base de dados e trago a lista de alunos
    $students = ['Licínia', 'Raquel', 'João', 'Leonel'];


        //array associativo
        //dados que serão carregados da base de dados
        $contactInfo = [
            'name' => 'Bruno',
            'contact' => 'Bruno@cesae.pt'
        ];

        //dd (dump and die) -mostra as infos do bruno como array na pag, e mata a pagina
    // dd($contactInfo);

    // var_dump($contactInfo); //-mostra as infos do bruno como array na pag, e continua a pagina



        $cesaeInfo = ['name'=> 'Cesae','address' => 'Rua do cesae', 'email' =>'cesae@cesae.pt'];



    return view('home',compact('courseName','students','contactInfo','cesaeInfo'));
    }




}
