<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\UsersExport;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Jobs\SendNotificationJob;
use App\Models\Product;
use App\Services\ProductDataService;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function session;
use function view;

class ProductController extends Controller
{
    /**
     * @var ProductDataService
     */
    private ProductDataService $data;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('products.index', [
            'products' => Product::latest()->available()->paginate(5)
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function store(Product $product, ProductStoreRequest $request, ProductDataService $data): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['data'] = $data->getData($request);

        $item = $product->create($validatedData);
        SendNotificationJob::dispatch(auth()->user(), $item);

        return redirect()->route('products')->with('success','Item created successfully!');
    }

    public function update(Product $product, ProductUpdateRequest $request, ProductDataService $data): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['data'] = $data->getData($request);

        $product->update($validatedData);

        return redirect()->route('products')->with('success','Item updated successfully!');
    }

    public function delete(Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();

        return redirect()->route('products')->with('success','Item deleted successfully!');
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
