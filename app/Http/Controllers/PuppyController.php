<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Actions\OptimizeWebpImageAction;

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
                    ->paginate(9)
                    ->withQueryString()
            ),
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    // ------------------------------
    // Like
    // ------------------------------
    public function like(Request $request, Puppy $puppy)
    {
        sleep(1);
        $puppy->likedBy()->toggle($request->user()->id);
        return back();
    }

    // ------------------------------
    // Store
    // ------------------------------
    public function store(Request $request)
    {
        sleep(2);
        // Validate the data
        $request->validate([
            'name' => 'required|string|max:255',
            'trait' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // Store the uploaded image
        $image_url = null;
        if ($request->hasFile('image')) {

            $optimized = (new OptimizeWebpImageAction())->handle($request->file('image'));

            $path = 'puppies/' . $optimized['fileName'];

            $stored = Storage::disk('public')->put($path, $optimized['webpString']);

            if (!$stored) {
                return back()->withErrors(['image' => 'Failed to upload image.']);
            }
            $image_url = Storage::url($path);
        }

        // Create a new Puppy instance attached to the authenticated user
        $request->user()->puppies()->create([
            'name' => $request->name,
            'trait' => $request->trait,
            'image_url' => $image_url,
        ]);

        // Redirect to the same page
        return back()->with('success', 'Puppy created successfully!');
    }
}
