@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Admin Panel - Table of Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @if ($user->image)
                            <img class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;" src="{{ asset('storage/users/' . $user->image) }}" alt="{{ $user->name }}">
                            @else
                                <img class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;" src="{{ asset('generic.jpg') }}" alt="Anonymous">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td> 
                        <td>{{ $user->role }}</td> 
                        <td>
                            @if (!$user->isAdmin())
                                <form action="{{ route('admin.validateUser', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">set as Admin</button>
                                </form>
                            @else
                                <form action="{{ route('admin.unvalidateUser', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning"> set as User</button>
                                </form>
                            @endif
                            
                            <!-- Delete Form -->
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="d-inline">
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
