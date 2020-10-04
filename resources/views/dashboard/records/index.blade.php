@extends('dashboard.layouts.app')

@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
           <div class="card">
            @include('flash::message')
            <div class="card-header">
                <h4 class="card-title">عرض قائمة السجلات السابقة</h4>
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
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">اسم المريض</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">العمر</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">رقم الهاتف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">العنوان</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">التشخيص</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">عرض</th>
                                    </tr>
                                </thead>
                                <tbody>                      
                                @foreach($records as $record)
                                <tr class="text-center">
                                    <th>{{$record->id}}</th>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->age}}</td>
                                    <td>{{$record->phone}}</td>
                                    <td>{{$record->address}}</td>
                                    <td>
                                        @if(isset($record->reveal->details->diagnosis))
                                            {{ $record->reveal->details->diagnosis}}
                                        @endif

                                    </td>
                                    <td>
                                        {{-- @if (auth()->user()->hasPermission('read-records')) --}}
                                            <a href="{{url(route('records.show', $record->id))}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        {{-- @else
                                        <button type="submit" class="btn btn-success btn-xs disabled"><i class="fa fa-primary"></i></button>
                                        @endif --}}
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



