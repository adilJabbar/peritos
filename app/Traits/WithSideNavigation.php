<?php

namespace App\Traits;

trait WithSideNavigation
{
    /* add default menu to be loaded
    $this->mountSubmenu('XXX');

    add query string
    protected $queryString = ['showSubmenu'];
    */

    public $showSubmenu;

    public function mountSubmenu($value)
    {
        ! $this->showSubmenu ? $this->showSubmenu = $value : '';
    }
}
