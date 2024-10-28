<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Website;
use App\Mail\PostNotificationMail;
use Illuminate\Support\Facades\Mail;

class SendPostNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:post-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Users of new posts';

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
     * @return int
     */
    public function handle()
    {
        // Retrieve all unsent posts
        $unsentPosts = Post::where('sent', false)->get();

        foreach ($unsentPosts as $post) {
            $website = $post->website;

            // Get all subscribers for the website through subscriptions
            $subscriptions = $website->subscriptions()->with('user')->get();

            foreach ($subscriptions as $subscription) {
                $subscriber = $subscription->user;

                // Send the email notification
                Mail::to($subscriber->email)->queue(new PostNotificationMail($post));
            }

            // Mark the post as sent
            $post->update(['sent' => true]);
        }

        $this->info('Post notifications sent to all subscribers.');
    }
}
