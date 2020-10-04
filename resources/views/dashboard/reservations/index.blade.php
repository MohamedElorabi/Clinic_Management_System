@extends('dashboard.layouts.app')

@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
           <div class="card">
            @include('flash::message')
            <div class="card-header">
                <h4 class="card-title">عرض قائمة الحجز</h4>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                            <table class="table zero-configuration dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending"> #الرقم</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">حالة الحجز</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">اسم المريض</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">موعد الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">السعر</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">اضافة الى كشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Edit: activate to sort column ascending">تعديل</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Delete: activate to sort column ascending">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>                      
                                
                                @foreach($reservations as $reservation)
                                <tr class="text-center">
                                    <th>{{$reservation->id}}</th>
                                    <td>{{$reservation->status}}</td>
                                    <td>{{$reservation->patient->name}}</td>
                                    <td>{{$reservation->reservation_time}}</td>
                                    <td>{{$reservation->fees}}</td>
                                    
                                    <td>
                                    <form class="add_reveals" action="{{route('add-to-reveals') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                             <button type="submit" class="btn btn-info" >
                                                <i class="fa fa-plus"></i>
                                             </button>
                                         </form>
                                    <td>
                                    @if (auth()->user()->hasPermission('update-reservations'))
                                        <a href="{{url(route('reservations.edit', $reservation->id))}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @else
                                    <button type="submit" class="btn btn-success btn-xs disabled"><i class="fa fa-edit"></i></button>
                                    @endif
                                    </td>
                                    <td>
                                    @if (auth()->user()->hasPermission('delete-reservations'))
                                    <form method="post" action="{{ route('reservations.destroy', $reservation->id)}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                    @else
                                    <button type="submit" class="btn btn-danger btn-xs disabled"><i class="fa fa-trash-o"></i></button>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>


@endsection
@section('script')
<script>

$('.add_reveals').on('submit', function(){

    formdata   = new FormData(this);
    var action   = this.action;
   
    $.ajax({
        url: "{{route('add-to-reveals')}}",
        type: "POST",
        data: formdata,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            console.log($data)

        }, error : function(reject){

        },
    });

    // return false;
});

</script>

@endsection
