<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\User;
use Illuminate\Http\Request;


class GiftController extends Controller
{

// ================================================================ function allGifts ================================================================

    public function allGifts()
    {
        // $giftsWDB = $this->loadGiftsWDB();
        // $getAllGifts = DB::table('gifts') // vai buscar todos as prendas há DB table gifts

        $gifts = Gift::join('users', 'gifts.user_id', '=', 'users.id')
            ->select(
                'gifts.id',
                'gifts.gift_name',
                'gifts.estimated_price',
                'gifts.price_paid',
                'users.name as user_name'
            )
            ->orderBy('gifts.id', 'asc')
            ->get();

        return view('gifts.allgifts', compact('gifts'));
    }


// ================================================================ function loadGiftsWDB ================================================================

    // valores para testes
    private function loadGiftsWDB()
    {
        $giftsWithoutDB = [
            ['id' => 1, 'gift_name' => 'Computador', 'user_id' => 1],
            ['id' => 2, 'gift_name' => 'Consola', 'user_id' => 4],
            ['id' => 3, 'gift_name' => 'Tablet', 'user_id' => 6]
        ];

        return $giftsWithoutDB;
    }


// ================================================================ function getAllGifts ================================================================

    protected function getAllGifts()
    {
        $gifts = Gift::join('users', 'gifts.user_id', '=', 'users.id')
            ->select(
                'gifts.id', 'gifts.gift_name', 'gifts.estimated_price', 'gifts.price_paid', 'gifts.user_id', 'users.name as user_name'
            )
            ->get();  // retorna tudo em array
        return $gifts;
    }


// ================================================================ function editGifts ================================================================

    public function editGifts(int $id)
    {
        // $giftInfo = Gift::join('users', 'gifts.user_id', '=', 'users.id')
        //     ->where('gifts.id', $id)
        //     ->select(
        //         'gifts.id','gifts.gift_name','gifts.estimated_price','gifts.price_paid','gifts.user_id','users.name as user_name')->first();
        // return view('gifts.editgifts', compact('giftInfo'));

        $giftInfo = Gift::where('id', $id)->first();

        // vai buscar os users à tabela users
        $users = $this->getAllUsers();

        return view('gifts.editgifts', compact('giftInfo', 'users'));
    }



// ================================================================ function deleteGifts ================================================================

    public function deleteGifts(int $id)
    {
        Gift::where('id', $id)->delete();  // apaga as prendas do user que vai ser apagado
        return back();
    }


// ================================================================ function addGifts ================================================================

    public function addGifts()
    {
        $users = $this->getAllUsers();
        return view('gifts.addgifts', compact('users'));
    }


// ================================================================ function getAllUsers ================================================================

    private function getAllUsers()
    {
        $users = User::select('id', 'name')->get();
        return $users;
    }


// ================================================================ function storeGifts ================================================================

    public function storeGifts(Request $request)
    {
        // dd($request->all()); //testa receber dados no backend, para ver a info que esta a ser recebida

        // validar os dados no servidor
        $request->validate([
            'gift_name' => 'required|string|max:255',
            'estimated_price' => 'required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/',
            'price_paid' => 'nullable', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // insere os dados na BD
        Gift::insert([
            'gift_name' => $request->gift_name,
            'estimated_price' => $request->estimated_price,
            'price_paid' => $request->price_paid,
            'user_id' => $request->user_id,
        ]);

        return redirect()
            ->route('gifts.all')
            ->with('message', 'Prenda adicionada com sucesso!');
    }



// ================================================================ function updateGifts ================================================================

    public function updateGifts(Request $request)
    {
        $request->validate([
            'gift_name' => 'required|max:255',
            'estimated_price' => 'required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/',
            'price_paid' => 'nullable', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        Gift::where('id', $request->id)->update([
            'gift_name' => $request->gift_name,
            'estimated_price' => $request->estimated_price,
            'price_paid' => $request->price_paid,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('gifts.all')->with('message', 'Prenda atualizada com sucesso!');
    }
}
