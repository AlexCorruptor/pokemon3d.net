<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Models\ForumAccount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use anlutro\LaravelSettings\Facade as Setting;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'p3d:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Essential stuff needed for a update.';

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
     * @return string
     */
    public function handle()
    {
        $rev = exec('git rev-parse --short HEAD');
        $branch = exec('git describe --tags --abbrev=0');
        $ver = $branch.' ('.$rev.')';

        $forum_accounts = ForumAccount::where('uuid', null)->orWhere('uuid', '')->get();
        foreach ($forum_accounts as $forum_account) {
            $forum_account->update(['uuid' => Str::uuid()]);
            $this->info('Updating ForumAccount with UUID: '.$forum_account->username);
        }

        $this->info('Migrating...');
        Artisan::call('migrate --force');
        $this->info('Updating version...');
        if (Setting::get('APP_VERSION') != $ver) {
            $this->info('Current version: '.Setting::get('APP_VERSION'));
            Setting::set('APP_VERSION', $ver);
            $this->info('Updated version to: '.Setting::get('APP_VERSION'));
            Setting::save();
        }
        $this->info('Seeding permissions...');
        Artisan::call('db:seed --class=PermissionSeeder');
        $this->info('Giving SA...');
        Artisan::call('p3d:givesa');
        $this->info('Running SkinUserUpdate command...');
        Artisan::call('p3d:skinuserupdate');
        $this->info('Done.');
    }
}
