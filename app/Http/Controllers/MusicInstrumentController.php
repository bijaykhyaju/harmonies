<?php

namespace App\Http\Controllers;

use App\MusicInstrument;
use App\InstrumentNote;
use App\InstrumentCollection;
use App\Music;
use App\MusicNote;
use App\MusicNoteIntervalTime;

use Illuminate\Http\Request;

use Auth;

class MusicInstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        //
        $default_instrument = MusicInstrument::where('user_id','0')
                                                ->where('default', '1')
                                                ->where('publish', '1')
                                                ->get();
        $added_instrument = MusicInstrument::where('user_id',Auth::user()->id)
                                                ->where('default', '0')
                                                ->get();
        return view('instrument_gallery', compact(['default_instrument', 'added_instrument']));
    }

    public function addInstrumentPage()
    {
        //
        return view('instrument');
    }

    public function publish(Request $request)
    {
        //Change the publish status of instrument
        //return "publish function";
        MusicInstrument::where('id', $request->id)->update([
            'publish' => request()->is_publish
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return dump(request()->all());
        $request->validate([
            'instrument_name' => 'required',
          ]);

        $instrumentRecordQuery = MusicInstrument::where('name', $request->instrument_name)
                              ->where('user_id',Auth::user()->id);

        $instrumentRecord = $instrumentRecordQuery->count();
        if($instrumentRecord>0){
              return "exist";
        }else{
              //return var_dump($request->note_select);
              $instrument = new MusicInstrument();
              $instrument->name = $request->instrument_name;
              $instrument->user_id = Auth::user()->id;
              $instrument->default = '0';
              $instrument->publish = '1';
              $instrument->save();

              $instrumentId = $instrument->id;

              $index = 1;
              foreach($request->note_select as $noteSelected){
                    $splitName = explode('_', $noteSelected);
                    $path_id = $splitName[0];
                    $name = $splitName[1];
                    $record=InstrumentCollection::getInstrumentById($path_id);
                    $file_name = $record->file_name;
                    $paren_record =  InstrumentCollection::getParentInstrumentById($record->parent_id);
                    $fullPath = $paren_record->file_path.$file_name;
                    $instrumentnote = new InstrumentNote();
                    $instrumentnote->name = $name;
                    $instrumentnote->index = $index;
                    $instrumentnote->file_full_path = $fullPath;
                    $instrumentnote->instrument_id = $instrumentId;
                    $instrumentnote->save();
                    $index++;
              }


              //$path = $request->note_1

              // $splitName = explode('_', $request->note_1);
              // $path_id = $splitName[0];
              // $name = $splitName[1];
              // $record=InstrumentCollection::getInstrumentById($path_id);
              // $file_name = $record->file_name;
              // $paren_record =  InstrumentCollection::getParentInstrumentById($record->parent_id);
              // $fullPath = $paren_record->file_path.$file_name;
              // $instrumentnote = new InstrumentNote();
              // $instrumentnote->name = $name;
              // $instrumentnote->index = '1';
              // $instrumentnote->description = $fullPath;
              // $instrumentnote->instrument_id = $instrumentId;
              // $instrumentnote->save();
              //
              // $splitName = explode('_', $request->note_2);
              // $path_id = $splitName[0];
              // $name = $splitName[1];
              // $record=InstrumentCollection::getInstrumentById($path_id);
              // $file_name = $record->file_name;
              // $paren_record =  InstrumentCollection::getParentInstrumentById($record->parent_id);
              // $fullPath = $paren_record->file_path.$file_name;
              // $instrumentnote = new InstrumentNote();
              // $instrumentnote->name = $name;
              // $instrumentnote->index = '2';
              // $instrumentnote->description = $fullPath;
              // $instrumentnote->instrument_id = $instrumentId;
              // $instrumentnote->save();
              //
              // $splitName = explode('_', $request->note_3);
              // $path_id = $splitName[0];
              // $name = $splitName[1];
              // $record=InstrumentCollection::getInstrumentById($path_id);
              // $file_name = $record->file_name;
              // $paren_record =  InstrumentCollection::getParentInstrumentById($record->parent_id);
              // $fullPath = $paren_record->file_path.$file_name;
              // $instrumentnote = new InstrumentNote();
              // $instrumentnote->name = $name;
              // $instrumentnote->index = '3';
              // $instrumentnote->description = $fullPath;
              // $instrumentnote->instrument_id = $instrumentId;
              // $instrumentnote->save();
              //
              // $splitName = explode('_', $request->note_4);
              // $path_id = $splitName[0];
              // $name = $splitName[1];
              // $record=InstrumentCollection::getInstrumentById($path_id);
              // $file_name = $record->file_name;
              // $paren_record =  InstrumentCollection::getParentInstrumentById($record->parent_id);
              // $fullPath = $paren_record->file_path.$file_name;
              // $instrumentnote = new InstrumentNote();
              // $instrumentnote->name = $name;
              // $instrumentnote->index = '4';
              // $instrumentnote->description = $fullPath;
              // $instrumentnote->instrument_id = $instrumentId;
              // $instrumentnote->save();
              //
              // $splitName = explode('_', $request->note_5);
              // $path_id = $splitName[0];
              // $name = $splitName[1];
              // $record=InstrumentCollection::getInstrumentById($path_id);
              // $file_name = $record->file_name;
              // $paren_record =  InstrumentCollection::getParentInstrumentById($record->parent_id);
              // $fullPath = $paren_record->file_path.$file_name;
              // $instrumentnote = new InstrumentNote();
              // $instrumentnote->name = $name;
              // $instrumentnote->index = '5';
              // $instrumentnote->description = $fullPath;
              // $instrumentnote->instrument_id = $instrumentId;
              // $instrumentnote->save();
              //
              // $splitName = explode('_', $request->note_6);
              // $path_id = $splitName[0];
              // $name = $splitName[1];
              // $record=InstrumentCollection::getInstrumentById($path_id);
              // $file_name = $record->file_name;
              // $paren_record =  InstrumentCollection::getParentInstrumentById($record->parent_id);
              // $fullPath = $paren_record->file_path.$file_name;
              // $instrumentnote = new InstrumentNote();
              // $instrumentnote->name = $name;
              // $instrumentnote->index = '6';
              // $instrumentnote->description = $fullPath;
              // $instrumentnote->instrument_id = $instrumentId;
              // $instrumentnote->save();
              //
              // $splitName = explode('_', $request->note_7);
              // $path_id = $splitName[0];
              // $name = $splitName[1];
              // $record=InstrumentCollection::getInstrumentById($path_id);
              // $file_name = $record->file_name;
              // $paren_record =  InstrumentCollection::getParentInstrumentById($record->parent_id);
              // $fullPath = $paren_record->file_path.$file_name;
              // $instrumentnote = new InstrumentNote();
              // $instrumentnote->name = $name;
              // $instrumentnote->index = '7';
              // $instrumentnote->description = $fullPath;
              // $instrumentnote->instrument_id = $instrumentId;
              // $instrumentnote->save();
        }






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\music_instrument  $music_instrument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //return "deleted";
        $instrument_id = $request->id;
        $musicRows = Music::where('instrument_id', $instrument_id)
                            ->where('user_id',Auth::user()->id)
                            ->get();
        //return $musicRows->count();
        foreach($musicRows as $music){
          MusicNote::where('music_id', $music->music_id)->delete();
          MusicNoteIntervalTime::where('music_id', $music->music_id )->delete();
          Music::where('music_id', $music->music_id)->delete();

        }
        MusicInstrument::where('id', $instrument_id )->delete();
        InstrumentNote::where('instrument_id', $instrument_id )->delete();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\music_instrument  $music_instrument
     * @return \Illuminate\Http\Response
     */
    public function show(music_instrument $music_instrument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\music_instrument  $music_instrument
     * @return \Illuminate\Http\Response
     */
    public function edit(music_instrument $music_instrument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\music_instrument  $music_instrument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, music_instrument $music_instrument)
    {
        //
    }


}
