@extends('editor.layouts.master')

@section('title')
    <title>Blog List - Investorbhai</title>
@endsection

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-gray-800">Blog List</h1>
        <a href="{{ route('blog.create') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg text-sm hover:bg-green-600 transition duration-300">
            Create Blog
        </a>
    </div>

    <!-- Blog List Table -->
    @if($blogs->isEmpty())
        <div class="bg-white shadow-lg rounded-lg overflow-hidden my-6 text-center py-4">
            <p class="text-gray-700 text-lg">No blogs available.</p>
        </div>
    @else
        <div class="bg-white shadow-lg rounded-lg overflow-hidden my-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-4 px-6 text-left">#</th>
                        <th class="py-4 px-6 text-left">Title</th>
                        <th class="py-4 px-6 text-left">Description</th>
                        <th class="py-4 px-6 text-center">Category</th>
                        <th class="py-4 px-6 text-center">Author</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($blogs as $blog)
                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300">
                        <td class="py-4 px-6 text-left whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6 text-left">
                            <span class="font-medium text-gray-900">{{ $blog->title }}</span>
                        </td>
                        <td class="py-4 px-6 text-left max-w-xs">
                            {!! limitWords($blog->description, 50) !!}
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">{{ $blog->category->category_name }}</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span>{{ $blog->user->name }}</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if ($blog->status)
                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Published</span>
                            @else
                                <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Draft</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('blog.edit', $blog->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded-lg text-xs hover:bg-blue-600 transition duration-300">
                                    Edit
                                </a>
                                <form action="{{ route('blog.delete', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg text-xs hover:bg-red-600 transition duration-300">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Pagination Links -->
    @if($blogs->isNotEmpty())
        <div class="mt-6">
            {{ $blogs->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
