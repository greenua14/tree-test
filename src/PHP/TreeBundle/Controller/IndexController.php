<?php

namespace PHP\TreeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
} 
