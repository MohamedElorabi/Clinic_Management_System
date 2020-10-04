@extends('dashboard.layouts.app')

@section('content')
<div class="col-md-6 col-12">
    <div class="card">
    @include('dashboard.partials.validations_errors')
        <div class="card-header">
            <h4 class="card-title">انشاء بيانات المريض</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('patients.store')}}" method="POST">
                   @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">الاسم</label>
                                    <input type="text" id="first-name-vertical" class="form-control" name="name">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label>السن</label>
                                    <input type="number" id="age" class="form-control" name="age">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    <input type="number" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">انشاء بيانات مريض</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection