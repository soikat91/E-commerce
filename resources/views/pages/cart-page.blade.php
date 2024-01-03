@extends('layout.app')

@section('content')
@include('component.MenuBar')
@include('component.CartList')
@include('component.TopBrands')

<script>
    (async()=>{
        
        await catgoryName();
    })()
</script>
@endsection