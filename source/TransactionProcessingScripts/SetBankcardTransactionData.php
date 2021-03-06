<?php
/* Copyright (c) 2013 EVO Payments International - All Rights Reserved.
 *
 * This software and documentation is subject to and made
 * available only pursuant to the terms of an executed license
 * agreement, and may be used only in accordance with the terms
 * of said agreement. This software may not, in whole or in part,
 * be copied, photocopied, reproduced, translated, or reduced to
 * any electronic medium or machine-readable form without
 * prior consent, in writing, from EVO Payments International
 *
 * Use, duplication or disclosure by the U.S. Government is subject
 * to restrictions set forth in an executed license agreement
 * and in subparagraph (c)(1) of the Commercial Computer
 * Software-Restricted Rights Clause at FAR 52.227-19; subparagraph
 * (c)(1)(ii) of the Rights in Technical Data and Computer Software
 * clause at DFARS 252.227-7013, subparagraph (d) of the Commercial
 * Computer Software--Licensing clause at NASA FAR supplement
 * 16-52.227-86; or their equivalent.
 *
 * Information in this software is subject to change without notice
 * and does not represent a commitment on the part of EVO Payments International.
 *
 * Sample Code is for reference Only and is intended to be used for educational purposes. It's the responsibility of
 * the software company to properly integrate into thier solution code that best meets thier production needs.
 */
require_once ABSPATH . '/ConfigFiles/app.config.php';
// Credit Card Info
/* SEE CREDIT CARD CLASS IN CWSClient.php FOR MORE INFO */
function setBCPTxnData($_serviceInformation) {
	if (Settings::IndustryType == 'Retail' && !Settings::TxnData_ProcessAsKeyed && !Settings::TxnData_ProcessEncrypted) {
		$tenderData = new creditCard ();
		$tenderData->type = 'Visa';
		// $tenderData->name = 'John Doe';
		// $tenderData->number = '4111111111111111';
		// $tenderData->expiration = '1215'; // MMYY
		// $tenderData->cvv = '111'; // Security code
		// $tenderData->address = '1000 1st Av';
		// $tenderData->zip = '10101';
		// $tenderData->track1 = 'B4111111111111111^EVOSNAP/TESTCARD^15121010454500415000010';
		$tenderData->track2 = '4111111111111111=15121010454541500010';
	}
	elseif (Settings::IndustryType == 'Restaurant' && !Settings::TxnData_ProcessAsKeyed && !Settings::TxnData_ProcessEncrypted) {
		$tenderData = new creditCard ();
		$tenderData->type = 'Visa';
		// $tenderData->name = 'John Doe';
		// $tenderData->number = '4111111111111111';
		// $tenderData->expiration = '1215'; // MMYY
		// $tenderData->cvv = '111'; // Security code
		// $tenderData->address = '1000 1st Av';
		// $tenderData->zip = '10101';
		// $tenderData->track1 = 'B4111111111111111^EVOSNAP/TESTCARD^15121010454500415000010';
		$tenderData->track2 = '4111111111111111=15121010454541500010';
	}
	elseif (Settings::IndustryType == 'MOTO' && !Settings::TxnData_ProcessEncrypted) {
		$tenderData = new creditCard ();
		$tenderData->type = 'MasterCard';
		$tenderData->name = 'John Doe';
		$tenderData->number = '5454545454545454';
		$tenderData->expiration = '1215'; // MMYY
		/*
		 * $tenderData->cvv = '111'; // Security code $tenderData->address = '1000 1st Av'; $tenderData->zip = '10101';
		 */
	}
	elseif (Settings::IndustryType == 'Ecommerce' && !Settings::TxnData_ProcessEncrypted) {
		$tenderData = new creditCard ();
		$tenderData->type = 'Visa';
		$tenderData->name = 'John Doe';
		$tenderData->number = '4111111111111111';
		$tenderData->expiration = '1215'; // MMYY
		$tenderData->cvv = '111'; // Security code
		$tenderData->address = '3000 3rd Av';
		$tenderData->city = 'Denver';
		$tenderData->state = 'CO';
		$tenderData->zip = '10101';
	}
	elseif (Settings::TxnData_ProcessEncrypted) {
		$tenderData = new creditCard ();
		// $tenderData->type = 'Visa';
		// $tenderData->name = 'John Doe';
		// $tenderData->number = '4111111111111111';
		// $tenderData->expiration = '1215'; // MMYY
		$tenderData->cvv = NULL; // Security code, For MagTek Always set to "Null". Value does not come from the device.
		                         // $tenderData->address = '1000 1st Av';
		                         // $tenderData->zip = '10101';
		                         // $tenderData->track1 = 'B4111111111111111^EVOSNAP/TESTCARD^15121010454500415000010';
		                         // $tenderData->track2 = '4111111111111111=15121010454541500010';
		$tenderData->encryptionKeyId = '9010010B0C2472000021'; // 20-character string returned by MagneSafe device when card is swiped.
		$tenderData->securePaymentAccountData = '87936F09AE06386BA4CD81ADFF7DF0FA5AC1B28EF9F7B7075E415545F9B9095C0AC5FA12B9905325'; // Encrypted Track 2 data returned by MagneSafe device when card is swiped.
		$tenderData->identificationInformation = '9ED72A486AB36DC352957C2C00607E937D1D90CB8B09A8588629AABA8EAF0FD65296A4FBA490EECFCD8D5B350438C4BFA6A36FFA2ADAAA3E'; // Encrypted MagnePrint® Information returned by the MagneSafe™ device when card is swiped.
		$tenderData->swipeStatus = '00304061'; // MagnePrint Status of Card Swipe. This is an alpha numeric string, returned by MagneSafe device when card is swiped.
	}
	if (! Settings::TxnData_ProcessEncrypted && ! Settings::TxnData_ProcessAsKeyed) {
		$tenderData = new creditCard ();
		$tenderData->type = 'Visa';
		// $tenderData->name = 'John Doe';
		// $tenderData->number = '4111111111111111';
		// $tenderData->expiration = '1215'; // MMYY
		// $tenderData->cvv = NULL; // Security code, For MagTek Always set to "Null". Value does not come from the device.
		// $tenderData->address = '1000 1st Av';
		// $tenderData->city = 'Denver';
		// $tenderData->state = 'CO';
		// $tenderData->zip = '10101';
		// $tenderData->track1 = 'B4111111111111111^EVOSNAP/TESTCARD^15121010454500415000010';
		$tenderData->track2 = '4111111111111111=15121010454541500010';
		// $tenderData->encryptionKeyId = '9010010B0C2472000021'; //20-character string returned by MagneSafe device when card is swiped.
		// $tenderData->securePaymentAccountData = '87936F09AE06386BA4CD81ADFF7DF0FA5AC1B28EF9F7B7075E415545F9B9095C0AC5FA12B9905325'; //Encrypted Track 2 data returned by MagneSafe device when card is swiped.
		// $tenderData->identificationInformation = '9ED72A486AB36DC352957C2C00607E937D1D90CB8B09A8588629AABA8EAF0FD65296A4FBA490EECFCD8D5B350438C4BFA6A36FFA2ADAAA3E'; //Encrypted MagnePrint® Information returned by the MagneSafe™ device when card is swiped.
		// $tenderData->swipeStatus = '00304061'; //MagnePrint Status of Card Swipe. This is an alpha numeric string, returned by MagneSafe device when card is swiped.
	}
	elseif (Settings::TxnData_ProcessAsKeyed) {
		$tenderData = new creditCard ();
		$tenderData->type = 'Visa';
		$tenderData->name = 'John Doe';
		$tenderData->number = '4111111111111111';
		$tenderData->expiration = '1215'; // MMYY
		$tenderData->cvv = '111'; // Security code, For MagTek Always set to "Null". Value does not come from the device.
		$tenderData->address = '1000 1st Av';
		$tenderData->city = 'Denver';
		$tenderData->state = 'CO';
		$tenderData->zip = '10101';
		// $tenderData->track1 = 'B4111111111111111^EVOSNAP/TESTCARD^15121010454500415000010';
		// $tenderData->track2 = '4111111111111111=15121010454541500010';
	}
	
if (Settings:: EMVData_ChangeMe)  {
		$EMVData->ApplicationId = 'testitem'; // Tag 9F06 AID
		$EMVData->ApplicationVersionNumber = 'testitem'; // Tag 9F09
		$EMVData->AuthorizationAmount = 'testitem'; // Tag 9F02
		$EMVData->ApplicationInterchangeProfile = 'testitem'; // Tag 82
		$EMVData->ApplicationTransactionCount = 'testitem'; // Tag 9F36 ATC
		$EMVData->ApplicationUsageControl = 'testitem'; // Tag 9F07
		$EMVData->AuthorizationResponseCode = 'testitem'; // Tag 8A
		$EMVData->CardAuthenticationReliabilityIndex = 'testitem'; 
		$EMVData->CardAuthenticationResultsCode = 'testitem';
		$EMVData->ChipConditionCode = 'testitem';
		$EMVData->Cryptogram = 'testitem'; // Tag 9F26
		$EMVData->CryptogramInformationData = 'testitem'; // Tag 9F27
		$EMVData->CVMList = 'testitem'; // Tag 8E
		$EMVData->CVMResults = 'testitem'; // Tag 9F34
		$EMVData->InterfaceDeviceSerialNumber = 'testitem'; // Tag 9F1E IFD
		$EMVData->CashBackAmount = 'testitem'; // Tag 9F03
		$EMVData->IssuerActionDefault = 'testitem'; // Tag 9F0D
		$EMVData->IssuerActionDenial = 'testitem'; // Tag 9F0E
		$EMVData->IssuerActionOnline = 'testitem'; // Tag 9F0F
		$EMVData->IssuerApplicationData = 'testitem'; // Tag 9F10
		$EMVData->IssuerScriptResults = 'testitem'; 
		$EMVData->LocalTransactionDate = 'testitem'; // Tag 9A
		$EMVData->TerminalCountryCode = 'testitem'; // Tag 9F1A
		$EMVData->TerminalType = 'testitem'; // Tag 9F35
		$EMVData->TerminalVerifyResult = 'testitem'; // Tag 95
		$EMVData->TransactionCategoryCode = 'testitem'; 
		$EMVData->CurrencyCode = 'testitem'; // Tag 5F2A
		$EMVData->SequenceNumber = 'testitem'; // Tag 9F41
		$EMVData->TransactionType = 'testitem'; // Tag 9C
		$EMVData->UnpredictableNumber = 'testitem'; // Tag 9F37
	}
	// Transaction information
	/* SEE TRANSACTION INFORMATION CLASS IN CWSClient.php FOR MORE INFO */
	$transactionData = new transData ();
	$transactionData->OrderNumber = '546846'; // Order Number needs to be unique
	$transactionData->CustomerPresent = Settings::CustomerPresent; // Present, Ecommerce, MOTO, NotPresent
	$transactionData->EmployeeId = '12'; // Used for Retail, Restaurant, MOTO
	
	if ($encryptedTransaction)
		$transactionData->EntryMode = 'Track2DataFromMSR'; // Keyed, TrackDataFromMSR For MagTek Enumeration set to EntryMode.Track2DataFromMSR. Value does not come from the device.
	if (! $encryptedTransaction)
		$transactionData->EntryMode = 'Keyed'; // Keyed, TrackDataFromMSR For MagTek Enumeration set to EntryMode.Track2DataFromMSR. Value does not come from the device.
	
	$transactionData->Amount = '10.00'; // in a decimal format xx.xx
	                                    // $transactionData->CashBackAmount = '0.00'; // in a decimal format. used for PINDebit transactions
	$transactionData->CurrencyCode = 'USD'; // TypeISOA3 Currency Codes USD CAD
	$transactionData->SignatureCaptured = false; // boolean true or false
	$transactionData->LaneId = "1";
	$transactionData->Reference = "1";
	if (isset ( $transactionData->IsPartialShipment ))
		$transactionData->IsPartialShipment = false; // boolean true or false
	if (isset ( $transactionData->IsQuasiCash ))
		$transactionData->IsQuasiCash = false; // boolean true or false
			                                       // $transactionData->TipAmount = '0.00'; // in a decimal format
	$transactionData->TransactionCode = 'NotSet';
	
	if (Settings::Pro_IncludeLevel2OrLevel3Data) {
		// Transaction information
		/* SEE TRANSACTION INFORMATION CLASS IN CWSClient.php FOR MORE INFO */
		$transactionData = new transDataPro ();
		$transactionData->OrderNumber = '546846'; // Order Number needs to be unique
		$transactionData->SignatureCaptured = 'false';
		$transactionData->CustomerPresent = Settings::CustomerPresent; // Present, Ecommerce, MOTO, NotPresent
		$transactionData->EmployeeId = '12'; // Used for Retail, Restaurant, MOTO
		$transactionData->EntryMode = Settings::TxnData_EntryMode; // Keyed, TrackDataFromMSR
		$transactionData->GoodsType = 'DigitalGoods'; // DigitalGoods - PhysicalGoods - Used only for Ecommerce
		                                              // $transactionData->IndustryType = Settings::IndustryType;
		$transactionData->AccountType = 'NotSet'; // SavingsAccount, CheckingAccount used only for PINDebit
		$transactionData->Amount = '10.00'; // in a decimal format xx.xx
		$transactionData->CashBackAmount = '0.00'; // in a decimal format. used for PINDebit transactions
		$transactionData->CurrencyCode = 'USD'; // TypeISOA3 Currency Codes USD CAD
		$transactionData->SignatureCaptured = false; // boolean true or false
		$transactionData->PartialApprovalCapable = 'NotSet'; // Capable | NotCapable | NotSet
		$transactionData->IsPartialShipment = false; // boolean true or false
		$transactionData->IsQuasiCash = false; // boolean true or false
		                                       // $transactionData->TipAmount = ''; // in a decimal format
		$transactionData->ReportingData = new TransactionReportingData ();
		$transactionData->ReportingData->Description = 'description';
		$transactionData->LaneId = "1";
		$level2Data = new Level2Data ();
		$level2Data->CommodityCode = 'testitem'; // order[commodity_code]
		$level2Data->CompanyName = 'testitem'; // order[billto_company]
		$level2Data->CustomerCode = 'testitem'; // order[customer_code]
		$level2Data->DiscountAmount = '1.00'; // order[discount_amount]
		$level2Data->DestinationPostalCode = 'testitem'; // order[shipto_zipcode]
		$level2Data->DutyAmount = '1.00'; // order[duty_amount]
		$level2Data->FreightAmount = '1.00'; // order[total_shipping]
		$level2Data->MiscHandlingAmount ='1.00'; 
		$level2Data->RequesterName = 'testitem';
		$level2Data->ShipFromPostalCode = 'testitem'; // order[ship_code]
		$level2Data->ShipmentId = 'testitem'; // order[shipment_id]
		$level2Data->OrderDate = DateTime::ISO8601; // order[order_date]
		$level2Data->OrderNumber = '123545'; // order[merchant_order_id]
		$level2Data->TaxExempt = new TaxExempt ();
		$level2Data->TaxExempt = 'IsTaxExempt'; // order_tax[exempt]
		$level2Data->Tax = new Tax ();
		$level2Data->Tax->Amount = '1.00'; // order_tax[amount]
		$level2Data->Tax->Rate = '.5'; // order_tax[rate]
		$level2Data->Tax->InvoiceNumber = 'testitem'; // order_tax[invoice_number]
		$level2Data->Tax->ItemizedTaxes = New ItemizedTaxes ();
		$level2Data->Tax->ItemizedTaxes->ItemizedTax = New ItemizedTax ();
		$level2Data->Tax->ItemizedTaxes->ItemizedTax->Amount = '1.00'; // order_itemized_tax[N][amount]
		$level2Data->Tax->ItemizedTaxes->ItemizedTax->Rate = '0.5'; // order_itemized_tax[N][rate]
		$level2Data->Tax->ItemizedTaxes->ItemizedTax->Type = 'VAT'; // order_itemized_tax[N][type]
		$level2Data->Description = 'testitem';
		$level2Data->DestinationCountryCode = 'USA'; // order[shipto_country]
		$lineItemDetail = new LineItemDetail ();
		$lineItemDetail->DiscountAmount = '1.00'; // order[total_discount]
		$lineItemDetail->ProductCode = 'testitem'; // order_item[N][sku]
		$lineItemDetail->Tax = new Tax ();
		$lineItemDetail->Tax->Amount = '1.00'; // order_item[N][amount]
		$lineItemDetail->UnitPrice = '10.00'; // order_item[N][price]
		$lineItemDetail->Quantity = '5.00'; // order_item[N][qty]
		$lineItemDetail->Description = 'testitem'; // order_item[N][description]
		$lineItemDetail->Amount = '1.00'; // order_item[N][amount]
		$lineItemDetail->UnitOfMeasure = 'VAT'; // order_item[N][unit_of_measure]
		$lineItemDetail->CommodityCode = 'testitem'; // order_item[N][commodity_code]
		$lineItemDetail->DiscountAmount = 'testitem'; // order_item[N][discount_amount]
		$lineItemDetail->DiscountIncluded = 'true'; // order_item[N][discount_included]
		$lineItemDetail->TaxIncluded = 'true'; // order_item[N][tax_included]
		$lineItemDetail->UPC = 'testitem'; // order_item[N][upc]
		$level2Data->BaseAmount = '9.00'; // order[total_subtotal]
		$transactionData->Level2Data = $level2Data;
	}
	
	if (Settings::TxnData_SoftDescriptors) {
		/*
		 * Note: not all processors support the new Alternative Merchant Data object See else statement below for alternate format of Soft Descriptors
		 */
		if ($_serviceInformation->BankcardServices->BankcardService->AlternativeMerchantData) {
			$altMerchData = new AlternativeMerchantData ();
			$altMerchData->Name = 'AltMerchName';
			$altMerchData->MerchantId = '122234';
			$altMerchData->Description = 'Blue Bottle';
			$altMerchData->CustomerServiceInternet = 'test@altmerch.com';
			$altMerchData->CustomerServicePhone = '303 5551212';
			$address = new AddressInfo ();
			$address->Street1 = '123 Test Street';
			$address->StateProvince = 'CO';
			$address->PostalCode = '80202';
			$address->City = 'Denver';
			$address->CountryCode = 'USA';
			$altMerchData->Address = $address;
			$transactionData->AltMerchantData = $altMerchData;
		} 		/*
		   * Note: older processors support this way of Soft Descriptors/Alternative Merchant Data the combination of your top level MerchantProfile->MerchantName with MerchantProfile->CustomerServiceInternet combined with the ReportingData->Description will make the soft descriptor format
		   */
		else {
			$reportingData = new TransactionReportingData ();
			$reportingData->Description = 'AltMerchName';
			$transactionData->ReportingData = $reportingData;
		}
	}
	
	$dateTime = new DateTime ( "now", new DateTimeZone ( 'America/Denver' ) );
	$transactionData->DateTime = $dateTime->format ( DATE_RFC3339 );
	
	if ($_serviceInformation->BankcardServices->BankcardService->Tenders->CredentialsRequired) {
		$credentials = array ();
		$credentials [] = array (
				'<UserId>' . Settings::TxnData_UserId . '</UserId>',
				'<Password>;' . Settings::TxnData_Password . '</Password>' 
		);
		$transactionData->Creds = $credentials;
	}
	
	$transaction = new newTransaction ();
	$transaction->TndrData = $tenderData;
	$transaction->TxnData = $transactionData;
	
	if (Settings::Pro_InterchangeData) {
		$interchangeData = new interchangeData ();
		$interchangeData->BillPayment = "Recurring"; // Any time BillPayInd is set to either "DeferredBilling", "Installment", "SinglePayment" or "Recurring", CustomerPresent should be set to "BillPayment"
		                                             // $interchangeData->RequestCommercialCard = "";
		$interchangeData->ExistingDebt = "NotExistingDebt";
		// $interchangeData->RequestACI = "";
		// $interchangeData->TotalNumberOfInstallments = "1"; //Used for Installment
		$interchangeData->CurrentInstallmentNumber = "1"; // Send 1 for the first payment and any number greater than 1 for the remaining payments.
		                                                  // $interchangeData->RequestAdvice = "1";
		                                                  
		// Any time BillPayInd is set to either "DeferredBilling", "Installment" or "Recurring", CustomerPresent should be set to "BillPayment"
		if ($interchangeData->BillPayment = "Installment" or $interchangeData->BillPayment = "DeferredBilling" or $interchangeData->BillPayment = "Recurring")
			$transactionData->CustomerPresent = 'BillPayment';
		
		$transactionData->InterchangeData = $interchangeData;
	}
	if(Settings::ProcessInternationalTxn)
	{
		$transactionData->Is3DSecure = false;
	}
	$transaction->TxnData = $transactionData;
	return $transaction;
}
?>