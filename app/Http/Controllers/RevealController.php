<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reveal;
use App\Models\Patient;
use App\Models\Attachment;
use App\Classes\FileOperations;
use App\Models\Details;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RevealController extends Controller
{

  private $directory = 'reveals';
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  public function __construct(){

    $this->middleware(['permission:read-reveals'])->only('index');
    $this->middleware(['permission:create-reveals'])->only('create');
    $this->middleware(['permission:update-reveals'])->only('update');
    $this->middleware(['permission:delete-reveals'])->only('destroy');

  }


  public function index()
  {
    $reveals= Reveal::where('is_finished' , 0)->orderBy('id','DESC')->get();
    return view('dashboard.reveals.index', compact('reveals'), ['title' => 'عرض بيانات الكشف']);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $patients = Patient::all();
    
    return view('dashboard.reveals.create',compact('patients'), ['title' => 'انشاء بيانات الكشف']);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    $last_reveal_num = Reveal::whereDate('created_at',Carbon::today())->max('reveal_num');
    $current_num = 1;
    if($last_reveal_num){
      $current_num += $last_reveal_num;
    }
    $this->validate($request,[
      'status' => ['required'],
    ]);
    
    if($request->status == 'new'){
      
      $patient = Patient::create([
        'name' => $request->patient_name,
        'phone' => $request->phone,
        'patient_code' => rand(10000,99999),
      ]);
      
    }else{
      $patient = Patient::find($request->patient_id);
    }
    // dd($request->all());
    $data = $request->all();
    $data['patient_id'] =  $patient->id;
    $data['reveal_num'] = $current_num;
    $reveal = Reveal::create($data);
    
    $detail = $reveal->details()->create([
      'reveal_id' => $reveal->id,
      'pathological_case'      => $request->pathological_case,
      'diagnosis'              => $request->diagnosis,
      'pharmaceutical'         => $request->pharmaceutical,
   ]);
    if($request->hasFile('attachments')){
      $images = $request->file('attachments');
      foreach ($images as $image) {
          $pathAfterUpload = FileOperations::StoreFileAs($this->directory, $image, str_random(10));
          $includesimage[] = $pathAfterUpload;
      }

     foreach ($includesimage as $key => $value) {
       $Attach_data[] = [
         'value'=>$value
       ];
      }
     
      $reveal->attachments()->createMany($Attach_data);

    }

    flash()->success('تمت الإضافة بنجاح');
    return redirect(route('reveals.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $reveal = Reveal::with('details')->findOrFail($id);
    $details = Details::all();
    return view('dashboard.reveals.show',compact('reveal', 'details'), ['title' => 'عرض بيانات الكشف']);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $reveal = Reveal::findOrFail($id);
    $details = Details::all();
    return view('dashboard.reveals.edit', compact('reveal' , 'details', 'id'), ['title' => 'تعديل بيانات الكشف']);
  }

  public function trash_img(Request $request)
  {

    Attachment::where('id', $request['image_id'])->where('ref_id', $request['reveal_id'])->delete();

    return response()->json();

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
    $reveal = Reveal::findOrFail($id);

    $reveal->update($request->all());
    // dd($request->file('attachments'));
    if($request->hasFile('attachments')){
      $images = $request->file('attachments');
      foreach ($images as $image) {
          $pathAfterUpload = FileOperations::StoreFileAs($this->directory, $image, str_random(10));
          $includesimage[] = $pathAfterUpload;
      }

     foreach ($includesimage as $key => $value) {
       $data[] = [
         'value'=>$value
       ];
       $reveal->attachments()->delete();
      }

      $reveal->attachments()->createMany($data);
    }

    flash()->success('تم التعديل بنجاح');
    return redirect(route('reveals.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    // $reveal = Reveal::find($id)->patient()->delete();
     $reveal = Reveal::find($id);
     $reveal->delete();
    flash()->success('تم الحذف بنجاح');
    return redirect(route('reveals.index'));
  }



  public function isFinished($id)
  {
    $reveal = Reveal::find($id);
    // return $reveal;
    $reveal->update(['is_finished' => 1]);
    
    flash()->success('تم  بنجاح');
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
    ])->with('reveals.details')->get();
      return response()->json(['result'=>$p]);
  }


  public function createDiagnosis(Request $request){
    // dd($request->all());
    $this->validate($request,[
      'pathological_case' => ['required'],
      'diagnosis' => ['required'],
      'pharmaceutical' => ['required'],
    ]);
    $details = Details::create($request->all());
    if($request->hasFile('attachments')){
      $images = $request->file('attachments');
      foreach ($images as $image) {
          $pathAfterUpload = FileOperations::StoreFileAs($this->directory, $image, str_random(10));
          $includesimage[] = $pathAfterUpload;
      }
      foreach ($includesimage as $key => $value) {
        $Attach_data[] = [
          'value'=>$value
        ];
       }
      
     $details->attachments()->createMany($Attach_data);
  }
  flash()->success('تمت الإضافة بنجاح');
  return redirect(route('reveals.index'));
 }

 public function getData($id){
      $patient = Patient::with('reveals.details.attachments')->find($id);
      if($patient->reveal->details->attachments){
        return response()->json([
          'result'=>$patient->reveal->details,
          ]);
      }else{
        return response()->json(['result'=>'there is no data']);
      }
  }
}


