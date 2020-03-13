<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 11.03.2020
 * Time: 23:42
 */

namespace App\Repositories;


use App\Models\AstroturfCalendar;
use App\Repositories\Interfaces\IAstroturfCalendarRepository;
use Illuminate\Support\Collection;

class AstroturfCalendarRepository implements IAstroturfCalendarRepository
{

    public function findById(int $id): ?AstroturfCalendar
    {
        try {
            $calendar = AstroturfCalendar::findOrFail($id);
            return $calendar;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $calendar = AstroturfCalendar::all();
            return $calendar;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findBySubscribeSituation(bool $is_subscribed): Collection
    {
        try {
            $calendar = AstroturfCalendar::where('is_subscriber', $is_subscribed)->get();
            return $calendar;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($astroturf_id, $data): ?AstroturfCalendar
    {
        try {
            $calendar = new AstroturfCalendar();
            $calendar->astroturf_id = $astroturf_id;
            $calendar->title = $data['title'];
            $calendar->start_date = $data['start_date'];
            $calendar->end_date = $data['end_date'];
            $calendar->is_subscriber = $data['is_subscriber'];
            $calendar->save();
            return $calendar;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function delete($id): ?AstroturfCalendar
    {
        try {
            $calendar = $this->findById($id);
            $calendar->delete();
            return $calendar;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}