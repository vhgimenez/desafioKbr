<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Http\Requests\PetRequest;
use App\Http\Requests\EditPetRequest;
use Carbon\Carbon;


class PetsController extends Controller
{
    public function index() {
        $name = request('name');
        $status = request('status');
        $de = request('de');
        $ate = request('ate');

        $pets = Pet::query();

        if (!empty($name)) {
            $pets->where('name', 'like', '%'.$name.'%');
        }

        if (!empty($status)) {
            $pets->where('status', $status);
        }

        if (!empty($de) && !empty($ate)) {
            $deDate = Carbon::createFromFormat('d/m/Y', $de);
            $ateDate = Carbon::createFromFormat('d/m/Y', $ate);

            $pets->whereBetween('created_at', [$deDate->startOfDay(), $ateDate->endOfDay()]);
        }

        $pets = $pets->paginate(3);
        return view('admin.pets.painel')->with(['pets' => $pets, 'name' => $name]);
    }

    public function create() {
        return view('admin.pets.cadastrar');
    }

    public function store(PetRequest $request) {
        $data = $request->except('_token');
    
        foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $fieldName) {
            if ($request->hasFile($fieldName) && $request->file($fieldName)->isValid()) {
                $requestImage = $request->{$fieldName};
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
                $requestImage->move(public_path('img/pets'), $imageName);
                $data[$fieldName] = $imageName;
            }
        }
    
        $return = Pet::create($data);
    
        return redirect()->route('admin.pets.index')->with('message', 'Animal cadastrado com sucesso!');
    }

    public function edit(int $id) {
        $pet = Pet::findOrFail($id);

        return view('admin.pets.editar')->with('pet', $pet);
    }

    public function update(EditPetRequest $request, $id) {
        $pet = Pet::findOrFail($id); 

        $data = $request->except('_token');

        foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $fieldName) {
            if ($request->hasFile($fieldName) && $request->file($fieldName)->isValid()) {
                $requestImage = $request->{$fieldName};
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
                $requestImage->move(public_path('img/pets'), $imageName);
                $data[$fieldName] = $imageName;
            }
        }

        $pet->update($data);

        return redirect()->route('admin.pets.index')->with('message', 'Animal atualizado com sucesso!');
    }

    public function destroy($id) {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        return redirect()->route('admin.pets.index')->with('message', 'Animal excluído com sucesso!');
    }
    
}