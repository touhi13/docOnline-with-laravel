<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeHelperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new helper class';

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
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $stub = file_get_contents(__DIR__.'/stubs/helper.stub');

        $stub = str_replace('{{class}}', ucfirst($name), $stub);

        if (!is_dir(app_path('Helpers'))) {
            mkdir(app_path('Helpers'));
        }

        file_put_contents(app_path("Helpers/{$name}.php"), $stub);

        $this->info("Helper created successfully.");
    }
}
