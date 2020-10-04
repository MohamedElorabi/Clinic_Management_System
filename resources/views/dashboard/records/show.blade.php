@extends('dashboard.layouts.app')

@section('content')



<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">البيانات الشخصية للمريض</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                    <table>
                       
                        <tbody>
                          <tr>
                            <td class="font-weight-bold">اسم المريض :</td>
                            <td>{{$record->name}}</td>
                          </tr>
                        <tr>
                            <td class="font-weight-bold">السن :</td>
                            <td>{{$record->age}}</td>
                        </tr>
                    </tbody></table>
                </div>
                <div class="col-12 col-md-12 col-lg-5">
                    <table class="ml-0 ml-sm-0 ml-lg-0">
                        <tbody><tr>
                            <td class="font-weight-bold">رقم التليفون :</td>
                            <td>{{$record->phone}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">العنوان :</td>
                            <td>{{$record->address}}</td>
                        </tr>
            
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!empty($record->reveal))
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
           <div class="card">
            @include('flash::message')
            <div class="card-header">
                <h4 class="card-title">عرض قائمة الكشف</h4>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                            <table class="table zero-configuration dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">حالة الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">موعد الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">عرض</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>                      
                                    @foreach($record->reveals as $reveal)
                                    <tr>
                                        <td>{{$reveal->status}}</td>
                                        <td>{{$reveal->detection_date}}</td>
                                        <td>
                                            @if (auth()->user()->hasPermission('read-reveals'))
                                                <a href="{{url(route('record_details', $reveal->id))}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            @else
                                            <button type="submit" class="btn btn-primary btn-xs disabled"><i class="fa fa-eye"></i></button>
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
@else
<div class="alert alert-danger" role="alert">
    <h2>لا يوجد بيانات كشف </h2>
</div>

@endif


@endsection