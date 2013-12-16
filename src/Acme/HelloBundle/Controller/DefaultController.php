<?php
namespace Acme\HelloBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Acme\HelloBundle\Entity\Markers;
use Acme\HelloBundle\Entity\Location;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Mapping as ORM;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('AcmeHelloBundle:Default:index.html.twig', array('name' => $name));
    }

    public function blogAction($name) {
        return new Response('<html><body>BLOG ' . $name . '~</body></html>');
    }

    public function newaddressAction(Request $request) {
        $Location = new location();
        $em = $this->getDoctrine()->getEntityManager();
        if($request->getMethod()== "POST"){
            
            $Location->setStreet($request->get('street'));  
            $Location->setDescription($request->get('description'));
            $Location->setTitle($request->get('title'));
            $Location->setAvenue($request->get('avenue'));
            $Location->setContact($request->get('contact'));
           // $Location->setMakerId('15');
            $em->persist($Location);
            $em->flush();
            return new Response('Sucessfully');
            //return $this->redirect($this->generateUrl('newaddmsg',array('street'=>$street)));
            }
               $form = $this->createFormBuilder($Location)
                ->add('street', 'text')
                ->add('avenue', 'text')
                ->add('description', 'text')
                ->add('title', 'text')
                ->add('contact', 'text')
                ->getForm();
        //$form->handleRequest($request);
        //if($form->isValid()){
        return $this->render('AcmeHelloBundle:Default:newaddress.html.twig', array('form' => $form->createView()));
    }
    public function successAction($street){
        return $this->render('AcmeHelloBundle:Default:newaddmsg.html.twig',array('street'=>$street));
    }
    public function showallAction() {
        $address = $this->getDoctrine()
                ->getRepository('Acme\HelloBundle\Entity\Markers')
                ->findAll();
        if (!$address) {
            throw $this->createNotFoundException('No Address found');
        }
        foreach ($address as $item) {
            $newaddress = $item->getaddress();
            $addressid = $item->getid();
            $addresslist[] = array('address' => $newaddress, 'id' => $addressid);
        }
        return $this->render('AcmeHelloBundle:Default:address.html.twig', array('address' => $addresslist));
    }

    public function findAll() {
        return $this->getEntityManager()
                        ->createQuery('select latitude,longitude from AcmeHelloBundle:Markers')
                        ->getResult();
    }

    public function findOneById($id) {
        return $this->getEntityManager()
                        ->createQuery('select m.name from AcmeHelloBundle:Markers m where m.id = $id')
                        ->getResult();
    }

    public function mapaddAction($id) {
        $address = $this->getDoctrine()
                ->getRepository('Acme\HelloBundle\Entity\Markers')
                ->findOneById($id);
        $latlng = $address->getaddress();
        $newaddress = $this->lookup($latlng);
        $latlnglist = array('lat' => $newaddress['latitude'], 'lng' => $newaddress['longitude']);
        return $this->render('AcmeHelloBundle:Default:map.html.twig', array('address' => $latlnglist, 'name' => $latlng));
    }

    public function lookup($string) {
        $string = str_replace(" ", "+", urlencode($string));
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $string . "&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);
        // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
        if ($response['status'] != 'OK') {
            return null;
        }
        //print_r($response);
        $geometry = $response['results'][0]['geometry'];
        $longitude = $geometry['location']['lat'];
        $latitude = $geometry['location']['lng'];
        $array = array(
            'latitude' => $geometry['location']['lat'],
            'longitude' => $geometry['location']['lng'],
            'location_type' => $geometry['location_type'],
        );
        return $array;
    }

}

