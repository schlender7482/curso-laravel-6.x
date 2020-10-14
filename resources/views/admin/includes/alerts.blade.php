@if ($errors->any())
    <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif
