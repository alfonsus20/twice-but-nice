<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public static  function getAllReviews(){
        $reviews = Review::orderBy('created_at')
        ->join('users', 'user_id', 'users.id')
        ->select('reviews.*', 'users.name', 'users.profile_image')
        ->take(4)
        ->get();
        // dd($reviews);
        return $reviews;
    }
}
