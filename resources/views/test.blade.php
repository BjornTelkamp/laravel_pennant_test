<!DOCTYPE html>
<html>
<head>
    <title>A/B Test Mockup</title>
    <style>
        .variant-a { background-color: #e6f3ff; padding: 20px; }
        .variant-b { background-color: #ffe6e6; padding: 20px; }
        .button-a { background-color: blue; color: white; padding: 10px; }
        .button-b { background-color: red; color: white; padding: 10px; }
    </style>
</head>
<body>
@if ($variant === 'variant-a')
    <div class="variant-a">
        <h1>Welcome to Variant A</h1>
        <p>This is the blue-themed version.</p>
        <button class="button-a">Click Me (A)</button>
    </div>
@else
    <div class="variant-b">
        <h1>Welcome to Variant B</h1>
        <p>This is the red-themed version.</p>
        <button class="button-b">Click Me (B)</button>
    </div>
@endif
</body>
</html>
