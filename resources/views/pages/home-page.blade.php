@extends('layout.app')
@section('content')
    
    @include('component.MenuBar');
    @include('component.HeroSlider'); 
    @include('component.TopCategories');
    @include('component.ExclusiveProducts');    
    @include('component.TopBrands');  
    @include('component.Footer');

    <script>
        (async ()=>{

            await catgoryName();
            await Slider();
            await CategoryName();
            await Popular();
            await New();
            await Top();
            await Special();
            await Trending();


        })()
    </script>
   
@endsection

