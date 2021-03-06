<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrawlingDataArticleAntaraNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawlingarticletribun:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawling save data antara news';

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
     * @return mixed
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost:8000/api/generate-save-articles-antara-news-crawling', [
        'form_params' => [
        ]
        ]);
        echo "Data Berhasil disimpan";
    }
}
