@if(isset($data) && !empty($data))
@foreach($data as $key => $value)
<p>{{ $value->id }}</p><br>
<h1>{{ $value->title }}</h1><br>
<p>{{ $value->summary }}</p><br>
<p>{{ $value->notice }}</p><br>
<p>{!! $value->description !!}</p><br>
<p>{{ $value->price }}</p><br>
<p>{{ $value->discount }}</p><br>
<p>{{ $value->duration }}</p><br>
<p>{{ $value->city }}</p><br>
<p>{{ $value->summary }}</p><br>
<p>{{ $value->added_by }}</p><br>
@endforeach
<br>
@endif