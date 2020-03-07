<?php

namespace App\Providers;

use App\Repositories\AstroturfRepository;
use App\Repositories\AstroturfServiceRepository;
use App\Repositories\FacilityRepository;
use App\Repositories\Interfaces\IAstroturfRepository;
use App\Repositories\Interfaces\IAstroturfServiceRepository;
use App\Repositories\Interfaces\IFacilityRepository;
use App\Repositories\Interfaces\IPlayerRepository;
use App\Repositories\Interfaces\IPlayerSkillRepository;
use App\Repositories\Interfaces\ITeamMemberRepository;
use App\Repositories\Interfaces\ITeamRepository;
use App\Repositories\PlayerRepository;
use App\Repositories\PlayerSkillRepository;
use App\Repositories\TeamMemberRepository;
use App\Repositories\TeamRepository;
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
        $this->app->bind(
            IFacilityRepository::class,
            FacilityRepository::class
        );

        $this->app->bind(
            IAstroturfRepository::class,
            AstroturfRepository::class
        );

        $this->app->bind(
            IAstroturfServiceRepository::class,
            AstroturfServiceRepository::class
        );

        $this->app->bind(
            IPlayerSkillRepository::class,
            PlayerSkillRepository::class
        );

        $this->app->bind(
            IPlayerRepository::class,
            PlayerRepository::class
        );

        $this->app->bind(
            ITeamRepository::class,
            TeamRepository::class
        );

        $this->app->bind(
            ITeamMemberRepository::class,
            TeamMemberRepository::class
        );

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
