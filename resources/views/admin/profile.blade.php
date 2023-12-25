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
                    <h6 class="m-0 font-weight-bold text-secondary">Profile Detail</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.profile_store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="formGroupExampleInput">Username</label>
                          <input type="text" class="form-control" id="username" name="username" value="{{ $admin_profile_data->username }}">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $admin_profile_data->name }}">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $admin_profile_data->email }}">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $admin_profile_data->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $admin_profile_data->address }}">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Photo</label>
                            <input type="file" class="form-control-file" id="photo" name="photo" value="{{ $admin_profile_data->photo }}">
                        </div>
                        <div class="form-group">
                            <img id="showimage" class="img-profile rounded-circle" width="100"
                            src="{{ (!empty($admin_profile_data->photo)) ? 
                            url('upload/admin_images/'.$admin_profile_data->photo) : url('upload/undraw_profile.svg') }}" >
                        </div>
                        <hr>
                        <button class="btn btn-secondary">Update Profile</button> <a class="btn btn-danger" href="{{ route('admin.dashboard') }}">Cancel</a>
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