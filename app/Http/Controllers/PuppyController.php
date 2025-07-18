<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\Request;
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

        sleep(1); // Simulate a delay for demonstration purposes
        $request->validate([
            'name' => 'required|string|max:255',
            'trait' => 'required|string|max:255',
            'image_url' => 'required|image|max:5120'
        ], [
            'name.required' => 'Pup needs a name!',
            'trait.required' => 'Signature move?',
            'image_url.required' => "Can't post a puppy without a cute pic!"
        ]);

        $puppy = new Puppy([
            'name' => $request->name,
            'trait' => $request->trait,
        ]);

        $puppy->user_id = $request->user()->id;

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('puppies', 'public');
            $puppy->image_url = '/storage/' . $path;
        }

        $puppy->save();

        return back();
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
