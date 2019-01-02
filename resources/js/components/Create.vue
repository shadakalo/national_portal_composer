<template>
   <div class="container">
   		<div class="row" >

   	<!--Left Sidebar-->
   			<div class="col-md-9 composer">
   				<h5 class="composer-title">NP Composer</h5>
   				<div class="composer-body">
   				<!-- Row & Col add buttons -->
   					<v-icon name="plus" class="icons" v-b-modal.elementModal></v-icon>
   				<a data-toggle="modal" data-target=".bd-example-modal-lg">	<v-icon name="edit" class="icons"></v-icon></a>
   				
   			<!-- 		<i class="fa fa-edit" v-b-modal.customizationmodal></i> -->
   					<a @click="showCol()" >
   						<v-icon name="columns"  class="icons"></v-icon>
   					</a>
   					<transition name="slide-fade" mode="out-in">
						    <span class="col-division" v-show="columnpopper">
		   					 	<span @click="addCol(1,style_element_id)">1:1</span>
			   					 <span @click="addCol(2,style_element_id)">1:2</span>
			   					 <span @click="addCol(3,style_element_id)">2:1</span>
			   					 <span @click="addCol(4,style_element_id)">2:2</span>
			   					 <span @click="addCol(5,style_element_id)">4:0</span>
			   					 <p>columns</p>
	   						 </span>
					 		</transition>
   				<!-- Row & Col add buttons -->
   				 <div class="template-overview">
   				 	
   				 </div>
   				 <div class="main-row">
   				 	<v-icon name="plus-circle" class="row-icon" v-b-modal.elementModal></v-icon>
   				 </div>
   				</div>



   				<!-- <div class="template" v-html="html_code" ref="template" >
   					<div>asdsdsa</div>
   				</div> -->
   			</div>
   	<!--Left Sidebar-->

	<!--Right Sidebar-->
   			<div class="col-md-3 right-sidebar" >
   				<h5 class="composer-title">Customise Element</h5>
   				
   			</div>
   	<!--Right Sidebar-->
   		</div>
	
   		<!--Modal-->	

   		<!--  add row modal -->
   		<b-modal id="elementModal" title="Add Elements" size="lg" ref="myModalRef">
		    <div class="row elements">
		    	<div class="col-3" @click="addRow()">
		    		<div>
		    			<h6 class="element-title" >+ Add Row</h6>
		    			<!-- <p class="element-body">Add a row</p> -->
		    		</div>	
		    	</div>
		    	<div class="col-3 offset-1">
		    						
		    	</div>
		    	<div class="col-3 offset-1">
		    	
		    	</div>
		    </div>
	   	</b-modal>
	   	<!--  add row modal -->

 		<!--Modal to customize elemenet-->	
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="customize_modal">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      	<div class="modal-header">
			  									<h4>Customize Elemenets</h4>
			  									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
			  		  	</div>
			  		  	<div class="modal-body">		
								   <div class="row elements">
								    	<div class="styles">
							   					<b-tabs>
															  <b-tab title="Default">
															  	<br>
										   						<div class="d-flex">
										   							<h6>Background :</h6>
										   							 <input type="color" name="background" v-model="background_color" class="color-input">
										   							
										   						</div>
										   						<!-- <div>
										   							<h6>Width :</h6>
										   							 <input type="range" min="0" max="1000" step="1" v-model="width" > 
										   							 <input type="text" name="width" v-model="width" class="half_input">
										   						</div>
										   						<div>
										   							<h6>Height :</h6>
										   							 <input type="range" min="0" max="1000" step="1" v-model="height" > 
										   							 <input type="text" name="height" v-model="height" class="half_input">
										   						</div> -->
										   						
										   						<div>
										   							<h6>Radious :</h6>
										   							<input type="range" min="0" max="360" step="1" v-model="border_radius" > 
										   							 <input type="text" name="radious" v-model="border_radius" class="half_input">
										   						</div>
										   						<div>
										   							<h6>Border :</h6>
										   							 <input type="text" name="border" v-model="border">
										   						</div>
															  </b-tab>
															  <b-tab title="Font">
															    <br>
															    <div>
										   							<h6>Size :</h6>
										   							<input type="range" min="0" max="72" step="1" v-model="font_size" > 
										   							 <input type="text" name="radious" v-model="font_size" class="half_input">
										   						</div>
										   						<div>
										   							<h6>Weight :</h6>
																			<div class="custom-control custom-radio custom-control-inline">
																			  <input type="radio" name="radioInline" class="custom-control-input" id="defaultInline1" value="bold" v-model="font_weight">
																			  <label class="custom-control-label" for="defaultInline1">Bold</label>
																			</div>
																			<div class="custom-control custom-radio custom-control-inline">
																			  <input type="radio" name="radioInline" class="custom-control-input" id="defaultInline2" value="bolder" v-model="font_weight">
																			  <label class="custom-control-label" for="defaultInline2">Bolder</label>
																			</div>
												   						</div>
												   						<div>
												   							Color :
												   							<input type="text" name="radious" v-model="color">
												   						</div>
															  </b-tab>
															  <b-tab title="Spacing" >
															   <br>
												   					<h5>Margin</h5>  	
												   					<div class="d-flex">
												   						<div class="mr-2">
											   							<h6>Top : [{{ margin_top }}]</h6>
											   							 <input type="range" min="0" max="100" step="1" v-model="margin_top" > 
											   							<!--  <input type="text" name="margin_top" v-model="margin_top" class="half_input"> -->
											   							</div>
											   							<div>
											   							<h6>Bottom : [{{ margin_bottom }}]</h6>
											   							 <input type="range" min="0" max="100" step="1" v-model="margin_bottom" > 
											   							<!--  <input type="text" name="margin_top" v-model="margin_top" class="half_input"> -->
											   							</div>
												   					</div>
												   					<div class="d-flex mt-2">
												   						<div class="mr-2">
											   							<h6>Left : [{{ margin_left }}]</h6>
											   							 <input type="range" min="-100" max="100" step="1" v-model="margin_left" > 
											   							<!--  <input type="text" name="margin_top" v-model="margin_top" class="half_input"> -->
											   							</div>
											   							<div>
											   							<h6>Right : [{{ margin_right }}]</h6>
											   							 <input type="range" min="-100" max="100" step="1" v-model="margin_right" > 
											   							<!--  <input type="text" name="margin_top" v-model="margin_top" class="half_input"> -->
											   							</div>
												   					</div>
												   					<br>
												   					<h5>Padding</h5>  
												   					<div class="d-flex">
												   						<div class="mr-2">
											   							<h6>Top : [{{ padding_top }}]</h6>
											   							 <input type="range" min="0" max="100" step="1" v-model="padding_top" > 
											   							<!--  <input type="text" name="padding_top" v-model="padding_top" class="half_input"> -->
											   							</div>
											   							<div>
											   							<h6>Bottom : [{{ padding_bottom }}]</h6>
											   							 <input type="range" min="0" max="100" step="1" v-model="padding_bottom" > 
											   							<!--  <input type="text" name="padding_top" v-model="padding_top" class="half_input"> -->
											   							</div>
												   					</div>
												   					<div class="d-flex mt-2">
												   						<div class="mr-2">
											   							<h6>Left : [{{ padding_left }}]</h6>
											   							 <input type="range" min="0" max="100" step="1" v-model="padding_left" > 
											   							<!--  <input type="text" name="padding_top" v-model="padding_top" class="half_input"> -->
											   							</div>
											   							<div>
											   							<h6>Right : [{{ padding_right }}]</h6>
											   							 <input type="range" min="0" max="100" step="1" v-model="padding_right" > 
											   							<!--  <input type="text" name="padding_top" v-model="padding_top" class="half_input"> -->
											   							</div>
												   					</div>	
															  </b-tab>
												 	</b-tabs>
							   			</div>
									   </div>
			  		  	</div>
			  		  	<div class="modal-footer">
			  		  			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  		  	</div>
			    </div>
			  </div>
			</div>
			<!--Modal to customize elemenet-->

			<!-- add column modal -->	
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="add_column_modal">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      	<div class="modal-header">
			  									<h4>Customize Columns</h4>
			  									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
			  		  	</div>
			  		  	<div class="modal-body">		
								   <div class="row elements">
								    	<div class="styles">
							   					<b-tabs>
															  <b-tab title="Add Column">
															  	 <div class="row no-gutters col-division-modal">
																						<a @click="addCol(1)">Single Column</a>
													   					 <a @click="addCol(2,1)">Double Column</a>
													   					 <a @click="addCol(3,1)">Triple Column</a>
													   					 <a @click="addCol(4,1)">Quad Column</a>
													   					 <!-- <a @click="addCol(2,2)">4:8</a>
													   					 <a @click="addCol(2,3)">3:9</a>
													   					 <a @click="addCol(2,4)">2:10</a> -->
											   					</div>
															  </b-tab>
															   <b-tab title="Change Length">
																    <br>
																    <div>	
																    					 <h6>Change Column Size : {{  column_size }}</h6>  
																   					 	<input type="range" min="2" max="12" step="1" v-model="column_size">
																   					 	<button class="btn btn-info" @click="changeColumn(column_size)">Chage</button> 
																   </div>
															  </b-tab>
												 	</b-tabs>
							   			</div>
									   </div>
			  		  	</div>
			  		  	<div class="modal-footer">
			  		  			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  		  	</div>
			    </div>
			  </div>
			</div>
			<!-- add column modal -->	
		<!--Modal-->
   </div>
</template>
<script>
var childElm = 0;
export default {
       name: 'app', 
    

       data(){
       		return {
       			html_code: "",
       			style :"",
       			columnpopper: false,
       			parent_count : 0,
       			child_count : 0,
       			custome_button_count: 0,
       			custome_button_id:"",
       			style_element_id	:"",
       			col_id	:"",


       			background_color:"",
       			border:"",
       			border_radius:"",
       			// height:"",
       			// width:"",

       			font_size:"",
       			font_weight:"",
       			color:"",
       			
       			
       			margin_top:"",
       			margin_left:"",
       			margin_bottom:"",
       			margin_right:"",

       			padding_top:"",
       			padding_bottom:"",
       			padding_left:"",
       			padding_right:"",

       			column_size:2
       		}
       },
       watch: {
       	/************************ WATCHING INPUTS STYLING ************************/
       		background_color(){
       			$('#'+this.style_element_id).css('background-color',this.background_color);
       		},
       		border(){
       			$('#'+this.style_element_id).css('border',this.border);
       		},
       		border_radius(){
       			$('#'+this.style_element_id).css('border-radius',this.border_radius);
       		},
       		margin_top(){
       			$('#'+this.style_element_id).css('margin-top',this.margin_top);
       		},
       		margin_bottom(){
       			$('#'+this.style_element_id).css('margin-bottom',this.margin_bottom);
       		},
       		margin_left(){
       			$('#'+this.style_element_id).css('margin-left',this.margin_left);
       		},
       		margin_right(){
       			$('#'+this.style_element_id).css('margin-right',this.margin_right);
       		},
       		padding_top(){
       			$('#'+this.style_element_id).css('padding-top',this.padding_top);
       		},
       		padding_bottom(){
       			$('#'+this.style_element_id).css('padding-bottom',this.padding_bottom);
       		},
       		padding_left(){
       			$('#'+this.style_element_id).css('padding-left',this.padding_left);
       		},
       		padding_right(){
       			$('#'+this.style_element_id).css('padding-right',this.padding_right);
       		},
       		/************************ WATCHING INPUTS STYLING ************************/
       },

       beforeCreate(){
       	 	var that = this  

       	 	/************************ SELECTING ELEMENT / DISPLAYING CUSTOMIZATION BUTTON ************************/
      	 		$('body').on('click',function(e){
													 var target    = $(e.target);
													 var target_id = '#'+target.attr('id');  
												 if (target.parents('.template-overview').length) {
												 				$(this.custome_button_id).children('a').css('display','none'); 
												 				$('.selected').css('outline-color','#8F4CFF').removeClass('selected');
												 				$(target_id).addClass('selected').css('outline-color','red').children('a').css('display','inline'); 
										     		this.custome_button_id = target_id;
													}else{
																	$('.selected').css('outline-color','#8F4CFF');
																	$(this.custome_button_id).children('a').css('display','none');  
													}
										}); 
       	 	/************************ SELECTING ELEMENT / DISPLAYING CUSTOMIZATION BUTTON ************************/

       	 	/************************ ELEMENT STYLING ************************/
										$(document).bind().on('click','.style_element_button',function(){
											// if(childElm==0){
											    that.style_element_id 			= $(this).parent().attr("id");  
											    that.background_color				= $(this).parent().css('background-color');
											    that.border												 	= $(this).parent().css('border');
											    that.border_radius						 = $(this).parent().css('border-radius');
											    that.margin_top										= $(this).parent().css('margin-top');
											    that.margin_bottom							= $(this).parent().css('margin-bottom');
											    that.margin_left									= $(this).parent().css('margin-left');
											    that.margin_right								= $(this).parent().css('margin-right');
											    that.padding_top									= $(this).parent().css('padding-top');
											    that.padding_bottom						= $(this).parent().css('padding-bottom');
											    that.padding_left								= $(this).parent().css('padding-left');
											    that.padding_right							= $(this).parent().css('padding-right');	 
											    $('#customize_modal').modal('show'); // pop's up the modal for styling 
											// }else childElm = 0;
											// alert(childElm);
										});
										/************************ ELEMENT STYLING ************************/

       	 	/************************ REMOVE ELEMENT ************************/
										$(document).bind().on('click','.remove_element_button',function(){
													$(this).parent().remove();
										});       	 	
       	 	/************************ REMOVE ELEMENT ************************/

       	 	/************************ ADD COLUMN ************************/
       	 				$(document).bind().on('click','.add_column_button',function(){
       	 								that.style_element_id 			= $(this).parent().attr("id"); // selects the row in which columns will be added
       	 								$('#add_column_modal').modal('show');
       	 				})
       	 	/************************ ADD COLUMN ************************/

											$(document).bind().on('click','.child',function(){
																var element  = $(this);
																var child_id = element.attr("id");
																childElm = 1;
											});
       },

       methods:{
       
       /************************ ADD ROW FUNCTION ************************/
       		addRow(){
       			this.parent_count = this.parent_count + 1;
       			var parent = "parent-"+this.parent_count;
       			 $('<div/>',{
									    'id'    : parent,
									    'class' : 'row parent',
									    'style'	: 'background-color:#ccc;height:auto;min-height:120px;position:relative;outline:1px dashed #8F4CFF;outline-offset:-1px;padding:10px;'    			 
											}).appendTo('.template-overview').append(this.customizeButtons(-11,0,-11,20));
       			this.$refs.myModalRef.hide();
       		},
       /************************ ADD ROW FUNCTION ************************/

       /************************ ADD COLUMN FUNCTION ************************/
       		addCol(value,order=0){

       		var	style_element_id  = '#'+this.style_element_id; // setting the selected element id to that variable
       		var	 parent_class 				= $(style_element_id).parent().attr('class');//parent class to verify has row or not

       		var child_class 						= $(style_element_id).children().last().attr('id');
	       								if (child_class.substring(9,14) == 'child') {
							       						var child_num = parseInt(child_class[child_class.length -1]);
							       		}else{
							       			   var child_num = 1;
							       		}
       	

       		if(parent_class.substring(0,3) == 'row'){
       					var col_number = $(style_element_id+">.child").length;
       			 		$('<div/>',{
										    'id'    : this.style_element_id+"-child-"+col_number,
										    'class' : 'row parent',
										    'style'	: 'background-color:#ccc;height:auto;min-height:120px;position:relative;outline:1px dashed #8F4CFF;outline-offset:-1px;padding:10px',   			 
											 	}).appendTo(style_element_id).append(this.customizeButtons(-11,0,-11,20));
											 	
											 	this.style_element_id = this.style_element_id+"-child-"+col_number;
       		}
       			//finding if there is any previous child exists
	       			var col_length = [];
	       			if (value == 1) {
	       					col_length = [12];
	       			}else if( value == 2){
	       					if (order == 1) col_length = [6,6];
	       					else if (order == 2) col_length = [4,8];
	       					else if (order == 3) col_length = [3,9];
	       					else if (order == 4) col_length = [2,10];
	       			}else if(value == 3){
	       					col_length = [4,4,4];
	       			}else if(value == 4){
	       					col_length = [3,3,3,3];
	       			}
	       			for (var i=0; i<value; i++){
	       							
							       	child_num +=1;

	       							// var col_number = $("#"+this.style_element_id+">.child").length;
	       							// col_number += 2;
		       						$('<div/>',{
											     'id'    : this.style_element_id+"-child-"+child_num,
											     'class' : 'col-md-'+col_length[i]+' child',
											     'style'	: 'background-color:#fff;min-height:120px;outline:1px dashed #8F4CFF;outline-offset:-1px;',
												 		}).appendTo('#'+this.style_element_id).append(this.customizeButtons());


	       			}


       		},
       		/************************ ADD COLUMN FUNCTION ************************/

       		/************************ COLUMN MODIFY/REMOVE ************************/
       		changeColumn(column_size){
       				var classes = $('#'+this.style_element_id).attr('class').split(' ');
       				 if (classes[0].substring(0,3) == "col") {
       				 			$('#'+this.style_element_id).addClass('col-md-'+column_size).removeClass(classes[0]);	
       				 }else if(classes[0].substring(0,5) == "child"){
       				 			$('#'+this.style_element_id).addClass('col-md-'+column_size).removeClass(classes[1]);
       				 }else{
       				   	alert('This action cant be done on this element');
       				 } 	
       		},
       		/************************ COLUMN MODIFY/REMOVE ************************/

       	/************************ CUSTOMIZATION BUTTON (STYLE,ADD,REMOVE) ************************/
       		customizeButtons(top_style,left_style,){
       				var top  			= -11;
       				var left 			= 0;
       				var a    			= [];
       				var buttons = ['style_element_button','add_column_button','remove_element_button']
       				var icons 		= ['fa fa-edit','fas fa-columns','fas fa-trash-alt'];
       				this.custome_button_count += 1;
       				for( var i=0; i<3 ; i++){
       							a[i] = $('<a/>', {
					       												'id'				: 'btn-'+this.custome_button_count,
																        'class' : buttons[i],
																        'html'		: '<i class="'+icons[i]+'"></i>',
																        'style'	:'cursor:pointer;position:absolute;top:'+top+'px;left:'+left+'px;z-index:999;font-size:12px;color:blue;opacity:.7;display:none;',
											  							  });
       							left += 15;
       				}
       				return a;
       		},
       /************************ CUSTOMIZATION BUTTON (STYLE,ADD,REMOVE) ************************/
       		showCol(){
       			this.columnpopper = !this.columnpopper;
       		} 
       }
}

</script>

<style scoped>
	.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
 
     padding-right: 0px !important; 
     padding-left: 0px !important; 
	}
	input[type=text]{
		width: 95%;
		margin-bottom: 5px;
		
	}
	.fa-trash-alt:before{
		color: #8F4CFF;
	}
	.color-input{
		height: 35px;
		background-color: #ccc;
		border:0px;
		margin-bottom: 5px;
		position: relative;
		top: -8px;
		left: 5px;
	}
	.half_input{
		width: 40% !important;
		position: relative;
		top: -5px;
	}
	.row-icon{
			width: 40px;
			height: 40px;
			color: blue;
			cursor: pointer;
			opacity: .7;
	}
	.main-row{
		text-align: center;
		margin: 20px auto 0px auto;

	}
	.icons{
		color: #ccc;
		margin-left: 10px;
		cursor: pointer;
		margin-bottom: 60px;

	}
	.col-division{
		background-color: #ccc;
		position: absolute;
		top: 3px;
		padding: 10px 10px 0px 10px;
		margin-left: 10px;
		border-radius: 5px;
	}

	.col-division span{
		font-size: 10px;
		font-weight: bolder;
		color: #ccc;
		background-color: #fff;
		border-radius: 5px;
		padding: 4px 12px 2px 12px;
		cursor: pointer;

	}
	.col-division span:hover{
		box-shadow: 0px 0px 2px 2px grey;
	}
	.col-division p{
		margin: 0px;
		color: #fff;
	}

	.col-division-modal>a{
		  padding: 4px 8px;
    background-color: #BD8BF6;
    opacity: .7;
    color: #fff;
    font-weight: bolder;
    margin: 5px;
    position: relative;
	}

	.col-division-modal a:hover{
				background-color: #8E4CFE;
				color: #fff;
				cursor: pointer;
	}

	.col-division-modal a .row{
	  	width: 100%;
				text-align: center;
				position: absolute;
				top: 30px;
				left:0px;
				background-color: #BD8BF6;
				padding: 4px 8px ;
	}

	.col-left{
			background-color: #fff;
	}
	.col-right{
			background-color: #ccc;
	}


	.composer{
		background-color: #fff;
		min-height: 600px;
		box-shadow: 0px 0px 2px 2px #ccc;
		border-top-right-radius: 5px;
		border-top-left-radius: 5px;

	}
	.composer-title{
		padding: 8px;
		border-bottom: 1px solid #ccc;
	}
	.composer-body{
		position: relative;
		padding: 0px 15px;
	}
	/* Right Sidebar */
	.right-sidebar{
		width: 80%;
	}
	/* Right Sidebar */
	.template{
		padding: 25px;
	}
	.elements{
		justify-content: center;
	}
	.elements .col-3{
		font-weight: bold;
		min-height: 70px;
		padding: 5px;
		cursor: pointer;
	
	}
	.elements .col-3:hover{
		border: 1px solid #B5A6F2;
		
	}
	.elements .col-3 div{
		width: 100%;
		height: 70px;
		background-color: #B5A6F2;
		border: 1px solid #ccc;
		padding: 5px 0px;
	}
	.element-title{
		font-weight: bolder;
		color: #fff;
		text-align: center;
		margin-top: 20px;
	}
	.element-body{
		color: #fff;
		text-align: center;
		
	}

	.slide-fade-enter-active {
	  transition: all .5s ease;
	}
	.slide-fade-leave-active {
	  transition: all .5s cubic-bezier(1.0, 0.5, 0.8, 1.0);
	}
	.slide-fade-enter, .slide-fade-leave-to
	/* .slide-fade-leave-active below version 2.1.8 */ {
	  transform: translateX(10px);
	  opacity: 0;
	}
</style>