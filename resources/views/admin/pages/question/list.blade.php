@extends('admin.layouts.master')

@section('title')
    <title>Question List - Investorbhai</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Questions</h1>
            <a href="{{ route('question.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-list fa-sm text-white-50"></i> Question Create
            </a>
        </div>

       @include('admin.layouts.message')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Questions List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($questions as $question)
                                <tr>
                                    <td>{{ $question->title }}</td>
                                    <td>{{ $question->user->name }}</td>
                                    <td>{{ $question->status == '1' ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $question->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('question.edit', $question->id) }}" class="btn btn-success" title="Edit Question">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('question.delete', $question->id) }}" class="btn btn-danger" title="Delete Question" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $question->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                        <form id="delete-form-{{ $question->id }}" action="{{ route('question.delete', $question->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No questions found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        {{ $questions->onEachSide(2)->links() }}
                    </div>
                    <div class="col-lg-4 col-md-12 text-right">
                        <h5 class="summary mt-2 pr-1">Showing {{ $questions->firstItem() }} to {{ $questions->lastItem() }} of {{ $questions->total() }} Questions </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
