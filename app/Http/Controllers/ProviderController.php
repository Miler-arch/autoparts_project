<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use App\Models\Provider;
use Illuminate\Support\Facades\Gate;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('provider_index'), 403);

        $providers = Provider::select('*')->orderBy('name', 'asc')->get();

        return view('admin.provider.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('provider_create'), 403);

        return view('admin.provider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Provider::create($request->all());
        return redirect()->route('providers.index')->with('registro', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        abort_if(Gate::denies('provider_show'), 403);

        return view('admin.provider.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        abort_if(Gate::denies('provider_edit'), 403);

        return view('admin.provider.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Provider $provider)
    {
        $provider->update($request->all());

        return redirect()->route('providers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // abort_if(Gate::denies('marca_destroy'), 403);

        // $category->delete();
        $provider = Provider::findOrFail($id);

        if ($provider->products()->exists()) {
            return redirect()->route('providers.index')->with('mensaje', 'ok');
        }

            $provider->delete();

            return redirect()->route('providers.index');
    }
}
