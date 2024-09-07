@extends('admin.layouts.master')

@section('title')
    <title>Category - InvestorBhai</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <a href="{{route('category.create')}}" class="btn btn-primary">Create </a>
        </div>

        @include('admin.layouts.message')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of Categories</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Category Name</th>
                                <th>Category Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{!! $category->category_description !!}</td>
                                    <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $category->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success" title="Edit Category">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger" title="Delete Category" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="delete-form-{{ $category->id }}" action="{{ route('category.delete', $category->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No category found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        {{ $categories->onEachSide(2)->links() }}
                    </div>
                    <div class="col-lg-4 col-md-12 text-right">
                        <h5 class="summary mt-2 pr-1">Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} Categories</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
