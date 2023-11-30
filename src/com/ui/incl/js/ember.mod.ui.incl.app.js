/**
 * Class components
 * @package
 * @author Ryno Van Zyl
 * @copyright Copyright Kwerqy. All rights reserved.
 */

var modal_panel;
var app = {
    //==================================================================================
    ajax: {
        request:function(url, options){

            var options = $.extend({
                update: false,
                data: false,
                form: false,
                confirm: false,
                method: 'POST',
                datatype: 'json',
                beforeSend: false,
                success: false,
                done: false,
                complete: false,
                no_overlay: false,
                screen_overlay: true,
                cancel_confirm: false,
                ok_confirm: false,
                csrf: $('.security-token').data("token"),
            }, (options == undefined ? {} : options));

            // confirm
            if (options.confirm === true) {
                options.confirm = 'Are you sure you want to continue?';
            }

            // function
            var $ajax = {
                done: function () { /* support for done method return */
                }
            };
            var do_ajax_request = function () {
                // overlay
                if (!options.no_overlay && options.update) {
                    app.overlay.show(options.update);
                }

                // post data
                var data_arr = [];
                if (options.form) data_arr.push($(options.form).serialize());
                if (typeof options.data === 'object') {
                    for (var prop in options.data) {
                        data_arr.push(encodeURIComponent(prop) + '=' + encodeURIComponent(options.data[prop]));
                    }
                    options.data = false;
                }
                if (options.data) data_arr.push(options.data);
                if (options.csrf && options.method != 'GET' && !options.form) data_arr.push('_csrf=' + encodeURIComponent(options.csrf));
                if (data_arr.length > 0) options.data = data_arr.join('&');

                // request
                $ajax = $.ajax(url, {
                	dataType: options.datatype,
                    async: options.async,
                    type: options.method,
                    data: options.data,
                    beforeSend: function () {

                        if (options.beforeSend) options.beforeSend.apply(this, [options]);

                        // overlay
                        if (!options.no_overlay) app.overlay.show(options.update);
                    },
                    success: function (data) {
                        // check for structured response

                        if (typeof data == 'string' && (/^##JSON##/).test(data)) {
                            // extract structure
                            data = $.parseJSON(data.replace(/^##JSON##/, ''));

                            // execute action
                            switch (data.type) {
                                case 'alert' :
                                    app.browser.alert(data.message, data.title);
                                    $('button').button('reset');
                                    break;
                            }
                            return;
                        }

                        // check response for message signature
                        if (typeof data == 'string' && (/##MESSAGE##/).test(data)) {
                            // split message string and data
                            var message_index = data.search(/##MESSAGE##/);
                            var message = data.substr(message_index);
                            data = data.substr(0, message_index);

                            // show message
                            var message_arr = eval(message.replace('##MESSAGE##', ''));
                            app.message.show_notice(message_arr);
                        }

                        if (options.success) {
                            switch (typeof options.success) {
                                case 'string' :
                                    eval(options.success + '(data, options);');
                                    break;
                                case 'function' :
                                    options.success.apply(this, [data, options]);
                                    break;
                            }
                        } else {
                            if (options.update && options.update !== "false") {

                                if ($(options.update).closest('.modal').length) options.autoscroll = false;

                                $(options.update).find('object.swfupload').each(function () {
                                    swfobject.removeSWF($(this)[0].id);
                                });

                                $('body .tooltip').remove();

                                if (options.hidden_update) {
                                    $(options.update).parent().css({'height': ($(options.update).parent().outerHeight())});
                                    $(options.update)
                                        .hide()
                                        .html(data)
                                        .show();
                                    $(options.update).parent().css({'height': ''});
                                } else {

                                    if (options.loader_html) {
                                        setTimeout(function () {
                                            $(options.update).html(data);
                                            if (options.autoscroll) browser.scrollTo(options.update, {offset: options.autoscroll_offset});

                                        }, 500)
                                    } else {
                                        $(options.update).html(data);
                                        if (options.autoscroll) browser.scrollTo(options.update, {offset: options.autoscroll_offset});
                                    }
                                }
                            }
                        }

                        if (options.done) options.done.apply(this, [data, options]);

                    },
                    complete: function (d) {

                        let data = d.responseJSON;

                        if (!options.no_overlay) app.overlay.hide();

                        if (options.complete) options.complete.apply(this, [options, data]);
                    }
                });
            }

            // confirm dialog
            if (options.confirm) {
                app.browser.confirm(options.confirm, function () {
                    if (options.ok_confirm) options.ok_confirm();
                    do_ajax_request();
                }, options.cancel_confirm);
            } else do_ajax_request();

            // return;
            return $ajax;

        },
		//--------------------------------------------------------------------------------
		request_function: function(url, func, options) {
	    	// options
	    	var options = $.extend({
				success: func
	    	}, (options == undefined ? {} : options));

	    	// ajax
    		return app.ajax.request(url, options)
		},
		//------------------------------------------------------------------------------
		process_response:function(response, oncomplete){

			if(response.js) eval(response.js);
			if(response.alert) app.browser.alert(response.alert, (response.title ? response.title : "Alert"), {ok_callback : new Function(response.ok_callback)});
			if(response.message) app.browser.alert(response.message, (response.title ? response.title : "Alert"), {ok_callback : new Function(response.ok_callback), class:'custom'});
			if(response.notice) app.message.show_notice(response.notice, {color:(response.notice_color ? response.notice_color : 'bg-primary')});
			if(response.redirect){ app.overlay.show(); document.location=response.redirect;}
			if(response.refresh) document.location.reload();
			// if(response.popup) app.browser.popup(response.popup);

			var oncomplete = (oncomplete === undefined ? function(){} : oncomplete);

			setTimeout(function () {
				oncomplete();
			}, 100)

		}
    },
    //==================================================================================
	html:{
    	//------------------------------------------------------------------------------
    	btn_arr:[],
		//------------------------------------------------------------------------------
    	set_btn_loading:function(el){
    		app.ui.set_button_loading(el);
		},
		//------------------------------------------------------------------------------
		unset_btn_loading:function(el){
    		app.ui.unset_button_loading(el);
		},
		//------------------------------------------------------------------------------
		tooltip:function(options){
    		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
			const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl, options))
		},
		//------------------------------------------------------------------------------
	},
    //==================================================================================
	form: {
		ihidden:function(id, value, append_to, options){

			options = $.extend({
				class:'',
			}, (options === undefined ? {} : options));

			$('<input>').attr({
				type: 'hidden',
				id: id,
				name: id,
				value: value,
				class: options.class
			}).appendTo(append_to);
		}
	},
    //==================================================================================
    browser: {
        window_count: 0,
        popup_count: 0,
        popup_id_arr: [],
        //--------------------------------------------------------------------------------
		close_popup: function() {
			let last_popup_id = app.browser.popup_id_arr[app.browser.popup_id_arr.length - 1];
			try {
				$('#' + last_popup_id).modal('hide');
				$('*[title]').tooltip('hide');
			}catch (e) {}
		},
        //------------------------------------------------------------------------------
		popup:function(url, options){

        	options = $.extend({
				title: '',
				width: 'modal-lg',
				id: app.str.generate_id(),
				popup_id: 'modal_panel_'+app.str.generate_id(),
				closable: true,
				backdrop: "static",
				class_modal_body: "mh-40",
				data: {},
				ok_callback: function(){},
			}, (options === undefined ? {} : options));

        	url = app.http.appendURL(url, 'mid=' + options.id);

        	let p = new popup(options);
			p.set_title(options.title);
			p.on_show(function(e){

				$('#' + options.id + ' .modal-body').html('<div id="'+options.popup_id+'"></div>')

				modal_panel = new panel({
					id:options.popup_id,
					url:url
				});
                modal_panel.refresh();

			});

			return p.build({
				backdrop:options.backdrop,
			});

		},
        //------------------------------------------------------------------------------
		alert: function(message, title, options) {

			options = $.extend({
				width: 'modal-md',
				closable: true,
				ok_callback: undefined,
			}, (options === undefined ? {} : options));

			if(!title) title = "Alert";

			let alert = new popup(options);
			alert.set_title(title);
			alert.set_body_content(message);
			alert.set_footer_content('<button type="button" class="btn btn-primary" commodal-btn="ok" data-bs-dismiss="modal">Ok</button>');
			if(options.ok_callback !== undefined){
				alert.on_show(function(){
					var $this = $(this);
					$this.find('button[commodal-btn=ok]')
						.click(function() {
							options.ok_callback.apply(this, []);
						}).focus();
					app.overlay.hide();
				});
			}

			var $popup = alert.build();

			return $popup;

		},
		//--------------------------------------------------------------------------------
		confirm: function(message, ok_callback, cancel_callback, options) {

			var options = $.extend({
				width: 'modal-md',
				title: 'Confirm',
			}, (options == undefined ? {} : options));

			var title = options.title;
			var ok_callback = (ok_callback == undefined ? function() {} : ok_callback);
			var cancel_callback = (cancel_callback == undefined ? function() {} : cancel_callback);

			let alert = new popup(options);
			alert.set_title(title);
			alert.set_body_content(message);
			alert.set_footer_content('<button class="btn btn-primary" commodal-btn="ok" data-dismiss="modal">Ok</button><button class="btn btn-secondary" commodal-btn="cancel" data-dismiss="modal">Cancel</button>');
			alert.on_show(function(){
				var $this = $(this);
				$this.find('button[commodal-btn=ok]')
					.click(function() {
						if (ok_callback) ok_callback.apply(this, []);
						alert.close();
					}).focus();

				$this.find('button[commodal-btn=cancel]').click(function() {
					if (cancel_callback) cancel_callback.apply(this, []);
					alert.close();
				});
			});
			return alert.build();
		},
		display_on_load_elements:function(){
        	$('.remove-on-load').removeClass('remove-on-load');
		},
    },
    //==================================================================================
	util:{
    	//-------------------------------------------------------------------------
        id_generator: function () {
            var S4 = function () {
                return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
            };
            return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
        },
    	//-------------------------------------------------------------------------
        copy_text_to_clipboard: function (text, options) {
            app.util.copy_text(text, options);
        },
        //-------------------------------------------------------------------------
        copy_to_clipboard: function (element) {
            app.util.copy_text(element.text());
        },
        //-------------------------------------------------------------------------
        copy_text: function (text, options) {

            var options = $.extend({
                br2nl: false,
            }, (options == undefined ? {} : options));

            if (options.br2nl) {
                var brRegex = /<br\s*[\/]?>/gi;
                text = text.replace(brRegex, "\r\n");
            }

            let body = $('body');
            let id = app.util.id_generator();

            let $temp = $("<input>");
            $temp.attr("id", id);
            $temp.css({position: 'absolute', left: '-5000px'});
            $temp.val(text);

            if (body.hasClass('modal-open')) {
                $('.modal.show').append($temp);
                $temp.select();
            } else {
                $("body").append($temp);
                $temp.select();
            }

            setTimeout(function () {
                document.execCommand("copy");
                app.message.show_notice("Text copied to clipboard");
                $temp.remove();
            }, 100);

        },
	},
    //==================================================================================
    data: {
		//------------------------------------------------------------------------------
		implode:function(seperator, data){
			if(!seperator) seperator = ",";
			return data.join(seperator)
		},
		//------------------------------------------------------------------------------
		explode:function(seperator, data){
			if(!seperator) seperator = ",";
			return data.split(seperator);
		},
		//------------------------------------------------------------------------------
		generate_unique_id:function(prefix){

			let rand = Math.round(new Date().getTime() + (Math.random() * 100));

			if(prefix) return prefix + "_" +rand;

			return rand;
		},
		//------------------------------------------------------------------------------
		serialize_object : function(params) {
			return jQuery.param( params );
		},
		//------------------------------------------------------------------------------
		form_to_json: function (selector) {
			var ary = $(selector).serializeArray();
			var obj = {};
			for (var a = 0; a < ary.length; a++)
				obj[ary[a].name] = ary[a].value;
			return obj;
		},
		//------------------------------------------------------------------------------
		json_to_arr: function (json_data) {
			var result = [];
			for(var i in json_data)
				result.push([i, json_data [i]]);

			return result;
		},

    },
    //==================================================================================
    ui: {
		//------------------------------------------------------------------------------
		is_mobile:function(){
			if( /Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )return true;
			return false;
		},
		//--------------------------------------------------------------------------------
		set_button_loading:function(target){

			if(!app.workspace.loading_button){
				app.workspace.loading_button = [];
			}

			$(target).each(function(){
				let el = $(this);

				if(el.hasClass('loading')) {
					return;
				}

				let accessor = app.data.generate_unique_id();
				app.workspace.loading_button.push({
					accessor : accessor,
					html : el.html(),
				});
				el.html('Loading... <i class=\'fas fa-spinner fa-spin\'></i>');
				el.prop('disabled', true);
				el.attr('disabled', true);
				el.addClass('.disabled', true);
				el.attr('data-accessor', accessor);
				el.addClass("loading");
			});
		},
		//--------------------------------------------------------------------------------
		unset_button_loading:function(target){

			if(!app.workspace.loading_button){
				app.workspace.loading_button = [];
			}

			$(target).each(function(){
				let el = $(this);
				let accessor = el.data('accessor');

				let result = app.workspace.loading_button.filter(x => x.accessor === accessor);

				$.each( result, function( key, value ) {
					el.html(value.html);
					el.prop('disabled', false);
					el.removeAttr('disabled', true);
					el.removeClass('.disabled', true);
					el.removeAttr('data-accessor');
					el.removeClass("loading");
				});
			});
		},

    },
    //==================================================================================
	str: {
		//------------------------------------------------------------------------------
		format_bytes: function (bytes, options) {

			options = $.extend({
				decimals: 2,
				symbol: true,
			}, (options === undefined ? {} : options));

			if (!+bytes) return options.symbol ? '0 Bytes' : 0

			const k = 1024
			const dm = options.decimals < 0 ? 0 : options.decimals
			const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB']

			const i = Math.floor(Math.log(bytes) / Math.log(k))

			if(!options.symbol) return parseFloat((bytes / Math.pow(k, i)).toFixed(dm));

			return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
		},
		//------------------------------------------------------------------------------
		extension: function (filename) {
			return filename.substr((filename.lastIndexOf('.') + 1));
		},
		//------------------------------------------------------------------------------
		clean_filename: function (filename) {
			var extension = util.extension(filename);
			var s = filename.substr(0, filename.lastIndexOf('.')) || filename;
			return s.replace(/[^a-z0-9]/gi, '_').toLowerCase() + '.' + extension;
		},
		//------------------------------------------------------------------------------
		generate_id : function(options) {
			options = $.extend({
				prepend: '',
				length: 5,
				lowercase: true,
				glue: "_",
			}, (options === undefined ? {} : options));

			let result = '';
			let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			let charactersLength = characters.length;

			for (let i = 0; i < options.length; i++) {
				result += characters.charAt(Math.floor(Math.random() * charactersLength));
			}

			if(options.lowercase) result = result.toLowerCase();
			if(options.prepend !== '') result = options.prepend + options.glue + result;

			return result;
		},
	},
    //==================================================================================
    num: {
		//------------------------------------------------------------------------------
		round: function round(value, precision) {
			if(precision === undefined) precision = 2;
			var aPrecision = Math.pow(10, precision);
			return Math.round(value*aPrecision)/aPrecision;
		},
		//------------------------------------------------------------------------------
		currency:function(number, symbol) {
			var neg = false;
			if(number < 0) {
				neg = true;
				number = Math.abs(number);
			}

			if(!symbol) symbol = "R";

			return (neg ? "-"+symbol+" " : symbol+' ') + parseFloat(number, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
		},
	},
	//==================================================================================
	http: {
    	//------------------------------------------------------------------------------
    	URLHasGet:function(url){
    		return url.includes('?');
		},
		//------------------------------------------------------------------------------
		appendURL:function(url, append){

    		if(url.includes(append))
    			return url;

    		if(app.http.URLHasGet(url)){
				return url + '&' + append;
			}else{
				return url + '?' + append;
			}
		}
		//------------------------------------------------------------------------------
	},
	//==================================================================================
    overlay:{
        hide:function(){
        	setTimeout(function(){
				$('.pageLoader, .page-loader-overlay').fadeOut();

				app.browser.display_on_load_elements();

			}, 200);
		},
        show:function(){
        	$('.pageLoader, .page-loader-overlay').show();
		},
    },
    //==================================================================================
	message: {
		//------------------------------------------------------------------------------
		is_notice_created: false,
		is_static_created: false,
		//------------------------------------------------------------------------------
		show_notice: function(message_arr, options) {
			// options
			options = $.extend({
				header: false,
				sub_header: false,
				color: 'bg-primary',
				autohide: true,
				delay: 2000,
				message: false,
			}, (options === undefined ? {} : options));

			// params
			message_arr = ($.isArray(message_arr) ? message_arr : [message_arr]);

			// build message
			let message = '';
			$.each(message_arr, function(index, item) {
				if(typeof item !== 'undefined'){
					message += item + '<br />';
				}
			});

			if(!options.header)options.header = message;
			else options.message = message;

			// toast wrapper
			let $toast = new toast();
			$toast.add_toast(options.message, options);
			$toast.build();

		}
		//------------------------------------------------------------------------------
	},
	//==================================================================================
	workspace: {
	},
	//==================================================================================
	session: {
		//------------------------------------------------------------------------------
    	set:function(id, value){
    		sessionStorage.setItem(id, value);
		},
		//------------------------------------------------------------------------------
		get:function(id, default_value){
    		let value = sessionStorage.getItem(id);
    		if(!value) value = default_value;
    		return value; 
		},
		//------------------------------------------------------------------------------
	},

}


$(document).keydown(function(e) {
    if ((e.ctrlKey || e.metaKey) && e.altKey && e.which == 76) {
       window.open('/index.php/system/login', '_blank')
    }

	if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey) {
		let focussed_el = $(':focus');
		let sType = focussed_el.getInputType();
		let input_type_arr = [
			"text",
			"number",
			"textarea",
		];

		if (jQuery.inArray(sType, input_type_arr) !== -1) {
			//find form
			focussed_el.closest("form").find(".ui-form-submit").click();
		}
	}
});


Dropzone.autoDiscover = false;

$(function(){


	let body = $('body');
	//----------------------------------------------------------------------------
	body.on('click', 'a[href]', function () {
        let el = $(this);
        let href = el.attr('href');

        if(el.data('fancybox')) return;

        if(href.length && href !== "#" && !el.attr('target')){
            if(href.substr(0, 4) === "http") app.overlay.show();
            if(href.substr(0, 1) === "/") app.overlay.show();
            if(href.substr(0, 3) === "?c=") app.overlay.show();
            if(href.substr(0, 12) === "index.php?c=") app.overlay.show();
        }
    });
	//----------------------------------------------------------------------------
	body.on('click', '.toggle-icon', function () {
        let el = $(this);
        let icon_default = el.attr('data-icon-default');
        let icon_toggle = el.attr('data-icon-toggle');
        let fontawesome_class = el.attr('data-fontawesome-class');
        
        if(!fontawesome_class) fontawesome_class = ".fas"

        let icon_element = el.find(fontawesome_class);
        
        if(icon_element){
        	if(icon_element.hasClass(icon_default)){
        		icon_element.removeClass(icon_default).addClass(icon_toggle);
			}else{
        		icon_element.addClass(icon_default).removeClass(icon_toggle);
			}
		}
    });
	//----------------------------------------------------------------------------
});


(function ($) {
    "use strict";

    $.fn.enterKey = function (fnc) {
		return this.each(function () {
			$(this).keypress(function (ev) {
				var keycode = (ev.keyCode ? ev.keyCode : ev.which);
				if (keycode == '13') {
					fnc.call(this, ev);
				}
			})
		})
	};

    $.fn.getInputType = function () {

        return this[0].tagName.toString().toLowerCase() === "input" ?
              $(this[0]).prop("type").toLowerCase() :
              this[0].tagName.toLowerCase();

    }; // getInputType

}(jQuery));

