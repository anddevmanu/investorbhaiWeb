@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a> --}}
        </div>

       @include('admin.layouts.message')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Modified At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ !empty($user->status) ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                    <td>{{ $user->updated_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success" title="Edit User">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if(Auth::user()->id !== $user->id)
                                                <a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger" title="Delete User" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endif
                                        </div>
                                        @if(Auth::user()->id !== $user->id)
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.delete', $user->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No user found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        {{ $users->onEachSide(2)->links() }}
                    </div>
                    <div class="col-lg-4 col-md-12 text-right">
                        <h5 class="summary mt-2 pr-1">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} Users </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
