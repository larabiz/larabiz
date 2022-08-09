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
        return view('livewire.posts', [
            'posts' => Post::query()
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ])
                ->selectRaw('MATCH(title, content, excerpt) AGAINST(?) AS relevance', [$this->search])
                ->with('media')
                ->when(! empty($this->search), function (Builder $query) {
                    $query->whereFullText(['title', 'content', 'excerpt'], $this->search);
                })
                ->latest()
                ->orderByDesc('relevance')
                ->get(),
        ]);
    }
}
