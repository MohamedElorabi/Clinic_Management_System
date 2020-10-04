<?php 

namespace App\Http\Controllers;

use App\Models\Details;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Reveal;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  public function __construct(){
    $this->middleware(['permission:read-patients'])->only('index');
    $this->middleware(['permission:create-patients'])->only('create');
    $this->middleware(['permission:update-patients'])->only('update');
    $this->middleware(['permission:delete-patients'])->only('destroy');
  }

  
  public function index()
  {
    $patients = Patient::all();
    return view('dashboard.patients.index', compact('patients'), ['title' => 'عرض بيانات المرضى']);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('dashboard.patients.create', ['title' => 'إنشاء بيانات المرضى']);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    $this->validate($request,[
      'name' => ['required', 'string', 'max:255'],
      'age' => ['required', 'max:2'],
      'phone' => ['required'],
      'address' => ['required']
    ]);
    $data =   $request->all() ;
    $data['patient_code'] = rand(10000,99999);
    $patient = Patient::create($data);
    flash()->success('تمت الإضافة بنجاح');
    return redirect(route('patients.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $patient = Patient::findOrFail($id);
    return view('dashboard.patients.show',compact('patient'));
  }

  public function details($id)
  {
    $reveal = Reveal::findOrFail($id);
    $details = Details::all();
    return view('dashboard.patients.show_details',compact('reveal', 'details'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $patient = Patient::findOrFail($id);
    return view('dashboard.patients.edit', compact('patient'), ['title' => 'تعديل بيانات المرضى']);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $patient = Patient::findOrFail($id);
    $patient->update($request->all());
    flash()->success('تم التعديل بنجاح');
    return redirect(route('patients.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    try{

      DB::beginTransaction();  
      $patient = Patient::find($id)->reveals()->delete();
      $patient = Patient::find($id)->delete();
      DB::commit();
      flash()->success('تم الحذف بنجاح');
      return redirect(route('patients.index'));

    }catch(\Exception $ex){
      DB::rollBack();
    }
    
  }



  
  
}

