<?php

namespace App\Console\Commands;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'smallgo:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the  package';

    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('key:generate');
        $this->initDatabase();
    }

    /**
     * Create tables and seed it.
     *
     * @return void
     */
    public function initDatabase()
    {
        $this->call('migrate');

        if (Administrator::count() == 0) {
            $this->call('db:seed', ['--class' => \Encore\Admin\Auth\Database\AdminTablesSeeder::class]);
        }
        $this->call('db:seed', ['--class' => \Database\Seed\InitTableSeeder::class]);
    }


}
