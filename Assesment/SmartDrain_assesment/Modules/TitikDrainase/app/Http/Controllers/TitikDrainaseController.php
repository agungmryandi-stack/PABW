<?php

namespace Modules\TitikDrainase\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Modules\TitikDrainase\Http\Requests\titikRequest;
use Modules\TitikDrainase\Models\TitikDrainase;

class TitikDrainaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
       $search = $request->string('search')->trim()->toString();
       $titikDrainase = TitikDrainase::query()
            ->when($search !== '', function (Builder $query) use ($search) {
                $query->where(function (Builder $query) use ($search) {
                    $query->where('nama_titik', 'like', "%{$search}%")
                        ->orWhere('kecamatan', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama_titik')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Buku::index', [
            'titikDrainase' => $titikDrainase,
            'filters' => ['search' => $search],
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('titikdrainase::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TitikDrainase $request): RedirectResponse
     {
        
         TitikDrainase::create($request->validated());

        return redirect()->route('titikdrainase.index')->with('success', 'titik drainase berhasil ditambahkan.');
    }

    public function edit(TitikDrainase $titikDrainase):Response
    {
        return Inertia::render('titikdrainase::edit', ['titikDrainase' => $titikDrainase]);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(TitikDrainase $request, TitikDrainase $titikDrainase): RedirectResponse
    {
        $titikDrainase->update($request->validated());

        return redirect()->route('titikdrainase.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(TitikDrainase $titikDrainase): RedirectResponse
    {
        $titikDrainase->delete();

        return redirect()->route('titikdrainase.index')->with('success', 'Data berhasil dihapus.');
    }
}
