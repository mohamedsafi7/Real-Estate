<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="add-property-form" method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        @auth

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" value="{{ auth()->user()->name }}" class="form-control" name="name" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">email </label>
                            <div class="col-md-6">
                                <input id="email" type="text" value="{{ auth()->user()->email }}" class="form-control" name="{{ auth()->user()->email }}" required autofocus>
                            </div>
                        </div>


                        <!-- Add more form groups for other fields like city, address, price, size, bedrooms, and bathrooms -->

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <input class="form-control" type="file" name="image" >

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
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
