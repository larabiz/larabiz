<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class Posts extends Component
{
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        if (! empty($this->search)) {
            $posts = Post::search($this->search)
                ->query(function (Builder $query) {
                    $query
                        ->addSelect([
                            'username' => User::select('username')
                                ->whereColumn('id', 'posts.user_id')
                                ->limit(1),
                        ])
                        ->with('media');
                })
                ->get();
        } else {
            $posts = Post::query()
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ])
                ->with('media')
                ->latest()
                ->get();
        }

        return view('livewire.posts', compact('posts'));
    }
}
