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
        $this->call('db:seed');
    }


}
