@extends('layouts.user-layout')

@section('mainSection')


<?php

  //get all the instruments for the logged in user

  $insturments = App\InstrumentCollection::getAllMusicInstruments();


?>
<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/instruments">Instruments</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Instrument</li>
        </ol>
      </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                      <h5>Add Instrument</h5>

                    </div>
                    <div class="table-responsive">

                    <div class="table-container">

                        <form name="addInstrumentForm" id="addInstrumentForm">
                          @csrf


                            @for($i=1;$i<=config('global.default_note_size');$i++)
                                <div class="form-group row">
                                  <label for="staticEmail" class="col-sm-2 col-form-label">Key {{$i}}: </label>
                                  <div class="col-sm-3">
                                    <select class="custom-select select-note" id="note_{{$i}}" name="note_{{$i}}" required>
                                      <option selected disabled value="0">Select note</option>
                                      @if($insturments->count())

                                        @foreach($insturments as $instrument)
                                            <optgroup label="{{$instrument->name}}">
                                                <?php
                                                  $file_path = $instrument->file_path;

                                                  $instumentRows = App\InstrumentCollection::getAllNotesOfInstrument($instrument->id);
                                                ?>
                                                @if($instumentRows->count())
                                                    @foreach($instumentRows as $instrumentNote)
                                                    <?php
                                                        $file_name = $instrumentNote->file_name;
                                                        $file_url = $file_path.$file_name;
                                                    ?>
                                                      <option value="{{$instrumentNote->id.'_'.$instrumentNote->name}}" rel="{{url($file_url)}}">{{$instrumentNote->name}}</option>

                                                    @endforeach

                                                  @endif


                                              </optgroup>
                                          @endforeach

                                      @endif
                                    </select>
                                  </div>
                                  <div class="col-sm-3" id="play-note" style="display:none">
                                        <audio id="play-audio-{{$i}}" src=""></audio>
                                        <button type="button" id="play-note-btn" class="btn btn-outline-primary">Play</button>
                                  </div>
                                </div>
                                @endfor

                        </form>

                    </div>
                    <div class="d-block text-center card-footer">
                        <!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button> -->
                        <button class="btn-wide btn btn-success" id="saveInstrumentBtnPopup" data-toggle="modal" data-target="#saveInstrumentModal">Save Instrument</button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="saveInstrumentModal" tabindex="-1" role="dialog" aria-labelledby="saveInstrumentModal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Do you want to save this instrument?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Instrument Name</label>
                              <input type="text" class="form-control" value="" name="instrument_name" id="instrument_name" placeholder="Please enter a title before you save your instrument.">
                              <p class="err-msg">&nbsp;</p>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="saveInstrumentcBtn">Save</button>

                          </div>
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

  <script>
  $(document).ready(function(){
    $('#saveInstrumentBtnPopup').click(function(e){
      var errorCount = 0;
      $('.select-note').each(function(){
        var t = $(this);
        var noteValue = t.val();
        //console.log(noteValue);
        if(noteValue=='0' || noteValue == null){
          errorCount++;
          $('#saveInstrumentBtnPopup').attr('data-target','saveInstrumentModal');
          t.addClass('err-class');
          e.preventDefault();
          //alert("error");
          //return false;
        }
      });
      if(errorCount==0){
        $('#saveInstrumentBtnPopup').attr('data-target','#saveInstrumentModal');
      }
      $('#instrument_name').removeClass('err-class');

      //validation
    });

    //remove the error border in select note
    $('.select-note').change(function(){
      var t = $(this)
      t.removeClass('err-class');
      var url = $("option:selected", t).attr("rel");
      //alert(t.val()+"===="+url);

      t.parent().next('#play-note').children('audio').attr('src',url);
      t.parent().next('#play-note').fadeIn(250);


    });

    $(document).on("click", "#play-note-btn", function(){
        var audioId = $(this).prev().parent().children('audio').attr('id');
        document.getElementById(audioId).play(0);

    });


    $('#saveInstrumentcBtn').click(function(){
        var save_btn = $('#saveInstrumentcBtn');
        save_btn.html("Saving",800);
        $('#instrument_name').removeClass('err-class');

        var instrumentName = $('#instrument_name').val();
        if(instrumentName == ""){
          $('#instrument_name').addClass('err-class');
          save_btn.html("Save",800);
        }else{

          var selected_note_array = [];
          $('.select-note').each(function(){
            selected_note_array.push($(this).val());

          });
          // console.log(selected_note_array);
          // return true;


          //var record = $("#addInstrumentForm").serialize();
          //record += '&instrument_name='+instrumentName;
          save_btn.html("Saving",800);
          var CSRF_TOKEN = $('input[name="_token"]').val();

          $.ajax({
              type: 'POST',
              url: '{{url('/instrument/add')}}',
              data:{note_select:selected_note_array,instrument_name:instrumentName, _token : CSRF_TOKEN },
              success:function(data){
                if(data=="exist"){
                  $('#instrument_name').addClass('err-class');

                  $('.err-msg').html("Instrument already exist with this name. Please enter different name.");
                  save_btn.html("Save",500);
                  return true;

                }
                //  json response
                //console.log(data);
                location.href = '{{url('/instruments')}}';
              },
              error: function(data) {
                  // if error occured
                  console.log(data);
                  $('#instrument_name').addClass('err-class');
                  $('.err-msg').html("Please enter the instrument before save.");
                  save_btn.html("Save",500);
                  //return true;

              }
          });

          //validation
        }
    });


  });

  </script>





@endsection
