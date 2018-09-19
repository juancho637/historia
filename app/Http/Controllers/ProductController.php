<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Provider;
use App\Service;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws \Exception
     */
    public function index()
    {

        $products = Product::withTrashed()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $providers = Provider::all();

        return view('admin.products.create', compact('categories', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'value' => 'required|numeric|min:0',
            'tax_percentage' => 'required|numeric|min:0',
            'type' => [
                'required',
                Rule::in(['producto', 'servicio']),
            ],
            'description' => 'required',
            'providers' => 'required|array|min:1',
            "providers.*" => 'exists:providers,id',
            'category' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->all());

        if (!empty($request->providers)) {
            $product->providers()->sync($request->providers);
        }

        return redirect()->route('products.show', $product)->with('flash', 'Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $providers = Provider::all();

        return view('admin.products.edit', compact('product','categories', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'value' => 'required|numeric|min:0',
            'tax_percentage' => 'required|numeric|min:0',
            'type' => [
                'required',
                Rule::in(['producto', 'servicio']),
            ],
            'description' => 'required',
            'providers' => 'required|array|min:1',
            "providers.*" => 'exists:providers,id',
            'category' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        if (!empty($request->providers)) {
            $product->providers()->sync($request->providers);
        }

        return redirect()->route('products.show', $product)->with('flash', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $product->save();
        $product->delete();

        return redirect()->route('products.index')->with('flash', 'Producto eliminado correctamente');
    }
}
