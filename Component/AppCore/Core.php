<?php

namespace Component\AppCore;


use Component\Http\Request;

class Core
{
    private $booted = false;

    private $container;

    private $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    private function boot()
    {
        if (true === $this->booted) {
            return;
        }
        if (null === $this->container) {
            $this->initializeContainer();
        }

        $this->booted = true;
    }

    protected function initializeContainer()
    {
        return $this->container = new Container();
    }

    public function handle()
    {
        $this->boot();
        if ($this->services instanceof \Closure) {
            $this->services($this->container);

        }

    }

    private function loadService()
    {

    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    private function buildContainer()
    {

    }
}