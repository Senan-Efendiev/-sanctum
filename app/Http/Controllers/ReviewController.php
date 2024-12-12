<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('game', 'user')->get();
        return view('reviews.index', compact('reviews'));
    }

    public function show($id)
    {
        $review = Review::with('game', 'user')->findOrFail($id);
        return view('reviews.show', compact('review'));
    }
}
