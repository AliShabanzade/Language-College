<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Str;

class Bot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bot
                {model : Namespace action}
                {--except= : Except action - (i=index,s=store,S=seeder,u=update,d=delete,f=factory,r=resource,R=request,c=controller,p=policy,y=Repository) - sample = isSu}
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

        Artisan::call('make:model ' . $model . ' -m');
        $this->info('Make ' . $model . ' model and migration Successfully.');

        Artisan::call('make:action ' . $model . '/Store' . $model . 'Action');
        Artisan::call('make:action ' . $model . '/Update' . $model . 'Action');
        Artisan::call('make:action ' . $model . '/Delete' . $model . 'Action');


        if ($this->option('toggle')) {
            Artisan::call('make:action ' . $model . '/Toggle' . $model . 'Action');
        }

        if ($this->option('data')) {
            Artisan::call('make:action ' . $model . '/Data' . $model . 'Action');
        }

        Artisan::call('make:policy ' . $model . 'Policy --model=' . $model);

        Artisan::call('make:resource ' . $model . 'Resource');

        Artisan::call('make:request ' . 'Store' . $model . 'Request');

        Artisan::call('make:request ' . 'Update' . $model . 'Request');

        Artisan::call('make:controller Api/V1/' . $model . 'Controller --api --model=' . $model);

        Artisan::call('make:factory ' . $model . 'Factory');

        Artisan::call('make:provider RepositoryServiceProvider');



        dd($model);
    }
}
