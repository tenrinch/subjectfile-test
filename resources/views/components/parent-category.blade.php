@if(isset($category->parent))
	@include('components.parent-category',['category'=>$category->parent])
	{{$category->parent->title}} - 
@endif



