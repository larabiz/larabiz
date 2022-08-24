<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;

class ShowSearchResultsController extends Controller
{
    public function __invoke(string $q) : View
    {
        return view('search', [
            'posts' => Post::search($q)
                ->query(function (Builder $query) {
                    $query
                        ->addSelect([
                            'username' => User::select('username')
                                ->whereColumn('id', 'posts.user_id')
                                ->limit(1),
                        ])
                        ->with('media');
                })
                ->get(),
            'q' => $q,
        ]);
    }
}
