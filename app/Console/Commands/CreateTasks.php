<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class CreateTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:tasks {--task=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('task')) {            
            $task = $this->option('task');
            Task::create([
                'text' => $task,
            ]);
        }
        $tasks = Task::all();
        foreach($tasks as $task) {
            $this->info("$task->id: $task->text");
        }
        return;
    }
}
