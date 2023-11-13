<?php

namespace App\Console\Commands;

use RuntimeException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:controller
    {model : Namespace action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $model = $this->argument('model');
        $model = Str::studly($model);

        $content_controller = file_get_contents(__DIR__ . '/stubs/controller.php.stub');
        $content_controller = str_replace(array('{{model}}', '{{kmodel}}'), array($model, Str::kebab($model)), $content_controller);

        $path = base_path('app/Http/Controllers/Api/V1/' );


        if ( ! file_exists($path . '/' . $model . 'Controller.php')) {
            File::put($path . '/' . $model . 'Controller.php', $content_controller);
        }

    }
}
