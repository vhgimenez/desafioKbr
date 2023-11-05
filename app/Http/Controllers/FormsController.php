<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Form;

class FormsController extends Controller
{
    public function index() {
        $name = request('name');
        $pet = request('pet');
        $date = request('created_at');

        $forms = Form::query();

        if (!empty($name)) {
            $forms->where('name', 'like', '%'.$name.'%');
        }

        if (!empty($pet)) {
            $forms->where('pet', 'like', '%'.$pet.'%');
        }

        if (!empty($date)) {
            $date = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            $forms->whereDate('created_at', '=', $date);
        }

        $forms = $forms->paginate(3);
        return view('admin.forms.painel')->with(['forms' => $forms, 'name' => $name, 'pet', $pet]);
    }

    public function destroy($id) {
        $form = Form::findOrFail($id);
        $form->delete();
        return redirect()->route('admin.forms.index')->with('message', 'Formulário excluído com sucesso!');
    }

    public function downloadCsv(Request $request) {
        $name = $request->input('name');
        $pet = $request->input('pet');
        $date = $request->input('created_at');

        $query = Form::query();

        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($pet)) {
            $query->where('pet', 'like', '%' . $pet . '%');
        }

        if (!empty($date)) {
            $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            $query->whereDate('created_at', '=', $date);
        }

        $forms = $query->get();

        $csvFileName = 'dados.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => 'attachment; filename="' . $csvFileName . '"',
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ["Nome", "Pet", "Data de Criação"]);

        foreach ($forms as $form) {
            fputcsv($handle, [
                $form->name,
                $form->pet,
                $form->created_at,
            ]);
        }

        fclose($handle);

        return response()
            ->stream(
                function () use ($handle) {
                    fclose($handle);
                },
                200,
                $headers
            );
    }

    public function downloadPdf(Request $request) {
        $name = $request->input('name');
        $pet = $request->input('pet');
        $date = $request->input('created_at');

        $query = Form::query();

        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($pet)) {
            $query->where('pet', 'like', '%' . $pet . '%');
        }

        if (!empty($date)) {
            $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            $query->whereDate('created_at', '=', $date);
        }

        $forms = $query->get();

        $pdf = PDF::loadView('admin.forms.pdf', ['forms' => $forms]);

        return $pdf->download('dados.pdf');
    }

}