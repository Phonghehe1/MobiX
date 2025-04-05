<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'desc');
        $categories = Category::orderBy($sort, $order)->paginate(10);

        return view('admin.categories.index', compact('categories', 'sort', 'order'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $category = Category::create($request->only('name'));

        return redirect()->route('admin.categories.index', $category->id)
            ->with('message', 'Thêm danh mục thành công');
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $category = Category::findOrFail($id);
        $category->update($request->only('name'));

        return redirect()->route('admin.categories.index')
            ->with('message', 'Cập nhật danh mục thành công');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('message', 'Xóa danh mục thành công');
    }
}
