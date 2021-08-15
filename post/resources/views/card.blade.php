<div class="card_main" id="card_{{ $card->id }}">
    <div class="card_hd">
<span v-on:click="delete_card({{ $card->id }})">X</span>
    </div>
    <div class="card">
      <div class="card_body">
        <div class="card_title">
          {{ $card->title }}
        </div>
        <div class="card_description" id="card_description_{{ $card->id }}">
            {{ $card->description }}
        </div>
      </div>
      <div class="card_nav">
<table>
  <tr><td colspan="3"><span onclick="move_card({{ $card->id }},'up')">&#9650;<span></td></tr>
  <tr><td><span onclick="move_card({{ $card->id }},'left')">&#9664;</span></td><td></td><td><b><span onclick="move_card({{ $card->id }},'right')">&#9654;</span></b></td></tr>
  <tr><td colspan="3"><span onclick="move_card({{ $card->id }},'down')">&#9660;<span></td></tr>
</table>
      </div>
    </div>
   
</div>