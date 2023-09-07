<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Basic</title>
    </head>
    <body>
        
        <h1>Welcome to Discount Page</h1>

    <form action="{{ route('processForm') }}" method="POST">
        @csrf <!-- CSRF Token -->
        
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>
        </div>
        
        <div>
            <label for="promo_code">Promo code:</label>
            <input type="text" id="promo_code" name="promo_code">
        </div>
        
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
    </body>
</html>