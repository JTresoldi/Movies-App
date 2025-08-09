<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieList;
use App\Models\MovieListItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ListController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public function index()
    {
        $lists = Auth::user()->movieLists;
        return view('listas.index', compact('lists'));
    }

    public function create()
    {
        return view('listas.create');
    }

    //Salvar nova lista
     public function store(Request $req)
    {
        $data = $req->validate([
            'name' => 'required|string|max:255',
            'is_public' => 'nullable|boolean',
        ]);

        // via relação
        Auth::user()->movieLists()->create([
            'name'      => $data['name'],
            'is_public' => $req->boolean('is_public'),
        ]);

        return redirect()->route('listas.index');
    }
    
    //Mostrar lista do dono
    public function show(MovieList $lista)
    {
        $this->authorize('view', $lista);

        $key = config('services.tmdb.key');
        $lang = config('services.tmdb.language', 'pt-BR');
        
        $filmes = [];
        foreach ($lista->items()->pluck('movie_id') as $id) {
            $resp = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
                'api_key' => $key,
                'language' => $lang,
            ]);
            if ($resp->successful()) {
                $filmes[] = $resp->json();
            }
        }
        
        return view('listas.show', compact('lista', 'filmes'));
    }

    //Delete lista
    public function destroy(MovieList $lista)
    {
        $this->authorize('delete', $lista);
        $lista->delete();
        
        return redirect()->route('listas.index');
    }

    //Add filme
    public function addMovie(Request $req, MovieList $lista)
    {
        $this->authorize('update', $lista);
        $req->validate((['movie_id'=>'required|integer']));

        if (! $lista->items()->where('movie_id', $req->movie_id)->exists()) {
            $lista->items()->create(['movie_id' => $req->movie_id]);
        }

        return back()->with('ok', 'Filme adicionado à lista.');
    }

    //Remover filme
    public function removeMovie(MovieList $lista, $movieId)
    {
        $this->authorize('update', $lista);
        $lista->items()->where('movie_id', $movieId)->delete();

        return back();
    }

    //Listas publicas
    public function publicIndex()
    {
        $lists = MovieList::where('is_public', true)->get();
        return view('listas.public.index', compact('lists'));
    }

    //Mostrar lista publica
    public function publicShow(MovieList $lista)
    {
        if (! $lista->is_public) abort(403);

        $key = config('services.tmdb.key');
        $lang = config('services.tmdb.language', 'pt-BR');

        $filmes = [];
        foreach ($lista->items()->pluck('movie_id') as $id) {
            $resp = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
                'api_key'  => $key,
                'language' => $lang,
            ]);
            if ($resp->successful()) {
                $filmes[] = $resp->json();
            }
    }

    return view('listas.public.show', compact('lista','filmes'));
    }
}
