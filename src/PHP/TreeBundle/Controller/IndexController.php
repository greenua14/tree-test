<?php

namespace PHP\TreeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PHP\TreeBundle\Entity\Node;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class IndexController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'say' => 'hello'
        );
    }

    /**
     * @Template()
     */
    public function listAction()
    {
        $nodes = $this->get('php.tree.node_repository')->findAll();

        return array(
            'nodes' => $nodes
        );
    }

    /**
     * @Template()
     */
    public function showAction($slug)
    {
        $nodeBySlug = $this->get('php.tree.node_repository')->findBy(
            array(
                'slug' => $slug,
            )
        );

        return array('nodeBySlug' => $nodeBySlug);
    }

    /**
     * @Template()
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        $node = new Node();
        $formType = $this->get('node.form.type');
        $form = $this->createForm($formType, $node);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($node);
            $em->flush();

            return $this->redirect($this->generateUrl(
                'php_tree_treeStructure'
            ));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Template()
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateAction(Request $request, $id)
    {
        $node = $this->get('php.tree.node_repository')->find($id);
        $formType = $this->get('node.form.type');
        $form = $this->createForm($formType, $node);

        $form->handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl(
                'php_tree_show', array('slug' => $node->getSlug())
            ));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Template()
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeAction($id)
    {
        $node = $this->get('php.tree.node_repository')->find($id);

        if($node)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($node);
            $em->flush();

            return $this->redirect($this->generateUrl(
                'php_tree_treeStructure'
            ));
        }

        return new Response('No advert');
    }

    /**
     * @Template()
     */
    public function treeStructureAction()
    {
        $nodes = $this->get('php.tree.node_repository')->findAll();

        return array(
            'nodes' => $nodes
        );
    }

    /**
     * @Template()
     */
    public function redirectAction()
    {
        return new RedirectResponse('https://translate.google.com.ua/#en/uk/compliant');
    }

    /**
     * @Template()
     */
    public function jsonAction()
    {
        $response = new JsonResponse();
        $response->setData(array(
            'data' => 'Hello World'
        ));

        return $response;
    }
}
