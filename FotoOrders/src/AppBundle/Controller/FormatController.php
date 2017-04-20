<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Format;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Format controller.
 *
 * @Route("format")
 */
class FormatController extends Controller
{
    /**
     * Lists all format entities.
     *
     * @Route("/", name="format_index")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formats = $em->getRepository('AppBundle:Format')->findAll();

        return $this->render('format/index.html.twig', array(
            'formats' => $formats,
        ));
    }

    /**
     * Creates a new format entity.
     *
     * @Route("/new", name="format_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $format = new Format();
        $form = $this->createForm('AppBundle\Form\FormatType', $format);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($format);
            $em->flush($format);

            return $this->redirectToRoute('format_show', array('id' => $format->getId()));
        }

        return $this->render('format/new.html.twig', array(
            'format' => $format,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a format entity.
     *
     * @Route("/{id}", name="format_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Format $format)
    {
        $deleteForm = $this->createDeleteForm($format);

        return $this->render('format/show.html.twig', array(
            'format' => $format,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing format entity.
     *
     * @Route("/{id}/edit", name="format_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Format $format)
    {
        $deleteForm = $this->createDeleteForm($format);
        $editForm = $this->createForm('AppBundle\Form\FormatType', $format);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('format_edit', array('id' => $format->getId()));
        }

        return $this->render('format/edit.html.twig', array(
            'format' => $format,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a format entity.
     *
     * @Route("/{id}", name="format_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Format $format)
    {
        $form = $this->createDeleteForm($format);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($format);
            $em->flush($format);
        }

        return $this->redirectToRoute('format_index');
    }

    /**
     * Creates a form to delete a format entity.
     *
     * @param Format $format The format entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Format $format)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('format_delete', array('id' => $format->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
