@extends('admin.dashboard')
@section('title',' Profile')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Admin Profile</h1><p></p>

    <!-- Content Row -->
    <div class="row">
        <!-- Donut Chart -->
        <div class="col-xl-3 col-lg-3">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                {{-- <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Full Name</h6>
                </div> --}}
                <!-- Card Body -->
                <div class="card-body" >
                    <img class="img-profile rounded-circle"
                    src="{{ (!empty($admin_profile_data->photo)) ? 
                    url('upload/admin_images/'.$admin_profile_data->photo) : url('upload/undraw_profile.svg') }}" >
                    <hr>
                    <h1 class="h3 mb-0 text-gray-800 font-weight-bold " style="text-align: center;">{{ $admin_profile_data->name }}</h1><hr>
                    <h1 class="h5 text-gray-600 mb-3" ><strong>Username:</strong> {{ $admin_profile_data->username }}</h1>
                    <h1 class="h5 text-gray-600 mb-3" ><strong>Role:</strong> Lead System and Software Enginner</h1>
                    <h1 class="h5 text-gray-600 mb-3" ><strong>Email:</strong> {{ $admin_profile_data->email }}</h1>
                    <h1 class="h5 text-gray-600 mb-3" ><strong>Phone:</strong> {{ $admin_profile_data->phone }}</h1>
                    <h1 class="h5 text-gray-600 mb-3" ><strong>Address:</strong> {{ $admin_profile_data->address }}</h1>
                    <h1 class="h6 text-gray-500 mb-3" style="text-align: center;">Camara Education Ethiopia</h1>
                </div>
                
            </div>
        </div>

        
        <div class="col-xl-6 col-lg-6">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">Change Password</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.change_password_store') }}">
                        @csrf
                        <div class="form-group">
                          <label for="formGroupExampleInput">Old Password</label>
                          <input type="password" class="form-control  @error('old_password') is-invalid @enderror " id="old_password" name="old_password" >
                          @error('old_password') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput">New Password</label>
                          <input type="password" class="form-control  @error('new_password') is-invalid @enderror " id="new_password" name="new_password" >
                          @error('new_password') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Confirm New Password</label>
                            <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" 
                            id="password_confirmation" name="password_confirmation" >
                            @error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror
                        </div>


                        <hr>
                        <button class="btn btn-secondary">Change Password</button> <a class="btn btn-danger" href="{{ route('admin.dashboard') }}">Cancel</a>
                      </form>
                
                </div>
            </div>
        </div>

        
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#photo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showimage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection