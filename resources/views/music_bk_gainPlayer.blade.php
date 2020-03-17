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

        <script src="{{ asset('js/bootstrap-4.3.1.js') }}" ></script>
        <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>

        <!-- Scripts for implementin tone.js-->
        <script src="https://unpkg.com/@webcomponents/webcomponentsjs@^2/webcomponents-bundle.js"></script>
      	<script src="{{ URL('tonejs/build/Tone.js') }}"></script>
        <!--script src="{{ URL('tonejs/build/tonejs-ui.js') }}"></script-->




        <style>
          .table-container tr{
            height: 90px;

          }
          .note1-cell{
            background-color: #FF0000;
          }
          .note2-cell{
            background-color: #FF7F00;
          }
          .note3-cell{
            background-color: #FFFF00;
          }
          .note4-cell{
            background-color: #00FF00;
          }
          .note5-cell{
            background-color: #0000FF;
          }
          .note6-cell{
            background-color: #4B0082;
          }
          .note7-cell{
            background-color: #9400D3;
          }
          .note8-cell{
            background-color: #9f929a;
          }
        </style>

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
              <div style="padding-bottom:10px;">
                <button type="button" class="btn btn-outline-dark" id="clear-selection"> Clear All</button>
                <button type="button" class="btn btn-outline-primary" id="playBtn">Play</button>
              </div>

              <?php
                  $noteArray = array('','C4','D4','E4','F4','G4','A4','B4','C5');
              ?>

              <table class="table table-bordered">

                <tbody>
                  @for($i=1;$i<9;$i++)
                  <tr id="idRow" class="note{{$i}}" rel="{{$noteArray[$i]}}">
                    <th>Note #{{$i}}</th>
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
          </div>



        <footer>
          <!-- Scripts Begins -->

          <script>
            $(document).ready(function(){

              var td = $('.table-container').find('td');

              //onclick toggle active
              $(td).click(function(){
                var t = $(this);
                //getting the class name
                var note_number = t.parent().attr('class');
                var note_val = t.parent().attr('rel');

                var class_name = t.attr('class');
                //alert(class_name);
                if(class_name == ""){

                  playNote(note_val);
                  //alert("play");
                }

                //toggleClass name in td
                t.toggleClass(note_number+'-cell');
              });

              $('#clear-selection').click(function(){
                //alert('hello');
                td.attr("class", "");
                //td.css('background-color', '#fff');
              });

              //play note using tone.js


              function playNote(note_val){
                var synth = new Tone.Synth().toMaster();

                //play a middle 'C' for the duration of an 8th note
                synth.triggerAttackRelease(note_val, "8n");

              }

              var player = new Tone.GrainPlayer({
                    "url" : '{{ URL('tonejs/audio/Clap.[mp4|ogg]') }}',
                "loop" : false,
                "grainSize" : 0.1,
                "overlap" : 0.05,
              }).toMaster();

              var playerKick = new Tone.GrainPlayer({
                    "url" : '{{ URL('tonejs/audio/Kick.[mp4|ogg]') }}',
                "loop" : false,
                "grainSize" : 0.1,
                "overlap" : 0.05,
              }).toMaster();

              $(document).on('click','#playBtn',function(){
                const player0 = player;//new GrainPlayer(buffer).toDestination();
                //start();
                //const time = now();
                const player1 = playerKick;
                player0.start(0);
                player1.start(0);

                /*
                  var seqNoteForCol1 = [];
                  var seqNoteForCol2 = [];
                  var seqNoteForCol3 = [];
                  var seqNoteForCol4 = [];
                  var seqNoteForCol5 = [];
                  var seqNoteForCol6 = [];
                  var seqNoteForCol7 = [];
                  var seqNoteForCol8 = [];

                  var key;
                  //var i=1;
                  for(var i=1;i<9;i++){
                    //console.log('working'+1);
                    //console.log("Notes for column " + i);

                    //console.log(keyNote);
                    $('tbody').find('td').each(function(){
                      //console.log($(this).attr('id'));


                      if($(this).attr('id')=="col"+i){
                        var t = $(this);
                        //alert(t.attr('id'));
                        //console.log(keyNote+"-> "+t.attr('id'));

                          if(t.attr('class')==""){
                              key = "";

                          }else{
                            var keyNote = t.parent().attr('rel');

                               key = keyNote;
                               if(i == 1)
                                seqNoteForCol1.push(key);
                                else if(i == 2)
                                 seqNoteForCol2.push(key);
                                 else if(i == 3)
                                  seqNoteForCol3.push(key);
                                  else if(i == 4)
                                   seqNoteForCol4.push(key);
                                   else if(i == 5)
                                    seqNoteForCol5.push(key);
                                    else if(i == 6)
                                     seqNoteForCol6.push(key);
                                     else if(i == 7)
                                      seqNoteForCol7.push(key);
                                      else if(i == 8)
                                       seqNoteForCol8.push(key);

                              //seqNote.push(key);
                              //console.log(key);

                          }
                      }


                    });

                  }


                  /*$('tr').each(function(){
                      var keyNote = $(this).attr('rel');
                      //alert(keyNote);
                      $(this).children('td').each(function(){
                        if($(this).attr('class')==""){
                            key = "";

                        }else{
                             key = keyNote;
                             //alert(key);
                             return false;
                        }
                      });
                      alert(key);
                      seqNote.push(key);

                  });
                  */
                  //console.log(seqNote);
                  /*$("#idRow").children('td').each(function() {
                    if($(this).attr('class')==""){
                        key = "";

                    }else key = "C4";
                    //console.log(key);

                    seqNote.push(key);

                  });
                  */

                  //var synth = new Tone.Synth().toMaster();



                  //var seqNote = ['C4',["E4", "D4", "E4"],'E4','F4','G4','A4','B4','C5'];

                  //console.log(seqNoteForCol1);
                  /*
                  var totalCols = 8;
                  var count=0;
                  for(var n=1; n<=totalCols;n++){

                      var seqNote = [];

                      if(n == 1)
                       seqNote = seqNoteForCol1;
                       else if(n == 2)
                        seqNote = seqNoteForCol2;
                        else if(n == 3)
                         seqNote = seqNoteForCol3;
                         else if(n == 4)
                          seqNote = seqNoteForCol4;
                          else if(n == 5)
                           seqNote = seqNoteForCol5;
                           else if(n == 6)
                            seqNote = seqNoteForCol6;
                            else if(n == 7)
                             seqNote = seqNoteForCol7;
                             else if(n == 8)
                              seqNote = seqNoteForCol8;
                      //console.log('seqNoteForCol'+n);
                      //console.log(seqNoteForCol1);
                      //seqNote.push('seqNoteForCol'+n);
                      //console.log("SeqNoteForCol"+n+ " length = "+seqNote.length);
                      var timeNote = count/4;

                      //for(var j=0; j<seqNote.length; j++)
                      //{

                            var music = seqNote;//[];
                            //console.log(music);
                            //music.push({"time": j, "note": seqNote[j], "duration": "8n"});
                            var synth = new Tone.Synth().toMaster();
                            //var synth = new Tone.Synth().toMaster();
                            var part = new Tone.Part(function(time, note){
                                //the notes given as the second element in the array
                                //will be passed in as the second argument
                                console.log(note);
                                synth.triggerAttackRelease(note, '8n', time);
                            }, music).start(0);

                            Tone.Transport.start();
                      //}
                      count++;
                  }

                  */
              });

              // var root; // let user choose
              //var familyOfTriads = [[0,4,7],[0,3,7],[0,3,6],[0,4,8]];

              /*
              var part = new Tone.Sequence(function(time, note){
                            //console.log(note);
                            synth.triggerAttackRelease(note, "8n", time);
                          //straight quater notes
                        }, myNote, "4n");

              part.start(0);
              part.loop = 1;
              //part.loopEnd = '16m';
              Tone.Transport.start();
              */


            });
          </script>

          <!-- Scripts Ends -->
        </footer>

    </body>
</html>
