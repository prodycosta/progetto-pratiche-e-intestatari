<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allegato;
use App\Models\Pratica;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AllegatoController extends Controller
{
    public function index(Request $request)
    {
        $praticaId = $request->input('id_pratica');
        $pratica = null;
        $allegati = [];

        if ($praticaId) {
            $pratica = Pratica::find($praticaId);

            if ($pratica) {

                $allegati = $pratica->allegati;
            }
        }

        $data = [
            'praticaId' => $praticaId,
            'pratica' => $pratica,
            'allegati' => $allegati,
        ];
        return view('pages.allegati', $data);
    }
    public function upload(Request $request, $id_pratica)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,png,jpg|max:2048',
            'NomeFile' => 'required',
            'id_pratica' => 'required|exists:pratiche,id',
        ]);
        $allegato = new Allegato;
        $allegato->id_pratica = $id_pratica;
        $nuovoNomeFile = $request->NomeFile . '_' . time();
        $allegato->file = $request->file('file')->storeAs('allegati', $nuovoNomeFile);
        $allegato->NomeFile = $request->NomeFile;
        $path = $request->file('file')->getRealPath();
        $fileContents = file_get_contents($path);
        $base64File = base64_encode($fileContents);
        $allegato->file = $base64File;
        $allegato->save();
        return response()->json(['success' => true, 'redirectUrl' => route('pages.index', ['id_pratica' => $id_pratica])]);
    }

    public function visualizza($id_allegato)
    {
        $allegato = Allegato::find($id_allegato);

        if (!$allegato) {
            return back()->with('error', 'Allegato non trovato');
        }
        $fileContents = base64_decode($allegato->File);
        $infoPercorso = pathinfo($allegato->NomeFile);
        $nuovoNomeFile = $infoPercorso['filename'] . '.png';
        $headers = [
            'Content-Type' => 'application/png',
            'Content-Disposition' => 'inline; filename="' . $nuovoNomeFile . '"',
        ];
        return response($fileContents, 200, $headers);
    }

    public function eliminaAllegato($id_allegato)
    {
        $allegato = Allegato::find($id_allegato);

        if (!$allegato) {
            return back()->with('error', 'Allegato non trovato');
        }
        if ($allegato->file) {

            Storage::delete($allegato->file);
        }
        $allegato->delete();
        return back()->with('success', 'Allegato eliminato con successo');
    }
}
