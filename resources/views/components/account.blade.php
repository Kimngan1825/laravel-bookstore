@if ($errors->any())
        <div style='color:red;width:30%; margin:0 auto'>
            <div >
                {{ __('Whoops! Something went wrong.') }}
            </div>

            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
@endif
@if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
@endif