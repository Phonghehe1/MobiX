<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'desc');
        $products = Product::with('category')->orderBy($sort, $order)->paginate(10);

        return view('admin.products.index', compact('products', 'sort', 'order'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
{

    $data = $request->all();

    // Kiểm tra nếu có ảnh được tải lên
    if ($request->hasFile('image')) {
        $path_image = $request->file('image')->store('images');
    }
    $data['image'] = $path_image ?? null;

    // Tạo sản phẩm mới
    $product = Product::create($data);

    return redirect()->route('admin.products.index', $product->id)
        ->with('message', 'Thêm sản phẩm thành công');
}


    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $data['image'] = $request->file('image')->store('product_images');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('message', 'Cập nhật sản phẩm thành công');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('message', 'Xóa sản phẩm thành công');
    }
}
