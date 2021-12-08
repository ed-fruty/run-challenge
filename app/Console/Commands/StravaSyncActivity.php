<?php

namespace App\Console\Commands;

use App\Jobs\LoadStravaActivities;
use App\Models\User;
use App\Services\Strava\DTO\UserActivityQuery;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

class StravaSyncActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'strava:sync:activity {--size=50} {--sleep=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Strava activities';
    /**
     * @var Dispatcher
     */
    private $bus;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Dispatcher  $bus)
    {
        parent::__construct();
        $this->bus = $bus;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() : int
    {
        User::query()
            ->whereNotNull('strava_id')
            ->orderBy('strava_last_synced_at')
            ->take($this->getSizeOption())
            ->get()
            ->each(function (User $user) {
                $this->line(sprintf(
                    'Start loading for user [id=%d]',
                    $user->id
                ));

                $query = UserActivityQuery::createForUser($user);

                $this->bus->dispatchNow(new LoadStravaActivities($user, $query));

                $this->info('Done.');

                $this->line(sprintf('Sleep for %d', $this->getSleepOption()));
                sleep($this->getSleepOption());
                $this->info('Wake up.');
            });

        $this->info('Job done successfully.');

        return self::SUCCESS;
    }

    /**
     * @return int
     */
    protected function getSleepOption(): int
    {
        return (int) $this->option('sleep');
    }

    /**
     * @return int
     */
    protected function getSizeOption(): int
    {
        return (int) $this->option('size');
    }
}
