<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')
                            ->orderBy('title', 'asc')
                            ->paginate();
        
        return view('admin.pages.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        DB::table('categories')->insert([
            'title'         => $request->title,
            'url'           => 'delphi',
            'description'   => $request->description,
        ]);
    
        return redirect()
                ->route('categories.index')
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
        if (!$category = DB::table('categories')->where('id', $id)->first()) 
        {
            return redirect()->back();
        };

        return view('admin.pages.categories.show', [
            'category' => $category
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
        if (!$category = DB::table('categories')->where('id', $id)->first()) 
        {
            return redirect()->back();
        };

        return view('admin.pages.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategoryRequest $request, $id)
    {
        if (!$category = DB::table('categories')->where('id', $id)->first()) 
        {
            return redirect()->back();
        };
        
        $category->update([
            'title'         => $request->title,
            'url'           => $request->url,
            'description'   => $request->description,
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = DB::table('categories')->where('id', $id)
                ->first();

        if (!$category)
            return redirect()->back();

        //Implementar a lófica de não poder excluir se tiver produtos vinculados.
        //if ($categoria->users->count()) {
        //    return redirect()
        //            ->back()
        //            ->with('error', 'Existem usuários vinculados ao Centro de Lucro! Não é possível deletar!');
        //}

        $category->delete($id);

        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        
        /*
        $categories = DB::table('categories')
                    ->where('title', $filters)
                    ->orWhere('description', 'LIKE', "%{$filters['filter']}%")
                    ->paginate();
        
        return view('admin.pages.categories.index', [
            'categories' => $categories,
            'filters' => $filters,
        ]);
        */

        $categories = DB::table('categories')
                    ->where(function ($query) use ($data) {
                        if (isset($data['title'])) {
                            $tit = $data['title'];
                            $query->where('title', 'LIKE', "%$tit%");
                        }
                        if (isset($data['url'])) {
                            $ur = $data['url'];
                            $query->orWhere('url', 'LIKE', "%$ur%");
                        }
                        if (isset($data['description'])) {
                            $desc = $data['description']; 
                            $query->orWhere('description', 'LIKE', "%$desc%");
                        }
                    })
                    ->orderBy('title', 'asc')
                    ->paginate();
        
        return view('admin.pages.categories.index', [
            'categories' => $categories,
            'data' => $data,
        ]);
    }
}
