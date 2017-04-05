<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DiscountCoupon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Discountcoupon controller.
 *
 * @Route("discountcoupon")
 */
class DiscountCouponController extends Controller
{
    /**
     * Lists all discountCoupon entities.
     *
     * @Route("/", name="discountcoupon_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $discountCoupons = $em->getRepository('AppBundle:DiscountCoupon')->findAll();

        return $this->render('discountcoupon/index.html.twig', array(
            'discountCoupons' => $discountCoupons,
        ));
    }

    /**
     * Creates a new discountCoupon entity.
     *
     * @Route("/new", name="discountcoupon_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $discountCoupon = new Discountcoupon();
        $discountCoupon->setValue(0.1);
        $form = $this->createForm('AppBundle\Form\DiscountCouponType', $discountCoupon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($discountCoupon);
            $em->flush($discountCoupon);

            return $this->redirectToRoute('discountcoupon_show', array('id' => $discountCoupon->getId()));
        }

        return $this->render('discountcoupon/new.html.twig', array(
            'discountCoupon' => $discountCoupon,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a discountCoupon entity.
     *
     * @Route("/{id}", name="discountcoupon_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(DiscountCoupon $discountCoupon)
    {
        $deleteForm = $this->createDeleteForm($discountCoupon);

        return $this->render('discountcoupon/show.html.twig', array(
            'discountCoupon' => $discountCoupon,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing discountCoupon entity.
     *
     * @Route("/{id}/edit", name="discountcoupon_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, DiscountCoupon $discountCoupon)
    {
        $deleteForm = $this->createDeleteForm($discountCoupon);
        $editForm = $this->createForm('AppBundle\Form\DiscountCouponType', $discountCoupon);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('discountcoupon_edit', array('id' => $discountCoupon->getId()));
        }

        return $this->render('discountcoupon/edit.html.twig', array(
            'discountCoupon' => $discountCoupon,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a discountCoupon entity.
     *
     * @Route("/{id}", name="discountcoupon_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, DiscountCoupon $discountCoupon)
    {
        $form = $this->createDeleteForm($discountCoupon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($discountCoupon);
            $em->flush($discountCoupon);
        }

        return $this->redirectToRoute('discountcoupon_index');
    }

    /**
     * Creates a form to delete a discountCoupon entity.
     *
     * @param DiscountCoupon $discountCoupon The discountCoupon entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DiscountCoupon $discountCoupon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('discountcoupon_delete', array('id' => $discountCoupon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
