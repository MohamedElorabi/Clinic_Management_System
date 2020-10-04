<?php

namespace App\Http\Controllers;
use App\Models\Reveal;
use App\Models\Patient;
use App\Models\Attachment;
use App\Classes\FileOperations;
use App\Models\Details;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecordsController extends Controller

{
    private $directory = 'website/records';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Patient::with('reveals.details')->get();
        return view('dashboard.records.index', compact('records'),['title' => 'عرض سجلات المرضى السابقة']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.records.create', ['title' => 'إنشاء سجلات المرضى السابقة']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
          $record = Patient::create($data);


          $last_reveal_num = Reveal::whereDate('created_at',Carbon::today())->max('reveal_num');
          $current_num = 1;
          if($last_reveal_num){
            $current_num += $last_reveal_num;
          }
         $reveal =  Reveal::create([
              'patient_id'=>$record->id,
              'status'=>'old',
              'detection_date'=> now(),
              'fees'=> 0,
              'fees_other'=> 0,
              'reveal_num' => $current_num
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

         $reveal = $reveal->details()->create([
            'reveal_id' => $reveal->id,
            'pathological_case'      => $request->pathological_case,
            'diagnosis'              => $request->diagnosis,
            'pharmaceutical'         => $request->pharmaceutical,
         ]);

         flash()->success('تمت الإضافة بنجاح');
         return redirect(route('records.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $record = Patient::where('id', $id)->with('reveals.details')->first();

        return view('dashboard.records.show',compact('record'));
    }

    public function record_details($id)
    {
      $reveal = Reveal::findOrFail($id);
      $details = Details::all();
      return view('dashboard.records.show_details',compact('reveal', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Patient::findOrFail($id);
        return view('dashboard.records.edit', compact('record' , 'id'), ['title' => 'تعديل بيانات السجل']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
