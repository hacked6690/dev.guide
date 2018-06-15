/* Write here your custom javascript codes */

jQuery(document).ready(function(e) {

	/* init. required Js function */
	js.init();

});

var js = function () {
	return {
		init: function (e) {
			js.tiny_mce();
			js.chosen();
			js.jscfm();
			js.onoff();
			js.js178();
			js.atoslug();
			js.number();
			js.float();
			js.datepicker();
		},
		tiny_mce: function (e) {

			if($(".tinymce").length) {
				$.each($(".tinymce"), function(i,e) {
					var h = $(this).data("height");
						h = typeof h =='undefined' ? 375 :h;

					var pi = $(this).data("plugin");
					var mb = $(this).data("menubar");
					var tb = $(this).data("toolbar");
					var ignore = $(this).data("ignore");
					var sb = $(this).data("statusbar");

					js.run_tiny_mce("#"+ $(this).attr("id"), h, pi, mb, tb, ignore, sb);
				});
			}
		},
		color_range: function (e) {
			// '#fafa6e','#2A4858'
			return chroma.scale(['#fafa6e','teal','red']).mode('lch').colors(13);
		},
		__gh: function (e) {
			if($("._gh").length) {
				$("._gh").each(function(e) {
					var mode = $(this).data("mode");
					if(typeof mode !==undefined) {
						if(mode ==='instant') {
							js.draw_graph($(this));
						}
					}
				});
			}
		},
		draw_graph: function (e) {

			google.charts.load("current", { packages:["corechart"] });

			var id = $(graph).data("id");
			var title = $(graph).data("title");
			var value = $(graph).data("value");
			var type = $(graph).data("type");
			var type_title = $(graph).data("type_title");
			var opt_height = $(graph).data("opt_height");
			var graph_type = $(graph).data("graph_type");
			var graph_title = $(graph).data("graph_title");
			var haxis_title = $(graph).data("haxis_title");
			var vaxis_title = $(graph).data("vaxis_title");

			if(typeof graph_type =='undefined' || graph_type =='' || graph_type =='bar') {
				js.__bar("gh-"+ id, title, value, type, type_title, opt_height, graph_title);
			} else if (graph_type =='pie') {
				js.__pie("gh-"+ id, title, value, graph_title);
			}
		},
		__bar: function (graph_id, title, value, type, type_title, opt_height =17, graph_title, haxis_title, vaxis_title) {

			google.charts.setOnLoadCallback(draw);

			function draw() {

				title = ''+ title;
				value = ''+ value;
				type = ''+ type;

				var arr_title = title.split(",");
				var arr_value = value.split("|");
				var arr_type = type.split("|");

				var vars_value = {};
				for (a = 0; a < arr_value.length; a++) {
					vars_value[a] = arr_value[a].split(",");
				}

				var mydata = [];

				var tmp_obj = [type_title];
				for (i = 0; i < arr_type.length; i++) {
					tmp_obj.push(arr_type[i]);
				}

				// push color role, end obj
				tmp_obj.push({role:'style'});

				mydata.push(tmp_obj);

				for (j = 0; j < arr_title.length; j++) {

					var tmp_title_value = [arr_title[j]];
					for (b = 0; b < Object.keys(vars_value).length; b++) {
						tmp_title_value.push(parseInt(vars_value[b][j]));
					}

					// push color #code, end obj
					// tmp_title_value.push(''+chroma.random());
					tmp_title_value.push(js.color_range()[j]);

					mydata.push(tmp_title_value);
				}

				var data = new google.visualization.arrayToDataTable(mydata);
				var view = new google.visualization.DataView(data);
				var vcols = [0];

				for (i = 0; i < arr_type.length; i++) {
					var tmp_vcols = {
										calc: "stringify",
										sourceColumn: i+1,
										type: "string",
										role: "annotation"
									};
					vcols.push(i+1);
					vcols.push(tmp_vcols);
					vcols.push(i+2);
				}

			    view.setColumns(vcols);

				var options = {
								titleTextStyle: { fontName: 'Content' },
						        title: graph_title,
						        height: data.getNumberOfRows() * opt_height + 35,
						        chartArea: { width: '50%' },
						        hAxis: { title: haxis_title, minValue: 0 },
						        vAxis: { title: vaxis_title },
						        backgroundColor: '#fcfcfc',
						        series: js.color_range(),
						        is3D: true
						    };

				var chart = new google.visualization.BarChart(document.getElementById(graph_id));
				chart.draw(view, options);
			}
		},
		__pie: function (graph_id, title, value, graph_title) {

			google.charts.setOnLoadCallback(draw);

			function draw() {

				var arr_title = title.split(",");
				var arr_value = value.split(",");
				var _title = typeof graph_title =='undefined' ? 'Pie graph title' : graph_title;

				var mydata = [];
				mydata.push(['Axe 1', 'axe 2']);

				for (j = 0; j < arr_value.length; j++) {
					mydata.push([arr_title[j], parseInt(arr_value[j])]);
				}

				var data = new google.visualization.arrayToDataTable(mydata);

				var options = {
						title: _title,
						pieHole: 0.35,
						chartArea: { width: '75%', height: '55%'}
					};

				var chart = new google.visualization.PieChart(document.getElementById(graph_id));
				chart.draw(data, options);
			}
		},
		jtags: function (e) {
			if($('.jtags').length) {
				$('.jtags').tagsInput({
					width:"auto",
					height:'80px',
					'maxChars' : 255,
				});
			}
		},
		chosen: function (e) {
			if($(".chosen-select").length) {
				$(".chosen-select").chosen({
					width: '100%',
					no_results_text: "Sorry, no data found ]&#10139; ",
				});
			}
		},
		role: function (selection) {
			var v = $(selection).find(":selected").val(),
				c = $(selection).find(":selected").data("code");
			$(selection).closest("form").find("."+c).removeClass("hidden");
			$(selection).closest("form").find(".not-"+c).addClass("hidden");
		},
		jw_player: function (e) {
			/* jwPlayer */
			if(typeof jwplayer !='undefined') {
				jwplayer.key="tXwrW26TZwRhZeG5DyN8OtKTtXlmUlGmZiN9KQ==";
				var vardt = $(".data").length ? $(".data").data("source") :'';
				var pltype = $(".data").length ? $(".data").data("type") :'';

				if(vardt) {
					jwplayer("player")
						.setup({
							"file": vardt,
							width: "100%",
							aspectratio: "16:9",
							autostart: true,
							modes: [ { type: "html5" }, { type: "flash", src: "player.swf" } ]
						});
				}
			}
		},
		context_menu: function (e) {
			/* disable contextmenu, f12. */
			if(window.location.hostname != window.def.local) {
				$(document).bind("contextmenu", function(e) { e.preventDefault(); });
				$(document).keydown(function(e) { if(e.which === 123) { return false; } });
			}
		},
		slugify: function(text) {
			return text.toString().toLowerCase()
			    .replace(/\s+/g, '_')           // Replace spaces with -
			    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
			    .replace(/\_\_+/g, '_')         // Replace multiple - with single -
			    .replace(/^_+/, '')             // Trim - from start of text
			    .replace(/_+$/, '');            // Trim - from end of text
		},
		slugate: function (slugof) {

			var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

			var vd = new Date();
			var d = vd.getDate();
			var m = vd.getMonth() +1;
			var y = vd.getFullYear();

			d = d<10 ? '0'+d :d;
			m = m<10 ? '0'+m :m;

			var str = days[vd.getDay()].toString().toLowerCase();
				str = slugof !=undefined ? slugof :str;

			return str +'_'+ Math.floor(Date.now() / 1000);
		},
		slug: function (title, code) {
			code = $("input[name='"+ code +"']")
					.closest('form').find("input[name='"+ title +"']").val()
					.replace(/[^a-z0-9\s]/gi, '').replace(/\s+/g, '_').toLowerCase();

			if(code.slice(1) =='_') { code = code.substring(0, 1); }
			else if(code.slice(-1) =='_') { code = code.slice(0, -1); }

			return code;
		},
		no_copy_paste: function (e) {
			if($(".no-copy-paste").length) {
				$(".no-copy-paste")
					.bind('contextmenu cut copy paste', function(e) {
						e.preventDefault();
					})
					.keydown(function(e) {
				        if (e.ctrlKey==true && (e.which == '118' || e.which == '86')) {
				            e.preventDefault();
				        }
				    });
			}
		},
		number: function (e) {
			if($(".number").length)
			{
				$(".number").keydown(function(e)
				{
				    // Allow: backspace, delete, tab, escape, enter and .
				    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				        // Allow: Ctrl+A
				        (e.keyCode == 65 && e.ctrlKey === true) ||
				        // Allow: Ctrl+C
				        (e.keyCode == 67 && e.ctrlKey === true) ||
				        // Allow: Ctrl+X
				        (e.keyCode == 88 && e.ctrlKey === true) ||
				        // Allow: home, end, left, right
				        (e.keyCode >= 35 && e.keyCode <= 39))
				    {
				        // let it happen, don't do anything
				    	return;
				    }

				    // Ensure that it is a number and stop the keypress
				    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105))
				    {
						e.preventDefault();

				    } else if(!js.is_numeric(e.key)) {
				    	return false;
				   	}
				});
			}
		},
		float: function (e) {
			if($('.float').length)
			{
				$('.float').keypress(function(event) {

				  	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) || (event.which == 46 && $(this).caret().start == 0)) {
					    event.preventDefault();
					}

				  	// this part is when left part of number is deleted and leaves a .
				  	// in the leftmost position. For example, 33.25, then 33 is deleted ;
				  	$('.float').keyup(function(event)
				  	{
				    	if ($(this).val().indexOf('.') == 0)
				    	{
				      		$(this).val($(this).val().substring(1));
				    	}
				 	});
				});
			}
		},
		enchar: function (e) {
			if($('.enchar').length)
			{
				/* en_US char. */
				$('.enchar').on('keypress', function (event) {
				    var regex = new RegExp("^[a-zA-Z0-9._-]+$");
				    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
				    if (!regex.test(key)) {
				       event.preventDefault();
				       return false;
				    }
				});
			}
		},
		numberof: function (e) {
			if($('.numberof').length)
			{
				/* for numberof-staff */
				$('.numberof').on('keypress', function (event) {
				    var regex = new RegExp("^[0-9\-<>]+$");
				    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
				    if (!regex.test(key)) {
				       event.preventDefault();
				       return false;
				    } else {
				    	if(event.charCode ==45 || event.charCode ==60 || event.charCode ==62) {
				    		if($(this).val().indexOf('-') !=-1) return false;
				    		if($(this).val().indexOf('<') !=-1) return false;
				    		if($(this).val().indexOf('>') !=-1) return false;

				    	} else if(event.charCode ==8 || event.charCode ==37 || event.charCode == 39 || event.charCode ==46) {
				    		return true;
				    	}
					}
				});
			}
		},
		ofdob: function (e) {
			if($('.ofdob').length)
			{
				/* for number -dob | 23-11-1993 */
				$('.ofdob').on('keypress', function (event) {
				    var regex = new RegExp("^[0-9\-]+$");
				    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
				    if (!regex.test(key)) {
				       event.preventDefault();
				       return false;
				    }
				});
			}
		},
		input_code: function (e) {

			if($("input[name='code']").length) {

				var $input = $("input[name='code']");

				$input.focus(function (e) {
						if(!$input.val()) {
							$input.val(js.slug('title', 'code'));
						}
					})
					.bind('contextmenu cut copy paste', function(e) {
						e.preventDefault();
					})
					.keydown(function (e) {
					    if (e.ctrlKey==true && (e.which == '118' || e.which == '86')) {
					        e.preventDefault();
					    }
					})
				    .on('keypress', function (event) {
					    var regex = new RegExp("^[a-zA-Z0-9\-._\+]+$");
					    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

					    if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
						    return true;
						} else if (!regex.test(key)) {
					       	event.preventDefault();
					       	return false;
					    }
					});

				$("#auto_code").click(function (e) {

					e.preventDefault();
					var slgu = js.slug('title', 'code');

					if(slgu =='' && $input.val() =='') {
						return $input.val(js.slugate());

					}else if(slgu =='' && $input.val() !='') {
						return false;

					} else { $input.val(slgu); }
				});
			}
		},
		auto_email: function (e) {
			if($("#auto_email").length)
			{
				$("#auto_email").click(function(e) {

					e.preventDefault();

					var fake ='';
					var possible = "abcdefghijklmnopqrstuvwxyz0123456789_";

					var $eml = $('input[name="email"]');

					for (var i = 0; i < 12; i++) {
			    		fake += possible.charAt(Math.floor(Math.random() * possible.length));
					}

					// put condition if has
					$eml.val(fake +'@example.com');
				});
			}
		},
		run_tiny_mce: function (sel, h, pi, mb, tb, ignore, sb) {

			var plugin = `advlist autolink lists link image charmap print preview hr anchor pagebreak `+
						`searchreplace wordcount visualblocks visualchars code fullscreen `+
						`insertdatetime media nonbreaking save table directionality `+
						`emoticons template paste textcolor colorpicker textpattern imagetools`;

			if(pi in ['min', 'mini'] || pi ==false) {
				plugin = `advlist autolink lists link image charmap print preview anchor `+
						    `searchreplace visualblocks code fullscreen `+
						    `insertdatetime media table paste code`;
			}

			var menubar = typeof mb =='undefined' ? true :mb;

			var toolbar = `forecolor backcolor bold italic | alignleft aligncenter alignright | `+
							`bullist numlist outdent indent | fullscreen link image code`;

				toolbar = typeof tb =='undefined' ? toolbar :tb;


				if(typeof ignore !=='undefined') {
					var arr = ignore.split(',');
					$.each(arr, function(i,e) {
						if(~toolbar.indexOf(arr[i].toString().trim())) {
							toolbar = toolbar.replace(arr[i].toString().trim(), '');
						}
					});
				}

			var statusbar = typeof sb =='undefined' ? true :false;

			if($(sel).length) {

				tinymce.init({
					selector: sel,
					height: h,
					skin: 'light',
					// language: 'km_KH',
					plugins: [ plugin ],
					menubar: menubar,
					toolbar: toolbar,
					toolbar_items_size : 'small',
					statusbar: statusbar,
					branding: false,
					document_base_url: '/',
					relative_urls: false,
					remove_script_host: false,
					file_picker_callback : elFinderBrowser,
					convert_urls : false,
					browser_spellcheck : true,
					content_css: "/assets/admin/css/custom.css?t="+ Math.floor(Date.now()),
				  	setup: function (ed) {
				        ed.on('change', function () {
				            tinyMCE.triggerSave();
				        });
				        ed.on('keydown', function(evt) {
				        	/* tab pressed */
					        if (evt.keyCode == 9) {
					          	if (evt.shiftKey) { ed.execCommand('mceInsertContent', false, '&emsp;'); }
					         	else { ed.execCommand('mceInsertContent', false, '&emsp;'); }

					          	evt.preventDefault();
					         	return false;
					        }
					    });
				    },
			        pagebreak_separator : "<!-- readmore -->"
				});

				function elFinderBrowser (callback, value, meta) {
					// use an absolute path! ;
					tinymce.activeEditor.windowManager.open({
						file: '/elfinder/tinymce4',
						title: 'elFinder 2.1',
						width: 900,
						height: 450,
						resizable: false
					}, {
						oninsert: function (file, fm) {
							var url, reg, info;

							// URL normalization
							url = file.url;
							reg = /\/[^/]+?\/\.\.\//;
							while(url.match(reg)) {
								url = url.replace(reg, '/');
							}

							// Make file info
							info = file.name + ' (' + fm.formatSize(file.size) + ')';

							// Provide file and text for the link dialog
							if (meta.filetype == 'file') {
								callback(url, {text: info, title: info});
							}

							// Provide image and alt text for the image dialog
							if (meta.filetype == 'image') {
								callback(url, {alt: info});
							}

							// Provide alternative source and posted for the media dialog
							if (meta.filetype == 'media') {
								callback(url);
							}
						}
					});

					return false;
				}
			}
		},
		language: function (e) {
			var languageCode='na';
			var path_parts = location.pathname.split("/");
			if(path_parts.length >=2) {
				if(path_parts[1].length ==2) {
					languageCode = path_parts[1];
				}
			}

			return languageCode;
		},
		read_url: function (input, target) {
			if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $("#"+ target).attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		},
		is_numeric: function (n) {
			return !isNaN(parseFloat(n)) && isFinite(n);
		},
		toggle_child: function (e) {
			// If has sub fillin ;
			if($(".toggle-child").length) {
				$(".toggle-child").on("click", function(e) {

					var aid = $(this).data("aid");
					var $pr = $(this).closest("section");
					var $thechild = $pr.find(".thechild");
					var $tc_input = $thechild.find("input");

					if($thechild.attr("data-childof") == aid) { $thechild.toggleClass("hidden"); }

					if($(this).prop("checked") ==true){ $tc_input.attr('name', $tc_input.attr("tmp-name")).removeAttr("tmp-name"); }
					else { $tc_input.attr('tmp-name', $tc_input.attr("name")).removeAttr("name"); }

				});
			}
		},
		tf_subanswer: function (e) {
			// Embed truefalse subanswer ;
			if($(".tf-subanswer").length) {
				$(".tf-subanswer").on("click", function(evt) {

					var $t = $(this);
					var $pr = $t.closest(".tf-parent");
					var $hd_child = $pr.find(".for-subanswer");

					if($t.prop("checked") && $t.val() =='true') { $hd_child.removeClass("hidden"); }
					else { $hd_child.addClass("hidden"); }

					if($t.prop("checked") && $t.val() =='false') {

						var $subChild = $hd_child.find("input");

						$.each($subChild, function(key, val) {

							var $tmp = $(val);

							if($tmp.hasClass("toggle-child")) {
								var $pr = $tmp.closest("section");
								var $child = $pr.find(".thechild").addClass("hidden");
							}

							switch($tmp.attr("type")) {
								case 'checkbox':
									$tmp.attr('checked', false);
									break;
								default:
									$tmp.val(function() { return this.defaultValue; });
									break;
							}
						});
					}
				});
			}
		},
		set_cookie: function (cname, cvalue, exdays) {
		    var d = new Date();
		    	d.setTime(d.getTime() + (exdays*24*60*60*1000));
		    var expires = "expires="+ d.toUTCString();
		    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		},
		get_cookie: function (cname) {
		    var name = cname + "=";
		    var decodedCookie = decodeURIComponent(document.cookie);
		    var ca = decodedCookie.split(';');

		    for(var i = 0; i <ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0) == ' ') {
		            c = c.substring(1);
		        }
		        if (c.indexOf(name) == 0) {
		            return c.substring(name.length, c.length);
		        }
		    }
		    return "";
		},
		is_browser: function (browser) {

			if(browser =='opera') { // Opera 8.0+
				return (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
			} else if(browser =='mozilla') { // Firefox 1.0+
				return typeof InstallTrigger !== 'undefined';
			} else if(browser =='safari') { // Safari 3.0+ "[object HTMLElementConstructor]"
				return /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
			} else if(browser =='iexplore') { // Internet Explorer 6-11
				return /*@cc_on!@*/false || !!document.documentMode;
			} else if(browser =='edge') { // Edge 20+
				return !isIE && !!window.StyleMedia;
			} else if(browser =='chrome') { // Chrome 1+
				return !!window.chrome && !!window.chrome.webstore;
			} else if(browser =='blink') { // Blink engine detection
				return (isChrome || isOpera) && !!window.CSS;
			}
		},
		jalert: function (type ='danger', message ='Error', jclass ='inline-block') {
			return `<div class="msg font-light">
							<div class="alert alert-`+ type +` fade in font-12 line-height-13 `+ jclass +`">
								<button class="close line-height-12" data-dismiss="alert">×</button>
								`+ message +`
							</div>
						</div>`;
		},
		jempty_tr: function (colspan =7) {
			return `<tr class="empty-tr text-center">
							<td colspan="`+ colspan +`" class="">
								<i class="fa fa-lg fa-fw fa-ban txt-color-red"></i>
								<span class="font-13">
									`+ (typeof label !=undefined ? label["no_data_found"]["title"] : 'No data found') +`
								</span>
							</td>
						</tr>`;
		},
		isjson: function (str) {
		    try { JSON.parse(str); }
		    catch (e) { return false; }

		    return true;
		},
		no_data: function (e) {
			if($(".no-data").length) {
				$(".no-data").on("click", function(e) {

					$.confirm({
						theme: 'supervan',
					    title: '<i class="fa fa-lg fa-fw fa-bullhorn txt-color-blue"></i> <span class="font-ubuntu info">System notice</span>',
					    content: '<strong>Sorry</strong>, there is NO data to show',
					    buttons: {
					        ok: {
					            text: "ok!",
					            btnClass: 'btn-primary',
					            keys: ['enter']
					        },
					        cancel: function(){}
					    }
					});
				});
			}
		},
		loading_overlay: function (alt ='') {

			var overlay = `<div class="loading-overlay">
		            				<img id="loading-start" src="/assets/core/`+ alt +`loading.gif"/>
		            			</div>`;

	        $(overlay).appendTo('body');

	        $(".loading-overlay").dblclick(function(e) {
	        	js.remove_overlay();
	        });

	        // hit escape to close the overlay ;
	        $(document).keyup(function(e) {
	            if (e.which === 27) {
	                js.remove_overlay();
	            }
	        });
		},
		remove_overlay: function (e) {
			$('.loading-overlay').remove();
		},
		loading_saved: function (e) {
			$("body").find(".loading-overlay").append(`<img id="loading-saved" src="/assets/core/saved.gif?t=`+ Math.floor(Math.random() * 99) + 1 +`"/>`);
			setTimeout(function(e) { js.remove_overlay() }, 1300);
		},
		loading_error: function (msg ='Sorry, request failed') {
			$.confirm({
				theme: 'supervan',
			    title: '<i class="fa fa-lg fa-fw fa-bullhorn txt-color-red"></i> <span class="font-ubuntu info">System info</span>',
			    content: '<span class="font-18">'+ msg +'</span>',
			    buttons: {
			        Close: function() {
			        	js.remove_overlay();
	            	}
			    }
			});
		},
		jscfm: function(e) {
			if($('.jscfm').length) {
				$('.jscfm').each(function(i, obj) {

					$(obj).on('click', function(evt) {

						$.confirm({
							theme: 'supervan',
						    title: '<i class="fa fa-lg fa-fw fa-trash-o txt-color-red"></i> <span class="font-ubuntu error">System warning</span>',
				    		content: 'You are requesting to <span class="txt-color-red font-16 font-bold">Delete</span> this record, ok ?',
						    buttons: {
						        ok: {
						            text: "ok!",
						            btnClass: 'btn-primary',
						            keys: ['enter'],
						            action: function() {
						            	$(obj).closest('form').submit();
						            }
						        },
						        cancel: function(){}
						    }
						});
					});
				});
			}
		},
		onoff: function(e) {
			if($('.onoff').length) {
				$('.onoff').on("click", function(evt) {

					var target = $(this).data("target");
					var $tar_input = $(".onoff_input").find("input");

					if(target !=undefined)
					{
						if($(this).prop('checked') ==true)
						{
							$tar_input.attr("name", target).removeAttr("tmp-name");
							$tar_input.closest(".onoff_input").removeClass("hidden");

						} else {
							$tar_input.attr("tmp-name", target).removeAttr("name");
							$tar_input.closest(".onoff_input").addClass("hidden");
						}
					}
				});
			}
		},
		js178: function(e) {
			if($('.js178').length) {
				$('.js178').on("click", function(evt) {

					evt.preventDefault();

					var $p = $(this).closest('.ofprivilege');
					var pid = $p.data("parent");
					var $chld = pid !=undefined ? $("#chldof-"+ pid) :undefined;

					if($chld !=undefined && $chld.hasClass('hidden')) {
						$chld.removeClass('hidden');
					} else {
						$chld.addClass('hidden');
					}
				});
			}
		},
		atoslug: function(e) {
			if($('.atoslug').length) {
				$('.atoslug').on("click", function(evt) {

					evt.preventDefault();

					var $p = $(this).closest('.atoslug-upper');
					var _tar = $(this).data('target');
					var $objt = $p.find('input[name="'+ _tar +'"]');
					var _of = $(this).data('slugof');

					if($objt.length) {
						var slgu = js.slug('title', 'slug');

						if(slgu =='' && $objt.val() =='') {
							return $objt.val(js.slugate(_of));

						}else if(slgu =='' && $objt.val() !='') {
							return false;

						} else { $objt.val(slgu); }
					}
				});
			}
		},
		datepicker: function(e) {
			if($(".datepicker").length)
			{
				jQuery.each($(".datepicker"), function(i,v) {
					$(this).datepicker({
						prevText: '<i class="glyphicon glyphicon-chevron-left"></i>',
						nextText: '<i class="glyphicon glyphicon-chevron-right"></i>',
						dateFormat: 'dd.mm.yy',
					});
				});
			}
		},
		validate_req: function(e) {
			if($(".validate_req").length)
			{
				$(".validate_req").keyup(function(e) {

					var $ptr = $(this).closest("tr"),
						$approved = $ptr.find(".approved-budget"),
						$additional = $ptr.find(".additional-budget"),
						$last = $ptr.find(".last-request"),
						$this = $(this),
						$subtotal = $ptr.find(".subtotal-request"),
						$left = $ptr.find(".left-budget");

					var arritionor = $additional.html().split('+').map(function(item) {
														return item.trim();
													});
					var additionor = 0;
					for (var i = arritionor.length - 1; i >= 0; i--)
					{
						additionor += parseFloat(arritionor[i]);
					}

					var apditional = parseFloat($approved.html()) + additionor,
						thisor = js.is_numeric($this.val()) ? $this.val() :0,
						subtotalor = parseFloat(thisor) + parseFloat($last.html()),
						leftor = apditional - (parseFloat($last.html()) + parseFloat(thisor));

					$subtotal.html(subtotalor.toFixed(2));
					$left.html(leftor.toFixed(2));
				});
			}
		},
		rollback_req: function(event) {
			if($(".rollback-tr").length)
			{
				$(".rollback-tr").unbind('click').on('click', function(e)
				{
					$(this).closest('tr').remove();

					// add empty tr if null ;
					$tbody = $(`#tbl-request tbody`);

					if($tbody.children('tr').length ==0)
					{
						$tbody.html(js.jempty_tr(7));
					}
				});
			}
		},
	}
}();

// End - Customize by site, start from `atoslug` down ;


/* custom Ajax function .; */
$(function (e) {

	"use strict";

	var ajx = {},
		run = {},
		setting = {
			language: js.language(),
			ajaxurl: '/ajax/'
		};

	// Start - get Client local IP (ex: 192.168.1.127) ___
	var local ='unknown';

	if(js.is_browser('mozilla') || js.is_browser('chrome')) {
		/* Compatibility for firefox and chrome */
		window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
		var pc = new RTCPeerConnection({iceServers:[]}), noop = function() {};
		    pc.createDataChannel(""); /* create a bogus data channel */
		    pc.createOffer(pc.setLocalDescription.bind(pc), noop); /* create offer and set local description */

	    /* listen for candidate events */
	    pc.onicecandidate = function(ice) {
	        if(!ice || !ice.candidate || !ice.candidate.candidate)  return;
	        local = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];
	        pc.onicecandidate = noop;
	    };
	}
	// End - get client ip ___


	// init previousValue = 'checked' ;
	jQuery.each($("input.toggle-checked[type='radio'], input.toggle-checked[type='checkbox']"), function(key, evt) {
		if($(this).is(':checked')) {
			$(this).attr('previousValue', 'checked');
		}
	});

	$("input.toggle-checked[type='radio'], input.toggle-checked[type='checkbox']").click(function(e) {
		var previousValue = $(this).attr('previousValue');
		var name = $(this).attr('name');

		if (previousValue == 'checked') {
			$(this).removeAttr('checked');
			$(this).attr('previousValue', false);
		} else {
			$("input[name="+ name +"]:radio").attr('previousValue', false);
			$(this).attr('previousValue', 'checked');
		}
	});
	// End - Toggle radio/ checkbox ___


	// Start - new gallery on Fly ___
	var last_gallery =0;

	if($("#new_gallery").length) {
		$("#new_gallery").on("click", function(e) {

			e.preventDefault();

			var $t = $(this),
				$parent = $(this).closest("section"),
				render = $(this).data('render');

			last_gallery = last_gallery==0 ? $parent.data("last") +1 : last_gallery +1;

			var ofgarllery = `<div class="row ofgarllery">
										<section class='col col-4 flexibled-error'>
				                            <label class='label'>
				                                Title
				                                <div class='inline-block' id='for-gallery_title[]'></div>
				                            </label>
				                            <label class='input'>
				                            	<input type='text' name='gallery_title[]' class='flexibled border-0 border-bottom-1' />
				                            </label>
				                        </section>
				                        <section class='col col-6 flexibled-error'>
				                            <label class='label'>
				                                File <code>*</code>
				                                <a href='javascript:;' class='btn btn-xs rollback-gallery txt-color-red'>Clear</a>
				                                <div class='inline-block' id='for-gallery_file[]'></div>
				                            </label>
				                            <div class="input input-file">
												<span class="button">
													<input type="hidden" name="gallery_file[]" class="flexibled">
													<input type="file" id="gallery_file" class="realtime_upload" data-render="`+ render +`" onchange="this.parentNode.nextSibling.value = this.value">
														Browse
												</span><input type="text" class="border-0 border-bottom-1" placeholder="Include" readonly="">
											</div>
				                        </section>
				                    </div>`;

			// some validate if required ___
			if(true) {

				$parent.closest("div").after(ofgarllery);

				run.rollback_gallery($(".rollback-gallery"));
				ajx.realtime_upload();
			}
		});
	}

	run.rollback_gallery = function ($element) {

		jQuery.each($element, function(k,v) {
			$(this).unbind("click").on("click", function(e) {

				var $obj = $(this);
				var cfm = $(this).data('cfm');

				if(cfm !=undefined) {
					$.confirm({
						theme: 'supervan',
					    title: '<i class="fa fa-lg fa-fw fa-trash-o txt-color-red"></i> <span class="font-ubuntu error">System warning</span>',
			    		content: 'You \'re <span class="txt-color-red font-16 font-bold">Deleting</span> this gallery, ok ?',
					    buttons: {
					        ok: {
					            text: "ok!",
					            btnClass: 'btn-primary',
					            keys: ['enter'],
					            action: function() {
					            	$obj.closest(".ofgarllery").remove();
					            }
					        },
					        cancel: function(){}
					    }
					});
				} else {
					$obj.closest(".ofgarllery").remove();
				}
			});
		});
	}

	if($(".rollback-gallery").length) {
		run.rollback_gallery($(".rollback-gallery"));
	}
	// End - gallery meta ___ ;


	// Start - new Term meta on Fly ___
	var last =0;

	if($("#new_meta").length) {
		$("#new_meta").on("click", function(e) {

			e.preventDefault();

			var $t = $(this);
			var $parent = $(this).closest("section");

			last = last==0 ? $parent.data("last") +1 : last +1;

			var ofmeta = `<div class="row">
									<section class='col col-6 flexibled-error ofmeta'>
			                            <label class='label'>
			                                &mdash;/. Term meta <code>*</code>
			                                <a href='javascript:;' class='btn btn-xs rollback-meta txt-color-red'>Clear</a>
			                                <div class='inline-block' id='for-term_meta[]'></div>
			                            </label>
			                            <label class='input'>
			                            	<input type='text' name='term_meta[]' class='flexibled border-0 border-bottom-1 font-bold'
			                            		placeholder='{"meta_key":"meta_value"}' />
			                            </label>
			                        </section>
			                    </div>`;

			// some validate if required ___
			if(true) {

				$parent.closest("div").after(ofmeta);

				run.rollback_meta($(".rollback-meta"));
			}
		});
	}

	run.rollback_meta = function ($element) {

		jQuery.each($element, function(k,v) {
			$(this).unbind("click").on("click", function(e) {

				var $obj = $(this);
				var cfm = $(this).data('cfm');

				if(cfm !=undefined) {
					$.confirm({
						theme: 'supervan',
					    title: '<i class="fa fa-lg fa-fw fa-trash-o txt-color-red"></i> <span class="font-ubuntu error">System warning</span>',
			    		content: 'You \'re <span class="txt-color-red font-16 font-bold">Deleting</span> this meta, ok ?',
					    buttons: {
					        ok: {
					            text: "ok!",
					            btnClass: 'btn-primary',
					            keys: ['enter'],
					            action: function() {
					            	$obj.closest(".ofmeta").remove();
					            }
					        },
					        cancel: function(){}
					    }
					});
				} else {
					$obj.closest(".ofmeta").remove();
				}
			});
		});
	}

	if($(".rollback-meta").length) {
		run.rollback_meta($(".rollback-meta"));
	}
	// End - new Term meta ___ ;


	// Start - Create new Taxonomy on Fly ___
	if($("#new_taxonomy").length) {
		$("#new_taxonomy").on("click", function(e) {

			e.preventDefault();

			var f = $(this).data("for");
			var t = $(this).data("type");

			var $pr = $(this).closest("section");
			var $lbl = $pr.find("[name='"+ f +"']").closest("label");
				$lbl.remove();

			var ni = `<label class="input ofni">
								<div class="row">
									<div class="col-md-8 margin-bottom-5">
										<input type="text" name="`+ f +`" class="`+ t +` flexibled"/>
									</div>
									<div class="col-md-4">
										<button class="btn-u btn-u-primary rollback">Remove</button>
									</div>
								</div>
							</label>`;

			if(!$pr.find("ofni").length) {

				$pr.append(ni);
				$(this).attr("disabled", true);

				if(t =='code') {
					$("."+ t).bind('contextmenu cut copy paste', function(e) {
							e.preventDefault();
						}).keydown(function(e) {
					        if (e.ctrlKey==true && (e.which == '118' || e.which == '86')) {
					            e.preventDefault();
					        }
					    }).on('keypress', function (event) {
						    var regex = new RegExp("^[a-zA-Z0-9\-._\+]+$");
						    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
						    if (!regex.test(key)) {
						       event.preventDefault();
						       return false;
						    }
						});
				}

				$(".rollback").unbind("click").on("click", function(e) {
					$pr.find(".ofni").remove();
					$pr.append($lbl);
					$("#new_taxonomy").removeAttr("disabled");
				});
			}
		});
	}
	// End - create new Taxonomy input ___


	// Start - child of Taxonomy ___
	if($(".of_taxonomy").length) {
		$(".of_taxonomy").on("change", function(e) {
			if(!jQuery.active) {
				ajx.of_taxonomy(this);
			}
		});
	}

	ajx.of_taxonomy = function (input) {

		var $input = $(input);
		var taxonomy = $input.data("taxonomy");
		var target = $input.data("target");
		var parent_id = $input.val();

		var frm = new FormData();
			frm.append('taxonomy', taxonomy);
			frm.append('parent_id', parent_id);

		if(parent_id !=='') {

			js.loading_overlay();

			$.ajax({
				url: setting.ajaxurl +'of_taxonomy',
				type: "POST",
				dataType: 'json',
				data: frm,
				contentType: false,
				cache: false,
				processData: false,
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				success: function(data)
				{
					// pass return to input
					$("select[name='"+ target +"']").html(data.option);

					js.remove_overlay();
				},
				error: function (responseData, textStatus, errorThrown) {
					console.log(textStatus);
				}
			});
		}
	}
	// End - child of Taxonomy ___


	// get from old Preview input ___
	ajx.realtime_upload = function (e)
	{
		if($(".realtime_upload").length)
		{
			$(".realtime_upload").unbind("change").on("change", function(evt)
			{
				var $this = $(this),
					name = $this.attr("id"),
					_tvalue = $this.val(),
					render = $this.data('render'),
					rndsize = $this.data('rndsize');

				var $parent = $this.closest(".input"),
					$input = $parent.find('input[name="'+ name +'"]'),
					$multi = $parent.find('input[name="'+ name +'[]"]'),
					hvalue = $input.val();

				if($parent.find(".msg").length)
				{
					$parent.find(".msg").remove();
				}

				if(_tvalue.trim() ==='')
				{
					// clear old data ;
					$input.val('');
					$this.parent().find("i").remove();

					return false;
				}

				/* check if have data-preview */
				var preview = $this.data("preview");
				if(typeof preview !='undefined')
				{
					js.readUrl(this, preview);
				}

				// set loading status ;
				var tmp_browse_label = $this.parent().html();

				if($this.parent().find("i").length)
				{
					$this.parent().find("i").remove();
				}

				$this.parent().append('<i class="fa fa-fw fa-spin fa-3x fa-spinner font-13"></i>');

				var frm = new FormData();

					frm.append('render', render);
					frm.append('rndsize', rndsize);

					jQuery.each($this[0].files, function(i, e)
					{
						frm.append('files[]', $this[0].files[i]);
					});

				if(_tvalue !=='')
				{
					$.ajax({
						url: setting.ajaxurl +'realtime_upload',
						type: "POST",
						dataType: 'json',
						data: frm,
						contentType: false,
						cache: false,
						processData: false,
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						success: function(data)
						{
							if(data.result)
							{
								$this.parent().find("i").remove();
								$this.parent().append('<i class="fa fa-fw fa-check"></i>');

								// pass return to input | multi ;
								$input.val(data.success);
								$multi.val(data.success);

							} else if(!data.result) {

								$this.parent().find("i").remove();
								$this.parent().append('<i class="fa fa-fw fa-times"></i>');

								if($this.hasClass('flexibled'))
								{
									$this.closest('.flexibled-error').find('#for-'+ $this.attr('id')).html(js.jalert('danger', data.msg));
								}
							}
						},
						error: function (responseData, textStatus, errorThrown) {
							console.log(textStatus);
						}
					});
				}
			});
		}
	}

	ajx.realtime_upload();
	// End - realtim upload ____ ;

	// `$target_btn` can be Button OR any Element that clicked
	ajx.chk_display_name = function($target_btn, input_name)
	{
		var $input = $('input[name="'+ input_name +'"]');

		$target_btn.click(function(e) {

			e.preventDefault();

			var s = $input.val();

			var p = $input.closest('form').find('input[name="cmd"]').val();
			var r = $input.closest('form').find('input[name="recordid"]').val();

			$input.parent().find(".chk_display_name.msg").remove();

			if(s==='' && !$input.parent().find('.chk_display_name.msg').length) {}

			var frm = new FormData();
				frm.append('source', s);
				frm.append('onpage', p);
				frm.append('recordid', r);

			if(s !=='')
			{
				$.ajax({
					url: setting.ajaxurl +'chk_display_name',
					type: "POST",
					dataType: 'json',
					data: frm,
					contentType: false,
					cache: false,
					processData: false,
					headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					success: function(data)
					{
						if($input.parent().find('.msg').length)
						{
							$input.parent().find('.msg').remove();
						}

						if($input.hasClass("flexibled"))
						{
							$input.closest(".flexibled-error").find(`#for-`+ input_name).html(js.jalert('danger', data.msg));

						} else {
							$input.after(js.jalert('danger', data.msg));
						}
					},
					error: function (responseData, textStatus, errorThrown)
					{
						console.log(textStatus);
					}
				});
			}
		});
	}

	// Start - evt of custajx for none ajax-table listing ___
	if($(".custajx").length)
	{
		var func = $(".custajx").data("func");
		var input_name = $(".custajx").data("input");

		ajx[func]($(".custajx"), input_name);
	}

	// setEvtFunction - 0=cmd, 1=tn, 2=r ;
	// for ajax-table list - with no interact/ return html to page ;
	ajx.ajax_function = function (e)
	{
		$(".custom_evt").unbind("click").click(function(e)
		{
			var $t = $(this);
			/* vary from one another -- */
			var s = $(this).data('source').split(',');
			var a = $(this).data('active');
				a = typeof a !=='undefined' ? a :'';
			var t = $(this).data('toggle');
				t = typeof t !=='undefined' ? t :'';

			if(s[0].trim() =='remove')
			{
				$.confirm({
					theme: 'supervan',
				    title: '<i class="fa fa-lg fa-fw fa-trash-o txt-color-red"></i> <span class="font-ubuntu error">System warning</span>',
				    content: 'You are requesting to <span class="txt-color-red font-16 font-bold">Delete</span> this record, ok ?',
				    autoClose: 'cancel|8000',
				    buttons:
				    {
				        ok:
				        {
				            text: "ok!",
				            btnClass: 'btn-primary',
				            keys: ['enter'],
				            action: function()
				            {
				            	if(s.length ==3)
				                	ajx.ajaxFunction(s[0].trim(), s[1].trim(), s[2].trim());
				               	else if (s.length ==4)
				               		ajx.ajaxFunction(s[0].trim(), s[1].trim(), s[2].trim(), s[3].trim());
				            }
				        },
				        cancel: function() {}
				    }
				});

			} else if(s[0].trim() =='deactivate' && t=='usr') {

				$.confirm({
					theme: 'supervan',
				    title: '<i class="fa fa-lg fa-fw fa-exchange"></i> <span class="font-ubuntu error">System warning</span>',
				    content: 'You are requesting to <span class="txt-color-blue font-16 font-bold">'+ (a=='active'? 'De-activate' :'Activate') +'</span> this record, ok ?',
				    buttons: {
				        ok: {
				            text: "ok!",
				            btnClass: 'btn-primary',
				            keys: ['enter'],
				            action: function()
				            {
				                // NEED TO PUT TOP OF De-activate -- process for message (email) to user
				                ajx.ajax_function('user_activated_mail', s[1].trim(), s[2].trim());

				                // show only in data table -deactivate
				                ajx.ajax_function(s[0].trim(), s[1].trim(), s[2].trim());
				            }
				        },
				        cancel: function(){}
				    }
				});

			} else if(s[0].trim() =='js_popup') {

				var _t = $t.data("dialog_title");
					_t = typeof _t !=='undefined' ? _t :'System';
				var _i = $t.data("dialog_icon");
					_i = typeof _i !=='undefined' ? '<i class="'+ _i +'"></i>' :'<i class="fa fa-lg fa-fw fa-exchange"></i>';
				var _c = $t.data("dialog_content");
					_c = typeof _c !=='undefined' ? _c :'&nbsp;';

				$.confirm({
					theme: 'supervan',
				    title: _i +' <span class="font-ubuntu error">'+ _t +'</span>',
				    content: _c,
				    buttons: {
				        ok: {
				            text: "ok!",
				            btnClass: 'btn-primary',
				            keys: ['enter'],
				            action: function() {}
				        }
				    }
				});

			} else {

				if(s.length ==3)
				{
					ajx.ajax_function(s[0].trim(), s[1].trim(), s[2].trim());

				} else if(s.length ==4) {
					ajx.ajax_function(s[0].trim(), s[1].trim(), s[2].trim(), s[3].trim());
				}
			}
		});
	}

	// Switch status active / deactive
	ajx.ajax_function = function(cmd, tn, r, obj)
	{
		// start loading overlay
		js.loading_overlay('alt-');

		var frm = new FormData();
			frm.append('tn', tn);
			frm.append('r', r);

			if(typeof obj !='undefined')
			{
				frm.append('obj', obj);
			}

		$.ajax({
			url: setting.ajaxurl + cmd,
			type: "POST",
			dataType: 'json',
			data: frm,
			contentType: false,
			cache: false,
			processData: false,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			success: function(data)
			{
				// trigger search-btn ;
				if(['deactivate', 'remove'].indexOf(cmd) >-1)
				{
					$(".btn_search").trigger("click");

				} else if(data && 'html' in data && $("#html").length) {

					var popup = $("html").data("popup") !="undefined" ? true :false;

					if(!popup)
					{
						$("#html").html(data['html']);

					} else {
						$.confirm({
							theme: 'supervan',
						    title: '',
						    content: '',
						    onContentReady: function () {
						    	this.setContent(data.html);
						    },
						    columnClass: 'xl',
						    buttons: {
						    	close: function(){}
							}
						});
					}
				}

				js.remove_overlay();
			},
			error: function (responseData, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	// Start - Ajax form submit ___
	if($(".ajxfrm").length)
	{
		$(".ajxfrm").each(function() {

			$(this).submit(function(e) {

				e.preventDefault();

				//get which button submit is click.
				var clicked = document.activeElement.getAttribute('name');

				$(this).find(':submit').prop("disabled", true);

				ajx.process($(this), clicked);

			});
		});
	}

	ajx.process = function(frm, clicked)
	{
		var $frm = frm,
			frmid = frm.attr('id'),
			_frmid = frmid.split('-'),
			_name = _frmid[0],
			_method = $frm.find('input[name="_method"]').val(),
			cmd = $frm.find('input[name="cmd"]').val();

		// init loading ovelay, except `login` ;
		var loading = $frm.data('loading');

		if(loading ==='inline')
		{
			$('#'+ _name +'_msg').html($('#'+ _name +'_msg').data('loadtxt'));

		} else {
			js.loading_overlay('alt-');
		}

		// create new Form data instance
		var _frm = new FormData($("#"+ frmid)[0]);

		// add button submit name if have more than one button.
		clicked = typeof clicked !=undefined ? clicked : 'undefined';

		_frm.append('clicked', clicked);

		// check if have input files ;
		if($(".inputfile").length)
		{
			$files = $frm.find(".inputfile")[0].files;

			_frm.append('files', $files);
		}

		// add csrf token -o
		if(typeof local!='undefined')
		{
			_frm.append('local', local);
		}

		// add border styles to form elements ;
		var obj = ['input, select, textarea'];

		for(var i in obj)
		{
			var $tpm = $('#'+ frmid +' '+ obj[i]);

			jQuery.each($tpm, function(index, value) {

				var $itpm = $($tpm[index]);

				if($itpm.attr('type') !=='hidden')
				{
					$itpm.css({ border: '1px solid #bdbdbd' });
				}
			});
		}

		// remove existing file msg ;
		if($('#'+ frmid +" .msg").length)
		{
			$('#'+ frmid +" .msg").remove();
		}

		// start main Ajax for ajafrm
		$.ajax({
			url: setting.ajaxurl + cmd,
			type: "POST",
			dataType: 'json',
			data: _frm,
			contentType: false,
			cache: false,
			processData: false,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			success: function(data)
			{
				// remove disabled submit ;
				frm.find(':submit').prop("disabled", false)
					.removeAttr("disabled");

				if(loading ==='inline')
				{
					$('#'+ _name +'_msg').html('');
				}

				if(data !==null)
				{
					if(data && 'html' in data && $("#html").length)
					{
						$("#html").html(data['html']);
					}

					if(frm.data("validate"))
					{
						run.validate(frm, data);

					} else {
						run[_name](frm, data);
					}
				}
			},
			error: function (responseData, textStatus, errorThrown) {

				$("#"+ _name +"_msg").html(textStatus);

				frm.find(':submit').prop("disabled", false)
					.removeAttr("disabled");
			}
		});
	};

	run.validate = function(frm, data)
	{
		var frmid = frm.attr('id'),
			_frmid = frmid.split('-'),
			_reset = frm.data('reset'),
			_reload = frm.data('reload'),
			_name = _frmid[0];

		// remove old message err. ;
		$('#'+ frm.attr('id') +' .msg').remove();

		// re-direct to Url if response
		if('url' in data && data.url !='')
		{
			setTimeout(function() {
				window.location.href = data.url;
			}, 700);
		}

		// if has pop-up, use jQuery confirm
		if('popup' in data && data.popup.title && data.popup.content)
		{
			$.confirm({
				theme: 'supervan',
			    title: data.popup['title'],
			    content: data.popup['content'],
			    buttons: {
			        ok: {
			            text: "ok!",
			            btnClass: 'btn-primary',
			            keys: ['enter']
			        }
			    }
			});
		}

		// in case, there is some attached action
		if('action' in data && data.action !=null)
		{
			$.each(data.action, function(i, v) {
				switch(v.name) {
					case 'show_form':
						$.each(v.value.split(","), function(index, value) {
							if($("form#"+ val.trim()).length) {
								$("form#"+ val.trim()).removeClass("hidden");
							}
						});
						break;
					case 'hide_form':
						$.each(v.value.split(","), function(index, value) {
							if($("form#"+ val.trim()).length) {
								$("form#"+ val.trim()).addClass("hidden");
							}
						});
						break;
					default: break;
				}
			});
		}

		// if has no Errors,
		if(data.result)
		{
			js.loading_saved();

			// call-back function ;
			if('callback' in data)
			{
				run[data.callback](frm, data);
			}

			if(_reset==true)
			{
				var inputs = document.getElementById(frmid).elements;

				jQuery.each(inpts, function(key, value) {
					var $inputs = inpts[key];
					// if($inputs.data("except") =='reset') {}
				});

				frm.trigger('reset');
			}

			if(_reload==true)
			{
				setTimeout(function() { location.reload(); }, 700);
			}

			// Required FIXED, remove .file, regard reset |not ;
			if($(".file").length)
			{
				jQuery.each($(".file"), function(k,v) {
					// console.log($(this));
				});
			}

		} else {

			// validate Errors if existed ;
			if('errors' in data && data.errors !='undefined')
			{
				$.each(data.errors, function(index, value) {

					// if index is array, remove `.` ;
					index = index.indexOf('.') != -1 ? index.replace('.', '_') :index;

					// border error ;
					var error = '1px solid red';

					// select type ;
					var $select = $("#"+ frmid +" select[name^="+ index +"]");
						$select.css({ border:error });

					if($select.is('[class*="flexibled"]'))
					{
 						$select.closest('.flexibled-error').find('#for-'+ index).append(js.jalert('danger', value));

					} else if($select.is('[class*="chosen-select"]')) {

						$select.parent().append(js.jalert('danger', value));

					} else {
						$select.after(js.jalert('danger', value));
					}


					// input type ;
					var $input = $("#"+ frmid +" input[name^="+ index +"]");
						$input.css({ border:error });

					if($input.is(''))
					{
						$input.parent().after(js.jalert('danger', value));

					} else if($input.is('[class*="datetime"], [class*="flexibled"], [class*="file"], [class*="checkbox"], [class*="radio"]')) {

						// file with realtime_upload ;
						if($input.hasClass('flexibled'))
						{
							$input.closest('.flexibled-error').find('#for-'+ index).append(js.jalert('danger', value));

						} else if($input.hasClass('file')) {

							$input.closest('.flexibled-error').find('#for-'+ value.name).append(js.jalert('danger', value));

						} else if($input.hasClass('datetime')) {

							$input.parent().after(js.jalert('danger', value));

						} else {
							$input.closest('label').append(js.jalert('danger', value));
						}

					} else {
						// normal input type ;
						$input.after(js.jalert('danger', value));
					}

					// textarea type ;
					var $textarea = $("#"+ frmid +" textarea[name^="+ index +"]");
						$textarea.css({ border:error });

					if($textarea.is('[class*="g-recaptcha-response"]'))
					{
						if($textarea.closest('.g-recaptcha').hasClass("flexibled"))
						{
							$textarea.closest('.g-recaptcha').closest('.flexibled-error')
								.find('#for-'+ index).append(js.jalert('danger', value));

						} else {
							$textarea.parent().after(js.jalert('danger', value));
						}

					} else if($textarea.is('[class*="flexibled"]')) {

						// tinyMCE type ;
						$textarea.closest('.flexibled-error').find('#for-'+ index).append(js.jalert('danger', value));

					} else {
						// normal textarea type ;
						$textarea.after(js.jalert('danger', value));
					}
				});
			}

			// remove loading ;
			js.loading_error(data.msg);
		}
	};
	// End - Ajax Form submitted ____


	// Start - Ajax Table listing
	run.total_col = function (tblid)
	{
		var total_col = $("#"+tblid+" table > thead").find("> tr:first > th").length;

		return {col: total_col};
	}

	if($(".datalist").length)
	{
		$(".datalist").each(function()
		{
			var tblid = $(this).attr('id');
			var qry_data = run.total_col(tblid);

			if($(".searchinputs").length)
			{
				$(".searchinputs").each(function() {
					if(typeof $(this).data('ignore') =='undefined') {
						$(this).change(function(e) { ajx.list_nav(tblid, qry_data); });
					}
				});

				$(".btn_search").each(function() {
					$(this).click(function(e) { ajx.list_nav(tblid, qry_data); });
				});
			}

			ajx.list_nav(tblid, qry_data);
		});
	}

	ajx.list_nav = function(cmd, data)
	{
		/* check query data */
		if($("#"+ cmd +" .searchinputs").length)
		{
			$("#"+ cmd +" .searchinputs" ).each(function(e) {
				data[$(this).attr('id')] = $(this).val();
			});
		}

		/* Start navigation btn */
		$("#"+ cmd +" .nav_first").unbind('click').click(function(e) { ajx.show_list('first', cmd, data); });
		$("#"+ cmd +" .nav_prev").unbind('click').click(function(e) { ajx.show_list('prev', cmd, data); });
		$("#"+ cmd +" .nav_next").unbind('click').click(function(e) { ajx.show_list('next', cmd, data); });
		$("#"+ cmd +" .nav_last").unbind('click').click(function(e) { ajx.show_list('last', cmd, data); });
		$("#"+ cmd +" .nav_rows_per_page").unbind('change').change(function(e) { ajx.show_list('', cmd, data); });
		$("#"+ cmd +" .nav_current_page").unbind('change').change(function(e) { ajx.show_list('goto', cmd, data); });

		ajx.show_list('', cmd, data);
	}

	ajx.show_list= function(nav_action, cmd, data)
	{
		$("#"+ cmd +" .nav_info").html('<span>'+ $("#"+ cmd +" .nav_info").data('loadtxt') +'</span>');

		var current_page = $("#"+ cmd +" .nav_current_page").val(),
			rows_per_page = $("#"+ cmd +" .nav_rows_per_page").val();

		/* store Cookie */
		// js.set_cookie('row_per_page', rows_per_page, 7);

		// init ajax call
		$.ajax({
			url: setting.ajaxurl + cmd,
			type: "POST",
			dataType: 'json',
			data: {
				qry_data: data,
				current_page: current_page,
				rows_per_page: rows_per_page,
				nav_action: nav_action
			},
			contentType: false,
			cache: false,
			processData: false,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			success: function(data)
			{
				if(data !==null) {

					/* check if invalid token | usersession */
					if('result' in data && !data.result) { return; }

					$("#"+ cmd +" tbody").html(data.list);
					$("#"+ cmd +" .nav_current_page").val(data.target_page);

					if(nav_action=='refresh' || nav_action=='')
					{
						$("#"+ cmd +" .nav_current_page").empty();

						$.each(data.goto_select_page, function(key, value) {
							$("#"+ cmd +" .nav_current_page").append($("<option></option>").attr("value", key).text(value));
						});
					}

					$("#"+ cmd +" .nav_info").html(data.list_nav_info);

					if($(".custom_evt").length)
					{
						setAjaxFunction($(this));
					}

					$.each(data.nav_btn_disabled, function (key, jdata)
					{
						if(jdata==1) {
							$("#"+ cmd +" ."+ key).removeClass('disabled');

						} else {
							$("#"+ cmd +" ."+ key).addClass('disabled');
						}
					});
				}
			},
			error: function (responseData, textStatus, errorThrown)
			{
				$("#"+ frm_name +"_msg").html(textStatus);
			}
		});
	};
	// End - Ajax table listing ___


	// ++++++++++++++++++++++++++++++++++++++++ Customize goes below ++++++++++++++++++++++++++++++++++++

	run.abc = function(frm,data){
		console.log(data);
		$("#myModal").modal('hide');
		$.ajax({
				url: 'events',
				type: "get",
				success: function(events) {
					  $('#calendar').fullCalendar('removeEvents');
		              $('#calendar').fullCalendar('addEventSource', events);         
		              $('#calendar').fullCalendar('rerenderEvents' );
				},
				error: function (responseData, textStatus, errorThrown) {
					console.log('error');
				}
			});

		// $('#calendar').fullCalendar( 'refetchEvents' );
	}

});





