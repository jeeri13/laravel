@extends('layout.app') <!-- Use your layout as needed -->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Promo Code Redemption Result</h2>
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @else
                <p>Hello, {{ $user->name }}</p>
                <p>Original Price: ${{ $originalPrice }}</p>
                <p>Price after Promo Code: ${{ $discountedPrice }}</p>
            @endif
        </div>
    </div>
</div>
@endsection
