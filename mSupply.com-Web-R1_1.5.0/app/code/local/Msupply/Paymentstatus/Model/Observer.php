<?php
class Msupply_Paymentstatus_Model_Observer {    

    public function updateStatus($observer){
        $event = $observer->getEvent();
		$order = $event->getOrder();
		$order_no   = (string) $order->getRealOrderId();
		$customer   = $order->getCustomer(); 
		$trusted  = $customer->getData('trusted');
		$payment = $order->getPayment();
		$orderplacestatus = $order->getStatusLabel();
		//Get Payment Info
		$paymentCode = $payment->getMethodInstance()->getCode();
		$order->loadByIncrementId($order_no);
		if($paymentCode == 'cashondelivery' || $paymentCode == 'cheque_checkout'){
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
		}
		if(($paymentCode == 'hdfc_standard' || $paymentCode == 'hdfcnb_standard' || $paymentCode == 'hdfcdc_standard') && ($orderplacestatus = 'Pending' || $orderplacestatus = 'pending'))
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		else if(($paymentCode == 'hdfc_standard' || $paymentCode == 'hdfcnb_standard' || $paymentCode == 'hdfcdc_standard') && ($orderplacestatus = 'Confirmed' || $orderplacestatus = 'confirmed'))
		{
			$paymentStatus = 'Confirmed';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
		}
		else if(($paymentCode == 'hdfc_standard' || $paymentCode == 'hdfcnb_standard' || $paymentCode == 'hdfcdc_standard') && ($orderplacestatus = '' || $orderplacestatus = NULL))
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		if(($paymentCode == 'payucheckout_shared')  && ($orderplacestatus = 'Pending' || $orderplacestatus = 'pending'))
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		else if(($paymentCode == 'payucheckout_shared')  && ($orderplacestatus = 'Confirmed' || $orderplacestatus = 'confirmed'))
		{
			$paymentStatus = 'Confirmed';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
		}
		else if(($paymentCode == 'payucheckout_shared') && ($orderplacestatus = '' || $orderplacestatus = NULL))
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		/*if($paymentCode == 'payucheckout_shared')
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}*/
		if($paymentCode == 'cashin')
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
		}
			if($paymentCode == 'neft')
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
		}
		if($trusted == 0 && $paymentCode == 'callmsupply')
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		$order->setPaymentStatus($paymentStatus);
		$order->save();
		return true;
    }
}
