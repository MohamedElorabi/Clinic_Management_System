<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware(['permission:read-users'])->only('index');
        $this->middleware(['permission:create-users'])->only('create');
        $this->middleware(['permission:update-users'])->only('update');
        $this->middleware(['permission:delete-users'])->only('destroy');
        
      }

      
    public function index()
    {
        $users = User::paginate(5);
        return view('dashboard.admins.index', compact('users'), ['title' => 'عرض بيانات المشرف']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'user_name' => ['required'],
            'password' => ['required', 'min:6','confirmed'],
          ]);
          $request_data = $request->except(['password']);
          $request_data['password'] = bcrypt($request->password);
          $user = User::create($request_data);
          $user->attachRole($request->role_id);
          flash()->success('تمت الاضافة بنجاح');
          return redirect(route('admins.index'));
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $roles = Role::all();
        return view('dashboard.admins.edit', compact('admin' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changePassword(UserRequest $request , $id)
    {
        $user = User::findOrFail($id);

        if (Hash::check($request->old_password, $user->password)){

            $user->password = bcrypt($request->password);
            $user->save();
            return back();
        }
          
    }
    
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $this->validate($request,[
            'user_name'    => ['required'],
            'old_password' => ['required'],
            'password'     => ['required' ,'confirmed'],
            'password_confirmation' => ['same:password'],
          ]);
          
          if (Hash::check($request->old_password, $user->password)){
            
            $user->update([
                'password' => Hash::make($request->password) ,
                'user_name' => $request->user_name ,
                'role_id'   =>$request->role_id

            ]);
              $user->syncRoles([$request->role_id]);
              flash()->success('تم التعديل بنجاح');
              return redirect(route('admins.index'));


          }else{
            
            flash()->success('خطا ف كلمة السر السابقة'); 
            return back();
          }
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return redirect(route('admins.index'));
    }
}
