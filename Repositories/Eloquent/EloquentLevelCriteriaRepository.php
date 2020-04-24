<?php

namespace Modules\Marketplace\Repositories\Eloquent;

use Modules\Marketplace\Repositories\LevelCriteriaRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentLevelCriteriaRepository extends EloquentBaseRepository implements LevelCriteriaRepository
{

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

          if (isset($filter->search)) { //si hay que filtrar por rango de precio
              $criterion = $filter->search;

              $query->whereHas('translations', function (Builder $q) use ($criterion) {
                  $q->where('name', 'like', "%{$criterion}%");
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
              if($filter->order==='random'){
                  $query->inRandomOrder();
              }else{
                  $orderByField = $filter->order->field ?? 'created_at';//Default field
                  $orderWay = $filter->order->way ?? 'desc';//Default way
                  $query->orderBy($orderByField, $orderWay);//Add order to query
              }

          }

          if(isset($filter->type)){
              $query->where('type',$filter->type);
          }

          if(isset($filter->levelType)){
              $query->where('level_type_id',$filter->levelType);
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
}
