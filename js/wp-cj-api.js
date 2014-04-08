jQuery(document).ready(function() {	
	jQuery("#cj-search").click(sendSearch);
    jQuery("#cj-keywords").keypress(function(e){
	  c = e.which ? e.which : e.keyCode
      if(c == 13){
       sendSearch(e);
       }
	});
	jQuery('.cj-insert-item-button').live('click', sendTemplateToEditor);
	jQuery('#cjapi-result-template').hide(); //hide result row template
   jQuery('div.advanced-search').hide(); //hide result row template
   jQuery('a.advanced-search').click(function(e) {
      e.preventDefault();
      jQuery('div.advanced-search').toggle(); 
      });
});

var sendingSearch = false;
function sendSearch(event){
	if( !sendingSearch ) {
		sendingSearch = true;
		jQuery('.cjapi-result-row').remove();
		jQuery('#cj-status').removeClass('ajax-feedback');
    	jQuery.get('admin-ajax.php', {   keywords:jQuery("#cj-keywords").val(), 
                                       advids:jQuery("#advertiser-ids").val(), 
                                       action:'cjapi_search' }, 
                                       fillSearchResultTable, 'json');
      }
	event.preventDefault();
}

function fillSearchResultTable(response, status){
	sendingSearch = false;
	jQuery('#cj-results').accordion('destroy');
	jQuery('.cjapi-result-row').remove();
	jQuery('#cj-results h3').remove();
	jQuery('#cj-status').addClass('ajax-feedback');
	jQuery('#cj-results').show();
	if (typeof(response) == 'object') {
		jQuery.each(response.products.product,createNewResultRow);
		jQuery('#cj-results').accordion({ autoHeight: false });
	} else { 
	}
}

function createNewResultRow() {
	var $resultRow = jQuery('#cjapi-result-template').clone();
	$resultRow.removeAttr('id');
	$resultRow.addClass('cjapi-result-row');
	var $replaceArray = [[/%advertiser-id%/g,this['advertiser-name']],
								[/%advertiser-name%/g,this['advertiser-name']],
								[/%buy-url%/g,this['buy-url']],
								[/%catalog-id%/g,this['catalog-id']],
								[/%currency%/g,this['currency']],
								[/%description%/g,this['description']],
								[/%image-url%/g,this['image-url']],
								[/%in-stock%/g,this['in-stock']],
								[/%manufacturer-name%/g,this['manufacturer-name']],
								[/%manufacturer-sku%/g,this['manufacturer-sku']],
								[/%name%/g, this['name']],
								[/%price%/g,this['price']],
								[/%retail-price%/g,this['retail-price']],
								[/%sale-price%/g,this['sale-price']],
								[/%sku%/g,this['sku']],
								[/%upc%/g,this['upc']],
                        [/%ad-id%/g,this['ad-id']],
                        [/%isbn%/g,this['ad-id']],
								];
	replaceArray($replaceArray, $resultRow);
	$resultRow.show();
	jQuery('#cj-results').append('<h3><a href="#">'+this['name']+' - '+this['advertiser-name']+' - '+this['price']+'</a></h3>');
	jQuery('#cj-results').append($resultRow);
}

function sendTemplateToEditor(event) {
	event.preventDefault();
	var $template = jQuery(this).parent().clone();
	var $remove = $template.find('.cj-insert-item-button');
	$remove.remove();
	send_to_editor($template.html());
}

function replaceArray($arr, $replacee) {
	for (var $i in $arr) {
		if (typeof($arr[$i][1]) == 'string') { 
			$replacee.html($replacee.html().replace($arr[$i][0], $arr[$i][1]));
		} else {
         $replacee.html(unescape($replacee.html()).replace($arr[$i][0], ''));
      }
	}
}