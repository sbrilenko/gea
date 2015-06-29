<?php
  $control = new controller();
 
  if (count($control -> getURI()) == 0){
  	 echo getMenu_main();
  	require_once ('scripts/main.php');
  } else {
  	 	echo getMenu();
	  	switch ($control->get[count($control->get)-1]){
	      case 1    :   require_once "scripts/about.php"; break;
	      case 2    :   require_once "scripts/product.php"; break;
	      case 3    :   require_once "scripts/video.php"; break;
	      case 4    :   require_once "scripts/certificates.php"; break;
	      case 6    :   require_once "scripts/warning.php"; break;
		  case 24   :   require_once "scripts/article.php"; break;
		  case 26   :   require_once "scripts/contacts.php"; break;
	      // Продукты
	      case 7    :   require_once "scripts/product.php"; break;
	      case 8    :   require_once "scripts/product.php"; break;
	      case 9    :   require_once "scripts/product.php"; break;
	      case 10   :   require_once "scripts/product.php"; break;
	      case 17   :   require_once "scripts/product.php"; break;
	      case 18   :   require_once "scripts/product.php"; break;
	      case 19   :   require_once "scripts/product.php"; break;
	      case 20   :   require_once "scripts/product.php"; break;
	      case 21   :   require_once "scripts/product.php"; break;
	      case 16   :   require_once "scripts/product.php"; break;
	      case 23   :   require_once "scripts/product.php"; break;
          case 37   :   require_once "scripts/product.php"; break;
	      // О компании
	      case 11   :   require_once "scripts/about_president.php"; break;
	      case 12   :   require_once "scripts/about_marketing.php"; break;
          case 12   :   require_once "scripts/error404.php"; break;
          case 30   :   require_once "scripts/about_product.php"; break;
          
          //case 31   :   require_once "scripts/about.php"; break;
          case 31   :   require_once "scripts/about_management.php"; break;
          
          
          //case 31   :   require_once "scripts/error404.php"; break;
	      // Задать вопрос
	      case 14   :   require_once "scripts/question.php"; break;
	      
	      // События
	      case 13   :   require_once "scripts/events.php"; break;
	      // Паразиты
	      case 22   :   require_once "scripts/parasites.php"; break;
	      case 29   :   require_once "scripts/webinar.php"; break;
          
          case 30   :   require_once "scripts/goods.php"; break;
          case 32   :   require_once "scripts/about_galery.php"; break;

          case 38   :   require_once "scripts/about_galery.php"; break;
          case 39   :   require_once "scripts/about_galery.php"; break;
			case 40   :   require_once "scripts/about_galery.php"; break;
	      default   :   require_once "scripts/error404.php";
	  }
  }
  
?>
