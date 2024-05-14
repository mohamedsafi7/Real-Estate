@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Admin Panel - Table of Properties</h1>

<!-- Filter Buttons -->
<div class="mb-4">
    <a href="{{ route('admin.index', ['validated' => 1]) }}" class="btn btn-primary {{ Request::get('validated') == '1' ? 'active' : '' }}">Validated</a>
    <a href="{{ route('admin.index', ['validated' => 0]) }}" class="btn btn-warning {{ Request::get('validated') == '0' ? 'active' : '' }}">Unvalidated</a>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary {{ Request::get('validated') == null ? 'active' : '' }}">All</a>
</div>


        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Location</th>
                    {{-- <th>status</th> --}}
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
                        <td>{{ $property->owner->name }} <p>{{ $property->owner->phone }}</p></td>
                        <td>{{ $property->city }},  {{ $property->address }}</td>
                        {{-- <td>{{ $property->validated }}</td> --}}
 
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
