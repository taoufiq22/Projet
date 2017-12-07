<?php
/**
 * Created by PhpStorm.
 * User: marjorie
 * Date: 05/12/2017
 * Time: 18:38
 */

namespace AppBundle\EventListener;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class RedirectAfterEditListener implements EventSubscriberInterface
{
    private $router;


    public function __construct(RouterInterface $router) {


        $this->router = $router;
    }


    public function onPasswordResettingSuccess(FormEvent $event) {

        $url = $this->router->generate('admin');
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }


    public static function getSubscribedEvents() {
        return [
            FOSUserEvents::PROFILE_EDIT_SUCCESS => 'onPasswordResettingSuccess',
        ];
    }

}