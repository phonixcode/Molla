<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'photo', 'status', 'condition'];

    public static function getBanners()
    {
       return Banner::latest()->get();
    }

    /**
     * @param Request $request
     * @param $table
     */
    public static function toggleStatus($request)
    {
        if (!empty($request)) {
            if ($request->mode == 'true') {
                Banner::where('id', $request->id)->update(['status' => 'active']);
            }else{
                Banner::where('id', $request->id)->update(['status' => 'inactive']);
            }
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
