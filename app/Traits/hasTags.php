<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Tag;

trait HasTags
{
    protected $queuedTags = [];

    public static function getTagClassName()
    {
        return Tag::class;
    }

    public static function bootHasTags()
    {
        static::created(function (Model $taggableModel) {
            $taggableModel->attachTags($taggableModel->queuedTags);

            $taggableModel->queuedTags = [];
        });

        static::deleted(function (Model $deletedModel) {
            $tags = $deletedModel->tags()->get();

            $deletedModel->detachTags($tags);
        });
    }

    public function tags()
    {
        return $this->morphToMany(self::getTagClassName(), 'taggable');
    }

    public function setTagsAttribute($tags)
    {
        if (! $this->exists) {
            $this->queuedTags = $tags;

            return;
        }

        $this->attachTags($tags);
    }

    public function scopeAllTags(Builder $query, $tags)
    {
        $tags = static::convertToTags($tags);

        collect($tags)->each(function ($tag) use ($query) {
            $query->whereHas('tags', function (Builder $query) use ($tag) {
                return $query->where('id', $tag ? $tag->id : 0);
            });
        });

        return $query;
    }

    public function scopeAnyTags(Builder $query, $tags)
    {
        $tags = static::convertToTags($tags);

        return $query->whereHas('tags', function (Builder $query) use ($tags) {
            $tagIds = collect($tags)->pluck('id');

            $query->whereIn('id', $tagIds);
        });
    }

    public function scopeRelevantTags(Builder $query, $limit = 5)
    {
        $relevant = $this->tags()
            ->newPivotStatement()
            ->select('taggable_id', \DB::raw('count(tag_id) as count_tags'))
            ->whereIn('tag_id', function($q) {
                $q->from($this->tags()->getTable())
                    ->where('taggable_id', $this->getKey())
                    ->select('tag_id');
            })
            ->where('taggable_id', '!=', $this->getKey())
            ->groupBy('taggable_id')
            ->orderBy('count_tags', 'desc')
            ->limit($limit)->pluck('taggable_id');

        return $query->whereIn($this->getKeyName(), $relevant);
    }

    public function attachTags($tags)
    {
        $className = static::getTagClassName();

        $tags = collect($className::findOrCreate($tags));

        $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());

        return $this;
    }

    public function attachTag($tag)
    {
        return $this->attachTags([$tag]);
    }

    public function detachTags($tags)
    {
        $tags = static::convertToTags($tags);

        collect($tags)
            ->filter()
            ->each(function (Tag $tag) {
                $this->tags()->detach($tag);
            });

        return $this;
    }

    public function detachTag($tag)
    {
        return $this->detachTags([$tag]);
    }

    public function syncTags($tags)
    {
        $className = static::getTagClassName();

        $tags = collect($className::findOrCreate($tags));

        $this->tags()->sync($tags->pluck('id')->toArray());

        return $this;
    }

    protected static function convertToTags($values)
    {
        return collect($values)->map(function ($value) {
            if ($value instanceof Tag) {
                return $value;
            }

            $className = static::getTagClassName();

            return $className::findFromString($value);
        });
    }
}