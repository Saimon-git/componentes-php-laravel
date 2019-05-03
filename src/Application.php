<?php


namespace SimonMontoya;


class Application
{
    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {

        $this->container = $container;
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider){
            $provider = new $provider($this->container);
            $provider->register();
        }

    }

    public function register()
    {
        $this->registerSessionManager();
        $this->registerAuthenticator();
        $this->registerAccessHandler();
    }

    protected function registerSessionManager()
    {


    }

    protected function registerAuthenticator()
    {

    }

    protected function registerAccessHandler()
    {

    }

}
