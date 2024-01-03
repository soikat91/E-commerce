@extends('layout.app')
@section('content')
    @include('component.MenuBar')
    @include('component.Policy')    
    @include('component.TopBrands')
    @include('component.Footer')

    <script>
        (async ()=>{

            await catgoryName();              
            


        })()
    </script>

@endsection