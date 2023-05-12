@extends('layout.default')
@section('content')
<div class="card">
        <div class="card-header">  Edit product Page</div>
        <div class="card-body">
<form action="{{route('product.update',[$post->id])}}" method="POST" enctype="multipart/form-data">
@csrf
@method('Post')
    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example1cg"> Product title</label> 
      <input type="text" id="form3Example1cg" name="title" value="{{$post->title}}"  class="form-control form-control-lg" />
      
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example3cg">image_url</label>

    
        @if("{{asset('/image/'.$post->image_url)}}")
        <img src="{{asset('/image/'.$post->image_url)}}" id="image"> 
             <button type="button" class="btn btn-primary" onclick="up()" id="btnuploadimage">update image </button>
             <input type="file" name="image_url"  style="display:none" id="image_upload"  class="form-control form-control-lg" />
            
    @else
            <p>No image found</p>
    @endif


      <!-- <img  style=" width:35px;" class="card-img-top"  src="{{asset('/image/'.$post->image_url)}}" alt="Card image cap"> -->
    </div>
    
    <div class="form-outline mb-4">
        <label class="form-label" >price</label>
      <input type="integer" id="form3Example4cg"  name="price"  value="{{$post->price}}" class="form-control form-control-lg" />  
    </div>
    <div class="form-outline mb-4">
        <label class="form-label"> short Description </label> 
      <input type="text" id="form3Example7cg" name="short_desc" value="{{$post->short_description}}"   class="form-control form-control-lg" />
    </div> 

    <div class="form-outline mb-4">
        <label class="form-label" > Detail </label> 
      <input type="text" id="form3Example5cg" name="detail"  value="{{$post->detail}}"   class="form-control form-control-lg" />
    </div> 

    <div class="form-outline mb-4">
        <label class="form-label" >Available quantity </label> 
      <input type="integer" id="form3Example17cg" name="avail_qty"  value="{{$post->avail_qty}}"   class="form-control form-control-lg" />
    </div> 

    <div class="form-outline mb-4">
        <label class="form-label" >Category </label> 
      <input type="integer" id="form3Example18cg" name="category"   value="{{$post->category}}"     class="form-control form-control-lg" />
    </div> 
    <div class="d-flex justify-content-center">
      <button type="submit"  >submit</button>
      <button type="submit"> <a href="{{ route('product.index')}}">Back</a></button>
    </div>

  </form>
        </div>
</div>
@endsection
<script type="text/javascript">
  function up(){
    var image = document.getElementById('image');
    var file = document.getElementById('image_upload');
    var btn = document.getElementById('btnuploadimage')
    image.style.display = 'none';
    btn.style.display = 'none';
    file.style.display = 'block';
  }
  </script>
