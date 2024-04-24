<form action="{{route('updateproperty',$property->id)}}" method="POST">
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


<form action="{{route('')}}"></form>