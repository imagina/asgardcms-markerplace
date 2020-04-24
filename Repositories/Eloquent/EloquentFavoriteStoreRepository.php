<?php

namespace Modules\Marketplace\Repositories\Eloquent;

use Modules\Marketplace\Events\FavoriteStoreWasCreated;
use Modules\Marketplace\Repositories\FavoriteStoreRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentFavoriteStoreRepository extends EloquentBaseRepository implements FavoriteStoreRepository
{

    public function getItemsBy($params = false)
    {

      // INITIALIZE QUERY
      $query = $this->model->query();

      // RELATIONSHIPS
      $defaultInclude = [];
      $query->with(array_merge($defaultInclude, $params->include));

      // FILTERS
      if($params->filter) {
        $filter = $params->filter;

        //add filter by search
        if (isset($filter->search)) {
            //find search in columns
            $query->where(function ($query) use ($filter) {
            $query->where('id', 'like', '%' . $filter->search . '%')
            ->orWhere('updated_at', 'like', '%' . $filter->search . '%')
            ->orWhere('created_at', 'like', '%' . $filter->search . '%');
            });
        }
        
        //add filter by date
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

         //add filter by user_id
        if (isset($filter->userId)){
          $query->where('user_id', $filter->userId);
        }

        //add filter by store_id
        if (isset($filter->storeId)){
          $query->where('store_id', $filter->storeId);
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

    public function getItem($criteria, $params = false)
    {
      // INITIALIZE QUERY
      $query = $this->model->query();

      // RELATIONSHIPS
      $includeDefault = [];
      $query->with(array_merge($includeDefault, $params->include));

      // FIELDS
      if ($params->fields) {
        $query->select($params->fields);
      }
     
      // FILTER
      if (isset($params->filter)) {
        $filter = $params->filter;
        if (isset($filter->field))
            $field = $filter->field;
      }

      $query->where($field ?? 'id', $criteria);

      return $query->first();

    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        $model=$this->model->create($data);

        event(new FavoriteStoreWasCreated($model,$data));

        return $model;
    }
    
}
