<?php

namespace App\Models\Traits;

use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Builder;

trait TaxonomizableTrait
{
    /**
     * The Eloquent taxonomies model name.
     *
     * @var string
     */
    protected static $taxonomiesModel = Taxonomy::class;

    /**
     * {@inheritDoc}
     */
    public static function getTaxonomiesModel()
    {
        return static::$taxonomiesModel;
    }

    /**
     * {@inheritDoc}
     */
    public static function setTaxonomiesModel($model)
    {
        static::$taxonomiesModel = $model;
    }

    /**
     * {@inheritDoc}
     */
    public function taxonomies()
    {
        //=> to get all taxonomy topics without namespace limitation, we use belongsToMany instead of morph
        //return $this->morphToMany(static::$taxonomiesModel, 'taxonomizable', 'taxonomized', 'taxonomizable_id', 'taxonomy_id')->withTimestamps();
        return $this->belongsToMany(static::$taxonomiesModel, 'taxonomized', 'taxonomizable_id', 'taxonomy_id')->withTimestamps();
    }

    /**
     * {@inheritDoc}
     */
    public static function allTaxonomies()
    {
        $instance = new static;

        return $instance->createTaxonomiesModel();
    }

    /**
     * {@inheritDoc}
     */
    public static function scopeWhereTaxonomy(Builder $query, $taxonomies, $type = 'taxonomies.id')
    {
        $taxonomies = (new static)->prepareTaxonomies($taxonomies);

        foreach ($taxonomies as $taxonomy) {
            $query->whereHas('taxonomies', function ($query) use ($type, $taxonomy) {
                $query->where($type, $taxonomy);
            });
        }

        return $query;
    }

    /**
     * {@inheritDoc}
     */
    public static function scopeWithTaxonomy(Builder $query, $taxonomies, $type = 'topics.id')
    {
        $taxonomies = (new static)->prepareTaxonomies($taxonomies);

        return $query->whereIn($type, function ($query) use ($taxonomies)  {
            $query->select('taxonomizable_id')->from('taxonomized')
                ->when(count($taxonomies) == 1, function ($query) use ($taxonomies) {
                    return $query->where('taxonomized.taxonomy_id', $taxonomies[0]);
                }, function ($query) use($taxonomies) {
                    return $query->whereIn('taxonomized.taxonomy_id', $taxonomies);
                });
        });
        /*return $query->whereHas('taxonomies', function ($query) use ($type, $taxonomies) {
            $query->whereIn($type, $taxonomies);
        });*/
    }

    /**
     * {@inheritDoc}
     */
    public function taxonomize($taxonomies)
    {
        foreach ($this->prepareTaxonomies($taxonomies) as $taxonomy) {
            $this->taxonomies()->attach($taxonomy);
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function untaxonomize($taxonomies = null)
    {
        $taxonomies = $taxonomies ?: $this->taxonomies()->pluck('taxonomies.id')->all();

        foreach ($this->prepareTaxonomies($taxonomies) as $taxonomy) {
            $this->taxonomies()->detach($taxonomy);
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function setTaxonomies($taxonomies, $type = 'taxonomies.id')
    {
        // Prepare the taxonomies
        $taxonomies = $this->prepareTaxonomies($taxonomies);

        // Get the current entity taxonomies
        $entityTaxonomies = $this->taxonomies()->pluck($type)->all();

        // Prepare the taxonomies to be added and removed
        $taxonomiesToAdd = array_diff($taxonomies, $entityTaxonomies);
        $taxonomiesToDel = array_diff($entityTaxonomies, $taxonomies);

        // Detach the taxonomies
        if (! empty($taxonomiesToDel)) {
            $this->untaxonomize($taxonomiesToDel);
        }

        // Attach the taxonomies
        if (! empty($taxonomiesToAdd)) {
            $this->taxonomize($taxonomiesToAdd);
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function prepareTaxonomies($taxonomies)
    {
        if (is_null($taxonomies)) {
            return [];
        }

        if (is_int($taxonomies)) {
            $taxonomies = [$taxonomies];
        }

        if (is_string($taxonomies)) {
            $taxonomies = (array) $taxonomies;
        }

        return array_unique(array_filter($taxonomies));
    }

    /**
     * {@inheritDoc}
     */
    public static function createTaxonomiesModel()
    {
        return new static::$taxonomiesModel;
    }
}
