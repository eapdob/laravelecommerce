<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EcommerceInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:install { --force : Do not ask for user confirmation }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for the Ecommerce Application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('force')) {
            $this->proceed();
        } else {
            if ($this->confirm('This will delete ALL your current data and install the default dummy data. Are you sure?')) {
                $this->proceed();
            }
        }
    }

    private function proceed()
    {
        File::deleteDirectory(public_path('storage/products'));
        File::deleteDirectory(public_path('storage/settings'));
        File::deleteDirectory(public_path('storage/pages'));
        File::deleteDirectory(public_path('storage/posts'));
        File::deleteDirectory(public_path('storage/users'));

        File::deleteDirectory(public_path('storage/public/dummy'));

        $this->callSilent('storage:link');

        $copySuccess = File::copyDirectory(public_path('img/products'), public_path('storage/products/dummy'));

        if ($copySuccess) {
            $this->info('Image successfully copied to storage');
        }

        File::copyDirectory(public_path('img/pages'), public_path('storage/pages'));
        File::copyDirectory(public_path('img/posts'), public_path('storage/posts'));
        File::copyDirectory(public_path('img/users'), public_path('storage/users'));

        $this->call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'VoyagerDatabaseSeeder',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'VoyagerDummyDatabaseSeeder',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'DataTypesTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'DataRowsTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'MenusTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'MenuItemsTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'RolesTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'PermissionsTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'PermissionRoleTableSeeder',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'PermissionRoleTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'UsersTableSeederCustom',
            '--force' => true,
        ]);

        $this->info('Dummy data installed');
    }
}