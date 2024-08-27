@php
       $ use App\Models\Post;
        $tags = YourModel::all()->pluck('tags')->flatten()->unique()->toArray(); // Adjust to fetch tags accordingly
    @endphp

