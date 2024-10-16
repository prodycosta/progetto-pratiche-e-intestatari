<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utente;
use App\Models\Intestatari;
use App\Models\Pratica;
use App\Models\Allegato;
use App\Models\StatoPratica;
use Illuminate\Support\Facades\Auth;
use App\Models\Ruolo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $utente = Auth::user();
        $intestatari = $utente->intestatari;
        $datiTabella = Pratica::with('intestatari')
            ->where('id_utente', $utente->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.index', compact('datiTabella', 'intestatari'));
    }
    public function blank()
    {
        return view('pages.blank');
    }
    public function pratica()
    {
        return view('pages.pratica');
    }
    public function cards()
    {
        return view('pages.intestatari');
    }
    public function charts()
    {
        return view('pages.charts');
    }
    public function forgotPassword()
    {
        return view('pages.forgot-password');
    }
    public function login()
    {
        return view('pages.login');
    }
    public function register()
    {
        return view('pages.register');
    }

    public function tables(Request $request)
    {
        $utente = Auth::user();
        $intestatari = $utente->intestatari;
        $datiTabella = Pratica::with('intestatari')
            ->where('id_utente', $utente->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.tables', compact('datiTabella', 'intestatari'));
    }

    public function tabellaIntestatari()
    {
        $intestatari = Intestatari::orderBy('created_at', 'desc')->get();
        return view('pages.tabella-intestatari', ['intestatari' => $intestatari]);
    }

    public function tabellaUtenti(Request $request)
    {
        $utentiQuery = Utente::join('ruoli', 'utenti.ruolo', '=', 'ruoli.id')
            ->select('utenti.*', 'ruoli.nome as nome_ruolo');
        if ($request->has('search')) {
            $search = $request->input('search');
            $utentiQuery->where('utenti.username', 'like', "%$search%");
        }


        $utenti = $utentiQuery->orderBy('utenti.created_at', 'desc')->get();

        foreach ($utenti as $utente) {

            $nomeRuolo = is_int($utente->ruolo) ? $utente->nome_ruolo : $utente->ruolo->nome;
            $utente->nome_ruolo = $nomeRuolo;
        }

        return view('pages.tabella-utenti', ['utenti' => $utenti]);
    }



    public function tabellaPratiche()
    {
        $pratiche = Pratica::with(['utente', 'intestatari', 'statoPratica'])
            ->latest('created_at')
            ->get();

        return view('pages.tabella-pratiche', ['pratiche' => $pratiche]);
    }
    public function notFound()
    {
        return view('pages.404');
    }

    public function allegati()
    {
        return view('pages.allegati');
    }

    public function visualizzaCard($id_pratica)
    {

        $intestatari = Intestatari::all();
        $pratica = Pratica::find($id_pratica);

        if (!$pratica) {
            return back()->with('error', 'Pratica non trovata');
        }

        if (Auth::user()->id !== $pratica->id_utente) {
            return back()->with('error', 'Non hai il permesso di visualizzare questa pratica');
        }

        $pratica->load('intestatari');

        $allegati = $pratica->allegati;
        return view('pages.card', compact('pratica', 'allegati', 'intestatari'));
    }

    public function eliminaRiga($id)
    {
        $pratica = Pratica::find($id);
        if ($pratica && $pratica->id_utente == auth()->user()->id) {

            DB::beginTransaction();

            try {
                $pratica->allegati()->delete();
                $pratica->delete();
                DB::commit();
                return redirect()->route('pages.index')->with('success', 'Pratica eliminata con successo');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('pages.index')->with('error', 'Impossibile eliminare la pratica');
            }
        } else {

            return redirect()->route('pages.index')->with('error', 'Impossibile eliminare la pratica');
        }
    }


    public function deleteRow($id)
    {
        $pratica = Pratica::find($id);
        if ($pratica && $pratica->id_utente == auth()->user()->id) {
            DB::beginTransaction();
            try {
                $pratica->allegati()->delete();
                $pratica->delete();
                DB::commit();
                return redirect()->route('pages.index')->with('success', 'Pratica eliminata con successo');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('pages.index')->with('error', 'Impossibile eliminare la pratica');
            }
        } else {

            return redirect()->route('pages.index')->with('error', 'Impossibile eliminare la pratica');
        }
    }


    public function mostraConfermaEliminazione()
    {
        return view('pages.mostra-conferma-eliminazione');
    }

    public function eliminaPratica($id)
    {
        $pratica = Pratica::find($id);

        if (!$pratica) {
            return redirect()->route('pages.index')->with('error', 'Pratica non trovata');
        }

        $pratica->allegati()->delete();

        $pratica->delete();

        return redirect()->route('pages.index')->with('success', 'Pratica e allegati associati eliminati con successo');
    }

    public function eliminaAccount()
    {
        $utente = Auth::user();

        if (Hash::check(request('password'), $utente->password)) {

            $utente->pratiche->each(function ($pratica) {
                $pratica->allegati->each->delete();
            });
            $utente->pratiche->each->delete();

            $utente->intestatari->each->delete();
            Utente::destroy($utente->id);
            Auth::logout();

            return redirect()->route('pages.register')->with('success', 'Account e dati associati eliminati con successo.');
        } else {
            return redirect()->back()->with('error', 'La password non è corretta.');
        }
    }
}
