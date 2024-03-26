<?php

namespace Database\Seeders;

use App\Models\NonWorkingDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonWorkingDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Add all Saturdays and Sundays in 2024
        $startDate = new \DateTime('2024-01-01');
        $endDate = new \DateTime('2024-12-31');
        $interval = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($startDate, $interval, $endDate);

        foreach ($dateRange as $date) {
            if ($date->format('N') >= 6) { // Check if it's Saturday or Sunday (6 or 7)
                NonWorkingDay::create([
                    'date' => $date->format('Y-m-d'),
                    'description' => 'Weekend',
                ]);
            }
        }

        // List of holidays in 2024 (Example data)
        $holidays = [
            '2024-01-01' => 'New Year\'s Day',
            '2024-01-14' => 'Makar Sankranti',
            '2024-01-26' => 'Republic Day',
            '2024-03-01' => 'Maha Shivaratri',
            '2024-03-10' => 'Holi',
            '2024-04-06' => 'Ram Navami',
            '2024-04-10' => 'Mahavir Jayanti',
            '2024-04-14' => 'Good Friday',
            '2024-05-01' => 'Labour Day',
            '2024-08-12' => 'Eid al-Fitr',
            '2024-08-15' => 'Independence Day',
            '2024-08-17' => 'Parsi New Year',
            '2024-09-02' => 'Ganesh Chaturthi',
            '2024-09-10' => 'Muharram',
            '2024-09-29' => 'Dussehra',
            '2024-10-02' => 'Mahatma Gandhi Jayanti',
            '2024-10-08' => 'Karva Chauth',
            '2024-10-27' => 'Diwali',
            '2024-11-10' => 'Milad un-Nabi',
            '2024-12-25' => 'Christmas Day',
        ];
        foreach ($holidays as $date => $description) {
            NonWorkingDay::create([
                'date' => $date,
                'description' => $description,
            ]);
        }
    }
}
