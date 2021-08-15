<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
  <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    
  </head> 
<body>
  <div id="root">
    <div id="board">
      @if($columns->count())
      @foreach ($columns as $column)
      
       @include('column')
          
      @endforeach
      @endif
    </div>
    <div class="col_main card_main" id="col_0" style="display:@if($columns->count()) {{'none'}}@else{{'block'}}@endif">
      There are no columns yet
    </div>
    
    <div v-on:click="add_column(1)" id="add_new_col" class="col_main card_main">
      <div  >
        Click here to add a column
      </div>
    </div>
  
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  
</body>
</html>