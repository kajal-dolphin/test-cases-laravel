@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger">
    <p>{{ $message }}</p>
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="d-flex bd-highlight">
    <div class="p-2 w-100 bd-highlight">
        <h6 class="mb-0 text-uppercase">BOOK LIST</h6>
    </div>
    <div class="p-2 flex-shrink-1 bd-highlight">
        <a class="btn btn-success btm-sm" href="{{ route('book.create') }}">Create</a>
    </div>
</div>
<hr />
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $key => $book)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->price }}</td>
                        <td>
                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('book.edit',$book->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <a href="{{ route('book.delete',$book->id) }}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
