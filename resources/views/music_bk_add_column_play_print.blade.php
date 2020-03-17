<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Music || Beats Making</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap-4.3.1.css') }}">
        <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}">


        <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
        <script src="{{ asset('js/bootstrap-4.3.1.js') }}" ></script>

        <!-- Scripts for implementin tone.js-->
        <script src="https://unpkg.com/@webcomponents/webcomponentsjs@^2/webcomponents-bundle.js"></script>
      	<script src="{{ URL('tonejs/build/Tone.js') }}"></script>
        <!--script src="{{ URL('tonejs/build/tonejs-ui.js') }}"></script-->


    </head>
    <body>
          <div class="container">
            <div class="">
              <nav class="navbar navbar-default">
                <div class="navbar-header">
                  <legend>Create Music</legend>
                </div>
              </nav>
            </div>
            <div class="table-container">
              <div class="button-section">
                <div class="left-element">
                  <button type="button" class="btn btn-outline-dark" id="clear-selection"> Clear All</button>
                  <button type="button" class="btn btn-outline-primary" id="playBtn">Play</button>
                </div>

                <div class="right-element">
                  <button type="button" class="btn btn-outline-dark" id="print-notes">Print</button>
                  <button type="button" class="btn btn-outline-info" id="add-column">Add Beats Column</button>
                </div>



              </div>

              <?php
                  $noteArray = array('','a0','a1','a2','a3','a4','a5','a6','a7');
              ?>

              <table class="table table-bordered" style="width:0;">
                <tbody>

                  @for($i=1;$i<9;$i++)
                  <tr id="idRow" class="note{{$i}}" rel="{{$noteArray[$i]}}"  url="{{ URL('tonejs/audio/piano/'.$noteArray[$i].'.mp3') }}">
                    <th style="width:10%;">Note #{{$i}}</th>
                    <td id="col1" class="">&nbsp;</td>
                    <td id="col2" class="">&nbsp;</td>
                    <td id="col3" class="">&nbsp;</td>
                    <td id="col4" class="">&nbsp;</td>
                    <td id="col5" class="">&nbsp;</td>
                    <td id="col6" class="">&nbsp;</td>
                    <td id="col7" class="">&nbsp;</td>
                    <td id="col8" class="">&nbsp;</td>
                  </tr>
                  @endfor

                </tbody>
              </table>
            </div>
            <div class="print-section" style="display:none;">
              <textarea style="width:80%;height: 420px;"></textarea>

            </div>
          </div>

        <footer>
          <!-- Scripts Begins -->
          <script>

            $(document).ready(function(){

                  //var td = $('.table-container').find('td');

                  //onclick toggle active
                  //$(td).click(function(){
                  $(document).on('click','td',function(){
                    var t = $(this);
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
                    t.toggleClass(note_number+'-cell');
                  });

                  $('#clear-selection').click(function(){
                    //alert('hello');
                    $("td").attr("class", "");
                    //td.css('background-color', '#fff');
                  });

                  function playNote(url, timeWhenToPlay){

                    //const time = now();
                    var player = new Tone.GrainPlayer({
                          "url" : url,
                          "loop" : false,
                          "grainSize" : 0.1,
                          "overlap" : 0.05,
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


                  var arrayContainerNotes = [];
                  var deltaTime = 0.7;

                  $(document).on('click','#playBtn',function(){
                    ////alert($("#idRow").find("td").length);
                    var seqNoteColumnArray = [];
                    arrayContainerNotes = [];
                    var totalColumn = $("#idRow").find("td").length;


                    var keyUrl;
                    var keyNoteName;
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
                                  keyNoteName= t.parent().attr('rel');
                                  keyUrl = keyNote;

                                  seqNotesNameArray.push(keyNoteName);
                                  seqNotesForEachColumn.push(keyUrl);
                                  //console.log(key);

                              }

                          }
                      });
                      seqNoteColumnArray.push(seqNotesForEachColumn);
                      arrayContainerNotes.push(seqNotesNameArray);
                    }
                    console.log(seqNoteColumnArray);
                    console.log(arrayContainerNotes);


                     //var seqNote = seqNoteForCol1;
                     for(var j=0; j<seqNoteColumnArray.length; j++)
                     {
                       //highlight the column while playing that column
                       var colNum = j+1;
                       var activeTimeIndex = j!=0 ? j : 0.3;

                       var seqNote = seqNoteColumnArray[j];
                       $('tbody').find('td').each(function(){

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


                     }

                  });

                  $(document).on('click','#print-notes',function(){
                      //console.log(arrayContainerNotes);

                      $('.print-section').show();
                      $('.print-section').find('textarea').html("");
                      for(var i=0; i<arrayContainerNotes.length; i++)
                      {

                        var seqNotePrintArray = arrayContainerNotes[i];
                        var arraySize = seqNotePrintArray.length;
                        var columnTitle = "Column#"+(i+1);
                        $('.print-section').find('textarea').append(columnTitle+"\n");

                        for(var k = 0; k < arraySize; k++){

                            var playedTime = (deltaTime*i).toFixed(2);

                           //playNote(seqNotePrintArray[k], "+" + playedTime);
                           $('.print-section').find('textarea').append("Note: "+ seqNotePrintArray[k]+"&emsp; Time: " +playedTime +" \n");
                           if(k==(arraySize-1)){
                             $('.print-section').find('textarea').append(" \n");
                           }



                        }
                      }
                  });





              });
          </script>

          <!-- Scripts Ends -->
        </footer>

    </body>
</html>
