<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commission;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Commission controller.
 *
 * @Route("commission")
 */
class CommissionController extends Controller
{
    /**
     * Lists commission of logged user entities.
     *
     * @Route("/", name="commission_index")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        /** @var User $user */
        $user = $this->getUser();//User
        $commissions = $user->getCommissions();

        return $this->render('commission/index.html.twig', array(
            'commissions' => $commissions,
        ));
    }

    /**
     * Lists all of commission.
     *
     * @Route("/all", name="commission_all_index")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getAllCommissionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commissions = $em->getRepository('AppBundle:Commission')->findAll();

        return $this->render('commission/index.html.twig', array(
            'commissions' => $commissions,
        ));
    }

    /**
     * Creates a new commission entity.
     *
     * @Route("/new", name="commission_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Request $request)
    {
        $commission = new Commission();
        $form = $this->createForm('AppBundle\Form\CommissionType', $commission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $file stores the uploaded file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $commission->getFilename();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where files are stored
            $file->move(
                $this->getParameter('foto_directory'),
                $fileName
            );

            // Update the 'filename' property to store the file name
            // instead of its contents
            $commission->setFilename($fileName);

            // ... persist the $product variable or any other work
            $commission->setStatus(0);
            $commission->setCreationTime(time());
            $commission->getCompletionTime(0);


            $user = $this->getUser();
            $commission->setUser($user);
            $user->addCommission($commission);




            $em = $this->getDoctrine()->getManager();
            $em->persist($commission);
            $em->flush($commission);

            return $this->redirectToRoute('commission_show', array('id' => $commission->getId()));
        }

        return $this->render('commission/new.html.twig', array(
            'commission' => $commission,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commission entity.
     *
     * @Route("/{id}", name="commission_show")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function showAction(Commission $commission)
    {
        $deleteForm = $this->createDeleteForm($commission);
//        $commission->setFilename(
//            new File($this->getParameter('foto_directory').'/'.$commission->getFilename())
//        );

        return $this->render('commission/show.html.twig', array(
            'commission' => $commission,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commission entity.
     *
     * @Route("/{id}/edit", name="commission_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function editAction(Request $request, Commission $commission, $id)
    {
        $deleteForm = $this->createDeleteForm($commission);

        $commission->setFilename(
            new File($this->getParameter('foto_directory').'/'.$commission->getFilename())
        );

        //get logged user
        $user = $this->getUser();

        //if user has ROLE_ADMIN go to other form
        if ($user->hasRole('ROLE_ADMIN')) {
            $editForm = $this->createForm('AppBundle\Form\CommissionTypeByAdmin', $commission);
        } else {
            $editForm = $this->createForm('AppBundle\Form\CommissionType', $commission);
        }

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // $file stores the uploaded file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $commission->getFilename();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where files are stored
            $file->move(
                $this->getParameter('foto_directory'),
                $fileName
            );

            // Update the 'filename' property to store the file name
            // instead of its contents
            $commission->setFilename($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commission_show', array('id' => $commission->getId()));
        }

        return $this->render('commission/edit.html.twig', array(
            'id' => $id,
            'commission' => $commission,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commission entity.
     *
     * @Route("/{id}", name="commission_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction(Request $request, Commission $commission)
    {
        $form = $this->createDeleteForm($commission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commission);
            $em->flush($commission);
        }

        return $this->redirectToRoute('commission_index');
    }

    /**
     * Creates a form to delete a commission entity.
     *
     * @param Commission $commission The commission entity
     *
     * @return \Symfony\Component\Form\Form The form
     * @Security("has_role('ROLE_USER')")
     */
    private function createDeleteForm(Commission $commission)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commission_delete', array('id' => $commission->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
