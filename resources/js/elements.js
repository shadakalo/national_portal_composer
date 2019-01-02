//appending elements

//customization buttons

var  customization_buttons =    $('<a/>', {
								        'class' : 'custome_element_button',
								        'html'		: '<i class="fa fa-edit "></i>',
								        'style'	:'cursor:pointer;position:absolute;top:-11px;left:0px;z-index:999;font-size:12px;color:blue;opacity:.7',
						         
						  		  }).on('click',function(){
				    					$('#customize_modal').modal('show')
									});

								// $('<a/>',{
								// 	'class' : 'remove_element_button',
								// 	'html'		: '<i class="fas fa-trash-alt"></i>',
								// 	'style'	: 'cursor:pointer;position:absolute;top:-11px;left:20px;z-index:999;font-size:12px;color:blue;opacity:.7'
								// 	}).on('click',function(){
								// 			$(this).parent().remove();
								// })			 


export default customization_buttons;