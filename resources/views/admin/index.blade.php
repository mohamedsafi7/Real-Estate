@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Admin Panel - Table of Properties</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $property)
                    <tr>
                        <td>
                            @if ($property->images->count() > 0)
                                <img class="img-thumbnail" src="{{ asset('storage/images/' . $property->images->first()->image_path) }}" alt="" style="max-width: 100px;">
                            @endif
                        </td>
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->address }}</td>
 
                        <td>
                            @if (!$property->validated)
                                <form action="{{ route('admin.validateProperty', $property->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Validate</button>
                                </form>
                            @else
                                <form action="{{ route('admin.unvalidateProperty', $property->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Unvalidate</button>
                                </form>
                            @endif
                            
                            <!-- Delete Form -->
                            <form action="{{ route('admin.deleteProperty', $property->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{-- {{ $properties->links() }} --}}
    </div>
@endsection
