<?php namespace App\Base\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

use Symfony\Component\HttpKernel\Exception\HttpException;


/**
 * Trait for cascading delete
 *
 * @package App\Base\Traits
 */
trait CascadeDelete
{
    /**
     * Boot the trait.
     *
     * Listen for the deleting event of a soft deleting model, and run
     * the delete operation for any configured relationship methods.
     *
     * @throws \HttpException
     */
    protected static function bootCascadeDelete()
    {

        static::deleting(function ($model)
        {

            if ($invalidCascadingRelationships = $model->hasInvalidCascadingRelationships())
            {
                throw new HttpException(sprintf(
                    '%s [%s] must exist and return an object of type Illuminate\Database\Eloquent\Relations\Relation',
                    str_plural('Relationship', count($invalidCascadingRelationships)),
                    join(', ', $invalidCascadingRelationships)
                ));
            }

            $delete = $model->forceDeleting ? 'forceDelete' : 'delete';

            foreach ($model->getActiveCascadingDeletes() as $relationship)
            {
                if ($model->{$relationship} instanceof Model)
                {
                    $model->{$relationship}->{$delete}();
                }
                else
                {
                    foreach ($model->{$relationship} as $child)
                    {
                        $child->{$delete}();
                    }
                }
            }
        });
    }



    /**
     * Determine if the current model has any invalid cascading relationships defined.
     *
     * A relationship is considered invalid when the method does not exist, or the relationship
     * method does not return an instance of Illuminate\Database\Eloquent\Relations\Relation.
     *
     * @return array
     */
    protected function hasInvalidCascadingRelationships()
    {
        return array_filter($this->getCascadingDeletes(), function ($relationship) {
            return ! method_exists($this, $relationship) || ! $this->{$relationship}() instanceof Relation;
        });
    }

    /**
     * Fetch the defined cascading soft deletes for this model.
     *
     * @return array
     */
    protected function getCascadingDeletes()
    {
        return isset($this->cascadeDeletes) ? (array) $this->cascadeDeletes : [];
    }

    /**
     * For the cascading deletes defined on the model, return only those that are not null.
     *
     * @return array
     */
    protected function getActiveCascadingDeletes()
    {
        return array_filter($this->getCascadingDeletes(), function ($relationship) {
            return ! is_null($this->{$relationship});
        });
    }
}
