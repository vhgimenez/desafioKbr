<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormsRequest;
use App\Models\Pet;
use App\Models\Form;

class AdoptionsController extends Controller
{
    public function index() {
        return view('index');
    }

    public function adoption() {
        $specie = request('specie');
        $breed = request('breed');
        $size = request('size');
        $local = request('local');
        $gender = request('gender');

        $pets = Pet::query();

        if (!empty($specie)) {
            $pets->where('specie', $specie);
        }

        if (!empty($breed)) {
            $pets->where('breed', $breed);
        }

        if (!empty($size)) {
            $pets->where('size', $size);
        }

        if (!empty($local)) {
            $pets->where('local', 'like', '%'.$local.'%');
        }

        if (!empty($gender)) {
            $pets->where('gender', $gender);
        }    

        $pets = $pets->where('status', 'ativado')
        ->orderBy('created_at', 'desc') 
        ->paginate(8);
        return view('adotar')->with(['pets' => $pets, 'local' => $local]);
    }

    public function details($id, $name) {
        $pet = Pet::where('id', $id)->where('name', $name)->first();
    
        if ($pet) {
            return view('integra')->with(['pet' => $pet]);
        } else {
            return redirect()->route('adoption')->with('error', 'Pet não encontrado.');
        }
    }

    public function form($name) {
        return view('form', ['name' => $name]);
    }

    public function store(FormsRequest $request) {


        $data = $request->except('_token');
        $data = Form::create($data);

        return redirect()->route('adoption')->with('message', 'Solicitação enviada com sucesso!');
    }
}
