<?php

namespace App\Http\Controllers;

use App\Models\Puppy;
use Illuminate\Http\Request;

class PuppyController extends Controller
{
    public function like(Request $request, Puppy $puppy)
    {
        $puppy->likedBy()->toggle($request->user()->id);
        return back();
    }
}
