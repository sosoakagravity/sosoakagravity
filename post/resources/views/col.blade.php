<div class="col_main" id="col_{{ $column->id }}">
    <div class="col_hd">
<span v-on:click="delete_column({{ $column->id }})">X</span>
    </div>
    <div class="col_title">
      {{ $column->title }}
    </div>
    <div class="col_content" id="col_content_{{ $column->id }}">
       @if ($column->card->count())
       @foreach ($column->card as $card)
       @include('card')
       @endforeach
       @else
           
       @endif
    </div>
   <div v-on:click="add_card({{ $column->id }})" id="add_new_card" class="card_main">
    <div  >
      Click here to add a new card
    </div>
  </div>
</div>