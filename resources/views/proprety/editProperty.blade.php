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
<div class="card">
    <div class="row justify-content-center mt-4 mb-4">
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
                                    <label for="category_id" class="form-label">Category</label>
                                    <select id="category_id" name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->id == $property->category_id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="listing_type_id" class="form-label">Listing Type </label>
                                    <select id="listing_type_id" name="listing_type_id" class="form-control">
                                        @foreach ($listingTypes as $listingType)
                                            <option value="{{ $listingType->id }}" @if($listingType->id == $property->listing_type_id) selected @endif>{{ $listingType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control custom-textarea">{{ $property->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="listing_type_id" class="form-label">Tags</label>
                                    <select id="tags" name="tags[]" class="form-control" multiple>
                                        <option value="Pool">Pool</option>
                                        <option value="Parking">Parking</option>
                                        <option value="Garage">Garage</option>
                                        <option value="Garden">Garden</option>
                                        <option value="Balcony">Balcony</option>
                                        <option value="Terrace">Terrace</option>
                                        <option value="Fireplace">Fireplace</option>
                                        <option value="Basement">Basement</option>
                                        <option value="Air Conditioning">Air Conditioning</option>
                                        <option value="Central Heating">Central Heating</option>
                                        <option value="Security System">Security System</option>
                                        <option value="Furnished">Furnished</option>
                                        <option value="Unfurnished">Unfurnished</option>
                                        <option value="Sea View">Sea View</option>
                                        <option value="Mountain View">Mountain View</option>
                                        <option value="City View">City View</option>
                                        <option value="Pet Friendly">Pet Friendly</option>
                                        <option value="Near Public Transport">Near Public Transport</option>
                                        <option value="Gym">Gym</option>
                                        <option value="Elevator">Elevator</option>
                                        </select>
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
