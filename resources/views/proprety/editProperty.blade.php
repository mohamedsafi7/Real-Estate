{{-- <form action="{{route('updateproperty',$property->id)}}" method="POST">
    @method('put')
    @csrf
    <input type="text" name="name" value={{"$property->name"}}>
    <input type="text" name="city"value={{"$property->city"}} >
    <input type="text" name="address" value={{"$property->address"}}>
    <input type="number" name="price" value={{"$property->price"}}>
    <input type="number" name="size" value={{"$property->size"}}>
    <input type="number" name="bedrooms" value={{"$property->bedrooms"}}>
    <input type="number" name="bathrooms" value={{"$property->bathrooms"}}>
    <input type="text" name="description" value={{"$property->description"}}>
    <input type="number" name="category_id" value={{"$property->category_id"}}>
    <input type="number" name="listing_type_id" value={{"$property->listing_type_id"}}>
    <input type="number" name="user_id" value={{"$property->user_id"}}>
    <button type="submit">update</button>
</form>

 --}}

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
    <div class="card" >
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('updateproperty', $property->id) }}" method="POST">
                            @method('put')
                            @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $property->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="{{ $property->city }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $property->address }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" value="{{ $property->price }}">
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input type="number" name="size" class="form-control" value="{{ $property->size }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bedrooms" class="form-label">Bedrooms</label>
                                <input type="number" name="bedrooms" class="form-control" value="{{ $property->bedrooms }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bathrooms" class="form-label">Bathrooms</label>
                                <input type="number" name="bathrooms" class="form-control" value="{{ $property->bathrooms }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_id" class="form-label">User ID</label>
                                <input type="number" name="user_id" class="form-control" value="{{ $property->user_id }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category ID</label>
                                <input type="number" name="category_id" class="form-control" value="{{ $property->category_id }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="listing_type_id" class="form-label">Listing Type ID</label>
                                <input type="number" name="listing_type_id" class="form-control" value="{{ $property->listing_type_id }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description"  class="form-control  custom-textarea">{{ $property->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
    
 </body>
 </html>
