<?php

namespace App\Providers;

use App\Repository\FavoriteRepository;
use App\Repository\Interfaces\FavoritesRepositoryInterface;
use App\Repository\Interfaces\KindRepositoryInterfaces;
use App\Repository\Interfaces\MpaaRepositoryInterface;
use App\Repository\Interfaces\VoteRepositoryInterface;
use App\Repository\KindRepository;
use App\Repository\MpaaRepository;
use App\Repository\VoteRepository;
use App\Repository\AnimeRepository;
use App\Repository\CategoryRepository;
use App\Repository\DLEParseRepository;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use App\Repository\Interfaces\DLEParse;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DLEParse::class, DLEParseRepository::class);
        $this->app->bind(AnimeRepositoryInterfaces::class, AnimeRepository::class);
        $this->app->bind(UserRepositoryInterfaces::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterfaces::class, CategoryRepository::class);
        $this->app->bind(FavoritesRepositoryInterface::class, FavoriteRepository::class);
        $this->app->bind(VoteRepositoryInterface::class, VoteRepository::class);
        $this->app->bind(KindRepositoryInterfaces::class, KindRepository::class);
        $this->app->bind(MpaaRepositoryInterface::class, MpaaRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
