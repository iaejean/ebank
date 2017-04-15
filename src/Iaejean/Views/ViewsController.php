<?php
namespace Iaejean\Views;

use Iaejean\Base\TraitController;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\SecurityExtraBundle\Annotation\PreAuthorize;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ViewsController
 * @package Iaejean\Views
 *
 * @DI\Tag("security.secure_service")
 */
class ViewsController extends Controller
{
    use TraitController;

    /**
     * @Route("/", name="home")
     * @Method("GET")
     * @PreAuthorize(expr="permitAll")
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('index.html.twig', ['env' => $this->get('kernel')->getEnvironment()]);
    }

    /**
     * @Route("/executive", name="executive")
     * @Method("GET")
     * @Secure(roles="ROLE_EXECUTIVE")
     * @return Response
     */
    public function executiveAction()
    {
        return $this->render('executive.html.twig', ['env' => $this->get('kernel')->getEnvironment()]);
    }

    /**
     * @Route("/cashier", name="cashier")
     * @Method("GET")
     * @Secure(roles="ROLE_CASHIER")
     * @return Response
     */
    public function cashierAction()
    {
        return $this->render('cashier.html.twig', ['env' => $this->get('kernel')->getEnvironment()]);
    }
}
