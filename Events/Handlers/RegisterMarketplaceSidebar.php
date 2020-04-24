<?php

namespace Modules\Marketplace\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterMarketplaceSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('marketplace::marketplaces.title.marketplaces'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('marketplace::settings.title.settings'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.setting.create');
                    $item->route('admin.marketplace.setting.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.settings.index')
                    );
                });
                $item->item(trans('marketplace::stores.title.stores'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.store.create');
                    $item->route('admin.marketplace.store.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.stores.index')
                    );
                });
                $item->item(trans('marketplace::storehistories.title.storehistories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.storehistory.create');
                    $item->route('admin.marketplace.storehistory.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.storehistories.index')
                    );
                });
                $item->item(trans('marketplace::themes.title.themes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.themes.create');
                    $item->route('admin.marketplace.themes.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.themes.index')
                    );
                });
                $item->item(trans('marketplace::comments.title.comments'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.comment.create');
                    $item->route('admin.marketplace.comment.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.comments.index')
                    );
                });
                $item->item(trans('marketplace::categorystores.title.categorystores'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.categorystore.create');
                    $item->route('admin.marketplace.categorystore.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.categorystores.index')
                    );
                });
                $item->item(trans('marketplace::favoritestores.title.favoritestores'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.favoritestore.create');
                    $item->route('admin.marketplace.favoritestore.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.favoritestores.index')
                    );
                });
                $item->item(trans('marketplace::levels.title.levels'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.level.create');
                    $item->route('admin.marketplace.level.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.levels.index')
                    );
                });
                $item->item(trans('marketplace::levelcriterias.title.levelcriterias'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.levelcriteria.create');
                    $item->route('admin.marketplace.levelcriteria.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.levelcriterias.index')
                    );
                });
                $item->item(trans('marketplace::leveltypes.title.leveltypes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.leveltype.create');
                    $item->route('admin.marketplace.leveltype.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.leveltypes.index')
                    );
                });
                $item->item(trans('marketplace::benefits.title.benefits'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.benefits.create');
                    $item->route('admin.marketplace.benefits.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.benefits.index')
                    );
                });
                $item->item(trans('marketplace::storecontacts.title.storecontacts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.marketplace.storecontact.create');
                    $item->route('admin.marketplace.storecontact.index');
                    $item->authorize(
                        $this->auth->hasAccess('marketplace.storecontacts.index')
                    );
                });
// append












            });
        });

        return $menu;
    }
}
