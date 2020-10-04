@extends('dashboard.layouts.app')

@section('content')
<div class="col-md-6 col-12">
    <div class="card">
    @include('dashboard.partials.validations_errors')
        <div class="card-header">
            <h4 class="card-title">انشاء بيانات سجل جديد</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('records.store')}}" method="POST" enctype='multipart/form-data'>
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
                                <div class="form-group">
                                    <label>الحالة المرضية</label>
                                    <fieldset class="form-group">
                                        <textarea name="pathological_case" class="form-control" id="" rows="3"></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>التشخيص</label>
                                    <fieldset class="form-group">
                                        <textarea name="diagnosis" class="form-control" id="" rows="3"></textarea>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>الأدوية</label>
                                    <fieldset class="form-group">
                                        <textarea name="pharmaceutical" class="form-control" id="" rows="3"></textarea>
                                    </fieldset>
                                </div>
                            </div>
                         

                            <div class="col-12">
                                <div class="form-group">
                                    <label>مرفقات</label>
                                    <input type="file" multiple class="form-control" name="attachments[]">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">انشاء سجل</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
