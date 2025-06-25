<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use App\Http\Requests\StoreTerrainRequest;
use App\Http\Requests\UpdateTerrainRequest;

class TerrainController extends Controller
{
    public function index()
    {
        $terrains = Terrain::with('images')->paginate(10);
        return view('terrains.index', compact('terrains'));
    }

    public function create()
    {
        return view('terrains.create');
    }

    public function store(StoreTerrainRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('terrains');
        }

        $terrain = auth()->user()->terrains()->create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $terrain->images()->create(['image_path' => $image->store('terrain_images')]);
            }
        }

        return redirect()->route('terrains.show', $terrain);
    }

    public function show(Terrain $terrain)
    {
        return view('terrains.show', compact('terrain'));
    }

    public function edit(Terrain $terrain)
    {
        $this->authorize('update', $terrain);
        return view('terrains.edit', compact('terrain'));
    }

    public function update(UpdateTerrainRequest $request, Terrain $terrain)
    {
        $this->authorize('update', $terrain);

        $data = $request->validated();

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('terrains');
        }

        $terrain->update($data);

        return redirect()->route('terrains.show', $terrain);
    }

    public function destroy(Terrain $terrain)
    {
        $this->authorize('delete', $terrain);
        $terrain->delete();
        return redirect()->route('terrains.index');
    }
}
