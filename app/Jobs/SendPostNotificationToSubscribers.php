<?php

namespace App\Jobs;

use App\Mail\NewPostNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\WebsiteSubscriber;
use Illuminate\Support\Facades\Mail;

class SendPostNotificationToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $postId;
    public $websiteId;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($postId, $websiteId)
    {
        $this->postId = $postId;
        $this->websiteId = $websiteId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $post = \App\Models\Post::find($this->postId);
        if (!$post) {
            return;
        }  

        WebsiteSubscriber::where('website_id', $this->websiteId)
            ->chunk(50, function ($subscribersChunk) use ($post) {
                foreach ($subscribersChunk as $subscriber) {
                    Mail::to($subscriber->email)->queue(new NewPostNotificationMail($post));
                }
            });        
    }
}
