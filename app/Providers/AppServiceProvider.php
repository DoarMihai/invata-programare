<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contact;
use App\Announcement;
use App\Lesson;
use Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*$this->app->bind('path.public', function() {
          return base_path().'/public_html';
        });*/
        
        view()->share('contactMessages', Contact::where('status', '=', 0)->get() );
        view()->share('defaultTitle', 'Invata-Programare : Tutoriale gratuite de PHP, HTML5, CSS3, jQuery si multe altele - Tutoriale gratuite de PHP, HTML5, CSS, JavaScript, jQuery, Java, C++, Python si mutle aletele');
        view()->share('announcement', Announcement::where('deleted', 0)->orderBy('id', 'DESC')->first());


        view()->share('promotedSidebar', Lesson::whereId(9)->first());

        $excludedCats = [2, 3, 4, 6, 7, 8, 9, 11, 12, 13, 14];
        view()->share('excluded', $excludedCats);

        // The setup
        $numberOfRows = 4;
        $lesson = Lesson::all(); // or use a ::where()->get();

        // And the actual randomisation line
        $random_lessons = $lesson->where('deleted', '=', 0)->shuffle()->slice(0, $numberOfRows);
        view()->share('random_lessons', $random_lessons);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
