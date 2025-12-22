@if(session('success'))
    <div style="padding:10px; background:#d4edda; color:#155724; margin-bottom:15px; border-radius:5px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="padding:10px; background:#f8d7da; color:#721c24; margin-bottom:15px; border-radius:5px;">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div style="padding:10px; background:#f8d7da; color:#721c24; margin-bottom:15px; border-radius:5px;">
        <strong>Terjadi kesalahan:</strong>
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
