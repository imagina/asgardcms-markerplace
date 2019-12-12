<?php

namespace Modules\Marketplace\Repositories\Eloquent;

use Modules\Marketplace\Events\StoreWasCreated;
use Modules\Marketplace\Events\StoreWasUpdated;
use Modules\Marketplace\Events\StoreWasDeleted;
use Modules\Marketplace\Repositories\StoreRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Database\Eloquent\Builder;

class EloquentStoreRepository extends EloquentBaseRepository implements StoreRepository
{
    /**
     * Find a resource by the given slug
     *
     * @param  string $slug
     * @return object
     */
    public function findBySlug($slug)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->whereHas('translations', function (Builder $q) use ($slug) {
                $q->where('slug', $slug);
            })->with('translations', 'parent', 'children', 'posts')->firstOrFail();
        }

        return $this->model->where('slug', $slug)->with('translations', 'parent', 'children', 'posts')->first();;
    }

    /**
     * Standard Api Method
     * @param bool $params
     * @return mixed
     */
    public function getItemsBy($params = false)
    {
        /*== initialize query ==*/
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with(['translations']);
        } else {//Especific relationships
            $includeDefault = ['translations'];//Default relationships
            if (isset($params->include))//merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);//Add Relationships to query
        }

        /*== FILTERS ==*/
        if (isset($params->filter)) {
            $filter = $params->filter;//Short filter
            if (isset($filter->parent)) {
                $query->where('parent_id', $filter->parent);
            }
            if (isset($filter->categories)) {
                $categories = is_array($filter->categories) ? $filter->categories : [$filter->categories];
                $query->whereHas('categories', function ($q) use ($categories) {
                    $q->whereIn('category_store_id', $categories);
                });
            }
            if (isset($filter->neighborhoods)) {
                $neighborhoods = is_array($filter->neighborhoods) ?$filter->neighborhoods : [$filter->neighborhoods];
                $query->whereIn('neighborhood_id', $neighborhoods);
            }
            if (isset($filter->cities)) {
                $cities = is_array($filter->cities) ?$filter->cities : [$filter->cities];
                $query->whereIn('city_id', $cities);
            }
            if (isset($filter->provinces)) {
                $provinces = is_array($filter->provinces) ?$filter->provinces : [$filter->provinces];
                $query->whereIn('province_id', $provinces);
            }
            if (isset($filter->user)) {
                $user = is_array($filter->user) ?$filter->user : [$filter->user];
                $query->whereIn('user_id', $user);
            }

            if (isset($filter->search)) { //si hay que filtrar por rango de precio
                $criterion = $filter->search;

                $query->whereHas('translations', function (Builder $q) use ($criterion) {
                    $q->where('name', 'like', "%{$criterion}%");
                    $q->orWhere('description', 'like',"%{$criterion}%");
                });
            }

            //Filter by date
            if (isset($filter->date)) {
                $date = $filter->date;//Short filter date
                $date->field = $date->field ?? 'created_at';
                if (isset($date->from))//From a date
                    $query->whereDate($date->field, '>=', $date->from);
                if (isset($date->to))//to a date
                    $query->whereDate($date->field, '<=', $date->to);
            }

            //Order by
            if (isset($filter->order)) {
                $orderByField = $filter->order->field ?? 'created_at';//Default field
                $orderWay = $filter->order->way ?? 'desc';//Default way
                $query->orderBy($orderByField, $orderWay);//Add order to query
            }
            if (isset($filter->status)) {
                $query->whereStatus($filter->status);
            }
        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
            $params->take ? $query->take($params->take) : false;//Take
            return $query->get();
        }
    }

    /**
     * Standard Api Method
     * @param $criteria
     * @param bool $params
     * @return mixed
     */
    public function getItem($criteria, $params = false)
    {
        //Initialize query
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with(['translations']);
        } else {//Especific relationships
            $includeDefault = [];//Default relationships
            if (isset($params->include))//merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);//Add Relationships to query
        }
        /*== FILTER ==*/
        if (isset($params->filter)) {
            $filter = $params->filter;

            if (isset($filter->field))//Filter by specific field
                $field = $filter->field;

            // find translatable attributes
            $translatedAttributes = $this->model->translatedAttributes;

            // filter by translatable attributes
            if (isset($field) && in_array($field, $translatedAttributes))//Filter by slug
                $query->whereHas('translations', function ($query) use ($criteria, $filter, $field) {
                    $query->where('locale', $filter->locale)
                        ->where($field, $criteria);
                });
            else
                // find by specific attribute or by id
                $query->where($field ?? 'id', $criteria);
        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        return $query->first();
    }

    /**
     * Standard Api Method
     * @param $data
     * @return mixed
     */
    public function create($data)
    {

        $category = $this->model->create($data);

        event(new StoreWasCreated($category, $data));

        return $this->find($category->id);
    }

    /**
     * Update a resource
     * @param $category
     * @param  array $data
     * @return mixed
     */
    public function update($category, $data)
    {
        $category->update($data);

        event(new StoreWasUpdated($category, $data));

        return $category;
    }


    public function destroy($model)
    {
        event(new StoreWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

    /**
     * Update the notifications for the given ids
     * @param array $criterias
     * @param array $data
     * @return bool
     */
    public function updateItems($criterias, $data)
    {
        $query = $this->model->query();
        $query->whereIn('id', $criterias)->update($data);
        return $query;


    }

    /**
     * Delete the notifications for the given ids
     * @param array $criterias
     * @return bool
     */
    public function deleteItems($criterias)
    {
        $query = $this->model->query();

        $query->whereIn('id', $criterias)->delete();

        return $query;

    }

}
