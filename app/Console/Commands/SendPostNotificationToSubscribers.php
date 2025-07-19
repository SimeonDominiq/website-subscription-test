<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Console\Command;
use App\Jobs\SendPostNotificationToSubscribers as SendPostNotificationToSubscribersJob;

class SendPostNotificationToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:notify-subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new posts to all subscribers who are yet to receive them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Processing new post notifications...');

        Website::chunk(5, function ($websites) {
            foreach ($websites as $website) {
                Post::where('website_id', $website->id)
                    ->chunk(50, function ($posts) use ($website) {
                        foreach ($posts as $post) {
                            SendPostNotificationToSubscribersJob::dispatch($post->id, $website->id);
                        }
                    });
            }
        });

        $this->info('All notifications queued successfully.');
    }

}