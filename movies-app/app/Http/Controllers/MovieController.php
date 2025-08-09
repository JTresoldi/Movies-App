<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $key = config('services.tmdb.key');
        $lang = config('services.tmdb.language', 'pt-BR');

        //Filmes populares
        $response = Http::get("https://api.themoviedb.org/3/movie/popular", [
            'api_key' => $key,
            'language' => $lang,
            'page' => 1,
        ]);

        if ($response->successful()) {
            $filmes = $response->json()['results'];
        } else {
            $filmes = [];
            dd($response->json()); //Debuga a resposta da API
        }

        $gResp = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => $key,
            'language' => $lang,
        ]);

        $genres = $gResp ->json()['genres'] ?? [];

        return view('home', compact('filmes', 'genres'));
    }

    public function show($id)
    {
        $key = config('services.tmdb.key');
        $lang = config('services.tmdb.language', 'pt-BR');

        $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
            'api_key' => $key,
            'language' => $lang,
        ]);

        $filme = $response->json();

        $minhasListas = Auth::check()
            ? Auth::user()->movieLists()->select('id', 'name')->get()
            : collect();

        return view('detalhes', compact('filme','minhasListas'));
    }

    public function buscar()
    {
        $key = config('services.tmdb.key');
        $lang = config('services.tmdb.language', 'pt-BR');
        
        $q = trim((string) request('q'));
        $genero = trim((string) request('genero'));

        //carregar os generos para o select
        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => $key,
            'language' => $lang,
        ])->json()['genres'] ?? [];

        $filmes = [];

        if ($genero !== '' && $q === '') {
            //so genero -> discover
            $resp = Http::get('https://api.themoviedb.org/3/discover/movie', [
                'api_key' => $key,
                'language' => $lang,
                'with_genres' => $genero,
                'sort_by' => 'popularity.desc',
                'page' => 1,
            ]);

            $filmes = $resp->json()['results'] ?? [];
            
        } else {
            //com ou sem genero -> search
            $resp = Http::get('https://api.themoviedb.org/3/search/movie', [
                'api_key' => $key,
                'language' => $lang,
                'query' => $q,
                'page' => 1,
            ]);

            $filmes = $resp->json()['results'] ?? [];

            if ($genero !== '') {
                $gid = (int) $genero;
                $filmes = array_values(array_filter($filmes, fn($f) => in_array($gid, $f['genre_ids'] ?? [])));
            }
        }

        return view('buscar', [
            'filmes' => $filmes, 
            'query' => $q,
            'genero' => $genero,
            'genres' => $genres,
        ]);
    }

}
