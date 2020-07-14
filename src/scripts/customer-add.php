<?php

/**
 * Created by Jared Kozel
 * 05/24/2020
 *
 * Output script for XML file for creating a customer account
 */

//Set the output to XML
header('Content-Type: text/xml');
header('Content-Disposition: attachment; filename="RandomCustomerAdd.xml"');

//Require composer
require_once '../../vendor/autoload.php';

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

$output = '<?xml version="1.0" ?>
<?qbxml version="2.0"?> 
<QBXML>
  <!-- onError may be set to continueOnError or stopOnError. --> 
  <QBXMLMsgsRq onError = "stopOnError">';

for ($i = 0; $i < 1; $i++)
{
    $output .= '<!-- Begin request #'.$i.': adding a customer -->
                <CustomerAddRq requestID = "2">
                    <CustomerAdd>
                        <Name>'.$faker->name.'</Name>
                        <IsActive>1</IsActive> 
                        <CompanyName>'.$faker->company.'</CompanyName>
                        <Salutation>'.$faker->title.'</Salutation>
                        <FirstName>'.$faker->firstName.'</FirstName>
                        <LastName>'.$faker->lastName.'</LastName>
                        <BillAddress>                                
                          <Addr1>'.$faker->streetAddress.'</Addr1>                     
                          <City>'.$faker->city.'</City>                       
                          <State>'.$faker->stateAbbr.'</State>                     
                          <PostalCode>'.$faker->postcode.'</PostalCode>           
                        </BillAddress>
                        <Phone>'.$faker->phoneNumber.'</Phone>                       
                        <AltPhone>'.$faker->tollFreePhoneNumber.'</AltPhone>                 
                        <Email>'.$faker->email.'</Email>
                        <!-- references to objects by name or ID require that the object -->
                        <!-- already exist                                               -->
                        <TermsRef>                                          
                          <FullName>Net 30</FullName>                      
                        </TermsRef>
                        <AccountNumber>'.$faker->ean8.'</AccountNumber>              
                        <CreditLimit>2000.00</CreditLimit>                  
                    </CustomerAdd>
                </CustomerAddRq>    ';
}

$output .= '
    </QBXMLMsgsRq>
</QBXML>';

echo $output;