<?php

namespace App\Http\Controllers;

use App\Models\RatingProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class RatingProductController extends Controller
{
    public function saveRating(Request $request)
{
    // Retrieve authenticated user ID
    $userId = auth()->user()->id;

    // Check if the user has already rated the product
    $rating = RatingProduct::where('user_id', $userId)
                            ->where('product_id', $request->input('product_id'))
                            ->first();

    if ($rating) {
        // Update existing rating
        $rating->rating = $request->input('rating');
        $rating->save();
    } else {
            // Create new rating
        $newRating = new RatingProduct();
        $newRating->user_id = $userId;
        $newRating->product_id = $request->input('product_id');
        $newRating->rating = $request->input('rating');
            $newRating->save();
    }

    // Optionally, return a response indicating success
        return response()->json(['success' => true]);
    }


public function admin_show_review(): View
    {
    
        $rating = RatingProduct::select('product_id', 'user_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('product_id', 'user_id') // Include user_id in the GROUP BY clause
        ->get();

        return view('admin-pages/rating/list', [
            'rating' => $rating,

            'layout' => 'side-menu'
        ]);
    }




}