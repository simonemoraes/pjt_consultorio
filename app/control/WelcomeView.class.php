<?php
/**
 * WelcomeView
 *
 * @version    1.0
 * @package    control
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class WelcomeView extends TPage
{
   
    /**
     * Class constructor
     * Creates the page
     */
     function __construct()
     {
         parent::__construct();
         
          $html1 = new THtmlRenderer('app/resources/meus_htmls/dashbourd_etiqueta.html');
          //$html2 = new THtmlRenderer('app/resources/system_welcome_pt.html');
 
         // replace the main section variables
         $html1->enableSection('main', array());
         //$html2->enableSection('main', array());
         
         $panel1 = new TPanelGroup('Geral');
          $panel1->add($html1);         
          $panel1->style = 'width:100%;';
          //$panel1->{'class'} = 'panel panel-primary';
         
         
         
//           $panel2 = new TPanelGroup('Bem-vindo!');
//           $panel2->add($html2);
         
         // add the template to the page
         parent::add($panel1);
     }
}
