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
    public function newmapAction(Request $request,$locationId) {
        $map = new Markers();
        $em = $this->getDoctrine()->getEntityManager();
        if($request->getMethod()== "POST"){
            $housenum = $request->get('housenum');
            $street = $request->get('street');  
            $city = $request->get('city');
            $state = $request->get('state');
            $zipcode = $request->get('zipcode');
            $address = $housenum." ". $street." ". $city." ". $state." ". $zipcode;
            $map->setAddress($address);
            $latlng = $this->lookup($address);
            $lat = $latlng['latitude'];
            $lng = $latlng['longitude'];
            $map->setLat($lat);
            $map->setLng($lng);
            $map->setLocationId($locationId);
            $em->persist($map);
            $em->flush();
            return $this->redirect($this->generateUrl('newaddress_page'));
            //return new Response($address);
            //return $this->redirect($this->generateUrl('newaddmsg',array('street'=>$street)));
            }
               $form = $this->createFormBuilder($map)
                ->add('address', 'text')
                ->getForm();
        //$form->handleRequest($request);
        //if($form->isValid()){
        return $this->render('AcmeHelloBundle:Default:addmap.html.twig', array('form' => $form->createView()));
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
            //$Location->setMakersId('15');
            $em->persist($Location);
            $em->flush();
            $id = $Location->getId();
            $locationId[] = array('Location'=>$id);
            //return new Response('Form has been Sucessfully added');
            return $this->render('AcmeHelloBundle:Default:newaddmsg.html.twig', array('Lid' => $locationId));
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
    public function newaddmsgAction(){
       // $id = $request->request->get('location_id');
        return $this->render('AcmeHelloBundle:Default:newaddmsg.html.twig');
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