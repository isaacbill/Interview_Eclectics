<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function processRecords()
    {
        // Define an array of 20 records
        $records = [
            "Record 1", "Record 2", "Record 3", "Record 4", "Record 5",
            "Record 6", "Record 7", "Record 8", "Record 9", "Record 10",
            "Record 11", "Record 12", "Record 13", "Record 14", "Record 15",
            "Record 16", "Record 17", "Record 18", "Record 19", "Record 20"
        ];

        // Iterate through the array in batches of 5
        $batchSize = 5;
        $totalRecords = count($records);

        for ($i = 0; $i < $totalRecords; $i += $batchSize) {
            // Extract the current batch
            $batch = array_slice($records, $i, $batchSize);

            // Start processing the batch
            echo "Processing Batch " . (($i / $batchSize) + 1) . ":\n";
            echo "Starting from index $i\n";

            foreach ($batch as $index => $value) {
                // Calculate the original index number
                $originalIndex = $i + $index;
                echo "Index: $originalIndex, Value: $value\n";
            }

            // Complete the batch processing
            echo "Batch completed.\n\n";
        }
    }
}
