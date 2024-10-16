<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utente;
use Illuminate\Support\Facades\DB;

class UtenteController extends Controller
{
    public function index()
    {
        $utenti = Utente::all();
        return view('pages.tabella-utenti', ['utenti' => $utenti]);
    }
    public function store(Request $request)
    {
        $validator = $request->validate([
            'nome' => 'required|string',
            'cognome' => 'required|string',
            'username' => 'required|string|unique:utenti',
            'password' => 'required|string',
            'email' => 'required|email|unique:utenti',
        ]);
        $utente = Utente::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'data_creazione' => now(),
            'ruolo' => $request->ruolo ?? 2,
        ]);
        return response()->json(['message' => 'Utente registrato con successo'], 201);
    }

    public function update(Request $request, Utente $utente)
    {
        $validatedData = $request->validate([
            'nome' => 'nullable|string',
            'cognome' => 'nullable|string',
            'username' => 'nullable|string',
            'email' => 'nullable|email',
            'ruolo' => 'integer',
        ]);
        $utente->update($validatedData);
        return redirect()->route('pages.tabella-utenti')->with('success', 'Utente modificato con successo');
    }

    public function eliminaUtente($id)
    {
        DB::beginTransaction();

        try {
            Utente::destroy($id);
            DB::commit();

            return redirect()->route('pages.tabella-utenti')->with('success', 'Utente eliminato con successo.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('pages.tabella-utenti')->with('error', 'Impossibile eliminare l\'utente.');
        }
    }

    public function mostraFormModifica($id)
    {
        $utenti = Utente::all();
        $utente = Utente::find($id);
        return view('pages.tabella-utenti', compact('utente', 'utenti'));
    }

    public function modificaUtente(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string',
            'cognome' => 'required|string',
            'username' => 'required|string|unique:utenti,username,' . $id,
            'email' => 'required|email|unique:utenti,email,' . $id,
            'ruolo' => 'integer',
        ]);
        $utente = Utente::find($id);

        if (!$utente) {
            return redirect()->route('pages.tabella-utenti')->with('error', 'Utente non trovato');
        }
        $utente->update($request->all());
        return redirect()->route('pages.tabella-utenti')->with('success', 'Utente modificato con successo');
    }
    public function getUtenteData($id)
    {
        $utente = Utente::find($id);

        if (!$utente) {
            return response()->json(['error' => 'Utente non trovato'], 404);
        }
        return response()->json($utente->toArray());
    }
}
