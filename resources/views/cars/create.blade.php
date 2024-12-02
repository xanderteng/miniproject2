<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: flex-start;
            padding: 10px;
        }
        .navbar a {
            color: white;
            padding: 14px 20px;
            text-align: center;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar a.active {
            background-color: #4CAF50;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            margin-right: 10px; /* Adds space between the label and the input field */
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        button {
            padding: 10px 15px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <a href="{{ route('cars.index') }}" class="{{ Request::is('cars') ? 'active' : '' }}">Parking Lot</a>
    <a href="{{ route('cars.create') }}" class="{{ Request::is('cars/create') ? 'active' : '' }}">Add New Car</a>
</div>

<!-- Form -->
<div style="padding: 20px;">
    <form method="POST" action="{{ url('/create-cars') }}" enctype="multipart/form-data">
        @csrf

        <div class="input-group">
            <label for="license_plate">License Plate:</label><br>
            <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate') }}" required>
            @error('license_plate')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label for="car_type">Car Type:</label><br>
            <input type="text" name="car_type" id="car_type" value="{{ old('car_type') }}" required>
            @error('car_type')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label for="location_id">Location:</label><br>
            <select name="location_id" id="location_id" required>
                <option value="">-- Select a Location --</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
            @error('location_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label for="car_type_image">Car Type Image:</label><br>
            <input type="file" name="car_type_image" id="car_type_image" required>
            @error('car_type_image')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Add Car</button>
    </form>
</div>

</body>
</html>
