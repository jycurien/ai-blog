<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contract\AutomaticPostCreator as AutomaticPostCreatorInterface;

class CreatePost extends Command
{
    public function __construct(
        private readonly AutomaticPostCreatorInterface $postCreator
    ){
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically create a random Post by calling some AI Api';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Creating new post...');

        try {
            $post = $this->postCreator->createPost();
            $this->info('New post created!');
        } catch (\Exception $exception) {
            $this->error(sprintf('Something went wrong: %s', $exception->getMessage()));
        }
    }
}
