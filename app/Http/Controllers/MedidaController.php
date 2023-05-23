<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaStoreRequest;
use App\Http\Requests\MedidaStoreRequest;
use App\Models\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
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
        $medidas = Medida::all();

        return view('admin.medida.index', compact('medidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('category_create'), 403);

        return view('admin.medida.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedidaStoreRequest $request)
    {
        $medida = new Medida();
        $medida->name = $request->name;
        $medida->save();
        return redirect()->route('medidas.index')->with('registro', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Medida $medida)
    {
        // abort_if(Gate::denies('category_show'), 403);

        return view('admin.medida.show', compact('medida'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medida  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Medida $medida)
    {
        // abort_if(Gate::denies('category_edit'), 403);

        return view('admin.medida.edit', compact('medida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medida  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medida $medida)
    {
        $medida->update($request->all());

        return redirect()->route('medidas.index');
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
        $medida = Medida::findOrFail($id);

        if ($medida->products()->exists()) {
            return redirect()->route('medidas.index')->with('mensaje', 'ok');
        }

            $medida->delete();

            return redirect()->route('medidas.index');
    }
}
