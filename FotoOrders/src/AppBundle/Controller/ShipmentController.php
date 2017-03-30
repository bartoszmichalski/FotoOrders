<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shipment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Shipment controller.
 *
 * @Route("shipment")
 */
class ShipmentController extends Controller
{
    /**
     * Lists all shipment entities.
     *
     * @Route("/", name="shipment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shipments = $em->getRepository('AppBundle:Shipment')->findAll();

        return $this->render('shipment/index.html.twig', array(
            'shipments' => $shipments,
        ));
    }

    /**
     * Creates a new shipment entity.
     *
     * @Route("/new", name="shipment_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $shipment = new Shipment();
        $form = $this->createForm('AppBundle\Form\ShipmentType', $shipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shipment);
            $em->flush($shipment);

            return $this->redirectToRoute('shipment_show', array('id' => $shipment->getId()));
        }

        return $this->render('shipment/new.html.twig', array(
            'shipment' => $shipment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a shipment entity.
     *
     * @Route("/{id}", name="shipment_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Shipment $shipment)
    {
        $deleteForm = $this->createDeleteForm($shipment);

        return $this->render('shipment/show.html.twig', array(
            'shipment' => $shipment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing shipment entity.
     *
     * @Route("/{id}/edit", name="shipment_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Shipment $shipment)
    {
        $deleteForm = $this->createDeleteForm($shipment);
        $editForm = $this->createForm('AppBundle\Form\ShipmentType', $shipment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shipment_edit', array('id' => $shipment->getId()));
        }

        return $this->render('shipment/edit.html.twig', array(
            'shipment' => $shipment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a shipment entity.
     *
     * @Route("/{id}", name="shipment_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Shipment $shipment)
    {
        $form = $this->createDeleteForm($shipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shipment);
            $em->flush($shipment);
        }

        return $this->redirectToRoute('shipment_index');
    }

    /**
     * Creates a form to delete a shipment entity.
     *
     * @param Shipment $shipment The shipment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Shipment $shipment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('shipment_delete', array('id' => $shipment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
