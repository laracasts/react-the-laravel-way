<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

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
            'likedPuppies' => $request->user()
                ? PuppyResource::collection($request->user()->likedPuppies)
                : [],
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
        usleep(200000);
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

            // Image optimization
            $image = Image::read($request->file('image'));

            // Scale down only
            if ($image->width() > 1000) {
                $image->scale(width: 1000);
            }

            $webpEncoded = $image->toWebp(quality: 95)->toString();

            $fileName = Str::random() . '.webp';
            $path = 'puppies/' . $fileName;

            $stored = Storage::disk('public')->put($path, $webpEncoded);

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
        return redirect()->route('home', ['page' => 1])->with('success', 'Puppy created successfully!');
    }

    // ------------------------------
    // Delete
    // ------------------------------
    public function destroy(Request $request, Puppy $puppy)
    {
        $imagePath = str_replace('/storage/', '', $puppy->image_url);

        $puppy->delete();

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()
            ->route('home', ['page' => 1])
            ->with('success', 'Puppy deleted successfully!');
    }
}
