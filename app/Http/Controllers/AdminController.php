<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDashboard(){
        return view('admin.index');
    }

    public function chart(){
        return view('admin.chart');
    }

    public function adminProfile(){
        $id = Auth::user()->id;
        $admin_profile_data = User::find($id);
        return view('admin.profile', compact('admin_profile_data'));
    }

    public function adminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function adminChangePassword(){
        $id = Auth::user()->id;
        $admin_profile_data = User::find($id);
        return view('admin.change_password', compact('admin_profile_data'));
    }

    public function adminChangePasswordStore(Request $request){
        // validate data
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|same:password_confirmation|min:3',
        ]);

        // Match old password
        // if (!Hash::check($request->old_password, auth::user()->password)) {
        //     $notification = array(
        //         'message' => 'Old password dows not match',
        //         'alert-type' => 'error'
        //     );
        //     return back()->with($notification);
        // }

        // Update Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password changed successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    public function adminLogin(){
        return view('admin.admin_login');
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }
}
