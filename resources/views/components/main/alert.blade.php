@if ($errors->any())
<div class="alert alert-danger color-danger alert-dismissible fade show" role="alert">
    <ul class="m-0 ps-4">
        @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success color-success alert-dismissible fade show" role="alert">
    {!! session('success') !!}
</div>
@endif