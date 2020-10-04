@extends('dashboard.layouts.app')

@section('content')

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
           <div class="card">
            @include('flash::message')
            <div class="card-header">
                <h4 class="card-title">عرض بيانات المرضى</h4>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                            <table class="table zero-configuration dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 173px;">كود المريض</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 274px;">الاسم</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 38px;">السن</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 128px;">رقم الهاتف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address date: activate to sort column ascending" style="width: 104px;">العنوان</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address date: activate to sort column ascending" style="width: 104px;">عرض</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Edit: activate to sort column ascending" style="width: 88px;">تعديل</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Delete: activate to sort column ascending" style="width: 88px;">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>                      
                                @foreach($patients as $patient)
                                    <tr role="row" class="odd">
                                        <th>{{$patient->patient_code}}</th>
                                        <td>{{$patient->name}}</td>
                                        <td>{{$patient->age}}</td>
                                        <td>{{$patient->phone}}</td>
                                        <td>{{$patient->address}}</td>
                                        <td>
                                            @if (auth()->user()->hasPermission('read-patients'))
                                                <a href="{{url(route('patients.show', $patient->id))}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            @else
                                            <button type="submit" class="btn btn-success btn-xs disabled"><i class="fa fa-edit"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                        @if (auth()->user()->hasPermission('update-patients'))
                                            <a href="{{url(route('patients.edit', $patient->id))}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        @else
                                        <button type="submit" class="btn btn-success btn-xs disabled"><i class="fa fa-edit"></i></button>
                                        @endif
                                        </td>
                                        
                                        <td>
                                        @if (auth()->user()->hasPermission('delete-patients'))
                                        <form method="post" action="{{ route('patients.destroy', $patient->id)}}">
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

