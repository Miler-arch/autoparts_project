<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\MarcaStoreRequest;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('category_index'), 403);
        $marcas = Marca::all();

        return view('admin.marca.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('category_create'), 403);

        return view('admin.marca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaStoreRequest $request)
    {
        $marca = new Marca();
        $marca->name = $request->name;
        $marca->save();
        return redirect()->route('marcas.index')->with('registro', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        // abort_if(Gate::denies('category_show'), 403);

        return view('admin.marca.show', compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        // abort_if(Gate::denies('category_edit'), 403);

        return view('admin.marca.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $marca->update($request->all());
        
        return redirect()->route('marcas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // abort_if(Gate::denies('marca_destroy'), 403);

        // $category->delete();
        $marca = Marca::findOrFail($id);

        if ($marca->products()->exists()) {
            return redirect()->route('marcas.index')->with('mensaje', 'ok');
        }

            $marca->delete();

            return redirect()->route('marcas.index');
    }
}
