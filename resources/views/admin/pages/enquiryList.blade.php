@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Enquiries</h1>

        </div>

        {{-- Include message partials --}}
        @include('admin.layouts.message')

        {{-- Table Card --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of Enquiries</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Phone</th>
                                <th>Created At</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enquiries as $enquiry)
                                <tr>
                                    <td>{{ $enquiry->name }}</td>
                                    <td>{{ $enquiry->email }}</td>
                                    <td>{{ Str::limit($enquiry->message, 50) }}</td>
                                    <td>{{ !empty($enquiry->Phone) ?? 'NA'}}</td>
                                    <td>{{ $enquiry->created_at->format('d-m-Y H:i') }}</td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('enquiries.delete', $enquiry->id) }}" class="btn btn-danger" title="Delete Enquiry"
                                               onclick="event.preventDefault(); document.getElementById('delete-form-{{ $enquiry->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                        <form id="delete-form-{{ $enquiry->id }}" action="{{ route('enquiries.delete', $enquiry->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No enquiries found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        {{ $enquiries->onEachSide(2)->links() }}
                    </div>
                    <div class="col-lg-4 col-md-12 text-right">
                        <h5 class="summary mt-2 pr-1">Showing {{ $enquiries->firstItem() }} to {{ $enquiries->lastItem() }} of {{ $enquiries->total() }} Enquiries</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
