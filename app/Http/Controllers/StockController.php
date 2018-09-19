<?php

namespace App\Http\Controllers;

use App\Product;
use App\Service;
use App\State;
use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.stocks.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->validate($request, [
            'purchase_amount' => 'required|numeric',
            'stock_min' => 'required|numeric',
            'due_date' => 'required|date',
            'lot' => 'required|numeric',
            'provider_id' => 'required|exists:providers,id',
        ]);

        $fields = $request->all();
        $fields['product_id'] = $product->id;
        if (!empty($request->purchase_amount)) {
            $fields['stock'] = $request->purchase_amount;
        }

        Stock::create($fields);

        return redirect()->route('products.show', $product)->with('flash', 'Stock creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Stock $stock)
    {
        return view('admin.stocks.show', compact('product', 'stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Stock $stock)
    {
        return view('admin.stocks.edit', compact('stock','product', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Stock $stock)
    {
        $this->validate($request, [
            'purchase_amount' => 'required|numeric',
            'stock_min' => 'required|numeric',
            'due_date' => 'required|date',
            'lot' => 'required|numeric',
            'provider_id' => 'required|exists:providers,id',
        ]);

        $fields = $request->all();
        if (!empty($request->purchase_amount)) {
            $fields['stock'] = $request->purchase_amount;
        }
        $stock->update($request->all());

        return redirect()->route('products.show', $product)->with('flash', 'Stock actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product, Stock $stock)
    {
        $stock->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $stock->save();
        $stock->delete();

        return redirect()->route('products.show', $product)->with('flash', 'Stock eliminado correctamente');
    }
}
