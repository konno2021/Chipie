
@if ($errors->count())
    <div class="alert alert-danger font-weight-bold" >
    <ul class="alert" style="list-style: none;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif