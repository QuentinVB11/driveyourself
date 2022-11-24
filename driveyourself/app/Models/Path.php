<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Path extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function pathType()
    {
        return $this->belongsTo(PathType::class);
    }

    public function examinationCenter()
    {
        return $this->belongsTo(ExaminationCenter::class);
    }


    public function getDistanceAttribute()
    {
        return number_format($this->attributes['distance'] , 1, ',', '.');
    }

    public function getDurationAttribute()
    {
        if($this->attributes['duration'] < 60)
        {
            return $this->attributes['duration'] . ' min';
        }
        else if ($this->attributes['duration'] % 60 == 0)
        {
            return $this->attributes['duration'] / 60 . ' h';
        }
        else
        {
            return floor($this->attributes['duration'] / 60) . ' h ' . $this->attributes['duration'] % 60 . ' min';
        }

    }

    public function points()
    {
        return $this->belongsToMany(Point::class)->using(PathPoint::class)->withPivot('order_number');
    }

    public static function getPaths()
    {

        //DB Field Names TO BE CHANGED
        return DB::table('paths') /* self::join */ -> join('examination_centers', 'examination_center_id', '=', 'examination_centers.id')

            ->select('paths.id','paths.name', 'path_type_id', 'duration', 'distance', 'level', 'examination_center_id', 'examination_centers.name' /*'date', 'difficulty'*/)
            ->orderBy('examination_centers.name')
            ->get();
    }



    public static function getPathByType($typeId)
    {

        //DB Field Names TO BE CHANGED
        return DB::table('paths') /* self::join */->join('examination_centers', 'examination_center_id', '=', 'examination_centers.id')
            ->select('paths.id', 'paths.name', 'path_type_id', 'duration', 'distance', 'examination_center_id', 'examination_centers.name', 'level' /*'date', 'difficulty'*/)
            ->where('path_type_id', '=', "$typeId")
            ->get();
    }

    public static function getPathByCenter($centerId)
    {

        //DB Field Names TO BE CHANGED
        return DB::table('paths') /* self::join */->join('examination_centers', 'examination_center_id', '=', 'examination_centers.id')
            ->select('paths.id', 'paths.name', 'path_type_id', 'duration', 'distance', 'examination_center_id', 'examination_centers.name', 'level' /*'date', 'difficulty'*/)
            ->where('examination_center_id', '=', "$centerId")
            ->get();
    }

    public static function getPathByDuration($duration)
    {

        //DB Field Names TO BE CHANGED
        return DB::table('paths') /* self::join */->join('examination_centers', 'examination_center_id', '=', 'examination_centers.id')
            ->select('paths.id', 'paths.name', 'path_type_id', 'duration', 'distance', 'examination_center_id', 'examination_centers.name', 'level' /*'date', 'difficulty'*/)
            ->where('duration', '=', "$duration")
            ->get();
    }



    public static function getPathByDistance($distance)
    {

        //DB Field Names TO BE CHANGED
        return DB::table('paths') /* self::join */->join('examination_centers', 'examination_center_id', '=', 'examination_centers.id')
            ->select('paths.id', 'paths.name', 'path_type_id', 'duration', 'distance', 'examination_center_id', 'examination_centers.name', 'level' /*'date', 'difficulty'*/)
            ->where('distance', '=', "$distance")
            ->get();
    }

    public static function getPathByLevel($level)
    {

        //DB Field Names TO BE CHANGED
        return DB::table('paths') /* self::join */->join('examination_centers', 'examination_center_id', '=', 'examination_centers.id')
            ->select('paths.id', 'paths.name', 'path_type_id', 'duration', 'distance', 'examination_center_id', 'examination_centers.name', 'level' /*'date', 'difficulty'*/)
            ->where('level', '=', "$level")
            ->get();
    }
}
