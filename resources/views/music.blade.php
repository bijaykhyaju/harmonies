@extends('layouts.user-layout')

@section('mainSection')

<?php
  $bitRate = '1.0';
  $action = "add";
  $url = "/music/add";
  //$instrumentResult = App\MusicInstrument::getLatestInstrument();
  //$allInstrumentsRows = App\MusicInstrument::getAllInstruments();
  $columnLength = config('global.default_note_size');



?>
@isset($musicNotes)
    <?php
      $music_id = $music->music_id;
      $action = "edit";
      $url = "/music/edit";
      $overwrite = "no";
      $instrumentResult = App\MusicInstrument::getInstrument($music->instrument_id);
      $maxColumnNo = App\MusicNote:: getHigestColumnNumber($music_id);
      $columnLength = ($maxColumnNo > config('global.default_note_size')) ? $maxColumnNo : config('global.default_note_size');


    ?>
@endisset
<style>
    .dropdown dd, .dropdown dt, .dropdown ul { margin:0px; padding:0px; }
    .dropdown dd { position:relative; }               

    /* The visible container */    
    .dropdown dt a {background:#ffffff url(images/arrow1.png) no-repeat scroll 97.5% center ; display:block; padding-right:20px;width:70px; border: 1px solid #d3d3d3;}       
    /*.dropdown dt a span {cursor:pointer; display:block; padding:0px 5px 0px 5px;line-height: 18px; vertical-align: middle; }*/
      .dropdown dt a:hover { 
        color:#212121; 
        border: 1px solid #999999;
      }
      
      /* Text for both (box and options) */
      .dropdown a, .dropdown a:visited { color:#555555; text-decoration:none; outline:none;}
    .dropdown a:hover { color:#212121;}        
      
      /* The container for the dropdown options */         
      .dropdown dd ul { background:#ffffff none repeat scroll 0 0; border:1px solid #d3d3d3; color:#555555; display:none; left:0px; padding:5px 0px; position:absolute; top:0px; width:90px; list-style:none;}  
      
      /* The dropdown options */                 
    .dropdown dd ul li a { padding:5px; display:block;}                         
    .dropdown span.value { display:none;}  
        
      /* If using images */       
    .dropdown img.flag { border:none; vertical-align:middle; margin-left:10px; }
    /* If using colors */     
    .dropdown .color { border: 1px solid silver; vertical-align:middle; margin-right:5px; min-width: 10px;}

</style>


<div class="app-main__outer">
    <div class="app-main__inner">


      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/music-gallery">Gallery</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ucfirst(trans($action." Music")) }}</li>
        </ol>
      </nav>


        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                    


                      <div class="button-section">


                        <div class="left-element">
                        
                          <button type="button" class="btn btn-outline-dark" id="clear-selection"> Clear All</button>
                          <button type="button" class="btn btn-outline-primary" id="playBtn">Play</button>

                          <select type="select" id="select-instrument" name="instrument" class="custom-select" style="width:40%">
                                <option value="0" disabled>Select Instrument</option>

                              @foreach($allInstrumentsRows as $instruments)


                                <option value="{{$instruments->id}}" style="color:green;" @if($instrumentResult->id == $instruments->id) {{"selected='selected'"}} @endif >{{$instruments->name}}</option>

                              @endforeach

                          </select>
                          <?/*
                          <dl class="dropdown">
                              <dt ><a href="#"><span>Color</span></a></dt>
                              <dd>
                                  <ul>
                                      <li><a href="#"><span class="color" style="background-color:Red">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                      Red<span class="value">Red</span></a></li>
                                      <li><a href="#"> <span class="color" style="background-color:Green">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                      Green<span class="value">Green</span></a></li>
                                      <li><a href="#"> <span class="color" style="background-color:Black">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                      Black<span class="value">Black</span></a></li>
                                      <li><a href="#"> <span class="color" style="background-color:White">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                      White<span class="value">White</span></a></li>
                                  </ul>
                              </dd>
                          </dl>*/?>
                        </div>

                        <div class="right-element">
                          <div class="content-right">
                              <button type="button" class="btn btn-outline-dark" id="decrease-tempo" style="position: absolute;right: 23em;">-</button>
                              <span style="position: absolute;top: 8px;right: 20.5em;">
                                  <input class="form-control" id="bpm-value" value="{{$noteInterval->interval_time ?? $bitRate}}" style="width:75px;display:initial;" disabled></input>
                              </span>


                              <button type="button" class="btn btn-outline-dark" id="increase-tempo">+</button>

                              <button type="button" class="btn btn-outline-primary" id="print-notes">Print</button>
                              <button type="button" class="btn btn-outline-info" id="add-column">Add Beats Column</button>
                          </div>
                        </div>



                      </div>


                    </div>


                    @isset($music)

                    <div class="card-body">
                        <div class="card-title" style="margin-bottom:-20px">{{$music->title}}</div>

                    </div>

                    @endisset

                    <div class="table-responsive">


                      <div class="gooey" style="display:none;">
                        <span class="dot"></span>
                        <div class="dots">
                          <span></span>
                          <span></span>
                          <span></span>
                        </div>
                      </div>
                      <div class="table-container" id="form-field-music">

                        <form id="beats_form">
                          <?php
                                  //$noteArray = array('','a0','a1','a2','a3','a4','a5','a6'); //for piano notes

                                  $classActiveArray = array('note1-cell','note2-cell','note3-cell','note4-cell','note5-cell','note6-cell','note7-cell','note8-cell');

                                  $classCount = 0;
                                  //for fetching the note keys of all instruments
                                  foreach($allInstrumentsRows as $insturmentRow){
                                    $noteCollectionByInstrument[$insturmentRow->id]= array();
                                    $urlsByInstrument[$insturmentRow->id]= array();
                                    $activeClassArray[$insturmentRow->id]= array($classActiveArray[$classCount]);
                                    $NotesResults = App\InstrumentNote::getInstrumentNotes($insturmentRow->id);
                                    foreach($NotesResults as $NotesResult){
                                      array_push($noteCollectionByInstrument[$insturmentRow->id],$NotesResult->name);
                                      array_push($urlsByInstrument[$insturmentRow->id],$NotesResult->file_full_path);
                                      //array_push($url_base,$noteRow->file_full_path);

                                    }
                                    $classCount++;
                                  }
                                  //dd($noteCollectionByInstrument);



                                  $instrumentNotesRows = App\InstrumentNote::getInstrumentNotes($instrumentResult->id);

                                  $noteArray = array('');
                                  $url_base = array('');
                                  //$note_extension = '';
                                  //dd($instrumentNotesRows);
                                  foreach($instrumentNotesRows as $noteRow){
                                    array_push($noteArray,$noteRow->name);
                                    array_push($url_base,$noteRow->file_full_path);

                                  }
                                  $columnSize = $columnLength;
                              ?>
<style>
td { border: 1px solid black; width: 50px; text-align: center; margin:0; padding:0; height:100%; }
  #span1 { background-color: #DDD; width: 25px; float: right; height:100%; }
  #span2 { background-color: #EEE; width: 24px; float: left; }
  .t { border-top: 1px solid black; width:100% }
  .r { border-right: 1px solid black; height: 100%; }
</style>
                              <table class="table table-bordered beats-table">
                                @csrf
                                <tbody>

                                  @for($i=1 ; $i < count($noteArray) ; $i++)

                                  <tr id="idRow" class="note{{$i}}" rel="{{$noteArray[$i]}}"  url="{{ URL($url_base[$i]) }}">


                                      <th class="note-name" style="width:15%;">{{$noteArray[$i]}}<?/*Note #{{$i}}*/?></th>

                                      @for($j=1 ; $j <= $columnSize ; $j++)
                                          @isset($musicNotes)
                                              <?php
                                                $music_id = $music->music_id;
                                                $isSelected = App\Music::isMusicNoteSelected($music_id, $noteArray[$i], $j);

                                              ?>
                                          @endisset

                                          <td id="col{{$j}}" class="@isset($isSelected) @if($isSelected && $isSelected->column_id == $j) {{'note'.$i.'-cell'}} @endif @endisset">&nbsp;
                                          @if($i==1 && $j==1)
                                          <div><div id="span1" class="t">1</div><div id="span2" class="t r">1</div></div>
                                          @endif
                                          </td>

                                      @endfor
                                  </tr>

                                  @endfor

                                </tbody>
                              </table>
                              <input name="insturment-onload" id="instrument-onload" value="{{$instrumentResult->id}}" hidden />
                          </form>

                        </div>
                        <div class="print-section" style="padding:15px;display:none;">
                          <textarea style="width:80%;height: 420px;"></textarea>

                        </div>

                    </div>
                    <div class="d-block text-center card-footer">
                        <!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button> -->
                        <button class="btn-wide btn btn-success" id="saveBtnPopup" data-toggle="modal" data-target="#saveMusicModal">Save Music</button>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="saveMusicModal" tabindex="-1" role="dialog" aria-labelledby="saveMusicModal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Do you want to save this music?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Music Title</label>
                              <input type="text" class="form-control" value="{{$music->title ?? ''}}" name="music_name" id="music_name" placeholder="Please enter a title before you save your music.">
                              <p class="err-msg">&nbsp;</p>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="saveMusicBtn">Save</button>
                            <input name="overwrite" id="overwrite_music" value="no" hidden>
                          </div>
                        </div>
                      </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <!-- @include('includes/footer') -->
  </div>


    <!-- Scripts Begins -->
    <script>
    $(document).ready(function() {
        $(".dropdown dt a").click(function() {
            $(".dropdown dd ul").toggle();
        });

        $(".dropdown dd ul li a").click(function() {
            var text = $(this).html();
            $(".dropdown dt a").html(text);
            $(".dropdown dd ul").hide();
            $("#result").html("Selected value is: " + getSelectedValue("sample"));
        });

        function getSelectedValue(id) {
            return $("#" + id).find("dt a span.value").html();
        }

        $(document).bind('click', function(e) {
            var $clicked = $(e.target);
            if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
        });

    });
      $(document).ready(function(){

            //load the instrument and change the key name and notes
            $('#select-instrument').change(function(){
              var selected_inst_id = $(this).val();
              var note_array = <?php echo json_encode($noteCollectionByInstrument) ?>;
              var urls_array = <?php echo json_encode($urlsByInstrument) ?>;

              //console.log(note_array[selected_inst_id]);
              //console.log(urls_array[selected_inst_id]);
              var note_list = note_array[selected_inst_id];
              var url_list = urls_array[selected_inst_id];
              var count = 0;
              $('th:first-child').each(function(){
                var th = $(this);
                th.html(note_list[count]);
                th.parent('tr').attr('url',url_list[count]);
                count++;
              });

            });


            //play the note and highlight the box and remove highlight if it is already slected
            $(document).on('click','td',function(){
              
              var t = $(this);
              //for active color
              var selected_inst_id = $('#select-instrument').val();
              var active_class_array = <?php echo json_encode($activeClassArray) ?>;
              var active_class = active_class_array[selected_inst_id];
              //console.log(selected_inst_id);

              //getting the class name
              var note_number = t.parent().attr('class');
              //var note_val = t.parent().attr('rel');
              var note_val = t.parent().attr('url');
              var class_name = t.attr('class');
              //alert(class_name);
              if(class_name == ""){

                playNote(note_val, "+0");
                //alert("play");
              }

              //toggleClass name in td
              //t.toggleClass(note_number+'-cell');
              t.toggleClass(active_class);
            });

            $('#clear-selection').click(function(){
              //alert('hello');
              $("td").attr("class", "");
              //td.css('background-color', '#fff');
            });

            function playNote(url, timeWhenToPlay, playBackRateValue=1){

              //const time = now();
              var player = new Tone.GrainPlayer({
                    "url" : url,
                    "loop": false,
                    //"overlap": 0.1 ,
                    //"grainSize" : 0.2 ,
                    "playbackRate" : playBackRateValue

                  }).toMaster();

              player.start(timeWhenToPlay);

            }


            $('#add-column').click(function(){


                var columnCount = $("#idRow").find("td").length;
                var classNameCount = columnCount+1;
                $('tbody').find('tr').each(function(){
                  $(this).append('<td id="col'+classNameCount+'" class="column-active">&nbsp;</td>');
                });
                var tdWidth= $('.table-container').find('td').width();
                var tableWidth = $(".table").width();
                var finalWidth = (parseFloat(tdWidth + tableWidth)).toFixed(2);
                $(".table").width(finalWidth);
                //$('tbody').find('td').each(function(){
                setTimeout(function(){
                    $("td").removeClass("column-active");
                },150);


            });


            //var arrayContainerNoteToSave = [];
            //var deltaTime = 0.7;

            $(document).on('click','#playBtn',function(){
              var deltaTime = parseFloat($("#bpm-value").val()).toFixed(1);
              //alert($('td').width());

              //Tone.Transport.bpm.value = 20;
              ////alert($("#idRow").find("td").length);
              var seqNoteColumnArray = [];
              //arrayContainerNotes = [];
              var totalColumn = $("#idRow").find("td").length;


              var keyUrl;
              //var keyNoteName;
              //var i=1;
              for(var i=1;i<=totalColumn;i++){
                var seqNotesForEachColumn = [];
                var seqNotesNameArray = [];

                $('tbody').find('td').each(function(){

                    if($(this).attr('id')=="col"+i){
                      var t = $(this);

                        if(t.attr('class')==""){
                            keyUrl = "";


                        }else{
                            var keyNote = t.parent().attr('url');
                            //keyNoteName= t.parent().attr('rel');
                            keyUrl = keyNote;

                            //seqNotesNameArray.push(keyNoteName);
                            seqNotesForEachColumn.push(keyUrl);
                            //console.log(key);

                        }

                    }
                });
                seqNoteColumnArray.push(seqNotesForEachColumn);
                //arrayContainerNotes.push(seqNotesNameArray);
              }
              //console.log(seqNoteColumnArray);
              //console.log(arrayContainerNotes);


               //var seqNote = seqNoteForCol1;
               //console.log(seqNoteColumnArray.length);
               for(var j=0; j<seqNoteColumnArray.length; j++)
               {
                 //highlight the column while playing that column
                 //console.log(j+" => "+seqNoteColumnArray.length);


                 var colNum = j+1;
                 var activeTimeIndex = j!=0 ? j : 0.3;

                 var seqNote = seqNoteColumnArray[j];
                 $('tbody').find('td').each(function(){

                       //for horizontal scrollLeft


                     if($(this).attr('id')=="col"+colNum){
                       var t = $(this);

                       setTimeout(function(){
                          t.addClass('column-active');

                       },(deltaTime*activeTimeIndex)*1000);

                       setTimeout(function(){
                          t.removeClass('column-active');
                        },(deltaTime*activeTimeIndex)*1100);


                     }

                  });

                 for(var k = 0; k < seqNote.length; k++){

                    playNote(seqNote[k], "+" + (deltaTime*j));
                 }
                 //console.log(j);
                 //if(colNum>7){
                 event.preventDefault();
                 setTimeout(function(){

                   $('.table-responsive').animate({
                    scrollLeft: "+=40px"
                  }, (deltaTime*800));
                },(deltaTime*3500));
                 //}
               }

            });

            $(document).on('click','#print-notes',function(){
                //console.log(arrayContainerNotes);


                //var seqNoteColumnArray = [];
                var arrayContainerNotes = [];
                var totalColumn = $("#idRow").find("td").length;
                var arrayEmpty = true;


                //var keyUrl;
                var keyNoteName;
                //var i=1;
                for(var i=1;i<=totalColumn;i++){
                  //var seqNotesForEachColumn = [];
                  var seqNotesNameArray = [];

                  $('tbody').find('td').each(function(){

                      if($(this).attr('id')=="col"+i){
                        var t = $(this);

                          if(t.attr('class')!=""){

                              //var keyNote = t.parent().attr('url');
                              keyNoteName= t.parent().attr('rel');
                              //keyUrl = keyNote;

                              seqNotesNameArray.push(keyNoteName);
                              //seqNotesForEachColumn.push(keyUrl);
                              //console.log(key);

                          }

                      }
                  });
                  //seqNoteColumnArray.push(seqNotesForEachColumn);
                  arrayContainerNotes.push(seqNotesNameArray);
                }
                //console.log(seqNoteColumnArray);
                //console.log(arrayContainerNotes);
                var pixelClear = "empty";

                if(arrayContainerNotes){
                  //console.log(arrayContainerNotes);
                  var deltaTime = parseFloat($("#bpm-value").val()).toFixed(1);
                  $('.print-section').show();
                  $('.print-section').find('textarea').html("");

                   //var seqNote = seqNoteForCol1;
                   for(var i=0; i<arrayContainerNotes.length; i++)
                   {

                     var seqNotePrintArray = arrayContainerNotes[i];
                     var arraySize = seqNotePrintArray.length;
                     //console.log(arraySize);
                     var columnTitle = "Column#"+(i+1);
                     //$('.print-section').find('textarea').append(columnTitle+"\n");
                     if(arraySize){

                       for(var k = 0; k < arraySize; k++){

                           var playedTime = (deltaTime*i).toFixed(2);
                           var notePlayed = seqNotePrintArray[k];
                           //pixelClear = "cpx.pixels[0] = (0,0,0) \ncpx.pixels[1] = (0,0,0) \ncpx.pixels[2] = (0,0,0) \ncpx.pixels[3] = (0,0,0) \ncpx.pixels[4] = (0,0,0) \ncpx.pixels[5] = (0,0,0) \ncpx.pixels[6] = (0,0,0)";
                           pixelClear ="cpx.pixels.fill((0, 0, 0))";

                           //var print_value ="Note "+(i+1)+":\n";
                           var print_value = "cpx.pixels[index_" + notePlayed+"] = (color_" + notePlayed + ") \n" + "cpx.play_tone(note_" + notePlayed + ", 1)\n\n";

                           if(notePlayed == "a"){
                             print_value = "cp.pixels[6] = (0, 70, 255) \ncp.pixels[7] = (0, 70, 255) \ncp.pixels[8] = (0, 70, 255)\n\n";
                           }
                           if(notePlayed == "b"){
                             print_value = "cp.pixels[4] = (0, 255, 0) \ncp.pixels[0] = (0, 255, 0) \ncp.pixels[5] = (0, 255, 0) \ncp.pixels[9] = (0, 255, 0)\n\n";
                           }
                           if(notePlayed == "c"){
                             print_value = "cp.pixels[3] = (255, 0, 255) \ncp.pixels[2] = (255, 0, 255) \ncp.pixels[1] = (255, 0, 255)\n\n";
                           }

                          //playNote(seqNotePrintArray[k], "+" + playedTime);

                          $('.print-section').find('textarea').append(print_value);
                          if(k==(arraySize-1)){
                            var print_gap_value = pixelClear+"\ntime.sleep("+deltaTime+")\n\n";
                            $('.print-section').find('textarea').append(print_gap_value);

                          }
                       }
                     }
                     else{
                       if(pixelClear=="empty"){
                         $('.print-section').find('textarea').html("There are no Notes played...");
                         return true;
                       }
                       var print_gap_value = pixelClear+"\ntime.sleep("+deltaTime+")\n\n";
                       $('.print-section').find('textarea').append(print_gap_value);
                     }
                   }
                 }

            });

            $(document).on('click','#increase-tempo', function(){
              var bpmField = $("#bpm-value");
              var bpmValue = parseFloat(bpmField.val());
              var newValue = parseFloat(bpmValue+0.1).toFixed(1);
              bpmField.val(newValue);
              //$('#deltaTime')

            });

            $(document).on('click','#decrease-tempo', function(){
              var bpmField = $("#bpm-value");
              var bpmValue = parseFloat(bpmField.val());
              if(bpmValue>0.1){
                var newValue = parseFloat(bpmValue-0.1).toFixed(1);
              }else{
                return;
              }
              bpmField.val(newValue);
              //$('#deltaTime')

            });

            $('#music_name').keyup(function(){
              $('#overwrite_music').val('no');
              $('#music_name').removeClass('err-class');
              $('.err-msg').html("&nbsp;",500);
              $('#saveMusicBtn').html("Save",500);

            });

            $('#saveBtnPopup').click(function(){
                $('#overwrite_music').val('no');
                $('#music_name').removeClass('err-class');
                $('.err-msg').html("&nbsp;",500);
                $('#saveMusicBtn').html("Save",500);
                //alert(parseInt($("#select-instrument").val()));
            });

            $('#saveMusicBtn').click(function(){
                //alert($('#overwrite_music').val());
                var beatBoxSelectedCount = 0;
                var overwriteOption = $('#overwrite_music').val();
                $('#music_name').removeClass('err-class');
                $('.err-msg').html("&nbsp;",500);
                var savBtn = $(this);
                var music_name = $('#music_name').val();
                $(this).html("Saving...",800);
                if(music_name==""){
                    $('#music_name').addClass('err-class');
                    savBtn.html("Save",800);
                    //$('.err-msg').html("Please enter the name of music.");
                    //$('#music_name').focus();
                }
                else{
                        $('#music_name').css({"border":"1px solid #ced4da"});
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var deltaTime = parseFloat($("#bpm-value").val()).toFixed(1);
                        var instrumentId = parseInt($("#select-instrument").val());
                        var seqNoteColumnArray = [];
                        var totalColumn = $("#idRow").find("td").length;
                        var keyNoteName;
                        for(var i=1;i<=totalColumn;i++){
                            var seqNotesForEachColumn = [];
                            var seqNotesNameArray = [];
                            $('tbody').find('td').each(function(){
                                if($(this).attr('id')=="col"+i){
                                  var t = $(this);
                                    if(t.attr('class')==""){
                                        keyUrl = "";
                                    }else{
                                        beatBoxSelectedCount++;
                                        //var keyNote = t.parent().attr('url');
                                        keyNoteName= t.parent().attr('rel');
                                        keyUrl = keyNoteName;
                                        //seqNotesNameArray.push(keyNoteName);
                                        seqNotesForEachColumn.push(keyUrl);
                                    }
                                    //seqNotesForEachColumn.push(keyUrl);
                                }
                            });
                            seqNoteColumnArray.push(seqNotesForEachColumn);
                        }
                        if(beatBoxSelectedCount==0){
                            //alert("Nothing to save");
                            $('.err-msg').html("Nothing to save. Please select the beat box before saving music.");
                            savBtn.html("Save",800);
                            return true;
                        }
                        $.ajax({
                              url: '{{$url}}',
                              type: 'post',
                              data: { @isset($music_id) id:'{{$music_id}}', @endisset _token : CSRF_TOKEN, overwrite:overwriteOption, time: deltaTime, music_title: music_name, instrument_id:instrumentId, data : seqNoteColumnArray},
                              error: function(data) {
                                   // will display json of validation errors, which you'd loop through and display
                                  //console.log("This is error section");
                                  $('#music_name').addClass('err-class');
                                  $('.err-msg').html(data);

                              },
                              success: function(data){
                                  //console.log(data);
                                  if(data=="exist"){
                                    $('#music_name').addClass('err-class');

                                    $('.err-msg').html("Music already exist with this name. Do you wish to overwrite this music?");
                                    savBtn.html("Confirm",500);
                                    $('#overwrite_music').val('yes');
                                    return true;

                                  }
                                  //$(this).html("Saved",800);
                                  location.href = '/music-gallery';

                                }
                          });
                    }
            });
        });
    </script>

    <!-- Scripts Ends -->




@endsection
