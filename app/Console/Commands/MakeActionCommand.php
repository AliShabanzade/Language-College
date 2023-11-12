<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class MakeActionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:action
    {model : Namespace action}
    {--type= : types - (Store-Update-Delete-Data-Toggle) - sample = isSu}
                ';

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
        $cmodel = Str::camel($model);

        if ($this->option('type') === 'Store') {
            $this->createAction($model, $cmodel, 'Store');
        }

        if ($this->option('type') === 'Update') {
            $this->createAction($model, $cmodel, 'Update');
        }

        if ($this->option('type') === 'Delete') {
            $this->createAction($model, $cmodel, 'Delete');
        }

        if ($this->option('type') === 'Toggle') {
            $this->createAction($model, $cmodel, 'Toggle');
        }

        if ($this->option('type') === 'Data') {
            $this->createAction($model, $cmodel, 'Data');
        }

    }

    private function createAction($model, $cmodel, $type): void
    {
        $content_repository = file_get_contents(__DIR__ . '/stubs/actions/' . Str::camel($type) . '.php.stub');
        $content_repository = str_replace(array('{{model}}', '{{cmodel}}'), array($model, $cmodel), $content_repository);

        $path = base_path('app/Actions/' . $model);
        if (!is_dir($path) && !mkdir($path, 0775) && !is_dir($path)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
        }
        $var = $path . '/' . Str::studly($type) . $model . 'Action.php';
        if (!file_exists($var)) {
            File::put($var, $content_repository);
        }
    }
}
