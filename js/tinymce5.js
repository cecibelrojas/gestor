!function(V) {
    "use strict";
    var r = function(e) {
        if (null === e)
            return "null";
        if (e === undefined)
            return "undefined";
        var t = typeof e;
        return "object" == t && (Array.prototype.isPrototypeOf(e) || e.constructor && "Array" === e.constructor.name) ? "array" : "object" == t && (String.prototype.isPrototypeOf(e) || e.constructor && "String" === e.constructor.name) ? "string" : t
    }
      , t = function(e) {
        return {
            eq: e
        }
    }
      , s = t(function(e, t) {
        return e === t
    })
      , i = function(o) {
        return t(function(e, t) {
            if (e.length !== t.length)
                return !1;
            for (var n = e.length, r = 0; r < n; r++)
                if (!o.eq(e[r], t[r]))
                    return !1;
            return !0
        })
    }
      , c = function(e, r) {
        return n = i(e),
        o = function(e) {
            return t = e,
            n = r,
            Array.prototype.slice.call(t).sort(n);
            var t, n
        }
        ,
        t(function(e, t) {
            return n.eq(o(e), o(t))
        });
        var n, o
    }
      , u = function(u) {
        return t(function(e, t) {
            var n = Object.keys(e)
              , r = Object.keys(t);
            if (!c(s).eq(n, r))
                return !1;
            for (var o = n.length, i = 0; i < o; i++) {
                var a = n[i];
                if (!u.eq(e[a], t[a]))
                    return !1
            }
            return !0
        })
    }
      , l = t(function(e, t) {
        if (e === t)
            return !0;
        var n = r(e);
        return n === r(t) && (-1 !== ["undefined", "boolean", "number", "string", "function", "xml", "null"].indexOf(n) ? e === t : "array" === n ? i(l).eq(e, t) : "object" === n && u(l).eq(e, t))
    })
      , f = function() {}
      , a = function(n, r) {
        return function() {
            for (var e = [], t = 0; t < arguments.length; t++)
                e[t] = arguments[t];
            return n(r.apply(null, e))
        }
    }
      , x = function(e) {
        return function() {
            return e
        }
    }
      , d = function(e) {
        return e
    };
    function N(r) {
        for (var o = [], e = 1; e < arguments.length; e++)
            o[e - 1] = arguments[e];
        return function() {
            for (var e = [], t = 0; t < arguments.length; t++)
                e[t] = arguments[t];
            var n = o.concat(e);
            return r.apply(null, n)
        }
    }
    var e, n, o, m = function(t) {
        return function(e) {
            return !t(e)
        }
    }, p = function(e) {
        return function() {
            throw new Error(e)
        }
    }, g = x(!1), h = x(!0), v = function() {
        return y
    }, y = (e = function(e) {
        return e.isNone()
    }
    ,
    {
        fold: function(e, t) {
            return e()
        },
        is: g,
        isSome: g,
        isNone: h,
        getOr: o = function(e) {
            return e
        }
        ,
        getOrThunk: n = function(e) {
            return e()
        }
        ,
        getOrDie: function(e) {
            throw new Error(e || "error: getOrDie called on none.")
        },
        getOrNull: x(null),
        getOrUndefined: x(undefined),
        or: o,
        orThunk: n,
        map: v,
        each: f,
        bind: v,
        exists: g,
        forall: h,
        filter: v,
        equals: e,
        equals_: e,
        toArray: function() {
            return []
        },
        toString: x("none()")
    }), b = function(n) {
        var e = x(n)
          , t = function() {
            return o
        }
          , r = function(e) {
            return e(n)
        }
          , o = {
            fold: function(e, t) {
                return t(n)
            },
            is: function(e) {
                return n === e
            },
            isSome: h,
            isNone: g,
            getOr: e,
            getOrThunk: e,
            getOrDie: e,
            getOrNull: e,
            getOrUndefined: e,
            or: t,
            orThunk: t,
            map: function(e) {
                return b(e(n))
            },
            each: function(e) {
                e(n)
            },
            bind: r,
            exists: r,
            forall: r,
            filter: function(e) {
                return e(n) ? o : y
            },
            toArray: function() {
                return [n]
            },
            toString: function() {
                return "some(" + n + ")"
            },
            equals: function(e) {
                return e.is(n)
            },
            equals_: function(e, t) {
                return e.fold(g, function(e) {
                    return t(n, e)
                })
            }
        };
        return o
    }, R = {
        some: b,
        none: v,
        from: function(e) {
            return null === e || e === undefined ? y : b(e)
        }
    }, C = function(r) {
        return function(e) {
            return n = typeof (t = e),
            (null === t ? "null" : "object" == n && (Array.prototype.isPrototypeOf(t) || t.constructor && "Array" === t.constructor.name) ? "array" : "object" == n && (String.prototype.isPrototypeOf(t) || t.constructor && "String" === t.constructor.name) ? "string" : n) === r;
            var t, n
        }
    }, w = function(t) {
        return function(e) {
            return typeof e === t
        }
    }, S = function(t) {
        return function(e) {
            return t === e
        }
    }, q = C("string"), E = C("object"), k = C("array"), _ = S(null), T = w("boolean"), A = S(undefined), D = w("function"), O = w("number"), B = Array.prototype.slice, P = Array.prototype.indexOf, L = Array.prototype.push, I = function(e, t) {
        return P.call(e, t)
    }, M = function(e, t) {
        return -1 < I(e, t)
    }, F = function(e, t) {
        for (var n = 0, r = e.length; n < r; n++) {
            if (t(e[n], n))
                return !0
        }
        return !1
    }, U = function(e, t) {
        for (var n = e.length, r = new Array(n), o = 0; o < n; o++) {
            var i = e[o];
            r[o] = t(i, o)
        }
        return r
    }, z = function(e, t) {
        for (var n = 0, r = e.length; n < r; n++) {
            t(e[n], n)
        }
    }, j = function(e, t) {
        for (var n = [], r = [], o = 0, i = e.length; o < i; o++) {
            var a = e[o];
            (t(a, o) ? n : r).push(a)
        }
        return {
            pass: n,
            fail: r
        }
    }, H = function(e, t) {
        for (var n = [], r = 0, o = e.length; r < o; r++) {
            var i = e[r];
            t(i, r) && n.push(i)
        }
        return n
    }, $ = function(e, t, n) {
        return function(e, t) {
            for (var n = e.length - 1; 0 <= n; n--) {
                t(e[n], n)
            }
        }(e, function(e) {
            n = t(n, e)
        }),
        n
    }, W = function(e, t, n) {
        return z(e, function(e) {
            n = t(n, e)
        }),
        n
    }, K = function(e, t) {
        return function(e, t, n) {
            for (var r = 0, o = e.length; r < o; r++) {
                var i = e[r];
                if (t(i, r))
                    return R.some(i);
                if (n(i, r))
                    break
            }
            return R.none()
        }(e, t, g)
    }, X = function(e, t) {
        for (var n = 0, r = e.length; n < r; n++) {
            if (t(e[n], n))
                return R.some(n)
        }
        return R.none()
    }, Y = function(e, t) {
        return function(e) {
            for (var t = [], n = 0, r = e.length; n < r; ++n) {
                if (!k(e[n]))
                    throw new Error("Arr.flatten item " + n + " was not an array, input: " + e);
                L.apply(t, e[n])
            }
            return t
        }(U(e, t))
    }, G = function(e, t) {
        for (var n = 0, r = e.length; n < r; ++n) {
            if (!0 !== t(e[n], n))
                return !1
        }
        return !0
    }, J = function(e) {
        var t = B.call(e, 0);
        return t.reverse(),
        t
    }, Q = function(e, t) {
        return H(e, function(e) {
            return !M(t, e)
        })
    }, Z = function(e) {
        return 0 === e.length ? R.none() : R.some(e[0])
    }, ee = function(e) {
        return 0 === e.length ? R.none() : R.some(e[e.length - 1])
    }, te = D(Array.from) ? Array.from : function(e) {
        return B.call(e)
    }
    , ne = Object.keys, re = Object.hasOwnProperty, oe = function(e, t) {
        for (var n = ne(e), r = 0, o = n.length; r < o; r++) {
            var i = n[r];
            t(e[i], i)
        }
    }, ie = function(e, n) {
        return ae(e, function(e, t) {
            return {
                k: t,
                v: n(e, t)
            }
        })
    }, ae = function(e, r) {
        var o = {};
        return oe(e, function(e, t) {
            var n = r(e, t);
            o[n.k] = n.v
        }),
        o
    }, ue = function(n) {
        return function(e, t) {
            n[t] = e
        }
    }, se = function(e, n, r, o) {
        return oe(e, function(e, t) {
            (n(e, t) ? r : o)(e, t)
        }),
        {}
    }, ce = function(e, t) {
        var n = {}
          , r = {};
        return se(e, t, ue(n), ue(r)),
        {
            t: n,
            f: r
        }
    }, le = function(e, t) {
        var n = {};
        return se(e, t, ue(n), f),
        n
    }, fe = function(e) {
        return n = function(e) {
            return e
        }
        ,
        r = [],
        oe(e, function(e, t) {
            r.push(n(e, t))
        }),
        r;
        var n, r
    }, de = function(e, t) {
        return me(e, t) ? R.from(e[t]) : R.none()
    }, me = function(e, t) {
        return re.call(e, t)
    }, pe = function() {
        return (pe = Object.assign || function(e) {
            for (var t, n = 1, r = arguments.length; n < r; n++)
                for (var o in t = arguments[n])
                    Object.prototype.hasOwnProperty.call(t, o) && (e[o] = t[o]);
            return e
        }
        ).apply(this, arguments)
    };
    function ge() {
        for (var e = 0, t = 0, n = arguments.length; t < n; t++)
            e += arguments[t].length;
        var r = Array(e)
          , o = 0;
        for (t = 0; t < n; t++)
            for (var i = arguments[t], a = 0, u = i.length; a < u; a++,
            o++)
                r[o] = i[a];
        return r
    }
    var he, ve, ye, be, Ce, we, xe, Se = function(e) {
        if (null === e || e === undefined)
            throw new Error("Node cannot be null or undefined");
        return {
            dom: x(e)
        }
    }, Ne = {
        fromHtml: function(e, t) {
            var n = (t || V.document).createElement("div");
            if (n.innerHTML = e,
            !n.hasChildNodes() || 1 < n.childNodes.length)
                throw V.console.error("HTML does not have a single root node", e),
                new Error("HTML must have a single root node");
            return Se(n.childNodes[0])
        },
        fromTag: function(e, t) {
            var n = (t || V.document).createElement(e);
            return Se(n)
        },
        fromText: function(e, t) {
            var n = (t || V.document).createTextNode(e);
            return Se(n)
        },
        fromDom: Se,
        fromPoint: function(e, t, n) {
            var r = e.dom();
            return R.from(r.elementFromPoint(t, n)).map(Se)
        }
    }, Ee = function(e, t) {
        var n = function(e, t) {
            for (var n = 0; n < e.length; n++) {
                var r = e[n];
                if (r.test(t))
                    return r
            }
            return undefined
        }(e, t);
        if (!n)
            return {
                major: 0,
                minor: 0
            };
        var r = function(e) {
            return Number(t.replace(n, "$" + e))
        };
        return _e(r(1), r(2))
    }, ke = function() {
        return _e(0, 0)
    }, _e = function(e, t) {
        return {
            major: e,
            minor: t
        }
    }, Re = {
        nu: _e,
        detect: function(e, t) {
            var n = String(t).toLowerCase();
            return 0 === e.length ? ke() : Ee(e, n)
        },
        unknown: ke
    }, Te = "Firefox", Ae = function(e) {
        var t = e.current
          , n = e.version
          , r = function(e) {
            return function() {
                return t === e
            }
        };
        return {
            current: t,
            version: n,
            isEdge: r("Edge"),
            isChrome: r("Chrome"),
            isIE: r("IE"),
            isOpera: r("Opera"),
            isFirefox: r(Te),
            isSafari: r("Safari")
        }
    }, De = {
        unknown: function() {
            return Ae({
                current: undefined,
                version: Re.unknown()
            })
        },
        nu: Ae,
        edge: x("Edge"),
        chrome: x("Chrome"),
        ie: x("IE"),
        opera: x("Opera"),
        firefox: x(Te),
        safari: x("Safari")
    }, Oe = "Windows", Be = "Android", Pe = "Solaris", Le = "FreeBSD", Ie = "ChromeOS", Me = function(e) {
        var t = e.current
          , n = e.version
          , r = function(e) {
            return function() {
                return t === e
            }
        };
        return {
            current: t,
            version: n,
            isWindows: r(Oe),
            isiOS: r("iOS"),
            isAndroid: r(Be),
            isOSX: r("OSX"),
            isLinux: r("Linux"),
            isSolaris: r(Pe),
            isFreeBSD: r(Le),
            isChromeOS: r(Ie)
        }
    }, Fe = {
        unknown: function() {
            return Me({
                current: undefined,
                version: Re.unknown()
            })
        },
        nu: Me,
        windows: x(Oe),
        ios: x("iOS"),
        android: x(Be),
        linux: x("Linux"),
        osx: x("OSX"),
        solaris: x(Pe),
        freebsd: x(Le),
        chromeos: x(Ie)
    }, Ue = function(e, t) {
        var n = String(t).toLowerCase();
        return K(e, function(e) {
            return e.search(n)
        })
    }, ze = function(e, n) {
        return Ue(e, n).map(function(e) {
            var t = Re.detect(e.versionRegexes, n);
            return {
                current: e.name,
                version: t
            }
        })
    }, je = function(e, n) {
        return Ue(e, n).map(function(e) {
            var t = Re.detect(e.versionRegexes, n);
            return {
                current: e.name,
                version: t
            }
        })
    }, He = function(e, t) {
        return -1 !== e.indexOf(t)
    }, Ve = function(e, t) {
        return n = e,
        o = 0,
        "" === (r = t) || n.length >= r.length && n.substr(o, o + r.length) === r;
        var n, r, o
    }, qe = function(t) {
        return function(e) {
            return e.replace(t, "")
        }
    }, $e = qe(/^\s+|\s+$/g), We = qe(/^\s+/g), Ke = qe(/\s+$/g), Xe = /.*?version\/\ ?([0-9]+)\.([0-9]+).*/, Ye = function(t) {
        return function(e) {
            return He(e, t)
        }
    }, Ge = [{
        name: "Edge",
        versionRegexes: [/.*?edge\/ ?([0-9]+)\.([0-9]+)$/],
        search: function(e) {
            return He(e, "edge/") && He(e, "chrome") && He(e, "safari") && He(e, "applewebkit")
        }
    }, {
        name: "Chrome",
        versionRegexes: [/.*?chrome\/([0-9]+)\.([0-9]+).*/, Xe],
        search: function(e) {
            return He(e, "chrome") && !He(e, "chromeframe")
        }
    }, {
        name: "IE",
        versionRegexes: [/.*?msie\ ?([0-9]+)\.([0-9]+).*/, /.*?rv:([0-9]+)\.([0-9]+).*/],
        search: function(e) {
            return He(e, "msie") || He(e, "trident")
        }
    }, {
        name: "Opera",
        versionRegexes: [Xe, /.*?opera\/([0-9]+)\.([0-9]+).*/],
        search: Ye("opera")
    }, {
        name: "Firefox",
        versionRegexes: [/.*?firefox\/\ ?([0-9]+)\.([0-9]+).*/],
        search: Ye("firefox")
    }, {
        name: "Safari",
        versionRegexes: [Xe, /.*?cpu os ([0-9]+)_([0-9]+).*/],
        search: function(e) {
            return (He(e, "safari") || He(e, "mobile/")) && He(e, "applewebkit")
        }
    }], Je = [{
        name: "Windows",
        search: Ye("win"),
        versionRegexes: [/.*?windows\ nt\ ?([0-9]+)\.([0-9]+).*/]
    }, {
        name: "iOS",
        search: function(e) {
            return He(e, "iphone") || He(e, "ipad")
        },
        versionRegexes: [/.*?version\/\ ?([0-9]+)\.([0-9]+).*/, /.*cpu os ([0-9]+)_([0-9]+).*/, /.*cpu iphone os ([0-9]+)_([0-9]+).*/]
    }, {
        name: "Android",
        search: Ye("android"),
        versionRegexes: [/.*?android\ ?([0-9]+)\.([0-9]+).*/]
    }, {
        name: "OSX",
        search: Ye("mac os x"),
        versionRegexes: [/.*?mac\ os\ x\ ?([0-9]+)_([0-9]+).*/]
    }, {
        name: "Linux",
        search: Ye("linux"),
        versionRegexes: []
    }, {
        name: "Solaris",
        search: Ye("sunos"),
        versionRegexes: []
    }, {
        name: "FreeBSD",
        search: Ye("freebsd"),
        versionRegexes: []
    }, {
        name: "ChromeOS",
        search: Ye("cros"),
        versionRegexes: [/.*?chrome\/([0-9]+)\.([0-9]+).*/]
    }], Qe = {
        browsers: x(Ge),
        oses: x(Je)
    }, Ze = function(e, t) {
        var n, r, o, i, a, u, s, c, l, f, d, m, p = Qe.browsers(), g = Qe.oses(), h = ze(p, e).fold(De.unknown, De.nu), v = je(g, e).fold(Fe.unknown, Fe.nu);
        return {
            browser: h,
            os: v,
            deviceType: (r = h,
            o = e,
            i = t,
            a = (n = v).isiOS() && !0 === /ipad/i.test(o),
            u = n.isiOS() && !a,
            s = n.isiOS() || n.isAndroid(),
            c = s || i("(pointer:coarse)"),
            l = a || !u && s && i("(min-device-width:768px)"),
            f = u || s && !l,
            d = r.isSafari() && n.isiOS() && !1 === /safari/i.test(o),
            m = !f && !l && !d,
            {
                isiPad: x(a),
                isiPhone: x(u),
                isTablet: x(l),
                isPhone: x(f),
                isTouch: x(c),
                isAndroid: n.isAndroid,
                isiOS: n.isiOS,
                isWebView: x(d),
                isDesktop: x(m)
            })
        }
    }, et = function(e) {
        return V.window.matchMedia(e).matches
    }, tt = (ye = !(he = function() {
        return Ze(V.navigator.userAgent, et)
    }
    ),
    function() {
        for (var e = [], t = 0; t < arguments.length; t++)
            e[t] = arguments[t];
        return ye || (ye = !0,
        ve = he.apply(null, e)),
        ve
    }
    ), nt = function() {
        return tt()
    }, rt = function(e, t) {
        for (var n = [], r = function(e) {
            return n.push(e),
            t(e)
        }, o = t(e); (o = o.bind(r)).isSome(); )
            ;
        return n
    }, ot = function(e, t) {
        var n = e.dom();
        if (1 !== n.nodeType)
            return !1;
        var r = n;
        if (r.matches !== undefined)
            return r.matches(t);
        if (r.msMatchesSelector !== undefined)
            return r.msMatchesSelector(t);
        if (r.webkitMatchesSelector !== undefined)
            return r.webkitMatchesSelector(t);
        if (r.mozMatchesSelector !== undefined)
            return r.mozMatchesSelector(t);
        throw new Error("Browser lacks native selectors")
    }, it = function(e) {
        return 1 !== e.nodeType && 9 !== e.nodeType || 0 === e.childElementCount
    }, at = function(e, t) {
        return e.dom() === t.dom()
    }, ut = function(e, t) {
        return n = e.dom(),
        r = t.dom(),
        o = n,
        i = r,
        a = V.Node.DOCUMENT_POSITION_CONTAINED_BY,
        0 != (o.compareDocumentPosition(i) & a);
        var n, r, o, i, a
    }, st = function(e, t) {
        return nt().browser.isIE() ? ut(e, t) : (n = t,
        r = e.dom(),
        o = n.dom(),
        r !== o && r.contains(o));
        var n, r, o
    }, ct = function(e) {
        return Ne.fromDom(e.dom().ownerDocument)
    }, lt = function(e) {
        return Ne.fromDom(e.dom().ownerDocument.defaultView)
    }, ft = function(e) {
        return R.from(e.dom().parentNode).map(Ne.fromDom)
    }, dt = function(e) {
        return R.from(e.dom().previousSibling).map(Ne.fromDom)
    }, mt = function(e) {
        return R.from(e.dom().nextSibling).map(Ne.fromDom)
    }, pt = function(e) {
        return J(rt(e, dt))
    }, gt = function(e) {
        return rt(e, mt)
    }, ht = function(e) {
        return U(e.dom().childNodes, Ne.fromDom)
    }, vt = function(e, t) {
        var n = e.dom().childNodes;
        return R.from(n[t]).map(Ne.fromDom)
    }, yt = function(e) {
        return vt(e, 0)
    }, bt = function(e) {
        return vt(e, e.dom().childNodes.length - 1)
    }, Ct = function(t, n) {
        ft(t).each(function(e) {
            e.dom().insertBefore(n.dom(), t.dom())
        })
    }, wt = function(e, t) {
        mt(e).fold(function() {
            ft(e).each(function(e) {
                St(e, t)
            })
        }, function(e) {
            Ct(e, t)
        })
    }, xt = function(t, n) {
        yt(t).fold(function() {
            St(t, n)
        }, function(e) {
            t.dom().insertBefore(n.dom(), e.dom())
        })
    }, St = function(e, t) {
        e.dom().appendChild(t.dom())
    }, Nt = function(t, e) {
        z(e, function(e) {
            St(t, e)
        })
    }, Et = function(e) {
        e.dom().textContent = "",
        z(ht(e), function(e) {
            kt(e)
        })
    }, kt = function(e) {
        var t = e.dom();
        null !== t.parentNode && t.parentNode.removeChild(t)
    }, _t = function(e) {
        var t, n = ht(e);
        0 < n.length && (t = e,
        z(n, function(e) {
            Ct(t, e)
        })),
        kt(e)
    }, Rt = ("undefined" != typeof V.window ? V.window : Function("return this;")(),
    function(e) {
        return e.dom().nodeName.toLowerCase()
    }
    ), Tt = function(e) {
        return e.dom().nodeType
    }, At = function(t) {
        return function(e) {
            return Tt(e) === t
        }
    }, Dt = At(1), Ot = At(3), Bt = function(e) {
        var t = Ot(e) ? e.dom().parentNode : e.dom();
        return t !== undefined && null !== t && t.ownerDocument.body.contains(t)
    }, Pt = function(n, r) {
        return {
            left: x(n),
            top: x(r),
            translate: function(e, t) {
                return Pt(n + e, r + t)
            }
        }
    }, Lt = Pt, It = function(e, t) {
        return e !== undefined ? e : t !== undefined ? t : 0
    }, Mt = function(e) {
        var t, n = e.dom(), r = n.ownerDocument.body;
        return r === n ? Lt(r.offsetLeft, r.offsetTop) : Bt(e) ? (t = n.getBoundingClientRect(),
        Lt(t.left, t.top)) : Lt(0, 0)
    }, Ft = function(e) {
        var t = e !== undefined ? e.dom() : V.document
          , n = t.body.scrollLeft || t.documentElement.scrollLeft
          , r = t.body.scrollTop || t.documentElement.scrollTop;
        return Lt(n, r)
    }, Ut = function(e, t, n) {
        (n !== undefined ? n.dom() : V.document).defaultView.scrollTo(e, t)
    }, zt = function(e, t) {
        nt().browser.isSafari() && D(e.dom().scrollIntoViewIfNeeded) ? e.dom().scrollIntoViewIfNeeded(!1) : e.dom().scrollIntoView(t)
    }, jt = function(e, t, n, r) {
        return {
            x: e,
            y: t,
            width: n,
            height: r,
            right: e + n,
            bottom: t + r
        }
    }, Ht = function(e) {
        var t, n, r = e === undefined ? V.window : e, o = r.document, i = Ft(Ne.fromDom(o));
        return n = (t = r) === undefined ? V.window : t,
        R.from(n.visualViewport).fold(function() {
            var e = r.document.documentElement
              , t = e.clientWidth
              , n = e.clientHeight;
            return jt(i.left(), i.top(), t, n)
        }, function(e) {
            return jt(Math.max(e.pageLeft, i.left()), Math.max(e.pageTop, i.top()), e.width, e.height)
        })
    }, Vt = function(t) {
        return function(e) {
            return !!e && e.nodeType === t
        }
    }, qt = function(e) {
        return !!e && !Object.getPrototypeOf(e)
    }, $t = Vt(1), Wt = function(e) {
        var n = e.map(function(e) {
            return e.toLowerCase()
        });
        return function(e) {
            if (e && e.nodeName) {
                var t = e.nodeName.toLowerCase();
                return M(n, t)
            }
            return !1
        }
    }, Kt = function(r, e) {
        var o = e.toLowerCase().split(" ");
        return function(e) {
            var t;
            if ($t(e))
                for (t = 0; t < o.length; t++) {
                    var n = e.ownerDocument.defaultView.getComputedStyle(e, null);
                    if ((n ? n.getPropertyValue(r) : null) === o[t])
                        return !0
                }
            return !1
        }
    }, Xt = function(t) {
        return function(e) {
            return $t(e) && e.hasAttribute(t)
        }
    }, Yt = function(e) {
        return $t(e) && e.hasAttribute("data-mce-bogus")
    }, Gt = function(e) {
        return $t(e) && "TABLE" === e.tagName
    }, Jt = function(t) {
        return function(e) {
            if ($t(e)) {
                if (e.contentEditable === t)
                    return !0;
                if (e.getAttribute("data-mce-contenteditable") === t)
                    return !0
            }
            return !1
        }
    }, Qt = Wt(["textarea", "input"]), Zt = Vt(3), en = Vt(8), tn = Vt(9), nn = Vt(11), rn = Wt(["br"]), on = Jt("true"), an = Jt("false"), un = function(e) {
        return e.style !== undefined && D(e.style.getPropertyValue)
    }, sn = function(e, t, n) {
        if (!(q(n) || T(n) || O(n)))
            throw V.console.error("Invalid call to Attr.set. Key ", t, ":: Value ", n, ":: Element ", e),
            new Error("Attribute value was not simple");
        e.setAttribute(t, n + "")
    }, cn = function(e, t, n) {
        sn(e.dom(), t, n)
    }, ln = function(e, t) {
        var n = e.dom();
        oe(t, function(e, t) {
            sn(n, t, e)
        })
    }, fn = function(e, t) {
        var n = e.dom().getAttribute(t);
        return null === n ? undefined : n
    }, dn = function(e, t) {
        e.dom().removeAttribute(t)
    }, mn = function(e, t) {
        var n = e.dom()
          , r = V.window.getComputedStyle(n).getPropertyValue(t);
        return "" !== r || Bt(e) ? r : pn(n, t)
    }, pn = function(e, t) {
        return un(e) ? e.style.getPropertyValue(t) : ""
    }, gn = function(e, t) {
        var n = e.dom()
          , r = pn(n, t);
        return R.from(r).filter(function(e) {
            return 0 < e.length
        })
    }, hn = nt().browser, vn = function(e) {
        return K(e, Dt)
    }, yn = function(e, t) {
        return e.children && M(e.children, t)
    }, bn = function(e, t, n) {
        var r, o, i, a = 0, u = 0, s = e.ownerDocument;
        if (n = n || e,
        t) {
            if (n === e && t.getBoundingClientRect && "static" === mn(Ne.fromDom(e), "position"))
                return {
                    x: a = (o = t.getBoundingClientRect()).left + (s.documentElement.scrollLeft || e.scrollLeft) - s.documentElement.clientLeft,
                    y: u = o.top + (s.documentElement.scrollTop || e.scrollTop) - s.documentElement.clientTop
                };
            for (r = t; r && r !== n && r.nodeType && !yn(r, n); )
                a += r.offsetLeft || 0,
                u += r.offsetTop || 0,
                r = r.offsetParent;
            for (r = t.parentNode; r && r !== n && r.nodeType && !yn(r, n); )
                a -= r.scrollLeft || 0,
                u -= r.scrollTop || 0,
                r = r.parentNode;
            u += (i = Ne.fromDom(t),
            hn.isFirefox() && "table" === Rt(i) ? vn(ht(i)).filter(function(e) {
                return "caption" === Rt(e)
            }).bind(function(o) {
                return vn(gt(o)).map(function(e) {
                    var t = e.dom().offsetTop
                      , n = o.dom().offsetTop
                      , r = o.dom().offsetHeight;
                    return t <= n ? -r : 0
                })
            }).getOr(0) : 0)
        }
        return {
            x: a,
            y: u
        }
    }, Cn = {}, wn = {
        exports: Cn
    };
    be = undefined,
    Ce = Cn,
    we = wn,
    xe = undefined,
    function(e) {
        if ("object" == typeof Ce && void 0 !== we)
            we.exports = e();
        else if ("function" == typeof be && be.amd)
            be([], e);
        else {
            ("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).EphoxContactWrapper = e()
        }
    }(function() {
        return function l(i, a, u) {
            function s(t, e) {
                if (!a[t]) {
                    if (!i[t]) {
                        var n = "function" == typeof xe && xe;
                        if (!e && n)
                            return n(t, !0);
                        if (c)
                            return c(t, !0);
                        var r = new Error("Cannot find module '" + t + "'");
                        throw r.code = "MODULE_NOT_FOUND",
                        r
                    }
                    var o = a[t] = {
                        exports: {}
                    };
                    i[t][0].call(o.exports, function(e) {
                        return s(i[t][1][e] || e)
                    }, o, o.exports, l, i, a, u)
                }
                return a[t].exports
            }
            for (var c = "function" == typeof xe && xe, e = 0; e < u.length; e++)
                s(u[e]);
            return s
        }({
            1: [function(e, t, n) {
                var r, o, i = t.exports = {};
                function a() {
                    throw new Error("setTimeout has not been defined")
                }
                function u() {
                    throw new Error("clearTimeout has not been defined")
                }
                function s(e) {
                    if (r === setTimeout)
                        return setTimeout(e, 0);
                    if ((r === a || !r) && setTimeout)
                        return r = setTimeout,
                        setTimeout(e, 0);
                    try {
                        return r(e, 0)
                    } catch (t) {
                        try {
                            return r.call(null, e, 0)
                        } catch (t) {
                            return r.call(this, e, 0)
                        }
                    }
                }
                !function() {
                    try {
                        r = "function" == typeof setTimeout ? setTimeout : a
                    } catch (e) {
                        r = a
                    }
                    try {
                        o = "function" == typeof clearTimeout ? clearTimeout : u
                    } catch (e) {
                        o = u
                    }
                }();
                var c, l = [], f = !1, d = -1;
                function m() {
                    f && c && (f = !1,
                    c.length ? l = c.concat(l) : d = -1,
                    l.length && p())
                }
                function p() {
                    if (!f) {
                        var e = s(m);
                        f = !0;
                        for (var t = l.length; t; ) {
                            for (c = l,
                            l = []; ++d < t; )
                                c && c[d].run();
                            d = -1,
                            t = l.length
                        }
                        c = null,
                        f = !1,
                        function n(e) {
                            if (o === clearTimeout)
                                return clearTimeout(e);
                            if ((o === u || !o) && clearTimeout)
                                return o = clearTimeout,
                                clearTimeout(e);
                            try {
                                return o(e)
                            } catch (t) {
                                try {
                                    return o.call(null, e)
                                } catch (t) {
                                    return o.call(this, e)
                                }
                            }
                        }(e)
                    }
                }
                function g(e, t) {
                    this.fun = e,
                    this.array = t
                }
                function h() {}
                i.nextTick = function(e) {
                    var t = new Array(arguments.length - 1);
                    if (1 < arguments.length)
                        for (var n = 1; n < arguments.length; n++)
                            t[n - 1] = arguments[n];
                    l.push(new g(e,t)),
                    1 !== l.length || f || s(p)
                }
                ,
                g.prototype.run = function() {
                    this.fun.apply(null, this.array)
                }
                ,
                i.title = "browser",
                i.browser = !0,
                i.env = {},
                i.argv = [],
                i.version = "",
                i.versions = {},
                i.on = h,
                i.addListener = h,
                i.once = h,
                i.off = h,
                i.removeListener = h,
                i.removeAllListeners = h,
                i.emit = h,
                i.prependListener = h,
                i.prependOnceListener = h,
                i.listeners = function(e) {
                    return []
                }
                ,
                i.binding = function(e) {
                    throw new Error("process.binding is not supported")
                }
                ,
                i.cwd = function() {
                    return "/"
                }
                ,
                i.chdir = function(e) {
                    throw new Error("process.chdir is not supported")
                }
                ,
                i.umask = function() {
                    return 0
                }
            }
            , {}],
            2: [function(e, f, t) {
                (function(t) {
                    function r() {}
                    function i(e) {
                        if ("object" != typeof this)
                            throw new TypeError("Promises must be constructed via new");
                        if ("function" != typeof e)
                            throw new TypeError("not a function");
                        this._state = 0,
                        this._handled = !1,
                        this._value = undefined,
                        this._deferreds = [],
                        l(e, this)
                    }
                    function o(r, o) {
                        for (; 3 === r._state; )
                            r = r._value;
                        0 !== r._state ? (r._handled = !0,
                        i._immediateFn(function() {
                            var e = 1 === r._state ? o.onFulfilled : o.onRejected;
                            if (null !== e) {
                                var t;
                                try {
                                    t = e(r._value)
                                } catch (n) {
                                    return void u(o.promise, n)
                                }
                                a(o.promise, t)
                            } else
                                (1 === r._state ? a : u)(o.promise, r._value)
                        })) : r._deferreds.push(o)
                    }
                    function a(e, t) {
                        try {
                            if (t === e)
                                throw new TypeError("A promise cannot be resolved with itself.");
                            if (t && ("object" == typeof t || "function" == typeof t)) {
                                var n = t.then;
                                if (t instanceof i)
                                    return e._state = 3,
                                    e._value = t,
                                    void s(e);
                                if ("function" == typeof n)
                                    return void l(function r(e, t) {
                                        return function() {
                                            e.apply(t, arguments)
                                        }
                                    }(n, t), e)
                            }
                            e._state = 1,
                            e._value = t,
                            s(e)
                        } catch (o) {
                            u(e, o)
                        }
                    }
                    function u(e, t) {
                        e._state = 2,
                        e._value = t,
                        s(e)
                    }
                    function s(e) {
                        2 === e._state && 0 === e._deferreds.length && i._immediateFn(function() {
                            e._handled || i._unhandledRejectionFn(e._value)
                        });
                        for (var t = 0, n = e._deferreds.length; t < n; t++)
                            o(e, e._deferreds[t]);
                        e._deferreds = null
                    }
                    function c(e, t, n) {
                        this.onFulfilled = "function" == typeof e ? e : null,
                        this.onRejected = "function" == typeof t ? t : null,
                        this.promise = n
                    }
                    function l(e, t) {
                        var n = !1;
                        try {
                            e(function(e) {
                                n || (n = !0,
                                a(t, e))
                            }, function(e) {
                                n || (n = !0,
                                u(t, e))
                            })
                        } catch (r) {
                            if (n)
                                return;
                            n = !0,
                            u(t, r)
                        }
                    }
                    var e, n;
                    e = this,
                    n = setTimeout,
                    i.prototype["catch"] = function(e) {
                        return this.then(null, e)
                    }
                    ,
                    i.prototype.then = function(e, t) {
                        var n = new this.constructor(r);
                        return o(this, new c(e,t,n)),
                        n
                    }
                    ,
                    i.all = function(e) {
                        var s = Array.prototype.slice.call(e);
                        return new i(function(o, i) {
                            if (0 === s.length)
                                return o([]);
                            var a = s.length;
                            function u(t, e) {
                                try {
                                    if (e && ("object" == typeof e || "function" == typeof e)) {
                                        var n = e.then;
                                        if ("function" == typeof n)
                                            return void n.call(e, function(e) {
                                                u(t, e)
                                            }, i)
                                    }
                                    s[t] = e,
                                    0 == --a && o(s)
                                } catch (r) {
                                    i(r)
                                }
                            }
                            for (var e = 0; e < s.length; e++)
                                u(e, s[e])
                        }
                        )
                    }
                    ,
                    i.resolve = function(t) {
                        return t && "object" == typeof t && t.constructor === i ? t : new i(function(e) {
                            e(t)
                        }
                        )
                    }
                    ,
                    i.reject = function(n) {
                        return new i(function(e, t) {
                            t(n)
                        }
                        )
                    }
                    ,
                    i.race = function(o) {
                        return new i(function(e, t) {
                            for (var n = 0, r = o.length; n < r; n++)
                                o[n].then(e, t)
                        }
                        )
                    }
                    ,
                    i._immediateFn = "function" == typeof t ? function(e) {
                        t(e)
                    }
                    : function(e) {
                        n(e, 0)
                    }
                    ,
                    i._unhandledRejectionFn = function(e) {
                        "undefined" != typeof console && console && console.warn("Possible Unhandled Promise Rejection:", e)
                    }
                    ,
                    i._setImmediateFn = function(e) {
                        i._immediateFn = e
                    }
                    ,
                    i._setUnhandledRejectionFn = function(e) {
                        i._unhandledRejectionFn = e
                    }
                    ,
                    void 0 !== f && f.exports ? f.exports = i : e.Promise || (e.Promise = i)
                }
                ).call(this, e("timers").setImmediate)
            }
            , {
                timers: 3
            }],
            3: [function(s, e, c) {
                (function(e, t) {
                    var r = s("process/browser.js").nextTick
                      , n = Function.prototype.apply
                      , o = Array.prototype.slice
                      , i = {}
                      , a = 0;
                    function u(e, t) {
                        this._id = e,
                        this._clearFn = t
                    }
                    c.setTimeout = function() {
                        return new u(n.call(setTimeout, window, arguments),clearTimeout)
                    }
                    ,
                    c.setInterval = function() {
                        return new u(n.call(setInterval, window, arguments),clearInterval)
                    }
                    ,
                    c.clearTimeout = c.clearInterval = function(e) {
                        e.close()
                    }
                    ,
                    u.prototype.unref = u.prototype.ref = function() {}
                    ,
                    u.prototype.close = function() {
                        this._clearFn.call(window, this._id)
                    }
                    ,
                    c.enroll = function(e, t) {
                        clearTimeout(e._idleTimeoutId),
                        e._idleTimeout = t
                    }
                    ,
                    c.unenroll = function(e) {
                        clearTimeout(e._idleTimeoutId),
                        e._idleTimeout = -1
                    }
                    ,
                    c._unrefActive = c.active = function(e) {
                        clearTimeout(e._idleTimeoutId);
                        var t = e._idleTimeout;
                        0 <= t && (e._idleTimeoutId = setTimeout(function() {
                            e._onTimeout && e._onTimeout()
                        }, t))
                    }
                    ,
                    c.setImmediate = "function" == typeof e ? e : function(e) {
                        var t = a++
                          , n = !(arguments.length < 2) && o.call(arguments, 1);
                        return i[t] = !0,
                        r(function() {
                            i[t] && (n ? e.apply(null, n) : e.call(null),
                            c.clearImmediate(t))
                        }),
                        t
                    }
                    ,
                    c.clearImmediate = "function" == typeof t ? t : function(e) {
                        delete i[e]
                    }
                }
                ).call(this, s("timers").setImmediate, s("timers").clearImmediate)
            }
            , {
                "process/browser.js": 1,
                timers: 3
            }],
            4: [function(e, t, n) {
                var r = e("promise-polyfill")
                  , o = "undefined" != typeof window ? window : Function("return this;")();
                t.exports = {
                    boltExport: o.Promise || r
                }
            }
            , {
                "promise-polyfill": 2
            }]
        }, {}, [4])(4)
    });
    var xn, Sn, Nn, En, kn = wn.exports.boltExport, _n = function(e) {
        var n = R.none()
          , t = []
          , r = function(e) {
            o() ? a(e) : t.push(e)
        }
          , o = function() {
            return n.isSome()
        }
          , i = function(e) {
            z(e, a)
        }
          , a = function(t) {
            n.each(function(e) {
                V.setTimeout(function() {
                    t(e)
                }, 0)
            })
        };
        return e(function(e) {
            n = R.some(e),
            i(t),
            t = []
        }),
        {
            get: r,
            map: function(n) {
                return _n(function(t) {
                    r(function(e) {
                        t(n(e))
                    })
                })
            },
            isReady: o
        }
    }, Rn = {
        nu: _n,
        pure: function(t) {
            return _n(function(e) {
                e(t)
            })
        }
    }, Tn = function(e) {
        V.setTimeout(function() {
            throw e
        }, 0)
    }, An = function(n) {
        var e = function(e) {
            n().then(e, Tn)
        };
        return {
            map: function(e) {
                return An(function() {
                    return n().then(e)
                })
            },
            bind: function(t) {
                return An(function() {
                    return n().then(function(e) {
                        return t(e).toPromise()
                    })
                })
            },
            anonBind: function(e) {
                return An(function() {
                    return n().then(function() {
                        return e.toPromise()
                    })
                })
            },
            toLazy: function() {
                return Rn.nu(e)
            },
            toCached: function() {
                var e = null;
                return An(function() {
                    return null === e && (e = n()),
                    e
                })
            },
            toPromise: n,
            get: e
        }
    }, Dn = {
        nu: function(e) {
            return An(function() {
                return new kn(e)
            })
        },
        pure: function(e) {
            return An(function() {
                return kn.resolve(e)
            })
        }
    }, On = function(a, e) {
        return e(function(r) {
            var o = []
              , i = 0;
            0 === a.length ? r([]) : z(a, function(e, t) {
                var n;
                e.get((n = t,
                function(e) {
                    o[n] = e,
                    ++i >= a.length && r(o)
                }
                ))
            })
        })
    }, Bn = function(e) {
        return On(e, Dn.nu)
    }, Pn = function(n) {
        return {
            is: function(e) {
                return n === e
            },
            isValue: h,
            isError: g,
            getOr: x(n),
            getOrThunk: x(n),
            getOrDie: x(n),
            or: function(e) {
                return Pn(n)
            },
            orThunk: function(e) {
                return Pn(n)
            },
            fold: function(e, t) {
                return t(n)
            },
            map: function(e) {
                return Pn(e(n))
            },
            mapError: function(e) {
                return Pn(n)
            },
            each: function(e) {
                e(n)
            },
            bind: function(e) {
                return e(n)
            },
            exists: function(e) {
                return e(n)
            },
            forall: function(e) {
                return e(n)
            },
            toOption: function() {
                return R.some(n)
            }
        }
    }, Ln = function(n) {
        return {
            is: g,
            isValue: g,
            isError: h,
            getOr: d,
            getOrThunk: function(e) {
                return e()
            },
            getOrDie: function() {
                return p(String(n))()
            },
            or: function(e) {
                return e
            },
            orThunk: function(e) {
                return e()
            },
            fold: function(e, t) {
                return e(n)
            },
            map: function(e) {
                return Ln(n)
            },
            mapError: function(e) {
                return Ln(e(n))
            },
            each: f,
            bind: function(e) {
                return Ln(n)
            },
            exists: g,
            forall: h,
            toOption: R.none
        }
    }, In = {
        value: Pn,
        error: Ln,
        fromOption: function(e, t) {
            return e.fold(function() {
                return Ln(t)
            }, Pn)
        }
    }, Mn = window.Promise ? window.Promise : (xn = Array.isArray || function(e) {
        return "[object Array]" === Object.prototype.toString.call(e)
    }
    ,
    Nn = (Sn = function(e) {
        if ("object" != typeof this)
            throw new TypeError("Promises must be constructed via new");
        if ("function" != typeof e)
            throw new TypeError("not a function");
        this._state = null,
        this._value = null,
        this._deferreds = [],
        qn(e, Fn(zn, this), Fn(jn, this))
    }
    ).immediateFn || "function" == typeof V.setImmediate && V.setImmediate || function(e) {
        V.setTimeout(e, 1)
    }
    ,
    Sn.prototype["catch"] = function(e) {
        return this.then(null, e)
    }
    ,
    Sn.prototype.then = function(n, r) {
        var o = this;
        return new Sn(function(e, t) {
            Un.call(o, new Vn(n,r,e,t))
        }
        )
    }
    ,
    Sn.all = function() {
        var s = Array.prototype.slice.call(1 === arguments.length && xn(arguments[0]) ? arguments[0] : arguments);
        return new Sn(function(o, i) {
            if (0 === s.length)
                return o([]);
            var a = s.length;
            function u(t, e) {
                try {
                    if (e && ("object" == typeof e || "function" == typeof e)) {
                        var n = e.then;
                        if ("function" == typeof n)
                            return void n.call(e, function(e) {
                                u(t, e)
                            }, i)
                    }
                    s[t] = e,
                    0 == --a && o(s)
                } catch (r) {
                    i(r)
                }
            }
            for (var e = 0; e < s.length; e++)
                u(e, s[e])
        }
        )
    }
    ,
    Sn.resolve = function(t) {
        return t && "object" == typeof t && t.constructor === Sn ? t : new Sn(function(e) {
            e(t)
        }
        )
    }
    ,
    Sn.reject = function(n) {
        return new Sn(function(e, t) {
            t(n)
        }
        )
    }
    ,
    Sn.race = function(o) {
        return new Sn(function(e, t) {
            for (var n = 0, r = o.length; n < r; n++)
                o[n].then(e, t)
        }
        )
    }
    ,
    Sn);
    function Fn(e, t) {
        return function() {
            e.apply(t, arguments)
        }
    }
    function Un(r) {
        var o = this;
        null !== this._state ? Nn(function() {
            var e = o._state ? r.onFulfilled : r.onRejected;
            if (null !== e) {
                var t;
                try {
                    t = e(o._value)
                } catch (n) {
                    return void r.reject(n)
                }
                r.resolve(t)
            } else
                (o._state ? r.resolve : r.reject)(o._value)
        }) : this._deferreds.push(r)
    }
    function zn(e) {
        try {
            if (e === this)
                throw new TypeError("A promise cannot be resolved with itself.");
            if (e && ("object" == typeof e || "function" == typeof e)) {
                var t = e.then;
                if ("function" == typeof t)
                    return void qn(Fn(t, e), Fn(zn, this), Fn(jn, this))
            }
            this._state = !0,
            this._value = e,
            Hn.call(this)
        } catch (n) {
            jn.call(this, n)
        }
    }
    function jn(e) {
        this._state = !1,
        this._value = e,
        Hn.call(this)
    }
    function Hn() {
        for (var e = 0, t = this._deferreds.length; e < t; e++)
            Un.call(this, this._deferreds[e]);
        this._deferreds = null
    }
    function Vn(e, t, n, r) {
        this.onFulfilled = "function" == typeof e ? e : null,
        this.onRejected = "function" == typeof t ? t : null,
        this.resolve = n,
        this.reject = r
    }
    function qn(e, t, n) {
        var r = !1;
        try {
            e(function(e) {
                r || (r = !0,
                t(e))
            }, function(e) {
                r || (r = !0,
                n(e))
            })
        } catch (o) {
            if (r)
                return;
            r = !0,
            n(o)
        }
    }
    var $n = function(e, t) {
        return "number" != typeof t && (t = 0),
        V.setTimeout(e, t)
    }
      , Wn = function(e, t) {
        return "number" != typeof t && (t = 1),
        V.setInterval(e, t)
    }
      , Kn = function(n, r) {
        var o, e;
        return (e = function() {
            for (var e = [], t = 0; t < arguments.length; t++)
                e[t] = arguments[t];
            V.clearTimeout(o),
            o = $n(function() {
                n.apply(this, e)
            }, r)
        }
        ).stop = function() {
            V.clearTimeout(o)
        }
        ,
        e
    }
      , Xn = {
        requestAnimationFrame: function(e, t) {
            En ? En.then(e) : En = new Mn(function(e) {
                !function(e, t) {
                    var n, r = V.window.requestAnimationFrame, o = ["ms", "moz", "webkit"];
                    for (n = 0; n < o.length && !r; n++)
                        r = V.window[o[n] + "RequestAnimationFrame"];
                    (r = r || function(e) {
                        V.window.setTimeout(e, 0)
                    }
                    )(e, t)
                }(e, t = t || V.document.body)
            }
            ).then(e)
        },
        setTimeout: $n,
        setInterval: Wn,
        setEditorTimeout: function(e, t, n) {
            return $n(function() {
                e.removed || t()
            }, n)
        },
        setEditorInterval: function(e, t, n) {
            var r;
            return r = Wn(function() {
                e.removed ? V.clearInterval(r) : t()
            }, n)
        },
        debounce: Kn,
        throttle: Kn,
        clearInterval: function(e) {
            return V.clearInterval(e)
        },
        clearTimeout: function(e) {
            return V.clearTimeout(e)
        }
    }
      , Yn = V.navigator.userAgent
      , Gn = nt()
      , Jn = Gn.browser
      , Qn = Gn.os
      , Zn = Gn.deviceType
      , er = /WebKit/.test(Yn) && !Jn.isEdge()
      , tr = "FormData"in V.window && "FileReader"in V.window && "URL"in V.window && !!V.URL.createObjectURL
      , nr = -1 !== Yn.indexOf("Windows Phone")
      , rr = {
        opera: Jn.isOpera(),
        webkit: er,
        ie: !(!Jn.isIE() && !Jn.isEdge()) && Jn.version.major,
        gecko: Jn.isFirefox(),
        mac: Qn.isOSX() || Qn.isiOS(),
        iOS: Zn.isiPad() || Zn.isiPhone(),
        android: Qn.isAndroid(),
        contentEditable: !0,
        transparentSrc: "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",
        caretAfter: !0,
        range: V.window.getSelection && "Range"in V.window,
        documentMode: Jn.isIE() ? V.document.documentMode || 7 : 10,
        fileApi: tr,
        ceFalse: !0,
        cacheSuffix: null,
        container: null,
        experimentalShadowDom: !1,
        canHaveCSP: !Jn.isIE(),
        desktop: Zn.isDesktop(),
        windowsPhone: nr,
        browser: {
            current: Jn.current,
            version: Jn.version,
            isChrome: Jn.isChrome,
            isEdge: Jn.isEdge,
            isFirefox: Jn.isFirefox,
            isIE: Jn.isIE,
            isOpera: Jn.isOpera,
            isSafari: Jn.isSafari
        },
        os: {
            current: Qn.current,
            version: Qn.version,
            isAndroid: Qn.isAndroid,
            isChromeOS: Qn.isChromeOS,
            isFreeBSD: Qn.isFreeBSD,
            isiOS: Qn.isiOS,
            isLinux: Qn.isLinux,
            isOSX: Qn.isOSX,
            isSolaris: Qn.isSolaris,
            isWindows: Qn.isWindows
        },
        deviceType: {
            isDesktop: Zn.isDesktop,
            isiPad: Zn.isiPad,
            isiPhone: Zn.isiPhone,
            isPhone: Zn.isPhone,
            isTablet: Zn.isTablet,
            isTouch: Zn.isTouch,
            isWebView: Zn.isWebView
        }
    }
      , or = Array.isArray
      , ir = function(e, t, n) {
        var r, o;
        if (!e)
            return 0;
        if (n = n || e,
        e.length !== undefined) {
            for (r = 0,
            o = e.length; r < o; r++)
                if (!1 === t.call(n, e[r], r, e))
                    return 0
        } else
            for (r in e)
                if (e.hasOwnProperty(r) && !1 === t.call(n, e[r], r, e))
                    return 0;
        return 1
    }
      , ar = function(n, r) {
        var o = [];
        return ir(n, function(e, t) {
            o.push(r(e, t, n))
        }),
        o
    }
      , ur = function(n, r) {
        var o = [];
        return ir(n, function(e, t) {
            r && !r(e, t, n) || o.push(e)
        }),
        o
    }
      , sr = function(e, t) {
        var n, r;
        if (e)
            for (n = 0,
            r = e.length; n < r; n++)
                if (e[n] === t)
                    return n;
        return -1
    }
      , cr = function(e, t, n, r) {
        var o = 0;
        for (arguments.length < 3 && (n = e[0]); o < e.length; o++)
            n = t.call(r, n, e[o], o);
        return n
    }
      , lr = function(e, t, n) {
        var r, o;
        for (r = 0,
        o = e.length; r < o; r++)
            if (t.call(n, e[r], r, e))
                return r;
        return -1
    }
      , fr = function(e) {
        return e[e.length - 1]
    }
      , dr = /^\s*|\s*$/g
      , mr = function(e) {
        return null === e || e === undefined ? "" : ("" + e).replace(dr, "")
    }
      , pr = function(e, t) {
        return t ? !("array" !== t || !or(e)) || typeof e === t : e !== undefined
    }
      , gr = function(e, n, r, o) {
        o = o || this,
        e && (r && (e = e[r]),
        ir(e, function(e, t) {
            if (!1 === n.call(o, e, t, r))
                return !1;
            gr(e, n, r, o)
        }))
    }
      , hr = {
        trim: mr,
        isArray: or,
        is: pr,
        toArray: function(e) {
            var t, n, r = e;
            if (!or(e))
                for (r = [],
                t = 0,
                n = e.length; t < n; t++)
                    r[t] = e[t];
            return r
        },
        makeMap: function(e, t, n) {
            var r;
            for (t = t || ",",
            "string" == typeof (e = e || []) && (e = e.split(t)),
            n = n || {},
            r = e.length; r--; )
                n[e[r]] = {};
            return n
        },
        each: ir,
        map: ar,
        grep: ur,
        inArray: sr,
        hasOwn: function(e, t) {
            return Object.prototype.hasOwnProperty.call(e, t)
        },
        extend: function(e) {
            for (var t = [], n = 1; n < arguments.length; n++)
                t[n - 1] = arguments[n];
            for (var r = 0; r < t.length; r++) {
                var o = t[r];
                for (var i in o)
                    if (o.hasOwnProperty(i)) {
                        var a = o[i];
                        a !== undefined && (e[i] = a)
                    }
            }
            return e
        },
        create: function(e, t, n) {
            var r, o, i, a, u, s = this, c = 0;
            if (e = /^((static) )?([\w.]+)(:([\w.]+))?/.exec(e),
            i = e[3].match(/(^|\.)(\w+)$/i)[2],
            !(o = s.createNS(e[3].replace(/\.\w+$/, ""), n))[i]) {
                if ("static" === e[2])
                    return o[i] = t,
                    void (this.onCreate && this.onCreate(e[2], e[3], o[i]));
                t[i] || (t[i] = function() {}
                ,
                c = 1),
                o[i] = t[i],
                s.extend(o[i].prototype, t),
                e[5] && (r = s.resolve(e[5]).prototype,
                a = e[5].match(/\.(\w+)$/i)[1],
                u = o[i],
                o[i] = c ? function() {
                    return r[a].apply(this, arguments)
                }
                : function() {
                    return this.parent = r[a],
                    u.apply(this, arguments)
                }
                ,
                o[i].prototype[i] = o[i],
                s.each(r, function(e, t) {
                    o[i].prototype[t] = r[t]
                }),
                s.each(t, function(e, t) {
                    r[t] ? o[i].prototype[t] = function() {
                        return this.parent = r[t],
                        e.apply(this, arguments)
                    }
                    : t !== i && (o[i].prototype[t] = e)
                })),
                s.each(t["static"], function(e, t) {
                    o[i][t] = e
                })
            }
        },
        walk: gr,
        createNS: function(e, t) {
            var n, r;
            for (t = t || V.window,
            e = e.split("."),
            n = 0; n < e.length; n++)
                t[r = e[n]] || (t[r] = {}),
                t = t[r];
            return t
        },
        resolve: function(e, t) {
            var n, r;
            for (t = t || V.window,
            n = 0,
            r = (e = e.split(".")).length; n < r && (t = t[e[n]]); n++)
                ;
            return t
        },
        explode: function(e, t) {
            return !e || pr(e, "array") ? e : ar(e.split(t || ","), mr)
        },
        _addCacheSuffix: function(e) {
            var t = rr.cacheSuffix;
            return t && (e += (-1 === e.indexOf("?") ? "?" : "&") + t),
            e
        }
    };
    function vr(p, g) {
        void 0 === g && (g = {});
        var h, v = 0, y = {};
        h = g.maxLoadTime || 5e3;
        var b = function(e) {
            p.getElementsByTagName("head")[0].appendChild(e)
        }
          , n = function(e, t, n) {
            var o, r, i, a, u = function(e) {
                a.status = e,
                a.passed = [],
                a.failed = [],
                o && (o.onload = null,
                o.onerror = null,
                o = null)
            }, s = function() {
                for (var e = a.passed, t = e.length; t--; )
                    e[t]();
                u(2)
            }, c = function() {
                for (var e = a.failed, t = e.length; t--; )
                    e[t]();
                u(3)
            }, l = function(e, t) {
                e() || ((new Date).getTime() - i < h ? Xn.setTimeout(t) : c())
            }, f = function() {
                l(function() {
                    for (var e, t, n = p.styleSheets, r = n.length; r--; )
                        if ((t = (e = n[r]).ownerNode ? e.ownerNode : e.owningElement) && t.id === o.id)
                            return s(),
                            1
                }, f)
            }, d = function() {
                l(function() {
                    try {
                        var e = r.sheet.cssRules;
                        return s(),
                        e
                    } catch (t) {}
                }, d)
            };
            if (e = hr._addCacheSuffix(e),
            y[e] ? a = y[e] : (a = {
                passed: [],
                failed: []
            },
            y[e] = a),
            t && a.passed.push(t),
            n && a.failed.push(n),
            1 !== a.status)
                if (2 !== a.status)
                    if (3 !== a.status) {
                        if (a.status = 1,
                        (o = p.createElement("link")).rel = "stylesheet",
                        o.type = "text/css",
                        o.id = "u" + v++,
                        o.async = !1,
                        o.defer = !1,
                        i = (new Date).getTime(),
                        g.contentCssCors && (o.crossOrigin = "anonymous"),
                        g.referrerPolicy && cn(Ne.fromDom(o), "referrerpolicy", g.referrerPolicy),
                        "onload"in o && !((m = V.navigator.userAgent.match(/WebKit\/(\d*)/)) && parseInt(m[1], 10) < 536))
                            o.onload = f,
                            o.onerror = c;
                        else {
                            if (0 < V.navigator.userAgent.indexOf("Firefox"))
                                return (r = p.createElement("style")).textContent = '@import "' + e + '"',
                                d(),
                                void b(r);
                            f()
                        }
                        var m;
                        b(o),
                        o.href = e
                    } else
                        c();
                else
                    s()
        }
          , t = function(t) {
            return Dn.nu(function(e) {
                n(t, a(e, x(In.value(t))), a(e, x(In.error(t))))
            })
        }
          , o = function(e) {
            return e.fold(d, d)
        };
        return {
            load: n,
            loadAll: function(e, n, r) {
                Bn(U(e, t)).get(function(e) {
                    var t = j(e, function(e) {
                        return e.isValue()
                    });
                    0 < t.fail.length ? r(t.fail.map(o)) : n(t.pass.map(o))
                })
            },
            _setReferrerPolicy: function(e) {
                g.referrerPolicy = e
            }
        }
    }
    var yr, br, Cr, wr = function(t) {
        var n;
        return function(e) {
            return (n = n || function(e, t) {
                for (var n = {}, r = 0, o = e.length; r < o; r++) {
                    var i = e[r];
                    n[String(i)] = t(i, r)
                }
                return n
            }(t, x(!0))).hasOwnProperty(Rt(e))
        }
    }, xr = wr(["h1", "h2", "h3", "h4", "h5", "h6"]), Sr = wr(["article", "aside", "details", "div", "dt", "figcaption", "footer", "form", "fieldset", "header", "hgroup", "html", "main", "nav", "section", "summary", "body", "p", "dl", "multicol", "dd", "figure", "address", "center", "blockquote", "h1", "h2", "h3", "h4", "h5", "h6", "listing", "xmp", "pre", "plaintext", "menu", "dir", "ul", "ol", "li", "hr", "table", "tbody", "thead", "tfoot", "th", "tr", "td", "caption"]), Nr = function(e) {
        return Dt(e) && !Sr(e)
    }, Er = function(e) {
        return Dt(e) && "br" === Rt(e)
    }, kr = wr(["h1", "h2", "h3", "h4", "h5", "h6", "p", "div", "address", "pre", "form", "blockquote", "center", "dir", "fieldset", "header", "footer", "article", "section", "hgroup", "aside", "nav", "figure"]), _r = wr(["ul", "ol", "dl"]), Rr = wr(["li", "dd", "dt"]), Tr = wr(["area", "base", "basefont", "br", "col", "frame", "hr", "img", "input", "isindex", "link", "meta", "param", "embed", "source", "wbr", "track"]), Ar = wr(["thead", "tbody", "tfoot"]), Dr = wr(["td", "th"]), Or = wr(["pre", "script", "textarea", "style"]), Br = function(e) {
        return e && "SPAN" === e.tagName && "bookmark" === e.getAttribute("data-mce-type")
    }, Pr = function(e, t) {
        var n, r = t.childNodes;
        if (!$t(t) || !Br(t)) {
            for (n = r.length - 1; 0 <= n; n--)
                Pr(e, r[n]);
            if (!1 === tn(t)) {
                if (Zt(t) && 0 < t.nodeValue.length) {
                    var o = hr.trim(t.nodeValue).length;
                    if (e.isBlock(t.parentNode) || 0 < o)
                        return;
                    if (0 === o && (a = (i = t).previousSibling && "SPAN" === i.previousSibling.nodeName,
                    u = i.nextSibling && "SPAN" === i.nextSibling.nodeName,
                    a && u))
                        return
                } else if ($t(t) && (1 === (r = t.childNodes).length && Br(r[0]) && t.parentNode.insertBefore(r[0], t),
                r.length || Tr(Ne.fromDom(t))))
                    return;
                e.remove(t)
            }
            var i, a, u;
            return t
        }
    }, Lr = hr.makeMap, Ir = /[&<>\"\u0060\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g, Mr = /[<>&\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g, Fr = /[<>&\"\']/g, Ur = /&#([a-z0-9]+);?|&([a-z0-9]+);/gi, zr = {
        128: "\u20ac",
        130: "\u201a",
        131: "\u0192",
        132: "\u201e",
        133: "\u2026",
        134: "\u2020",
        135: "\u2021",
        136: "\u02c6",
        137: "\u2030",
        138: "\u0160",
        139: "\u2039",
        140: "\u0152",
        142: "\u017d",
        145: "\u2018",
        146: "\u2019",
        147: "\u201c",
        148: "\u201d",
        149: "\u2022",
        150: "\u2013",
        151: "\u2014",
        152: "\u02dc",
        153: "\u2122",
        154: "\u0161",
        155: "\u203a",
        156: "\u0153",
        158: "\u017e",
        159: "\u0178"
    };
    br = {
        '"': "&quot;",
        "'": "&#39;",
        "<": "&lt;",
        ">": "&gt;",
        "&": "&amp;",
        "`": "&#96;"
    },
    Cr = {
        "&lt;": "<",
        "&gt;": ">",
        "&amp;": "&",
        "&quot;": '"',
        "&apos;": "'"
    };
    var jr = function(e, t) {
        var n, r, o, i = {};
        if (e) {
            for (e = e.split(","),
            t = t || 10,
            n = 0; n < e.length; n += 2)
                r = String.fromCharCode(parseInt(e[n], t)),
                br[r] || (o = "&" + e[n + 1] + ";",
                i[r] = o,
                i[o] = r);
            return i
        }
    };
    yr = jr("50,nbsp,51,iexcl,52,cent,53,pound,54,curren,55,yen,56,brvbar,57,sect,58,uml,59,copy,5a,ordf,5b,laquo,5c,not,5d,shy,5e,reg,5f,macr,5g,deg,5h,plusmn,5i,sup2,5j,sup3,5k,acute,5l,micro,5m,para,5n,middot,5o,cedil,5p,sup1,5q,ordm,5r,raquo,5s,frac14,5t,frac12,5u,frac34,5v,iquest,60,Agrave,61,Aacute,62,Acirc,63,Atilde,64,Auml,65,Aring,66,AElig,67,Ccedil,68,Egrave,69,Eacute,6a,Ecirc,6b,Euml,6c,Igrave,6d,Iacute,6e,Icirc,6f,Iuml,6g,ETH,6h,Ntilde,6i,Ograve,6j,Oacute,6k,Ocirc,6l,Otilde,6m,Ouml,6n,times,6o,Oslash,6p,Ugrave,6q,Uacute,6r,Ucirc,6s,Uuml,6t,Yacute,6u,THORN,6v,szlig,70,agrave,71,aacute,72,acirc,73,atilde,74,auml,75,aring,76,aelig,77,ccedil,78,egrave,79,eacute,7a,ecirc,7b,euml,7c,igrave,7d,iacute,7e,icirc,7f,iuml,7g,eth,7h,ntilde,7i,ograve,7j,oacute,7k,ocirc,7l,otilde,7m,ouml,7n,divide,7o,oslash,7p,ugrave,7q,uacute,7r,ucirc,7s,uuml,7t,yacute,7u,thorn,7v,yuml,ci,fnof,sh,Alpha,si,Beta,sj,Gamma,sk,Delta,sl,Epsilon,sm,Zeta,sn,Eta,so,Theta,sp,Iota,sq,Kappa,sr,Lambda,ss,Mu,st,Nu,su,Xi,sv,Omicron,t0,Pi,t1,Rho,t3,Sigma,t4,Tau,t5,Upsilon,t6,Phi,t7,Chi,t8,Psi,t9,Omega,th,alpha,ti,beta,tj,gamma,tk,delta,tl,epsilon,tm,zeta,tn,eta,to,theta,tp,iota,tq,kappa,tr,lambda,ts,mu,tt,nu,tu,xi,tv,omicron,u0,pi,u1,rho,u2,sigmaf,u3,sigma,u4,tau,u5,upsilon,u6,phi,u7,chi,u8,psi,u9,omega,uh,thetasym,ui,upsih,um,piv,812,bull,816,hellip,81i,prime,81j,Prime,81u,oline,824,frasl,88o,weierp,88h,image,88s,real,892,trade,89l,alefsym,8cg,larr,8ch,uarr,8ci,rarr,8cj,darr,8ck,harr,8dl,crarr,8eg,lArr,8eh,uArr,8ei,rArr,8ej,dArr,8ek,hArr,8g0,forall,8g2,part,8g3,exist,8g5,empty,8g7,nabla,8g8,isin,8g9,notin,8gb,ni,8gf,prod,8gh,sum,8gi,minus,8gn,lowast,8gq,radic,8gt,prop,8gu,infin,8h0,ang,8h7,and,8h8,or,8h9,cap,8ha,cup,8hb,int,8hk,there4,8hs,sim,8i5,cong,8i8,asymp,8j0,ne,8j1,equiv,8j4,le,8j5,ge,8k2,sub,8k3,sup,8k4,nsub,8k6,sube,8k7,supe,8kl,oplus,8kn,otimes,8l5,perp,8m5,sdot,8o8,lceil,8o9,rceil,8oa,lfloor,8ob,rfloor,8p9,lang,8pa,rang,9ea,loz,9j0,spades,9j3,clubs,9j5,hearts,9j6,diams,ai,OElig,aj,oelig,b0,Scaron,b1,scaron,bo,Yuml,m6,circ,ms,tilde,802,ensp,803,emsp,809,thinsp,80c,zwnj,80d,zwj,80e,lrm,80f,rlm,80j,ndash,80k,mdash,80o,lsquo,80p,rsquo,80q,sbquo,80s,ldquo,80t,rdquo,80u,bdquo,810,dagger,811,Dagger,81g,permil,81p,lsaquo,81q,rsaquo,85c,euro", 32);
    var Hr = function(e, t) {
        return e.replace(t ? Ir : Mr, function(e) {
            return br[e] || e
        })
    }
      , Vr = function(e, t) {
        return e.replace(t ? Ir : Mr, function(e) {
            return 1 < e.length ? "&#" + (1024 * (e.charCodeAt(0) - 55296) + (e.charCodeAt(1) - 56320) + 65536) + ";" : br[e] || "&#" + e.charCodeAt(0) + ";"
        })
    }
      , qr = function(e, t, n) {
        return n = n || yr,
        e.replace(t ? Ir : Mr, function(e) {
            return br[e] || n[e] || e
        })
    }
      , $r = {
        encodeRaw: Hr,
        encodeAllRaw: function(e) {
            return ("" + e).replace(Fr, function(e) {
                return br[e] || e
            })
        },
        encodeNumeric: Vr,
        encodeNamed: qr,
        getEncodeFunc: function(e, t) {
            var n = jr(t) || yr
              , r = Lr(e.replace(/\+/g, ","));
            return r.named && r.numeric ? function(e, t) {
                return e.replace(t ? Ir : Mr, function(e) {
                    return br[e] !== undefined ? br[e] : n[e] !== undefined ? n[e] : 1 < e.length ? "&#" + (1024 * (e.charCodeAt(0) - 55296) + (e.charCodeAt(1) - 56320) + 65536) + ";" : "&#" + e.charCodeAt(0) + ";"
                })
            }
            : r.named ? t ? function(e, t) {
                return qr(e, t, n)
            }
            : qr : r.numeric ? Vr : Hr
        },
        decode: function(e) {
            return e.replace(Ur, function(e, t) {
                return t ? 65535 < (t = "x" === t.charAt(0).toLowerCase() ? parseInt(t.substr(1), 16) : parseInt(t, 10)) ? (t -= 65536,
                String.fromCharCode(55296 + (t >> 10), 56320 + (1023 & t))) : zr[t] || String.fromCharCode(t) : Cr[e] || yr[e] || (n = e,
                (r = Ne.fromTag("div").dom()).innerHTML = n,
                r.textContent || r.innerText || n);
                var n, r
            })
        }
    }
      , Wr = {}
      , Kr = {}
      , Xr = hr.makeMap
      , Yr = hr.each
      , Gr = hr.extend
      , Jr = hr.explode
      , Qr = hr.inArray
      , Zr = function(e, t) {
        return (e = hr.trim(e)) ? e.split(t || " ") : []
    }
      , eo = function(e) {
        var u, t, n, r, o, i, s = {}, a = function(e, t, n) {
            var r, o, i, a = function(e, t) {
                var n, r, o = {};
                for (n = 0,
                r = e.length; n < r; n++)
                    o[e[n]] = t || {};
                return o
            };
            for (t = t || "",
            "string" == typeof (n = n || []) && (n = Zr(n)),
            r = (e = Zr(e)).length; r--; )
                i = {
                    attributes: a(o = Zr([u, t].join(" "))),
                    attributesOrder: o,
                    children: a(n, Kr)
                },
                s[e[r]] = i
        }, c = function(e, t) {
            var n, r, o, i;
            for (n = (e = Zr(e)).length,
            t = Zr(t); n--; )
                for (r = s[e[n]],
                o = 0,
                i = t.length; o < i; o++)
                    r.attributes[t[o]] = {},
                    r.attributesOrder.push(t[o])
        };
        return Wr[e] ? Wr[e] : (u = "id accesskey class dir lang style tabindex title role",
        t = "address blockquote div dl fieldset form h1 h2 h3 h4 h5 h6 hr menu ol p pre table ul",
        n = "a abbr b bdo br button cite code del dfn em embed i iframe img input ins kbd label map noscript object q s samp script select small span strong sub sup textarea u var #text #comment",
        "html4" !== e && (u += " contenteditable contextmenu draggable dropzone hidden spellcheck translate",
        t += " article aside details dialog figure main header footer hgroup section nav",
        n += " audio canvas command datalist mark meter output picture progress time wbr video ruby bdi keygen"),
        "html5-strict" !== e && (u += " xml:lang",
        n = [n, i = "acronym applet basefont big font strike tt"].join(" "),
        Yr(Zr(i), function(e) {
            a(e, "", n)
        }),
        t = [t, o = "center dir isindex noframes"].join(" "),
        r = [t, n].join(" "),
        Yr(Zr(o), function(e) {
            a(e, "", r)
        })),
        r = r || [t, n].join(" "),
        a("html", "manifest", "head body"),
        a("head", "", "base command link meta noscript script style title"),
        a("title hr noscript br"),
        a("base", "href target"),
        a("link", "href rel media hreflang type sizes hreflang"),
        a("meta", "name http-equiv content charset"),
        a("style", "media type scoped"),
        a("script", "src async defer type charset"),
        a("body", "onafterprint onbeforeprint onbeforeunload onblur onerror onfocus onhashchange onload onmessage onoffline ononline onpagehide onpageshow onpopstate onresize onscroll onstorage onunload", r),
        a("address dt dd div caption", "", r),
        a("h1 h2 h3 h4 h5 h6 pre p abbr code var samp kbd sub sup i b u bdo span legend em strong small s cite dfn", "", n),
        a("blockquote", "cite", r),
        a("ol", "reversed start type", "li"),
        a("ul", "", "li"),
        a("li", "value", r),
        a("dl", "", "dt dd"),
        a("a", "href target rel media hreflang type", n),
        a("q", "cite", n),
        a("ins del", "cite datetime", r),
        a("img", "src sizes srcset alt usemap ismap width height"),
        a("iframe", "src name width height", r),
        a("embed", "src type width height"),
        a("object", "data type typemustmatch name usemap form width height", [r, "param"].join(" ")),
        a("param", "name value"),
        a("map", "name", [r, "area"].join(" ")),
        a("area", "alt coords shape href target rel media hreflang type"),
        a("table", "border", "caption colgroup thead tfoot tbody tr" + ("html4" === e ? " col" : "")),
        a("colgroup", "span", "col"),
        a("col", "span"),
        a("tbody thead tfoot", "", "tr"),
        a("tr", "", "td th"),
        a("td", "colspan rowspan headers", r),
        a("th", "colspan rowspan headers scope abbr", r),
        a("form", "accept-charset action autocomplete enctype method name novalidate target", r),
        a("fieldset", "disabled form name", [r, "legend"].join(" ")),
        a("label", "form for", n),
        a("input", "accept alt autocomplete checked dirname disabled form formaction formenctype formmethod formnovalidate formtarget height list max maxlength min multiple name pattern readonly required size src step type value width"),
        a("button", "disabled form formaction formenctype formmethod formnovalidate formtarget name type value", "html4" === e ? r : n),
        a("select", "disabled form multiple name required size", "option optgroup"),
        a("optgroup", "disabled label", "option"),
        a("option", "disabled label selected value"),
        a("textarea", "cols dirname disabled form maxlength name readonly required rows wrap"),
        a("menu", "type label", [r, "li"].join(" ")),
        a("noscript", "", r),
        "html4" !== e && (a("wbr"),
        a("ruby", "", [n, "rt rp"].join(" ")),
        a("figcaption", "", r),
        a("mark rt rp summary bdi", "", n),
        a("canvas", "width height", r),
        a("video", "src crossorigin poster preload autoplay mediagroup loop muted controls width height buffered", [r, "track source"].join(" ")),
        a("audio", "src crossorigin preload autoplay mediagroup loop muted controls buffered volume", [r, "track source"].join(" ")),
        a("picture", "", "img source"),
        a("source", "src srcset type media sizes"),
        a("track", "kind src srclang label default"),
        a("datalist", "", [n, "option"].join(" ")),
        a("article section nav aside main header footer", "", r),
        a("hgroup", "", "h1 h2 h3 h4 h5 h6"),
        a("figure", "", [r, "figcaption"].join(" ")),
        a("time", "datetime", n),
        a("dialog", "open", r),
        a("command", "type label icon disabled checked radiogroup command"),
        a("output", "for form name", n),
        a("progress", "value max", n),
        a("meter", "value min max low high optimum", n),
        a("details", "open", [r, "summary"].join(" ")),
        a("keygen", "autofocus challenge disabled form keytype name")),
        "html5-strict" !== e && (c("script", "language xml:space"),
        c("style", "xml:space"),
        c("object", "declare classid code codebase codetype archive standby align border hspace vspace"),
        c("embed", "align name hspace vspace"),
        c("param", "valuetype type"),
        c("a", "charset name rev shape coords"),
        c("br", "clear"),
        c("applet", "codebase archive code object alt name width height align hspace vspace"),
        c("img", "name longdesc align border hspace vspace"),
        c("iframe", "longdesc frameborder marginwidth marginheight scrolling align"),
        c("font basefont", "size color face"),
        c("input", "usemap align"),
        c("select"),
        c("textarea"),
        c("h1 h2 h3 h4 h5 h6 div p legend caption", "align"),
        c("ul", "type compact"),
        c("li", "type"),
        c("ol dl menu dir", "compact"),
        c("pre", "width xml:space"),
        c("hr", "align noshade size width"),
        c("isindex", "prompt"),
        c("table", "summary width frame rules cellspacing cellpadding align bgcolor"),
        c("col", "width align char charoff valign"),
        c("colgroup", "width align char charoff valign"),
        c("thead", "align char charoff valign"),
        c("tr", "align char charoff valign bgcolor"),
        c("th", "axis align char charoff valign nowrap bgcolor width height"),
        c("form", "accept"),
        c("td", "abbr axis scope align char charoff valign nowrap bgcolor width height"),
        c("tfoot", "align char charoff valign"),
        c("tbody", "align char charoff valign"),
        c("area", "nohref"),
        c("body", "background bgcolor text link vlink alink")),
        "html4" !== e && (c("input button select textarea", "autofocus"),
        c("input textarea", "placeholder"),
        c("a", "download"),
        c("link script img", "crossorigin"),
        c("img", "loading"),
        c("iframe", "sandbox seamless allowfullscreen loading")),
        Yr(Zr("a form meter progress dfn"), function(e) {
            s[e] && delete s[e].children[e]
        }),
        delete s.caption.children.table,
        delete s.script,
        Wr[e] = s)
    }
      , to = function(e, n) {
        var r;
        return e && (r = {},
        "string" == typeof e && (e = {
            "*": e
        }),
        Yr(e, function(e, t) {
            r[t] = r[t.toUpperCase()] = ("map" === n ? Xr : Jr)(e, /[, ]/)
        })),
        r
    };
    function no(i) {
        var e, t, n, r, o, a, u, s, c, l, f, d, m, x = {}, p = {}, S = [], g = {}, h = {}, v = function(e, t, n) {
            var r = i[e];
            return r ? r = Xr(r, /[, ]/, Xr(r.toUpperCase(), /[, ]/)) : (r = Wr[e]) || (r = Xr(t, " ", Xr(t.toUpperCase(), " ")),
            r = Gr(r, n),
            Wr[e] = r),
            r
        };
        n = eo((i = i || {}).schema),
        !1 === i.verify_html && (i.valid_elements = "*[*]"),
        e = to(i.valid_styles),
        t = to(i.invalid_styles, "map"),
        s = to(i.valid_classes, "map"),
        r = v("whitespace_elements", "pre script noscript style textarea video audio iframe object code"),
        o = v("self_closing_elements", "colgroup dd dt li option p td tfoot th thead tr"),
        a = v("short_ended_elements", "area base basefont br col frame hr img input isindex link meta param embed source wbr track"),
        u = v("boolean_attributes", "checked compact declare defer disabled ismap multiple nohref noresize noshade nowrap readonly selected autoplay loop controls"),
        l = v("non_empty_elements", "td th iframe video audio object script pre code", a),
        f = v("move_caret_before_on_enter_elements", "table", l),
        d = v("text_block_elements", "h1 h2 h3 h4 h5 h6 p div address pre form blockquote center dir fieldset header footer article section hgroup aside main nav figure"),
        c = v("block_elements", "hr table tbody thead tfoot th tr td li ol ul caption dl dt dd noscript menu isindex option datalist select optgroup figcaption details summary", d),
        m = v("text_inline_elements", "span strong b em i font strike u var cite dfn code mark q sup sub samp"),
        Yr((i.special || "script noscript noframes noembed title style textarea xmp").split(" "), function(e) {
            h[e] = new RegExp("</" + e + "[^>]*>","gi")
        });
        var N = function(e) {
            return new RegExp("^" + e.replace(/([?+*])/g, ".$1") + "$")
        }
          , y = function(e) {
            var t, n, r, o, i, a, u, s, c, l, f, d, m, p, g, h, v, y, b = /^([#+\-])?([^\[!\/]+)(?:\/([^\[!]+))?(?:(!?)\[([^\]]+)\])?$/, C = /^([!\-])?(\w+[\\:]:\w+|[^=:<]+)?(?:([=:<])(.*))?$/, w = /[*?+]/;
            if (e)
                for (e = Zr(e, ","),
                x["@"] && (h = x["@"].attributes,
                v = x["@"].attributesOrder),
                t = 0,
                n = e.length; t < n; t++)
                    if (i = b.exec(e[t])) {
                        if (p = i[1],
                        c = i[2],
                        g = i[3],
                        s = i[5],
                        a = {
                            attributes: d = {},
                            attributesOrder: m = []
                        },
                        "#" === p && (a.paddEmpty = !0),
                        "-" === p && (a.removeEmpty = !0),
                        "!" === i[4] && (a.removeEmptyAttrs = !0),
                        h && (oe(h, function(e, t) {
                            d[t] = e
                        }),
                        m.push.apply(m, v)),
                        s)
                            for (r = 0,
                            o = (s = Zr(s, "|")).length; r < o; r++)
                                if (i = C.exec(s[r])) {
                                    if (u = {},
                                    f = i[1],
                                    l = i[2].replace(/[\\:]:/g, ":"),
                                    p = i[3],
                                    y = i[4],
                                    "!" === f && (a.attributesRequired = a.attributesRequired || [],
                                    a.attributesRequired.push(l),
                                    u.required = !0),
                                    "-" === f) {
                                        delete d[l],
                                        m.splice(Qr(m, l), 1);
                                        continue
                                    }
                                    p && ("=" === p && (a.attributesDefault = a.attributesDefault || [],
                                    a.attributesDefault.push({
                                        name: l,
                                        value: y
                                    }),
                                    u.defaultValue = y),
                                    ":" === p && (a.attributesForced = a.attributesForced || [],
                                    a.attributesForced.push({
                                        name: l,
                                        value: y
                                    }),
                                    u.forcedValue = y),
                                    "<" === p && (u.validValues = Xr(y, "?"))),
                                    w.test(l) ? (a.attributePatterns = a.attributePatterns || [],
                                    u.pattern = N(l),
                                    a.attributePatterns.push(u)) : (d[l] || m.push(l),
                                    d[l] = u)
                                }
                        h || "@" !== c || (h = d,
                        v = m),
                        g && (a.outputName = c,
                        x[g] = a),
                        w.test(c) ? (a.pattern = N(c),
                        S.push(a)) : x[c] = a
                    }
        }
          , b = function(e) {
            x = {},
            S = [],
            y(e),
            Yr(n, function(e, t) {
                p[t] = e.children
            })
        }
          , C = function(e) {
            var a = /^(~)?(.+)$/;
            e && (Wr.text_block_elements = Wr.block_elements = null,
            Yr(Zr(e, ","), function(e) {
                var t = a.exec(e)
                  , n = "~" === t[1]
                  , r = n ? "span" : "div"
                  , o = t[2];
                if (p[o] = p[r],
                g[o] = r,
                n || (c[o.toUpperCase()] = {},
                c[o] = {}),
                !x[o]) {
                    var i = x[r];
                    delete (i = Gr({}, i)).removeEmptyAttrs,
                    delete i.removeEmpty,
                    x[o] = i
                }
                Yr(p, function(e, t) {
                    e[r] && (p[t] = e = Gr({}, p[t]),
                    e[o] = e[r])
                })
            }))
        }
          , w = function(e) {
            var o = /^([+\-]?)(\w+)\[([^\]]+)\]$/;
            Wr[i.schema] = null,
            e && Yr(Zr(e, ","), function(e) {
                var t, n, r = o.exec(e);
                r && (n = r[1],
                t = n ? p[r[2]] : p[r[2]] = {
                    "#comment": {}
                },
                t = p[r[2]],
                Yr(Zr(r[3], "|"), function(e) {
                    "-" === n ? delete t[e] : t[e] = {}
                }))
            })
        }
          , E = function(e) {
            var t, n = x[e];
            if (n)
                return n;
            for (t = S.length; t--; )
                if ((n = S[t]).pattern.test(e))
                    return n
        };
        i.valid_elements ? b(i.valid_elements) : (Yr(n, function(e, t) {
            x[t] = {
                attributes: e.attributes,
                attributesOrder: e.attributesOrder
            },
            p[t] = e.children
        }),
        "html5" !== i.schema && Yr(Zr("strong/b em/i"), function(e) {
            e = Zr(e, "/"),
            x[e[1]].outputName = e[0]
        }),
        Yr(Zr("ol ul sub sup blockquote span font a table tbody tr strong em b i"), function(e) {
            x[e] && (x[e].removeEmpty = !0)
        }),
        Yr(Zr("p h1 h2 h3 h4 h5 h6 th td pre div address caption li"), function(e) {
            x[e].paddEmpty = !0
        }),
        Yr(Zr("span"), function(e) {
            x[e].removeEmptyAttrs = !0
        })),
        C(i.custom_elements),
        w(i.valid_children),
        y(i.extended_valid_elements),
        w("+ol[ul|ol],+ul[ul|ol]"),
        Yr({
            dd: "dl",
            dt: "dl",
            li: "ul ol",
            td: "tr",
            th: "tr",
            tr: "tbody thead tfoot",
            tbody: "table",
            thead: "table",
            tfoot: "table",
            legend: "fieldset",
            area: "map",
            param: "video audio object"
        }, function(e, t) {
            x[t] && (x[t].parentsRequired = Zr(e))
        }),
        i.invalid_elements && Yr(Jr(i.invalid_elements), function(e) {
            x[e] && delete x[e]
        }),
        E("span") || y("span[!data-mce-type|*]");
        return {
            children: p,
            elements: x,
            getValidStyles: function() {
                return e
            },
            getValidClasses: function() {
                return s
            },
            getBlockElements: function() {
                return c
            },
            getInvalidStyles: function() {
                return t
            },
            getShortEndedElements: function() {
                return a
            },
            getTextBlockElements: function() {
                return d
            },
            getTextInlineElements: function() {
                return m
            },
            getBoolAttrs: function() {
                return u
            },
            getElementRule: E,
            getSelfClosingElements: function() {
                return o
            },
            getNonEmptyElements: function() {
                return l
            },
            getMoveCaretBeforeOnEnterElements: function() {
                return f
            },
            getWhiteSpaceElements: function() {
                return r
            },
            getSpecialElements: function() {
                return h
            },
            isValidChild: function(e, t) {
                var n = p[e.toLowerCase()];
                return !(!n || !n[t.toLowerCase()])
            },
            isValid: function(e, t) {
                var n, r, o = E(e);
                if (o) {
                    if (!t)
                        return !0;
                    if (o.attributes[t])
                        return !0;
                    if (n = o.attributePatterns)
                        for (r = n.length; r--; )
                            if (n[r].pattern.test(e))
                                return !0
                }
                return !1
            },
            getCustomElements: function() {
                return g
            },
            addValidElements: y,
            setValidElements: b,
            addCustomElements: C,
            addValidChildren: w
        }
    }
    var ro = "\ufeff"
      , oo = "\xa0"
      , io = function(e, t, n, r) {
        var o = function(e) {
            return 1 < (e = parseInt(e, 10).toString(16)).length ? e : "0" + e
        };
        return "#" + o(t) + o(n) + o(r)
    }
      , ao = function(b, e) {
        var C, t, s, c, w = /rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\s*\)/gi, x = /(?:url(?:(?:\(\s*\"([^\"]+)\"\s*\))|(?:\(\s*\'([^\']+)\'\s*\))|(?:\(\s*([^)\s]+)\s*\))))|(?:\'([^\']+)\')|(?:\"([^\"]+)\")/gi, S = /\s*([^:]+):\s*([^;]+);?/g, N = /\s+$/, E = {}, k = ro;
        for (b = b || {},
        e && (s = e.getValidStyles(),
        c = e.getInvalidStyles()),
        t = ("\\\" \\' \\; \\: ; : " + k).split(" "),
        C = 0; C < t.length; C++)
            E[t[C]] = k + C,
            E[k + C] = t[C];
        return {
            toHex: function(e) {
                return e.replace(w, io)
            },
            parse: function(e) {
                var t, n, r, o, i, a, u, s, c = {}, l = b.url_converter, f = b.url_converter_scope || this, d = function(e, t, n) {
                    var r, o, i, a;
                    if ((r = c[e + "-top" + t]) && (o = c[e + "-right" + t]) && (i = c[e + "-bottom" + t]) && (a = c[e + "-left" + t])) {
                        var u = [r, o, i, a];
                        for (C = u.length - 1; C-- && u[C] === u[C + 1]; )
                            ;
                        -1 < C && n || (c[e + t] = -1 === C ? u[0] : u.join(" "),
                        delete c[e + "-top" + t],
                        delete c[e + "-right" + t],
                        delete c[e + "-bottom" + t],
                        delete c[e + "-left" + t])
                    }
                }, m = function(e) {
                    var t, n = c[e];
                    if (n) {
                        for (t = (n = n.split(" ")).length; t--; )
                            if (n[t] !== n[0])
                                return !1;
                        return c[e] = n[0],
                        !0
                    }
                }, p = function(e) {
                    return o = !0,
                    E[e]
                }, g = function(e, t) {
                    return o && (e = e.replace(/\uFEFF[0-9]/g, function(e) {
                        return E[e]
                    })),
                    t || (e = e.replace(/\\([\'\";:])/g, "$1")),
                    e
                }, h = function(e) {
                    return String.fromCharCode(parseInt(e.slice(1), 16))
                }, v = function(e) {
                    return e.replace(/\\[0-9a-f]+/gi, h)
                }, y = function(e, t, n, r, o, i) {
                    if (o = o || i)
                        return "'" + (o = g(o)).replace(/\'/g, "\\'") + "'";
                    if (t = g(t || n || r),
                    !b.allow_script_urls) {
                        var a = t.replace(/[\s\r\n]+/g, "");
                        if (/(java|vb)script:/i.test(a))
                            return "";
                        if (!b.allow_svg_data_urls && /^data:image\/svg/i.test(a))
                            return ""
                    }
                    return l && (t = l.call(f, t, "style")),
                    "url('" + t.replace(/\'/g, "\\'") + "')"
                };
                if (e) {
                    for (e = (e = e.replace(/[\u0000-\u001F]/g, "")).replace(/\\[\"\';:\uFEFF]/g, p).replace(/\"[^\"]+\"|\'[^\']+\'/g, function(e) {
                        return e.replace(/[;:]/g, p)
                    }); t = S.exec(e); )
                        if (S.lastIndex = t.index + t[0].length,
                        n = t[1].replace(N, "").toLowerCase(),
                        r = t[2].replace(N, ""),
                        n && r) {
                            if (n = v(n),
                            r = v(r),
                            -1 !== n.indexOf(k) || -1 !== n.indexOf('"'))
                                continue;
                            if (!b.allow_script_urls && ("behavior" === n || /expression\s*\(|\/\*|\*\//.test(r)))
                                continue;
                            "font-weight" === n && "700" === r ? r = "bold" : "color" !== n && "background-color" !== n || (r = r.toLowerCase()),
                            r = (r = r.replace(w, io)).replace(x, y),
                            c[n] = o ? g(r, !0) : r
                        }
                    d("border", "", !0),
                    d("border", "-width"),
                    d("border", "-color"),
                    d("border", "-style"),
                    d("padding", ""),
                    d("margin", ""),
                    i = "border",
                    u = "border-style",
                    s = "border-color",
                    m(a = "border-width") && m(u) && m(s) && (c[i] = c[a] + " " + c[u] + " " + c[s],
                    delete c[a],
                    delete c[u],
                    delete c[s]),
                    "medium none" === c.border && delete c.border,
                    "none" === c["border-image"] && delete c["border-image"]
                }
                return c
            },
            serialize: function(i, a) {
                var u = ""
                  , e = function(e) {
                    var t, n, r, o;
                    if (t = s[e])
                        for (n = 0,
                        r = t.length; n < r; n++)
                            e = t[n],
                            (o = i[e]) && (u += (0 < u.length ? " " : "") + e + ": " + o + ";")
                };
                return a && s ? (e("*"),
                e(a)) : oe(i, function(e, t) {
                    var n, r, o;
                    !e || c && (n = t,
                    r = a,
                    (o = c["*"]) && o[n] || (o = c[r]) && o[n]) || (u += (0 < u.length ? " " : "") + t + ": " + e + ";")
                }),
                u
            }
        }
    }
      , uo = /^(?:mouse|contextmenu)|click/
      , so = {
        keyLocation: 1,
        layerX: 1,
        layerY: 1,
        returnValue: 1,
        webkitMovementX: 1,
        webkitMovementY: 1,
        keyIdentifier: 1,
        mozPressure: 1
    }
      , co = function() {
        return !1
    }
      , lo = function() {
        return !0
    }
      , fo = function(e, t, n, r) {
        e.addEventListener ? e.addEventListener(t, n, r || !1) : e.attachEvent && e.attachEvent("on" + t, n)
    }
      , mo = function(e, t, n, r) {
        e.removeEventListener ? e.removeEventListener(t, n, r || !1) : e.detachEvent && e.detachEvent("on" + t, n)
    }
      , po = function(e, t) {
        var n, r, o = t || {};
        for (n in e)
            so[n] || (o[n] = e[n]);
        if (o.target || (o.target = o.srcElement || V.document),
        rr.experimentalShadowDom && (o.target = function(e, t) {
            if (e.composedPath) {
                var n = e.composedPath();
                if (n && 0 < n.length)
                    return n[0]
            }
            return t
        }(e, o.target)),
        e && uo.test(e.type) && e.pageX === undefined && e.clientX !== undefined) {
            var i = o.target.ownerDocument || V.document
              , a = i.documentElement
              , u = i.body;
            o.pageX = e.clientX + (a && a.scrollLeft || u && u.scrollLeft || 0) - (a && a.clientLeft || u && u.clientLeft || 0),
            o.pageY = e.clientY + (a && a.scrollTop || u && u.scrollTop || 0) - (a && a.clientTop || u && u.clientTop || 0)
        }
        return o.preventDefault = function() {
            o.isDefaultPrevented = lo,
            e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
        }
        ,
        o.stopPropagation = function() {
            o.isPropagationStopped = lo,
            e && (e.stopPropagation ? e.stopPropagation() : e.cancelBubble = !0)
        }
        ,
        !(o.stopImmediatePropagation = function() {
            o.isImmediatePropagationStopped = lo,
            o.stopPropagation()
        }
        ) == ((r = o).isDefaultPrevented === lo || r.isDefaultPrevented === co) && (o.isDefaultPrevented = co,
        o.isPropagationStopped = co,
        o.isImmediatePropagationStopped = co),
        "undefined" == typeof o.metaKey && (o.metaKey = !1),
        o
    }
      , go = function(e, t, n) {
        var r = e.document
          , o = {
            type: "ready"
        };
        if (n.domLoaded)
            t(o);
        else {
            var i = function() {
                mo(e, "DOMContentLoaded", i),
                mo(e, "load", i),
                n.domLoaded || (n.domLoaded = !0,
                t(o))
            };
            "complete" === r.readyState || "interactive" === r.readyState && r.body ? i() : fo(e, "DOMContentLoaded", i),
            fo(e, "load", i)
        }
    }
      , ho = (vo.prototype.bind = function(e, t, n, r) {
        var o, i, a, u, s, c, l, f = this, d = V.window, m = function(e) {
            f.executeHandlers(po(e || d.event), o)
        };
        if (e && 3 !== e.nodeType && 8 !== e.nodeType) {
            e[f.expando] ? o = e[f.expando] : (o = f.count++,
            e[f.expando] = o,
            f.events[o] = {}),
            r = r || e;
            var p = t.split(" ");
            for (a = p.length; a--; )
                c = m,
                s = l = !1,
                "DOMContentLoaded" === (u = p[a]) && (u = "ready"),
                f.domLoaded && "ready" === u && "complete" === e.readyState ? n.call(r, po({
                    type: u
                })) : (f.hasMouseEnterLeave || (s = f.mouseEnterLeave[u]) && (c = function(e) {
                    var t, n;
                    if (t = e.currentTarget,
                    (n = e.relatedTarget) && t.contains)
                        n = t.contains(n);
                    else
                        for (; n && n !== t; )
                            n = n.parentNode;
                    n || ((e = po(e || d.event)).type = "mouseout" === e.type ? "mouseleave" : "mouseenter",
                    e.target = t,
                    f.executeHandlers(e, o))
                }
                ),
                f.hasFocusIn || "focusin" !== u && "focusout" !== u || (l = !0,
                s = "focusin" === u ? "focus" : "blur",
                c = function(e) {
                    (e = po(e || d.event)).type = "focus" === e.type ? "focusin" : "focusout",
                    f.executeHandlers(e, o)
                }
                ),
                (i = f.events[o][u]) ? "ready" === u && f.domLoaded ? n(po({
                    type: u
                })) : i.push({
                    func: n,
                    scope: r
                }) : (f.events[o][u] = i = [{
                    func: n,
                    scope: r
                }],
                i.fakeName = s,
                i.capture = l,
                i.nativeHandler = c,
                "ready" === u ? go(e, c, f) : fo(e, s || u, c, l)));
            return e = i = 0,
            n
        }
    }
    ,
    vo.prototype.unbind = function(n, e, t) {
        var r, o, i, a, u, s;
        if (!n || 3 === n.nodeType || 8 === n.nodeType)
            return this;
        if (r = n[this.expando]) {
            if (s = this.events[r],
            e) {
                var c = e.split(" ");
                for (i = c.length; i--; )
                    if (o = s[u = c[i]]) {
                        if (t)
                            for (a = o.length; a--; )
                                if (o[a].func === t) {
                                    var l = o.nativeHandler
                                      , f = o.fakeName
                                      , d = o.capture;
                                    (o = o.slice(0, a).concat(o.slice(a + 1))).nativeHandler = l,
                                    o.fakeName = f,
                                    o.capture = d,
                                    s[u] = o
                                }
                        t && 0 !== o.length || (delete s[u],
                        mo(n, o.fakeName || u, o.nativeHandler, o.capture))
                    }
            } else
                oe(s, function(e, t) {
                    mo(n, e.fakeName || t, e.nativeHandler, e.capture)
                }),
                s = {};
            for (u in s)
                if (me(s, u))
                    return this;
            delete this.events[r];
            try {
                delete n[this.expando]
            } catch (m) {
                n[this.expando] = null
            }
        }
        return this
    }
    ,
    vo.prototype.fire = function(e, t, n) {
        var r;
        if (!e || 3 === e.nodeType || 8 === e.nodeType)
            return this;
        var o = po(null, n);
        for (o.type = t,
        o.target = e; (r = e[this.expando]) && this.executeHandlers(o, r),
        (e = e.parentNode || e.ownerDocument || e.defaultView || e.parentWindow) && !o.isPropagationStopped(); )
            ;
        return this
    }
    ,
    vo.prototype.clean = function(e) {
        var t, n;
        if (!e || 3 === e.nodeType || 8 === e.nodeType)
            return this;
        if (e[this.expando] && this.unbind(e),
        e.getElementsByTagName || (e = e.document),
        e && e.getElementsByTagName)
            for (this.unbind(e),
            t = (n = e.getElementsByTagName("*")).length; t--; )
                (e = n[t])[this.expando] && this.unbind(e);
        return this
    }
    ,
    vo.prototype.destroy = function() {
        this.events = {}
    }
    ,
    vo.prototype.cancel = function(e) {
        return e && (e.preventDefault(),
        e.stopImmediatePropagation()),
        !1
    }
    ,
    vo.prototype.executeHandlers = function(e, t) {
        var n, r, o, i, a = this.events[t];
        if (n = a && a[e.type])
            for (r = 0,
            o = n.length; r < o; r++)
                if ((i = n[r]) && !1 === i.func.call(i.scope, e) && e.preventDefault(),
                e.isImmediatePropagationStopped())
                    return
    }
    ,
    vo.Event = new vo,
    vo);
    function vo() {
        this.domLoaded = !1,
        this.events = {},
        this.count = 1,
        this.expando = "mce-data-" + (+new Date).toString(32),
        this.hasMouseEnterLeave = "onmouseenter"in V.document.documentElement,
        this.hasFocusIn = "onfocusin"in V.document.documentElement,
        this.count = 1
    }
    var yo, bo, Co, wo, xo, So, No, Eo, ko, _o, Ro, To, Ao, Do, Oo, Bo, Po, Lo = "sizzle" + -new Date, Io = V.window.document, Mo = 0, Fo = 0, Uo = vi(), zo = vi(), jo = vi(), Ho = function(e, t) {
        return e === t && (_o = !0),
        0
    }, Vo = typeof undefined, qo = {}.hasOwnProperty, $o = [], Wo = $o.pop, Ko = $o.push, Xo = $o.push, Yo = $o.slice, Go = $o.indexOf || function(e) {
        for (var t = 0, n = this.length; t < n; t++)
            if (this[t] === e)
                return t;
        return -1
    }
    , Jo = "[\\x20\\t\\r\\n\\f]", Qo = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", Zo = "\\[" + Jo + "*(" + Qo + ")(?:" + Jo + "*([*^$|!~]?=)" + Jo + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + Qo + "))|)" + Jo + "*\\]", ei = ":(" + Qo + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + Zo + ")*)|.*)\\)|)", ti = new RegExp("^" + Jo + "+|((?:^|[^\\\\])(?:\\\\.)*)" + Jo + "+$","g"), ni = new RegExp("^" + Jo + "*," + Jo + "*"), ri = new RegExp("^" + Jo + "*([>+~]|" + Jo + ")" + Jo + "*"), oi = new RegExp("=" + Jo + "*([^\\]'\"]*?)" + Jo + "*\\]","g"), ii = new RegExp(ei), ai = new RegExp("^" + Qo + "$"), ui = {
        ID: new RegExp("^#(" + Qo + ")"),
        CLASS: new RegExp("^\\.(" + Qo + ")"),
        TAG: new RegExp("^(" + Qo + "|[*])"),
        ATTR: new RegExp("^" + Zo),
        PSEUDO: new RegExp("^" + ei),
        CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + Jo + "*(even|odd|(([+-]|)(\\d*)n|)" + Jo + "*(?:([+-]|)" + Jo + "*(\\d+)|))" + Jo + "*\\)|)","i"),
        bool: new RegExp("^(?:checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)$","i"),
        needsContext: new RegExp("^" + Jo + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + Jo + "*((?:-\\d)?\\d*)" + Jo + "*\\)|)(?=[^-]|$)","i")
    }, si = /^(?:input|select|textarea|button)$/i, ci = /^h\d$/i, li = /^[^{]+\{\s*\[native \w/, fi = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, di = /[+~]/, mi = /'|\\/g, pi = new RegExp("\\\\([\\da-f]{1,6}" + Jo + "?|(" + Jo + ")|.)","ig"), gi = function(e, t, n) {
        var r = "0x" + t - 65536;
        return r != r || n ? t : r < 0 ? String.fromCharCode(65536 + r) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320)
    };
    try {
        Xo.apply($o = Yo.call(Io.childNodes), Io.childNodes),
        $o[Io.childNodes.length].nodeType
    } catch (pE) {
        Xo = {
            apply: $o.length ? function(e, t) {
                Ko.apply(e, Yo.call(t))
            }
            : function(e, t) {
                for (var n = e.length, r = 0; e[n++] = t[r++]; )
                    ;
                e.length = n - 1
            }
        }
    }
    var hi = function(e, t, n, r) {
        var o, i, a, u, s, c, l, f, d, m;
        if ((t ? t.ownerDocument || t : Io) !== To && Ro(t),
        n = n || [],
        !e || "string" != typeof e)
            return n;
        if (1 !== (u = (t = t || To).nodeType) && 9 !== u)
            return [];
        if (Do && !r) {
            if (o = fi.exec(e))
                if (a = o[1]) {
                    if (9 === u) {
                        if (!(i = t.getElementById(a)) || !i.parentNode)
                            return n;
                        if (i.id === a)
                            return n.push(i),
                            n
                    } else if (t.ownerDocument && (i = t.ownerDocument.getElementById(a)) && Po(t, i) && i.id === a)
                        return n.push(i),
                        n
                } else {
                    if (o[2])
                        return Xo.apply(n, t.getElementsByTagName(e)),
                        n;
                    if ((a = o[3]) && yo.getElementsByClassName)
                        return Xo.apply(n, t.getElementsByClassName(a)),
                        n
                }
            if (yo.qsa && (!Oo || !Oo.test(e))) {
                if (f = l = Lo,
                d = t,
                m = 9 === u && e,
                1 === u && "object" !== t.nodeName.toLowerCase()) {
                    for (c = xo(e),
                    (l = t.getAttribute("id")) ? f = l.replace(mi, "\\$&") : t.setAttribute("id", f),
                    f = "[id='" + f + "'] ",
                    s = c.length; s--; )
                        c[s] = f + Si(c[s]);
                    d = di.test(e) && wi(t.parentNode) || t,
                    m = c.join(",")
                }
                if (m)
                    try {
                        return Xo.apply(n, d.querySelectorAll(m)),
                        n
                    } catch (p) {} finally {
                        l || t.removeAttribute("id")
                    }
            }
        }
        return No(e.replace(ti, "$1"), t, n, r)
    };
    function vi() {
        var n = [];
        function r(e, t) {
            return n.push(e + " ") > bo.cacheLength && delete r[n.shift()],
            r[e + " "] = t
        }
        return r
    }
    function yi(e) {
        return e[Lo] = !0,
        e
    }
    function bi(e, t) {
        var n = t && e
          , r = n && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || 1 << 31) - (~e.sourceIndex || 1 << 31);
        if (r)
            return r;
        if (n)
            for (; n = n.nextSibling; )
                if (n === t)
                    return -1;
        return e ? 1 : -1
    }
    function Ci(a) {
        return yi(function(i) {
            return i = +i,
            yi(function(e, t) {
                for (var n, r = a([], e.length, i), o = r.length; o--; )
                    e[n = r[o]] && (e[n] = !(t[n] = e[n]))
            })
        })
    }
    function wi(e) {
        return e && typeof e.getElementsByTagName != Vo && e
    }
    function xi() {}
    function Si(e) {
        for (var t = 0, n = e.length, r = ""; t < n; t++)
            r += e[t].value;
        return r
    }
    function Ni(a, e, t) {
        var u = e.dir
          , s = t && "parentNode" === u
          , c = Fo++;
        return e.first ? function(e, t, n) {
            for (; e = e[u]; )
                if (1 === e.nodeType || s)
                    return a(e, t, n)
        }
        : function(e, t, n) {
            var r, o, i = [Mo, c];
            if (n) {
                for (; e = e[u]; )
                    if ((1 === e.nodeType || s) && a(e, t, n))
                        return !0
            } else
                for (; e = e[u]; )
                    if (1 === e.nodeType || s) {
                        if ((r = (o = e[Lo] || (e[Lo] = {}))[u]) && r[0] === Mo && r[1] === c)
                            return i[2] = r[2];
                        if ((o[u] = i)[2] = a(e, t, n))
                            return !0
                    }
        }
    }
    function Ei(o) {
        return 1 < o.length ? function(e, t, n) {
            for (var r = o.length; r--; )
                if (!o[r](e, t, n))
                    return !1;
            return !0
        }
        : o[0]
    }
    function ki(e, t, n, r, o) {
        for (var i, a = [], u = 0, s = e.length, c = null != t; u < s; u++)
            (i = e[u]) && (n && !n(i, r, o) || (a.push(i),
            c && t.push(u)));
        return a
    }
    function _i(p, g, h, v, y, e) {
        return v && !v[Lo] && (v = _i(v)),
        y && !y[Lo] && (y = _i(y, e)),
        yi(function(e, t, n, r) {
            var o, i, a, u = [], s = [], c = t.length, l = e || function m(e, t, n) {
                for (var r = 0, o = t.length; r < o; r++)
                    hi(e, t[r], n);
                return n
            }(g || "*", n.nodeType ? [n] : n, []), f = !p || !e && g ? l : ki(l, u, p, n, r), d = h ? y || (e ? p : c || v) ? [] : t : f;
            if (h && h(f, d, n, r),
            v)
                for (o = ki(d, s),
                v(o, [], n, r),
                i = o.length; i--; )
                    (a = o[i]) && (d[s[i]] = !(f[s[i]] = a));
            if (e) {
                if (y || p) {
                    if (y) {
                        for (o = [],
                        i = d.length; i--; )
                            (a = d[i]) && o.push(f[i] = a);
                        y(null, d = [], o, r)
                    }
                    for (i = d.length; i--; )
                        (a = d[i]) && -1 < (o = y ? Go.call(e, a) : u[i]) && (e[o] = !(t[o] = a))
                }
            } else
                d = ki(d === t ? d.splice(c, d.length) : d),
                y ? y(null, t, d, r) : Xo.apply(t, d)
        })
    }
    function Ri(e) {
        for (var r, t, n, o = e.length, i = bo.relative[e[0].type], a = i || bo.relative[" "], u = i ? 1 : 0, s = Ni(function(e) {
            return e === r
        }, a, !0), c = Ni(function(e) {
            return -1 < Go.call(r, e)
        }, a, !0), l = [function(e, t, n) {
            return !i && (n || t !== Eo) || ((r = t).nodeType ? s : c)(e, t, n)
        }
        ]; u < o; u++)
            if (t = bo.relative[e[u].type])
                l = [Ni(Ei(l), t)];
            else {
                if ((t = bo.filter[e[u].type].apply(null, e[u].matches))[Lo]) {
                    for (n = ++u; n < o && !bo.relative[e[n].type]; n++)
                        ;
                    return _i(1 < u && Ei(l), 1 < u && Si(e.slice(0, u - 1).concat({
                        value: " " === e[u - 2].type ? "*" : ""
                    })).replace(ti, "$1"), t, u < n && Ri(e.slice(u, n)), n < o && Ri(e = e.slice(n)), n < o && Si(e))
                }
                l.push(t)
            }
        return Ei(l)
    }
    yo = hi.support = {},
    wo = hi.isXML = function(e) {
        var t = e && (e.ownerDocument || e).documentElement;
        return !!t && "HTML" !== t.nodeName
    }
    ,
    Ro = hi.setDocument = function(e) {
        var t, s = e ? e.ownerDocument || e : Io, n = s.defaultView;
        return s !== To && 9 === s.nodeType && s.documentElement ? (Ao = (To = s).documentElement,
        Do = !wo(s),
        n && n !== function r(e) {
            try {
                return e.top
            } catch (t) {}
            return null
        }(n) && (n.addEventListener ? n.addEventListener("unload", function() {
            Ro()
        }, !1) : n.attachEvent && n.attachEvent("onunload", function() {
            Ro()
        })),
        yo.attributes = !0,
        yo.getElementsByTagName = !0,
        yo.getElementsByClassName = li.test(s.getElementsByClassName),
        yo.getById = !0,
        bo.find.ID = function(e, t) {
            if (typeof t.getElementById != Vo && Do) {
                var n = t.getElementById(e);
                return n && n.parentNode ? [n] : []
            }
        }
        ,
        bo.filter.ID = function(e) {
            var t = e.replace(pi, gi);
            return function(e) {
                return e.getAttribute("id") === t
            }
        }
        ,
        bo.find.TAG = yo.getElementsByTagName ? function(e, t) {
            if (typeof t.getElementsByTagName != Vo)
                return t.getElementsByTagName(e)
        }
        : function(e, t) {
            var n, r = [], o = 0, i = t.getElementsByTagName(e);
            if ("*" !== e)
                return i;
            for (; n = i[o++]; )
                1 === n.nodeType && r.push(n);
            return r
        }
        ,
        bo.find.CLASS = yo.getElementsByClassName && function(e, t) {
            if (Do)
                return t.getElementsByClassName(e)
        }
        ,
        Bo = [],
        Oo = [],
        yo.disconnectedMatch = !0,
        Oo = Oo.length && new RegExp(Oo.join("|")),
        Bo = Bo.length && new RegExp(Bo.join("|")),
        t = li.test(Ao.compareDocumentPosition),
        Po = t || li.test(Ao.contains) ? function(e, t) {
            var n = 9 === e.nodeType ? e.documentElement : e
              , r = t && t.parentNode;
            return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)))
        }
        : function(e, t) {
            if (t)
                for (; t = t.parentNode; )
                    if (t === e)
                        return !0;
            return !1
        }
        ,
        Ho = t ? function(e, t) {
            if (e === t)
                return _o = !0,
                0;
            var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
            return n || (1 & (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !yo.sortDetached && t.compareDocumentPosition(e) === n ? e === s || e.ownerDocument === Io && Po(Io, e) ? -1 : t === s || t.ownerDocument === Io && Po(Io, t) ? 1 : ko ? Go.call(ko, e) - Go.call(ko, t) : 0 : 4 & n ? -1 : 1)
        }
        : function(e, t) {
            if (e === t)
                return _o = !0,
                0;
            var n, r = 0, o = e.parentNode, i = t.parentNode, a = [e], u = [t];
            if (!o || !i)
                return e === s ? -1 : t === s ? 1 : o ? -1 : i ? 1 : ko ? Go.call(ko, e) - Go.call(ko, t) : 0;
            if (o === i)
                return bi(e, t);
            for (n = e; n = n.parentNode; )
                a.unshift(n);
            for (n = t; n = n.parentNode; )
                u.unshift(n);
            for (; a[r] === u[r]; )
                r++;
            return r ? bi(a[r], u[r]) : a[r] === Io ? -1 : u[r] === Io ? 1 : 0
        }
        ,
        s) : To
    }
    ,
    hi.matches = function(e, t) {
        return hi(e, null, null, t)
    }
    ,
    hi.matchesSelector = function(e, t) {
        if ((e.ownerDocument || e) !== To && Ro(e),
        t = t.replace(oi, "='$1']"),
        yo.matchesSelector && Do && (!Bo || !Bo.test(t)) && (!Oo || !Oo.test(t)))
            try {
                var n = (void 0).call(e, t);
                if (n || yo.disconnectedMatch || e.document && 11 !== e.document.nodeType)
                    return n
            } catch (pE) {}
        return 0 < hi(t, To, null, [e]).length
    }
    ,
    hi.contains = function(e, t) {
        return (e.ownerDocument || e) !== To && Ro(e),
        Po(e, t)
    }
    ,
    hi.attr = function(e, t) {
        (e.ownerDocument || e) !== To && Ro(e);
        var n = bo.attrHandle[t.toLowerCase()]
          , r = n && qo.call(bo.attrHandle, t.toLowerCase()) ? n(e, t, !Do) : undefined;
        return r !== undefined ? r : yo.attributes || !Do ? e.getAttribute(t) : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
    }
    ,
    hi.error = function(e) {
        throw new Error("Syntax error, unrecognized expression: " + e)
    }
    ,
    hi.uniqueSort = function(e) {
        var t, n = [], r = 0, o = 0;
        if (_o = !yo.detectDuplicates,
        ko = !yo.sortStable && e.slice(0),
        e.sort(Ho),
        _o) {
            for (; t = e[o++]; )
                t === e[o] && (r = n.push(o));
            for (; r--; )
                e.splice(n[r], 1)
        }
        return ko = null,
        e
    }
    ,
    Co = hi.getText = function(e) {
        var t, n = "", r = 0, o = e.nodeType;
        if (o) {
            if (1 === o || 9 === o || 11 === o) {
                if ("string" == typeof e.textContent)
                    return e.textContent;
                for (e = e.firstChild; e; e = e.nextSibling)
                    n += Co(e)
            } else if (3 === o || 4 === o)
                return e.nodeValue
        } else
            for (; t = e[r++]; )
                n += Co(t);
        return n
    }
    ,
    (bo = hi.selectors = {
        cacheLength: 50,
        createPseudo: yi,
        match: ui,
        attrHandle: {},
        find: {},
        relative: {
            ">": {
                dir: "parentNode",
                first: !0
            },
            " ": {
                dir: "parentNode"
            },
            "+": {
                dir: "previousSibling",
                first: !0
            },
            "~": {
                dir: "previousSibling"
            }
        },
        preFilter: {
            ATTR: function(e) {
                return e[1] = e[1].replace(pi, gi),
                e[3] = (e[3] || e[4] || e[5] || "").replace(pi, gi),
                "~=" === e[2] && (e[3] = " " + e[3] + " "),
                e.slice(0, 4)
            },
            CHILD: function(e) {
                return e[1] = e[1].toLowerCase(),
                "nth" === e[1].slice(0, 3) ? (e[3] || hi.error(e[0]),
                e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])),
                e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && hi.error(e[0]),
                e
            },
            PSEUDO: function(e) {
                var t, n = !e[6] && e[2];
                return ui.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && ii.test(n) && (t = xo(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t),
                e[2] = n.slice(0, t)),
                e.slice(0, 3))
            }
        },
        filter: {
            TAG: function(e) {
                var t = e.replace(pi, gi).toLowerCase();
                return "*" === e ? function() {
                    return !0
                }
                : function(e) {
                    return e.nodeName && e.nodeName.toLowerCase() === t
                }
            },
            CLASS: function(e) {
                var t = Uo[e + " "];
                return t || (t = new RegExp("(^|" + Jo + ")" + e + "(" + Jo + "|$)")) && Uo(e, function(e) {
                    return t.test("string" == typeof e.className && e.className || typeof e.getAttribute != Vo && e.getAttribute("class") || "")
                })
            },
            ATTR: function(n, r, o) {
                return function(e) {
                    var t = hi.attr(e, n);
                    return null == t ? "!=" === r : !r || (t += "",
                    "=" === r ? t === o : "!=" === r ? t !== o : "^=" === r ? o && 0 === t.indexOf(o) : "*=" === r ? o && -1 < t.indexOf(o) : "$=" === r ? o && t.slice(-o.length) === o : "~=" === r ? -1 < (" " + t + " ").indexOf(o) : "|=" === r && (t === o || t.slice(0, o.length + 1) === o + "-"))
                }
            },
            CHILD: function(m, e, t, p, g) {
                var h = "nth" !== m.slice(0, 3)
                  , v = "last" !== m.slice(-4)
                  , y = "of-type" === e;
                return 1 === p && 0 === g ? function(e) {
                    return !!e.parentNode
                }
                : function(e, t, n) {
                    var r, o, i, a, u, s, c = h != v ? "nextSibling" : "previousSibling", l = e.parentNode, f = y && e.nodeName.toLowerCase(), d = !n && !y;
                    if (l) {
                        if (h) {
                            for (; c; ) {
                                for (i = e; i = i[c]; )
                                    if (y ? i.nodeName.toLowerCase() === f : 1 === i.nodeType)
                                        return !1;
                                s = c = "only" === m && !s && "nextSibling"
                            }
                            return !0
                        }
                        if (s = [v ? l.firstChild : l.lastChild],
                        v && d) {
                            for (u = (r = (o = l[Lo] || (l[Lo] = {}))[m] || [])[0] === Mo && r[1],
                            a = r[0] === Mo && r[2],
                            i = u && l.childNodes[u]; i = ++u && i && i[c] || (a = u = 0) || s.pop(); )
                                if (1 === i.nodeType && ++a && i === e) {
                                    o[m] = [Mo, u, a];
                                    break
                                }
                        } else if (d && (r = (e[Lo] || (e[Lo] = {}))[m]) && r[0] === Mo)
                            a = r[1];
                        else
                            for (; (i = ++u && i && i[c] || (a = u = 0) || s.pop()) && ((y ? i.nodeName.toLowerCase() !== f : 1 !== i.nodeType) || !++a || (d && ((i[Lo] || (i[Lo] = {}))[m] = [Mo, a]),
                            i !== e)); )
                                ;
                        return (a -= g) === p || a % p == 0 && 0 <= a / p
                    }
                }
            },
            PSEUDO: function(e, i) {
                var t, a = bo.pseudos[e] || bo.setFilters[e.toLowerCase()] || hi.error("unsupported pseudo: " + e);
                return a[Lo] ? a(i) : 1 < a.length ? (t = [e, e, "", i],
                bo.setFilters.hasOwnProperty(e.toLowerCase()) ? yi(function(e, t) {
                    for (var n, r = a(e, i), o = r.length; o--; )
                        e[n = Go.call(e, r[o])] = !(t[n] = r[o])
                }) : function(e) {
                    return a(e, 0, t)
                }
                ) : a
            }
        },
        pseudos: {
            not: yi(function(e) {
                var r = []
                  , o = []
                  , u = So(e.replace(ti, "$1"));
                return u[Lo] ? yi(function(e, t, n, r) {
                    for (var o, i = u(e, null, r, []), a = e.length; a--; )
                        (o = i[a]) && (e[a] = !(t[a] = o))
                }) : function(e, t, n) {
                    return r[0] = e,
                    u(r, null, n, o),
                    !o.pop()
                }
            }),
            has: yi(function(t) {
                return function(e) {
                    return 0 < hi(t, e).length
                }
            }),
            contains: yi(function(t) {
                return t = t.replace(pi, gi),
                function(e) {
                    return -1 < (e.textContent || e.innerText || Co(e)).indexOf(t)
                }
            }),
            lang: yi(function(n) {
                return ai.test(n || "") || hi.error("unsupported lang: " + n),
                n = n.replace(pi, gi).toLowerCase(),
                function(e) {
                    var t;
                    do {
                        if (t = Do ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang"))
                            return (t = t.toLowerCase()) === n || 0 === t.indexOf(n + "-")
                    } while ((e = e.parentNode) && 1 === e.nodeType);return !1
                }
            }),
            target: function(e) {
                var t = V.window.location && V.window.location.hash;
                return t && t.slice(1) === e.id
            },
            root: function(e) {
                return e === Ao
            },
            focus: function(e) {
                return e === To.activeElement && (!To.hasFocus || To.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
            },
            enabled: function(e) {
                return !1 === e.disabled
            },
            disabled: function(e) {
                return !0 === e.disabled
            },
            checked: function(e) {
                var t = e.nodeName.toLowerCase();
                return "input" === t && !!e.checked || "option" === t && !!e.selected
            },
            selected: function(e) {
                return e.parentNode && e.parentNode.selectedIndex,
                !0 === e.selected
            },
            empty: function(e) {
                for (e = e.firstChild; e; e = e.nextSibling)
                    if (e.nodeType < 6)
                        return !1;
                return !0
            },
            parent: function(e) {
                return !bo.pseudos.empty(e)
            },
            header: function(e) {
                return ci.test(e.nodeName)
            },
            input: function(e) {
                return si.test(e.nodeName)
            },
            button: function(e) {
                var t = e.nodeName.toLowerCase();
                return "input" === t && "button" === e.type || "button" === t
            },
            text: function(e) {
                var t;
                return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
            },
            first: Ci(function() {
                return [0]
            }),
            last: Ci(function(e, t) {
                return [t - 1]
            }),
            eq: Ci(function(e, t, n) {
                return [n < 0 ? n + t : n]
            }),
            even: Ci(function(e, t) {
                for (var n = 0; n < t; n += 2)
                    e.push(n);
                return e
            }),
            odd: Ci(function(e, t) {
                for (var n = 1; n < t; n += 2)
                    e.push(n);
                return e
            }),
            lt: Ci(function(e, t, n) {
                for (var r = n < 0 ? n + t : n; 0 <= --r; )
                    e.push(r);
                return e
            }),
            gt: Ci(function(e, t, n) {
                for (var r = n < 0 ? n + t : n; ++r < t; )
                    e.push(r);
                return e
            })
        }
    }).pseudos.nth = bo.pseudos.eq,
    z(["radio", "checkbox", "file", "password", "image"], function(e) {
        bo.pseudos[e] = function n(t) {
            return function(e) {
                return "input" === e.nodeName.toLowerCase() && e.type === t
            }
        }(e)
    }),
    z(["submit", "reset"], function(e) {
        bo.pseudos[e] = function t(n) {
            return function(e) {
                var t = e.nodeName.toLowerCase();
                return ("input" === t || "button" === t) && e.type === n
            }
        }(e)
    }),
    xi.prototype = bo.filters = bo.pseudos,
    bo.setFilters = new xi,
    xo = hi.tokenize = function(e, t) {
        var n, r, o, i, a, u, s, c = zo[e + " "];
        if (c)
            return t ? 0 : c.slice(0);
        for (a = e,
        u = [],
        s = bo.preFilter; a; ) {
            for (i in n && !(r = ni.exec(a)) || (r && (a = a.slice(r[0].length) || a),
            u.push(o = [])),
            n = !1,
            (r = ri.exec(a)) && (n = r.shift(),
            o.push({
                value: n,
                type: r[0].replace(ti, " ")
            }),
            a = a.slice(n.length)),
            bo.filter)
                bo.filter.hasOwnProperty(i) && (!(r = ui[i].exec(a)) || s[i] && !(r = s[i](r)) || (n = r.shift(),
                o.push({
                    value: n,
                    type: i,
                    matches: r
                }),
                a = a.slice(n.length)));
            if (!n)
                break
        }
        return t ? a.length : a ? hi.error(e) : zo(e, u).slice(0)
    }
    ,
    So = hi.compile = function(e, t) {
        var n, r = [], o = [], i = jo[e + " "];
        if (!i) {
            for (n = (t = t || xo(e)).length; n--; )
                (i = Ri(t[n]))[Lo] ? r.push(i) : o.push(i);
            (i = jo(e, function a(h, v) {
                var y = 0 < v.length
                  , b = 0 < h.length
                  , e = function(e, t, n, r, o) {
                    var i, a, u, s = 0, c = "0", l = e && [], f = [], d = Eo, m = e || b && bo.find.TAG("*", o), p = Mo += null == d ? 1 : Math.random() || .1, g = m.length;
                    for (o && (Eo = t !== To && t); c !== g && null != (i = m[c]); c++) {
                        if (b && i) {
                            for (a = 0; u = h[a++]; )
                                if (u(i, t, n)) {
                                    r.push(i);
                                    break
                                }
                            o && (Mo = p)
                        }
                        y && ((i = !u && i) && s--,
                        e && l.push(i))
                    }
                    if (s += c,
                    y && c !== s) {
                        for (a = 0; u = v[a++]; )
                            u(l, f, t, n);
                        if (e) {
                            if (0 < s)
                                for (; c--; )
                                    l[c] || f[c] || (f[c] = Wo.call(r));
                            f = ki(f)
                        }
                        Xo.apply(r, f),
                        o && !e && 0 < f.length && 1 < s + v.length && hi.uniqueSort(r)
                    }
                    return o && (Mo = p,
                    Eo = d),
                    l
                };
                return y ? yi(e) : e
            }(o, r))).selector = e
        }
        return i
    }
    ,
    No = hi.select = function(e, t, n, r) {
        var o, i, a, u, s, c = "function" == typeof e && e, l = !r && xo(e = c.selector || e);
        if (n = n || [],
        1 === l.length) {
            if (2 < (i = l[0] = l[0].slice(0)).length && "ID" === (a = i[0]).type && yo.getById && 9 === t.nodeType && Do && bo.relative[i[1].type]) {
                if (!(t = (bo.find.ID(a.matches[0].replace(pi, gi), t) || [])[0]))
                    return n;
                c && (t = t.parentNode),
                e = e.slice(i.shift().value.length)
            }
            for (o = ui.needsContext.test(e) ? 0 : i.length; o-- && (a = i[o],
            !bo.relative[u = a.type]); )
                if ((s = bo.find[u]) && (r = s(a.matches[0].replace(pi, gi), di.test(i[0].type) && wi(t.parentNode) || t))) {
                    if (i.splice(o, 1),
                    !(e = r.length && Si(i)))
                        return Xo.apply(n, r),
                        n;
                    break
                }
        }
        return (c || So(e, l))(r, t, !Do, n, di.test(e) && wi(t.parentNode) || t),
        n
    }
    ,
    yo.sortStable = Lo.split("").sort(Ho).join("") === Lo,
    yo.detectDuplicates = !!_o,
    Ro(),
    yo.sortDetached = !0;
    var Ti = V.document
      , Ai = Array.prototype.push
      , Di = Array.prototype.slice
      , Oi = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/
      , Bi = ho.Event
      , Pi = hr.makeMap("children,contents,next,prev")
      , Li = function(e) {
        return void 0 !== e
    }
      , Ii = function(e) {
        return "string" == typeof e
    }
      , Mi = function(e, t) {
        var n, r, o;
        for (o = (t = t || Ti).createElement("div"),
        n = t.createDocumentFragment(),
        o.innerHTML = e; r = o.firstChild; )
            n.appendChild(r);
        return n
    }
      , Fi = function(e, t, n, r) {
        var o;
        if (Ii(t))
            t = Mi(t, Qi(e[0]));
        else if (t.length && !t.nodeType) {
            if (t = na.makeArray(t),
            r)
                for (o = t.length - 1; 0 <= o; o--)
                    Fi(e, t[o], n, r);
            else
                for (o = 0; o < t.length; o++)
                    Fi(e, t[o], n, r);
            return e
        }
        if (t.nodeType)
            for (o = e.length; o--; )
                n.call(e[o], t);
        return e
    }
      , Ui = function(e, t) {
        return e && t && -1 !== (" " + e.className + " ").indexOf(" " + t + " ")
    }
      , zi = function(e, t, n) {
        var r, o;
        return t = na(t)[0],
        e.each(function() {
            n && r === this.parentNode || (r = this.parentNode,
            o = t.cloneNode(!1),
            this.parentNode.insertBefore(o, this)),
            o.appendChild(this)
        }),
        e
    }
      , ji = hr.makeMap("fillOpacity fontWeight lineHeight opacity orphans widows zIndex zoom", " ")
      , Hi = hr.makeMap("checked compact declare defer disabled ismap multiple nohref noshade nowrap readonly selected", " ")
      , Vi = {
        "for": "htmlFor",
        "class": "className",
        readonly: "readOnly"
    }
      , qi = {
        "float": "cssFloat"
    }
      , $i = {}
      , Wi = {}
      , Ki = function(e, t) {
        return new na.fn.init(e,t)
    }
      , Xi = /^\s*|\s*$/g
      , Yi = function(e) {
        return null === e || e === undefined ? "" : ("" + e).replace(Xi, "")
    }
      , Gi = function(e, t) {
        var n, r, o, i;
        if (e)
            if ((n = e.length) === undefined) {
                for (r in e)
                    if (e.hasOwnProperty(r) && (i = e[r],
                    !1 === t.call(i, r, i)))
                        break
            } else
                for (o = 0; o < n && (i = e[o],
                !1 !== t.call(i, o, i)); o++)
                    ;
        return e
    }
      , Ji = function(e, n) {
        var r = [];
        return Gi(e, function(e, t) {
            n(t, e) && r.push(t)
        }),
        r
    }
      , Qi = function(e) {
        return e ? 9 === e.nodeType ? e : e.ownerDocument : Ti
    };
    Ki.fn = Ki.prototype = {
        constructor: Ki,
        selector: "",
        context: null,
        length: 0,
        init: function(e, t) {
            var n, r, o = this;
            if (!e)
                return o;
            if (e.nodeType)
                return o.context = o[0] = e,
                o.length = 1,
                o;
            if (t && t.nodeType)
                o.context = t;
            else {
                if (t)
                    return na(e).attr(t);
                o.context = t = V.document
            }
            if (Ii(e)) {
                if (!(n = "<" === (o.selector = e).charAt(0) && ">" === e.charAt(e.length - 1) && 3 <= e.length ? [null, e, null] : Oi.exec(e)))
                    return na(t).find(e);
                if (n[1])
                    for (r = Mi(e, Qi(t)).firstChild; r; )
                        Ai.call(o, r),
                        r = r.nextSibling;
                else {
                    if (!(r = Qi(t).getElementById(n[2])))
                        return o;
                    if (r.id !== n[2])
                        return o.find(e);
                    o.length = 1,
                    o[0] = r
                }
            } else
                this.add(e, !1);
            return o
        },
        toArray: function() {
            return hr.toArray(this)
        },
        add: function(e, t) {
            var n, r;
            if (Ii(e))
                return this.add(na(e));
            if (!1 !== t)
                for (n = na.unique(this.toArray().concat(na.makeArray(e))),
                this.length = n.length,
                r = 0; r < n.length; r++)
                    this[r] = n[r];
            else
                Ai.apply(this, na.makeArray(e));
            return this
        },
        attr: function(t, n) {
            var e, r = this;
            if ("object" == typeof t)
                Gi(t, function(e, t) {
                    r.attr(e, t)
                });
            else {
                if (!Li(n)) {
                    if (r[0] && 1 === r[0].nodeType) {
                        if ((e = $i[t]) && e.get)
                            return e.get(r[0], t);
                        if (Hi[t])
                            return r.prop(t) ? t : undefined;
                        null === (n = r[0].getAttribute(t, 2)) && (n = undefined)
                    }
                    return n
                }
                this.each(function() {
                    var e;
                    if (1 === this.nodeType) {
                        if ((e = $i[t]) && e.set)
                            return void e.set(this, n);
                        null === n ? this.removeAttribute(t, 2) : this.setAttribute(t, n, 2)
                    }
                })
            }
            return r
        },
        removeAttr: function(e) {
            return this.attr(e, null)
        },
        prop: function(e, t) {
            var n = this;
            if ("object" == typeof (e = Vi[e] || e))
                Gi(e, function(e, t) {
                    n.prop(e, t)
                });
            else {
                if (!Li(t))
                    return n[0] && n[0].nodeType && e in n[0] ? n[0][e] : t;
                this.each(function() {
                    1 === this.nodeType && (this[e] = t)
                })
            }
            return n
        },
        css: function(n, r) {
            var e, o, i = this, t = function(e) {
                return e.replace(/-(\D)/g, function(e, t) {
                    return t.toUpperCase()
                })
            }, a = function(e) {
                return e.replace(/[A-Z]/g, function(e) {
                    return "-" + e
                })
            };
            if ("object" == typeof n)
                Gi(n, function(e, t) {
                    i.css(e, t)
                });
            else if (Li(r))
                n = t(n),
                "number" != typeof r || ji[n] || (r = r.toString() + "px"),
                i.each(function() {
                    var e = this.style;
                    if ((o = Wi[n]) && o.set)
                        o.set(this, r);
                    else {
                        try {
                            this.style[qi[n] || n] = r
                        } catch (t) {}
                        null !== r && "" !== r || (e.removeProperty ? e.removeProperty(a(n)) : e.removeAttribute(n))
                    }
                });
            else {
                if (e = i[0],
                (o = Wi[n]) && o.get)
                    return o.get(e);
                if (!e.ownerDocument.defaultView)
                    return e.currentStyle ? e.currentStyle[t(n)] : "";
                try {
                    return e.ownerDocument.defaultView.getComputedStyle(e, null).getPropertyValue(a(n))
                } catch (u) {
                    return undefined
                }
            }
            return i
        },
        remove: function() {
            for (var e, t = this.length; t--; )
                e = this[t],
                Bi.clean(e),
                e.parentNode && e.parentNode.removeChild(e);
            return this
        },
        empty: function() {
            for (var e, t = this.length; t--; )
                for (e = this[t]; e.firstChild; )
                    e.removeChild(e.firstChild);
            return this
        },
        html: function(e) {
            var t;
            if (Li(e)) {
                t = this.length;
                try {
                    for (; t--; )
                        this[t].innerHTML = e
                } catch (n) {
                    na(this[t]).empty().append(e)
                }
                return this
            }
            return this[0] ? this[0].innerHTML : ""
        },
        text: function(e) {
            var t;
            if (Li(e)) {
                for (t = this.length; t--; )
                    "innerText"in this[t] ? this[t].innerText = e : this[0].textContent = e;
                return this
            }
            return this[0] ? this[0].innerText || this[0].textContent : ""
        },
        append: function() {
            return Fi(this, arguments, function(e) {
                (1 === this.nodeType || this.host && 1 === this.host.nodeType) && this.appendChild(e)
            })
        },
        prepend: function() {
            return Fi(this, arguments, function(e) {
                (1 === this.nodeType || this.host && 1 === this.host.nodeType) && this.insertBefore(e, this.firstChild)
            }, !0)
        },
        before: function() {
            return this[0] && this[0].parentNode ? Fi(this, arguments, function(e) {
                this.parentNode.insertBefore(e, this)
            }) : this
        },
        after: function() {
            return this[0] && this[0].parentNode ? Fi(this, arguments, function(e) {
                this.parentNode.insertBefore(e, this.nextSibling)
            }, !0) : this
        },
        appendTo: function(e) {
            return na(e).append(this),
            this
        },
        prependTo: function(e) {
            return na(e).prepend(this),
            this
        },
        replaceWith: function(e) {
            return this.before(e).remove()
        },
        wrap: function(e) {
            return zi(this, e)
        },
        wrapAll: function(e) {
            return zi(this, e, !0)
        },
        wrapInner: function(e) {
            return this.each(function() {
                na(this).contents().wrapAll(e)
            }),
            this
        },
        unwrap: function() {
            return this.parent().each(function() {
                na(this).replaceWith(this.childNodes)
            })
        },
        clone: function() {
            var e = [];
            return this.each(function() {
                e.push(this.cloneNode(!0))
            }),
            na(e)
        },
        addClass: function(e) {
            return this.toggleClass(e, !0)
        },
        removeClass: function(e) {
            return this.toggleClass(e, !1)
        },
        toggleClass: function(o, i) {
            var e = this;
            return "string" != typeof o || (-1 !== o.indexOf(" ") ? Gi(o.split(" "), function() {
                e.toggleClass(this, i)
            }) : e.each(function(e, t) {
                var n, r;
                (r = Ui(t, o)) !== i && (n = t.className,
                r ? t.className = Yi((" " + n + " ").replace(" " + o + " ", " ")) : t.className += n ? " " + o : o)
            })),
            e
        },
        hasClass: function(e) {
            return Ui(this[0], e)
        },
        each: function(e) {
            return Gi(this, e)
        },
        on: function(e, t) {
            return this.each(function() {
                Bi.bind(this, e, t)
            })
        },
        off: function(e, t) {
            return this.each(function() {
                Bi.unbind(this, e, t)
            })
        },
        trigger: function(e) {
            return this.each(function() {
                "object" == typeof e ? Bi.fire(this, e.type, e) : Bi.fire(this, e)
            })
        },
        show: function() {
            return this.css("display", "")
        },
        hide: function() {
            return this.css("display", "none")
        },
        slice: function() {
            return new na(Di.apply(this, arguments))
        },
        eq: function(e) {
            return -1 === e ? this.slice(e) : this.slice(e, +e + 1)
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        find: function(e) {
            var t, n, r = [];
            for (t = 0,
            n = this.length; t < n; t++)
                na.find(e, this[t], r);
            return na(r)
        },
        filter: function(n) {
            return na("function" == typeof n ? Ji(this.toArray(), function(e, t) {
                return n(t, e)
            }) : na.filter(n, this.toArray()))
        },
        closest: function(n) {
            var r = [];
            return n instanceof na && (n = n[0]),
            this.each(function(e, t) {
                for (; t; ) {
                    if ("string" == typeof n && na(t).is(n)) {
                        r.push(t);
                        break
                    }
                    if (t === n) {
                        r.push(t);
                        break
                    }
                    t = t.parentNode
                }
            }),
            na(r)
        },
        offset: function(e) {
            var t, n, r, o, i = 0, a = 0;
            return e ? this.css(e) : ((t = this[0]) && (r = (n = t.ownerDocument).documentElement,
            t.getBoundingClientRect && (i = (o = t.getBoundingClientRect()).left + (r.scrollLeft || n.body.scrollLeft) - r.clientLeft,
            a = o.top + (r.scrollTop || n.body.scrollTop) - r.clientTop)),
            {
                left: i,
                top: a
            })
        },
        push: Ai,
        sort: Array.prototype.sort,
        splice: Array.prototype.splice
    },
    hr.extend(Ki, {
        extend: hr.extend,
        makeArray: function(e) {
            return (t = e) && t === t.window || e.nodeType ? [e] : hr.toArray(e);
            var t
        },
        inArray: function(e, t) {
            var n;
            if (t.indexOf)
                return t.indexOf(e);
            for (n = t.length; n--; )
                if (t[n] === e)
                    return n;
            return -1
        },
        isArray: hr.isArray,
        each: Gi,
        trim: Yi,
        grep: Ji,
        find: hi,
        expr: hi.selectors,
        unique: hi.uniqueSort,
        text: hi.getText,
        contains: hi.contains,
        filter: function(e, t, n) {
            var r = t.length;
            for (n && (e = ":not(" + e + ")"); r--; )
                1 !== t[r].nodeType && t.splice(r, 1);
            return t = 1 === t.length ? na.find.matchesSelector(t[0], e) ? [t[0]] : [] : na.find.matches(e, t)
        }
    });
    var Zi = function(e, t, n) {
        var r = []
          , o = e[t];
        for ("string" != typeof n && n instanceof na && (n = n[0]); o && 9 !== o.nodeType; ) {
            if (n !== undefined) {
                if (o === n)
                    break;
                if ("string" == typeof n && na(o).is(n))
                    break
            }
            1 === o.nodeType && r.push(o),
            o = o[t]
        }
        return r
    }
      , ea = function(e, t, n, r) {
        var o = [];
        for (r instanceof na && (r = r[0]); e; e = e[t])
            if (!n || e.nodeType === n) {
                if (r !== undefined) {
                    if (e === r)
                        break;
                    if ("string" == typeof r && na(e).is(r))
                        break
                }
                o.push(e)
            }
        return o
    }
      , ta = function(e, t, n) {
        for (e = e[t]; e; e = e[t])
            if (e.nodeType === n)
                return e;
        return null
    };
    Gi({
        parent: function(e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        },
        parents: function(e) {
            return Zi(e, "parentNode")
        },
        next: function(e) {
            return ta(e, "nextSibling", 1)
        },
        prev: function(e) {
            return ta(e, "previousSibling", 1)
        },
        children: function(e) {
            return ea(e.firstChild, "nextSibling", 1)
        },
        contents: function(e) {
            return hr.toArray(("iframe" === e.nodeName ? e.contentDocument || e.contentWindow.document : e).childNodes)
        }
    }, function(r, o) {
        Ki.fn[r] = function(t) {
            var n = [];
            this.each(function() {
                var e = o.call(n, this, t, n);
                e && (na.isArray(e) ? n.push.apply(n, e) : n.push(e))
            }),
            1 < this.length && (Pi[r] || (n = na.unique(n)),
            0 === r.indexOf("parents") && (n = n.reverse()));
            var e = na(n);
            return t ? e.filter(t) : e
        }
    }),
    Gi({
        parentsUntil: function(e, t) {
            return Zi(e, "parentNode", t)
        },
        nextUntil: function(e, t) {
            return ea(e, "nextSibling", 1, t).slice(1)
        },
        prevUntil: function(e, t) {
            return ea(e, "previousSibling", 1, t).slice(1)
        }
    }, function(o, i) {
        Ki.fn[o] = function(t, e) {
            var n = [];
            this.each(function() {
                var e = i.call(n, this, t, n);
                e && (na.isArray(e) ? n.push.apply(n, e) : n.push(e))
            }),
            1 < this.length && (n = na.unique(n),
            0 !== o.indexOf("parents") && "prevUntil" !== o || (n = n.reverse()));
            var r = na(n);
            return e ? r.filter(e) : r
        }
    }),
    Ki.fn.is = function(e) {
        return !!e && 0 < this.filter(e).length
    }
    ,
    Ki.fn.init.prototype = Ki.fn,
    Ki.overrideDefaults = function(n) {
        var r, o = function(e, t) {
            return r = r || n(),
            0 === arguments.length && (e = r.element),
            t = t || r.context,
            new o.fn.init(e,t)
        };
        return na.extend(o, this),
        o
    }
    ,
    Ki.attrHooks = $i,
    Ki.cssHooks = Wi;
    var na = Ki
      , ra = (oa.prototype.current = function() {
        return this.node
    }
    ,
    oa.prototype.next = function(e) {
        return this.node = this.findSibling(this.node, "firstChild", "nextSibling", e),
        this.node
    }
    ,
    oa.prototype.prev = function(e) {
        return this.node = this.findSibling(this.node, "lastChild", "previousSibling", e),
        this.node
    }
    ,
    oa.prototype.prev2 = function(e) {
        return this.node = this.findPreviousNode(this.node, "lastChild", "previousSibling", e),
        this.node
    }
    ,
    oa.prototype.findSibling = function(e, t, n, r) {
        var o, i;
        if (e) {
            if (!r && e[t])
                return e[t];
            if (e !== this.rootNode) {
                if (o = e[n])
                    return o;
                for (i = e.parentNode; i && i !== this.rootNode; i = i.parentNode)
                    if (o = i[n])
                        return o
            }
        }
    }
    ,
    oa.prototype.findPreviousNode = function(e, t, n, r) {
        var o, i, a;
        if (e) {
            if (o = e[n],
            this.rootNode && o === this.rootNode)
                return;
            if (o) {
                if (!r)
                    for (a = o[t]; a; a = a[t])
                        if (!a[t])
                            return a;
                return o
            }
            if ((i = e.parentNode) && i !== this.rootNode)
                return i
        }
    }
    ,
    oa);
    function oa(e, t) {
        this.node = e,
        this.rootNode = t,
        this.current = this.current.bind(this),
        this.next = this.next.bind(this),
        this.prev = this.prev.bind(this),
        this.prev2 = this.prev2.bind(this)
    }
    var ia, aa = hr.each, ua = hr.grep, sa = rr.ie, ca = /^([a-z0-9],?)+$/i, la = /^[ \t\r\n]*$/, fa = function(n, r, o) {
        var i = r.keep_values
          , e = {
            set: function(e, t, n) {
                r.url_converter && (t = r.url_converter.call(r.url_converter_scope || o(), t, n, e[0])),
                e.attr("data-mce-" + n, t).attr(n, t)
            },
            get: function(e, t) {
                return e.attr("data-mce-" + t) || e.attr(t)
            }
        }
          , t = {
            style: {
                set: function(e, t) {
                    null === t || "object" != typeof t ? (i && e.attr("data-mce-style", t),
                    null !== t && "string" == typeof t ? (e.removeAttr("style"),
                    e.css(n.parse(t))) : e.attr("style", t)) : e.css(t)
                },
                get: function(e) {
                    var t = e.attr("data-mce-style") || e.attr("style");
                    return t = n.serialize(n.parse(t), e[0].nodeName)
                }
            }
        };
        return i && (t.href = t.src = e),
        t
    }, da = function(e, t) {
        var n = t.attr("style")
          , r = e.serialize(e.parse(n), t[0].nodeName);
        r = r || null,
        t.attr("data-mce-style", r)
    }, ma = function(e, t) {
        var n, r, o = 0;
        if (e)
            for (n = e.nodeType,
            e = e.previousSibling; e; e = e.previousSibling)
                r = e.nodeType,
                (!t || 3 !== r || r !== n && e.nodeValue.length) && (o++,
                n = r);
        return o
    };
    function pa(a, u) {
        var s, c = this;
        void 0 === u && (u = {});
        var r = {}
          , l = V.window
          , o = {}
          , t = 0
          , e = vr(a, {
            contentCssCors: u.contentCssCors,
            referrerPolicy: u.referrerPolicy
        })
          , f = []
          , d = u.schema ? u.schema : no({})
          , i = ao({
            url_converter: u.url_converter,
            url_converter_scope: u.url_converter_scope
        }, u.schema)
          , m = u.ownEvents ? new ho : ho.Event
          , n = d.getBlockElements()
          , p = na.overrideDefaults(function() {
            return {
                context: a,
                element: H.getRoot()
            }
        })
          , g = function(e) {
            if (e && a && "string" == typeof e) {
                var t = a.getElementById(e);
                return t && t.id !== e ? a.getElementsByName(e)[1] : t
            }
            return e
        }
          , h = function(e) {
            return p("string" == typeof e ? g(e) : e)
        }
          , v = function(e, t, n) {
            var r, o, i = h(e);
            return i.length && (o = (r = s[t]) && r.get ? r.get(i, t) : i.attr(t)),
            void 0 === o && (o = n || ""),
            o
        }
          , y = function(e) {
            var t = g(e);
            return t ? t.attributes : []
        }
          , b = function(e, t, n) {
            var r, o;
            "" === n && (n = null);
            var i = h(e);
            r = i.attr(t),
            i.length && ((o = s[t]) && o.set ? o.set(i, n, t) : i.attr(t, n),
            r !== n && u.onSetAttrib && u.onSetAttrib({
                attrElm: i,
                attrName: t,
                attrValue: n
            }))
        }
          , C = function() {
            return u.root_element || a.body
        }
          , w = function(e, t) {
            return bn(a.body, g(e), t)
        }
          , x = function(e, t, n) {
            var r = h(e);
            return n ? r.css(t) : ("float" === (t = t.replace(/-(\D)/g, function(e, t) {
                return t.toUpperCase()
            })) && (t = rr.browser.isIE() ? "styleFloat" : "cssFloat"),
            r[0] && r[0].style ? r[0].style[t] : undefined)
        }
          , S = function(e) {
            var t, n;
            return e = g(e),
            t = x(e, "width"),
            n = x(e, "height"),
            -1 === t.indexOf("px") && (t = 0),
            -1 === n.indexOf("px") && (n = 0),
            {
                w: parseInt(t, 10) || e.offsetWidth || e.clientWidth,
                h: parseInt(n, 10) || e.offsetHeight || e.clientHeight
            }
        }
          , N = function(e, t) {
            var n;
            if (!e)
                return !1;
            if (!Array.isArray(e)) {
                if ("*" === t)
                    return 1 === e.nodeType;
                if (ca.test(t)) {
                    var r = t.toLowerCase().split(/,/)
                      , o = e.nodeName.toLowerCase();
                    for (n = r.length - 1; 0 <= n; n--)
                        if (r[n] === o)
                            return !0;
                    return !1
                }
                if (e.nodeType && 1 !== e.nodeType)
                    return !1
            }
            var i = Array.isArray(e) ? e : [e];
            return 0 < hi(t, i[0].ownerDocument || i[0], null, i).length
        }
          , E = function(e, t, n, r) {
            var o, i = [], a = g(e);
            for (r = r === undefined,
            n = n || ("BODY" !== C().nodeName ? C().parentNode : null),
            hr.is(t, "string") && (t = "*" === (o = t) ? function(e) {
                return 1 === e.nodeType
            }
            : function(e) {
                return N(e, o)
            }
            ); a && a !== n && a.nodeType && 9 !== a.nodeType; ) {
                if (!t || "function" == typeof t && t(a)) {
                    if (!r)
                        return [a];
                    i.push(a)
                }
                a = a.parentNode
            }
            return r ? i : null
        }
          , k = function(e, t, n) {
            var r = t;
            if (e)
                for ("string" == typeof t && (r = function(e) {
                    return N(e, t)
                }
                ),
                e = e[n]; e; e = e[n])
                    if ("function" == typeof r && r(e))
                        return e;
            return null
        }
          , _ = function(e, n, r) {
            var o, t = "string" == typeof e ? g(e) : e;
            if (!t)
                return !1;
            if (hr.isArray(t) && (t.length || 0 === t.length))
                return o = [],
                aa(t, function(e, t) {
                    e && ("string" == typeof e && (e = g(e)),
                    o.push(n.call(r, e, t)))
                }),
                o;
            var i = r || c;
            return n.call(i, t)
        }
          , R = function(e, t) {
            h(e).each(function(e, n) {
                aa(t, function(e, t) {
                    b(n, t, e)
                })
            })
        }
          , T = function(e, r) {
            var t = h(e);
            sa ? t.each(function(e, t) {
                if (!1 !== t.canHaveHTML) {
                    for (; t.firstChild; )
                        t.removeChild(t.firstChild);
                    try {
                        t.innerHTML = "<br>" + r,
                        t.removeChild(t.firstChild)
                    } catch (n) {
                        na("<div></div>").html("<br>" + r).contents().slice(1).appendTo(t)
                    }
                    return r
                }
            }) : t.html(r)
        }
          , A = function(e, n, r, o, i) {
            return _(e, function(e) {
                var t = "string" == typeof n ? a.createElement(n) : n;
                return R(t, r),
                o && ("string" != typeof o && o.nodeType ? t.appendChild(o) : "string" == typeof o && T(t, o)),
                i ? t : e.appendChild(t)
            })
        }
          , D = function(e, t, n) {
            return A(a.createElement(e), e, t, n, !0)
        }
          , O = $r.decode
          , B = $r.encodeAllRaw
          , P = function(e, t) {
            var n = h(e);
            return t ? n.each(function() {
                for (var e; e = this.firstChild; )
                    3 === e.nodeType && 0 === e.data.length ? this.removeChild(e) : this.parentNode.insertBefore(e, this)
            }).remove() : n.remove(),
            1 < n.length ? n.toArray() : n[0]
        }
          , L = function(e, t, n) {
            h(e).toggleClass(t, n).each(function() {
                "" === this.className && na(this).attr("class", null)
            })
        }
          , I = function(t, e, n) {
            return _(e, function(e) {
                return hr.is(e, "array") && (t = t.cloneNode(!0)),
                n && aa(ua(e.childNodes), function(e) {
                    t.appendChild(e)
                }),
                e.parentNode.replaceChild(t, e)
            })
        }
          , M = function(e) {
            if ($t(e)) {
                var t = "a" === e.nodeName.toLowerCase() && !v(e, "href") && v(e, "id");
                if (v(e, "name") || v(e, "data-mce-bookmark") || t)
                    return !0
            }
            return !1
        }
          , F = function() {
            return a.createRange()
        }
          , U = function(e, t, n, r) {
            if (hr.isArray(e)) {
                for (var o = e.length, i = []; o--; )
                    i[o] = U(e[o], t, n, r);
                return i
            }
            return !u.collect || e !== a && e !== l || f.push([e, t, n, r]),
            m.bind(e, t, n, r || H)
        }
          , z = function(e, t, n) {
            var r;
            if (hr.isArray(e)) {
                r = e.length;
                for (var o = []; r--; )
                    o[r] = z(e[r], t, n);
                return o
            }
            if (0 < f.length && (e === a || e === l))
                for (r = f.length; r--; ) {
                    var i = f[r];
                    e !== i[0] || t && t !== i[1] || n && n !== i[2] || m.unbind(i[0], i[1], i[2])
                }
            return m.unbind(e, t, n)
        }
          , j = function(e) {
            if (e && $t(e)) {
                var t = e.getAttribute("data-mce-contenteditable");
                return t && "inherit" !== t ? t : "inherit" !== e.contentEditable ? e.contentEditable : null
            }
            return null
        }
          , H = {
            doc: a,
            settings: u,
            win: l,
            files: o,
            stdMode: !0,
            boxModel: !0,
            styleSheetLoader: e,
            boundEvents: f,
            styles: i,
            schema: d,
            events: m,
            isBlock: function(e) {
                if ("string" == typeof e)
                    return !!n[e];
                if (e) {
                    var t = e.nodeType;
                    if (t)
                        return !(1 !== t || !n[e.nodeName])
                }
                return !1
            },
            $: p,
            $$: h,
            root: null,
            clone: function(t, e) {
                if (!sa || 1 !== t.nodeType || e)
                    return t.cloneNode(e);
                var n = a.createElement(t.nodeName);
                return aa(y(t), function(e) {
                    b(n, e.nodeName, v(t, e.nodeName))
                }),
                n
            },
            getRoot: C,
            getViewPort: function(e) {
                var t = Ht(e);
                return {
                    x: t.x,
                    y: t.y,
                    w: t.width,
                    h: t.height
                }
            },
            getRect: function(e) {
                var t, n;
                return e = g(e),
                t = w(e),
                n = S(e),
                {
                    x: t.x,
                    y: t.y,
                    w: n.w,
                    h: n.h
                }
            },
            getSize: S,
            getParent: function(e, t, n) {
                var r = E(e, t, n, !1);
                return r && 0 < r.length ? r[0] : null
            },
            getParents: E,
            get: g,
            getNext: function(e, t) {
                return k(e, t, "nextSibling")
            },
            getPrev: function(e, t) {
                return k(e, t, "previousSibling")
            },
            select: function(e, t) {
                return hi(e, g(t) || u.root_element || a, [])
            },
            is: N,
            add: A,
            create: D,
            createHTML: function(e, t, n) {
                var r, o = "";
                for (r in o += "<" + e,
                t)
                    t.hasOwnProperty(r) && null !== t[r] && "undefined" != typeof t[r] && (o += " " + r + '="' + B(t[r]) + '"');
                return void 0 !== n ? o + ">" + n + "</" + e + ">" : o + " />"
            },
            createFragment: function(e) {
                var t, n = a.createElement("div"), r = a.createDocumentFragment();
                for (r.appendChild(n),
                e && (n.innerHTML = e); t = n.firstChild; )
                    r.appendChild(t);
                return r.removeChild(n),
                r
            },
            remove: P,
            setStyle: function(e, t, n) {
                var r = q(t) ? h(e).css(t, n) : h(e).css(t);
                u.update_styles && da(i, r)
            },
            getStyle: x,
            setStyles: function(e, t) {
                var n = h(e).css(t);
                u.update_styles && da(i, n)
            },
            removeAllAttribs: function(e) {
                return _(e, function(e) {
                    var t, n = e.attributes;
                    for (t = n.length - 1; 0 <= t; t--)
                        e.removeAttributeNode(n.item(t))
                })
            },
            setAttrib: b,
            setAttribs: R,
            getAttrib: v,
            getPos: w,
            parseStyle: function(e) {
                return i.parse(e)
            },
            serializeStyle: function(e, t) {
                return i.serialize(e, t)
            },
            addStyle: function(e) {
                var t, n;
                if (H !== pa.DOM && a === V.document) {
                    if (r[e])
                        return;
                    r[e] = !0
                }
                (n = a.getElementById("mceDefaultStyles")) || ((n = a.createElement("style")).id = "mceDefaultStyles",
                n.type = "text/css",
                (t = a.getElementsByTagName("head")[0]).firstChild ? t.insertBefore(n, t.firstChild) : t.appendChild(n)),
                n.styleSheet ? n.styleSheet.cssText += e : n.appendChild(a.createTextNode(e))
            },
            loadCSS: function(e) {
                var n;
                H === pa.DOM || a !== V.document ? (e = e || "",
                n = a.getElementsByTagName("head")[0],
                aa(e.split(","), function(e) {
                    var t;
                    e = hr._addCacheSuffix(e),
                    o[e] || (o[e] = !0,
                    t = D("link", pe(pe({
                        rel: "stylesheet",
                        type: "text/css",
                        href: e
                    }, u.contentCssCors ? {
                        crossOrigin: "anonymous"
                    } : {}), u.referrerPolicy ? {
                        referrerPolicy: u.referrerPolicy
                    } : {})),
                    n.appendChild(t))
                })) : pa.DOM.loadCSS(e)
            },
            addClass: function(e, t) {
                h(e).addClass(t)
            },
            removeClass: function(e, t) {
                L(e, t, !1)
            },
            hasClass: function(e, t) {
                return h(e).hasClass(t)
            },
            toggleClass: L,
            show: function(e) {
                h(e).show()
            },
            hide: function(e) {
                h(e).hide()
            },
            isHidden: function(e) {
                return "none" === h(e).css("display")
            },
            uniqueId: function(e) {
                return (e || "mce_") + t++
            },
            setHTML: T,
            getOuterHTML: function(e) {
                var t = "string" == typeof e ? g(e) : e;
                return $t(t) ? t.outerHTML : na("<div></div>").append(na(t).clone()).html()
            },
            setOuterHTML: function(e, t) {
                h(e).each(function() {
                    try {
                        if ("outerHTML"in this)
                            return void (this.outerHTML = t)
                    } catch (e) {}
                    P(na(this).html(t), !0)
                })
            },
            decode: O,
            encode: B,
            insertAfter: function(e, t) {
                var r = g(t);
                return _(e, function(e) {
                    var t, n;
                    return t = r.parentNode,
                    (n = r.nextSibling) ? t.insertBefore(e, n) : t.appendChild(e),
                    e
                })
            },
            replace: I,
            rename: function(t, e) {
                var n;
                return t.nodeName !== e.toUpperCase() && (n = D(e),
                aa(y(t), function(e) {
                    b(n, e.nodeName, v(t, e.nodeName))
                }),
                I(n, t, !0)),
                n || t
            },
            findCommonAncestor: function(e, t) {
                for (var n, r = e; r; ) {
                    for (n = t; n && r !== n; )
                        n = n.parentNode;
                    if (r === n)
                        break;
                    r = r.parentNode
                }
                return !r && e.ownerDocument ? e.ownerDocument.documentElement : r
            },
            toHex: function(e) {
                return i.toHex(hr.trim(e))
            },
            run: _,
            getAttribs: y,
            isEmpty: function(e, t) {
                var n, r, o = 0;
                if (M(e))
                    return !1;
                if (e = e.firstChild) {
                    var i = new ra(e,e.parentNode)
                      , a = d ? d.getWhiteSpaceElements() : {};
                    t = t || (d ? d.getNonEmptyElements() : null);
                    do {
                        if (n = e.nodeType,
                        $t(e)) {
                            var u = e.getAttribute("data-mce-bogus");
                            if (u) {
                                e = i.next("all" === u);
                                continue
                            }
                            if (r = e.nodeName.toLowerCase(),
                            t && t[r]) {
                                if ("br" !== r)
                                    return !1;
                                o++,
                                e = i.next();
                                continue
                            }
                            if (M(e))
                                return !1
                        }
                        if (8 === n)
                            return !1;
                        if (3 === n && !la.test(e.nodeValue))
                            return !1;
                        if (3 === n && e.parentNode && a[e.parentNode.nodeName] && la.test(e.nodeValue))
                            return !1;
                        e = i.next()
                    } while (e)
                }
                return o <= 1
            },
            createRng: F,
            nodeIndex: ma,
            split: function(e, t, n) {
                var r, o, i, a = F();
                if (e && t)
                    return a.setStart(e.parentNode, ma(e)),
                    a.setEnd(t.parentNode, ma(t)),
                    r = a.extractContents(),
                    (a = F()).setStart(t.parentNode, ma(t) + 1),
                    a.setEnd(e.parentNode, ma(e) + 1),
                    o = a.extractContents(),
                    (i = e.parentNode).insertBefore(Pr(H, r), e),
                    n ? i.insertBefore(n, e) : i.insertBefore(t, e),
                    i.insertBefore(Pr(H, o), e),
                    P(e),
                    n || t
            },
            bind: U,
            unbind: z,
            fire: function(e, t, n) {
                return m.fire(e, t, n)
            },
            getContentEditable: j,
            getContentEditableParent: function(e) {
                for (var t = C(), n = null; e && e !== t && null === (n = j(e)); e = e.parentNode)
                    ;
                return n
            },
            destroy: function() {
                if (0 < f.length)
                    for (var e = f.length; e--; ) {
                        var t = f[e];
                        m.unbind(t[0], t[1], t[2])
                    }
                hi.setDocument && hi.setDocument()
            },
            isChildOf: function(e, t) {
                for (; e; ) {
                    if (t === e)
                        return !0;
                    e = e.parentNode
                }
                return !1
            },
            dumpRng: function(e) {
                return "startContainer: " + e.startContainer.nodeName + ", startOffset: " + e.startOffset + ", endContainer: " + e.endContainer.nodeName + ", endOffset: " + e.endOffset
            }
        };
        return s = fa(i, u, function() {
            return H
        }),
        H
    }
    (ia = pa = pa || {}).DOM = ia(V.document),
    ia.nodeIndex = ma;
    var ga = pa
      , ha = ga.DOM
      , va = hr.each
      , ya = hr.grep
      , ba = (Ca.prototype._setReferrerPolicy = function(e) {
        this.settings.referrerPolicy = e
    }
    ,
    Ca.prototype.loadScript = function(e, t, n) {
        var r, o, i = ha;
        o = i.uniqueId(),
        (r = V.document.createElement("script")).id = o,
        r.type = "text/javascript",
        r.src = hr._addCacheSuffix(e),
        this.settings.referrerPolicy && i.setAttrib(r, "referrerpolicy", this.settings.referrerPolicy),
        r.onload = function() {
            i.remove(o),
            r && (r.onreadystatechange = r.onload = r = null),
            t()
        }
        ,
        r.onerror = function() {
            D(n) ? n() : "undefined" != typeof V.console && V.console.log && V.console.log("Failed to load script: " + e)
        }
        ,
        (V.document.getElementsByTagName("head")[0] || V.document.body).appendChild(r)
    }
    ,
    Ca.prototype.isDone = function(e) {
        return 2 === this.states[e]
    }
    ,
    Ca.prototype.markDone = function(e) {
        this.states[e] = 2
    }
    ,
    Ca.prototype.add = function(e, t, n, r) {
        this.states[e] === undefined && (this.queue.push(e),
        this.states[e] = 0),
        t && (this.scriptLoadedCallbacks[e] || (this.scriptLoadedCallbacks[e] = []),
        this.scriptLoadedCallbacks[e].push({
            success: t,
            failure: r,
            scope: n || this
        }))
    }
    ,
    Ca.prototype.load = function(e, t, n, r) {
        return this.add(e, t, n, r)
    }
    ,
    Ca.prototype.remove = function(e) {
        delete this.states[e],
        delete this.scriptLoadedCallbacks[e]
    }
    ,
    Ca.prototype.loadQueue = function(e, t, n) {
        this.loadScripts(this.queue, e, t, n)
    }
    ,
    Ca.prototype.loadScripts = function(n, e, t, r) {
        var o, i = this, a = [], u = function(t, e) {
            va(i.scriptLoadedCallbacks[e], function(e) {
                D(e[t]) && e[t].call(e.scope)
            }),
            i.scriptLoadedCallbacks[e] = undefined
        };
        i.queueLoadedCallbacks.push({
            success: e,
            failure: r,
            scope: t || this
        }),
        (o = function() {
            var e = ya(n);
            if (n.length = 0,
            va(e, function(e) {
                2 !== i.states[e] ? 3 !== i.states[e] ? 1 !== i.states[e] && (i.states[e] = 1,
                i.loading++,
                i.loadScript(e, function() {
                    i.states[e] = 2,
                    i.loading--,
                    u("success", e),
                    o()
                }, function() {
                    i.states[e] = 3,
                    i.loading--,
                    a.push(e),
                    u("failure", e),
                    o()
                })) : u("failure", e) : u("success", e)
            }),
            !i.loading) {
                var t = i.queueLoadedCallbacks.slice(0);
                i.queueLoadedCallbacks.length = 0,
                va(t, function(e) {
                    0 === a.length ? D(e.success) && e.success.call(e.scope) : D(e.failure) && e.failure.call(e.scope, a)
                })
            }
        }
        )()
    }
    ,
    Ca.ScriptLoader = new Ca,
    Ca);
    function Ca(e) {
        void 0 === e && (e = {}),
        this.states = {},
        this.queue = [],
        this.scriptLoadedCallbacks = {},
        this.queueLoadedCallbacks = [],
        this.loading = 0,
        this.settings = e
    }
    var wa, xa = function(e) {
        var t = e;
        return {
            get: function() {
                return t
            },
            set: function(e) {
                t = e
            }
        }
    }, Sa = {}, Na = xa("en"), Ea = function() {
        return de(Sa, Na.get())
    }, ka = {
        getData: function() {
            return ie(Sa, function(e) {
                return pe({}, e)
            })
        },
        setCode: function(e) {
            e && Na.set(e)
        },
        getCode: function() {
            return Na.get()
        },
        add: function(e, t) {
            var n = Sa[e];
            n || (Sa[e] = n = {}),
            oe(t, function(e, t) {
                n[t.toLowerCase()] = e
            })
        },
        translate: function(e) {
            var t, n, r = Ea().getOr({}), o = function(e) {
                return D(e) ? Object.prototype.toString.call(e) : i(e) ? "" : "" + e
            }, i = function(e) {
                return "" === e || null === e || e === undefined
            }, a = function(e) {
                var t = o(e);
                return de(r, t.toLowerCase()).map(o).getOr(t)
            }, u = function(e) {
                return e.replace(/{context:\w+}$/, "")
            };
            if (i(e))
                return "";
            if (E(t = e) && me(t, "raw"))
                return o(e.raw);
            if (k(n = e) && 1 < n.length) {
                var s = e.slice(1);
                return u(a(e[0]).replace(/\{([0-9]+)\}/g, function(e, t) {
                    return me(s, t) ? o(s[t]) : e
                }))
            }
            return u(a(e))
        },
        isRtl: function() {
            return Ea().bind(function(e) {
                return de(e, "_dir")
            }).exists(function(e) {
                return "rtl" === e
            })
        },
        hasCode: function(e) {
            return me(Sa, e)
        }
    };
    function _a() {
        var r = this
          , o = []
          , s = {}
          , c = {}
          , i = []
          , l = function(t, n) {
            var e = H(i, function(e) {
                return e.name === t && e.state === n
            });
            z(e, function(e) {
                return e.callback()
            })
        }
          , f = function(e) {
            var t;
            return c[e] && (t = c[e].dependencies),
            t || []
        }
          , d = function(e, t) {
            return "object" == typeof t ? t : "string" == typeof e ? {
                prefix: "",
                resource: t,
                suffix: ""
            } : {
                prefix: e.prefix,
                resource: t,
                suffix: e.suffix
            }
        }
          , m = function(o, i, a, u, e) {
            if (!s[o]) {
                var t = "string" == typeof i ? i : i.prefix + i.resource + i.suffix;
                0 !== t.indexOf("/") && -1 === t.indexOf("://") && (t = _a.baseURL + "/" + t),
                s[o] = t.substring(0, t.lastIndexOf("/"));
                var n = function() {
                    var n, e, t, r;
                    l(o, "loaded"),
                    n = i,
                    e = a,
                    t = u,
                    r = f(o),
                    z(r, function(e) {
                        var t = d(n, e);
                        m(t.resource, t, undefined, undefined)
                    }),
                    e && (t ? e.call(t) : e.call(ba))
                };
                c[o] ? n() : ba.ScriptLoader.add(t, n, u, e)
            }
        }
          , e = function(e, t, n) {
            void 0 === n && (n = "added"),
            me(c, e) && "added" === n || me(s, e) && "loaded" === n ? t() : i.push({
                name: e,
                state: n,
                callback: t
            })
        };
        return {
            items: o,
            urls: s,
            lookup: c,
            _listeners: i,
            get: function(e) {
                return c[e] ? c[e].instance : undefined
            },
            dependencies: f,
            requireLangPack: function(t, n) {
                !1 !== _a.languageLoad && e(t, function() {
                    var e = ka.getCode();
                    !e || n && -1 === ("," + (n || "") + ",").indexOf("," + e + ",") || ba.ScriptLoader.add(s[t] + "/langs/" + e + ".js")
                }, "loaded")
            },
            add: function(e, t, n) {
                var r = t;
                return o.push(r),
                c[e] = {
                    instance: r,
                    dependencies: n
                },
                l(e, "added"),
                r
            },
            remove: function(e) {
                delete s[e],
                delete c[e]
            },
            createUrl: d,
            addComponents: function(e, t) {
                var n = r.urls[e];
                z(t, function(e) {
                    ba.ScriptLoader.add(n + "/" + e)
                })
            },
            load: m,
            waitFor: e
        }
    }
    (wa = _a = _a || {}).PluginManager = wa(),
    wa.ThemeManager = wa();
    var Ra = _a
      , Ta = function(n, r) {
        var o = null;
        return {
            cancel: function() {
                null !== o && (V.clearTimeout(o),
                o = null)
            },
            throttle: function() {
                for (var e = [], t = 0; t < arguments.length; t++)
                    e[t] = arguments[t];
                null === o && (o = V.setTimeout(function() {
                    n.apply(null, e),
                    o = null
                }, r))
            }
        }
    }
      , Aa = function(n, r) {
        var o = null;
        return {
            cancel: function() {
                null !== o && (V.clearTimeout(o),
                o = null)
            },
            throttle: function() {
                for (var e = [], t = 0; t < arguments.length; t++)
                    e[t] = arguments[t];
                null !== o && V.clearTimeout(o),
                o = V.setTimeout(function() {
                    n.apply(null, e),
                    o = null
                }, r)
            }
        }
    }
      , Da = function(e, t) {
        var n = fn(e, t);
        return n === undefined || "" === n ? [] : n.split(" ")
    }
      , Oa = function(e) {
        return e.dom().classList !== undefined
    }
      , Ba = function(e, t) {
        return o = t,
        i = Da(n = e, r = "class").concat([o]),
        cn(n, r, i.join(" ")),
        !0;
        var n, r, o, i
    }
      , Pa = function(e, t) {
        return o = t,
        0 < (i = H(Da(n = e, r = "class"), function(e) {
            return e !== o
        })).length ? cn(n, r, i.join(" ")) : dn(n, r),
        !1;
        var n, r, o, i
    }
      , La = function(e, t) {
        Oa(e) ? e.dom().classList.add(t) : Ba(e, t)
    }
      , Ia = function(e) {
        0 === (Oa(e) ? e.dom().classList : Da(e, "class")).length && dn(e, "class")
    }
      , Ma = function(e, t) {
        return Oa(e) && e.dom().classList.contains(t)
    }
      , Fa = function(e, t) {
        var n = [];
        return z(ht(e), function(e) {
            t(e) && (n = n.concat([e])),
            n = n.concat(Fa(e, t))
        }),
        n
    }
      , Ua = function(e, t) {
        return n = t,
        o = (r = e) === undefined ? V.document : r.dom(),
        it(o) ? [] : U(o.querySelectorAll(n), Ne.fromDom);
        var n, r, o
    };
    function za(e, t, n, r, o) {
        return e(n, r) ? R.some(n) : D(o) && o(n) ? R.none() : t(n, r, o)
    }
    var ja, Ha = function(e, t, n) {
        for (var r = e.dom(), o = D(n) ? n : x(!1); r.parentNode; ) {
            r = r.parentNode;
            var i = Ne.fromDom(r);
            if (t(i))
                return R.some(i);
            if (o(i))
                break
        }
        return R.none()
    }, Va = function(e, t, n) {
        return za(function(e, t) {
            return t(e)
        }, Ha, e, t, n)
    }, qa = function(e, t, n) {
        return Ha(e, function(e) {
            return ot(e, t)
        }, n)
    }, $a = function(e, t) {
        return n = t,
        o = (r = e) === undefined ? V.document : r.dom(),
        it(o) ? R.none() : R.from(o.querySelector(n)).map(Ne.fromDom);
        var n, r, o
    }, Wa = function(e, t, n) {
        return za(function(e, t) {
            return ot(e, t)
        }, qa, e, t, n)
    }, Ka = x("mce-annotation"), Xa = x("data-mce-annotation"), Ya = x("data-mce-annotation-uid"), Ga = function(r, e) {
        var t = r.selection.getRng()
          , n = Ne.fromDom(t.startContainer)
          , o = Ne.fromDom(r.getBody())
          , i = e.fold(function() {
            return "." + Ka()
        }, function(e) {
            return "[" + Xa() + '="' + e + '"]'
        })
          , a = vt(n, t.startOffset).getOr(n)
          , u = Wa(a, i, function(e) {
            return at(e, o)
        })
          , s = function(e, t) {
            return n = t,
            (r = e.dom()) && r.hasAttribute && r.hasAttribute(n) ? R.some(fn(e, t)) : R.none();
            var n, r
        };
        return u.bind(function(e) {
            return s(e, "" + Ya()).bind(function(n) {
                return s(e, "" + Xa()).map(function(e) {
                    var t = Ja(r, n);
                    return {
                        uid: n,
                        name: e,
                        elements: t
                    }
                })
            })
        })
    }, Ja = function(e, t) {
        var n = Ne.fromDom(e.getBody());
        return Ua(n, "[" + Ya() + '="' + t + '"]')
    }, Qa = function(i, e) {
        var a = xa({})
          , c = function(e, t) {
            u(e, function(e) {
                return t(e),
                e
            })
        }
          , u = function(e, t) {
            var n = a.get()
              , r = t(n.hasOwnProperty(e) ? n[e] : {
                listeners: [],
                previous: xa(R.none())
            });
            n[e] = r,
            a.set(n)
        }
          , t = Aa(function() {
            var e, t, n, r = a.get(), o = (e = ne(r),
            (n = B.call(e, 0)).sort(t),
            n);
            z(o, function(e) {
                u(e, function(u) {
                    var s = u.previous.get();
                    return Ga(i, R.some(e)).fold(function() {
                        var t;
                        s.isSome() && (c(t = e, function(e) {
                            z(e.listeners, function(e) {
                                return e(!1, t)
                            })
                        }),
                        u.previous.set(R.none()))
                    }, function(e) {
                        var t, n, r, o = e.uid, i = e.name, a = e.elements;
                        s.is(o) || (n = o,
                        r = a,
                        c(t = i, function(e) {
                            z(e.listeners, function(e) {
                                return e(!0, t, {
                                    uid: n,
                                    nodes: U(r, function(e) {
                                        return e.dom()
                                    })
                                })
                            })
                        }),
                        u.previous.set(R.some(o)))
                    }),
                    {
                        previous: u.previous,
                        listeners: u.listeners
                    }
                })
            })
        }, 30);
        i.on("remove", function() {
            t.cancel()
        }),
        i.on("NodeChange", function() {
            t.throttle()
        });
        return {
            addListener: function(e, t) {
                u(e, function(e) {
                    return {
                        previous: e.previous,
                        listeners: e.listeners.concat([t])
                    }
                })
            }
        }
    }, Za = function(e, n) {
        e.on("init", function() {
            e.serializer.addNodeFilter("span", function(e) {
                z(e, function(t) {
                    var e;
                    e = t,
                    R.from(e.attr(Xa())).bind(n.lookup).each(function(e) {
                        !1 === e.persistent && t.unwrap()
                    })
                })
            })
        })
    }, eu = 0, tu = function(e) {
        var t = (new Date).getTime();
        return e + "_" + Math.floor(1e9 * Math.random()) + ++eu + String(t)
    }, nu = function(e, t) {
        var n, r, o = ct(e).dom(), i = Ne.fromDom(o.createDocumentFragment()), a = (n = t,
        (r = (o || V.document).createElement("div")).innerHTML = n,
        ht(Ne.fromDom(r)));
        Nt(i, a),
        Et(e),
        St(e, i)
    }, ru = function(e, t) {
        return Ne.fromDom(e.dom().cloneNode(t))
    }, ou = function(e) {
        return ru(e, !1)
    }, iu = function(e) {
        return ru(e, !0)
    }, au = function(e, t, n) {
        void 0 === n && (n = g);
        var r = new ra(e,t)
          , o = function(e) {
            for (var t; (t = r[e]()) && !Zt(t) && !n(t); )
                ;
            return R.from(t).filter(Zt)
        };
        return {
            current: function() {
                return R.from(r.current()).filter(Zt)
            },
            next: function() {
                return o("next")
            },
            prev: function() {
                return o("prev")
            },
            prev2: function() {
                return o("prev2")
            }
        }
    }, uu = function(t, e) {
        var i = e || function(e) {
            return t.isBlock(e) || rn(e) || an(e)
        }
          , a = function(e, t, n, r) {
            if (Zt(e)) {
                var o = r(e, t, e.data);
                if (-1 !== o)
                    return R.some({
                        container: e,
                        offset: o
                    })
            }
            return n().bind(function(e) {
                return a(e.container, e.offset, n, r)
            })
        };
        return {
            backwards: function(e, t, n, r) {
                var o = au(e, r, i);
                return a(e, t, function() {
                    return o.prev().map(function(e) {
                        return {
                            container: e,
                            offset: e.length
                        }
                    })
                }, n).getOrNull()
            },
            forwards: function(e, t, n, r) {
                var o = au(e, r, i);
                return a(e, t, function() {
                    return o.next().map(function(e) {
                        return {
                            container: e,
                            offset: 0
                        }
                    })
                }, n).getOrNull()
            }
        }
    }, su = ro, cu = function(e) {
        return e === ro
    }, lu = function(e) {
        return e.replace(/\uFEFF/g, "")
    }, fu = $t, du = Zt, mu = function(e) {
        return du(e) && (e = e.parentNode),
        fu(e) && e.hasAttribute("data-mce-caret")
    }, pu = function(e) {
        return du(e) && cu(e.data)
    }, gu = function(e) {
        return mu(e) || pu(e)
    }, hu = function(e) {
        return e.firstChild !== e.lastChild || !rn(e.firstChild)
    }, vu = function(e) {
        var t = e.container();
        return !(!e || !Zt(t)) && (t.data.charAt(e.offset()) === su || e.isAtStart() && pu(t.previousSibling))
    }, yu = function(e) {
        var t = e.container();
        return !(!e || !Zt(t)) && (t.data.charAt(e.offset() - 1) === su || e.isAtEnd() && pu(t.nextSibling))
    }, bu = function(e, t, n) {
        var r, o, i;
        return (r = t.ownerDocument.createElement(e)).setAttribute("data-mce-caret", n ? "before" : "after"),
        r.setAttribute("data-mce-bogus", "all"),
        r.appendChild(((i = V.document.createElement("br")).setAttribute("data-mce-bogus", "1"),
        i)),
        o = t.parentNode,
        n ? o.insertBefore(r, t) : t.nextSibling ? o.insertBefore(r, t.nextSibling) : o.appendChild(r),
        r
    }, Cu = function(e) {
        return du(e) && e.data[0] === su
    }, wu = function(e) {
        return du(e) && e.data[e.data.length - 1] === su
    }, xu = function(e) {
        return e && e.hasAttribute("data-mce-caret") ? (t = e.getElementsByTagName("br"),
        n = t[t.length - 1],
        Yt(n) && n.parentNode.removeChild(n),
        e.removeAttribute("data-mce-caret"),
        e.removeAttribute("data-mce-bogus"),
        e.removeAttribute("style"),
        e.removeAttribute("_moz_abspos"),
        e) : null;
        var t, n
    }, Su = on, Nu = an, Eu = rn, ku = Zt, _u = Wt(["script", "style", "textarea"]), Ru = Wt(["img", "input", "textarea", "hr", "iframe", "video", "audio", "object"]), Tu = Wt(["table"]), Au = gu, Du = function(e) {
        return !Au(e) && (ku(e) ? !_u(e.parentNode) : Ru(e) || Eu(e) || Tu(e) || Ou(e))
    }, Ou = function(e) {
        return !1 === ($t(t = e) && "true" === t.getAttribute("unselectable")) && Nu(e);
        var t
    }, Bu = function(e, t) {
        return Du(e) && function(e, t) {
            for (e = e.parentNode; e && e !== t; e = e.parentNode) {
                if (Ou(e))
                    return !1;
                if (Su(e))
                    return !0
            }
            return !0
        }(e, t)
    }, Pu = Math.round, Lu = function(e) {
        return e ? {
            left: Pu(e.left),
            top: Pu(e.top),
            bottom: Pu(e.bottom),
            right: Pu(e.right),
            width: Pu(e.width),
            height: Pu(e.height)
        } : {
            left: 0,
            top: 0,
            bottom: 0,
            right: 0,
            width: 0,
            height: 0
        }
    }, Iu = function(e, t) {
        return e = Lu(e),
        t || (e.left = e.left + e.width),
        e.right = e.left,
        e.width = 0,
        e
    }, Mu = function(e, t, n) {
        return 0 <= e && e <= Math.min(t.height, n.height) / 2
    }, Fu = function(e, t) {
        return e.bottom - e.height / 2 < t.top || !(e.top > t.bottom) && Mu(t.top - e.bottom, e, t)
    }, Uu = function(e, t) {
        return e.top > t.bottom || !(e.bottom < t.top) && Mu(t.bottom - e.top, e, t)
    }, zu = function(e, t, n) {
        return t >= e.left && t <= e.right && n >= e.top && n <= e.bottom
    }, ju = function(e) {
        var t = e.startContainer
          , n = e.startOffset;
        return t.hasChildNodes() && e.endOffset === n + 1 ? t.childNodes[n] : null
    }, Hu = function(e, t) {
        return 1 === e.nodeType && e.hasChildNodes() && (t >= e.childNodes.length && (t = e.childNodes.length - 1),
        e = e.childNodes[t]),
        e
    }, Vu = new RegExp("[\u0300-\u036f\u0483-\u0487\u0488-\u0489\u0591-\u05bd\u05bf\u05c1-\u05c2\u05c4-\u05c5\u05c7\u0610-\u061a\u064b-\u065f\u0670\u06d6-\u06dc\u06df-\u06e4\u06e7-\u06e8\u06ea-\u06ed\u0711\u0730-\u074a\u07a6-\u07b0\u07eb-\u07f3\u0816-\u0819\u081b-\u0823\u0825-\u0827\u0829-\u082d\u0859-\u085b\u08e3-\u0902\u093a\u093c\u0941-\u0948\u094d\u0951-\u0957\u0962-\u0963\u0981\u09bc\u09be\u09c1-\u09c4\u09cd\u09d7\u09e2-\u09e3\u0a01-\u0a02\u0a3c\u0a41-\u0a42\u0a47-\u0a48\u0a4b-\u0a4d\u0a51\u0a70-\u0a71\u0a75\u0a81-\u0a82\u0abc\u0ac1-\u0ac5\u0ac7-\u0ac8\u0acd\u0ae2-\u0ae3\u0b01\u0b3c\u0b3e\u0b3f\u0b41-\u0b44\u0b4d\u0b56\u0b57\u0b62-\u0b63\u0b82\u0bbe\u0bc0\u0bcd\u0bd7\u0c00\u0c3e-\u0c40\u0c46-\u0c48\u0c4a-\u0c4d\u0c55-\u0c56\u0c62-\u0c63\u0c81\u0cbc\u0cbf\u0cc2\u0cc6\u0ccc-\u0ccd\u0cd5-\u0cd6\u0ce2-\u0ce3\u0d01\u0d3e\u0d41-\u0d44\u0d4d\u0d57\u0d62-\u0d63\u0dca\u0dcf\u0dd2-\u0dd4\u0dd6\u0ddf\u0e31\u0e34-\u0e3a\u0e47-\u0e4e\u0eb1\u0eb4-\u0eb9\u0ebb-\u0ebc\u0ec8-\u0ecd\u0f18-\u0f19\u0f35\u0f37\u0f39\u0f71-\u0f7e\u0f80-\u0f84\u0f86-\u0f87\u0f8d-\u0f97\u0f99-\u0fbc\u0fc6\u102d-\u1030\u1032-\u1037\u1039-\u103a\u103d-\u103e\u1058-\u1059\u105e-\u1060\u1071-\u1074\u1082\u1085-\u1086\u108d\u109d\u135d-\u135f\u1712-\u1714\u1732-\u1734\u1752-\u1753\u1772-\u1773\u17b4-\u17b5\u17b7-\u17bd\u17c6\u17c9-\u17d3\u17dd\u180b-\u180d\u18a9\u1920-\u1922\u1927-\u1928\u1932\u1939-\u193b\u1a17-\u1a18\u1a1b\u1a56\u1a58-\u1a5e\u1a60\u1a62\u1a65-\u1a6c\u1a73-\u1a7c\u1a7f\u1ab0-\u1abd\u1abe\u1b00-\u1b03\u1b34\u1b36-\u1b3a\u1b3c\u1b42\u1b6b-\u1b73\u1b80-\u1b81\u1ba2-\u1ba5\u1ba8-\u1ba9\u1bab-\u1bad\u1be6\u1be8-\u1be9\u1bed\u1bef-\u1bf1\u1c2c-\u1c33\u1c36-\u1c37\u1cd0-\u1cd2\u1cd4-\u1ce0\u1ce2-\u1ce8\u1ced\u1cf4\u1cf8-\u1cf9\u1dc0-\u1df5\u1dfc-\u1dff\u200c-\u200d\u20d0-\u20dc\u20dd-\u20e0\u20e1\u20e2-\u20e4\u20e5-\u20f0\u2cef-\u2cf1\u2d7f\u2de0-\u2dff\u302a-\u302d\u302e-\u302f\u3099-\u309a\ua66f\ua670-\ua672\ua674-\ua67d\ua69e-\ua69f\ua6f0-\ua6f1\ua802\ua806\ua80b\ua825-\ua826\ua8c4\ua8e0-\ua8f1\ua926-\ua92d\ua947-\ua951\ua980-\ua982\ua9b3\ua9b6-\ua9b9\ua9bc\ua9e5\uaa29-\uaa2e\uaa31-\uaa32\uaa35-\uaa36\uaa43\uaa4c\uaa7c\uaab0\uaab2-\uaab4\uaab7-\uaab8\uaabe-\uaabf\uaac1\uaaec-\uaaed\uaaf6\uabe5\uabe8\uabed\ufb1e\ufe00-\ufe0f\ufe20-\ufe2f\uff9e-\uff9f]"), qu = function(e) {
        return "string" == typeof e && 768 <= e.charCodeAt(0) && Vu.test(e)
    }, $u = function(e, t, n) {
        return e.isSome() && t.isSome() ? R.some(n(e.getOrDie(), t.getOrDie())) : R.none()
    }, Wu = $t, Ku = Du, Xu = Kt("display", "block table"), Yu = Kt("float", "left right"), Gu = function() {
        for (var n = [], e = 0; e < arguments.length; e++)
            n[e] = arguments[e];
        return function(e) {
            for (var t = 0; t < n.length; t++)
                if (!n[t](e))
                    return !1;
            return !0
        }
    }(Wu, Ku, m(Yu)), Ju = m(Kt("white-space", "pre pre-line pre-wrap")), Qu = Zt, Zu = rn, es = ga.nodeIndex, ts = Hu, ns = function(e) {
        return "createRange"in e ? e.createRange() : ga.DOM.createRng()
    }, rs = function(e) {
        return e && /[\r\n\t ]/.test(e)
    }, os = function(e) {
        return !!e.setStart && !!e.setEnd
    }, is = function(e) {
        var t, n = e.startContainer, r = e.startOffset;
        return !!(rs(e.toString()) && Ju(n.parentNode) && Zt(n) && (t = n.data,
        rs(t[r - 1]) || rs(t[r + 1])))
    }, as = function(e) {
        return 0 === e.left && 0 === e.right && 0 === e.top && 0 === e.bottom
    }, us = function(e) {
        var t, n, r, o, i, a, u, s;
        return t = 0 < (n = e.getClientRects()).length ? Lu(n[0]) : Lu(e.getBoundingClientRect()),
        !os(e) && Zu(e) && as(t) ? (i = (r = e).ownerDocument,
        a = ns(i),
        u = i.createTextNode(oo),
        (s = r.parentNode).insertBefore(u, r),
        a.setStart(u, 0),
        a.setEnd(u, 1),
        o = Lu(a.getBoundingClientRect()),
        s.removeChild(u),
        o) : as(t) && os(e) ? function(e) {
            var t = e.startContainer
              , n = e.endContainer
              , r = e.startOffset
              , o = e.endOffset;
            if (t === n && Zt(n) && 0 === r && 1 === o) {
                var i = e.cloneRange();
                return i.setEndAfter(n),
                us(i)
            }
            return null
        }(e) : t
    }, ss = function(e, t) {
        var n = Iu(e, t);
        return n.width = 1,
        n.right = n.left + 1,
        n
    }, cs = function(e) {
        var t, n, r = [], o = function(e) {
            var t, n;
            0 !== e.height && (0 < r.length && (t = e,
            n = r[r.length - 1],
            t.left === n.left && t.top === n.top && t.bottom === n.bottom && t.right === n.right) || r.push(e))
        }, i = function(e, t) {
            var n = ns(e.ownerDocument);
            if (t < e.data.length) {
                if (qu(e.data[t]))
                    return r;
                if (qu(e.data[t - 1]) && (n.setStart(e, t),
                n.setEnd(e, t + 1),
                !is(n)))
                    return o(ss(us(n), !1)),
                    r
            }
            0 < t && (n.setStart(e, t - 1),
            n.setEnd(e, t),
            is(n) || o(ss(us(n), !1))),
            t < e.data.length && (n.setStart(e, t),
            n.setEnd(e, t + 1),
            is(n) || o(ss(us(n), !0)))
        };
        if (Qu(e.container()))
            return i(e.container(), e.offset()),
            r;
        if (Wu(e.container()))
            if (e.isAtEnd())
                n = ts(e.container(), e.offset()),
                Qu(n) && i(n, n.data.length),
                Gu(n) && !Zu(n) && o(ss(us(n), !1));
            else {
                if (n = ts(e.container(), e.offset()),
                Qu(n) && i(n, 0),
                Gu(n) && e.isAtEnd())
                    return o(ss(us(n), !1)),
                    r;
                t = ts(e.container(), e.offset() - 1),
                Gu(t) && !Zu(t) && (!Xu(t) && !Xu(n) && Gu(n) || o(ss(us(t), !1))),
                Gu(n) && o(ss(us(n), !0))
            }
        return r
    };
    function ls(t, n, e) {
        var r = function() {
            return e = e || cs(ls(t, n))
        };
        return {
            container: x(t),
            offset: x(n),
            toRange: function() {
                var e;
                return (e = ns(t.ownerDocument)).setStart(t, n),
                e.setEnd(t, n),
                e
            },
            getClientRects: r,
            isVisible: function() {
                return 0 < r().length
            },
            isAtStart: function() {
                return Qu(t),
                0 === n
            },
            isAtEnd: function() {
                return Qu(t) ? n >= t.data.length : n >= t.childNodes.length
            },
            isEqual: function(e) {
                return e && t === e.container() && n === e.offset()
            },
            getNode: function(e) {
                return ts(t, e ? n - 1 : n)
            }
        }
    }
    (ja = ls = ls || {}).fromRangeStart = function(e) {
        return ja(e.startContainer, e.startOffset)
    }
    ,
    ja.fromRangeEnd = function(e) {
        return ja(e.endContainer, e.endOffset)
    }
    ,
    ja.after = function(e) {
        return ja(e.parentNode, es(e) + 1)
    }
    ,
    ja.before = function(e) {
        return ja(e.parentNode, es(e))
    }
    ,
    ja.isAbove = function(e, t) {
        return $u(Z(t.getClientRects()), ee(e.getClientRects()), Fu).getOr(!1)
    }
    ,
    ja.isBelow = function(e, t) {
        return $u(ee(t.getClientRects()), Z(e.getClientRects()), Uu).getOr(!1)
    }
    ,
    ja.isAtStart = function(e) {
        return !!e && e.isAtStart()
    }
    ,
    ja.isAtEnd = function(e) {
        return !!e && e.isAtEnd()
    }
    ,
    ja.isTextPosition = function(e) {
        return !!e && Zt(e.container())
    }
    ,
    ja.isElementPosition = function(e) {
        return !1 === ja.isTextPosition(e)
    }
    ;
    var fs, ds, ms = ls, ps = Zt, gs = Yt, hs = ga.nodeIndex, vs = function(e) {
        var t = e.parentNode;
        return gs(t) ? vs(t) : t
    }, ys = function(e) {
        return e ? cr(e.childNodes, function(e, t) {
            return gs(t) && "BR" !== t.nodeName ? e = e.concat(ys(t)) : e.push(t),
            e
        }, []) : []
    }, bs = function(t) {
        return function(e) {
            return t === e
        }
    }, Cs = function(e) {
        var t, r, n, o;
        return (ps(e) ? "text()" : e.nodeName.toLowerCase()) + "[" + (r = ys(vs(t = e)),
        n = lr(r, bs(t), t),
        r = r.slice(0, n + 1),
        o = cr(r, function(e, t, n) {
            return ps(t) && ps(r[n - 1]) && e++,
            e
        }, 0),
        r = ur(r, Wt([t.nodeName])),
        (n = lr(r, bs(t), t)) - o) + "]"
    }, ws = function(e, t) {
        var n, r, o, i, a, u = [];
        return n = t.container(),
        r = t.offset(),
        ps(n) ? o = function(e, t) {
            for (; (e = e.previousSibling) && ps(e); )
                t += e.data.length;
            return t
        }(n, r) : (r >= (i = n.childNodes).length ? (o = "after",
        r = i.length - 1) : o = "before",
        n = i[r]),
        u.push(Cs(n)),
        a = function(e, t, n) {
            var r = [];
            for (t = t.parentNode; t !== e && (!n || !n(t)); t = t.parentNode)
                r.push(t);
            return r
        }(e, n),
        a = ur(a, m(Yt)),
        (u = u.concat(ar(a, function(e) {
            return Cs(e)
        }))).reverse().join("/") + "," + o
    }, xs = function(e, t) {
        var n, r, o;
        return t ? (t = (n = t.split(","))[0].split("/"),
        o = 1 < n.length ? n[1] : "before",
        (r = cr(t, function(e, t) {
            return (t = /([\w\-\(\)]+)\[([0-9]+)\]/.exec(t)) ? ("text()" === t[1] && (t[1] = "#text"),
            n = e,
            r = t[1],
            o = parseInt(t[2], 10),
            i = ys(n),
            i = ur(i, function(e, t) {
                return !ps(e) || !ps(i[t - 1])
            }),
            (i = ur(i, Wt([r])))[o]) : null;
            var n, r, o, i
        }, e)) ? ps(r) ? function(e, t) {
            for (var n, r = e, o = 0; ps(r); ) {
                if (n = r.data.length,
                o <= t && t <= o + n) {
                    e = r,
                    t -= o;
                    break
                }
                if (!ps(r.nextSibling)) {
                    e = r,
                    t = n;
                    break
                }
                o += n,
                r = r.nextSibling
            }
            return ps(e) && t > e.data.length && (t = e.data.length),
            ms(e, t)
        }(r, parseInt(o, 10)) : (o = "after" === o ? hs(r) + 1 : hs(r),
        ms(r.parentNode, o)) : null) : null
    }, Ss = function(e, t) {
        Zt(t) && 0 === t.data.length && e.remove(t)
    }, Ns = function(e, t, n) {
        var r, o, i, a, u, s, c;
        nn(n) ? (i = e,
        a = t,
        u = n,
        s = R.from(u.firstChild),
        c = R.from(u.lastChild),
        a.insertNode(u),
        s.each(function(e) {
            return Ss(i, e.previousSibling)
        }),
        c.each(function(e) {
            return Ss(i, e.nextSibling)
        })) : (r = e,
        o = n,
        t.insertNode(o),
        Ss(r, o.previousSibling),
        Ss(r, o.nextSibling))
    }, Es = an, ks = function(e, t, n, r, o) {
        var i, a = r[o ? "startContainer" : "endContainer"], u = r[o ? "startOffset" : "endOffset"], s = [], c = 0, l = e.getRoot();
        for (Zt(a) ? s.push(n ? function(e, t, n) {
            var r, o;
            for (o = e(t.data.slice(0, n)).length,
            r = t.previousSibling; r && Zt(r); r = r.previousSibling)
                o += e(r.data).length;
            return o
        }(t, a, u) : u) : (u >= (i = a.childNodes).length && i.length && (c = 1,
        u = Math.max(0, i.length - 1)),
        s.push(e.nodeIndex(i[u], n) + c)); a && a !== l; a = a.parentNode)
            s.push(e.nodeIndex(a, n));
        return s
    }, _s = function(e, t, n) {
        var r = 0;
        return hr.each(e.select(t), function(e) {
            if ("all" !== e.getAttribute("data-mce-bogus"))
                return e !== n && void r++
        }),
        r
    }, Rs = function(e, t) {
        var n, r, o, i = t ? "start" : "end";
        n = e[i + "Container"],
        r = e[i + "Offset"],
        $t(n) && "TR" === n.nodeName && (n = (o = n.childNodes)[Math.min(t ? r : r - 1, o.length - 1)]) && (r = t ? 0 : n.childNodes.length,
        e["set" + (t ? "Start" : "End")](n, r))
    }, Ts = function(e) {
        return Rs(e, !0),
        Rs(e, !1),
        e
    }, As = function(e, t) {
        var n;
        if ($t(e) && (e = Hu(e, t),
        Es(e)))
            return e;
        if (gu(e)) {
            if (Zt(e) && mu(e) && (e = e.parentNode),
            n = e.previousSibling,
            Es(n))
                return n;
            if (n = e.nextSibling,
            Es(n))
                return n
        }
    }, Ds = function(e, t, n) {
        var r = n.getNode()
          , o = r ? r.nodeName : null
          , i = n.getRng();
        if (Es(r) || "IMG" === o)
            return {
                name: o,
                index: _s(n.dom, o, r)
            };
        var a, u, s, c, l, f, d, m = As((a = i).startContainer, a.startOffset) || As(a.endContainer, a.endOffset);
        return m ? {
            name: o = m.tagName,
            index: _s(n.dom, o, m)
        } : (u = e,
        c = t,
        l = i,
        f = (s = n).dom,
        (d = {}).start = ks(f, u, c, l, !0),
        s.isCollapsed() || (d.end = ks(f, u, c, l, !1)),
        d)
    }, Os = function(e, t, n) {
        var r = {
            "data-mce-type": "bookmark",
            id: t,
            style: "overflow:hidden;line-height:0px"
        };
        return n ? e.create("span", r, "&#xFEFF;") : e.create("span", r)
    }, Bs = function(e, t) {
        var n = e.dom
          , r = e.getRng()
          , o = n.uniqueId()
          , i = e.isCollapsed()
          , a = e.getNode()
          , u = a.nodeName;
        if ("IMG" === u)
            return {
                name: u,
                index: _s(n, u, a)
            };
        var s = Ts(r.cloneRange());
        if (!i) {
            s.collapse(!1);
            var c = Os(n, o + "_end", t);
            Ns(n, s, c)
        }
        (r = Ts(r)).collapse(!0);
        var l = Os(n, o + "_start", t);
        return Ns(n, r, l),
        e.moveToBookmark({
            id: o,
            keep: !0
        }),
        {
            id: o
        }
    }, Ps = function(e, t, n) {
        return 2 === t ? Ds(lu, n, e) : 3 === t ? (o = (r = e).getRng(),
        {
            start: ws(r.dom.getRoot(), ms.fromRangeStart(o)),
            end: ws(r.dom.getRoot(), ms.fromRangeEnd(o))
        }) : t ? {
            rng: e.getRng()
        } : Bs(e, !1);
        var r, o
    }, Ls = N(Ds, d, !0), Is = "_mce_caret", Ms = function(e) {
        return $t(e) && e.id === Is
    }, Fs = function(e, t) {
        for (; t && t !== e; ) {
            if (t.id === Is)
                return t;
            t = t.parentNode
        }
        return null
    }, Us = ga.DOM, zs = function(e, t, n) {
        var r = e.getParam(t, n);
        if (-1 === r.indexOf("="))
            return r;
        var o = e.getParam(t, "", "hash");
        return o.hasOwnProperty(e.id) ? o[e.id] : n
    }, js = function(e) {
        return e.getParam("content_security_policy", "")
    }, Hs = function(e) {
        if (e.getParam("force_p_newlines", !1))
            return "p";
        var t = e.getParam("forced_root_block", "p");
        return !1 === t ? "" : !0 === t ? "p" : t
    }, Vs = function(e) {
        return e.getParam("forced_root_block_attrs", {})
    }, qs = function(e) {
        return e.getParam("automatic_uploads", !0, "boolean")
    }, $s = function(e) {
        return e.getParam("icons", "", "string")
    }, Ws = function(e) {
        return e.getParam("language", "en", "string")
    }, Ks = function(e) {
        return e.getParam("indent_use_margin", !1)
    }, Xs = $t, Ys = Zt, Gs = function(e) {
        var t = e.parentNode;
        t && t.removeChild(e)
    }, Js = function(e, t) {
        0 === t.length ? Gs(e) : e.nodeValue = t
    }, Qs = function(e) {
        var t = lu(e);
        return {
            count: e.length - t.length,
            text: t
        }
    }, Zs = function(e, t) {
        return rc(e),
        t
    }, ec = function(e, t) {
        var n, r, o = t.container(), i = (n = te(o.childNodes),
        (-1 === (r = I(n, e)) ? R.none() : R.some(r)).map(function(e) {
            return e < t.offset() ? ms(o, t.offset() - 1) : t
        }).getOr(t));
        return rc(e),
        i
    }, tc = function(e, t) {
        return Ys(e) && t.container() === e ? (r = t,
        o = Qs((n = e).data.substr(0, r.offset())),
        i = Qs(n.data.substr(r.offset())),
        0 < (a = o.text + i.text).length ? (Js(n, a),
        ms(n, r.offset() - o.count)) : r) : Zs(e, t);
        var n, r, o, i, a
    }, nc = function(e, t) {
        return ms.isTextPosition(t) ? tc(e, t) : (n = e,
        ((r = t).container() === n.parentNode ? ec : Zs)(n, r));
        var n, r
    }, rc = function(e) {
        if (Xs(e) && gu(e) && (hu(e) ? e.removeAttribute("data-mce-caret") : Gs(e)),
        Ys(e)) {
            var t = lu(function(e) {
                try {
                    return e.nodeValue
                } catch (t) {
                    return ""
                }
            }(e));
            Js(e, t)
        }
    }, oc = nt().browser, ic = an, ac = function(e, t, n) {
        var r, o, i, a, u, s = Iu(t.getBoundingClientRect(), n);
        return i = "BODY" === e.tagName ? (r = e.ownerDocument.documentElement,
        o = e.scrollLeft || r.scrollLeft,
        e.scrollTop || r.scrollTop) : (u = e.getBoundingClientRect(),
        o = e.scrollLeft - u.left,
        e.scrollTop - u.top),
        s.left += o,
        s.right += o,
        s.top += i,
        s.bottom += i,
        s.width = 1,
        0 < (a = t.offsetWidth - t.clientWidth) && (n && (a *= -1),
        s.left += a,
        s.right += a),
        s
    }, uc = function(e, a, u, t) {
        var n, s, c = xa(R.none()), r = Hs(e), l = 0 < r.length ? r : "p", f = function() {
            !function(e) {
                var t, n, r, o, i;
                for (t = Ua(Ne.fromDom(e), "*[contentEditable=false]"),
                o = 0; o < t.length; o++)
                    r = (n = t[o].dom()).previousSibling,
                    wu(r) && (1 === (i = r.data).length ? r.parentNode.removeChild(r) : r.deleteData(i.length - 1, 1)),
                    r = n.nextSibling,
                    Cu(r) && (1 === (i = r.data).length ? r.parentNode.removeChild(r) : r.deleteData(0, 1))
            }(a),
            s && (rc(s),
            s = null),
            c.get().each(function(e) {
                na(e.caret).remove(),
                c.set(R.none())
            }),
            n && (Xn.clearInterval(n),
            n = null)
        }, d = function() {
            n = Xn.setInterval(function() {
                t() ? na("div.mce-visual-caret", a).toggleClass("mce-visual-caret-hidden") : na("div.mce-visual-caret", a).addClass("mce-visual-caret-hidden")
            }, 500)
        };
        return {
            show: function(t, e) {
                var n, r, o;
                if (f(),
                $t(o = e) && /^(TD|TH)$/i.test(o.tagName))
                    return null;
                if (!u(e))
                    return s = function(e, t) {
                        var n, r, o;
                        if (r = e.ownerDocument.createTextNode(su),
                        o = e.parentNode,
                        t) {
                            if (n = e.previousSibling,
                            du(n)) {
                                if (gu(n))
                                    return n;
                                if (wu(n))
                                    return n.splitText(n.data.length - 1)
                            }
                            o.insertBefore(r, e)
                        } else {
                            if (n = e.nextSibling,
                            du(n)) {
                                if (gu(n))
                                    return n;
                                if (Cu(n))
                                    return n.splitText(1),
                                    n
                            }
                            e.nextSibling ? o.insertBefore(r, e.nextSibling) : o.appendChild(r)
                        }
                        return r
                    }(e, t),
                    r = e.ownerDocument.createRange(),
                    ic(s.nextSibling) ? (r.setStart(s, 0),
                    r.setEnd(s, 0)) : (r.setStart(s, 1),
                    r.setEnd(s, 1)),
                    r;
                s = bu(l, e, t),
                n = ac(a, e, t),
                na(s).css("top", n.top);
                var i = na('<div class="mce-visual-caret" data-mce-bogus="all"></div>').css(n).appendTo(a)[0];
                return c.set(R.some({
                    caret: i,
                    element: e,
                    before: t
                })),
                c.get().each(function(e) {
                    t && na(e.caret).addClass("mce-visual-caret-before")
                }),
                d(),
                (r = e.ownerDocument.createRange()).setStart(s, 0),
                r.setEnd(s, 0),
                r
            },
            hide: f,
            getCss: function() {
                return ".mce-visual-caret {position: absolute;background-color: black;background-color: currentcolor;}.mce-visual-caret-hidden {display: none;}*[data-mce-caret] {position: absolute;left: -1000px;right: auto;top: 0;margin: 0;padding: 0;}"
            },
            reposition: function() {
                c.get().each(function(e) {
                    var t = ac(a, e.element, e.before);
                    na(e.caret).css(pe({}, t))
                })
            },
            destroy: function() {
                return Xn.clearInterval(n)
            }
        }
    }, sc = function() {
        return oc.isIE() || oc.isEdge() || oc.isFirefox()
    }, cc = function(e) {
        return ic(e) || Gt(e) && sc()
    }, lc = an, fc = Kt("display", "block table table-cell table-caption list-item"), dc = gu, mc = mu, pc = $t, gc = Du, hc = function(e, t) {
        for (var n; n = e(t); )
            if (!mc(n))
                return n;
        return null
    }, vc = function(e, t, n, r, o) {
        var i = new ra(e,r);
        if (t < 0) {
            if ((lc(e) || mc(e)) && n(e = hc(i.prev, !0)))
                return e;
            for (; e = hc(i.prev, o); )
                if (n(e))
                    return e
        }
        if (0 < t) {
            if ((lc(e) || mc(e)) && n(e = hc(i.next, !0)))
                return e;
            for (; e = hc(i.next, o); )
                if (n(e))
                    return e
        }
        return null
    }, yc = function(e, t) {
        for (; e && e !== t; ) {
            if (fc(e))
                return e;
            e = e.parentNode
        }
        return null
    }, bc = function(e, t, n) {
        return yc(e.container(), n) === yc(t.container(), n)
    }, Cc = function(e, t) {
        var n, r;
        return t ? (n = t.container(),
        r = t.offset(),
        pc(n) ? n.childNodes[r + e] : null) : null
    }, wc = function(e, t) {
        var n = t.ownerDocument.createRange();
        return e ? (n.setStartBefore(t),
        n.setEndBefore(t)) : (n.setStartAfter(t),
        n.setEndAfter(t)),
        n
    }, xc = function(e, t, n) {
        var r, o, i, a;
        for (o = e ? "previousSibling" : "nextSibling"; n && n !== t; ) {
            if (r = n[o],
            dc(r) && (r = r[o]),
            lc(r)) {
                if (a = n,
                yc(r, i = t) === yc(a, i))
                    return r;
                break
            }
            if (gc(r))
                break;
            n = n.parentNode
        }
        return null
    }, Sc = N(wc, !0), Nc = N(wc, !1), Ec = function(e, t, n) {
        var r, o, i, a, u = N(xc, !0, t), s = N(xc, !1, t);
        if (o = n.startContainer,
        i = n.startOffset,
        mu(o)) {
            if (pc(o) || (o = o.parentNode),
            "before" === (a = o.getAttribute("data-mce-caret")) && (r = o.nextSibling,
            cc(r)))
                return Sc(r);
            if ("after" === a && (r = o.previousSibling,
            cc(r)))
                return Nc(r)
        }
        if (!n.collapsed)
            return n;
        if (Zt(o)) {
            if (dc(o)) {
                if (1 === e) {
                    if (r = s(o))
                        return Sc(r);
                    if (r = u(o))
                        return Nc(r)
                }
                if (-1 === e) {
                    if (r = u(o))
                        return Nc(r);
                    if (r = s(o))
                        return Sc(r)
                }
                return n
            }
            if (wu(o) && i >= o.data.length - 1)
                return 1 === e && (r = s(o)) ? Sc(r) : n;
            if (Cu(o) && i <= 1)
                return -1 === e && (r = u(o)) ? Nc(r) : n;
            if (i === o.data.length)
                return (r = s(o)) ? Sc(r) : n;
            if (0 === i)
                return (r = u(o)) ? Nc(r) : n
        }
        return n
    }, kc = function(e, t) {
        return R.from(Cc(e ? 0 : -1, t)).filter(lc)
    }, _c = function(e, t, n) {
        var r = Ec(e, t, n);
        return -1 === e ? ls.fromRangeStart(r) : ls.fromRangeEnd(r)
    }, Rc = function(e) {
        return R.from(e.getNode()).map(Ne.fromDom)
    }, Tc = function(e, t) {
        for (; t = e(t); )
            if (t.isVisible())
                return t;
        return t
    }, Ac = function(e, t) {
        var n = bc(e, t);
        return !(n || !rn(e.getNode())) || n
    };
    (ds = fs = fs || {})[ds.Backwards = -1] = "Backwards",
    ds[ds.Forwards = 1] = "Forwards";
    var Dc, Oc = an, Bc = Zt, Pc = $t, Lc = rn, Ic = Du, Mc = function(e) {
        return Ru(e) || !!Ou(t = e) && !0 !== W(te(t.getElementsByTagName("*")), function(e, t) {
            return e || Su(t)
        }, !1);
        var t
    }, Fc = Bu, Uc = function(e, t) {
        return e.hasChildNodes() && t < e.childNodes.length ? e.childNodes[t] : null
    }, zc = function(e, t) {
        if (0 < e) {
            if (Ic(t.previousSibling) && !Bc(t.previousSibling))
                return ms.before(t);
            if (Bc(t))
                return ms(t, 0)
        }
        if (e < 0) {
            if (Ic(t.nextSibling) && !Bc(t.nextSibling))
                return ms.after(t);
            if (Bc(t))
                return ms(t, t.data.length)
        }
        return !(e < 0) || Lc(t) ? ms.before(t) : ms.after(t)
    }, jc = function(e, t, n) {
        var r, o, i, a, u;
        if (!Pc(n) || !t)
            return null;
        if (t.isEqual(ms.after(n)) && n.lastChild) {
            if (u = ms.after(n.lastChild),
            e < 0 && Ic(n.lastChild) && Pc(n.lastChild))
                return Lc(n.lastChild) ? ms.before(n.lastChild) : u
        } else
            u = t;
        var s, c, l, f = u.container(), d = u.offset();
        if (Bc(f)) {
            if (e < 0 && 0 < d)
                return ms(f, --d);
            if (0 < e && d < f.length)
                return ms(f, ++d);
            r = f
        } else {
            if (e < 0 && 0 < d && (o = Uc(f, d - 1),
            Ic(o)))
                return !Mc(o) && (i = vc(o, e, Fc, o)) ? Bc(i) ? ms(i, i.data.length) : ms.after(i) : Bc(o) ? ms(o, o.data.length) : ms.before(o);
            if (0 < e && d < f.childNodes.length && (o = Uc(f, d),
            Ic(o)))
                return Lc(o) ? (s = n,
                (l = (c = o).nextSibling) && Ic(l) ? Bc(l) ? ms(l, 0) : ms.before(l) : jc(fs.Forwards, ms.after(c), s)) : !Mc(o) && (i = vc(o, e, Fc, o)) ? Bc(i) ? ms(i, 0) : ms.before(i) : Bc(o) ? ms(o, 0) : ms.after(o);
            r = o || u.getNode()
        }
        return (0 < e && u.isAtEnd() || e < 0 && u.isAtStart()) && (r = vc(r, e, x(!0), n, !0),
        Fc(r, n)) ? zc(e, r) : (o = vc(r, e, Fc, n),
        !(a = fr(H(function(e, t) {
            for (var n = []; e && e !== t; )
                n.push(e),
                e = e.parentNode;
            return n
        }(f, n), Oc))) || o && a.contains(o) ? o ? zc(e, o) : null : u = 0 < e ? ms.after(a) : ms.before(a))
    }, Hc = function(t) {
        return {
            next: function(e) {
                return jc(fs.Forwards, e, t)
            },
            prev: function(e) {
                return jc(fs.Backwards, e, t)
            }
        }
    }, Vc = function(e) {
        return ms.isTextPosition(e) ? 0 === e.offset() : Du(e.getNode())
    }, qc = function(e) {
        if (ms.isTextPosition(e)) {
            var t = e.container();
            return e.offset() === t.data.length
        }
        return Du(e.getNode(!0))
    }, $c = function(e, t) {
        return !ms.isTextPosition(e) && !ms.isTextPosition(t) && e.getNode() === t.getNode(!0)
    }, Wc = function(e, t, n) {
        return e ? !$c(t, n) && (r = t,
        !(!ms.isTextPosition(r) && rn(r.getNode()))) && qc(t) && Vc(n) : !$c(n, t) && Vc(t) && qc(n);
        var r
    }, Kc = function(e, t, n) {
        var r = Hc(t);
        return R.from(e ? r.next(n) : r.prev(n))
    }, Xc = function(t, n, r) {
        return Kc(t, n, r).bind(function(e) {
            return bc(r, e, n) && Wc(t, r, e) ? Kc(t, n, e) : R.some(e)
        })
    }, Yc = function(t, n, e, r) {
        return Xc(t, n, e).bind(function(e) {
            return r(e) ? Yc(t, n, e, r) : R.some(e)
        })
    }, Gc = function(e, t) {
        var n, r, o, i, a, u = e ? t.firstChild : t.lastChild;
        return Zt(u) ? R.some(ms(u, e ? 0 : u.data.length)) : u ? Du(u) ? R.some(e ? ms.before(u) : rn(a = u) ? ms.before(a) : ms.after(a)) : (r = t,
        o = u,
        i = (n = e) ? ms.before(o) : ms.after(o),
        Kc(n, r, i)) : R.none()
    }, Jc = N(Kc, !0), Qc = N(Kc, !1), Zc = N(Gc, !0), el = N(Gc, !1), tl = function(e, t) {
        return $t(t) && e.isBlock(t) && !t.innerHTML && !rr.ie && (t.innerHTML = '<br data-mce-bogus="1" />'),
        t
    }, nl = function(e, t) {
        return el(e).fold(function() {
            return !1
        }, function(e) {
            return t.setStart(e.container(), e.offset()),
            t.setEnd(e.container(), e.offset()),
            !0
        })
    }, rl = function(e, t, n) {
        return !(!1 !== t.hasChildNodes() || !Fs(e, t)) && (o = n,
        i = (r = t).ownerDocument.createTextNode(su),
        r.appendChild(i),
        o.setStart(i, 0),
        o.setEnd(i, 0),
        !0);
        var r, o, i
    }, ol = function(e, t, n, r) {
        var o, i, a, u, s = n[t ? "start" : "end"], c = e.getRoot();
        if (s) {
            for (a = s[0],
            i = c,
            o = s.length - 1; 1 <= o; o--) {
                if (u = i.childNodes,
                rl(c, i, r))
                    return !0;
                if (s[o] > u.length - 1)
                    return !!rl(c, i, r) || nl(i, r);
                i = u[s[o]]
            }
            3 === i.nodeType && (a = Math.min(s[0], i.nodeValue.length)),
            1 === i.nodeType && (a = Math.min(s[0], i.childNodes.length)),
            t ? r.setStart(i, a) : r.setEnd(i, a)
        }
        return !0
    }, il = function(e) {
        return Zt(e) && 0 < e.data.length
    }, al = function(e, t, n) {
        var r, o, i, a, u, s, c = e.get(n.id + "_" + t), l = n.keep;
        if (c) {
            if (r = c.parentNode,
            s = (u = (o = "start" === t ? l ? c.hasChildNodes() ? (r = c.firstChild,
            1) : il(c.nextSibling) ? (r = c.nextSibling,
            0) : il(c.previousSibling) ? (r = c.previousSibling,
            c.previousSibling.data.length) : (r = c.parentNode,
            e.nodeIndex(c) + 1) : e.nodeIndex(c) : l ? c.hasChildNodes() ? (r = c.firstChild,
            1) : il(c.previousSibling) ? (r = c.previousSibling,
            c.previousSibling.data.length) : (r = c.parentNode,
            e.nodeIndex(c)) : e.nodeIndex(c),
            r),
            o),
            !l) {
                for (a = c.previousSibling,
                i = c.nextSibling,
                hr.each(hr.grep(c.childNodes), function(e) {
                    Zt(e) && (e.nodeValue = e.nodeValue.replace(/\uFEFF/g, ""))
                }); c = e.get(n.id + "_" + t); )
                    e.remove(c, !0);
                a && i && a.nodeType === i.nodeType && Zt(a) && !rr.opera && (o = a.nodeValue.length,
                a.appendData(i.nodeValue),
                e.remove(i),
                s = (u = a,
                o))
            }
            return R.some(ms(u, s))
        }
        return R.none()
    }, ul = function(e, t) {
        var n, r, o, i, a, u, s, c, l, f, d, m, p, g, h = e.dom;
        if (t) {
            if (g = t,
            hr.isArray(g.start))
                return m = t,
                p = (d = h).createRng(),
                ol(d, !0, m, p) && ol(d, !1, m, p) ? R.some(p) : R.none();
            if ("string" == typeof t.start)
                return R.some((c = t,
                l = (s = h).createRng(),
                f = xs(s.getRoot(), c.start),
                l.setStart(f.container(), f.offset()),
                f = xs(s.getRoot(), c.end),
                l.setEnd(f.container(), f.offset()),
                l));
            if (t.hasOwnProperty("id"))
                return a = al(o = h, "start", i = t),
                u = al(o, "end", i),
                $u(a, u.or(a), function(e, t) {
                    var n = o.createRng();
                    return n.setStart(tl(o, e.container()), e.offset()),
                    n.setEnd(tl(o, t.container()), t.offset()),
                    n
                });
            if (t.hasOwnProperty("name"))
                return n = h,
                r = t,
                R.from(n.select(r.name)[r.index]).map(function(e) {
                    var t = n.createRng();
                    return t.selectNode(e),
                    t
                });
            if (t.hasOwnProperty("rng"))
                return R.some(t.rng)
        }
        return R.none()
    }, sl = function(e, t, n) {
        return Ps(e, t, n)
    }, cl = function(t, e) {
        ul(t, e).each(function(e) {
            t.setRng(e)
        })
    }, ll = function(e) {
        return $t(e) && "SPAN" === e.tagName && "bookmark" === e.getAttribute("data-mce-type")
    }, fl = (Dc = oo,
    function(e) {
        return Dc === e
    }
    ), dl = function(e) {
        return "" !== e && -1 !== " \f\n\r\t\x0B".indexOf(e)
    }, ml = function(e) {
        return !dl(e) && !fl(e)
    }, pl = function(e) {
        return !!e.nodeType
    }, gl = function(e, t, n) {
        var r, o, i, a, u = n.startOffset, s = n.startContainer;
        if ((n.startContainer !== n.endContainer || !(a = n.startContainer.childNodes[n.startOffset]) || !/^(IMG)$/.test(a.nodeName)) && 1 === s.nodeType)
            for (u < (i = s.childNodes).length ? (s = i[u],
            r = new ra(s,e.getParent(s, e.isBlock))) : (s = i[i.length - 1],
            (r = new ra(s,e.getParent(s, e.isBlock))).next(!0)),
            o = r.current(); o; o = r.next())
                if (3 === o.nodeType && !bl(o))
                    return n.setStart(o, 0),
                    void t.setRng(n)
    }, hl = function(e, t, n) {
        if (e) {
            var r = t ? "nextSibling" : "previousSibling";
            for (e = n ? e : e[r]; e; e = e[r])
                if (1 === e.nodeType || !bl(e))
                    return e
        }
    }, vl = function(e, t) {
        return pl(t) && (t = t.nodeName),
        !!e.schema.getTextBlockElements()[t.toLowerCase()]
    }, yl = function(e, t, n) {
        return e.schema.isValidChild(t, n)
    }, bl = function(e) {
        return e && Zt(e) && /^([\t \r\n]+|)$/.test(e.nodeValue)
    }, Cl = function(e, n) {
        return "string" != typeof e ? e = e(n) : n && (e = e.replace(/%(\w+)/g, function(e, t) {
            return n[t] || e
        })),
        e
    }, wl = function(e, t) {
        return e = "" + ((e = e || "").nodeName || e),
        t = "" + ((t = t || "").nodeName || t),
        e.toLowerCase() === t.toLowerCase()
    }, xl = function(e, t, n) {
        return "color" !== n && "backgroundColor" !== n || (t = e.toHex(t)),
        "fontWeight" === n && 700 === t && (t = "bold"),
        "fontFamily" === n && (t = t.replace(/[\'\"]/g, "").replace(/,\s+/g, ",")),
        "" + t
    }, Sl = function(e, t, n) {
        return xl(e, e.getStyle(t, n), n)
    }, Nl = function(t, e) {
        var n;
        return t.getParent(e, function(e) {
            return (n = t.getStyle(e, "text-decoration")) && "none" !== n
        }),
        n
    }, El = function(e, t, n) {
        return e.getParents(t, n, e.getRoot())
    }, kl = function(t, e, n) {
        var r = ["inline", "block", "selector", "attributes", "styles", "classes"]
          , a = function(e) {
            return le(e, function(e, t) {
                return F(r, function(e) {
                    return e === t
                })
            })
        };
        return F(t.formatter.get(e), function(e) {
            var i = a(e);
            return F(t.formatter.get(n), function(e) {
                var t, n, r, o = a(e);
                return t = i,
                n = o,
                void 0 === r && (r = l),
                u(r).eq(t, n)
            })
        })
    }, _l = ll, Rl = El, Tl = bl, Al = vl, Dl = function(e, t) {
        for (var n = t; n; ) {
            if ($t(n) && e.getContentEditable(n))
                return "false" === e.getContentEditable(n) ? n : t;
            n = n.parentNode
        }
        return t
    }, Ol = function(e, t, n, r) {
        for (var o = t.data, i = n; e ? 0 <= i : i < o.length; e ? i-- : i++)
            if (r(o.charAt(i)))
                return e ? i + 1 : i;
        return -1
    }, Bl = function(e, t, n) {
        return Ol(e, t, n, function(e) {
            return fl(e) || dl(e)
        })
    }, Pl = function(e, t, n) {
        return Ol(e, t, n, ml)
    }, Ll = function(i, e, t, n, a, r) {
        var u, s = i.getParent(t, i.isBlock) || e, o = function(e, t, n) {
            var r = uu(i)
              , o = a ? r.backwards : r.forwards;
            return R.from(o(e, t, function(e, t) {
                return _l(e.parentNode) ? -1 : n(a, u = e, t)
            }, s))
        };
        return o(t, n, Bl).bind(function(e) {
            return r ? o(e.container, e.offset + (a ? -1 : 0), Pl) : R.some(e)
        }).orThunk(function() {
            return u ? R.some({
                container: u,
                offset: a ? 0 : u.length
            }) : R.none()
        })
    }, Il = function(e, t, n, r, o) {
        Zt(r) && 0 === r.nodeValue.length && r[o] && (r = r[o]);
        for (var i = Rl(e, r), a = 0; a < i.length; a++)
            for (var u = 0; u < t.length; u++) {
                var s = t[u];
                if (!("collapsed"in s && s.collapsed !== n.collapsed) && e.is(i[a], s.selector))
                    return i[a]
            }
        return r
    }, Ml = function(t, e, n, r) {
        var o, i = t.dom, a = i.getRoot();
        if (e[0].wrapper || (o = i.getParent(n, e[0].block, a)),
        !o) {
            var u = i.getParent(n, "LI,TD,TH");
            o = i.getParent(Zt(n) ? n.parentNode : n, function(e) {
                return e !== a && Al(t, e)
            }, u)
        }
        if (o && e[0].wrapper && (o = Rl(i, o, "ul,ol").reverse()[0] || o),
        !o)
            for (o = n; o[r] && !i.isBlock(o[r]) && (o = o[r],
            !wl(o, "br")); )
                ;
        return o || n
    }, Fl = function(e, t, n, r, o, i, a) {
        var u, s, c, l, f, d;
        if (u = s = a ? n : o,
        l = a ? "previousSibling" : "nextSibling",
        f = e.getRoot(),
        Zt(u) && !Tl(u) && (a ? 0 < r : i < u.nodeValue.length))
            return u;
        for (; ; ) {
            if (!t[0].block_expand && e.isBlock(s))
                return s;
            for (c = s[l]; c; c = c[l])
                if (!_l(c) && !Tl(c) && ("BR" !== (d = c).nodeName || !d.getAttribute("data-mce-bogus") || d.nextSibling))
                    return s;
            if (s === f || s.parentNode === f) {
                u = s;
                break
            }
            s = s.parentNode
        }
        return u
    }, Ul = function(e, t, n, r) {
        void 0 === r && (r = !1);
        var o = t.startContainer
          , i = t.startOffset
          , a = t.endContainer
          , u = t.endOffset
          , s = e.dom;
        $t(o) && o.hasChildNodes() && (o = Hu(o, i),
        Zt(o) && (i = 0)),
        $t(a) && a.hasChildNodes() && (a = Hu(a, t.collapsed ? u : u - 1),
        Zt(a) && (u = a.nodeValue.length)),
        o = Dl(s, o),
        a = Dl(s, a),
        (_l(o.parentNode) || _l(o)) && (o = _l(o) ? o : o.parentNode,
        o = t.collapsed ? o.previousSibling || o : o.nextSibling || o,
        Zt(o) && (i = t.collapsed ? o.length : 0)),
        (_l(a.parentNode) || _l(a)) && (a = _l(a) ? a : a.parentNode,
        a = t.collapsed ? a.nextSibling || a : a.previousSibling || a,
        Zt(a) && (u = t.collapsed ? 0 : a.length)),
        t.collapsed && (Ll(s, e.getBody(), o, i, !0, r).each(function(e) {
            var t = e.container
              , n = e.offset;
            o = t,
            i = n
        }),
        Ll(s, e.getBody(), a, u, !1, r).each(function(e) {
            var t = e.container
              , n = e.offset;
            a = t,
            u = n
        }));
        return (n[0].inline || n[0].block_expand) && (n[0].inline && Zt(o) && 0 !== i || (o = Fl(s, n, o, i, a, u, !0)),
        n[0].inline && Zt(a) && u !== a.nodeValue.length || (a = Fl(s, n, o, i, a, u, !1))),
        n[0].selector && !1 !== n[0].expand && !n[0].inline && (o = Il(s, n, t, o, "previousSibling"),
        a = Il(s, n, t, a, "nextSibling")),
        (n[0].block || n[0].selector) && (o = Ml(e, n, o, "previousSibling"),
        a = Ml(e, n, a, "nextSibling"),
        n[0].block && (s.isBlock(o) || (o = Fl(s, n, o, i, a, u, !0)),
        s.isBlock(a) || (a = Fl(s, n, o, i, a, u, !1)))),
        $t(o) && (i = s.nodeIndex(o),
        o = o.parentNode),
        $t(a) && (u = s.nodeIndex(a) + 1,
        a = a.parentNode),
        {
            startContainer: o,
            startOffset: i,
            endContainer: a,
            endOffset: u
        }
    }, zl = function(e, t) {
        var n = e.childNodes;
        return t >= n.length ? t = n.length - 1 : t < 0 && (t = 0),
        n[t] || e
    }, jl = function(e, t, u) {
        var n = t.startContainer
          , r = t.startOffset
          , o = t.endContainer
          , i = t.endOffset
          , s = function(e) {
            var t;
            return 3 === (t = e[0]).nodeType && t === n && r >= t.nodeValue.length && e.splice(0, 1),
            t = e[e.length - 1],
            0 === i && 0 < e.length && t === o && 3 === t.nodeType && e.splice(e.length - 1, 1),
            e
        }
          , c = function(e, t, n) {
            for (var r = []; e && e !== n; e = e[t])
                r.push(e);
            return r
        }
          , a = function(e, t) {
            do {
                if (e.parentNode === t)
                    return e;
                e = e.parentNode
            } while (e)
        }
          , l = function(e, t, n) {
            for (var r = n ? "nextSibling" : "previousSibling", o = e, i = o.parentNode; o && o !== t; o = i) {
                i = o.parentNode;
                var a = c(o === e ? o : o[r], r);
                a.length && (n || a.reverse(),
                u(s(a)))
            }
        };
        if (1 === n.nodeType && n.hasChildNodes() && (n = zl(n, r)),
        1 === o.nodeType && o.hasChildNodes() && (o = zl(o, i - 1)),
        n === o)
            return u(s([n]));
        for (var f = e.findCommonAncestor(n, o), d = n; d; d = d.parentNode) {
            if (d === o)
                return l(n, f, !0);
            if (d === f)
                break
        }
        for (d = o; d; d = d.parentNode) {
            if (d === n)
                return l(o, f);
            if (d === f)
                break
        }
        var m = a(n, f) || n
          , p = a(o, f) || o;
        l(n, m, !0);
        var g = c(m === n ? m : m.nextSibling, "nextSibling", p === o ? p.nextSibling : p);
        g.length && u(s(g)),
        l(o, p)
    }, Hl = function(e) {
        var t = [];
        if (e)
            for (var n = 0; n < e.rangeCount; n++)
                t.push(e.getRangeAt(n));
        return t
    }, Vl = function(e) {
        return H(Y(e, function(e) {
            var t = ju(e);
            return t ? [Ne.fromDom(t)] : []
        }), Dr)
    }, ql = function(e, t) {
        var n = Ua(t, "td[data-mce-selected],th[data-mce-selected]");
        return 0 < n.length ? n : Vl(e)
    }, $l = function(e) {
        return ql(Hl(e.selection.getSel()), Ne.fromDom(e.getBody()))
    }, Wl = function(t) {
        return yt(t).fold(x([t]), function(e) {
            return [t].concat(Wl(e))
        })
    }, Kl = function(t) {
        return bt(t).fold(x([t]), function(e) {
            return "br" === Rt(e) ? dt(e).map(function(e) {
                return [t].concat(Kl(e))
            }).getOr([]) : [t].concat(Kl(e))
        })
    }, Xl = function(o, e) {
        return $u((a = (i = e).startContainer,
        u = i.startOffset,
        Zt(a) ? 0 === u ? R.some(Ne.fromDom(a)) : R.none() : R.from(a.childNodes[u]).map(Ne.fromDom)), (n = (t = e).endContainer,
        r = t.endOffset,
        Zt(n) ? r === n.data.length ? R.some(Ne.fromDom(n)) : R.none() : R.from(n.childNodes[r - 1]).map(Ne.fromDom)), function(e, t) {
            var n = K(Wl(o), N(at, e))
              , r = K(Kl(o), N(at, t));
            return n.isSome() && r.isSome()
        }).getOr(!1);
        var t, n, r, i, a, u
    }, Yl = function(e, t, n, r) {
        var o = n
          , i = new ra(n,o)
          , a = e.schema.getNonEmptyElements();
        do {
            if (3 === n.nodeType && 0 !== hr.trim(n.nodeValue).length)
                return void (r ? t.setStart(n, 0) : t.setEnd(n, n.nodeValue.length));
            if (a[n.nodeName] && !/^(TD|TH)$/.test(n.nodeName))
                return void (r ? t.setStartBefore(n) : "BR" === n.nodeName ? t.setEndBefore(n) : t.setEndAfter(n))
        } while (n = r ? i.next() : i.prev());"BODY" === o.nodeName && (r ? t.setStart(o, 0) : t.setEnd(o, o.childNodes.length))
    }, Gl = function(e) {
        var t = e.selection.getSel();
        return t && 0 < t.rangeCount
    }, Jl = function(r, o) {
        var e = $l(r);
        0 < e.length ? z(e, function(e) {
            var t = e.dom()
              , n = r.dom.createRng();
            n.setStartBefore(t),
            n.setEndAfter(t),
            o(n, !0)
        }) : o(r.selection.getRng(), !1)
    }, Ql = function(e, t, n) {
        var r = Bs(e, t);
        n(r),
        e.moveToBookmark(r)
    };
    var Zl = function gE(n, r) {
        var t = function(e) {
            return n(e) ? R.from(e.dom().nodeValue) : R.none()
        };
        return {
            get: function(e) {
                if (!n(e))
                    throw new Error("Can only get " + r + " value of a " + r + " node");
                return t(e).getOr("")
            },
            getOption: t,
            set: function(e, t) {
                if (!n(e))
                    throw new Error("Can only set raw " + r + " value of a " + r + " node");
                e.dom().nodeValue = t
            }
        }
    }(Ot, "text")
      , ef = function(e) {
        return Zl.get(e)
    }
      , tf = function(r, o, i, a) {
        return ft(o).fold(function() {
            return "skipping"
        }, function(e) {
            return "br" === a || Ot(n = o) && ef(n) === ro ? "valid" : Dt(t = o) && Ma(t, Ka()) ? "existing" : Ms(o) ? "caret" : yl(r, i, a) && yl(r, Rt(e), i) ? "valid" : "invalid-child";
            var t, n
        })
    }
      , nf = function(e, t, n, r) {
        var o = t.uid
          , i = void 0 === o ? tu("mce-annotation") : o
          , a = function p(e, t) {
            var n = {};
            for (var r in e)
                Object.prototype.hasOwnProperty.call(e, r) && t.indexOf(r) < 0 && (n[r] = e[r]);
            if (null != e && "function" == typeof Object.getOwnPropertySymbols) {
                var o = 0;
                for (r = Object.getOwnPropertySymbols(e); o < r.length; o++)
                    t.indexOf(r[o]) < 0 && Object.prototype.propertyIsEnumerable.call(e, r[o]) && (n[r[o]] = e[r[o]])
            }
            return n
        }(t, ["uid"])
          , u = Ne.fromTag("span", e);
        La(u, Ka()),
        cn(u, "" + Ya(), i),
        cn(u, "" + Xa(), n);
        var s, c = r(i, a), l = c.attributes, f = void 0 === l ? {} : l, d = c.classes, m = void 0 === d ? [] : d;
        return ln(u, f),
        s = u,
        z(m, function(e) {
            La(s, e)
        }),
        u
    }
      , rf = function(i, e, t, n, r) {
        var a = []
          , u = nf(i.getDoc(), r, t, n)
          , s = xa(R.none())
          , c = function() {
            s.set(R.none())
        }
          , l = function(e) {
            z(e, o)
        }
          , o = function(e) {
            var t, n;
            switch (tf(i, e, "span", Rt(e))) {
            case "invalid-child":
                c();
                var r = ht(e);
                l(r),
                c();
                break;
            case "valid":
                var o = s.get().getOrThunk(function() {
                    var e = ou(u);
                    return a.push(e),
                    s.set(R.some(e)),
                    e
                });
                Ct(t = e, n = o),
                St(n, t)
            }
        };
        return jl(i.dom, e, function(e) {
            var t;
            c(),
            t = U(e, Ne.fromDom),
            l(t)
        }),
        a
    }
      , of = function(u, s, c, l) {
        u.undoManager.transact(function() {
            var e, t, n, r = u.selection, o = r.getRng(), i = 0 < $l(u).length;
            if (o.collapsed && !i && (n = Ul(e = u, t = o, [{
                inline: !0
            }]),
            t.setStart(n.startContainer, n.startOffset),
            t.setEnd(n.endContainer, n.endOffset),
            e.selection.setRng(t)),
            r.getRng().collapsed && !i) {
                var a = nf(u.getDoc(), l, s, c.decorate);
                nu(a, oo),
                r.getRng().insertNode(a.dom()),
                r.select(a.dom())
            } else
                Ql(r, !1, function() {
                    Jl(u, function(e) {
                        rf(u, e, s, c.decorate, l)
                    })
                })
        })
    }
      , af = function(u) {
        var n, r = (n = {},
        {
            register: function(e, t) {
                n[e] = {
                    name: e,
                    settings: t
                }
            },
            lookup: function(e) {
                return n.hasOwnProperty(e) ? R.from(n[e]).map(function(e) {
                    return e.settings
                }) : R.none()
            }
        });
        Za(u, r);
        var o = Qa(u);
        return {
            register: function(e, t) {
                r.register(e, t)
            },
            annotate: function(t, n) {
                r.lookup(t).each(function(e) {
                    of(u, t, e, n)
                })
            },
            annotationChanged: function(e, t) {
                o.addListener(e, t)
            },
            remove: function(e) {
                Ga(u, R.some(e)).each(function(e) {
                    var t = e.elements;
                    z(t, _t)
                })
            },
            getAll: function(e) {
                var t, n, r, o, i, a = (t = u,
                n = e,
                r = Ne.fromDom(t.getBody()),
                o = Ua(r, "[" + Xa() + '="' + n + '"]'),
                i = {},
                z(o, function(e) {
                    var t = fn(e, Ya())
                      , n = i.hasOwnProperty(t) ? i[t] : [];
                    i[t] = n.concat([e])
                }),
                i);
                return ie(a, function(e) {
                    return U(e, function(e) {
                        return e.dom()
                    })
                })
            }
        }
    }
      , uf = /^[ \t\r\n]*$/
      , sf = {
        "#text": 3,
        "#comment": 8,
        "#cdata": 4,
        "#pi": 7,
        "#doctype": 10,
        "#document-fragment": 11
    }
      , cf = function(e, t, n) {
        var r = n ? "lastChild" : "firstChild"
          , o = n ? "prev" : "next";
        if (e[r])
            return e[r];
        if (e !== t) {
            var i = e[o];
            if (i)
                return i;
            for (var a = e.parent; a && a !== t; a = a.parent)
                if (i = a[o])
                    return i
        }
    }
      , lf = function(e) {
        if (!uf.test(e.value))
            return !1;
        var t = e.parent;
        return !t || "span" === t.name && !t.attr("style") || !/^[ ]+$/.test(e.value)
    }
      , ff = function(e) {
        var t = "a" === e.name && !e.attr("href") && e.attr("id");
        return e.attr("name") || e.attr("id") && !e.firstChild || e.attr("data-mce-bookmark") || t
    }
      , df = (mf.create = function(e, t) {
        var n = new mf(e,sf[e] || 1);
        return t && oe(t, function(e, t) {
            n.attr(t, e)
        }),
        n
    }
    ,
    mf.prototype.replace = function(e) {
        return e.parent && e.remove(),
        this.insert(e, this),
        this.remove(),
        this
    }
    ,
    mf.prototype.attr = function(e, t) {
        var n, r = this;
        if ("string" != typeof e)
            return e !== undefined && null !== e && oe(e, function(e, t) {
                r.attr(t, e)
            }),
            r;
        if (n = r.attributes) {
            if (t === undefined)
                return n.map[e];
            if (null === t) {
                if (e in n.map) {
                    delete n.map[e];
                    for (var o = n.length; o--; )
                        if (n[o].name === e)
                            return n.splice(o, 1),
                            r
                }
                return r
            }
            if (e in n.map) {
                for (o = n.length; o--; )
                    if (n[o].name === e) {
                        n[o].value = t;
                        break
                    }
            } else
                n.push({
                    name: e,
                    value: t
                });
            return n.map[e] = t,
            r
        }
    }
    ,
    mf.prototype.clone = function() {
        var e, t = new mf(this.name,this.type);
        if (e = this.attributes) {
            var n = [];
            n.map = {};
            for (var r = 0, o = e.length; r < o; r++) {
                var i = e[r];
                "id" !== i.name && (n[n.length] = {
                    name: i.name,
                    value: i.value
                },
                n.map[i.name] = i.value)
            }
            t.attributes = n
        }
        return t.value = this.value,
        t.shortEnded = this.shortEnded,
        t
    }
    ,
    mf.prototype.wrap = function(e) {
        return this.parent.insert(e, this),
        e.append(this),
        this
    }
    ,
    mf.prototype.unwrap = function() {
        for (var e = this.firstChild; e; ) {
            var t = e.next;
            this.insert(e, this, !0),
            e = t
        }
        this.remove()
    }
    ,
    mf.prototype.remove = function() {
        var e = this.parent
          , t = this.next
          , n = this.prev;
        return e && (e.firstChild === this ? (e.firstChild = t) && (t.prev = null) : n.next = t,
        e.lastChild === this ? (e.lastChild = n) && (n.next = null) : t.prev = n,
        this.parent = this.next = this.prev = null),
        this
    }
    ,
    mf.prototype.append = function(e) {
        e.parent && e.remove();
        var t = this.lastChild;
        return t ? ((t.next = e).prev = t,
        this.lastChild = e) : this.lastChild = this.firstChild = e,
        e.parent = this,
        e
    }
    ,
    mf.prototype.insert = function(e, t, n) {
        e.parent && e.remove();
        var r = t.parent || this;
        return n ? (t === r.firstChild ? r.firstChild = e : t.prev.next = e,
        e.prev = t.prev,
        (e.next = t).prev = e) : (t === r.lastChild ? r.lastChild = e : t.next.prev = e,
        e.next = t.next,
        (e.prev = t).next = e),
        e.parent = r,
        e
    }
    ,
    mf.prototype.getAll = function(e) {
        for (var t = [], n = this.firstChild; n; n = cf(n, this))
            n.name === e && t.push(n);
        return t
    }
    ,
    mf.prototype.empty = function() {
        if (this.firstChild) {
            for (var e = [], t = this.firstChild; t; t = cf(t, this))
                e.push(t);
            for (var n = e.length; n--; )
                (t = e[n]).parent = t.firstChild = t.lastChild = t.next = t.prev = null
        }
        return this.firstChild = this.lastChild = null,
        this
    }
    ,
    mf.prototype.isEmpty = function(e, t, n) {
        void 0 === t && (t = {});
        var r = this.firstChild;
        if (ff(this))
            return !1;
        if (r)
            do {
                if (1 === r.type) {
                    if (r.attr("data-mce-bogus"))
                        continue;
                    if (e[r.name])
                        return !1;
                    if (ff(r))
                        return !1
                }
                if (8 === r.type)
                    return !1;
                if (3 === r.type && !lf(r))
                    return !1;
                if (3 === r.type && r.parent && t[r.parent.name] && uf.test(r.value))
                    return !1;
                if (n && n(r))
                    return !1
            } while (r = cf(r, this));return !0
    }
    ,
    mf.prototype.walk = function(e) {
        return cf(this, null, e)
    }
    ,
    mf);
    function mf(e, t) {
        this.name = e,
        1 === (this.type = t) && (this.attributes = [],
        this.attributes.map = {})
    }
    var pf = hr.makeMap
      , gf = function(e) {
        var u, s, c, l, f, d = [];
        return u = (e = e || {}).indent,
        s = pf(e.indent_before || ""),
        c = pf(e.indent_after || ""),
        l = $r.getEncodeFunc(e.entity_encoding || "raw", e.entities),
        f = "html" === e.element_format,
        {
            start: function(e, t, n) {
                var r, o, i, a;
                if (u && s[e] && 0 < d.length && 0 < (a = d[d.length - 1]).length && "\n" !== a && d.push("\n"),
                d.push("<", e),
                t)
                    for (r = 0,
                    o = t.length; r < o; r++)
                        i = t[r],
                        d.push(" ", i.name, '="', l(i.value, !0), '"');
                d[d.length] = !n || f ? ">" : " />",
                n && u && c[e] && 0 < d.length && 0 < (a = d[d.length - 1]).length && "\n" !== a && d.push("\n")
            },
            end: function(e) {
                var t;
                d.push("</", e, ">"),
                u && c[e] && 0 < d.length && 0 < (t = d[d.length - 1]).length && "\n" !== t && d.push("\n")
            },
            text: function(e, t) {
                0 < e.length && (d[d.length] = t ? e : l(e))
            },
            cdata: function(e) {
                d.push("<![CDATA[", e, "]]>")
            },
            comment: function(e) {
                d.push("\x3c!--", e, "--\x3e")
            },
            pi: function(e, t) {
                t ? d.push("<?", e, " ", l(t), "?>") : d.push("<?", e, "?>"),
                u && d.push("\n")
            },
            doctype: function(e) {
                d.push("<!DOCTYPE", e, ">", u ? "\n" : "")
            },
            reset: function() {
                d.length = 0
            },
            getContent: function() {
                return d.join("").replace(/\n$/, "")
            }
        }
    }
      , hf = function(t, p) {
        void 0 === p && (p = no());
        var g = gf(t);
        (t = t || {}).validate = !("validate"in t) || t.validate;
        return {
            serialize: function(e) {
                var f, d;
                d = t.validate,
                f = {
                    3: function(e) {
                        g.text(e.value, e.raw)
                    },
                    8: function(e) {
                        g.comment(e.value)
                    },
                    7: function(e) {
                        g.pi(e.name, e.value)
                    },
                    10: function(e) {
                        g.doctype(e.value)
                    },
                    4: function(e) {
                        g.cdata(e.value)
                    },
                    11: function(e) {
                        if (e = e.firstChild)
                            for (; m(e),
                            e = e.next; )
                                ;
                    }
                },
                g.reset();
                var m = function(e) {
                    var t, n, r, o, i, a, u, s, c, l = f[e.type];
                    if (l)
                        l(e);
                    else {
                        if (t = e.name,
                        n = e.shortEnded,
                        r = e.attributes,
                        d && r && 1 < r.length && ((a = []).map = {},
                        c = p.getElementRule(e.name))) {
                            for (u = 0,
                            s = c.attributesOrder.length; u < s; u++)
                                (o = c.attributesOrder[u])in r.map && (i = r.map[o],
                                a.map[o] = i,
                                a.push({
                                    name: o,
                                    value: i
                                }));
                            for (u = 0,
                            s = r.length; u < s; u++)
                                (o = r[u].name)in a.map || (i = r.map[o],
                                a.map[o] = i,
                                a.push({
                                    name: o,
                                    value: i
                                }));
                            r = a
                        }
                        if (g.start(e.name, r, n),
                        !n) {
                            if (e = e.firstChild)
                                for (; m(e),
                                e = e.next; )
                                    ;
                            g.end(t)
                        }
                    }
                };
                return 1 !== e.type || t.inner ? f[11](e) : m(e),
                g.getContent()
            }
        }
    }
      , vf = function(e, t) {
        return e.replace(new RegExp(t.prefix + "_[0-9]+","g"), function(e) {
            return de(t.uris, e).getOr(e)
        })
    }
      , yf = function(e, t, n) {
        var r, o, i, a, u = 1;
        for (a = e.getShortEndedElements(),
        (i = /<([!?\/])?([A-Za-z0-9\-_\:\.]+)((?:\s+[^"\'>]+(?:(?:"[^"]*")|(?:\'[^\']*\')|[^>]*))*|\/|\s+)>/g).lastIndex = r = n; o = i.exec(t); ) {
            if (r = i.lastIndex,
            "/" === o[1])
                u--;
            else if (!o[1]) {
                if (o[2]in a)
                    continue;
                u++
            }
            if (0 === u)
                break
        }
        return r
    }
      , bf = function(e, t) {
        var n = e.exec(t);
        if (n) {
            var r = n[1]
              , o = n[2];
            return "string" == typeof r && "data-mce-bogus" === r.toLowerCase() ? o : null
        }
        return null
    };
    function Cf(W, K) {
        void 0 === K && (K = no());
        var e = function() {};
        !1 !== (W = W || {}).fix_self_closing && (W.fix_self_closing = !0);
        var X = W.comment ? W.comment : e
          , Y = W.cdata ? W.cdata : e
          , G = W.text ? W.text : e
          , J = W.start ? W.start : e
          , Q = W.end ? W.end : e
          , Z = W.pi ? W.pi : e
          , ee = W.doctype ? W.doctype : e
          , n = function(m, e) {
            void 0 === e && (e = "html");
            var t, n, r, p, o, i, a, g, u, s, h, c, v, l, f, d, y, b, C, w, x, S, N, E, k, _, R, T, A, D = m.html, O = 0, B = [], P = 0, L = $r.decode, I = hr.makeMap("src,href,data,background,formaction,poster,xlink:href"), M = /((java|vb)script|mhtml):/i, F = "html" === e ? 0 : 1, U = function(e) {
                var t, n;
                for (t = B.length; t-- && B[t].name !== e; )
                    ;
                if (0 <= t) {
                    for (n = B.length - 1; t <= n; n--)
                        (e = B[n]).valid && Q(e.name);
                    B.length = t
                }
            }, z = function(e, t) {
                return G(vf(e, m), t)
            }, j = function(e) {
                "" !== e && (">" === e.charAt(0) && (e = " " + e),
                W.allow_conditional_comments || "[if" !== e.substr(0, 3).toLowerCase() || (e = " " + e),
                X(vf(e, m)))
            }, H = function(e, t) {
                var n = e || ""
                  , r = !Ve(n, "--")
                  , o = function(e, t, n) {
                    void 0 === n && (n = 0);
                    var r = e.toLowerCase();
                    if (-1 !== r.indexOf("[if ", n) && (u = n,
                    /^\s*\[if [\w\W]+\]>.*<!\[endif\](--!?)?>/.test(r.substr(u)))) {
                        var o = r.indexOf("[endif]", n);
                        return r.indexOf(">", o)
                    }
                    if (t) {
                        var i = r.indexOf(">", n);
                        return -1 !== i ? i : r.length
                    }
                    var a = /--!?>/;
                    a.lastIndex = n;
                    var u, s = a.exec(e);
                    return s ? s.index + s[0].length : r.length
                }(D, r, t);
                return e = D.substr(t, o - t),
                j(r ? n + e : e),
                o + 1
            }, V = function(e, t, n, r, o) {
                var i, a, u, s, c, l;
                if (t = t.toLowerCase(),
                u = t in h ? t : L(n || r || o || ""),
                n = de(m.uris, u).getOr(u),
                v && !g && !1 == (0 === (s = t).indexOf("data-") || 0 === s.indexOf("aria-"))) {
                    if (!(i = b[t]) && C) {
                        for (a = C.length; a-- && !(i = C[a]).pattern.test(t); )
                            ;
                        -1 === a && (i = null)
                    }
                    if (!i)
                        return;
                    if (i.validValues && !(n in i.validValues))
                        return
                }
                if (I[t] && !W.allow_script_urls) {
                    var f = n.replace(/[\s\u0000-\u001F]+/g, "");
                    try {
                        f = decodeURIComponent(f)
                    } catch (d) {
                        f = unescape(f)
                    }
                    if (M.test(f))
                        return;
                    if (l = f,
                    !(c = W).allow_html_data_urls && (/^data:image\//i.test(l) ? !1 === c.allow_svg_data_urls && /^data:image\/svg\+xml/i.test(l) : /^data:/i.test(l)))
                        return
                }
                g && (t in I || 0 === t.indexOf("on")) || (p.map[t] = n,
                p.push({
                    name: t,
                    value: n
                }))
            };
            for (k = new RegExp("<(?:(?:!--([\\w\\W]*?)--!?>)|(?:!\\[CDATA\\[([\\w\\W]*?)\\]\\]>)|(?:![Dd][Oo][Cc][Tt][Yy][Pp][Ee]([\\w\\W]*?)>)|(?:!(--)?)|(?:\\?([^\\s\\/<>]+) ?([\\w\\W]*?)[?/]>)|(?:\\/([A-Za-z][A-Za-z0-9\\-_\\:\\.]*)>)|(?:([A-Za-z][A-Za-z0-9\\-_\\:\\.]*)((?:\\s+[^\"'>]+(?:(?:\"[^\"]*\")|(?:'[^']*')|[^>]*))*|\\/|\\s+)>))","g"),
            _ = /([\w:\-]+)(?:\s*=\s*(?:(?:\"((?:[^\"])*)\")|(?:\'((?:[^\'])*)\')|([^>\s]+)))?/g,
            s = K.getShortEndedElements(),
            E = W.self_closing_elements || K.getSelfClosingElements(),
            h = K.getBoolAttrs(),
            v = W.validate,
            u = W.remove_internals,
            A = W.fix_self_closing,
            R = K.getSpecialElements(),
            N = D + ">"; t = k.exec(N); ) {
                var q = t[0];
                if (O < t.index && z(L(D.substr(O, t.index - O))),
                n = t[7])
                    ":" === (n = n.toLowerCase()).charAt(0) && (n = n.substr(1)),
                    U(n);
                else if (n = t[8]) {
                    if (t.index + q.length > D.length) {
                        z(L(D.substr(t.index))),
                        O = t.index + q.length;
                        continue
                    }
                    ":" === (n = n.toLowerCase()).charAt(0) && (n = n.substr(1)),
                    c = n in s,
                    A && E[n] && 0 < B.length && B[B.length - 1].name === n && U(n);
                    var $ = bf(_, t[9]);
                    if (null !== $) {
                        if ("all" === $) {
                            O = yf(K, D, k.lastIndex),
                            k.lastIndex = O;
                            continue
                        }
                        f = !1
                    }
                    if (!v || (l = K.getElementRule(n))) {
                        if (f = !0,
                        v && (b = l.attributes,
                        C = l.attributePatterns),
                        (y = t[9]) ? ((g = -1 !== y.indexOf("data-mce-type")) && u && (f = !1),
                        (p = []).map = {},
                        y.replace(_, V)) : (p = []).map = {},
                        v && !g) {
                            if (w = l.attributesRequired,
                            x = l.attributesDefault,
                            S = l.attributesForced,
                            l.removeEmptyAttrs && !p.length && (f = !1),
                            S)
                                for (o = S.length; o--; )
                                    a = (d = S[o]).name,
                                    "{$uid}" === (T = d.value) && (T = "mce_" + P++),
                                    p.map[a] = T,
                                    p.push({
                                        name: a,
                                        value: T
                                    });
                            if (x)
                                for (o = x.length; o--; )
                                    (a = (d = x[o]).name)in p.map || ("{$uid}" === (T = d.value) && (T = "mce_" + P++),
                                    p.map[a] = T,
                                    p.push({
                                        name: a,
                                        value: T
                                    }));
                            if (w) {
                                for (o = w.length; o-- && !(w[o]in p.map); )
                                    ;
                                -1 === o && (f = !1)
                            }
                            if (d = p.map["data-mce-bogus"]) {
                                if ("all" === d) {
                                    O = yf(K, D, k.lastIndex),
                                    k.lastIndex = O;
                                    continue
                                }
                                f = !1
                            }
                        }
                        f && J(n, p, c)
                    } else
                        f = !1;
                    if (r = R[n]) {
                        r.lastIndex = O = t.index + q.length,
                        O = (t = r.exec(D)) ? (f && (i = D.substr(O, t.index - O)),
                        t.index + t[0].length) : (i = D.substr(O),
                        D.length),
                        f && (0 < i.length && z(i, !0),
                        Q(n)),
                        k.lastIndex = O;
                        continue
                    }
                    c || (y && y.indexOf("/") === y.length - 1 ? f && Q(n) : B.push({
                        name: n,
                        valid: f
                    }))
                } else if (n = t[1])
                    j(n);
                else if (n = t[2]) {
                    if (!(1 == F || W.preserve_cdata || 0 < B.length && K.isValidChild(B[B.length - 1].name, "#cdata"))) {
                        O = H("", t.index + 2),
                        k.lastIndex = O;
                        continue
                    }
                    Y(n)
                } else if (n = t[3])
                    ee(n);
                else {
                    if ((n = t[4]) || "<!" === q) {
                        O = H(n, t.index + q.length),
                        k.lastIndex = O;
                        continue
                    }
                    if (n = t[5]) {
                        if (1 != F) {
                            O = H("?", t.index + 2),
                            k.lastIndex = O;
                            continue
                        }
                        Z(n, t[6])
                    }
                }
                O = t.index + q.length
            }
            for (O < D.length && z(L(D.substr(O))),
            o = B.length - 1; 0 <= o; o--)
                (n = B[o]).valid && Q(n.name)
        };
        return {
            parse: function(e, t) {
                void 0 === t && (t = "html"),
                n(function(e) {
                    for (var t, n = /data:[^;]+;base64,([a-z0-9\+\/=]+)/gi, r = [], o = {}, i = tu("img"), a = 0, u = 0; t = n.exec(e); ) {
                        var s = t[0]
                          , c = i + "_" + u++;
                        o[c] = s,
                        a < t.index && r.push(e.substr(a, t.index - a)),
                        r.push(c),
                        a = t.index + s.length
                    }
                    return 0 === a ? {
                        prefix: i,
                        uris: o,
                        html: e
                    } : (a < e.length && r.push(e.substr(a)),
                    {
                        prefix: i,
                        uris: o,
                        html: r.join("")
                    })
                }(e), t)
            }
        }
    }
    (Cf = Cf || {}).findEndTag = yf;
    var wf, xf, Sf, Nf, Ef, kf = Cf, _f = function(e, t) {
        var n, r, o, i, a, u, s, c, l = t, f = /<(\w+) [^>]*data-mce-bogus="all"[^>]*>/g, d = e.schema;
        for (u = e.getTempAttrs(),
        s = l,
        c = new RegExp(["\\s?(" + u.join("|") + ')="[^"]+"'].join("|"),"gi"),
        l = s.replace(c, ""),
        a = d.getShortEndedElements(); i = f.exec(l); )
            r = f.lastIndex,
            o = i[0].length,
            n = a[i[1]] ? r : kf.findEndTag(d, l, r),
            l = l.substring(0, r - o) + l.substring(n),
            f.lastIndex = r - o;
        return lu(l)
    }, Rf = _f, Tf = function(e, t, n, r) {
        var o, i, a, u, s;
        if (t.format = n,
        t.get = !0,
        t.getInner = !0,
        t.no_events || e.fire("BeforeGetContent", t),
        "raw" === t.format)
            o = hr.trim(Rf(e.serializer, r.innerHTML));
        else if ("text" === t.format)
            o = lu(r.innerText || r.textContent);
        else {
            if ("tree" === t.format)
                return e.serializer.serialize(r, t);
            a = (i = e).serializer.serialize(r, t),
            u = Hs(i),
            s = new RegExp("^(<" + u + "[^>]*>(&nbsp;|&#160;|\\s|\xa0|<br \\/>|)<\\/" + u + ">[\r\n]*|<br \\/>[\r\n]*)$"),
            o = a.replace(s, "")
        }
        return "text" === t.format || Or(Ne.fromDom(r)) ? t.content = o : t.content = hr.trim(o),
        t.no_events || e.fire("GetContent", t),
        t.content
    }, Af = hr.each, Df = function(o) {
        this.compare = function(e, t) {
            if (e.nodeName !== t.nodeName)
                return !1;
            var n = function(n) {
                var r = {};
                return Af(o.getAttribs(n), function(e) {
                    var t = e.nodeName.toLowerCase();
                    0 !== t.indexOf("_") && "style" !== t && 0 !== t.indexOf("data-") && (r[t] = o.getAttrib(n, t))
                }),
                r
            }
              , r = function(e, t) {
                var n, r;
                for (r in e)
                    if (e.hasOwnProperty(r)) {
                        if (void 0 === (n = t[r]))
                            return !1;
                        if (e[r] !== n)
                            return !1;
                        delete t[r]
                    }
                for (r in t)
                    if (t.hasOwnProperty(r))
                        return !1;
                return !0
            };
            return !!r(n(e), n(t)) && (!!r(o.parseStyle(o.getAttrib(e, "style")), o.parseStyle(o.getAttrib(t, "style"))) && (!ll(e) && !ll(t)))
        }
    }, Of = function(n, r, o) {
        return R.from(o.container()).filter(Zt).exists(function(e) {
            var t = n ? 0 : -1;
            return r(e.data.charAt(o.offset() + t))
        })
    }, Bf = N(Of, !0, dl), Pf = N(Of, !1, dl), Lf = function(e) {
        var t = e.container();
        return Zt(t) && 0 === t.data.length
    }, If = function(t, n) {
        return function(e) {
            return R.from(Cc(t ? 0 : -1, e)).filter(n).isSome()
        }
    }, Mf = function(e) {
        return "IMG" === e.nodeName && "block" === mn(Ne.fromDom(e), "display")
    }, Ff = function(e) {
        return an(e) && !($t(t = e) && "all" === t.getAttribute("data-mce-bogus"));
        var t
    }, Uf = If(!0, Mf), zf = If(!1, Mf), jf = If(!0, Gt), Hf = If(!1, Gt), Vf = If(!0, Ff), qf = If(!1, Ff), $f = function(e, t) {
        var n, r, o, i = Ne.fromDom(e), a = Ne.fromDom(t);
        return n = a,
        r = "pre,code",
        o = N(at, i),
        qa(n, r, o).isSome()
    }, Wf = function(e, t) {
        return Du(t) && !1 === (r = e,
        Zt(o = t) && /^[ \t\r\n]*$/.test(o.data) && !1 === $f(r, o)) || $t(n = t) && "A" === n.nodeName && n.hasAttribute("name") || Kf(t);
        var n, r, o
    }, Kf = Xt("data-mce-bookmark"), Xf = Xt("data-mce-bogus"), Yf = (wf = "data-mce-bogus",
    xf = "all",
    function(e) {
        return $t(e) && e.getAttribute(wf) === xf
    }
    ), Gf = function(e, t) {
        return void 0 === t && (t = !0),
        function(e, t) {
            var n, r = 0;
            if (Wf(e, e))
                return !1;
            if (!(n = e.firstChild))
                return !0;
            var o = new ra(n,e);
            do {
                if (t) {
                    if (Yf(n)) {
                        n = o.next(!0);
                        continue
                    }
                    if (Xf(n)) {
                        n = o.next();
                        continue
                    }
                }
                if (rn(n))
                    r++,
                    n = o.next();
                else {
                    if (Wf(e, n))
                        return !1;
                    n = o.next()
                }
            } while (n);return r <= 1
        }(e.dom(), t)
    }, Jf = function(e) {
        var t = Ua(e, "br")
          , n = H(function(e) {
            for (var t = [], n = e.dom(); n; )
                t.push(Ne.fromDom(n)),
                n = n.lastChild;
            return t
        }(e).slice(-1), Er);
        t.length === n.length && z(n, kt)
    }, Qf = function(e) {
        Et(e),
        St(e, Ne.fromHtml('<br data-mce-bogus="1">'))
    }, Zf = function(n) {
        bt(n).each(function(t) {
            dt(t).each(function(e) {
                Sr(n) && Er(t) && Sr(e) && kt(t)
            })
        })
    }, ed = function(e, t, n) {
        return st(t, e) ? function(e, t) {
            for (var n = D(t) ? t : g, r = e.dom(), o = []; null !== r.parentNode && r.parentNode !== undefined; ) {
                var i = r.parentNode
                  , a = Ne.fromDom(i);
                if (o.push(a),
                !0 === n(a))
                    break;
                r = i
            }
            return o
        }(e, function(e) {
            return n(e) || at(e, t)
        }).slice(0, -1) : []
    }, td = function(e, t) {
        return ed(e, t, x(!1))
    }, nd = function(e, t) {
        return [e].concat(td(e, t))
    }, rd = function(e, t, n) {
        if (0 !== n) {
            var r, o, i, a = e.data.slice(t, t + n), u = t + n >= e.data.length, s = 0 === t;
            e.replaceData(t, n, (o = s,
            i = u,
            W(r = a, function(e, t) {
                return dl(t) || fl(t) ? e.previousCharIsSpace || "" === e.str && o || e.str.length === r.length - 1 && i ? {
                    previousCharIsSpace: !1,
                    str: e.str + oo
                } : {
                    previousCharIsSpace: !0,
                    str: e.str + " "
                } : {
                    previousCharIsSpace: !1,
                    str: e.str + t
                }
            }, {
                previousCharIsSpace: !1,
                str: ""
            }).str))
        }
    }, od = function(e, t) {
        var n = e.data.slice(t)
          , r = n.length - We(n).length;
        return rd(e, t, r)
    }, id = function(e, t) {
        return r = e,
        o = (n = t).container(),
        i = n.offset(),
        !1 === ms.isTextPosition(n) && o === r.parentNode && i > ms.before(r).offset() ? ms(t.container(), t.offset() - 1) : t;
        var n, r, o, i
    }, ad = function(e) {
        return Du(e.previousSibling) ? R.some((t = e.previousSibling,
        Zt(t) ? ms(t, t.data.length) : ms.after(t))) : e.previousSibling ? el(e.previousSibling) : R.none();
        var t
    }, ud = function(e) {
        return Du(e.nextSibling) ? R.some((t = e.nextSibling,
        Zt(t) ? ms(t, 0) : ms.before(t))) : e.nextSibling ? Zc(e.nextSibling) : R.none();
        var t
    }, sd = function(r, o) {
        return ad(o).orThunk(function() {
            return ud(o)
        }).orThunk(function() {
            return e = r,
            t = o,
            n = ms.before(t.previousSibling ? t.previousSibling : t.parentNode),
            Qc(e, n).fold(function() {
                return Jc(e, ms.after(t))
            }, R.some);
            var e, t, n
        })
    }, cd = function(n, r) {
        return ud(r).orThunk(function() {
            return ad(r)
        }).orThunk(function() {
            return t = r,
            Jc(e = n, ms.after(t)).fold(function() {
                return Qc(e, ms.before(t))
            }, R.some);
            var e, t
        })
    }, ld = function(e, t, n) {
        return (e ? cd : sd)(t, n).map(N(id, n))
    }, fd = function(t, n, e) {
        e.fold(function() {
            t.focus()
        }, function(e) {
            t.selection.setRng(e.toRange(), n)
        })
    }, dd = function(e, t) {
        return t && e.schema.getBlockElements().hasOwnProperty(Rt(t))
    }, md = function(e) {
        if (Gf(e)) {
            var t = Ne.fromHtml('<br data-mce-bogus="1">');
            return Et(e),
            St(e, t),
            R.some(ms.before(t.dom()))
        }
        return R.none()
    }, pd = function(e, t, l) {
        var n, r, o, i, a = dt(e).filter(Ot), u = mt(e).filter(Ot);
        return kt(e),
        r = u,
        o = t,
        i = function(e, t, n) {
            var r, o, i, a, u = e.dom(), s = t.dom(), c = u.data.length;
            return o = s,
            i = l,
            a = Ke((r = u).data).length,
            r.appendData(o.data),
            kt(Ne.fromDom(o)),
            i && od(r, a),
            n.container() === s ? ms(u, c) : n
        }
        ,
        ((n = a).isSome() && r.isSome() && o.isSome() ? R.some(i(n.getOrDie(), r.getOrDie(), o.getOrDie())) : R.none()).orThunk(function() {
            return l && (a.each(function(e) {
                return t = e.dom(),
                n = e.dom().length,
                r = t.data.slice(0, n),
                o = r.length - Ke(r).length,
                rd(t, n - o, o);
                var t, n, r, o
            }),
            u.each(function(e) {
                return od(e.dom(), 0)
            })),
            t
        })
    }, gd = function(t, n, e, r) {
        void 0 === r && (r = !0);
        var o, i, a = ld(n, t.getBody(), e.dom()), u = Ha(e, N(dd, t), (o = t.getBody(),
        function(e) {
            return e.dom() === o
        }
        )), s = pd(e, a, (i = e,
        me(t.schema.getTextInlineElements(), Rt(i))));
        t.dom.isEmpty(t.getBody()) ? (t.setContent(""),
        t.selection.setCursorLocation()) : u.bind(md).fold(function() {
            r && fd(t, n, s)
        }, function(e) {
            r && fd(t, n, R.some(e))
        })
    }, hd = function(a) {
        if (!k(a))
            throw new Error("cases must be an array");
        if (0 === a.length)
            throw new Error("there must be at least one case");
        var u = []
          , n = {};
        return z(a, function(e, r) {
            var t = ne(e);
            if (1 !== t.length)
                throw new Error("one and only one name per case");
            var o = t[0]
              , i = e[o];
            if (n[o] !== undefined)
                throw new Error("duplicate key detected:" + o);
            if ("cata" === o)
                throw new Error("cannot have a case named cata (sorry)");
            if (!k(i))
                throw new Error("case arguments must be an array");
            u.push(o),
            n[o] = function() {
                var e = arguments.length;
                if (e !== i.length)
                    throw new Error("Wrong number of arguments to case " + o + ". Expected " + i.length + " (" + i + "), got " + e);
                for (var n = new Array(e), t = 0; t < n.length; t++)
                    n[t] = arguments[t];
                return {
                    fold: function() {
                        if (arguments.length !== a.length)
                            throw new Error("Wrong number of arguments to fold. Expected " + a.length + ", got " + arguments.length);
                        return arguments[r].apply(null, n)
                    },
                    match: function(e) {
                        var t = ne(e);
                        if (u.length !== t.length)
                            throw new Error("Wrong number of arguments to match. Expected: " + u.join(",") + "\nActual: " + t.join(","));
                        if (!G(u, function(e) {
                            return M(t, e)
                        }))
                            throw new Error("Not all branches were specified when using match. Specified: " + t.join(", ") + "\nRequired: " + u.join(", "));
                        return e[o].apply(null, n)
                    },
                    log: function(e) {
                        V.console.log(e, {
                            constructors: u,
                            constructor: o,
                            params: n
                        })
                    }
                }
            }
        }),
        n
    }, vd = function(e, t) {
        return {
            start: e,
            end: t
        }
    }, yd = hd([{
        removeTable: ["element"]
    }, {
        emptyCells: ["cells"]
    }, {
        deleteCellSelection: ["rng", "cell"]
    }]), bd = function(e, t) {
        return Wa(Ne.fromDom(e), "td,th", t)
    }, Cd = function(e, t) {
        return qa(e, "table", t)
    }, wd = function(e) {
        return !at(e.start, e.end)
    }, xd = function(e, t) {
        return Cd(e.start, t).bind(function(r) {
            return Cd(e.end, t).bind(function(e) {
                return t = at(r, e),
                n = r,
                t ? R.some(n) : R.none();
                var t, n
            })
        })
    }, Sd = function(e) {
        return Ua(e, "td,th")
    }, Nd = function(r, e) {
        var t = bd(e.startContainer, r)
          , n = bd(e.endContainer, r);
        return e.collapsed ? R.none() : $u(t, n, vd).fold(function() {
            return t.fold(function() {
                return n.bind(function(t) {
                    return Cd(t, r).bind(function(e) {
                        return Z(Sd(e)).map(function(e) {
                            return vd(e, t)
                        })
                    })
                })
            }, function(t) {
                return Cd(t, r).bind(function(e) {
                    return ee(Sd(e)).map(function(e) {
                        return vd(t, e)
                    })
                })
            })
        }, function(e) {
            return Ed(r, e) ? R.none() : (n = r,
            Cd((t = e).start, n).bind(function(e) {
                return ee(Sd(e)).map(function(e) {
                    return vd(t.start, e)
                })
            }));
            var t, n
        })
    }, Ed = function(e, t) {
        return xd(t, e).isSome()
    }, kd = function(e, t, n) {
        return e.filter(function(e) {
            return wd(e) && Ed(n, e)
        }).orThunk(function() {
            return Nd(n, t)
        }).bind(function(e) {
            return xd(t = e, n).map(function(e) {
                return {
                    rng: t,
                    table: e,
                    cells: Sd(e)
                }
            });
            var t
        })
    }, _d = function(e, t) {
        return X(e, function(e) {
            return at(e, t)
        })
    }, Rd = function(e, r, o) {
        return e.filter(function(e) {
            return n = o,
            !wd(t = e) && xd(t, n).exists(function(e) {
                var t = e.dom().rows;
                return 1 === t.length && 1 === t[0].cells.length
            }) && Xl(e.start, r);
            var t, n
        }).map(function(e) {
            return e.start
        })
    }, Td = function(n) {
        return $u(_d((r = n).cells, r.rng.start), _d(r.cells, r.rng.end), function(e, t) {
            return r.cells.slice(e, t + 1)
        }).map(function(e) {
            var t = n.cells;
            return e.length === t.length ? yd.removeTable(n.table) : yd.emptyCells(e)
        });
        var r
    }, Ad = function(e, t) {
        var n, r, o, i, a, u = (n = e,
        function(e) {
            return at(n, e)
        }
        ), s = (o = u,
        i = bd((r = t).startContainer, o),
        a = bd(r.endContainer, o),
        $u(i, a, vd));
        return Rd(s, t, u).map(function(e) {
            return yd.deleteCellSelection(t, e)
        }).orThunk(function() {
            return kd(s, t, u).bind(Td)
        })
    }, Dd = function(e) {
        var t;
        return (8 === Tt(t = e) || "#comment" === Rt(t) ? dt : bt)(e).bind(Dd).orThunk(function() {
            return R.some(e)
        })
    }, Od = function(e, t) {
        return z(t, Qf),
        e.selection.setCursorLocation(t[0].dom(), 0),
        !0
    }, Bd = function(e, t, n) {
        t.deleteContents();
        var r, o = Dd(n).getOr(n), i = Ne.fromDom(e.dom.getParent(o.dom(), e.dom.isBlock));
        if (Gf(i) && (Qf(i),
        e.selection.setCursorLocation(i.dom(), 0)),
        !at(n, i)) {
            var a = ft(i).is(n) ? [] : ft(r = i).map(ht).map(function(e) {
                return H(e, function(e) {
                    return !at(r, e)
                })
            }).getOr([]);
            z(a.concat(ht(n)), function(e) {
                at(e, i) || st(e, i) || kt(e)
            })
        }
        return !0
    }, Pd = function(e, t) {
        return gd(e, !1, t),
        !0
    }, Ld = function(n, e, r, t) {
        return Md(e, t).fold(function() {
            return t = n,
            Ad(e, r).map(function(e) {
                return e.fold(N(Pd, t), N(Od, t), N(Bd, t))
            });
            var t
        }, function(e) {
            return Fd(n, e)
        }).getOr(!1)
    }, Id = function(e, t) {
        return K(nd(t, e), Dr)
    }, Md = function(e, t) {
        return K(nd(t, e), function(e) {
            return "caption" === Rt(e)
        })
    }, Fd = function(e, t) {
        return Qf(t),
        e.selection.setCursorLocation(t.dom(), 0),
        R.some(!0)
    }, Ud = function(u, s, c, l, f) {
        return Xc(c, u.getBody(), f).bind(function(e) {
            return o = c,
            i = f,
            a = e,
            Zc((r = l).dom()).bind(function(t) {
                return el(r.dom()).map(function(e) {
                    return o ? i.isEqual(t) && a.isEqual(e) : i.isEqual(e) && a.isEqual(t)
                })
            }).getOr(!0) ? Fd(u, l) : (t = l,
            n = e,
            Md(s, Ne.fromDom(n.getNode())).map(function(e) {
                return !1 === at(e, t)
            }));
            var t, n, r, o, i, a
        }).or(R.some(!0))
    }, zd = function(o, i, a, e) {
        var u = ms.fromRangeStart(o.selection.getRng());
        return Id(a, e).bind(function(e) {
            return Gf(e) ? Fd(o, e) : (t = a,
            n = e,
            r = u,
            Xc(i, o.getBody(), r).bind(function(e) {
                return Id(t, Ne.fromDom(e.getNode())).map(function(e) {
                    return !1 === at(e, n)
                })
            }));
            var t, n, r
        }).getOr(!1)
    }, jd = function(e, t) {
        return (e ? jf : Hf)(t)
    }, Hd = function(a, u, r) {
        var s = Ne.fromDom(a.getBody());
        return Md(s, r).fold(function() {
            return zd(a, u, s, r) || (e = a,
            t = u,
            n = ms.fromRangeStart(e.selection.getRng()),
            jd(t, n) || Kc(t, e.getBody(), n).map(function(e) {
                return jd(t, e)
            }).getOr(!1));
            var e, t, n
        }, function(e) {
            return t = a,
            n = u,
            r = s,
            o = e,
            i = ms.fromRangeStart(t.selection.getRng()),
            (Gf(o) ? Fd(t, o) : Ud(t, r, n, o, i)).getOr(!1);
            var t, n, r, o, i
        })
    }, Vd = function(e, t) {
        var n, r, o, i, a, u = Ne.fromDom(e.selection.getStart(!0)), s = $l(e);
        return e.selection.isCollapsed() && 0 === s.length ? Hd(e, t, u) : (n = e,
        r = u,
        o = Ne.fromDom(n.getBody()),
        i = n.selection.getRng(),
        0 !== (a = $l(n)).length ? Od(n, a) : Ld(n, o, i, r))
    }, qd = function(a) {
        var u = ms.fromRangeStart(a)
          , s = ms.fromRangeEnd(a)
          , c = a.commonAncestorContainer;
        return Kc(!1, c, s).map(function(e) {
            return !bc(u, s, c) && bc(u, e, c) ? (t = u.container(),
            n = u.offset(),
            r = e.container(),
            o = e.offset(),
            (i = V.document.createRange()).setStart(t, n),
            i.setEnd(r, o),
            i) : a;
            var t, n, r, o, i
        }).getOr(a)
    }, $d = function(e) {
        return e.collapsed ? e : qd(e)
    }, Wd = function(e, t) {
        var n, r;
        return e.getBlockElements()[t.name] && ((r = t).firstChild && r.firstChild === r.lastChild) && ("br" === (n = t.firstChild).name || n.value === oo)
    }, Kd = function(e, t) {
        var n, r, o, i = t.firstChild, a = t.lastChild;
        return i && "meta" === i.name && (i = i.next),
        a && "mce_marker" === a.attr("id") && (a = a.prev),
        r = a,
        o = (n = e).getNonEmptyElements(),
        r && (r.isEmpty(o) || Wd(n, r)) && (a = a.prev),
        !(!i || i !== a) && ("ul" === i.name || "ol" === i.name)
    }, Xd = function(e) {
        return e && e.firstChild && e.firstChild === e.lastChild && ((t = e.firstChild).data === oo || rn(t));
        var t
    }, Yd = function(e) {
        return 0 < e.length && (!(t = e[e.length - 1]).firstChild || Xd(t)) ? e.slice(0, -1) : e;
        var t
    }, Gd = function(e, t) {
        var n = e.getParent(t, e.isBlock);
        return n && "LI" === n.nodeName ? n : null
    }, Jd = function(e, t) {
        var n = ms.after(e)
          , r = Hc(t).prev(n);
        return r ? r.toRange() : null
    }, Qd = function(t, e, n) {
        var r, o, i, a, u = t.parentNode;
        return hr.each(e, function(e) {
            u.insertBefore(e, t)
        }),
        r = t,
        o = n,
        i = ms.before(r),
        (a = Hc(o).next(i)) ? a.toRange() : null
    }, Zd = function(e, o, i, t) {
        var n, r, a, u, s, c, l, f, d, m, p, g, h, v, y, b, C, w, x, S, N = (n = o,
        r = t,
        c = e.serialize(r),
        l = n.createFragment(c),
        u = (a = l).firstChild,
        s = a.lastChild,
        u && "META" === u.nodeName && u.parentNode.removeChild(u),
        s && "mce_marker" === s.id && s.parentNode.removeChild(s),
        a), E = Gd(o, i.startContainer), k = Yd((f = N.firstChild,
        hr.grep(f.childNodes, function(e) {
            return "LI" === e.nodeName
        }))), _ = o.getRoot(), R = function(e) {
            var t = ms.fromRangeStart(i)
              , n = Hc(o.getRoot())
              , r = 1 === e ? n.prev(t) : n.next(t);
            return !r || Gd(o, r.getNode()) !== E
        };
        return R(1) ? Qd(E, k, _) : R(2) ? (d = E,
        m = k,
        p = _,
        o.insertAfter(m.reverse(), d),
        Jd(m[0], p)) : (h = k,
        v = _,
        y = g = E,
        C = (b = i).cloneRange(),
        w = b.cloneRange(),
        C.setStartBefore(y),
        w.setEndAfter(y),
        x = [C.cloneContents(), w.cloneContents()],
        (S = g.parentNode).insertBefore(x[0], g),
        hr.each(h, function(e) {
            S.insertBefore(e, g)
        }),
        S.insertBefore(x[1], g),
        S.removeChild(g),
        Jd(h[h.length - 1], v))
    }, em = Wt(["td", "th"]), tm = function(e, t) {
        var n, r, o = e.selection.getRng(), i = o.startContainer, a = o.startOffset;
        o.collapsed && (r = a,
        Zt(n = i) && n.nodeValue[r - 1] === oo) && Zt(i) && (i.insertData(a - 1, " "),
        i.deleteData(a, 1),
        o.setStart(i, a),
        o.setEnd(i, a),
        e.selection.setRng(o)),
        e.selection.setContent(t)
    }, nm = function(e) {
        var t = e.dom
          , n = $d(e.selection.getRng());
        e.selection.setRng(n);
        var r, o, i, a = t.getParent(n.startContainer, em);
        r = t,
        o = n,
        null !== (i = a) && i === r.getParent(o.endContainer, em) && Xl(Ne.fromDom(i), o) ? Bd(e, n, Ne.fromDom(a)) : e.getDoc().execCommand("Delete", !1, null)
    }, rm = function(e, t, n) {
        var r, o, i, a, u, s, c, l, f, d, m, p = e.selection, g = e.dom;
        if (/^ | $/.test(t) && (t = function(e, t) {
            var n, r;
            n = e.startContainer,
            r = e.startOffset;
            var o = function(e) {
                return n[e] && 3 === n[e].nodeType
            };
            return 3 === n.nodeType && (0 < r ? t = t.replace(/^&nbsp;/, " ") : o("previousSibling") || (t = t.replace(/^ /, "&nbsp;")),
            r < n.length ? t = t.replace(/&nbsp;(<br>|)$/, " ") : o("nextSibling") || (t = t.replace(/(&nbsp;| )(<br>|)$/, "&nbsp;"))),
            t
        }(p.getRng(), t)),
        r = e.parser,
        m = n.merge,
        o = hf({
            validate: e.settings.validate
        }, e.schema),
        d = '<span id="mce_marker" data-mce-type="bookmark">&#xFEFF;&#x200B;</span>',
        s = {
            content: t,
            format: "html",
            selection: !0,
            paste: n.paste
        },
        (s = e.fire("BeforeSetContent", s)).isDefaultPrevented())
            e.fire("SetContent", {
                content: s.content,
                format: "html",
                selection: !0,
                paste: n.paste
            });
        else {
            -1 === (t = s.content).indexOf("{$caret}") && (t += "{$caret}"),
            t = t.replace(/\{\$caret\}/, d);
            var h, v, y, b, C, w, x = (l = p.getRng()).startContainer || (l.parentElement ? l.parentElement() : null), S = e.getBody();
            x === S && p.isCollapsed() && g.isBlock(S.firstChild) && (h = e,
            (v = S.firstChild) && !h.schema.getShortEndedElements()[v.nodeName]) && g.isEmpty(S.firstChild) && ((l = g.createRng()).setStart(S.firstChild, 0),
            l.setEnd(S.firstChild, 0),
            p.setRng(l)),
            p.isCollapsed() || (nm(e),
            y = e.selection.getRng(),
            b = t,
            C = y.startContainer,
            w = y.startOffset,
            3 === C.nodeType && y.collapsed && (C.data[w] === oo ? (C.deleteData(w, 1),
            /[\u00a0| ]$/.test(b) || (b += " ")) : C.data[w - 1] === oo && (C.deleteData(w - 1, 1),
            /[\u00a0| ]$/.test(b) || (b = " " + b))),
            t = b);
            var N, E, k, _ = {
                context: (i = p.getNode()).nodeName.toLowerCase(),
                data: n.data,
                insert: !0
            };
            if (u = r.parse(t, _),
            !0 === n.paste && Kd(e.schema, u) && Gd(g, i))
                return l = Zd(o, g, e.selection.getRng(), u),
                e.selection.setRng(l),
                void e.fire("SetContent", s);
            if (!function(e) {
                for (var t = e; t = t.walk(); )
                    1 === t.type && t.attr("data-mce-fragment", "1")
            }(u),
            "mce_marker" === (f = u.lastChild).attr("id"))
                for (f = (c = f).prev; f; f = f.walk(!0))
                    if (3 === f.type || !g.isBlock(f.name)) {
                        e.schema.isValidChild(f.parent.name, "span") && f.parent.insert(c, f, "br" === f.name);
                        break
                    }
            if (e._selectionOverrides.showBlockCaretContainer(i),
            _.invalid) {
                for (tm(e, d),
                i = p.getNode(),
                a = e.getBody(),
                9 === i.nodeType ? i = f = a : f = i; f !== a; )
                    f = (i = f).parentNode;
                t = i === a ? a.innerHTML : g.getOuterHTML(i),
                t = o.serialize(r.parse(t.replace(/<span (id="mce_marker"|id=mce_marker).+?<\/span>/i, function() {
                    return o.serialize(u)
                }))),
                i === a ? g.setHTML(a, t) : g.setOuterHTML(i, t)
            } else
                !function(e, t, n) {
                    if ("all" === n.getAttribute("data-mce-bogus"))
                        n.parentNode.insertBefore(e.dom.createFragment(t), n);
                    else {
                        var r = n.firstChild
                          , o = n.lastChild;
                        !r || r === o && "BR" === r.nodeName ? e.dom.setHTML(n, t) : tm(e, t)
                    }
                }(e, t = o.serialize(u), i);
            !function(e, t) {
                var n = e.schema.getTextInlineElements()
                  , r = e.dom;
                if (t) {
                    var o = e.getBody()
                      , i = new Df(r);
                    hr.each(r.select("*[data-mce-fragment]"), function(e) {
                        for (var t = e.parentNode; t && t !== o; t = t.parentNode)
                            n[e.nodeName.toLowerCase()] && i.compare(t, e) && r.remove(e, !0)
                    })
                }
            }(e, m),
            function(n, e) {
                var t, r, o, i, a, u = n.dom, s = n.selection;
                if (e) {
                    if (n.selection.scrollIntoView(e),
                    t = function(e) {
                        for (var t = n.getBody(); e && e !== t; e = e.parentNode)
                            if ("false" === n.dom.getContentEditable(e))
                                return e;
                        return null
                    }(e))
                        return u.remove(e),
                        s.select(t);
                    var c = u.createRng();
                    (i = e.previousSibling) && 3 === i.nodeType ? (c.setStart(i, i.nodeValue.length),
                    rr.ie || (a = e.nextSibling) && 3 === a.nodeType && (i.appendData(a.data),
                    a.parentNode.removeChild(a))) : (c.setStartBefore(e),
                    c.setEndBefore(e));
                    r = u.getParent(e, u.isBlock),
                    u.remove(e),
                    r && u.isEmpty(r) && (n.$(r).empty(),
                    c.setStart(r, 0),
                    c.setEnd(r, 0),
                    em(r) || r.getAttribute("data-mce-fragment") || !(o = function(e) {
                        var t = ms.fromRangeStart(e);
                        if (t = Hc(n.getBody()).next(t))
                            return t.toRange()
                    }(c)) ? u.add(r, u.create("br", {
                        "data-mce-bogus": "1"
                    })) : (c = o,
                    u.remove(r))),
                    s.setRng(c)
                }
            }(e, g.get("mce_marker")),
            N = e.getBody(),
            hr.each(N.getElementsByTagName("*"), function(e) {
                e.removeAttribute("data-mce-fragment")
            }),
            E = e.dom,
            k = e.selection.getStart(),
            R.from(E.getParent(k, "td,th")).map(Ne.fromDom).each(Zf),
            e.fire("SetContent", s),
            e.addVisual()
        }
    }, om = function(e) {
        var t = ct(e).dom();
        return e.dom() === t.activeElement
    }, im = function(e) {
        var t = e !== undefined ? e.dom() : V.document;
        return R.from(t.activeElement).map(Ne.fromDom)
    }, am = function(e, t, n, r) {
        return {
            start: x(e),
            soffset: x(t),
            finish: x(n),
            foffset: x(r)
        }
    }, um = hd([{
        before: ["element"]
    }, {
        on: ["element", "offset"]
    }, {
        after: ["element"]
    }]), sm = (um.before,
    um.on,
    um.after,
    function(e) {
        return e.fold(d, d, d)
    }
    ), cm = hd([{
        domRange: ["rng"]
    }, {
        relative: ["startSitu", "finishSitu"]
    }, {
        exact: ["start", "soffset", "finish", "foffset"]
    }]), lm = {
        domRange: cm.domRange,
        relative: cm.relative,
        exact: cm.exact,
        exactFromRange: function(e) {
            return cm.exact(e.start(), e.soffset(), e.finish(), e.foffset())
        },
        getWin: function(e) {
            var t = e.match({
                domRange: function(e) {
                    return Ne.fromDom(e.startContainer)
                },
                relative: function(e, t) {
                    return sm(e)
                },
                exact: function(e, t, n, r) {
                    return e
                }
            });
            return lt(t)
        },
        range: am
    }, fm = nt().browser, dm = function(e, t) {
        var n = Ot(t) ? ef(t).length : ht(t).length + 1;
        return n < e ? n : e < 0 ? 0 : e
    }, mm = function(e) {
        return lm.range(e.start(), dm(e.soffset(), e.start()), e.finish(), dm(e.foffset(), e.finish()))
    }, pm = function(e, t) {
        return !qt(t.dom()) && (st(e, t) || at(e, t))
    }, gm = function(t) {
        return function(e) {
            return pm(t, e.start()) && pm(t, e.finish())
        }
    }, hm = function(e) {
        return !0 === e.inline || fm.isIE()
    }, vm = function(e) {
        return lm.range(Ne.fromDom(e.startContainer), e.startOffset, Ne.fromDom(e.endContainer), e.endOffset)
    }, ym = function(e) {
        var t, n, r = lt(e);
        return t = r.dom(),
        ((n = t.getSelection()) && 0 !== n.rangeCount ? R.from(n.getRangeAt(0)) : R.none()).map(vm).filter(gm(e))
    }, bm = function(e) {
        var t = V.document.createRange();
        try {
            return t.setStart(e.start().dom(), e.soffset()),
            t.setEnd(e.finish().dom(), e.foffset()),
            R.some(t)
        } catch (n) {
            return R.none()
        }
    }, Cm = function(e) {
        var t = hm(e) ? ym(Ne.fromDom(e.getBody())) : R.none();
        e.bookmark = t.isSome() ? t : e.bookmark
    }, wm = function(r) {
        return (r.bookmark ? r.bookmark : R.none()).bind(function(e) {
            return t = Ne.fromDom(r.getBody()),
            n = e,
            R.from(n).filter(gm(t)).map(mm);
            var t, n
        }).bind(bm)
    }, xm = {
        isEditorUIElement: function(e) {
            var t = e.className.toString();
            return -1 !== t.indexOf("tox-") || -1 !== t.indexOf("mce-")
        }
    }, Sm = function(n, e) {
        var t, r;
        nt().browser.isIE() ? (r = n).on("focusout", function() {
            Cm(r)
        }) : (t = e,
        n.on("mouseup touchend", function(e) {
            t.throttle()
        })),
        n.on("keyup NodeChange", function(e) {
            var t;
            "nodechange" === (t = e).type && t.selectionChange || Cm(n)
        })
    }, Nm = function(r) {
        var o = Ta(function() {
            Cm(r)
        }, 0);
        r.on("init", function() {
            var e, t, n;
            r.inline && (e = r,
            t = o,
            n = function() {
                t.throttle()
            }
            ,
            ga.DOM.bind(V.document, "mouseup", n),
            e.on("remove", function() {
                ga.DOM.unbind(V.document, "mouseup", n)
            })),
            Sm(r, o)
        }),
        r.on("remove", function() {
            o.cancel()
        })
    }, Em = ga.DOM, km = function(t, e) {
        var n = t ? t.settings.custom_ui_selector : "";
        return null !== Em.getParent(e, function(e) {
            return xm.isEditorUIElement(e) || !!n && t.dom.is(e, n)
        })
    }, _m = function(r, e) {
        var t = e.editor;
        Nm(t),
        t.on("focusin", function() {
            var e = r.focusedEditor;
            e !== this && (e && e.fire("blur", {
                focusedEditor: this
            }),
            r.setActive(this),
            (r.focusedEditor = this).fire("focus", {
                blurredEditor: e
            }),
            this.focus(!0))
        }),
        t.on("focusout", function() {
            var t = this;
            Xn.setEditorTimeout(t, function() {
                var e = r.focusedEditor;
                km(t, function() {
                    try {
                        return V.document.activeElement
                    } catch (e) {
                        return V.document.body
                    }
                }()) || e !== t || (t.fire("blur", {
                    focusedEditor: null
                }),
                r.focusedEditor = null)
            })
        }),
        Sf || (Sf = function(e) {
            var t, n = r.activeEditor;
            t = e.target,
            n && t.ownerDocument === V.document && (t === V.document.body || km(n, t) || r.focusedEditor !== n || (n.fire("blur", {
                focusedEditor: null
            }),
            r.focusedEditor = null))
        }
        ,
        Em.bind(V.document, "focusin", Sf))
    }, Rm = function(e, t) {
        e.focusedEditor === t.editor && (e.focusedEditor = null),
        e.activeEditor || (Em.unbind(V.document, "focusin", Sf),
        Sf = null)
    }, Tm = function(t, e) {
        return ((n = e).collapsed ? R.from(Hu(n.startContainer, n.startOffset)).map(Ne.fromDom) : R.none()).bind(function(e) {
            return Ar(e) ? R.some(e) : !1 === st(t, e) ? R.some(t) : R.none()
        });
        var n
    }, Am = function(t, e) {
        Tm(Ne.fromDom(t.getBody()), e).bind(function(e) {
            return Zc(e.dom())
        }).fold(function() {
            t.selection.normalize()
        }, function(e) {
            return t.selection.setRng(e.toRange())
        })
    }, Dm = function(e) {
        if (e.setActive)
            try {
                e.setActive()
            } catch (t) {
                e.focus()
            }
        else
            e.focus()
    }, Om = function(e) {
        return om(e) || im(ct(t = e)).filter(function(e) {
            return t.dom().contains(e.dom())
        }).isSome();
        var t
    }, Bm = function(r) {
        return im().filter(function(e) {
            return t = e.dom(),
            !((n = t.classList) !== undefined && (n.contains("tox-edit-area") || n.contains("tox-edit-area__iframe") || n.contains("mce-content-body"))) && km(r, e.dom());
            var t, n
        }).isSome()
    }, Pm = function(e) {
        return e.inline ? (n = e.getBody()) && Om(Ne.fromDom(n)) : (t = e).iframeElement && om(Ne.fromDom(t.iframeElement));
        var t, n
    }, Lm = function(t) {
        var e = t.selection
          , n = t.getBody()
          , r = e.getRng();
        t.quirks.refreshContentEditable(),
        t.bookmark !== undefined && !1 === Pm(t) && wm(t).each(function(e) {
            t.selection.setRng(e),
            r = e
        });
        var o, i, a = (o = t,
        i = e.getNode(),
        o.dom.getParent(i, function(e) {
            return "true" === o.dom.getContentEditable(e)
        }));
        if (t.$.contains(n, a))
            return Dm(a),
            Am(t, r),
            void Im(t);
        t.inline || (rr.opera || Dm(n),
        t.getWin().focus()),
        (rr.gecko || t.inline) && (Dm(n),
        Am(t, r)),
        Im(t)
    }, Im = function(e) {
        return e.editorManager.setActive(e)
    }, Mm = function(e, t) {
        t(e),
        e.firstChild && Mm(e.firstChild, t),
        e.next && Mm(e.next, t)
    }, Fm = function(e, t, n) {
        var r = function(e, n, t) {
            var r = {}
              , o = {}
              , i = [];
            for (var a in t.firstChild && Mm(t.firstChild, function(t) {
                z(e, function(e) {
                    e.name === t.name && (r[e.name] ? r[e.name].nodes.push(t) : r[e.name] = {
                        filter: e,
                        nodes: [t]
                    })
                }),
                z(n, function(e) {
                    "string" == typeof t.attr(e.name) && (o[e.name] ? o[e.name].nodes.push(t) : o[e.name] = {
                        filter: e,
                        nodes: [t]
                    })
                })
            }),
            r)
                r.hasOwnProperty(a) && i.push(r[a]);
            for (var u in o)
                o.hasOwnProperty(u) && i.push(o[u]);
            return i
        }(e, t, n);
        z(r, function(t) {
            z(t.filter.callbacks, function(e) {
                e(t.nodes, t.filter.name, {})
            })
        })
    }, Um = function(e) {
        return e instanceof df
    }, zm = function(e, t) {
        var r;
        e.dom.setHTML(e.getBody(), t),
        Pm(r = e) && Zc(r.getBody()).each(function(e) {
            var t = e.getNode()
              , n = Gt(t) ? Zc(t).getOr(e) : e;
            r.selection.setRng(n.toRange())
        })
    }, jm = function(u, s, c) {
        return c.format = c.format ? c.format : "html",
        c.set = !0,
        c.content = Um(s) ? "" : s,
        Um(s) || c.no_events || (u.fire("BeforeSetContent", c),
        s = c.content),
        R.from(u.getBody()).fold(x(s), function(e) {
            return Um(s) ? function(e, t, n, r) {
                Fm(e.parser.getNodeFilters(), e.parser.getAttributeFilters(), n);
                var o = hf({
                    validate: e.validate
                }, e.schema).serialize(n);
                return r.content = Or(Ne.fromDom(t)) ? o : hr.trim(o),
                zm(e, r.content),
                r.no_events || e.fire("SetContent", r),
                n
            }(u, e, s, c) : (t = u,
            n = e,
            o = c,
            0 === (r = s).length || /^\s+$/.test(r) ? (a = '<br data-mce-bogus="1">',
            "TABLE" === n.nodeName ? r = "<tr><td>" + a + "</td></tr>" : /^(UL|OL)$/.test(n.nodeName) && (r = "<li>" + a + "</li>"),
            r = (i = Hs(t)) && t.schema.isValidChild(n.nodeName.toLowerCase(), i.toLowerCase()) ? (r = a,
            t.dom.createHTML(i, t.settings.forced_root_block_attrs, r)) : r || '<br data-mce-bogus="1">',
            zm(t, r),
            t.fire("SetContent", o)) : ("raw" !== o.format && (r = hf({
                validate: t.validate
            }, t.schema).serialize(t.parser.parse(r, {
                isRootContent: !0,
                insert: !0
            }))),
            o.content = Or(Ne.fromDom(n)) ? r : hr.trim(r),
            zm(t, o.content),
            o.no_events || t.fire("SetContent", o)),
            o.content);
            var t, n, r, o, i, a
        })
    }, Hm = function(e, t) {
        return e.splitText(t)
    }, Vm = function(e) {
        var t = e.startContainer
          , n = e.startOffset
          , r = e.endContainer
          , o = e.endOffset;
        return t === r && Zt(t) ? 0 < n && n < t.nodeValue.length && (t = (r = Hm(t, n)).previousSibling,
        n < o ? (t = r = Hm(r, o -= n).previousSibling,
        o = r.nodeValue.length,
        n = 0) : o = 0) : (Zt(t) && 0 < n && n < t.nodeValue.length && (t = Hm(t, n),
        n = 0),
        Zt(r) && 0 < o && o < r.nodeValue.length && (o = (r = Hm(r, o).previousSibling).nodeValue.length)),
        {
            startContainer: t,
            startOffset: n,
            endContainer: r,
            endOffset: o
        }
    }, qm = wl, $m = function(e, t, n) {
        var r = e.formatter.get(n);
        if (r)
            for (var o = 0; o < r.length; o++)
                if (!1 === r[o].inherit && e.dom.is(t, r[o].selector))
                    return !0;
        return !1
    }, Wm = function(t, e, n, r) {
        var o = t.dom.getRoot();
        return e !== o && (e = t.dom.getParent(e, function(e) {
            return !!$m(t, e, n) || (e.parentNode === o || !!Ym(t, e, n, r, !0))
        }),
        Ym(t, e, n, r))
    }, Km = function(e, t, n) {
        return !!qm(t, n.inline) || (!!qm(t, n.block) || (n.selector ? 1 === t.nodeType && e.is(t, n.selector) : void 0))
    }, Xm = function(e, t, n, r, o, i) {
        var a, u, s, c = n[r];
        if (n.onmatch)
            return n.onmatch(t, n, r);
        if (c)
            if ("undefined" == typeof c.length) {
                for (a in c)
                    if (c.hasOwnProperty(a)) {
                        if (u = "attributes" === r ? e.getAttrib(t, a) : Sl(e, t, a),
                        o && !u && !n.exact)
                            return;
                        if ((!o || n.exact) && !qm(u, xl(e, Cl(c[a], i), a)))
                            return
                    }
            } else
                for (s = 0; s < c.length; s++)
                    if ("attributes" === r ? e.getAttrib(t, c[s]) : Sl(e, t, c[s]))
                        return n;
        return n
    }, Ym = function(e, t, n, r, o) {
        var i, a, u, s, c = e.formatter.get(n), l = e.dom;
        if (c && t)
            for (a = 0; a < c.length; a++)
                if (i = c[a],
                Km(e.dom, t, i) && Xm(l, t, i, "attributes", o, r) && Xm(l, t, i, "styles", o, r)) {
                    if (s = i.classes)
                        for (u = 0; u < s.length; u++)
                            if (!e.dom.hasClass(t, s[u]))
                                return;
                    return i
                }
    }, Gm = function(e, t, n, r) {
        var o;
        return r ? Wm(e, r, t, n) : (r = e.selection.getNode(),
        !!Wm(e, r, t, n) || !((o = e.selection.getStart()) === r || !Wm(e, o, t, n)))
    }, Jm = function(r, o, i) {
        var a = []
          , u = {}
          , e = r.selection.getStart();
        return r.dom.getParent(e, function(e) {
            for (var t = 0; t < o.length; t++) {
                var n = o[t];
                !u[n] && Ym(r, e, n, i) && (u[n] = !0,
                a.push(n))
            }
        }, r.dom.getRoot()),
        a
    }, Qm = function(e, t) {
        var n, r, o, i, a, u = e.formatter.get(t), s = e.dom;
        if (u)
            for (n = e.selection.getStart(),
            r = El(s, n),
            i = u.length - 1; 0 <= i; i--) {
                if (!(a = u[i].selector) || u[i].defaultBlock)
                    return !0;
                for (o = r.length - 1; 0 <= o; o--)
                    if (s.is(r[o], a))
                        return !0
            }
        return !1
    }, Zm = function(o, i, e) {
        return W(e, function(e, t) {
            var n, r = (n = t,
            F(o.formatter.get(n), function(t) {
                var n = function(e) {
                    return 1 < e.length && "%" === e.charAt(0)
                };
                return F(["styles", "attributes"], function(e) {
                    return de(t, e).exists(function(e) {
                        var t = k(e) ? e : fe(e);
                        return F(t, n)
                    })
                })
            }));
            return o.formatter.matchNode(i, t, {}, r) ? e.concat([t]) : e
        }, [])
    }, ep = su, tp = "_mce_caret", np = function(e) {
        return 0 < function(e) {
            for (var t = []; e; ) {
                if (3 === e.nodeType && e.nodeValue !== ep || 1 < e.childNodes.length)
                    return [];
                1 === e.nodeType && t.push(e),
                e = e.firstChild
            }
            return t
        }(e).length
    }, rp = function(e) {
        if (e) {
            var t = new ra(e,e);
            for (e = t.current(); e; e = t.next())
                if (Zt(e))
                    return e
        }
        return null
    }, op = function(e) {
        var t = Ne.fromTag("span");
        return ln(t, {
            id: tp,
            "data-mce-bogus": "1",
            "data-mce-type": "format-caret"
        }),
        e && St(t, Ne.fromText(ep)),
        t
    }, ip = function(e, t, n) {
        void 0 === n && (n = !0);
        var r, o = e.dom, i = e.selection;
        if (np(t))
            gd(e, !1, Ne.fromDom(t), n);
        else {
            var a = i.getRng()
              , u = o.getParent(t, o.isBlock)
              , s = a.startContainer
              , c = a.startOffset
              , l = a.endContainer
              , f = a.endOffset
              , d = ((r = rp(t)) && r.nodeValue.charAt(0) === ep && r.deleteData(0, 1),
            r);
            o.remove(t, !0),
            s === d && 0 < c && a.setStart(d, c - 1),
            l === d && 0 < f && a.setEnd(d, f - 1),
            u && o.isEmpty(u) && Qf(Ne.fromDom(u)),
            i.setRng(a)
        }
    }, ap = function(e, t, n) {
        void 0 === n && (n = !0);
        var r = e.dom
          , o = e.selection;
        if (t)
            ip(e, t, n);
        else if (!(t = Fs(e.getBody(), o.getStart())))
            for (; t = r.get(tp); )
                ip(e, t, !1)
    }, up = function(e, t) {
        return e.appendChild(t),
        t
    }, sp = function(e, t) {
        var n = $(e, function(e, t) {
            return up(e, t.cloneNode(!1))
        }, t);
        return up(n, n.ownerDocument.createTextNode(ep))
    }, cp = function(e, t, n, r) {
        var o, i, a, u, s, c, l, f, d = e.dom, m = e.selection, p = [], g = m.getRng(), h = g.startContainer, v = g.startOffset;
        for (3 === (i = h).nodeType && (v !== h.nodeValue.length && (o = !0),
        i = i.parentNode); i; ) {
            if (Ym(e, i, t, n, r)) {
                a = i;
                break
            }
            i.nextSibling && (o = !0),
            p.push(i),
            i = i.parentNode
        }
        if (a)
            if (o) {
                var y = m.getBookmark();
                g.collapse(!0);
                var b = Ul(e, g, e.formatter.get(t), !0);
                b = Vm(b),
                e.formatter.remove(t, n, b, r),
                m.moveToBookmark(y)
            } else {
                var C = Fs(e.getBody(), a)
                  , w = op(!1).dom();
                s = w,
                c = null !== C ? C : a,
                l = (u = e).dom,
                (f = l.getParent(c, N(vl, u))) && l.isEmpty(f) ? c.parentNode.replaceChild(s, c) : (Jf(Ne.fromDom(c)),
                l.isEmpty(c) ? c.parentNode.replaceChild(s, c) : l.insertAfter(s, c));
                var x = function(t, e, n, r, o, i) {
                    var a = t.formatter
                      , u = t.dom
                      , s = H(ne(a.get()), function(e) {
                        return "removeformat" !== e && e !== r
                    })
                      , c = Zm(t, n, s);
                    if (0 < H(c, function(e) {
                        return !kl(t, e, r)
                    }).length) {
                        var l = n.cloneNode(!1);
                        return u.add(e, l),
                        a.remove(r, o, l, i),
                        u.remove(l),
                        R.some(l)
                    }
                    return R.none()
                }(e, w, a, t, n, r)
                  , S = sp(p.concat(x.toArray()), w);
                ip(e, C, !1),
                m.setCursorLocation(S, 1),
                d.isEmpty(a) && d.remove(a)
            }
    }, lp = function(i) {
        i.on("mouseup keydown", function(e) {
            var t, n, r, o;
            t = i,
            n = e.keyCode,
            r = t.selection,
            o = t.getBody(),
            ap(t, null, !1),
            8 !== n && 46 !== n || !r.isCollapsed() || r.getStart().innerHTML !== ep || ap(t, Fs(o, r.getStart())),
            37 !== n && 39 !== n || ap(t, Fs(o, r.getStart()))
        })
    }, fp = function(e, t) {
        return e.schema.getTextInlineElements().hasOwnProperty(Rt(t)) && !Ms(t.dom()) && !Yt(t.dom())
    }, dp = {}, mp = ur, pp = ir;
    Ef = function(e) {
        var t, n, r = e.selection.getRng();
        t = Wt(["pre"]),
        r.collapsed || (n = e.selection.getSelectedBlocks(),
        pp(mp(mp(n, t), function(e) {
            return t(e.previousSibling) && -1 !== sr(n, e.previousSibling)
        }), function(e) {
            var t, n;
            t = e.previousSibling,
            na(n = e).remove(),
            na(t).append("<br><br>").append(n.childNodes)
        }))
    }
    ,
    dp[Nf = "pre"] || (dp[Nf] = []),
    dp[Nf].push(Ef);
    var gp, hp, vp = /^(src|href|style)$/, yp = hr.each, bp = wl, Cp = function(e, t, n) {
        return e.isChildOf(t, n) && t !== n && !e.isBlock(n)
    }, wp = function(e, t, n) {
        var r, o;
        if (r = t[n ? "startContainer" : "endContainer"],
        o = t[n ? "startOffset" : "endOffset"],
        $t(r)) {
            var i = r.childNodes.length - 1;
            !n && o && o--,
            r = r.childNodes[i < o ? i : o]
        }
        return Zt(r) && n && o >= r.nodeValue.length && (r = new ra(r,e.getBody()).next() || r),
        Zt(r) && !n && 0 === o && (r = new ra(r,e.getBody()).prev() || r),
        r
    }, xp = function(e, t, n, r) {
        var o = e.create(n, r);
        return t.parentNode.insertBefore(o, t),
        o.appendChild(t),
        o
    }, Sp = function(e, t, n, r, o) {
        var i = Ne.fromDom(t)
          , a = Ne.fromDom(e.create(r, o))
          , u = (n ? gt : pt)(i);
        return Nt(a, u),
        n ? (Ct(i, a),
        xt(a, i)) : (wt(i, a),
        St(a, i)),
        a.dom()
    }, Np = function(e, t, n, r) {
        return !(t = hl(t, n, r)) || "BR" === t.nodeName || e.isBlock(t)
    }, Ep = function(e, r, o, t, i) {
        var n, a, u, s, c, l = e.dom;
        if (u = l,
        !(bp(s = t, (c = r).inline) || bp(s, c.block) || c.selector && ($t(s) && u.is(s, c.selector)) || (a = t,
        r.links && "A" === a.nodeName)))
            return !1;
        var f, d, m, p, g, h, v, y = t;
        if (r.inline && "all" === r.remove && k(r.preserve_attributes)) {
            var b = H(l.getAttribs(y), function(e) {
                return M(r.preserve_attributes, e.name.toLowerCase())
            });
            if (l.removeAllAttribs(y),
            z(b, function(e) {
                return l.setAttrib(y, e.name, e.value)
            }),
            0 < b.length)
                return e.dom.rename(t, "span"),
                !0
        }
        if ("all" !== r.remove) {
            yp(r.styles, function(e, t) {
                e = xl(l, Cl(e, o), t),
                "number" == typeof t && (t = e,
                i = null),
                !r.remove_similar && i && !bp(Sl(l, i, t), e) || l.setStyle(y, t, ""),
                n = !0
            }),
            n && "" === l.getAttrib(y, "style") && (y.removeAttribute("style"),
            y.removeAttribute("data-mce-style")),
            yp(r.attributes, function(e, t) {
                var n;
                if (e = Cl(e, o),
                "number" == typeof t && (t = e,
                i = null),
                r.remove_similar || !i || bp(l.getAttrib(i, t), e)) {
                    if ("class" === t && (e = l.getAttrib(y, t)) && (n = "",
                    z(e.split(/\s+/), function(e) {
                        /mce\-\w+/.test(e) && (n += (n ? " " : "") + e)
                    }),
                    n))
                        return void l.setAttrib(y, t, n);
                    "class" === t && y.removeAttribute("className"),
                    vp.test(t) && y.removeAttribute("data-mce-" + t),
                    y.removeAttribute(t)
                }
            }),
            yp(r.classes, function(e) {
                e = Cl(e, o),
                i && !l.hasClass(i, e) || l.removeClass(y, e)
            });
            for (var C = l.getAttribs(y), w = 0; w < C.length; w++) {
                var x = C[w].nodeName;
                if (0 !== x.indexOf("_") && 0 !== x.indexOf("data-"))
                    return !1
            }
        }
        return "none" !== r.remove ? (f = e,
        m = r,
        g = (d = y).parentNode,
        h = f.dom,
        v = Hs(f),
        m.block && (v ? g === h.getRoot() && (m.list_block && bp(d, m.list_block) || z(te(d.childNodes), function(e) {
            yl(f, v, e.nodeName.toLowerCase()) ? p ? p.appendChild(e) : (p = xp(h, e, v),
            h.setAttribs(p, f.settings.forced_root_block_attrs)) : p = 0
        })) : h.isBlock(d) && !h.isBlock(g) && (Np(h, d, !1) || Np(h, d.firstChild, !0, !0) || d.insertBefore(h.create("br"), d.firstChild),
        Np(h, d, !0) || Np(h, d.lastChild, !1, !0) || d.appendChild(h.create("br")))),
        m.selector && m.inline && !bp(m.inline, d) || h.remove(d, !0),
        !0) : void 0
    }, kp = function(s, c, l, e, f) {
        var d = s.formatter.get(c)
          , m = d[0]
          , i = !0
          , u = s.dom
          , t = s.selection
          , p = function(e) {
            var n, t, r, o, i, a, u = (t = e,
            r = c,
            o = l,
            i = f,
            z(El((n = s).dom, t.parentNode).reverse(), function(e) {
                if (!a && "_start" !== e.id && "_end" !== e.id) {
                    var t = Ym(n, e, r, o, i);
                    t && !1 !== t.split && (a = e)
                }
            }),
            a);
            return function(e, t, n, r, o, i, a, u) {
                var s, c, l, f = e.dom;
                if (n) {
                    for (var d = n.parentNode, m = r.parentNode; m && m !== d; m = m.parentNode) {
                        s = f.clone(m, !1);
                        for (var p = 0; p < t.length; p++)
                            if (Ep(e, t[p], u, s, s)) {
                                s = 0;
                                break
                            }
                        s && (c && s.appendChild(c),
                        l = l || s,
                        c = s)
                    }
                    !i || a.mixed && f.isBlock(n) || (r = f.split(n, r)),
                    c && (o.parentNode.insertBefore(c, o),
                    l.appendChild(o))
                }
                return r
            }(s, d, u, e, e, !0, m, l)
        }
          , g = function(e) {
            var t, n, r;
            if ($t(e) && u.getContentEditable(e) && (n = i,
            i = "true" === u.getContentEditable(e),
            r = !0),
            t = te(e.childNodes),
            i && !r)
                for (var o = 0; o < d.length && !Ep(s, d[o], l, e, e); o++)
                    ;
            if (m.deep && t.length) {
                for (o = 0; o < t.length; o++)
                    g(t[o]);
                r && (i = n)
            }
        }
          , h = function(e) {
            var t, n = u.get(e ? "_start" : "_end"), r = n[e ? "firstChild" : "lastChild"];
            return ll(t = r) && $t(t) && ("_start" === t.id || "_end" === t.id) && (r = r[e ? "firstChild" : "lastChild"]),
            Zt(r) && 0 === r.data.length && (r = e ? n.previousSibling || n.nextSibling : n.nextSibling || n.previousSibling),
            u.remove(n, !0),
            r
        }
          , n = function(e) {
            var t, n, r = e.commonAncestorContainer, o = Ul(s, e, d, !0);
            if (m.split) {
                if (o = Vm(o),
                (t = wp(s, o, !0)) !== (n = wp(s, o))) {
                    if (/^(TR|TH|TD)$/.test(t.nodeName) && t.firstChild && (t = "TR" === t.nodeName ? t.firstChild.firstChild || t : t.firstChild || t),
                    r && /^T(HEAD|BODY|FOOT|R)$/.test(r.nodeName) && /^(TH|TD)$/.test(n.nodeName) && n.firstChild && (n = n.firstChild || n),
                    Cp(u, t, n)) {
                        var i = R.from(t.firstChild).getOr(t);
                        return p(Sp(u, i, !0, "span", {
                            id: "_start",
                            "data-mce-type": "bookmark"
                        })),
                        void h(!0)
                    }
                    if (Cp(u, n, t)) {
                        i = R.from(n.lastChild).getOr(n);
                        return p(Sp(u, i, !1, "span", {
                            id: "_end",
                            "data-mce-type": "bookmark"
                        })),
                        void h(!1)
                    }
                    t = xp(u, t, "span", {
                        id: "_start",
                        "data-mce-type": "bookmark"
                    }),
                    n = xp(u, n, "span", {
                        id: "_end",
                        "data-mce-type": "bookmark"
                    });
                    var a = u.createRng();
                    a.setStartAfter(t),
                    a.setEndBefore(n),
                    jl(u, a, function(e) {
                        z(e, function(e) {
                            ll(e) || ll(e.parentNode) || p(e)
                        })
                    }),
                    p(t),
                    p(n),
                    t = h(!0),
                    n = h()
                } else
                    t = n = p(t);
                o.startContainer = t.parentNode ? t.parentNode : t,
                o.startOffset = u.nodeIndex(t),
                o.endContainer = n.parentNode ? n.parentNode : n,
                o.endOffset = u.nodeIndex(n) + 1
            }
            jl(u, o, function(e) {
                z(e, function(t) {
                    g(t);
                    z(["underline", "line-through", "overline"], function(e) {
                        $t(t) && s.dom.getStyle(t, "text-decoration") === e && t.parentNode && Nl(u, t.parentNode) === e && Ep(s, {
                            deep: !1,
                            exact: !0,
                            inline: "span",
                            styles: {
                                textDecoration: e
                            }
                        }, null, t)
                    })
                })
            })
        };
        if (e)
            if (pl(e)) {
                var r = u.createRng();
                r.setStartBefore(e),
                r.setEndAfter(e),
                n(r)
            } else
                n(e);
        else if ("false" !== u.getContentEditable(t.getNode()))
            t.isCollapsed() && m.inline && !$l(s).length ? cp(s, c, l, f) : (Ql(t, !0, function() {
                Jl(s, n)
            }),
            m.inline && Gm(s, c, l, t.getStart()) && gl(u, t, t.getRng()),
            s.nodeChanged());
        else {
            e = t.getNode();
            for (var o = 0; o < d.length && (!d[o].ceFalseOverride || !Ep(s, d[o], l, e, e)); o++)
                ;
        }
    }, _p = hr.each, Rp = function(e) {
        return $t(e) && !ll(e) && !Ms(e) && !Yt(e)
    }, Tp = function(e, t) {
        var n;
        for (n = e; n; n = n[t]) {
            if (Zt(n) && 0 !== n.nodeValue.length)
                return e;
            if ($t(n) && !ll(n))
                return n
        }
        return e
    }, Ap = function(e, t, n) {
        var r, o, i = new Df(e);
        if (t && n && (t = Tp(t, "previousSibling"),
        n = Tp(n, "nextSibling"),
        i.compare(t, n))) {
            for (r = t.nextSibling; r && r !== n; )
                r = (o = r).nextSibling,
                t.appendChild(o);
            return e.remove(n),
            hr.each(hr.grep(n.childNodes), function(e) {
                t.appendChild(e)
            }),
            t
        }
        return n
    }, Dp = function(e, t, n) {
        _p(e.childNodes, function(e) {
            Rp(e) && (t(e) && n(e),
            e.hasChildNodes() && Dp(e, t, n))
        })
    }, Op = function(t, n) {
        return function(e) {
            return !(!e || !Sl(t, e, n))
        }
    }, Bp = function(t, n, r) {
        return function(e) {
            t.setStyle(e, n, r),
            "" === e.getAttribute("style") && e.removeAttribute("style"),
            Pp(t, e)
        }
    }, Pp = function(e, t) {
        "SPAN" === t.nodeName && 0 === e.getAttribs(t).length && e.remove(t, !0)
    }, Lp = function(n, e, r, o) {
        _p(e, function(t) {
            _p(n.dom.select(t.inline, o), function(e) {
                Rp(e) && Ep(n, t, r, e, t.exact ? e : null)
            }),
            function(r, e, t) {
                if (e.clear_child_styles) {
                    var n = e.links ? "*:not(a)" : "*";
                    _p(r.select(n, t), function(n) {
                        Rp(n) && _p(e.styles, function(e, t) {
                            r.setStyle(n, t, "")
                        })
                    })
                }
            }(n.dom, t, o)
        })
    }, Ip = hr.each, Mp = function(R, T, A, r) {
        var e, D = R.formatter.get(T), O = D[0], o = !r && R.selection.isCollapsed(), i = R.dom, t = R.selection, B = function(n, e) {
            if (e = e || O,
            n) {
                if (e.onformat && e.onformat(n, e, A, r),
                Ip(e.styles, function(e, t) {
                    i.setStyle(n, t, Cl(e, A))
                }),
                e.styles) {
                    var t = i.getAttrib(n, "style");
                    t && i.setAttrib(n, "data-mce-style", t)
                }
                Ip(e.attributes, function(e, t) {
                    i.setAttrib(n, t, Cl(e, A))
                }),
                Ip(e.classes, function(e) {
                    e = Cl(e, A),
                    i.hasClass(n, e) || i.addClass(n, e)
                })
            }
        }, d = function(e, t) {
            var n = !1;
            return !!O.selector && (Ip(e, function(e) {
                if (!("collapsed"in e && e.collapsed !== o))
                    return i.is(t, e.selector) && !Ms(t) ? (B(t, e),
                    !(n = !0)) : void 0
            }),
            n)
        }, a = function(k, e, t, s) {
            var c, l, _ = [], f = !0;
            c = O.inline || O.block,
            l = k.create(c),
            B(l),
            jl(k, e, function(e) {
                var a, u = function(e) {
                    var t = !1
                      , n = f
                      , r = e.nodeName.toLowerCase()
                      , o = e.parentNode.nodeName.toLowerCase();
                    if ($t(e) && k.getContentEditable(e) && (n = f,
                    f = "true" === k.getContentEditable(e),
                    t = !0),
                    wl(r, "br"))
                        return a = 0,
                        void (O.block && k.remove(e));
                    if (O.wrapper && Ym(R, e, T, A))
                        a = 0;
                    else {
                        if (f && !t && O.block && !O.wrapper && vl(R, r) && yl(R, o, c))
                            return e = k.rename(e, c),
                            B(e),
                            _.push(e),
                            void (a = 0);
                        if (O.selector) {
                            var i = d(D, e);
                            if (!O.inline || i)
                                return void (a = 0)
                        }
                        !f || t || !yl(R, c, r) || !yl(R, o, c) || !s && 3 === e.nodeType && 1 === e.nodeValue.length && 65279 === e.nodeValue.charCodeAt(0) || Ms(e) || O.inline && k.isBlock(e) ? (a = 0,
                        Ip(hr.grep(e.childNodes), u),
                        t && (f = n),
                        a = 0) : (a || (a = k.clone(l, !1),
                        e.parentNode.insertBefore(a, e),
                        _.push(a)),
                        a.appendChild(e))
                    }
                };
                Ip(e, u)
            }),
            !0 === O.links && Ip(_, function(e) {
                var t = function(e) {
                    "A" === e.nodeName && B(e, O),
                    Ip(hr.grep(e.childNodes), t)
                };
                t(e)
            }),
            Ip(_, function(e) {
                var t, n, r, o, i, a, u, s, c, l, f, d, m, p, g, h, v, y, b, C, w, x, S, N, E = function(e) {
                    var n = !1;
                    return Ip(e.childNodes, function(e) {
                        if ((t = e) && 1 === t.nodeType && !ll(t) && !Ms(t) && !Yt(t))
                            return n = e,
                            !1;
                        var t
                    }),
                    n
                };
                (n = 0,
                Ip(e.childNodes, function(e) {
                    var t;
                    (t = e) && Zt(t) && 0 === t.length || ll(e) || n++
                }),
                t = n,
                !(1 < _.length) && k.isBlock(e) || 0 !== t) ? (O.inline || O.wrapper) && (O.exact || 1 !== t || ((S = E(x = e)) && !ll(S) && Km(k, S, O) && (N = k.clone(S, !1),
                B(N),
                k.replace(N, x, !0),
                k.remove(S, !0)),
                e = N || x),
                Lp(R, D, A, e),
                y = O,
                b = T,
                C = A,
                Ym(v = R, (w = e).parentNode, b, C) && Ep(v, y, C, w) || y.merge_with_parents && v.dom.getParent(w.parentNode, function(e) {
                    if (Ym(v, e, b, C))
                        return Ep(v, y, C, w),
                        !0
                }),
                m = k,
                g = A,
                h = e,
                (p = O).styles && p.styles.backgroundColor && Dp(h, Op(m, "fontSize"), Bp(m, "backgroundColor", Cl(p.styles.backgroundColor, g))),
                c = k,
                f = e,
                d = function(e) {
                    if (1 === e.nodeType && e.parentNode && 1 === e.parentNode.nodeType) {
                        var t = Nl(c, e.parentNode);
                        c.getStyle(e, "color") && t ? c.setStyle(e, "text-decoration", t) : c.getStyle(e, "text-decoration") === t && c.setStyle(e, "text-decoration", null)
                    }
                }
                ,
                (l = O).styles && (l.styles.color || l.styles.textDecoration) && (hr.walk(f, d, "childNodes"),
                d(f)),
                a = k,
                s = e,
                "sub" !== (u = O).inline && "sup" !== u.inline || (Dp(s, Op(a, "fontSize"), Bp(a, "fontSize", "")),
                a.remove(a.select("sup" === u.inline ? "sub" : "sup", s), !0)),
                r = k,
                o = O,
                (i = e) && !1 !== o.merge_siblings && (i = Ap(r, hl(i), i),
                i = Ap(r, i, hl(i, !0)))) : k.remove(e, !0)
            })
        };
        if ("false" !== i.getContentEditable(t.getNode())) {
            if (O) {
                if (r)
                    pl(r) ? d(D, r) || ((e = i.createRng()).setStartBefore(r),
                    e.setEndAfter(r),
                    a(i, Ul(R, e, D), 0, !0)) : a(i, r, 0, !0);
                else if (o && O.inline && !$l(R).length)
                    !function(e, t, n) {
                        var r, o, i = e.selection, a = i.getRng(), u = a.startOffset, s = a.startContainer.nodeValue;
                        (r = Fs(e.getBody(), i.getStart())) && (o = rp(r));
                        var c, l, f = /[^\s\u00a0\u00ad\u200b\ufeff]/;
                        if (s && 0 < u && u < s.length && f.test(s.charAt(u)) && f.test(s.charAt(u - 1))) {
                            var d = i.getBookmark();
                            a.collapse(!0);
                            var m = Ul(e, a, e.formatter.get(t));
                            m = Vm(m),
                            e.formatter.apply(t, n, m),
                            i.moveToBookmark(d)
                        } else
                            r && o.nodeValue === ep || (c = e.getDoc(),
                            l = op(!0).dom(),
                            o = (r = c.importNode(l, !0)).firstChild,
                            a.insertNode(r),
                            u = 1),
                            e.formatter.apply(t, n, r),
                            i.setCursorLocation(o, u)
                    }(R, T, A);
                else {
                    var n = t.getNode();
                    R.settings.forced_root_block || !D[0].defaultBlock || i.getParent(n, i.isBlock) || Mp(R, D[0].defaultBlock),
                    t.setRng($d(t.getRng())),
                    Ql(t, !0, function(e) {
                        Jl(R, function(e, t) {
                            var n = t ? e : Ul(R, e, D);
                            a(i, n)
                        })
                    }),
                    gl(i, t, t.getRng()),
                    R.nodeChanged()
                }
                u = R,
                pp(dp[T], function(e) {
                    e(u)
                })
            }
            var u
        } else {
            r = t.getNode();
            for (var s = 0, c = D.length; s < c; s++)
                if (D[s].ceFalseOverride && i.is(r, D[s].selector))
                    return void B(r, D[s])
        }
    }, Fp = function(n, e) {
        return U(e, function(e) {
            var t = n.fire("GetSelectionRange", {
                range: e
            });
            return t.range !== e ? t.range : e
        })
    }, Up = function(e, t) {
        var n = (t || V.document).createDocumentFragment();
        return z(e, function(e) {
            n.appendChild(e.dom())
        }),
        Ne.fromDom(n)
    }, zp = function(e, t, n) {
        return {
            element: x(e),
            width: x(t),
            rows: x(n)
        }
    }, jp = function(e, t) {
        return {
            element: x(e),
            cells: x(t)
        }
    }, Hp = function(e, t) {
        var n = parseInt(fn(e, t), 10);
        return isNaN(n) ? 1 : n
    }, Vp = function(e) {
        return W(e, function(e, t) {
            return t.cells().length > e ? t.cells().length : e
        }, 0)
    }, qp = function(e, t) {
        for (var n, r = e.rows(), o = 0; o < r.length; o++)
            for (var i = r[o].cells(), a = 0; a < i.length; a++)
                if (at(i[a], t))
                    return R.some((n = o,
                    {
                        x: x(a),
                        y: x(n)
                    }));
        return R.none()
    }, $p = function(e, t, n, r, o) {
        for (var i = [], a = e.rows(), u = n; u <= o; u++) {
            var s = a[u].cells()
              , c = t < r ? s.slice(t, r + 1) : s.slice(r, t + 1);
            i.push(jp(a[u].element(), c))
        }
        return i
    }, Wp = function(e) {
        var o = zp(ou(e), 0, []);
        return z(Ua(e, "tr"), function(n, r) {
            z(Ua(n, "td,th"), function(e, t) {
                !function(e, t, n, r, o) {
                    for (var i = Hp(o, "rowspan"), a = Hp(o, "colspan"), u = e.rows(), s = n; s < n + i; s++) {
                        u[s] || (u[s] = jp(iu(r), []));
                        for (var c = t; c < t + a; c++) {
                            u[s].cells()[c] = s === n && c === t ? o : ou(o)
                        }
                    }
                }(o, function(e, t, n) {
                    for (; r = t,
                    o = n,
                    i = void 0,
                    ((i = e.rows())[o] ? i[o].cells() : [])[r]; )
                        t++;
                    var r, o, i;
                    return t
                }(o, t, r), r, n, e)
            })
        }),
        zp(o.element(), Vp(o.rows()), o.rows())
    }, Kp = function(e) {
        return n = U((t = e).rows(), function(e) {
            var t = U(e.cells(), function(e) {
                var t = iu(e);
                return dn(t, "colspan"),
                dn(t, "rowspan"),
                t
            })
              , n = ou(e.element());
            return Nt(n, t),
            n
        }),
        r = ou(t.element()),
        o = Ne.fromTag("tbody"),
        Nt(o, n),
        St(r, o),
        r;
        var t, n, r, o
    }, Xp = function(l, e, t) {
        return qp(l, e).bind(function(c) {
            return qp(l, t).map(function(e) {
                return t = l,
                r = e,
                o = (n = c).x(),
                i = n.y(),
                a = r.x(),
                u = r.y(),
                s = i < u ? $p(t, o, i, a, u) : $p(t, o, u, a, i),
                zp(t.element(), Vp(s), s);
                var t, n, r, o, i, a, u, s
            })
        })
    }, Yp = function(t, n) {
        return K(t, function(e) {
            return "li" === Rt(e) && Xl(e, n)
        }).fold(x([]), function(e) {
            return K(t, function(e) {
                return "ul" === Rt(e) || "ol" === Rt(e)
            }).map(function(e) {
                return [Ne.fromTag("li"), Ne.fromTag(Rt(e))]
            }).getOr([])
        })
    }, Gp = function(e, t) {
        var n, r = Ne.fromDom(t.commonAncestorContainer), o = nd(r, e), i = H(o, function(e) {
            return Nr(e) || xr(e)
        }), a = Yp(o, t), u = i.concat(a.length ? a : Rr(n = r) ? ft(n).filter(_r).fold(x([]), function(e) {
            return [n, e]
        }) : _r(n) ? [n] : []);
        return U(u, ou)
    }, Jp = function() {
        return Up([])
    }, Qp = function(e, t) {
        return n = Ne.fromDom(t.cloneContents()),
        r = Gp(e, t),
        o = W(r, function(e, t) {
            return St(t, e),
            t
        }, n),
        0 < r.length ? Up([o]) : o;
        var n, r, o
    }, Zp = function(e, o) {
        return t = e,
        n = o[0],
        qa(n, "table", N(at, t)).bind(function(e) {
            var t = o[0]
              , n = o[o.length - 1]
              , r = Wp(e);
            return Xp(r, t, n).map(function(e) {
                return Up([Kp(e)])
            })
        }).getOrThunk(Jp);
        var t, n
    }, eg = function(e, t) {
        var n, r, o = ql(t, e);
        return 0 < o.length ? Zp(e, o) : (n = e,
        0 < (r = t).length && r[0].collapsed ? Jp() : Qp(n, r[0]))
    }, tg = function(e, t, n) {
        if (void 0 === n && (n = {}),
        n.get = !0,
        n.format = t,
        n.selection = !0,
        (n = e.fire("BeforeGetContent", n)).isDefaultPrevented())
            return e.fire("GetContent", n),
            n.content;
        if ("text" === n.format)
            return l = e,
            R.from(l.selection.getRng()).map(function(e) {
                var t = l.dom.add(l.getBody(), "div", {
                    "data-mce-bogus": "all",
                    style: "overflow: hidden; opacity: 0;"
                }, e.cloneContents())
                  , n = lu(t.innerText);
                return l.dom.remove(t),
                n
            }).getOr("");
        n.getInner = !0;
        var r, o, i, a, u, s, c, l, f = (o = n,
        i = (r = e).selection.getRng(),
        a = r.dom.create("body"),
        u = r.selection.getSel(),
        s = Fp(r, Hl(u)),
        (c = o.contextual ? eg(Ne.fromDom(r.getBody()), s).dom() : i.cloneContents()) && a.appendChild(c),
        r.selection.serializer.serialize(a, o));
        return "tree" === n.format ? f : (n.content = e.selection.isCollapsed() ? "" : f,
        e.fire("GetContent", n),
        n.content)
    }, ng = function(e) {
        return $t(e) ? e.outerHTML : Zt(e) ? $r.encodeRaw(e.data, !1) : en(e) ? "\x3c!--" + e.data + "--\x3e" : ""
    }, rg = function(e, t, n) {
        var r = function(e) {
            var t, n, r;
            for (r = V.document.createElement("div"),
            t = V.document.createDocumentFragment(),
            e && (r.innerHTML = e); n = r.firstChild; )
                t.appendChild(n);
            return t
        }(t);
        if (e.hasChildNodes() && n < e.childNodes.length) {
            var o = e.childNodes[n];
            o.parentNode.insertBefore(r, o)
        } else
            e.appendChild(r)
    }, og = function(e, t) {
        var n, r, p, g, o, h, v, c, y, l, i, a = U(te(t.childNodes), ng);
        return g = e,
        o = (p = a).length + g.length + 2,
        h = new Array(o),
        v = new Array(o),
        c = function(e, t, n, r, o) {
            var i = l(e, t, n, r);
            if (null === i || i.start === t && i.diag === t - r || i.end === e && i.diag === e - n)
                for (var a = e, u = n; a < t || u < r; )
                    a < t && u < r && p[a] === g[u] ? (o.push([0, p[a]]),
                    ++a,
                    ++u) : r - n < t - e ? (o.push([2, p[a]]),
                    ++a) : (o.push([1, g[u]]),
                    ++u);
            else {
                c(e, i.start, n, i.start - i.diag, o);
                for (var s = i.start; s < i.end; ++s)
                    o.push([0, p[s]]);
                c(i.end, t, i.end - i.diag, r, o)
            }
        }
        ,
        y = function(e, t, n, r) {
            for (var o = e; o - t < r && o < n && p[o] === g[o - t]; )
                ++o;
            return {
                start: e,
                end: o,
                diag: t
            }
        }
        ,
        l = function(e, t, n, r) {
            var o = t - e
              , i = r - n;
            if (0 == o || 0 == i)
                return null;
            var a, u, s, c, l, f = o - i, d = i + o, m = (d % 2 == 0 ? d : 1 + d) / 2;
            for (h[1 + m] = e,
            v[1 + m] = t + 1,
            a = 0; a <= m; ++a) {
                for (u = -a; u <= a; u += 2) {
                    for (s = u + m,
                    u === -a || u !== a && h[s - 1] < h[s + 1] ? h[s] = h[s + 1] : h[s] = h[s - 1] + 1,
                    l = (c = h[s]) - e + n - u; c < t && l < r && p[c] === g[l]; )
                        h[s] = ++c,
                        ++l;
                    if (f % 2 != 0 && f - a <= u && u <= f + a && v[s - f] <= h[s])
                        return y(v[s - f], u + e - n, t, r)
                }
                for (u = f - a; u <= f + a; u += 2) {
                    for (s = u + m - f,
                    u === f - a || u !== f + a && v[s + 1] <= v[s - 1] ? v[s] = v[s + 1] - 1 : v[s] = v[s - 1],
                    l = (c = v[s] - 1) - e + n - u; e <= c && n <= l && p[c] === g[l]; )
                        v[s] = c--,
                        l--;
                    if (f % 2 == 0 && -a <= u && u <= a && v[s] <= h[s + f])
                        return y(v[s], u + e - n, t, r)
                }
            }
        }
        ,
        i = [],
        c(0, p.length, 0, g.length, i),
        n = t,
        r = 0,
        z(i, function(e) {
            0 === e[0] ? r++ : 1 === e[0] ? (rg(n, e[1], r),
            r++) : 2 === e[0] && function(e, t) {
                if (e.hasChildNodes() && t < e.childNodes.length) {
                    var n = e.childNodes[t];
                    n.parentNode.removeChild(n)
                }
            }(n, r)
        }),
        t
    }, ig = xa(R.none()), ag = function(n) {
        var e, t, r, o;
        return o = n.getBody(),
        e = H(U(te(o.childNodes), ng), function(e) {
            return 0 < e.length
        }),
        t = (r = Y(e, function(e) {
            var t = _f(n.serializer, e);
            return 0 < t.length ? [t] : []
        })).join(""),
        -1 !== t.indexOf("</iframe>") ? {
            type: "fragmented",
            fragments: r,
            content: "",
            bookmark: null,
            beforeBookmark: null
        } : {
            type: "complete",
            fragments: null,
            content: t,
            bookmark: null,
            beforeBookmark: null
        }
    }, ug = function(e, t, n) {
        "fragmented" === t.type ? og(t.fragments, e.getBody()) : e.setContent(t.content, {
            format: "raw"
        }),
        e.selection.moveToBookmark(n ? t.beforeBookmark : t.bookmark)
    }, sg = function(e) {
        return "fragmented" === e.type ? e.fragments.join("") : e.content
    }, cg = function(e) {
        var t = Ne.fromTag("body", ig.get().getOrThunk(function() {
            var e = V.document.implementation.createHTMLDocument("undo");
            return ig.set(R.some(e)),
            e
        }));
        return nu(t, sg(e)),
        z(Ua(t, "*[data-mce-bogus]"), _t),
        t.dom().innerHTML
    }, lg = function(e, t) {
        return !(!e || !t) && (r = t,
        sg(e) === sg(r) || (n = t,
        cg(e) === cg(n)));
        var n, r
    }, fg = function(e) {
        return 0 === e.get()
    }, dg = function(e, t, n) {
        fg(n) && (e.typing = t)
    }, mg = function(e, t) {
        e.typing && (dg(e, !1, t),
        e.add())
    }, pg = function(e) {
        return e instanceof df
    }, gg = function(e, t) {
        Fm(e.serializer.getNodeFilters(), e.serializer.getAttributeFilters(), t)
    }, hg = function() {
        return {
            type: "complete",
            fragments: [],
            content: "",
            bookmark: null,
            beforeBookmark: null
        }
    }, vg = function(s) {
        return {
            undoManager: {
                beforeChange: function(e, t) {
                    return n = s,
                    r = t,
                    void (fg(e) && r.set(R.some(Ls(n.selection))));
                    var n, r
                },
                addUndoLevel: function(e, t, n, r, o, i) {
                    return function(e, t, n, r, o, i, a) {
                        var u = e.settings
                          , s = ag(e);
                        if (i = i || {},
                        i = hr.extend(i, s),
                        !1 === fg(r) || e.removed)
                            return null;
                        var c = t.data[n.get()];
                        if (e.fire("BeforeAddUndo", {
                            level: i,
                            lastLevel: c,
                            originalEvent: a
                        }).isDefaultPrevented())
                            return null;
                        if (c && lg(c, i))
                            return null;
                        if (t.data[n.get()] && o.get().each(function(e) {
                            t.data[n.get()].beforeBookmark = e
                        }),
                        u.custom_undo_redo_levels && t.data.length > u.custom_undo_redo_levels) {
                            for (var l = 0; l < t.data.length - 1; l++)
                                t.data[l] = t.data[l + 1];
                            t.data.length--,
                            n.set(t.data.length)
                        }
                        i.bookmark = Ls(e.selection),
                        n.get() < t.data.length - 1 && (t.data.length = n.get() + 1),
                        t.data.push(i),
                        n.set(t.data.length - 1);
                        var f = {
                            level: i,
                            lastLevel: c,
                            originalEvent: a
                        };
                        return e.fire("AddUndo", f),
                        0 < n.get() && (e.setDirty(!0),
                        e.fire("change", f)),
                        i
                    }(s, e, t, n, r, o, i)
                },
                undo: function(e, t, n) {
                    return r = s,
                    i = t,
                    a = n,
                    (o = e).typing && (o.add(),
                    o.typing = !1,
                    dg(o, !1, i)),
                    0 < a.get() && (a.set(a.get() - 1),
                    u = o.data[a.get()],
                    ug(r, u, !0),
                    r.setDirty(!0),
                    r.fire("Undo", {
                        level: u
                    })),
                    u;
                    var r, o, i, a, u
                },
                redo: function(e, t) {
                    return n = s,
                    o = t,
                    (r = e).get() < o.length - 1 && (r.set(r.get() + 1),
                    i = o[r.get()],
                    ug(n, i, !1),
                    n.setDirty(!0),
                    n.fire("Redo", {
                        level: i
                    })),
                    i;
                    var n, r, o, i
                },
                clear: function(e, t) {
                    return n = s,
                    o = t,
                    (r = e).data = [],
                    o.set(0),
                    r.typing = !1,
                    void n.fire("ClearUndos");
                    var n, r, o
                },
                reset: function(e) {
                    return (t = e).clear(),
                    void t.add();
                    var t
                },
                hasUndo: function(e, t) {
                    return n = s,
                    r = e,
                    0 < t.get() || r.typing && r.data[0] && !lg(ag(n), r.data[0]);
                    var n, r
                },
                hasRedo: function(e, t) {
                    return n = e,
                    t.get() < n.data.length - 1 && !n.typing;
                    var n
                },
                transact: function(e, t, n) {
                    return o = n,
                    mg(r = e, t),
                    r.beforeChange(),
                    r.ignore(o),
                    r.add();
                    var r, o
                },
                ignore: function(e, t) {
                    return function(e, t) {
                        try {
                            e.set(e.get() + 1),
                            t()
                        } finally {
                            e.set(e.get() - 1)
                        }
                    }(e, t)
                },
                extra: function(e, t, n, r) {
                    return function(e, t, n, r, o) {
                        if (t.transact(r)) {
                            var i = t.data[n.get()].bookmark
                              , a = t.data[n.get() - 1];
                            ug(e, a, !0),
                            t.transact(o) && (t.data[n.get() - 1].beforeBookmark = i)
                        }
                    }(s, e, t, n, r)
                }
            },
            formatter: {
                apply: function(e, t, n) {
                    return Mp(s, e, t, n)
                },
                remove: function(e, t, n, r) {
                    return kp(s, e, t, n, r)
                },
                toggle: function(e, t, n) {
                    return o = e,
                    i = t,
                    a = n,
                    u = (r = s).formatter.get(o),
                    void (!Gm(r, o, i, a) || "toggle"in u[0] && !u[0].toggle ? Mp : kp)(r, o, i, a);
                    var r, o, i, a, u
                }
            },
            editor: {
                getContent: function(e, t) {
                    return n = s,
                    r = e,
                    o = t,
                    R.from(n.getBody()).fold(x("tree" === r.format ? new df("body",11) : ""), function(e) {
                        return Tf(n, r, o, e)
                    });
                    var n, r, o
                },
                setContent: function(e, t) {
                    return jm(s, e, t)
                },
                insertContent: function(e, t) {
                    return rm(s, e, t)
                }
            },
            selection: {
                getContent: function(e, t) {
                    return tg(s, e, t)
                }
            },
            raw: {
                getModel: function() {
                    return R.none()
                }
            }
        }
    }, yg = function(e) {
        return me(e.plugins, "rtc")
    }, bg = function(n) {
        var r = n;
        return de(n.plugins, "rtc").fold(function() {
            return r.rtcInstance = vg(n),
            R.none()
        }, function(e) {
            return R.some(e.setup().then(function(e) {
                var o, i, a, t;
                return r.rtcInstance = (o = n,
                i = e,
                a = function(e) {
                    return E(e) ? e : {}
                }
                ,
                t = p("Unimplemented feature for rtc"),
                {
                    undoManager: {
                        beforeChange: f,
                        addUndoLevel: t,
                        undo: function() {
                            return i.undo(),
                            hg()
                        },
                        redo: function() {
                            return i.redo(),
                            hg()
                        },
                        clear: t,
                        reset: t,
                        hasUndo: function() {
                            return i.hasUndo()
                        },
                        hasRedo: function() {
                            return i.hasRedo()
                        },
                        transact: function(e, t, n) {
                            return i.transact(n),
                            hg()
                        },
                        ignore: t,
                        extra: t
                    },
                    formatter: {
                        apply: function(e, t, n) {
                            return i.applyFormat(e, a(t))
                        },
                        remove: function(e, t, n, r) {
                            return i.removeFormat(e, a(t))
                        },
                        toggle: function(e, t, n) {
                            return i.toggleFormat(e, a(t))
                        }
                    },
                    editor: {
                        getContent: function(e, t) {
                            if ("html" !== t && "tree" !== t)
                                return vg(o).editor.getContent(e, t);
                            var n = i.getContent()
                              , r = hf({
                                inner: !0
                            });
                            return gg(o, n),
                            "tree" === t ? n : r.serialize(n)
                        },
                        setContent: function(e, t) {
                            var n = pg(e) ? e : o.parser.parse(e, {
                                isRootContent: !0,
                                insert: !0
                            });
                            return i.setContent(n),
                            e
                        },
                        insertContent: function(e, t) {
                            var n = pg(e) ? e : o.parser.parse(e, {
                                insert: !0
                            });
                            i.insertContent(n)
                        }
                    },
                    selection: {
                        getContent: function(e, t) {
                            if ("html" !== e && "tree" !== e)
                                return vg(o).selection.getContent(e, t);
                            var n = i.getSelectedContent()
                              , r = hf({});
                            return gg(o, n),
                            "tree" === e ? n : r.serialize(n)
                        }
                    },
                    raw: {
                        getModel: function() {
                            return R.some(i.getRawModel())
                        }
                    }
                }),
                e.isRemote
            }))
        })
    }, Cg = function(e) {
        return e.rtcInstance ? e.rtcInstance : vg(e)
    }, wg = function(e) {
        var t = e.rtcInstance;
        if (t)
            return t;
        throw new Error("Failed to get RTC instance not yet initialized.")
    }, xg = function(e, t) {
        void 0 === t && (t = {});
        var n, r, o = t.format ? t.format : "html";
        return n = t,
        r = o,
        Cg(e).editor.getContent(n, r)
    }, Sg = function(e, t, n) {
        return void 0 === n && (n = {}),
        r = t,
        o = n,
        Cg(e).editor.setContent(r, o);
        var r, o
    }, Ng = ga.DOM, Eg = function(e) {
        return R.from(e).each(function(e) {
            return e.destroy()
        })
    }, kg = function(e) {
        if (!e.removed) {
            var t = e._selectionOverrides
              , n = e.editorUpload
              , r = e.getBody()
              , o = e.getElement();
            r && e.save({
                is_removing: !0
            }),
            e.removed = !0,
            e.unbindAllNativeEvents(),
            e.hasHiddenInput && o && Ng.remove(o.nextSibling),
            e.fire("remove"),
            e.editorManager.remove(e),
            !e.inline && r && (i = e,
            Ng.setStyle(i.id, "display", i.orgDisplay)),
            e.fire("detach"),
            Ng.remove(e.getContainer()),
            Eg(t),
            Eg(n),
            e.destroy()
        }
        var i
    }, _g = function(e, t) {
        var n, r, o, i = e.selection, a = e.dom;
        e.destroyed || (t || e.removed ? (t || (e.editorManager.off("beforeunload", e._beforeUnload),
        e.theme && e.theme.destroy && e.theme.destroy(),
        Eg(i),
        Eg(a)),
        (r = (n = e).formElement) && (r._mceOldSubmit && (r.submit = r._mceOldSubmit,
        r._mceOldSubmit = null),
        Ng.unbind(r, "submit reset", n.formEventDelegate)),
        (o = e).contentAreaContainer = o.formElement = o.container = o.editorContainer = null,
        o.bodyElement = o.contentDocument = o.contentWindow = null,
        o.iframeElement = o.targetElm = null,
        o.selection && (o.selection = o.selection.win = o.selection.dom = o.selection.dom.doc = null),
        e.destroyed = !0) : e.remove())
    }, Rg = Object.prototype.hasOwnProperty, Tg = (gp = function(e, t) {
        return E(e) && E(t) ? Tg(e, t) : t
    }
    ,
    function() {
        for (var e = new Array(arguments.length), t = 0; t < e.length; t++)
            e[t] = arguments[t];
        if (0 === e.length)
            throw new Error("Can't merge zero objects");
        for (var n = {}, r = 0; r < e.length; r++) {
            var o = e[r];
            for (var i in o)
                Rg.call(o, i) && (n[i] = gp(n[i], o[i]))
        }
        return n
    }
    ), Ag = nt().deviceType, Dg = Ag.isTouch(), Og = Ag.isPhone(), Bg = Ag.isTablet(), Pg = ["lists", "autolink", "autosave"], Lg = {
        table_grid: !1,
        object_resizing: !1,
        resize: !1
    }, Ig = function(e) {
        var t = k(e) ? e.join(" ") : e
          , n = U(q(t) ? t.split(" ") : [], $e);
        return H(n, function(e) {
            return 0 < e.length
        })
    }, Mg = function(n, e) {
        var t, r, o = ce(e, function(e, t) {
            return M(n, t)
        });
        return t = o.t,
        r = o.f,
        {
            sections: x(t),
            settings: x(r)
        }
    }, Fg = function(e, t) {
        return e.sections().hasOwnProperty(t)
    }, Ug = function(e, t) {
        return de(e, "toolbar_mode").orThunk(function() {
            return de(e, "toolbar_drawer").map(function(e) {
                return !1 === e ? "wrap" : e
            })
        }).getOr(t)
    }, zg = function(e, t, n, r) {
        var o, i, a, u, s, c, l, f = Ig(n.forced_plugins), d = Ig(r.plugins), m = Fg(o = t, i = "mobile") ? o.sections()[i] : {}, p = m.plugins ? Ig(m.plugins) : d, g = e && (s = u = "mobile",
        c = (a = t).sections(),
        Fg(a, u) && c[u].theme === s) ? H(p, N(M, Pg)) : e && Fg(t, "mobile") ? p : d, h = (l = g,
        [].concat(Ig(f)).concat(Ig(l)));
        return hr.extend(r, {
            plugins: h.join(" ")
        })
    }, jg = function(e, t, n, r, o) {
        var i, a, u, s, c, l, f, d = e ? {
            mobile: (i = o.mobile || {},
            a = t,
            u = {
                resize: !1,
                toolbar_mode: Ug(i, "scrolling"),
                toolbar_sticky: !1
            },
            pe(pe(pe({}, Lg), u), a ? {
                menubar: !1
            } : {}))
        } : {}, m = Mg(["mobile"], Tg(d, o)), p = hr.extend(n, r, m.settings(), (f = m,
        e && Fg(f, "mobile") ? function(e, t, n) {
            void 0 === n && (n = {});
            var r = e.sections()
              , o = r.hasOwnProperty(t) ? r[t] : {};
            return hr.extend({}, n, o)
        }(m, "mobile") : {}), {
            validate: !0,
            external_plugins: (s = r,
            c = m.settings(),
            l = c.external_plugins ? c.external_plugins : {},
            s && s.external_plugins ? hr.extend({}, s.external_plugins, l) : l)
        });
        return zg(e, m, r, p)
    }, Hg = function(e, t, n, r, o) {
        var i, a, u, s, c = (i = n,
        a = Dg,
        u = e,
        s = {
            id: t,
            theme: "silver",
            toolbar_mode: Ug(o, "floating"),
            plugins: "",
            document_base_url: i,
            add_form_submit_trigger: !0,
            submit_patch: !0,
            add_unload_trigger: !0,
            convert_urls: !0,
            relative_urls: !0,
            remove_script_host: !0,
            object_resizing: !0,
            doctype: "<!DOCTYPE html>",
            visual: !0,
            font_size_legacy_values: "xx-small,small,medium,large,x-large,xx-large,300%",
            forced_root_block: "p",
            hidden_input: !0,
            inline_styles: !0,
            convert_fonts_to_spans: !0,
            indent: !0,
            indent_before: "p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,th,ul,ol,li,dl,dt,dd,area,table,thead,tfoot,tbody,tr,section,summary,article,hgroup,aside,figure,figcaption,option,optgroup,datalist",
            indent_after: "p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,th,ul,ol,li,dl,dt,dd,area,table,thead,tfoot,tbody,tr,section,summary,article,hgroup,aside,figure,figcaption,option,optgroup,datalist",
            entity_encoding: "named",
            url_converter: u.convertURL,
            url_converter_scope: u
        },
        pe(pe({}, s), a ? Lg : {}));
        return jg(Og || Bg, Og, c, r, o)
    }, Vg = function(e, t, n) {
        return R.from(t.settings[n]).filter(e)
    }, qg = function(e, t, n, r) {
        var o, i, a, u = t in e.settings ? e.settings[t] : n;
        return "hash" === r ? (a = {},
        "string" == typeof (i = u) ? z(0 < i.indexOf("=") ? i.split(/[;,](?![^=;,]*(?:[;,]|$))/) : i.split(","), function(e) {
            var t = e.split("=");
            1 < t.length ? a[hr.trim(t[0])] = hr.trim(t[1]) : a[hr.trim(t[0])] = hr.trim(t[0])
        }) : a = i,
        a) : "string" === r ? Vg(q, e, t).getOr(n) : "number" === r ? Vg(O, e, t).getOr(n) : "boolean" === r ? Vg(T, e, t).getOr(n) : "object" === r ? Vg(E, e, t).getOr(n) : "array" === r ? Vg(k, e, t).getOr(n) : "string[]" === r ? Vg((o = q,
        function(e) {
            return k(e) && G(e, o)
        }
        ), e, t).getOr(n) : "function" === r ? Vg(D, e, t).getOr(n) : u
    }, $g = (hp = {},
    {
        add: function(e, t) {
            hp[e] = t
        },
        get: function(e) {
            return hp[e] ? hp[e] : {
                icons: {}
            }
        },
        has: function(e) {
            return me(hp, e)
        }
    }), Wg = function(e, t) {
        return t.dom()[e]
    }, Kg = function(e, t) {
        return parseInt(mn(t, e), 10)
    }, Xg = N(Wg, "clientWidth"), Yg = N(Wg, "clientHeight"), Gg = N(Kg, "margin-top"), Jg = N(Kg, "margin-left"), Qg = function(e, t, n) {
        var r, o, i, a, u, s, c, l, f, d, m, p = Ne.fromDom(e.getBody()), g = e.inline ? p : (r = p,
        Ne.fromDom(r.dom().ownerDocument.documentElement)), h = (o = e.inline,
        a = t,
        u = n,
        s = (i = g).dom().getBoundingClientRect(),
        {
            x: a - (o ? s.left + i.dom().clientLeft + Jg(i) : 0),
            y: u - (o ? s.top + i.dom().clientTop + Gg(i) : 0)
        });
        return l = h.x,
        f = h.y,
        d = Xg(c = g),
        m = Yg(c),
        0 <= l && 0 <= f && l <= d && f <= m
    }, Zg = function(e) {
        var t, n = e.inline ? e.getBody() : e.getContentAreaContainer();
        return t = n,
        R.from(t).map(Ne.fromDom).map(function(e) {
            return st(ct(e), e)
        }).getOr(!1)
    };
    function eh(n) {
        var t, o = [], i = function() {
            var e = n.theme;
            return e && e.getNotificationManagerImpl ? e.getNotificationManagerImpl() : function t() {
                var e = function() {
                    throw new Error("Theme did not provide a NotificationManager implementation.")
                };
                return {
                    open: e,
                    close: e,
                    reposition: e,
                    getArgs: e
                }
            }()
        }, a = function() {
            0 < o.length && i().reposition(o)
        }, u = function(t) {
            X(o, function(e) {
                return e === t
            }).each(function(e) {
                o.splice(e, 1)
            })
        }, r = function(r) {
            if (!n.removed && Zg(n))
                return K(o, function(e) {
                    return t = i().getArgs(e),
                    n = r,
                    !(t.type !== n.type || t.text !== n.text || t.progressBar || t.timeout || n.progressBar || n.timeout);
                    var t, n
                }).getOrThunk(function() {
                    n.editorManager.setActive(n);
                    var e, t = i().open(r, function() {
                        u(t),
                        a()
                    });
                    return e = t,
                    o.push(e),
                    a(),
                    t
                })
        };
        return (t = n).on("SkinLoaded", function() {
            var e = t.settings.service_message;
            e && r({
                text: e,
                type: "warning",
                timeout: 0
            })
        }),
        t.on("ResizeEditor ResizeWindow NodeChange", function() {
            Xn.requestAnimationFrame(a)
        }),
        t.on("remove", function() {
            z(o.slice(), function(e) {
                i().close(e)
            })
        }),
        {
            open: r,
            close: function() {
                R.from(o[0]).each(function(e) {
                    i().close(e),
                    u(e),
                    a()
                })
            },
            getNotifications: function() {
                return o
            }
        }
    }
    var th = Ra.PluginManager
      , nh = Ra.ThemeManager;
    var rh = function(n) {
        var r = []
          , o = function() {
            var e = n.theme;
            return e && e.getWindowManagerImpl ? e.getWindowManagerImpl() : function t() {
                var e = function() {
                    throw new Error("Theme did not provide a WindowManager implementation.")
                };
                return {
                    open: e,
                    openUrl: e,
                    alert: e,
                    confirm: e,
                    close: e,
                    getParams: e,
                    setParams: e
                }
            }()
        }
          , i = function(e, t) {
            return function() {
                return t ? t.apply(e, arguments) : undefined
            }
        }
          , a = function(e) {
            var t;
            r.push(e),
            t = e,
            n.fire("OpenWindow", {
                dialog: t
            })
        }
          , u = function(t) {
            var e;
            e = t,
            n.fire("CloseWindow", {
                dialog: e
            }),
            0 === (r = H(r, function(e) {
                return e !== t
            })).length && n.focus()
        }
          , s = function(e) {
            n.editorManager.setActive(n),
            Cm(n);
            var t = e();
            return a(t),
            t
        };
        return n.on("remove", function() {
            z(r, function(e) {
                o().close(e)
            })
        }),
        {
            open: function(e, t) {
                return s(function() {
                    return o().open(e, t, u)
                })
            },
            openUrl: function(e) {
                return s(function() {
                    return o().openUrl(e, u)
                })
            },
            alert: function(e, t, n) {
                o().alert(e, i(n || this, t))
            },
            confirm: function(e, t, n) {
                o().confirm(e, i(n || this, t))
            },
            close: function() {
                R.from(r[r.length - 1]).each(function(e) {
                    o().close(e),
                    u(e)
                })
            }
        }
    }
      , oh = function(e, t) {
        e.notificationManager.open({
            type: "error",
            text: t
        })
    }
      , ih = function(e, t) {
        e._skinLoaded ? oh(e, t) : e.on("SkinLoaded", function() {
            oh(e, t)
        })
    }
      , ah = function(e, t, n) {
        var r, o;
        r = t,
        o = {
            message: n
        },
        e.fire(r, o),
        V.console.error(n)
    }
      , uh = function(e, t, n) {
        return n ? "Failed to load " + e + ": " + n + " from url " + t : "Failed to load " + e + " url: " + t
    }
      , sh = function(e, t, n) {
        ah(e, "PluginLoadError", uh("plugin", t, n))
    }
      , ch = function(e) {
        for (var t = [], n = 1; n < arguments.length; n++)
            t[n - 1] = arguments[n];
        var r = V.window.console;
        r && (r.error ? r.error.apply(r, ge([e], t)) : r.log.apply(r, ge([e], t)))
    }
      , lh = function(t) {
        var e, n, r = (n = (e = t).settings.content_css,
        q(n) ? U(n.split(","), $e) : k(n) ? n : !1 === n || e.inline ? [] : ["default"]), o = t.editorManager.baseURL + "/skins/content", i = "content" + t.editorManager.suffix + ".css", a = !0 === t.inline;
        return U(r, function(e) {
            return /^[a-z0-9\-]+$/i.test(e) && !a ? o + "/" + e + "/" + i : t.documentBaseURI.toAbsolute(e)
        })
    };
    var fh = function hE(r, o) {
        var e = function(e) {
            var t = o(e);
            if (t <= 0 || null === t) {
                var n = mn(e, r);
                return parseFloat(n) || 0
            }
            return t
        }
          , i = function(o, e) {
            return W(e, function(e, t) {
                var n = mn(o, t)
                  , r = n === undefined ? 0 : parseInt(n, 10);
                return isNaN(r) ? e : e + r
            }, 0)
        };
        return {
            set: function(e, t) {
                if (!O(t) && !t.match(/^[0-9]+$/))
                    throw new Error(r + ".set accepts only positive integer values. Value was " + t);
                var n = e.dom();
                un(n) && (n.style[r] = t + "px")
            },
            get: e,
            getOuter: e,
            aggregate: i,
            max: function(e, t, n) {
                var r = i(e, n);
                return r < t ? t - r : 0
            }
        }
    }("height", function(e) {
        var t = e.dom();
        return Bt(e) ? t.getBoundingClientRect().height : t.offsetHeight
    })
      , dh = function(r, e) {
        return r.view(e).fold(x([]), function(e) {
            var t = r.owner(e)
              , n = dh(r, t);
            return [e].concat(n)
        })
    }
      , mh = /* */
    Object.freeze({
        __proto__: null,
        view: function(e) {
            return (e.dom() === V.document ? R.none() : R.from(e.dom().defaultView.frameElement)).map(Ne.fromDom)
        },
        owner: function(e) {
            return ct(e)
        }
    })
      , ph = function(e) {
        var t, n, r, o = Ne.fromDom(V.document), i = Ft(o), a = (t = e,
        r = (n = mh).owner(t),
        dh(n, r)), u = Mt(e), s = $(a, function(e, t) {
            var n = Mt(t);
            return {
                left: e.left + n.left(),
                top: e.top + n.top()
            }
        }, {
            left: 0,
            top: 0
        });
        return Lt(s.left + u.left() + i.left(), s.top + u.top() + i.top())
    }
      , gh = function(e) {
        return "textarea" === Rt(e)
    }
      , hh = function(e, t) {
        var n, r = function(e) {
            var t = e.dom().ownerDocument
              , n = t.body
              , r = t.defaultView
              , o = t.documentElement;
            if (n === e.dom())
                return Lt(n.offsetLeft, n.offsetTop);
            var i = It(r.pageYOffset, o.scrollTop)
              , a = It(r.pageXOffset, o.scrollLeft)
              , u = It(o.clientTop, n.clientTop)
              , s = It(o.clientLeft, n.clientLeft);
            return Mt(e).translate(a - s, i - u)
        }(e), o = (n = e,
        fh.get(n));
        return {
            element: e,
            bottom: r.top() + o,
            height: o,
            pos: r,
            cleanup: t
        }
    }
      , vh = function(e, t) {
        var n = function(e, t) {
            var n = ht(e);
            if (0 === n.length || gh(e))
                return {
                    element: e,
                    offset: t
                };
            if (t < n.length && !gh(n[t]))
                return {
                    element: n[t],
                    offset: 0
                };
            var r = n[n.length - 1];
            return gh(r) ? {
                element: e,
                offset: t
            } : "img" === Rt(r) ? {
                element: r,
                offset: 1
            } : Ot(r) ? {
                element: r,
                offset: ef(r).length
            } : {
                element: r,
                offset: ht(r).length
            }
        }(e, t)
          , r = Ne.fromHtml('<span data-mce-bogus="all">\ufeff</span>');
        return Ct(n.element, r),
        hh(r, function() {
            return kt(r)
        })
    }
      , yh = function(n, r, o, i) {
        xh(n, function(e, t) {
            return Ch(n, r, o, i)
        }, o)
    }
      , bh = function(e, t, n, r, o) {
        var i, a, u = {
            elm: r.element.dom(),
            alignToTop: o
        };
        i = u,
        e.fire("ScrollIntoView", i).isDefaultPrevented() || (n(t, Ft(t).top(), r, o),
        a = u,
        e.fire("AfterScrollIntoView", a))
    }
      , Ch = function(e, t, n, r) {
        var o = Ne.fromDom(e.getBody())
          , i = Ne.fromDom(e.getDoc());
        o.dom().offsetWidth;
        var a = vh(Ne.fromDom(n.startContainer), n.startOffset);
        bh(e, i, t, a, r),
        a.cleanup()
    }
      , wh = function(e, t, n, r) {
        var o, i = Ne.fromDom(e.getDoc());
        bh(e, i, n, (o = t,
        hh(Ne.fromDom(o), f)), r)
    }
      , xh = function(e, t, n) {
        var r = n.startContainer
          , o = n.startOffset
          , i = n.endContainer
          , a = n.endOffset;
        t(Ne.fromDom(r), Ne.fromDom(i));
        var u = e.dom.createRng();
        u.setStart(r, o),
        u.setEnd(i, a),
        e.selection.setRng(n)
    }
      , Sh = function(e, t, n, r) {
        var o = e.pos;
        if (n)
            Ut(o.left(), o.top(), r);
        else {
            var i = o.top() - t + e.height;
            Ut(o.left(), i, r)
        }
    }
      , Nh = function(e, t, n, r, o) {
        var i = n + t
          , a = r.pos.top()
          , u = r.bottom
          , s = n <= u - a;
        if (a < t)
            Sh(r, n, !1 !== o, e);
        else if (i < a) {
            Sh(r, n, s ? !1 !== o : !0 === o, e)
        } else
            i < u && !s && Sh(r, n, !0 === o, e)
    }
      , Eh = function(e, t, n, r) {
        var o = e.dom().defaultView.innerHeight;
        Nh(e, t, o, n, r)
    }
      , kh = function(e, t, n, r) {
        var o = e.dom().defaultView.innerHeight;
        Nh(e, t, o, n, r);
        var i = ph(n.element)
          , a = Ht(V.window);
        i.top() < a.y ? zt(n.element, !1 !== r) : i.top() > a.bottom && zt(n.element, !0 === r)
    }
      , _h = function(e, t, n) {
        return yh(e, Eh, t, n)
    }
      , Rh = function(e, t, n) {
        return wh(e, t, Eh, n)
    }
      , Th = function(e, t, n) {
        return yh(e, kh, t, n)
    }
      , Ah = function(e, t, n) {
        return wh(e, t, kh, n)
    }
      , Dh = function(e, t, n) {
        (e.inline ? _h : Th)(e, t, n)
    }
      , Oh = function(e) {
        return on(e) || an(e)
    }
      , Bh = function(e, t, n) {
        var r, o, i, a, u, s = n;
        if (s.caretPositionFromPoint)
            (o = s.caretPositionFromPoint(e, t)) && ((r = n.createRange()).setStart(o.offsetNode, o.offset),
            r.collapse(!0));
        else if (n.caretRangeFromPoint)
            r = n.caretRangeFromPoint(e, t);
        else if (s.body.createTextRange) {
            r = s.body.createTextRange();
            try {
                r.moveToPoint(e, t),
                r.collapse(!0)
            } catch (c) {
                r = function(e, n, t) {
                    var r, o, i;
                    if (r = t.elementFromPoint(e, n),
                    o = t.body.createTextRange(),
                    r && "HTML" !== r.tagName || (r = t.body),
                    o.moveToElementText(r),
                    0 < (i = (i = hr.toArray(o.getClientRects())).sort(function(e, t) {
                        return (e = Math.abs(Math.max(e.top - n, e.bottom - n))) - (t = Math.abs(Math.max(t.top - n, t.bottom - n)))
                    })).length) {
                        n = (i[0].bottom + i[0].top) / 2;
                        try {
                            return o.moveToPoint(e, n),
                            o.collapse(!0),
                            o
                        } catch (a) {}
                    }
                    return null
                }(e, t, n)
            }
            return i = r,
            a = n.body,
            u = i && i.parentElement ? i.parentElement() : null,
            an(function(e, t, n) {
                for (; e && e !== t; ) {
                    if (n(e))
                        return e;
                    e = e.parentNode
                }
                return null
            }(u, a, Oh)) ? null : i
        }
        return r
    }
      , Ph = function(e, t, n, r, o) {
        var i = n ? t.startContainer : t.endContainer
          , a = n ? t.startOffset : t.endOffset;
        return R.from(i).map(Ne.fromDom).map(function(e) {
            return r && t.collapsed ? e : vt(e, o(e, a)).getOr(e)
        }).bind(function(e) {
            return Dt(e) ? R.some(e) : ft(e).filter(Dt)
        }).map(function(e) {
            return e.dom()
        }).getOr(e)
    }
      , Lh = function(e, t, n) {
        return Ph(e, t, !0, n, function(e, t) {
            return Math.min(e.dom().childNodes.length, t)
        })
    }
      , Ih = function(e, t, n) {
        return Ph(e, t, !1, n, function(e, t) {
            return 0 < t ? t - 1 : t
        })
    }
      , Mh = function(e, t) {
        for (var n = e; e && Zt(e) && 0 === e.length; )
            e = t ? e.nextSibling : e.previousSibling;
        return e || n
    }
      , Fh = function(e, t) {
        void 0 === t && (t = {});
        var n, r, o = t.format ? t.format : "html";
        return n = o,
        r = t,
        wg(e).selection.getContent(n, r)
    }
      , Uh = function(e, t) {
        return e && t && e.startContainer === t.startContainer && e.startOffset === t.startOffset && e.endContainer === t.endContainer && e.endOffset === t.endOffset
    }
      , zh = function(e, t, n) {
        return null !== function(e, t, n) {
            for (; e && e !== t; ) {
                if (n(e))
                    return e;
                e = e.parentNode
            }
            return null
        }(e, t, n)
    }
      , jh = function(e, t, n) {
        return zh(e, t, function(e) {
            return e.nodeName === n
        })
    }
      , Hh = function(e) {
        return e && "TABLE" === e.nodeName
    }
      , Vh = function(e, t, n) {
        for (var r = new ra(t,e.getParent(t.parentNode, e.isBlock) || e.getRoot()); t = r[n ? "prev" : "next"](); )
            if (rn(t))
                return !0
    }
      , qh = function(e, t, n, r, o) {
        var i, a, u = e.getRoot(), s = e.schema.getNonEmptyElements(), c = e.getParent(o.parentNode, e.isBlock) || u;
        if (r && rn(o) && t && e.isEmpty(c))
            return R.some(ls(o.parentNode, e.nodeIndex(o)));
        for (var l, f, d = new ra(o,c); a = d[r ? "prev" : "next"](); ) {
            if ("false" === e.getContentEditableParent(a) || (f = u,
            gu(l = a) && !1 === zh(l, f, Ms)))
                return R.none();
            if (Zt(a) && 0 < a.nodeValue.length)
                return !1 === jh(a, u, "A") ? R.some(ls(a, r ? a.nodeValue.length : 0)) : R.none();
            if (e.isBlock(a) || s[a.nodeName.toLowerCase()])
                return R.none();
            i = a
        }
        return n && i ? R.some(ls(i, 0)) : R.none()
    }
      , $h = function(e, t, n, r) {
        var o, i, a, u, s, c, l, f, d, m = e.getRoot(), p = !1;
        if (o = r[(n ? "start" : "end") + "Container"],
        i = r[(n ? "start" : "end") + "Offset"],
        c = $t(o) && i === o.childNodes.length,
        u = e.schema.getNonEmptyElements(),
        s = n,
        gu(o))
            return R.none();
        if ($t(o) && i > o.childNodes.length - 1 && (s = !1),
        tn(o) && (o = m,
        i = 0),
        o === m) {
            if (s && (a = o.childNodes[0 < i ? i - 1 : 0])) {
                if (gu(a))
                    return R.none();
                if (u[a.nodeName] || Hh(a))
                    return R.none()
            }
            if (o.hasChildNodes()) {
                if (i = Math.min(!s && 0 < i ? i - 1 : i, o.childNodes.length - 1),
                o = o.childNodes[i],
                i = Zt(o) && c ? o.data.length : 0,
                !t && o === m.lastChild && Hh(o))
                    return R.none();
                if (function(e, t) {
                    for (; t && t !== e; ) {
                        if (an(t))
                            return !0;
                        t = t.parentNode
                    }
                    return !1
                }(m, o) || gu(o))
                    return R.none();
                if (o.hasChildNodes() && !1 === Hh(o)) {
                    var g = new ra(a = o,m);
                    do {
                        if (an(a) || gu(a)) {
                            p = !1;
                            break
                        }
                        if (Zt(a) && 0 < a.nodeValue.length) {
                            i = s ? 0 : a.nodeValue.length,
                            o = a,
                            p = !0;
                            break
                        }
                        if (u[a.nodeName.toLowerCase()] && (!(l = a) || !/^(TD|TH|CAPTION)$/.test(l.nodeName))) {
                            i = e.nodeIndex(a),
                            o = a.parentNode,
                            s || i++,
                            p = !0;
                            break
                        }
                    } while (a = s ? g.next() : g.prev())
                }
            }
        }
        return t && (Zt(o) && 0 === i && qh(e, c, t, !0, o).each(function(e) {
            o = e.container(),
            i = e.offset(),
            p = !0
        }),
        $t(o) && (!(a = (a = o.childNodes[i]) || o.childNodes[i - 1]) || !rn(a) || (d = "A",
        (f = a).previousSibling && f.previousSibling.nodeName === d) || Vh(e, a, !1) || Vh(e, a, !0) || qh(e, c, t, !0, a).each(function(e) {
            o = e.container(),
            i = e.offset(),
            p = !0
        }))),
        s && !t && Zt(o) && i === o.nodeValue.length && qh(e, c, t, !1, o).each(function(e) {
            o = e.container(),
            i = e.offset(),
            p = !0
        }),
        p ? R.some(ls(o, i)) : R.none()
    }
      , Wh = function(e, t) {
        var n = t.collapsed
          , r = t.cloneRange()
          , o = ls.fromRangeStart(t);
        return $h(e, n, !0, r).each(function(e) {
            n && ls.isAbove(o, e) || r.setStart(e.container(), e.offset())
        }),
        n || $h(e, n, !1, r).each(function(e) {
            r.setEnd(e.container(), e.offset())
        }),
        n && r.collapse(!0),
        Uh(t, r) ? R.none() : R.some(r)
    }
      , Kh = function(e) {
        return 0 === e.dom().length ? (kt(e),
        R.none()) : R.some(e)
    }
      , Xh = function(r, e) {
        var t = R.from(e.firstChild).map(Ne.fromDom)
          , n = R.from(e.lastChild).map(Ne.fromDom);
        r.deleteContents(),
        r.insertNode(e);
        var o = t.bind(dt).filter(Ot).bind(Kh)
          , i = n.bind(mt).filter(Ot).bind(Kh);
        $u(o, t.filter(Ot), function(e, t) {
            var n, r;
            n = t.dom(),
            r = e.dom().data,
            n.insertData(0, r),
            kt(e)
        }),
        $u(i, n.filter(Ot), function(e, t) {
            var n = t.dom().length;
            t.dom().appendData(e.dom().data),
            r.setEnd(t.dom(), n),
            kt(e)
        }),
        r.collapse(!1)
    }
      , Yh = function(e, t, n) {
        void 0 === n && (n = {});
        var r, o = (r = t,
        pe(pe({
            format: "html"
        }, n), {
            set: !0,
            selection: !0,
            content: r
        }));
        if (o.no_events || !(o = e.fire("BeforeSetContent", o)).isDefaultPrevented()) {
            n.content = function(e, t) {
                if ("raw" === t.format)
                    return t.content;
                var n = e.parser.parse(t.content, pe({
                    isRootContent: !0,
                    forced_root_block: !1
                }, t));
                return hf({
                    validate: e.validate
                }, e.schema).serialize(n)
            }(e, o);
            var i = e.selection.getRng();
            Xh(i, i.createContextualFragment(n.content)),
            e.selection.setRng(i),
            Dh(e, i),
            o.no_events || e.fire("SetContent", o)
        } else
            e.fire("SetContent", o)
    };
    function Gh(e) {
        return {
            getBookmark: N(sl, e),
            moveToBookmark: N(cl, e)
        }
    }
    (Gh = Gh || {}).isBookmarkNode = ll;
    var Jh = Gh
      , Qh = function(t, n, e) {
        if (e.collapsed)
            return !1;
        if (rr.browser.isIE() && e.startOffset === e.endOffset - 1 && e.startContainer === e.endContainer) {
            var r = e.startContainer.childNodes[e.startOffset];
            if ($t(r))
                return F(r.getClientRects(), function(e) {
                    return zu(e, t, n)
                })
        }
        return F(e.getClientRects(), function(e) {
            return zu(e, t, n)
        })
    }
      , Zh = {
        BACKSPACE: 8,
        DELETE: 46,
        DOWN: 40,
        ENTER: 13,
        LEFT: 37,
        RIGHT: 39,
        SPACEBAR: 32,
        TAB: 9,
        UP: 38,
        END: 35,
        HOME: 36,
        modifierPressed: function(e) {
            return e.shiftKey || e.ctrlKey || e.altKey || this.metaKeyPressed(e)
        },
        metaKeyPressed: function(e) {
            return rr.mac ? e.metaKey : e.ctrlKey && !e.altKey
        }
    }
      , ev = an
      , tv = on
      , nv = function(r, s) {
        var c, l, f, a, d, m, p, g, h, v, y, b, C, w, x, S, N, E = s.dom, u = hr.each, k = s.getDoc(), _ = V.document, R = Math.abs, T = Math.round, A = s.getBody();
        a = {
            nw: [0, 0, -1, -1],
            ne: [1, 0, 1, -1],
            se: [1, 1, 1, 1],
            sw: [0, 1, -1, 1]
        };
        var D = function(e) {
            return e && ("IMG" === e.nodeName || s.dom.is(e, "figure.image"))
        }
          , n = function(e) {
            var t = e.target;
            !function(e, t) {
                if ("longpress" !== e.type && 0 !== e.type.indexOf("touch"))
                    return D(e.target) && !Qh(e.clientX, e.clientY, t);
                var n = e.touches[0];
                return D(e.target) && !Qh(n.clientX, n.clientY, t)
            }(e, s.selection.getRng()) || e.isDefaultPrevented() || s.selection.select(t)
        }
          , O = function(e) {
            return s.dom.is(e, "figure.image") ? e.querySelector("img") : e
        }
          , B = function(e) {
            var t = s.getParam("object_resizing");
            return !1 !== t && !rr.iOS && ("string" != typeof t && (t = "table,img,figure.image,div"),
            "false" !== e.getAttribute("data-mce-resize") && (e !== s.getBody() && ot(Ne.fromDom(e), t)))
        }
          , P = function(e, t, n) {
            E.setStyles(O(e), {
                width: t,
                height: n
            })
        }
          , L = function(e) {
            var t, n, r, o, i, a, u;
            t = e.screenX - m,
            n = e.screenY - p,
            w = t * d[2] + v,
            x = n * d[3] + y,
            w = w < 5 ? 5 : w,
            x = x < 5 ? 5 : x,
            (D(c) && !1 !== s.getParam("resize_img_proportional", !0, "boolean") ? !Zh.modifierPressed(e) : Zh.modifierPressed(e)) && (R(t) > R(n) ? (x = T(w * b),
            w = T(x / b)) : (w = T(x / b),
            x = T(w * b))),
            P(l, w, x),
            r = 0 < (r = d.startPos.x + t) ? r : 0,
            o = 0 < (o = d.startPos.y + n) ? o : 0,
            E.setStyles(f, {
                left: r,
                top: o,
                display: "block"
            }),
            f.innerHTML = w + " &times; " + x,
            d[2] < 0 && l.clientWidth <= w && E.setStyle(l, "left", g + (v - w)),
            d[3] < 0 && l.clientHeight <= x && E.setStyle(l, "top", h + (y - x)),
            (t = A.scrollWidth - S) + (n = A.scrollHeight - N) !== 0 && E.setStyles(f, {
                left: r - t,
                top: o - n
            }),
            C || (i = c,
            a = v,
            u = y,
            s.fire("ObjectResizeStart", {
                target: i,
                width: a,
                height: u
            }),
            C = !0)
        }
          , I = function() {
            var e = C;
            C = !1;
            var t, n, r, o = function(e, t) {
                t && (c.style[e] || !s.schema.isValid(c.nodeName.toLowerCase(), e) ? E.setStyle(O(c), e, t) : E.setAttrib(O(c), e, "" + t))
            };
            e && (o("width", w),
            o("height", x)),
            E.unbind(k, "mousemove", L),
            E.unbind(k, "mouseup", I),
            _ !== k && (E.unbind(_, "mousemove", L),
            E.unbind(_, "mouseup", I)),
            E.remove(l),
            E.remove(f),
            i(c),
            e && (t = c,
            n = w,
            r = x,
            s.fire("ObjectResized", {
                target: t,
                width: n,
                height: r
            }),
            E.setAttrib(c, "style", E.getAttrib(c, "style"))),
            s.nodeChanged()
        }
          , i = function(e) {
            var t, r, o, n, i;
            M(),
            U(),
            t = E.getPos(e, A),
            g = t.x,
            h = t.y,
            i = e.getBoundingClientRect(),
            r = i.width || i.right - i.left,
            o = i.height || i.bottom - i.top,
            c !== e && (c = e,
            w = x = 0),
            n = s.fire("ObjectSelected", {
                target: e
            }),
            B(e) && !n.isDefaultPrevented() ? u(a, function(n, e) {
                var t;
                (t = E.get("mceResizeHandle" + e)) && E.remove(t),
                t = E.add(A, "div", {
                    id: "mceResizeHandle" + e,
                    "data-mce-bogus": "all",
                    "class": "mce-resizehandle",
                    unselectable: !0,
                    style: "cursor:" + e + "-resize; margin:0; padding:0"
                }),
                11 === rr.ie && (t.contentEditable = !1),
                E.bind(t, "mousedown", function(e) {
                    var t;
                    e.stopImmediatePropagation(),
                    e.preventDefault(),
                    m = (t = e).screenX,
                    p = t.screenY,
                    v = O(c).clientWidth,
                    y = O(c).clientHeight,
                    b = y / v,
                    (d = n).startPos = {
                        x: r * n[0] + g,
                        y: o * n[1] + h
                    },
                    S = A.scrollWidth,
                    N = A.scrollHeight,
                    l = c.cloneNode(!0),
                    E.addClass(l, "mce-clonedresizable"),
                    E.setAttrib(l, "data-mce-bogus", "all"),
                    l.contentEditable = !1,
                    l.unSelectabe = !0,
                    E.setStyles(l, {
                        left: g,
                        top: h,
                        margin: 0
                    }),
                    P(l, r, o),
                    l.removeAttribute("data-mce-selected"),
                    A.appendChild(l),
                    E.bind(k, "mousemove", L),
                    E.bind(k, "mouseup", I),
                    _ !== k && (E.bind(_, "mousemove", L),
                    E.bind(_, "mouseup", I)),
                    f = E.add(A, "div", {
                        "class": "mce-resize-helper",
                        "data-mce-bogus": "all"
                    }, v + " &times; " + y)
                }),
                n.elm = t,
                E.setStyles(t, {
                    left: r * n[0] + g - t.offsetWidth / 2,
                    top: o * n[1] + h - t.offsetHeight / 2
                })
            }) : M(),
            c.setAttribute("data-mce-selected", "1")
        }
          , M = function() {
            U(),
            c && c.removeAttribute("data-mce-selected"),
            oe(a, function(e, t) {
                var n = E.get("mceResizeHandle" + t);
                n && (E.unbind(n),
                E.remove(n))
            })
        }
          , o = function(e) {
            var t, n = function(e, t) {
                if (e)
                    do {
                        if (e === t)
                            return !0
                    } while (e = e.parentNode)
            };
            C || s.removed || (u(E.select("img[data-mce-selected],hr[data-mce-selected]"), function(e) {
                e.removeAttribute("data-mce-selected")
            }),
            t = "mousedown" === e.type ? e.target : r.getNode(),
            n(t = E.$(t).closest("table,img,figure.image,hr")[0], A) && (z(),
            n(r.getStart(!0), t) && n(r.getEnd(!0), t)) ? i(t) : M())
        }
          , F = function(e) {
            return ev(function(e, t) {
                for (; t && t !== e; ) {
                    if (tv(t) || ev(t))
                        return t;
                    t = t.parentNode
                }
                return null
            }(s.getBody(), e))
        }
          , U = function() {
            oe(a, function(e) {
                e.elm && (E.unbind(e.elm),
                delete e.elm)
            })
        }
          , z = function() {
            try {
                s.getDoc().execCommand("enableObjectResizing", !1, !1)
            } catch (e) {}
        };
        s.on("init", function() {
            if (z(),
            rr.browser.isIE() || rr.browser.isEdge()) {
                s.on("mousedown click", function(e) {
                    var t = e.target
                      , n = t.nodeName;
                    C || !/^(TABLE|IMG|HR)$/.test(n) || F(t) || (2 !== e.button && s.selection.select(t, "TABLE" === n),
                    "mousedown" === e.type && s.nodeChanged())
                });
                var e = function(e) {
                    var t = function(e) {
                        Xn.setEditorTimeout(s, function() {
                            return s.selection.select(e)
                        })
                    };
                    if (F(e.target))
                        return e.preventDefault(),
                        void t(e.target);
                    /^(TABLE|IMG|HR)$/.test(e.target.nodeName) && (e.preventDefault(),
                    "IMG" === e.target.tagName && t(e.target))
                };
                E.bind(A, "mscontrolselect", e),
                s.on("remove", function() {
                    return E.unbind(A, "mscontrolselect", e)
                })
            }
            var t = Xn.throttle(function(e) {
                s.composing || o(e)
            });
            s.on("nodechange ResizeEditor ResizeWindow ResizeContent drop FullscreenStateChanged", t),
            s.on("keyup compositionend", function(e) {
                c && "TABLE" === c.nodeName && t(e)
            }),
            s.on("hide blur", M),
            s.on("contextmenu longpress", n, !0)
        }),
        s.on("remove", U);
        return {
            isResizable: B,
            showResizeRect: i,
            hideResizeRect: M,
            updateResizeRect: o,
            destroy: function() {
                c = l = null
            }
        }
    }
      , rv = function(e, t, n) {
        if (e && e.hasOwnProperty(t)) {
            var r = H(e[t], function(e) {
                return e !== n
            });
            0 === r.length ? delete e[t] : e[t] = r
        }
    };
    var ov = function(e) {
        return !!e.select
    }
      , iv = function(e) {
        return !(!e || !e.ownerDocument) && st(Ne.fromDom(e.ownerDocument), Ne.fromDom(e))
    }
      , av = function(u, s, e, c) {
        var n, t, l, f, r = function h(i, n) {
            var a, u;
            return {
                selectorChangedWithUnbind: function(e, t) {
                    return a || (a = {},
                    u = {},
                    n.on("NodeChange", function(e) {
                        var n = e.element
                          , r = i.getParents(n, null, i.getRoot())
                          , o = {};
                        hr.each(a, function(e, n) {
                            hr.each(r, function(t) {
                                if (i.is(t, n))
                                    return u[n] || (hr.each(e, function(e) {
                                        e(!0, {
                                            node: t,
                                            selector: n,
                                            parents: r
                                        })
                                    }),
                                    u[n] = e),
                                    o[n] = e,
                                    !1
                            })
                        }),
                        hr.each(u, function(e, t) {
                            o[t] || (delete u[t],
                            hr.each(e, function(e) {
                                e(!1, {
                                    node: n,
                                    selector: t,
                                    parents: r
                                })
                            }))
                        })
                    })),
                    a[e] || (a[e] = []),
                    a[e].push(t),
                    {
                        unbind: function() {
                            rv(a, e, t),
                            rv(u, e, t)
                        }
                    }
                }
            }
        }(u, c).selectorChangedWithUnbind, o = function(e, t) {
            return Yh(c, e, t)
        }, i = function(e) {
            var t = m();
            t.collapse(!!e),
            a(t)
        }, d = function() {
            return s.getSelection ? s.getSelection() : s.document.selection
        }, m = function() {
            var e, t, n, r, o = function(e, t, n) {
                try {
                    return t.compareBoundaryPoints(e, n)
                } catch (r) {
                    return -1
                }
            };
            if (!s)
                return null;
            if (null == (r = s.document))
                return null;
            if (c.bookmark !== undefined && !1 === Pm(c)) {
                var i = wm(c);
                if (i.isSome())
                    return i.map(function(e) {
                        return Fp(c, [e])[0]
                    }).getOr(r.createRange())
            }
            try {
                (e = d()) && !qt(e.anchorNode) && (t = 0 < e.rangeCount ? e.getRangeAt(0) : e.createRange ? e.createRange() : r.createRange())
            } catch (a) {}
            return (t = (t = Fp(c, [t])[0]) || (r.createRange ? r.createRange() : r.body.createTextRange())).setStart && 9 === t.startContainer.nodeType && t.collapsed && (n = u.getRoot(),
            t.setStart(n, 0),
            t.setEnd(n, 0)),
            l && f && (0 === o(t.START_TO_START, t, l) && 0 === o(t.END_TO_END, t, l) ? t = f : f = l = null),
            t
        }, a = function(e, t) {
            var n, r;
            if ((o = e) && (ov(o) || iv(o.startContainer) && iv(o.endContainer))) {
                var o, i = ov(e) ? e : null;
                if (i) {
                    f = null;
                    try {
                        i.select()
                    } catch (a) {}
                } else {
                    if (n = d(),
                    e = c.fire("SetSelectionRange", {
                        range: e,
                        forward: t
                    }).range,
                    n) {
                        f = e;
                        try {
                            n.removeAllRanges(),
                            n.addRange(e)
                        } catch (a) {}
                        !1 === t && n.extend && (n.collapse(e.endContainer, e.endOffset),
                        n.extend(e.startContainer, e.startOffset)),
                        l = 0 < n.rangeCount ? n.getRangeAt(0) : null
                    }
                    e.collapsed || e.startContainer !== e.endContainer || !n.setBaseAndExtent || rr.ie || e.endOffset - e.startOffset < 2 && e.startContainer.hasChildNodes() && (r = e.startContainer.childNodes[e.startOffset]) && "IMG" === r.tagName && (n.setBaseAndExtent(e.startContainer, e.startOffset, e.endContainer, e.endOffset),
                    n.anchorNode === e.startContainer && n.focusNode === e.endContainer || n.setBaseAndExtent(r, 0, r, 1)),
                    c.fire("AfterSetSelectionRange", {
                        range: e,
                        forward: t
                    })
                }
            }
        }, p = function() {
            var e, t, n = d();
            return !(n && n.anchorNode && n.focusNode) || ((e = u.createRng()).setStart(n.anchorNode, n.anchorOffset),
            e.collapse(!0),
            (t = u.createRng()).setStart(n.focusNode, n.focusOffset),
            t.collapse(!0),
            e.compareBoundaryPoints(e.START_TO_START, t) <= 0)
        }, g = {
            bookmarkManager: null,
            controlSelection: null,
            dom: u,
            win: s,
            serializer: e,
            editor: c,
            collapse: i,
            setCursorLocation: function(e, t) {
                var n = u.createRng();
                e ? (n.setStart(e, t),
                n.setEnd(e, t),
                a(n),
                i(!1)) : (Yl(u, n, c.getBody(), !0),
                a(n))
            },
            getContent: function(e) {
                return Fh(c, e)
            },
            setContent: o,
            getBookmark: function(e, t) {
                return n.getBookmark(e, t)
            },
            moveToBookmark: function(e) {
                return n.moveToBookmark(e)
            },
            select: function(e, t) {
                var r, n, o;
                return r = u,
                n = e,
                o = t,
                R.from(n).map(function(e) {
                    var t = r.nodeIndex(e)
                      , n = r.createRng();
                    return n.setStart(e.parentNode, t),
                    n.setEnd(e.parentNode, t + 1),
                    o && (Yl(r, n, e, !0),
                    Yl(r, n, e, !1)),
                    n
                }).each(a),
                e
            },
            isCollapsed: function() {
                var e = m()
                  , t = d();
                return !(!e || e.item) && (e.compareEndPoints ? 0 === e.compareEndPoints("StartToEnd", e) : !t || e.collapsed)
            },
            isForward: p,
            setNode: function(e) {
                return o(u.getOuterHTML(e)),
                e
            },
            getNode: function() {
                return e = c.getBody(),
                (t = m()) ? (r = t.startContainer,
                o = t.endContainer,
                i = t.startOffset,
                a = t.endOffset,
                n = t.commonAncestorContainer,
                !t.collapsed && (r === o && a - i < 2 && r.hasChildNodes() && (n = r.childNodes[i]),
                3 === r.nodeType && 3 === o.nodeType && (r = r.length === i ? Mh(r.nextSibling, !0) : r.parentNode,
                o = 0 === a ? Mh(o.previousSibling, !1) : o.parentNode,
                r && r === o)) ? r : n && 3 === n.nodeType ? n.parentNode : n) : e;
                var e, t, n, r, o, i, a
            },
            getSel: d,
            setRng: a,
            getRng: m,
            getStart: function(e) {
                return Lh(c.getBody(), m(), e)
            },
            getEnd: function(e) {
                return Ih(c.getBody(), m(), e)
            },
            getSelectedBlocks: function(e, t) {
                return function(e, t, n, r) {
                    var o, i, a = [];
                    if (i = e.getRoot(),
                    n = e.getParent(n || Lh(i, t, t.collapsed), e.isBlock),
                    r = e.getParent(r || Ih(i, t, t.collapsed), e.isBlock),
                    n && n !== i && a.push(n),
                    n && r && n !== r)
                        for (var u = new ra(o = n,i); (o = u.next()) && o !== r; )
                            e.isBlock(o) && a.push(o);
                    return r && n !== r && r !== i && a.push(r),
                    a
                }(u, m(), e, t)
            },
            normalize: function() {
                var e = m()
                  , t = d();
                if (1 < Hl(t).length || !Gl(c))
                    return e;
                var n = Wh(u, e);
                return n.each(function(e) {
                    a(e, p())
                }),
                n.getOr(e)
            },
            selectorChanged: function(e, t) {
                return r(e, t),
                g
            },
            selectorChangedWithUnbind: r,
            getScrollContainer: function() {
                for (var e, t = u.getRoot(); t && "BODY" !== t.nodeName; ) {
                    if (t.scrollHeight > t.clientHeight) {
                        e = t;
                        break
                    }
                    t = t.parentNode
                }
                return e
            },
            scrollIntoView: function(e, t) {
                return r = e,
                o = t,
                void ((n = c).inline ? Rh : Ah)(n, r, o);
                var n, r, o
            },
            placeCaretAt: function(e, t) {
                return a(Bh(e, t, c.getDoc()))
            },
            getBoundingClientRect: function() {
                var e = m();
                return e.collapsed ? ms.fromRangeStart(e).getClientRects()[0] : e.getBoundingClientRect()
            },
            destroy: function() {
                s = l = f = null,
                t.destroy()
            }
        };
        return n = Jh(g),
        t = nv(g, c),
        g.bookmarkManager = n,
        g.controlSelection = t,
        g
    }
      , uv = function(e, a, u) {
        e.addNodeFilter("font", function(e) {
            z(e, function(e) {
                var t, n = a.parse(e.attr("style")), r = e.attr("color"), o = e.attr("face"), i = e.attr("size");
                r && (n.color = r),
                o && (n["font-family"] = o),
                i && (n["font-size"] = u[parseInt(e.attr("size"), 10) - 1]),
                e.name = "span",
                e.attr("style", a.serialize(n)),
                t = e,
                z(["color", "face", "size"], function(e) {
                    t.attr(e, null)
                })
            })
        })
    }
      , sv = function(e, t) {
        var n, r = ao();
        t.convert_fonts_to_spans && uv(e, r, hr.explode(t.font_size_legacy_values)),
        n = r,
        e.addNodeFilter("strike", function(e) {
            z(e, function(e) {
                var t = n.parse(e.attr("style"));
                t["text-decoration"] = "line-through",
                e.name = "span",
                e.attr("style", n.serialize(t))
            })
        })
    }
      , cv = function(e) {
        var t, n, r = decodeURIComponent(e).split(",");
        return (n = /data:([^;]+)/.exec(r[0])) && (t = n[1]),
        {
            type: t,
            data: r[1]
        }
    }
      , lv = function(e, t) {
        var n;
        try {
            n = V.atob(t)
        } catch (pE) {
            return R.none()
        }
        for (var r = new Uint8Array(n.length), o = 0; o < r.length; o++)
            r[o] = n.charCodeAt(o);
        return R.some(new V.Blob([r],{
            type: e
        }))
    }
      , fv = function(e) {
        return 0 === e.indexOf("blob:") ? (i = e,
        new Mn(function(e, t) {
            var n = function() {
                t("Cannot convert " + i + " to Blob. Resource might not exist or is inaccessible.")
            };
            try {
                var r = new V.XMLHttpRequest;
                r.open("GET", i, !0),
                r.responseType = "blob",
                r.onload = function() {
                    200 === this.status ? e(this.response) : n()
                }
                ,
                r.onerror = n,
                r.send()
            } catch (o) {
                n()
            }
        }
        )) : 0 === e.indexOf("data:") ? (o = e,
        new Mn(function(e) {
            var t = cv(o)
              , n = t.type
              , r = t.data;
            lv(n, r).fold(function() {
                return e(new V.Blob([]))
            }, e)
        }
        )) : null;
        var i, o
    }
      , dv = 0
      , mv = function(e) {
        return (e || "blobid") + dv++
    }
      , pv = function(r, o, i, t) {
        var a, u;
        if (0 !== o.src.indexOf("blob:")) {
            var e = cv(o.src)
              , n = e.data
              , s = e.type;
            a = n,
            (u = r.getByData(a, s)) ? i({
                image: o,
                blobInfo: u
            }) : fv(o.src).then(function(e) {
                u = r.create(mv(), e, a),
                r.add(u),
                i({
                    image: o,
                    blobInfo: u
                })
            }, function(e) {
                t(e)
            })
        } else
            (u = r.getByUri(o.src)) ? i({
                image: o,
                blobInfo: u
            }) : fv(o.src).then(function(t) {
                var n;
                n = t,
                new Mn(function(e) {
                    var t = new V.FileReader;
                    t.onloadend = function() {
                        e(t.result)
                    }
                    ,
                    t.readAsDataURL(n)
                }
                ).then(function(e) {
                    a = cv(e).data,
                    u = r.create(mv(), t, a),
                    r.add(u),
                    i({
                        image: o,
                        blobInfo: u
                    })
                })
            }, function(e) {
                t(e)
            })
    };
    function gv(i, a) {
        var u = {};
        return {
            findAll: function(e, n) {
                var t, r;
                n = n || x(!0),
                t = H((r = e) ? te(r.getElementsByTagName("img")) : [], function(e) {
                    var t = e.src;
                    return !!rr.fileApi && (!e.hasAttribute("data-mce-bogus") && (!e.hasAttribute("data-mce-placeholder") && (!(!t || t === rr.transparentSrc) && (0 === t.indexOf("blob:") ? !i.isUploaded(t) && n(e) : 0 === t.indexOf("data:") && n(e)))))
                });
                var o = U(t, function(n) {
                    if (u[n.src] !== undefined)
                        return new Mn(function(t) {
                            u[n.src].then(function(e) {
                                if ("string" == typeof e)
                                    return e;
                                t({
                                    image: n,
                                    blobInfo: e.blobInfo
                                })
                            })
                        }
                        );
                    var e = new Mn(function(e, t) {
                        pv(a, n, e, t)
                    }
                    ).then(function(e) {
                        return delete u[e.image.src],
                        e
                    })["catch"](function(e) {
                        return delete u[n.src],
                        e
                    });
                    return u[n.src] = e
                });
                return Mn.all(o)
            }
        }
    }
    var hv = function(e, t, n, r) {
        (e.padd_empty_with_br || t.insert) && n[r.name] ? r.empty().append(new df("br",1)).shortEnded = !0 : r.empty().append(new df("#text",3)).value = oo
    }
      , vv = function(e, t) {
        return e && e.firstChild && e.firstChild === e.lastChild && e.firstChild.name === t
    }
      , yv = function(r, e, t, n) {
        return n.isEmpty(e, t, function(e) {
            return t = e,
            (n = r.getElementRule(t.name)) && n.paddEmpty;
            var t, n
        })
    }
      , bv = function(e, o) {
        var i = o.blob_cache
          , t = function(t) {
            var e, n, r = t.attr("src");
            (e = t).attr("src") === rr.transparentSrc || e.attr("data-mce-placeholder") || t.attr("data-mce-bogus") || ((n = /data:([^;]+);base64,([a-z0-9\+\/=]+)/i.exec(r)) ? R.some({
                type: n[1],
                data: decodeURIComponent(n[2])
            }) : R.none()).filter(function() {
                return function(e, t) {
                    if (t.images_dataimg_filter) {
                        var n = new V.Image;
                        return n.src = e.attr("src"),
                        oe(e.attributes.map, function(e, t) {
                            n.setAttribute(t, e)
                        }),
                        t.images_dataimg_filter(n)
                    }
                    return !0
                }(t, o)
            }).bind(function(e) {
                var t = e.type
                  , n = e.data;
                return R.from(i.getByData(n, t)).orThunk(function() {
                    return lv(t, n).map(function(e) {
                        var t = i.create(mv(), e, n);
                        return i.add(t),
                        t
                    })
                })
            }).each(function(e) {
                t.attr("src", e.blobUri())
            })
        };
        i && e.addAttributeFilter("src", function(e) {
            return z(e, t)
        })
    }
      , Cv = function(e, g) {
        var h = e.schema;
        g.remove_trailing_brs && e.addNodeFilter("br", function(e, t, n) {
            var r, o, i, a, u, s, c, l, f = e.length, d = hr.extend({}, h.getBlockElements()), m = h.getNonEmptyElements(), p = h.getNonEmptyElements();
            for (d.body = 1,
            r = 0; r < f; r++)
                if (i = (o = e[r]).parent,
                d[o.parent.name] && o === i.lastChild) {
                    for (u = o.prev; u; ) {
                        if ("span" !== (s = u.name) || "bookmark" !== u.attr("data-mce-type")) {
                            if ("br" !== s)
                                break;
                            if ("br" === s) {
                                o = null;
                                break
                            }
                        }
                        u = u.prev
                    }
                    o && (o.remove(),
                    yv(h, m, p, i) && (c = h.getElementRule(i.name)) && (c.removeEmpty ? i.remove() : c.paddEmpty && hv(g, n, d, i)))
                } else {
                    for (a = o; i && i.firstChild === a && i.lastChild === a && !d[(a = i).name]; )
                        i = i.parent;
                    a === i && !0 !== g.padd_empty_with_br && ((l = new df("#text",3)).value = oo,
                    o.replace(l))
                }
        }),
        e.addAttributeFilter("href", function(e) {
            var t = e.length
              , n = function(e) {
                var t = e ? hr.trim(e) : "";
                return /\b(noopener)\b/g.test(t) ? t : t.split(" ").filter(function(e) {
                    return 0 < e.length
                }).concat(["noopener"]).sort().join(" ")
            };
            if (!g.allow_unsafe_link_target)
                for (; t--; ) {
                    var r = e[t];
                    "a" === r.name && "_blank" === r.attr("target") && r.attr("rel", n(r.attr("rel")))
                }
        }),
        g.allow_html_in_named_anchor || e.addAttributeFilter("id,name", function(e) {
            for (var t, n, r, o, i = e.length; i--; )
                if ("a" === (o = e[i]).name && o.firstChild && !o.attr("href"))
                    for (r = o.parent,
                    t = o.lastChild; n = t.prev,
                    r.insert(t, o),
                    t = n; )
                        ;
        }),
        g.fix_list_elements && e.addNodeFilter("ul,ol", function(e) {
            for (var t, n, r = e.length; r--; )
                if ("ul" === (n = (t = e[r]).parent).name || "ol" === n.name)
                    if (t.prev && "li" === t.prev.name)
                        t.prev.append(t);
                    else {
                        var o = new df("li",1);
                        o.attr("style", "list-style-type: none"),
                        t.wrap(o)
                    }
        }),
        g.validate && h.getValidClasses() && e.addAttributeFilter("class", function(e) {
            for (var t, n, r, o, i, a, u, s = e.length, c = h.getValidClasses(); s--; ) {
                for (n = (t = e[s]).attr("class").split(" "),
                i = "",
                r = 0; r < n.length; r++)
                    o = n[r],
                    u = !1,
                    (a = c["*"]) && a[o] && (u = !0),
                    a = c[t.name],
                    !u && a && a[o] && (u = !0),
                    u && (i && (i += " "),
                    i += o);
                i.length || (i = null),
                t.attr("class", i)
            }
        }),
        bv(e, g)
    }
      , wv = hr.makeMap
      , xv = hr.each
      , Sv = hr.explode
      , Nv = hr.extend
      , Ev = function(R, T) {
        void 0 === T && (T = no());
        var A = {}
          , D = []
          , O = {}
          , B = {};
        (R = R || {}).validate = !("validate"in R) || R.validate,
        R.root_name = R.root_name || "body";
        var e, t, P = function(e) {
            var t, n, r;
            (n = e.name)in A && ((r = O[n]) ? r.push(e) : O[n] = [e]),
            t = D.length;
            for (; t--; )
                (n = D[t].name)in e.attributes.map && ((r = B[n]) ? r.push(e) : B[n] = [e]);
            return e
        }, n = {
            schema: T,
            addAttributeFilter: function(e, n) {
                xv(Sv(e), function(e) {
                    var t;
                    for (t = 0; t < D.length; t++)
                        if (D[t].name === e)
                            return void D[t].callbacks.push(n);
                    D.push({
                        name: e,
                        callbacks: [n]
                    })
                })
            },
            getAttributeFilters: function() {
                return [].concat(D)
            },
            addNodeFilter: function(e, n) {
                xv(Sv(e), function(e) {
                    var t = A[e];
                    t || (A[e] = t = []),
                    t.push(n)
                })
            },
            getNodeFilters: function() {
                var e = [];
                for (var t in A)
                    A.hasOwnProperty(t) && e.push({
                        name: t,
                        callbacks: A[t]
                    });
                return e
            },
            filterNode: P,
            parse: function(e, u) {
                var t, n, r, o, i, a, s, c, l, f, d, m = [];
                u = u || {},
                O = {},
                B = {},
                l = Nv(wv("script,style,head,html,body,title,meta,param"), T.getBlockElements());
                var p, g = T.getNonEmptyElements(), h = T.children, v = R.validate, y = "forced_root_block"in u ? u.forced_root_block : R.forced_root_block, b = !1 === (p = y) ? "" : !0 === p ? "p" : p, C = T.getWhiteSpaceElements(), w = /^[ \t\r\n]+/, x = /[ \t\r\n]+$/, S = /[ \t\r\n]+/g, N = /^[ \t\r\n]+$/;
                f = C.hasOwnProperty(u.context) || C.hasOwnProperty(R.root_name);
                var E = function(e, t) {
                    var n, r = new df(e,t);
                    return e in A && ((n = O[e]) ? n.push(r) : O[e] = [r]),
                    r
                }
                  , k = function(e) {
                    var t, n, r, o, i = T.getBlockElements();
                    for (t = e.prev; t && 3 === t.type; ) {
                        if (0 < (r = t.value.replace(x, "")).length)
                            return void (t.value = r);
                        if (n = t.next) {
                            if (3 === n.type && n.value.length) {
                                t = t.prev;
                                continue
                            }
                            if (!i[n.name] && "script" !== n.name && "style" !== n.name) {
                                t = t.prev;
                                continue
                            }
                        }
                        o = t.prev,
                        t.remove(),
                        t = o
                    }
                };
                t = kf({
                    validate: v,
                    allow_script_urls: R.allow_script_urls,
                    allow_conditional_comments: R.allow_conditional_comments,
                    preserve_cdata: R.preserve_cdata,
                    self_closing_elements: function(e) {
                        var t, n = {};
                        for (t in e)
                            "li" !== t && "p" !== t && (n[t] = e[t]);
                        return n
                    }(T.getSelfClosingElements()),
                    cdata: function(e) {
                        d.append(E("#cdata", 4)).value = e
                    },
                    text: function(e, t) {
                        var n, r, o;
                        f || (e = e.replace(S, " "),
                        r = d.lastChild,
                        o = l,
                        r && (o[r.name] || "br" === r.name) && (e = e.replace(w, ""))),
                        0 !== e.length && ((n = E("#text", 3)).raw = !!t,
                        d.append(n).value = e)
                    },
                    comment: function(e) {
                        d.append(E("#comment", 8)).value = e
                    },
                    pi: function(e, t) {
                        d.append(E(e, 7)).value = t,
                        k(d)
                    },
                    doctype: function(e) {
                        d.append(E("#doctype", 10)).value = e,
                        k(d)
                    },
                    start: function(e, t, n) {
                        var r, o, i, a, u;
                        if (i = v ? T.getElementRule(e) : {}) {
                            for ((r = E(i.outputName || e, 1)).attributes = t,
                            r.shortEnded = n,
                            d.append(r),
                            (u = h[d.name]) && h[r.name] && !u[r.name] && m.push(r),
                            o = D.length; o--; )
                                (a = D[o].name)in t.map && ((s = B[a]) ? s.push(r) : B[a] = [r]);
                            l[e] && k(r),
                            n || (d = r),
                            !f && C[e] && (f = !0)
                        }
                    },
                    end: function(e) {
                        var t, n, r, o, i, a;
                        if (n = v ? T.getElementRule(e) : {}) {
                            if (l[e] && !f) {
                                if ((t = d.firstChild) && 3 === t.type)
                                    if (0 < (r = t.value.replace(w, "")).length)
                                        t.value = r,
                                        t = t.next;
                                    else
                                        for (o = t.next,
                                        t.remove(),
                                        t = o; t && 3 === t.type; )
                                            r = t.value,
                                            o = t.next,
                                            0 !== r.length && !N.test(r) || (t.remove(),
                                            t = o),
                                            t = o;
                                if ((t = d.lastChild) && 3 === t.type)
                                    if (0 < (r = t.value.replace(x, "")).length)
                                        t.value = r,
                                        t = t.prev;
                                    else
                                        for (o = t.prev,
                                        t.remove(),
                                        t = o; t && 3 === t.type; )
                                            r = t.value,
                                            o = t.prev,
                                            0 !== r.length && !N.test(r) || (t.remove(),
                                            t = o),
                                            t = o
                            }
                            if (f && C[e] && (f = !1),
                            n.removeEmpty && yv(T, g, C, d))
                                return i = d.parent,
                                l[d.name] ? d.empty().remove() : d.unwrap(),
                                void (d = i);
                            n.paddEmpty && (vv(a = d, "#text") && a.firstChild.value === oo || yv(T, g, C, d)) && hv(R, u, l, d),
                            d = d.parent
                        }
                    }
                }, T);
                var _ = d = new df(u.context || R.root_name,11);
                if (t.parse(e, u.format),
                v && m.length && (u.context ? u.invalid = !0 : function(e) {
                    var t, n, r, o, i, a, u, s, c, l, f, d, m, p, g, h;
                    for (d = wv("tr,td,th,tbody,thead,tfoot,table"),
                    l = T.getNonEmptyElements(),
                    f = T.getWhiteSpaceElements(),
                    m = T.getTextBlockElements(),
                    p = T.getSpecialElements(),
                    t = 0; t < e.length; t++)
                        if ((n = e[t]).parent && !n.fixed)
                            if (m[n.name] && "li" === n.parent.name) {
                                for (g = n.next; g && m[g.name]; )
                                    g.name = "li",
                                    g.fixed = !0,
                                    n.parent.insert(g, n.parent),
                                    g = g.next;
                                n.unwrap(n)
                            } else {
                                for (o = [n],
                                r = n.parent; r && !T.isValidChild(r.name, n.name) && !d[r.name]; r = r.parent)
                                    o.push(r);
                                if (r && 1 < o.length) {
                                    for (o.reverse(),
                                    i = a = P(o[0].clone()),
                                    c = 0; c < o.length - 1; c++) {
                                        for (T.isValidChild(a.name, o[c].name) ? (u = P(o[c].clone()),
                                        a.append(u)) : u = a,
                                        s = o[c].firstChild; s && s !== o[c + 1]; )
                                            h = s.next,
                                            u.append(s),
                                            s = h;
                                        a = u
                                    }
                                    yv(T, l, f, i) ? r.insert(n, o[0], !0) : (r.insert(i, o[0], !0),
                                    r.insert(n, i)),
                                    r = o[0],
                                    (yv(T, l, f, r) || vv(r, "br")) && r.empty().remove()
                                } else if (n.parent) {
                                    if ("li" === n.name) {
                                        if ((g = n.prev) && ("ul" === g.name || "ul" === g.name)) {
                                            g.append(n);
                                            continue
                                        }
                                        if ((g = n.next) && ("ul" === g.name || "ul" === g.name)) {
                                            g.insert(n, g.firstChild, !0);
                                            continue
                                        }
                                        n.wrap(P(new df("ul",1)));
                                        continue
                                    }
                                    T.isValidChild(n.parent.name, "div") && T.isValidChild("div", n.name) ? n.wrap(P(new df("div",1))) : p[n.name] ? n.empty().remove() : n.unwrap()
                                }
                            }
                }(m)),
                b && ("body" === _.name || u.isRootContent) && function() {
                    var e, t, n = _.firstChild, r = function(e) {
                        e && ((n = e.firstChild) && 3 === n.type && (n.value = n.value.replace(w, "")),
                        (n = e.lastChild) && 3 === n.type && (n.value = n.value.replace(x, "")))
                    };
                    if (T.isValidChild(_.name, b.toLowerCase())) {
                        for (; n; )
                            e = n.next,
                            3 === n.type || 1 === n.type && "p" !== n.name && !l[n.name] && !n.attr("data-mce-type") ? (t || ((t = E(b, 1)).attr(R.forced_root_block_attrs),
                            _.insert(t, n)),
                            t.append(n)) : (r(t),
                            t = null),
                            n = e;
                        r(t)
                    }
                }(),
                !u.invalid) {
                    for (c in O)
                        if (O.hasOwnProperty(c)) {
                            for (s = A[c],
                            i = (n = O[c]).length; i--; )
                                n[i].parent || n.splice(i, 1);
                            for (r = 0,
                            o = s.length; r < o; r++)
                                s[r](n, c, u)
                        }
                    for (r = 0,
                    o = D.length; r < o; r++)
                        if ((s = D[r]).name in B) {
                            for (i = (n = B[s.name]).length; i--; )
                                n[i].parent || n.splice(i, 1);
                            for (i = 0,
                            a = s.callbacks.length; i < a; i++)
                                s.callbacks[i](n, s.name, u)
                        }
                }
                return _
            }
        };
        return Cv(n, R),
        e = n,
        (t = R).inline_styles && sv(e, t),
        n
    }
      , kv = function(e, t, n) {
        return m = n,
        (d = e) && d.hasEventListeners("PreProcess") && !m.no_events ? (o = t,
        i = n,
        f = (r = e).dom,
        o = o.cloneNode(!0),
        (a = V.document.implementation).createHTMLDocument && (u = a.createHTMLDocument(""),
        hr.each("BODY" === o.nodeName ? o.childNodes : [o], function(e) {
            u.body.appendChild(u.importNode(e, !0))
        }),
        o = "BODY" !== o.nodeName ? u.body.firstChild : u.body,
        s = f.doc,
        f.doc = u),
        c = r,
        l = pe(pe({}, i), {
            node: o
        }),
        c.fire("PreProcess", l),
        s && (f.doc = s),
        o) : t;
        var r, o, i, a, u, s, c, l, f, d, m
    }
      , _v = function(e, t, n) {
        -1 === hr.inArray(t, n) && (e.addAttributeFilter(n, function(e, t) {
            for (var n = e.length; n--; )
                e[n].attr(t, null)
        }),
        t.push(n))
    }
      , Rv = function(e, t, n, r, o) {
        var i, a, u, s, c, l, f = (i = r,
        hf(t, n).serialize(i));
        return a = e,
        s = f,
        (u = o).no_events || !a ? s : (c = a,
        l = pe(pe({}, u), {
            content: s
        }),
        c.fire("PostProcess", l).content)
    }
      , Tv = function(y, b) {
        var e = ["data-mce-selected"]
          , C = b && b.dom ? b.dom : ga.DOM
          , w = b && b.schema ? b.schema : no(y);
        y.entity_encoding = y.entity_encoding || "named",
        y.remove_trailing_brs = !("remove_trailing_brs"in y) || y.remove_trailing_brs;
        var t, s, c, x = Ev(y, w);
        s = y,
        c = C,
        (t = x).addAttributeFilter("data-mce-tabindex", function(e, t) {
            for (var n, r = e.length; r--; )
                (n = e[r]).attr("tabindex", n.attr("data-mce-tabindex")),
                n.attr(t, null)
        }),
        t.addAttributeFilter("src,href,style", function(e, t) {
            for (var n, r, o = e.length, i = "data-mce-" + t, a = s.url_converter, u = s.url_converter_scope; o--; )
                (r = (n = e[o]).attr(i)) !== undefined ? (n.attr(t, 0 < r.length ? r : null),
                n.attr(i, null)) : (r = n.attr(t),
                "style" === t ? r = c.serializeStyle(c.parseStyle(r), n.name) : a && (r = a.call(u, r, t, n.name)),
                n.attr(t, 0 < r.length ? r : null))
        }),
        t.addAttributeFilter("class", function(e) {
            for (var t, n, r = e.length; r--; )
                (n = (t = e[r]).attr("class")) && (n = t.attr("class").replace(/(?:^|\s)mce-item-\w+(?!\S)/g, ""),
                t.attr("class", 0 < n.length ? n : null))
        }),
        t.addAttributeFilter("data-mce-type", function(e, t, n) {
            for (var r, o = e.length; o--; ) {
                if ("bookmark" === (r = e[o]).attr("data-mce-type") && !n.cleanup)
                    R.from(r.firstChild).exists(function(e) {
                        return !cu(e.value)
                    }) ? r.unwrap() : r.remove()
            }
        }),
        t.addNodeFilter("noscript", function(e) {
            for (var t, n = e.length; n--; )
                (t = e[n].firstChild) && (t.value = $r.decode(t.value))
        }),
        t.addNodeFilter("script,style", function(e, t) {
            for (var n, r, o, i = e.length, a = function(e) {
                return e.replace(/(<!--\[CDATA\[|\]\]-->)/g, "\n").replace(/^[\r\n]*|[\r\n]*$/g, "").replace(/^\s*((<!--)?(\s*\/\/)?\s*<!\[CDATA\[|(<!--\s*)?\/\*\s*<!\[CDATA\[\s*\*\/|(\/\/)?\s*<!--|\/\*\s*<!--\s*\*\/)\s*[\r\n]*/gi, "").replace(/\s*(\/\*\s*\]\]>\s*\*\/(-->)?|\s*\/\/\s*\]\]>(-->)?|\/\/\s*(-->)?|\]\]>|\/\*\s*-->\s*\*\/|\s*-->\s*)\s*$/g, "")
            }; i--; )
                r = (n = e[i]).firstChild ? n.firstChild.value : "",
                "script" === t ? ((o = n.attr("type")) && n.attr("type", "mce-no/type" === o ? null : o.replace(/^mce\-/, "")),
                "xhtml" === s.element_format && 0 < r.length && (n.firstChild.value = "// <![CDATA[\n" + a(r) + "\n// ]]>")) : "xhtml" === s.element_format && 0 < r.length && (n.firstChild.value = "\x3c!--\n" + a(r) + "\n--\x3e")
        }),
        t.addNodeFilter("#comment", function(e) {
            for (var t, n = e.length; n--; )
                t = e[n],
                s.preserve_cdata && 0 === t.value.indexOf("[CDATA[") ? (t.name = "#cdata",
                t.type = 4,
                t.value = c.decode(t.value.replace(/^\[CDATA\[|\]\]$/g, ""))) : 0 === t.value.indexOf("mce:protected ") && (t.name = "#text",
                t.type = 3,
                t.raw = !0,
                t.value = unescape(t.value).substr(14))
        }),
        t.addNodeFilter("xml:namespace,input", function(e, t) {
            for (var n, r = e.length; r--; )
                7 === (n = e[r]).type ? n.remove() : 1 === n.type && ("input" !== t || n.attr("type") || n.attr("type", "text"))
        }),
        t.addAttributeFilter("data-mce-type", function(e) {
            z(e, function(e) {
                "format-caret" === e.attr("data-mce-type") && (e.isEmpty(t.schema.getNonEmptyElements()) ? e.remove() : e.unwrap())
            })
        }),
        t.addAttributeFilter("data-mce-src,data-mce-href,data-mce-style,data-mce-selected,data-mce-expando,data-mce-type,data-mce-resize,data-mce-placeholder", function(e, t) {
            for (var n = e.length; n--; )
                e[n].attr(t, null)
        });
        return {
            schema: w,
            addNodeFilter: x.addNodeFilter,
            addAttributeFilter: x.addAttributeFilter,
            serialize: function(e, t) {
                void 0 === t && (t = {});
                var n, r, o, i, a, u, s, c, l, f, d, m, p = pe({
                    format: "html"
                }, t), g = kv(b, e, p), h = (n = C,
                r = g,
                i = lu((o = p).getInner ? r.innerHTML : n.getOuterHTML(r)),
                o.selection || Or(Ne.fromDom(r)) ? i : hr.trim(i)), v = (a = x,
                u = h,
                d = (s = p).selection ? pe({
                    forced_root_block: !1
                }, s) : s,
                m = a.parse(u, d),
                (f = function(e) {
                    return e && "br" === e.name
                }
                )(c = m.lastChild) && f(l = c.prev) && (c.remove(),
                l.remove()),
                m);
                return "tree" === p.format ? v : Rv(b, y, w, v, p)
            },
            addRules: function(e) {
                w.addValidElements(e)
            },
            setRules: function(e) {
                w.setValidElements(e)
            },
            addTempAttr: N(_v, x, e),
            getTempAttrs: function() {
                return e
            },
            getNodeFilters: x.getNodeFilters,
            getAttributeFilters: x.getAttributeFilters
        }
    }
      , Av = function(e, t) {
        var n = Tv(e, t);
        return {
            schema: n.schema,
            addNodeFilter: n.addNodeFilter,
            addAttributeFilter: n.addAttributeFilter,
            serialize: n.serialize,
            addRules: n.addRules,
            setRules: n.setRules,
            addTempAttr: n.addTempAttr,
            getTempAttrs: n.getTempAttrs,
            getNodeFilters: n.getNodeFilters,
            getAttributeFilters: n.getAttributeFilters
        }
    };
    function Dv(u, s) {
        var r = {}
          , n = function(e, r, o, t) {
            var i, n;
            (i = new V.XMLHttpRequest).open("POST", s.url),
            i.withCredentials = s.credentials,
            i.upload.onprogress = function(e) {
                t(e.loaded / e.total * 100)
            }
            ,
            i.onerror = function() {
                o("Image upload failed due to a XHR Transport error. Code: " + i.status)
            }
            ,
            i.onload = function() {
                var e, t, n;
                i.status < 200 || 300 <= i.status ? o("HTTP Error: " + i.status) : (e = JSON.parse(i.responseText)) && "string" == typeof e.location ? r((t = s.basePath,
                n = e.location,
                t ? t.replace(/\/$/, "") + "/" + n.replace(/^\//, "") : n)) : o("Invalid JSON: " + i.responseText)
            }
            ,
            (n = new V.FormData).append("file", e.blob(), e.filename()),
            i.send(n)
        }
          , c = function(e, t) {
            return {
                url: t,
                blobInfo: e,
                status: !0
            }
        }
          , l = function(e, t) {
            return {
                url: "",
                blobInfo: e,
                status: !1,
                error: t
            }
        }
          , f = function(e, t) {
            hr.each(r[e], function(e) {
                e(t)
            }),
            delete r[e]
        }
          , o = function(e, n) {
            return e = hr.grep(e, function(e) {
                return !u.isUploaded(e.blobUri())
            }),
            Mn.all(hr.map(e, function(e) {
                return u.isPending(e.blobUri()) ? (t = e.blobUri(),
                new Mn(function(e) {
                    r[t] = r[t] || [],
                    r[t].push(e)
                }
                )) : (o = e,
                i = s.handler,
                a = n,
                u.markPending(o.blobUri()),
                new Mn(function(t) {
                    var n;
                    try {
                        var r = function() {
                            n && n.close()
                        };
                        i(o, function(e) {
                            r(),
                            u.markUploaded(o.blobUri(), e),
                            f(o.blobUri(), c(o, e)),
                            t(c(o, e))
                        }, function(e) {
                            r(),
                            u.removeFailed(o.blobUri()),
                            f(o.blobUri(), l(o, e)),
                            t(l(o, e))
                        }, function(e) {
                            e < 0 || 100 < e || (n = n || a()).progressBar.value(e)
                        })
                    } catch (e) {
                        t(l(o, e.message))
                    }
                }
                ));
                var o, i, a, t
            }))
        };
        return !1 === D(s.handler) && (s.handler = n),
        {
            upload: function(e, t) {
                return s.url || s.handler !== n ? o(e, t) : new Mn(function(e) {
                    e([])
                }
                )
            }
        }
    }
    var Ov = 0
      , Bv = function(e) {
        return e + Ov++ + (t = function() {
            return Math.round(4294967295 * Math.random()).toString(36)
        }
        ,
        "s" + (new Date).getTime().toString(36) + t() + t() + t());
        var t
    }
      , Pv = function(u) {
        var n, o, e, t, r, i, s = (n = [],
        o = function(e) {
            var t, n;
            if (!e.blob || !e.base64)
                throw new Error("blob and base64 representations of the image are required for BlobInfo to be created");
            return t = e.id || Bv("blobid"),
            n = e.name || t,
            {
                id: x(t),
                name: x(n),
                filename: x(n + "." + ({
                    "image/jpeg": "jpg",
                    "image/jpg": "jpg",
                    "image/gif": "gif",
                    "image/png": "png"
                }[e.blob.type.toLowerCase()] || "dat")),
                blob: x(e.blob),
                base64: x(e.base64),
                blobUri: x(e.blobUri || V.URL.createObjectURL(e.blob)),
                uri: x(e.uri)
            }
        }
        ,
        {
            create: function(e, t, n, r) {
                if (q(e))
                    return o({
                        id: e,
                        name: r,
                        blob: t,
                        base64: n
                    });
                if (E(e))
                    return o(e);
                throw new Error("Unknown input type")
            },
            add: function(e) {
                t(e.id()) || n.push(e)
            },
            get: t = function(t) {
                return e(function(e) {
                    return e.id() === t
                })
            }
            ,
            getByUri: function(t) {
                return e(function(e) {
                    return e.blobUri() === t
                })
            },
            getByData: function(t, n) {
                return e(function(e) {
                    return e.base64() === t && e.blob().type === n
                })
            },
            findFirst: e = function(e) {
                return K(n, e).getOrUndefined()
            }
            ,
            removeByUri: function(t) {
                n = H(n, function(e) {
                    return e.blobUri() !== t || (V.URL.revokeObjectURL(e.blobUri()),
                    !1)
                })
            },
            destroy: function() {
                z(n, function(e) {
                    V.URL.revokeObjectURL(e.blobUri())
                }),
                n = []
            }
        }), a = function w() {
            var n = {}
              , r = function(e, t) {
                return {
                    status: e,
                    resultUri: t
                }
            }
              , t = function(e) {
                return e in n
            };
            return {
                hasBlobUri: t,
                getResultUri: function(e) {
                    var t = n[e];
                    return t ? t.resultUri : null
                },
                isPending: function(e) {
                    return !!t(e) && 1 === n[e].status
                },
                isUploaded: function(e) {
                    return !!t(e) && 2 === n[e].status
                },
                markPending: function(e) {
                    n[e] = r(1, null)
                },
                markUploaded: function(e, t) {
                    n[e] = r(2, t)
                },
                removeFailed: function(e) {
                    delete n[e]
                },
                destroy: function() {
                    n = {}
                }
            }
        }(), c = [], l = function(t) {
            return function(e) {
                return u.selection ? t(e) : []
            }
        }, f = function(e, t, n) {
            for (var r = 0; -1 !== (r = e.indexOf(t, r)) && (e = e.substring(0, r) + n + e.substr(r + t.length),
            r += n.length - t.length + 1),
            -1 !== r; )
                ;
            return e
        }, d = function(e, t, n) {
            return e = f(e, 'src="' + t + '"', 'src="' + n + '"'),
            e = f(e, 'data-mce-src="' + t + '"', 'data-mce-src="' + n + '"')
        }, m = function(t, n) {
            z(u.undoManager.data, function(e) {
                "fragmented" === e.type ? e.fragments = U(e.fragments, function(e) {
                    return d(e, t, n)
                }) : e.content = d(e.content, t, n)
            })
        }, p = function() {
            return u.notificationManager.open({
                text: u.translate("Image uploading..."),
                type: "info",
                timeout: -1,
                progressBar: !0
            })
        }, g = function(e, t) {
            var n, r = u.convertURL(t, "src");
            m(e.src, t),
            u.$(e).attr({
                src: u.getParam("images_reuse_filename", !1, "boolean") ? (n = t) + (-1 === n.indexOf("?") ? "?" : "&") + (new Date).getTime() : t,
                "data-mce-src": r
            })
        }, h = function(n) {
            return r = r || Dv(a, {
                url: u.getParam("images_upload_url", "", "string"),
                basePath: u.getParam("images_upload_base_path", "", "string"),
                credentials: u.getParam("images_upload_credentials", !1, "boolean"),
                handler: u.getParam("images_upload_handler", null, "function")
            }),
            b().then(l(function(a) {
                var e = U(a, function(e) {
                    return e.blobInfo
                });
                return r.upload(e, p).then(l(function(e) {
                    var t = U(e, function(e, t) {
                        var n, r, o = a[t].blobInfo, i = a[t].image;
                        return e.status && u.getParam("images_replace_blob_uris", !0, "boolean") ? (s.removeByUri(i.src),
                        g(i, e.url)) : e.error && (n = u,
                        r = e.error,
                        ih(n, ka.translate(["Failed to upload image: {0}", r]))),
                        {
                            element: i,
                            status: e.status,
                            uploadUri: e.url,
                            blobInfo: o
                        }
                    });
                    return n && n(t),
                    t
                }))
            }))
        }, v = function(e) {
            if (qs(u))
                return h(e)
        }, y = function(t) {
            return !1 !== G(c, function(e) {
                return e(t)
            }) && (0 !== t.getAttribute("src").indexOf("data:") || u.getParam("images_dataimg_filter", x(!0), "function")(t))
        }, b = function() {
            return (i = i || gv(a, s)).findAll(u.getBody(), y).then(l(function(e) {
                return e = H(e, function(e) {
                    return "string" != typeof e || (ih(u, e),
                    !1)
                }),
                z(e, function(e) {
                    m(e.image.src, e.blobInfo.blobUri()),
                    e.image.src = e.blobInfo.blobUri(),
                    e.image.removeAttribute("data-mce-src")
                }),
                e
            }))
        }, C = function(e) {
            return e.replace(/src="(blob:[^"]+)"/g, function(e, n) {
                var t = a.getResultUri(n);
                if (t)
                    return 'src="' + t + '"';
                var r = s.getByUri(n);
                return (r = r || W(u.editorManager.get(), function(e, t) {
                    return e || t.editorUpload && t.editorUpload.blobCache.getByUri(n)
                }, null)) ? 'src="data:' + r.blob().type + ";base64," + r.base64() + '"' : e
            })
        };
        return u.on("SetContent", function() {
            (qs(u) ? v : b)()
        }),
        u.on("RawSaveContent", function(e) {
            e.content = C(e.content)
        }),
        u.on("GetContent", function(e) {
            e.source_view || "raw" === e.format || (e.content = C(e.content))
        }),
        u.on("PostRender", function() {
            u.parser.addNodeFilter("img", function(e) {
                z(e, function(e) {
                    var t = e.attr("src");
                    if (!s.getByUri(t)) {
                        var n = a.getResultUri(t);
                        n && e.attr("src", n)
                    }
                })
            })
        }),
        {
            blobCache: s,
            addFilter: function(e) {
                c.push(e)
            },
            uploadImages: h,
            uploadImagesAuto: v,
            scanForImages: b,
            destroy: function() {
                s.destroy(),
                a.destroy(),
                i = r = null
            }
        }
    }
      , Lv = function(r, e, t, n) {
        var o = ne(t.get())
          , i = {}
          , a = {}
          , u = H(El(r.dom, e), function(e) {
            return 1 === e.nodeType && !e.getAttribute("data-mce-bogus")
        });
        oe(n, function(e, n) {
            hr.each(u, function(t) {
                return r.formatter.matchNode(t, n, {}, e.similar) ? (-1 === o.indexOf(n) && (z(e.callbacks, function(e) {
                    e(!0, {
                        node: t,
                        format: n,
                        parents: u
                    })
                }),
                i[n] = e.callbacks),
                a[n] = e.callbacks,
                !1) : !$m(r, t, n) && void 0
            })
        });
        var s = Iv(t.get(), a, e, u);
        t.set(pe(pe({}, i), s))
    }
      , Iv = function(e, n, r, o) {
        return ce(e, function(e, t) {
            return !!me(n, t) || (z(e, function(e) {
                e(!1, {
                    node: r,
                    format: t,
                    parents: o
                })
            }),
            !1)
        }).t
    }
      , Mv = function(e, o, i, a, t) {
        var n, r, u, s, c, l, f, d;
        return null === o.get() && (r = e,
        u = xa({}),
        (n = o).set({}),
        r.on("NodeChange", function(e) {
            Lv(r, e.element, u, n.get())
        })),
        c = i,
        l = a,
        f = t,
        d = (s = o).get(),
        z(c.split(","), function(e) {
            d[e] || (d[e] = {
                similar: f,
                callbacks: []
            }),
            d[e].callbacks.push(l)
        }),
        s.set(d),
        {
            unbind: function() {
                return t = i,
                n = a,
                r = (e = o).get(),
                z(t.split(","), function(e) {
                    r[e].callbacks = H(r[e].callbacks, function(e) {
                        return e !== n
                    }),
                    0 === r[e].callbacks.length && delete r[e]
                }),
                void e.set(r);
                var e, t, n, r
            }
        }
    };
    function Fv(e) {
        var r, t, n = {}, o = function(e, t) {
            e && ("string" != typeof e ? hr.each(e, function(e, t) {
                o(t, e)
            }) : (k(t) || (t = [t]),
            hr.each(t, function(e) {
                "undefined" == typeof e.deep && (e.deep = !e.selector),
                "undefined" == typeof e.split && (e.split = !e.selector || e.inline),
                "undefined" == typeof e.remove && e.selector && !e.inline && (e.remove = "none"),
                e.selector && e.inline && (e.mixed = !0,
                e.block_expand = !0),
                "string" == typeof e.classes && (e.classes = e.classes.split(/\s+/))
            }),
            n[e] = t))
        };
        return o((r = e.dom,
        t = {
            valigntop: [{
                selector: "td,th",
                styles: {
                    verticalAlign: "top"
                }
            }],
            valignmiddle: [{
                selector: "td,th",
                styles: {
                    verticalAlign: "middle"
                }
            }],
            valignbottom: [{
                selector: "td,th",
                styles: {
                    verticalAlign: "bottom"
                }
            }],
            alignleft: [{
                selector: "figure.image",
                collapsed: !1,
                classes: "align-left",
                ceFalseOverride: !0,
                preview: "font-family font-size"
            }, {
                selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",
                styles: {
                    textAlign: "left"
                },
                inherit: !1,
                preview: !1,
                defaultBlock: "div"
            }, {
                selector: "img,table",
                collapsed: !1,
                styles: {
                    "float": "left"
                },
                preview: "font-family font-size"
            }],
            aligncenter: [{
                selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",
                styles: {
                    textAlign: "center"
                },
                inherit: !1,
                preview: "font-family font-size",
                defaultBlock: "div"
            }, {
                selector: "figure.image",
                collapsed: !1,
                classes: "align-center",
                ceFalseOverride: !0,
                preview: "font-family font-size"
            }, {
                selector: "img",
                collapsed: !1,
                styles: {
                    display: "block",
                    marginLeft: "auto",
                    marginRight: "auto"
                },
                preview: !1
            }, {
                selector: "table",
                collapsed: !1,
                styles: {
                    marginLeft: "auto",
                    marginRight: "auto"
                },
                preview: "font-family font-size"
            }],
            alignright: [{
                selector: "figure.image",
                collapsed: !1,
                classes: "align-right",
                ceFalseOverride: !0,
                preview: "font-family font-size"
            }, {
                selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",
                styles: {
                    textAlign: "right"
                },
                inherit: !1,
                preview: "font-family font-size",
                defaultBlock: "div"
            }, {
                selector: "img,table",
                collapsed: !1,
                styles: {
                    "float": "right"
                },
                preview: "font-family font-size"
            }],
            alignjustify: [{
                selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",
                styles: {
                    textAlign: "justify"
                },
                inherit: !1,
                defaultBlock: "div",
                preview: "font-family font-size"
            }],
            bold: [{
                inline: "strong",
                remove: "all",
                preserve_attributes: ["class", "style"]
            }, {
                inline: "span",
                styles: {
                    fontWeight: "bold"
                }
            }, {
                inline: "b",
                remove: "all",
                preserve_attributes: ["class", "style"]
            }],
            italic: [{
                inline: "em",
                remove: "all",
                preserve_attributes: ["class", "style"]
            }, {
                inline: "span",
                styles: {
                    fontStyle: "italic"
                }
            }, {
                inline: "i",
                remove: "all",
                preserve_attributes: ["class", "style"]
            }],
            underline: [{
                inline: "span",
                styles: {
                    textDecoration: "underline"
                },
                exact: !0
            }, {
                inline: "u",
                remove: "all",
                preserve_attributes: ["class", "style"]
            }],
            strikethrough: [{
                inline: "span",
                styles: {
                    textDecoration: "line-through"
                },
                exact: !0
            }, {
                inline: "strike",
                remove: "all",
                preserve_attributes: ["class", "style"]
            }],
            forecolor: {
                inline: "span",
                styles: {
                    color: "%value"
                },
                links: !0,
                remove_similar: !0,
                clear_child_styles: !0
            },
            hilitecolor: {
                inline: "span",
                styles: {
                    backgroundColor: "%value"
                },
                links: !0,
                remove_similar: !0,
                clear_child_styles: !0
            },
            fontname: {
                inline: "span",
                toggle: !1,
                styles: {
                    fontFamily: "%value"
                },
                clear_child_styles: !0
            },
            fontsize: {
                inline: "span",
                toggle: !1,
                styles: {
                    fontSize: "%value"
                },
                clear_child_styles: !0
            },
            fontsize_class: {
                inline: "span",
                attributes: {
                    "class": "%value"
                }
            },
            blockquote: {
                block: "blockquote",
                wrapper: !0,
                remove: "all"
            },
            subscript: {
                inline: "sub"
            },
            superscript: {
                inline: "sup"
            },
            code: {
                inline: "code"
            },
            link: {
                inline: "a",
                selector: "a",
                remove: "all",
                split: !0,
                deep: !0,
                onmatch: function() {
                    return !0
                },
                onformat: function(n, e, t) {
                    hr.each(t, function(e, t) {
                        r.setAttrib(n, t, e)
                    })
                }
            },
            removeformat: [{
                selector: "b,strong,em,i,font,u,strike,sub,sup,dfn,code,samp,kbd,var,cite,mark,q,del,ins",
                remove: "all",
                split: !0,
                expand: !1,
                block_expand: !0,
                deep: !0
            }, {
                selector: "span",
                attributes: ["style", "class"],
                remove: "empty",
                split: !0,
                expand: !1,
                deep: !0
            }, {
                selector: "*",
                attributes: ["style", "class"],
                split: !1,
                expand: !1,
                deep: !0
            }]
        },
        hr.each("p h1 h2 h3 h4 h5 h6 div address pre div dt dd samp".split(/\s/), function(e) {
            t[e] = {
                block: e,
                remove: "all"
            }
        }),
        t)),
        o(e.settings.formats),
        {
            get: function(e) {
                return e ? n[e] : n
            },
            has: function(e) {
                return me(n, e)
            },
            register: o,
            unregister: function(e) {
                return e && n[e] && delete n[e],
                n
            }
        }
    }
    var Uv, zv, jv = hr.each, Hv = ga.DOM, Vv = function(e, t) {
        var n, o, r, m = t && t.schema || no({}), p = function(e) {
            var t, n, r;
            return o = "string" == typeof e ? {
                name: e,
                classes: [],
                attrs: {}
            } : e,
            t = Hv.create(o.name),
            n = t,
            (r = o).classes.length && Hv.addClass(n, r.classes.join(" ")),
            Hv.setAttribs(n, r.attrs),
            t
        }, g = function(n, e, t) {
            var r, o, i, a, u, s, c, l, f = 0 < e.length && e[0], d = f && f.name;
            if (u = d,
            s = "string" != typeof (a = n) ? a.nodeName.toLowerCase() : a,
            c = m.getElementRule(s),
            i = !(!(l = c && c.parentsRequired) || !l.length) && (u && -1 !== hr.inArray(l, u) ? u : l[0]))
                d === i ? (o = e[0],
                e = e.slice(1)) : o = i;
            else if (f)
                o = e[0],
                e = e.slice(1);
            else if (!t)
                return n;
            return o && (r = p(o)).appendChild(n),
            t && (r || (r = Hv.create("div")).appendChild(n),
            hr.each(t, function(e) {
                var t = p(e);
                r.insertBefore(t, n)
            })),
            g(r, e, o && o.siblings)
        };
        return e && e.length ? (o = e[0],
        n = p(o),
        (r = Hv.create("div")).appendChild(g(n, e.slice(1), o.siblings)),
        r) : ""
    }, qv = function(e) {
        var t, a = {
            classes: [],
            attrs: {}
        };
        return "*" !== (e = a.selector = hr.trim(e)) && (t = e.replace(/(?:([#\.]|::?)([\w\-]+)|(\[)([^\]]+)\]?)/g, function(e, t, n, r, o) {
            switch (t) {
            case "#":
                a.attrs.id = n;
                break;
            case ".":
                a.classes.push(n);
                break;
            case ":":
                -1 !== hr.inArray("checked disabled enabled read-only required".split(" "), n) && (a.attrs[n] = n)
            }
            if ("[" === r) {
                var i = o.match(/([\w\-]+)(?:\=\"([^\"]+))?/);
                i && (a.attrs[i[1]] = i[2])
            }
            return ""
        })),
        a.name = t || "div",
        a
    }, $v = function(n, e) {
        var t, r, o, i, a, u, s = "";
        if (!1 === (u = n.settings.preview_styles))
            return "";
        "string" != typeof u && (u = "font-family font-size font-weight font-style text-decoration text-transform color background-color border border-radius outline text-shadow");
        var c, l = function(e) {
            return e.replace(/%(\w+)/g, "")
        };
        if ("string" == typeof e) {
            if (!(e = n.formatter.get(e)))
                return;
            e = e[0]
        }
        return "preview"in e && !1 === (u = e.preview) ? "" : (t = e.block || e.inline || "span",
        r = (i = (c = e.selector) && "string" == typeof c ? (c = (c = c.split(/\s*,\s*/)[0]).replace(/\s*(~\+|~|\+|>)\s*/g, "$1"),
        hr.map(c.split(/(?:>|\s+(?![^\[\]]+\]))/), function(e) {
            var t = hr.map(e.split(/(?:~\+|~|\+)/), qv)
              , n = t.pop();
            return t.length && (n.siblings = t),
            n
        }).reverse()) : []).length ? (i[0].name || (i[0].name = t),
        t = e.selector,
        Vv(i, n)) : Vv([t], n),
        o = Hv.select(t, r)[0] || r.firstChild,
        jv(e.styles, function(e, t) {
            (e = l(e)) && Hv.setStyle(o, t, e)
        }),
        jv(e.attributes, function(e, t) {
            (e = l(e)) && Hv.setAttrib(o, t, e)
        }),
        jv(e.classes, function(e) {
            e = l(e),
            Hv.hasClass(o, e) || Hv.addClass(o, e)
        }),
        n.fire("PreviewFormats"),
        Hv.setStyles(r, {
            position: "absolute",
            left: -65535
        }),
        n.getBody().appendChild(r),
        a = Hv.getStyle(n.getBody(), "fontSize", !0),
        a = /px$/.test(a) ? parseInt(a, 10) : 0,
        jv(u.split(" "), function(e) {
            var t = Hv.getStyle(o, e, !0);
            if (!("background-color" === e && /transparent|rgba\s*\([^)]+,\s*0\)/.test(t) && (t = Hv.getStyle(n.getBody(), e, !0),
            "#ffffff" === Hv.toHex(t).toLowerCase()) || "color" === e && "#000000" === Hv.toHex(t).toLowerCase())) {
                if ("font-size" === e && /em|%$/.test(t)) {
                    if (0 === a)
                        return;
                    t = parseFloat(t) / (/%$/.test(t) ? 100 : 1) * a + "px"
                }
                "border" === e && t && (s += "padding:0 2px;"),
                s += e + ":" + t + ";"
            }
        }),
        n.fire("AfterPreviewFormats"),
        Hv.remove(r),
        s)
    }, Wv = function(s) {
        var e = Fv(s)
          , t = xa(null);
        return function(e) {
            e.addShortcut("meta+b", "", "Bold"),
            e.addShortcut("meta+i", "", "Italic"),
            e.addShortcut("meta+u", "", "Underline");
            for (var t = 1; t <= 6; t++)
                e.addShortcut("access+" + t, "", ["FormatBlock", !1, "h" + t]);
            e.addShortcut("access+7", "", ["FormatBlock", !1, "p"]),
            e.addShortcut("access+8", "", ["FormatBlock", !1, "div"]),
            e.addShortcut("access+9", "", ["FormatBlock", !1, "address"])
        }(s),
        lp(s),
        {
            get: e.get,
            has: e.has,
            register: e.register,
            unregister: e.unregister,
            apply: function(e, t, n) {
                var r, o, i;
                r = e,
                o = t,
                i = n,
                wg(s).formatter.apply(r, o, i)
            },
            remove: function(e, t, n, r) {
                var o, i, a, u;
                o = e,
                i = t,
                a = n,
                u = r,
                wg(s).formatter.remove(o, i, a, u)
            },
            toggle: function(e, t, n) {
                var r, o, i;
                r = e,
                o = t,
                i = n,
                wg(s).formatter.toggle(r, o, i)
            },
            match: N(Gm, s),
            matchAll: N(Jm, s),
            matchNode: N(Ym, s),
            canApply: N(Qm, s),
            formatChanged: N(Mv, s, t),
            getCssText: N($v, s)
        }
    }, Kv = function(n, r, o) {
        var i = xa(!1)
          , a = function(e) {
            dg(r, !1, o),
            r.add({}, e)
        };
        n.on("init", function() {
            r.add()
        }),
        n.on("BeforeExecCommand", function(e) {
            var t = e.command;
            "Undo" !== t && "Redo" !== t && "mceRepaint" !== t && (mg(r, o),
            r.beforeChange())
        }),
        n.on("ExecCommand", function(e) {
            var t = e.command;
            "Undo" !== t && "Redo" !== t && "mceRepaint" !== t && a(e)
        }),
        n.on("ObjectResizeStart cut", function() {
            r.beforeChange()
        }),
        n.on("SaveContent ObjectResized blur", a),
        n.on("dragend", a),
        n.on("keyup", function(e) {
            var t = e.keyCode;
            e.isDefaultPrevented() || ((33 <= t && t <= 36 || 37 <= t && t <= 40 || 45 === t || e.ctrlKey) && (a(),
            n.nodeChanged()),
            46 !== t && 8 !== t || n.nodeChanged(),
            i.get() && r.typing && !1 === lg(ag(n), r.data[0]) && (!1 === n.isDirty() && (n.setDirty(!0),
            n.fire("change", {
                level: r.data[0],
                lastLevel: null
            })),
            n.fire("TypingUndo"),
            i.set(!1),
            n.nodeChanged()))
        }),
        n.on("keydown", function(e) {
            var t = e.keyCode;
            if (!e.isDefaultPrevented())
                if (33 <= t && t <= 36 || 37 <= t && t <= 40 || 45 === t)
                    r.typing && a(e);
                else {
                    var n = e.ctrlKey && !e.altKey || e.metaKey;
                    !(t < 16 || 20 < t) || 224 === t || 91 === t || r.typing || n || (r.beforeChange(),
                    dg(r, !0, o),
                    r.add({}, e),
                    i.set(!0))
                }
        }),
        n.on("mousedown", function(e) {
            r.typing && a(e)
        });
        n.on("input", function(e) {
            var t;
            e.inputType && ("insertReplacementText" === e.inputType || "insertText" === (t = e).inputType && null === t.data) && a(e)
        }),
        n.on("AddUndo Undo Redo ClearUndos", function(e) {
            e.isDefaultPrevented() || n.nodeChanged()
        })
    }, Xv = function(s) {
        var e, c = xa(R.none()), l = xa(0), f = xa(0), d = {
            data: [],
            typing: !1,
            beforeChange: function() {
                var e, t;
                e = l,
                t = c,
                wg(s).undoManager.beforeChange(e, t)
            },
            add: function(e, t) {
                return n = d,
                r = f,
                o = l,
                i = c,
                a = e,
                u = t,
                wg(s).undoManager.addUndoLevel(n, r, o, i, a, u);
                var n, r, o, i, a, u
            },
            undo: function() {
                return e = d,
                t = l,
                n = f,
                wg(s).undoManager.undo(e, t, n);
                var e, t, n
            },
            redo: function() {
                return e = s,
                t = f,
                n = d.data,
                wg(e).undoManager.redo(t, n);
                var e, t, n
            },
            clear: function() {
                var e, t;
                e = d,
                t = f,
                wg(s).undoManager.clear(e, t)
            },
            reset: function() {
                var e;
                e = d,
                wg(s).undoManager.reset(e)
            },
            hasUndo: function() {
                return e = d,
                t = f,
                wg(s).undoManager.hasUndo(e, t);
                var e, t
            },
            hasRedo: function() {
                return e = d,
                t = f,
                wg(s).undoManager.hasRedo(e, t);
                var e, t
            },
            transact: function(e) {
                return t = d,
                n = l,
                r = e,
                wg(s).undoManager.transact(t, n, r);
                var t, n, r
            },
            ignore: function(e) {
                var t, n;
                t = l,
                n = e,
                wg(s).undoManager.ignore(t, n)
            },
            extra: function(e, t) {
                var n, r, o, i;
                n = d,
                r = f,
                o = e,
                i = t,
                wg(s).undoManager.extra(n, r, o, i)
            }
        };
        return yg(s) || Kv(s, d, l),
        (e = s).addShortcut("meta+z", "", "Undo"),
        e.addShortcut("meta+y,meta+shift+z", "", "Redo"),
        d
    }, Yv = [9, 27, Zh.HOME, Zh.END, 19, 20, 44, 144, 145, 33, 34, 45, 16, 17, 18, 91, 92, 93, Zh.DOWN, Zh.UP, Zh.LEFT, Zh.RIGHT].concat(rr.browser.isFirefox() ? [224] : []), Gv = "data-mce-placeholder", Jv = function(e) {
        return "keydown" === e.type || "keyup" === e.type
    }, Qv = function(e) {
        var t = e.keyCode;
        return t === Zh.BACKSPACE || t === Zh.DELETE
    }, Zv = function(a) {
        var e, u = a.dom, s = Hs(a), c = (e = a).getParam("placeholder", Us.getAttrib(e.getElement(), "placeholder"), "string"), l = function(e, t) {
            if (!function(e) {
                if (Jv(e)) {
                    var t = e.keyCode;
                    return !Qv(e) && (Zh.metaKeyPressed(e) || e.altKey || 112 <= t && t <= 123 || M(Yv, t))
                }
                return !1
            }(e)) {
                var n, r, o = a.getBody(), i = !(Jv(n = e) && !(Qv(n) || "keyup" === n.type && 229 === n.keyCode)) && function(e, t, n) {
                    if (Gf(Ne.fromDom(t), !1)) {
                        var r = "" === n
                          , o = t.firstElementChild;
                        return !o || !e.getStyle(t.firstElementChild, "padding-left") && !e.getStyle(t.firstElementChild, "padding-right") && (r ? !e.isBlock(o) : n === o.nodeName.toLowerCase())
                    }
                    return !1
                }(u, o, s);
                "" !== u.getAttrib(o, Gv) === i && !t || (u.setAttrib(o, Gv, i ? c : null),
                u.setAttrib(o, "aria-placeholder", i ? c : null),
                r = i,
                a.fire("PlaceholderToggle", {
                    state: r
                }),
                a.on(i ? "keydown" : "keyup", l),
                a.off(i ? "keyup" : "keydown", l))
            }
        };
        c && a.on("init", function(e) {
            l(e, !0),
            a.on("change SetContent ExecCommand", l),
            a.on("paste", function(e) {
                return Xn.setEditorTimeout(a, function() {
                    return l(e)
                })
            }),
            a.on("remove", function() {
                var e = a.getBody();
                u.setAttrib(e, Gv, null),
                u.setAttrib(e, "aria-placeholder", null)
            })
        })
    }, ey = function(e) {
        return e.touches === undefined || 1 !== e.touches.length ? R.none() : R.some(e.touches[0])
    }, ty = function(a) {
        var u = xa(R.none())
          , s = xa(!1)
          , r = Aa(function(e) {
            a.fire("longpress", pe(pe({}, e), {
                type: "longpress"
            })),
            s.set(!0)
        }, 400);
        a.on("touchstart", function(n) {
            ey(n).each(function(e) {
                r.cancel();
                var t = {
                    x: x(e.clientX),
                    y: x(e.clientY),
                    target: x(n.target)
                };
                r.throttle(n),
                s.set(!1),
                u.set(R.some(t))
            })
        }, !0),
        a.on("touchmove", function(e) {
            r.cancel(),
            ey(e).each(function(i) {
                u.get().each(function(e) {
                    var t, n, r, o;
                    t = i,
                    n = e,
                    r = Math.abs(t.clientX - n.x()),
                    o = Math.abs(t.clientY - n.y()),
                    (5 < r || 5 < o) && (u.set(R.none()),
                    s.set(!1),
                    a.fire("longpresscancel"))
                })
            })
        }, !0),
        a.on("touchend touchcancel", function(t) {
            r.cancel(),
            "touchcancel" !== t.type && u.get().filter(function(e) {
                return e.target().isEqualNode(t.target)
            }).each(function() {
                s.get() ? t.preventDefault() : a.fire("tap", pe(pe({}, t), {
                    type: "tap"
                }))
            })
        }, !0)
    }, ny = function(e, t) {
        return e.hasOwnProperty(t.nodeName)
    }, ry = function(e, t) {
        if (Zt(t)) {
            if (0 === t.nodeValue.length)
                return !0;
            if (/^\s+$/.test(t.nodeValue) && (!t.nextSibling || ny(e, t.nextSibling)))
                return !0
        }
        return !1
    }, oy = function(e) {
        var t, n, r, o, i, a, u, s, c, l, f = e.dom, d = e.selection, m = e.schema, p = m.getBlockElements(), g = d.getStart(), h = e.getBody(), v = Hs(e);
        if (g && $t(g) && v && (l = h.nodeName.toLowerCase(),
        m.isValidChild(l, v.toLowerCase()) && (y = p,
        b = h,
        C = g,
        !F(td(Ne.fromDom(C), Ne.fromDom(b)), function(e) {
            return ny(y, e.dom())
        })))) {
            var y, b, C, w, x;
            for (n = (t = d.getRng()).startContainer,
            r = t.startOffset,
            o = t.endContainer,
            i = t.endOffset,
            c = Pm(e),
            g = h.firstChild; g; )
                if (w = p,
                Zt(x = g) || $t(x) && !ny(w, x) && !ll(x)) {
                    if (ry(p, g)) {
                        g = (u = g).nextSibling,
                        f.remove(u);
                        continue
                    }
                    a || (a = f.create(v, Vs(e)),
                    g.parentNode.insertBefore(a, g),
                    s = !0),
                    g = (u = g).nextSibling,
                    a.appendChild(u)
                } else
                    a = null,
                    g = g.nextSibling;
            s && c && (t.setStart(n, r),
            t.setEnd(o, i),
            d.setRng(t),
            e.nodeChanged())
        }
    }, iy = function(e, t, n) {
        var r = e ? 1 : -1;
        return t.setRng(ms(n.container(), n.offset() + r).toRange()),
        t.getSel().modify("move", e ? "forward" : "backward", "word"),
        !0
    }, ay = function(e, t) {
        var n = t.selection.getRng()
          , r = e ? ms.fromRangeEnd(n) : ms.fromRangeStart(n);
        return !!D(t.selection.getSel().modify) && (e && vu(r) ? iy(!0, t.selection, r) : !(e || !yu(r)) && iy(!1, t.selection, r))
    }, uy = Zt, sy = function(e) {
        return uy(e) && e.data[0] === su
    }, cy = function(e) {
        return uy(e) && e.data[e.data.length - 1] === su
    }, ly = function(e) {
        return e.ownerDocument.createTextNode(su)
    }, fy = function(e, t) {
        return (e ? function(e) {
            if (uy(e.previousSibling))
                return cy(e.previousSibling) || e.previousSibling.appendData(su),
                e.previousSibling;
            if (uy(e))
                return sy(e) || e.insertData(0, su),
                e;
            var t = ly(e);
            return e.parentNode.insertBefore(t, e),
            t
        }
        : function(e) {
            if (uy(e.nextSibling))
                return sy(e.nextSibling) || e.nextSibling.insertData(0, su),
                e.nextSibling;
            if (uy(e))
                return cy(e) || e.appendData(su),
                e;
            var t = ly(e);
            return e.nextSibling ? e.parentNode.insertBefore(t, e.nextSibling) : e.parentNode.appendChild(t),
            t
        }
        )(t)
    }, dy = N(fy, !0), my = N(fy, !1), py = function(e, t) {
        return Zt(e.container()) ? fy(t, e.container()) : fy(t, e.getNode())
    }, gy = function(e, t) {
        var n = t.get();
        return n && e.container() === n && pu(n)
    }, hy = function(n, e) {
        return e.fold(function(e) {
            rc(n.get());
            var t = dy(e);
            return n.set(t),
            R.some(ms(t, t.length - 1))
        }, function(e) {
            return Zc(e).map(function(e) {
                if (gy(e, n))
                    return ms(n.get(), 1);
                rc(n.get());
                var t = py(e, !0);
                return n.set(t),
                ms(t, 1)
            })
        }, function(e) {
            return el(e).map(function(e) {
                if (gy(e, n))
                    return ms(n.get(), n.get().length - 1);
                rc(n.get());
                var t = py(e, !1);
                return n.set(t),
                ms(t, t.length - 1)
            })
        }, function(e) {
            rc(n.get());
            var t = my(e);
            return n.set(t),
            R.some(ms(t, 1))
        })
    }, vy = /[\u0591-\u07FF\uFB1D-\uFDFF\uFE70-\uFEFC]/, yy = function(e, t) {
        return ot(Ne.fromDom(t), e.getParam("inline_boundaries_selector", "a[href],code,.mce-annotation", "string"))
    }, by = function(e) {
        return "rtl" === ga.DOM.getStyle(e, "direction", !0) || (t = e.textContent,
        vy.test(t));
        var t
    }, Cy = function(e, t, n) {
        var r, o, i, a = (r = e,
        o = t,
        i = n,
        H(ga.DOM.getParents(i.container(), "*", o), r));
        return R.from(a[a.length - 1])
    }, wy = function(e, t) {
        if (!t)
            return t;
        var n = t.container()
          , r = t.offset();
        return e ? pu(n) ? Zt(n.nextSibling) ? ms(n.nextSibling, 0) : ms.after(n) : vu(t) ? ms(n, r + 1) : t : pu(n) ? Zt(n.previousSibling) ? ms(n.previousSibling, n.previousSibling.data.length) : ms.before(n) : yu(t) ? ms(n, r - 1) : t
    }, xy = N(wy, !0), Sy = N(wy, !1), Ny = function(e, t) {
        for (var n = 0; n < e.length; n++) {
            var r = e[n].apply(null, t);
            if (r.isSome())
                return r
        }
        return R.none()
    }, Ey = hd([{
        before: ["element"]
    }, {
        start: ["element"]
    }, {
        end: ["element"]
    }, {
        after: ["element"]
    }]), ky = function(e, t) {
        var n = yc(t, e);
        return n || e
    }, _y = function(e, t, n) {
        var r = xy(n)
          , o = ky(t, r.container());
        return Cy(e, o, r).fold(function() {
            return Jc(o, r).bind(N(Cy, e, o)).map(function(e) {
                return Ey.before(e)
            })
        }, R.none)
    }, Ry = function(e, t) {
        return null === Fs(e, t)
    }, Ty = function(e, t, n) {
        return Cy(e, t, n).filter(N(Ry, t))
    }, Ay = function(e, t, n) {
        var r = Sy(n);
        return Ty(e, t, r).bind(function(e) {
            return Qc(e, r).isNone() ? R.some(Ey.start(e)) : R.none()
        })
    }, Dy = function(e, t, n) {
        var r = xy(n);
        return Ty(e, t, r).bind(function(e) {
            return Jc(e, r).isNone() ? R.some(Ey.end(e)) : R.none()
        })
    }, Oy = function(e, t, n) {
        var r = Sy(n)
          , o = ky(t, r.container());
        return Cy(e, o, r).fold(function() {
            return Qc(o, r).bind(N(Cy, e, o)).map(function(e) {
                return Ey.after(e)
            })
        }, R.none)
    }, By = function(e) {
        return !1 === by(Ly(e))
    }, Py = function(e, t, n) {
        return Ny([_y, Ay, Dy, Oy], [e, t, n]).filter(By)
    }, Ly = function(e) {
        return e.fold(d, d, d, d)
    }, Iy = function(e) {
        return e.fold(x("before"), x("start"), x("end"), x("after"))
    }, My = function(e) {
        return e.fold(Ey.before, Ey.before, Ey.after, Ey.after)
    }, Fy = function(e) {
        return e.fold(Ey.start, Ey.start, Ey.end, Ey.end)
    }, Uy = function(a, e, u, t, n, s) {
        return $u(Cy(e, u, t), Cy(e, u, n), function(e, t) {
            return e !== t && (r = t,
            o = yc(e, n = u),
            i = yc(r, n),
            o && o === i) ? Ey.after(a ? e : t) : s;
            var n, r, o, i
        }).getOr(s)
    }, zy = function(e, r) {
        return e.fold(x(!0), function(e) {
            return n = r,
            !(Iy(t = e) === Iy(n) && Ly(t) === Ly(n));
            var t, n
        })
    }, jy = function(e, t) {
        return e ? t.fold(a(R.some, Ey.start), R.none, a(R.some, Ey.after), R.none) : t.fold(R.none, a(R.some, Ey.before), R.none, a(R.some, Ey.end))
    }, Hy = function(e, a, u, s) {
        var t = wy(e, s)
          , c = Py(a, u, t);
        return Py(a, u, t).bind(N(jy, e)).orThunk(function() {
            return n = a,
            r = u,
            o = c,
            i = wy(t = e, s),
            Kc(t, r, i).map(N(wy, t)).fold(function() {
                return o.map(My)
            }, function(e) {
                return Py(n, r, e).map(N(Uy, t, n, r, i, e)).filter(N(zy, o))
            }).filter(By);
            var t, n, r, o, i
        })
    }, Vy = (N(Hy, !1),
    N(Hy, !0),
    function(e, t) {
        var n = e.dom.createRng();
        n.setStart(t.container(), t.offset()),
        n.setEnd(t.container(), t.offset()),
        e.selection.setRng(n)
    }
    ), qy = function(e) {
        return !1 !== e.settings.inline_boundaries
    }, $y = function(e, t) {
        e ? t.setAttribute("data-mce-selected", "inline-boundary") : t.removeAttribute("data-mce-selected")
    }, Wy = function(t, e, n) {
        return hy(e, n).map(function(e) {
            return Vy(t, e),
            n
        })
    }, Ky = function(e, t) {
        if (e.selection.isCollapsed() && !0 !== e.composing && t.get()) {
            var n = ms.fromRangeStart(e.selection.getRng());
            ms.isTextPosition(n) && !1 === (vu(r = n) || yu(r)) && (Vy(e, nc(t.get(), n)),
            t.set(null))
        }
        var r
    }, Xy = function(a, u, s) {
        return function() {
            return !!qy(a) && (n = u,
            e = s,
            r = (t = a).getBody(),
            o = ms.fromRangeStart(t.selection.getRng()),
            i = N(yy, t),
            Hy(e, i, r, o).bind(function(e) {
                return Wy(t, n, e)
            }).isSome());
            var t, n, e, r, o, i
        }
    }, Yy = function(e, t, n) {
        return function() {
            return !!qy(t) && ay(e, t)
        }
    }, Gy = function(u) {
        var s = xa(null)
          , c = N(yy, u);
        return u.on("NodeChange", function(e) {
            var t, n, r, o, i, a;
            !qy(u) || rr.browser.isIE() && e.initial || (t = c,
            n = u.dom,
            r = e.parents,
            o = U(Ua(Ne.fromDom(n.getRoot()), '*[data-mce-selected="inline-boundary"]'), function(e) {
                return e.dom()
            }),
            i = H(o, t),
            a = H(r, t),
            z(Q(i, a), N($y, !1)),
            z(Q(a, i), N($y, !0)),
            Ky(u, s),
            function(n, r, o, e) {
                if (r.selection.isCollapsed()) {
                    var t = H(e, n);
                    z(t, function(e) {
                        var t = ms.fromRangeStart(r.selection.getRng());
                        Py(n, r.getBody(), t).bind(function(e) {
                            return Wy(r, o, e)
                        })
                    })
                }
            }(c, u, s, e.parents))
        }),
        s
    }, Jy = N(Yy, !0), Qy = N(Yy, !1), Zy = function(e) {
        return W(e, function(e, t) {
            return e.concat(function(t) {
                var e = function(e) {
                    return U(e, function(e) {
                        return (e = Lu(e)).node = t,
                        e
                    })
                };
                if ($t(t))
                    return e(t.getClientRects());
                if (Zt(t)) {
                    var n = t.ownerDocument.createRange();
                    return n.setStart(t, 0),
                    n.setEnd(t, t.data.length),
                    e(n.getClientRects())
                }
            }(t))
        }, [])
    };
    (zv = Uv = Uv || {})[zv.Up = -1] = "Up",
    zv[zv.Down = 1] = "Down";
    var eb, tb, nb = function(o, i, a, e, u, t) {
        var n, s, c = 0, l = [], r = function(e) {
            var t, n, r;
            for (r = Zy([e]),
            -1 === o && (r = r.reverse()),
            t = 0; t < r.length; t++)
                if (n = r[t],
                !a(n, s)) {
                    if (0 < l.length && i(n, fr(l)) && c++,
                    n.line = c,
                    u(n))
                        return !0;
                    l.push(n)
                }
        };
        return (s = fr(t.getClientRects())) && (r(n = t.getNode()),
        function(e, t, n, r) {
            for (; r = vc(r, e, Bu, t); )
                if (n(r))
                    return
        }(o, e, r, n)),
        l
    }, rb = N(nb, Uv.Up, Fu, Uu), ob = N(nb, Uv.Down, Uu, Fu), ib = function(n) {
        return function(e) {
            return t = n,
            e.line > t;
            var t
        }
    }, ab = function(n) {
        return function(e) {
            return t = n,
            e.line === t;
            var t
        }
    }, ub = an, sb = vc, cb = function(e, t) {
        return Math.abs(e.left - t)
    }, lb = function(e, t) {
        return Math.abs(e.right - t)
    }, fb = function(e, t) {
        return e >= t.left && e <= t.right
    }, db = function(e, o) {
        return cr(e, function(e, t) {
            var n, r;
            return n = Math.min(cb(e, o), lb(e, o)),
            r = Math.min(cb(t, o), lb(t, o)),
            fb(o, t) || !fb(o, e) && (r === n && ub(t.node) || r < n) ? t : e
        })
    }, mb = function(e, t, n, r) {
        for (; r = sb(r, e, Bu, t); )
            if (n(r))
                return
    }, pb = function(e, t, n) {
        var r, o, i, a, u, s, c, l = Zy(H(te(e.getElementsByTagName("*")), cc)), f = H(l, function(e) {
            return n >= e.top && n <= e.bottom
        });
        return (r = (r = db(f, t)) && db((a = e,
        c = function(t, e) {
            var n;
            return n = H(Zy([e]), function(e) {
                return !t(e, u)
            }),
            s = s.concat(n),
            0 === n.length
        }
        ,
        (s = []).push(u = r),
        mb(Uv.Up, a, N(c, Fu), u.node),
        mb(Uv.Down, a, N(c, Uu), u.node),
        s), t)) && cc(r.node) ? (i = t,
        {
            node: (o = r).node,
            before: cb(o, i) < lb(o, i)
        }) : null
    }, gb = on, hb = an, vb = function(e, t, n, r, o) {
        return t._selectionOverrides.showCaret(e, n, r, o)
    }, yb = function(e, t) {
        var n, r;
        return e.fire("BeforeObjectSelected", {
            target: t
        }).isDefaultPrevented() ? null : ((r = (n = t).ownerDocument.createRange()).selectNode(n),
        r)
    }, bb = function(e, t, n) {
        var r = Ec(1, e.getBody(), t)
          , o = ms.fromRangeStart(r)
          , i = o.getNode();
        if (hb(i))
            return vb(1, e, i, !o.isAtEnd(), !1);
        var a = o.getNode(!0);
        if (hb(a))
            return vb(1, e, a, !1, !1);
        var u = e.dom.getParent(o.getNode(), function(e) {
            return hb(e) || gb(e)
        });
        return hb(u) ? vb(1, e, u, !1, n) : null
    }, Cb = function(e, t, n) {
        if (!t || !t.collapsed)
            return t;
        var r = bb(e, t, n);
        return r || t
    };
    (tb = eb = eb || {})[tb.Br = 0] = "Br",
    tb[tb.Block = 1] = "Block",
    tb[tb.Wrap = 2] = "Wrap",
    tb[tb.Eol = 3] = "Eol";
    var wb = function(e, t) {
        return e === fs.Backwards ? J(t) : t
    }
      , xb = function(e, t, n, r) {
        for (var o, i, a, u, s, c, l = Hc(n), f = r, d = []; f && (s = l,
        c = f,
        o = t === fs.Forwards ? s.next(c) : s.prev(c)); ) {
            if (rn(o.getNode(!1)))
                return t === fs.Forwards ? {
                    positions: wb(t, d).concat([o]),
                    breakType: eb.Br,
                    breakAt: R.some(o)
                } : {
                    positions: wb(t, d),
                    breakType: eb.Br,
                    breakAt: R.some(o)
                };
            if (o.isVisible()) {
                if (e(f, o)) {
                    var m = (i = t,
                    a = f,
                    rn((u = o).getNode(i === fs.Forwards)) ? eb.Br : !1 === bc(a, u) ? eb.Block : eb.Wrap);
                    return {
                        positions: wb(t, d),
                        breakType: m,
                        breakAt: R.some(o)
                    }
                }
                d.push(o),
                f = o
            } else
                f = o
        }
        return {
            positions: wb(t, d),
            breakType: eb.Eol,
            breakAt: R.none()
        }
    }
      , Sb = function(n, r, o, e) {
        return r(o, e).breakAt.map(function(e) {
            var t = r(o, e).positions;
            return n === fs.Backwards ? t.concat(e) : [e].concat(t)
        }).getOr([])
    }
      , Nb = function(e, i) {
        return W(e, function(e, o) {
            return e.fold(function() {
                return R.some(o)
            }, function(r) {
                return $u(Z(r.getClientRects()), Z(o.getClientRects()), function(e, t) {
                    var n = Math.abs(i - e.left);
                    return Math.abs(i - t.left) <= n ? o : r
                }).or(e)
            })
        }, R.none())
    }
      , Eb = function(t, e) {
        return Z(e.getClientRects()).bind(function(e) {
            return Nb(t, e.left)
        })
    }
      , kb = N(xb, ls.isAbove, -1)
      , _b = N(xb, ls.isBelow, 1)
      , Rb = N(Sb, -1, kb)
      , Tb = N(Sb, 1, _b)
      , Ab = an
      , Db = ju
      , Ob = function(e, t, n, r) {
        var o = e === fs.Forwards
          , i = o ? Vf : qf;
        if (!r.collapsed) {
            var a = Db(r);
            if (Ab(a))
                return vb(e, t, a, e === fs.Backwards, !0)
        }
        var u = mu(r.startContainer)
          , s = _c(e, t.getBody(), r);
        if (i(s))
            return yb(t, s.getNode(!o));
        var c = wy(o, n(s));
        if (!c)
            return u ? r : null;
        if (i(c))
            return vb(e, t, c.getNode(!o), o, !0);
        var l = n(c);
        return l && i(l) && Ac(c, l) ? vb(e, t, l.getNode(!o), o, !0) : u ? Cb(t, c.toRange(), !0) : null
    }
      , Bb = function(e, t, n, r) {
        var o, i, a, u, s, c, l, f, d;
        if (d = Db(r),
        o = _c(e, t.getBody(), r),
        i = n(t.getBody(), ib(1), o),
        a = H(i, ab(1)),
        s = fr(o.getClientRects()),
        (Vf(o) || jf(o)) && (d = o.getNode()),
        (qf(o) || Hf(o)) && (d = o.getNode(!0)),
        !s)
            return null;
        if (c = s.left,
        (u = db(a, c)) && Ab(u.node))
            return l = Math.abs(c - u.left),
            f = Math.abs(c - u.right),
            vb(e, t, u.node, l < f, !0);
        if (d) {
            var m = function(e, t, n, r) {
                var o, i, a, u, s, c, l = Hc(t), f = [], d = 0, m = function(e) {
                    return fr(e.getClientRects())
                };
                c = m(u = 1 === e ? (o = l.next,
                i = Uu,
                a = Fu,
                ms.after(r)) : (o = l.prev,
                i = Fu,
                a = Uu,
                ms.before(r)));
                do {
                    if (u.isVisible() && !a(s = m(u), c)) {
                        if (0 < f.length && i(s, fr(f)) && d++,
                        (s = Lu(s)).position = u,
                        s.line = d,
                        n(s))
                            return f;
                        f.push(s)
                    }
                } while (u = o(u));return f
            }(e, t.getBody(), ib(1), d);
            if (u = db(H(m, ab(1)), c))
                return Cb(t, u.position.toRange(), !0);
            if (u = fr(H(m, ab(0))))
                return Cb(t, u.position.toRange(), !0)
        }
    }
      , Pb = function(e, t, n) {
        var r, o, i, a, u = Hc(e.getBody()), s = N(Tc, u.next), c = N(Tc, u.prev);
        if (n.collapsed && e.settings.forced_root_block) {
            if (!(r = e.dom.getParent(n.startContainer, "PRE")))
                return;
            (1 === t ? s : c)(ms.fromRangeStart(n)) || (a = (i = e).dom.create(Hs(i)),
            (!rr.ie || 11 <= rr.ie) && (a.innerHTML = '<br data-mce-bogus="1">'),
            o = a,
            1 === t ? e.$(r).after(o) : e.$(r).before(o),
            e.selection.select(o, !0),
            e.selection.collapse())
        }
    }
      , Lb = function(l, f) {
        return function() {
            var e, t, n, r, o, i, a, u, s, c = (t = f,
            r = Hc((e = l).getBody()),
            o = N(Tc, r.next),
            i = N(Tc, r.prev),
            a = t ? fs.Forwards : fs.Backwards,
            u = t ? o : i,
            s = e.selection.getRng(),
            (n = Ob(a, e, u, s)) ? n : (n = Pb(e, a, s)) || null);
            return !!c && (l.selection.setRng(c),
            !0)
        }
    }
      , Ib = function(u, s) {
        return function() {
            var e, t, n, r, o, i, a = (r = (t = s) ? 1 : -1,
            o = t ? ob : rb,
            i = (e = u).selection.getRng(),
            (n = Bb(r, e, o, i)) ? n : (n = Pb(e, r, i)) || null);
            return !!a && (u.selection.setRng(a),
            !0)
        }
    }
      , Mb = function(r, o) {
        return function() {
            var t, e = o ? ms.fromRangeEnd(r.selection.getRng()) : ms.fromRangeStart(r.selection.getRng()), n = (o ? _b : kb)(r.getBody(), e);
            return (o ? ee : Z)(n.positions).filter((t = o,
            function(e) {
                return (t ? qf : Vf)(e)
            }
            )).fold(x(!1), function(e) {
                return r.selection.setRng(e.toRange()),
                !0
            })
        }
    }
      , Fb = function(o, e) {
        return Y(e, function(e) {
            var t, n, r = (t = Lu(e.getBoundingClientRect()),
            n = -1,
            {
                left: t.left - n,
                top: t.top - n,
                right: t.right + 2 * n,
                bottom: t.bottom + 2 * n,
                width: t.width + n,
                height: t.height + n
            });
            return [{
                x: r.left,
                y: o(r),
                cell: e
            }, {
                x: r.right,
                y: o(r),
                cell: e
            }]
        })
    }
      , Ub = function(e, t, n, r, o) {
        var i, a, u = Ua(Ne.fromDom(n), "td,th,caption").map(function(e) {
            return e.dom()
        }), s = H(Fb(e, u), function(e) {
            return t(e, o)
        });
        return i = r,
        a = o,
        W(s, function(e, r) {
            return e.fold(function() {
                return R.some(r)
            }, function(e) {
                var t = Math.sqrt(Math.abs(e.x - i) + Math.abs(e.y - a))
                  , n = Math.sqrt(Math.abs(r.x - i) + Math.abs(r.y - a));
                return R.some(n < t ? r : e)
            })
        }, R.none()).map(function(e) {
            return e.cell
        })
    }
      , zb = N(Ub, function(e) {
        return e.bottom
    }, function(e, t) {
        return e.y < t
    })
      , jb = N(Ub, function(e) {
        return e.top
    }, function(e, t) {
        return e.y > t
    })
      , Hb = function(t, n) {
        return Z(n.getClientRects()).bind(function(e) {
            return zb(t, e.left, e.top)
        }).bind(function(e) {
            return Eb(el(t = e).map(function(e) {
                return kb(t, e).positions.concat(e)
            }).getOr([]), n);
            var t
        })
    }
      , Vb = function(t, n) {
        return ee(n.getClientRects()).bind(function(e) {
            return jb(t, e.left, e.top)
        }).bind(function(e) {
            return Eb(Zc(t = e).map(function(e) {
                return [e].concat(_b(t, e).positions)
            }).getOr([]), n);
            var t
        })
    }
      , qb = function(e, t) {
        e.selection.setRng(t),
        Dh(e, t)
    }
      , $b = function(e, t, n) {
        var r, o, i, a, u = e(t, n);
        return (a = u).breakType === eb.Wrap && 0 === a.positions.length || !rn(n.getNode()) && ((i = u).breakType === eb.Br && 1 === i.positions.length) ? (r = e,
        o = t,
        !u.breakAt.map(function(e) {
            return r(o, e).breakAt.isSome()
        }).getOr(!1)) : u.breakAt.isNone()
    }
      , Wb = N($b, kb)
      , Kb = N($b, _b)
      , Xb = function(e, t, n, r) {
        var o, i, a, u, s = e.selection.getRng(), c = t ? 1 : -1;
        if (sc() && (o = t,
        i = s,
        a = n,
        u = ms.fromRangeStart(i),
        Gc(!o, a).map(function(e) {
            return e.isEqual(u)
        }).getOr(!1))) {
            var l = vb(c, e, n, !t, !0);
            return qb(e, l),
            !0
        }
        return !1
    }
      , Yb = function(e, t) {
        var n = t.getNode(e);
        return $t(n) && "TABLE" === n.nodeName ? R.some(n) : R.none()
    }
      , Gb = function(u, s, c) {
        var e = Yb(!!s, c)
          , t = !1 === s;
        e.fold(function() {
            return qb(u, c.toRange())
        }, function(a) {
            return Gc(t, u.getBody()).filter(function(e) {
                return e.isEqual(c)
            }).fold(function() {
                return qb(u, c.toRange())
            }, function(e) {
                return n = s,
                o = a,
                t = c,
                void ((i = Hs(r = u)) ? r.undoManager.transact(function() {
                    var e = Ne.fromTag(i);
                    ln(e, Vs(r)),
                    St(e, Ne.fromTag("br")),
                    (n ? wt : Ct)(Ne.fromDom(o), e);
                    var t = r.dom.createRng();
                    t.setStart(e.dom(), 0),
                    t.setEnd(e.dom(), 0),
                    qb(r, t)
                }) : qb(r, t.toRange()));
                var n, r, o, t, i
            })
        })
    }
      , Jb = function(e, t, n, r) {
        var o, i, a, u, s, c, l = e.selection.getRng(), f = ms.fromRangeStart(l), d = e.getBody();
        if (!t && Wb(r, f)) {
            var m = (u = d,
            Hb(s = n, c = f).orThunk(function() {
                return Z(c.getClientRects()).bind(function(e) {
                    return Nb(Rb(u, ms.before(s)), e.left)
                })
            }).getOr(ms.before(s)));
            return Gb(e, t, m),
            !0
        }
        if (t && Kb(r, f)) {
            m = (o = d,
            Vb(i = n, a = f).orThunk(function() {
                return Z(a.getClientRects()).bind(function(e) {
                    return Nb(Tb(o, ms.after(i)), e.left)
                })
            }).getOr(ms.after(i)));
            return Gb(e, t, m),
            !0
        }
        return !1
    }
      , Qb = function(t, n) {
        return function() {
            return R.from(t.dom.getParent(t.selection.getNode(), "td,th")).bind(function(e) {
                return R.from(t.dom.getParent(e, "table")).map(function(e) {
                    return Xb(t, n, e)
                })
            }).getOr(!1)
        }
    }
      , Zb = function(n, r) {
        return function() {
            return R.from(n.dom.getParent(n.selection.getNode(), "td,th")).bind(function(t) {
                return R.from(n.dom.getParent(t, "table")).map(function(e) {
                    return Jb(n, r, e, t)
                })
            }).getOr(!1)
        }
    }
      , eC = function(e) {
        return M(["figcaption"], Rt(e))
    }
      , tC = function(e) {
        var t = V.document.createRange();
        return t.setStartBefore(e.dom()),
        t.setEndBefore(e.dom()),
        t
    }
      , nC = function(e, t, n) {
        (n ? St : xt)(e, t)
    }
      , rC = function(e, t, n, r) {
        return "" === t ? (l = e,
        f = r,
        d = Ne.fromTag("br"),
        nC(l, d, f),
        tC(d)) : (o = e,
        i = r,
        a = t,
        u = n,
        s = Ne.fromTag(a),
        c = Ne.fromTag("br"),
        ln(s, u),
        St(s, c),
        nC(o, s, i),
        tC(c));
        var o, i, a, u, s, c, l, f, d
    }
      , oC = function(e, t, n) {
        return t ? (o = e.dom(),
        _b(o, n).breakAt.isNone()) : (r = e.dom(),
        kb(r, n).breakAt.isNone());
        var r, o
    }
      , iC = function(t, n) {
        var e, r, o = Ne.fromDom(t.getBody()), i = ms.fromRangeStart(t.selection.getRng()), a = Hs(t), u = Vs(t);
        return e = i,
        r = N(at, o),
        Va(Ne.fromDom(e.container()), Sr, r).filter(eC).exists(function() {
            if (oC(o, n, i)) {
                var e = rC(o, a, u, n);
                return t.selection.setRng(e),
                !0
            }
            return !1
        })
    }
      , aC = function(e, t) {
        return function() {
            return !!e.selection.isCollapsed() && iC(e, t)
        }
    }
      , uC = function(e, r) {
        return Y(U(e, function(e) {
            return pe({
                shiftKey: !1,
                altKey: !1,
                ctrlKey: !1,
                metaKey: !1,
                keyCode: 0,
                action: f
            }, e)
        }), function(e) {
            return t = e,
            (n = r).keyCode === t.keyCode && n.shiftKey === t.shiftKey && n.altKey === t.altKey && n.ctrlKey === t.ctrlKey && n.metaKey === t.metaKey ? [e] : [];
            var t, n
        })
    }
      , sC = function(e) {
        for (var t = [], n = 1; n < arguments.length; n++)
            t[n - 1] = arguments[n];
        return function() {
            return e.apply(null, t)
        }
    }
      , cC = function(e, t) {
        return K(uC(e, t), function(e) {
            return e.action()
        })
    }
      , lC = function(i, a) {
        i.on("keydown", function(e) {
            var t, n, r, o;
            !1 === e.isDefaultPrevented() && (t = i,
            n = a,
            r = e,
            o = nt().os,
            cC([{
                keyCode: Zh.RIGHT,
                action: Lb(t, !0)
            }, {
                keyCode: Zh.LEFT,
                action: Lb(t, !1)
            }, {
                keyCode: Zh.UP,
                action: Ib(t, !1)
            }, {
                keyCode: Zh.DOWN,
                action: Ib(t, !0)
            }, {
                keyCode: Zh.RIGHT,
                action: Qb(t, !0)
            }, {
                keyCode: Zh.LEFT,
                action: Qb(t, !1)
            }, {
                keyCode: Zh.UP,
                action: Zb(t, !1)
            }, {
                keyCode: Zh.DOWN,
                action: Zb(t, !0)
            }, {
                keyCode: Zh.RIGHT,
                action: Xy(t, n, !0)
            }, {
                keyCode: Zh.LEFT,
                action: Xy(t, n, !1)
            }, {
                keyCode: Zh.RIGHT,
                ctrlKey: !o.isOSX(),
                altKey: o.isOSX(),
                action: Jy(t, n)
            }, {
                keyCode: Zh.LEFT,
                ctrlKey: !o.isOSX(),
                altKey: o.isOSX(),
                action: Qy(t, n)
            }, {
                keyCode: Zh.UP,
                action: aC(t, !1)
            }, {
                keyCode: Zh.DOWN,
                action: aC(t, !0)
            }], r).each(function(e) {
                r.preventDefault()
            }))
        })
    }
      , fC = function(e, t) {
        return st(e, t) ? Va(t, function(e) {
            return kr(e) || Rr(e)
        }, (n = e,
        function(e) {
            return at(n, Ne.fromDom(e.dom().parentNode))
        }
        )) : R.none();
        var n
    }
      , dC = function(e) {
        var t, n, r;
        e.dom.isEmpty(e.getBody()) && (e.setContent(""),
        n = (t = e).getBody(),
        r = n.firstChild && t.dom.isBlock(n.firstChild) ? n.firstChild : n,
        t.selection.setCursorLocation(r, 0))
    }
      , mC = function(e, t) {
        return {
            from: e,
            to: t
        }
    }
      , pC = function(e, t) {
        var n = Ne.fromDom(e)
          , r = Ne.fromDom(t.container());
        return fC(n, r).map(function(e) {
            return {
                block: e,
                position: t
            }
        })
    }
      , gC = function(o, i, e) {
        var t = pC(o, ms.fromRangeStart(e))
          , n = t.bind(function(e) {
            return Kc(i, o, e.position).bind(function(e) {
                return pC(o, e).map(function(e) {
                    return t = o,
                    n = i,
                    rn((r = e).position.getNode()) && !1 === Gf(r.block) ? Gc(!1, r.block.dom()).bind(function(e) {
                        return e.isEqual(r.position) ? Kc(n, t, e).bind(function(e) {
                            return pC(t, e)
                        }) : R.some(r)
                    }).getOr(r) : r;
                    var t, n, r
                })
            })
        });
        return $u(t, n, mC).filter(function(e) {
            return !1 === at((r = e).from.block, r.to.block) && ft((n = e).from.block).bind(function(t) {
                return ft(n.to.block).filter(function(e) {
                    return at(t, e)
                })
            }).isSome() && (!1 === an((t = e).from.block.dom()) && !1 === an(t.to.block.dom()));
            var t, n, r
        })
    }
      , hC = function(e) {
        var t, n = (t = ht(e),
        X(t, Sr).fold(function() {
            return t
        }, function(e) {
            return t.slice(0, e)
        }));
        return z(n, kt),
        n
    }
      , vC = function(e, t) {
        var n = nd(t, e);
        return K(n.reverse(), function(e) {
            return Gf(e)
        }).each(kt)
    }
      , yC = function(e, t, n, r) {
        if (Gf(n))
            return Qf(n),
            Zc(n.dom());
        0 === H(pt(r), function(e) {
            return !Gf(e)
        }).length && Gf(t) && Ct(r, Ne.fromTag("br"));
        var o = Qc(n.dom(), ms.before(r.dom()));
        return z(hC(t), function(e) {
            Ct(r, e)
        }),
        vC(e, t),
        o
    }
      , bC = function(e, t, n) {
        if (Gf(n))
            return kt(n),
            Gf(t) && Qf(t),
            Zc(t.dom());
        var r = el(n.dom());
        return z(hC(t), function(e) {
            St(n, e)
        }),
        vC(e, t),
        r
    }
      , CC = function(e, t) {
        return st(t, e) ? (n = nd(e, t),
        R.from(n[n.length - 1])) : R.none();
        var n
    }
      , wC = function(e, t) {
        Gc(e, t.dom()).map(function(e) {
            return e.getNode()
        }).map(Ne.fromDom).filter(Er).each(kt)
    }
      , xC = function(e, t, n) {
        return wC(!0, t),
        wC(!1, n),
        CC(t, n).fold(N(bC, e, t, n), N(yC, e, t, n))
    }
      , SC = function(e, t, n, r) {
        return t ? xC(e, r, n) : xC(e, n, r)
    }
      , NC = function(t, n) {
        var e, r, o, i = Ne.fromDom(t.getBody()), a = (e = i.dom(),
        r = n,
        ((o = t.selection.getRng()).collapsed ? gC(e, r, o) : R.none()).bind(function(e) {
            return SC(i, n, e.from.block, e.to.block)
        }));
        return a.each(function(e) {
            t.selection.setRng(e.toRange())
        }),
        a.isSome()
    }
      , EC = function(e, t) {
        var n = Ne.fromDom(t)
          , r = N(at, e);
        return Ha(n, Dr, r).isSome()
    }
      , kC = function(e, t) {
        var n, r, o = Qc(e.dom(), ms.fromRangeStart(t)).isNone(), i = Jc(e.dom(), ms.fromRangeEnd(t)).isNone();
        return !(EC(n = e, (r = t).startContainer) || EC(n, r.endContainer)) && o && i
    }
      , _C = function(e) {
        var n, r, o, t, i = Ne.fromDom(e.getBody()), a = e.selection.getRng();
        return kC(i, a) ? ((t = e).setContent(""),
        t.selection.setCursorLocation(),
        !0) : (n = i,
        r = e.selection,
        o = r.getRng(),
        $u(fC(n, Ne.fromDom(o.startContainer)), fC(n, Ne.fromDom(o.endContainer)), function(e, t) {
            return !1 === at(e, t) && (o.deleteContents(),
            SC(n, !0, e, t).each(function(e) {
                r.setRng(e.toRange())
            }),
            !0)
        }).getOr(!1))
    }
      , RC = function(e, t) {
        return !e.selection.isCollapsed() && _C(e)
    }
      , TC = function(e) {
        return Rc(e).exists(Er)
    }
      , AC = function(e, t, n) {
        var r = H(nd(Ne.fromDom(n.container()), t), Sr)
          , o = Z(r).getOr(t);
        return Kc(e, o.dom(), n).filter(TC)
    }
      , DC = function(e, t) {
        return Rc(t).exists(Er) || AC(!0, e, t).isSome()
    }
      , OC = function(e, t) {
        return n = t,
        R.from(n.getNode(!0)).map(Ne.fromDom).exists(Er) || AC(!1, e, t).isSome();
        var n
    }
      , BC = N(AC, !1)
      , PC = N(AC, !0)
      , LC = hd([{
        remove: ["element"]
    }, {
        moveToElement: ["element"]
    }, {
        moveToPosition: ["position"]
    }])
      , IC = function(e, t, n, r) {
        var o = r.getNode(!1 === t);
        return fC(Ne.fromDom(e), Ne.fromDom(n.getNode())).map(function(e) {
            return Gf(e) ? LC.remove(e.dom()) : LC.moveToElement(o)
        }).orThunk(function() {
            return R.some(LC.moveToElement(o))
        })
    }
      , MC = function(u, s, c) {
        return Kc(s, u, c).bind(function(e) {
            return a = e.getNode(),
            Dr(Ne.fromDom(a)) || Rr(Ne.fromDom(a)) ? R.none() : (t = u,
            o = e,
            i = function(e) {
                return Nr(Ne.fromDom(e)) && !bc(r, o, t)
            }
            ,
            kc(!(n = s), r = c).fold(function() {
                return kc(n, o).fold(x(!1), i)
            }, i) ? R.none() : s && an(e.getNode()) || !1 === s && an(e.getNode(!0)) ? IC(u, s, c, e) : s && qf(c) || !1 === s && Vf(c) ? R.some(LC.moveToPosition(e)) : R.none());
            var t, n, r, o, i, a
        })
    }
      , FC = function(r, e, o) {
        return i = e,
        a = o.getNode(!1 === i),
        u = i ? "after" : "before",
        $t(a) && a.getAttribute("data-mce-caret") === u ? (t = e,
        n = o.getNode(!1 === e),
        (t && an(n.nextSibling) ? R.some(LC.moveToElement(n.nextSibling)) : !1 === t && an(n.previousSibling) ? R.some(LC.moveToElement(n.previousSibling)) : R.none()).fold(function() {
            return MC(r, e, o)
        }, R.some)) : MC(r, e, o).bind(function(e) {
            return t = r,
            n = o,
            e.fold(function(e) {
                return R.some(LC.remove(e))
            }, function(e) {
                return R.some(LC.moveToElement(e))
            }, function(e) {
                return bc(n, e, t) ? R.none() : R.some(LC.moveToPosition(e))
            });
            var t, n
        });
        var t, n, i, a, u
    }
      , UC = function(e, t) {
        return R.from(HC(e.getBody(), t))
    }
      , zC = function(a, u) {
        var e = a.selection.getNode();
        return UC(a, e).filter(an).fold(function() {
            var e, t, n, r, o, i;
            return (e = a.getBody(),
            t = u,
            n = a.selection.getRng(),
            r = Ec(t ? 1 : -1, e, n),
            o = ms.fromRangeStart(r),
            i = Ne.fromDom(e),
            (!1 === t && qf(o) ? R.some(LC.remove(o.getNode(!0))) : t && Vf(o) ? R.some(LC.remove(o.getNode())) : !1 === t && Vf(o) && OC(i, o) ? BC(i, o).map(function(e) {
                return LC.remove(e.getNode())
            }) : t && qf(o) && DC(i, o) ? PC(i, o).map(function(e) {
                return LC.remove(e.getNode())
            }) : FC(e, t, o)).map(function(e) {
                return e.fold(function(e) {
                    return o._selectionOverrides.hideFakeCaret(),
                    gd(o, i, Ne.fromDom(e)),
                    !0
                }, (r = i = u,
                function(e) {
                    var t = r ? ms.before(e) : ms.after(e);
                    return n.selection.setRng(t.toRange()),
                    !0
                }
                ), (t = n = o = a,
                function(e) {
                    return t.selection.setRng(e.toRange()),
                    !0
                }
                ));
                var t, n, r, o, i
            })).getOr(!1)
        }, function() {
            return !0
        })
    }
      , jC = function(t, n) {
        var e = t.selection.getNode();
        return !!an(e) && UC(t, e.parentNode).filter(an).fold(function() {
            var e;
            return e = Ne.fromDom(t.getBody()),
            z(Ua(e, ".mce-offscreen-selection"), kt),
            gd(t, n, Ne.fromDom(t.selection.getNode())),
            dC(t),
            !0
        }, function() {
            return !0
        })
    }
      , HC = function(e, t) {
        for (; t && t !== e; ) {
            if (on(t) || an(t))
                return t;
            t = t.parentNode
        }
        return null
    }
      , VC = function(e) {
        var t, n = HC(e.getBody(), e.selection.getNode());
        return on(n) && e.dom.isBlock(n) && e.dom.isEmpty(n) && (t = e.dom.create("br", {
            "data-mce-bogus": "1"
        }),
        e.dom.setHTML(n, ""),
        n.appendChild(t),
        e.selection.setRng(ms.before(t).toRange())),
        !0
    }
      , qC = function(e, t) {
        return (e.selection.isCollapsed() ? zC : jC)(e, t)
    }
      , $C = function(e, t, n, r, o, i) {
        var a, u, s = vb(r, e, i.getNode(!o), o, !0);
        if (t.collapsed) {
            var c = t.cloneRange();
            o ? c.setEnd(s.startContainer, s.startOffset) : c.setStart(s.endContainer, s.endOffset),
            c.deleteContents()
        } else
            t.deleteContents();
        return e.selection.setRng(s),
        a = e.dom,
        Zt(u = n) && 0 === u.data.length && a.remove(u),
        !0
    }
      , WC = function(e, t) {
        return function(e, t) {
            var n = e.selection.getRng();
            if (!Zt(n.commonAncestorContainer))
                return !1;
            var r = t ? fs.Forwards : fs.Backwards
              , o = Hc(e.getBody())
              , i = N(Tc, o.next)
              , a = N(Tc, o.prev)
              , u = t ? i : a
              , s = t ? Vf : qf
              , c = _c(r, e.getBody(), n)
              , l = wy(t, u(c));
            if (!l || !Ac(c, l))
                return !1;
            if (s(l))
                return $C(e, n, c.getNode(), r, t, l);
            var f = u(l);
            return !!(f && s(f) && Ac(l, f)) && $C(e, n, c.getNode(), r, t, f)
        }(e, t)
    }
      , KC = function(t, n) {
        return function(e) {
            return hy(n, e).map(function(e) {
                return Vy(t, e),
                !0
            }).getOr(!1)
        }
    }
      , XC = function(r, o, i, a) {
        var u = r.getBody()
          , s = N(yy, r);
        r.undoManager.ignore(function() {
            var e, t, n;
            r.selection.setRng((e = i,
            t = a,
            (n = V.document.createRange()).setStart(e.container(), e.offset()),
            n.setEnd(t.container(), t.offset()),
            n)),
            r.execCommand("Delete"),
            Py(s, u, ms.fromRangeStart(r.selection.getRng())).map(Fy).map(KC(r, o))
        }),
        r.nodeChanged()
    }
      , YC = function(n, r, i, o) {
        var e, t, a = (e = n.getBody(),
        t = o.container(),
        yc(t, e) || e), u = N(yy, n), s = Py(u, a, o);
        return s.bind(function(e) {
            return i ? e.fold(x(R.some(Fy(e))), R.none, x(R.some(My(e))), R.none) : e.fold(R.none, x(R.some(My(e))), R.none, x(R.some(Fy(e))))
        }).map(KC(n, r)).getOrThunk(function() {
            var t = Xc(i, a, o)
              , e = t.bind(function(e) {
                return Py(u, a, e)
            });
            return s.isSome() && e.isSome() ? Cy(u, a, o).map(function(e) {
                return !!$u(Zc(o = e), el(o), function(e, t) {
                    var n = wy(!0, e)
                      , r = wy(!1, t);
                    return Jc(o, n).map(function(e) {
                        return e.isEqual(r)
                    }).getOr(!0)
                }).getOr(!0) && (gd(n, i, Ne.fromDom(e)),
                !0);
                var o
            }).getOr(!1) : e.bind(function(e) {
                return t.map(function(e) {
                    return i ? XC(n, r, o, e) : XC(n, r, e, o),
                    !0
                })
            }).getOr(!1)
        })
    }
      , GC = function(e, t, n) {
        if (e.selection.isCollapsed() && !1 !== e.settings.inline_boundaries) {
            var r = ms.fromRangeStart(e.selection.getRng());
            return YC(e, t, n, r)
        }
        return !1
    }
      , JC = function(e) {
        return 1 === ht(e).length
    }
      , QC = function(e, t, n, r) {
        var o, i, a, u, s = N(fp, t), c = U(H(r, s), function(e) {
            return e.dom()
        });
        if (0 === c.length)
            gd(t, e, n);
        else {
            var l = (o = n.dom(),
            i = c,
            a = op(!1),
            u = sp(i, a.dom()),
            Ct(Ne.fromDom(o), a),
            kt(Ne.fromDom(o)),
            ms(u, 0));
            t.selection.setRng(l.toRange())
        }
    }
      , ZC = function(r, o) {
        var t, e = Ne.fromDom(r.getBody()), n = Ne.fromDom(r.selection.getStart()), s = H((t = nd(n, e),
        X(t, Sr).fold(x(t), function(e) {
            return t.slice(0, e)
        })), JC);
        return ee(s).map(function(e) {
            var t, i, a, u, n = ms.fromRangeStart(r.selection.getRng());
            return i = o,
            a = n,
            u = e.dom(),
            !(!$u(Zc(u), el(u), function(e, t) {
                var n = wy(!0, e)
                  , r = wy(!1, t)
                  , o = wy(!1, a);
                return i ? Jc(u, o).map(function(e) {
                    return e.isEqual(r) && a.isEqual(n)
                }).getOr(!1) : Qc(u, o).map(function(e) {
                    return e.isEqual(n) && a.isEqual(r)
                }).getOr(!1)
            }).getOr(!0) || Ms((t = e).dom()) && np(t.dom())) && (QC(o, r, e, s),
            !0)
        }).getOr(!1)
    }
      , ew = function(e, t) {
        return !!e.selection.isCollapsed() && ZC(e, t)
    }
      , tw = function(e, t) {
        return !!e.selection.isCollapsed() && (n = e,
        r = t,
        o = ms.fromRangeStart(n.selection.getRng()),
        Kc(r, n.getBody(), o).filter(function(e) {
            return (r ? Uf : zf)(e)
        }).bind(function(e) {
            return R.from(Cc(r ? 0 : -1, e))
        }).map(function(e) {
            return n.selection.select(e),
            !0
        }).getOr(!1));
        var n, r, o
    }
      , nw = function(e) {
        var t = parseInt(e, 10);
        return isNaN(t) ? 0 : t
    }
      , rw = function(e, t) {
        return (e || "table" === Rt(t) ? "margin" : "padding") + ("rtl" === mn(t, "direction") ? "-right" : "-left")
    }
      , ow = function(e) {
        var r, t = aw(e);
        return !e.mode.isReadOnly() && (1 < t.length || (r = e,
        G(t, function(e) {
            var t = rw(Ks(r), e)
              , n = gn(e, t).map(nw).getOr(0);
            return "false" !== r.dom.getContentEditable(e.dom()) && 0 < n
        })))
    }
      , iw = function(e) {
        return _r(e) || Rr(e)
    }
      , aw = function(e) {
        return H(U(e.selection.getSelectedBlocks(), Ne.fromDom), function(e) {
            return !iw(e) && !ft(e).map(iw).getOr(!1) && Va(e, function(e) {
                return on(e.dom()) || an(e.dom())
            }).exists(function(e) {
                return on(e.dom())
            })
        })
    }
      , uw = function(e, t) {
        var n = e.dom
          , r = e.selection
          , o = e.formatter
          , i = e.getParam("indentation", "40px", "string")
          , a = /[a-z%]+$/i.exec(i)[0]
          , u = parseInt(i, 10)
          , s = Ks(e)
          , c = Hs(e);
        e.queryCommandState("InsertUnorderedList") || e.queryCommandState("InsertOrderedList") || "" !== c || n.getParent(r.getNode(), n.isBlock) || o.apply("div"),
        z(aw(e), function(e) {
            !function(e, t, n, r, o, i) {
                var a = rw(n, Ne.fromDom(i));
                if ("outdent" === t) {
                    var u = Math.max(0, nw(i.style[a]) - r);
                    e.setStyle(i, a, u ? u + o : "")
                } else {
                    u = nw(i.style[a]) + r + o;
                    e.setStyle(i, a, u)
                }
            }(n, t, s, u, a, e.dom())
        })
    }
      , sw = function(e, t, n) {
        return Yc(e, t, n, Lf)
    }
      , cw = function(e, t) {
        return K(nd(Ne.fromDom(t.container()), e), Sr)
    }
      , lw = function(e, n, r) {
        return sw(e, n.dom(), r).forall(function(t) {
            return cw(n, r).fold(function() {
                return !1 === bc(t, r, n.dom())
            }, function(e) {
                return !1 === bc(t, r, n.dom()) && st(e, Ne.fromDom(t.container()))
            })
        })
    }
      , fw = function(t, n, r) {
        return cw(n, r).fold(function() {
            return sw(t, n.dom(), r).forall(function(e) {
                return !1 === bc(e, r, n.dom())
            })
        }, function(e) {
            return sw(t, e.dom(), r).isNone()
        })
    }
      , dw = N(fw, !1)
      , mw = N(fw, !0)
      , pw = N(lw, !1)
      , gw = N(lw, !0)
      , hw = function(e, t, n) {
        if (e.selection.isCollapsed() && ow(e)) {
            var r = e.dom
              , o = e.selection.getRng()
              , i = ms.fromRangeStart(o)
              , a = r.getParent(o.startContainer, r.isBlock);
            if (null !== a && dw(Ne.fromDom(a), i))
                return uw(e, "outdent"),
                !0
        }
        return !1
    }
      , vw = function(o, i) {
        o.on("keydown", function(e) {
            var t, n, r;
            !1 === e.isDefaultPrevented() && (t = o,
            n = i,
            r = e,
            cC([{
                keyCode: Zh.BACKSPACE,
                action: sC(hw, t, !1)
            }, {
                keyCode: Zh.BACKSPACE,
                action: sC(qC, t, !1)
            }, {
                keyCode: Zh.DELETE,
                action: sC(qC, t, !0)
            }, {
                keyCode: Zh.BACKSPACE,
                action: sC(WC, t, !1)
            }, {
                keyCode: Zh.DELETE,
                action: sC(WC, t, !0)
            }, {
                keyCode: Zh.BACKSPACE,
                action: sC(GC, t, n, !1)
            }, {
                keyCode: Zh.DELETE,
                action: sC(GC, t, n, !0)
            }, {
                keyCode: Zh.BACKSPACE,
                action: sC(Vd, t, !1)
            }, {
                keyCode: Zh.DELETE,
                action: sC(Vd, t, !0)
            }, {
                keyCode: Zh.BACKSPACE,
                action: sC(tw, t, !1)
            }, {
                keyCode: Zh.DELETE,
                action: sC(tw, t, !0)
            }, {
                keyCode: Zh.BACKSPACE,
                action: sC(RC, t, !1)
            }, {
                keyCode: Zh.DELETE,
                action: sC(RC, t, !0)
            }, {
                keyCode: Zh.BACKSPACE,
                action: sC(NC, t, !1)
            }, {
                keyCode: Zh.DELETE,
                action: sC(NC, t, !0)
            }, {
                keyCode: Zh.BACKSPACE,
                action: sC(ew, t, !1)
            }, {
                keyCode: Zh.DELETE,
                action: sC(ew, t, !0)
            }], r).each(function(e) {
                r.preventDefault()
            }))
        }),
        o.on("keyup", function(e) {
            var t, n;
            !1 === e.isDefaultPrevented() && (t = o,
            n = e,
            cC([{
                keyCode: Zh.BACKSPACE,
                action: sC(VC, t)
            }, {
                keyCode: Zh.DELETE,
                action: sC(VC, t)
            }], n))
        })
    }
      , yw = function(e, t) {
        var n, r, o = t, i = e.dom, a = e.schema.getMoveCaretBeforeOnEnterElements();
        if (t) {
            if (/^(LI|DT|DD)$/.test(t.nodeName)) {
                var u = function(e) {
                    for (; e; ) {
                        if (1 === e.nodeType || 3 === e.nodeType && e.data && /[\r\n\s]/.test(e.data))
                            return e;
                        e = e.nextSibling
                    }
                }(t.firstChild);
                u && /^(UL|OL|DL)$/.test(u.nodeName) && t.insertBefore(i.doc.createTextNode(oo), t.firstChild)
            }
            if (r = i.createRng(),
            t.normalize(),
            t.hasChildNodes()) {
                for (var s = new ra(t,t); n = s.current(); ) {
                    if (Zt(n)) {
                        r.setStart(n, 0),
                        r.setEnd(n, 0);
                        break
                    }
                    if (a[n.nodeName.toLowerCase()]) {
                        r.setStartBefore(n),
                        r.setEndBefore(n);
                        break
                    }
                    o = n,
                    n = s.next()
                }
                n || (r.setStart(o, 0),
                r.setEnd(o, 0))
            } else
                rn(t) ? t.nextSibling && i.isBlock(t.nextSibling) ? (r.setStartBefore(t),
                r.setEndBefore(t)) : (r.setStartAfter(t),
                r.setEndAfter(t)) : (r.setStart(t, 0),
                r.setEnd(t, 0));
            e.selection.setRng(r),
            Dh(e, r)
        }
    }
      , bw = function(e) {
        return R.from(e.dom.getParent(e.selection.getStart(!0), e.dom.isBlock))
    }
      , Cw = function(e, t) {
        return e && e.parentNode && e.parentNode.nodeName === t
    }
      , ww = function(e) {
        return e && /^(OL|UL|LI)$/.test(e.nodeName)
    }
      , xw = function(e) {
        var t = e.parentNode;
        return /^(LI|DT|DD)$/.test(t.nodeName) ? t : e
    }
      , Sw = function(e, t, n) {
        for (var r = e[n ? "firstChild" : "lastChild"]; r && !$t(r); )
            r = r[n ? "nextSibling" : "previousSibling"];
        return r === t
    }
      , Nw = function(e, t, n, r, o) {
        var i = e.dom
          , a = e.selection.getRng();
        if (n !== e.getBody()) {
            var u;
            ww(u = n) && ww(u.parentNode) && (o = "LI");
            var s, c, l = o ? t(o) : i.create("BR");
            if (Sw(n, r, !0) && Sw(n, r, !1))
                Cw(n, "LI") ? i.insertAfter(l, xw(n)) : i.replace(l, n);
            else if (Sw(n, r, !0))
                Cw(n, "LI") ? (i.insertAfter(l, xw(n)),
                l.appendChild(i.doc.createTextNode(" ")),
                l.appendChild(n)) : n.parentNode.insertBefore(l, n);
            else if (Sw(n, r, !1))
                i.insertAfter(l, xw(n));
            else {
                n = xw(n);
                var f = a.cloneRange();
                f.setStartAfter(r),
                f.setEndAfter(n);
                var d = f.extractContents();
                "LI" === o && (c = "LI",
                (s = d).firstChild && s.firstChild.nodeName === c) ? (l = d.firstChild,
                i.insertAfter(d, n)) : (i.insertAfter(d, n),
                i.insertAfter(l, n))
            }
            i.remove(r),
            yw(e, l)
        }
    }
      , Ew = function(e) {
        e.innerHTML = '<br data-mce-bogus="1">'
    }
      , kw = function(e, t) {
        return e.nodeName === t || e.previousSibling && e.previousSibling.nodeName === t
    }
      , _w = function(e, t) {
        return t && e.isBlock(t) && !/^(TD|TH|CAPTION|FORM)$/.test(t.nodeName) && !/^(fixed|absolute)/i.test(t.style.position) && "true" !== e.getContentEditable(t)
    }
      , Rw = function(e, t, n) {
        return !1 === Zt(t) ? n : e ? 1 === n && t.data.charAt(n - 1) === su ? 0 : n : n === t.data.length - 1 && t.data.charAt(n) === su ? t.data.length : n
    }
      , Tw = function(e, t) {
        var n, r, o = e.getRoot();
        for (n = t; n !== o && "false" !== e.getContentEditable(n); )
            "true" === e.getContentEditable(n) && (r = n),
            n = n.parentNode;
        return n !== o ? r : o
    }
      , Aw = function(o, i, e) {
        R.from(e.style).map(o.dom.parseStyle).each(function(e) {
            var t = function(e) {
                var t = {}
                  , n = e.dom();
                if (un(n))
                    for (var r = 0; r < n.style.length; r++) {
                        var o = n.style.item(r);
                        t[o] = n.style[o]
                    }
                return t
            }(Ne.fromDom(i))
              , n = pe(pe({}, t), e);
            o.dom.setStyles(i, n)
        });
        var t = R.from(e["class"]).map(function(e) {
            return e.split(/\s+/)
        })
          , n = R.from(i.className).map(function(e) {
            return H(e.split(/\s+/), function(e) {
                return "" !== e
            })
        });
        $u(t, n, function(t, e) {
            var n = H(e, function(e) {
                return !M(t, e)
            })
              , r = ge(t, n);
            o.dom.setAttrib(i, "class", r.join(" "))
        });
        var r = ["style", "class"]
          , a = le(e, function(e, t) {
            return !M(r, t)
        });
        o.dom.setAttribs(i, a)
    }
      , Dw = function(e, t) {
        var n = Hs(e);
        if (n && n.toLowerCase() === t.tagName.toLowerCase()) {
            var r = Vs(e);
            Aw(e, t, r)
        }
    }
      , Ow = function(a, e) {
        var t, u, s, i, c, n, r, o, l, f, d, m, p, g = a.dom, h = a.schema, v = h.getNonEmptyElements(), y = a.selection.getRng(), b = function(e) {
            var t, n, r, o = s, i = h.getTextInlineElements();
            if (r = t = e || "TABLE" === f || "HR" === f ? g.create(e || m) : c.cloneNode(!1),
            !1 === a.getParam("keep_styles", !0))
                g.setAttrib(t, "style", null),
                g.setAttrib(t, "class", null);
            else
                do {
                    if (i[o.nodeName]) {
                        if (Ms(o) || ll(o))
                            continue;
                        n = o.cloneNode(!1),
                        g.setAttrib(n, "id", ""),
                        t.hasChildNodes() ? n.appendChild(t.firstChild) : r = n,
                        t.appendChild(n)
                    }
                } while ((o = o.parentNode) && o !== u);return Dw(a, t),
            Ew(r),
            t
        }, C = function(e) {
            var t, n, r = Rw(e, s, i);
            if (Zt(s) && (e ? 0 < r : r < s.nodeValue.length))
                return !1;
            if (s.parentNode === c && p && !e)
                return !0;
            if (e && $t(s) && s === c.firstChild)
                return !0;
            if (kw(s, "TABLE") || kw(s, "HR"))
                return p && !e || !p && e;
            var o = new ra(s,c);
            for (Zt(s) && (e && 0 === r ? o.prev() : e || r !== s.nodeValue.length || o.next()); t = o.current(); ) {
                if ($t(t)) {
                    if (!t.getAttribute("data-mce-bogus") && (n = t.nodeName.toLowerCase(),
                    v[n] && "br" !== n))
                        return !1
                } else if (Zt(t) && !/^[ \t\r\n]*$/.test(t.nodeValue))
                    return !1;
                e ? o.prev() : o.next()
            }
            return !0
        }, w = function() {
            r = /^(H[1-6]|PRE|FIGURE)$/.test(f) && "HGROUP" !== d ? b(m) : b(),
            a.getParam("end_container_on_empty_block", !1) && _w(g, l) && g.isEmpty(c) ? r = g.split(l, c) : g.insertAfter(r, c),
            yw(a, r)
        };
        Wh(g, y).each(function(e) {
            y.setStart(e.startContainer, e.startOffset),
            y.setEnd(e.endContainer, e.endOffset)
        }),
        s = y.startContainer,
        i = y.startOffset,
        m = Hs(a),
        n = !(!e || !e.shiftKey);
        var x, S, N, E, k, _, R = !(!e || !e.ctrlKey);
        $t(s) && s.hasChildNodes() && (p = i > s.childNodes.length - 1,
        s = s.childNodes[Math.min(i, s.childNodes.length - 1)] || s,
        i = p && Zt(s) ? s.nodeValue.length : 0),
        (u = Tw(g, s)) && ((m && !n || !m && n) && (s = function(e, t, n, r, o) {
            var i, a, u, s, c, l, f, d = t || "P", m = e.dom, p = Tw(m, r);
            if (!(a = m.getParent(r, m.isBlock)) || !_w(m, a)) {
                if (l = (a = a || p) === e.getBody() || (f = a) && /^(TD|TH|CAPTION)$/.test(f.nodeName) ? a.nodeName.toLowerCase() : a.parentNode.nodeName.toLowerCase(),
                !a.hasChildNodes())
                    return i = m.create(d),
                    Dw(e, i),
                    a.appendChild(i),
                    n.setStart(i, 0),
                    n.setEnd(i, 0),
                    i;
                for (s = r; s.parentNode !== a; )
                    s = s.parentNode;
                for (; s && !m.isBlock(s); )
                    s = (u = s).previousSibling;
                if (u && e.schema.isValidChild(l, d.toLowerCase())) {
                    for (i = m.create(d),
                    Dw(e, i),
                    u.parentNode.insertBefore(i, u),
                    s = u; s && !m.isBlock(s); )
                        c = s.nextSibling,
                        i.appendChild(s),
                        s = c;
                    n.setStart(r, o),
                    n.setEnd(r, o)
                }
            }
            return r
        }(a, m, y, s, i)),
        c = g.getParent(s, g.isBlock),
        l = c ? g.getParent(c.parentNode, g.isBlock) : null,
        f = c ? c.nodeName.toUpperCase() : "",
        "LI" !== (d = l ? l.nodeName.toUpperCase() : "") || R || (l = (c = l).parentNode,
        f = d),
        /^(LI|DT|DD)$/.test(f) && g.isEmpty(c) ? Nw(a, b, l, c, m) : m && c === a.getBody() || (m = m || "P",
        mu(c) ? (r = xu(c),
        g.isEmpty(c) && Ew(c),
        Dw(a, r),
        yw(a, r)) : C() ? w() : C(!0) ? (r = c.parentNode.insertBefore(b(), c),
        yw(a, kw(c, "HR") ? r : c)) : ((_ = (k = y).cloneRange()).setStart(k.startContainer, Rw(!0, k.startContainer, k.startOffset)),
        _.setEnd(k.endContainer, Rw(!1, k.endContainer, k.endOffset)),
        (t = _.cloneRange()).setEndAfter(c),
        o = t.extractContents(),
        E = o,
        z(Fa(Ne.fromDom(E), Ot), function(e) {
            var t = e.dom();
            t.nodeValue = lu(t.nodeValue)
        }),
        function(e) {
            for (; Zt(e) && (e.nodeValue = e.nodeValue.replace(/^[\r\n]+/, "")),
            e = e.firstChild; )
                ;
        }(o),
        r = o.firstChild,
        g.insertAfter(o, c),
        function(e, t, n) {
            var r, o = n, i = [];
            if (o) {
                for (; o = o.firstChild; ) {
                    if (e.isBlock(o))
                        return;
                    $t(o) && !t[o.nodeName.toLowerCase()] && i.push(o)
                }
                for (r = i.length; r--; )
                    !(o = i[r]).hasChildNodes() || o.firstChild === o.lastChild && "" === o.firstChild.nodeValue ? e.remove(o) : (a = e,
                    (u = o) && "A" === u.nodeName && a.isEmpty(u) && e.remove(o));
                var a, u
            }
        }(g, v, r),
        x = g,
        (S = c).normalize(),
        (N = S.lastChild) && !/^(left|right)$/gi.test(x.getStyle(N, "float", !0)) || x.add(S, "br"),
        g.isEmpty(c) && Ew(c),
        r.normalize(),
        g.isEmpty(r) ? (g.remove(r),
        w()) : (Dw(a, r),
        yw(a, r))),
        g.setAttrib(r, "id", ""),
        a.fire("NewBlock", {
            newBlock: r
        })))
    }
      , Bw = function(e, t, n) {
        var r = e.create("span", {}, "&nbsp;");
        n.parentNode.insertBefore(r, n),
        t.scrollIntoView(r),
        e.remove(r)
    }
      , Pw = function(e, t, n, r) {
        var o = e.createRng();
        r ? (o.setStartBefore(n),
        o.setEndBefore(n)) : (o.setStartAfter(n),
        o.setEndAfter(n)),
        t.setRng(o)
    }
      , Lw = function(e, t) {
        var n, r, o = e.selection, i = e.dom, a = o.getRng();
        Wh(i, a).each(function(e) {
            a.setStart(e.startContainer, e.startOffset),
            a.setEnd(e.endContainer, e.endOffset)
        });
        var u = a.startOffset
          , s = a.startContainer;
        if (1 === s.nodeType && s.hasChildNodes()) {
            var c = u > s.childNodes.length - 1;
            s = s.childNodes[Math.min(u, s.childNodes.length - 1)] || s,
            u = c && 3 === s.nodeType ? s.nodeValue.length : 0
        }
        var l = i.getParent(s, i.isBlock)
          , f = l ? i.getParent(l.parentNode, i.isBlock) : null
          , d = f ? f.nodeName.toUpperCase() : ""
          , m = !(!t || !t.ctrlKey);
        "LI" !== d || m || (l = f),
        s && 3 === s.nodeType && u >= s.nodeValue.length && !function(e, t, n) {
            for (var r, o = new ra(t,n), i = e.getNonEmptyElements(); r = o.next(); )
                if (i[r.nodeName.toLowerCase()] || 0 < r.length)
                    return !0
        }(e.schema, s, l) && (n = i.create("br"),
        a.insertNode(n),
        a.setStartAfter(n),
        a.setEndAfter(n),
        r = !0),
        n = i.create("br"),
        Ns(i, a, n),
        Bw(i, o, n),
        Pw(i, o, n, r),
        e.undoManager.add()
    }
      , Iw = function(e, t) {
        var n = Ne.fromTag("br");
        Ct(Ne.fromDom(t), n),
        e.undoManager.add()
    }
      , Mw = function(e, t) {
        Fw(e.getBody(), t) || wt(Ne.fromDom(t), Ne.fromTag("br"));
        var n = Ne.fromTag("br");
        wt(Ne.fromDom(t), n),
        Bw(e.dom, e.selection, n.dom()),
        Pw(e.dom, e.selection, n.dom(), !1),
        e.undoManager.add()
    }
      , Fw = function(e, t) {
        return n = ms.after(t),
        !!rn(n.getNode()) || Jc(e, ms.after(t)).map(function(e) {
            return rn(e.getNode())
        }).getOr(!1);
        var n
    }
      , Uw = function(e) {
        return e && "A" === e.nodeName && "href"in e
    }
      , zw = function(e) {
        return e.fold(x(!1), Uw, Uw, x(!1))
    }
      , jw = function(e, t) {
        t.fold(f, N(Iw, e), N(Mw, e), f)
    }
      , Hw = function(e, t) {
        var n, r, o, i = (r = N(yy, n = e),
        o = ms.fromRangeStart(n.selection.getRng()),
        Py(r, n.getBody(), o).filter(zw));
        i.isSome() ? i.each(N(jw, e)) : Lw(e, t)
    }
      , Vw = function(e, t) {
        return bw(e).filter(function(e) {
            return 0 < t.length && ot(Ne.fromDom(e), t)
        }).isSome()
    }
      , qw = hd([{
        br: []
    }, {
        block: []
    }, {
        none: []
    }])
      , $w = function(e, t) {
        return Vw(n = e, n.getParam("no_newline_selector", ""));
        var n
    }
      , Ww = function(n) {
        return function(e, t) {
            return "" === Hs(e) === n
        }
    }
      , Kw = function(n) {
        return function(e, t) {
            return bw(e).filter(function(e) {
                return Rr(Ne.fromDom(e))
            }).isSome() === n
        }
    }
      , Xw = function(n, r) {
        return function(e, t) {
            return bw(e).fold(x(""), function(e) {
                return e.nodeName.toUpperCase()
            }) === n.toUpperCase() === r
        }
    }
      , Yw = function(e) {
        return Xw("pre", e)
    }
      , Gw = function(n) {
        return function(e, t) {
            return e.getParam("br_in_pre", !0) === n
        }
    }
      , Jw = function(e, t) {
        return Vw(n = e, n.getParam("br_newline_selector", ".mce-toc h2,figcaption,caption"));
        var n
    }
      , Qw = function(e, t) {
        return t
    }
      , Zw = function(e) {
        var t = Hs(e)
          , n = function(e, t) {
            var n, r, o = e.getRoot();
            for (n = t; n !== o && "false" !== e.getContentEditable(n); )
                "true" === e.getContentEditable(n) && (r = n),
                n = n.parentNode;
            return n !== o ? r : o
        }(e.dom, e.selection.getStart());
        return n && e.schema.isValidChild(n.nodeName, t || "P")
    }
      , ex = function(e, t) {
        return function(n, r) {
            return W(e, function(e, t) {
                return e && t(n, r)
            }, !0) ? R.some(t) : R.none()
        }
    }
      , tx = function(e, t) {
        return Ny([ex([$w], qw.none()), ex([Xw("summary", !0)], qw.br()), ex([Yw(!0), Gw(!1), Qw], qw.br()), ex([Yw(!0), Gw(!1)], qw.block()), ex([Yw(!0), Gw(!0), Qw], qw.block()), ex([Yw(!0), Gw(!0)], qw.br()), ex([Kw(!0), Qw], qw.br()), ex([Kw(!0)], qw.block()), ex([Ww(!0), Qw, Zw], qw.block()), ex([Ww(!0)], qw.br()), ex([Jw], qw.br()), ex([Ww(!1), Qw], qw.br()), ex([Zw], qw.block())], [e, !(!t || !t.shiftKey)]).getOr(qw.none())
    }
      , nx = function(e, t) {
        tx(e, t).fold(function() {
            Hw(e, t)
        }, function() {
            Ow(e, t)
        }, f)
    }
      , rx = function(o) {
        o.on("keydown", function(e) {
            var t, n, r;
            e.keyCode === Zh.ENTER && (t = o,
            (n = e).isDefaultPrevented() || (n.preventDefault(),
            (r = t.undoManager).typing && (r.typing = !1,
            r.add()),
            t.undoManager.transact(function() {
                !1 === t.selection.isCollapsed() && t.execCommand("Delete"),
                nx(t, n)
            })))
        })
    }
      , ox = function(n, r) {
        var e = r.container()
          , t = r.offset();
        return Zt(e) ? (e.insertData(t, n),
        R.some(ls(e, t + n.length))) : Rc(r).map(function(e) {
            var t = Ne.fromText(n);
            return (r.isAtEnd() ? wt : Ct)(e, t),
            ls(t.dom(), n.length)
        })
    }
      , ix = N(ox, oo)
      , ax = N(ox, " ")
      , ux = function(e) {
        return ls.isTextPosition(e) && !e.isAtStart() && !e.isAtEnd()
    }
      , sx = function(e, t) {
        var n = H(nd(Ne.fromDom(t.container()), e), Sr);
        return Z(n).getOr(e)
    }
      , cx = function(e, t) {
        return ux(t) ? Pf(t) : Pf(t) || Qc(sx(e, t).dom(), t).exists(Pf)
    }
      , lx = function(e, t) {
        return ux(t) ? Bf(t) : Bf(t) || Jc(sx(e, t).dom(), t).exists(Bf)
    }
      , fx = function(e) {
        return Rc(e).bind(function(e) {
            return Va(e, Dt)
        }).exists(function(e) {
            return t = mn(e, "white-space"),
            M(["pre", "pre-wrap"], t);
            var t
        })
    }
      , dx = function(e, t) {
        return r = t,
        Qc(e.dom(), r).isNone() || (n = t,
        Jc(e.dom(), n).isNone()) || dw(e, t) || mw(e, t) || OC(e, t) || DC(e, t);
        var n, r
    }
      , mx = function(e, t) {
        var n, r, o, i = (r = (n = t).container(),
        o = n.offset(),
        Zt(r) && o < r.data.length ? ls(r, o + 1) : n);
        return !fx(i) && (mw(e, i) || gw(e, i) || DC(e, i) || lx(e, i))
    }
      , px = function(e, t) {
        return n = e,
        !fx(r = t) && (dw(n, r) || pw(n, r) || OC(n, r) || cx(n, r)) || mx(e, t);
        var n, r
    }
      , gx = function(e, t) {
        return fl(e.charAt(t))
    }
      , hx = function(e) {
        var t = e.container();
        return Zt(t) && He(t.data, oo)
    }
      , vx = function(e) {
        var n, t = e.data, r = (n = t.split(""),
        U(n, function(e, t) {
            return fl(e) && 0 < t && t < n.length - 1 && ml(n[t - 1]) && ml(n[t + 1]) ? " " : e
        }).join(""));
        return r !== t && (e.data = r,
        !0)
    }
      , yx = function(l, e) {
        return R.some(e).filter(hx).bind(function(e) {
            var t, n, r, o, i, a, u, s, c = e.container();
            return (i = l,
            u = (a = c).data,
            s = ls(a, 0),
            !(!gx(u, 0) || px(i, s) || (a.data = " " + u.slice(1),
            0)) || vx(c) || (t = l,
            r = (n = c).data,
            o = ls(n, r.length - 1),
            !(!gx(r, r.length - 1) || px(t, o) || (n.data = r.slice(0, -1) + " ",
            0)))) ? R.some(e) : R.none()
        })
    }
      , bx = function(t) {
        var e = Ne.fromDom(t.getBody());
        t.selection.isCollapsed() && yx(e, ls.fromRangeStart(t.selection.getRng())).each(function(e) {
            t.selection.setRng(e.toRange())
        })
    }
      , Cx = function(r, o) {
        return function(e) {
            return t = r,
            (!fx(n = e) && (dx(t, n) || cx(t, n) || lx(t, n)) ? ix : ax)(o);
            var t, n
        }
    }
      , wx = function(e) {
        var t, n, r = ms.fromRangeStart(e.selection.getRng()), o = Ne.fromDom(e.getBody());
        if (e.selection.isCollapsed()) {
            var i = N(yy, e)
              , a = ms.fromRangeStart(e.selection.getRng());
            return Py(i, e.getBody(), a).bind((n = o,
            function(e) {
                return e.fold(function(e) {
                    return Qc(n.dom(), ms.before(e))
                }, function(e) {
                    return Zc(e)
                }, function(e) {
                    return el(e)
                }, function(e) {
                    return Jc(n.dom(), ms.after(e))
                })
            }
            )).bind(Cx(o, r)).exists((t = e,
            function(e) {
                return t.selection.setRng(e.toRange()),
                t.nodeChanged(),
                !0
            }
            ))
        }
        return !1
    }
      , xx = function(r) {
        r.on("keydown", function(e) {
            var t, n;
            !1 === e.isDefaultPrevented() && (t = r,
            n = e,
            cC([{
                keyCode: Zh.SPACEBAR,
                action: sC(wx, t)
            }], n).each(function(e) {
                n.preventDefault()
            }))
        })
    }
      , Sx = function(e, t) {
        var n;
        t.hasAttribute("data-mce-caret") && (xu(t),
        (n = e).selection.setRng(n.selection.getRng()),
        e.selection.scrollIntoView(t))
    }
      , Nx = function(e, t) {
        var n, r = (n = e,
        $a(Ne.fromDom(n.getBody()), "*[data-mce-caret]").fold(x(null), function(e) {
            return e.dom()
        }));
        if (r)
            return "compositionstart" === t.type ? (t.preventDefault(),
            t.stopPropagation(),
            void Sx(e, r)) : void (hu(r) && (Sx(e, r),
            e.undoManager.add()))
    }
      , Ex = nt().browser
      , kx = function(t) {
        var e, n;
        e = t,
        n = Ta(function() {
            e.composing || bx(e)
        }, 0),
        Ex.isIE() && (e.on("keypress", function(e) {
            n.throttle()
        }),
        e.on("remove", function(e) {
            n.cancel()
        })),
        t.on("input", function(e) {
            !1 === e.isComposing && bx(t)
        })
    }
      , _x = function(r) {
        r.on("keydown", function(e) {
            var t, n;
            !1 === e.isDefaultPrevented() && (t = r,
            n = e,
            cC([{
                keyCode: Zh.END,
                action: Mb(t, !0)
            }, {
                keyCode: Zh.HOME,
                action: Mb(t, !1)
            }], n).each(function(e) {
                n.preventDefault()
            }))
        })
    }
      , Rx = function(e) {
        var t, n = Gy(e);
        (t = e).on("keyup compositionstart", N(Nx, t)),
        lC(e, n),
        vw(e, n),
        rx(e),
        xx(e),
        kx(e),
        _x(e)
    }
      , Tx = (Ax.prototype.nodeChanged = function(e) {
        var t, n, r, o = this.editor.selection;
        this.editor.initialized && o && !this.editor.settings.disable_nodechange && !this.editor.mode.isReadOnly() && (r = this.editor.getBody(),
        (t = o.getStart(!0) || r).ownerDocument === this.editor.getDoc() && this.editor.dom.isChildOf(t, r) || (t = r),
        n = [],
        this.editor.dom.getParent(t, function(e) {
            if (e === r)
                return !0;
            n.push(e)
        }),
        (e = e || {}).element = t,
        e.parents = n,
        this.editor.fire("NodeChange", e))
    }
    ,
    Ax.prototype.isSameElementPath = function(e) {
        var t, n;
        if ((n = this.editor.$(e).parentsUntil(this.editor.getBody()).add(e)).length === this.lastPath.length) {
            for (t = n.length; 0 <= t && n[t] === this.lastPath[t]; t--)
                ;
            if (-1 === t)
                return this.lastPath = n,
                !0
        }
        return this.lastPath = n,
        !1
    }
    ,
    Ax);
    function Ax(r) {
        var o;
        this.lastPath = [],
        this.editor = r;
        var t = this;
        "onselectionchange"in r.getDoc() || r.on("NodeChange click mouseup keyup focus", function(e) {
            var t, n;
            n = {
                startContainer: (t = r.selection.getRng()).startContainer,
                startOffset: t.startOffset,
                endContainer: t.endContainer,
                endOffset: t.endOffset
            },
            "nodechange" !== e.type && Uh(n, o) || r.fire("SelectionChange"),
            o = n
        }),
        r.on("contextmenu", function() {
            r.fire("SelectionChange")
        }),
        r.on("SelectionChange", function() {
            var e = r.selection.getStart(!0);
            !e || !rr.range && r.selection.isCollapsed() || Gl(r) && !t.isSameElementPath(e) && r.dom.isChildOf(e, r.getBody()) && r.nodeChanged({
                selectionChange: !0
            })
        }),
        r.on("mouseup", function(e) {
            !e.isDefaultPrevented() && Gl(r) && ("IMG" === r.selection.getNode().nodeName ? Xn.setEditorTimeout(r, function() {
                r.nodeChanged()
            }) : r.nodeChanged())
        })
    }
    var Dx = function(e) {
        var t, n;
        (t = e).on("click", function(e) {
            t.dom.getParent(e.target, "details") && e.preventDefault()
        }),
        (n = e).parser.addNodeFilter("details", function(e) {
            z(e, function(e) {
                e.attr("data-mce-open", e.attr("open")),
                e.attr("open", "open")
            })
        }),
        n.serializer.addNodeFilter("details", function(e) {
            z(e, function(e) {
                var t = e.attr("data-mce-open");
                e.attr("open", q(t) ? t : null),
                e.attr("data-mce-open", null)
            })
        })
    }
      , Ox = function(e) {
        return $t(e) && kr(Ne.fromDom(e))
    }
      , Bx = function(t) {
        t.on("click", function(e) {
            3 <= e.detail && function(e) {
                var t = e.selection.getRng()
                  , n = ls.fromRangeStart(t)
                  , r = ls.fromRangeEnd(t);
                if (ls.isElementPosition(n)) {
                    var o = n.container();
                    Ox(o) && Zc(o).each(function(e) {
                        return t.setStart(e.container(), e.offset())
                    })
                }
                if (ls.isElementPosition(r)) {
                    o = n.container();
                    Ox(o) && el(o).each(function(e) {
                        return t.setEnd(e.container(), e.offset())
                    })
                }
                e.selection.setRng($d(t))
            }(t)
        })
    }
      , Px = function(e) {
        var t, n, r, o;
        return o = e.getBoundingClientRect(),
        n = (t = e.ownerDocument).documentElement,
        r = t.defaultView,
        {
            top: o.top + r.pageYOffset - n.clientTop,
            left: o.left + r.pageXOffset - n.clientLeft
        }
    }
      , Lx = function(e, t) {
        return n = (u = e).inline ? Px(u.getBody()) : {
            left: 0,
            top: 0
        },
        a = (i = e).getBody(),
        r = i.inline ? {
            left: a.scrollLeft,
            top: a.scrollTop
        } : {
            left: 0,
            top: 0
        },
        {
            pageX: (o = function(e, t) {
                if (t.target.ownerDocument === e.getDoc())
                    return {
                        left: t.pageX,
                        top: t.pageY
                    };
                var n, r, o, i, a, u = Px(e.getContentAreaContainer()), s = (r = (n = e).getBody(),
                o = n.getDoc().documentElement,
                i = {
                    left: r.scrollLeft,
                    top: r.scrollTop
                },
                a = {
                    left: r.scrollLeft || o.scrollLeft,
                    top: r.scrollTop || o.scrollTop
                },
                n.inline ? i : a);
                return {
                    left: t.pageX - u.left + s.left,
                    top: t.pageY - u.top + s.top
                }
            }(e, t)).left - n.left + r.left,
            pageY: o.top - n.top + r.top
        };
        var n, r, o, i, a, u
    }
      , Ix = an
      , Mx = on
      , Fx = function(e) {
        e && e.parentNode && e.parentNode.removeChild(e)
    }
      , Ux = function(u, s) {
        return function(e) {
            if (0 === e.button) {
                var t = K(s.dom.getParents(e.target), function() {
                    for (var n = [], e = 0; e < arguments.length; e++)
                        n[e] = arguments[e];
                    return function(e) {
                        for (var t = 0; t < n.length; t++)
                            if (n[t](e))
                                return !0;
                        return !1
                    }
                }(Ix, Mx)).getOr(null);
                if (i = s.getBody(),
                Ix(a = t) && a !== i) {
                    var n = s.dom.getPos(t)
                      , r = s.getBody()
                      , o = s.getDoc().documentElement;
                    u.element = t,
                    u.screenX = e.screenX,
                    u.screenY = e.screenY,
                    u.maxX = (s.inline ? r.scrollWidth : o.offsetWidth) - 2,
                    u.maxY = (s.inline ? r.scrollHeight : o.offsetHeight) - 2,
                    u.relX = e.pageX - n.x,
                    u.relY = e.pageY - n.y,
                    u.width = t.offsetWidth,
                    u.height = t.offsetHeight,
                    u.ghost = function(e, t, n, r) {
                        var o = t.cloneNode(!0);
                        e.dom.setStyles(o, {
                            width: n,
                            height: r
                        }),
                        e.dom.setAttrib(o, "data-mce-selected", null);
                        var i = e.dom.create("div", {
                            "class": "mce-drag-container",
                            "data-mce-bogus": "all",
                            unselectable: "on",
                            contenteditable: "false"
                        });
                        return e.dom.setStyles(i, {
                            position: "absolute",
                            opacity: .5,
                            overflow: "hidden",
                            border: 0,
                            padding: 0,
                            margin: 0,
                            width: n,
                            height: r
                        }),
                        e.dom.setStyles(o, {
                            margin: 0,
                            boxSizing: "border-box"
                        }),
                        i.appendChild(o),
                        i
                    }(s, t, u.width, u.height)
                }
            }
            var i, a
        }
    }
      , zx = function(g, h) {
        var v = Xn.throttle(function(e, t) {
            h._selectionOverrides.hideFakeCaret(),
            h.selection.placeCaretAt(e, t)
        }, 0);
        return function(e) {
            var t, n, r, o, i, a, u, s, c, l, f, d, m = Math.max(Math.abs(e.screenX - g.screenX), Math.abs(e.screenY - g.screenY));
            if (g.element && !g.dragging && 10 < m) {
                if (h.fire("dragstart", {
                    target: g.element
                }).isDefaultPrevented())
                    return;
                g.dragging = !0,
                h.focus()
            }
            if (g.dragging) {
                var p = (f = g,
                {
                    pageX: (d = Lx(h, e)).pageX - f.relX,
                    pageY: d.pageY + 5
                });
                c = g.ghost,
                l = h.getBody(),
                c.parentNode !== l && l.appendChild(c),
                t = g.ghost,
                n = p,
                r = g.width,
                o = g.height,
                i = g.maxX,
                a = g.maxY,
                s = u = 0,
                t.style.left = n.pageX + "px",
                t.style.top = n.pageY + "px",
                n.pageX + r > i && (u = n.pageX + r - i),
                n.pageY + o > a && (s = n.pageY + o - a),
                t.style.width = r - u + "px",
                t.style.height = o - s + "px",
                v(e.clientX, e.clientY)
            }
        }
    }
      , jx = function(l, f) {
        return function(e) {
            if (l.dragging && (s = (i = f).selection,
            c = s.getSel().getRangeAt(0).startContainer,
            a = 3 === c.nodeType ? c.parentNode : c,
            u = l.element,
            a !== u && !i.dom.isChildOf(a, u) && !Ix(a))) {
                var t = (r = l.element,
                (o = r.cloneNode(!0)).removeAttribute("data-mce-selected"),
                o)
                  , n = f.fire("drop", {
                    targetClone: t,
                    clientX: e.clientX,
                    clientY: e.clientY
                });
                n.isDefaultPrevented() || (t = n.targetClone,
                f.undoManager.transact(function() {
                    Fx(l.element),
                    f.insertContent(f.dom.getOuterHTML(t)),
                    f._selectionOverrides.hideFakeCaret()
                }))
            }
            var r, o, i, a, u, s, c;
            Hx(l)
        }
    }
      , Hx = function(e) {
        e.dragging = !1,
        e.element = null,
        Fx(e.ghost)
    }
      , Vx = function(e) {
        var t, n, r, o, i, a, u, s, c = {};
        t = ga.DOM,
        a = V.document,
        n = Ux(c, e),
        r = zx(c, e),
        o = jx(c, e),
        u = c,
        i = function() {
            u.dragging && s.fire("dragend"),
            Hx(u)
        }
        ,
        (s = e).on("mousedown", n),
        e.on("mousemove", r),
        e.on("mouseup", o),
        t.bind(a, "mousemove", r),
        t.bind(a, "mouseup", i),
        e.on("remove", function() {
            t.unbind(a, "mousemove", r),
            t.unbind(a, "mouseup", i)
        })
    }
      , qx = function(e) {
        var n;
        Vx(e),
        (n = e).on("drop", function(e) {
            var t = "undefined" != typeof e.clientX ? n.getDoc().elementFromPoint(e.clientX, e.clientY) : null;
            (Ix(t) || Ix(n.dom.getContentEditableParent(t))) && e.preventDefault()
        })
    }
      , $x = on
      , Wx = an
      , Kx = function(e, t) {
        for (var n = e.getBody(); t && t !== n; ) {
            if ($x(t) || Wx(t))
                return t;
            t = t.parentNode
        }
        return null
    }
      , Xx = function(g) {
        var h, v = g.getBody(), o = uc(g, v, function(e) {
            return g.dom.isBlock(e)
        }, function() {
            return Pm(g)
        }), y = "sel-" + g.dom.uniqueId(), a = function(e) {
            e && g.selection.setRng(e)
        }, r = function() {
            return g.selection.getRng()
        }, b = function(e, t, n, r) {
            return void 0 === r && (r = !0),
            g.fire("ShowCaret", {
                target: t,
                direction: e,
                before: n
            }).isDefaultPrevented() ? null : (r && g.selection.scrollIntoView(t, -1 === e),
            o.show(n, t))
        }, t = function(e) {
            return gu(e) || Cu(e) || wu(e)
        }, C = function(e) {
            return t(e.startContainer) || t(e.endContainer)
        }, u = function(e) {
            var t = g.schema.getShortEndedElements()
              , n = g.dom.createRng()
              , r = e.startContainer
              , o = e.startOffset
              , i = e.endContainer
              , a = e.endOffset;
            return me(t, r.nodeName.toLowerCase()) ? 0 === o ? n.setStartBefore(r) : n.setStartAfter(r) : n.setStart(r, o),
            me(t, i.nodeName.toLowerCase()) ? 0 === a ? n.setEndBefore(i) : n.setEndAfter(i) : n.setEnd(i, a),
            n
        }, s = function(e, t) {
            var n, r, o, i, a, u, s, c, l, f, d = g.$, m = g.dom;
            if (!e)
                return null;
            if (e.collapsed) {
                if (!C(e))
                    if (!1 === t) {
                        if (c = _c(-1, v, e),
                        cc(c.getNode(!0)))
                            return b(-1, c.getNode(!0), !1, !1);
                        if (cc(c.getNode()))
                            return b(-1, c.getNode(), !c.isAtEnd(), !1)
                    } else {
                        if (c = _c(1, v, e),
                        cc(c.getNode()))
                            return b(1, c.getNode(), !c.isAtEnd(), !1);
                        if (cc(c.getNode(!0)))
                            return b(1, c.getNode(!0), !1, !1)
                    }
                return null
            }
            if (i = e.startContainer,
            a = e.startOffset,
            u = e.endOffset,
            3 === i.nodeType && 0 === a && Wx(i.parentNode) && (i = i.parentNode,
            a = m.nodeIndex(i),
            i = i.parentNode),
            1 !== i.nodeType)
                return null;
            if (u === a + 1 && i === e.endContainer && (n = i.childNodes[a]),
            !Wx(n))
                return null;
            if (l = f = n.cloneNode(!0),
            (s = g.fire("ObjectSelected", {
                target: n,
                targetClone: l
            })).isDefaultPrevented())
                return null;
            r = $a(Ne.fromDom(g.getBody()), "#" + y).fold(function() {
                return d([])
            }, function(e) {
                return d([e.dom()])
            }),
            l = s.targetClone,
            0 === r.length && (r = d('<div data-mce-bogus="all" class="mce-offscreen-selection"></div>').attr("id", y)).appendTo(g.getBody()),
            e = g.dom.createRng(),
            l === f && rr.ie ? (r.empty().append('<p style="font-size: 0" data-mce-bogus="all">\xa0</p>').append(l),
            e.setStartAfter(r[0].firstChild.firstChild),
            e.setEndAfter(l)) : (r.empty().append(oo).append(l).append(oo),
            e.setStart(r[0].firstChild, 1),
            e.setEnd(r[0].lastChild, 0)),
            r.css({
                top: m.getPos(n, g.getBody()).y
            }),
            r[0].focus(),
            (o = g.selection.getSel()).removeAllRanges(),
            o.addRange(e);
            var p = Ne.fromDom(n);
            return z(Ua(Ne.fromDom(g.getBody()), "*[data-mce-selected]"), function(e) {
                at(p, e) || dn(e, "data-mce-selected")
            }),
            g.dom.getAttrib(n, "data-mce-selected") || n.setAttribute("data-mce-selected", "1"),
            h = n,
            w(),
            e
        }, c = function() {
            h && (h.removeAttribute("data-mce-selected"),
            $a(Ne.fromDom(g.getBody()), "#" + y).each(kt),
            h = null),
            $a(Ne.fromDom(g.getBody()), "#" + y).each(kt),
            h = null
        }, w = function() {
            o.hide()
        };
        return rr.ceFalse && function() {
            g.on("mouseup", function(e) {
                var t = r();
                t.collapsed && Qg(g, e.clientX, e.clientY) && a(bb(g, t, !1))
            }),
            g.on("click", function(e) {
                var t;
                (t = Kx(g, e.target)) && (Wx(t) && (e.preventDefault(),
                g.focus()),
                $x(t) && g.dom.isChildOf(t, g.selection.getNode()) && c())
            }),
            g.on("blur NewBlock", function() {
                c()
            }),
            g.on("ResizeWindow FullscreenStateChanged", function() {
                return o.reposition()
            });
            var n, i = function(e, t) {
                var n, r, o = g.dom.getParent(e, g.dom.isBlock), i = g.dom.getParent(t, g.dom.isBlock);
                return !(!o || !g.dom.isChildOf(o, i) || !1 !== Wx(Kx(g, o))) || o && (n = o,
                r = i,
                !(g.dom.getParent(n, g.dom.isBlock) === g.dom.getParent(r, g.dom.isBlock))) && function(e) {
                    var t = Hc(e);
                    if (!e.firstChild)
                        return !1;
                    var n = ms.before(e.firstChild)
                      , r = t.next(n);
                    return r && !Vf(r) && !qf(r)
                }(o)
            };
            (n = g).on("tap", function(e) {
                var t = Kx(n, e.target);
                Wx(t) && (e.preventDefault(),
                s(yb(n, t)))
            }, !0),
            g.on("mousedown", function(e) {
                var t, n = e.target;
                if ((n === v || "HTML" === n.nodeName || g.dom.isChildOf(n, v)) && !1 !== Qg(g, e.clientX, e.clientY))
                    if (t = Kx(g, n))
                        Wx(t) ? (e.preventDefault(),
                        s(yb(g, t))) : (c(),
                        $x(t) && e.shiftKey || Qh(e.clientX, e.clientY, g.selection.getRng()) || (w(),
                        g.selection.placeCaretAt(e.clientX, e.clientY)));
                    else if (!1 === cc(n)) {
                        c(),
                        w();
                        var r = pb(v, e.clientX, e.clientY);
                        if (r && !i(e.target, r.node)) {
                            e.preventDefault();
                            var o = b(1, r.node, r.before, !1);
                            g.getBody().focus(),
                            a(o)
                        }
                    }
            }),
            g.on("keypress", function(e) {
                Zh.modifierPressed(e) || (e.keyCode,
                Wx(g.selection.getNode()) && e.preventDefault())
            }),
            g.on("GetSelectionRange", function(e) {
                var t = e.range;
                if (h) {
                    if (!h.parentNode)
                        return void (h = null);
                    (t = t.cloneRange()).selectNode(h),
                    e.range = t
                }
            }),
            g.on("SetSelectionRange", function(e) {
                e.range = u(e.range);
                var t = s(e.range, e.forward);
                t && (e.range = t)
            });
            var t, e;
            g.on("AfterSetSelectionRange", function(e) {
                var t, n = e.range;
                C(n) || "mcepastebin" === n.startContainer.parentNode.id || w(),
                t = n.startContainer.parentNode,
                g.dom.hasClass(t, "mce-offscreen-selection") || c()
            }),
            g.on("copy", function(e) {
                var t, n = e.clipboardData;
                if (!e.isDefaultPrevented() && e.clipboardData && !rr.ie) {
                    var r = (t = g.dom.get(y)) ? t.getElementsByTagName("*")[0] : t;
                    r && (e.preventDefault(),
                    n.clearData(),
                    n.setData("text/html", r.outerHTML),
                    n.setData("text/plain", r.outerText))
                }
            }),
            qx(g),
            e = Ta(function() {
                if (!t.removed && t.getBody().contains(V.document.activeElement) && t.selection.getRng().collapsed) {
                    var e = Cb(t, t.selection.getRng(), !1);
                    t.selection.setRng(e)
                }
            }, 0),
            (t = g).on("focus", function() {
                e.throttle()
            }),
            t.on("blur", function() {
                e.cancel()
            })
        }(),
        {
            showCaret: b,
            showBlockCaretContainer: function(e) {
                e.hasAttribute("data-mce-caret") && (xu(e),
                a(r()),
                g.selection.scrollIntoView(e))
            },
            hideFakeCaret: w,
            destroy: function() {
                o.destroy(),
                h = null
            }
        }
    }
      , Yx = function(u) {
        var s, n, r, o = hr.each, c = Zh.BACKSPACE, l = Zh.DELETE, f = u.dom, d = u.selection, e = u.settings, t = u.parser, i = rr.gecko, a = rr.ie, m = rr.webkit, p = "data:text/mce-internal,", g = a ? "Text" : "URL", h = function(e, t) {
            try {
                u.getDoc().execCommand(e, !1, t)
            } catch (n) {}
        }, v = function(e) {
            return e.isDefaultPrevented()
        }, y = function() {
            u.shortcuts.add("meta+a", null, "SelectAll")
        }, b = function() {
            u.on("keydown", function(e) {
                if (!v(e) && e.keyCode === c && d.isCollapsed() && 0 === d.getRng().startOffset) {
                    var t = d.getNode().previousSibling;
                    if (t && t.nodeName && "table" === t.nodeName.toLowerCase())
                        return e.preventDefault(),
                        !1
                }
            })
        }, C = function() {
            u.inline || (u.contentStyles.push("body {min-height: 150px}"),
            u.on("click", function(e) {
                var t;
                if ("HTML" === e.target.nodeName) {
                    if (11 < rr.ie)
                        return void u.getBody().focus();
                    t = u.selection.getRng(),
                    u.getBody().focus(),
                    u.selection.setRng(t),
                    u.selection.normalize(),
                    u.nodeChanged()
                }
            }))
        };
        return u.on("keydown", function(e) {
            var t, n, r, o, i;
            if (!v(e) && e.keyCode === Zh.BACKSPACE && (n = (t = d.getRng()).startContainer,
            r = t.startOffset,
            o = f.getRoot(),
            i = n,
            t.collapsed && 0 === r)) {
                for (; i && i.parentNode && i.parentNode.firstChild === i && i.parentNode !== o; )
                    i = i.parentNode;
                "BLOCKQUOTE" === i.tagName && (u.formatter.toggle("blockquote", null, i),
                (t = f.createRng()).setStart(n, 0),
                t.setEnd(n, 0),
                d.setRng(t))
            }
        }),
        s = function(e) {
            var t = f.create("body")
              , n = e.cloneContents();
            return t.appendChild(n),
            d.serializer.serialize(t, {
                format: "html"
            })
        }
        ,
        u.on("keydown", function(e) {
            var t, n, r, o, i, a = e.keyCode;
            if (!v(e) && (a === l || a === c)) {
                if (t = u.selection.isCollapsed(),
                n = u.getBody(),
                t && !f.isEmpty(n))
                    return;
                if (!t && (r = u.selection.getRng(),
                o = s(r),
                (i = f.createRng()).selectNode(u.getBody()),
                o !== s(i)))
                    return;
                e.preventDefault(),
                u.setContent(""),
                n.firstChild && f.isBlock(n.firstChild) ? u.selection.setCursorLocation(n.firstChild, 0) : u.selection.setCursorLocation(n, 0),
                u.nodeChanged()
            }
        }),
        rr.windowsPhone || u.on("keyup focusin mouseup", function(e) {
            Zh.modifierPressed(e) || d.normalize()
        }, !0),
        m && (u.inline || f.bind(u.getDoc(), "mousedown mouseup", function(e) {
            var t;
            if (e.target === u.getDoc().documentElement)
                if (t = d.getRng(),
                u.getBody().focus(),
                "mousedown" === e.type) {
                    if (gu(t.startContainer))
                        return;
                    d.placeCaretAt(e.clientX, e.clientY)
                } else
                    d.setRng(t)
        }),
        u.on("click", function(e) {
            var t = e.target;
            /^(IMG|HR)$/.test(t.nodeName) && "false" !== f.getContentEditableParent(t) && (e.preventDefault(),
            u.selection.select(t),
            u.nodeChanged()),
            "A" === t.nodeName && f.hasClass(t, "mce-item-anchor") && (e.preventDefault(),
            d.select(t))
        }),
        e.forced_root_block && u.on("init", function() {
            h("DefaultParagraphSeparator", Hs(u))
        }),
        u.on("init", function() {
            u.dom.bind(u.getBody(), "submit", function(e) {
                e.preventDefault()
            })
        }),
        b(),
        t.addNodeFilter("br", function(e) {
            for (var t = e.length; t--; )
                "Apple-interchange-newline" === e[t].attr("class") && e[t].remove()
        }),
        rr.iOS ? (u.inline || u.on("keydown", function() {
            V.document.activeElement === V.document.body && u.getWin().focus()
        }),
        C(),
        u.on("click", function(e) {
            var t = e.target;
            do {
                if ("A" === t.tagName)
                    return void e.preventDefault()
            } while (t = t.parentNode)
        }),
        u.contentStyles.push(".mce-content-body {-webkit-touch-callout: none}")) : y()),
        11 <= rr.ie && (C(),
        b()),
        rr.ie && (y(),
        h("AutoUrlDetect", !1),
        u.on("dragstart", function(e) {
            var t, n, r;
            (t = e).dataTransfer && (u.selection.isCollapsed() && "IMG" === t.target.tagName && d.select(t.target),
            0 < (n = u.selection.getContent()).length && (r = p + escape(u.id) + "," + escape(n),
            t.dataTransfer.setData(g, r)))
        }),
        u.on("drop", function(e) {
            if (!v(e)) {
                var t = (i = e).dataTransfer && (a = i.dataTransfer.getData(g)) && 0 <= a.indexOf(p) ? (a = a.substr(p.length).split(","),
                {
                    id: unescape(a[0]),
                    html: unescape(a[1])
                }) : null;
                if (t && t.id !== u.id) {
                    e.preventDefault();
                    var n = Bh(e.x, e.y, u.getDoc());
                    d.setRng(n),
                    r = t.html,
                    o = !0,
                    u.queryCommandSupported("mceInsertClipboardContent") ? u.execCommand("mceInsertClipboardContent", !1, {
                        content: r,
                        internal: o
                    }) : u.execCommand("mceInsertContent", !1, r)
                }
            }
            var r, o, i, a
        })),
        i && (u.on("keydown", function(e) {
            if (!v(e) && e.keyCode === c) {
                if (!u.getBody().getElementsByTagName("hr").length)
                    return;
                if (d.isCollapsed() && 0 === d.getRng().startOffset) {
                    var t = d.getNode()
                      , n = t.previousSibling;
                    if ("HR" === t.nodeName)
                        return f.remove(t),
                        void e.preventDefault();
                    n && n.nodeName && "hr" === n.nodeName.toLowerCase() && (f.remove(n),
                    e.preventDefault())
                }
            }
        }),
        V.Range.prototype.getClientRects || u.on("mousedown", function(e) {
            if (!v(e) && "HTML" === e.target.nodeName) {
                var t = u.getBody();
                t.blur(),
                Xn.setEditorTimeout(u, function() {
                    t.focus()
                })
            }
        }),
        n = function() {
            var e = f.getAttribs(d.getStart().cloneNode(!1));
            return function() {
                var t = d.getStart();
                t !== u.getBody() && (f.setAttrib(t, "style", null),
                o(e, function(e) {
                    t.setAttributeNode(e.cloneNode(!0))
                }))
            }
        }
        ,
        r = function() {
            return !d.isCollapsed() && f.getParent(d.getStart(), f.isBlock) !== f.getParent(d.getEnd(), f.isBlock)
        }
        ,
        u.on("keypress", function(e) {
            var t;
            if (!v(e) && (8 === e.keyCode || 46 === e.keyCode) && r())
                return t = n(),
                u.getDoc().execCommand("delete", !1, null),
                t(),
                e.preventDefault(),
                !1
        }),
        f.bind(u.getDoc(), "cut", function(e) {
            var t;
            !v(e) && r() && (t = n(),
            Xn.setEditorTimeout(u, function() {
                t()
            }))
        }),
        e.readonly || u.on("BeforeExecCommand mousedown", function() {
            h("StyleWithCSS", !1),
            h("enableInlineTableEditing", !1),
            e.object_resizing || h("enableObjectResizing", !1)
        }),
        u.on("SetContent ExecCommand", function(e) {
            "setcontent" !== e.type && "mceInsertLink" !== e.command || o(f.select("a"), function(e) {
                var t = e.parentNode
                  , n = f.getRoot();
                if (t.lastChild === e) {
                    for (; t && !f.isBlock(t); ) {
                        if (t.parentNode.lastChild !== t || t === n)
                            return;
                        t = t.parentNode
                    }
                    f.add(t, "br", {
                        "data-mce-bogus": 1
                    })
                }
            })
        }),
        u.contentStyles.push("img:-moz-broken {-moz-force-broken-image-icon:1;min-width:24px;min-height:24px}"),
        rr.mac && u.on("keydown", function(e) {
            !Zh.metaKeyPressed(e) || e.shiftKey || 37 !== e.keyCode && 39 !== e.keyCode || (e.preventDefault(),
            u.selection.getSel().modify("move", 37 === e.keyCode ? "backward" : "forward", "lineboundary"))
        }),
        b()),
        {
            refreshContentEditable: function() {},
            isHidden: function() {
                var e;
                return !(!i || u.removed) && (!(e = u.selection.getSel()) || !e.rangeCount || 0 === e.rangeCount)
            }
        }
    }
      , Gx = ga.DOM
      , Jx = function(e) {
        return le(e, function(e) {
            return !1 === A(e)
        })
    }
      , Qx = function(e) {
        var t, n = e.settings, r = e.editorUpload.blobCache;
        return Jx({
            allow_conditional_comments: n.allow_conditional_comments,
            allow_html_in_named_anchor: n.allow_html_in_named_anchor,
            allow_script_urls: n.allow_script_urls,
            allow_unsafe_link_target: n.allow_unsafe_link_target,
            convert_fonts_to_spans: n.convert_fonts_to_spans,
            fix_list_elements: n.fix_list_elements,
            font_size_legacy_values: n.font_size_legacy_values,
            forced_root_block: n.forced_root_block,
            forced_root_block_attrs: n.forced_root_block_attrs,
            padd_empty_with_br: n.padd_empty_with_br,
            preserve_cdata: n.preserve_cdata,
            remove_trailing_brs: n.remove_trailing_brs,
            inline_styles: n.inline_styles,
            root_name: (t = e).inline ? t.getElement().nodeName.toLowerCase() : undefined,
            validate: !0,
            blob_cache: r,
            images_dataimg_filter: n.images_dataimg_filter
        })
    }
      , Zx = function(u) {
        var e = u.dom.getRoot();
        u.inline || Gl(u) && u.selection.getStart(!0) !== e || Zc(e).each(function(e) {
            var t, n, r, o, i = e.getNode(), a = Gt(i) ? Zc(i).getOr(e) : e;
            rr.browser.isIE() ? (t = u,
            n = a.toRange(),
            r = Ne.fromDom(t.getBody()),
            o = (hm(t) ? R.from(n) : R.none()).map(vm).filter(gm(r)),
            t.bookmark = o.isSome() ? o : t.bookmark) : u.selection.setRng(a.toRange())
        })
    }
      , eS = function(e) {
        var t;
        e.bindPendingEventDelegates(),
        e.initialized = !0,
        e.fire("Init"),
        e.focus(!0),
        Zx(e),
        e.nodeChanged({
            initial: !0
        }),
        e.execCallback("init_instance_callback", e),
        (t = e).settings.auto_focus && Xn.setEditorTimeout(t, function() {
            var e;
            (e = !0 === t.settings.auto_focus ? t : t.editorManager.get(t.settings.auto_focus)).destroyed || e.focus()
        }, 100)
    }
      , tS = function(t, e) {
        var n = t.settings
          , r = t.getDoc()
          , o = t.getBody();
        n.browser_spellcheck || n.gecko_spellcheck || (r.body.spellcheck = !1,
        Gx.setAttrib(o, "spellcheck", "false")),
        t.quirks = Yx(t),
        t.fire("PostRender");
        var i, a, u, s, c, l = t.getParam("directionality", ka.isRtl() ? "rtl" : undefined);
        if (l !== undefined && (o.dir = l),
        n.protect && t.on("BeforeSetContent", function(t) {
            hr.each(n.protect, function(e) {
                t.content = t.content.replace(e, function(e) {
                    return "\x3c!--mce:protected " + escape(e) + "--\x3e"
                })
            })
        }),
        t.on("SetContent", function() {
            t.addVisual(t.getBody())
        }),
        !1 === e && t.load({
            initial: !0,
            format: "html"
        }),
        t.startContent = t.getContent({
            format: "raw"
        }),
        t.on("compositionstart compositionend", function(e) {
            t.composing = "compositionstart" === e.type
        }),
        0 < t.contentStyles.length) {
            var f = "";
            hr.each(t.contentStyles, function(e) {
                f += e + "\r\n"
            }),
            t.dom.addStyle(f)
        }
        ((i = t).inline ? Gx.styleSheetLoader : i.dom.styleSheetLoader).loadAll(t.contentCSS, function(e) {
            eS(t)
        }, function(e) {
            eS(t)
        }),
        n.content_style && (a = t,
        u = n.content_style,
        s = Ne.fromDom(a.getDoc().head),
        c = Ne.fromTag("style"),
        cn(c, "type", "text/css"),
        St(c, Ne.fromText(u)),
        St(s, c))
    }
      , nS = function(t, e) {
        var n, u, r, o, i, a, s, c = t.settings, l = t.getElement(), f = t.getDoc();
        c.inline || (t.getElement().style.visibility = t.orgVisibility),
        e || t.inline || (f.open(),
        f.write(t.iframeHTML),
        f.close()),
        t.inline && (t.on("remove", function() {
            var e = this.getBody();
            Gx.removeClass(e, "mce-content-body"),
            Gx.removeClass(e, "mce-edit-focus"),
            Gx.setAttrib(e, "contentEditable", null)
        }),
        Gx.addClass(l, "mce-content-body"),
        t.contentDocument = f = V.document,
        t.contentWindow = V.window,
        t.bodyElement = l,
        t.contentAreaContainer = l),
        (n = t.getBody()).disabled = !0,
        t.readonly = !!c.readonly,
        t.readonly || (t.inline && "static" === Gx.getStyle(n, "position", !0) && (n.style.position = "relative"),
        n.contentEditable = t.getParam("content_editable_state", !0)),
        n.disabled = !1,
        t.editorUpload = Pv(t),
        t.schema = no(c),
        t.dom = ga(f, {
            keep_values: !0,
            url_converter: t.convertURL,
            url_converter_scope: t,
            hex_colors: c.force_hex_style_colors,
            update_styles: !0,
            root_element: t.inline ? t.getBody() : null,
            collect: function() {
                return t.inline
            },
            schema: t.schema,
            contentCssCors: t.getParam("content_css_cors", !1, "boolean"),
            referrerPolicy: t.getParam("referrer_policy", "", "string"),
            onSetAttrib: function(e) {
                t.fire("SetAttrib", e)
            }
        }),
        t.parser = ((r = Ev(Qx(u = t), u.schema)).addAttributeFilter("src,href,style,tabindex", function(e, t) {
            for (var n, r, o = e.length, i = u.dom, a = "data-mce-" + t; o--; )
                if ((r = (n = e[o]).attr(t)) && !n.attr(a)) {
                    if (0 === r.indexOf("data:") || 0 === r.indexOf("blob:"))
                        continue;
                    "style" === t ? ((r = i.serializeStyle(i.parseStyle(r), n.name)).length || (r = null),
                    n.attr(a, r),
                    n.attr(t, r)) : "tabindex" === t ? (n.attr(a, r),
                    n.attr(t, null)) : n.attr(a, u.convertURL(r, t, n.name))
                }
        }),
        r.addNodeFilter("script", function(e) {
            for (var t, n, r = e.length; r--; )
                0 !== (n = (t = e[r]).attr("type") || "no/type").indexOf("mce-") && t.attr("type", "mce-" + n)
        }),
        u.settings.preserve_cdata && r.addNodeFilter("#cdata", function(e) {
            for (var t, n = e.length; n--; )
                (t = e[n]).type = 8,
                t.name = "#comment",
                t.value = "[CDATA[" + u.dom.encode(t.value) + "]]"
        }),
        r.addNodeFilter("p,h1,h2,h3,h4,h5,h6,div", function(e) {
            for (var t, n = e.length, r = u.schema.getNonEmptyElements(); n--; )
                (t = e[n]).isEmpty(r) && 0 === t.getAll("br").length && (t.append(new df("br",1)).shortEnded = !0)
        }),
        r),
        t.serializer = Av((i = (o = t).settings,
        pe(pe({}, Qx(o)), Jx({
            url_converter: i.url_converter,
            url_converter_scope: i.url_converter_scope,
            element_format: i.element_format,
            entities: i.entities,
            entity_encoding: i.entity_encoding,
            indent: i.indent,
            indent_after: i.indent_after,
            indent_before: i.indent_before,
            block_elements: i.block_elements,
            boolean_attributes: i.boolean_attributes,
            custom_elements: i.custom_elements,
            extended_valid_elements: i.extended_valid_elements,
            invalid_elements: i.invalid_elements,
            invalid_styles: i.invalid_styles,
            move_caret_before_on_enter_elements: i.move_caret_before_on_enter_elements,
            non_empty_elements: i.non_empty_elements,
            schema: i.schema,
            self_closing_elements: i.self_closing_elements,
            short_ended_elements: i.short_ended_elements,
            special: i.special,
            text_block_elements: i.text_block_elements,
            text_inline_elements: i.text_inline_elements,
            valid_children: i.valid_children,
            valid_classes: i.valid_classes,
            valid_elements: i.valid_elements,
            valid_styles: i.valid_styles,
            verify_html: i.verify_html,
            whitespace_elements: i.whitespace_elements
        }))), t),
        t.selection = av(t.dom, t.getWin(), t.serializer, t),
        t.annotator = af(t),
        t.formatter = Wv(t),
        t.undoManager = Xv(t),
        t._nodeChangeDispatcher = new Tx(t),
        t._selectionOverrides = Xx(t),
        ty(t),
        Dx(t),
        yg(t) || Bx(t),
        yg(a = t) || Rx(a),
        Hs(s = t) && s.on("NodeChange", N(oy, s)),
        Zv(t),
        t.fire("PreInit"),
        bg(t).fold(function() {
            tS(t, !1)
        }, function(e) {
            t.setProgressState(!0),
            e.then(function(e) {
                t.setProgressState(!1),
                tS(t, e)
            })
        })
    }
      , rS = ga.DOM
      , oS = function(e) {
        var t, n, r;
        return r = e.getParam("doctype", "<!DOCTYPE html>") + "<html><head>",
        e.getParam("document_base_url", "") !== e.documentBaseUrl && (r += '<base href="' + e.documentBaseURI.getURI() + '" />'),
        r += '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />',
        t = zs(e, "body_id", "tinymce"),
        n = zs(e, "body_class", ""),
        js(e) && (r += '<meta http-equiv="Content-Security-Policy" content="' + js(e) + '" />'),
        r += '</head><body id="' + t + '" class="mce-content-body ' + n + '" data-id="' + e.id + '"><br></body></html>'
    }
      , iS = function(e, t) {
        var n, r, o, i, a = e.editorManager.translate("Rich Text Area. Press ALT-0 for help."), u = (n = e.id,
        r = a,
        t.height,
        o = e.getParam("iframe_attrs", {}),
        i = Ne.fromTag("iframe"),
        ln(i, o),
        ln(i, {
            id: n + "_ifr",
            frameBorder: "0",
            allowTransparency: "true",
            title: r
        }),
        La(i, "tox-edit-area__iframe"),
        i.dom());
        u.onload = function() {
            u.onload = null,
            e.fire("load")
        }
        ;
        var s = function(e, t) {
            if (V.document.domain !== V.window.location.hostname && rr.browser.isIE()) {
                var n = Bv("mce");
                e[n] = function() {
                    nS(e)
                }
                ;
                var r = 'javascript:(function(){document.open();document.domain="' + V.document.domain + '";var ed = window.parent.tinymce.get("' + e.id + '");document.write(ed.iframeHTML);document.close();ed.' + n + "(true);})()";
                return rS.setAttrib(t, "src", r),
                !0
            }
            return !1
        }(e, u);
        return e.contentAreaContainer = t.iframeContainer,
        e.iframeElement = u,
        e.iframeHTML = oS(e),
        rS.add(t.iframeContainer, u),
        s
    }
      , aS = ga.DOM
      , uS = function(t, n, e) {
        var r = th.get(e)
          , o = th.urls[e] || t.documentBaseUrl.replace(/\/$/, "");
        if (e = hr.trim(e),
        r && -1 === hr.inArray(n, e)) {
            if (hr.each(th.dependencies(e), function(e) {
                uS(t, n, e)
            }),
            t.plugins[e])
                return;
            try {
                var i = new r(t,o,t.$);
                (t.plugins[e] = i).init && (i.init(t, o),
                n.push(e))
            } catch (pE) {
                !function(e, t, n) {
                    var r = ka.translate(["Failed to initialize plugin: {0}", t]);
                    ch(r, n),
                    ih(e, r)
                }(t, e, pE)
            }
        }
    }
      , sS = function(e) {
        return e.replace(/^\-/, "")
    }
      , cS = function(e) {
        return {
            editorContainer: e,
            iframeContainer: e
        }
    }
      , lS = function(e) {
        var t, n, r = e.getElement();
        return e.inline ? cS(null) : (t = r,
        n = aS.create("div"),
        aS.insertAfter(n, t),
        cS(n))
    }
      , fS = function(e) {
        var n, t, r, o, i, a;
        e.fire("ScriptsLoaded"),
        n = e,
        t = hr.trim($s(n)),
        r = n.ui.registry.getAll().icons,
        o = pe(pe({}, $g.get("default").icons), $g.get(t).icons),
        oe(o, function(e, t) {
            me(r, t) || n.ui.registry.addIcon(t, e)
        }),
        function(e) {
            var t = e.settings.theme;
            if (q(t)) {
                e.settings.theme = sS(t);
                var n = nh.get(t);
                e.theme = new n(e,nh.urls[t]),
                e.theme.init && e.theme.init(e, nh.urls[t] || e.documentBaseUrl.replace(/\/$/, ""), e.$)
            } else
                e.theme = {}
        }(e),
        i = e,
        a = [],
        hr.each(i.settings.plugins.split(/[ ,]/), function(e) {
            uS(i, a, sS(e))
        });
        var u, s, c, l, f, d, m, p, g, h = (f = (u = e).getElement(),
        u.orgDisplay = f.style.display,
        q(u.settings.theme) ? u.theme.renderUI() : D(u.settings.theme) ? (c = (s = u).getElement(),
        (l = (0,
        s.settings.theme)(s, c)).editorContainer.nodeType && (l.editorContainer.id = l.editorContainer.id || s.id + "_parent"),
        l.iframeContainer && l.iframeContainer.nodeType && (l.iframeContainer.id = l.iframeContainer.id || s.id + "_iframecontainer"),
        l.height = l.iframeHeight ? l.iframeHeight : c.offsetHeight,
        l) : lS(u));
        return e.editorContainer = h.editorContainer ? h.editorContainer : null,
        (d = e).contentCSS = d.contentCSS.concat(lh(d)),
        e.inline ? nS(e) : (g = iS(m = e, p = h),
        p.editorContainer && (rS.get(p.editorContainer).style.display = m.orgDisplay,
        m.hidden = rS.isHidden(p.editorContainer)),
        m.getElement().style.display = "none",
        rS.setAttrib(m.id, "aria-hidden", "true"),
        void (g || nS(m)))
    }
      , dS = ga.DOM
      , mS = function(e) {
        return "-" === e.charAt(0)
    }
      , pS = function(e, t) {
        var n = Ws(t)
          , r = t.getParam("language_url", "", "string");
        if (!1 === ka.hasCode(n) && "en" !== n) {
            var o = "" !== r ? r : t.editorManager.baseURL + "/langs/" + n + ".js";
            e.add(o, f, undefined, function() {
                ah(t, "LanguageLoadError", uh("language", o, n))
            })
        }
    }
      , gS = function(t, e, n) {
        return R.from(e).filter(function(e) {
            return 0 < e.length && !$g.has(e)
        }).map(function(e) {
            return {
                url: t.editorManager.baseURL + "/icons/" + e + "/icons" + n + ".js",
                name: R.some(e)
            }
        })
    }
      , hS = function(e, o, t) {
        var n, r = gS(o, "default", t), i = (n = o,
        R.from(n.getParam("icons_url", "", "string")).filter(function(e) {
            return 0 < e.length
        }).map(function(e) {
            return {
                url: e,
                name: R.none()
            }
        }).orThunk(function() {
            return gS(o, $s(o), "")
        }));
        z(function(e) {
            for (var t = [], n = function(e) {
                t.push(e)
            }, r = 0; r < e.length; r++)
                e[r].each(n);
            return t
        }([r, i]), function(r) {
            e.add(r.url, f, undefined, function() {
                var e, t, n;
                e = o,
                t = r.url,
                n = r.name.getOrUndefined(),
                ah(e, "IconsLoadError", uh("icons", t, n))
            })
        })
    }
      , vS = function(e, t) {
        var i = ba.ScriptLoader;
        !function(e, t, n, r) {
            var o = t.settings
              , i = o.theme;
            if (q(i)) {
                if (!mS(i) && !nh.urls.hasOwnProperty(i)) {
                    var a = o.theme_url;
                    a ? nh.load(i, t.documentBaseURI.toAbsolute(a)) : nh.load(i, "themes/" + i + "/theme" + n + ".js")
                }
                e.loadQueue(function() {
                    nh.waitFor(i, r)
                })
            } else
                r()
        }(i, e, t, function() {
            var r, n, o;
            pS(i, e),
            hS(i, e, t),
            n = (r = e).settings,
            o = t,
            k(n.plugins) && (n.plugins = n.plugins.join(" ")),
            hr.each(n.external_plugins, function(e, t) {
                th.load(t, e, f, undefined, function() {
                    sh(r, e, t)
                }),
                n.plugins += " " + t
            }),
            hr.each(n.plugins.split(/[ ,]/), function(e) {
                if ((e = hr.trim(e)) && !th.urls[e])
                    if (mS(e)) {
                        e = e.substr(1, e.length);
                        var t = th.dependencies(e);
                        hr.each(t, function(e) {
                            var t = {
                                prefix: "plugins/",
                                resource: e,
                                suffix: "/plugin" + o + ".js"
                            }
                              , n = th.createUrl(t, e);
                            th.load(n.resource, n, f, undefined, function() {
                                sh(r, n.prefix + n.resource + n.suffix, n.resource)
                            })
                        })
                    } else {
                        var n = {
                            prefix: "plugins/",
                            resource: e,
                            suffix: "/plugin" + o + ".js"
                        };
                        th.load(e, n, f, undefined, function() {
                            sh(r, n.prefix + n.resource + n.suffix, e)
                        })
                    }
            }),
            i.loadQueue(function() {
                e.removed || fS(e)
            }, e, function() {
                e.removed || fS(e)
            })
        })
    }
      , yS = function(e, t) {
        var n, r, o, i, a = "string" != typeof (n = t) ? (r = hr.extend({
            paste: n.paste,
            data: {
                paste: n.paste
            }
        }, n),
        {
            content: n.content,
            details: r
        }) : {
            content: n,
            details: {}
        };
        o = a.content,
        i = a.details,
        Cg(e).editor.insertContent(o, i)
    }
      , bS = function(e, t) {
        e.getDoc().execCommand(t, !1, null)
    }
      , CS = function(e) {
        return D(e) ? e : x(!1)
    }
      , wS = function(e, t, n) {
        var r = t(e)
          , o = CS(n);
        return r.orThunk(function() {
            return o(e) ? R.none() : function(e, t, n) {
                for (var r = e.dom(), o = CS(n); r.parentNode; ) {
                    r = r.parentNode;
                    var i = Ne.fromDom(r)
                      , a = t(i);
                    if (a.isSome())
                        return a;
                    if (o(i))
                        break
                }
                return R.none()
            }(e, t, o)
        })
    }
      , xS = {
        "font-size": "size",
        "font-family": "face"
    }
      , SS = function(e, t, n) {
        var r = function(r) {
            return gn(r, e).orThunk(function() {
                return "font" === Rt(r) ? de(xS, e).bind(function(e) {
                    return t = r,
                    n = e,
                    R.from(fn(t, n));
                    var t, n
                }) : R.none()
            })
        };
        return wS(Ne.fromDom(n), function(e) {
            return r(e)
        }, function(e) {
            return at(Ne.fromDom(t), e)
        })
    }
      , NS = function(o) {
        return function(r, e) {
            return R.from(e).map(Ne.fromDom).filter(Dt).bind(function(e) {
                return SS(o, r, e.dom()).or((t = o,
                n = e.dom(),
                R.from(ga.DOM.getStyle(n, t, !0))));
                var t, n
            }).getOr("")
        }
    }
      , ES = NS("font-size")
      , kS = a(function(e) {
        return e.replace(/[\'\"\\]/g, "").replace(/,\s+/g, ",")
    }, NS("font-family"))
      , _S = function(e) {
        return Zc(e.getBody()).map(function(e) {
            var t = e.container();
            return Zt(t) ? t.parentNode : t
        })
    }
      , RS = function(o) {
        return R.from(o.selection.getRng()).bind(function(e) {
            var t, n, r = o.getBody();
            return n = r,
            (t = e).startContainer === n && 0 === t.startOffset ? R.none() : R.from(o.selection.getStart(!0))
        })
    }
      , TS = function(e, t) {
        if (/^[0-9\.]+$/.test(t)) {
            var n = parseInt(t, 10);
            if (1 <= n && n <= 7) {
                var r = (a = e,
                hr.explode(a.getParam("font_size_style_values", "xx-small,x-small,small,medium,large,x-large,xx-large")))
                  , o = (i = e,
                hr.explode(i.getParam("font_size_classes", "")));
                return o ? o[n - 1] || t : r[n - 1] || t
            }
            return t
        }
        return t;
        var i, a
    }
      , AS = function(e, t) {
        var n, r = TS(e, t);
        e.formatter.toggle("fontname", {
            value: (n = r.split(/\s*,\s*/),
            U(n, function(e) {
                return -1 === e.indexOf(" ") || Ve(e, '"') || Ve(e, "'") ? e : "'" + e + "'"
            }).join(","))
        }),
        e.nodeChanged()
    }
      , DS = hr.each
      , OS = hr.map
      , BS = hr.inArray
      , PS = (LS.prototype.execCommand = function(t, n, r, e) {
        var o, i, a = !1, u = this;
        if (!u.editor.removed) {
            var s;
            if (/^(mceAddUndoLevel|mceEndUndoLevel|mceBeginUndoLevel|mceRepaint)$/.test(t) || e && e.skip_focus ? (s = u.editor,
            wm(s).each(function(e) {
                s.selection.setRng(e)
            })) : u.editor.focus(),
            (e = u.editor.fire("BeforeExecCommand", {
                command: t,
                ui: n,
                value: r
            })).isDefaultPrevented())
                return !1;
            if (i = t.toLowerCase(),
            o = u.commands.exec[i])
                return o(i, n, r),
                u.editor.fire("ExecCommand", {
                    command: t,
                    ui: n,
                    value: r
                }),
                !0;
            if (DS(this.editor.plugins, function(e) {
                if (e.execCommand && e.execCommand(t, n, r))
                    return u.editor.fire("ExecCommand", {
                        command: t,
                        ui: n,
                        value: r
                    }),
                    !(a = !0)
            }),
            a)
                return a;
            if (u.editor.theme && u.editor.theme.execCommand && u.editor.theme.execCommand(t, n, r))
                return u.editor.fire("ExecCommand", {
                    command: t,
                    ui: n,
                    value: r
                }),
                !0;
            try {
                a = u.editor.getDoc().execCommand(t, n, r)
            } catch (c) {}
            return !!a && (u.editor.fire("ExecCommand", {
                command: t,
                ui: n,
                value: r
            }),
            !0)
        }
    }
    ,
    LS.prototype.queryCommandState = function(e) {
        var t;
        if (!this.editor.quirks.isHidden() && !this.editor.removed) {
            if (e = e.toLowerCase(),
            t = this.commands.state[e])
                return t(e);
            try {
                return this.editor.getDoc().queryCommandState(e)
            } catch (n) {}
            return !1
        }
    }
    ,
    LS.prototype.queryCommandValue = function(e) {
        var t;
        if (!this.editor.quirks.isHidden() && !this.editor.removed) {
            if (e = e.toLowerCase(),
            t = this.commands.value[e])
                return t(e);
            try {
                return this.editor.getDoc().queryCommandValue(e)
            } catch (n) {}
        }
    }
    ,
    LS.prototype.addCommands = function(e, n) {
        var r = this;
        n = n || "exec",
        DS(e, function(t, e) {
            DS(e.toLowerCase().split(","), function(e) {
                r.commands[n][e] = t
            })
        })
    }
    ,
    LS.prototype.addCommand = function(e, o, i) {
        var a = this;
        e = e.toLowerCase(),
        this.commands.exec[e] = function(e, t, n, r) {
            return o.call(i || a.editor, t, n, r)
        }
    }
    ,
    LS.prototype.queryCommandSupported = function(e) {
        if (e = e.toLowerCase(),
        this.commands.exec[e])
            return !0;
        try {
            return this.editor.getDoc().queryCommandSupported(e)
        } catch (t) {}
        return !1
    }
    ,
    LS.prototype.addQueryStateHandler = function(e, t, n) {
        var r = this;
        e = e.toLowerCase(),
        this.commands.state[e] = function() {
            return t.call(n || r.editor)
        }
    }
    ,
    LS.prototype.addQueryValueHandler = function(e, t, n) {
        var r = this;
        e = e.toLowerCase(),
        this.commands.value[e] = function() {
            return t.call(n || r.editor)
        }
    }
    ,
    LS.prototype.hasCustomCommand = function(e) {
        return e = e.toLowerCase(),
        !!this.commands.exec[e]
    }
    ,
    LS.prototype.execNativeCommand = function(e, t, n) {
        return t === undefined && (t = !1),
        n === undefined && (n = null),
        this.editor.getDoc().execCommand(e, t, n)
    }
    ,
    LS.prototype.isFormatMatch = function(e) {
        return this.editor.formatter.match(e)
    }
    ,
    LS.prototype.toggleFormat = function(e, t) {
        this.editor.formatter.toggle(e, t ? {
            value: t
        } : undefined),
        this.editor.nodeChanged()
    }
    ,
    LS.prototype.storeSelection = function(e) {
        this.selectionBookmark = this.editor.selection.getBookmark(e)
    }
    ,
    LS.prototype.restoreSelection = function() {
        this.editor.selection.moveToBookmark(this.selectionBookmark)
    }
    ,
    LS.prototype.setupCommands = function(i) {
        var a = this;
        this.addCommands({
            "mceResetDesignMode,mceBeginUndoLevel": function() {},
            "mceEndUndoLevel,mceAddUndoLevel": function() {
                i.undoManager.add()
            },
            "Cut,Copy,Paste": function(e) {
                var t, n = i.getDoc();
                try {
                    a.execNativeCommand(e)
                } catch (o) {
                    t = !0
                }
                if ("paste" !== e || n.queryCommandEnabled(e) || (t = !0),
                t || !n.queryCommandSupported(e)) {
                    var r = i.translate("Your browser doesn't support direct access to the clipboard. Please use the Ctrl+X/C/V keyboard shortcuts instead.");
                    rr.mac && (r = r.replace(/Ctrl\+/g, "\u2318+")),
                    i.notificationManager.open({
                        text: r,
                        type: "error"
                    })
                }
            },
            unlink: function() {
                if (i.selection.isCollapsed()) {
                    var e = i.dom.getParent(i.selection.getStart(), "a");
                    e && i.dom.remove(e, !0)
                } else
                    i.formatter.remove("link")
            },
            "JustifyLeft,JustifyCenter,JustifyRight,JustifyFull,JustifyNone": function(e) {
                var t = e.substring(7);
                "full" === t && (t = "justify"),
                DS("left,center,right,justify".split(","), function(e) {
                    t !== e && i.formatter.remove("align" + e)
                }),
                "none" !== t && a.toggleFormat("align" + t)
            },
            "InsertUnorderedList,InsertOrderedList": function(e) {
                var t, n;
                a.execNativeCommand(e),
                (t = i.dom.getParent(i.selection.getNode(), "ol,ul")) && (n = t.parentNode,
                /^(H[1-6]|P|ADDRESS|PRE)$/.test(n.nodeName) && (a.storeSelection(),
                i.dom.split(n, t),
                a.restoreSelection()))
            },
            "Bold,Italic,Underline,Strikethrough,Superscript,Subscript": function(e) {
                a.toggleFormat(e)
            },
            "ForeColor,HiliteColor": function(e, t, n) {
                a.toggleFormat(e, n)
            },
            FontName: function(e, t, n) {
                AS(i, n)
            },
            FontSize: function(e, t, n) {
                var r, o;
                o = n,
                (r = i).formatter.toggle("fontsize", {
                    value: TS(r, o)
                }),
                r.nodeChanged()
            },
            RemoveFormat: function(e) {
                i.formatter.remove(e)
            },
            mceBlockQuote: function() {
                a.toggleFormat("blockquote")
            },
            FormatBlock: function(e, t, n) {
                return a.toggleFormat(n || "p")
            },
            mceCleanup: function() {
                var e = i.selection.getBookmark();
                i.setContent(i.getContent()),
                i.selection.moveToBookmark(e)
            },
            mceRemoveNode: function(e, t, n) {
                var r = n || i.selection.getNode();
                r !== i.getBody() && (a.storeSelection(),
                i.dom.remove(r, !0),
                a.restoreSelection())
            },
            mceSelectNodeDepth: function(e, t, n) {
                var r = 0;
                i.dom.getParent(i.selection.getNode(), function(e) {
                    if (1 === e.nodeType && r++ === n)
                        return i.selection.select(e),
                        !1
                }, i.getBody())
            },
            mceSelectNode: function(e, t, n) {
                i.selection.select(n)
            },
            mceInsertContent: function(e, t, n) {
                yS(i, n)
            },
            mceInsertRawHTML: function(e, t, n) {
                i.selection.setContent("tiny_mce_marker");
                var r = i.getContent();
                i.setContent(r.replace(/tiny_mce_marker/g, function() {
                    return n
                }))
            },
            mceInsertNewLine: function(e, t, n) {
                nx(i, n)
            },
            mceToggleFormat: function(e, t, n) {
                a.toggleFormat(n)
            },
            mceSetContent: function(e, t, n) {
                i.setContent(n)
            },
            "Indent,Outdent": function(e) {
                uw(i, e)
            },
            mceRepaint: function() {},
            InsertHorizontalRule: function() {
                i.execCommand("mceInsertContent", !1, "<hr />")
            },
            mceToggleVisualAid: function() {
                i.hasVisual = !i.hasVisual,
                i.addVisual()
            },
            mceReplaceContent: function(e, t, n) {
                i.execCommand("mceInsertContent", !1, n.replace(/\{\$selection\}/g, i.selection.getContent({
                    format: "text"
                })))
            },
            mceInsertLink: function(e, t, n) {
                var r;
                "string" == typeof n && (n = {
                    href: n
                }),
                r = i.dom.getParent(i.selection.getNode(), "a"),
                n.href = n.href.replace(/ /g, "%20"),
                r && n.href || i.formatter.remove("link"),
                n.href && i.formatter.apply("link", n, r)
            },
            selectAll: function() {
                var e = i.dom.getParent(i.selection.getStart(), on);
                if (e) {
                    var t = i.dom.createRng();
                    t.selectNodeContents(e),
                    i.selection.setRng(t)
                }
            },
            "delete": function() {
                var e;
                hw(e = i) || qC(e, !1) || WC(e, !1) || GC(e, !1) || NC(e, !1) || Vd(e) || RC(e) || ew(e, !1) || (bS(e, "Delete"),
                dC(e))
            },
            forwardDelete: function() {
                var e;
                qC(e = i, !0) || WC(e, !0) || GC(e, !0) || NC(e, !0) || Vd(e) || RC(e) || ew(e, !0) || bS(e, "ForwardDelete")
            },
            mceNewDocument: function() {
                i.setContent("")
            },
            InsertLineBreak: function(e, t, n) {
                return Hw(i, n),
                !0
            }
        });
        var e = function(n) {
            return function() {
                var e = i.selection.isCollapsed() ? [i.dom.getParent(i.selection.getNode(), i.dom.isBlock)] : i.selection.getSelectedBlocks()
                  , t = OS(e, function(e) {
                    return !!i.formatter.matchNode(e, n)
                });
                return -1 !== BS(t, !0)
            }
        };
        a.addCommands({
            JustifyLeft: e("alignleft"),
            JustifyCenter: e("aligncenter"),
            JustifyRight: e("alignright"),
            JustifyFull: e("alignjustify"),
            "Bold,Italic,Underline,Strikethrough,Superscript,Subscript": function(e) {
                return a.isFormatMatch(e)
            },
            mceBlockQuote: function() {
                return a.isFormatMatch("blockquote")
            },
            Outdent: function() {
                return ow(i)
            },
            "InsertUnorderedList,InsertOrderedList": function(e) {
                var t = i.dom.getParent(i.selection.getNode(), "ul,ol");
                return t && ("insertunorderedlist" === e && "UL" === t.tagName || "insertorderedlist" === e && "OL" === t.tagName)
            }
        }, "state"),
        a.addCommands({
            Undo: function() {
                i.undoManager.undo()
            },
            Redo: function() {
                i.undoManager.redo()
            }
        }),
        a.addQueryValueHandler("FontName", function() {
            return RS(t = i).fold(function() {
                return _S(t).map(function(e) {
                    return kS(t.getBody(), e)
                }).getOr("")
            }, function(e) {
                return kS(t.getBody(), e)
            });
            var t
        }, this),
        a.addQueryValueHandler("FontSize", function() {
            return RS(t = i).fold(function() {
                return _S(t).map(function(e) {
                    return ES(t.getBody(), e)
                }).getOr("")
            }, function(e) {
                return ES(t.getBody(), e)
            });
            var t
        }, this)
    }
    ,
    LS);
    function LS(e) {
        this.commands = {
            state: {},
            exec: {},
            value: {}
        },
        this.editor = e,
        this.setupCommands(e)
    }
    var IS = hr.makeMap("focus blur focusin focusout click dblclick mousedown mouseup mousemove mouseover beforepaste paste cut copy selectionchange mouseout mouseenter mouseleave wheel keydown keypress keyup input beforeinput contextmenu dragstart dragend dragover draggesture dragdrop drop drag submit compositionstart compositionend compositionupdate touchstart touchmove touchend touchcancel", " ")
      , MS = (FS.isNative = function(e) {
        return !!IS[e.toLowerCase()]
    }
    ,
    FS.prototype.fire = function(e, t) {
        var n, r, o, i;
        if (e = e.toLowerCase(),
        (t = t || {}).type = e,
        t.target || (t.target = this.scope),
        t.preventDefault || (t.preventDefault = function() {
            t.isDefaultPrevented = h
        }
        ,
        t.stopPropagation = function() {
            t.isPropagationStopped = h
        }
        ,
        t.stopImmediatePropagation = function() {
            t.isImmediatePropagationStopped = h
        }
        ,
        t.isDefaultPrevented = g,
        t.isPropagationStopped = g,
        t.isImmediatePropagationStopped = g),
        this.settings.beforeFire && this.settings.beforeFire(t),
        n = this.bindings[e])
            for (r = 0,
            o = n.length; r < o; r++) {
                if ((i = n[r]).once && this.off(e, i.func),
                t.isImmediatePropagationStopped())
                    return t.stopPropagation(),
                    t;
                if (!1 === i.func.call(this.scope, t))
                    return t.preventDefault(),
                    t
            }
        return t
    }
    ,
    FS.prototype.on = function(e, t, n, r) {
        var o, i, a;
        if (!1 === t && (t = g),
        t) {
            var u = {
                func: t
            };
            for (r && hr.extend(u, r),
            a = (i = e.toLowerCase().split(" ")).length; a--; )
                e = i[a],
                (o = this.bindings[e]) || (o = this.bindings[e] = [],
                this.toggleEvent(e, !0)),
                n ? o.unshift(u) : o.push(u)
        }
        return this
    }
    ,
    FS.prototype.off = function(e, t) {
        var n, r, o, i, a = this;
        if (e)
            for (n = (o = e.toLowerCase().split(" ")).length; n--; ) {
                if (e = o[n],
                r = this.bindings[e],
                !e)
                    return oe(this.bindings, function(e, t) {
                        a.toggleEvent(t, !1),
                        delete a.bindings[t]
                    }),
                    this;
                if (r) {
                    if (t)
                        for (i = r.length; i--; )
                            r[i].func === t && (r = r.slice(0, i).concat(r.slice(i + 1)),
                            this.bindings[e] = r);
                    else
                        r.length = 0;
                    r.length || (this.toggleEvent(e, !1),
                    delete this.bindings[e])
                }
            }
        else
            oe(this.bindings, function(e, t) {
                a.toggleEvent(t, !1)
            }),
            this.bindings = {};
        return this
    }
    ,
    FS.prototype.once = function(e, t, n) {
        return this.on(e, t, n, {
            once: !0
        })
    }
    ,
    FS.prototype.has = function(e) {
        return e = e.toLowerCase(),
        !(!this.bindings[e] || 0 === this.bindings[e].length)
    }
    ,
    FS);
    function FS(e) {
        this.bindings = {},
        this.settings = e || {},
        this.scope = this.settings.scope || this,
        this.toggleEvent = this.settings.toggleEvent || g
    }
    var US, zS = function(n) {
        return n._eventDispatcher || (n._eventDispatcher = new MS({
            scope: n,
            toggleEvent: function(e, t) {
                MS.isNative(e) && n.toggleNativeEvent && n.toggleNativeEvent(e, t)
            }
        })),
        n._eventDispatcher
    }, jS = {
        fire: function(e, t, n) {
            if (this.removed && "remove" !== e && "detach" !== e)
                return t;
            var r = zS(this).fire(e, t);
            if (!1 !== n && this.parent)
                for (var o = this.parent(); o && !r.isPropagationStopped(); )
                    o.fire(e, r, !1),
                    o = o.parent();
            return r
        },
        on: function(e, t, n) {
            return zS(this).on(e, t, n)
        },
        off: function(e, t) {
            return zS(this).off(e, t)
        },
        once: function(e, t) {
            return zS(this).once(e, t)
        },
        hasEventListeners: function(e) {
            return zS(this).has(e)
        }
    }, HS = "data-mce-contenteditable", VS = function(e, t, n) {
        Ma(e, t) && !1 === n ? function(e, t) {
            Oa(e) ? e.dom().classList.remove(t) : Pa(e, t);
            Ia(e)
        }(e, t) : n && La(e, t)
    }, qS = function(e, t, n) {
        try {
            e.getDoc().execCommand(t, !1, n)
        } catch (r) {}
    }, $S = function(e, t) {
        e.dom().contentEditable = t ? "true" : "false"
    }, WS = function(e, t) {
        var n, r, o, i = Ne.fromDom(e.getBody());
        VS(i, "mce-content-readonly", t),
        t ? (e.selection.controlSelection.hideResizeRect(),
        e._selectionOverrides.hideFakeCaret(),
        o = e,
        R.from(o.selection.getNode()).each(function(e) {
            e.removeAttribute("data-mce-selected")
        }),
        e.readonly = !0,
        $S(i, !1),
        z(Ua(i, '*[contenteditable="true"]'), function(e) {
            cn(e, HS, "true"),
            $S(e, !1)
        })) : (e.readonly = !1,
        $S(i, !0),
        z(Ua(i, "*[" + HS + '="true"]'), function(e) {
            dn(e, HS),
            $S(e, !0)
        }),
        qS(e, "StyleWithCSS", !1),
        qS(e, "enableInlineTableEditing", !1),
        qS(e, "enableObjectResizing", !1),
        (Pm(r = e) || Bm(r)) && e.focus(),
        (n = e).selection.setRng(n.selection.getRng()),
        e.nodeChanged())
    }, KS = function(e) {
        return e.readonly
    }, XS = function(t) {
        t.parser.addAttributeFilter("contenteditable", function(e) {
            KS(t) && z(e, function(e) {
                e.attr(HS, e.attr("contenteditable")),
                e.attr("contenteditable", "false")
            })
        }),
        t.serializer.addAttributeFilter(HS, function(e) {
            KS(t) && z(e, function(e) {
                e.attr("contenteditable", e.attr(HS))
            })
        }),
        t.serializer.addTempAttr(HS)
    }, YS = ga.DOM, GS = function(e, t) {
        return "selectionchange" === t ? e.getDoc() : !e.inline && /^mouse|touch|click|contextmenu|drop|dragover|dragend/.test(t) ? e.getDoc().documentElement : e.settings.event_root ? (e.eventRoot || (e.eventRoot = YS.select(e.settings.event_root)[0]),
        e.eventRoot) : e.getBody()
    }, JS = function(e, t, n) {
        var r, o, i, a, u;
        (u = e).hidden || KS(u) ? KS(e) && (r = e,
        a = (o = n).target,
        "click" !== o.type || Zh.metaKeyPressed(o) || (i = a,
        null === r.dom.getParent(i, "a")) || o.preventDefault()) : e.fire(t, n)
    }, QS = function(i, a) {
        var e, t;
        if (i.delegates || (i.delegates = {}),
        !i.delegates[a] && !i.removed)
            if (e = GS(i, a),
            i.settings.event_root) {
                if (US || (US = {},
                i.editorManager.on("removeEditor", function() {
                    i.editorManager.activeEditor || US && (oe(US, function(e, t) {
                        i.dom.unbind(GS(i, t))
                    }),
                    US = null)
                })),
                US[a])
                    return;
                t = function(e) {
                    for (var t = e.target, n = i.editorManager.get(), r = n.length; r--; ) {
                        var o = n[r].getBody();
                        o !== t && !YS.isChildOf(t, o) || JS(n[r], a, e)
                    }
                }
                ,
                US[a] = t,
                YS.bind(e, a, t)
            } else
                t = function(e) {
                    JS(i, a, e)
                }
                ,
                YS.bind(e, a, t),
                i.delegates[a] = t
    }, ZS = pe(pe({}, jS), {
        bindPendingEventDelegates: function() {
            var t = this;
            hr.each(t._pendingNativeEvents, function(e) {
                QS(t, e)
            })
        },
        toggleNativeEvent: function(e, t) {
            var n = this;
            "focus" !== e && "blur" !== e && (t ? n.initialized ? QS(n, e) : n._pendingNativeEvents ? n._pendingNativeEvents.push(e) : n._pendingNativeEvents = [e] : n.initialized && (n.dom.unbind(GS(n, e), e, n.delegates[e]),
            delete n.delegates[e]))
        },
        unbindAllNativeEvents: function() {
            var n = this
              , e = n.getBody()
              , t = n.dom;
            n.delegates && (oe(n.delegates, function(e, t) {
                n.dom.unbind(GS(n, t), t, e)
            }),
            delete n.delegates),
            !n.inline && e && t && (e.onload = null,
            t.unbind(n.getWin()),
            t.unbind(n.getDoc())),
            t && (t.unbind(e),
            t.unbind(n.getContainer()))
        }
    }), eN = ["design", "readonly"], tN = function(e, t, n, r) {
        var o, i = n[t.get()], a = n[r];
        try {
            a.activate()
        } catch (pE) {
            return void V.console.error("problem while activating editor mode " + r + ":", pE)
        }
        i.deactivate(),
        i.editorReadOnly !== a.editorReadOnly && WS(e, a.editorReadOnly),
        t.set(r),
        o = r,
        e.fire("SwitchMode", {
            mode: o
        })
    }, nN = function(t) {
        var e, n, r = xa("design"), o = xa({
            design: {
                activate: f,
                deactivate: f,
                editorReadOnly: !1
            },
            readonly: {
                activate: f,
                deactivate: f,
                editorReadOnly: !0
            }
        });
        return (e = t).serializer ? XS(e) : e.on("PreInit", function() {
            XS(e)
        }),
        (n = t).on("ShowCaret", function(e) {
            KS(n) && e.preventDefault()
        }),
        n.on("ObjectSelected", function(e) {
            KS(n) && e.preventDefault()
        }),
        {
            isReadOnly: function() {
                return KS(t)
            },
            set: function(e) {
                return function(e, t, n, r) {
                    if (r !== n.get()) {
                        if (!me(t, r))
                            throw new Error("Editor mode '" + r + "' is invalid");
                        e.initialized ? tN(e, n, t, r) : e.on("init", function() {
                            return tN(e, n, t, r)
                        })
                    }
                }(t, o.get(), r, e)
            },
            get: function() {
                return r.get()
            },
            register: function(e, t) {
                o.set(function(e, t, n) {
                    var r;
                    if (M(eN, t))
                        throw new Error("Cannot override default mode " + t);
                    return pe(pe({}, e), ((r = {})[t] = pe(pe({}, n), {
                        deactivate: function() {
                            try {
                                n.deactivate()
                            } catch (pE) {
                                V.console.error("problem while deactivating editor mode " + t + ":", pE)
                            }
                        }
                    }),
                    r))
                }(o.get(), e, t))
            }
        }
    }, rN = hr.each, oN = hr.explode, iN = {
        f1: 112,
        f2: 113,
        f3: 114,
        f4: 115,
        f5: 116,
        f6: 117,
        f7: 118,
        f8: 119,
        f9: 120,
        f10: 121,
        f11: 122,
        f12: 123
    }, aN = hr.makeMap("alt,ctrl,shift,meta,access"), uN = (sN.prototype.add = function(e, n, r, o) {
        var t, i = this;
        return "string" == typeof (t = r) ? r = function() {
            i.editor.execCommand(t, !1, null)
        }
        : hr.isArray(t) && (r = function() {
            i.editor.execCommand(t[0], t[1], t[2])
        }
        ),
        rN(oN(hr.trim(e)), function(e) {
            var t = i.createShortcut(e, n, r, o);
            i.shortcuts[t.id] = t
        }),
        !0
    }
    ,
    sN.prototype.remove = function(e) {
        var t = this.createShortcut(e);
        return !!this.shortcuts[t.id] && (delete this.shortcuts[t.id],
        !0)
    }
    ,
    sN.prototype.parseShortcut = function(e) {
        var t, n, r = {};
        for (n in rN(oN(e.toLowerCase(), "+"), function(e) {
            e in aN ? r[e] = !0 : /^[0-9]{2,}$/.test(e) ? r.keyCode = parseInt(e, 10) : (r.charCode = e.charCodeAt(0),
            r.keyCode = iN[e] || e.toUpperCase().charCodeAt(0))
        }),
        t = [r.keyCode],
        aN)
            r[n] ? t.push(n) : r[n] = !1;
        return r.id = t.join(","),
        r.access && (r.alt = !0,
        rr.mac ? r.ctrl = !0 : r.shift = !0),
        r.meta && (rr.mac ? r.meta = !0 : (r.ctrl = !0,
        r.meta = !1)),
        r
    }
    ,
    sN.prototype.createShortcut = function(e, t, n, r) {
        var o;
        return (o = hr.map(oN(e, ">"), this.parseShortcut))[o.length - 1] = hr.extend(o[o.length - 1], {
            func: n,
            scope: r || this.editor
        }),
        hr.extend(o[0], {
            desc: this.editor.translate(t),
            subpatterns: o.slice(1)
        })
    }
    ,
    sN.prototype.hasModifier = function(e) {
        return e.altKey || e.ctrlKey || e.metaKey
    }
    ,
    sN.prototype.isFunctionKey = function(e) {
        return "keydown" === e.type && 112 <= e.keyCode && e.keyCode <= 123
    }
    ,
    sN.prototype.matchShortcut = function(e, t) {
        return !!t && t.ctrl === e.ctrlKey && t.meta === e.metaKey && t.alt === e.altKey && t.shift === e.shiftKey && !!(e.keyCode === t.keyCode || e.charCode && e.charCode === t.charCode) && (e.preventDefault(),
        !0)
    }
    ,
    sN.prototype.executeShortcutAction = function(e) {
        return e.func ? e.func.call(e.scope) : null
    }
    ,
    sN);
    function sN(e) {
        this.shortcuts = {},
        this.pendingPatterns = [],
        this.editor = e;
        var n = this;
        e.on("keyup keypress keydown", function(t) {
            !n.hasModifier(t) && !n.isFunctionKey(t) || t.isDefaultPrevented() || (rN(n.shortcuts, function(e) {
                if (n.matchShortcut(t, e))
                    return n.pendingPatterns = e.subpatterns.slice(0),
                    "keydown" === t.type && n.executeShortcutAction(e),
                    !0
            }),
            n.matchShortcut(t, n.pendingPatterns[0]) && (1 === n.pendingPatterns.length && "keydown" === t.type && n.executeShortcutAction(n.pendingPatterns[0]),
            n.pendingPatterns.shift()))
        })
    }
    var cN = function() {
        var e, t, n, r, o, i, a, u, s = (t = {},
        n = {},
        r = {},
        o = {},
        i = {},
        a = {},
        {
            addButton: (u = function(n, r) {
                return function(e, t) {
                    return n[e.toLowerCase()] = pe(pe({}, t), {
                        type: r
                    })
                }
            }
            )(e = {}, "button"),
            addGroupToolbarButton: u(e, "grouptoolbarbutton"),
            addToggleButton: u(e, "togglebutton"),
            addMenuButton: u(e, "menubutton"),
            addSplitButton: u(e, "splitbutton"),
            addMenuItem: u(t, "menuitem"),
            addNestedMenuItem: u(t, "nestedmenuitem"),
            addToggleMenuItem: u(t, "togglemenuitem"),
            addAutocompleter: u(n, "autocompleter"),
            addContextMenu: u(o, "contextmenu"),
            addContextToolbar: u(i, "contexttoolbar"),
            addContextForm: u(i, "contextform"),
            addSidebar: u(a, "sidebar"),
            addIcon: function(e, t) {
                return r[e.toLowerCase()] = t
            },
            getAll: function() {
                return {
                    buttons: e,
                    menuItems: t,
                    icons: r,
                    popups: n,
                    contextMenus: o,
                    contextToolbars: i,
                    sidebars: a
                }
            }
        });
        return {
            addAutocompleter: s.addAutocompleter,
            addButton: s.addButton,
            addContextForm: s.addContextForm,
            addContextMenu: s.addContextMenu,
            addContextToolbar: s.addContextToolbar,
            addIcon: s.addIcon,
            addMenuButton: s.addMenuButton,
            addMenuItem: s.addMenuItem,
            addNestedMenuItem: s.addNestedMenuItem,
            addSidebar: s.addSidebar,
            addSplitButton: s.addSplitButton,
            addToggleButton: s.addToggleButton,
            addGroupToolbarButton: s.addGroupToolbarButton,
            addToggleMenuItem: s.addToggleMenuItem,
            getAll: s.getAll
        }
    }
      , lN = hr.each
      , fN = hr.trim
      , dN = "source protocol authority userInfo user password host port relative path directory file query anchor".split(" ")
      , mN = {
        ftp: 21,
        http: 80,
        https: 443,
        mailto: 25
    }
      , pN = (gN.parseDataUri = function(e) {
        var t, n = decodeURIComponent(e).split(","), r = /data:([^;]+)/.exec(n[0]);
        return r && (t = r[1]),
        {
            type: t,
            data: n[1]
        }
    }
    ,
    gN.getDocumentBaseUrl = function(e) {
        var t;
        return t = 0 !== e.protocol.indexOf("http") && "file:" !== e.protocol ? e.href : e.protocol + "//" + e.host + e.pathname,
        /^[^:]+:\/\/\/?[^\/]+\//.test(t) && (t = t.replace(/[\?#].*$/, "").replace(/[\/\\][^\/]+$/, ""),
        /[\/\\]$/.test(t) || (t += "/")),
        t
    }
    ,
    gN.prototype.setPath = function(e) {
        var t = /^(.*?)\/?(\w+)?$/.exec(e);
        this.path = t[0],
        this.directory = t[1],
        this.file = t[2],
        this.source = "",
        this.getURI()
    }
    ,
    gN.prototype.toRelative = function(e) {
        var t;
        if ("./" === e)
            return e;
        var n = new gN(e,{
            base_uri: this
        });
        if ("mce_host" !== n.host && this.host !== n.host && n.host || this.port !== n.port || this.protocol !== n.protocol && "" !== n.protocol)
            return n.getURI();
        var r = this.getURI()
          , o = n.getURI();
        return r === o || "/" === r.charAt(r.length - 1) && r.substr(0, r.length - 1) === o ? r : (t = this.toRelPath(this.path, n.path),
        n.query && (t += "?" + n.query),
        n.anchor && (t += "#" + n.anchor),
        t)
    }
    ,
    gN.prototype.toAbsolute = function(e, t) {
        var n = new gN(e,{
            base_uri: this
        });
        return n.getURI(t && this.isSameOrigin(n))
    }
    ,
    gN.prototype.isSameOrigin = function(e) {
        if (this.host == e.host && this.protocol == e.protocol) {
            if (this.port == e.port)
                return !0;
            var t = mN[this.protocol];
            if (t && (this.port || t) == (e.port || t))
                return !0
        }
        return !1
    }
    ,
    gN.prototype.toRelPath = function(e, t) {
        var n, r, o, i = 0, a = "", u = e.substring(0, e.lastIndexOf("/")).split("/");
        if (n = t.split("/"),
        u.length >= n.length)
            for (r = 0,
            o = u.length; r < o; r++)
                if (r >= n.length || u[r] !== n[r]) {
                    i = r + 1;
                    break
                }
        if (u.length < n.length)
            for (r = 0,
            o = n.length; r < o; r++)
                if (r >= u.length || u[r] !== n[r]) {
                    i = r + 1;
                    break
                }
        if (1 === i)
            return t;
        for (r = 0,
        o = u.length - (i - 1); r < o; r++)
            a += "../";
        for (r = i - 1,
        o = n.length; r < o; r++)
            a += r !== i - 1 ? "/" + n[r] : n[r];
        return a
    }
    ,
    gN.prototype.toAbsPath = function(e, t) {
        var n, r, o, i = 0, a = [];
        r = /\/$/.test(t) ? "/" : "";
        var u = e.split("/")
          , s = t.split("/");
        for (lN(u, function(e) {
            e && a.push(e)
        }),
        u = a,
        n = s.length - 1,
        a = []; 0 <= n; n--)
            0 !== s[n].length && "." !== s[n] && (".." !== s[n] ? 0 < i ? i-- : a.push(s[n]) : i++);
        return 0 !== (o = (n = u.length - i) <= 0 ? J(a).join("/") : u.slice(0, n).join("/") + "/" + J(a).join("/")).indexOf("/") && (o = "/" + o),
        r && o.lastIndexOf("/") !== o.length - 1 && (o += r),
        o
    }
    ,
    gN.prototype.getURI = function(e) {
        var t;
        return void 0 === e && (e = !1),
        this.source && !e || (t = "",
        e || (this.protocol ? t += this.protocol + "://" : t += "//",
        this.userInfo && (t += this.userInfo + "@"),
        this.host && (t += this.host),
        this.port && (t += ":" + this.port)),
        this.path && (t += this.path),
        this.query && (t += "?" + this.query),
        this.anchor && (t += "#" + this.anchor),
        this.source = t),
        this.source
    }
    ,
    gN);
    function gN(e, t) {
        e = fN(e),
        this.settings = t || {};
        var n = this.settings.base_uri
          , r = this;
        if (/^([\w\-]+):([^\/]{2})/i.test(e) || /^\s*#/.test(e))
            r.source = e;
        else {
            var o = 0 === e.indexOf("//");
            if (0 !== e.indexOf("/") || o || (e = (n && n.protocol || "http") + "://mce_host" + e),
            !/^[\w\-]*:?\/\//.test(e)) {
                var i = this.settings.base_uri ? this.settings.base_uri.path : new gN(V.document.location.href).directory;
                if (this.settings.base_uri && "" == this.settings.base_uri.protocol)
                    e = "//mce_host" + r.toAbsPath(i, e);
                else {
                    var a = /([^#?]*)([#?]?.*)/.exec(e);
                    e = (n && n.protocol || "http") + "://mce_host" + r.toAbsPath(i, a[1]) + a[2]
                }
            }
            e = e.replace(/@@/g, "(mce_at)");
            var u = /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@\/]*):?([^:@\/]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(e);
            lN(dN, function(e, t) {
                var n = u[t];
                n = n && n.replace(/\(mce_at\)/g, "@@"),
                r[e] = n
            }),
            n && (r.protocol || (r.protocol = n.protocol),
            r.userInfo || (r.userInfo = n.userInfo),
            r.port || "mce_host" !== r.host || (r.port = n.port),
            r.host && "mce_host" !== r.host || (r.host = n.host),
            r.source = ""),
            o && (r.protocol = "")
        }
    }
    var hN = ga.DOM
      , vN = hr.extend
      , yN = hr.each
      , bN = hr.resolve
      , CN = rr.ie
      , wN = (xN.prototype.render = function() {
        !function(t) {
            var e = t.settings
              , n = t.id;
            ka.setCode(Ws(t));
            var r = function() {
                dS.unbind(V.window, "ready", r),
                t.render()
            };
            if (ho.Event.domLoaded) {
                if (t.getElement() && rr.contentEditable) {
                    e.inline ? t.inline = !0 : (t.orgVisibility = t.getElement().style.visibility,
                    t.getElement().style.visibility = "hidden");
                    var o = t.getElement().form || dS.getParent(n, "form");
                    o && (t.formElement = o,
                    e.hidden_input && !Qt(t.getElement()) && (dS.insertAfter(dS.create("input", {
                        type: "hidden",
                        name: n
                    }), n),
                    t.hasHiddenInput = !0),
                    t.formEventDelegate = function(e) {
                        t.fire(e.type, e)
                    }
                    ,
                    dS.bind(o, "submit reset", t.formEventDelegate),
                    t.on("reset", function() {
                        t.resetContent()
                    }),
                    !e.submit_patch || o.submit.nodeType || o.submit.length || o._mceOldSubmit || (o._mceOldSubmit = o.submit,
                    o.submit = function() {
                        return t.editorManager.triggerSave(),
                        t.setDirty(!1),
                        o._mceOldSubmit(o)
                    }
                    )),
                    t.windowManager = rh(t),
                    t.notificationManager = eh(t),
                    "xml" === e.encoding && t.on("GetContent", function(e) {
                        e.save && (e.content = dS.encode(e.content))
                    }),
                    e.add_form_submit_trigger && t.on("submit", function() {
                        t.initialized && t.save()
                    }),
                    e.add_unload_trigger && (t._beforeUnload = function() {
                        !t.initialized || t.destroyed || t.isHidden() || t.save({
                            format: "raw",
                            no_events: !0,
                            set_dirty: !1
                        })
                    }
                    ,
                    t.editorManager.on("BeforeUnload", t._beforeUnload)),
                    t.editorManager.add(t),
                    vS(t, t.suffix)
                }
            } else
                dS.bind(V.window, "ready", r)
        }(this)
    }
    ,
    xN.prototype.focus = function(e) {
        var t, n;
        n = e,
        (t = this).removed || (n ? Im : Lm)(t)
    }
    ,
    xN.prototype.hasFocus = function() {
        return Pm(this)
    }
    ,
    xN.prototype.execCallback = function(e) {
        for (var t = [], n = 1; n < arguments.length; n++)
            t[n - 1] = arguments[n];
        var r, o = this.settings[e];
        if (o)
            return this.callbackLookup && (r = this.callbackLookup[e]) && (o = r.func,
            r = r.scope),
            "string" == typeof o && (r = (r = o.replace(/\.\w+$/, "")) ? bN(r) : 0,
            o = bN(o),
            this.callbackLookup = this.callbackLookup || {},
            this.callbackLookup[e] = {
                func: o,
                scope: r
            }),
            o.apply(r || this, t)
    }
    ,
    xN.prototype.translate = function(e) {
        return ka.translate(e)
    }
    ,
    xN.prototype.getParam = function(e, t, n) {
        return qg(this, e, t, n)
    }
    ,
    xN.prototype.nodeChanged = function(e) {
        this._nodeChangeDispatcher.nodeChanged(e)
    }
    ,
    xN.prototype.addCommand = function(e, t, n) {
        this.editorCommands.addCommand(e, t, n)
    }
    ,
    xN.prototype.addQueryStateHandler = function(e, t, n) {
        this.editorCommands.addQueryStateHandler(e, t, n)
    }
    ,
    xN.prototype.addQueryValueHandler = function(e, t, n) {
        this.editorCommands.addQueryValueHandler(e, t, n)
    }
    ,
    xN.prototype.addShortcut = function(e, t, n, r) {
        this.shortcuts.add(e, t, n, r)
    }
    ,
    xN.prototype.execCommand = function(e, t, n, r) {
        return this.editorCommands.execCommand(e, t, n, r)
    }
    ,
    xN.prototype.queryCommandState = function(e) {
        return this.editorCommands.queryCommandState(e)
    }
    ,
    xN.prototype.queryCommandValue = function(e) {
        return this.editorCommands.queryCommandValue(e)
    }
    ,
    xN.prototype.queryCommandSupported = function(e) {
        return this.editorCommands.queryCommandSupported(e)
    }
    ,
    xN.prototype.show = function() {
        this.hidden && (this.hidden = !1,
        this.inline ? this.getBody().contentEditable = "true" : (hN.show(this.getContainer()),
        hN.hide(this.id)),
        this.load(),
        this.fire("show"))
    }
    ,
    xN.prototype.hide = function() {
        var e = this
          , t = e.getDoc();
        e.hidden || (CN && t && !e.inline && t.execCommand("SelectAll"),
        e.save(),
        e.inline ? (e.getBody().contentEditable = "false",
        e === e.editorManager.focusedEditor && (e.editorManager.focusedEditor = null)) : (hN.hide(e.getContainer()),
        hN.setStyle(e.id, "display", e.orgDisplay)),
        e.hidden = !0,
        e.fire("hide"))
    }
    ,
    xN.prototype.isHidden = function() {
        return !!this.hidden
    }
    ,
    xN.prototype.setProgressState = function(e, t) {
        this.fire("ProgressState", {
            state: e,
            time: t
        })
    }
    ,
    xN.prototype.load = function(e) {
        var t, n = this.getElement();
        if (this.removed)
            return "";
        if (n) {
            (e = e || {}).load = !0;
            var r = Qt(n) ? n.value : n.innerHTML;
            return t = this.setContent(r, e),
            e.element = n,
            e.no_events || this.fire("LoadContent", e),
            e.element = n = null,
            t
        }
    }
    ,
    xN.prototype.save = function(e) {
        var t, n, r = this, o = r.getElement();
        if (o && r.initialized && !r.removed)
            return (e = e || {}).save = !0,
            e.element = o,
            e.content = r.getContent(e),
            e.no_events || r.fire("SaveContent", e),
            "raw" === e.format && r.fire("RawSaveContent", e),
            t = e.content,
            Qt(o) ? o.value = t : (!e.is_removing && r.inline || (o.innerHTML = t),
            (n = hN.getParent(r.id, "form")) && yN(n.elements, function(e) {
                if (e.name === r.id)
                    return e.value = t,
                    !1
            })),
            e.element = o = null,
            !1 !== e.set_dirty && r.setDirty(!1),
            t
    }
    ,
    xN.prototype.setContent = function(e, t) {
        return Sg(this, e, t)
    }
    ,
    xN.prototype.getContent = function(e) {
        return xg(this, e)
    }
    ,
    xN.prototype.insertContent = function(e, t) {
        t && (e = vN({
            content: e
        }, t)),
        this.execCommand("mceInsertContent", !1, e)
    }
    ,
    xN.prototype.resetContent = function(e) {
        e === undefined ? Sg(this, this.startContent, {
            format: "raw"
        }) : Sg(this, e),
        this.undoManager.reset(),
        this.setDirty(!1),
        this.nodeChanged()
    }
    ,
    xN.prototype.isDirty = function() {
        return !this.isNotDirty
    }
    ,
    xN.prototype.setDirty = function(e) {
        var t = !this.isNotDirty;
        this.isNotDirty = !e,
        e && e !== t && this.fire("dirty")
    }
    ,
    xN.prototype.getContainer = function() {
        return this.container || (this.container = hN.get(this.editorContainer || this.id + "_parent")),
        this.container
    }
    ,
    xN.prototype.getContentAreaContainer = function() {
        return this.contentAreaContainer
    }
    ,
    xN.prototype.getElement = function() {
        return this.targetElm || (this.targetElm = hN.get(this.id)),
        this.targetElm
    }
    ,
    xN.prototype.getWin = function() {
        var e;
        return this.contentWindow || (e = this.iframeElement) && (this.contentWindow = e.contentWindow),
        this.contentWindow
    }
    ,
    xN.prototype.getDoc = function() {
        var e;
        return this.contentDocument || (e = this.getWin()) && (this.contentDocument = e.document),
        this.contentDocument
    }
    ,
    xN.prototype.getBody = function() {
        var e = this.getDoc();
        return this.bodyElement || (e ? e.body : null)
    }
    ,
    xN.prototype.convertURL = function(e, t, n) {
        var r = this.settings;
        return r.urlconverter_callback ? this.execCallback("urlconverter_callback", e, n, !0, t) : !r.convert_urls || n && "LINK" === n.nodeName || 0 === e.indexOf("file:") || 0 === e.length ? e : r.relative_urls ? this.documentBaseURI.toRelative(e) : e = this.documentBaseURI.toAbsolute(e, r.remove_script_host)
    }
    ,
    xN.prototype.addVisual = function(e) {
        var n, r = this, o = r.settings, i = r.dom;
        e = e || r.getBody(),
        r.hasVisual === undefined && (r.hasVisual = o.visual),
        yN(i.select("table,a", e), function(e) {
            var t;
            switch (e.nodeName) {
            case "TABLE":
                return n = o.visual_table_class || "mce-item-table",
                void ((t = i.getAttrib(e, "border")) && "0" !== t || !r.hasVisual ? i.removeClass(e, n) : i.addClass(e, n));
            case "A":
                return void (i.getAttrib(e, "href") || (t = i.getAttrib(e, "name") || e.id,
                n = o.visual_anchor_class || "mce-item-anchor",
                t && r.hasVisual ? i.addClass(e, n) : i.removeClass(e, n)))
            }
        }),
        r.fire("VisualAid", {
            element: e,
            hasVisual: r.hasVisual
        })
    }
    ,
    xN.prototype.remove = function() {
        kg(this)
    }
    ,
    xN.prototype.destroy = function(e) {
        _g(this, e)
    }
    ,
    xN.prototype.uploadImages = function(e) {
        return this.editorUpload.uploadImages(e)
    }
    ,
    xN.prototype._scanForImages = function() {
        return this.editorUpload.scanForImages()
    }
    ,
    xN.prototype.addButton = function() {
        throw new Error("editor.addButton has been removed in tinymce 5x, use editor.ui.registry.addButton or editor.ui.registry.addToggleButton or editor.ui.registry.addSplitButton instead")
    }
    ,
    xN.prototype.addSidebar = function() {
        throw new Error("editor.addSidebar has been removed in tinymce 5x, use editor.ui.registry.addSidebar instead")
    }
    ,
    xN.prototype.addMenuItem = function() {
        throw new Error("editor.addMenuItem has been removed in tinymce 5x, use editor.ui.registry.addMenuItem instead")
    }
    ,
    xN.prototype.addContextToolbar = function() {
        throw new Error("editor.addContextToolbar has been removed in tinymce 5x, use editor.ui.registry.addContextToolbar instead")
    }
    ,
    xN);
    function xN(e, t, n) {
        var r = this;
        this.plugins = {},
        this.contentCSS = [],
        this.contentStyles = [],
        this.loadedCSS = {},
        this.isNotDirty = !1,
        this.editorManager = n,
        this.documentBaseUrl = n.documentBaseURL,
        vN(this, ZS),
        this.settings = Hg(this, e, this.documentBaseUrl, n.defaultSettings, t),
        this.settings.suffix && (n.suffix = this.settings.suffix),
        this.suffix = n.suffix,
        this.settings.base_url && n._setBaseUrl(this.settings.base_url),
        this.baseUri = n.baseURI,
        this.settings.referrer_policy && (ba.ScriptLoader._setReferrerPolicy(this.settings.referrer_policy),
        ga.DOM.styleSheetLoader._setReferrerPolicy(this.settings.referrer_policy)),
        Ra.languageLoad = this.settings.language_load,
        Ra.baseURL = n.baseURL,
        this.id = e,
        this.setDirty(!1),
        this.documentBaseURI = new pN(this.settings.document_base_url,{
            base_uri: this.baseUri
        }),
        this.baseURI = this.baseUri,
        this.inline = !!this.settings.inline,
        this.shortcuts = new uN(this),
        this.editorCommands = new PS(this),
        this.settings.cache_suffix && (rr.cacheSuffix = this.settings.cache_suffix.replace(/^[\?\&]+/, "")),
        this.ui = {
            registry: cN()
        };
        var o = nN(this);
        this.mode = o,
        this.setMode = o.set,
        n.fire("SetupEditor", {
            editor: this
        }),
        this.execCallback("setup", this),
        this.$ = na.overrideDefaults(function() {
            return {
                context: r.inline ? r.getBody() : r.getDoc(),
                element: r.getBody()
            }
        })
    }
    var SN, NN, EN = ga.DOM, kN = hr.explode, _N = hr.each, RN = hr.extend, TN = 0, AN = !1, DN = [], ON = [], BN = function(t) {
        var n = t.type;
        _N(MN.get(), function(e) {
            switch (n) {
            case "scroll":
                e.fire("ScrollWindow", t);
                break;
            case "resize":
                e.fire("ResizeWindow", t)
            }
        })
    }, PN = function(e) {
        e !== AN && (e ? na(window).on("resize scroll", BN) : na(window).off("resize scroll", BN),
        AN = e)
    }, LN = function(t) {
        var e = ON;
        delete DN[t.id];
        for (var n = 0; n < DN.length; n++)
            if (DN[n] === t) {
                DN.splice(n, 1);
                break
            }
        return ON = H(ON, function(e) {
            return t !== e
        }),
        MN.activeEditor === t && (MN.activeEditor = 0 < ON.length ? ON[0] : null),
        MN.focusedEditor === t && (MN.focusedEditor = null),
        e.length !== ON.length
    }, IN = "CSS1Compat" !== V.document.compatMode, MN = pe(pe({}, jS), {
        baseURI: null,
        baseURL: null,
        defaultSettings: {},
        documentBaseURL: null,
        suffix: null,
        $: na,
        majorVersion: "5",
        minorVersion: "3.2",
        releaseDate: "2020-06-10",
        editors: DN,
        i18n: ka,
        activeEditor: null,
        focusedEditor: null,
        settings: {},
        setup: function() {
            var e, t, n = "";
            t = pN.getDocumentBaseUrl(V.document.location),
            /^[^:]+:\/\/\/?[^\/]+\//.test(t) && (t = t.replace(/[\?#].*$/, "").replace(/[\/\\][^\/]+$/, ""),
            /[\/\\]$/.test(t) || (t += "/"));
            var r, o = window.tinymce || window.tinyMCEPreInit;
            if (o)
                e = o.base || o.baseURL,
                n = o.suffix;
            else {
                for (var i = V.document.getElementsByTagName("script"), a = 0; a < i.length; a++) {
                    var u;
                    if ("" !== (u = i[a].src || "")) {
                        var s = u.substring(u.lastIndexOf("/"));
                        if (/tinymce(\.full|\.jquery|)(\.min|\.dev|)\.js/.test(u)) {
                            -1 !== s.indexOf(".min") && (n = ".min"),
                            e = u.substring(0, u.lastIndexOf("/"));
                            break
                        }
                    }
                }
                if (!e && V.document.currentScript)
                    -1 !== (u = V.document.currentScript.src).indexOf(".min") && (n = ".min"),
                    e = u.substring(0, u.lastIndexOf("/"))
            }
            this.baseURL = new pN(t).toAbsolute(e),
            this.documentBaseURL = t,
            this.baseURI = new pN(this.baseURL),
            this.suffix = n,
            (r = this).on("AddEditor", N(_m, r)),
            r.on("RemoveEditor", N(Rm, r))
        },
        overrideDefaults: function(e) {
            var t, n;
            (t = e.base_url) && this._setBaseUrl(t),
            n = e.suffix,
            e.suffix && (this.suffix = n);
            var r = (this.defaultSettings = e).plugin_base_urls;
            r !== undefined && oe(r, function(e, t) {
                Ra.PluginManager.urls[t] = e
            })
        },
        init: function(r) {
            var n, u, s = this;
            u = hr.makeMap("area base basefont br col frame hr img input isindex link meta param embed source wbr track colgroup option table tbody tfoot thead tr th td script noscript style textarea video audio iframe object menu", " ");
            var c = function(e) {
                var t = e.id;
                return t || (t = (t = e.name) && !EN.get(t) ? e.name : EN.uniqueId(),
                e.setAttribute("id", t)),
                t
            }
              , l = function(e, t) {
                return t.constructor === RegExp ? t.test(e.className) : EN.hasClass(e, t)
            }
              , f = function(e) {
                n = e
            }
              , e = function() {
                var o, i = 0, a = [], n = function(e, t, n) {
                    var r = new wN(e,t,s);
                    a.push(r),
                    r.on("init", function() {
                        ++i === o.length && f(a)
                    }),
                    r.targetElm = r.targetElm || n,
                    r.render()
                };
                EN.unbind(window, "ready", e),
                function(e) {
                    var t = r[e];
                    if (t)
                        t.apply(s, Array.prototype.slice.call(arguments, 2))
                }("onpageload"),
                o = na.unique(function(t) {
                    var e, n = [];
                    if (rr.browser.isIE() && rr.browser.version.major < 11)
                        return ch("TinyMCE does not support the browser you are using. For a list of supported browsers please see: https://www.tinymce.com/docs/get-started/system-requirements/"),
                        [];
                    if (IN)
                        return ch("Failed to initialize the editor as the document is not in standards mode. TinyMCE requires standards mode."),
                        [];
                    if (t.types)
                        return _N(t.types, function(e) {
                            n = n.concat(EN.select(e.selector))
                        }),
                        n;
                    if (t.selector)
                        return EN.select(t.selector);
                    if (t.target)
                        return [t.target];
                    switch (t.mode) {
                    case "exact":
                        0 < (e = t.elements || "").length && _N(kN(e), function(t) {
                            var e;
                            (e = EN.get(t)) ? n.push(e) : _N(V.document.forms, function(e) {
                                _N(e.elements, function(e) {
                                    e.name === t && (t = "mce_editor_" + TN++,
                                    EN.setAttrib(e, "id", t),
                                    n.push(e))
                                })
                            })
                        });
                        break;
                    case "textareas":
                    case "specific_textareas":
                        _N(EN.select("textarea"), function(e) {
                            t.editor_deselector && l(e, t.editor_deselector) || t.editor_selector && !l(e, t.editor_selector) || n.push(e)
                        })
                    }
                    return n
                }(r)),
                r.types ? _N(r.types, function(t) {
                    hr.each(o, function(e) {
                        return !EN.is(e, t.selector) || (n(c(e), RN({}, r, t), e),
                        !1)
                    })
                }) : (hr.each(o, function(e) {
                    var t;
                    (t = s.get(e.id)) && t.initialized && !(t.getContainer() || t.getBody()).parentNode && (LN(t),
                    t.unbindAllNativeEvents(),
                    t.destroy(!0),
                    t.removed = !0,
                    t = null)
                }),
                0 === (o = hr.grep(o, function(e) {
                    return !s.get(e.id)
                })).length ? f([]) : _N(o, function(e) {
                    var t;
                    t = e,
                    r.inline && t.tagName.toLowerCase()in u ? ch("Could not initialize inline editor on invalid inline target element", e) : n(c(e), r, e)
                }))
            };
            return s.settings = r,
            EN.bind(window, "ready", e),
            new Mn(function(t) {
                n ? t(n) : f = function(e) {
                    t(e)
                }
            }
            )
        },
        get: function(t) {
            return 0 === arguments.length ? ON.slice(0) : q(t) ? K(ON, function(e) {
                return e.id === t
            }).getOr(null) : O(t) && ON[t] ? ON[t] : null
        },
        add: function(e) {
            var n = this;
            return DN[e.id] === e || (null === n.get(e.id) && ("length" !== e.id && (DN[e.id] = e),
            DN.push(e),
            ON.push(e)),
            PN(!0),
            n.activeEditor = e,
            n.fire("AddEditor", {
                editor: e
            }),
            SN || (SN = function(e) {
                var t = n.fire("BeforeUnload");
                if (t.returnValue)
                    return e.preventDefault(),
                    e.returnValue = t.returnValue,
                    t.returnValue
            }
            ,
            window.addEventListener("beforeunload", SN))),
            e
        },
        createEditor: function(e, t) {
            return this.add(new wN(e,t,this))
        },
        remove: function(e) {
            var t, n, r = this;
            if (e) {
                if (!q(e))
                    return n = e,
                    _(r.get(n.id)) ? null : (LN(n) && r.fire("RemoveEditor", {
                        editor: n
                    }),
                    0 === ON.length && window.removeEventListener("beforeunload", SN),
                    n.remove(),
                    PN(0 < ON.length),
                    n);
                _N(EN.select(e), function(e) {
                    (n = r.get(e.id)) && r.remove(n)
                })
            } else
                for (t = ON.length - 1; 0 <= t; t--)
                    r.remove(ON[t])
        },
        execCommand: function(e, t, n) {
            var r = this.get(n);
            switch (e) {
            case "mceAddEditor":
                return this.get(n) || new wN(n,this.settings,this).render(),
                !0;
            case "mceRemoveEditor":
                return r && r.remove(),
                !0;
            case "mceToggleEditor":
                return r ? (r.isHidden() ? r.show() : r.hide(),
                !0) : (this.execCommand("mceAddEditor", 0, n),
                !0)
            }
            return !!this.activeEditor && this.activeEditor.execCommand(e, t, n)
        },
        triggerSave: function() {
            _N(ON, function(e) {
                e.save()
            })
        },
        addI18n: function(e, t) {
            ka.add(e, t)
        },
        translate: function(e) {
            return ka.translate(e)
        },
        setActive: function(e) {
            var t = this.activeEditor;
            this.activeEditor !== e && (t && t.fire("deactivate", {
                relatedTarget: e
            }),
            e.fire("activate", {
                relatedTarget: t
            })),
            this.activeEditor = e
        },
        _setBaseUrl: function(e) {
            this.baseURL = new pN(this.documentBaseURL).toAbsolute(e.replace(/\/+$/, "")),
            this.baseURI = new pN(this.baseURL)
        }
    });
    function FN(n) {
        return {
            walk: function(e, t) {
                return jl(n, e, t)
            },
            split: Vm,
            normalize: function(t) {
                return Wh(n, t).fold(x(!1), function(e) {
                    return t.setStart(e.startContainer, e.startOffset),
                    t.setEnd(e.endContainer, e.endOffset),
                    !0
                })
            }
        }
    }
    MN.setup(),
    (NN = FN = FN || {}).compareRanges = Uh,
    NN.getCaretRangeFromPoint = Bh,
    NN.getSelectedNode = ju,
    NN.getNode = Hu;
    var UN, zN, jN, HN, VN = FN, qN = (UN = {},
    zN = {},
    {
        load: function(r, o) {
            var i = 'Script at URL "' + o + '" failed to load'
              , a = 'Script at URL "' + o + "\" did not call `tinymce.Resource.add('" + r + "', data)` within 1 second";
            if (UN[r] !== undefined)
                return UN[r];
            var e = new Mn(function(e, t) {
                var n = function(e, t, n) {
                    void 0 === n && (n = 1e3);
                    var r = !1
                      , o = null
                      , i = function(n) {
                        return function() {
                            for (var e = [], t = 0; t < arguments.length; t++)
                                e[t] = arguments[t];
                            r || (r = !0,
                            null !== o && (V.clearTimeout(o),
                            o = null),
                            n.apply(null, e))
                        }
                    }
                      , a = i(e)
                      , u = i(t);
                    return {
                        start: function() {
                            for (var e = [], t = 0; t < arguments.length; t++)
                                e[t] = arguments[t];
                            r || null !== o || (o = V.setTimeout(function() {
                                return u.apply(null, e)
                            }, n))
                        },
                        resolve: a,
                        reject: u
                    }
                }(e, t);
                zN[r] = n.resolve,
                ba.ScriptLoader.loadScript(o, function() {
                    return n.start(a)
                }, function() {
                    return n.reject(i)
                })
            }
            );
            return UN[r] = e
        },
        add: function(e, t) {
            zN[e] !== undefined && (zN[e](t),
            delete zN[e]),
            UN[e] = Mn.resolve(t)
        }
    }), $N = Math.min, WN = Math.max, KN = Math.round, XN = function(e, t, n) {
        var r, o, i, a, u, s;
        return r = t.x,
        o = t.y,
        i = e.w,
        a = e.h,
        u = t.w,
        s = t.h,
        "b" === (n = (n || "").split(""))[0] && (o += s),
        "r" === n[1] && (r += u),
        "c" === n[0] && (o += KN(s / 2)),
        "c" === n[1] && (r += KN(u / 2)),
        "b" === n[3] && (o -= a),
        "r" === n[4] && (r -= i),
        "c" === n[3] && (o -= KN(a / 2)),
        "c" === n[4] && (r -= KN(i / 2)),
        YN(r, o, i, a)
    }, YN = function(e, t, n, r) {
        return {
            x: e,
            y: t,
            w: n,
            h: r
        }
    }, GN = {
        inflate: function(e, t, n) {
            return YN(e.x - t, e.y - n, e.w + 2 * t, e.h + 2 * n)
        },
        relativePosition: XN,
        findBestRelativePosition: function(e, t, n, r) {
            var o, i;
            for (i = 0; i < r.length; i++)
                if ((o = XN(e, t, r[i])).x >= n.x && o.x + o.w <= n.w + n.x && o.y >= n.y && o.y + o.h <= n.h + n.y)
                    return r[i];
            return null
        },
        intersect: function(e, t) {
            var n, r, o, i;
            return n = WN(e.x, t.x),
            r = WN(e.y, t.y),
            o = $N(e.x + e.w, t.x + t.w),
            i = $N(e.y + e.h, t.y + t.h),
            o - n < 0 || i - r < 0 ? null : YN(n, r, o - n, i - r)
        },
        clamp: function(e, t, n) {
            var r, o, i, a, u, s, c, l, f, d;
            return u = e.x,
            s = e.y,
            c = e.x + e.w,
            l = e.y + e.h,
            f = t.x + t.w,
            d = t.y + t.h,
            r = WN(0, t.x - u),
            o = WN(0, t.y - s),
            i = WN(0, c - f),
            a = WN(0, l - d),
            u += r,
            s += o,
            n && (c += r,
            l += o,
            u -= i,
            s -= a),
            YN(u, s, (c -= i) - u, (l -= a) - s)
        },
        create: YN,
        fromClientRect: function(e) {
            return YN(e.left, e.top, e.width, e.height)
        }
    }, JN = hr.each, QN = hr.extend, ZN = function() {};
    ZN.extend = jN = function(n) {
        var o, i = this.prototype, r = function() {
            var e, t, n;
            if (!HN && (this.init && this.init.apply(this, arguments),
            t = this.Mixins))
                for (e = t.length; e--; )
                    (n = t[e]).init && n.init.apply(this, arguments)
        }, t = function() {
            return this
        };
        return HN = !0,
        o = new this,
        HN = !1,
        n.Mixins && (JN(n.Mixins, function(e) {
            for (var t in e)
                "init" !== t && (n[t] = e[t])
        }),
        i.Mixins && (n.Mixins = i.Mixins.concat(n.Mixins))),
        n.Methods && JN(n.Methods.split(","), function(e) {
            n[e] = t
        }),
        n.Properties && JN(n.Properties.split(","), function(e) {
            var t = "_" + e;
            n[e] = function(e) {
                return e !== undefined ? (this[t] = e,
                this) : this[t]
            }
        }),
        n.Statics && JN(n.Statics, function(e, t) {
            r[t] = e
        }),
        n.Defaults && i.Defaults && (n.Defaults = QN({}, i.Defaults, n.Defaults)),
        oe(n, function(e, t) {
            var n, r;
            "function" == typeof e && i[t] ? o[t] = (n = t,
            r = e,
            function() {
                var e, t = this._super;
                return this._super = i[n],
                e = r.apply(this, arguments),
                this._super = t,
                e
            }
            ) : o[t] = e
        }),
        r.prototype = o,
        (r.constructor = r).extend = jN,
        r
    }
    ;
    var eE = Math.min
      , tE = Math.max
      , nE = Math.round
      , rE = {
        serialize: function(e) {
            var t = JSON.stringify(e);
            return q(t) ? t.replace(/[\u0080-\uFFFF]/g, function(e) {
                var t = e.charCodeAt(0).toString(16);
                return "\\u" + "0000".substring(t.length) + t
            }) : t
        },
        parse: function(e) {
            try {
                return JSON.parse(e)
            } catch (t) {}
        }
    }
      , oE = {
        callbacks: {},
        count: 0,
        send: function(t) {
            var n = this
              , r = ga.DOM
              , o = t.count !== undefined ? t.count : n.count
              , i = "tinymce_jsonp_" + o;
            n.callbacks[o] = function(e) {
                r.remove(i),
                delete n.callbacks[o],
                t.callback(e)
            }
            ,
            r.add(r.doc.body, "script", {
                id: i,
                src: t.url,
                type: "text/javascript"
            }),
            n.count++
        }
    }
      , iE = pe(pe({}, jS), {
        send: function(e) {
            var t, n = 0, r = function() {
                !e.async || 4 === t.readyState || 1e4 < n++ ? (e.success && n < 1e4 && 200 === t.status ? e.success.call(e.success_scope, "" + t.responseText, t, e) : e.error && e.error.call(e.error_scope, 1e4 < n ? "TIMED_OUT" : "GENERAL", t, e),
                t = null) : Xn.setTimeout(r, 10)
            };
            if (e.scope = e.scope || this,
            e.success_scope = e.success_scope || e.scope,
            e.error_scope = e.error_scope || e.scope,
            e.async = !1 !== e.async,
            e.data = e.data || "",
            iE.fire("beforeInitialize", {
                settings: e
            }),
            t = new V.XMLHttpRequest) {
                if (t.overrideMimeType && t.overrideMimeType(e.content_type),
                t.open(e.type || (e.data ? "POST" : "GET"), e.url, e.async),
                e.crossDomain && (t.withCredentials = !0),
                e.content_type && t.setRequestHeader("Content-Type", e.content_type),
                e.requestheaders && hr.each(e.requestheaders, function(e) {
                    t.setRequestHeader(e.key, e.value)
                }),
                t.setRequestHeader("X-Requested-With", "XMLHttpRequest"),
                (t = iE.fire("beforeSend", {
                    xhr: t,
                    settings: e
                }).xhr).send(e.data),
                !e.async)
                    return r();
                Xn.setTimeout(r, 10)
            }
        }
    })
      , aE = hr.extend
      , uE = (sE.sendRPC = function(e) {
        return (new sE).send(e)
    }
    ,
    sE.prototype.send = function(e) {
        var n = e.error
          , r = e.success
          , o = aE(this.settings, e);
        o.success = function(e, t) {
            void 0 === (e = rE.parse(e)) && (e = {
                error: "JSON Parse error."
            }),
            e.error ? n.call(o.error_scope || o.scope, e.error, t) : r.call(o.success_scope || o.scope, e.result)
        }
        ,
        o.error = function(e, t) {
            n && n.call(o.error_scope || o.scope, e, t)
        }
        ,
        o.data = rE.serialize({
            id: e.id || "c" + this.count++,
            method: e.method,
            params: e.params
        }),
        o.content_type = "application/json",
        iE.send(o)
    }
    ,
    sE);
    function sE(e) {
        this.settings = aE({}, e),
        this.count = 0
    }
    var cE;
    try {
        var lE = "__storage_test__";
        (cE = V.window.localStorage).setItem(lE, lE),
        cE.removeItem(lE)
    } catch (pE) {
        cE = function() {
            return n = {},
            r = [],
            e = {
                getItem: function(e) {
                    var t = n[e];
                    return t || null
                },
                setItem: function(e, t) {
                    r.push(e),
                    n[e] = String(t)
                },
                key: function(e) {
                    return r[e]
                },
                removeItem: function(t) {
                    r = r.filter(function(e) {
                        return e === t
                    }),
                    delete n[t]
                },
                clear: function() {
                    r = [],
                    n = {}
                },
                length: 0
            },
            Object.defineProperty(e, "length", {
                get: function() {
                    return r.length
                },
                configurable: !1,
                enumerable: !1
            }),
            e;
            var n, r, e
        }()
    }
    var fE, dE = {
        geom: {
            Rect: GN
        },
        util: {
            Promise: Mn,
            Delay: Xn,
            Tools: hr,
            VK: Zh,
            URI: pN,
            Class: ZN,
            EventDispatcher: MS,
            Observable: jS,
            I18n: ka,
            XHR: iE,
            JSON: rE,
            JSONRequest: uE,
            JSONP: oE,
            LocalStorage: cE,
            Color: function(e) {
                var n = {}
                  , u = 0
                  , s = 0
                  , c = 0
                  , t = function(e) {
                    var t;
                    return "object" == typeof e ? "r"in e ? (u = e.r,
                    s = e.g,
                    c = e.b) : "v"in e && function(e, t, n) {
                        var r, o, i, a;
                        if (e = (parseInt(e, 10) || 0) % 360,
                        t = parseInt(t, 10) / 100,
                        n = parseInt(n, 10) / 100,
                        t = tE(0, eE(t, 1)),
                        n = tE(0, eE(n, 1)),
                        0 !== t) {
                            switch (r = e / 60,
                            i = (o = n * t) * (1 - Math.abs(r % 2 - 1)),
                            a = n - o,
                            Math.floor(r)) {
                            case 0:
                                u = o,
                                s = i,
                                c = 0;
                                break;
                            case 1:
                                u = i,
                                s = o,
                                c = 0;
                                break;
                            case 2:
                                u = 0,
                                s = o,
                                c = i;
                                break;
                            case 3:
                                u = 0,
                                s = i,
                                c = o;
                                break;
                            case 4:
                                u = i,
                                s = 0,
                                c = o;
                                break;
                            case 5:
                                u = o,
                                s = 0,
                                c = i;
                                break;
                            default:
                                u = s = c = 0
                            }
                            u = nE(255 * (u + a)),
                            s = nE(255 * (s + a)),
                            c = nE(255 * (c + a))
                        } else
                            u = s = c = nE(255 * n)
                    }(e.h, e.s, e.v) : (t = /rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)[^\)]*\)/gi.exec(e)) ? (u = parseInt(t[1], 10),
                    s = parseInt(t[2], 10),
                    c = parseInt(t[3], 10)) : (t = /#([0-F]{2})([0-F]{2})([0-F]{2})/gi.exec(e)) ? (u = parseInt(t[1], 16),
                    s = parseInt(t[2], 16),
                    c = parseInt(t[3], 16)) : (t = /#([0-F])([0-F])([0-F])/gi.exec(e)) && (u = parseInt(t[1] + t[1], 16),
                    s = parseInt(t[2] + t[2], 16),
                    c = parseInt(t[3] + t[3], 16)),
                    u = u < 0 ? 0 : 255 < u ? 255 : u,
                    s = s < 0 ? 0 : 255 < s ? 255 : s,
                    c = c < 0 ? 0 : 255 < c ? 255 : c,
                    n
                };
                return e && t(e),
                n.toRgb = function() {
                    return {
                        r: u,
                        g: s,
                        b: c
                    }
                }
                ,
                n.toHsv = function() {
                    return e = u,
                    t = s,
                    n = c,
                    o = 0,
                    (i = eE(e /= 255, eE(t /= 255, n /= 255))) === (a = tE(e, tE(t, n))) ? {
                        h: 0,
                        s: 0,
                        v: 100 * (o = i)
                    } : (r = (a - i) / a,
                    {
                        h: nE(60 * ((e === i ? 3 : n === i ? 1 : 5) - (e === i ? t - n : n === i ? e - t : n - e) / ((o = a) - i))),
                        s: nE(100 * r),
                        v: nE(100 * o)
                    });
                    var e, t, n, r, o, i, a
                }
                ,
                n.toHex = function() {
                    var e = function(e) {
                        return 1 < (e = parseInt(e, 10).toString(16)).length ? e : "0" + e
                    };
                    return "#" + e(u) + e(s) + e(c)
                }
                ,
                n.parse = t,
                n
            }
        },
        dom: {
            EventUtils: ho,
            Sizzle: hi,
            DomQuery: na,
            TreeWalker: ra,
            TextSeeker: uu,
            DOMUtils: ga,
            ScriptLoader: ba,
            RangeUtils: VN,
            Serializer: Av,
            ControlSelection: nv,
            BookmarkManager: Jh,
            Selection: av,
            Event: ho.Event
        },
        html: {
            Styles: ao,
            Entities: $r,
            Node: df,
            Schema: no,
            SaxParser: kf,
            DomParser: Ev,
            Writer: gf,
            Serializer: hf
        },
        Env: rr,
        AddOnManager: Ra,
        Annotator: af,
        Formatter: Wv,
        UndoManager: Xv,
        EditorCommands: PS,
        WindowManager: rh,
        NotificationManager: eh,
        EditorObservable: ZS,
        Shortcuts: uN,
        Editor: wN,
        FocusManager: xm,
        EditorManager: MN,
        DOM: ga.DOM,
        ScriptLoader: ba.ScriptLoader,
        PluginManager: Ra.PluginManager,
        ThemeManager: Ra.ThemeManager,
        IconManager: $g,
        Resource: qN,
        trim: hr.trim,
        isArray: hr.isArray,
        is: hr.is,
        toArray: hr.toArray,
        makeMap: hr.makeMap,
        each: hr.each,
        map: hr.map,
        grep: hr.grep,
        inArray: hr.inArray,
        extend: hr.extend,
        create: hr.create,
        walk: hr.walk,
        createNS: hr.createNS,
        resolve: hr.resolve,
        explode: hr.explode,
        _addCacheSuffix: hr._addCacheSuffix,
        isOpera: rr.opera,
        isWebKit: rr.webkit,
        isIE: rr.ie,
        isGecko: rr.gecko,
        isMac: rr.mac
    }, mE = hr.extend(MN, dE);
    fE = mE,
    window.tinymce = fE,
    window.tinyMCE = fE,
    function(e) {
        if ("object" == typeof module)
            try {
                module.exports = e
            } catch (t) {}
    }(mE)
}(window);

/* Ephox Fluffy plugin
 *
 * Copyright 2010-2016 Ephox Corporation.  All rights reserved.
 *
 * Version: 2.4.0-12
 */

!function(a) {
    "use strict";
    var n, t, r, e, u = void 0 !== a.window ? a.window : Function("return this;")(), i = function(n, t) {
        return {
            isRequired: n,
            applyPatch: t
        }
    }, c = function(i, o) {
        return function() {
            for (var n = [], t = 0; t < arguments.length; t++)
                n[t] = arguments[t];
            var r = o.apply(this, n)
              , e = void 0 === r ? n : r;
            return i.apply(this, e)
        }
    }, o = function(n, t) {
        if (n)
            for (var r = 0; r < t.length; r++)
                t[r].isRequired(n) && t[r].applyPatch(n);
        return n
    }, f = function() {}, l = function(n) {
        return function() {
            return n
        }
    }, s = l(!1), g = l(!0), p = function() {
        return d
    }, d = (n = function(n) {
        return n.isNone()
    }
    ,
    e = {
        fold: function(n, t) {
            return n()
        },
        is: s,
        isSome: s,
        isNone: g,
        getOr: r = function(n) {
            return n
        }
        ,
        getOrThunk: t = function(n) {
            return n()
        }
        ,
        getOrDie: function(n) {
            throw new Error(n || "error: getOrDie called on none.")
        },
        getOrNull: l(null),
        getOrUndefined: l(void 0),
        or: r,
        orThunk: t,
        map: p,
        each: f,
        bind: p,
        exists: s,
        forall: g,
        filter: p,
        equals: n,
        equals_: n,
        toArray: function() {
            return []
        },
        toString: l("none()")
    },
    Object.freeze && Object.freeze(e),
    e), h = function(r) {
        var n = l(r)
          , t = function() {
            return i
        }
          , e = function(n) {
            return n(r)
        }
          , i = {
            fold: function(n, t) {
                return t(r)
            },
            is: function(n) {
                return r === n
            },
            isSome: g,
            isNone: s,
            getOr: n,
            getOrThunk: n,
            getOrDie: n,
            getOrNull: n,
            getOrUndefined: n,
            or: t,
            orThunk: t,
            map: function(n) {
                return h(n(r))
            },
            each: function(n) {
                n(r)
            },
            bind: e,
            exists: e,
            forall: e,
            filter: function(n) {
                return n(r) ? i : d
            },
            toArray: function() {
                return [r]
            },
            toString: function() {
                return "some(" + r + ")"
            },
            equals: function(n) {
                return n.is(r)
            },
            equals_: function(n, t) {
                return n.fold(s, function(n) {
                    return t(r, n)
                })
            }
        };
        return i
    }, v = p, y = function(n) {
        return null == n ? d : h(n)
    }, m = function(t) {
        return function(n) {
            return function(n) {
                if (null === n)
                    return "null";
                var t = typeof n;
                return "object" === t && (Array.prototype.isPrototypeOf(n) || n.constructor && "Array" === n.constructor.name) ? "array" : "object" === t && (String.prototype.isPrototypeOf(n) || n.constructor && "String" === n.constructor.name) ? "string" : t
            }(n) === t
        }
    }, w = m("object"), O = m("array"), b = m("undefined"), j = m("function"), A = (Array.prototype.slice,
    Array.prototype.indexOf), x = Array.prototype.push, E = function(n, t) {
        return r = n,
        e = t,
        -1 < A.call(r, e);
        var r, e
    }, S = function(n, t) {
        return function(n) {
            for (var t = [], r = 0, e = n.length; r < e; ++r) {
                if (!O(n[r]))
                    throw new Error("Arr.flatten item " + r + " was not an array, input: " + n);
                x.apply(t, n[r])
            }
            return t
        }(function(n, t) {
            for (var r = n.length, e = new Array(r), i = 0; i < r; i++) {
                var o = n[i];
                e[i] = t(o, i)
            }
            return e
        }(n, t))
    }, M = (j(Array.from) && Array.from,
    Object.prototype.hasOwnProperty), _ = function(u) {
        return function() {
            for (var n = new Array(arguments.length), t = 0; t < n.length; t++)
                n[t] = arguments[t];
            if (0 === n.length)
                throw new Error("Can't merge zero objects");
            for (var r = {}, e = 0; e < n.length; e++) {
                var i = n[e];
                for (var o in i)
                    M.call(i, o) && (r[o] = u(r[o], i[o]))
            }
            return r
        }
    }, D = _(function(n, t) {
        return w(n) && w(t) ? D(n, t) : t
    }), P = _(function(n, t) {
        return t
    }), U = Object.keys, N = Object.hasOwnProperty, R = function(n, t) {
        for (var r = U(n), e = 0, i = r.length; e < i; e++) {
            var o = r[e];
            t(n[o], o)
        }
    }, T = function(n, t) {
        return q(n, t) ? y(n[t]) : v()
    }, q = function(n, t) {
        return N.call(n, t)
    }, C = function(n) {
        if (b(n) || "" === n)
            return [];
        var t = O(n) ? S(n, function(n) {
            return n.split(/[\s+,]/)
        }) : n.split(/[\s+,]/);
        return S(t, function(n) {
            return 0 < n.length ? [n.trim()] : []
        })
    }, I = function(n, t) {
        var r, e, i, o = D(n, t), u = C(t.plugins), a = T(o, "custom_plugin_urls").getOr({}), c = (r = function(n, t) {
            return E(u, t)
        }
        ,
        e = {},
        i = {},
        R(a, function(n, t) {
            (r(n, t) ? e : i)[t] = n
        }),
        {
            t: e,
            f: i
        }), f = T(o, "external_plugins").getOr({}), l = {};
        R(c.t, function(n, t) {
            l[t] = n
        });
        var s = P(l, f);
        return P(t, 0 === U(s).length ? {} : {
            external_plugins: s
        })
    }, k = {
        getCustomPluginUrls: I,
        patch: i(function() {
            return !0
        }, function(t) {
            t.EditorManager.init = c(t.EditorManager.init, function(n) {
                return [I(t.defaultSettings, n)]
            })
        })
    }, L = function(n, t) {
        return function(n, t) {
            for (var r = null != t ? t : u, e = 0; e < n.length && null != r; ++e)
                r = r[n[e]];
            return r
        }(n.split("."), t)
    }, z = function(n) {
        return parseInt(n, 10)
    }, V = function(n, t) {
        var r = n - t;
        return 0 === r ? 0 : 0 < r ? 1 : -1
    }, B = function(n, t, r) {
        return {
            major: n,
            minor: t,
            patch: r
        }
    }, F = function(n) {
        var t = /([0-9]+)\.([0-9]+)\.([0-9]+)(?:(\-.+)?)/.exec(n);
        return t ? B(z(t[1]), z(t[2]), z(t[3])) : B(0, 0, 0)
    }, $ = function(n, t) {
        return !!n && -1 === function(n, t) {
            var r = V(n.major, t.major);
            if (0 !== r)
                return r;
            var e = V(n.minor, t.minor);
            if (0 !== e)
                return e;
            var i = V(n.patch, t.patch);
            return 0 !== i ? i : 0
        }(F([(r = n).majorVersion, r.minorVersion].join(".").split(".").slice(0, 3).join(".")), F(t));
        var r
    }, G = {
        patch: i(function(n) {
            return $(n, "4.7.0")
        }, function(n) {
            var o;
            n.EditorManager.init = c(n.EditorManager.init, (o = n.EditorManager,
            function(n) {
                var t = L("tinymce.util.Tools", u)
                  , r = C(n.plugins)
                  , e = o.defaultSettings.forced_plugins || []
                  , i = 0 < e.length ? r.concat(e) : r;
                return [t.extend({}, n, {
                    plugins: i
                })]
            }
            ))
        })
    }, H = function() {
        return (new Date).getTime()
    }, J = function(n, t, r, e, i) {
        var o, u = H();
        o = a.setInterval(function() {
            n() && (a.clearInterval(o),
            t()),
            H() - u > i && (a.clearInterval(o),
            r())
        }, e)
    }, K = function(i) {
        return function() {
            var n, t, r, e = (n = i,
            t = "position",
            r = n.currentStyle ? n.currentStyle[t] : a.window.getComputedStyle(n, null)[t],
            r || "").toLowerCase();
            return "absolute" === e || "fixed" === e
        }
    }, Q = function(n) {
        n.parentNode.removeChild(n)
    }, W = function(n, t) {
        var r, e = ((r = a.document.createElement("div")).style.display = "none",
        r.className = "mce-floatpanel",
        r);
        a.document.body.appendChild(e),
        J(K(e), function() {
            Q(e),
            n()
        }, function() {
            Q(e),
            t()
        }, 10, 5e3)
    }, X = function(n, t) {
        n.notificationManager ? n.notificationManager.open({
            text: t,
            type: "warning",
            timeout: 0,
            icon: ""
        }) : n.windowManager.alert(t)
    }, Y = function(n) {
        n.EditorManager.on("AddEditor", function(n) {
            var t = n.editor
              , r = t.settings.service_message;
            r && W(function() {
                X(t, t.settings.service_message)
            }, function() {
                a.alert(r)
            })
        })
    }, Z = function(n) {
        var t, r, e = L("tinymce.util.URI", u);
        (t = n.base_url) && (this.baseURL = new e(this.documentBaseURL).toAbsolute(t.replace(/\/+$/, "")),
        this.baseURI = new e(this.baseURL)),
        r = n.suffix,
        n.suffix && (this.suffix = r),
        this.defaultSettings = n
    }, nn = function(n) {
        return [L("tinymce.util.Tools", u).extend({}, this.defaultSettings, n)]
    }, tn = {
        patch: i(function(n) {
            return "function" != typeof n.overrideDefaults
        }, function(n) {
            Y(n),
            n.overrideDefaults = Z,
            n.EditorManager.init = c(n.EditorManager.init, nn)
        })
    }, rn = {
        patch: i(function(n) {
            return $(n, "4.5.0")
        }, function(n) {
            var e;
            n.overrideDefaults = c(n.overrideDefaults, (e = n,
            function(n) {
                var t = n.plugin_base_urls;
                for (var r in t)
                    e.PluginManager.urls[r] = t[r]
            }
            ))
        })
    }, en = function(n) {
        o(n, [tn.patch, rn.patch, G.patch, k.patch])
    };
    en(u.tinymce)
}(window);

(function(cloudSettings) {
    tinymce.overrideDefaults(cloudSettings);
}
)({
    "imagetools_proxy": "https://imageproxy.tiny.cloud/2/image",
    "suffix": ".min",
    "linkchecker_service_url": "https://hyperlinking.tiny.cloud",
    "spellchecker_rpc_url": "https://spelling.tiny.cloud",
    "spellchecker_api_key": "",
    "tinydrive_service_url": "https://catalog.tiny.cloud",
    "api_key": "",
    "imagetools_api_key": "",
    "tinydrive_api_key": "",
    "forced_plugins": ["chiffer"],
    "referrer_policy": "origin",
    "content_css_cors": true,
    "custom_plugin_urls": {},
    "chiffer_snowplow_service_url": "https://sp.tinymce.com/i",
    "mediaembed_api_key": "",
    "linkchecker_api_key": "",
    "mediaembed_service_url": "https://hyperlinking.tiny.cloud"
});
tinymce.baseURL = "https://cdn.tiny.cloud/1//tinymce/5.3.2-85"

/* Ephox chiffer plugin
*
* Copyright 2010-2019 Tiny Technologies Inc. All rights reserved.
*
* Version: 1.5.0-11
*/

!function(u) {
    "use strict";
    var t, a = function() {
        return (new Date).getTime()
    }, c = (t = "string",
    function(n) {
        return function(n) {
            if (null === n)
                return "null";
            var t = typeof n;
            return "object" === t && (Array.prototype.isPrototypeOf(n) || n.constructor && "Array" === n.constructor.name) ? "array" : "object" === t && (String.prototype.isPrototypeOf(n) || n.constructor && "String" === n.constructor.name) ? "string" : t
        }(n) === t
    }
    ), s = function() {}, f = function(n, t) {
        var i, c, e, o = (i = n,
        c = t,
        {
            send: function(n, t, e) {
                var o = "?aid=" + c + "&tna=tinymce_cloud&p=web&dtm=" + t + "&stm=" + a() + "&tz=" + ("undefined" != typeof Intl ? encodeURIComponent(Intl.DateTimeFormat().resolvedOptions().timeZone) : "N%2FA") + "&e=se&se_ca=" + n
                  , r = u.document.createElement("img");
                r.src = i.chiffer_snowplow_service_url + o,
                r.onload = function() {
                    e(!0)
                }
                ,
                r.onerror = function() {
                    e(!1)
                }
            }
        });
        return e = o,
        {
            sendStat: function(n) {
                return function() {
                    e.send(n, a(), s)
                }
            }
        }
    };
    return function() {
        var n, t, e = tinymce.defaultSettings, o = {
            load: function(n) {
                return s
            }
        }, r = (n = e.api_key,
        c(n) ? n : void 0), i = void 0 === r ? o : ((t = f(e, r)).sendStat("script_load")(),
        {
            load: function(n) {
                n.once("init", t.sendStat("init")),
                n.once("focus", t.sendStat("focus"))
            }
        });
        tinymce.PluginManager.add("chiffer", i.load)
    }
}(window)();
