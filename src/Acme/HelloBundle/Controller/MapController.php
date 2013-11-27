<?php
namespace Acme\HelloBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Acme\HelloBundle\Entity\Markers;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Mapping as ORM;
class DefaultController extends Controller{

	public function generatexmlAction(){
	$address = $this->getDoctrine()
						->getRepository('Acme\HelloBundle\Entity\Markers')
						->findAll();
	}
} 
?>