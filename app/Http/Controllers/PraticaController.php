<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pratica;
use App\Models\Utente;
use App\Models\Intestatari;
use Illuminate\Support\Facades\Auth;
use App\Models\StatoPratica;
use App\Models\Allegato;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class PraticaController extends Controller
{
    public function index()
    {
        $pratiche = Pratica::all();
        return view('pages.pratiche', compact('pratiche'));
    }

    public function pratica()
    {
        $utente = Auth::user();
        $intestatari = $utente->intestatari;
        return view('pages.pratica', compact('intestatari'));
    }
    public function store(Request $request)
    {
        $request->merge(['id_utente' => Auth::id(), 'id_stato' => 1]);

        $idIntestatari = $request->input('id_intestatari');
        $request->request->add(['id_utente' =>  Auth::id()]);
        $validatedData = $request->validate([
            'cap' => 'required|string',
            'indirizzo' => 'required|string',
            'numero_civico' => 'required|string',
            'provincia' => 'required|string',
            'comune' => 'required|string',
            'anni_contratto' => 'required|integer',
            'id_utente' => 'required|exists:utenti,id',
            'id_stato' => 'required|exists:stato_pratica,id',
            'id_intestatari' => 'array',
        ]);
        $validatedData['id_intestatari'] = json_encode($request->input('id_intestatari'));
        $pratica = Pratica::create($validatedData);
        $praticaId = $pratica->id;
        return redirect()->route('pages.allegati', ['id_pratica' => $praticaId])->with('success', 'Pratica aggiunta con successo');
    }

    public function tables()
    {
        $utente = Auth::user();
        $intestatari = $utente->intestatari;
        $datiTabella = Pratica::all();
        return view('pages.tables', ['datiTabella' => $datiTabella, 'intestatari' => $intestatari]);
    }
    public function update(Request $request, Pratica $pratica)
    {

        $validatedData = $request->validate([
            'cap' => 'nullable|string',
            'indirizzo' => 'nullable|string',
            'numero_civico' => 'nullable|string',
            'provincia' => 'nullable|string',
            'comune' => 'nullable|string',
            'anni_contratto' => 'nullable|integer',
            'id_utente' => 'nullable|exists:utenti,id',
            'id_stato' => 'nullable|exists:stato_pratica,id',
            'id_intestatari' => 'array',

        ]);
        $pratica->update($validatedData);
        return redirect()->route('pages.tabella-pratiche')->with('success', 'Pratica aggiornata con successo');
    }

    public function eliminaPratica($id)
    {
        DB::beginTransaction();
        try {
            $pratica = Pratica::findOrFail($id);
            $pratica->allegati()->delete();
            $pratica->delete();
            DB::commit();

            return redirect()->route('pages.tabella-pratiche')->with('success', 'Pratica eliminata con successo');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('pages.tabella-pratiche')->with('error', 'Impossibile eliminare la pratica');
        }
    }

    public function mostraFormModifica($id)
    {
        $pratica = Pratica::find($id);
        $intestatari = Intestatari::all();
        $pratiche = Pratica::all();
        return view('pages.modifica-pratica', compact('pratica', 'intestatari', 'pratiche'));
    }

    public function modificaPratica(Request $request, $id)
    {

        $request->validate([
            'cap' => 'nullable|string',
            'indirizzo' => 'nullable|string',
            'numero_civico' => 'nullable|string',
            'provincia' => 'nullable|string',
            'comune' => 'nullable|string',
            'anni_contratto' => 'nullable|integer',
            'id_utente' => 'nullable|exists:utenti,id',
            'id_stato' => 'nullable|exists:stato_pratica,id',
            'id_intestatari' => 'array',

        ]);
        $pratica = Pratica::find($id);

        if (!$pratica) {
            return redirect()->route('pages.tabella-pratiche')->with('error', 'Pratica non trovata');
        }
        $pratica->update($request->all());

        return redirect()->route('pages.tabella-pratiche')->with('success', 'Pratica modificata con successo');
    }

    public function getPraticaData($id)
    {
        $pratica = Pratica::find($id);

        if (!$pratica) {
            return response()->json(['error' => 'Pratica non trovata'], 404);
        }
        return response()->json($pratica->toArray());
    }
}
