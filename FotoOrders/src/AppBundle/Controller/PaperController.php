<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Paper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Paper controller.
 *
 * @Route("paper")
 */
class PaperController extends Controller
{
    /**
     * Lists all paper entities.
     *
     * @Route("/", name="paper_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $papers = $em->getRepository('AppBundle:Paper')->findAll();

        return $this->render('paper/index.html.twig', array(
            'papers' => $papers,
        ));
    }

    /**
     * Creates a new paper entity.
     *
     * @Route("/new", name="paper_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $paper = new Paper();
        $form = $this->createForm('AppBundle\Form\PaperType', $paper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paper);
            $em->flush($paper);

            return $this->redirectToRoute('paper_show', array('id' => $paper->getId()));
        }

        return $this->render('paper/new.html.twig', array(
            'paper' => $paper,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paper entity.
     *
     * @Route("/{id}", name="paper_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Paper $paper)
    {
        $deleteForm = $this->createDeleteForm($paper);

        return $this->render('paper/show.html.twig', array(
            'paper' => $paper,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paper entity.
     *
     * @Route("/{id}/edit", name="paper_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Paper $paper)
    {
        $deleteForm = $this->createDeleteForm($paper);
        $editForm = $this->createForm('AppBundle\Form\PaperType', $paper);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paper_edit', array('id' => $paper->getId()));
        }

        return $this->render('paper/edit.html.twig', array(
            'paper' => $paper,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paper entity.
     *
     * @Route("/{id}", name="paper_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Paper $paper)
    {
        $form = $this->createDeleteForm($paper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paper);
            $em->flush($paper);
        }

        return $this->redirectToRoute('paper_index');
    }

    /**
     * Creates a form to delete a paper entity.
     *
     * @param Paper $paper The paper entity
     *
     * @return \Symfony\Component\Form\Form The form
     * @Security("has_role('ROLE_ADMIN')")
     */
    private function createDeleteForm(Paper $paper)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paper_delete', array('id' => $paper->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
