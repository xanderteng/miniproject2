<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: flex-start; /* Align items to the left */
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
      
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
      
        .delete-btn, .edit-btn {
            font-size: 14px;
            cursor: pointer;
            padding: 5px 10px;
            border: none;
            background: none;
            text-decoration: underline;
            font-weight: bold;
        }
        .delete-btn {
            color: red;
        }
        .edit-btn {
            color: blue;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <a href="{{ route('cars.index') }}" class="{{ Request::is('cars') ? 'active' : '' }}">Parking Lot</a>
    <a href="{{ route('cars.create') }}" class="{{ Request::is('cars/create') ? 'active' : '' }}">Add New Car</a>
</div>

<!-- Main Content -->
<div style="padding: 20px;">
    <h1>Cars List</h1>
    <p>Total Cars Parked: {{ $carCount }}</p>

    <table>
        <thead>
            <tr>
                <th>Number</th>
                <th>License Plate</th>
                <th>Car Type</th>
                <th>Parked At</th>
                <th>Location</th>
                <th>Car Image</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $index => $car)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $car->license_plate }}</td>
                    <td>{{ $car->car_type }}</td>
                    <td>{{ $car->parked_at }}</td>
                    <td>{{ $car->location->name }}</td>
                    <td>
                    @if($car->car_type_image)
                        <img src="{{ asset('storage/' . $car->car_type_image) }}" alt="Car Image" width="100">
                    @else
    No image available
@endif

                    </td>
                    <td>
                        <a href="{{ route('cars.edit', $car->id) }}" class="edit-btn">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this car?')" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $cars->links() }} 
    </div>
</div>

</body>
</html>
