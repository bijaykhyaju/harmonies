
<form id="beats_form">
      <?php

          $noteArray = array('');
          $url_base = array('');
          //dd($instrumentNotesRows);
          foreach($instrumentNotesRows as $noteRow){
            array_push($noteArray,$noteRow->name);
            array_push($url_base,$noteRow->file_full_path);
          }
          //$session_data = session()->all();
          $session_data = Session::get('selectedNotes');



          $columnSize = config('global.default_note_size');
      ?>
      {{var_dump($session_data)}}
      <table class="table table-bordered" style="width:0;">
        @csrf
        <tbody>

          @for($i=1 ; $i < count($noteArray) ; $i++)

          <tr id="idRow" class="note{{$i}}" rel="{{$noteArray[$i]}}"  url="{{ URL($url_base[$i]) }}">
              <th style="width:15%;">{{$noteArray[$i]}}<?/*Note #{{$i}}*/?></th>

              @for($j=1 ; $j <= $columnSize ; $j++)
                  @isset($musicNotes)
                      <?php
                        $music_id = $music->music_id;
                        $isSelected = App\Music::isMusicNoteSelected($music_id, $noteArray[$i], $j);

                      ?>
                  @endisset
                  <td id="col{{$j}}" class="@isset($isSelected) @if($isSelected && $isSelected->column_id == $j) {{'note'.$i.'-cell'}} @endif @endisset">&nbsp;</td>

              @endfor


          </tr>


          @endfor

        </tbody>
      </table>



  </form>
