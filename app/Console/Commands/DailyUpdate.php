<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Students;
use App\Models\Teachers;

class DailyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily_updates';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function __construct()
    {
        parent::__construct();
    }  

    public function handle()
    {
        $students = Students::all();

        foreach ($students as $student) {
            $student->attend = "0";
            $student->time = null;
            $student->parent = null;
            $student->save();
        }
        $teachers = Teachers::all();

        foreach ($teachers as $teacher) {
            $teacher->attend = "0";
            $teacher->save();
        }
        return Command::SUCCESS;
    }
}
