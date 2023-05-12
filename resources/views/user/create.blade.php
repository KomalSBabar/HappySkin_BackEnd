
@extends('layout.default')
@section('content')

<p> Create user page</p>

<form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="form-outline mb-4">
    <label class="form-label" for="form3Example1cg"> Name </label>
    <input type="text" name="name" class="form-control form-control-lg" />

  </div>
  
  <div class="form-outline mb-4">
    <label class="form-label" for="form3Example1cg">Email </label>
    <input type="email" name="email" class="form-control form-control-lg" />

  </div>
  <div class="form-outline mb-4">
  <label class="form-label" for="form3Example1cg">Select gender</label>
    <select class="form-control form-control-lg " name="gender">

      <option>Select gender</option>
      <option>female</option>
      <option>male</option>
    </select>
  </div>

  <div class="form-outline mb-4">
    <label class="form-label" for="form3Example4cg">phone number</label>
    <input type="text" name="phone" class="form-control form-control-lg" />
  </div>




  <div class="d-flex justify-content-center">
    <button type="submit">submit</button>
  </div>

</form>
@endsection