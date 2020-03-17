@extends('layouts.user-layout')

@section('mainSection')
<?php
  $count = 1;
?>

<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Instruments</li>
        </ol>
      </nav>

        <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                      <div class="card-header" style="display:block;min-height: 62px;">
                          <div class="top-bar">
                              <div class="left-element">
                                <h4>Music Instruments</h4>
                              </div>

                              <div class="right-element">
                                <a href="{{url('/instrument/add-instrument')}}"><button type="button" class="btn btn-info" id="add-music">Add Instrument</button></a>
                              </div>
                          </div>
                      </div>

                      <div class="card-body">

                          @if($default_instrument->count()>0 || $added_instrument->count()>0)
                            <ul id="sorter" class="polaroid">

                              @foreach($default_instrument as $defaultInstrument)


                              <li id="sortdata_{{$defaultInstrument->id}}" >
                                  <div class="polaroidimg">
                                      <img src="{{ asset('images/music-instrument-thumbnail.png') }}" width="200" height="200"  border="0" />
                                  </div>
                                  <div class="polaroidlabel">
                                      <div class="tr">
                                        <div class="td">
                                            <span class="inst_sn" id="insturmentCount_{{$defaultInstrument->id}}">{{$count}}</span>.&nbsp;{{$defaultInstrument->name}}
                                      </div>
                                    </div>
                                  </div>
                                  <div class="polaroidoption">

                                      <div style="float:right;width:82px;padding-bottom:10px;">

                                          <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked disabled>
                                            <label class="custom-control-label" for="customSwitch1">Default</label>
                                          </div>

                                      </div>

                                  </div>
                              </li>
                              <?php $count++; ?>
                              @endforeach

                              @foreach($added_instrument as $addedInstrument)


                              <li id="sortdata_{{$addedInstrument->id}}" >
                                  <div class="polaroidimg">
                                      <img src="{{ asset('images/music-instrument-thumbnail.png') }}" width="200" height="200"  border="0" />
                                  </div>
                                  <div class="polaroidlabel">
                                      <div class="tr">
                                        <div class="td">
                                            <span class="inst_sn" id="insturmentCount_{{$addedInstrument->id}}">{{$count}}</span>.&nbsp;{{$addedInstrument->name}}
                                      </div>
                                    </div>
                                  </div>
                                  <div class="polaroidoption">

                                      <span class="del-button" rel="{{$addedInstrument->id}}" data-toggle="modal" data-target="#deleteInstrumentModal">
                                        <img src="{{ asset('images/icon_delete.png') }}" width="22" height="22" border="0" />
                                      </span>

                                      <div style="float:right;width:82px;padding-bottom:10px;">
                                        <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input publish-insturment" rel="{{$addedInstrument->id}}" id="{{strtolower($addedInstrument->name)}}" {{App\MusicInstrument::isInstrumentPublish($addedInstrument->id)}} >
                                          <label class="custom-control-label" for="{{strtolower($addedInstrument->name)}}">Publish</label>
                                        </div>
                                      </div>

                                  </div>
                              </li>
                              <?php $count++; ?>
                              @endforeach







                             </ul>
                             @else
                             <div>No insturment found. Please click "Add Instrument" button to add new instrument.</div>

                           @endif




                                <!-- Modal -->
                                <div class="modal fade" id="deleteInstrumentModal" tabindex="-1" role="dialog" aria-labelledby="deleteMusicModal" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this instrument?</h5>

                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                            <p class="err-msg">Are you sure you want to delete this instrument? This will delete all the music associate with this instrument.</p>

                                        </div>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelDeleteBtn">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="deleteInstrumentBtn" rel="" >Confirm</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>


                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
  $('#add-music').click(function(){
    location.href = '/music';

  });

  $('.del-button').click(function(){
    var id = $(this).attr('rel');
    //alert(id);
    $('#deleteInstrumentBtn').attr('rel',id);
    $('#deleteInstrumentBtn').html('Confirm');
  });


  $('#deleteInstrumentBtn').click(function(){
      var id = $(this).attr('rel');
      $(this).html('Deleting...');
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      //alert(id);
      var count = 1;
      $("#insturmentCount_"+id).removeClass('inst_sn');
      $.ajax({
            url: '{{url("/instrument/delete")}}',
            type: 'post',
            data: { _token : CSRF_TOKEN, id : id },
            error:function(data){
              console.log(data);
            },
            success: function(data){
              console.log(data);
              //alert(id);
              $('#cancelDeleteBtn').click();
              $('#sortdata_'+id).fadeOut(300);
              $('.inst_sn').each(function(){
                $(this).html(count);
                count++;
              });
            }
        });
  });

  $('.publish-insturment').click(function(){
    //alert($(this).val());
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var isChecked;
    var instId = $(this).attr('rel');
    if($(this).is(':checked')){
      //console.log("checked");
      isChecked = '1';
    }else{
      //console.log('unchecked');
      isChecked = '0';
    }
    $.ajax({
      url: '{{url("/instrument/publish")}}',
      type: 'post',
      data: { _token : CSRF_TOKEN, id : instId, is_publish : isChecked },
      error:function(data){
        console.log(data);
      },
      success: function(data){
        console.log("Status Changed");

      }


      });
  });






</script>



@endsection
