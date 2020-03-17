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


                              <li id="sortdata" >
                                  <div class="polaroidimg">
                                      <img src="{{ asset('images/music-instrument-thumbnail.png') }}" width="200" height="200"  border="0" />
                                  </div>
                                  <div class="polaroidlabel">
                                      <div class="tr">
                                        <div class="td">
                                            <span class="cat_sn">{{$count}}.</span>&nbsp;{{$defaultInstrument->name}}
                                      </div>
                                    </div>
                                  </div>
                                  <div class="polaroidoption">
                                      <?/*<a href=""><img src="{{ asset('images/icon_edit.png') }}" width="24" height="24" border="0" /></a>
                                      <a href="JavaScript:void(0);" class="cat_del_link" rel=""><img src="{{ asset('images/icon_delete.png') }}" width="24" height="24" border="0" /></a>*/?>
                                      <div style="float:right;width:82px;padding-bottom:10px;">
                                        <!-- Default checked -->
                                          <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked disabled>
                                            <label class="custom-control-label" for="customSwitch1">Default</label>
                                          </div>
                                        <?/*<label>
                                          <input type="checkbox" id="checkbox" class="default_instrument" checked disabled  />&nbsp;Default
                                        </label>*/?>
                                      </div>

                                      <div id="img-" style="float:right;width:30px;display:none;">
                                        <img src="{{ asset('images/loading.gif')}}" width="20" height="20" border="0" />
                                      </div>
                                  </div>
                              </li>
                              <?php $count++; ?>
                              @endforeach

                              @foreach($added_instrument as $addedInstrument)


                              <li id="sortdata" >
                                  <div class="polaroidimg">
                                      <a href=""><img src="{{ asset('images/music-instrument-thumbnail.png') }}" width="200" height="200"  border="0" /></a>
                                  </div>
                                  <div class="polaroidlabel">
                                      <div class="tr">
                                        <div class="td">
                                            <span class="cat_sn">{{$count}}.</span>&nbsp;{{$addedInstrument->name}}
                                      </div>
                                    </div>
                                  </div>
                                  <div class="polaroidoption">

                                      <a href="JavaScript:void(0);" class="cat_del_link" rel=""><img src="{{ asset('images/icon_delete.png') }}" width="24" height="24" border="0" /></a>

                                      <div style="float:right;width:82px;padding-bottom:10px;">
                                        <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input publish-insturment" rel="{{$addedInstrument->id}}" id="{{strtolower($addedInstrument->name)}}" {{App\MusicInstrument::isInstrumentPublish($addedInstrument->id)}} >
                                          <label class="custom-control-label" for="{{strtolower($addedInstrument->name)}}">Publish</label>
                                        </div>
                                        <?/*<label><input type="checkbox" id="checkbox" class="publish_category"  />&nbsp;New</label>*/?>
                                      </div>

                                      <div id="img-" style="float:right;width:30px;display:none;">
                                        <img src="images/loading.gif" width="20" height="20" border="0" />
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
                                <div class="modal fade" id="deleteMusicModal" tabindex="-1" role="dialog" aria-labelledby="deleteMusicModal" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this music?</h5>

                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                            <p class="err-msg">This will delete your music. Are you sure you want to continue.</p>

                                        </div>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="deleteBtn">Confirm</button>
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


  $('.delete-music').click(function(){
    var id = $(this).attr('rel');
    //alert(id);
    $('#music_id_delete').val(id);

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
        //location.href = '/music-gallery';

      }


      });
  });


  $('#deleteBtn').click(function(){


        var mId = $('#music_id_delete').val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: '/music/delete',
          type: 'post',
          data: { _token : CSRF_TOKEN, id: mId},
          error:function(data){
            console.log(data);
          },
          success: function(data){
            location.href = '/music-gallery';

          }


          });




  });


</script>



@endsection
