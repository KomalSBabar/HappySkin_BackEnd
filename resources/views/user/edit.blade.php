@extends('layout.default')
@section('content')

<p style="padding-top: 75px;"> Edit user Page</p>

<form  action="{{route('user.update',[$user->id]) }}"  method="POST">
    

@csrf
    @method('Post')
   
    <div class="form-outline mb-4">
        <label class="form-label" for="form31cg"> user name</label>
        <input type="text" id="form3Example1cg" name="name" value="{{$user->name}}" class="form-control form-control-sm" />

    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="form3Excg"> user email</label>
        <input type="text" id="form3Example1cg" name="email" value="{{$user->email}}" class="form-control form-control-sm" />

    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="formcg"> phone number</label>
        <input type="text" id="form3Example1cg" name="phone_no" value="{{$user->phone_no}}" class="form-control form-control-sm" />

    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="form3cg"> gender </label>
        <!-- <input type="text" id="form3Example1cg" name="title" value="{{$user->gender}}" class="form-control form-control-sm" /> -->
        <select class="form-control"   value="{{$user->gender}}" name="gender">

            <option> Select</option>
            <option>Female</option>
            <option>male</option>
        </select>
    </div>

    <div class="d-flex justify-content-center">
      <button type="submit"  >submit</button>
      <button type="submit"> <a href="{{ route('user.index')}}">Back</a></button>
    </div>

    

</form>
 @endsection