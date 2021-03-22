<?php

namespace modules;

require_once(__DIR__ . '/../stripe/init.php');

use \lib\core\Module;

class stripe extends Module
{
  public $stripe;

  function __construct($app) {
    $this->stripe = new \Stripe\StripeClient(CONFIG('STRIPE_SECRET_KEY'));
    parent::__construct($app);
  }

  // /v1/3d_secure - post
  public function createThreeDsecure($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->threeDSecure->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/3d_secure/{three_d_secure} - get
  public function retrieveThreeDsecure($options) {
    option_require($options, 'three_d_secure');
    $options = $this->app->parseObject($options);
    return $this->stripe->threeDSecure->retrieve(three_d_secure)->toArray();
  }

  // /v1/account_links - post
  public function createAccountLink($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->accountLinks->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts - get
  public function listAccounts($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts - post
  public function createAccount($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account} - delete
  public function deleteAccount($options) {
    option_require($options, 'account');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->delete(account)->toArray();
  }

  // /v1/accounts/{account} - get
  public function retrieveAccount($options) {
    option_require($options, 'account');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->retrieve(account)->toArray();
  }

  // /v1/accounts/{account} - post
  public function updateAccount($options) {
    option_require($options, 'account');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->update(account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/bank_accounts/{id} - delete
  public function deleteAccountBankAccount($options) {
    option_require($options, 'account');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->deleteBankAccount(account, id)->toArray();
  }

  // /v1/accounts/{account}/bank_accounts/{id} - get
  public function retrieveAccountBankAccount($options) {
    option_require($options, 'account');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->retrieveBankAccount(account, id)->toArray();
  }

  // /v1/accounts/{account}/bank_accounts/{id} - post
  public function updateAccountBankAccount($options) {
    option_require($options, 'account');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->updateBankAccount(account, id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/capabilities - get
  public function listAccountsCapabilities($options) {
    option_require($options, 'account');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->listCapabilities(account)->toArray();
  }

  // /v1/accounts/{account}/capabilities/{capability} - get
  public function retrieveAccountCapabilitie($options) {
    option_require($options, 'account');
    option_require($options, 'capability');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->retrieveCapabilitie(account, capability)->toArray();
  }

  // /v1/accounts/{account}/capabilities/{capability} - post
  public function updateAccountCapabilitie($options) {
    option_require($options, 'account');
    option_require($options, 'capability');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->updateCapabilitie(account, capability, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/external_accounts - get
  public function listAccountsExternalAccounts($options) {
    option_require($options, 'account');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->listExternalAccounts(account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/external_accounts/{id} - delete
  public function deleteAccountExternalAccount($options) {
    option_require($options, 'account');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->deleteExternalAccount(account, id)->toArray();
  }

  // /v1/accounts/{account}/external_accounts/{id} - get
  public function retrieveAccountExternalAccount($options) {
    option_require($options, 'account');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->retrieveExternalAccount(account, id)->toArray();
  }

  // /v1/accounts/{account}/external_accounts/{id} - post
  public function updateAccountExternalAccount($options) {
    option_require($options, 'account');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->updateExternalAccount(account, id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/people - get
  public function listAccountsPeople($options) {
    option_require($options, 'account');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->listPeople(account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/people/{person} - delete
  public function deleteAccountPerson($options) {
    option_require($options, 'account');
    option_require($options, 'person');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->deletePerson(account, person)->toArray();
  }

  // /v1/accounts/{account}/people/{person} - get
  public function retrieveAccountPerson($options) {
    option_require($options, 'account');
    option_require($options, 'person');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->retrievePerson(account, person)->toArray();
  }

  // /v1/accounts/{account}/people/{person} - post
  public function updateAccountPerson($options) {
    option_require($options, 'account');
    option_require($options, 'person');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->updatePerson(account, person, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/persons - get
  public function listAccountsPersons($options) {
    option_require($options, 'account');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->listPersons(account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/reject - post
  public function rejectAccount($options) {
    option_require($options, 'account');
    $options = $this->app->parseObject($options);
    return $this->stripe->accounts->reject(account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/apple_pay/domains - get
  public function listApplePayDomains($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->applePay->domains->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/apple_pay/domains - post
  public function createApplePayDomain($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->applePay->domains->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/apple_pay/domains/{domain} - delete
  public function deleteApplePayDomain($options) {
    option_require($options, 'domain');
    $options = $this->app->parseObject($options);
    return $this->stripe->applePay->domains->delete(domain)->toArray();
  }

  // /v1/apple_pay/domains/{domain} - get
  public function retrieveApplePayDomain($options) {
    option_require($options, 'domain');
    $options = $this->app->parseObject($options);
    return $this->stripe->applePay->domains->retrieve(domain)->toArray();
  }

  // /v1/application_fees - get
  public function listApplicationFees($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->applicationFees->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/application_fees/{fee}/refunds/{id} - get
  public function retrieveApplicationFeeRefund($options) {
    option_require($options, 'fee');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->applicationFees->retrieveRefund(fee, id)->toArray();
  }

  // /v1/application_fees/{fee}/refunds/{id} - post
  public function updateApplicationFeeRefund($options) {
    option_require($options, 'fee');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->applicationFees->updateRefund(fee, id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/application_fees/{id} - get
  public function retrieveApplicationFee($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->applicationFees->retrieve(id)->toArray();
  }

  // /v1/application_fees/{id}/refund - post
  public function refundApplicationFee($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->applicationFees->refund(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/application_fees/{id}/refunds - get
  public function listApplicationFeesRefunds($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->applicationFees->listRefunds(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/balance - get
  public function retrieveBalance($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->balance->retrieve()->toArray();
  }

  // /v1/balance/history - get
  public function listBalanceHistory($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->balance->history->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/balance/history/{id} - get
  public function retrieveBalanceHistory($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->balance->history->retrieve(id)->toArray();
  }

  // /v1/balance_transactions - get
  public function listBalanceTransactions($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->balanceTransactions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/balance_transactions/{id} - get
  public function retrieveBalanceTransaction($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->balanceTransactions->retrieve(id)->toArray();
  }

  // /v1/billing_portal/configurations - get
  public function listBillingPortalConfigurations($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->billingPortal->configurations->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/billing_portal/configurations - post
  public function createBillingPortalConfiguration($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->billingPortal->configurations->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/billing_portal/configurations/{configuration} - get
  public function retrieveBillingPortalConfiguration($options) {
    option_require($options, 'configuration');
    $options = $this->app->parseObject($options);
    return $this->stripe->billingPortal->configurations->retrieve(configuration)->toArray();
  }

  // /v1/billing_portal/configurations/{configuration} - post
  public function updateBillingPortalConfiguration($options) {
    option_require($options, 'configuration');
    $options = $this->app->parseObject($options);
    return $this->stripe->billingPortal->configurations->update(configuration, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/billing_portal/sessions - post
  public function createBillingPortalSession($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->billingPortal->sessions->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/bitcoin/receivers - get
  public function listBitcoinReceivers($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->bitcoin->receivers->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/bitcoin/receivers/{id} - get
  public function retrieveBitcoinReceiver($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->bitcoin->receivers->retrieve(id)->toArray();
  }

  // /v1/bitcoin/receivers/{receiver}/transactions - get
  public function listBitcoinReceiversTransactions($options) {
    option_require($options, 'receiver');
    $options = $this->app->parseObject($options);
    return $this->stripe->bitcoin->receivers->listTransactions(receiver, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/bitcoin/transactions - get
  public function listBitcoinTransactions($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->bitcoin->transactions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges - get
  public function listCharges($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges - post
  public function createCharge($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge} - get
  public function retrieveCharge($options) {
    option_require($options, 'charge');
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->retrieve(charge)->toArray();
  }

  // /v1/charges/{charge} - post
  public function updateCharge($options) {
    option_require($options, 'charge');
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->update(charge, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge}/capture - post
  public function captureCharge($options) {
    option_require($options, 'charge');
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->capture(charge, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge}/dispute/close - post
  public function updateChargeDispute($options) {
    option_require($options, 'charge');
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->updateDispute(charge, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge}/refund - post
  public function refundCharge($options) {
    option_require($options, 'charge');
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->refund(charge, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge}/refunds - get
  public function listChargesRefunds($options) {
    option_require($options, 'charge');
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->listRefunds(charge, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge}/refunds/{refund} - get
  public function retrieveChargeRefund($options) {
    option_require($options, 'charge');
    option_require($options, 'refund');
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->retrieveRefund(charge, refund)->toArray();
  }

  // /v1/charges/{charge}/refunds/{refund} - post
  public function updateChargeRefund($options) {
    option_require($options, 'charge');
    option_require($options, 'refund');
    $options = $this->app->parseObject($options);
    return $this->stripe->charges->updateRefund(charge, refund, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/checkout/sessions - get
  public function listCheckoutSessions($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->checkout->sessions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/checkout/sessions - post
  public function createCheckoutSession($options) {
  if ($options && isset($options->lineItemsType)) {
    unset($options->lineItemsType);
  }

    $options = $this->app->parseObject($options);
    return $this->stripe->checkout->sessions->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/checkout/sessions/{session} - get
  public function retrieveCheckoutSession($options) {
    option_require($options, 'session');
    $options = $this->app->parseObject($options);
    return $this->stripe->checkout->sessions->retrieve(session)->toArray();
  }

  // /v1/checkout/sessions/{session}/line_items - get
  public function listCheckoutSessionsLineItems($options) {
    option_require($options, 'session');
    $options = $this->app->parseObject($options);
    return $this->stripe->checkout->sessions->listLineItems(session, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/country_specs - get
  public function listCountrySpecs($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->countrySpecs->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/country_specs/{country} - get
  public function retrieveCountrySpec($options) {
    option_require($options, 'country');
    $options = $this->app->parseObject($options);
    return $this->stripe->countrySpecs->retrieve(country)->toArray();
  }

  // /v1/coupons - get
  public function listCoupons($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->coupons->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/coupons - post
  public function createCoupon($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->coupons->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/coupons/{coupon} - delete
  public function deleteCoupon($options) {
    option_require($options, 'coupon');
    $options = $this->app->parseObject($options);
    return $this->stripe->coupons->delete(coupon)->toArray();
  }

  // /v1/coupons/{coupon} - get
  public function retrieveCoupon($options) {
    option_require($options, 'coupon');
    $options = $this->app->parseObject($options);
    return $this->stripe->coupons->retrieve(coupon)->toArray();
  }

  // /v1/coupons/{coupon} - post
  public function updateCoupon($options) {
    option_require($options, 'coupon');
    $options = $this->app->parseObject($options);
    return $this->stripe->coupons->update(coupon, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes - get
  public function listCreditNotes($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->creditNotes->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes - post
  public function createCreditNote($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->creditNotes->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/preview - get
  public function retrieveCreditNotesPreview($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->creditNotes->preview->retrieve(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/preview/lines - get
  public function listCreditNotesPreviewLines($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->creditNotes->preview->lines->all(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/{credit_note}/lines - get
  public function listCreditNotesLines($options) {
    option_require($options, 'credit_note');
    $options = $this->app->parseObject($options);
    return $this->stripe->creditNotes->listLines(credit_note, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/{id} - get
  public function retrieveCreditNote($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->creditNotes->retrieve(id)->toArray();
  }

  // /v1/credit_notes/{id} - post
  public function updateCreditNote($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->creditNotes->update(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/{id}/void - post
  public function voidCreditNote($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->creditNotes->void(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers - get
  public function listCustomers($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers - post
  public function createCustomer($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer} - delete
  public function deleteCustomer($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->delete(customer)->toArray();
  }

  // /v1/customers/{customer} - get
  public function retrieveCustomer($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->retrieve(customer)->toArray();
  }

  // /v1/customers/{customer} - post
  public function updateCustomer($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->update(customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/balance_transactions - get
  public function listCustomersBalanceTransactions($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->listBalanceTransactions(customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/balance_transactions/{transaction} - get
  public function retrieveCustomerBalanceTransaction($options) {
    option_require($options, 'customer');
    option_require($options, 'transaction');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->retrieveBalanceTransaction(customer, transaction)->toArray();
  }

  // /v1/customers/{customer}/balance_transactions/{transaction} - post
  public function updateCustomerBalanceTransaction($options) {
    option_require($options, 'customer');
    option_require($options, 'transaction');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->updateBalanceTransaction(customer, transaction, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/bank_accounts - get
  public function listCustomersBankAccounts($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->listBankAccounts(customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/bank_accounts/{id} - delete
  public function deleteCustomerBankAccount($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->deleteBankAccount(customer, id)->toArray();
  }

  // /v1/customers/{customer}/bank_accounts/{id} - get
  public function retrieveCustomerBankAccount($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->retrieveBankAccount(customer, id)->toArray();
  }

  // /v1/customers/{customer}/bank_accounts/{id} - post
  public function updateCustomerBankAccount($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->updateBankAccount(customer, id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/cards - get
  public function listCustomersCards($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->listCards(customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/cards/{id} - delete
  public function deleteCustomerCard($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->deleteCard(customer, id)->toArray();
  }

  // /v1/customers/{customer}/cards/{id} - get
  public function retrieveCustomerCard($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->retrieveCard(customer, id)->toArray();
  }

  // /v1/customers/{customer}/cards/{id} - post
  public function updateCustomerCard($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->updateCard(customer, id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/sources - get
  public function listCustomersSources($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->listSources(customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/sources/{id} - delete
  public function deleteCustomerSource($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->deleteSource(customer, id)->toArray();
  }

  // /v1/customers/{customer}/sources/{id} - get
  public function retrieveCustomerSource($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->retrieveSource(customer, id)->toArray();
  }

  // /v1/customers/{customer}/sources/{id} - post
  public function updateCustomerSource($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->updateSource(customer, id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/subscriptions - get
  public function listCustomersSubscriptions($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->listSubscriptions(customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/subscriptions/{subscription_exposed_id} - delete
  public function deleteCustomerSubscription($options) {
    option_require($options, 'customer');
    option_require($options, 'subscription_exposed_id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->deleteSubscription(customer, subscription_exposed_id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/subscriptions/{subscription_exposed_id} - get
  public function retrieveCustomerSubscription($options) {
    option_require($options, 'customer');
    option_require($options, 'subscription_exposed_id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->retrieveSubscription(customer, subscription_exposed_id)->toArray();
  }

  // /v1/customers/{customer}/subscriptions/{subscription_exposed_id} - post
  public function updateCustomerSubscription($options) {
    option_require($options, 'customer');
    option_require($options, 'subscription_exposed_id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->updateSubscription(customer, subscription_exposed_id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/tax_ids - get
  public function listCustomersTaxIds($options) {
    option_require($options, 'customer');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->listTaxIds(customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/tax_ids/{id} - delete
  public function deleteCustomerTax($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->deleteTaxId(customer, id)->toArray();
  }

  // /v1/customers/{customer}/tax_ids/{id} - get
  public function retrieveCustomerTax($options) {
    option_require($options, 'customer');
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->customers->retrieveTaxId(customer, id)->toArray();
  }

  // /v1/disputes - get
  public function listDisputes($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->disputes->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/disputes/{dispute} - get
  public function retrieveDispute($options) {
    option_require($options, 'dispute');
    $options = $this->app->parseObject($options);
    return $this->stripe->disputes->retrieve(dispute)->toArray();
  }

  // /v1/disputes/{dispute} - post
  public function updateDispute($options) {
    option_require($options, 'dispute');
    $options = $this->app->parseObject($options);
    return $this->stripe->disputes->update(dispute, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/disputes/{dispute}/close - post
  public function closeDispute($options) {
    option_require($options, 'dispute');
    $options = $this->app->parseObject($options);
    return $this->stripe->disputes->close(dispute, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/ephemeral_keys - post
  public function createEphemeralKey($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->ephemeralKeys->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/ephemeral_keys/{key} - delete
  public function deleteEphemeralKey($options) {
    option_require($options, 'key');
    $options = $this->app->parseObject($options);
    return $this->stripe->ephemeralKeys->delete(key)->toArray();
  }

  // /v1/events - get
  public function listEvents($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->events->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/events/{id} - get
  public function retrieveEvent($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->events->retrieve(id)->toArray();
  }

  // /v1/exchange_rates - get
  public function listExchangeRates($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->exchangeRates->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/exchange_rates/{rate_id} - get
  public function retrieveExchangeRate($options) {
    option_require($options, 'rate_id');
    $options = $this->app->parseObject($options);
    return $this->stripe->exchangeRates->retrieve(rate_id)->toArray();
  }

  // /v1/file_links - get
  public function listFileLinks($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->fileLinks->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/file_links - post
  public function createFileLink($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->fileLinks->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/file_links/{link} - get
  public function retrieveFileLink($options) {
    option_require($options, 'link');
    $options = $this->app->parseObject($options);
    return $this->stripe->fileLinks->retrieve(link)->toArray();
  }

  // /v1/file_links/{link} - post
  public function updateFileLink($options) {
    option_require($options, 'link');
    $options = $this->app->parseObject($options);
    return $this->stripe->fileLinks->update(link, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/files - get
  public function listFiles($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->files->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/files - post
  public function createFile($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->files->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/files/{file} - get
  public function retrieveFile($options) {
    option_require($options, 'file');
    $options = $this->app->parseObject($options);
    return $this->stripe->files->retrieve(file)->toArray();
  }

  // /v1/invoiceitems - get
  public function listInvoiceitems($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->invoiceitems->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoiceitems - post
  public function createInvoiceitem($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->invoiceitems->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoiceitems/{invoiceitem} - delete
  public function deleteInvoiceitem($options) {
    option_require($options, 'invoiceitem');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoiceitems->delete(invoiceitem)->toArray();
  }

  // /v1/invoiceitems/{invoiceitem} - get
  public function retrieveInvoiceitem($options) {
    option_require($options, 'invoiceitem');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoiceitems->retrieve(invoiceitem)->toArray();
  }

  // /v1/invoiceitems/{invoiceitem} - post
  public function updateInvoiceitem($options) {
    option_require($options, 'invoiceitem');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoiceitems->update(invoiceitem, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices - get
  public function listInvoices($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices - post
  public function createInvoice($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/upcoming - get
  public function retrieveInvoicesUpcoming($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->upcoming->retrieve(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/upcoming/lines - get
  public function listInvoicesUpcomingLines($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->upcoming->lines->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice} - delete
  public function deleteInvoice($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->delete(invoice)->toArray();
  }

  // /v1/invoices/{invoice} - get
  public function retrieveInvoice($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->retrieve(invoice)->toArray();
  }

  // /v1/invoices/{invoice} - post
  public function updateInvoice($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->update(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/finalize - post
  public function finalizeInvoice($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->finalize(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/lines - get
  public function listInvoicesLines($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->listLines(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/mark_uncollectible - post
  public function markUncollectibleInvoice($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->markUncollectible(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/pay - post
  public function payInvoice($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->pay(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/send - post
  public function sendInvoice($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->send(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/void - post
  public function voidInvoice($options) {
    option_require($options, 'invoice');
    $options = $this->app->parseObject($options);
    return $this->stripe->invoices->void(invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuer_fraud_records - get
  public function listIssuerFraudRecords($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuerFraudRecords->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuer_fraud_records/{issuer_fraud_record} - get
  public function retrieveIssuerFraudRecord($options) {
    option_require($options, 'issuer_fraud_record');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuerFraudRecords->retrieve(issuer_fraud_record)->toArray();
  }

  // /v1/issuing/authorizations - get
  public function listIssuingAuthorizations($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->authorizations->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/authorizations/{authorization} - get
  public function retrieveIssuingAuthorization($options) {
    option_require($options, 'authorization');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->authorizations->retrieve(authorization)->toArray();
  }

  // /v1/issuing/authorizations/{authorization} - post
  public function updateIssuingAuthorization($options) {
    option_require($options, 'authorization');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->authorizations->update(authorization, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/authorizations/{authorization}/approve - post
  public function approveIssuingAuthorization($options) {
    option_require($options, 'authorization');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->authorizations->approve(authorization, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/authorizations/{authorization}/decline - post
  public function declineIssuingAuthorization($options) {
    option_require($options, 'authorization');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->authorizations->decline(authorization, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cardholders - get
  public function listIssuingCardholders($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->cardholders->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cardholders - post
  public function createIssuingCardholder($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->cardholders->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cardholders/{cardholder} - get
  public function retrieveIssuingCardholder($options) {
    option_require($options, 'cardholder');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->cardholders->retrieve(cardholder)->toArray();
  }

  // /v1/issuing/cardholders/{cardholder} - post
  public function updateIssuingCardholder($options) {
    option_require($options, 'cardholder');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->cardholders->update(cardholder, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cards - get
  public function listIssuingCards($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->cards->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cards - post
  public function createIssuingCard($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->cards->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cards/{card} - get
  public function retrieveIssuingCard($options) {
    option_require($options, 'card');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->cards->retrieve(card)->toArray();
  }

  // /v1/issuing/cards/{card} - post
  public function updateIssuingCard($options) {
    option_require($options, 'card');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->cards->update(card, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/disputes - get
  public function listIssuingDisputes($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->disputes->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/disputes - post
  public function createIssuingDispute($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->disputes->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/disputes/{dispute} - get
  public function retrieveIssuingDispute($options) {
    option_require($options, 'dispute');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->disputes->retrieve(dispute)->toArray();
  }

  // /v1/issuing/disputes/{dispute} - post
  public function updateIssuingDispute($options) {
    option_require($options, 'dispute');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->disputes->update(dispute, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/disputes/{dispute}/submit - post
  public function submitIssuingDispute($options) {
    option_require($options, 'dispute');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->disputes->submit(dispute, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/settlements - get
  public function listIssuingSettlements($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->settlements->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/settlements/{settlement} - get
  public function retrieveIssuingSettlement($options) {
    option_require($options, 'settlement');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->settlements->retrieve(settlement)->toArray();
  }

  // /v1/issuing/settlements/{settlement} - post
  public function updateIssuingSettlement($options) {
    option_require($options, 'settlement');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->settlements->update(settlement, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/transactions - get
  public function listIssuingTransactions($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->transactions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/transactions/{transaction} - get
  public function retrieveIssuingTransaction($options) {
    option_require($options, 'transaction');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->transactions->retrieve(transaction)->toArray();
  }

  // /v1/issuing/transactions/{transaction} - post
  public function updateIssuingTransaction($options) {
    option_require($options, 'transaction');
    $options = $this->app->parseObject($options);
    return $this->stripe->issuing->transactions->update(transaction, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/mandates/{mandate} - get
  public function retrieveMandate($options) {
    option_require($options, 'mandate');
    $options = $this->app->parseObject($options);
    return $this->stripe->mandates->retrieve(mandate)->toArray();
  }

  // /v1/order_returns - get
  public function listOrderReturns($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->orderReturns->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/order_returns/{id} - get
  public function retrieveOrderReturn($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->orderReturns->retrieve(id)->toArray();
  }

  // /v1/orders - get
  public function listOrders($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->orders->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/orders - post
  public function createOrder($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->orders->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/orders/{id} - get
  public function retrieveOrder($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->orders->retrieve(id)->toArray();
  }

  // /v1/orders/{id} - post
  public function updateOrder($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->orders->update(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/orders/{id}/pay - post
  public function payOrder($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->orders->pay(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents - get
  public function listPaymentIntents($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentIntents->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents - post
  public function createPaymentIntent($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentIntents->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent} - get
  public function retrievePaymentIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentIntents->retrieve(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent} - post
  public function updatePaymentIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentIntents->update(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent}/cancel - post
  public function cancelPaymentIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentIntents->cancel(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent}/capture - post
  public function capturePaymentIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentIntents->capture(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent}/confirm - post
  public function confirmPaymentIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentIntents->confirm(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods - get
  public function listPaymentMethods($options) {
    option_require($options, 'customer');
    option_require($options, 'type');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentMethods->all(customer, type, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods - post
  public function createPaymentMethod($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentMethods->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods/{payment_method} - get
  public function retrievePaymentMethod($options) {
    option_require($options, 'payment_method');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentMethods->retrieve(payment_method)->toArray();
  }

  // /v1/payment_methods/{payment_method} - post
  public function updatePaymentMethod($options) {
    option_require($options, 'payment_method');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentMethods->update(payment_method, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods/{payment_method}/attach - post
  public function attachPaymentMethod($options) {
    option_require($options, 'payment_method');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentMethods->attach(payment_method, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods/{payment_method}/detach - post
  public function detachPaymentMethod($options) {
    option_require($options, 'payment_method');
    $options = $this->app->parseObject($options);
    return $this->stripe->paymentMethods->detach(payment_method, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts - get
  public function listPayouts($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->payouts->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts - post
  public function createPayout($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->payouts->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts/{payout} - get
  public function retrievePayout($options) {
    option_require($options, 'payout');
    $options = $this->app->parseObject($options);
    return $this->stripe->payouts->retrieve(payout)->toArray();
  }

  // /v1/payouts/{payout} - post
  public function updatePayout($options) {
    option_require($options, 'payout');
    $options = $this->app->parseObject($options);
    return $this->stripe->payouts->update(payout, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts/{payout}/cancel - post
  public function cancelPayout($options) {
    option_require($options, 'payout');
    $options = $this->app->parseObject($options);
    return $this->stripe->payouts->cancel(payout, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts/{payout}/reverse - post
  public function reversePayout($options) {
    option_require($options, 'payout');
    $options = $this->app->parseObject($options);
    return $this->stripe->payouts->reverse(payout, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/plans - get
  public function listPlans($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->plans->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/plans - post
  public function createPlan($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->plans->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/plans/{plan} - delete
  public function deletePlan($options) {
    option_require($options, 'plan');
    $options = $this->app->parseObject($options);
    return $this->stripe->plans->delete(plan)->toArray();
  }

  // /v1/plans/{plan} - get
  public function retrievePlan($options) {
    option_require($options, 'plan');
    $options = $this->app->parseObject($options);
    return $this->stripe->plans->retrieve(plan)->toArray();
  }

  // /v1/plans/{plan} - post
  public function updatePlan($options) {
    option_require($options, 'plan');
    $options = $this->app->parseObject($options);
    return $this->stripe->plans->update(plan, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/prices - get
  public function listPrices($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->prices->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/prices - post
  public function createPrice($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->prices->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/prices/{price} - get
  public function retrievePrice($options) {
    option_require($options, 'price');
    $options = $this->app->parseObject($options);
    return $this->stripe->prices->retrieve(price)->toArray();
  }

  // /v1/prices/{price} - post
  public function updatePrice($options) {
    option_require($options, 'price');
    $options = $this->app->parseObject($options);
    return $this->stripe->prices->update(price, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/products - get
  public function listProducts($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->products->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/products - post
  public function createProduct($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->products->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/products/{id} - delete
  public function deleteProduct($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->products->delete(id)->toArray();
  }

  // /v1/products/{id} - get
  public function retrieveProduct($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->products->retrieve(id)->toArray();
  }

  // /v1/products/{id} - post
  public function updateProduct($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->products->update(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/promotion_codes - get
  public function listPromotionCodes($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->promotionCodes->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/promotion_codes - post
  public function createPromotionCode($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->promotionCodes->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/promotion_codes/{promotion_code} - get
  public function retrievePromotionCode($options) {
    option_require($options, 'promotion_code');
    $options = $this->app->parseObject($options);
    return $this->stripe->promotionCodes->retrieve(promotion_code)->toArray();
  }

  // /v1/promotion_codes/{promotion_code} - post
  public function updatePromotionCode($options) {
    option_require($options, 'promotion_code');
    $options = $this->app->parseObject($options);
    return $this->stripe->promotionCodes->update(promotion_code, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/early_fraud_warnings - get
  public function listRadarEarlyFraudWarnings($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->earlyFraudWarnings->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/early_fraud_warnings/{early_fraud_warning} - get
  public function retrieveRadarEarlyFraudWarning($options) {
    option_require($options, 'early_fraud_warning');
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->earlyFraudWarnings->retrieve(early_fraud_warning)->toArray();
  }

  // /v1/radar/value_list_items - get
  public function listRadarValueListItems($options) {
    option_require($options, 'value_list');
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueListItems->all(value_list, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/value_list_items - post
  public function createRadarValueListItem($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueListItems->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/value_list_items/{item} - delete
  public function deleteRadarValueListItem($options) {
    option_require($options, 'item');
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueListItems->delete(item)->toArray();
  }

  // /v1/radar/value_list_items/{item} - get
  public function retrieveRadarValueListItem($options) {
    option_require($options, 'item');
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueListItems->retrieve(item)->toArray();
  }

  // /v1/radar/value_lists - get
  public function listRadarValueLists($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueLists->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/value_lists - post
  public function createRadarValueList($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueLists->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/value_lists/{value_list} - delete
  public function deleteRadarValueList($options) {
    option_require($options, 'value_list');
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueLists->delete(value_list)->toArray();
  }

  // /v1/radar/value_lists/{value_list} - get
  public function retrieveRadarValueList($options) {
    option_require($options, 'value_list');
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueLists->retrieve(value_list)->toArray();
  }

  // /v1/radar/value_lists/{value_list} - post
  public function updateRadarValueList($options) {
    option_require($options, 'value_list');
    $options = $this->app->parseObject($options);
    return $this->stripe->radar->valueLists->update(value_list, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/recipients - get
  public function listRecipients($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->recipients->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/recipients - post
  public function createRecipient($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->recipients->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/recipients/{id} - delete
  public function deleteRecipient($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->recipients->delete(id)->toArray();
  }

  // /v1/recipients/{id} - get
  public function retrieveRecipient($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->recipients->retrieve(id)->toArray();
  }

  // /v1/recipients/{id} - post
  public function updateRecipient($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->recipients->update(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/refunds - get
  public function listRefunds($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->refunds->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/refunds - post
  public function createRefund($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->refunds->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/refunds/{refund} - get
  public function retrieveRefund($options) {
    option_require($options, 'refund');
    $options = $this->app->parseObject($options);
    return $this->stripe->refunds->retrieve(refund)->toArray();
  }

  // /v1/refunds/{refund} - post
  public function updateRefund($options) {
    option_require($options, 'refund');
    $options = $this->app->parseObject($options);
    return $this->stripe->refunds->update(refund, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/reporting/report_runs - get
  public function listReportingReportRuns($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->reporting->reportRuns->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/reporting/report_runs - post
  public function createReportingReportRun($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->reporting->reportRuns->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/reporting/report_runs/{report_run} - get
  public function retrieveReportingReportRun($options) {
    option_require($options, 'report_run');
    $options = $this->app->parseObject($options);
    return $this->stripe->reporting->reportRuns->retrieve(report_run)->toArray();
  }

  // /v1/reporting/report_types - get
  public function listReportingReportTypes($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->reporting->reportTypes->all()->toArray();
  }

  // /v1/reporting/report_types/{report_type} - get
  public function retrieveReportingReportType($options) {
    option_require($options, 'report_type');
    $options = $this->app->parseObject($options);
    return $this->stripe->reporting->reportTypes->retrieve(report_type)->toArray();
  }

  // /v1/reviews - get
  public function listReviews($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->reviews->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/reviews/{review} - get
  public function retrieveReview($options) {
    option_require($options, 'review');
    $options = $this->app->parseObject($options);
    return $this->stripe->reviews->retrieve(review)->toArray();
  }

  // /v1/reviews/{review}/approve - post
  public function approveReview($options) {
    option_require($options, 'review');
    $options = $this->app->parseObject($options);
    return $this->stripe->reviews->approve(review, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_attempts - get
  public function listSetupAttempts($options) {
    option_require($options, 'setup_intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->setupAttempts->all(setup_intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents - get
  public function listSetupIntents($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->setupIntents->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents - post
  public function createSetupIntent($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->setupIntents->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents/{intent} - get
  public function retrieveSetupIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->setupIntents->retrieve(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents/{intent} - post
  public function updateSetupIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->setupIntents->update(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents/{intent}/cancel - post
  public function cancelSetupIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->setupIntents->cancel(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents/{intent}/confirm - post
  public function confirmSetupIntent($options) {
    option_require($options, 'intent');
    $options = $this->app->parseObject($options);
    return $this->stripe->setupIntents->confirm(intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sigma/scheduled_query_runs - get
  public function listSigmaScheduledQueryRuns($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->sigma->scheduledQueryRuns->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sigma/scheduled_query_runs/{scheduled_query_run} - get
  public function retrieveSigmaScheduledQueryRun($options) {
    option_require($options, 'scheduled_query_run');
    $options = $this->app->parseObject($options);
    return $this->stripe->sigma->scheduledQueryRuns->retrieve(scheduled_query_run)->toArray();
  }

  // /v1/skus - get
  public function listSkus($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->skus->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/skus - post
  public function createSku($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->skus->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/skus/{id} - delete
  public function deleteSku($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->skus->delete(id)->toArray();
  }

  // /v1/skus/{id} - get
  public function retrieveSku($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->skus->retrieve(id)->toArray();
  }

  // /v1/skus/{id} - post
  public function updateSku($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->skus->update(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources - post
  public function createSource($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->sources->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources/{source} - get
  public function retrieveSource($options) {
    option_require($options, 'source');
    $options = $this->app->parseObject($options);
    return $this->stripe->sources->retrieve(source, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources/{source} - post
  public function updateSource($options) {
    option_require($options, 'source');
    $options = $this->app->parseObject($options);
    return $this->stripe->sources->update(source, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources/{source}/mandate_notifications/{mandate_notification} - get
  public function retrieveSourceMandateNotification($options) {
    option_require($options, 'mandate_notification');
    option_require($options, 'source');
    $options = $this->app->parseObject($options);
    return $this->stripe->sources->retrieveMandateNotification(mandate_notification, source)->toArray();
  }

  // /v1/sources/{source}/source_transactions - get
  public function listSourcesSourceTransactions($options) {
    option_require($options, 'source');
    $options = $this->app->parseObject($options);
    return $this->stripe->sources->listSourceTransactions(source, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources/{source}/source_transactions/{source_transaction} - get
  public function retrieveSourceSourceTransaction($options) {
    option_require($options, 'source');
    option_require($options, 'source_transaction');
    $options = $this->app->parseObject($options);
    return $this->stripe->sources->retrieveSourceTransaction(source, source_transaction)->toArray();
  }

  // /v1/sources/{source}/verify - post
  public function verifySource($options) {
    option_require($options, 'source');
    $options = $this->app->parseObject($options);
    return $this->stripe->sources->verify(source, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items - get
  public function listSubscriptionItems($options) {
    option_require($options, 'subscription');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionItems->all(subscription, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items - post
  public function createSubscriptionItem($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionItems->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items/{item} - delete
  public function deleteSubscriptionItem($options) {
    option_require($options, 'item');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionItems->delete(item, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items/{item} - get
  public function retrieveSubscriptionItem($options) {
    option_require($options, 'item');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionItems->retrieve(item)->toArray();
  }

  // /v1/subscription_items/{item} - post
  public function updateSubscriptionItem($options) {
    option_require($options, 'item');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionItems->update(item, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items/{subscription_item}/usage_record_summaries - get
  public function listSubscriptionItemsUsageRecordSummaries($options) {
    option_require($options, 'subscription_item');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionItems->listUsageRecordSummaries(subscription_item, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules - get
  public function listSubscriptionSchedules($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionSchedules->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules - post
  public function createSubscriptionSchedule($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionSchedules->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules/{schedule} - get
  public function retrieveSubscriptionSchedule($options) {
    option_require($options, 'schedule');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionSchedules->retrieve(schedule)->toArray();
  }

  // /v1/subscription_schedules/{schedule} - post
  public function updateSubscriptionSchedule($options) {
    option_require($options, 'schedule');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionSchedules->update(schedule, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules/{schedule}/cancel - post
  public function cancelSubscriptionSchedule($options) {
    option_require($options, 'schedule');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionSchedules->cancel(schedule, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules/{schedule}/release - post
  public function releaseSubscriptionSchedule($options) {
    option_require($options, 'schedule');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptionSchedules->release(schedule, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions - get
  public function listSubscriptions($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions - post
  public function createSubscription($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptions->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions/{subscription_exposed_id} - delete
  public function deleteSubscription($options) {
    option_require($options, 'subscription_exposed_id');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptions->delete(subscription_exposed_id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions/{subscription_exposed_id} - get
  public function retrieveSubscription($options) {
    option_require($options, 'subscription_exposed_id');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptions->retrieve(subscription_exposed_id)->toArray();
  }

  // /v1/subscriptions/{subscription_exposed_id} - post
  public function updateSubscription($options) {
    option_require($options, 'subscription_exposed_id');
    $options = $this->app->parseObject($options);
    return $this->stripe->subscriptions->update(subscription_exposed_id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tax_rates - get
  public function listTaxRates($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->taxRates->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tax_rates - post
  public function createTaxRate($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->taxRates->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tax_rates/{tax_rate} - get
  public function retrieveTaxRate($options) {
    option_require($options, 'tax_rate');
    $options = $this->app->parseObject($options);
    return $this->stripe->taxRates->retrieve(tax_rate)->toArray();
  }

  // /v1/tax_rates/{tax_rate} - post
  public function updateTaxRate($options) {
    option_require($options, 'tax_rate');
    $options = $this->app->parseObject($options);
    return $this->stripe->taxRates->update(tax_rate, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/connection_tokens - post
  public function createTerminalConnectionToken($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->connectionTokens->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/locations - get
  public function listTerminalLocations($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->locations->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/locations - post
  public function createTerminalLocation($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->locations->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/locations/{location} - delete
  public function deleteTerminalLocation($options) {
    option_require($options, 'location');
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->locations->delete(location)->toArray();
  }

  // /v1/terminal/locations/{location} - get
  public function retrieveTerminalLocation($options) {
    option_require($options, 'location');
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->locations->retrieve(location)->toArray();
  }

  // /v1/terminal/locations/{location} - post
  public function updateTerminalLocation($options) {
    option_require($options, 'location');
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->locations->update(location, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/readers - get
  public function listTerminalReaders($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->readers->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/readers - post
  public function createTerminalReader($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->readers->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/readers/{reader} - delete
  public function deleteTerminalReader($options) {
    option_require($options, 'reader');
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->readers->delete(reader)->toArray();
  }

  // /v1/terminal/readers/{reader} - get
  public function retrieveTerminalReader($options) {
    option_require($options, 'reader');
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->readers->retrieve(reader)->toArray();
  }

  // /v1/terminal/readers/{reader} - post
  public function updateTerminalReader($options) {
    option_require($options, 'reader');
    $options = $this->app->parseObject($options);
    return $this->stripe->terminal->readers->update(reader, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tokens - post
  public function createToken($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->tokens->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tokens/{token} - get
  public function retrieveToken($options) {
    option_require($options, 'token');
    $options = $this->app->parseObject($options);
    return $this->stripe->tokens->retrieve(token)->toArray();
  }

  // /v1/topups - get
  public function listTopups($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->topups->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/topups - post
  public function createTopup($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->topups->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/topups/{topup} - get
  public function retrieveTopup($options) {
    option_require($options, 'topup');
    $options = $this->app->parseObject($options);
    return $this->stripe->topups->retrieve(topup)->toArray();
  }

  // /v1/topups/{topup} - post
  public function updateTopup($options) {
    option_require($options, 'topup');
    $options = $this->app->parseObject($options);
    return $this->stripe->topups->update(topup, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/topups/{topup}/cancel - post
  public function cancelTopup($options) {
    option_require($options, 'topup');
    $options = $this->app->parseObject($options);
    return $this->stripe->topups->cancel(topup, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers - get
  public function listTransfers($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->transfers->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers - post
  public function createTransfer($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->transfers->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers/{id}/reversals - get
  public function listTransfersReversals($options) {
    option_require($options, 'id');
    $options = $this->app->parseObject($options);
    return $this->stripe->transfers->listReversals(id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers/{transfer} - get
  public function retrieveTransfer($options) {
    option_require($options, 'transfer');
    $options = $this->app->parseObject($options);
    return $this->stripe->transfers->retrieve(transfer)->toArray();
  }

  // /v1/transfers/{transfer} - post
  public function updateTransfer($options) {
    option_require($options, 'transfer');
    $options = $this->app->parseObject($options);
    return $this->stripe->transfers->update(transfer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers/{transfer}/reversals/{id} - get
  public function retrieveTransferReversal($options) {
    option_require($options, 'id');
    option_require($options, 'transfer');
    $options = $this->app->parseObject($options);
    return $this->stripe->transfers->retrieveReversal(id, transfer)->toArray();
  }

  // /v1/transfers/{transfer}/reversals/{id} - post
  public function updateTransferReversal($options) {
    option_require($options, 'id');
    option_require($options, 'transfer');
    $options = $this->app->parseObject($options);
    return $this->stripe->transfers->updateReversal(id, transfer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/webhook_endpoints - get
  public function listWebhookEndpoints($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->webhookEndpoints->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/webhook_endpoints - post
  public function createWebhookEndpoint($options) {
    $options = $this->app->parseObject($options);
    return $this->stripe->webhookEndpoints->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/webhook_endpoints/{webhook_endpoint} - delete
  public function deleteWebhookEndpoint($options) {
    option_require($options, 'webhook_endpoint');
    $options = $this->app->parseObject($options);
    return $this->stripe->webhookEndpoints->delete(webhook_endpoint)->toArray();
  }

  // /v1/webhook_endpoints/{webhook_endpoint} - get
  public function retrieveWebhookEndpoint($options) {
    option_require($options, 'webhook_endpoint');
    $options = $this->app->parseObject($options);
    return $this->stripe->webhookEndpoints->retrieve(webhook_endpoint)->toArray();
  }

  // /v1/webhook_endpoints/{webhook_endpoint} - post
  public function updateWebhookEndpoint($options) {
    option_require($options, 'webhook_endpoint');
    $options = $this->app->parseObject($options);
    return $this->stripe->webhookEndpoints->update(webhook_endpoint, json_decode(json_encode($options), true))->toArray();
  }

}
