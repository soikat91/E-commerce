@extends('layout.app')
@section('content')

@include('component.MenuBar')
@include('component.ProductDetails')
@include(('component.TopBrands'))
@include('component.Footer')

<script>
        (async ()=>{
            await catgoryName();
        })()
</script>
@endsection