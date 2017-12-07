<?php
/**
 * Created by PhpStorm.
 * User: marjorie
 * Date: 05/12/2017
 * Time: 17:11
 */

namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;


class RedirectAfterResettingResetListener implements EventSubscriberInterface
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
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => 'onPasswordResettingSuccess',
        ];
    }
}