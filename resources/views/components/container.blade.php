@props(['name'])
<div class="container bg-white border rounded-3 py-2 col-sm-12">
    <div class="row mb-1">
        <div class="col"><h2>{{ucfirst($name)}}</h2></div>
    </div>
    {{$slot}}
</div>
