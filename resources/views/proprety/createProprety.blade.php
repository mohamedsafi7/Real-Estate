@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="add-property-form" method="POST" action="{{ route('addproprety') }}" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group row">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('city') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('price') }}</label>
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="size" class="col-md-4 col-form-label text-md-right">{{ __('size') }}</label>
                            <div class="col-md-6">
                                <input id="size" type="text" class="form-control" name="size" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bedrooms" class="col-md-4 col-form-label text-md-right">{{ __('bedrooms') }}</label>
                            <div class="col-md-6">
                                <input id="bedrooms" type="text" class="form-control" name="bedrooms" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bathrooms" class="col-md-4 col-form-label text-md-right">{{ __('bathrooms') }}</label>
                            <div class="col-md-6">
                                <input id="bathrooms" type="text" class="form-control" name="bathrooms" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('category') }}</label>
                            <div class="col-md-6">
                                <select id="property-category" name="property-category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="listingType" class="col-md-4 col-form-label text-md-right">{{ __('listingType') }}</label>
                            <div class="col-md-6">
                                                               
                                <select id="listing-type" name="listing-type" class="form-control">
                                    @foreach ($listingTypes as $listingType)
                                        <option value="{{ $listingType->id }}">{{ $listingType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <!-- Add more form groups for other fields like city, address, price, size, bedrooms, and bathrooms -->

                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('images') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" type="file" name="images[]" multiple accept="image/*">

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Add proprety</button>
                                <button type="button" class="btn btn-secondary close-btn">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
