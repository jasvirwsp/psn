<?php
include("vendor/autoload.php");

use Konekt\PdfInvoice\InvoicePrinter;

  $invoice = new InvoicePrinter();
  
  /* Header settings */
  $invoice->setLogo("images/logo.png");   //logo image path
  $invoice->setColor("#007fff");      // pdf color scheme
  $invoice->setType("Quote");    // Invoice Type
  $invoice->setReference("INV-55033645");   // Reference
  $invoice->setDate(date('M dS ,Y',time()));   //Billing Date
  $invoice->setTime(date('h:i:s A',time()));   //Billing Time
  $invoice->setDue(date('M dS ,Y',strtotime('+3 months')));    // Due Date
  $invoice->setFrom(array("Seller Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740"));
  $invoice->setTo(array("Purchaser Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740"));
  
 
  $invoice->addItem('LG 18.5" WLCD',"",10,0,230,0,2300);
 
  
  $invoice->addTotal("Total",9460);
  $invoice->addTotal("VAT 21%",1986.6);
  $invoice->addTotal("Total due",11446.6,true);
  
  $invoice->addBadge("Payment Paid");
  
  $invoice->addTitle("Important Notice");
  
  $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");
  

  
  $invoice->setFooternote("My Company Name Here");
  
  $invoice->render('example1.pdf','I'); 
  /* I => Display on browser, D => Force Download, F => local path save, S => return document path */

?>