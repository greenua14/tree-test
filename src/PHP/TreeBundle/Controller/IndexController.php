<?php

namespace PHP\TreeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PHP\TreeBundle\Entity\Node;
use Symfony\Component\HttpFoundation\Request;

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
     */
    public function removeAction()
    {
        return array();
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
} 
