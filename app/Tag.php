<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    public $guarded = [];

    public static function findOrCreate($values)
    {
        $tags = collect($values)->map(function ($value) {
            if ($value instanceof Tag) {
                return $value;
            }

            return static::findOrCreateFromString($value);
        });

        return is_string($values) ? $tags->first() : $tags;
    }

    public static function findFromString(string $name)
    {
        return static::query()
            ->where("name", $name)
            ->first();
    }

    protected static function findOrCreateFromString(string $name)
    {
        $tag = static::findFromString($name);

        if (! $tag) {
            $tag = static::create([
                'name' => $name
            ]);
        }

        return $tag;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = ! empty($value) ? str_slug($value) : null;
    }
}