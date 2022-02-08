<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Jobs\SendNotificationJob;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductCreatedNotification;
use App\Services\ProductDataService;
use Illuminate\Support\Facades\Notification;
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
        $this->data = (new ProductDataService());
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

    public function store(Product $product, ProductStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['data'] = $this->data->getData($request);

        $item = $product->create($validatedData);
        SendNotificationJob::dispatch(auth()->user(), $item);

        return redirect()->route('products')->with('success','Item created successfully!');
    }

    public function update(Product $product, ProductUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['data'] = $this->data->getData($request);

        $product->update($validatedData);

        return redirect()->route('products')->with('success','Item updated successfully!');
    }

    public function delete(Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();

        return redirect()->route('products')->with('success','Item deleted successfully!');
    }
}
