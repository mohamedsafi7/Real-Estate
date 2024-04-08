@extends('layouts.app')

@section('content')
    <div>
        <h2>Create Category</h2>
        <form method="POST" action="{{ route('categories.add') }}">
            @csrf
            <div>
                <label for="name">Category Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <button type="submit">Add Category</button>
        </form>
        
    </div>
@endsection
