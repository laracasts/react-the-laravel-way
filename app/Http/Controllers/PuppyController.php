<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PuppyController extends Controller
{

    // ------------------------------
    // Index
    // ------------------------------

    public function index(Request $request)
    {
        $search = $request->search;

        return Inertia::render('puppies/index', [
            'puppies' => PuppyResource::collection(
                Puppy::query()
                    ->when($search, function ($query, $search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('trait', 'like', "%{$search}%");
                    })
                    ->with(['user', 'likedBy'])
                    ->latest()
                    ->paginate(6)
                    ->withQueryString()
                // ->get()
            ),
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    // ------------------------------
    // Store
    // ------------------------------

    public function store(Request $request)
    {
        sleep(1);

        $request->validate([
            'name' => 'required|string|max:255',
            'trait' => 'required|string|max:255',
            'image' => 'required|image|max:5120'
        ], [
            'name.required' => 'Pup needs a name!',
            'trait.required' => 'Signature move?',
            'image.required' => "Can't post a puppy without a cute pic!"
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('puppies', 'public');
            if (!$path) {
                return back()->withErrors(['image' => 'Failed to upload image']);
            }
            $imageUrl = Storage::url($path);
        }

        $request->user()->puppies()->create([
            'name' => $request->name,
            'trait' => $request->trait,
            'image_url' => $imageUrl,
        ]);

        return back()->with('success', 'Puppy added successfully!');
    }

    // ------------------------------
    // Like
    // ------------------------------

    public function like(Request $request, Puppy $puppy)
    {
        usleep(300000);
        $puppy->likedBy()->toggle($request->user()->id);
        return back();
    }
}
