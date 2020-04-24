<?php

namespace Modules\Marketplace\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Marketplace\Entities\Store;
use Modules\Marketplace\Entities\Status;
use Modules\Marketplace\Entities\TypeStore;
use Modules\Marketplace\Entities\Level;

class StorePresenter extends Presenter
{
    /**
     * @var \Modules\Marketplace\Entities\Status
     */
    protected $status;
    protected $typeStore;
    /**
     * @var \Modules\Marketplace\Repositories\StoreRepository
     */
    private $store;
    private $level;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->store = app('Modules\Marketplace\Repositories\StoreRepository');
        $this->level = app('Modules\Marketplace\Repositories\LevelRepository');
        $this->status = app('Modules\Marketplace\Entities\Status');
        $this->typeStore = app('Modules\Marketplace\Entities\TypeStore');
    }

    /**
     * Get level store
     * @return object
     */
    public function level()
    {
        //Get levels store
        $params = (object)[
            'filter' => [
                "entityNamespace" => Store::class
            ],
            'fields' => [],
            'include' => [],
            'take' => 30,
        ];
        $levels = $this->level->getItemsBy($params);
        $levelEntity = null;
        foreach ($levels as $level) {
            $allCriteriasCount = count($level->options->criterias);
            $critCount = 0;
            foreach ($level->options->criterias as $criteria) {
                $valueRelation = $this->entity->{$criteria->relationName};

                switch ($criteria->operator) {
                    case ">=":
                        if ($valueRelation >= $criteria->value) {
                            $critCount++;
                        }
                        break;
                    case "<=":
                        if ($valueRelation <= $criteria->value) {
                            $critCount++;
                        }
                        break;
                    case "==":
                        if ($valueRelation == $criteria->value) {
                            $critCount++;
                        }
                        break;
                    case "<":
                        if ($valueRelation < $criteria->value) {
                            $critCount++;
                        }
                        break;
                    case ">":
                        if ($valueRelation > $criteria->value) {
                            $critCount++;
                        }
                        break;
                    default:
                        $critCount++;
                        break;
                }


                /*if ($criteria->operator == ">=") {
                    if ($valueRelation >= $criteria->value) {
                        $critCount++;
                    }
                } else if ($criteria->operator == "<=") {

                } else if ($criteria->operator == "==") {

                } else if ($criteria->operator == "<") {
                    if ($valueRelation < $criteria->value) {
                        $critCount++;
                    }
                } else if ($criteria->operator == ">") {
                    if ($valueRelation > $criteria->value) {
                        $critCount++;
                    }
                }*/
                /*
                //Con este eval se deja de realizar todas las validaciones de arriba
                */
                // $ma ="return (".$valueRelation.$criteria->operator.$criteria->value.")".";";
                // if(eval($ma)){
                //   $critCount++;
                // }
            }//foreach

            if ($allCriteriasCount == $critCount)
                $levelEntity = $level;
        }//foreach levels
        return $levelEntity;
    }

    /**
     * Get the previous store of the current store
     * @return object
     */
    public function previous()
    {
        return $this->store->getPreviousOf($this->entity);
    }

    /**
     * Get the next store of the current store
     * @return object
     */
    public function next()
    {
        return $this->store->getNextOf($this->entity);
    }

    /**
     * Get the type store
     * @return string
     */
    public function type()
    {
        return $this->typeStore->get($this->entity->type);
    }

    /**
     * Get the store status
     * @return string
     */
    public function status()
    {
        return $this->status->get($this->entity->status);
    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        switch ($this->entity->status) {
            case Status::DRAFT:
                return 'bg-red';
                break;
            case Status::PENDING:
                return 'bg-orange';
                break;
            case Status::PUBLISHED:
                return 'bg-green';
                break;
            case Status::UNPUBLISHED:
                return 'bg-purple';
                break;
            default:
                return 'bg-red';
                break;
        }
    }

    public function mainImage($store, $thumbnail = null)
    {
        $item = $store->mainimage2;
        $path = $thumbnail ?: $store->path;
        switch ($item->mimetype) {
            case 'image/jpg':
            case 'image/png':
            case 'image/jpeg':
            case 'image/gif':
            case 'image/bmp':
                return "<img class='img-fluid w-100'
                             src='$item->path'
                             alt='$this->title'/>";
                break;
            case 'aplication/pdf':
                return "<a class='btn btn-primary '
                             href='$item->path'
                             title='$this->title'/>";
                break;
            case 'audio/mp3':
                return "<div class='frame-audio'>
                            <audio class='w-100' controls='' preload='none' src=$item->path>
                Tú navegador no soporta este reproductor, actualízalo.
                            </audio>
                        </div>";
                break;
            case 'video/mp4':
                return "<video width='320' height='240' controls>
                        <source src='$item->path' type='$item->maintype'>
                        Tú navegador no soporta este reproductor, actualízalo.
                        </video>";
                break;
            default:
                return "<a class='btn btn-primary '
                             href='$item->path'
                             title='$this->title'/>";
                break;
        }
    }
}
