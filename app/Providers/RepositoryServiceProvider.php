<?php

namespace App\Providers;

use App\Repositories\AstroturfCalendarRepository;
use App\Repositories\AstroturfRepository;
use App\Repositories\AstroturfServiceRepository;
use App\Repositories\EliminationApplicationRepository;
use App\Repositories\EliminationLevelRepository;
use App\Repositories\EliminationMatchRepository;
use App\Repositories\EliminationRepository;
use App\Repositories\FacilityRepository;
use App\Repositories\Interfaces\IAstroturfCalendarRepository;
use App\Repositories\Interfaces\IAstroturfRepository;
use App\Repositories\Interfaces\IAstroturfServiceRepository;
use App\Repositories\Interfaces\IEliminationApplicationRepository;
use App\Repositories\Interfaces\IEliminationLevelRepository;
use App\Repositories\Interfaces\IEliminationMatchRepository;
use App\Repositories\Interfaces\IEliminationRepository;
use App\Repositories\Interfaces\IFacilityRepository;
use App\Repositories\Interfaces\IPlayerRepository;
use App\Repositories\Interfaces\IPlayerSkillRepository;
use App\Repositories\Interfaces\ITeamMemberRepository;
use App\Repositories\Interfaces\ITeamRepository;
use App\Repositories\Interfaces\IVSRepository;
use App\Repositories\PlayerRepository;
use App\Repositories\PlayerSkillRepository;
use App\Repositories\TeamMemberRepository;
use App\Repositories\TeamRepository;
use App\Repositories\VSRepository;
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
          IAstroturfCalendarRepository::class,
          AstroturfCalendarRepository::class
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

        $this->app->bind(
            IVSRepository::class,
            VSRepository::class
        );

        $this->app->bind(
            IEliminationRepository::class,
            EliminationRepository::class
        );

        $this->app->bind(
            IEliminationApplicationRepository::class,
            EliminationApplicationRepository::class
        );

        $this->app->bind(
            IEliminationMatchRepository::class,
            EliminationMatchRepository::class
        );

        $this->app->bind(
          IEliminationLevelRepository::class,
          EliminationLevelRepository::class
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
