<?php

namespace App\Http\Controllers;

use App\Music;
use App\MusicNote;
use App\MusicNoteIntervalTime;
use App\MusicInstrument;
use App\InstrumentNote;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Auth;

class MusicController extends Controller
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
        return view('music_gallery', [
          'musics' =>  Music::where('user_id',Auth::user()->id)->latest()->get()
        ]);


    }

    public function musicPage()
    {
        //
        //$musicInstrument = Music
        $instrumentResult = MusicInstrument::getLatestInstrument();
        $allInstrumentsRows = MusicInstrument::getAllInstruments();

        return view('music',compact(['instrumentResult','allInstrumentsRows']));


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

    public function selectInstrument(Request $request){
      $instrumentId = $request->instrtrument_id;




      $instrumentRecord = MusicInstrument::where('id', $instrumentId)->first();
      $instrumentNotesRows = InstrumentNote::where('instrument_id', $instrumentId)->get();


      // $loadedInstrumentId = $request->onload_instrument_id;
      // $selectedNotes = [];
      //
      // foreach (request()->data as $data => $value_array)
      // {
      //   //echo "Column ".($data+1).": ";
      //   $column_number = $data+1;
      //   foreach ($value_array as $data1 => $value)
      //   {
      //     $selections = array(
      //         'insturment_id' => $loadedInstrumentId,
      //         'music_note' => $value,
      //         'column_no' => $column_number
      //     );
      //     //$selectedNotes = collect($selections);
      //
      //     //Session::push('selectedNotes', $selections);
      //     $selectedNotes = array_add($selections);
      //     //array_merge($selectedNotes,$selections);
      //     //$selectedNotes.push($selections);
      //
      //     //$request->session()->put(["music.instrument_id", $loadedInstrumentId],["music.music_note", $value],["music.column_no", $column_number]);
      //
      //
      //
      //      //echo $value.", ";
      //   }
      //   //echo "\n";
      // }
      // //Session::push('selectedNotes', $selectedNotes);
      // return var_dump($selectedNotes);



      return view("ajaxview/music_ajax",compact(['instrumentRecord','instrumentNotesRows']));




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
        //return $request->data;
        //return $request->instrument_id;
        $request->validate([
          'music_title' => 'required',
        ]);

        $musicRecordQuery = Music::where('title', $request->music_title)
                              ->where('user_id',Auth::user()->id);

        $musicRecord = $musicRecordQuery->count();

        $instrument_id = $request->instrument_id;

        $overwrite = $request->overwrite;
        if($musicRecord>0 && $overwrite == "no"){
              return "exist";
        }
        else if($musicRecord>0 && $overwrite == "yes"){

              $recordMusic = $musicRecordQuery->first();
              $mId = $recordMusic->music_id;
              Music::where('music_id', $mId)->update([
                  'title' => request()->music_title,
                  'instrument_id' => $instrument_id
              ]);


              //Updating the music Notes
              MusicNote::where('music_id', $mId)->delete();

              foreach (request()->data as $data => $value_array)
              {
                //echo "Column ".($data+1).": ";
                $column_number = $data+1;


                foreach ($value_array as $data1 => $value)
                {

                  $music_note = new MusicNote();
                  $music_note->music_id = $mId;
                  $music_note->column_id = $column_number;
                  $music_note->note_name = $value;
                  $music_note->instrument_id = $instrument_id;
                  $music_note->save();

                   //echo $value.", ";
                }
                //echo "\n";
              }

              //Update in note interval time table
              MusicNoteIntervalTime::where('music_id', $mId)->update([
                  'interval_time' => request()->time
              ]);

        }
        else{

              $music = new Music();

              $music->title = $request->music_title;
              $music->description = "";
              $music->user_id = Auth::user()->id;
              $music->instrument_id = $instrument_id;
              $music->save();

              $musicId = $music->id;
              //echo($music->getTable()); //get table name
              //echo "Last entered music id is = ".$music->id;
              //echo Auth::user()->id;
              foreach ($request['data'] as $data => $value_array)
              {
                //echo "Column ".($data+1).": ";
                $column_number = $data+1;


                foreach ($value_array as $data1 => $value)
                {

                  $music_note = new MusicNote();
                  $music_note->music_id = $musicId;
                  $music_note->column_id = $column_number;
                  $music_note->note_name = $value;
                  $music_note->instrument_id = $instrument_id;
                  $music_note->save();

                   //echo $value.", ";
                }
                //echo "\n";
              }

              //insert in note interval time table
              $interval = new MusicNoteIntervalTime();
              $time = $request->time;
              //return $time;

              $interval->music_id = $musicId;
              $interval->interval_time = $time;

              $interval->save();


          }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show($musicId)
    {
        //
        $music = Music::where("music_id",$musicId)
                        ->where('user_id',Auth::user()->id)
                        ->first();
        //Post::where('slug', $slug)
        $musicNotes = MusicNote::where("music_id",$musicId)->get();
        $noteTimeInterval = MusicNoteIntervalTime::where("music_id",$musicId)->first();


        return view('music',[
          'music' => $music,
          'musicNotes' => $musicNotes,
          'noteInterval' => $noteTimeInterval
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

      if(isset(request()->id)){
          //return request()->music_title;
          $mId = request()->id;
          $musicRecord = Music::where('music_id', $mId)->first();
          //return $musicRecord->title;
          $instrument_id = $request->instrument_id;

          $title = request()->music_title;
          $ifOverwrite =request()->overwrite;
          //return "overwrite = ".$ifOverwrite;
          if($ifOverwrite == "no"){
            if($title == $musicRecord->title){
              return "exist";
            }
          }
          if(($ifOverwrite == "yes" && $title == $musicRecord->title) || $title != $musicRecord->title){

              //return "overwrite = ".$ifOverwrite;
                //return "Music Edit";

                Music::where('music_id', $mId)->update([
                    'title' => request()->music_title,
                    'instrument_id' => $instrument_id
                ]);


                //Updating the music Notes
                MusicNote::where('music_id', $mId)->delete();

                foreach (request()->data as $data => $value_array)
                {
                  //echo "Column ".($data+1).": ";
                  $column_number = $data+1;


                  foreach ($value_array as $data1 => $value)
                  {

                    $music_note = new MusicNote();
                    $music_note->music_id = $mId;
                    $music_note->column_id = $column_number;
                    $music_note->note_name = $value;
                    $music_note->instrument_id = $instrument_id;
                    $music_note->save();

                     //echo $value.", ";
                  }
                  //echo "\n";
                }

                //Update in note interval time table
                MusicNoteIntervalTime::where('music_id', $mId)->update([
                    'interval_time' => request()->time
                ]);

            }


      }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $musicId = $request->id;
        //return "music id = ".$musicId;
        Music::where('music_id', $musicId )->delete();
        MusicNote::where('music_id', $musicId )->delete();
        MusicNoteIntervalTime::where('music_id', $musicId )->delete();

        //return redirect('/music-gallery');



    }
}
