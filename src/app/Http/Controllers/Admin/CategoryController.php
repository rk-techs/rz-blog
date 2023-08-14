<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::orderByRaw('ISNULL(`sort_order`), `sort_order` ASC')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $inputs = $request->only(['name', 'slug', 'sort_order']);

        $category = Category::create($inputs);

        return redirect()
            ->route('admin.category.index')
            ->with([
                'category_id' => "カテゴリーID:{$category->id}",
                'stored'      => 'を登録しました。',
            ]);
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $inputs = $request->only(['name', 'slug', 'sort_order']);

        $category->update($inputs);

        return redirect()
            ->route('admin.category.index')
            ->with([
                'category_id' => "カテゴリーID:{$category->id}",
                'updated'     => 'を更新しました。',
            ]);
    }

    public function destroy(Category $category)
    {
        // TODO: postテーブル作成後、子テーブル存在チェック処理を追加
        if (false) {
            // code ...
            return;
        }

        $category->delete();

        return redirect()
            ->route('admin.category.index')
            ->with([
                'category_id' => "カテゴリID:{$category->id}",
                'deleted'     => 'を削除しました。',
            ]);
    }
}
