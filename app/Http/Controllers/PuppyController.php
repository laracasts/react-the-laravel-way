<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

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
        usleep(200000);
        // Validate the data
        $request->validate([
            'name' => 'required|string|max:255',
            'trait' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // Store the uploaded image
        $image_url = null;
        if ($request->hasFile('image')) {
            // Image intervention
            $image = Image::read($request->file('image'));

            // Scale down only
            if ($image->width() > 1000) {
                $image->scale(width: 1000);
            }

            // Encode to WebP
            $webpEncoded = $image->toWebp(quality: 95)->toString();

            // Custom file name
            $fileName = Str::random() . '.webp';

            // Storage path
            $path = 'puppies/' . $fileName;

            // Store the WebP image
            $stored = Storage::disk('public')->put($path, $webpEncoded);

            if (!$stored) {
                return back()->withErrors(['image' => 'Failed to upload image.']);
            }

            // $path = $request->file('image')->store('puppies', 'public');
            $image_url = Storage::url($path);
        }

        // Create a new Puppy instance attached to the authenticated user
        $puppy = $request->user()->puppies()->create([
            'name' => $request->name,
            'trait' => $request->trait,
            'image_url' => $image_url,
        ]);

        // Redirect to the same page
        return back()->with('success', 'Puppy created successfully!');
    }
}
