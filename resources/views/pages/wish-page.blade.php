@extends('layout.app')

@section('content')
@include('component.MenuBar')
@include('component.wish')
@include('component.TopBrands')

<script>
    (async()=>{
        
        await catgoryName();
    })()
</script>
@endsection