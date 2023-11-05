<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index() {

        $name = request('name');
        $status = request('status');
        $de = request('de');
        $ate = request('ate');

        $users = User::query();

        if (!empty($name)) {
            $users->where('name', 'like', '%'.$name.'%');
        }

        if (!empty($status)) {
            $users->where('status', $status);
        }

        if (!empty($de) && !empty($ate)) {
            $deDate = Carbon::createFromFormat('d/m/Y', $de);
            $ateDate = Carbon::createFromFormat('d/m/Y', $ate);

            $users->whereBetween('created_at', [$deDate->startOfDay(), $ateDate->endOfDay()]);
        }

        $users = $users->paginate(3);

        return view('admin.painel')->with(['users' => $users, 'name' => $name]);
    }

    public function create() {
        return view('admin.cadastrar');
    }

    public function store(UserRequest $request) {
        $data = $request->except('_token');

        $return = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('admin.index')->with('message', 'Usuário cadastrado com sucesso!');
    }

    public function edit(int $id) {
        $user = User::findOrFail($id);

        return view('admin.editar')->with('user', $user);
    }

    public function update(int $id, Request $request) {
        $data = $request->except(['_token', '_method']);
        $user = User::findOrFail($id);
        $user->update($data);
        return redirect()->route('admin.index')->with('message', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.index')->with('message', 'Usuário excluído com sucesso!');
    }
}
