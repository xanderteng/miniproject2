<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
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

        .container {
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            margin-right: 10px; /* Adds space between label and input field */
        }

        .form-control {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .img-thumbnail {
            width: 150px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="{{ route('cars.index') }}" class="{{ Request::is('cars') ? 'active' : '' }}">Parking Lot</a>
        <a href="{{ route('cars.create') }}" class="{{ Request::is('cars/create') ? 'active' : '' }}">Add New Car</a>
    </div>

    <div class="container">
        <h1>Edit Car</h1>
        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="license_plate">License Plate:</label>
                <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}" required>
                @error('license_plate')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="car_type">Car Type:</label>
                <input type="text" class="form-control" id="car_type" name="car_type" value="{{ old('car_type', $car->car_type) }}" required>
                @error('car_type')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="location_id">Location:</label>
                <select class="form-control" id="location_id" name="location_id" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $car->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                    @endforeach
                </select>
                @error('location_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="car_type_image">Car Type Image:</label>
                <input type="file" class="form-control" id="car_type_image" name="car_type_image">
                @if($car->car_type_image)
                    <img src="{{ asset('storage/' . $car->car_type_image) }}" alt="Car Image" class="img-thumbnail mt-2">
                @endif
                @error('car_type_image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Update Car</button>
        </form>
    </div>

</body>
</html>
