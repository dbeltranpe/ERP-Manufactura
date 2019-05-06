angular.module('invoicing', [])

//The default logo for the invoice
.constant('DEFAULT_LOGO', 'images/metaware_logo.png')

//The invoice displayed when the user first uses the app
.constant('DEFAULT_INVOICE', {
	tax: 13.00,
	invoice_number: 10,

	items:[

		]
})

//Service for accessing local storage
.service('LocalStorage', [function() {

	var Service = {};


	// Checks to see if an invoice is stored
	var hasInvoice = function() {
		return !(localStorage['invoice'] == '' || localStorage['invoice'] == null);
	};

	// Returns a stored invoice (false if none is stored)
	Service.getInvoice = function() {
		if (hasInvoice()) {
			return JSON.parse(localStorage['invoice']);
		} else {
			return false;
		}
	};

	Service.setInvoice = function(invoice) {
		localStorage['invoice'] = JSON.stringify(invoice);
	};

	// Clears a stored invoice
	Service.clearinvoice = function() {
		localStorage['invoice'] = '';
	};

	// Clears all local storage
	Service.clear = function() {
		localStorage['invoice'] = '';
	};

	return Service;

}])


//Main application controller
.controller('InvoiceCtrl', ['$scope', '$http', 'DEFAULT_INVOICE', 'LocalStorage',
	function($scope, $http, DEFAULT_INVOICE, LocalStorage) {

	// Set defaults
	$scope.currencySymbol = '$';
	$scope.logoRemoved = false;
	$scope.printMode   = false;

	(function init() {
		// Attempt to load invoice from local storage
		!function() {
			var invoice = LocalStorage.getInvoice();
			$scope.invoice = invoice ? invoice : DEFAULT_INVOICE;
		}();


	})()

	// Adds an item to the invoice's items
	$scope.addItem = function() {
		$scope.invoice.items.push({ qty:0, cost:0, description:"" });
	}

	// Remotes an item from the invoice
	$scope.removeItem = function(item) {
		$scope.invoice.items.splice($scope.invoice.items.indexOf(item), 1);
	};

	$scope.entregar = function(){
		alert('entro');
		
		$http.post('facturas-guardar.php', JSON.stringify($scope.invoice.items))
		.success(
				function(data){

					alert(data);

				}
		);

	};

	// Calculates the sub total of the invoice
	$scope.invoiceSubTotal = function() {
//		console.log($scope.invoice.items);
		var total = 0.00;
		angular.forEach($scope.invoice.items, function(item, key){
			total += (item.qty * item.cost);
		});
		return total;
	};

	// Calculates the tax of the invoice
	$scope.calculateTax = function() {
		return (0.19 * $scope.invoiceSubTotal());
	};

	// Calculates the grand total of the invoice
	$scope.calculateGrandTotal = function() {
		saveInvoice();
		return $scope.calculateTax() + $scope.invoiceSubTotal();
	};

	// Clears the local storage
	$scope.clearLocalStorage = function() {
		var confirmClear = confirm('Are you sure you would like to clear the invoice?');
		if(confirmClear) {
			LocalStorage.clear();
			setInvoice(DEFAULT_INVOICE);
		}
	};


	$scope.traerValor = function(pCod, pArray){
		var end = false;
		var costo = null;

		for (var i = 0; i < pArray.length && end==false; i++) 
		{
			if(costo == null && pArray[i]['codigo']==pCod)
			{
				costo = pArray[i]['valor'];
				end = true;
			}

		}

		this.item.cost = costo;
		return costo;
	};

	// Sets the current invoice to the given one
	var setInvoice = function(invoice) {
		$scope.invoice = invoice;
		saveInvoice();
	};

	// Saves the invoice in local storage
	var saveInvoice = function() {
		LocalStorage.setInvoice($scope.invoice);
	};

	// Runs on document.ready
	angular.element(document).ready(function () {

	});

}])
