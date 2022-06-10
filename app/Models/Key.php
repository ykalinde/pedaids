<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    protected $dates = ["disabled_at"];

    protected $fillable = ["key", "disabled_at"];

    public static function searchKey($key)
    {
        return self::where("key", $key)->first();
    }

    public static function saveKey($key)
    {
        return self::create(["key" => $key]);
    }

    public static function hasDisabled()
    {
        return self::whereNotNull("disabled_at")->exists();
    }

    public static function getRandomDisabledKey()
    {
        return self::whereNotNull("disabled_at")->inRandomOrder()->first();
    }

    public function disable()
    {
        $this->update(["disabled_at" => now()]);
    }

    public function enableKey()
    {
        $this->update(["disabled_at" => null]);
    }
}
