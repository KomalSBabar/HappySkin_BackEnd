@extends('layout.default')
@section('content')

<p> Create product Page</p>

<form   action="{{route('product_store')}}"   method="POST" enctype="multipart/form-data"   >
@csrf
    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example1cg"> Product title</label> 
      <input type="text" id="form3Example1cg" name="title"  class="form-control form-control-lg" />
      
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example3cg">image_url</label>
      <input type="file" id="form3Example3cg" name="image_url"  class="form-control form-control-lg" />
     
    </div>
    
    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example4cg">price</label>
      <input type="integer" id="form3Example4cg"  name="price"  class="form-control form-control-lg" />  
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example1cg"> short Description </label> 
      <input type="text" id="form3Example7cg" name="short_desc"  class="form-control form-control-lg" />
    </div> 

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example1cg"> Detail </label> 
      <input type="text" id="form3Example5cg" name="detail"  class="form-control form-control-lg" />
    </div> 

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example1cg">Available quantity </label> 
      <input type="integer" id="form3Example17cg" name="avail_qty"  class="form-control form-control-lg" />
    </div> 

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example1cg">Category </label> 
      <input type="integer" id="form3Example18cg" name="category"  class="form-control form-control-lg" />
    </div> 
    
    <div class="d-flex justify-content-center">
      <button type="submit"  >submit</button>
    </div>

  </form>
@endsection
