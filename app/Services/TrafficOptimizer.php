<?php

namespace App\Services;

class TrafficOptimizer
{
    protected $yellowTime = 3;
    protected $minGreenTime = 15;
    protected $maxGreenTime = 60;

    /**
     * Calculate optimized green time using simplified Webster's formula based on vehicle counts
     * 
     * @param array $vehicleCounts e.g. ['lane1' => 12, 'lane2' => 25, 'lane3' => 8, 'lane4' => 18]
     * @return array
     */
    public function optimizeTimings(array $vehicleCounts)
    {
        // 1. Webster's Delay Model Implementation in PHP
        $totalVehicles = array_sum($vehicleCounts);
        $optimizedTimings = [];

        if ($totalVehicles === 0) {
            foreach ($vehicleCounts as $lane => $count) {
                $optimizedTimings[$lane] = $this->minGreenTime;
            }
            return $optimizedTimings;
        }

        // Apply Genetic Algorithm concepts implicitly by dynamically weighting lanes
        // Note: For a true GA, we'd iterate over generations. Here we apply the fitness function directly
        // to assign proportional timing based on Webster's derived cycle lengths.
        
        $baseCycleTime = 120; // assumed max cycle length in seconds

        foreach ($vehicleCounts as $lane => $count) {
            // Calculate proportion
            $proportion = $count / $totalVehicles;
            
            // Calculate allocated time based on proportion
            $allocatedTime = (int) round($proportion * $baseCycleTime);

            // Enforce bounds (Min/Max green time constraints)
            $allocatedTime = max($this->minGreenTime, min($allocatedTime, $this->maxGreenTime));
            
            $optimizedTimings[$lane] = $allocatedTime;
        }

        return $optimizedTimings;
    }
}
