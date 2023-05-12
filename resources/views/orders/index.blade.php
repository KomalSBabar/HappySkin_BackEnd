@extends('layout.default')
@section('content')
<div class="container-fluid">
  
    <div class="card">
        <div class="card-header"> Orders</div>
        <div class="card-body">
    <div class="row ">

        <div class="col-md-4 col-sm-6">
            <div >
                <div class="card" style="width: 65rem;  margin:5%">

                    <div>
                        <div class="table-responsive">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 30px;">id</th>
                                        <th class=" py-3 px-4" style="width: 1110px; text-align:center;">product image</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">order number</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">shiping addres</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">product price</th>
                                        <th class=" py-3 px-4" style="min-width: 15px;">payment status</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($user_orders as $key => $uo)
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
                                                    <img class="card-img-top" src="{{asset('/image/'.$uo->image_url)}}" alt="Card image cap">
                                                    <h6 class="d-block text-dark"> {{$uo->title}} </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                  
                                                    <h6 class="d-block text-dark"> {{$uo->order_number}} </h6>

                                                </div>
                                            </div>

                                        </td>

                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h6 class="d-block text-dark"> {{$uo->addres}} </h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                <h6 class="d-block text-dark"> {{$uo->price}} </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                <h6 class="d-block text-dark"> {{$uo->payment_status}} </h6>
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