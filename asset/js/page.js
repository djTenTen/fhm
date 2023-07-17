$(document).ready(function(e){
	if($('#item-management-page').exists()){
		$('#item-management-page').on("click", "tr.item", function(e){
			if(!($(e.target).is("a") || $(e.target).is("i"))){
				var item_id = $(this).attr("data-id");

				$('#item-management-page').find("table tbody tr[data-id='" + item_id + "']").toggleClass("active");
				$('#item-management-page').find("table tbody tr[data-id='" + item_id + "'] a.variation-toggle").toggleClass("shown");
			}
		});

		$('#item-management-page ol#table-action').on("click", "li", function(e){
			if($(this).attr('data-action') == 'show'){
				$('#item-management-page').find("table tbody tr").addClass("active");
				$('#item-management-page').find("table tbody tr a.variation-toggle").addClass("shown");
			} else {
				$('#item-management-page').find("table tbody tr").removeClass("active");
				$('#item-management-page').find("table tbody tr a.variation-toggle").removeClass("shown");
			}
		});
	}

	if($("#inventory-management-page").exists()){
		$("#inventory-management-page table").on("click", "button[data-type='trace-inventory']", function(){
			var id = $(this).attr("data-item-id");

			preloader("show");

			$.ajax({
				url: siteurl + "/ajax/item-history.php",
				method: "POST",
				datatype: 'json',
				data: { "id": id },
				success: function(data){
					// console.log(data);

					if(data.status == 'success'){
						html = "";

						html += '<div class="row mg-b-20">';
							html += '<div class="col-lg-2">';
								html += '<img src="' + data.item.image + '" class="d-block wd-100p mg-b-15">';
							html += '</div>';

							html += '<div class="col-lg-10">';
								html += '<table class="table table-bordered">';
									html += '<tbody>';
										html += '<tr>';
											html += '<td style="width: 25%;" colspan="1">ID</td>';
											html += '<td style="width: 75%;" colspan="3">' + data.item.id + '</td>';
										html += '</tr>';
										html += '<tr>';
											html += '<td style="width: 25%;" colspan="1">Name</td>';
											html += '<td style="width: 75%;" colspan="3">' + data.item.name + '</td>';
										html += '</tr>';
										html += '<tr>';
											html += '<td style="width: 25%;" colspan="1">Retail Price</td>';
											html += '<td style="width: 75%;" colspan="3">' + data.item.retail_price + '</td>';
										html += '</tr>';
										html += '<tr>';
											html += '<td style="width: 25%;">Total Inventory</td>';
											html += '<td style="width: 25%;">' + data.item.total_stock + '</td>';
											html += '<td style="width: 25%;">Inventory Age</td>';
											html += '<td style="width: 25%;">' + data.item.inventory_age + '</td>';
										html += '</tr>';

									html += '</tbody>';
								html += '</table>';
							html += '</div>';

							html += '<div class="col-lg-12">';
								html += '<div>';
								html += '</div>';
							html += '</div>';


							for(var x = 0; x < data.warehouse.length; x++){
								html += '<div class="col-lg-4">';
									html += '<table class="table table-bordered mg-b-10">';
										html += '<tbody>';
											html += '<tr>';
												html += '<td colspan="2" class="text-center">' + data.warehouse[x].name + '</td>';
											html += '</tr>';
											html += '<tr>';
												html += '<td style="width: 50%;">Onhand</td>';
												html += '<td style="width: 50%;">' + data.warehouse[x].total + '</td>';
											html += '</tr>';

											html += '<tr>';
												html += '<td style="width: 50%;">Display</td>';
												html += '<td style="width: 50%;">' + data.warehouse[x].display + '</td>';
											html += '</tr>';

											html += '<tr>';
												html += '<td style="width: 50%;">Damage</td>';
												html += '<td style="width: 50%;">' + data.warehouse[x].damage + '</td>';
											html += '</tr>';

											html += '<tr>';
												html += '<td style="width: 50%;">Available</td>';
												html += '<td style="width: 50%;">' + data.warehouse[x].available + '</td>';
											html += '</tr>';

										html += '</tbody>';
									html += '</table>';
								html += '</div>';
							}
						html += '</div>';

						html += '<h5 class="mg-b-15">Transaction History</h5>';

						html += '<table class="table table-bordered mg-b-30">';
							html += '<thead>';
								html += '<tr>';
									html += '<th style="width: 20%;">Date</th>';
									html += '<th style="width: 20%;">Invoice No.</th>';
									html += '<th style="width: 20%;">Warehouse</th>';
									html += '<th style="width: 20%;">Transaction Type</th>';
									html += '<th style="width: 20%;">Quantity</th>';
									html += '<th style="width: 1%;"></th>';
								html += '</tr>';
							html += '</thead>';
							html += '<tbody>';
								for(var x = 0; x < data.history.length; x++){
									html += '<tr>';
										html += '<td class="align-middle">' + data.history[x].transaction_date + '</td>';
										html += '<td class="align-middle">' + data.history[x].invoice_no + '</td>';
										html += '<td class="align-middle">' + data.history[x].warehouse + '</td>';
										if(data.history[x].type == 'purchase'){ html += '<td class="align-middle"><span class="badge badge-primary">Purchase</span></td>'; }
										else if (data.history[x].type == 'sales'){ html += '<td class="align-middle"><span class="badge badge-success">Sales</span></td>'; }
										html += '<td class="align-middle">' + data.history[x].quantity + '</td>';
										html += '<td class="align-middle"><a href="' + data.history[x].link + '" class="btn btn-icon btn-primary btn-xs" target="_blank"><i class="fas fa-search"></i></a></td>';
										
									html += '</tr>';
								}
							html += '</tbody>';
						html += '</table>';

						html += '<h5 class="mg-b-15">Transfer History</h5>';


						$('#modal-inventory-history div.modal-body').html(html);

						preloader("hide");
						$('#modal-inventory-history').modal('show');

					} else {
						console.log("error");

					}
				},
				error: function(data){
					console.log('error');
				}
			});
		});
	}

	if($("#add-purchase-page").exists() || $("#add-sales-page").exists() || $("#add-reservation-page").exists() || $("#add-quotation-page").exists()){
		var page, type;

		if($("#add-purchase-page").exists()){
			page = $("#add-purchase-page");
			type = "purchase";

		} else if($("#add-sales-page").exists()){
			page = $("#add-sales-page");
			type = "sales";

		} else if($("#add-reservation-page").exists()){
			page = $("#add-reservation-page");
			type = "reservation";

		} else if($("#add-quotation-page").exists()){
			page = $("#add-quotation-page");
			type = "quotation";
		}

		var input = page.find("#item-search");
		var table = page.find("#item-list-table");

		page.find("input[name='delivery-method']").change(function(){
			var delivery_method = $(this).val();

			if(delivery_method == 'pickup'){
				$("input[name='delivery-fee']").attr("disabled", "disabled");
				$("input[name='delivery-fee']").val("0");
				
				compute_total();
			} else {
				$("input[name='delivery-fee']").removeAttr("disabled");
			}
		});

		input.autocomplete({
			minLength: 0,
			source: function(request, response){
				if(request.term != ''){
					$.ajax({
						url: siteurl + "/ajax/item.php",
						method: "POST",
						datatype: 'json',
						data: { term: request.term },
						success: function(data){
							response(data);
						}
					});
				}
			},
			select: function(event, ui) {
				var inventory;
				input.val("");

				if(ui.item.negative_inventory == 'false' && type == 'sales'){
					inventory = ui.item.inventory;
				} else {
					inventory = "false";
				}

				add_item(table, type, ui.item.identifier, ui.item.id, ui.item.image, ui.item.name, ui.item.retail_price, ui.item.wholesale_price, inventory);

				return false;
			},
		});

		table.on("click", "tbody button.remove", function(){
			$(this).closest("tr").remove();

			compute_total();
		});

		table.on("change keyup", "input", function(){
			compute_total();
		});

		if(type == 'sales'){
			page.find("input[name='official-receipt']").change(function(){
				var official_receipt = $(this).val();
				if(official_receipt == 'yes'){
					$("input[name='official-receipt-no']").removeAttr("disabled");
				} else {
					$("input[name='official-receipt-no']").attr("disabled", "disabled");
				}
			});
		}

		function compute_total(){
			var ctrl = 0;
			var count = 0;
			var total_discount = 0;
			var grand_total = 0;
			
			table.find("tbody tr").each(function(){
				ctrl++;

				row = $(this);
				
				var quantity = row.find('input[name="quantity[]"]').val();
				var price = row.find('input[name="price[]"]').val();
				var discount = 0;

				count += parseInt(quantity) == NaN ? 0 : parseInt(quantity);

				/*
				if(table.find("thead tr th").length == 6){
					var discounts = row.find("td input[name='discount[]']").val();

					if(discounts.includes("-")){
						discounts = discounts.split("-");
						var cur_price = Number(price);

						for(var i = 0; i < discounts.length; i++){
							if(/^\d+(\.\d+)?%$/.test(discounts[i])){
								discounts[i] = discounts[i].replace("%", "");
								discount += Number(cur_price * (discounts[i] / 100));
								cur_price = Number(cur_price - (cur_price * (discounts[i] / 100)));
							} else if(!isNaN(discounts[i])){
								discount += Number(discounts[i]);
								cur_price = Number(cur_price - discounts[i]);
							}
						}
					} else {
						if(/^\d+(\.\d+)?%$/.test(discounts)){
							discounts = Number(discounts.replace("%", ""));
							discount = Number(price * (discounts / 100));
						} else if(!isNaN(discounts)){
							discount = Number(discounts);
						}
					}
				}
				*/

				var subtotal = Number(quantity * (price - discount));
				row.find("td[data-name='total']").html( subtotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );

				grand_total += Number(subtotal);
			});
			
			table.find("tfoot td[data-name='subtotal']").html( grand_total.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );

			var total_discount = 0;
			
			if(table.find("tfoot td input[name='discount']").length > 0){
				var discounts = table.find("tfoot td input[name='discount']").val();
				var cur_price = Number(grand_total);

				if(/^\d+(\.\d+)?%$/.test(discounts)){
					discounts = discounts.replace("%", "");
					total_discount += Number(cur_price * (discounts / 100));
					cur_price = Number(cur_price - (cur_price * (discounts / 100)));
				} else if(!isNaN(discounts)){
					total_discount += Number(discounts);
					cur_price = Number(cur_price - discounts);
				}

				/*
				if(discounts.includes("-")){
					discounts = discounts.split("-");
					var cur_price = Number(grand_total);

					for(var i = 0; i < discounts.length; i++){
						if(/^\d+(\.\d+)?%$/.test(discounts[i])){
							discounts[i] = discounts[i].replace("%", "");
							total_discount += Number(cur_price * (discounts[i] / 100));
							cur_price = Number(cur_price - (cur_price * (discounts[i] / 100)));
						} else if(!isNaN(discounts[i])){
							total_discount += Number(discounts[i]);
							cur_price = Number(cur_price - discounts[i]);
						}
					}

				} else {
					if(/^\d+(\.\d+)?%$/.test(discounts)){
						discounts = discounts.replace("%", "");
						total_discount = grand_total * (discounts / 100);
					} else if(!isNaN(discounts)){
						total_discount = discounts;
					}
				}
				*/
			}

			if($('input[name="delivery-fee"]').exists()){
				delivery_fee = Number($('input[name="delivery-fee"]').val());
			} else {
				delivery_fee = 0;
			}

			grand_total = (grand_total - total_discount) + delivery_fee;


			table.find("tfoot td[data-name='item-count']").html( count );
			table.find("tfoot td[data-name='grand-total']").html( grand_total.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );

			if(ctrl > 0){
				input.removeAttr("required");
			} else {
				input.attr("required", "required");
			}
		}

		function add_item(table, type, identifier, item_id, image, name, retail_price, wholesale_price, inventory){
			var html = "";

			if(inventory == 'false'){
				html += '<tr data-identifier="' + identifier + '">';
				
				if(inventory != 'false'){
					html += '<td class="align-middle"><input type="hidden" name="' + type + '-item[]" value=""><input type="hidden" name="item[]" value="' + item_id + '"><input class="form-control text-center" type="number" name="quantity[]" value="1" min="0" max="' + inventory + '" style="min-width: 100px;" required></td>';
				} else {
					html += '<td class="align-middle"><input type="hidden" name="' + type + '-item[]" value=""><input type="hidden" name="item[]" value="' + item_id + '"><input class="form-control text-center" type="number" name="quantity[]" value="1" min="0" style="min-width: 100px;" required></td>';
				}

				html += '<td class="align-middle" style="width: 1%;"><img src="' + image + '" style="width:' + 80 + 'px" class="d-block"></td>';
				html += '<td class="align-middle">' + name + '</td>';
				
				if(type == 'purchase'){
					html += '<td class="align-middle"><input class="form-control text-center" type="number" name="price[]" value="0" min="0" step="0.01" style="min-width: 120px;" required></td>';
				} else {
					html += '<td class="align-middle"><input class="form-control text-center" type="number" name="price[]" value="' + retail_price + '" min="' + wholesale_price + '" step="0.01" style="min-width: 120px;" required></td>';
				}

				if(type == 'purchase'){
					html += '<td data-name="total" class="align-middle">0.00</td>';
				} else {
					html += '<td data-name="total" class="align-middle">' + retail_price + '</td>';
				}
				
				html += '<td class="align-middle"><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>';

				html += '</tr>';

				table.find("tbody").append(html);

				compute_total();
			}
		}
	}

	if($('#complete-delivery').exists()){
		$("html").on("click", "#complete-delivery form button[name='submit']", function(e){
			$("html").addClass("loading");
			e.preventDefault();

			$.ajax({
				url: siteurl + "/ajax/ecommerce-delivered.php",
				method: "POST",
				datatype: 'html',
				data: $('#complete-delivery form').serialize(),
				success: function(data){
					if(data == 'success'){
						window.location = window.location.href + "&tp=sc&action=update-status";
					} else {
						$("html").removeClass("loading");
					}
				}
			});
		});

		$('#complete-delivery form input').on("change keyup", function(e){
			compute_payout();

		});

		$('#complete-delivery form button[data-action="copy"]').on("click", function(e){
			var row = $('#complete-delivery table tbody tr:first-child');

			if($('#complete-delivery input[name="type"]').val() == 'lazada'){
				var date_delivered = row.find("input[name='delivered-date[]']").val();
				var shipping_fee_collected = Number(row.find('input[name="shipping-fee-collected[]"]').val()) == NaN ? 0 : Number(row.find('input[name="shipping-fee-collected[]"]').val());
				var shipping_fee_charged = Number(row.find('input[name="shipping-fee-charged[]"]').val()) == NaN ? 0 : Number(row.find('input[name="shipping-fee-charged[]"]').val());
				var commission_fee = Number(row.find('input[name="commission-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="commission-fee[]"]').val());
				var payment_fee = Number(row.find('input[name="payment-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="payment-fee[]"]').val());
				var other_fee = Number(row.find('input[name="other-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="other-fee[]"]').val());
				var other_credit = Number(row.find('input[name="other-credit[]"]').val()) == NaN ? 0 : Number(row.find('input[name="other-credit[]"]').val());

				$("#complete-delivery table tbody tr input[name='delivered-date[]']").val( date_delivered );
				$("#complete-delivery table tbody tr input[name='shipping-fee-collected[]']").val( shipping_fee_collected );
				$("#complete-delivery table tbody tr input[name='shipping-fee-charged[]']").val( shipping_fee_charged );
				$("#complete-delivery table tbody tr input[name='commission-fee[]']").val( commission_fee );
				$("#complete-delivery table tbody tr input[name='payment-fee[]']").val( payment_fee );
				$("#complete-delivery table tbody tr input[name='other-fee[]']").val( other_fee );
				$("#complete-delivery table tbody tr input[name='other-credit[]']").val( other_credit );

			} else if($('#complete-delivery input[name="type"]').val() == 'shopee'){
				var date_delivered = row.find("input[name='delivered-date[]']").val();
				var shipping_fee_collected = Number(row.find('input[name="shipping-fee-collected[]"]').val()) == NaN ? 0 : Number(row.find('input[name="shipping-fee-collected[]"]').val());
				var shipping_fee_charged = Number(row.find('input[name="shipping-fee-charged[]"]').val()) == NaN ? 0 : Number(row.find('input[name="shipping-fee-charged[]"]').val());
				var transaction_fee = Number(row.find('input[name="transaction-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="transaction-fee[]"]').val());
				var other_fee = Number(row.find('input[name="other-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="other-fee[]"]').val());
				var other_credit = Number(row.find('input[name="other-credit[]"]').val()) == NaN ? 0 : Number(row.find('input[name="other-credit[]"]').val());

				$("#complete-delivery table tbody tr input[name='delivered-date[]']").val( date_delivered );
				$("#complete-delivery table tbody tr input[name='shipping-fee-collected[]']").val( shipping_fee_collected );
				$("#complete-delivery table tbody tr input[name='shipping-fee-charged[]']").val( shipping_fee_charged );
				$("#complete-delivery table tbody tr input[name='transaction-fee[]']").val( transaction_fee );
				$("#complete-delivery table tbody tr input[name='other-fee[]']").val( other_fee );
				$("#complete-delivery table tbody tr input[name='other-credit[]']").val( other_credit );
			}

			compute_payout();

		});

		function compute_payout(){
			var grand_total = {
				shipping_fee_collected: 0,
				shipping_fee_charged: 0,
				payment_fee: 0,
				commission_fee: 0,
				transaction_fee: 0,
				other_fee: 0,
				other_credit: 0,
				payout: 0,
			};

			if($('#complete-delivery input[name="type"]').val() == 'lazada'){
				$('#complete-delivery form table tbody tr').each(function(){
					var row = $(this);

					subtotal = 0;

					var quantity = parseInt(row.find("span[data-name='quantity']").html());
					var price = parseFloat(row.find("span[data-name='price']").html().replace(",", ""))  == NaN ? 0 : parseFloat(row.find("span[data-name='price']").html().replace(",", ""));

					var shipping_fee_collected = Number(row.find('input[name="shipping-fee-collected[]"]').val()) == NaN ? 0 : Number(row.find('input[name="shipping-fee-collected[]"]').val());
					var shipping_fee_charged = Number(row.find('input[name="shipping-fee-charged[]"]').val()) == NaN ? 0 : Number(row.find('input[name="shipping-fee-charged[]"]').val());
					var commission_fee = Number(row.find('input[name="commission-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="commission-fee[]"]').val());
					var payment_fee = Number(row.find('input[name="payment-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="payment-fee[]"]').val());
					var other_fee = Number(row.find('input[name="other-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="other-fee[]"]').val());
					var other_credit = Number(row.find('input[name="other-credit[]"]').val()) == NaN ? 0 : Number(row.find('input[name="other-credit[]"]').val());

					var payout = ((quantity * price) + shipping_fee_collected + other_credit) - (shipping_fee_charged + commission_fee + payment_fee + other_fee);

					grand_total['shipping_fee_collected'] += shipping_fee_collected;
					grand_total['shipping_fee_charged'] += shipping_fee_charged;
					grand_total['payment_fee'] += payment_fee;
					grand_total['commission_fee'] += commission_fee;
					grand_total['other_fee'] += other_fee;
					grand_total['other_credit'] += other_credit;
					grand_total['payout'] += payout;

					row.find("td[data-name='payout']").html( payout.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				});

				$('#complete-delivery form table tfoot tr td[data-name="shipping-fee-collected"]').html( grand_total['shipping_fee_collected'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="shipping-fee-charged"]').html( grand_total['shipping_fee_charged'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="payment-fee"]').html( grand_total['payment_fee'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="commission-fee"]').html( grand_total['commission_fee'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="other-fee"]').html( grand_total['other_fee'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="other-credit"]').html( grand_total['other_credit'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="payout"]').html( grand_total['payout'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
			} else if($('#complete-delivery input[name="type"]').val() == 'shopee'){
				$('#complete-delivery form table tbody tr').each(function(){
					var row = $(this);

					subtotal = 0;

					var quantity = parseInt(row.find("span[data-name='quantity']").html());
					var price = parseFloat(row.find("span[data-name='price']").html().replace(",", ""))  == NaN ? 0 : parseFloat(row.find("span[data-name='price']").html().replace(",", ""));

					var shipping_fee_collected = Number(row.find('input[name="shipping-fee-collected[]"]').val()) == NaN ? 0 : Number(row.find('input[name="shipping-fee-collected[]"]').val());
					var shipping_fee_charged = Number(row.find('input[name="shipping-fee-charged[]"]').val()) == NaN ? 0 : Number(row.find('input[name="shipping-fee-charged[]"]').val());
					var transaction_fee = Number(row.find('input[name="transaction-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="transaction-fee[]"]').val());
					var other_fee = Number(row.find('input[name="other-fee[]"]').val()) == NaN ? 0 : Number(row.find('input[name="other-fee[]"]').val());
					var other_credit = Number(row.find('input[name="other-credit[]"]').val()) == NaN ? 0 : Number(row.find('input[name="other-credit[]"]').val());

					var payout = ((quantity * price) + shipping_fee_collected + other_credit) - (shipping_fee_charged + transaction_fee + other_fee);

					grand_total['shipping_fee_collected'] += shipping_fee_collected;
					grand_total['shipping_fee_charged'] += shipping_fee_charged;
					grand_total['transaction_fee'] += transaction_fee;
					grand_total['other_fee'] += other_fee;
					grand_total['other_credit'] += other_credit;
					grand_total['payout'] += payout;

					row.find("td[data-name='payout']").html( payout.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				});

				$('#complete-delivery form table tfoot tr td[data-name="shipping-fee-collected"]').html( grand_total['shipping_fee_collected'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="shipping-fee-charged"]').html( grand_total['shipping_fee_charged'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="transaction-fee"]').html( grand_total['transaction_fee'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="other-fee"]').html( grand_total['other_fee'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="other-credit"]').html( grand_total['other_credit'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );
				$('#complete-delivery form table tfoot tr td[data-name="payout"]').html( grand_total['payout'].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') );

			}
		}
	}

	if($('#add-stock-transfer-page').exists()){
		page = $("#add-stock-transfer-page");

		var input = page.find("#item-search");
		var table = page.find("#item-list-table");

		input.autocomplete({
			minLength: 0,
			source: function(request, response){
				if(request.term != ''){
					$.ajax({
						url: siteurl + "/ajax/item.php",
						method: "POST",
						datatype: 'json',
						data: { term: request.term },
						success: function(data){
							response(data);
						}
					});
				}
			},
			select: function(event, ui) {
				var inventory;
				input.val("");

				if(ui.item.negative_inventory == 'false' && type == 'sales'){
					inventory = ui.item.inventory;
				} else {
					inventory = "false";
				}

				add_item(table, ui.item.identifier, ui.item.id, ui.item.image, ui.item.name);

				return false;
			},
		});

		table.on("click", "tbody button.remove", function(){
			$(this).closest("tr").remove();

			compute_total();
		});

		table.on("change keyup", "input", function(){
			compute_total();
		});

		function compute_total(){
			var total = 0;

			var ctrl = 0;

			table.find("tbody tr").each(function(){
				ctrl++;

				var row = $(this);

				quantity = parseInt(row.find("input[name='quantity[]']").val()) || 0;
				total += quantity;
			});

			if(ctrl > 0){
				input.removeAttr("required");
			} else {
				input.attr("required", "required");
			}

			table.find("tfoot tr td[data-name='total']").html(total);
		}

		function add_item(table, identifier, item_id, image, name){
			var html = "";

			var i = 0;
			table.find("tbody tr").each(function(){ i++; });
			i++;

			if(!(table.find("tbody tr[data-identifier='" + identifier +"']").exists()) && i <= 9){

				var i = 0;
				table.find("tbody tr").each(function(){ i++; });
				i++;

				html += '<tr data-identifier="' + identifier + '">';
				
				html += '<td class="align-middle">' + i + '</td>';
				html += '<td class="align-middle" style="width: 1%;"><img src="' + image + '" style="width:' + 80 + 'px" class="d-block"></td>';
				html += '<td class="align-middle"><input type="hidden" name="stock-transfer[]" value=""><input type="hidden" name="item[]" value="' + item_id + '">' + name + '</td>';
				html += '<td class="align-middle"><input class="form-control text-center" type="number" name="quantity[]" value="0" min="0" style="min-width: 120px;" required></td>';
				html += '<td class="align-middle"><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>';

				html += '</tr>';

				table.find("tbody").append(html);

				compute_total();
			}
		}
	}

	if($('#create-payment-page').exists()){
		$('#create-payment-page input[name="type"]').on("change", function(){
			preloader("show");

			var value = $(this).val();

			$('#create-payment-page input[name="type"]').attr("disabled", "disabled");
			$(this).removeAttr("disabled");

			$.ajax({
				url: siteurl + "/ajax/payment-invoice.php",
				method: "POST",
				datatype: 'json',
				data: "type=" + value,
				success: function(data){
					html = "";

					if(data.length > 0){
						for(var x = 0; x < data.length; x++){
							html += "<tr>"; 
							html += "<td><div class='custom-control custom-checkbox custom-checkbox-only'><input type='checkbox' class='custom-control-input' name='id[]' id='id-" + data[x].id + "' value='" + data[x].value + "'><label class='custom-control-label' for='id-" + data[x].id + "'>&nbsp;</label></div></td>";
							html += "<td>";
								html += "<div class='row'>";
									html += "<div class='col-lg-12 row'>";
										html += "<div class='col-lg-5'>Invoice No:</div>";
										html += "<div class='col-lg-7'>" + data[x].invoice_no + "</div>";
									html += "</div>";

									html += "<div class='col-lg-12 row'>";
										html += "<div class='col-lg-5'>Name:</div>";
										html += "<div class='col-lg-7'>" + data[x].name + "</div>";
									html += "</div>";

									html += "<div class='col-lg-12 row'>";
										html += "<div class='col-lg-5'>Date:</div>";
										html += "<div class='col-lg-7'>" + data[x].date + "</div>";
									html += "</div>";

								html += "</div>";
							html += "</td>";
							
							html += "<td class='text-right'>" + data[x].total + "</td>";

							html += "</tr>";
						}

						$('#create-payment-page table#payment-invoice tbody').html(html);
						$('#create-payment-page #payment-details').removeClass("d-none");

					} else {
						$('#create-payment-page table#payment-invoice tbody').html("<tr><td class='text-center tx-24' style='padding: 100px 0px;' colspan=3'>" + message_no_results_found + "</td></tr>");
						$('#create-payment-page #payment-details').removeClass("d-none");
					}

					preloader("hide");
				},
			});
		});
	}

	if($('#view-payment-page').exists()){
		$('#view-payment-page #add-invoice-modal').on('shown.bs.modal', function (){
			preloader("show");

			var type = $("input[name='type']").val();

			$.ajax({
				url: siteurl + "/ajax/payment-invoice.php",
				method: "POST",
				datatype: 'json',
				data: "type=" + type,
				success: function(data){
					html = "";

					html += '<form method="post">';
					html += '<input type="hidden" name="action" value="add-invoice">';

					html += "<table class='table table-bordered mg-b-30'>";
					html += "<thead>";
						html += "<tr>";
							html += "<th style='width: 1%;'></th>";
							html += "<th style='width: 70%;'>Details</th>";
							html += "<th style='width: 30%;'>Total</th>";
						html += "</tr>";
					html += "</thead>";
					
					html += "<tbody>";

					if(data.length > 0){
						for(var x = 0; x < data.length; x++){

							html += "<tr>"; 
							html += "<td><div class='custom-control custom-checkbox custom-checkbox-only'><input type='checkbox' class='custom-control-input' name='id[]' id='id-" + data[x].id + "' value='" + data[x].value + "'><label class='custom-control-label' for='id-" + data[x].id + "'>&nbsp;</label></div></td>";
							html += "<td>";
								html += "<div class='row'>";
									html += "<div class='col-lg-12 row'>";
										html += "<div class='col-lg-5'>Invoice No:</div>";
										html += "<div class='col-lg-7'>" + data[x].invoice_no + "</div>";
									html += "</div>";

									html += "<div class='col-lg-12 row'>";
										html += "<div class='col-lg-5'>Name:</div>";
										html += "<div class='col-lg-7'>" + data[x].name + "</div>";
									html += "</div>";

									html += "<div class='col-lg-12 row'>";
										html += "<div class='col-lg-5'>Date:</div>";
										html += "<div class='col-lg-7'>" + data[x].date + "</div>";
									html += "</div>";

								html += "</div>";
							html += "</td>";
							
							html += "<td class='text-right'>" + data[x].total + "</td>";

							html += "</tr>";
						}

					} else {
						html += "<tr><td class='text-center tx-24' style='padding: 100px 0px;' colspan=3'>" + message_no_results_found + "</td></tr>";
					}

					html += "</tbody>";

					html += "</table>";

					html += '<button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>';
					html += '</form>';

					$('#view-payment-page #add-invoice-modal div.modal-body').html(html);

					preloader("hide");
				},
			});
		});

		$('#view-payment-page #add-invoice-modal').on('hidden.bs.modal', function (e) {
			$('#view-payment-page #add-invoice-modal div.modal-body').html("");
		})
	}

	if($('#payment-method-form').exists()){
		$('#payment-method-form table').on("change", "tr td > select", function(){
			var row = $(this).closest("tr");
			var method = $(this).val();
			
			row.find("td > div div div").removeClass("d-block");
			row.find("td > div div div").addClass("d-none");

			if(method == 'check'){
				row.find("td[data-name='description'] div[data-name='check']").removeClass("d-none");
				row.find("td[data-name='description'] div[data-name='check']").addClass("d-block");
			}

		});
	}

	if($('#reservation-management-page').exists()){
		$('#reservation-management-page table').on('click', 'button[data-action="quick-view"]', function(){
			var row = $(this);
			
			$("html").addClass("loading");

			$.ajax({
				url: siteurl + "/ajax/view-reservation.php",
				method: "POST",
				datatype: 'html',
				data: { id: row.attr("data-id") },
				success: function(result){
					// console.log(result);

					html = '';

					data = result.data;

					if(result.status == 'success'){
						html += "<div class='row'>";
							html += "<div class='col-lg-9 mg-sm-b-30'>";
								html += "<div class='table-responsive'>";
									html += "<table class='table table-bordered mg-b-20'>";
										
										html += "<tbody>";
											html += "<tr>";
												html += "<td style='width: 20%'>ID</td>";
												html += "<td style='width: 30%'>" + data.reservation_id + "</td>";
												
												html += "<td style='width: 20%'>Status</td>";
												html += "<td style='width: 30%'>" + data.status + "</td>";
											html += "</tr>";
											
											html += "<tr>";
												html += "<td style='width: 20%'>Delivery Method</td>";
												html += "<td style='width: 30%'>" + data.delivery_method + "</td>";
												
												html += "<td style='width: 20%'>Delivery Date</td>";
												html += "<td style='width: 30%'>" + data.delivery_date + "</td>";
											html += "</tr>";

											html += "<tr>";
												html += "<td>Customer</td>";
												html += "<td colspan='3'>" + data.customer + "</td>";
											html += "</tr>";
											
											html += "<tr>";
												html += "<td>Address</td>";
												html += "<td colspan='3'> " + data.address + " </td>";
											html += "</tr>";
											
											html += "<tr>";
												html += "<td>Contact Number</td>";
												html += "<td colspan='3'> " + data.contact_number + " </td>";
											html += "</tr>";
											
											html += "<tr>";
												html += "<td>Remarks</td>";
												html += "<td colspan='3'> " + data.remark + " </td>";
											html += "</tr>";
									
											html += "<tr>";
												html += "<td>Added By</td>";
												html += "<td> " + data.added_by + " </td>";

												html += "<td>Added On</td>";
												html += "<td> " + data.added_on + " </td>";
											html += "</tr>";
											
											if(data.updated_by !== undefined){
												html += "<tr>";
													html += "<td>Updated By</td>";
													html += "<td> " + data.updated_by + " </td>";

													html += "<td>Updated On</td>";
													html += "<td> " + data.updated_on + " </td>";
												html += "</tr>";
											}
											
											
										html += "</tbody>";
									html += "</table>";
								html += "</div>";

								html += "<div class='table-responsive'>";
									html += "<table class='table table-bordered mg-b-20'>";
										html += "<thead>";
											html += "<tr>";
												html += "<th class='text-center' style='width: 10%'>Quantity</th>";
												html += "<th class='text-center' style='width: 55%' colspan='2'>Description</th>";
												html += "<th class='text-center' style='width: 15%'>Price</th>";
												html += "<th class='text-center' style='width: 15%'>Sub-Total</th>";
											html += "</tr>";
										html += "</thead>";
										
										html += "<tbody>";
											if(data.item.length > 0){
												for(var x = 0; x < data.item.length; x++){
											html += "<tr>";
												html += "<td class='align-middle text-center'>" + data.item[x].quantity + "</td>";
												html += "<td style='width: 1%;'>" + data.item[x].image + "</td>";
												html += "<td class='align-middle'>" + data.item[x].item + "</td>";
												html += "<td class='align-middle text-right'>" + data.item[x].price + "</td>";
												html += "<td class='align-middle text-right'>" + data.item[x].subtotal + "</td>";
											html += "</tr>";
												}
											}
										html += "</tbody>";
										
										html += "<tfoot>";
											html += "<tr>";
												html += "<td class='text-center'></td>";
												html += "<td class='text-right' colspan='3'>Subtotal</td>";
												html += "<td class='text-right'> " + data.subtotal + " </td>";
											html += "</tr>";
								
											html += "<tr>";
												html += "<td colspan='4' class='text-right'>Delivery Fee</td>";
												html += "<td class='text-right'> " + data.delivery_fee + " </td>";
											html += "</tr>";

											html += "<tr>";
												html += "<td colspan='4' class='text-right'>Grand Total</td>";
												html += "<td class='text-right'>" + data.grand_total + "</td>";
											html += "</tr>";
										html += "</tfoot>";
									html += "</table>";
								html += "</div>";

								if(data.stat == 'open' || data.stat == 'ready'){
								html += "<div>";
									html += "<a href='" + data.edit + "' class='btn btn-primary btn-sm mg-r-10'>Edit</a>";
									if(data.print != undefined){
									html += "<a href='" + data.print + "' class='btn btn-primary btn-sm mg-r-10' target='_blank'>Print Dispatch</a>";
									}
									html += "<button type='button' class='btn btn-success btn-sm mg-r-10' data-id='" + data.id + "' data-action='completed'>Complete</button>";
									html += "<button type='button' class='btn btn-danger btn-sm mg-r-10' data-id=" + data.id + " data-action='cancelled'>Cancel</button>";
								html += "</div>";
								}

							html += "</div>";

							html += "<div class='col-lg-3'>";
								html += "<div class='card'>";
									html += "<div class='card-body'>";
										html += "<h4 class='card-title mb-4'>Notes</h4>";
										if(data.notes.length > 0){
											for(var x = 0; x < data.notes.length; x++){
										html += "<div class='color-box bg-light mb-3 p-3 rounded'>";
											html += "<h5 class='m-0 mb-2'>" + data.notes[x].description + "</h5>";
											html += "<p class='m-0'>By " + data.notes[x].added_by + ", " + data.notes[x].added_on + "</p>";
										html += "</div>";
											}
										}
									html += "</div>";
								html += "</div>";
							html += "</div>";
						html += "</div>";
						
						$("html").removeClass("loading");
						$('#modal-view-reservation div.modal-body').html(html);

						$('#modal-view-reservation').modal('show');
					}
				}
			});
		});
		
		$('#reservation-management-page #modal-view-reservation').on('click', 'button[type="button"]', function(){
			var button = $(this);

			$.ajax({
				url: siteurl + "/ajax/update-status.php",
				method: "POST",
				datatype: 'html',
				data: {
					id: button.attr("data-id"),
					type: "reservation",
					status: button.attr("data-action")
				},
				success: function(result){
					console.log(result);

					if(result == 'success'){
						$('#reservation-management-page #modal-view-reservation').modal('hide');
					}
				},
			});
		});
	}
});