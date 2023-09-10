<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Basic</title>
        <!-- Add Bootstrap 5.4.3 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
    </head>
    <body>
        <div class="container mt-5">
	        <h1 class="text-center">Welcome to Discount Page</h1>
	            <div class="text-end">
	                    @if(!session()->has('email'))
	                        <a href="login" class="btn btn-primary">Login</a>
	                    @else
	                        <b>Welcome {{ session('name') }} </b>
	                        <br/><a href="logout"  class="btn btn-danger"> Logout </a>
	                    @endif
	                    </div>
	        @if(session('success'))
	            <div class="alert alert-success mt-3">
	                {{ session('success') }}
	            </div>
	        @endif
	        @if(session('error'))
	            <div class="alert alert-danger mt-3">
	                {{ session('error') }}
	            </div>
	        @endif
	    <form action="{{ route('processForm') }}" method="POST" class="mt-4" style="margin:10px">
	        @csrf <!-- CSRF Token -->
        
	        <div class="mb-3">
	            <label for="price" class="form-label">Price:</label>
	            <input type="text" class="form-control" id="price" name="price" required>
	        </div>
        
	        <div class="mb-3">
	            <label for="promo_code" class="form-label">Promo code:</label>
	            <input type="text" class="form-control" id="promo_code" name="promo_code">
	        </div>
        
	        <div class="mb-3">
	            <button type="submit" class="btn btn-primary">Submit</button>
	        </div>
	    </form>
	</div>
    <!-- Add Bootstrap 5.4.3 JavaScript (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.4.3/js/bootstrap.min.js"></script>
    </body>
</html>