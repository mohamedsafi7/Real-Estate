<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row justify-content-center">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-body">
                        <form class="add-property-form" method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @auth
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" name='name' id="name" value="{{$user->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="text" class="form-control" id="email" name='email' value="{{$user->email}}">
                            </div>
                            <!-- Add more form groups for other fields like city, address, price, size, bedrooms, and bathrooms -->
                           
                            <div class="mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                            </div>
                           
                            <div class="form-group row mb-0">
                                <div class="col-md-8"> <!-- Adjust col-md value for positioning -->
                                    <button type="submit" class="btn btn-primary">update </button>
                                </div>
                            </div>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
