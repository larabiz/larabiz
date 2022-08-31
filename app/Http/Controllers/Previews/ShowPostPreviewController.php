<?php

namespace App\Http\Controllers\Previews;

use App\Models\Post;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowPostPreviewController extends Controller
{
    public function __construct()
    {
        if (app()->isProduction()) {
            $this->middleware('signed');
        }
    }

    public function __invoke(string $randomId) : View
    {
        $post = Post::withoutGlobalScope('published')
            ->whereRandomId($randomId)
            ->first();

        return view('previews.post', compact('post') + [
            'colors' => collect([
                collect(['from-[#0f0c29]', 'via-[#302b63]', 'to-[#24243e]', 'text-blue-50']),
                collect(['from-[#834d9b]', 'to-[#d04ed6]', 'text-pink-50']),
                collect(['from-[#536976]', 'to-[#bbd2c5]', 'text-gray-50']),
                collect(['from-[#232526]', 'to-[#414345]', 'text-gray-50']),
                collect(['from-[#0f2027]', 'to-[#203a43]', 'text-gray-50']),
                collect(['from-[#373b44]', 'to-[#4286f4]', 'text-blue-50']),
                collect(['from-[#8e2de2]', 'to-[#4a00e0]', 'text-purple-50']),
                collect(['from-[#642b73]', 'to-[#c6426e]', 'text-purple-50']),
                collect(['from-[#141e30]', 'to-[#243b55]', 'text-gray-50']),
                collect(['from-[#000000]', 'to-[#434343]', 'text-gray-50']),
                collect(['from-[#1e3c72]', 'to-[#2a5298]', 'text-gray-50']),
                collect(['from-[#6a3093]', 'to-[#a044ff]', 'text-purple-50']),
                collect(['from-[#b24592]', 'to-[#f15f79]', 'text-pink-50']),
                collect(['from-[#360033]', 'to-[#0b8793]', 'text-cyan-50']),
            ])->random(),
        ]);
    }
}
