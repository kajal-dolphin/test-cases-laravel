@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div>
    <h3>Create Calculation</h3>
    <div class="pt-3">
        <form action="{{ route('calculation.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="value1" class="form-label">Value 1</label>
                <input type="text" class="form-control" id="value1" name="value1">
            </div>
            <div class="mb-3">
                <label for="value2" class="form-label">Value 2</label>
                <input type="text" class="form-control" id="value2" name="value2">
            </div>
            <div class="mb-3">
                <label for="operation" class="form-label">Operation</label>
                <select class="form-select" aria-label="Default select example" name="operation">
                    <option value="Add">Add</option>
                    <option value="Subtract">Subtract</option>
                    <option value="Multiply">Multiply</option>
                    <option value="Divide">Divide</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
