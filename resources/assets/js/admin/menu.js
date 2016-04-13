jQuery(function($){
	var objects = new Array()
	var menu = new Array()

	$('.connectedSortable').sortable({
		connectWith: ".connectedSortable"
	});

	$('#deleteZone').droppable({
		accept: ".connectedSortable > li",
		activeClass: "ui-state-highlight",
		drop: function( event, ui ) {
			if (ui.draggable.length) {
				$(ui.draggable[0]).remove()
			}
		}
	});

	$('.ui-state-default').droppable({
		drop : function( event, ui) {
			$('li.ui-state-default').css('border', '0px');
		},
		over : function( event, ui){
			this.style.border = "1px dashed black"
		},
		out : function(){
			this.style.border = "0px"
		}
 	});

	function add_checkbox_result(data, type){
		var entradas = document.getElementById(type+'-results')
		entradas.innerHTML = ''
		for(d in data){
			var li = document.createElement('li')
			var label = document.createElement('label')
			var input = document.createElement('input')
			input.type = 'checkbox'
			input.name = type + '-menu-add[]'
			input.value = data[d].id
			input.setAttribute('data-slug', data[d].slug)

			var text = document.createTextNode(' ' + data[d].title)
			label.appendChild(input) 					
			label.appendChild(text)
			li.appendChild(label)
			
			entradas.appendChild(li)
			document.querySelector('#add-'+ type+' input[type=submit]').removeAttribute('disabled')
			objects[type + '_' + data[d].id] = data[d]
		}
	}

	function get_posts(e){
		e.preventDefault()
		var t = this
 		$.ajax({
 			'url' : this.action,
 			'method' : this.method,
 			'data' : {
 				'title' : document.getElementById(this.getAttribute('data-type') + '_title').value,
 				'type' : this.getAttribute('data-type')
 			},
 			'headers' : {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
 		}).done(function(data, status){
			if (status == 'success') {
				if (data.length) {
					add_checkbox_result(data, t.getAttribute('data-type'))
				} else {

					document.querySelector('#add-'+ t.getAttribute('data-type') +' input[type=submit]').setAttribute('disabled','') 					
				}
			} else {
				console.log('error')
			}
 		});
	}

  	function add_to_menu(is_link, element, type){
  		var li = document.createElement('li')
  		var span = document.createElement('span')
  		var text = document.createTextNode(' ' + element.title)
  		var ul = document.createElement('ul')
  		li.className = 'ui-state-default'
  		span.className = 'ui-icon ui-state-default ui-icon-arrowthick-2-n-s'
  		ul.className = 'connectedSortable'

  		if (!is_link) {
  			li.setAttribute('data-slug', element.slug)
			li.setAttribute('data-id', element.id)	
  		} else {
  			li.setAttribute('data-url', element.url)
  		}
  		li.id = type+'-'+ new Date().getTime()
		li.setAttribute('data-title', element.title)
		li.setAttribute('data-type', type)
		li.appendChild(span)
		li.appendChild(text)
		li.appendChild(ul) 			

		document.getElementById('sortable').appendChild(li)
		$('.connectedSortable').sortable({
			connectWith: ".connectedSortable"
		});

		$('.ui-state-default').droppable({
			drop : function( event, ui) {
				$('li.ui-state-default').css('border', '0px');
			},
			over : function( event, ui){
				this.style.border = "1px dashed black"
			},
			out : function(){
				this.style.border = "0px"
			}
	 	});
  	}

 	function add_entrada_to_menu(event){	
 		event.preventDefault();
 		var array = $(this).serializeArray()
 		for (a in array){
 			add_to_menu(false, objects['post_'+array[a].value], 'post')
 		}
 		
 	}

 	function add_pagina_to_menu(event){	
 		event.preventDefault();
 		var array = $(this).serializeArray()
 		for (a in array){
 			add_to_menu(false, objects['page_'+array[a].value], 'page')
 		}
 		
 	}

 	function add_categoria_to_menu(event) {
 		event.preventDefault();
 		var array = $(this).serializeArray()
 		for (a in array){
 			add_to_menu(false, objects['category_'+array[a].value], 'category')
 		}
 	}

 	function add_link_to_menu(event) {
 		event.preventDefault();
 		var array = { 
 			'title' : this.elements[0].value,
 			'type' : this.getAttribute('data-type'),
 			'url' : this.elements[1].value,
 		}
 		add_to_menu(true, array, 'link')
 	}

 	function build_menu(callback){
 		menu = new Array()
 		var array = document.querySelectorAll('#sortable li')

 		for (var a = 0; a < array.length; a++) {
 			var element = {
 				'id' : array[a].id,
 				'name' : array[a].getAttribute('data-title'),
 				'type' : array[a].getAttribute('data-type'),
 				'order' : (a + 1)
 			}
 			if (array[a].getAttribute('data-type') == 'link') {
 				element.url = array[a].getAttribute('data-url')
 			}else{
 				element.entity_id = array[a].getAttribute('data-id')
 			}
 			var parent = array[a].parentNode.parentNode
 			if (parent.nodeName == 'LI') {
 				element.parent = parent.id
 			} else {
 				element.parent = ''
 			}
 			menu.push(element)
 		}
 		document.getElementById('tabs_menu').value = JSON.stringify(menu)
 		callback()
 	}


 	function create_menu(data){
 		console.log('create_menu')
 		if (data.length) {
 			for (var i = 0; i < data.length; i++) {
 				var li = document.createElement('li')
		  		var span = document.createElement('span')
		  		var text = document.createTextNode(' ' + data[i].name)
		  		var ul = document.createElement('ul')
		  		li.className = 'ui-state-default'
		  		span.className = 'ui-icon ui-state-default ui-icon-arrowthick-2-n-s'
		  		ul.className = 'connectedSortable'

		  		if (data[i].type == 'link') {
		  			li.setAttribute('data-url', data[i].url)
		  		} else {
					li.setAttribute('data-id', data[i].entity_id)	
		  		}
		  		li.id = data[i].id
				li.setAttribute('data-title', data[i].name)
				li.setAttribute('data-type', data[i].type)
				li.appendChild(span)
				li.appendChild(text)
				li.appendChild(ul) 	

				if (data[i].parent !='') {
					document.querySelector('#'+data[i].parent +' ul').appendChild(li)
				} else{
					document.getElementById('sortable').appendChild(li)
				}
 			}

			$('.connectedSortable').sortable({
				connectWith: ".connectedSortable"
			});

			$('.ui-state-default').droppable({
				drop : function( event, ui) {
					$('li.ui-state-default').css('border', '0px');
				},
				over : function( event, ui){
					this.style.border = "1px dashed black"
				},
				out : function(){
					this.style.border = "0px"
				}
		 	});
 		}
 	}

 	$('#add-post').on('submit', add_entrada_to_menu);
 	$('#add-page').on('submit', add_pagina_to_menu);
 	$('#add-category').on('submit', add_categoria_to_menu);
 	$('#add-link').on('submit', add_link_to_menu);
 	// $('#build').on('click', function(e){
 	// 	e.preventDefault()
 	// });
 	$('#submit_menu_form').on('submit', function(e){
 		e.preventDefault()
 		var t = this
 		build_menu(function(){t.submit();})
 	})
 	$('#post_get_form, #page_get_form, #category_get_form').on('submit', get_posts);


 	//EDIT MENU
 	if(document.getElementsByClassName('editMenu').length){
 		var url_menu = document.getElementsByClassName('editMenu')[0].getAttribute('data-url')
 		$.get(url_menu, null, create_menu)
 	}
})