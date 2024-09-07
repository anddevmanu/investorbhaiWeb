@extends('admin.layouts.master')

@section('title')
    <title>Blog List - Investorbhai</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Blogs</h1>
            <a href="{{route('blog.create')}}" class="btn btn-primary">Create</a>
        </div>

       @include('admin.layouts.message')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of Blogs</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->category ? $blog->category->name : 'N/A' }}</td>
                                    <td>{{ $blog->description }}</td>
                                    <td>{{ !empty($blog->status) ? 'Published' : 'Draft' }}</td>
                                    <td>{{ $blog->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-success" title="Edit Blog">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('blog.delete', $blog->id) }}" class="btn btn-danger" title="Delete Blog" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $blog->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                        <form id="delete-form-{{ $blog->id }}" action="{{ route('blog.delete', $blog->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No blogs found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        {{ $blogs->onEachSide(2)->links() }}
                    </div>
                    <div class="col-lg-4 col-md-12 text-right">
                        <h5 class="summary mt-2 pr-1">Showing {{ $blogs->firstItem() }} to {{ $blogs->lastItem() }} of {{ $blogs->total() }} Blogs</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
