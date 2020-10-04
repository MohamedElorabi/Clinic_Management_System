@extends('dashboard.layouts.app')

@section('content')

<div class="row">
<div class="col-md-6 col-12">
    <div class="card">
    @include('dashboard.partials.validations_errors')
        <div class="card-header">
            <h4 class="card-title">انشاء بيانات المريض</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form id="addPatient" class="form form-vertical" action="{{route('reservations.store')}}" method="POST">
                   @csrf
                    <div class="form-body">
                        <div class="row">

                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">الاسم</label>
                                    <input type="text" id="name" class="form-control" name="name">
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
                                    <input type="number" id="phone" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <input type="text" id="address" class="form-control" name="address">
                                </div>
                            </div>

                            <div class="col-12">
                                <input type="hidden" name="addPatient" value="1">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">اضافة مريض للحجز</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="col-md-6 col-12">
    <div class="card">
    @include('dashboard.partials.validations_errors')
        <div class="card-header">
            <h4 class="card-title">انشاء بيانات الحجز</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('reservations.store')}}" method="POST">
                   @csrf
                    <div class="form-body">
                        <div class="row">

                            <div class="col-12">
                                <fieldset class="form-group">
                                    <label>حالة الحجز</label>
                                    <select name="status" id="status"  class="form-control">
                                        <option disabled selected>نوع الكشف</option>
                                        <option value="new">جديد</option>
                                        <option value="old">متابعة</option>
                                        <option value="Surgery">عمليات</option>
                                    </select>
                                </fieldset>
                                </div>
                                <div class="col-12" id="patients-div" style="display:none;">
    
                                </div>

                          {{-- <div class="col-12">
                                  <fieldset class='form-group'>
                                    <label>اسم المريض</label>
                                    <select name='patient_id' id="allPatients" class='form-control'>
                                    @foreach($patients as $patient)
                                    <option value ='{{$patient->id}}' >{{$patient->name}}</option>
                                    @endforeach
                                    </select>
                                  </fieldset>
                              </div> --}}


                            <div class="col-12">
                                <div class="form-group">
                                    <label>موعد الحجز</label>
                                    <input type="datetime-local" class="form-control" name="reservation_time">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>السعر</label>
                                    <input type="text" class="form-control" name="fees">
                                </div>
                            </div>

                            <div class="col-12">
                                
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">انشاء حجز</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
                                +"<input type='text' class='form-control' id='search' placeholder='search' name='search'>"
                            +"</div>"
                            
    
                            +"<select name='patient_id' class='form-control' id='show-patients' style='display:none;'>"
                              
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
                            +"</div>";
                            
            $('#patients-div').show();
            $('#patients-div').html(str);
            }else{
    
            $('#patients-div').hide();
            }
    
    });
    
    </script>
<script>

$('#addPatient').on('submit', function(){

    formdata   = new FormData(this);

    $.ajax({
        url: "{{route('reservations.store')}}",
        type: "POST",
        data: formdata,
        mimeTypes: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
           
            var patient = '<option selected value='+ data.id +'>'+ data.name + '</option>';
            
            // $('#allPatients').html('');
            $('#allPatients').append(patient);

             // Clear the form.
             $('#name').val('');
             $('#age').val('');
             $('#phone').val('');
             $('#address').val('');

        }, error : function(reject){

            // var response = $.parseJSON(reject.responseText) ;

            // $.each (response.errors , function (key , val){

            //     $('#' + key + '_error').text(val[0]);
            // })
        },
    });

    return false;
});

</script>


<script>
    $(document).on('keyup','#search' ,function(){
        var search = $(this).val();
        if(search != ''){
            $.ajax({
            
            url: "/reservations/search",
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


            },     
            
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            },
        });
        }else{
            $('#show-patients').hide()
        }
  
    });
    </script>

@endsection
