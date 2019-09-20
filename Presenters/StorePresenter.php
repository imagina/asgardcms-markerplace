<?php

namespace Modules\Marketplace\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Marketplace\Entities\Status;

class StorePresenter extends Presenter
{
    /**
     * @var \Modules\Marketplace\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Marketplace\Repositories\PostRepository
     */
    private $store;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->store = app('Modules\Marketplace\Repositories\PostRepository');
        $this->status = app('Modules\Marketplace\Entities\Status');
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

    public function mainImage($store,$thumbnail=null)
    {
        $item=$store->mainimage2;
        $path=$thumbnail?:$store->path;
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
