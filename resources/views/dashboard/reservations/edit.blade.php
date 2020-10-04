@extends('dashboard.layouts.app')
@inject('patients', 'App\Patient')
@section('content')

<div class="col-md-6 col-12">
    <div class="card">
    @include('dashboard.partials.validations_errors')
        <div class="card-header">
            <h4 class="card-title">تعديل بيانات الحجز</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('reservations.update', $reservation->id)}}" method="POST">
                   @csrf
                   @method('PATCH')
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label>اسم المريض</label>
                                <select name="patient_id" class="form-control">
                               
                                    @foreach($patients->get() as $patient)
                                    <option value="{{$patient->id}}" {{$patient->id==$reservation->patient_id ? 'selected':''}}>{{$patient->name}}</option>
                                    @endforeach
                               
                                </select>
                                <!-- <input type="text" class="form-control" value="{{$reservation->patient->name}}" name="patient_id"> -->
                            </fieldset>
                            </div>

                            <div class="col-12">
                            <fieldset class="form-group">
                                <label>نوع الحجز</label>
                                <select name="status" id="status"  class="form-control">
                                    <option>{{$reservation->status}}</option>
                                </select>
                            </fieldset>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>موعد الحجز</label>
                                    <input type="datetime-local" class="form-control" value="{{$reservation->reservation_time}}" name="reservation_time">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>السعر</label>
                                    <input type="text" class="form-control" value="{{$reservation->fees}}" name="fees">
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">تعديل بيانات الحجز</button>
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
