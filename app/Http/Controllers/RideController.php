<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;

class RideController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Simulate node.js latency
        usleep(1500000); // 1.5 seconds

        return response()->json([
            'success' => true,
            'user' => [
                'id' => 'user_' . time(),
                'name' => explode('@', $request->email)[0],
                'email' => $request->email,
            ]
        ]);
    }

    public function getRides()
    {
        // Simulate node.js latency
        usleep(500000); // 0.5 seconds

        if (Ride::count() === 0) {
            // Populate mock data into Local SQLite instead of maintaining raw arrays
            Ride::insert([
                [
                    'destination' => 'Koramangala 5th Block',
                    'pickupLocation' => 'HSR Layout',
                    'time' => now()->addHour()->toIso8601String(),
                    'driverName' => 'John Doe',
                    'status' => 'Upcoming',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'destination' => 'Indiranagar Metro',
                    'pickupLocation' => 'Koramangala 5th Block',
                    'time' => now()->subDay()->toIso8601String(),
                    'driverName' => 'Raju',
                    'status' => 'Completed',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'destination' => 'Airport',
                    'pickupLocation' => 'Indiranagar',
                    'time' => now()->subDays(2)->toIso8601String(),
                    'driverName' => 'Manjesh',
                    'status' => 'Completed',
                    'created_at' => now(), 'updated_at' => now(),
                ]
            ]);
        }

        $rides = Ride::all();

        return response()->json($rides);
    }
}
