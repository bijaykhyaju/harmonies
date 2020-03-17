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
                  $noteArray = array('','a0','a1','a2','a3','a4','a5','a6','a7');
              ?>

              <table class="table table-bordered">

                <tbody>
                  @for($i=1;$i<9;$i++)
                  <tr id="idRow" class="note{{$i}}" rel="{{$noteArray[$i]}}"  url="{{ URL('tonejs/audio/piano/'.$noteArray[$i].'.mp3') }}">
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

            $(document).ready(function(){

                  var td = $('.table-container').find('td');

                  //onclick toggle active
                  $(td).click(function(){
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
                    td.attr("class", "");
                    //td.css('background-color', '#fff');
                  });

                  //play note using tone.js




                  var player = new Tone.GrainPlayer({
                        "url" : '{{ URL('tonejs/audio/piano/A5.mp3') }}',
                    "loop" : false,
                    "grainSize" : 0.1,
                    "overlap" : 0.05,
                  }).toMaster();

                  var playerKick = new Tone.GrainPlayer({
                        "url" : '{{ URL('tonejs/audio/piano/C5.mp3') }}',
                        "loop" : false,
                        "grainSize" : 0.1,
                        "overlap" : 0.05,
                      }).toMaster();

                  $(document).on('click','#playBtn',function(){
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

                      $('tbody').find('td').each(function(){
                        //console.log($(this).attr('id'));


                        if($(this).attr('id')=="col"+i){
                          var t = $(this);
                          //alert(t.attr('id'));
                          //console.log(keyNote+"-> "+t.attr('id'));

                            if(t.attr('class')==""){
                                key = "";

                            }else{
                              var keyNote = t.parent().attr('url');

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

                    var deltaTime = 0.7;
                    var seqNote = seqNoteForCol1;
                    for(var j=0; j<seqNote.length; j++)
                    {
                    playNote(seqNote[j], "+" + (deltaTime*0));
                    }

                    var seqNote = seqNoteForCol2;
                    for(var j=0; j<seqNote.length; j++)
                    {
                    playNote(seqNote[j], "+" + (deltaTime*1));
                    }


                    var seqNote = seqNoteForCol3;
                    for(var j=0; j<seqNote.length; j++)
                    {
                    playNote(seqNote[j], "+" + (deltaTime*2));
                    }


                    var seqNote = seqNoteForCol4;
                    for(var j=0; j<seqNote.length; j++)
                    {
                    playNote(seqNote[j], "+" + (deltaTime*3));
                    }


                    var seqNote = seqNoteForCol5;
                    for(var j=0; j<seqNote.length; j++)
                    {
                    playNote(seqNote[j], "+" + (deltaTime*4));
                    }


                    var seqNote = seqNoteForCol6;
                    for(var j=0; j<seqNote.length; j++)
                    {
                    playNote(seqNote[j], "+" + (deltaTime*5));
                    }


                    var seqNote = seqNoteForCol7;
                    for(var j=0; j<seqNote.length; j++)
                    {
                    playNote(seqNote[j], "+" + (deltaTime*6));
                    }


                    var seqNote = seqNoteForCol8;
                    for(var j=0; j<seqNote.length; j++)
                    {
                    playNote(seqNote[j], "+" + (deltaTime*7));
                    }
                  });

              });
          </script>

          <!-- Scripts Ends -->
        </footer>

    </body>
</html>
