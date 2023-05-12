@extends('layout.default')
@section('content')

<div class="main-panel">
  <div class="container-fluid">

    <div class="row">

      <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
          <div class="card-header">
            <h2> User Details</h2>


          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->

                    <a href="{{ route('user.create')}}"> <button class="btn product_button btn-outline-dark my-2 my-sm-0" type="submit">create user </button></a>
                  </tr>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 30px;">id</th>
                    <th class=" py-3 px-4" style="width: 700px; text-align:center;">Details </th>
                    <th class=" py-3 px-4" style="width: 700px; text-align:center;">update </th>
                  </tr>

                </thead>
                <tbody>
                  @foreach($users as $key => $user )
                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">
                        <div class="media-body">

                          {{$key + 1}}
                        </div>
                      </div>
                    </td>
                    <td class="p-4">
                      <div class="media align-items-center">
                        <div class="media-body">

                          <h6 class="d-block text-dark"> Name :{{$user->name}} </h6>
                          <h6 class="d-block text-dark"> Email : {{ $user->email}}</h6>
                          <h6 class="d-block text-dark"> Phone number: {{ $user->phone_no}}</h6>
                          <h6 class="d-block text-dark"> Gender : {{ $user->gender}}</h6>
                          <h6 class="d-block text-dark"> Role: {{ $user->role}}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h6 class="d-block btn btn-primary"><a href="{{ route('user.edit',[$user->id]) }}">edit</h6>

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
  @endsection