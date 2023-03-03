<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\GalleryRequest;

class GalleryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request, TravelPackage $travel_package)
    {
        if($request->validated()){
            $images = $request->file('images')->store(
                'travel_package/gallery', 'public'
            );
            Gallery::create($request->except('images') + ['images' => $images,'travel_package_id' => $travel_package->id]);
        }

        return redirect()->route('admin.travel_packages.edit', [$travel_package])->with([
            'message' => 'Success Created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelPackage $travel_package,Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('travel_package','gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request,TravelPackage $travel_package, Gallery $gallery)
    {
        if($request->validated()) {
            if($request->images) {
                File::delete('storage/'. $gallery->images);
                $images = $request->file('images')->store(
                    'travel_package/gallery', 'public'
                );
                $gallery->update($request->except('images') + ['images' => $images, 'travel_package_id' => $travel_package->id]);
            }else {
                $gallery->update($request->validated());
            }
        }

        return redirect()->route('admin.travel_packages.edit', [$travel_package])->with([
            'message' => 'Success Updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelPackage $travel_package,Gallery $gallery)
    {
        File::delete('storage/'. $gallery->images);
        $gallery->delete();

        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
