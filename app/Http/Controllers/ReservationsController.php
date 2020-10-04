<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Patient;
use App\Models\Reveal;
use Carbon\Carbon;
class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware(['permission:read-reservations'])->only('index');
        $this->middleware(['permission:create-reservations'])->only('create');
        $this->middleware(['permission:update-reservations'])->only('update');
        $this->middleware(['permission:delete-reservations'])->only('destroy');
        
      }
    public function index()
    {
        $reservations = Reservation::paginate(5);
        return view('dashboard.reservations.index', compact('reservations'), ['title' => 'عرض بيانات الحجز']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $patients = Patient::all();
      $reservations = Reservation::get();
      return view('dashboard.reservations.create',compact('patients', 'reservations'), ['title' => 'إنشاء حجز جديد']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // add new patient and return instance from it;
        if($request->has('addPatient')){
             $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'max:2'],
            'phone' => ['required'],
            'address' => ['required']
          ]);
          $data =   $request->all() ;
          $data['patient_code'] = rand(10000,99999);
          $patient = Patient::create($data);
          return $patient;
        }
        //add new reservation
        $this->validate($request,[
            'status' => ['required'],
            'patient_id' => ['required', 'max:2'],
            'reservation_time' => ['required'],
            'fees' => ['required'],

          ]);
          $reservation = Reservation::create($request->all());
          flash()->success('تمت الإضافة بنجاح');
          return redirect(route('reservations.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('dashboard.reservations.edit', compact('reservation' , 'id'), ['title' => 'تعديل بيانات الحجز']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());
        flash()->success('تم التعديل بنجاح');
        return redirect(route('reservations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $reservation = Reservation::find($id);
       if($reservation) {
          $reservation->delete();
          flash()->success('تم الحذف بنجاح');
          return redirect(route('reservations.index'));
        }else{
            
            flash()->success('عفوا هذا الحجز غير موجود تأكد من البيانات');
            return redirect(route('reservations.index'));

       }
    }

    public function toReveal(Request $request)
    {  
      $reservation =   Reservation::with('reveal')->find($request->reservation_id);
      $patient = Patient::where('id',$reservation->patient_id)->first();

      $last_reveal_num = Reveal::whereDate('created_at', Carbon::today())->max('reveal_num');
        $current_num = 1;
        if($last_reveal_num){
          $current_num += $last_reveal_num;
      }
      $reveal = Reveal::create(['patient_id'=>$patient->id ,'phone'=>$patient->phone,
                                 'status'=>$reservation->status,
                                 'detection_date'=>$reservation->reservation_time,
                                 'fees'=>$reservation->fees,
                                 'reveal_num' => $current_num ]);
      $patient->reveals()->save($reveal);
      $reservation->delete();
      return redirect(route('reveals.index'));
    }

    public function search(Request $request)
    {
      $p = Patient::where([
        ['name','like','%'.$request->search.'%'],
      
      ])->orWhere([
              ['patient_code','like','%'.$request->search.'%'],
      ])->orWhere([
        ['phone','like','%'.$request->search.'%'],
      ])->with('reveals')->get();
        // dd($p);
        return response()->json(['result'=>$p]);
    }
}
