@extends('layouts.user-layout')

@section('mainSection')
<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Gallery</li>
        </ol>
      </nav>

        <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">

                          <div class="top-bar">
                              <div class="left-element">
                                <h3>List of Music</h3>
                              </div>

                              <div class="right-element ">
                                <button type="button" class="btn btn-info" id="add-music">Add Music</button>
                              </div>
                          </div>

                            <table class="mb-0 table">
                                <thead>
                                <tr>
                                    <th class="card-title">S.N</th>
                                    <th class="card-title" colspan="6">Music Name</th>
                                    <th class="card-title">Action</th>
                                </tr>
                                </thead>
                                <tbody>


                                @if($musics)
                                  @foreach($musics as $index => $music)

                                  <tr>
                                      <th scope="row">{{ ++$index }}</th>
                                      <td colspan="6"><a href="/music/{{ $music->music_id }}" style="text-decoration:none;">{{ $music->title }}</a></td>
                                      <td>

                                        <button class="btn btn-danger btn-sm delete-music" data-toggle="modal" data-target="#deleteMusicModal" rel="{{$music->music_id}}">Delete</button>
                                      </td>
                                  </tr>

                                  @endforeach


                                @endif
                                @if($musics->count()==0)
                                  <tr>
                                      <td colspan="8">No music found. Click "Add Music" button to create.</td>
                                  </tr>
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

                                </tbody>
                                <input name="music_id" id="music_id_delete" value="" hidden>
                            </table>
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
  $('.edit-music').click(function(){
    var musicId = $(this).attr('rel');
    //alert(musicId);
    location.href = '/music/'+musicId;
  });

  $('.delete-music').click(function(){
    var id = $(this).attr('rel');
    //alert(id);
    $('#music_id_delete').val(id);

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
