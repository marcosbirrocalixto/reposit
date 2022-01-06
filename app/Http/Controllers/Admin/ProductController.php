<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product) 
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->with('category')->paginate();
        
        return view('admin.pages.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$categories = Category::orderBy('title','asc')->pluck('title', 'id');

        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpateProductRequest $request)
    {
        /*
        $category = Category::find($request->category->id);
        $product = $category->products()->create($request->all());
        */

        $this->product->create($request->all());
    
        return redirect()
                ->route('products.index')
                ->withSuccess('Dados cadastrados com sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->product->with('category')->find($id)) 
        {
            return redirect()->back();
        }

        return view('admin.pages.products.show', [
            'product'       => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$categories = Category::orderBy('title','asc')->pluck('title', 'id');

        if (!$product = $this->product->find($id)) 
        {
            return redirect()->back();
        }

        return view('admin.pages.products.edit', [
            'product'       => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpateProductRequest $request, $id)
    {
        $product = $this->product->find($id);

        $product->update($request->all());

        return redirect()
                    ->route('products.index')
                    ->withSuccess('Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->product->find($id)) 
        {
            return redirect()->back();
        }

        //Implementar a lófica de não poder excluir se tiver produtos vinculados.
        //if ($categoria->users->count()) {
        //    return redirect()
        //            ->back()
        //            ->with('error', 'Existem usuários vinculados ao Centro de Lucro! Não é possível deletar!');
        //}

        $product->delete($id);

        return redirect()
                    ->route('categories.index')
                    ->withSuccess('Produto deletado com sucesso');;
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        //dd($filters['category']);

        $products = $this->product
                        ->with('category')
                        ->where(function ($query) use ($request) {
                        if ($request->name) {
                            $filter = $request->name;
                            $query->where(function ($querySub) use ($filter) {
                                $querySub->where('name', 'LIKE', "%{$filter}%")
                                            ->orWhere('description', 'LIKE', "%{$filter}%");
                            });
                        }

                        if ($request->url) {
                            $query->where('url', 'LIKE', "%{$request->url}%");
                        }

                        if ($request->category) {
                            $query->orWhere('category_id', $request->category);
                        }


                    })
                    ->paginate(1);
                    //->toSql();
                    //dd($products);
        
        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters,
        ]);
    }
}
