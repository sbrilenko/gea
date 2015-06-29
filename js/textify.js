/*
 * Textify - Columnize, Paginate and Touch Your Long Text
 * Programmer: Fabio Ferrante
 * CodeCanyon: http://codecanyon.net/user/kernelstudio/portfolio
 *
 * If this script you like, please put a comment on codecanyon.
 *
 * Includes jQuery Easing v1.3
 * http://gsgd.co.uk/sandbox/jquery/easing/
 * Copyright (c) 2008 George McGinley Smith
 * jQuery Easing released under the BSD License.	
 *
 */ 
(function ($) {
    $.fn.textify = function (options) {
        defaults = {
            numberOfColumn: 2,
            margin: 20,
            padding: 15,
            width: "screen",
            height: "screen",
            showNavigation: true,
            textAlign: 'justify',
            isZoom: false,
        }
        var myVar;
        var options = $.extend(defaults, options);
        return this.each(function () {
            var $textify, columnWidth, columnHeight, $contentText, $page, $column, pagewidth, pageheight, $textifyNav, isList = false
            var $this = $(this)
            var $text = $(this)
                .clone(true)
            var $cache = $(this)            
            initTextify($text)
            $(window)
                .resize(function () {
                setPage()
                if (pagewidth !== $('.textify')
                    .width() || pageheight !== $('.textify')
                    .height()) {
                    clearInterval(myVar);
                    $this.empty()
                    $this.next('.textify_nav')
                        .remove();
                    myVar = setTimeout(function () {
                        initTextify($cache)
                    }, 200);
                }
            });

            function setPage() {
                if (options.width === 'auto') {
                    pagewidth = $this.width()
                } else if (options.width === 'screen') {
                    pagewidth = $(window)
                        .width()
                } else if (typeof (options.width) == "string") {
                    pagewidth = parseInt(options.width);
                    if (isNaN(options.width)) {
                        pagewidth = defaults.width;
                    }
                } else {
                    pagewidth = options.width
                }
                if (options.height === 'auto') {
                    pageheight = $this.height()
                } else if (options.height === 'screen') {
                    pageheight = $(window)
                        .height()
                } else if (typeof (options.height) === "string") {
                    pageheight = parseInt(options.height);
                    if (isNaN(options.height)) {
                        pageheight = defaults.height;
                    }
                } else {
                    pageheight = options.height
                }
                return [pagewidth, pageheight]
            }

            function initTextify(tt) {
                $text = tt.clone(true);
                $cache = tt.clone(true);
                setPage()
                options.startPage = 1
                $this.empty()
                    .append('<div class="textify"/>')
                    .children()
                    .css({
                    'height': pageheight,
                    'width': pagewidth
                })
                    .append('<div class="contentText"/>');

                columnWidth = Math.floor((pagewidth - (options.padding * 2) - (options.margin * (options.numberOfColumn - 1))) / options.numberOfColumn);
                columnHeight = pageheight - (options.padding * 2)
                $page = 1;
                $textify = $this.children(":first")
                $contentText = $textify.children(":first")
                touch()
                // if ($text.find('img')
                //     .length > 0) {
                //     $text.find('img')
                //         .each(function (i) {
                //         var srcImg = $(this)
                //             .attr('src')

                //         var thisImg = $(this)

                //         var img = $("<img />")
                //             .load(function () {
                //             setImage(this, thisImg)


                //             if ((i + 1) === $text.find('img')
                //                 .length) {
                //                 addPage()
                //             }
                //         })
                //             .error(function () {
                //             alert('There was a problem with the image file');
                //             return false;
                //         })
                //             .attr('src', srcImg)
                //     })
                // } else {
                    addPage()
                                    arrow()
                // }
            }

            // function setImage(element, thisImg) {
            //     if (element.width > columnWidth) {
            //         thisImg.css({
            //             'display': 'block',
            //             'width': columnWidth,
            //             'margin': 0,
            //             'padding': 0
            //         })
            //         thisNewHeight = element.height * thisImg.width() / element.width
            //         if (thisNewHeight >= columnHeight) {
            //             thisImg.css({
            //                 'display': 'block',
            //                 'width': 'auto',
            //                 'margin': 0,
            //                 'height': columnHeight,
            //                 'padding': 0
            //             })
            //         }
            //     } else {
            //         if (element.height >= columnHeight - 100) {
            //             thisImg.css({
            //                 'display': 'block',
            //                 'height': columnHeight - 100,
            //                 'margin': 0,
            //                 'padding': 0
            //             })
            //         } else {

            //             thisImg.css({
            //                 'display': 'block',
            //                 'margin-right': '20px',
            //                 'margin-top': '10px',
            //                 'margin-bottom': '10px'
            //             })
            //         }
            //     }
            // }

            function addPage() {
                $textify.children()
                    .css({
                    'height': pageheight,
                    'width': pagewidth * options.startPage
                })
                    .append('<div class="page' + options.startPage + '" />')
                    .children()
                    .css({
                    'height': pageheight - (options.padding * 2),
                    'width': pagewidth - (options.padding * 2),
                    'padding': options.padding,
                    'float': 'left'
                })
                $page = $textify.find('.page' + options.startPage);
                addColumns()
            }

            function optimizeText(text, box) {

                theBox = box
                if (text.contents()
                    .length > 0 && $text.text()
                    .length > 0) {
                    text.contents()
                        .each(function () {

                        model = $(this)

                            .clone()

                        model.appendTo(theBox);
                        if ($column.height() > columnHeight) {
                            model.detach();
                            analyzeContent($(this), theBox)
                            return false;
                        } else {
                            model.detach();
                            $(this)
                                .appendTo(theBox);
                        }
                    })
                }
            }

            function analyzeContent(obj, box) {
				
				
                if (obj.contents()
                    .length > 0 && $text.text()
                    .length > 0) {
					
                    if (obj[0].nodeType === 1) {
                        formatNode(obj)
                        // console.log('tag  '+tag)
                        // console.log('name  '+nodeName)
                        box.append(tag)
                        theBox = box.find(nodeName)
                            .last()
                    } else {
                        theBox = box
                    }

                    obj.contents()
                        .each(function (i) {

                        model = $(this)
                            .clone()
                        model.appendTo(theBox);
                        // console.log($(this))
                        if ($column.height() > columnHeight) {
                            model.detach();
                            if ($(this)
                                .contents()
                                .length > 0) {

                                analyzeContent($(this), theBox)
                                return false;


                            } else if ($(this)[0].nodeName === 'IMG') {
                                addColumns()
                                return false;
                            } else {
								if(obj[0].nodeName.toLowerCase() === "li"){
									isList=true
									
								} else {
									isList=false
								}

                                textify($(this), theBox)
                                return false;

                            }
                        } else {
                            model.detach();
                            $(this)
                                .appendTo(theBox);


                        }
                    })
                } else {

                    allPar = $(obj)
                        .text()
                        .split(".")
                        
                    y = 0
                    // console.log('allParY  '+allPar[y])
                    // console.log(allPar[y].length)
                    if ($column.height() <= columnHeight) {
                        while ($column.height() <= columnHeight) {
                                // console.log('apy  '+allPar[y])
                            // if (allPar[y].length != 0){
                            box.append(allPar[y] + '.')
                            // }
                            $prefinish = $text.html()

                            if($prefinish.indexOf('<br>') == 0){
                                // console.log('заменять должен')
                                $prefinish = $prefinish.replace('<br>','')
                            }
                            // console.log('prefinish:'+$prefinish)
                            var myRegExp = new RegExp("(?![^<>]*>)" + allPar[y] + '.')
                            news = $text.html()
                            news = news.replace(/\&nbsp\;/g, ' ')
                            news = news.replace(myRegExp, '');
                            $text.html(news)
                            // console.log('news  '+news)
                            y++
                        }
                        $text.html($prefinish)
                        box.html($(box)
                            .html()
                            .slice(0, box.html()
                            .lastIndexOf(allPar[y - 1])))
						
                        textify($text, theBox)
                    }



                }

            }

            function formatNode(obj) {
                nodeName = obj[0].nodeName.toLowerCase()
                var a, aLength, attributes, map;
                map = {};
                tag = '<' + nodeName
                attr = obj[0].attributes
                for (a = 0; a < attr.length; a++) {
                    if (attr[a].specified) {
                        tag = tag + ' ' + attr[a].name.toLowerCase() + '=' + attr[a].value
                    }
                }
                tag = tag + '/>'
                return [nodeName, tag]
            }

            function textify(text, box) {
                /*if (text[0].nodeName !== '#text') {
				
				addColumns()
			} else {*/
                // console.log('obj')
                // console.log(text)
                textString = $(text)
                    .text()
                    .replace(/\&nbsp\;/g, ' ')
                    // console.log('beforesplit  '+textString)
                allChars = textString.split(/\s+/)
                // console.log('split  '+allChars)
                y = 0
				if ($column.height() >= columnHeight) {
					isList = false
				}
                if ($column.height() <= columnHeight) {
                    while ($column.height() <= columnHeight) {

                        box.append(allChars[y] + ' ')                        
                        $prefinish = $text.html()
                        if ((allChars[y].indexOf('[') > -1) || (allChars[y].indexOf(']') > -1) || (allChars[y].indexOf('(') > -1) || (allChars[y].indexOf(')') > -1) || (allChars[y].indexOf('?') > -1) || (allChars[y].indexOf('.') > -1)) {
                            thisChar = allChars[y].replace(/[[]/g, '[[]')
                            thisChar = thisChar.replace(/[]]/g, '[]]')
                            thisChar = thisChar.replace(/[(]/g, '[(]')
                            thisChar = thisChar.replace(/[)]/g, '[)]')
                            thisChar = thisChar.replace(/[?]/g, '[?]')
                            thisChar = thisChar.replace(/[.]/g, '[.]')


                        } else if (allChars[y].indexOf('&') > -1) {
                            thisChar = "&amp;"
                        } else {
                            thisChar = allChars[y]
                        }
                        var myRegExp = new RegExp("(?![^<>]*>)" + thisChar)
                        // console.log(thisChar)
                        news = $text.html()
                        news = news.replace(/\&nbsp\;/g, ' ')
                        news = news.replace(myRegExp, '');
                        // console.log('textify news    '+news)
                        $text.html(news)
                        y++
                    }
                    $text.html($prefinish)

                    box.html($(box)
                        .html()
                        .slice(0, box.html()
                        .lastIndexOf(allChars[y - 1])))
                }

                addColumns()


                //}
            }

            function addColumns() {
                $column = $page.children(":last")
                $column.find('li')
                    .filter(function () {
                    return $(this)
                        .text() == ''
                })
                    .remove()
			
				if(isList){
					$text.find('li:first-child').css("list-style","none")
					isList = false
				}
                if (options.showNavigation) {
				
                    if ($textify.find('.textify_nav')
                        .length == 0) {
                        $textify.append('<div class="textify_nav" style="display:none"/>')
                            .children()
                            .last()
                            .css({
                            'left': Math.floor((pagewidth - $textify.find('.textify_nav')
                                .width()) / 2)
                        })
                            .append('<ul/>')
                            .children()
                            .attr('class', 'text_pagination')
                            .append(function () {
                            var pageNav = '';
                            $textifyNav = $textify.find('.text_pagination')
                            for (i = 0; i < options.startPage; i++) {
                                $('<li/>')
                                    .appendTo($textifyNav)
                                    .click(function () {
                                    activeNavigation($(this))
                                })
                                if (i === 0) {
                                    $textifyNav.find('li')
                                        .attr('class', 'selected')
                                }
                            }
                        })
                    }
                    columnHeight = pageheight - (options.padding * 2) - $('.textify_nav')
                        .outerHeight()

                 }
                if ($page.children()
                    .length < options.numberOfColumn) {
                    $page.append('<div class="column"/>');
                    $column = $page.children(":last")
                    if ($page.children()
                        .length !== options.numberOfColumn) {
                        $column.css('margin-right', options.margin)
                    }
                    $column.css({
                        'width': columnWidth,
                        'float': 'left',
                        'text-align': options.textAlign
                    });
                    setTimeout(function () {
                        optimizeText($text, $column)
                    }, 100);
                } else {
                    options.startPage++
                    if (options.showNavigation) {
                        if ($textify.find('.textify_nav')
                            .length > 0) {
                            $('<li/>')
                                .appendTo($textifyNav)
                                .click(function () {
                                activeNavigation($(this))
                            })
                            $textify.find('.textify_nav')
                                .css({
                                'left': Math.floor((pagewidth - $textify.find('.textify_nav')
                                    .width()) / 2)
                            })
                        }
                    }
                    $contentText.css('width', pagewidth * options.startPage)
                    $contentText.append('<div class="page' + options.startPage + '" />');
                    $page = $textify.find('.page' + options.startPage);
                    $page.css({
                        'height': pageheight - (options.padding * 2),
                        'width': pagewidth - (options.padding * 2),
                        'padding': options.padding,
                        'float': 'left'
                    });
                    $page.append('<div class="column"/>');
                    $column = $page.children(":last")
                    if ($textify.find('.column')
                        .length !== options.numberOfColumn) {
                        $column.css('margin-right', options.margin)
                    }
                    $column.css({
                        'width': columnWidth,
                        'float': 'left',
                        'text-align': options.textAlign
                    });
                    setTimeout(function () {
                        optimizeText($text, $column)
                    }, 100);
                }
                return false;
            }

            function activeNavigation(obj) {                
                $textify.find('.text_pagination li')
                    .removeClass('selected')
                obj.addClass('selected')
                marginLeft = pagewidth * obj.index()
                $contentText.animate({
                    marginLeft: [-marginLeft, 'easeOutExpo']
                }, 0);
                if($('text_pagination li:last-child').hasClass('selected')){
                    $('.right_ar').replaceWith('<a href="#" class="right_ar"></a>')
                }
            }
              
            function arrow(){
                var el =$(document).find('.left_ar, .right_ar')
                el.on('click',function(){
                    var btn = $(this)
                    var letter = $(document).find('.num_page span');
                 $textify.find('.text_pagination')
                 .children()
                .each(function() {
                        if ($(this).hasClass('selected')) {
                            if (btn.hasClass('right_ar') && ( ($(this)
                                .index() + 1) < $textify.find('.text_pagination')
                                .children()
                                .length)) {
                                if ((($(this).index() + 1) < $textify.find('.text_pagination').children().length) && ($('#next').val() == undefined)){
                                    $('.right_ar').hide()
                                }
                                //alert('право'
                                letter.html(letter.html().slice(0,-1)+String.fromCharCode(letter.html().charCodeAt(letter.html().length-1)+1))                                
                                obj = $(this)
                                    .next()
                            } else if (btn.hasClass('left_ar') && ($(this)
                                .index() + 1) > 1) {
                               // alert('лево')
                               letter.html(letter.html().slice(0,-1)+String.fromCharCode(letter.html().charCodeAt(letter.html().length-1)-1))
                               $('.right_ar').show();
                                obj = $(this)
                                    .prev()
                            } else {
                                //alert('куку')
                                //alert(btn.attr('class'))
                                obj = $(this)
                                if (btn.hasClass('right_ar')){
                                    var next_link = $('#next').val()
                                    // console.log(next_link)
                                    if(next_link != undefined){
                                    window.location.href = next_link                                    
                                    }
                                }
                                if (btn.hasClass('left_ar')){
                                    // window.location.href = "/"
                                    var prev_link = $('#prev').val()
                                    // console.log(prev_link)
                                    window.location.href = prev_link 
                                }
                           }
                            activeNavigation(obj)
                            return false;     
                            }
                            })
                

                })
            
            
            }  
            function touch() {
                var startX, offsetX, diffX, el = $contentText;
                el.live("gesturechange", function (e) {
                    options.isZoom = true;
                });
                el.live("gestureend", function (e) {
                    options.isZoom = false;
                });
                var letter = $(document).find('.num_page span')
                if (!options.isZoom) {
                    el.bind("touchstart touchmove touchend", function (e) {
                        if (e.originalEvent.touches.length > 1) return;
                        if (e.type == 'touchstart') {
                            offsetX = parseInt(el.css('margin-left'))
                            diffX = offsetX
                            startX = e.originalEvent.touches[0].pageX || e.originalEvent.changedTouches[0].pageX;
                            startY = e.originalEvent.touches[0].pageY || e.originalEvent.changedTouches[0].pageY;
                        } else if (e.type == 'touchmove') {
                            movX = e.originalEvent.changedTouches[0].pageX - startX;
                            movY = e.originalEvent.changedTouches[0].pageY - startY;
                            diffX = offsetX + movX;
                            if (Math.abs(movY) < Math.abs(movX)) {
                                el.css("margin-left", diffX + "px");
                                e.preventDefault();
                            }
                        } else if (e.type == 'touchend') {
                            if (Math.abs(movY) < Math.abs(movX)) {
                                $textify.find('.text_pagination')
                                    .children()
                                    .each(function () {
                                    if ($(this)
                                        .hasClass('selected') && offsetX !== diffX) {
                                        if ((diffX < offsetX) && (($(this)
                                            .index() + 1) < $textify.find('.text_pagination')
                                            .children()
                                            .length)) {
                                            letter.html(letter.html().slice(0,-1)+String.fromCharCode(letter.html().charCodeAt(letter.html().length-1)+1))
                                            obj = $(this)
                                                .next()
                                        } else if ((diffX > offsetX) && ($(this)
                                            .index() + 1) > 1) {
                                            letter.html(letter.html().slice(0,-1)+String.fromCharCode(letter.html().charCodeAt(letter.html().length-1)-1))
                                            obj = $(this)
                                                .prev()
                                        } else {
                                            obj = $(this)
                                        }
                                        diffX = offsetX
                                        activeNavigation(obj)
                                        return false;
                                    }
                                })
                            }
                        }
                    });
                }
            }
        })
    }
})(jQuery);