<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // if user has ROLE_ADMIN redirect to commission show all
        $user = $this->getUser();
        if ($user) {
            if ($user->hasRole('ROLE_ADMIN')) {
                return $this->redirectToRoute('commission_all_index');
            } else {
                return $this->redirectToRoute('commission_index');
            }
        }
        return $this->redirect('http://google.com');
    }

}
