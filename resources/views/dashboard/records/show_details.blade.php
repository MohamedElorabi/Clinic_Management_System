@extends('dashboard.layouts.app')
@section('content')


@if(!empty($reveal->details))

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="form form-vertical">
            
                <div class="form-body">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>الحالة المرضية</label>
                                <fieldset class="form-group">
                                <textarea name="pathological_case" class="form-control" id="" rows="3">{{$reveal->details->pathological_case}}</textarea>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>التشخيص</label>
                                <fieldset class="form-group">
                                    <textarea name="diagnosis" class="form-control" id="" rows="3">{{$reveal->details->diagnosis}}</textarea>
                                </fieldset>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>الأدوية</label>
                                <fieldset class="form-group">
                                    <textarea name="pharmaceutical" class="form-control" id="" rows="3">{{$reveal->details->pharmaceutical}}</textarea>
                                </fieldset>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label>مرفقات</label>
                                <div class="col-12">
                                    <div class="form-group">
                                        @foreach($reveal->details->attachments as $attachment)
                                        <div class="test" onclick="deleItem({{$attachment->id}})" id="test-{{$attachment->id}}"> 
                                            <span class="remImage" id="delete-{{$attachment->id}}"><i class="fas fa-trash-alt"></i>
                                            <img style="width:200px; height:200px " src="{{asset('storage/'.$attachment->value)}}"/></span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-danger" role="alert">
    <h2>لا يوجد بيانات كشف</h2>
</div>
@endif

@endsection