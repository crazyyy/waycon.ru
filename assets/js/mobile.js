// Mobile v2.2.1 (needed by some other scripts - has no effect by itself)
// Depends on:
//  - jQuery v1.7
function a7mobile(originalSettings) {
  var defaultSettings = {
      possibleResolutions: ['standard', 'mobile', 'tablet', 'phone']
    },
    settings = jQuery.extend({}, defaultSettings, originalSettings);

  var currentResolutions = [];
  this.evalMobile = function() {
    var prevRes = currentResolutions.slice();
    currentResolutions = [];
    jQuery.each(settings.possibleResolutions, function(k, v) {
      if (jQuery('.resdetector.' + v + 'only').css('display') != 'none') {
        if (jQuery.inArray(v, prevRes) === -1) {
          a7mobile.evalMobile.on[v].fire(true, v);
        }
        currentResolutions.push(v);
      } else if (jQuery.inArray(v, prevRes) !== -1) {
        a7mobile.evalMobile.on[v].fire(false, v);
      }
    });
  };
  this.initializeMobile = function() {
    jQuery.each(settings.possibleResolutions, function(k, v) {
      var jDetector = jQuery(document.createElement('div'));
      jDetector.addClass(v + 'only resdetector');
      jDetector.attr('id', v + 'detector');
      jDetector.append(document.createTextNode(' '));
      jQuery('body').append(jDetector);
    });
    a7mobile.evalMobile.on.initialize.fire();
    jQuery(window).on('resize', a7mobile.evalMobile);
    a7mobile.evalMobile();
    a7mobile.evalMobile.on.initialized.fire();
  };
  this.check = function(size) {
    return currentResolutions.indexOf(size) !== -1;
  };
  this.evalMobile.on = [];
  jQuery.each(settings.possibleResolutions, function(k, v) {
    a7mobile.evalMobile.on[v] = jQuery.Callbacks();
  });
  this.evalMobile.on.initialize = jQuery.Callbacks();
  this.evalMobile.on.initialized = jQuery.Callbacks();
  jQuery(window).ready(this.initializeMobile);
}
a7mobile.apply(a7mobile, {});

// GetQsParameters v1.0.0 (needed by some other scripts - has no effect by itself)
// Depends on:
//  - Mobile v2.0.0
a7mobile.getQsParameters = function(fullQueryString) {
  var result = {},
    tmp = [],
    queryString = fullQueryString.substr(1);
  if (typeof queryString != 'string' || !queryString.length)
    return result;
  queryString.split("&").forEach(function(item) {
    tmp = item.split("=");
    result[tmp[0]] = decodeURIComponent(tmp[1]);
  });
  return result;
};

// Plus v2.5.1 (adds a plus icon into mobile menus)
// Depends on:
//  - GetQsParameters v1.0.0
//  - Mobile v2.0.0
//  - jQuery v1.8
(function(originalSettings) {
  a7mobile.evalMobile.on.initialize.add(function() {
    var defaultQsParams = a7mobile.getQsParameters(location.search);
    defaultQsParams['type'] = 91;
    var defaultSettings = {
        liFilter: '*',
        resolutions: ['phone'],
        menue: '#menuehoch',
        getAjaxRequestModifications: null,
        subFilter: 'li.sub',
        autoSub: false,
        noAjaxMode: false,
        addPlusFunction: function(li) {
          var plus = jQuery(document.createElement('a')).text('+').addClass('plus');
          li.prepend(plus);
          return plus;
        }
      },
      settings = jQuery.extend({}, defaultSettings, originalSettings);

    var mobileLoaded = false,
      mobileLoading = false;
    var jMenuehoch = null;
    jMenuehoch = jQuery(settings.menue);
    jMenuehoch = jMenuehoch.add(jMenuehoch.children('ul')).filter('ul');

    function plus(showPlus) {
      function onClick(ev) {
        jQuery(this).closest('li').children('ul.pluslist').toggleClass('inactive');
        if (jQuery(this).closest('li').children('ul.pluslist').is(':visible')) {
          jQuery(this).text('-').addClass('minus');
        } else {
          jQuery(this).text('+').removeClass('minus');
        }
      }

      function addPlus(li) {
        for (var i = 0; i < li.length; i++) {
          settings.addPlusFunction(li.eq(i)).on('click', onClick);
        }
      }
      if (!mobileLoaded && !mobileLoading && showPlus) {
        var originalRequest = {
            'url': location.protocol + '//' + location.host + location.pathname,
            'type': 'GET',
            'data': defaultQsParams,
            //TODO: error handling
            'success': function(data, status, xhr) {
              var newDom = jQuery.parseHTML(data);
              var jNewMenu = jQuery(newDom).add(jQuery(newDom).children('ul')).filter('ul');
              jNewMenu.find('>li').filter(settings.liFilter).each(function() {
                var jNli = jQuery(this).addClass('pluslist');
                var jOli = jMenuehoch.find('>li').filter(settings.liFilter).eq(jNli.index());
                var jNcul = jNli.children('ul');
                var jOcul = jOli.children('ul');
                var jNuls = jNcul.add(jNcul.find('ul'));
                // Add class "inactive" to all contained uls
                jNuls.addClass('inactive pluslist');
                jOcul.addClass('nonpluslist');
                if (jOli.length > 0) jOli.append(jNcul);
                else jMenuehoch.append(jNli);
              });
              var jLis, lis;
              if (settings.autoSub) {
                lis = [];
                jMenuehoch.find(settings.liFilter).each(function(idx, el) {
                  if (jQuery(el).find('ul').length > 0) {
                    lis.push(el);
                  }
                });
                jLis = jQuery(lis);
              } else {
                jLis = jMenuehoch.find(settings.liFilter).filter(settings.subFilter);
              }
              addPlus(jLis);
              jLis.filter('.act, .cur').each(function(sk, sv) {
                onClick.call(jQuery(sv).children('.plus'), {});
              });
              mobileLoading = false;
              mobileLoaded = true;
            }
          },
          request = originalRequest;
        if (typeof settings.getAjaxRequestModifications == 'function') {
          request = jQuery.extend(originalRequest, settings.getAjaxRequestModifications(originalRequest));
        }
        if (settings.noAjaxMode) {
          request.success(jMenuehoch.prop('outerHTML'));
        } else {
          jQuery.ajax(request);
        }
        mobileLoading = true;
      }
    }
    jQuery.each(settings.resolutions, function(k, v) {
      a7mobile.evalMobile.on[v].add(plus);
    });
  });
})({
  resolutions: ['mobile'],
  menue: '#menuequer',
  liFilter: 'li',
  noAjaxMode: true
});

// HtmlSwitcher v1.1.3 (moves HTML elements in specific resolutions to other locations)
// Depends on:
//  - Mobile v2.0.0
//  - jQuery
(function(originalSettings) {
  a7mobile.evalMobile.on.initialize.add(function() {
    if (typeof a7js === 'undefined') a7js = {};
    if (typeof a7js.htmlswitcher === 'undefined') a7js.htmlswitcher = {};
    if (typeof a7js.htmlswitcher.additionalMovements === 'undefined') a7js.htmlswitcher.additionalMovements = [];
    var defaultSettings = {
        movements: []
      },
      settings = jQuery.extend({}, defaultSettings, originalSettings);
    settings.movements = settings.movements.concat(a7js.htmlswitcher.additionalMovements);
    // This variable serves only as template for cloning
    var jPlaceholder = jQuery(document.createElement('div'));
    jPlaceholder.addClass('htmlswitcher placeholder');
    // For each movement, ...
    jQuery.each(settings.movements, function(k, movement) {
      var jSources = jQuery(movement.source);
      // ... and each source of that movement, ...
      jSources.each(function() {
        // ... set jSource to a single source element ...
        var jSource = jQuery(this);
        // ... target to the target element of that source ...
        var target = movement.target;
        if (typeof target == 'function') {
          target = target(jSource);
        }
        var jTarget = jQuery(target);
        if (jTarget.length == 0) {
          return;
        }
        // ... and create a clone of the placeholder.
        var jThisPlaceholder = jPlaceholder.clone().addClass(movement.placeholderClass);
        // This function is called, once per active resolution.
        // The parameter `on` is true if the resolution is entered or false if the resolution is left.
        function doSwitch(on) {
          if (on) {
            jSource.before(jThisPlaceholder);
            switch (movement.insertionStrategy) {
              case 'after':
                jTarget.after(jSource);
                break;
              case 'before':
                jTarget.before(jSource);
                break;
            }
          } else {
            jThisPlaceholder.after(jSource);
            jThisPlaceholder.remove();
          }
        }
        jQuery.each(movement.resolutions, function(k, resolution) {
          a7mobile.evalMobile.on[resolution].add(doSwitch);
        });
      });
    });
  });
})({
  movements: [{
    source: '.csc-textpic-intext-left-nowrap:not(.csc-textpic-above, .csc-textpic-below) .csc-textpic-imagewrap, ' +
      '.csc-textpic-intext-right-nowrap:not(.csc-textpic-above, .csc-textpic-below) .csc-textpic-imagewrap, ' +
      '.csc-textpic-left:not(.csc-textpic-above, .csc-textpic-below) .csc-textpic-imagewrap, ' +
      '.csc-textpic-right:not(.csc-textpic-above, .csc-textpic-below) .csc-textpic-imagewrap',
    target: function(jEl) {
      return jEl.closest('.csc-textpic').find('.csc-textpic-text');
    },
    insertionStrategy: 'after',
    placeholderClass: 'csc-textpic-imagewrap',
    resolutions: ['phone']
  }]
});

// sidemenu v1.1.1 (toggles the 'openmenu' class of the html element when menuicon is clicked)
// Depends on:
//  - jQuery
(function(originalSettings) {
  var defaultSettings = {
      menuIcon: '.menuicon',
      backgroundElement: '#links',
      indicateClosedMenu: false
    },
    settings = jQuery.extend({}, defaultSettings, originalSettings);
  jQuery(document).ready(function() {
    var jMenuicon = jQuery(settings.menuIcon);
    var jBackgroundElement = jQuery(settings.backgroundElement);
    var jHtml = jQuery(document.documentElement);
    if (settings.indicateClosedMenu) {
      jHtml.addClass('closedmenu');
    }
    jMenuicon.on('click', function(e) {
      jHtml.toggleClass('openmenu');
      if (settings.indicateClosedMenu) {
        jHtml.removeClass('closedmenu');
      }
      e.preventDefault();
    });
    jBackgroundElement.on('click', function(e) {
      if (e.target == jBackgroundElement[0]) {
        jHtml.removeClass('openmenu');
        if (settings.indicateClosedMenu) {
          jHtml.addClass('closedmenu');
        }
      }
    });
  });
})({
  backgroundElement: '#menuequerwrap',
  indicateClosedMenu: true
});

// TelefonnummernJS v2.1.1 (adds tel:-protocol links to .telefonnummer's in the phone view)
// Depends on:
//  - Mobile v2.0
(function(originalSettings) {
  var defaultSettings = {
      resolutions: ['phone'],
      phoneNumerElements: '.telefonnummer'
    },
    settings = jQuery.extend({}, defaultSettings, originalSettings);

  var jEls = jQuery(settings.phoneNumerElements);

  function phoneNumbers(activate) {
    console.log(activate ? 'activate' : 'deactivate');
    if (activate) {
      jEls.each(function() {
        var jEl = jQuery(this);
        var a = document.createElement('a');
        a.href = 'tel:' + jEl.text().replace(/\s*\(0\)\s*|\s+/g, ' ').replace(/^\s*\+\s*/g, '+');
        jEl.wrap(a);
      });
    } else {
      jEls.each(function() {
        var jEl = jQuery(this);
        if (jEl.parent().prop("tagName") == 'A') {
          jEl.unwrap();
        }
      });
    }
  }

  a7mobile.evalMobile.on.initialize.add(function() {
    console.log('initialize');
    jQuery.each(settings.resolutions, function(k, resolution) {
      console.log('resolution: ' + resolution);
      a7mobile.evalMobile.on[resolution].add(phoneNumbers);
    });
  });
})({
  resolutions: ['mobile', 'standard'],
  phoneNumberElements: '.phonenumber'
});
// Print v1.0.0
// Depends on:
//  - Mobile v2.1
(function(originalSettings) {
  var defaultSettings = {
      emptyChecks: [],
      printEmptyClass: 'a7printempty'
    },
    settings = jQuery.extend({}, defaultSettings, originalSettings);

  var printMq = window.matchMedia('print');

  function beforePrint() {
    var emptyCheck;
    var jEl;
    for (var i = 0; i < settings.emptyChecks.length; i++) {
      emptyCheck = settings.emptyChecks[i];
      jEl = jQuery(emptyCheck.target);
      jEl.each(function() {
        var jTarget = jQuery(this);
        var jDescendants = jTarget.find(emptyCheck.descendants);
        jDescendants = jDescendants.filter(':visible').not('.noprint').not('.nostandard');
        if (jDescendants.length == 0) {
          jTarget.addClass(settings.printEmptyClass);
        }
      });
    }
  }

  function afterPrint() {
    jQuery('.' + settings.printEmptyClass).removeClass(settings.printEmptyClass);
  }
  printMq.addListener(function() {
    if (printMq.matches) {
      beforePrint();
    } else {
      afterPrint();
    }
  });
  jQuery(window).on('beforeprint', beforePrint).on('afterprint', afterPrint);
})({
  emptyChecks: [{
    target: '#unten',
    descendants: '#unten0 > * > *'
  }, {
    target: '#untenli, #untenmi',
    descendants: '> *'
  }]
});

// Accordion v1.1.11 (makes accordions work for elements of type .fulltext and .headeraccordion)
// Depends on:
// - jQuery 1.7
jQuery(function() {
  if (typeof a7js === 'undefined') a7js = {};
  if (typeof a7js.accordion === 'undefined') a7js.accordion = {};
  if (typeof a7js.accordion.fulltexts === 'undefined') a7js.accordion.fulltexts = [];

  function Fulltext(jFulltext) {
    var self = this;
    self.jFulltext = jFulltext.addClass('hidefulltext fulltext');
    self.jControlElements = jQuery([]);
    self.jAccordion = jQuery([]);
    self.createControlElement = function(jTemplate, actions) {
      var jEl = jTemplate.clone();
      self.convertToControlElement(jEl, actions);
      return jEl;
    };
    self.convertToControlElement = function(jEl, actions) {
      self.jControlElements = self.jControlElements.add(jEl);
      jEl.addClass('hidefulltext');
      var jClickables = jQuery([]);
      if ((actions & Fulltext.ACTION_OPEN) != 0)
        jClickables = jClickables.add(jEl.find('.more').andSelf().filter('.more'));
      if ((actions & Fulltext.ACTION_CLOSE) != 0)
        jClickables = jClickables.add(jEl.find('.close').andSelf().filter('.close'));
      jClickables.on('click', function() {
        var possibleActions = self.jFulltext.hasClass('showfulltext') ? Fulltext.ACTION_CLOSE : Fulltext.ACTION_OPEN;
        if (jQuery(this).hasClass('more') && (possibleActions & actions & Fulltext.ACTION_OPEN) != 0)
          self.open();
        if (jQuery(this).hasClass('close') && (possibleActions & actions & Fulltext.ACTION_CLOSE) != 0)
          self.close();
      });
    };
    self.close = function() {
      self.jFulltext.removeClass('showfulltext').addClass('hidefulltext');
      self.jControlElements.removeClass('showfulltext').addClass('hidefulltext');
      self.jAccordion.removeClass('accordionopened').addClass('accordionclosed');
      self.jFulltext.trigger('accordionclose', [self]);
    };
    self.open = function() {
      self.jFulltext.removeClass('hidefulltext').addClass('showfulltext');
      self.jControlElements.removeClass('hidefulltext').addClass('showfulltext');
      self.jAccordion.removeClass('accordionclosed').addClass('accordionopened');
      self.jFulltext.trigger('accordionopen', [self]);
    };
  }
  Fulltext.ACTION_OPEN = 0x01;
  Fulltext.ACTION_CLOSE = 0x02;
  a7js.accordion.Fulltext = Fulltext;
  var fulltext, i, jEl, jHeader, jContent;
  if (typeof window.a7js != 'undefined' && typeof window.a7js.accordionOpenElementHtml != 'undefined') {
    var jOpenElementTemplate = jQuery(window.a7js.accordionOpenElementHtml);
    var jCloseElementTemplate = null;
    if (typeof window.a7js.accordionCloseElementHtml != 'undefined')
      jCloseElementTemplate = jQuery(window.a7js.accordionCloseElementHtml);
    var jFulltexts = jQuery('.fulltext');
    if (typeof a7js.accordion.ignoreSelector !== 'undefined')
      jFulltexts = jFulltexts.not(a7js.accordion.ignoreSelector);
    for (i = 0; i < jFulltexts.length; i++) {
      fulltext = new Fulltext(jFulltexts.eq(i));
      fulltext.createControlElement(jOpenElementTemplate, Fulltext.ACTION_OPEN).insertAfter(fulltext.jFulltext);
      if (jCloseElementTemplate !== null)
        fulltext.createControlElement(jCloseElementTemplate, Fulltext.ACTION_CLOSE).insertAfter(fulltext.jFulltext);
      a7js.accordion.fulltexts.push(fulltext);
    }
  }
  var jAccordionContentElements = jQuery('.headeraccordion, .ceaccordion');
  for (i = 0; i < jAccordionContentElements.length; i++) {
    jEl = jAccordionContentElements.eq(i);
    jHeader = jEl.filter('.headeraccordion').find('.csc-header h1, .csc-header h2, .csc-header h3, .csc-header h4, .csc-header h5, .csc-header h6, .csc-header h7');
    jHeader = jHeader.add(jEl.filter('.ceaccordion').find('.csc').first());
    jHeader.addClass('more close');
    jContent = jEl.filter('.headeraccordion').find('.csc-header').parent().children().not('.csc-header');
    jContent = jContent.add(jEl.filter('.ceaccordion').find('.csc').not(jHeader));
    fulltext = new Fulltext(jContent);
    fulltext.convertToControlElement(jHeader, Fulltext.ACTION_OPEN | Fulltext.ACTION_CLOSE);
    fulltext.jAccordion = jEl.addClass('accordionclosed');
    a7js.accordion.fulltexts.push(fulltext);
  }
});

(function() {
  var settings = {};
  if (typeof window.a7js != 'undefined' && typeof window.a7js.pageScrollClass != 'undefined') {
    settings = window.a7js.pageScrollClass;
  }
  if (settings.active == 'undefined' || !settings.active) {
    return;
  }
  var isTop = false;
  jQuery(window).on('scroll', function() {
    var pos = window.scrollTop();
    if ((pos == 0) === isTop) {
      return;
    }
    if (pos == 0) {
      jQuery('body').addClass('scrolltop');
    } else {
      jQuery('body').removeClass('scrolltop');
    }
  });
})();

// a7m7.js v0.0.6
a7mobile.evalMobile.on.initialize.add(function() {
  // .h100 means a max height of 100% - so the element being 100% heigh is actually not garanteed
  var jParentsH100 = jQuery('.hvp .slider-wrapper *, .h100 .slider-wrapper *').parents('.csc, .csc *').add('.hvp, .h100');
  var jParentsH50 = jQuery('.h50 .slider-wrapper *').parents('.csc, .csc *').add('.h50');;
  var jParentsH33 = jQuery('.h33 .slider-wrapper *').parents('.csc, .csc *').add('.h33');;
  var jH100 = jQuery('.hvp.vhforce, .h100.vhforce');
  var jH50 = jQuery('.h50.vhforce');
  var jH33 = jQuery('.h33.vhforce');
  var jFixo = jQuery('#fixo');
  var active = true;

  function correctHeight() {
    if (!active) {
      return;
    }
    var vpInnerHeight = jQuery(window).height();
    vpInnerHeight -= jFixo.height();
    var jVpInclude = jQuery('.vhinclude');
    jVpInclude.each(function() {
      vpInnerHeight -= jQuery(this).height();
    });
    jParentsH100.css('max-height', '' + vpInnerHeight + 'px');
    jH100.css('height', '' + (vpInnerHeight) + 'px');
    jParentsH50.css('max-height', '' + vpInnerHeight / 2 + 'px');
    jH50.css('height', '' + (vpInnerHeight / 2) + 'px');
    jParentsH33.css('max-height', '' + vpInnerHeight / 3 + 'px');
    jH33.css('height', '' + (vpInnerHeight / 3) + 'px');
  }
  a7mobile.evalMobile.on.standard.add(function(isStandard) {
    active = isStandard;
    if (active) {
      jQuery(window).on('resize.a7m7', correctHeight);
      correctHeight();
    } else {
      jQuery(window).off('resize.a7m7');
      jParentsH100.css('max-height', '');
      jH100.css('height', '');
      jParentsH50.css('max-height', '');
      jH50.css('height', '');
      jParentsH33.css('max-height', '');
      jH33.css('height', '');
    }
  });
});

// AnchorJS v0.1.8
// a7MB, 25.06.15: Takes the hash of the current URI and sets the scroll position respecting the height of e.g. #fixo to an appropriate position.
function correctAnchorScroll(hash, forceJump) {
  var eFixo, height, eTarget, top, distance, i, fulltext;
  if (typeof hash == 'undefined') {
    hash = location.hash;
  }
  if (hash.length < 2) {
    return true;
  }
  hash = "" + hash;
  eTarget = document.getElementById(hash.substring(1));
  if (eTarget === null || (anchorJS.currentHash == hash && (typeof forceJump == 'undefined' || !forceJump))) {
    return true;
  }
  if (typeof a7js !== 'undefined' && typeof a7js.accordion !== 'undefined' && typeof a7js.accordion.fulltexts !== 'undefined') {
    for (i = 0; i < a7js.accordion.fulltexts.length; i++) {
      fulltext = a7js.accordion.fulltexts[i];
      if (fulltext.jFulltext.hasClass('showfulltext')) {
        continue;
      }
      var p = fulltext.jFulltext.add(fulltext.jControlElements).add(fulltext.jAccordion);
      if (p.filter(eTarget).length > 0 || p.find(eTarget).length > 0) {
        fulltext.jControlElements.filter('.more').trigger('click');
      }
    }
  }
  eFixo = document.getElementById(anchorJS.settings.contentOverlappingElementIds[0]);
  if (window.getComputedStyle(eFixo).getPropertyValue('position') != 'fixed') {
    return true;
  }
  height = eFixo.offsetHeight;
  top = eTarget.getBoundingClientRect().top - document.body.getBoundingClientRect().top - height;
  window.scrollTo(0, Math.max(0, top - 15));
  anchorJS.currentHash = hash;
}

function queueCorrectAnchorScroll(arg1, arg2) {
  window.setTimeout(function() {
    correctAnchorScroll(arg1, arg2);
  }, 0);
}

function getHashFromUrl(url) {
  var a = document.createElement('a');
  a.href = url;
  return a.hash;
}
if (window.addEventListener) {
  window.addEventListener('hashchange', function(ev) {
    queueCorrectAnchorScroll(getHashFromUrl(ev.newURL), true);
  });
  window.addEventListener('load', function() {
    queueCorrectAnchorScroll(void 0, true);
    window.setTimeout(function() {
      queueCorrectAnchorScroll(void 0, true);
    }, 1000);
  });
  window.addEventListener('focus', function() {
    queueCorrectAnchorScroll(void 0, true);
  });
  document.addEventListener('DOMContentLoaded', function() {
    document.removeEventListener('DOMContentLoaded', arguments.callee, false);
    correctAnchorScroll();
  }, false);
} else {
  window.attachEvent('hashchange', function() {
    queueCorrectAnchorScroll(void 0, true);
  });
  window.attachEvent('load', function() {
    queueCorrectAnchorScroll(void 0, true);
    window.setTimeout(queueCorrectAnchorScroll, 1000);
  });
  window.attachEvent('focus', function() {
    queueCorrectAnchorScroll(void 0, true);
  });
}
if (typeof jQuery != 'undefined') {
  jQuery(document).on('click', 'a[href*="#"]', function(e) {
    var sharpPos = this.href.indexOf('#');
    var beforeFragment = this.href.substr(0, sharpPos);
    var lSharpPos = location.href.indexOf('#');
    var lBeforeFragment = location.href.substr(lSharpPos);
    if (beforeFragment != lBeforeFragment) {
      return;
    }
    var fragment = this.href.substr(sharpPos + 1);

    if (correctAnchorScroll('#' + fragment, true) !== true) {
      e.preventDefault();
    }
  });
}

var anchorJS = {};
anchorJS.settings = {
  contentOverlappingElementIds: ['fixo']
};
jQuery.fn.positionTo = function(parent) {
  var jEl = this;
  var pos = {
    left: 0,
    top: 0
  };
  var tmpPos;
  var cc = 0;
  while (!jEl.is(parent)) {
    if (++cc >= 99) throw "Error in positionTo. The given parent is not an offset parent of this.";
    tmpPos = jEl.position();
    pos.left += tmpPos.left;
    pos.top += tmpPos.top;
    jEl = jEl.offsetParent();
  }
  return pos;
};
jQuery(document).ready(function() {
  if (typeof a7fxsettings != 'undefined' && a7fxsettings.scrollFade === true) {
    jQuery(window).on('load', function() {
      jQuery('.csc *, .fadetoview').addClass('fadetoview outofview');
      var jFadeInElements = jQuery('.outofview');
      jFadeInElements.each(function() {
        var jThis = jQuery(this);
        var offset = jThis.offset();
        var width = jThis.outerWidth();
        if (offset.left + width / 2 - 50 > jWindow.width() / 2) {
          jThis.addClass('fadefromright');
        } else if (offset.left + width / 2 + 50 < jWindow.width() / 2) {
          jThis.addClass('fadefromleft');
        }
      });
      setTimeout(scrollHandler, 1);
    });
    var jWindow = jQuery(window);

    function scrollHandler() {
      var jFadeInElements = jQuery('.outofview');
      var currentScroll = jWindow.scrollTop();
      var windowHeight = jWindow.height();
      jFadeInElements.each(function() {
        var jThis = jQuery(this);
        if (jThis.offset().top <= currentScroll + windowHeight * 1) {
          jThis.removeClass('outofview');
          jThis.one('transitionend', function() {
            jThis.removeClass('fadefromright fadefromleft fadetoview');
          });
        }
      });
      if (typeof a7js === 'undefined') a7js = {};
      if (typeof a7js.a7fx === 'undefined') a7js.a7fx = {};
      if (a7js.a7fx.bodyScrollSlideBackground !== false) {
        jQuery('body').css('background-position', 'center ' + ((currentScroll / (jQuery('#inhalt').height() - jWindow.height())) * 100) + '%');
      }
    }
    jQuery(window).on('scroll', scrollHandler);
    jQuery(window).on('resize', scrollHandler);
    setTimeout(scrollHandler, 1);
    setTimeout(scrollHandler, 1000);
    setTimeout(scrollHandler, 2000);
    setInterval(scrollHandler, 2000);
  }

  jQuery('.fxhovercoinimpulse img').each(function() {
    var jThis = jQuery(this);
    var jParent = jThis.parent();
    var jHoverParent;
    var jCsc = jThis.closest('.csc');
    var jFigure = jThis.closest('figure');
    if (jCsc.find('img').length == 1) {
      jHoverParent = jCsc;
    } else {
      jHoverParent = jFigure;
    }
    jHoverParent.on('mouseenter', function() {
      jParent.addClass('fxprepareanimation');
      setTimeout(function() {
        jParent.removeClass('fxprepareanimation');
        jParent.css({
          'animation-play-state': 'running'
        });
      }, 1);
    });
  });

  jQuery('.fxhovercoinimpulse img, .fxhovercoinspin img').each(function() {
    var jThis = jQuery(this);
    var jParent = jThis.parent();
    for (var i = 0; i < 10; i++) {
      jParent.append(jThis.clone().addClass('fxcoinbackside nr' + (i + 1)));
    }
    jThis.parent().addClass('fxcoinparent');
  });

  jQuery('.fxhoverspotlight .csc').on('mouseenter', function() {
    var jThis = jQuery(this);
    var jParent = jThis.closest('.fxhoverspotlight');
    jParent.addClass('active');
    jThis.addClass('active');
  });
  jQuery('.fxhoverspotlight .csc').on('mouseleave', function() {
    var jThis = jQuery(this);
    var jParent = jThis.closest('.fxhoverspotlight');
    jParent.removeClass('active');
    jThis.removeClass('active');
  });

  function adjustHoverCaptions() {
    jQuery('.fxhovercaption figure').each(function() {
      var jThis = jQuery(this);
      var jImg = jThis.find('img').first();
      var jFigCaption = jThis.find('figcaption');
      if (jFigCaption.length == 0) {
        return;
      }
      var jOffsetParent = jFigCaption.offsetParent();
      jFigCaption.css({
        'left': jImg.positionTo(jOffsetParent).left + "px",
        'top': jImg.positionTo(jOffsetParent).top + "px",
        'max-width': jImg.innerWidth() + "px",
        'max-height': jImg.innerHeight() + "px"
      });
      var jA = jThis.find('a');
      if (jA.length == 1) {
        jFigCaption.on('click', function() {
          location.href = jA.attr('href');
        });
        jThis.addClass('fxlink');
      }
    });
  }
  jQuery(window).on('resize scroll', adjustHoverCaptions);
  jQuery(window).on('load', function() {
    setTimeout(adjustHoverCaptions, 1000);
  });
});

// LoadSlide v0.0.1 (Slides down nivo slider elements after the page is done loading)
// Depends on:
// - jQuery
(function() {
  var jImageCycle;
  var animationDuration = 1; // in seconds
  jQuery(document).ready(function() {
    jImageCycle = jQuery('.tx-imagecycle-pi3');
    jImageCycle.css({
      'transition': 'max-height ' + animationDuration + 's',
      'max-height': '0',
      'overflow': 'hidden'
    });
  });
  jQuery(window).on('load', function() {
    function slideDown() {
      var height = jImageCycle.children('.nivoSlider').height();
      if (height < 10) {
        setTimeout(slideDown, 20);
      }
      jImageCycle.css({
        'max-height': height * 1.2
      });
      setTimeout(function() {
        jImageCycle.css({
          'transition': '',
          'max-height': '',
          'overflow': ''
        });
      }, animationDuration * 1000);
    }
    slideDown();
  });
})();

(function() {
  if (typeof a7js === 'undefined') a7js = {};
  if (typeof a7js.accordion === 'undefined') a7js.accordion = {};
  a7js.accordion.ignoreSelector = (typeof a7js.accordion.ignoreSelector === 'undefined' ? '' : a7js.accordion.ignoreSelector + ', ') + '.wayconaccordion, .wayconaccordion *';
  jQuery(document).ready(function() {
    if (typeof a7js === 'undefined' || typeof a7js.accordion === 'undefined') {
      setTimeout(this, 1);
    }
    var Fulltext = a7js.accordion.Fulltext;
    var i, jEl, jMore, jFulltext, fulltext, jEls;
    var jCloseElementTemplate = null;
    if (typeof window.a7js.accordionCloseElementHtml != 'undefined') {
      jCloseElementTemplate = jQuery(window.a7js.accordionCloseElementHtml);
    }
    jEls = jQuery('.wayconaccordion');
    for (i = 0; i < jEls.length; i++) {
      jEl = jEls.eq(i);
      jMore = jEl.find('.more');
      fulltext = new Fulltext(jEl.find('.fulltext'));
      fulltext.convertToControlElement(jMore, Fulltext.ACTION_OPEN);
      if (jCloseElementTemplate !== null) {
        fulltext.createControlElement(jCloseElementTemplate, Fulltext.ACTION_CLOSE).insertAfter(fulltext.jFulltext);
      }
      a7js.accordion.fulltexts.push(fulltext);
    }
  });
})();


// decrypt helper function
function decryptCharcode(n, start, end, offset) {
  n = n + offset;
  if (offset > 0 && n > end) {
    n = start + (n - end - 1);
  } else if (offset < 0 && n < start) {
    n = end - (start - n - 1);
  }
  return String.fromCharCode(n);
}
// decrypt string
function decryptString(enc, offset) {
  var dec = "";
  var len = enc.length;
  for (var i = 0; i < len; i++) {
    var n = enc.charCodeAt(i);
    if (n >= 0x2B && n <= 0x3A) {
      dec += decryptCharcode(n, 0x2B, 0x3A, offset); // 0-9 . , - + / :
    } else if (n >= 0x40 && n <= 0x5A) {
      dec += decryptCharcode(n, 0x40, 0x5A, offset); // A-Z @
    } else if (n >= 0x61 && n <= 0x7A) {
      dec += decryptCharcode(n, 0x61, 0x7A, offset); // a-z
    } else {
      dec += enc.charAt(i);
    }
  }
  return dec;
}
// decrypt spam-protected emails
function linkTo_UnCryptMailto(s) {
  location.href = decryptString(s, 2);
}

var docElement = document.documentElement;
docElement.className = docElement.className.replace(/(^|\s)no-js(\s|$)/, '$1$2') + 'js';
if (typeof window.a7js == 'undefined') window.a7js = {};
window.a7js.accordionOpenElementHtml = "<p class=\"buttonlook\"><a class=\"more\">more<\/a><\/p>";
window.a7js.accordionCloseElementHtml = "<p class=\"buttonlook\"><a class=\"close\">show less<\/a><\/p>";
window.a7fxsettings = {
  'scrollFade': true
};
window.a7js = window.a7js || {};
window.a7js.htmlswitcher = window.a7js.htmlswitcher || {};
window.a7js.htmlswitcher.additionalMovements = [{
  source: 'div#socialmediaicons',
  target: 'div.top',
  insertionStrategy: 'after',
  resolutions: ['mobile']
}];
