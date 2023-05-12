@extends('layout.default')
@section('content')
<div class="container-fluid">
  
    <div class="card">
        <div class="card-header"> Product  Page</div>
        <div class="card-body">
    <div class="row ">

        <div class="col-md-4 col-sm-6">
            <div >
                <div class="card" style="width: 76rem;  margin:5%">

                    <div>
                        <div class="table-responsive">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <!-- Set columns width -->

                                        <a href="{{ route('product.create')}}"> <button class="btn product_button btn-outline-dark my-2 my-sm-0" >create Product </button></a>
                                    </tr>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 30px;">id</th>
                                        <th class=" py-3 px-4" style="width: 1110px; text-align:center;">product image</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">product name</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">product price</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">product category</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">available quantity</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">update</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    {{$key + 1}}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-8">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <img class="card-img-top" src="{{asset('/image/'.$product->image_url)}}" alt="Card image cap">
                                                  
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h6 class="d-block text-dark"> title :{{$product->title}} </h6>
                                                    <h6 class="d-block text-dark"> id :{{$product->id}} </h6>
                                                    <!-- <h6 class="d-block text-dark"> id :{{$product->short_description}} </h6> -->
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h6 class="d-block text-dark"> {{ $product->price}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h6 class="d-block text-dark"> {{ $product->category}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h6 class="d-block text-dark"> {{ $product->avail_qty}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h6 class="d-block btn btn-primary"><a href="{{ url('edit/'.$product->id) }}">edit</h6>
                                                    <h6 class="d-block btn btn-primary"><a href="{{route('product.destroy',[$product->id])}}">delete</h6>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>








                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    </div>
</div>
@endsection