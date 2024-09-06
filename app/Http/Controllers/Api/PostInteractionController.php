<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class PostInteractionController extends Controller
{
    public function increaseView($id)
    {
        // Redis key for views
        $key = "post:{$id}:views";

        // Increment the view count
        $newViewCount = Redis::incr($key);

        return response()->json([
            'success' => true,
            'views' => $newViewCount,
        ]);
    }

    public function like($id)
    {
        // Redis key for likes
        $key = "post:{$id}:likes";

        // Increment the like count
        $newLikeCount = Redis::incr($key);

        return response()->json([
            'success' => true,
            'likes' => $newLikeCount,
        ]);
    }

    public function dislike($id)
    {
        // Redis key for dislikes
        $key = "post:{$id}:dislikes";

        // Increment the dislike count
        $newDislikeCount = Redis::incr($key);

        return response()->json([
            'success' => true,
            'dislikes' => $newDislikeCount,
        ]);
    }


    public function getPostInteractions($id)
    {
        $views = Redis::get("post:{$id}:views") ?: 0;
        $likes = Redis::get("post:{$id}:likes") ?: 0;
        $dislikes = Redis::get("post:{$id}:dislikes") ?: 0;

        return response()->json([
            'success' => true,
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
        ]);
    }
}
