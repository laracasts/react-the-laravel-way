<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PuppyController extends Controller
{

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
                    ->get()
            ),
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function like(Request $request, Puppy $puppy)
    {
        sleep(1);
        $puppy->likedBy()->toggle($request->user()->id);
        return back();
    }
}
