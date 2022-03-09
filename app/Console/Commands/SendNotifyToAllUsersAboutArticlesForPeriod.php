<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticlesForPeriodNotification;

class SendNotifyToAllUsersAboutArticlesForPeriod extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:get_articles_for_period
        {daysAgo : Период задается в количестве дней, отсчитываемых назад от текущего времени}        
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправить уведомления всем пользователям о статьях, созданных в указанный промежуток времени';

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
        $from = Carbon::now()->subDays($this->argument('daysAgo'));        

        $articlesTitle = Article::where('created_at', '>', $from)->get()->pluck('title')->toArray();

        $users = User::all();

        foreach ($users as $user) {
            $user->notify(new ArticlesForPeriodNotification($articlesTitle));          
        }
    }
}
