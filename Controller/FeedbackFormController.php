<?php
/**
 * File containing the FeedbackController class.
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace EzSystems\DemoBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use EzSystems\DemoBundle\Entity\Feedback;
use Symfony\Component\HttpFoundation\Response;

class FeedbackFormController extends Controller
{

    //TODO comment
    public function showFeedbackFormAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        /*
        // We need the author, whatever the view type is.
        $repository = $this->getRepository();
        $location = $repository->getLocationService()->loadLocation( $locationId );
        $author = $repository->getUserService()->loadUser( $location->getContentInfo()->ownerId );

        // Delegate view rendering to the original ViewController
        // (makes it possible to continue using defined template rules)
        // We just add "author" to the list of variables exposed to the final template
        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array( 'author' => $author )
        );
        */

        $feedback = new Feedback();
        //TODO setcountry

        $form = $this->createFormBuilder( $feedback )
            ->add( 'firstName', 'text' )
            ->add( 'lastName', 'text' )
            ->add( 'email', 'email' )
            ->add( 'subject', 'text' )
            ->add( 'country', 'country' )
            ->add( 'message', 'textarea' )
            ->add( 'save', 'submit' )
            ->getForm();

        $form->handleRequest( $this->getRequest() );

        $test = ''; //FIXME delete

        if ( $form->isValid() )
        {
            //TODO send an email
            $test = 'validé';
        }

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array( 'form' => $form->createView(), 'test' => $test )
        );
    }

}
