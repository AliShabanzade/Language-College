<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
<<<<<<< HEAD
use JetBrains\PhpStorm\NoReturn;
=======
>>>>>>> 10855a1 (fix project files)
use Str;

class BotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bot
                {model : Namespace action}
<<<<<<< HEAD
                {--except= : Except action - (i=index,s=store,S=seeder,u=update,d=delete,f=factory,r=resource,R=request,c=controller.php.stub,p=policy,y=Repository) - sample = isSu}
=======
                {--except= : Except action - (i=index,s=store,S=seeder,u=update,d=delete,f=factory,r=resource,R=request,c=controller,p=policy,y=Repository) - sample = isSu}
>>>>>>> 10855a1 (fix project files)
                {--t|toggle : Add toggle action}
                {--d|data : Add data needed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create multiple action';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = $this->argument('model');
        $model = Str::studly($model);

<<<<<<< HEAD

=======
>>>>>>> 10855a1 (fix project files)
        Artisan::call('make:model ' . $model . ' -m');
        $this->info('Make ' . $model . ' model and migration Successfully.');

        Artisan::call('app:action ' . $model . ' --type=Store');
        Artisan::call('app:action ' . $model . ' --type=Update');
        Artisan::call('app:action ' . $model . ' --type=Delete');

        if ($this->option('toggle')) {
            Artisan::call('app:action ' . $model . ' --type=Toggle');
        }

        if ($this->option('data')) {
            Artisan::call('app:action ' . $model . ' --type=Data');
        }

        Artisan::call('make:policy ' . $model . 'Policy --model=' . $model);

        Artisan::call('make:resource ' . $model . 'Resource');

        Artisan::call('make:request ' . 'Store' . $model . 'Request');

        Artisan::call('make:request ' . 'Update' . $model . 'Request');

//        Artisan::call('make:controller.php.stub Api/V1/' . $model . 'Controller --api --model=' . $model);

        Artisan::call('make:factory ' . $model . 'Factory');

        Artisan::call('make:provider RepositoryServiceProvider');

        Artisan::call('app:repository ' . $model);

        Artisan::call('app:lang ' . $model);

        Artisan::call('app:route ' . $model);

<<<<<<< HEAD
        Artisan::call('app:controller ' . $model);

=======
>>>>>>> 10855a1 (fix project files)
        dd($model);
    }
}
