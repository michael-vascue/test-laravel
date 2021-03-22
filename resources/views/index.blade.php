<!-- /resources/views/vue/index.blade.php -->
{{-- @extends('welcome') --}}

<!DOCTYPE html>
<html>
    <head>
        {{-- <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script> --}}
   
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <div id="app">
            {{-- <navigation-bar></navigation-bar> --}}
            <dashboard></dashboard>
    
        </div>
    </head>
    <body>
    </body>
    <script src="{{asset('/js/app.js')}}"></script>
</html>

@section('content')
<h1>This is a vue component</h1>
 <div id="app">
  <router-view></router-view>
 </div>
 <script src="/js/app.js"></script>
@endsection