<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intestatari;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IntestatariController extends Controller
{
    public function index()
    {
        $intestatari = Intestatari::all();
        return view('pages.intestatari', compact('intestatari'));
    }
    public function store(Request $request)
    {
        $request->request->add(['id_utente' =>  Auth::id()]);
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'cognome' => 'required|string',
            'cap' => 'required|string',
            'indirizzo' => 'required|string',
            'numero_civico' => 'required|string',
            'comune' => 'required|string',
            'provincia' => 'required|string',
            'numero_documento' => 'required|string',
            'scadenza_documento' => 'required|date',
            'codice_fiscale' => 'required|string',
            'data_nascita' => 'required|date',
            'numero_telefono' => 'required|string',
            'id_utente' => 'exists:utenti,id|integer',
        ]);

        Intestatari::create($validatedData);

        return redirect()
            ->route('pages.intestatari')
            ->with('success', 'Intestatario aggiunto con successo!')
            ->with('alert', 'success');
    }



    public function update(Request $request, Intestatari $intestatario)
    {
        $validatedData = $request->validate([
            'nome' => 'nullable|string',
            'cognome' => 'nullable|string',
            'cap' => 'nullable|string',
            'indirizzo' => 'nullable|string',
            'numero_civico' => 'nullable|string',
            'comune' => 'nullable|string',
            'provincia' => 'nullable|string',
            'numero_documento' => 'nullable|string',
            'scadenza_documento' => 'nullable|date',
            'codice_fiscale' => 'nullable|string',
            'data_nascita' => 'nullable|date',
            'numero_telefono' => 'nullable|string',
            'id_utente' => 'exists:utenti,id|integer',
        ]);
        $intestatario->update($validatedData);
        return redirect()->route('pages.tabella-intestatari')->with('success', 'Intestatario aggiornato con successo');
    }

    public function eliminaIntestatari($id)
    {
        DB::beginTransaction();
        try {
            Intestatari::destroy($id);
            DB::commit();

            return redirect()->route('pages.tabella-intestatari')->with('success', 'Intestatario eliminato con successo.');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('pages.tabella-intestatari')->with('error', 'Impossibile eliminare l\'intestatario.');
        }
    }

    public function mostraFormModifica($id)
    {
        $intestatari = Intestatari::all();
        $intestatario = Intestatari::find($id);

        if (!$intestatario) {

            return redirect()->route('pages.tabella-intestatari')->with('error', 'Intestatario non trovato');
        }
        return view('pages.tabella-intestatari', compact('intestatario', 'intestatari'));
    }

    public function modificaIntestatario(Request $request, $id)
    {
        $request->validate([
            'nome' => 'nullable|string',
            'cognome' => 'nullable|string',
            'cap' => 'nullable|string',
            'indirizzo' => 'nullable|string',
            'numero_civico' => 'nullable|string',
            'comune' => 'nullable|string',
            'provincia' => 'nullable|string',
            'numero_documento' => 'nullable|string',
            'scadenza_documento' => 'nullable|date',
            'codice_fiscale' => 'nullable|string',
            'data_nascita' => 'nullable|date',
            'numero_telefono' => 'nullable|string',
            'id_utente' => 'exists:utenti,id|integer',
        ]);
        $intestatario = Intestatari::find($id);
        if (!$intestatario) {

            return redirect()->route('pages.tabella-intestatari')->with('error', 'Intestatario non trovato');
        }
        $intestatario->update($request->all());
        return redirect()->route('pages.tabella-intestatari')->with('success', 'Intestatario modificato con successo');
    }

    public function getDataForEdit($id)
    {
        $intestatario = Intestatari::find($id);

        if (!$intestatario) {
            return response()->json(['error' => 'Intestatario non trovato'], 404);
        }
        return response()->json($intestatario->toArray());
    }
}
