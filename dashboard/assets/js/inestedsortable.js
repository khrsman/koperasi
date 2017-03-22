/**
 * 
 * Nested Sortable Plugin for jQuery/Interface.
 * 
 * Version 1.0.1
 *  
 *Change Log:
 * 1.0 
 *       Initial Release
 * 1.0.1
 *       Added noNestingClass option to prevent nesting in some elements.
 *
 *
 * Copyright (c) 2007 Bernardo de Padua dos Santos
 * Dual licensed under the MIT (MIT-LICENSE.txt) 
 * and GPL (GPL-LICENSE.txt) licenses.
 * 
 *  http://code.google.com/p/nestedsortables/
 * 
 */
jq141.iNestedSortable = {
	/*
	 * Called when an item is being dragged. Puts the sort helper in the proper place.
	 * The "e" argument passed in is the Sortable element.
	 */
	checkHover : function(e,o) {
		if(e.isNestedSortable){
			//A brand new NestedSortable hovering check
			jq141.iNestedSortable.scroll(e);
			return jq141.iNestedSortable.newCheckHover(e);
		} else {
			//The legacy hovering check performed by plain Sortables
			//I don't think "o" is even used, but it is in the function declaration
			return jq141.iNestedSortable.oldCheckHover(e,o);
		}
	},
	oldCheckHover : jq141.iSort.checkhover,
	newCheckHover : function (e) {
		if (!jq141.iDrag.dragged) {
			return;
		}
		if ( !(e.dropCfg.el.size() > 0) ) {
			return;
		}
			
		//we need to recalculate the position of the sortables, 
		//or there will be some mismatches
		if(!e.nestedSortCfg.remeasured) {
			jq141.iSort.measure(e);
			e.nestedSortCfg.remeasured = true;
		}
		
		//finds item that is on top of the one being dragged,
		//and in a compatible nesting level
		var precItem = jq141.iNestedSortable.findPrecedingItem(e);
		
		var shouldNest = jq141.iNestedSortable.shouldNestItem(e, precItem);
		var touchingFirst = (!precItem) ? jq141.iNestedSortable.isTouchingFirstItem(e) : false;
		var quit = false;
		
		//avoids doing things more than once
		if(precItem) {
			if(e.nestedSortCfg.lastPrecedingItem === precItem && e.nestedSortCfg.lastShouldNest === shouldNest) {
				quit = true;
			}
		}
		else if(e.nestedSortCfg.lastPrecedingItem === precItem && e.nestedSortCfg.lastTouchingFirst === touchingFirst) {
			quit = true;
		}
		e.nestedSortCfg.lastPrecedingItem = precItem;
		e.nestedSortCfg.lastShouldNest = shouldNest;
		e.nestedSortCfg.lastTouchingFirst = touchingFirst;
		if(quit) {return;}
		
		if (precItem !== null) {
			//there is an element on top of this one 
			//on the same nesting, or smaller
			if (shouldNest) {
				jq141.iNestedSortable.nestItem(e, precItem);
			} else  {
				jq141.iNestedSortable.appendItem(e, precItem);
			}
		} else if (touchingFirst) {
			//no element on top, but touches the first item on the list
			jq141.iNestedSortable.insertOnTop(e);	
		}

	},
	/*
	 * Auto scrolls the page when we are dragging an element.
	 */
	scroll: function(e) {

		if(!e.nestedSortCfg.autoScroll) {
			return false;
		}
		var sensitivity = e.nestedSortCfg.scrollSensitivity;
		var speed = e.nestedSortCfg.scrollSpeed;
		var pointer = jq141.iDrag.dragged.dragCfg.currentPointer;
		var docDim = jq141.iUtil.getScroll();
		if((pointer.y - docDim.ih) - docDim.t > -sensitivity) {
			window.scrollBy(0,speed);
		}
		if(pointer.y - docDim.t < sensitivity) {
			window.scrollBy(0,-speed);
		}
		//The two lines bellow are for horizontal scrolling. It is not needed.
		//if((pointer.x - docDim.iw) - docDim.l > -sensitivity) {window.scrollBy(speed,0);}
		//if(pointer.x - docDim.l < sensitivity) {window.scrollBy(-speed,0);}

	},
	/*
	 * Called when the item is released after a drag. 
	 * The argument passed in is the dragged element released.
	 */
	check : function(dragged) {
		//A brand new NestedSortable release check
		jq141.iNestedSortable.newCheck(dragged);

		//The legacy release check performed by plain Sortables
		return jq141.iNestedSortable.oldCheck(dragged);
	},
	oldCheck : jq141.iSort.check,
	newCheck : function(dragged) {
		//removes nesting styling
		if (jq141.iNestedSortable.latestNestingClass &&
			jq141.iNestedSortable.currentNesting) 
		{
			jq141.iNestedSortable.currentNesting
				.removeClass(jq141.iNestedSortable.latestNestingClass);
			jq141.iNestedSortable.currentNesting = null;
			jq141.iNestedSortable.latestNestingClass = "";
		}
		
		if(jq141.iDrop.overzone.isNestedSortable) {
			jq141.iDrop.overzone.nestedSortCfg.remeasured = false;
		}
		
	},
	/*
	 * Called when there is a need to serialize the
	 * NestedSortable, to send back to the server. The 
	 * parameter is a string with the id of the NestedSortable
	 * element, or an array of ids. If no parameter is passed,
	 * all nested sortables in the page will be serialized. The
	 * return value is an object with a 'hash' parameter, that
	 * contains a string for use in GET or POST, and a 'o' parameter,
	 * with contains a JavaScript object representation 
	 * of the item order.
	 */
	serialize: function(s) {
		if(jQuery('#' + s).get(0).isNestedSortable){
			//A brand new NestedSortable serialization
			return jq141.iNestedSortable.newSerialize(s);
		} else {
			//The legacy serialization
			return jq141.iNestedSortable.oldSerialize(s);
		}
	},
	oldSerialize: jq141.iSort.serialize,
	newSerialize: function (s) {
		var i;
		var h = ''; //url get string that represents the element order
		var currentPath = ''; 	//used so the recursive function can build h
		var o = {}; //json object that represents the element order
		var e; //NestedSortable element being worked on
		/*
		 * This recursive function will build the get string (h)
		 * and return the object (o) for a given NestedSortable.
		 */
		var buildHierarchySer = function(context) {
			var retVal = [];
			thisChildren = jQuery(context).children('.' + jq141.iSort.collected[s]);
			thisChildren.each( function(i) {
				
				//Extracts part of the HTML element ID that 
				//will be shown in the serialization, using a RegExp.
				var serId = jq141.attr(this,'id');
				if(serId && serId.match) {
					serId = serId.match(e.nestedSortCfg.serializeRegExp)[0];
				}
				
				
				if (h.length > 0) {
					h += '&';
				}
				h += s + currentPath + '['+i+'][id]=' + serId;
				retVal[i] = {id: serId};
				var newContext = jQuery(this).children(e.nestedSortCfg.nestingTag + "." + e.nestedSortCfg.nestingTagClass.split(" ").join(".")).get(0);
				var oldPath = currentPath;
				currentPath += '['+i+'][children]';
				var thisChildren = buildHierarchySer(newContext);
				if (thisChildren.length > 0) {
					retVal[i].children = thisChildren;
				}
				currentPath = oldPath;
			});
			return retVal;
		};

		//analises the parameter passed in
		if (s) {
			if (jq141.iSort.collected[s] ) {
				//when only one NestedSortable id was passed in
				e = jQuery('#' + s).get(0);
				o[s] = buildHierarchySer(e);
			} else {
				for ( a in s) {
					//when an array of NestedSortables ids was passed in
					if (jq141.iSort.collected[s[a]] ) {
						e = jQuery('#' + s[a]).get(0);
						o[s[a]] = buildHierarchySer(e);			
					}
				}
			}
		} else {
			//when nothing was passed in (we will serialize all)
			for ( i in jq141.iSort.collected){
				e = jQuery('#' + i).get(0);
				o[i] = buildHierarchySer(e);
			}
		}
		return {hash:h, o:o};
	},
	
	/*
	 * Finds the sortable item that is on top of the one being dragged,
	 * and in a compatible nesting level. Returns null if none was found.
	 */
	findPrecedingItem : function (e) {
		var largestY = 0;
		var preceding = jq141.grep(e.dropCfg.el, function(i) {
			//needs to be on top of the one being dragged
			var isOnTop = (i.pos.y < jq141.iDrag.dragged.dragCfg.ny) && (i.pos.y > largestY);
			if(!isOnTop) {
				return false;
			}
			
			//needs to be on the same nesting level or a "child" level
			var isSameLevel;
			if(e.nestedSortCfg.rightToLeft) {
				isSameLevel = (i.pos.x + i.pos.wb + e.nestedSortCfg.snapTolerance > jq141.iDrag.dragged.dragCfg.nx + jq141.iDrag.dragged.dragCfg.oC.wb);
			} else {
				isSameLevel = (i.pos.x - e.nestedSortCfg.snapTolerance < jq141.iDrag.dragged.dragCfg.nx);
			}
			if(!isSameLevel) {
				return false;
			}
			
			//can't be an element that is being dragged
			var isBeingDragged = jq141.iNestedSortable.isBeingDragged(e, i);
			if(isBeingDragged) {
				return false;
			}
			
			//got here because it is a match
			largestY = i.pos.y;
			return true;
		});
		
		if ( preceding.length > 0 ) {
			//the last one should be it
			return preceding[(preceding.length-1)];
		} else {
			//nothing above it
			return null;
		}
	},
	/*
	 * Checks if the item being dragged is on top and touching the first item on the list.
	 * Returns true or false.
	 */
	isTouchingFirstItem : function (e) {
		var lowestY;
		var firstItem = jq141.grep(e.dropCfg.el, function(i) {
			//needs to be on top of all elements already looked up
			var isBefore = (lowestY === undefined || i.pos.y < lowestY);
			if (!isBefore) {
				return false;
			}
			
			//can't be an element that is being dragged
			var isBeingDragged = jq141.iNestedSortable.isBeingDragged(e, i);
			if(isBeingDragged) {
				return false;
			}
			
			//got here because it is a match 
			lowestY = i.pos.y;
			return true;
		});
		if ( firstItem.length > 0 ) {
			//the last one should be it
			firstItem = firstItem[(firstItem.length-1)];
			return firstItem.pos.y < jq141.iDrag.dragged.dragCfg.ny + jq141.iDrag.dragged.dragCfg.oC.hb &&
				firstItem.pos.y > jq141.iDrag.dragged.dragCfg.ny;
		} else {
			return false;
		}
	},
	/*
	 * Checks to see if an element is being dragged. 
	 * You may de dragging an element by itself or by one of his ancestors.
	 * Returns true or false.
	 */
	isBeingDragged : function (e, elem) {
		var dragged = jq141.iDrag.dragged;
		
		//nothing being dragged
		if(!dragged) {
			return false;
		}
			
		//trivial case
		if(elem == dragged) {
			return true;
		}
		
		//looks for its ancestors
		if ( 
			jQuery(elem)
				.parents("." + e.sortCfg.accept.split(" ").join("."))
				.filter(function() {return this == dragged;}).length !== 0
			) {
			return true;
		} else {
			return false;
		}
	},
	shouldNestItem : function(e, precedingItem ) {
		//there should be a preceding item to be able to nest
		if(!precedingItem) {return false;}
		if(e.nestedSortCfg.noNestingClass &&
			jQuery(precedingItem).filter("." + e.nestedSortCfg.noNestingClass).get(0) === precedingItem)
			{return false;}
		//This code is to limit the levels of nesting that can be achieved
		//Development of this is currently halted.
		/*
		if(	e.nestedSortCfg.nestingLimit !== false) {
			//nesting level of the preceding item
			var nLevelPrec = jQuery(precedingItem)
				.parents("." + e.sortCfg.accept.split(" ").join("."))
				.length;
			
			//don't allow nesting
			if (nLevelPrec >= e.nestedSortCfg.nestingLimit) return false;
			
			//will hold the maximum level of nesting in the element being dragged
			var nLevelDrag = 0;
			
			//for each leaf element inside the dragged element (that have no elements nested to it)
			jQuery(e.nestedSortCfg.nestingTag + "." + e.nestedSortCfg.nestingTagClass.split(" ").join(".") + " > ." + e.sortCfg.accept.split(" ").join(".") + ":first-child", jq141.iDrag.dragged)
				.not("*["+e.nestedSortCfg.nestingTag + "." + e.nestedSortCfg.nestingTagClass.split(" ").join(".")+"]")
				.each( function(i) {
					var draggedIndex = 0;
					//finds out 
					var parentLength = jQuery(this).parents("." + e.sortCfg.accept.split(" ").join(".")).each(
						function(i) {
							draggedIndex = i;
							return this == jq141.iDrag.dragged;
						}
						).length;
					
					//here dradraggedIndex holds the index 
					//of the dragged element in the ancestors array of the leaf element
					var thisLevel = parentLength - draggedIndex;
					if (thisLevel > nLevelDrag )
						nLevelDrag = thisLevel;
					}
				);
				
			//don't allow nesting
			if (nLevelPrec + nLevelDrag > e.nestedSortCfg.nestingLimit) return false;
		}*/
		
		if (e.nestedSortCfg.rightToLeft) {
			return precedingItem.pos.x + precedingItem.pos.wb - (e.nestedSortCfg.nestingPxSpace - e.nestedSortCfg.snapTolerance) > jq141.iDrag.dragged.dragCfg.nx + jq141.iDrag.dragged.dragCfg.oC.wb;
		} else {
			return precedingItem.pos.x + (e.nestedSortCfg.nestingPxSpace - e.nestedSortCfg.snapTolerance) < jq141.iDrag.dragged.dragCfg.nx;
		} 
	},
	nestItem: function(e, parent) {
		//selects the nesting tag inside the parent
		var parentNesting = jQuery(parent).children(e.nestedSortCfg.nestingTag + "." + e.nestedSortCfg.nestingTagClass.split(" ").join(".") );
		var helper = jq141.iSort.helper;
		styleHelper = helper.get(0).style;
		styleHelper.width = 'auto'; //makes sure helper gets resized properly
		
		//if there is none, creates it
		if ( !parentNesting.size()) {
			var newUl = "<" + e.nestedSortCfg.nestingTag + " class='"+e.nestedSortCfg.nestingTagClass+"'></" + e.nestedSortCfg.nestingTag+">";
			// Place new nesting tag and adds style
			parentNesting = jQuery(parent).append(newUl).children(e.nestedSortCfg.nestingTag).css(e.nestedSortCfg.styleToAttach); 
		}
		
		//styles the nesting
		jq141.iNestedSortable.updateCurrentNestingClass(e, parentNesting );
		
		//does stuff before the helper is removed
		jq141.iNestedSortable.beforeHelperRemove(e);
		
		//puts the helper in the proper place.
		parentNesting.prepend(helper.get(0));
		
		//does stuff after the helper is inserted
		jq141.iNestedSortable.afterHelperInsert(e);
	},
	appendItem: function(e, itemBefore) {
		jq141.iNestedSortable.updateCurrentNestingClass(e, jQuery(itemBefore).parent() );
		jq141.iNestedSortable.beforeHelperRemove(e);
		jQuery(itemBefore).after(jq141.iSort.helper.get(0));
		jq141.iNestedSortable.afterHelperInsert(e);
	},
	insertOnTop: function (e) {
		jq141.iNestedSortable.updateCurrentNestingClass(e, e);
		jq141.iNestedSortable.beforeHelperRemove(e);
		jQuery(e).prepend(jq141.iSort.helper.get(0));
		jq141.iNestedSortable.afterHelperInsert(e);
	},
	beforeHelperRemove : function (e) {
		//hides the nesting when it becomes empty
		var parent = jq141.iSort.helper.parent(e.nestedSortCfg.nestingTag + "." + e.nestedSortCfg.nestingTagClass.split(" ").join("."));
		var numSiblings = parent
			.children("." + e.sortCfg.accept.split(" ").join(".") + ":visible")
			.size();	
		if(numSiblings === 0 && parent.get(0) !== e) {
			parent.hide();
		}
	},
	afterHelperInsert : function (e) {
		//displays the nesting after something is inserted
		var parent = jq141.iSort.helper.parent();
		if(parent.get(0) !== e) {
			parent.show();
		}
		e.nestedSortCfg.remeasured = false;
	},
	updateCurrentNestingClass : function(e, nestingElem) {
		
		var nesting = jQuery(nestingElem);
		
		if ((e.nestedSortCfg.currentNestingClass) && //makes sure a special class is desired
			(!jq141.iNestedSortable.currentNesting || nesting.get(0) != jq141.iNestedSortable.currentNesting.get(0)) ){ //avoids doing it on the same elem
			
			//removes from last nesting
			if(jq141.iNestedSortable.currentNesting) {
				jq141.iNestedSortable.currentNesting
					.removeClass(e.nestedSortCfg.currentNestingClass);
			}		
			
			if(nesting.get(0) != e) { //not root nesting
				jq141.iNestedSortable.currentNesting = nesting;
				
				//adds to this one
				nesting.addClass(e.nestedSortCfg.currentNestingClass);
				
				//this is need to remove the styling on "check"
				jq141.iNestedSortable.latestNestingClass = e.nestedSortCfg.currentNestingClass;
			} else {
				//don't style the "root nesting"
				
				//cleans up
				jq141.iNestedSortable.currentNesting = null;
				jq141.iNestedSortable.latestNestingClass = "";
			}
		}
	},
	destroy: function () {
		return this.each(
			function () {
				if(this.isNestedSortable) {
					this.nestedSortCfg = null;
					this.isNestedSortable = null;
					jQuery(this).SortableDestroy();
				}
			}
		);
	},
	build: function(conf) {
		if (conf.accept && jq141.iUtil && jq141.iDrag && jq141.iDrop && jq141.iSort) 
		{
			this.each(
				function() {
					this.isNestedSortable = true;
					this.nestedSortCfg = {
						noNestingClass : conf.noNestingClass ? conf.noNestingClass : false,
						rightToLeft : conf.rightToLeft ? true : false , 
						nestingPxSpace : parseInt(conf.nestingPxSpace, 10) || 30 ,
						currentNestingClass :  conf.currentNestingClass ? conf.currentNestingClass : "",
						nestingLimit : conf.nestingLimit ? conf.nestingLimit : false, //not implemented yet
						autoScroll : conf.autoScroll !== undefined ? conf.autoScroll == true : true,
						scrollSensitivity: conf.scrollSensitivity ? conf.scrollSensitivity : 20,
						scrollSpeed: conf.scrollSpeed ? conf.scrollSpeed : 20,
						serializeRegExp : conf.serializeRegExp ? conf.serializeRegExp : /[^\-]*$/
					};
										
					//a "do nothing" tolerance when nesting/un-nesting, to stop things from jumping up too quickly
					this.nestedSortCfg.snapTolerance = parseInt(this.nestedSortCfg.nestingPxSpace * 0.4, 10);
						
					//the tag that will be used to nest items to parent items
					this.nestedSortCfg.nestingTag = this.tagName;
					this.nestedSortCfg.nestingTagClass = this.className;
					
					//style that makes nested elements be padded to the right or to the left
					this.nestedSortCfg.styleToAttach = (this.nestedSortCfg.rightToLeft) ? 
						{"padding-left":0, "padding-right": this.nestedSortCfg.nestingPxSpace + 'px' }
						:{"padding-left": this.nestedSortCfg.nestingPxSpace + 'px', "padding-right": 0 };
					jQuery(this.nestedSortCfg.nestingTag, this)
						.css(this.nestedSortCfg.styleToAttach);
						
				}
			);
			
			//overides checkhover, check and serialize, without losing backwards compatilibity (eg. plain Sortables can stil be used) 
			jq141.iSort.checkhover = jq141.iNestedSortable.checkHover;
			jq141.iSort.check = jq141.iNestedSortable.check;
			jq141.iSort.serialize = jq141.iNestedSortable.serialize;
		}
		
		return this.Sortable(conf);
	}
};

//Extends jQuery to add the plugin.
jq141.fn.extend(
	{
		NestedSortable : jq141.iNestedSortable.build,
		NestedSortableDestroy: jq141.iNestedSortable.destroy
	}
);


//Monkey patches interface with some corrections, which are not applied to
//the 1.2 version yet. getScroll is needed by the autoScroll option.
jq141.iUtil.getScroll = function (e)
	{
		var t, l, w, h, iw, ih;
		if (e && e.nodeName.toLowerCase() != 'body') {
			t = e.scrollTop;
			l = e.scrollLeft;
			w = e.scrollWidth;
			h = e.scrollHeight;
			iw = 0;
			ih = 0;
		} else  {
			if (document.documentElement && document.documentElement.scrollTop) {
				t = document.documentElement.scrollTop;
				l = document.documentElement.scrollLeft;
				w = document.documentElement.scrollWidth;
				h = document.documentElement.scrollHeight;
			} else if (document.body) {
				t = document.body.scrollTop;
				l = document.body.scrollLeft;
				w = document.body.scrollWidth;
				h = document.body.scrollHeight;
			}
			iw = self.innerWidth||document.documentElement.clientWidth||document.body.clientWidth||0;
			ih = self.innerHeight||document.documentElement.clientHeight||document.body.clientHeight||0;
		}
		return { t: t, l: l, w: w, h: h, iw: iw, ih: ih };
	};