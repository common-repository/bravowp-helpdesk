<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




//listing all woocommerce products
function bwhd_controllers_woocommerce_products_list()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_woocommerce_products_list","Start");

	try
	{

		$result = array();
		
		if (bwhd_globals_woocommerceactive())
		{


			$productsQueryParams = array( 'post_type' => 'product', 'posts_per_page'=>-1, 'numberposts'=>-1 );
			$productsList = get_posts( $productsQueryParams );

			foreach( $productsList as $productsInfo )
			{
				$productForList = array( 'productId' => $productsInfo->ID, 'productDescription' => $productsInfo->post_title);
				array_push( $result, $productForList);
			}

		}

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_woocommerce_products_list", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_woocommerce_products_list","End");

}




//listing all woocommerce orders (array of ids)
function bwhd_controllers_woocommerce_products_listforcurrentuser()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_woocommerce_products_listforcurrentuser","Start");

	try
	{

		$result = array();
		
		//only works
		if (bwhd_globals_woocommerceactive())
		{

			//only retrieve if an user is logged in
			if ( wp_get_current_user()->ID > 0 ) 
			{

				//getting orders for this customer
                $requestOrdersParams = array();
                $requestOrdersParams['orderby'] = "date";
                $requestOrdersParams['per_page'] = 9999999;
                $requestOrdersParams['page'] = 1;
                $requestOrdersParams['customer'] = wp_get_current_user()->ID;
                
                //request end point
                $request = new WP_REST_Request( 'GET', '/wp-json/wc/v1/orders' );
                $request->set_query_params($requestOrdersParams);

                //firing request            
                $productsController = new WC_REST_Orders_Controller();
                $resultAPI = $productsController->get_items($request);

				$listOrders = $resultAPI->data;

				foreach ($listOrders as $infoOrder) 
                {

					$resultOrderLineItems = $infoOrder["line_items"];

					//cycling this order's products lines
                    foreach ($resultOrderLineItems as $resultOrderLineItem) 
                    {
                        
                         //see if this product was already included in this customer's list of products
                         $addThisProduct = 1;
                         foreach ( $result as $productAlreadyAdded ) 
                         {
                             if ( $productAlreadyAdded["productId"] == $resultOrderLineItem["product_id"] )
                             {
                                 $addThisProduct = 0;   //no need to add this product again
                                 break;
                             }
                         }

                         //adds the product to the products owned by the customer
                         if ( $addThisProduct == 1 )
                         {

                            $productToAdd = array();

                            $productToAdd["productId"] = $resultOrderLineItem["product_id"];
                            $productToAdd["productDescription"] = $resultOrderLineItem["name"];

                            array_push( $result , $productToAdd );

                         }

                    }

				}

			}

		}

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_woocommerce_products_listforcurrentuser", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_woocommerce_products_listforcurrentuser","End");

}

?>
