/** ---------------------------------------------------------------------------
	*											ImageResizer Plugin with JQuery
	* ---------------------------------------------------------------------------
	* Version: 1.0.0
	* Author: Fabrice K.E.M
	* Created: 10/06/2018
	* Repository: https://github.com/fabrice8/imageResizer
	*/
( function( factory ){
	
	if( typeof define === 'function' && define.amd )
		define( [ 'jquery' ], factory ) // AMD. Register as an anonymous module.
		
	else if( typeof module === 'object' && module.exports )
		module.exports = factory( require('jquery') ) // Node/CommonJS
		
	else factory( jQuery ) // Browser globals
	
}( function( $ ){
	'use strict'
	
	var OUTBOUNDS_COLOR = {
														black: 'rgba(20, 20, 20, .6)',
														white: 'rgba(250, 250, 250, .6)'
													},
			STATIC_RESIZE = false, // the get absolute input sizes
			AUTO_RESIZE = false, // scalable but keep the picture sizes format
			FREE_RESIZE = false // give ability to resize de image any how you want directly in the canvas
			
	if( typeof $ !== 'undefined' && $.hasOwnProperty( 'fn' ) )
		$.fn.imageResizer = core
		
	else throw new Error( 'Image Resizer\'s JavaScript requires jQuery' )
	
	// Touch screen JQuery support events binding
	$.fn.extend({
		touchend: function( fn ){ return fn ? this.bind( 'touchend', fn ) : this.trigger('touchend') },
		touchstart: function( fn ){ return fn ? this.bind( 'touchstart', fn ) : this.trigger('touchstart') },
		touchmove: function( fn ){ return fn ? this.bind( 'touchmove', fn ) : this.trigger('touchmove') }
	})
	
	function CreateResizeBox( option ){
		// Create the resizing hoster block
		
		return '<div class="R-container">'
							+'<div class="R-cover"></div>'
							
							+'<div class="R-adapter">'
								+'<canvas class="statCanvas"></canvas>'
							
								+'<div class="R-cropper'+( option.circleCrop ? ' circle' : '' )+'">'
									+'<canvas class="dynaCanvas"></canvas>'
									
									+'<div class="R-col-1"></div>'
									+'<div class="R-col-2"></div>'
									+'<div class="R-col-3"></div>'
									
									+'<div class="R-raw-1"></div>'
									+'<div class="R-raw-2"></div>'
									+'<div class="R-raw-3"></div>'
									
									+'<div class="R-corner-lt" data-action="lt-resize"></div>'
									+'<div class="R-corner-rt" data-action="rt-resize"></div>'
									+'<div class="R-corner-rb" data-action="rb-resize"></div>'
									+'<div class="R-corner-lb" data-action="lb-resize"></div>'
									
									+'<div class="R-side-left" data-action="l-resize"></div>'
									+'<div class="R-side-top" data-action="t-resize"></div>'
									+'<div class="R-side-right" data-action="r-resize"></div>'
									+'<div class="R-side-bottom" data-action="b-resize"></div>'
								+'</div>'
							+'</div>'
					+'</div>'
	}
	
	function Cropper( e, adapted, callback ){
		// Define the responsivity of the cropper ( resizer ) in function of the picture and his adaptation to the container
		
		var rendWidth = adapted.width,
				rendHeight = adapted.height,
				
				destinationWidth,
				destinationHeight
				
		if( e.ratio != 1 ){
			if( e.ratio < 1 ){
				// Si le width du format souhaité est inferieur au height
				
				// ----- ( axe X )
				destinationWidth = rendWidth < rendHeight ?
												// si l'image est HAUT
												( rendWidth / rendHeight ) > ( e.minWidth / e.minHeight ) ? // Test de sensibilité entre les rapports de l'image normal et du formatage
																				( e.minWidth * rendHeight ) / e.minHeight // Considerable par rapport au width
																				: rendWidth // Plus ou moins
												
												// si l'image est LARGE
												: e.minWidth < e.minHeight ? 
																( e.minWidth * rendHeight ) / e.minHeight // Considerable par rapport au height
																: rendWidth // Plus ou moins
				// ----- ( axe Y )
				destinationHeight = rendWidth < rendHeight ? 
											// si l'image est HAUT
											( rendWidth / rendHeight ) > ( e.minWidth / e.minHeight ) ?// Test de sensibilité entre les rapports de l'image normal et du formatage
																					rendHeight // Plus ou moins
																					: ( e.minHeight * rendWidth ) / e.minWidth // Considerable par rapport au width
																					
											// si l'image est LARGE 
											: e.minWidth < e.minHeight ? 
														rendHeight // Plus ou moins
														: rendWidth * ( e.minHeight / rendHeight ) // Considerable par rapport au height
			} else {
				// Si le width du format souhaité est superieur au height ( commentaire inverse )
				
				destinationWidth = rendWidth < rendHeight ?
																					rendWidth 
																					: ( rendWidth / rendHeight ) > ( e.minWidth / e.minHeight ) ? 
																																												( e.minWidth * rendHeight) / e.minHeight 
																																												: rendWidth
				destinationHeight = rendWidth < rendHeight ? 
																					( e.minHeight * rendWidth ) / e.minWidth 
																					: ( rendWidth / rendHeight ) > ( e.minWidth / e.minHeight ) ? 
																																												rendHeight 
																																												: rendWidth * ( e.minHeight / rendHeight )
			}
		}
		else destinationWidth = destinationHeight = rendWidth < rendHeight ? rendWidth : rendHeight
		
		callback({
						width: destinationWidth,
						height: destinationHeight,
						left: adapted.HzImage ? ( rendWidth - destinationWidth ) / 2 : 0,
						top: adapted.HzImage ? 0 : ( rendHeight - destinationHeight ) / 2
					})
	}
	
	function AdaptImg( e, CONTAINER, callback ){
		// Adapt the image format to the container ( adaptation by responsive )
		var 
		rendWidth = e.width,
		rendHeight = e.height,
		horizontalImage = e.width >= e.height,
		rendTop = 0,
		rendLeft = 0
		
		if( horizontalImage ){
			if( e.width > CONTAINER.width() ){
				rendHeight *= CONTAINER.width() / rendWidth
				rendWidth = CONTAINER.width()
				
				rendTop = ( CONTAINER.height() - rendHeight ) / 2
			} 
			else {
				rendWidth *= CONTAINER.height() / rendHeight
				rendHeight = CONTAINER.height()
				
				rendLeft = ( CONTAINER.width() - rendWidth ) / 2
			}
		} else {
			rendWidth *= CONTAINER.height() / rendHeight
			rendHeight = CONTAINER.height()
			rendLeft = ( CONTAINER.width() - rendWidth ) / 2
		}
		
		callback({ 
			width: rendWidth, 
			height: rendHeight,
			left: rendLeft,
			top: rendTop,
			HzImage: e.width != e.height ? e.width > e.height : null
		})
	}
	
	function validateIMG( img, options, callback ){
	
		var 
		MIN_SIZES = { width: 80, height: 80 }, // minimus size of image
		FORMAT
		
		if( /x/.test( options.imgFormat ) ){
			// Format 320x400, 1000/740, ...
			FORMAT = options.imgFormat.split('x')
			
			MIN_SIZES.width = Number( FORMAT[0] )
			MIN_SIZES.height = Number( FORMAT[1] )
			
			STATIC_RESIZE = true
			AUTO_RESIZE = false
			FREE_RESIZE = false

			$('.R-container [data-action]').hide()
		}
		else if( /[1-9]\/[1-9]/.test( options.imgFormat ) ){
			// Format 3/2, 1/6 ...
			FORMAT = options.imgFormat.split('/')
		
			MIN_SIZES.width *= Number( FORMAT[0] )
			MIN_SIZES.height *= Number( FORMAT[1] )
			
			STATIC_RESIZE = false
			AUTO_RESIZE = true
			FREE_RESIZE = false
			
			$('.R-container [data-action]').show()
			$('.R-container [class^=R-side-]').hide()
		} 
		else { 
			// automatic format and changeable
			STATIC_RESIZE = false
			AUTO_RESIZE = false
			FREE_RESIZE = true
			$('.R-container [data-action]').show()
		}
		
		img.width >= MIN_SIZES.width && img.height >= MIN_SIZES.height ?
						callback({
							width: img.width,
							height: img.height,
							minWidth: MIN_SIZES.width,
							minHeight: MIN_SIZES.height,
							ratio: Number( MIN_SIZES.width ) / Number( MIN_SIZES.height )
						})
						: $(".R-container").html( '<div class="R-error">This image is smaller than '+ MIN_SIZES.width +'x'+ MIN_SIZES.height +'</div>' )
	}
	
	function core( options, callback ){
		
		/**---------------------------------------- resizer input configurations ----------------------------------------**/
		
		var OPTIONS = $.extend({
														image: false,
														imgFormat: 'auto', // Formats: 3/2, 200x360, auto
														device: 'all', // lg-md, sm-xs
														circleCrop: false, // true => circle, square ( by default )
														zoomable: true,
														zoomMax: 2,
														outBoundColor: 'black', // black, white
														btnDoneAttr: '.R-container .R-btn-done'
													}, options ),
				IMG_URL
				
		/**---------------------------------------- Create and init the resizer DOM components ----------------------------------------**/
		
		$(this).html( CreateResizeBox( OPTIONS ) )
		
		var  
		_IMG_ = new Image(),
		$_HOSTER = $(this),
		$_CONTAINER = $(".R-container"),
		$_ADAPTER = $(".R-adapter"),
		$_CROPPER = $(".R-cropper"),
		$_COVER = $(".R-cover"),
		
		$_TRIGGERS = $('[class^="R-side-"], [class^="R-corner-"]')
		
		
		if( OPTIONS.image )
			IMG_URL = typeof OPTIONS.image !== 'string' ? window.URL.createObjectURL( OPTIONS.image ) : OPTIONS.image // create URL in case the IMG is a blob file
		
		else $_CONTAINER.html( '<div class="R-error">Configuration Error: Set the image URL or blob image file as options.image </div>' )
		
		/**---------------------------------------- Load and init the new image created ----------------------------------------**/
		
		_IMG_.onload = function(){
			
			/*************** Validate input image and apply resize configurations ***************/
			validateIMG( _IMG_, OPTIONS, function( originDetails ){
				
				/**---------------------------------------- init resize box elements variables ----------------------------------------**/
				
				var 
				_statCanvas = document.querySelector(".statCanvas"),
				_dynaCanvas = document.querySelector(".dynaCanvas"),
				
				ctx_Static = _statCanvas.getContext("2d"),
				ctx_Dynamic = _dynaCanvas.getContext("2d")
						
				// static (container) and dynamic (cropper) canvas contexts
				ctx_Dynamic.imageSmoothingEnabled = true
				ctx_Dynamic.imageSmoothingQuality = 'high'
						
				// given the picture size to the static canvas
				_statCanvas.width = $_CONTAINER.width()
				_statCanvas.height = $_CONTAINER.height()
				
				/*************** Adapt the picture to the container ( responsive ) ***************/
				AdaptImg( originDetails, $_CONTAINER, function( ADAPTED ){
					// Cover only the space of the image
					$_COVER.css({
						left: ADAPTED.left +'px', 
						top: ADAPTED.top +'px', 
						right: ADAPTED.left +'px', 
						bottom: ADAPTED.top +'px', 
						background: OUTBOUNDS_COLOR[ OUTBOUNDS_COLOR.hasOwnProperty( OPTIONS.outBoundColor ) ? OPTIONS.outBoundColor : 'black' ]
					})
					
					/*************** Position and the size of the image resizer ( cropper ) in function of the container ***************/
					Cropper( originDetails, ADAPTED, function( CROPPED ){
					
						$_CROPPER.css({ // 4 => _CROPPER border width
							width: _dynaCanvas.width = CROPPED.width - 4,
							height: _dynaCanvas.height = CROPPED.height - 4,
							left: CROPPED.left +'px', 
							top: CROPPED.top +'px' 
						})
						
						/**---------------------------------------- init variables ----------------------------------------**/
						
						// Cropper moving limits
						var 
						MoveLimitLeft = 0,
						MoveLimitTop = 0,
						MoveLimitRight = ADAPTED.width - _dynaCanvas.width,
						MoveLimitBottom = ADAPTED.height - _dynaCanvas.height,
						
						// Cropper resizing limits
						ResizeLimitLeft = 0,
						ResizeLimitTop = 0,
						ResizeLimitRight = ResizeLimitLeft + ADAPTED.width,
						ResizeLimitBottom = ResizeLimitTop + ADAPTED.height,

						// Cropper minimun sizes
						MIN_WIDTH = $_CROPPER.width() / 2,
						MIN_HEIGHT = $_CROPPER.height() / 2,
						
						// transition informations variables
						NO_MOVE = false, // variable of transition between moving and resizing scale
						ZOOMING = { width: ADAPTED.width, height: ADAPTED.height, left: 0, top: 0 }, // init image zoom sizes and position
						MOVING = {}, // moving informations
						RESIZING = {}, // resizing informations
							
						// Static canvas zooming informations
						zoomUp = true,
						deffZoom = 0,
						zoom = 1
					
						/**---------------------------------------- init canvas images ----------------------------------------**/
						
						ctx_Static.drawImage( _IMG_, 0, 0, ADAPTED.width, ADAPTED.height ); // Set picture into the static canvas
						$_ADAPTER.css({ left: ADAPTED.left, top: ADAPTED.top, width: ADAPTED.width, height: ADAPTED.height }) // init the cropper sizes and position
						
						// Load first shot of image into the dynamic canvas ( cropper )
						ctx_Dynamic.drawImage( _statCanvas, CROPPED.left+2, CROPPED.top+2, CROPPED.width, CROPPED.height, 0, 0, CROPPED.width, CROPPED.height )
						
						/**---------------------------------------- events ----------------------------------------**/
						
						$_CROPPER.mousedown( function(e){
							
							if( !NO_MOVE ){
								
								MOVING.t = $_CROPPER
								MOVING.x = e.pageX - $_CROPPER.position().left
								MOVING.y = e.pageY - $_CROPPER.position().top
							}
							
							MoveLimitRight = ADAPTED.width - $_CROPPER.width()
							MoveLimitBottom = ADAPTED.height - $_CROPPER.height()
						} )
						
						.dblclick( function( e ){
							// zooming container image
							if( !OPTIONS.zoomable ) return 
						
							zoom == 1 ? zoomUp = true : null
							zoom > ( OPTIONS.zoomMax - 0.5 ) ? zoomUp = false : null
							
							MOVING.ox = Math.floor( e.pageX - $_COVER.offset().left )
							MOVING.oy = Math.floor( e.pageY - $_COVER.offset().top )
									
							zooming( zoomUp )
						} )
						
						.touchstart( function(e){
							if( !NO_MOVE ){
								
								MOVING.t = $_CROPPER
								MOVING.x = e.originalEvent.touches[0].clientX - $_CROPPER.position().left
								MOVING.y = e.originalEvent.touches[0].clientY - $_CROPPER.position().top
							}
							
							MoveLimitRight = ADAPTED.width - $_CROPPER.width()
							MoveLimitBottom = ADAPTED.height - $_CROPPER.height()
						} )
						
						$_TRIGGERS.mousedown( function(e){
							NO_MOVE = true
							
							RESIZING.t = $(this)
							RESIZING.topHeight = $_CROPPER.position().top + $_CROPPER.height() // to calculate TOP by scale LEFT movement in AUTO RESIZING
						} )
						
						$(document).mouseup( function(){ stop() } )
						
						.mousemove( function(e){
							e.preventDefault()
							if( !STATIC_RESIZE && RESIZING.t ) resizing( e, RESIZING )
						} )
						
						.touchend( function(){ stop() } )
						
						$_ADAPTER.mousemove( function(e){
							e.preventDefault()
							if( MOVING.t ) moving( e, MOVING )
						} )
						
						.touchmove( function(e){
							e.preventDefault()
							
							if( MOVING.t )
								moving( e, MOVING, true )
							
							else if( RESIZING.t && ( RESIZING.x || RESIZING.y ) )
								resizing( e, RESIZING, true )
						} )
						
						// Trigger event when the resizing is declare as done
						$( OPTIONS.btnDoneAttr ).click( function(){ ( callback )( _dynaCanvas.toDataURL( 'image/jpeg' ) ) } )
						
						/**---------------------------------------- pilote functions ----------------------------------------**/
						
						function moving( e, MOVING, touch ){
							// moving cropper in the container
							
							// Cropper moving position
							var LEFT = ( touch ? e.originalEvent.touches[0].clientX : e.pageX ) - MOVING.x,
									TOP = ( touch ? e.originalEvent.touches[0].clientY : e.pageY ) - MOVING.y,
									
									M_X = ( LEFT >= MoveLimitLeft && LEFT <= ( MoveLimitRight - 4 ) ),
									M_Y = ( TOP >= MoveLimitTop && TOP <= ( MoveLimitBottom - 4 ) )
									
									
							M_X ? $_CROPPER.css( 'left', LEFT +'px' ) : LEFT = $_CROPPER.position().left
							M_Y ? $_CROPPER.css( 'top', TOP +'px' ) : TOP = $_CROPPER.position().top
							
							if( zoom > 1 ){
								// showing zoomed image ( out of the container sizes ) in function of the position of the mouse
								ctx_Static.clearRect( 0, 0, ZOOMING.width, ZOOMING.height );
								
								// mouse position
								MOVING.ox = Math.floor( e.pageX - $_COVER.offset().left )
								MOVING.oy = Math.floor( e.pageY - $_COVER.offset().top )
								
								// ration between original and zoomed image sizes
								// deffZoom = ( zoom - ( zoom > 1 ? ( zoom / 2 ) : 0 ) )
								
								ctx_Static.drawImage(_IMG_, -MOVING.ox * deffZoom, -MOVING.oy * deffZoom, ZOOMING.width, ZOOMING.height )
							}
							
							/* Note: left & top (+2) is to compensate the border size deficit */
							ctx_Dynamic.drawImage( _statCanvas, LEFT+2,  TOP+2, $_CROPPER.width(), $_CROPPER.height(), 0, 0, $_CROPPER.width(), $_CROPPER.height() ) // image of this position
						}
						
						function resizing( e, RESIZING, touch ){
							// Cropper image resizing
							
							// cropper left and top side postion
							var 
							POS_X = ( touch ? e.originalEvent.touches[0].pageX : e.pageX ) - $_CROPPER.offset().left,
							POS_Y = ( touch ? e.originalEvent.touches[0].pageY : e.pageY ) - $_CROPPER.offset().top,
									
							// image relative position
							LEFT = ( touch ? e.originalEvent.touches[0].clientX : e.clientX ) - $_ADAPTER.offset().left,
							TOP = ( touch ? e.originalEvent.touches[0].clientY : e.clientY ) - $_ADAPTER.offset().top,
							
							SC_WIDTH,
							SC_HEIGHT
							
							/* Note: left & top (+2) is to compensate the border size deficit */
							switch( RESIZING.t.data('action') ){
								case 'l-resize': SC_WIDTH = $_CROPPER.width() - POS_X;
								
															if( ResizeLimitLeft <= LEFT && SC_WIDTH > MIN_WIDTH ){
																
																$_CROPPER.css({ 'width': SC_WIDTH +'px', 'left': LEFT +'px' })
																_dynaCanvas.width = SC_WIDTH
																
																ctx_Dynamic.drawImage( _statCanvas, LEFT+2, $_CROPPER.position().top+2, SC_WIDTH, $_CROPPER.height(), 0, 0, SC_WIDTH, $_CROPPER.height() )
															}
										break;
										
								case 'r-resize': SC_WIDTH = POS_X;

															if( ResizeLimitRight-4 >= LEFT && SC_WIDTH > MIN_WIDTH ){
																
																$_CROPPER.css( 'width', SC_WIDTH +'px' )
																_dynaCanvas.width = SC_WIDTH
																
																ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, $_CROPPER.position().top+2, SC_WIDTH, $_CROPPER.height(), 0, 0, SC_WIDTH, $_CROPPER.height() )
															}
										break;

								case 't-resize': SC_HEIGHT = $_CROPPER.height() - POS_Y;
															
															if( ResizeLimitTop <= TOP && SC_HEIGHT > MIN_HEIGHT ){
																
																$_CROPPER.css({ 'height': SC_HEIGHT +'px', 'top': TOP +'px' })
																_dynaCanvas.height = SC_HEIGHT
																
																ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, TOP, $_CROPPER.width()+2, SC_HEIGHT, 0, 0, $_CROPPER.width(), SC_HEIGHT )
															}
										break;
										
								case 'b-resize': SC_HEIGHT = POS_Y;
															
															if( ResizeLimitBottom-4 >= TOP && SC_HEIGHT > MIN_HEIGHT ){
																
																$_CROPPER.css( 'height', SC_HEIGHT +'px' )
																_dynaCanvas.height = SC_HEIGHT
																
																ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, $_CROPPER.position().top+2, $_CROPPER.width(), SC_HEIGHT, 0, 0, $_CROPPER.width(), SC_HEIGHT )
															}
										break;
								
								case 'lt-resize': SC_WIDTH = $_CROPPER.width() - POS_X
															SC_HEIGHT = $_CROPPER.height() - POS_Y
																
															if( AUTO_RESIZE ){
																// proportional resizing ( width <=> height )
																
																if( ResizeLimitLeft <= LEFT && SC_WIDTH > MIN_WIDTH ){
																	
																	SC_HEIGHT = SC_WIDTH / originDetails.ratio
																	TOP = RESIZING.topHeight - SC_HEIGHT
																	
																	if( ResizeLimitTop <= TOP && TOP <= ( ADAPTED.height - SC_HEIGHT - 4 ) && SC_HEIGHT > MIN_HEIGHT ){
																		
																		$_CROPPER.css({ 'width': SC_WIDTH +'px', 'height': SC_HEIGHT +'px', 'left': LEFT +'px', 'top': TOP +'px' })
																		_dynaCanvas.width = SC_WIDTH
																		_dynaCanvas.height = SC_HEIGHT
																		
																		ctx_Dynamic.drawImage( _statCanvas, LEFT+2, TOP+2, SC_WIDTH, SC_HEIGHT, 0, 0, SC_WIDTH, SC_HEIGHT )
																	}
																}
															} else {
																// free resizing
															
																if( ResizeLimitLeft <= LEFT && SC_WIDTH > MIN_WIDTH ){
																	
																	$_CROPPER.css({ 'width': SC_WIDTH +'px', 'left': LEFT +'px' })
																	_dynaCanvas.width = SC_WIDTH
																	
																	ctx_Dynamic.drawImage( _statCanvas, LEFT+2, $_CROPPER.position().top+2, SC_WIDTH, $_CROPPER.height(), 0, 0, SC_WIDTH, $_CROPPER.height() )
																}
																
																if( ResizeLimitTop <= TOP && SC_HEIGHT > MIN_HEIGHT ){
																	
																	$_CROPPER.css({ 'height': SC_HEIGHT +'px', 'top': TOP +'px' })
																	_dynaCanvas.height = SC_HEIGHT
																	
																	ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, TOP+2, $_CROPPER.width(), SC_HEIGHT, 0, 0, $_CROPPER.width(), SC_HEIGHT )
																}
															}
										break;
										
								case 'lb-resize': SC_WIDTH = $_CROPPER.width() - POS_X;
															SC_HEIGHT = POS_Y;
									
															if( AUTO_RESIZE ){
																// proportional resizing ( width <=> height )
																
																if( ResizeLimitLeft <= LEFT && SC_WIDTH > MIN_WIDTH ){
																	
																	SC_HEIGHT = SC_WIDTH / originDetails.ratio
																	
																	if( ResizeLimitBottom-4 >= TOP && SC_HEIGHT > MIN_HEIGHT && SC_HEIGHT < ( ADAPTED.height - $_CROPPER.position().top - 4 ) ){
																		
																		$_CROPPER.css({ 'width': SC_WIDTH +'px', 'height': SC_HEIGHT +'px', 'left': LEFT +'px' })
																		_dynaCanvas.width = SC_WIDTH
																		_dynaCanvas.height = SC_HEIGHT
																		
																		ctx_Dynamic.drawImage( _statCanvas, LEFT+2, $_CROPPER.position().top+2, SC_WIDTH, SC_HEIGHT, 0, 0, SC_WIDTH, SC_HEIGHT )
																	}
																}
															} else {
																// free resizing
																
																if( ResizeLimitLeft <= LEFT && SC_WIDTH > MIN_WIDTH ){
																	
																	$_CROPPER.css({ 'width': SC_WIDTH +'px', 'left': LEFT +'px' })
																	_dynaCanvas.width = SC_WIDTH
																	
																	ctx_Dynamic.drawImage( _statCanvas, LEFT+2, $_CROPPER.position().top+2, SC_WIDTH, $_CROPPER.height(), 0, 0, SC_WIDTH, $_CROPPER.height() )
																}
																
																if( ResizeLimitBottom-4 >= TOP && SC_HEIGHT > MIN_HEIGHT ){
																	
																	$_CROPPER.css( 'height', SC_HEIGHT +'px' )
																	_dynaCanvas.height = SC_HEIGHT
																	
																	ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, $_CROPPER.position().top+2, $_CROPPER.width(), SC_HEIGHT, 0, 0, $_CROPPER.width(), SC_HEIGHT )
																}
															}
										break;
										
								case 'rt-resize': SC_WIDTH = POS_X;
															SC_HEIGHT = $_CROPPER.height() - POS_Y;
								
															if( AUTO_RESIZE ){
																// proportional resizing ( width <=> height )
																
																if( ResizeLimitRight-4 >= LEFT && SC_WIDTH > MIN_WIDTH ){
																	
																	SC_HEIGHT = SC_WIDTH / originDetails.ratio
																	TOP = RESIZING.topHeight - SC_HEIGHT
																	
																	if( ResizeLimitTop <= TOP && SC_HEIGHT > MIN_HEIGHT ){
																		
																		$_CROPPER.css({ 'width': SC_WIDTH +'px', 'height': SC_HEIGHT +'px', 'top': TOP +'px' })
																		_dynaCanvas.width = SC_WIDTH
																		_dynaCanvas.height = SC_HEIGHT
																		
																		ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, TOP+2, SC_WIDTH, SC_HEIGHT, 0, 0, SC_WIDTH, SC_HEIGHT )
																	}
																	
																	RESIZING.lastLeft = LEFT
																}
															} else {
																// free resizing
																
																if( ResizeLimitRight-4 >= LEFT && SC_WIDTH > MIN_WIDTH ){
																	
																	$_CROPPER.css( 'width', SC_WIDTH +'px' )
																	_dynaCanvas.width = SC_WIDTH
																	
																	ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, $_CROPPER.position().top+2, SC_WIDTH, $_CROPPER.height(), 0, 0, SC_WIDTH, $_CROPPER.height() )
																}
																
																if( ResizeLimitTop <= TOP && SC_HEIGHT > MIN_HEIGHT ){
																	
																	$_CROPPER.css({ 'height': SC_HEIGHT +'px', 'top': TOP +'px' })
																	_dynaCanvas.height = SC_HEIGHT
																	
																	ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, TOP+2, $_CROPPER.width(), SC_HEIGHT, 0, 0, $_CROPPER.width(), SC_HEIGHT )
																}
															}
										break;
										
								case 'rb-resize': SC_WIDTH = POS_X;
															SC_HEIGHT = POS_Y;
								
															if( AUTO_RESIZE ){
																// proportional resizing ( width <=> height )
																
																if( ResizeLimitRight-4 >= LEFT && SC_WIDTH > MIN_WIDTH ){
																	
																	SC_HEIGHT = SC_WIDTH / originDetails.ratio
																	
																	if( ResizeLimitBottom-4 >= TOP && SC_HEIGHT > MIN_HEIGHT && SC_HEIGHT < ( ADAPTED.height - $_CROPPER.position().top - 4 ) ){
																		
																		$_CROPPER.css({ 'width': SC_WIDTH +'px', 'height': SC_HEIGHT +'px' })
																		_dynaCanvas.width = SC_WIDTH
																		_dynaCanvas.height = SC_HEIGHT
																		
																		ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, $_CROPPER.position().top+2, SC_WIDTH, SC_HEIGHT, 0, 0, SC_WIDTH, SC_HEIGHT )
																	}
																}
															} else {
																// free resizing
																	
																if( ResizeLimitRight-4 >= LEFT && SC_WIDTH > MIN_WIDTH ){
																	
																	$_CROPPER.css( 'width', SC_WIDTH +'px' )
																	_dynaCanvas.width = SC_WIDTH
																	
																	ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, $_CROPPER.position().top+2, SC_WIDTH, $_CROPPER.height(), 0, 0, SC_WIDTH, $_CROPPER.height() )
																}
																
																if( ResizeLimitBottom-4 >= TOP && SC_HEIGHT > MIN_HEIGHT ){
																	
																	$_CROPPER.css( 'height', SC_HEIGHT +'px' )
																	_dynaCanvas.height = SC_HEIGHT
																	
																	ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, $_CROPPER.position().top+2, $_CROPPER.width(), SC_HEIGHT, 0, 0, $_CROPPER.width(), SC_HEIGHT )
																}
															}
										break;
							}
						}
						
						function zooming( zoomUp ){
							// zoom container image
							
							ctx_Static.clearRect( 0, 0, ZOOMING.width, ZOOMING.height )
							
							if( zoomUp && zoom < OPTIONS.zoomMax ) zoom++ // zoom up
							else if( zoom > 1 ) zoom-- // zoom down
							
							// Zoomed image dimensions
							ZOOMING.width = ADAPTED.width * zoom
							ZOOMING.height = ADAPTED.height * zoom
							
							// ration between original and zoomed image sizes
							deffZoom = ( zoom - ( zoom > 1 ? ( zoom / 2 ) : 0 ) )
							
							// Zoomed image left & top position
							ZOOMING.left = zoom > 1 ? - MOVING.ox * deffZoom : 0
							ZOOMING.top = zoom > 1 ? - MOVING.oy * deffZoom : 0
							
							
							ctx_Static.drawImage( _IMG_, ZOOMING.left, ZOOMING.top, ZOOMING.width, ZOOMING.height )
							
							/* Note: left & top (+2) is to compensate the border size deficit */
							ctx_Dynamic.drawImage( _statCanvas, $_CROPPER.position().left+2, $_CROPPER.position().top+2, $_CROPPER.width(), $_CROPPER.height(), 0, 0, $_CROPPER.width(), $_CROPPER.height() )
						}
						
						function stop(){
							// init cropper moving and resizing informations
							
							NO_MOVE = false 
							MOVING = {}
							RESIZING = {}
						}
					} )
				} )
			} )
		}
		
		_IMG_.src = IMG_URL
	}
} ) )