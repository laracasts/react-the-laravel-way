<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PuppyController extends Controller
{

    public function index()
    {
        return Inertia::render('puppies/index', [
            'puppies' => PuppyResource::collection(Puppy::all()->load(['user', 'likedBy'])),
        ]);
    }

    public function like(Request $request, Puppy $puppy)
    {
        sleep(1);
        $puppy->likedBy()->toggle($request->user()->id);
        return back();
    }
}
