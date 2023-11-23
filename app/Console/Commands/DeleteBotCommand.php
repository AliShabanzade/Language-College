<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteBotCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dbot
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


        $path = base_path('app/Actions/' . $model . '/Delete' . $model . 'Action.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }
        $path = base_path('app/Actions/' . $model . '/Store' . $model . 'Action.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('app/Actions/' . $model . '/Update' . $model . 'Action.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('app/Actions/' . $model);
        if (is_dir($path)) {
            rmdir($path);
        }

        $path = base_path('app/Http/Requests/' . '/Store' . $model . 'Request.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('app/Http/Requests/' . '/Update' . $model . 'Request.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('app/Http/Resources/' . $model . 'Resource.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }


        $path = base_path('app/Models/' . $model . '.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('app/Policies/' . $model . 'Policy.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('app/Repositories/' . $model . '/' . $model . 'Repository.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('app/Repositories/' . $model . '/' . $model . 'RepositoryInterface.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('app/Repositories/' . $model);
        if (is_dir($path)) {
            rmdir($path);
        }

        $path = base_path('database/factories/' . $model . 'Factory.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('database/seeders/' . $model . 'Seeder.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('lang/en' . '/' . $model . '.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('lang/fa' . '/' . $model . '.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path = base_path('routes/api' . '/' . $model . '.php');
        if (\File::exists($path)) {
            \File::delete($path);
        }

    }

}
