<?php
use Illuminate\Support\Facade;


$environment = App::environment();


?>
{{ Str::plural('choir',2) }} {{ (bool) env('APP_DEBUG') }}
