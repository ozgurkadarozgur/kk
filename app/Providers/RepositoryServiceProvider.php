<?php

namespace App\Providers;

use App\Repositories\AstroturfCalendarRepository;
use App\Repositories\AstroturfRepository;
use App\Repositories\AstroturfServiceRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\EliminationApplicationRepository;
use App\Repositories\EliminationLevelRepository;
use App\Repositories\EliminationMatchRepository;
use App\Repositories\EliminationRepository;
use App\Repositories\FacilityRepository;
use App\Repositories\FacilityUserRepository;
use App\Repositories\Interfaces\IAstroturfCalendarRepository;
use App\Repositories\Interfaces\IAstroturfRepository;
use App\Repositories\Interfaces\IAstroturfServiceRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICityRepository;
use App\Repositories\Interfaces\IEliminationApplicationRepository;
use App\Repositories\Interfaces\IEliminationLevelRepository;
use App\Repositories\Interfaces\IEliminationMatchRepository;
use App\Repositories\Interfaces\IEliminationRepository;
use App\Repositories\Interfaces\IFacilityRepository;
use App\Repositories\Interfaces\IFacilityUserRepository;
use App\Repositories\Interfaces\ILeagueApplicationRepository;
use App\Repositories\Interfaces\ILeagueFixtureRepository;
use App\Repositories\Interfaces\ILeagueRepository;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Interfaces\IPlayerAstroturfReservationRepository;
use App\Repositories\Interfaces\IPlayerPasswordResetRepository;
use App\Repositories\Interfaces\IPlayerPositionRepository;
use App\Repositories\Interfaces\IPlayerRepository;
use App\Repositories\Interfaces\IPlayerSkillRepository;
use App\Repositories\Interfaces\IProductRepository;
use App\Repositories\Interfaces\ITeamMemberRepository;
use App\Repositories\Interfaces\ITeamRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\Interfaces\IVSRepository;
use App\Repositories\LeagueApplicationRepository;
use App\Repositories\LeagueFixtureRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PlayerAstroturfReservationRepository;
use App\Repositories\PlayerPasswordResetRepository;
use App\Repositories\PlayerPositionRepository;
use App\Repositories\PlayerRepository;
use App\Repositories\PlayerSkillRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TeamMemberRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
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
          ICityRepository::class,
          CityRepository::class
        );

        $this->app->bind(
          IUserRepository::class,
          UserRepository::class
        );

        $this->app->bind(
            IFacilityRepository::class,
            FacilityRepository::class
        );

        $this->app->bind(
          IFacilityUserRepository::class,
          FacilityUserRepository::class
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
            IPlayerPositionRepository::class,
            PlayerPositionRepository::class
        );

        $this->app->bind(
            IPlayerRepository::class,
            PlayerRepository::class
        );

        $this->app->bind(
          IPlayerPasswordResetRepository::class,
          PlayerPasswordResetRepository::class
        );

        $this->app->bind(
            IPlayerAstroturfReservationRepository::class,
            PlayerAstroturfReservationRepository::class
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

        $this->app->bind(
            ILeagueRepository::class,
            LeagueRepository::class
        );

        $this->app->bind(
            ILeagueApplicationRepository::class,
            LeagueApplicationRepository::class
        );

        $this->app->bind(
          ILeagueFixtureRepository::class,
          LeagueFixtureRepository::class
        );

        $this->app->bind(
            ICategoryRepository::class,
            CategoryRepository::class
        );

        $this->app->bind(
          IProductRepository::class,
          ProductRepository::class
        );

        $this->app->bind(
          IOrderRepository::class,
          OrderRepository::class
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
