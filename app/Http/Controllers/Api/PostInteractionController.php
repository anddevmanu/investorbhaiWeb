<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class PostInteractionController extends Controller
{
    public function increaseView($id)
    {

            // Increment the view count directly in tbl_posts
        DB::table('tbl_posts')
        ->where('id', $id)
        ->increment('views');

            $updatedViewCount = DB::table('tbl_posts')
                ->where('id', $id)
                ->value('views');

                return response()->json([
        'success' => true,
                'views' => $updatedViewCount,
            ]);
    }

    public function like($id)
    {
        DB::table('tbl_posts')
            ->where('id', $id)
            ->increment('likes');

        // Fetch the updated like count
        $updatedLikeCount = DB::table('tbl_posts')
            ->where('id', $id)
            ->value('likes');

        return response()->json([
            'success' => true,
            'likes' => $updatedLikeCount,
        ]);
    }

    public function dislike($id)
    {
        // Increment the dislike count directly in tbl_posts
        DB::table('tbl_posts')
            ->where('id', $id)
            ->increment('dislikes');

        // Fetch the updated dislike count
        $updatedDislikeCount = DB::table('tbl_posts')
            ->where('id', $id)
            ->value('dislikes');

        return response()->json([
            'success' => true,
            'dislikes' => $updatedDislikeCount,
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
