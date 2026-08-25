"use strict";

var _excluded = ["endValue"];
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _objectWithoutProperties(e, t) { if (null == e) return {}; var o, r, i = _objectWithoutPropertiesLoose(e, t); if (Object.getOwnPropertySymbols) { var n = Object.getOwnPropertySymbols(e); for (r = 0; r < n.length; r++) o = n[r], -1 === t.indexOf(o) && {}.propertyIsEnumerable.call(e, o) && (i[o] = e[o]); } return i; }
function _objectWithoutPropertiesLoose(r, e) { if (null == r) return {}; var t = {}; for (var n in r) if ({}.hasOwnProperty.call(r, n)) { if (-1 !== e.indexOf(n)) continue; t[n] = r[n]; } return t; }
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/* -------------------------------------------------------------------------- */
/*                                    Utils                                   */
/* -------------------------------------------------------------------------- */
var docReady = function docReady(fn) {
  // see if DOM is already available
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', fn);
  } else {
    setTimeout(fn, 1);
  }
};
var isRTL = function isRTL() {
  return document.querySelector('html').getAttribute('dir') === 'rtl';
};
var resize = function resize(fn) {
  return window.addEventListener('resize', fn);
};
var isIterableArray = function isIterableArray(array) {
  return Array.isArray(array) && !!array.length;
};
var camelize = function camelize(str) {
  var text = str.replace(/[-_\s.]+(.)?/g, function (_, c) {
    return c ? c.toUpperCase() : '';
  });
  return "".concat(text.substr(0, 1).toLowerCase()).concat(text.substr(1));
};
var getData = function getData(el, data) {
  try {
    return JSON.parse(el.dataset[camelize(data)]);
  } catch (e) {
    return el.dataset[camelize(data)];
  }
};

/* ----------------------------- Colors function ---------------------------- */

var hexToRgb = function hexToRgb(hexValue) {
  var hex;
  hexValue.indexOf('#') === 0 ? hex = hexValue.substring(1) : hex = hexValue;
  // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
  var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex.replace(shorthandRegex, function (m, r, g, b) {
    return r + r + g + g + b + b;
  }));
  return result ? [parseInt(result[1], 16), parseInt(result[2], 16), parseInt(result[3], 16)] : null;
};
var rgbaColor = function rgbaColor() {
  var color = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '#fff';
  var alpha = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0.5;
  return "rgba(".concat(hexToRgb(color), ", ").concat(alpha, ")");
};

/* --------------------------------- Colors --------------------------------- */

var getColor = function getColor(name) {
  var dom = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document.documentElement;
  return getComputedStyle(dom).getPropertyValue("--falcon-".concat(name)).trim();
};
var getColors = function getColors(dom) {
  return {
    primary: getColor('primary', dom),
    secondary: getColor('secondary', dom),
    success: getColor('success', dom),
    info: getColor('info', dom),
    warning: getColor('warning', dom),
    danger: getColor('danger', dom),
    light: getColor('light', dom),
    dark: getColor('dark', dom)
  };
};
var getSoftColors = function getSoftColors(dom) {
  return {
    primary: getColor('soft-primary', dom),
    secondary: getColor('soft-secondary', dom),
    success: getColor('soft-success', dom),
    info: getColor('soft-info', dom),
    warning: getColor('soft-warning', dom),
    danger: getColor('soft-danger', dom),
    light: getColor('soft-light', dom),
    dark: getColor('soft-dark', dom)
  };
};
var getGrays = function getGrays(dom) {
  return {
    white: getColor('white', dom),
    100: getColor('100', dom),
    200: getColor('200', dom),
    300: getColor('300', dom),
    400: getColor('400', dom),
    500: getColor('500', dom),
    600: getColor('600', dom),
    700: getColor('700', dom),
    800: getColor('800', dom),
    900: getColor('900', dom),
    1000: getColor('1000', dom),
    1100: getColor('1100', dom),
    black: getColor('black', dom)
  };
};
var hasClass = function hasClass(el, className) {
  !el && false;
  return el.classList.value.includes(className);
};
var addClass = function addClass(el, className) {
  el.classList.add(className);
};
var getOffset = function getOffset(el) {
  var rect = el.getBoundingClientRect();
  var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
  var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  return {
    top: rect.top + scrollTop,
    left: rect.left + scrollLeft
  };
};
function isScrolledIntoView(el) {
  var rect = el.getBoundingClientRect();
  var windowHeight = window.innerHeight || document.documentElement.clientHeight;
  var windowWidth = window.innerWidth || document.documentElement.clientWidth;
  var vertInView = rect.top <= windowHeight && rect.top + rect.height >= 0;
  var horInView = rect.left <= windowWidth && rect.left + rect.width >= 0;
  return vertInView && horInView;
}
var isElementIntoView = function isElementIntoView(el) {
  var position = el.getBoundingClientRect();
  // checking whether fully visible
  if (position.top >= 0 && position.bottom <= window.innerHeight) {
    return true;
  }

  // checking for partial visibility
  if (position.top < window.innerHeight && position.bottom >= 0) {
    return true;
  }
};
var breakpoints = {
  xs: 0,
  sm: 576,
  md: 768,
  lg: 992,
  xl: 1200,
  xxl: 1540
};
var getBreakpoint = function getBreakpoint(el) {
  var classes = el && el.classList.value;
  var breakpoint;
  if (classes) {
    breakpoint = breakpoints[classes.split(' ').filter(function (cls) {
      return cls.includes('navbar-expand-');
    }).pop().split('-').pop()];
  }
  return breakpoint;
};
var getCurrentScreenBreakpoint = function getCurrentScreenBreakpoint() {
  var currentBreakpoint = '';
  if (window.innerWidth >= breakpoints.xl) {
    currentBreakpoint = 'xl';
  } else if (window.innerWidth >= breakpoints.lg) {
    currentBreakpoint = 'lg';
  } else if (window.innerWidth >= breakpoints.md) {
    currentBreakpoint = 'md';
  } else {
    currentBreakpoint = 'sm';
  }
  var breakpointStartVal = breakpoints[currentBreakpoint];
  return {
    currentBreakpoint: currentBreakpoint,
    breakpointStartVal: breakpointStartVal
  };
};

/* --------------------------------- Cookie --------------------------------- */

var setCookie = function setCookie(name, value, expire) {
  var expires = new Date();
  expires.setTime(expires.getTime() + expire);
  document.cookie = "".concat(name, "=").concat(value, ";expires=").concat(expires.toUTCString());
};
var getCookie = function getCookie(name) {
  var keyValue = document.cookie.match("(^|;) ?".concat(name, "=([^;]*)(;|$)"));
  return keyValue ? keyValue[2] : keyValue;
};
var settings = {
  tinymce: {
    theme: 'oxide'
  },
  chart: {
    borderColor: 'rgba(255, 255, 255, 0.8)'
  }
};

/* -------------------------- Chart Initialization -------------------------- */

var newChart = function newChart(chart, config) {
  var ctx = chart.getContext('2d');
  return new window.Chart(ctx, config);
};

/* ---------------------------------- Store --------------------------------- */

var getItemFromStore = function getItemFromStore(key, defaultValue) {
  var store = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : localStorage;
  try {
    return JSON.parse(store.getItem(key)) || defaultValue;
  } catch (_unused) {
    return store.getItem(key) || defaultValue;
  }
};
var setItemToStore = function setItemToStore(key, payload) {
  var store = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : localStorage;
  return store.setItem(key, payload);
};
var getStoreSpace = function getStoreSpace() {
  var store = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : localStorage;
  return parseFloat((escape(encodeURIComponent(JSON.stringify(store))).length / (1024 * 1024)).toFixed(2));
};

/* get Dates between */

var getDates = function getDates(startDate, endDate) {
  var interval = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1000 * 60 * 60 * 24;
  var duration = endDate - startDate;
  var steps = duration / interval;
  return Array.from({
    length: steps + 1
  }, function (v, i) {
    return new Date(startDate.valueOf() + interval * i);
  });
};
var getPastDates = function getPastDates(duration) {
  var days;
  switch (duration) {
    case 'week':
      days = 7;
      break;
    case 'month':
      days = 30;
      break;
    case 'year':
      days = 365;
      break;
    default:
      days = duration;
  }
  var date = new Date();
  var endDate = date;
  var startDate = new Date(new Date().setDate(date.getDate() - (days - 1)));
  return getDates(startDate, endDate);
};

/* Get Random Number */
var getRandomNumber = function getRandomNumber(min, max) {
  return Math.floor(Math.random() * (max - min) + min);
};
var utils = {
  docReady: docReady,
  breakpoints: breakpoints,
  isRTL: isRTL,
  resize: resize,
  isIterableArray: isIterableArray,
  camelize: camelize,
  getData: getData,
  hasClass: hasClass,
  addClass: addClass,
  hexToRgb: hexToRgb,
  rgbaColor: rgbaColor,
  getColor: getColor,
  getColors: getColors,
  getSoftColors: getSoftColors,
  getGrays: getGrays,
  getOffset: getOffset,
  isScrolledIntoView: isScrolledIntoView,
  isElementIntoView: isElementIntoView,
  getBreakpoint: getBreakpoint,
  getCurrentScreenBreakpoint: getCurrentScreenBreakpoint,
  setCookie: setCookie,
  getCookie: getCookie,
  newChart: newChart,
  settings: settings,
  getItemFromStore: getItemFromStore,
  setItemToStore: setItemToStore,
  getStoreSpace: getStoreSpace,
  getDates: getDates,
  getPastDates: getPastDates,
  getRandomNumber: getRandomNumber
};

/* -------------------------------------------------------------------------- */
/*                                  Detector                                  */
/* -------------------------------------------------------------------------- */

var detectorInit = function detectorInit() {
  var _window = window,
    is = _window.is;
  var html = document.querySelector('html');
  is.opera() && addClass(html, 'opera');
  is.mobile() && addClass(html, 'mobile');
  is.firefox() && addClass(html, 'firefox');
  is.safari() && addClass(html, 'safari');
  is.ios() && addClass(html, 'ios');
  is.iphone() && addClass(html, 'iphone');
  is.ipad() && addClass(html, 'ipad');
  is.ie() && addClass(html, 'ie');
  is.edge() && addClass(html, 'edge');
  is.chrome() && addClass(html, 'chrome');
  is.mac() && addClass(html, 'osx');
  is.windows() && addClass(html, 'windows');
  navigator.userAgent.match('CriOS') && addClass(html, 'chrome');
};

/*-----------------------------------------------
|   DomNode
-----------------------------------------------*/
var DomNode = /*#__PURE__*/function () {
  function DomNode(node) {
    _classCallCheck(this, DomNode);
    this.node = node;
  }
  return _createClass(DomNode, [{
    key: "addClass",
    value: function addClass(className) {
      this.isValidNode() && this.node.classList.add(className);
    }
  }, {
    key: "removeClass",
    value: function removeClass(className) {
      this.isValidNode() && this.node.classList.remove(className);
    }
  }, {
    key: "toggleClass",
    value: function toggleClass(className) {
      this.isValidNode() && this.node.classList.toggle(className);
    }
  }, {
    key: "hasClass",
    value: function hasClass(className) {
      this.isValidNode() && this.node.classList.contains(className);
    }
  }, {
    key: "data",
    value: function data(key) {
      if (this.isValidNode()) {
        try {
          return JSON.parse(this.node.dataset[this.camelize(key)]);
        } catch (e) {
          return this.node.dataset[this.camelize(key)];
        }
      }
      return null;
    }
  }, {
    key: "attr",
    value: function attr(name) {
      return this.isValidNode() && this.node[name];
    }
  }, {
    key: "setAttribute",
    value: function setAttribute(name, value) {
      this.isValidNode() && this.node.setAttribute(name, value);
    }
  }, {
    key: "removeAttribute",
    value: function removeAttribute(name) {
      this.isValidNode() && this.node.removeAttribute(name);
    }
  }, {
    key: "setProp",
    value: function setProp(name, value) {
      this.isValidNode() && (this.node[name] = value);
    }
  }, {
    key: "on",
    value: function on(event, cb) {
      this.isValidNode() && this.node.addEventListener(event, cb);
    }
  }, {
    key: "isValidNode",
    value: function isValidNode() {
      return !!this.node;
    }

    // eslint-disable-next-line class-methods-use-this
  }, {
    key: "camelize",
    value: function camelize(str) {
      var text = str.replace(/[-_\s.]+(.)?/g, function (_, c) {
        return c ? c.toUpperCase() : '';
      });
      return "".concat(text.substr(0, 1).toLowerCase()).concat(text.substr(1));
    }
  }]);
}();
/* --------------------------------------------------------------------------
|                                 bg player
--------------------------------------------------------------------------- */
var bgPlayerInit = function bgPlayerInit() {
  var Selector = {
    DATA_YOUTUBE_EMBED: '[data-youtube-embed]',
    YT_VIDEO: '.yt-video'
  };
  var DATA_KEY = {
    YOUTUBE_EMBED: 'youtube-embed'
  };
  var ClassName = {
    LOADED: 'loaded'
  };
  var Events = {
    SCROLL: 'scroll',
    LOADING: 'loading',
    DOM_CONTENT_LOADED: 'DOMContentLoaded'
  };
  var youtubeEmbedElements = document.querySelectorAll(Selector.DATA_YOUTUBE_EMBED);
  var loadVideo = function loadVideo() {
    function setupPlayer() {
      window.YT.ready(function () {
        youtubeEmbedElements.forEach(function (youtubeEmbedElement) {
          var userOptions = utils.getData(youtubeEmbedElement, DATA_KEY.YOUTUBE_EMBED);
          var defaultOptions = {
            videoId: 'hLpy-DRuiz0',
            startSeconds: 1,
            endSeconds: 50
          };
          var options = window._.merge(defaultOptions, userOptions);
          var youTubePlayer = function youTubePlayer() {
            // eslint-disable-next-line
            new YT.Player(youtubeEmbedElement, {
              videoId: options.videoId,
              playerVars: {
                autoplay: 1,
                disablekb: 1,
                controls: 0,
                modestbranding: 1,
                // Hide the Youtube Logo
                loop: 1,
                fs: 0,
                enablejsapi: 0,
                start: options === null || options === void 0 ? void 0 : options.startSeconds,
                end: options === null || options === void 0 ? void 0 : options.endSeconds
              },
              events: {
                onReady: function onReady(e) {
                  e.target.mute();
                  e.target.playVideo();
                },
                onStateChange: function onStateChange(e) {
                  if (e.data === window.YT.PlayerState.PLAYING) {
                    document.querySelectorAll(Selector.DATA_YOUTUBE_EMBED).forEach(function (embedElement) {
                      embedElement.classList.add(ClassName.LOADED);
                    });
                  }
                  if (e.data === window.YT.PlayerState.PAUSED) {
                    e.target.playVideo();
                  }
                  if (e.data === window.YT.PlayerState.ENDED) {
                    // Loop from starting point
                    e.target.seekTo(options.startSeconds);
                  }
                }
              }
            });
          };
          youTubePlayer();
        });
      });
    }
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    tag.onload = setupPlayer;
  };
  if (document.readyState !== Events.LOADING) {
    loadVideo();
  } else {
    document.addEventListener(Events.DOM_CONTENT_LOADED, function () {
      return loadVideo();
    });
  }

  /* --------------------------------------------------------------------------
   |                                 Adjust BG Ratio
   --------------------------------------------------------------------------- */

  var adjustBackgroundRatio = function adjustBackgroundRatio() {
    var ytElements = document.querySelectorAll(Selector.YT_VIDEO);
    ytElements.forEach(function (ytEl) {
      var ytElement = ytEl;
      var width = ytElement.parentElement.offsetWidth + 200;
      var height = width * 9 / 16;
      var minHeight = ytElement.parentElement.offsetHeight + 112;
      var minWidth = minHeight * 16 / 9;
      ytElement.style.width = "".concat(width, "px");
      ytElement.style.height = "".concat(height, "px");
      ytElement.style.minHeight = "".concat(minHeight, "px");
      ytElement.style.minWidth = "".concat(minWidth, "px");
    });
  };
  adjustBackgroundRatio();
  document.addEventListener(Events.SCROLL, function () {
    return adjustBackgroundRatio();
  });
};

/* -------------------------------------------------------------------------- */
/*                                  Count Up                                  */
/* -------------------------------------------------------------------------- */

var countupInit = function countupInit() {
  if (window.countUp) {
    var countups = document.querySelectorAll('[data-countup]');
    countups.forEach(function (node) {
      var _utils$getData = utils.getData(node, 'countup'),
        endValue = _utils$getData.endValue,
        options = _objectWithoutProperties(_utils$getData, _excluded);
      var _fireCountUp = function fireCountUp() {
        var isInView = utils.isScrolledIntoView(node);
        if (isInView) {
          var countUp = new window.countUp.CountUp(node, endValue, _objectSpread({
            duration: 5
          }, options));
          if (!countUp.error) {
            countUp.start();
          } else {
            console.error(countUp.error);
          }
          window.removeEventListener('scroll', _fireCountUp);
        }
      };
      window.addEventListener('scroll', _fireCountUp);
    });
  }
};

/*-----------------------------------------------
|   Dashboard Table dropdown
-----------------------------------------------*/
var dropdownMenuInit = function dropdownMenuInit() {
  // Only for ios
  if (window.is.ios()) {
    var Event = {
      SHOWN_BS_DROPDOWN: 'shown.bs.dropdown',
      HIDDEN_BS_DROPDOWN: 'hidden.bs.dropdown'
    };
    var Selector = {
      TABLE_RESPONSIVE: '.table-responsive',
      DROPDOWN_MENU: '.dropdown-menu'
    };
    document.querySelectorAll(Selector.TABLE_RESPONSIVE).forEach(function (table) {
      table.addEventListener(Event.SHOWN_BS_DROPDOWN, function (e) {
        var t = e.currentTarget;
        if (t.scrollWidth > t.clientWidth) {
          t.style.paddingBottom = "".concat(e.target.nextElementSibling.clientHeight, "px");
        }
      });
      table.addEventListener(Event.HIDDEN_BS_DROPDOWN, function (e) {
        e.currentTarget.style.paddingBottom = '';
      });
    });
  }
};

// Reference
// https://github.com/twbs/bootstrap/issues/11037#issuecomment-274870381

/* -------------------------------------------------------------------------- */
/*                           Open dropdown on hover                           */
/* -------------------------------------------------------------------------- */

var dropdownOnHover = function dropdownOnHover() {
  var navbarArea = document.querySelectorAll('[data-bs-toggle="dropdown"]');
  if (navbarArea) {
    navbarArea.forEach(function (navbarItem) {
      navbarItem.addEventListener('mouseover', function (e) {
        if (e.target.className.includes('dropdown-toggle') && window.innerWidth > 992) {
          var dropdownInstance = new window.bootstrap.Dropdown(e.target);

          /* eslint-disable no-underscore-dangle */
          dropdownInstance._element.classList.add('show');
          dropdownInstance._menu.classList.add('show');
          dropdownInstance._menu.setAttribute('data-bs-popper', 'none');
          e.target.parentNode.addEventListener('mouseleave', function () {
            dropdownInstance.hide();
          });
        }
      });
    });
  }
};

/* -------------------------------------------------------------------------- */
/*                               Form-Processor                               */
/* -------------------------------------------------------------------------- */

var formInit = function formInit() {
  var zforms = document.querySelectorAll('[data-form]');
  if (zforms.length) {
    zforms.forEach(function (form) {
      form.addEventListener('submit', /*#__PURE__*/function () {
        var _ref = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(e) {
          var feedbackEl, formData, response, result, _t;
          return _regenerator().w(function (_context) {
            while (1) switch (_context.p = _context.n) {
              case 0:
                e.preventDefault();
                feedbackEl = form.querySelector('.feedback');
                formData = new FormData(form);
                _context.p = 1;
                _context.n = 2;
                return fetch("https://formspree.io/f/".concat('YOUR_FORM_ID'), {
                  method: 'POST',
                  body: formData,
                  headers: {
                    Accept: 'application/json'
                  }
                });
              case 2:
                response = _context.v;
                _context.n = 3;
                return response.json();
              case 3:
                result = _context.v;
                if (response.ok) {
                  feedbackEl.innerHTML = "\n            <div class=\"alert alert-success\">\n              Your message has been sent successfully.\n            </div>";
                  form.reset();
                } else {
                  feedbackEl.innerHTML = "\n            <div class=\"alert alert-danger\">\n              ".concat(result.error || 'Something went wrong', "\n            </div>");
                }
                _context.n = 5;
                break;
              case 4:
                _context.p = 4;
                _t = _context.v;
                feedbackEl.innerHTML = "\n          <div class=\"alert alert-danger\">\n            Network error. Please try again.\n          </div>";
              case 5:
                _context.p = 5;
                setTimeout(function () {
                  feedbackEl.innerHTML = null;
                }, 3000);
                return _context.f(5);
              case 6:
                return _context.a(2);
            }
          }, _callee, null, [[1, 4, 5, 6]]);
        }));
        return function (_x) {
          return _ref.apply(this, arguments);
        };
      }());
    });
  }
};

/*-----------------------------------------------
|   Google Map
-----------------------------------------------*/

var mapInstances = [];
var panoramaInstances = [];
function destroyMap(map) {
  if (map) {
    window.google.maps.event.clearInstanceListeners(map);
  }
}
function destroyAll() {
  mapInstances.forEach(destroyMap);
  mapInstances.length = 0;
  panoramaInstances.length = 0;
}
function initMap() {
  var themeController = document.body;
  var $googlemaps = _toConsumableArray(document.querySelectorAll('[data-gmap]'));
  if (!$googlemaps.length || !window.google) return;
  Promise.all([window.google.maps.importLibrary('maps'), window.google.maps.importLibrary('marker'), window.google.maps.importLibrary('core')]).then(function (_ref2) {
    var _ref3 = _slicedToArray(_ref2, 3),
      mapsLib = _ref3[0],
      markerLib = _ref3[1],
      coreLib = _ref3[2];
    var Map = mapsLib.Map,
      InfoWindow = mapsLib.InfoWindow;
    var AdvancedMarkerElement = markerLib.AdvancedMarkerElement;
    var ColorScheme = coreLib.ColorScheme;
    $googlemaps.forEach(function (itm) {
      var latLng = utils.getData(itm, 'latlng').split(',');
      var zoom = utils.getData(itm, 'zoom');
      var mapId = utils.getData(itm, 'mapid');
      var markerPopup = itm.innerHTML;
      var lightIconUrl = utils.getData(itm, 'icon') || 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png';
      var darkIconUrl = utils.getData(itm, 'dark-icon') || lightIconUrl;

      /* ---------- Street View ---------- */
      if (utils.getData(itm, 'theme') === 'streetview') {
        var panorama = new window.google.maps.StreetViewPanorama(itm, {
          position: {
            lat: +latLng[0],
            lng: +latLng[1]
          },
          pov: utils.getData(itm, 'pov'),
          zoom: zoom,
          gestureHandling: 'none',
          scrollwheel: false,
          visible: true
        });
        panoramaInstances.push(panorama);
        return;
      }

      /* ---------- Map ---------- */
      var map = new Map(itm, {
        mapId: mapId,
        zoom: zoom,
        center: {
          lat: +latLng[0],
          lng: +latLng[1]
        },
        scrollwheel: utils.getData(itm, 'scrollwheel'),
        colorScheme: localStorage.getItem('theme') === 'dark' ? ColorScheme.DARK : ColorScheme.LIGHT
      });
      mapInstances.push(map);
      var infowindow = new InfoWindow({
        content: markerPopup
      });
      var iconImage = document.createElement('img');
      iconImage.src = localStorage.getItem('theme') === 'dark' ? darkIconUrl : lightIconUrl;
      var marker = new AdvancedMarkerElement({
        map: map,
        position: {
          lat: +latLng[0],
          lng: +latLng[1]
        },
        content: iconImage
      });
      marker.addListener('click', function () {
        infowindow.open(map, marker);
      });
    });

    /* ---------- Theme switch listener (ONCE) ---------- */
    themeController === null || themeController === void 0 || themeController.addEventListener('clickControl', function (_ref4) {
      var detail = _ref4.detail;
      if (detail.control === 'theme') {
        destroyAll();
        initMap();
      }
    });
  });
}

/*-----------------------------------------------
|   Hamburger
-----------------------------------------------*/

var hamburgerInit = function hamburgerInit() {
  var Selector = {
    HAMBURGER: '.hamburger',
    NAVBAR_COLLAPSE: '#primaryNavbarCollapse'
  };
  var hamburger = document.querySelector(Selector.HAMBURGER);
  var navbarCollapse = document.querySelector(Selector.NAVBAR_COLLAPSE);
  if (hamburger) {
    navbarCollapse.addEventListener('show.bs.collapse', function () {
      hamburger.classList.add('is-active');
    });
  }
  if (hamburger) {
    navbarCollapse.addEventListener('hide.bs.collapse', function () {
      hamburger.classList.remove('is-active');
    });
  }
};
function inertiaInit() {
  var Selector = {
    DATA_INERTIA: '[data-inertia]'
  };
  var DATA_KEY = {
    INERTIA: 'inertia'
  };
  var Events = {
    SCROLL: 'scroll',
    RESIZE: 'resize'
  };
  var inertiaEls = document.querySelectorAll(Selector.DATA_INERTIA);
  inertiaEls.forEach(function (el) {
    var rect = el.getBoundingClientRect();
    var options = utils.getData(el, DATA_KEY.INERTIA);
    var offsetTop = rect.top >= 0 ? rect.top : 0;
    var winHeight = window.innerHeight;
    var currentPosition = window.pageYOffset;
    var y = 0;
    var previousPosition = 0;
    var initialTranslate = (offsetTop - currentPosition) * 100 / winHeight;
    var controller = {
      weight: 2,
      duration: 0.7,
      ease: 'Power3.easeOut'
    };
    Object.assign(controller, options);

    // eslint-disable-next-line no-param-reassign
    el.style.transform = "translateY(".concat(initialTranslate, "px);");
    var inertiaEffect = function inertiaEffect() {
      currentPosition = window.pageYOffset;
      y = controller.weight * (offsetTop - currentPosition) * 100 / winHeight;
      currentPosition === previousPosition || window.gsap.to(el, {
        duration: controller.duration,
        y: y,
        ease: controller.ease
      });
      previousPosition = currentPosition;
    };
    window.addEventListener(Events.SCROLL, inertiaEffect);
    window.addEventListener(Events.RESIZE, inertiaEffect);
  });
}

/* -------------------------------------------------------------------------- */
/*                                 bigPicture                                 */
/* -------------------------------------------------------------------------- */

var lightboxInit = function lightboxInit() {
  if (window.BigPicture) {
    var bpItems = document.querySelectorAll('[data-bigpicture]');
    bpItems.forEach(function (bpItem) {
      var userOptions = utils.getData(bpItem, 'bigpicture');
      var defaultOptions = {
        el: bpItem
      };
      var options = window._.merge(defaultOptions, userOptions);
      bpItem.addEventListener('click', function () {
        window.BigPicture(options);
      });
    });
  }
};

/*-----------------------------------------------
|   Inline Player [plyr]
-----------------------------------------------*/

var plyrInit = function plyrInit() {
  if (window.Plyr) {
    var plyrs = document.querySelectorAll('.player');
    plyrs.forEach(function (plyr) {
      var userOptions = utils.getData(plyr, 'options');
      var defaultOptions = {
        captions: {
          active: true
        }
      };
      var options = window._.merge(defaultOptions, userOptions);
      return new window.Plyr(plyr, options);
    });
  }
};

/* -------------------------------------------------------------------------- */
/*                                   Popover                                  */
/* -------------------------------------------------------------------------- */

var popoverInit = function popoverInit() {
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  popoverTriggerList.map(function (popoverTriggerEl) {
    return new window.bootstrap.Popover(popoverTriggerEl);
  });
};

/* -------------------------------------------------------------------------- */
/*                                  Preloader                                 */
/* -------------------------------------------------------------------------- */

var preloaderInit = function preloaderInit() {
  var bodyElement = document.querySelector('body');
  window.imagesLoaded(bodyElement, function () {
    var preloader = document.querySelector('.preloader');
    preloader === null || preloader === void 0 || preloader.classList.add('loaded');
    setTimeout(function () {
      preloader === null || preloader === void 0 || preloader.remove();
    }, 900);
  });
};

/* -------------------------------------------------------------------------- */
/*                                Scroll To Top                               */
/* -------------------------------------------------------------------------- */

var scrollToTop = function scrollToTop() {
  document.querySelectorAll('[data-anchor] > a, [data-scroll-to]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var _utils$getData2;
      e.preventDefault();
      var el = e.target;
      var id = utils.getData(el, 'scroll-to') || el.getAttribute('href');
      window.scroll({
        top: (_utils$getData2 = utils.getData(el, 'offset-top')) !== null && _utils$getData2 !== void 0 ? _utils$getData2 : utils.getOffset(document.querySelector(id)).top - 100,
        left: 0,
        behavior: 'smooth'
      });
      window.location.hash = id;
    });
  });
};

/* -------------------------------------------------------------------------- */
/*                                 Scrollbars                                 */
/* -------------------------------------------------------------------------- */

var scrollbarInit = function scrollbarInit() {
  Array.prototype.forEach.call(document.querySelectorAll('.scrollbar-overlay'), function (el) {
    return new window.OverlayScrollbars(el, {
      scrollbars: {
        autoHide: 'leave',
        autoHideDelay: 200
      }
    });
  });
};

/*-----------------------------------------------
|  Swiper
-----------------------------------------------*/
var swiperInit = function swiperInit() {
  var Selector = {
    DATA_SWIPER: '[data-swiper]',
    DATA_ZANIM_TIMELINE: '[data-zanim-timeline]',
    IMG: 'img',
    SWIPER_NAV: '.swiper-nav',
    SWIPER_BUTTON_NEXT: '.swiper-button-next',
    SWIPER_BUTTON_PREV: '.swiper-button-prev'
  };
  var DATA_KEY = {
    SWIPER: 'swiper'
  };
  var Events = {
    SLIDE_CHANGE: 'slideChange'
  };
  var swipers = document.querySelectorAll(Selector.DATA_SWIPER);
  if (swipers.length) {
    swipers.forEach(function (swiper) {
      var options = utils.getData(swiper, DATA_KEY.SWIPER);
      var thumbsOptions = options.thumb;
      var thumbsInit;
      if (thumbsOptions) {
        var thumbImages = swiper.querySelectorAll(Selector.IMG);
        var slides = '';
        thumbImages.forEach(function (img) {
          slides += "\n          <div class='swiper-slide '>\n            <img class='img-fluid rounded mt-1' src=".concat(img.src, " alt=''/>\n          </div>\n        ");
        });
        var thumbs = document.createElement('div');
        thumbs.setAttribute('class', 'swiper thumb');
        thumbs.innerHTML = "<div class='swiper-wrapper'>".concat(slides, "</div>");
        if (thumbsOptions.parent) {
          var parent = document.querySelector(thumbsOptions.parent);
          parent.parentNode.appendChild(thumbs);
        } else {
          swiper.parentNode.appendChild(thumbs);
        }
        thumbsInit = new window.Swiper(thumbs, thumbsOptions);
      }
      var swiperNav = swiper.querySelector(Selector.SWIPER_NAV);
      var newSwiper = new window.Swiper(swiper, _objectSpread(_objectSpread({}, options), {}, {
        navigation: {
          nextEl: swiperNav === null || swiperNav === void 0 ? void 0 : swiperNav.querySelector('.swiper-button-next'),
          prevEl: swiperNav === null || swiperNav === void 0 ? void 0 : swiperNav.querySelector('.swiper-button-prev')
        },
        thumbs: {
          swiper: thumbsInit
        },
        on: {
          init: function init() {
            var timelineElements = swiper.querySelectorAll(Selector.DATA_ZANIM_TIMELINE);
            timelineElements.forEach(function (el) {
              window.zanimation(el, function (animation) {
                setTimeout(function () {
                  animation.play();
                }, 400);
              });
            });
          }
        }
      }));

      //- zanimation effect start
      if (swiper) {
        newSwiper.on(Events.SLIDE_CHANGE, function () {
          var timelineElements = swiper.querySelectorAll(Selector.DATA_ZANIM_TIMELINE);
          timelineElements.forEach(function (el) {
            window.zanimation(el, function (animation) {
              setTimeout(function () {
                animation.play();
              }, 400);
            });
          });
        });
      }
      //- zanimation effect end
    });
  }
};

/* -------------------------------------------------------------------------- */
/*                                    Toast                                   */
/* -------------------------------------------------------------------------- */

var toastInit = function toastInit() {
  var toastElList = [].slice.call(document.querySelectorAll('.toast'));
  toastElList.map(function (toastEl) {
    return new window.bootstrap.Toast(toastEl);
  });
  var liveToastBtn = document.getElementById('liveToastBtn');
  if (liveToastBtn) {
    var liveToast = new window.bootstrap.Toast(document.getElementById('liveToast'));
    liveToastBtn.addEventListener('click', function () {
      liveToast && liveToast.show();
    });
  }
};

/* -------------------------------------------------------------------------- */
/*                                   Tooltip                                  */
/* -------------------------------------------------------------------------- */
var tooltipInit = function tooltipInit() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new window.bootstrap.Tooltip(tooltipTriggerEl, {
      trigger: 'hover'
    });
  });
};

/*-----------------------------------------------
|                 Zanimation
-----------------------------------------------*/

/*
global CustomEase, gsap
*/
CustomEase.create('CubicBezier', '.77,0,.18,1');

/*-----------------------------------------------
|   Global Functions
-----------------------------------------------*/
var filterBlur = function filterBlur() {
  var blur = 'blur(5px)';
  var isIpadIphoneMacFirefox = (window.is.ios() || window.is.mac()) && window.is.firefox();
  if (isIpadIphoneMacFirefox) {
    blur = 'blur(0px)';
  }
  return blur;
};
var zanimationEffects = {
  "default": {
    from: {
      opacity: 0,
      y: 70
    },
    to: {
      opacity: 1,
      y: 0
    },
    ease: 'CubicBezier',
    duration: 0.8,
    delay: 0
  },
  'slide-down': {
    from: {
      opacity: 0,
      y: -70
    },
    to: {
      opacity: 1,
      y: 0
    },
    ease: 'CubicBezier',
    duration: 0.8,
    delay: 0
  },
  'slide-left': {
    from: {
      opacity: 0,
      x: 70
    },
    to: {
      opacity: 1,
      x: 0
    },
    ease: 'CubicBezier',
    duration: 0.8,
    delay: 0
  },
  'slide-right': {
    from: {
      opacity: 0,
      x: -70
    },
    to: {
      opacity: 1,
      x: 0
    },
    ease: 'CubicBezier',
    duration: 0.8,
    delay: 0
  },
  'zoom-in': {
    from: {
      scale: 0.9,
      opacity: 0,
      filter: filterBlur()
    },
    to: {
      scale: 1,
      opacity: 1,
      filter: 'blur(0px)'
    },
    delay: 0,
    ease: 'CubicBezier',
    duration: 0.8
  },
  'zoom-out': {
    from: {
      scale: 1.1,
      opacity: 1,
      filter: filterBlur()
    },
    to: {
      scale: 1,
      opacity: 1,
      filter: 'blur(0px)'
    },
    delay: 0,
    ease: 'CubicBezier',
    duration: 0.8
  },
  'zoom-out-slide-right': {
    from: {
      scale: 1.1,
      opacity: 1,
      x: -70,
      filter: filterBlur()
    },
    to: {
      scale: 1,
      opacity: 1,
      x: 0,
      filter: 'blur(0px)'
    },
    delay: 0,
    ease: 'CubicBezier',
    duration: 0.8
  },
  'zoom-out-slide-left': {
    from: {
      scale: 1.1,
      opacity: 1,
      x: 70,
      filter: filterBlur()
    },
    to: {
      scale: 1,
      opacity: 1,
      x: 0,
      filter: 'blur(0px)'
    },
    delay: 0,
    ease: 'CubicBezier',
    duration: 0.8
  },
  'blur-in': {
    from: {
      opacity: 0,
      filter: filterBlur()
    },
    to: {
      opacity: 1,
      filter: 'blur(0px)'
    },
    delay: 0,
    ease: 'CubicBezier',
    duration: 0.8
  }
};
if (utils.isRTL()) {
  Object.keys(zanimationEffects).forEach(function (key) {
    if (zanimationEffects[key].from.x) {
      zanimationEffects[key].from.x = -zanimationEffects[key].from.x;
    }
  });
}
var zanimation = function zanimation(el, callback) {
  var Selector = {
    DATA_ZANIM_TIMELINE: '[data-zanim-timeline]',
    DATA_KEYS: '[data-zanim-xs], [data-zanim-sm], [data-zanim-md], [data-zanim-lg], [data-zanim-xl]'
  };
  var DATA_KEY = {
    DATA_ZANIM_TRIGGER: 'data-zanim-trigger'
  };

  /*-----------------------------------------------
   |   Get Controller
   -----------------------------------------------*/
  var controllerZanim;
  var currentBreakpointName = utils.getCurrentScreenBreakpoint().currentBreakpoint;
  var currentBreakpointVal = utils.getCurrentScreenBreakpoint().breakpointStartVal;
  var getController = function getController(element) {
    var options = {};
    var controller = {};
    if (element.hasAttribute("data-zanim-".concat(currentBreakpointName))) {
      controllerZanim = "zanim-".concat(currentBreakpointName);
    } else {
      /*-----------------------------------------------
         |   Set the mobile first Animation
         -----------------------------------------------*/
      var animationBreakpoints = [];
      var attributes = element.getAttributeNames();
      attributes.forEach(function (attribute) {
        if (attribute !== DATA_KEY.DATA_ZANIM_TRIGGER && attribute.startsWith('data-zanim-')) {
          var breakPointName = attribute.split('data-zanim-')[1];
          if (utils.breakpoints[breakPointName] < currentBreakpointVal) {
            animationBreakpoints.push({
              name: breakPointName,
              size: utils.breakpoints[breakPointName]
            });
          }
        }
      });
      controllerZanim = undefined;
      if (animationBreakpoints.length !== 0) {
        animationBreakpoints = animationBreakpoints.sort(function (a, b) {
          return a.size - b.size;
        });
        var activeBreakpoint = animationBreakpoints.pop();
        controllerZanim = "zanim-".concat(activeBreakpoint.name);
      }
    }
    var userOptions = utils.getData(element, controllerZanim);
    controller = window._.merge(options, userOptions);
    if (!(controllerZanim === undefined)) {
      if (userOptions.animation) {
        options = zanimationEffects[userOptions.animation];
      } else {
        options = zanimationEffects["default"];
      }
    }
    if (controllerZanim === undefined) {
      options = {
        delay: 0,
        duration: 0,
        ease: 'Expo.easeOut',
        from: {},
        to: {}
      };
    }

    /*-----------------------------------------------
      |   populating the controller
      -----------------------------------------------*/
    controller.delay || (controller.delay = options.delay);
    controller.duration || (controller.duration = options.duration);
    controller.from || (controller.from = options.from);
    controller.to || (controller.to = options.to);
    if (controller.ease) {
      controller.to.ease = controller.ease;
    } else {
      controller.to.ease = options.ease;
    }
    return controller;
  };
  /*-----------------------------------------------
   |   End of Get Controller
   -----------------------------------------------*/

  /*-----------------------------------------------
   |   For Timeline
   -----------------------------------------------*/

  var zanimTimeline = el.hasAttribute('data-zanim-timeline');
  if (zanimTimeline) {
    var timelineOption = utils.getData(el, 'zanim-timeline');
    var timeline = gsap.timeline(timelineOption);
    var timelineElements = el.querySelectorAll(Selector.DATA_KEYS);
    timelineElements.forEach(function (timelineEl) {
      var controller = getController(timelineEl);
      timeline.fromTo(timelineEl, controller.duration, controller.from, controller.to, controller.delay).pause();
      window.imagesLoaded(timelineEl, callback(timeline));
    });
  } else if (!el.closest(Selector.DATA_ZANIM_TIMELINE)) {
    /*-----------------------------------------------
      |   For single elements outside timeline
      -----------------------------------------------*/
    var controller = getController(el);
    callback(gsap.fromTo(el, controller.duration, controller.from, controller.to).delay(controller.delay).pause());
  }
  callback(gsap.timeline());
};

/*-----------------------------------------------
|    Zanimation Init
-----------------------------------------------*/

var zanimationInit = function zanimationInit() {
  var Selector = {
    DATA_ZANIM_TRIGGER: '[data-zanim-trigger]',
    DATA_ZANIM_REPEAT: '[zanim-repeat]'
  };
  var DATA_KEY = {
    DATA_ZANIM_TRIGGER: 'data-zanim-trigger'
  };
  var Events = {
    SCROLL: 'scroll'
  };

  /*-----------------------------------------------
   |   Triggering zanimation when the element enters in the view
   -----------------------------------------------*/
  var triggerZanimation = function triggerZanimation() {
    var triggerElement = document.querySelectorAll(Selector.DATA_ZANIM_TRIGGER);
    triggerElement.forEach(function (el) {
      if (utils.isElementIntoView(el) && el.hasAttribute(DATA_KEY.DATA_ZANIM_TRIGGER)) {
        zanimation(el, function (animation) {
          return animation.play();
        });
        if (!document.querySelector(Selector.DATA_ZANIM_REPEAT)) {
          el.removeAttribute(DATA_KEY.DATA_ZANIM_TRIGGER);
        }
      }
    });
  };
  triggerZanimation();
  window.addEventListener(Events.SCROLL, function () {
    return triggerZanimation();
  });
};
var gsapAnimation = {
  zanimationInit: zanimationInit,
  zanimation: zanimation
};

/* -------------------------------------------------------------------------- */
/*                            Theme Initialization                            */
/* -------------------------------------------------------------------------- */
docReady(detectorInit);
docReady(tooltipInit);
docReady(popoverInit);
docReady(toastInit);
docReady(plyrInit);
docReady(initMap);
docReady(countupInit);
docReady(scrollToTop);
docReady(swiperInit);
docReady(dropdownOnHover);
docReady(scrollbarInit);
docReady(dropdownMenuInit);
docReady(lightboxInit);
docReady(bgPlayerInit);
docReady(hamburgerInit);
docReady(zanimationInit);
docReady(inertiaInit);
docReady(preloaderInit);
docReady(formInit);
//# sourceMappingURL=theme.js.map
