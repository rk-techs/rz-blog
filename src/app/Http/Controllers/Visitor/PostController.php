<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('front.home', [
            'posts'      => Post::published()->latest()->simplePaginate(30)->withQueryString(),
            'categories' => Category::sorted()->get(),
            'tags'       => Tag::sorted()->get(),
        ]);
    }

    public function show(string $slug)
    {
        return view('front.post', [
            'post' => Post::withSlug($slug)->firstOrFail(),
        ]);
    }

    public function filter(FilterRequest $request)
    {
        $categorySlug  = $request->input('category_slug');
        $tagSlugs      = $request->input('tag_slugs');
        $tagOption     = $request->input('tag_option');

        $postQuery = Post::query();

        if ($categorySlug) {
            $postQuery->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($tagSlugs && $tagOption === 'or') {
            $postQuery->whereHas('tags', function ($q) use ($tagSlugs) {
                $q->whereIn('slug', $tagSlugs);
            });
        } elseif ($tagSlugs && $tagOption === 'and') {
            foreach ($tagSlugs as $tagSlug) {
                $postQuery->whereHas('tags', function ($q) use ($tagSlug) {
                    $q->where('slug', $tagSlug);
                });
            }
        }

        $filteredPostCount = $postQuery->count();
        $paginatedPosts = $postQuery->published()->latest()->simplePaginate(30)->withQueryString();

        return view('front.home', [
            'categories'    => Category::sorted()->get(),
            'tags'          => Tag::sorted()->get(),
            'filteredPostCount' => $filteredPostCount,
            'posts'         => $paginatedPosts,
            'queries'       => $request->query(),
        ]);
    }

    /** Ajax Search */
    public function search(Request $request)
    {
        $query = $request->get('query');

        $postQuery = Post::query()
                        ->published()
                        ->where('title', 'LIKE', "%{$query}%")
                        ->latest();

        $posts = $postQuery->get();

        return response()->json(['posts' => $posts]);
    }

}
