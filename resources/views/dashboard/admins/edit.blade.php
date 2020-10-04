@extends('dashboard.layouts.app')
@section('content')

<div class="col-md-6 col-12">
    <div class="card">
    @include('dashboard.partials.validations_errors')
        <div class="card-header">
            <h4 class="card-title">تعديل بيانات مشرف</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('admins.update', $admin->id)}}" method="POST">
                   @csrf
                   {{ method_field('put')}}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">اسم المستخدم</label>
                                    <input type="text" id="first-name-vertical" value="{{ $admin->user_name }}" class="form-control" name="user_name">
                                </div>
                            </div>
                            
                           
                            <div class="col-12">
                                <div class="form-group">
                                    <label>كلمة المرور السابقة</label>
                                    <input type="password" class="form-control" name="old_password">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>كلمة المرو الجديدة</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>تأكيد كلمة المرو الجديدة</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="col-12">
                            <label>الأدوار</label>
                                <div class="form-group">
                               
                                    <select class="form-control" name="role_id">
                                        @foreach($roles as $role)
                                          <option value="{{ $role->id }}" {{$admin->hasRole($role->name) == $role->name?"selected":""}}>{{$role->name}}</option>    
                                        @endforeach                    
                                    </select>
                                </div>
                            </div>
                           
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection