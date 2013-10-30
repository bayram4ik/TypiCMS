/*
 * ListEnhancer 1.0, jQuery plugin
 * 
 * Copyright(c) 2012, Samuel De Backer
 * http://www.typi.be
 *	
 * ListEnhancer add buttons select-all to lists with checkboxes 
 * and show confirm box (nedd bootbox plugin) when submit.
 * Thanks to jQuery community 
 * Licenced under the MIT Licence
 */
(function($)
{
	var settings = {
		done: function(data) {},
		error: function(jqXHR, textStatus, errorThrown) {}
	};
	var listForm, nbOfCheckboxes, nbOfCheckedCheckboxes, actionName, selectionButton, selectAllText, deSelectAllText;
	var translations = {
		'nl': {
			'Select all': 'Tout sélectionner',
			'Deselect all': 'Tout désélectionner',
			'delete': 'Supprimer',
			'_link': 'Associer',
			'Cancel': 'Annuler',
			'item': 'élément',
		},
		'en': {
			'Select all': 'Select all',
			'Deselect all': 'Deselect all',
			'delete': 'Delete',
			'_link': 'Link',
			'Cancel': 'Cancel',
			'item': 'item',
		},
		'fr': {
			'Select all': 'Tout sélectionner',
			'Deselect all': 'Tout désélectionner',
			'delete': 'Supprimer',
			'_link': 'Associer',
			'Cancel': 'Annuler',
			'item': 'élément',
		}
	}
	var lang = $('html').attr('lang');
	var methods = {
		init: function (options) {
			return this.each(function() {
				if (options) {
					$.extend(settings, options);
				}
				listForm = $(this);
				$(':submit').addClass('custom-alert');
				$(':submit').click(function(){
					actionName = this.name;
				});
				listForm.submit(
					methods.beforeSubmit
				);

				listForm.find('.btn-toolbar button').prop('disabled', true);
				selectAllText = methods.translate('Select all');
				deSelectAllText = methods.translate('Deselect all');
				selectionButton = $('<a>', {
					class: 'btn btn-default btn-xs',
					id: 'selectionButton',
					href: '#',
					text: selectAllText,
					click: function () {
						//alert($(this).attr('id'));
						$(this).toggleClass('checked');
						var checked_status;
						if ($(this).hasClass('checked')) {
							checked_status = 'checked';
						}
						listForm.find('li input:checkbox:not(:disabled)').each(function () {
							this.checked = checked_status;
							if (checked_status) {
								selectionButton.text(deSelectAllText);
							} else {
								selectionButton.text(selectAllText);
							}
						});
						methods.verifierCheckboxes();
						return false;
					}
				});
				listForm.find('.btn-toolbar').prepend('<div class="btn-group" id="selectAllGroup"></div>');
				$('#selectAllGroup').append(selectionButton);
				listForm.find('li input:checkbox').click(function () {
					if (this.checked) {
						methods.checkChilds($(this));
					} else {
						methods.uncheckParents($(this));
					}
					methods.verifierCheckboxes();
				});

			});
		},
		beforeSubmit: function () {
			var confirmString;
			if (nbOfCheckedCheckboxes > 0) {
				if (actionName === 'delete') {
					confirmString = methods.translate(actionName) + ' ' + nbOfCheckedCheckboxes.toString() + ' ' + methods.translate('item');
					if (nbOfCheckedCheckboxes > 1) {
						confirmString += 's';
					}
					confirmString += ' ?';
					bootbox.dialog(confirmString, [{
						label: methods.translate('Cancel')
					}, {
						label: methods.translate(actionName),
						class: 'btn-danger',
						callback: methods.launchAction
					}], {
						header: 'Attention',
						animate: false,
						onEscape: function(){
							$(this).close();
						}
					});
				} else {
					return true;
				}
			}
			return false;
		},
		launchAction: function() {
			listForm.find('.btn-toolbar button').prop('disabled', true);
			var checkedItems = listForm.find('input:checkbox:checked').parent();
			if (actionName === 'delete') {
				var nb_elements = listForm.find('#nb_elements');
				if (nb_elements.html() > '0') {
					nb_elements.html(nb_elements.html() - parseInt(nbOfCheckedCheckboxes, 10));
				}
			};
			$.ajax({
				type: 'POST',
				url: listForm.attr('action'),
				dataType: 'json',
				data: listForm.serialize()+'&'+actionName+'='+actionName,
				success: function (data) {
					settings.done.call(this, data);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					settings.error.call(this, jqXHR, textStatus, errorThrown);
				}
			});
		},
		translate: function(string) {
			return translations[lang][string];
			// return string;
		},
		verifierCheckboxes: function() {
			nbOfCheckboxes = listForm.find('li input:checkbox:not(:disabled)').length;
			nbOfCheckedCheckboxes = listForm.find('li input:checkbox:checked').length;
			if (nbOfCheckedCheckboxes === 0) {
				listForm.find('.btn-toolbar button').prop('disabled', true);
			} else {
				listForm.find('.btn-toolbar button').prop('disabled', false);
				if (nbOfCheckboxes === nbOfCheckedCheckboxes) {
					selectionButton.text(deSelectAllText).addClass('checked');
				} else {
					selectionButton.text(selectAllText).removeClass('checked');
				}
			}
		},
		checkChilds: function(checkbox) {
			checkbox.closest('li').find('input:checkbox').prop({'checked':'checked'});
		},
		uncheckParents: function(checkbox) {
			checkbox.parents('li').children().children('input:checkbox').prop({'checked':''});
		}

	};
	$.fn.listEnhancer = function (method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method == 'object' || ! method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.listEnhancer');
		}
	};
})(jQuery);