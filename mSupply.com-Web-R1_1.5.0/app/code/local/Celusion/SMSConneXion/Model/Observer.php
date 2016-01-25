<?php
ob_start();
class Celusion_SMSConneXion_Model_Observer {
	
  protected $_smxUsername = NULL;
  protected $_smxPassword = NULL;
  protected $_smxSecret = NULL;

  protected $_alertNewUserEnabled = NULL;
  protected $_alertNewUserMessageCustomer = NULL;
  protected $_alertNewUserMessageStaff = NULL;
  protected $_alertNewUserMobile = NULL;
  
  protected $_alertAdminOrderEnabled = NULL;
  protected $_alertAdminOrderMessageCutomer = NULL;
  protected $_alertAdminOrderMessageStaff = NULL;
  protected $_alertAdminOrderMobileStaff = NULL;
  
  protected $_alertOrderEnabled = NULL;
  protected $_alertOrderMessageCutomer = NULL;
  protected $_alertOrderMessageStaff = NULL;
  protected $_alertOrderMobileStaff = NULL;
  
  protected $_alertForgotPasswordEnabled = NULL;
  protected $_alertForgotPasswordMessageCutomer = NULL;
  protected $_alertForgotPasswordMessageStaff = NULL;
  protected $_alertForgotPasswordMobileStaff = NULL;
  
  protected $_alertOrderCancelEnabled = NULL;
  protected $_alertOrderCancelMessageCutomer = NULL;
  protected $_alertOrderCancelMessageStaff = NULL;
  protected $_alertOrderCancelMobileStaff = NULL;
  
  protected $_alertOrderHoldEnabled = NULL;
  protected $_alertOrderHoldMessageCutomer = NULL;
  protected $_alertOrderHoldMessageStaff = NULL;
  protected $_alertOrderHoldMobileStaff = NULL;
  
  protected $_alertOrderUnholdEnabled = NULL;
  protected $_alertOrderUnholdMessageCutomer = NULL;
  protected $_alertOrderUnholdMessageStaff = NULL;
  protected $_alertOrderUnholdMobileStaff = NULL;
  
  protected $_alertCreateInvoiceEnabled = NULL;
  protected $_alertCreateInvoiceMessageCutomer = NULL;
  protected $_alertCreateInvoiceMessageStaff = NULL;
  protected $_alertCreateInvoiceMobileStaff = NULL;
  
  protected $_alertVoidPaymentEnabled = NULL;
  protected $_alertVoidPaymentMessageCutomer = NULL;
  protected $_alertVoidPaymentMessageStaff = NULL;
  protected $_alertVoidPaymentMobileStaff = NULL;
  
  protected $_alertCreditmemoEnabled = NULL;
  protected $_alertCreditmemoMessageCutomer = NULL;
  protected $_alertCreditmemoMessageStaff = NULL;
  protected $_alertCreditmemoMobileStaff = NULL;
  
  protected $_alertShipmentCreationEnabled = NULL;
  protected $_alertShipmentCreationMessageCutomer = NULL;
  protected $_alertShipmentCreationMessageStaff = NULL;
  protected $_alertShipmentCreationMobileStaff = NULL;
    
  public function __construct()
  {
    $this->_smxUsername = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_username');
	$this->_smxPassword = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_password');
	$this->_smxSecret = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_secret');

	$this->_alertNewUserEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/newuser_group/enabled');
	$this->_alertNewUserMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/newuser_group/messagecustomer');
	$this->_alertNewUserMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/newuser_group/messagestaff');
	$this->_alertNewUserMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/newuser_group/mobilestaff');
      
	$this->_alertAdminOrderEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/admin_order_group/enabled');
	$this->_alertAdminOrderMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/admin_order_group/messagecustomer');
	$this->_alertAdminOrderMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/admin_order_group/messagestaff');
	$this->_alertAdminOrderMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/admin_order_group/mobilestaff');
      
	
	$this->_alertOrderEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/order_group/enabled');
	$this->_alertOrderMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/order_group/messagecustomer');
	$this->_alertOrderMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_group/messagestaff');
	$this->_alertOrderMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_group/mobilestaff');
	
	$this->_alertForgotPasswordEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/forgetpassword_group/enabled');
	$this->_alertForgotPasswordMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/forgetpassword_group/messagecustomer');
		
	$this->_alertOrderCancelEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/order_cancel_group/enabled');
	$this->_alertOrderCancelMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/order_cancel_group/messagecustomer');
	$this->_alertOrderCancelMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_cancel_group/messagestaff');
	$this->_alertOrderCancelMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_cancel_group/mobilestaff');
  	
	$this->_alertOrderHoldEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/order_hold_group/enabled');
	$this->_alertOrderHoldMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/order_hold_group/messagecustomer');
	$this->_alertOrderHoldMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_hold_group/messagestaff');
	$this->_alertOrderHoldMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_hold_group/mobilestaff');
    
	$this->_alertOrderUnholdEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/order_unhold_group/enabled');
	$this->_alertOrderUnholdMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/order_unhold_group/messagecustomer');
	$this->_alertOrderUnholdMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_unhold_group/messagestaff');
	$this->_alertOrderUnholdMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_unhold_group/mobilestaff');
    
	$this->_alertCreateInvoiceEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/invoice_group/enabled');
	$this->_alertCreateInvoiceMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/invoice_group/messagecustomer');
	$this->_alertCreateInvoiceMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/invoice_group/messagestaff');
	$this->_alertCreateInvoiceMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/invoice_group/mobilestaff');
    
	$this->_alertVoidPaymentEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/void_payment_group/enabled');
	$this->_alertVoidPaymentMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/void_payment_group/messagecustomer');
	$this->_alertVoidPaymentMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/void_payment_group/messagestaff');
	$this->_alertVoidPaymentMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/void_payment_group/mobilestaff');
  
  	$this->_alertCreditmemoEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/creditmemo_group/enabled');
	$this->_alertCreditmemoMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/creditmemo_group/messagecustomer');
	$this->_alertCreditmemoMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/creditmemo_group/messagestaff');
	$this->_alertCreditmemoMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/creditmemo_group/mobilestaff');
	
	$this->_alertShipmentCreationEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/shipment_group/enabled');
	$this->_alertShipmentCreationMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/shipment_group/messagecustomer');
	$this->_alertShipmentCreationMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/shipment_group/messagestaff');
	$this->_alertShipmentCreationMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/shipment_group/mobilestaff');   
	
 }

  public function sendNewUserAlerts($observer)
  {
  	
  	if(!$this->_alertNewUserEnabled){
		return FALSE;
	}
  	
	$event = $observer->getEvent();
	$customer = $event->getCustomer();

	$name = $customer->getName();	
	$email = $customer->getEmail();
	
	$mobile_code = $customer->getMobileCode();
    $mobile_number = $customer->getMobile();	
					
    $mobile = $mobile_code . $mobile_number;
	$mobile_numbers = $mobile_number;
	//Mage::log('Mobile - '.$mobile);
	
	$messagestaff = $this->_alertNewUserMessageStaff;
	$messagestaff = str_replace('{{name}}',$name,$messagestaff);	
	$messagestaff = str_replace('{{email}}',$email,$messagestaff);
	$messagestaff = str_replace('{{mobile}}',$mobile_numbers,$messagestaff);	
	$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
	$messagecustomer = $this->_alertNewUserMessageCustomer;
	$messagecustomer = str_replace('{{name}}',$name,$messagecustomer);
	$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
	$messagecustomer = str_replace('{{email}}',$email,$messagecustomer);
	$messagecustomer = str_replace('{{mobile}}',$mobile_numbers,$messagecustomer);

	$this->SendSms($mobile,$messagecustomer);
	if(!empty($this->_alertNewUserMobileStaff)){
		$this->SendSms($this->_alertNewUserMobileStaff,$messagestaff);	 	
	}	
  }
  
  public function sendOrderAlerts(Varien_Event_Observer $observer)
  {
  	if(!$this->_alertOrderEnabled){
		return FALSE;
	}
	
		$orderIds = $observer->getData('order_ids');
		//$shippingamt = $order->getFeeAmount();
		$order_array = array();
        $order = Mage::getModel('sales/order')->load($orderIds);
        $order_details = Mage::getModel('sales/order')->loadByIncrementId($order->getIncrementId());
		$shippingamt = $order_details->getFeeAmount();
		$resource = Mage::getSingleton('core/resource');
		/**
		 * Retrieve the write connection
		 */
		$writeConnection = $resource->getConnection('core_write');

		//$query =  "UPDATE zaybx_sales_flat_order SET shipping_amount = ".$shippingamt." WHERE entity_id =".$orderIds[0];
		$query =  "UPDATE zaybx_sales_flat_order SET shipping_amount = ".$shippingamt." WHERE entity_id =".$orderIds[0];
		/**
		 * Execute the query
		 */
		$writeConnection->query($query);	 
		//Mage::log('Order Details'.$order);
		
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
        $order_array['customer_name'] = $order->getCustomerName();
        $order_array['order_number'] = $order->getIncrementId();
        $order_array['date'] = $order->getCreatedAtFormated('long');
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($order->getCustomerId())->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($order->getCustomerId())->getMobile();		
		$mobile = $mobile_code . $mobile_number;					
		//Mage::log('Mobile - '.$mobile);
		//Mage::log('Grand Total - '.$order_array['total']);
			 
	 if(empty($mobile)){	 		 	
		$mobile = $order->getBillingAddress()->getTelephone();    	
		//Mage::log('Telephone - '.$mobile);		 	
	 }	
	 
	 $messagestaff = $this->_alertOrderMessageStaff;
	 $messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 $messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);
     $messagestaff = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagestaff);
	 $messagestaff = str_replace('{{total}}', $order_array['total'], $messagestaff);
	 $messagestaff = str_replace('{{date}}', $order_array['date'], $messagestaff);	
     $messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	  $messagestaff = str_replace('{{status}}', $order_array['status'], $messagestaff);
       
	
	 $messagecustomer = $this->_alertOrderMessageCutomer;
	 $messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
     $messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     $messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
     $messagecustomer = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagecustomer );
     $messagecustomer = str_replace('{{total}}', $order_array['total'], $messagecustomer);
     $messagecustomer = str_replace('{{date}}', $order_array['date'], $messagecustomer);
	 $messagecustomer = str_replace('{{status}}', $order_array['status'], $messagecustomer);
     
	 $this->SendSms($mobile,$messagecustomer);	
	 if(!empty($this->_alertOrderMobileStaff)){
	 	$this->SendSms($this->_alertOrderMobileStaff,$messagestaff);	 	
	 }
	 //Mage::log('Order Sms Sent!!');	
  }
  
  public function sendForgetPasswordAlerts($observer){
  	
	//Mage::log("Forget Password Event..");
	
	
    $email  = Mage::app()->getRequest()->getPost('email');
			
	$customer = Mage::getModel('customer/customer')
                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                ->loadByUsername($email);
        if ($customer->getId()) {
            try {
                $newPassword = $customer->generatePassword();
                $customer->changePassword($newPassword, false);
                $customer->sendPasswordReminderEmail();
				
                $name = $customer->getName();
				
                //Mage::log('Customer Name '.$name);
                //Mage::log('New Password '.$newPassword);
				
                $mobile_code = $customer->getMobileCode();
                $mobile_number = $customer->getMobile();
				                
				$mobile = $mobile_code . $mobile_number;
				
				if(empty($mobile)){
					$mobile = $customer->getPrimaryBillingAddress()->getTelephone();  
					//Mage::Log('Telephone '.$mobile);  				
				}		
																				
				$messagecustomer = $this->_alertForgotPasswordMessageCutomer;				
				$messagecustomer = str_replace('{{name}}', $name, $messagecustomer);	
				$messagecustomer = str_replace('{{password}}', $newPassword, $messagecustomer);	
				$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
				//Mage::log('Customer Message '.$messagecustomer);    
				
				$this->SendSms($mobile,$messagecustomer);	          
            } catch (Exception $e) {              
            }
        } else {			
            #$this->_getSession()->addError($this->__('This email address was not found in our records.'));
            #$this->_getSession()->setForgottenEmail($email);
        }	
  }
  public function sendOrderCancelAlerts($observer){
  	
  	if(!$this->_alertOrderCancelEnabled){
		return FALSE;
	}
		
		//Mage::log('Order Cancel Start...');
		
		$order_id = $observer->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($order_id);		
		$data = $order->getData();
		
        $order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $data['increment_id'];
        $order_array['date'] = $data['created_at'];
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;					
		//Mage::log('Order Cancel Mobile - '.$mobile);
		
			 
	 if(empty($mobile)){	
	 	$billingAddress = $data['billing_address_id']; 		 	
		$mobile = $order->getBillingAddress()->getTelephone();    	
		//Mage::log('Order Cancel Telephone - '.$mobile);		 	
	 }	
	 
	 $messagestaff = $this->_alertOrderCancelMessageStaff;
	 $messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 $messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 $messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 
	$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
	
	 $messagecustomer = $this->_alertOrderCancelMessageCutomer;
	 $messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
     $messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     $messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
	 $messagecustomer = str_replace('{{date}}',  $order_array['date'], $messagecustomer);
        
	 $this->SendSms($mobile,$messagecustomer);
	 if(!empty($this->_alertOrderCancelMobileStaff)){
		$this->SendSms($this->_alertOrderCancelMobileStaff,$messagestaff);	 	
	 }	
		//Mage::log('Order Cancel Sms Sent!!');			
  }
  
  public function sendOrderStatusAlerts($observer){
  		
		/*if(($this->_alertOrderUnholdEnabled) && ($this->_alertOrderholdEnabled)){
			return FALSE;
	 	}*/				
		
		//Mage::log('Welcome Order Status Changed!!!');		
		
		$order_id = $observer->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($order_id);		
		$data = $order->getData();
		
		
		$OrderStatus = $data['status'];
		$OrderState = $data['state'];
		$increment_id = $data['increment_id'];
		$quoteId = $order['quote_id'];
		
		$comments = $order->getStatusHistoryCollection(true);
		//Mage::log('prefix'.Zend_Debug::dump($comments, null, false), null, 'logfilecomment.log');	
		
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
		$order_array['order_number'] = $increment_id;
		$order_array['date'] = $data['created_at'];
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
		$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		 $mobile = $mobile_code . $mobile_number;
						
		//Mage::log('Mobile - '.$mobile);
					 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Telephone - '.$mobile);		 	
		 }
		 
		if($OrderStatus=="" && $this->_alertAdminOrderEnabled)
		{
		  // Event added for order created by admin from backend
			$messagestaff = $this->_alertAdminOrderMessageStaff;	
			$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 		$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 		$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
			$messagestaff = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagestaff);
			$messagestaff = str_replace('{{total}}', $order_array['total'], $messagestaff);
			$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
     
			
			$messagecustomer = $this->_alertAdminOrderMessageCutomer;
			$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
			$messagecustomer = str_replace('{{date}}', $order_array['date'], $messagecustomer);
			$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
			$messagecustomer = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagecustomer);
			$messagecustomer = str_replace('{{total}}', $order_array['total'], $messagecustomer);
			$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
							 
			$this->SendSms($mobile,$messagecustomer);	
			if(!empty($this->_alertAdminOrderMobileStaff)){
				$this->SendSms($this->_alertOrderHoldMobileStaff,$messagestaff);				
			}
		}
		
		if($OrderStatus == "holded" && $this->_alertOrderHoldEnabled){
		
			//Mage::log("Order on hold.");
			$messagestaff = $this->_alertOrderHoldMessageStaff;	
			$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 		$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 		$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
			$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
			
			$messagecustomer = $this->_alertOrderHoldMessageCustomer;
	 		$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
     		$messagecustomer = str_replace('{{date}}', $order_array['date'], $messagecustomer);
     		$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
			$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
							 
			$this->SendSms($mobile,$messagecustomer);	
			if(!empty($this->_alertOrderHoldMobileStaff)){
				$this->SendSms($this->_alertOrderHoldMobileStaff,$messagestaff);				
			}
		}
		
		
		if($OrderStatus == "pending" && $this->_alertOrderUnholdEnabled){
		  
			//Mage::log("Order released from hold.");				
			$messagestaff = $this->_alertOrderUnholdMessageStaff;	
			$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 		$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 		$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
			$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
			$messagecustomer = $this->_alertOrderUnholdMessageCustomer;
	 		$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
			$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     		$messagecustomer = str_replace('{{date}}', $order_array['date'], $messagecustomer);
     		$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
			// Calling SendSms()			
			$this->SendSms($mobile,$messagecustomer);	
			if(!empty($this->_alertOrderUnholdMobileStaff)){
				$this->SendSms($this->_alertOrderUnholdMobileStaff,$messagestaff);	 	
			}
		}		 	
  }
  
  public function sendInvoiceAlerts($observer)
  {  	
		if((!$this->_alertCreateInvoiceEnabled)){
			return FALSE;
	 	}
		
  		$order_id = $observer->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($order_id);		
		$data = $order->getData();		
		$OrderStatus = $data['status'];
		$OrderState = $data['state'];
		$increment_id = $data['increment_id'];
		$currency = $data['base_currency_code'];
				
		$orders_invoice = Mage::getModel("sales/order_invoice")->getCollection();
		//Mage::log('prefix'.Zend_Debug::dump($orders_invoice, null, false), null, 'logfileInvoiceNo.log');	
						
		#Mage::log('prefix'.Zend_Debug::dump($invoice, null, false), null, 'logfileInvoiceNo.log');	
		#Mage::log('prefix'.Zend_Debug::dump($invoiceId, null, false), null, 'logfileInvoiceNoData.log');
				
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $increment_id;
        $order_array['date'] = $data['created_at'];
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;
							
		//Mage::log('Order Invoice Mobile - '.$mobile);
					 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Order Invoice Telephone - '.$mobile);		 	
		 }
		 
		$messagestaff = $this->_alertCreateInvoiceMessageStaff;	
		$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 	$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 	$messagestaff = str_replace('{{amount}}',  $currency.' '.$order_array['total'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
		$messagecustomer = $this->_alertCreateInvoiceMessageCustomer;
	 	$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
		$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     	       $messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
		$messagecustomer = str_replace('{{amount}}',  $currency.' '.$order_array['total'], $messagecustomer);	 					
		$this->SendSms($mobile,$messagecustomer);			
		if(!empty($this->_alertCreateInvoiceMobileStaff)){
			$this->SendSms($this->_alertCreateInvoiceMobileStaff,$messagestaff);	 	
		}	
		
		#Mage::log('Customer Msg'.$messagecustomer);
		#Mage::log('Staff Msg'.$messagestaff);
			 			 
		#Mage::log('Order Invoice Event!!');
		#Mage::log('prefix'.Zend_Debug::dump($data, null, false), null, 'logfileInvoice.log');
  }
  
   public function sendPaymentVoidAlerts($observer)
  {
  	 	if((!$this->_alertVoidPaymentEnabled)){
			return FALSE;
	 	}
		
  		$order_id = $observer->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($order_id);		
		$data = $order->getData();		
		$OrderStatus = $data['status'];
		$OrderState = $data['state'];
		$increment_id = $data['increment_id'];
		$currency = $data['base_currency_code'];
				
		$orders_invoice = Mage::getModel("sales/order_invoice")->getCollection();
		//Mage::log('prefix'.Zend_Debug::dump($orders_invoice, null, false), null, 'logfileVoidPayment.log');	
						
		#Mage::log('prefix'.Zend_Debug::dump($invoice, null, false), null, 'logfileInvoiceNo.log');	
		#Mage::log('prefix'.Zend_Debug::dump($invoiceId, null, false), null, 'logfileInvoiceNoData.log');
				
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $increment_id;
        $order_array['date'] = $data['created_at'];
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;
							
		//Mage::log('Void Payment Mobile - '.$mobile);
					 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Void Payment Telephone - '.$mobile);		 	
		 }
		 
		$messagestaff = $this->_alertVoidPaymentMessageStaff;	
		$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 	$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 	$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
		
		$messagecustomer = $this->_alertVoidPaymentMessageCustomer;
	 	$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
		$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     	$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
		$messagecustomer = str_replace('{{date}}',  $order_array['date'], $messagecustomer);	 
			 
		$this->SendSms($mobile,$messagecustomer);	
		if(!empty($this->_alertVoidPaymentMobileStaff)){
			$this->SendSms($this->_alertVoidPaymentMobileStaff,$messagestaff);	
		}	
		//Mage::log('Void Payment Customer Msg'.$messagecustomer);
		//Mage::log('Void PaymentStaff Msg'.$messagestaff);
			 			 
		//Mage::log('Void Payment Event!!');			 
  }
  
  public function sendCreditmemoAlerts($observer)
   {
   	 	//Mage::log("CreditOrder Memo...");
			
		if((!$this->_alertCreditmemoEnabled)){
			return FALSE;
	 	}
	
		$creditmemo = $observer->getEvent()->getCreditmemo();
		$order = $creditmemo->getOrder();
	    $order_array = array();
        				  				
		$data = $order->getData();				
		$increment_id = $data['increment_id'];
		$currency = $data['base_currency_code'];
				
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $increment_id;
        $order_array['date'] = $data['created_at'];
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
				
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;
							
							 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Credit Memo Telephone - '.$mobile);		 	
		 }
		 
		$messagestaff = $this->_alertCreditmemoMessageStaff;	
		$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 	$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 	$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
		
		$messagecustomer = $this->_alertCreditmemoMessageCustomer;
	 	$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
		$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     	$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
		$messagecustomer = str_replace('{{date}}',  $order_array['date'], $messagecustomer);	 
			
		$this->SendSms($mobile,$messagecustomer);	
		if(!empty($this->_alertCreditmemoMobileStaff)){
			$this->SendSms($this->_alertCreditmemoMobileStaff,$messagestaff);	 	
		}						    	
   }
   
  public function sendShipmentCreationAlerts($observer){
  	
		//Mage::log("Shipment Event Inside");
	
  		if(!$this->_alertShipmentCreationEnabled){
			return FALSE;	
		}	
		
  		$shipment = $observer->getEvent()->getShipment();
        $order = $shipment->getOrder();
        $track = $shipment->getAllTracks();
		
		$data = $order->getData();	
		$order_array = array();
		$increment_id = $data['increment_id'];
						
		foreach($track as $tno){
			$order_array['title'] = $tno['title'];
	    	$order_array['tracking'] = $tno['number'];   
		}
		#Mage::log('prefix'.Zend_Debug::dump($trackdata, null, false), null, 'logShipmentdata.log');	
				
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $increment_id;   
				
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;
							
		#Mage::log('Credit Memo Mobile - '.$mobile);
					 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Credit Memo Telephone - '.$mobile);		 	
		 }
		 
		$messagestaff = $this->_alertShipmentCreationMessageStaff;	
		$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 	$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 	$messagestaff = str_replace('{{title}}',  $order_array['title'], $messagestaff);	 	 	
	 	$messagestaff = str_replace('{{tracking}}',  $order_array['tracking'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
		
		$messagecustomer = $this->_alertShipmentCreationMessageCustomer;
	 	$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);		
		$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);		
		$messagecustomer = str_replace('{{title}}',  $order_array['title'], $messagecustomer);
		$messagecustomer = str_replace('{{tracking}}', $order_array['tracking'], $messagecustomer);
		$messagecustomer = str_replace('{{date}}',  $order_array['date'], $messagecustomer);	 	 	
		$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
		
		#Mage::log('Shipment Customer Msg '.$messagecustomer);		
		#Mage::log('Shipment Staff Msg '.$messagestaff);	
				
		$this->SendSms($mobile,$messagecustomer);
		if(!empty($this->_alertShipmentCreationMobileStaff)){
			$this->SendSms($this->_alertShipmentCreationMobileStaff,$messagestaff);	 				
		}
  } 
          
  public function SendSms($mobileno, $message){  	  	
	$username = $this->_smxUsername;
	$pass = $this->_smxPassword;
	Zend_Loader::loadClass('Zend_Http_Client'); 		
	$obj = new Celusion_SMSConneXion_Model_Client();
	$objResult = $obj->license();	
	//Mage::log('License Result '.$objResult);
	
	if($objResult){
	 
  	$smx = new Zend_Http_Client('http://smsc.smsconnexion.com/api/gateway.aspx');
	$smx->setParameterPost(array(
    		'action'  => 'send',
    		'username'   => $username,
    		'passphrase'   => $pass,
		 	'phone'   => $mobileno,
			'message' => $message));			
	$response = $smx->request('POST');	
	}						 							
  }
  
    public function sendCanceOrderMail($observer){
		
	
		//$orders = $observer->getEvent()->getOrder()->getId();
		$order = $observer->getOrder();
		$orderStatus = $order->getStatus();
		
		if ($orderStatus == Mage_Sales_Model_Order::STATE_CANCELED){
			$this->_sendStatusMail($order);
		}
  
	}
	
	private  function _sendStatusMail($order)
    {
		
		
		$emailTemplate  = Mage::getModel('core/email_template');

        $emailTemplate->loadDefault('sales_email_order_cancel_template');
        $emailTemplate->setTemplateSubject('Cancellation of your mSupply Order No:' . $order->getIncrementId());

        // Get General email address (Admin->Configuration->General->Store Email Addresses)
        $salesData['email'] = Mage::getStoreConfig('trans_email/ident_general/email');
        $salesData['name'] = Mage::getStoreConfig('trans_email/ident_general/name');

        $emailTemplate->setSenderName($salesData['name']);
        $emailTemplate->setSenderEmail($salesData['email']);
        
        $orderId = $order->getId();
        $orderLoad = Mage::getModel('sales/order')->load($orderId);
	    $orderItems = $orderLoad->getItemsCollection();
		
		

		foreach($orderItems as $data)
		{
		
        $parentProductIdArr = explode("-",$data->getSku());
		$product = Mage::getModel("catalog/product")->loadByAttribute("sku",$parentProductIdArr[0]);
		$productMediaConfig = Mage::getModel('catalog/product_media_config');
		$smallImageUrl = $productMediaConfig->getMediaUrl($product->getSmallImage());
		$message .='<tr style="float:left; width:711px; margin:15px;color:#444444;">
				
				       <td style="float:left; width:116px;">
							<a target="_blank" href="' . $product->getProductUrl() . '" style="text-decoration:none;float:left; text-align:left;">
								<img border="0" width="100%" src=' . $smallImageUrl. ' alt="product-image" />
							</a>								
						</td>
						<td style="float:left; width:250px; padding:2px;">
							<p>
								<span style="font-size:13px;text-align:left;float:left;">ID: #' . $data->getSku() . '</span><br/>
								<a target="_blank" href="' . $product->getProductUrl() . '" style="color:#444444;text-decoration:none;font-size:12px;text-align:left;float:left;">
								<span>' . $data->getName() . '</span>
								</a>
							</p>
						</td>
						<td style="float:left; width:150px; padding:2px;color:#444444;font-size:13px;">' . Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($data->getPrice(),2) . '</td>
						<td style="float:left; width:75px; padding:2px;color:#444444;font-size:13px;">' . round($data->getQtyOrdered()) . '</td>
						<td style="float:left; padding:2px;color:#444444;font-size:13px;">' . Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($data->getRowTotal(),2) . '</td>
			       </tr>';	
			       
		}
		$orderSubTotal = $orderLoad->getSubtotal();
		$ordersubtotal = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderSubTotal,2);
		$ShippHandling = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getShippingAmount(),2);
		$vat = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getTaxAmount(),2);
		$grandTotal = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getGrandTotal(),2);
		$convenienceamt = $orderLoad->getConvenienceAmount();
		$paymentCharge = $orderLoad->getPaymentCharge();
		$servCharge = $convenienceamt + $paymentCharge;
		$serviceCharge = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($servCharge,2);
		
		$ordertotal ='<tr align="right" style="float:left;width:96%;margin:0 15px 15px;border-top:1px solid #eaeaea;padding-top: 10px;">
									    <td>
										    <table cellpadding="0" cellspacing="0" width="500" align="right" style="color:#444444;font-size:12px;line-height: 25px;">													
													<tr>
														<td align="right" colspan="1">Subtotal</td>
														<td align="right">' . $ordersubtotal . '</td>
													</tr>
													<tr>
														<td align="right" colspan="1">Shipping & Handling Charges</td>
														<td align="right">' . $ShippHandling . '</span></td>
													</tr>
													<tr>
														<td colspan="1" align="right">VAT</td>
														<td align="right">'. $vat .'</td>
													</tr>
													<tr>
														<td align="right" colspan="1">Service Charges (Including Service Tax)</td>
														<td align="right">' .$serviceCharge . '</td>														
													</tr>
													<tr>
													     <td align="right" colspan="1" style="color:#bd4931;"><strong>Grand Total</strong></td>
													     <td align="right" style="color:#bd4931;"><strong>' . $grandTotal . '</strong></td>
													</tr>
											</table>
										</td>
									</tr>';
									
		
		$emailTemplateVariables['payment_html'] = $message;

        $emailTemplateVariables['firstname'] = $order->getCustomerFirstname();
        $emailTemplateVariables['order_increment_id'] = $order->getIncrementId();
        $emailTemplateVariables['order_created_at_formated'] = $order->getCreatedAtFormated('long');
        $emailTemplateVariables['store_name'] = $order->getStoreName();
        $emailTemplateVariables['store_url'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $emailTemplateVariables['payment_html'] = $message;
        $emailTemplateVariables['order_total'] = $ordertotal;
        $emailTemplate->send($order->getCustomerEmail(), $order->getStoreName(), $emailTemplateVariables);
        
		
	}
}
ob_end_clean();
