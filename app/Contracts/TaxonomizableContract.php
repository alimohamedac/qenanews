<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface TaxonomizableContract
{

    /**
     * Returns the taxonomy model name.
     *
     * @return string
     */
    public static function getTaxonomiesModel();

    /**
     * Sets the taxonomy model name.
     *
     * @param  string  $model
     * @return void
     */
    public static function setTaxonomiesModel($model);

    /**
     * Returns the entity taxonomy model object.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxonomies();

    /**
     * Returns all the taxonomies under the entity namespace.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function allTaxonomies();

    /**
     * Returns the entities with only the given taxonomies.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string|array  $taxonomies
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeWhereTaxonomy(Builder $query, $taxonomies, $type = 'id');

    /**
     * Returns the entities with one of the given taxonomies.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string|array  $taxonomies
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeWithTaxonomy(Builder $query, $taxonomies, $type = 'id');

    /**
     * Attaches  the given taxonomies.
     *
     * @param  array  $taxonomies
     * @return bool
     */
    public function taxonomize($taxonomies);

    /**
     * Detaches the given taxonomies or all entity taxonomies.
     *
     * @param  array  $taxonomies
     * @return bool
     */
    public function untaxonomize($taxonomies = null);

    /**
     * Attaches or detaches the given taxonomies.
     *
     * @param  string|array  $taxonomies
     * @param  string  $type
     * @return bool
     */
    public function setTaxonomies($taxonomies, $type = 'name');

    /**
     * Prepares the given taxonomies before being saved.
     *
     * @param  string|array  $taxonomies
     * @return array
     */
    public function prepareTaxonomies($taxonomies);

    /**
     * Creates a new model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function createTaxonomiesModel();

}
