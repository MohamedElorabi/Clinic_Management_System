@extends('dashboard.layouts.app')
@inject('patients', 'App\Models\Patient')
@section('content')


@if(!empty($reveal->details))

<div class="row">
    <div class="col-md-6 col-12"> 
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">عرض بيانات أخر كشف</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
            <div class="form form-vertical" enctype='multipart/form-data'>
                    <input type="hidden" name="_method" value="PUT">
                   @csrf
                    <div class="form-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label>حالة الكشف</label>
                                    <input type="text" value="{{$reveal->status}}" disabled class="form-control" name="status">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>اسم المريض</label>
                                    <input type="text" value="{{$reveal->patient->name}}" disabled class="form-control" name="patient_id">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>الحالة المرضية</label>
                                    <fieldset class="form-group">
                                        <textarea name="pathological_case" disabled  class="form-control" id="" rows="3">{{$reveal->details->pathological_case}}</textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>التشخيص</label>
                                    <fieldset class="form-group">
                                        <textarea name="diagnosis"  class="form-control" disabled id="" rows="3">{{$reveal->details->diagnosis}}</textarea>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>الأدوية</label>
                                    <fieldset class="form-group">
                                        <textarea name="pharmaceutical" class="form-control" disabled id="" rows="3">{{$reveal->details->pharmaceutical}}</textarea>
                                    </fieldset>
                                </div>
                            </div>
                            

                            <div class="col-12">
                                <div class="form-group">
                                    <label>سعر الكشف</label>
                                    <input type="text" value="{{$reveal->fees}}" disabled class="form-control" name="fees">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>سعر أعمال أخرى</label>
                                    <input type="text" value="{{$reveal->fees_other}}" disabled class="form-control" name="fees_other">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label>مرفقات</label>
                                    <input type="file" multiple class="form-control" name="attachments[]">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    @foreach($reveal->attachments as $attachment)
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




    <div class="col-md-6 col-12"> 
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">إضافة تشخيص جديد</h4>
          </div>
          <div class="card-content">
              <div class="card-body">
              <form class="form form-vertical" action="{{route('reveals.create-Diagnosis')}}" method="POST" enctype='multipart/form-data'>
                     @csrf
                      <div class="form-body">
                          <div class="row">
                          <input type="hidden" name="reveal_id" value="{{$reveal->id}}">
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
                                  <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">حفظ</button>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
  
              
          </div>
        </div>
    </div>
   
</div>

@else 


<div class="alert alert-danger" role="alert">
    <h2>لا يوجد بيانات يمكنك اضافة تشخيص جديد</h2>
</div>
  
  <div class="col-md-6 col-12"> 
    <div class="card">
      <div class="card-header">
          <h4 class="card-title">إضافة تشخيص جديد</h4>
      </div>
      <div class="card-content">
          <div class="card-body">
          <form class="form form-vertical" action="{{route('reveals.create-Diagnosis')}}" method="POST" enctype='multipart/form-data'>
                 @csrf
                  <div class="form-body">
                      <div class="row">
                      <input type="hidden" name="reveal_id" value="{{$reveal->id}}">
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
                              <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">حفظ</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>

          
      </div>
    </div>
</div>


  
@endif

<script>
    function deleItem(item) { 

        $("#test-"+item).css("display", "none");
        // var _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        url: "/delte_imge",
        type:"DELETE",
        data:{
          image_id:item,
          reveal_id:"{{$reveal->id}}",
          _token:"{{ csrf_token() }}"
        
        },

     });
    }
   
</script>



@endsection
