@extends('dashboard.layouts.app')

@section('content')
<div class="col-md-6 col-12">
    <div class="card">
    @include('dashboard.partials.validations_errors')
        <div class="card-header">
            <h4 class="card-title">انشاء بيانات كشف جديد</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('reveals.store')}}" method="POST" enctype='multipart/form-data'>
                   @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                            <fieldset class="form-group">
                                <label>حالة الكشف</label>
                                <select name="status" id="status"  class="form-control">
                                    <option disabled selected>نوع الكشف</option>
                                    <option value="new">جديد</option>
                                    <option value="old">متابعة</option>
                                </select>
                            </fieldset>
                            </div>
                            <div class="col-12" id="patients-div" style="display:none;">

                            </div>

                          
                               
                            <div class="col-12">
                                <div class="form-group">
                                    <label>الحالة المرضية</label>
                                    <fieldset class="form-group">
                                    <textarea name="pathological_case" id="pathological_case" value="" class="form-control" rows="3"></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>التشخيص</label>
                                    <fieldset class="form-group">
                                        <textarea name="diagnosis" id="diagnosis" value="' + patient.id + '" class="form-control" rows="3"></textarea>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>الأدوية</label>
                                    <fieldset class="form-group">
                                        <textarea name="pharmaceutical" id="pharmaceutical" value="" class="form-control" rows="3"></textarea>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>تكلفة الكشف</label>
                                    <input type="text" class="form-control" name="fees">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>تكلفة أعمال أخرى</label>
                                    <input type="text" class="form-control" name="fees_other">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>مرفقات</label>
                                    <input type="file" multiple class="form-control" name="attachments[]">
                                </div>
                            </div>

                            <div id="show-images" style="margin-bottom: 20px"></div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">اضافة كشف جديد</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
$('#status').change(function(){
   var item = $(this).val();
   if(item == "old"){
           var str = "<div class='col-12 wrap'>"
                        +" <div class='form-group'>"
                            +"<input type='text' class='form-control' value='' id='search' placeholder='search' name='search'>"
                        +"</div>"
                        +"<select name='patient_id' class='form-control' id='show-patients' style='display:none;'>"
                        +"<option>اختر اسم المريض</option>"
                        +"</select>"
                    +"</div>"
             +"</div>";
        $('#patients-div').show();
        $('#patients-div').html(str);
        
        }else if(item == "new"){
            var str = "<div class='col-12'>"
                        +"<div class='form-group'>"
                            +"<label>اسم المريض</label>"
                            +"<input type='text' class='form-control' value='' name='patient_name'>"
                        +"</div>"
                        +"<div class='form-group'>"
                            +"<label>رقم الهاتف</label>"
                            +"<input type='text' class='form-control' value='' name='phone'>"
                        +"</div>"
                        +"</div>";
                        
        $('#patients-div').show();
        $('#patients-div').html(str);
        }else{

        $('#patients-div').hide();
        }

});

</script>
<script>
    $(document).on('keyup','#search' ,function(){
        var search = $(this).val();
        if(search != ''){
            $.ajax({
            
            url: "/reveals/search",
            data:{
                search
            },
            success:function(response) {
    
               $('#show-patients').show();             
               var str = ["<option selected > اختر اسم المريض</option"];
           $.each(response['result'], function(k, v) {
                   str.push ("<option value="+v['id']+">"+v['name']+"</option>");
            });
        
            $('#show-patients').html(str);

            // var patient_id = $('#show-patients').val();

            },     
            
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            },
        });
        }else{
            $('#show-patients').hide();

            $('#pathological_case').val('');
            $('#diagnosis').val('');
            $('#pharmaceutical').val('');
        }
  
    });

    $(document).on("change", "#show-patients", function(){
        var id = $(this).val();
        $.ajax({
            url: "/reveals/get-data-reveal/" + id,
          
            success: function (response) {
                var str =[];
                $('#pathological_case').val(response['result'].pathological_case);
                $('#diagnosis').val(response['result'].diagnosis);
                $('#pharmaceutical').val(response['result'].pharmaceutical);
                var str = [];
                
                $.each(response['result']['attachments'], function(k,v) {
                   str.push ("<img width='150px' height='250px' src='{{asset('storage/')}}/"+v['value']+"'>");
            });
            $('#show-images').html(str);
            }
        });
    });

    </script>

@endsection
