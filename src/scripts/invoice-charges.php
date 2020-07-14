<?php

/**
 * Created by Jared Kozel
 * 05/24/2020
 *
 * Output script for XML file for creating a customer account
 */

//Set the output to XML
header('Content-Type: text/xml');
header('Content-Disposition: attachment; filename="GenerateInvoiceForCustomer.xml"');

//Require composer
require_once '../../vendor/autoload.php';
require_once '../php/item.php';

// use the factory to create a Faker\Generator instance
$faker = new Faker\Generator();
$faker->addProvider(new Faker\Provider\en_US\Person($faker));
$faker->addProvider(new Faker\Provider\en_US\Address($faker));
$faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
$faker->addProvider(new Faker\Provider\en_US\Company($faker));
$faker->addProvider(new Faker\Provider\Lorem($faker));
$faker->addProvider(new Faker\Provider\Internet($faker));
$faker->addProvider(new Faker\Provider\Item($faker));
$faker->addProvider(new Faker\Provider\DateTime($faker));

//Get the Params
$companyName = $_REQUEST['cname'];
$charges = $_REQUEST['charges'];

$output = '<?xml version="1.0" ?>
<?qbxml version="2.0"?> 
<QBXML>
  <!-- onError may be set to continueOnError or stopOnError. --> 
  <QBXMLMsgsRq onError = "stopOnError">';

//Save the Items Generated Names
$itemsGenerated = [];

//Create an Item For each charge
for ($i = 0; $i < $charges; $i++)
{
    $itemName = $faker->item ." " . rand(0, 999999);
    $itemsGenerated[] = $itemName;
    $output .= '<!-- Begin request #'.$i.': creating item -->
                <ItemInventoryAddRq requestID = "2">
                  <ItemInventoryAdd>
                    <Name>'.$itemName.'</Name>
                    <IncomeAccountRef>
                      <FullName>Other Income</FullName>
                    </IncomeAccountRef>
                    <COGSAccountRef>
                      <FullName>Cost Of Goods Sold</FullName>
                    </COGSAccountRef>
                    <AssetAccountRef>
                      <FullName>Other Income</FullName>
                    </AssetAccountRef>
                  </ItemInventoryAdd>
                </ItemInventoryAddRq>    
	    ';
}

$output .= '<!-- Begin request #0: Creating an Invoice-->                  
        <InvoiceAddRq>
	        <InvoiceAdd> <!-- required -->
                <CustomerRef> <!-- required -->
                    <FullName >'.$companyName.'</FullName> <!-- optional -->
                </CustomerRef>
                <RefNumber >FINV'.rand(100, 9999).'</RefNumber>
  				<DueDate >'.$faker->date().'</DueDate>
  				<ShipDate >'.$faker->date().'</ShipDate>';

//Create an Invoice Line Item For each charge
for ($i = 0; $i < $charges; $i++)
{
    $output .= '		
		<InvoiceLineAdd>
             <ItemRef> <!-- optional -->
               <FullName >' . $itemsGenerated[$i] . '</FullName> <!-- optional -->
            </ItemRef>
            <Desc >Test Item #' . $i . '</Desc>
            <Quantity >' . $faker->randomDigit . '</Quantity>
            <Amount >' .  number_format($faker->randomFloat(2, .01, 1000),
            2, '.', '') . '</Amount>
        </InvoiceLineAdd>
     ';
}
$output .= '
             </InvoiceAdd>  
         </InvoiceAddRq>  
    </QBXMLMsgsRq>
</QBXML>';

echo $output;