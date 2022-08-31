<?php

namespace App\Http\Controllers\Search;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class SearchPostsController extends Controller
{
    public function __invoke(Request $request) : View
    {
        $request->validate([
            'q' => ['required', 'string', 'min:3'],
        ], [
            'q.required' => "Vous n'avez rien saisi pour le moment.",
            'q.min' => 'Votre requête doit contenir au moins 3 caractères.',
        ]);

        return view('search.posts', [
            'posts' => Post::search($request->q)
                ->query(function (Builder $query) {
                    $query->withUsername();
                })
                ->get(),
            'q' => $request->q,
        ]);
    }
}
