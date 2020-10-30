! function(a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : a(window.jQuery)
}(function(a) {
    Array.prototype.reduce || (Array.prototype.reduce = function(a) {
        var b, c = Object(this),
            d = c.length >>> 0,
            e = 0;
        if (2 === arguments.length) b = arguments[1];
        else {
            for (; d > e && !(e in c);) e++;
            if (e >= d) throw new TypeError("Reduce of empty array with no initial value");
            b = c[e++]
        }
        for (; d > e; e++) e in c && (b = a(b, c[e], e, c));
        return b
    }), "function" != typeof Array.prototype.filter && (Array.prototype.filter = function(a) {
        for (var b = Object(this), c = b.length >>> 0, d = [], e = arguments.length >= 2 ? arguments[1] : void 0, f = 0; c > f; f++)
            if (f in b) {
                var g = b[f];
                a.call(e, g, f, b) && d.push(g)
            }
        return d
    });
    var b, c = "function" == typeof define && define.amd,
        d = function(b) {
            var c = "Comic Sans MS" === b ? "Courier New" : "Comic Sans MS",
                d = a("<div>").css({
                    "position": "absolute",
                    "left": "-9999px",
                    "top": "-9999px",
                    "fontSize": "200px"
                }).text("mmmmmmmmmwwwwwww").appendTo(document.body),
                e = d.css("fontFamily", c).width(),
                f = d.css("fontFamily", b + "," + c).width();
            return d.remove(), e !== f
        },
        e = {
            "isMac": navigator.appVersion.indexOf("Mac") > -1,
            "isMSIE": navigator.userAgent.indexOf("MSIE") > -1 || navigator.userAgent.indexOf("Trident") > -1,
            "isFF": navigator.userAgent.indexOf("Firefox") > -1,
            "jqueryVersion": parseFloat(a.fn.jquery),
            "isSupportAmd": c,
            "hasCodeMirror": c ? require.specified("CodeMirror") : !!window.CodeMirror,
            "isFontInstalled": d,
            "isW3CRangeSupport": !!document.createRange
        },
        f = function() {
            var b = function(a) {
                    return function(b) {
                        return a === b
                    }
                },
                c = function(a, b) {
                    return a === b
                },
                d = function(a) {
                    return function(b, c) {
                        return b[a] === c[a]
                    }
                },
                e = function() {
                    return !0
                },
                f = function() {
                    return !1
                },
                g = function(a) {
                    return function() {
                        return !a.apply(a, arguments)
                    }
                },
                h = function(a, b) {
                    return function(c) {
                        return a(c) && b(c)
                    }
                },
                i = function(a) {
                    return a
                },
                j = 0,
                k = function(a) {
                    var b = ++j + "";
                    return a ? a + b : b
                },
                l = function(b) {
                    var c = a(document);
                    return {
                        "top": b.top + c.scrollTop(),
                        "left": b.left + c.scrollLeft(),
                        "width": b.right - b.left,
                        "height": b.bottom - b.top
                    }
                },
                m = function(a) {
                    var b = {};
                    for (var c in a) a.hasOwnProperty(c) && (b[a[c]] = c);
                    return b
                };
            return {
                "eq": b,
                "eq2": c,
                "peq2": d,
                "ok": e,
                "fail": f,
                "self": i,
                "not": g,
                "and": h,
                "uniqueId": k,
                "rect2bnd": l,
                "invertObject": m
            }
        }(),
        g = function() {
            var b = function(a) {
                    return a[0]
                },
                c = function(a) {
                    return a[a.length - 1]
                },
                d = function(a) {
                    return a.slice(0, a.length - 1)
                },
                e = function(a) {
                    return a.slice(1)
                },
                g = function(a, b) {
                    for (var c = 0, d = a.length; d > c; c++) {
                        var e = a[c];
                        if (b(e)) return e
                    }
                },
                h = function(a, b) {
                    for (var c = 0, d = a.length; d > c; c++)
                        if (!b(a[c])) return !1;
                    return !0
                },
                i = function(b, c) {
                    return -1 !== a.inArray(c, b)
                },
                j = function(a, b) {
                    return b = b || f.self, a.reduce(function(a, c) {
                        return a + b(c)
                    }, 0)
                },
                k = function(a) {
                    for (var b = [], c = -1, d = a.length; ++c < d;) b[c] = a[c];
                    return b
                },
                l = function(a, d) {
                    if (!a.length) return [];
                    var f = e(a);
                    return f.reduce(function(a, b) {
                        var e = c(a);
                        return d(c(e), b) ? e[e.length] = b : a[a.length] = [b], a
                    }, [
                        [b(a)]
                    ])
                },
                m = function(a) {
                    for (var b = [], c = 0, d = a.length; d > c; c++) a[c] && b.push(a[c]);
                    return b
                },
                n = function(a) {
                    for (var b = [], c = 0, d = a.length; d > c; c++) i(b, a[c]) || b.push(a[c]);
                    return b
                },
                o = function(a, b) {
                    var c = a.indexOf(b);
                    return -1 === c ? null : a[c + 1]
                },
                p = function(a, b) {
                    var c = a.indexOf(b);
                    return -1 === c ? null : a[c - 1]
                };
            return {
                "head": b,
                "last": c,
                "initial": d,
                "tail": e,
                "prev": p,
                "next": o,
                "find": g,
                "contains": i,
                "all": h,
                "sum": j,
                "from": k,
                "clusterBy": l,
                "compact": m,
                "unique": n
            }
        }(),
        h = String.fromCharCode(160),
        i = "\ufeff",
        j = function() {
            var b = function(b) {
                    return b && a(b).hasClass("note-editable")
                },
                c = function(b) {
                    return b && a(b).hasClass("note-control-sizing")
                },
                d = function(b) {
                    var c;
                    if (b.hasClass("note-air-editor")) {
                        var d = g.last(b.attr("id").split("-"));
                        return c = function(b) {
                            return function() {
                                return a(b + d)
                            }
                        }, {
                            "editor": function() {
                                return b
                            },
                            "holder": function() {
                                return b.data("holder")
                            },
                            "editable": function() {
                                return b
                            },
                            "popover": c("#note-popover-"),
                            "handle": c("#note-handle-"),
                            "dialog": c("#note-dialog-")
                        }
                    }
                    return c = function(a) {
                        return function() {
                            return b.find(a)
                        }
                    }, {
                        "editor": function() {
                            return b
                        },
                        "holder": function() {
                            return b.data("holder")
                        },
                        "dropzone": c(".note-dropzone"),
                        "toolbar": c(".note-toolbar"),
                        "editable": c(".note-editable"),
                        "codable": c(".note-codable"),
                        "statusbar": c(".note-statusbar"),
                        "popover": c(".note-popover"),
                        "handle": c(".note-handle"),
                        "dialog": c(".note-dialog")
                    }
                },
                k = function(b) {
                    var c = a(b).closest(".note-editor, .note-air-editor, .note-air-layout");
                    if (!c.length) return null;
                    var e;
                    return e = c.is(".note-editor, .note-air-editor") ? c : a("#note-editor-" + g.last(c.attr("id").split("-"))), d(e)
                },
                l = function(a) {
                    return a = a.toUpperCase(),
                        function(b) {
                            return b && b.nodeName.toUpperCase() === a
                        }
                },
                m = function(a) {
                    return a && 3 === a.nodeType
                },
                n = function(a) {
                    return a && /^BR|^IMG|^HR/.test(a.nodeName.toUpperCase())
                },
                o = function(a) {
                    return b(a) ? !1 : a && /^DIV|^P|^LI|^H[1-7]/.test(a.nodeName.toUpperCase())
                },
                p = l("LI"),
                q = function(a) {
                    return o(a) && !p(a)
                },
                r = l("TABLE"),
                s = function(a) {
                    return !(w(a) || t(a) || o(a) || r(a) || v(a))
                },
                t = function(a) {
                    return a && /^UL|^OL/.test(a.nodeName.toUpperCase())
                },
                u = function(a) {
                    return a && /^TD|^TH/.test(a.nodeName.toUpperCase())
                },
                v = l("BLOCKQUOTE"),
                w = function(a) {
                    return u(a) || v(a) || b(a)
                },
                x = l("A"),
                y = function(a) {
                    return s(a) && !!H(a, o)
                },
                z = function(a) {
                    return s(a) && !H(a, o)
                },
                A = l("BODY"),
                B = function(a, b) {
                    return a.nextSibling === b || a.previousSibling === b
                },
                C = function(a, b) {
                    b = b || f.ok;
                    var c = [];
                    return a.previousSibling && b(a.previousSibling) && c.push(a.previousSibling), c.push(a), a.nextSibling && b(a.nextSibling) && c.push(a.nextSibling), c
                },
                D = e.isMSIE ? "&nbsp;" : "<br>",
                E = function(a) {
                    return m(a) ? a.nodeValue.length : a.childNodes.length
                },
                F = function(a) {
                    var b = E(a);
                    return 0 === b ? !0 : j.isText(a) || 1 !== b || a.innerHTML !== D ? !1 : !0
                },
                G = function(a) {
                    n(a) || E(a) || (a.innerHTML = D)
                },
                H = function(a, c) {
                    for (; a;) {
                        if (c(a)) return a;
                        if (b(a)) break;
                        a = a.parentNode
                    }
                    return null
                },
                I = function(a, c) {
                    for (a = a.parentNode; a && 1 === E(a);) {
                        if (c(a)) return a;
                        if (b(a)) break;
                        a = a.parentNode
                    }
                    return null
                },
                J = function(a, c) {
                    c = c || f.fail;
                    var d = [];
                    return H(a, function(a) {
                        return b(a) || d.push(a), c(a)
                    }), d
                },
                K = function(a, b) {
                    var c = J(a);
                    return g.last(c.filter(b))
                },
                L = function(b, c) {
                    for (var d = J(b), e = c; e; e = e.parentNode)
                        if (a.inArray(e, d) > -1) return e;
                    return null
                },
                M = function(a, b) {
                    b = b || f.fail;
                    for (var c = []; a && !b(a);) c.push(a), a = a.previousSibling;
                    return c
                },
                N = function(a, b) {
                    b = b || f.fail;
                    for (var c = []; a && !b(a);) c.push(a), a = a.nextSibling;
                    return c
                },
                O = function(a, b) {
                    var c = [];
                    return b = b || f.ok,
                        function d(e) {
                            a !== e && b(e) && c.push(e);
                            for (var f = 0, g = e.childNodes.length; g > f; f++) d(e.childNodes[f])
                        }(a), c
                },
                P = function(b, c) {
                    var d = b.parentNode,
                        e = a("<" + c + ">")[0];
                    return d.insertBefore(e, b), e.appendChild(b), e
                },
                Q = function(a, b) {
                    var c = b.nextSibling,
                        d = b.parentNode;
                    return c ? d.insertBefore(a, c) : d.appendChild(a), a
                },
                R = function(b, c) {
                    return a.each(c, function(a, c) {
                        b.appendChild(c)
                    }), b
                },
                S = function(a) {
                    return 0 === a.offset
                },
                T = function(a) {
                    return a.offset === E(a.node)
                },
                U = function(a) {
                    return S(a) || T(a)
                },
                V = function(a, b) {
                    for (; a && a !== b;) {
                        if (0 !== X(a)) return !1;
                        a = a.parentNode
                    }
                    return !0
                },
                W = function(a, b) {
                    for (; a && a !== b;) {
                        if (X(a) !== E(a.parentNode) - 1) return !1;
                        a = a.parentNode
                    }
                    return !0
                },
                X = function(a) {
                    for (var b = 0; a = a.previousSibling;) b += 1;
                    return b
                },
                Y = function(a) {
                    return !!(a && a.childNodes && a.childNodes.length)
                },
                Z = function(a, c) {
                    var d, e;
                    if (0 === a.offset) {
                        if (b(a.node)) return null;
                        d = a.node.parentNode, e = X(a.node)
                    } else Y(a.node) ? (d = a.node.childNodes[a.offset - 1], e = E(d)) : (d = a.node, e = c ? 0 : a.offset - 1);
                    return {
                        "node": d,
                        "offset": e
                    }
                },
                $ = function(a, c) {
                    var d, e;
                    if (E(a.node) === a.offset) {
                        if (b(a.node)) return null;
                        d = a.node.parentNode, e = X(a.node) + 1
                    } else Y(a.node) ? (d = a.node.childNodes[a.offset], e = 0) : (d = a.node, e = c ? E(a.node) : a.offset + 1);
                    return {
                        "node": d,
                        "offset": e
                    }
                },
                _ = function(a, b) {
                    return a.node === b.node && a.offset === b.offset
                },
                aa = function(a) {
                    if (m(a.node) || !Y(a.node) || F(a.node)) return !0;
                    var b = a.node.childNodes[a.offset - 1],
                        c = a.node.childNodes[a.offset];
                    return b && !n(b) || c && !n(c) ? !1 : !0
                },
                ba = function(a, b) {
                    for (; a;) {
                        if (b(a)) return a;
                        a = Z(a)
                    }
                    return null
                },
                ca = function(a, b) {
                    for (; a;) {
                        if (b(a)) return a;
                        a = $(a)
                    }
                    return null
                },
                da = function(a, b, c, d) {
                    for (var e = a; e && (c(e), !_(e, b));) {
                        var f = d && a.node !== e.node && b.node !== e.node;
                        e = $(e, f)
                    }
                },
                ea = function(b, c) {
                    var d = J(c, f.eq(b));
                    return a.map(d, X).reverse()
                },
                fa = function(a, b) {
                    for (var c = a, d = 0, e = b.length; e > d; d++) c = c.childNodes.length <= b[d] ? c.childNodes[c.childNodes.length - 1] : c.childNodes[b[d]];
                    return c
                },
                ga = function(a, b) {
                    if (m(a.node)) return S(a) ? a.node : T(a) ? a.node.nextSibling : a.node.splitText(a.offset);
                    var c = a.node.childNodes[a.offset],
                        d = Q(a.node.cloneNode(!1), a.node);
                    return R(d, N(c)), b || (G(a.node), G(d)), d
                },
                ha = function(a, b, c) {
                    var d = J(b.node, f.eq(a));
                    return d.length ? 1 === d.length ? ga(b, c) : d.reduce(function(a, d) {
                        var e = Q(d.cloneNode(!1), d);
                        return a === b.node && (a = ga(b, c)), R(e, N(a)), c || (G(d), G(e)), e
                    }) : null
                },
                ia = function(a, b) {
                    var c, d, e = b ? o : w,
                        f = J(a.node, e),
                        h = g.last(f) || a.node;
                    e(h) ? (c = f[f.length - 2], d = h) : (c = h, d = c.parentNode);
                    var i = c && ha(c, a, b);
                    return {
                        "rightNode": i,
                        "container": d
                    }
                },
                ja = function(a) {
                    return document.createElement(a)
                },
                ka = function(a) {
                    return document.createTextNode(a)
                },
                la = function(a, b) {
                    if (a && a.parentNode) {
                        if (a.removeNode) return a.removeNode(b);
                        var c = a.parentNode;
                        if (!b) {
                            var d, e, f = [];
                            for (d = 0, e = a.childNodes.length; e > d; d++) f.push(a.childNodes[d]);
                            for (d = 0, e = f.length; e > d; d++) c.insertBefore(f[d], a)
                        }
                        c.removeChild(a)
                    }
                },
                ma = function(a, c) {
                    for (; a && !b(a) && c(a);) {
                        var d = a.parentNode;
                        la(a), a = d
                    }
                },
                na = function(a, b) {
                    if (a.nodeName.toUpperCase() === b.toUpperCase()) return a;
                    var c = ja(b);
                    return a.style.cssText && (c.style.cssText = a.style.cssText), R(c, g.from(a.childNodes)), Q(c, a), la(a), c
                },
                oa = l("TEXTAREA"),
                pa = function(b, c) {
                    var d = oa(b[0]) ? b.val() : b.html();
                    if (c) {
                        var e = /<(\/?)(\b(?!!)[^>\s]*)(.*?)(\s*\/?>)/g;
                        d = d.replace(e, function(a, b, c) {
                            c = c.toUpperCase();
                            var d = /^DIV|^TD|^TH|^P|^LI|^H[1-7]/.test(c) && !!b,
                                e = /^BLOCKQUOTE|^TABLE|^TBODY|^TR|^HR|^UL|^OL/.test(c);
                            return a + (d || e ? "\n" : "")
                        }), d = a.trim(d)
                    }
                    return d
                },
                qa = function(a, b) {
                    var c = a.val();
                    return b ? c.replace(/[\n\r]/g, "") : c
                };
            return {
                "NBSP_CHAR": h,
                "ZERO_WIDTH_NBSP_CHAR": i,
                "blank": D,
                "emptyPara": "<p>" + D + "</p>",
                "makePredByNodeName": l,
                "isEditable": b,
                "isControlSizing": c,
                "buildLayoutInfo": d,
                "makeLayoutInfo": k,
                "isText": m,
                "isVoid": n,
                "isPara": o,
                "isPurePara": q,
                "isInline": s,
                "isBodyInline": z,
                "isBody": A,
                "isParaInline": y,
                "isList": t,
                "isTable": r,
                "isCell": u,
                "isBlockquote": v,
                "isBodyContainer": w,
                "isAnchor": x,
                "isDiv": l("DIV"),
                "isLi": p,
                "isBR": l("BR"),
                "isSpan": l("SPAN"),
                "isB": l("B"),
                "isU": l("U"),
                "isS": l("S"),
                "isI": l("I"),
                "isImg": l("IMG"),
                "isTextarea": oa,
                "isEmpty": F,
                "isEmptyAnchor": f.and(x, F),
                "isClosestSibling": B,
                "withClosestSiblings": C,
                "nodeLength": E,
                "isLeftEdgePoint": S,
                "isRightEdgePoint": T,
                "isEdgePoint": U,
                "isLeftEdgeOf": V,
                "isRightEdgeOf": W,
                "prevPoint": Z,
                "nextPoint": $,
                "isSamePoint": _,
                "isVisiblePoint": aa,
                "prevPointUntil": ba,
                "nextPointUntil": ca,
                "walkPoint": da,
                "ancestor": H,
                "singleChildAncestor": I,
                "listAncestor": J,
                "lastAncestor": K,
                "listNext": N,
                "listPrev": M,
                "listDescendant": O,
                "commonAncestor": L,
                "wrap": P,
                "insertAfter": Q,
                "appendChildNodes": R,
                "position": X,
                "hasChildren": Y,
                "makeOffsetPath": ea,
                "fromOffsetPath": fa,
                "splitTree": ha,
                "splitPoint": ia,
                "create": ja,
                "createText": ka,
                "remove": la,
                "removeWhile": ma,
                "replace": na,
                "html": pa,
                "value": qa
            }
        }(),
        k = function() {
            var b = function(a, b) {
                    var c, d, e = a.parentElement(),
                        f = document.body.createTextRange(),
                        h = g.from(e.childNodes);
                    for (c = 0; c < h.length; c++)
                        if (!j.isText(h[c])) {
                            if (f.moveToElementText(h[c]), f.compareEndPoints("StartToStart", a) >= 0) break;
                            d = h[c]
                        }
                    if (0 !== c && j.isText(h[c - 1])) {
                        var i = document.body.createTextRange(),
                            k = null;
                        i.moveToElementText(d || e), i.collapse(!d), k = d ? d.nextSibling : e.firstChild;
                        var l = a.duplicate();
                        l.setEndPoint("StartToStart", i);
                        for (var m = l.text.replace(/[\r\n]/g, "").length; m > k.nodeValue.length && k.nextSibling;) m -= k.nodeValue.length, k = k.nextSibling;
                        k.nodeValue;
                        b && k.nextSibling && j.isText(k.nextSibling) && m === k.nodeValue.length && (m -= k.nodeValue.length, k = k.nextSibling), e = k, c = m
                    }
                    return {
                        "cont": e,
                        "offset": c
                    }
                },
                c = function(a) {
                    var b = function(a, c) {
                            var d, e;
                            if (j.isText(a)) {
                                var h = j.listPrev(a, f.not(j.isText)),
                                    i = g.last(h).previousSibling;
                                d = i || a.parentNode, c += g.sum(g.tail(h), j.nodeLength), e = !i
                            } else {
                                if (d = a.childNodes[c] || a, j.isText(d)) return b(d, 0);
                                c = 0, e = !1
                            }
                            return {
                                "node": d,
                                "collapseToStart": e,
                                "offset": c
                            }
                        },
                        c = document.body.createTextRange(),
                        d = b(a.node, a.offset);
                    return c.moveToElementText(d.node), c.collapse(d.collapseToStart), c.moveStart("character", d.offset), c
                },
                d = function(b, h, i, k) {
                    this.sc = b, this.so = h, this.ec = i, this.eo = k;
                    var l = function() {
                        if (e.isW3CRangeSupport) {
                            var a = document.createRange();
                            return a.setStart(b, h), a.setEnd(i, k), a
                        }
                        var d = c({
                            "node": b,
                            "offset": h
                        });
                        return d.setEndPoint("EndToEnd", c({
                            "node": i,
                            "offset": k
                        })), d
                    };
                    this.getPoints = function() {
                        return {
                            "sc": b,
                            "so": h,
                            "ec": i,
                            "eo": k
                        }
                    }, this.getStartPoint = function() {
                        return {
                            "node": b,
                            "offset": h
                        }
                    }, this.getEndPoint = function() {
                        return {
                            "node": i,
                            "offset": k
                        }
                    }, this.select = function() {
                        var a = l();
                        if (e.isW3CRangeSupport) {
                            var b = document.getSelection();
                            b.rangeCount > 0 && b.removeAllRanges(), b.addRange(a)
                        } else a.select()
                    }, this.normalize = function() {
                        var a = function(a) {
                                return j.isVisiblePoint(a) || (a = j.isLeftEdgePoint(a) ? j.nextPointUntil(a, j.isVisiblePoint) : j.prevPointUntil(a, j.isVisiblePoint)), a
                            },
                            b = a(this.getStartPoint()),
                            c = a(this.getEndPoint());
                        return new d(b.node, b.offset, c.node, c.offset)
                    }, this.nodes = function(a, b) {
                        a = a || f.ok;
                        var c = b && b.includeAncestor,
                            d = b && b.fullyContains,
                            e = this.getStartPoint(),
                            h = this.getEndPoint(),
                            i = [],
                            k = [];
                        return j.walkPoint(e, h, function(b) {
                            if (!j.isEditable(b.node)) {
                                var e;
                                d ? (j.isLeftEdgePoint(b) && k.push(b.node), j.isRightEdgePoint(b) && g.contains(k, b.node) && (e = b.node)) : e = c ? j.ancestor(b.node, a) : b.node, e && a(e) && i.push(e)
                            }
                        }, !0), g.unique(i)
                    }, this.commonAncestor = function() {
                        return j.commonAncestor(b, i)
                    }, this.expand = function(a) {
                        var c = j.ancestor(b, a),
                            e = j.ancestor(i, a);
                        if (!c && !e) return new d(b, h, i, k);
                        var f = this.getPoints();
                        return c && (f.sc = c, f.so = 0), e && (f.ec = e, f.eo = j.nodeLength(e)), new d(f.sc, f.so, f.ec, f.eo)
                    }, this.collapse = function(a) {
                        return a ? new d(b, h, b, h) : new d(i, k, i, k)
                    }, this.splitText = function() {
                        var a = b === i,
                            c = this.getPoints();
                        return j.isText(i) && !j.isEdgePoint(this.getEndPoint()) && i.splitText(k), j.isText(b) && !j.isEdgePoint(this.getStartPoint()) && (c.sc = b.splitText(h), c.so = 0, a && (c.ec = c.sc, c.eo = k - h)), new d(c.sc, c.so, c.ec, c.eo)
                    }, this.deleteContents = function() {
                        if (this.isCollapsed()) return this;
                        var b = this.splitText(),
                            c = b.nodes(null, {
                                "fullyContains": !0
                            }),
                            e = j.prevPointUntil(b.getStartPoint(), function(a) {
                                return !g.contains(c, a.node)
                            }),
                            f = [];
                        return a.each(c, function(a, b) {
                            var c = b.parentNode;
                            e.node !== c && 1 === j.nodeLength(c) && f.push(c), j.remove(b, !1)
                        }), a.each(f, function(a, b) {
                            j.remove(b, !1)
                        }), new d(e.node, e.offset, e.node, e.offset).normalize()
                    };
                    var m = function(a) {
                        return function() {
                            var c = j.ancestor(b, a);
                            return !!c && c === j.ancestor(i, a)
                        }
                    };
                    this.isOnEditable = m(j.isEditable), this.isOnList = m(j.isList), this.isOnAnchor = m(j.isAnchor), this.isOnCell = m(j.isCell), this.isLeftEdgeOf = function(a) {
                        if (!j.isLeftEdgePoint(this.getStartPoint())) return !1;
                        var b = j.ancestor(this.sc, a);
                        return b && j.isLeftEdgeOf(this.sc, b)
                    }, this.isCollapsed = function() {
                        return b === i && h === k
                    }, this.wrapBodyInlineWithPara = function() {
                        if (j.isBodyContainer(b) && j.isEmpty(b)) return b.innerHTML = j.emptyPara, new d(b.firstChild, 0, b.firstChild, 0);
                        if (j.isParaInline(b) || j.isPara(b)) return this.normalize();
                        var a;
                        if (j.isInline(b)) {
                            var c = j.listAncestor(b, f.not(j.isInline));
                            a = g.last(c), j.isInline(a) || (a = c[c.length - 2] || b.childNodes[h])
                        } else a = b.childNodes[h > 0 ? h - 1 : 0];
                        var e = j.listPrev(a, j.isParaInline).reverse();
                        if (e = e.concat(j.listNext(a.nextSibling, j.isParaInline)), e.length) {
                            var i = j.wrap(g.head(e), "p");
                            j.appendChildNodes(i, g.tail(e))
                        }
                        return this.normalize()
                    }, this.insertNode = function(a) {
                        var b = this.wrapBodyInlineWithPara().deleteContents(),
                            c = j.splitPoint(b.getStartPoint(), j.isInline(a));
                        return c.rightNode ? c.rightNode.parentNode.insertBefore(a, c.rightNode) : c.container.appendChild(a), a
                    }, this.toString = function() {
                        var a = l();
                        return e.isW3CRangeSupport ? a.toString() : a.text
                    }, this.bookmark = function(a) {
                        return {
                            "s": {
                                "path": j.makeOffsetPath(a, b),
                                "offset": h
                            },
                            "e": {
                                "path": j.makeOffsetPath(a, i),
                                "offset": k
                            }
                        }
                    }, this.paraBookmark = function(a) {
                        return {
                            "s": {
                                "path": g.tail(j.makeOffsetPath(g.head(a), b)),
                                "offset": h
                            },
                            "e": {
                                "path": g.tail(j.makeOffsetPath(g.last(a), i)),
                                "offset": k
                            }
                        }
                    }, this.getClientRects = function() {
                        var a = l();
                        return a.getClientRects()
                    }
                };
            return {
                "create": function(a, c, f, g) {
                    if (arguments.length) 2 === arguments.length && (f = a, g = c);
                    else if (e.isW3CRangeSupport) {
                        var h = document.getSelection();
                        if (0 === h.rangeCount) return null;
                        if (j.isBody(h.anchorNode)) return null;
                        var i = h.getRangeAt(0);
                        a = i.startContainer, c = i.startOffset, f = i.endContainer, g = i.endOffset
                    } else {
                        var k = document.selection.createRange(),
                            l = k.duplicate();
                        l.collapse(!1);
                        var m = k;
                        m.collapse(!0);
                        var n = b(m, !0),
                            o = b(l, !1);
                        j.isText(n.node) && j.isLeftEdgePoint(n) && j.isTextNode(o.node) && j.isRightEdgePoint(o) && o.node.nextSibling === n.node && (n = o), a = n.cont, c = n.offset, f = o.cont, g = o.offset
                    }
                    return new d(a, c, f, g)
                },
                "createFromNode": function(a) {
                    var b = a,
                        c = 0,
                        d = a,
                        e = j.nodeLength(d);
                    return j.isVoid(b) && (c = j.listPrev(b).length - 1, b = b.parentNode), j.isBR(d) ? (e = j.listPrev(d).length - 1, d = d.parentNode) : j.isVoid(d) && (e = j.listPrev(d).length, d = d.parentNode), this.create(b, c, d, e)
                },
                "createFromBookmark": function(a, b) {
                    var c = j.fromOffsetPath(a, b.s.path),
                        e = b.s.offset,
                        f = j.fromOffsetPath(a, b.e.path),
                        g = b.e.offset;
                    return new d(c, e, f, g)
                },
                "createFromParaBookmark": function(a, b) {
                    var c = a.s.offset,
                        e = a.e.offset,
                        f = j.fromOffsetPath(g.head(b), a.s.path),
                        h = j.fromOffsetPath(g.last(b), a.e.path);
                    return new d(f, c, h, e)
                }
            }
        }(),
        l = {
            "version": "0.6.4",
            "options": {
                "width": null,
                "height": null,
                "minHeight": null,
                "maxHeight": null,
                "focus": !1,
                "tabsize": 4,
                "styleWithSpan": !0,
                "disableLinkTarget": !1,
                "disableDragAndDrop": !1,
                "disableResizeEditor": !1,
                "shortcuts": !0,
                "placeholder": !1,
                "prettifyHtml": !0,
                "iconPrefix": "fa fa-",
                "codemirror": {
                    "mode": "text/html",
                    "htmlMode": !0,
                    "lineNumbers": !0
                },
                "lang": "en-US",
                "direction": null,
                "toolbar": [
                    ["style", ["style"]],
                    ["font", ["bold", "italic", "underline", "clear"]],
                    ["fontname", ["fontname"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                    ["height", ["height"]],
                    ["table", ["table"]],
                    ["insert", ["link", "picture", "hr"]],
                    ["view", ["fullscreen", "codeview"]],
                    ["help", ["help"]]
                ],
                "airMode": !1,
                "airPopover": [
                    ["color", ["color"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["para", ["ul", "paragraph"]],
                    ["table", ["table"]],
                    ["insert", ["link", "picture"]]
                ],
                "styleTags": ["p", "blockquote", "pre", "h1", "h2", "h3", "h4", "h5", "h6"],
                "defaultFontName": "Helvetica Neue",
                "fontNames": ["Arial", "Arial Black", "Comic Sans MS", "Courier New", "Helvetica Neue", "Helvetica", "Impact", "Lucida Grande", "Tahoma", "Times New Roman", "Verdana"],
                "fontNamesIgnoreCheck": [],
                "colors": [
                    ["#000000", "#424242", "#636363", "#9C9C94", "#CEC6CE", "#EFEFEF", "#F7F7F7", "#FFFFFF"],
                    ["#FF0000", "#FF9C00", "#FFFF00", "#00FF00", "#00FFFF", "#0000FF", "#9C00FF", "#FF00FF"],
                    ["#F7C6CE", "#FFE7CE", "#FFEFC6", "#D6EFD6", "#CEDEE7", "#CEE7F7", "#D6D6E7", "#E7D6DE"],
                    ["#E79C9C", "#FFC69C", "#FFE79C", "#B5D6A5", "#A5C6CE", "#9CC6EF", "#B5A5D6", "#D6A5BD"],
                    ["#E76363", "#F7AD6B", "#FFD663", "#94BD7B", "#73A5AD", "#6BADDE", "#8C7BC6", "#C67BA5"],
                    ["#CE0000", "#E79439", "#EFC631", "#6BA54A", "#4A7B8C", "#3984C6", "#634AA5", "#A54A7B"],
                    ["#9C0000", "#B56308", "#BD9400", "#397B21", "#104A5A", "#085294", "#311873", "#731842"],
                    ["#630000", "#7B3900", "#846300", "#295218", "#083139", "#003163", "#21104A", "#4A1031"]
                ],
                "lineHeights": ["1.0", "1.2", "1.4", "1.5", "1.6", "1.8", "2.0", "3.0"],
                "insertTableMaxSize": {
                    "col": 10,
                    "row": 10
                },
                "maximumImageFileSize": null,
                "oninit": null,
                "onfocus": null,
                "onblur": null,
                "onenter": null,
                "onkeyup": null,
                "onkeydown": null,
                "onImageUpload": null,
                "onImageUploadError": null,
                "onMediaDelete": null,
                "onToolbarClick": null,
                "onsubmit": null,
                "onCreateLink": function(a) {
                    return -1 !== a.indexOf("@") && -1 === a.indexOf(":") ? a = "mailto:" + a : -1 === a.indexOf("://") && (a = "http://" + a), a
                },
                "keyMap": {
                    "pc": {
                        "ENTER": "insertParagraph",
                        "CTRL+Z": "undo",
                        "CTRL+Y": "redo",
                        "TAB": "tab",
                        "SHIFT+TAB": "untab",
                        "CTRL+B": "bold",
                        "CTRL+I": "italic",
                        "CTRL+U": "underline",
                        "CTRL+SHIFT+S": "strikethrough",
                        "CTRL+BACKSLASH": "removeFormat",
                        "CTRL+SHIFT+L": "justifyLeft",
                        "CTRL+SHIFT+E": "justifyCenter",
                        "CTRL+SHIFT+R": "justifyRight",
                        "CTRL+SHIFT+J": "justifyFull",
                        "CTRL+SHIFT+NUM7": "insertUnorderedList",
                        "CTRL+SHIFT+NUM8": "insertOrderedList",
                        "CTRL+LEFTBRACKET": "outdent",
                        "CTRL+RIGHTBRACKET": "indent",
                        "CTRL+NUM0": "formatPara",
                        "CTRL+NUM1": "formatH1",
                        "CTRL+NUM2": "formatH2",
                        "CTRL+NUM3": "formatH3",
                        "CTRL+NUM4": "formatH4",
                        "CTRL+NUM5": "formatH5",
                        "CTRL+NUM6": "formatH6",
                        "CTRL+ENTER": "insertHorizontalRule",
                        "CTRL+K": "showLinkDialog"
                    },
                    "mac": {
                        "ENTER": "insertParagraph",
                        "CMD+Z": "undo",
                        "CMD+SHIFT+Z": "redo",
                        "TAB": "tab",
                        "SHIFT+TAB": "untab",
                        "CMD+B": "bold",
                        "CMD+I": "italic",
                        "CMD+U": "underline",
                        "CMD+SHIFT+S": "strikethrough",
                        "CMD+BACKSLASH": "removeFormat",
                        "CMD+SHIFT+L": "justifyLeft",
                        "CMD+SHIFT+E": "justifyCenter",
                        "CMD+SHIFT+R": "justifyRight",
                        "CMD+SHIFT+J": "justifyFull",
                        "CMD+SHIFT+NUM7": "insertUnorderedList",
                        "CMD+SHIFT+NUM8": "insertOrderedList",
                        "CMD+LEFTBRACKET": "outdent",
                        "CMD+RIGHTBRACKET": "indent",
                        "CMD+NUM0": "formatPara",
                        "CMD+NUM1": "formatH1",
                        "CMD+NUM2": "formatH2",
                        "CMD+NUM3": "formatH3",
                        "CMD+NUM4": "formatH4",
                        "CMD+NUM5": "formatH5",
                        "CMD+NUM6": "formatH6",
                        "CMD+ENTER": "insertHorizontalRule",
                        "CMD+K": "showLinkDialog"
                    }
                }
            },
            "lang": {
                "en-US": {
                    "font": {
                        "bold": "Bold",
                        "italic": "Italic",
                        "underline": "Underline",
                        "clear": "Remove Font Style",
                        "height": "Line Height",
                        "name": "Font Family"
                    },
                    "image": {
                        "image": "Picture",
                        "insert": "Insert Image",
                        "resizeFull": "Resize Full",
                        "resizeHalf": "Resize Half",
                        "resizeQuarter": "Resize Quarter",
                        "floatLeft": "Float Left",
                        "floatRight": "Float Right",
                        "floatNone": "Float None",
                        "shapeRounded": "Shape: Rounded",
                        "shapeCircle": "Shape: Circle",
                        "shapeThumbnail": "Shape: Thumbnail",
                        "shapeNone": "Shape: None",
                        "dragImageHere": "Drag image or text here",
                        "dropImage": "Drop image or Text",
                        "selectFromFiles": "Select from files",
                        "maximumFileSize": "Maximum file size",
                        "maximumFileSizeError": "Maximum file size exceeded.",
                        "url": "Image URL",
                        "remove": "Remove Image"
                    },
                    "link": {
                        "link": "Link",
                        "insert": "Insert Link",
                        "unlink": "Unlink",
                        "edit": "Edit",
                        "textToDisplay": "Text to display",
                        "url": "To what URL should this link go?",
                        "openInNewWindow": "Open in new window"
                    },
                    "table": {
                        "table": "Table"
                    },
                    "hr": {
                        "insert": "Insert Horizontal Rule"
                    },
                    "style": {
                        "style": "Style",
                        "normal": "Normal",
                        "blockquote": "Quote",
                        "pre": "Code",
                        "h1": "Header 1",
                        "h2": "Header 2",
                        "h3": "Header 3",
                        "h4": "Header 4",
                        "h5": "Header 5",
                        "h6": "Header 6"
                    },
                    "lists": {
                        "unordered": "Unordered list",
                        "ordered": "Ordered list"
                    },
                    "options": {
                        "help": "Help",
                        "fullscreen": "Full Screen",
                        "codeview": "Code View"
                    },
                    "paragraph": {
                        "paragraph": "Paragraph",
                        "outdent": "Outdent",
                        "indent": "Indent",
                        "left": "Align left",
                        "center": "Align center",
                        "right": "Align right",
                        "justify": "Justify full"
                    },
                    "color": {
                        "recent": "Recent Color",
                        "more": "More Color",
                        "background": "Background Color",
                        "foreground": "Foreground Color",
                        "transparent": "Transparent",
                        "setTransparent": "Set transparent",
                        "reset": "Reset",
                        "resetToDefault": "Reset to default"
                    },
                    "shortcut": {
                        "shortcuts": "Keyboard shortcuts",
                        "close": "Close",
                        "textFormatting": "Text formatting",
                        "action": "Action",
                        "paragraphFormatting": "Paragraph formatting",
                        "documentStyle": "Document Style",
                        "extraKeys": "Extra keys"
                    },
                    "history": {
                        "undo": "Undo",
                        "redo": "Redo"
                    }
                }
            }
        },
        m = function() {
            var b = function(b) {
                    return a.Deferred(function(c) {
                        a.extend(new FileReader, {
                            "onload": function(a) {
                                var b = a.target.result;
                                c.resolve(b)
                            },
                            "onerror": function() {
                                c.reject(this)
                            }
                        }).readAsDataURL(b)
                    }).promise()
                },
                c = function(b, c) {
                    return a.Deferred(function(d) {
                        var e = a("<img>");
                        e.one("load", function() {
                            e.off("error abort"), d.resolve(e)
                        }).one("error abort", function() {
                            e.off("load").detach(), d.reject(e)
                        }).css({
                            "display": "none"
                        }).appendTo(document.body).attr({
                            "src": b,
                            "data-filename": c
                        })
                    }).promise()
                };
            return {
                "readFileAsDataURL": b,
                "createImage": c
            }
        }(),
        n = {
            "isEdit": function(a) {
                return g.contains([8, 9, 13, 32], a)
            },
            "nameFromCode": {
                "8": "BACKSPACE",
                "9": "TAB",
                "13": "ENTER",
                "32": "SPACE",
                "48": "NUM0",
                "49": "NUM1",
                "50": "NUM2",
                "51": "NUM3",
                "52": "NUM4",
                "53": "NUM5",
                "54": "NUM6",
                "55": "NUM7",
                "56": "NUM8",
                "66": "B",
                "69": "E",
                "73": "I",
                "74": "J",
                "75": "K",
                "76": "L",
                "82": "R",
                "83": "S",
                "85": "U",
                "89": "Y",
                "90": "Z",
                "191": "SLASH",
                "219": "LEFTBRACKET",
                "220": "BACKSLASH",
                "221": "RIGHTBRACKET"
            }
        },
        o = function(a) {
            var b = [],
                c = -1,
                d = a[0],
                e = function() {
                    var b = k.create(),
                        c = {
                            "s": {
                                "path": [],
                                "offset": 0
                            },
                            "e": {
                                "path": [],
                                "offset": 0
                            }
                        };
                    return {
                        "contents": a.html(),
                        "bookmark": b ? b.bookmark(d) : c
                    }
                },
                f = function(b) {
                    null !== b.contents && a.html(b.contents), null !== b.bookmark && k.createFromBookmark(d, b.bookmark).select()
                };
            this.undo = function() {
                c > 0 && (c--, f(b[c]))
            }, this.redo = function() {
                b.length - 1 > c && (c++, f(b[c]))
            }, this.recordUndo = function() {
                c++, b.length > c && (b = b.slice(0, c)), b.push(e())
            }, this.recordUndo()
        },
        p = function() {
            var b = function(b, c) {
                if (e.jqueryVersion < 1.9) {
                    var d = {};
                    return a.each(c, function(a, c) {
                        d[c] = b.css(c)
                    }), d
                }
                return b.css.call(b, c)
            };
            this.stylePara = function(b, c) {
                a.each(b.nodes(j.isPara, {
                    "includeAncestor": !0
                }), function(b, d) {
                    a(d).css(c)
                })
            }, this.styleNodes = function(b, c) {
                b = b.splitText();
                var d = c && c.nodeName || "SPAN",
                    e = !(!c || !c.expandClosestSibling),
                    h = !(!c || !c.onlyPartialContains);
                if (b.isCollapsed()) return b.insertNode(j.create(d));
                var i = j.makePredByNodeName(d),
                    k = a.map(b.nodes(j.isText, {
                        "fullyContains": !0
                    }), function(a) {
                        return j.singleChildAncestor(a, i) || j.wrap(a, d)
                    });
                if (e) {
                    if (h) {
                        var l = b.nodes();
                        i = f.and(i, function(a) {
                            return g.contains(l, a)
                        })
                    }
                    return a.map(k, function(b) {
                        var c = j.withClosestSiblings(b, i),
                            d = g.head(c),
                            e = g.tail(c);
                        return a.each(e, function(a, b) {
                            j.appendChildNodes(d, b.childNodes), j.remove(b)
                        }), g.head(c)
                    })
                }
                return k
            }, this.current = function(c, d) {
                var e = a(j.isText(c.sc) ? c.sc.parentNode : c.sc),
                    f = ["font-family", "font-size", "text-align", "list-style-type", "line-height"],
                    g = b(e, f) || {};
                if (g["font-size"] = parseInt(g["font-size"], 10), g["font-bold"] = document.queryCommandState("bold") ? "bold" : "normal", g["font-italic"] = document.queryCommandState("italic") ? "italic" : "normal", g["font-underline"] = document.queryCommandState("underline") ? "underline" : "normal", g["font-strikethrough"] = document.queryCommandState("strikeThrough") ? "strikethrough" : "normal", g["font-superscript"] = document.queryCommandState("superscript") ? "superscript" : "normal", g["font-subscript"] = document.queryCommandState("subscript") ? "subscript" : "normal", c.isOnList()) {
                    var h = ["circle", "disc", "disc-leading-zero", "square"],
                        i = a.inArray(g["list-style-type"], h) > -1;
                    g["list-style"] = i ? "unordered" : "ordered"
                } else g["list-style"] = "none";
                var k = j.ancestor(c.sc, j.isPara);
                if (k && k.style["line-height"]) g["line-height"] = k.style.lineHeight;
                else {
                    var l = parseInt(g["line-height"], 10) / parseInt(g["font-size"], 10);
                    g["line-height"] = l.toFixed(1)
                }
                return g.image = j.isImg(d) && d, g.anchor = c.isOnAnchor() && j.ancestor(c.sc, j.isAnchor), g.ancestors = j.listAncestor(c.sc, j.isEditable), g.range = c, g
            }
        },
        q = function() {
            this.insertTab = function(a, b, c) {
                var d = j.createText(new Array(c + 1).join(j.NBSP_CHAR));
                b = b.deleteContents(), b.insertNode(d, !0), b = k.create(d, c), b.select()
            }, this.insertParagraph = function() {
                var b = k.create();
                b = b.deleteContents(), b = b.wrapBodyInlineWithPara();
                var c, d = j.ancestor(b.sc, j.isPara);
                if (d) {
                    c = j.splitTree(d, b.getStartPoint());
                    var e = j.listDescendant(d, j.isEmptyAnchor);
                    e = e.concat(j.listDescendant(c, j.isEmptyAnchor)), a.each(e, function(a, b) {
                        j.remove(b)
                    })
                } else {
                    var f = b.sc.childNodes[b.so];
                    c = a(j.emptyPara)[0], f ? b.sc.insertBefore(c, f) : b.sc.appendChild(c)
                }
                k.create(c, 0).normalize().select()
            }
        },
        r = function() {
            this.tab = function(a, b) {
                var c = j.ancestor(a.commonAncestor(), j.isCell),
                    d = j.ancestor(c, j.isTable),
                    e = j.listDescendant(d, j.isCell),
                    f = g[b ? "prev" : "next"](e, c);
                f && k.create(f, 0).select()
            }, this.createTable = function(b, c) {
                for (var d, e = [], f = 0; b > f; f++) e.push("<td>" + j.blank + "</td>");
                d = e.join("");
                for (var g, h = [], i = 0; c > i; i++) h.push("<tr>" + d + "</tr>");
                return g = h.join(""), a('<table class="table table-bordered">' + g + "</table>")[0]
            }
        },
        s = function() {
            this.insertOrderedList = function() {
                this.toggleList("OL")
            }, this.insertUnorderedList = function() {
                this.toggleList("UL")
            }, this.indent = function() {
                var b = this,
                    c = k.create().wrapBodyInlineWithPara(),
                    d = c.nodes(j.isPara, {
                        "includeAncestor": !0
                    }),
                    e = g.clusterBy(d, f.peq2("parentNode"));
                a.each(e, function(c, d) {
                    var e = g.head(d);
                    j.isLi(e) ? b.wrapList(d, e.parentNode.nodeName) : a.each(d, function(b, c) {
                        a(c).css("marginLeft", function(a, b) {
                            return (parseInt(b, 10) || 0) + 25
                        })
                    })
                }), c.select()
            }, this.outdent = function() {
                var b = this,
                    c = k.create().wrapBodyInlineWithPara(),
                    d = c.nodes(j.isPara, {
                        "includeAncestor": !0
                    }),
                    e = g.clusterBy(d, f.peq2("parentNode"));
                a.each(e, function(c, d) {
                    var e = g.head(d);
                    j.isLi(e) ? b.releaseList([d]) : a.each(d, function(b, c) {
                        a(c).css("marginLeft", function(a, b) {
                            return b = parseInt(b, 10) || 0, b > 25 ? b - 25 : ""
                        })
                    })
                }), c.select()
            }, this.toggleList = function(b) {
                var c = this,
                    d = k.create().wrapBodyInlineWithPara(),
                    e = d.nodes(j.isPara, {
                        "includeAncestor": !0
                    }),
                    h = d.paraBookmark(e),
                    i = g.clusterBy(e, f.peq2("parentNode"));
                if (g.find(e, j.isPurePara)) {
                    var l = [];
                    a.each(i, function(a, d) {
                        l = l.concat(c.wrapList(d, b))
                    }), e = l
                } else {
                    var m = d.nodes(j.isList, {
                        "includeAncestor": !0
                    }).filter(function(c) {
                        return !a.nodeName(c, b)
                    });
                    m.length ? a.each(m, function(a, c) {
                        j.replace(c, b)
                    }) : e = this.releaseList(i, !0)
                }
                k.createFromParaBookmark(h, e).select()
            }, this.wrapList = function(b, c) {
                var d = g.head(b),
                    e = g.last(b),
                    f = j.isList(d.previousSibling) && d.previousSibling,
                    h = j.isList(e.nextSibling) && e.nextSibling,
                    i = f || j.insertAfter(j.create(c || "UL"), e);
                return b = a.map(b, function(a) {
                    return j.isPurePara(a) ? j.replace(a, "LI") : a
                }), j.appendChildNodes(i, b), h && (j.appendChildNodes(i, g.from(h.childNodes)), j.remove(h)), b
            }, this.releaseList = function(b, c) {
                var d = [];
                return a.each(b, function(b, e) {
                    var f = g.head(e),
                        h = g.last(e),
                        i = c ? j.lastAncestor(f, j.isList) : f.parentNode,
                        k = i.childNodes.length > 1 ? j.splitTree(i, {
                            "node": h.parentNode,
                            "offset": j.position(h) + 1
                        }, !0) : null,
                        l = j.splitTree(i, {
                            "node": f.parentNode,
                            "offset": j.position(f)
                        }, !0);
                    e = c ? j.listDescendant(l, j.isLi) : g.from(l.childNodes).filter(j.isLi), (c || !j.isList(i.parentNode)) && (e = a.map(e, function(a) {
                        return j.replace(a, "P")
                    })), a.each(g.from(e).reverse(), function(a, b) {
                        j.insertAfter(b, i)
                    });
                    var m = g.compact([i, l, k]);
                    a.each(m, function(b, c) {
                        var d = [c].concat(j.listDescendant(c, j.isList));
                        a.each(d.reverse(), function(a, b) {
                            j.nodeLength(b) || j.remove(b, !0)
                        })
                    }), d = d.concat(e)
                }), d
            }
        },
        t = function() {
            var b = new p,
                c = new r,
                d = new q,
                f = new s;
            this.createRange = function(a) {
                return a.focus(), k.create()
            }, this.saveRange = function(a, b) {
                a.focus(), a.data("range", k.create()), b && k.create().collapse().select()
            }, this.saveNode = function(a) {
                for (var b = [], c = 0, d = a[0].childNodes.length; d > c; c++) b.push(a[0].childNodes[c]);
                a.data("childNodes", b)
            }, this.restoreRange = function(a) {
                var b = a.data("range");
                b && (b.select(), a.focus())
            }, this.restoreNode = function(a) {
                a.html("");
                for (var b = a.data("childNodes"), c = 0, d = b.length; d > c; c++) a[0].appendChild(b[c])
            }, this.currentStyle = function(a) {
                var c = k.create();
                return c ? c.isOnEditable() && b.current(c, a) : !1
            };
            var h = this.triggerOnBeforeChange = function(a) {
                    var b = a.data("callbacks").onBeforeChange;
                    b && b(a.html(), a)
                },
                i = this.triggerOnChange = function(a) {
                    var b = a.data("callbacks").onChange;
                    b && b(a.html(), a)
                };
            this.undo = function(a) {
                h(a), a.data("NoteHistory").undo(), i(a)
            }, this.redo = function(a) {
                h(a), a.data("NoteHistory").redo(), i(a)
            };
            for (var l = this.beforeCommand = function(a) {
                    h(a)
                }, n = this.afterCommand = function(a) {
                    a.data("NoteHistory").recordUndo(), i(a)
                }, o = ["bold", "italic", "underline", "strikethrough", "superscript", "subscript", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull", "formatBlock", "removeFormat", "backColor", "foreColor", "insertHorizontalRule", "fontName"], t = 0, u = o.length; u > t; t++) this[o[t]] = function(a) {
                return function(b, c) {
                    l(b), document.execCommand(a, !1, c), n(b)
                }
            }(o[t]);
            this.tab = function(a, b) {
                var e = k.create();
                e.isCollapsed() && e.isOnCell() ? c.tab(e) : (l(a), d.insertTab(a, e, b.tabsize), n(a))
            }, this.untab = function() {
                var a = k.create();
                a.isCollapsed() && a.isOnCell() && c.tab(a, !0)
            }, this.insertParagraph = function(a) {
                l(a), d.insertParagraph(a), n(a)
            }, this.insertOrderedList = function(a) {
                l(a), f.insertOrderedList(a), n(a)
            }, this.insertUnorderedList = function(a) {
                l(a), f.insertUnorderedList(a), n(a)
            }, this.indent = function(a) {
                l(a), f.indent(a), n(a)
            }, this.outdent = function(a) {
                l(a), f.outdent(a), n(a)
            }, this.insertImage = function(a, b, c) {
                m.createImage(b, c).then(function(b) {
                    l(a), b.css({
                        "display": "",
                        "width": Math.min(a.width(), b.width())
                    }), k.create().insertNode(b[0]), k.createFromNode(b[0]).collapse().select(), n(a)
                }).fail(function() {
                    var b = a.data("callbacks");
                    b.onImageUploadError && b.onImageUploadError()
                })
            }, this.insertNode = function(a, b) {
                l(a);
                var c = this.createRange(a);
                c.insertNode(b), k.createFromNode(b).collapse().select(), n(a)
            }, this.insertText = function(a, b) {
                l(a);
                var c = this.createRange(a),
                    d = c.insertNode(j.createText(b));
                k.create(d, j.nodeLength(d)).select(), n(a)
            }, this.formatBlock = function(a, b) {
                l(a), b = e.isMSIE ? "<" + b + ">" : b, document.execCommand("FormatBlock", !1, b), n(a)
            }, this.formatPara = function(a) {
                l(a), this.formatBlock(a, "P"),
                    n(a)
            };
            for (var t = 1; 6 >= t; t++) this["formatH" + t] = function(a) {
                return function(b) {
                    this.formatBlock(b, "H" + a)
                }
            }(t);
            this.fontSize = function(c, d) {
                l(c);
                var e = this.createRange(c),
                    f = b.styleNodes(e);
                a.each(f, function(b, c) {
                    a(c).css({
                        "font-size": d + "px"
                    })
                }), n(c)
            }, this.lineHeight = function(a, c) {
                l(a), b.stylePara(k.create(), {
                    "lineHeight": c
                }), n(a)
            }, this.unlink = function(a) {
                var b = k.create();
                if (b.isOnAnchor()) {
                    var c = j.ancestor(b.sc, j.isAnchor);
                    b = k.createFromNode(c), b.select(), l(a), document.execCommand("unlink"), n(a)
                }
            }, this.createLink = function(c, d, e) {
                var f = d.url,
                    h = d.text,
                    i = d.newWindow,
                    j = d.range,
                    m = j.toString() !== h;
                l(c), e.onCreateLink && (f = e.onCreateLink(f));
                var o;
                if (m) {
                    var p = j.insertNode(a("<A>" + h + "</A>")[0]);
                    o = [p]
                } else o = b.styleNodes(j, {
                    "nodeName": "A",
                    "expandClosestSibling": !0,
                    "onlyPartialContains": !0
                });
                a.each(o, function(b, c) {
                    a(c).attr("href", f), i ? a(c).attr("target", "_blank") : a(c).removeAttr("target")
                });
                var q = k.createFromNode(g.head(o)).collapse(!0),
                    r = q.getStartPoint(),
                    s = k.createFromNode(g.last(o)).collapse(),
                    t = s.getEndPoint();
                k.create(r.node, r.offset, t.node, t.offset).select(), n(c)
            }, this.getLinkInfo = function(b) {
                b.focus();
                var c = k.create().expand(j.isAnchor),
                    d = a(g.head(c.nodes(j.isAnchor)));
                return {
                    "range": c,
                    "text": c.toString(),
                    "isNewWindow": d.length ? "_blank" === d.attr("target") : !1,
                    "url": d.length ? d.attr("href") : ""
                }
            }, this.color = function(a, b) {
                var c = JSON.parse(b),
                    d = c.foreColor,
                    e = c.backColor;
                l(a), d && document.execCommand("foreColor", !1, d), e && document.execCommand("backColor", !1, e), n(a)
            }, this.insertTable = function(a, b) {
                var d = b.split("x");
                l(a);
                var e = k.create();
                e = e.deleteContents(), e.insertNode(c.createTable(d[0], d[1])), n(a)
            }, this.floatMe = function(a, b, c) {
                l(a), c.css("float", b), n(a)
            }, this.imageShape = function(a, b, c) {
                l(a), c.removeClass("img-rounded img-circle img-thumbnail"), b && c.addClass(b), n(a)
            }, this.resize = function(a, b, c) {
                l(a), c.css({
                    "width": 100 * b + "%",
                    "height": ""
                }), n(a)
            }, this.resizeTo = function(a, b, c) {
                var d;
                if (c) {
                    var e = a.y / a.x,
                        f = b.data("ratio");
                    d = {
                        "width": f > e ? a.x : a.y / f,
                        "height": f > e ? a.x * f : a.y
                    }
                } else d = {
                    "width": a.x,
                    "height": a.y
                };
                b.css(d)
            }, this.removeMedia = function(a, b, c) {
                l(a), c.detach();
                var d = a.data("callbacks");
                d && d.onMediaDelete && d.onMediaDelete(c, this, a), n(a)
            }, this.focus = function(a) {
                a.focus()
            }
        },
        u = function() {
            this.update = function(b, c) {
                var d = function(b, c) {
                        b.find(".dropdown-menu li a").each(function() {
                            var b = a(this).data("value") + "" == c + "";
                            this.className = b ? "checked" : ""
                        })
                    },
                    f = function(a, c) {
                        var d = b.find(a);
                        d.toggleClass("active", c())
                    };
                if (c.image) {
                    var g = a(c.image);
                    f('button[data-event="imageShape"][data-value="img-rounded"]', function() {
                        return g.hasClass("img-rounded")
                    }), f('button[data-event="imageShape"][data-value="img-circle"]', function() {
                        return g.hasClass("img-circle")
                    }), f('button[data-event="imageShape"][data-value="img-thumbnail"]', function() {
                        return g.hasClass("img-thumbnail")
                    }), f('button[data-event="imageShape"]:not([data-value])', function() {
                        return !g.is(".img-rounded, .img-circle, .img-thumbnail")
                    });
                    var h = g.css("float");
                    f('button[data-event="floatMe"][data-value="left"]', function() {
                        return "left" === h
                    }), f('button[data-event="floatMe"][data-value="right"]', function() {
                        return "right" === h
                    }), f('button[data-event="floatMe"][data-value="none"]', function() {
                        return "left" !== h && "right" !== h
                    });
                    var i = g.attr("style");
                    return f('button[data-event="resize"][data-value="1"]', function() {
                        return !!/(^|\s)(max-)?width\s*:\s*100%/.test(i)
                    }), f('button[data-event="resize"][data-value="0.5"]', function() {
                        return !!/(^|\s)(max-)?width\s*:\s*50%/.test(i)
                    }), void f('button[data-event="resize"][data-value="0.25"]', function() {
                        return !!/(^|\s)(max-)?width\s*:\s*25%/.test(i)
                    })
                }
                var j = b.find(".note-fontname");
                if (j.length) {
                    var k = c["font-family"];
                    if (k) {
                        for (var l = k.split(","), m = 0, n = l.length; n > m && (k = l[m].replace(/[\'\"]/g, "").replace(/\s+$/, "").replace(/^\s+/, ""), !e.isFontInstalled(k)); m++);
                        j.find(".note-current-fontname").text(k), d(j, k)
                    }
                }
                var o = b.find(".note-fontsize");
                o.find(".note-current-fontsize").text(c["font-size"]), d(o, parseFloat(c["font-size"]));
                var p = b.find(".note-height");
                d(p, parseFloat(c["line-height"])), f('button[data-event="bold"]', function() {
                    return "bold" === c["font-bold"]
                }), f('button[data-event="italic"]', function() {
                    return "italic" === c["font-italic"]
                }), f('button[data-event="underline"]', function() {
                    return "underline" === c["font-underline"]
                }), f('button[data-event="strikethrough"]', function() {
                    return "strikethrough" === c["font-strikethrough"]
                }), f('button[data-event="superscript"]', function() {
                    return "superscript" === c["font-superscript"]
                }), f('button[data-event="subscript"]', function() {
                    return "subscript" === c["font-subscript"]
                }), f('button[data-event="justifyLeft"]', function() {
                    return "left" === c["text-align"] || "start" === c["text-align"]
                }), f('button[data-event="justifyCenter"]', function() {
                    return "center" === c["text-align"]
                }), f('button[data-event="justifyRight"]', function() {
                    return "right" === c["text-align"]
                }), f('button[data-event="justifyFull"]', function() {
                    return "justify" === c["text-align"]
                }), f('button[data-event="insertUnorderedList"]', function() {
                    return "unordered" === c["list-style"]
                }), f('button[data-event="insertOrderedList"]', function() {
                    return "ordered" === c["list-style"]
                })
            }, this.updateRecentColor = function(b, c, d) {
                var e = a(b).closest(".note-color"),
                    f = e.find(".note-recent-color"),
                    g = JSON.parse(f.attr("data-value"));
                g[c] = d, f.attr("data-value", JSON.stringify(g));
                var h = "backColor" === c ? "background-color" : "color";
                f.find("i").css(h, d)
            }
        },
        v = function() {
            var a = new u;
            this.update = function(b, c) {
                a.update(b, c)
            }, this.updateRecentColor = function(b, c, d) {
                a.updateRecentColor(b, c, d)
            }, this.activate = function(a) {
                a.find("button").not('button[data-event="codeview"]').removeClass("disabled")
            }, this.deactivate = function(a) {
                a.find("button").not('button[data-event="codeview"]').addClass("disabled")
            }, this.updateFullscreen = function(a, b) {
                var c = a.find('button[data-event="fullscreen"]');
                c.toggleClass("active", b)
            }, this.updateCodeview = function(a, b) {
                var c = a.find('button[data-event="codeview"]');
                c.toggleClass("active", b), b ? this.deactivate(a) : this.activate(a)
            }, this.get = function(a, b) {
                var c = j.makeLayoutInfo(a).toolbar();
                return c.find("[data-name=" + b + "]")
            }, this.setButtonState = function(a, b, c) {
                c = c === !1 ? !1 : !0;
                var d = this.get(a, b);
                d.toggleClass("active", c)
            }
        },
        w = 24,
        x = function() {
            var b = a(document);
            this.attach = function(a, b) {
                b.disableResizeEditor || a.statusbar().on("mousedown", c)
            };
            var c = function(a) {
                a.preventDefault(), a.stopPropagation();
                var c = j.makeLayoutInfo(a.target).editable(),
                    d = c.offset().top - b.scrollTop(),
                    e = j.makeLayoutInfo(a.currentTarget || a.target),
                    f = e.editor().data("options");
                b.on("mousemove", function(a) {
                    var b = a.clientY - (d + w);
                    b = f.minHeight > 0 ? Math.max(b, f.minHeight) : b, b = f.maxHeight > 0 ? Math.min(b, f.maxHeight) : b, c.height(b)
                }).one("mouseup", function() {
                    b.off("mousemove")
                })
            }
        },
        y = function() {
            var b = new u,
                c = function(b, c) {
                    var d = a(b),
                        e = c ? d.offset() : d.position(),
                        f = d.outerHeight(!0);
                    return {
                        "left": e.left,
                        "top": e.top + f
                    }
                },
                d = function(a, b) {
                    a.css({
                        "display": "block",
                        "left": b.left,
                        "top": b.top
                    })
                },
                e = 20;
            this.update = function(h, i, j) {
                b.update(h, i);
                var k = h.find(".note-link-popover");
                if (i.anchor) {
                    var l = k.find("a"),
                        m = a(i.anchor).attr("href"),
                        n = a(i.anchor).attr("target");
                    l.attr("href", m).html(m), n ? l.attr("target", "_blank") : l.removeAttr("target"), d(k, c(i.anchor, j))
                } else k.hide();
                var o = h.find(".note-image-popover");
                i.image ? d(o, c(i.image, j)) : o.hide();
                var p = h.find(".note-air-popover");
                if (j && !i.range.isCollapsed()) {
                    var q = g.last(i.range.getClientRects());
                    if (q) {
                        var r = f.rect2bnd(q);
                        d(p, {
                            "left": Math.max(r.left + r.width / 2 - e, 0),
                            "top": r.top + r.height
                        })
                    }
                } else p.hide()
            }, this.updateRecentColor = function(a, b, c) {
                a.updateRecentColor(a, b, c)
            }, this.hide = function(a) {
                a.children().hide()
            }
        },
        z = function(b) {
            var c = a(document),
                d = function(d) {
                    if (j.isControlSizing(d.target)) {
                        d.preventDefault(), d.stopPropagation();
                        var e = j.makeLayoutInfo(d.target),
                            f = e.handle(),
                            g = e.popover(),
                            h = e.editable(),
                            i = e.editor(),
                            k = f.find(".note-control-selection").data("target"),
                            l = a(k),
                            m = l.offset(),
                            n = c.scrollTop(),
                            o = i.data("options").airMode;
                        c.on("mousemove", function(a) {
                            b.invoke("editor.resizeTo", {
                                "x": a.clientX - m.left,
                                "y": a.clientY - (m.top - n)
                            }, l, !a.shiftKey), b.invoke("handle.update", f, {
                                "image": k
                            }, o), b.invoke("popover.update", g, {
                                "image": k
                            }, o)
                        }).one("mouseup", function() {
                            c.off("mousemove"), b.invoke("editor.afterCommand", h)
                        }), l.data("ratio") || l.data("ratio", l.height() / l.width())
                    }
                };
            this.attach = function(a) {
                a.handle().on("mousedown", d)
            }, this.update = function(b, c, d) {
                var e = b.find(".note-control-selection");
                if (c.image) {
                    var f = a(c.image),
                        g = d ? f.offset() : f.position(),
                        h = {
                            "w": f.outerWidth(!0),
                            "h": f.outerHeight(!0)
                        };
                    e.css({
                        "display": "block",
                        "left": g.left,
                        "top": g.top,
                        "width": h.w,
                        "height": h.h
                    }).data("target", c.image);
                    var i = h.w + "x" + h.h;
                    e.find(".note-control-selection-info").text(i)
                } else e.hide()
            }, this.hide = function(a) {
                a.children().hide()
            }
        },
        A = function(b) {
            var c = a(window),
                d = a("html, body");
            this.toggle = function(a) {
                var e = a.editor(),
                    f = a.toolbar(),
                    g = a.editable(),
                    h = a.codable(),
                    i = function(a) {
                        g.css("height", a.h), h.css("height", a.h), h.data("cmeditor") && h.data("cmeditor").setsize(null, a.h)
                    };
                e.toggleClass("fullscreen");
                var j = e.hasClass("fullscreen");
                j ? (g.data("orgheight", g.css("height")), c.on("resize", function() {
                    i({
                        "h": c.height() - f.outerHeight()
                    })
                }).trigger("resize"), d.css("overflow", "hidden")) : (c.off("resize"), i({
                    "h": g.data("orgheight")
                }), d.css("overflow", "visible")), b.invoke("toolbar.updateFullscreen", f, j)
            }
        };
    e.hasCodeMirror && (e.isSupportAmd ? require(["CodeMirror"], function(a) {
        b = a
    }) : b = window.CodeMirror);
    var B = function(a) {
            this.sync = function(b) {
                var c = a.invoke("codeview.isActivated", b);
                c && e.hasCodeMirror && b.codable().data("cmEditor").save()
            }, this.isActivated = function(a) {
                var b = a.editor();
                return b.hasClass("codeview")
            }, this.toggle = function(a) {
                this.isActivated(a) ? this.deactivate(a) : this.activate(a)
            }, this.activate = function(c) {
                var d = c.editor(),
                    f = c.toolbar(),
                    g = c.editable(),
                    h = c.codable(),
                    i = c.popover(),
                    k = c.handle(),
                    l = d.data("options");
                if (h.val(j.html(g, l.prettifyHtml)), h.height(g.height()), a.invoke("toolbar.updateCodeview", f, !0), a.invoke("popover.hide", i), a.invoke("handle.hide", k), d.addClass("codeview"), h.focus(), e.hasCodeMirror) {
                    var m = b.fromTextArea(h[0], l.codemirror);
                    if (l.codemirror.tern) {
                        var n = new b.TernServer(l.codemirror.tern);
                        m.ternServer = n, m.on("cursorActivity", function(a) {
                            n.updateArgHints(a)
                        })
                    }
                    m.setSize(null, g.outerHeight()), h.data("cmEditor", m)
                }
            }, this.deactivate = function(b) {
                var c = b.editor(),
                    d = b.toolbar(),
                    f = b.editable(),
                    g = b.codable(),
                    h = c.data("options");
                if (e.hasCodeMirror) {
                    var i = g.data("cmEditor");
                    g.val(i.getValue()), i.toTextArea()
                }
                f.html(j.value(g, h.prettifyHtml) || j.emptyPara), f.height(h.height ? g.height() : "auto"), c.removeClass("codeview"), f.focus(), a.invoke("toolbar.updateCodeview", d, !1)
            }
        },
        C = function(b) {
            var c = a(document);
            this.attach = function(a, b) {
                b.airMode || b.disableDragAndDrop ? c.on("drop", function(a) {
                    a.preventDefault()
                }) : this.attachDragAndDropEvent(a, b)
            }, this.attachDragAndDropEvent = function(d, e) {
                var f = a(),
                    g = d.editor(),
                    h = d.dropzone(),
                    i = h.find(".note-dropzone-message");
                c.on("dragenter", function(a) {
                    var c = b.invoke("codeview.isActivated", d),
                        j = g.width() > 0 && g.height() > 0;
                    c || f.length || !j || (g.addClass("dragover"), h.width(g.width()), h.height(g.height()), i.text(e.langInfo.image.dragImageHere)), f = f.add(a.target)
                }).on("dragleave", function(a) {
                    f = f.not(a.target), f.length || g.removeClass("dragover")
                }).on("drop", function() {
                    f = a(), g.removeClass("dragover")
                }), h.on("dragenter", function() {
                    h.addClass("hover"), i.text(e.langInfo.image.dropImage)
                }).on("dragleave", function() {
                    h.removeClass("hover"), i.text(e.langInfo.image.dragImageHere)
                }), h.on("drop", function(c) {
                    c.preventDefault();
                    var d = c.originalEvent.dataTransfer,
                        e = d.getData("text/html"),
                        f = d.getData("text/plain"),
                        g = j.makeLayoutInfo(c.currentTarget || c.target);
                    d && d.files && d.files.length ? (g.editable().focus(), b.insertImages(g, d.files)) : e ? a(e).each(function() {
                        g.editable().focus(), b.invoke("editor.insertNode", g.editable(), this)
                    }) : f && (g.editable().focus(), b.invoke("editor.insertText", g.editable(), f))
                }).on("dragover", !1)
            }
        },
        D = function(b) {
            this.attach = function(a) {
                a.editable().on("paste", c)
            };
            var c = function(c) {
                var d = c.originalEvent.clipboardData,
                    e = j.makeLayoutInfo(c.currentTarget || c.target),
                    f = e.editable();
                if (!d || !d.items || !d.items.length) {
                    var h = f.data("callbacks");
                    if (!h.onImageUpload) return;
                    return b.invoke("editor.saveNode", f), b.invoke("editor.saveRange", f), f.html(""), void setTimeout(function() {
                        var c = f.find("img");
                        if (c.length && -1 !== c[0].src.indexOf("data:")) {
                            for (var d = c[0].src, g = atob(d.split(",")[1]), h = new Uint8Array(g.length), i = 0; i < g.length; i++) h[i] = g.charCodeAt(i);
                            var j = new Blob([h], {
                                "type": "image/png"
                            });
                            j.name = "clipboard.png", b.invoke("editor.restoreNode", f), b.invoke("editor.restoreRange", f), b.insertImages(e, [j]), b.invoke("editor.afterCommand", f)
                        } else {
                            var k = f.html();
                            b.invoke("editor.restoreNode", f), b.invoke("editor.restoreRange", f);
                            try {
                                a(k).each(function() {
                                    f.focus(), b.invoke("editor.insertNode", f, this)
                                })
                            } catch (l) {
                                f.focus(), b.invoke("editor.insertText", f, k)
                            }
                        }
                    }, 0)
                }
                var i = g.head(d.items),
                    k = "file" === i.kind && -1 !== i.type.indexOf("image/");
                k && b.insertImages(e, [i.getAsFile()]), b.invoke("editor.afterCommand", f)
            }
        },
        E = function(b) {
            var c = function(a, b) {
                a.toggleClass("disabled", !b), a.attr("disabled", !b)
            };
            this.showLinkDialog = function(b, d, e) {
                return a.Deferred(function(a) {
                    var b = d.find(".note-link-dialog"),
                        f = b.find(".note-link-text"),
                        g = b.find(".note-link-url"),
                        h = b.find(".note-link-btn"),
                        i = b.find("input[type=checkbox]");
                    b.one("shown.bs.modal", function() {
                        f.val(e.text), f.on("input", function() {
                            e.text = f.val()
                        }), e.url || (e.url = e.text, c(h, e.text)), g.on("input", function() {
                            c(h, g.val()), e.text || f.val(g.val())
                        }).val(e.url).trigger("focus").trigger("select"), i.prop("checked", e.newWindow), h.one("click", function(c) {
                            c.preventDefault(), a.resolve({
                                "range": e.range,
                                "url": g.val(),
                                "text": f.val(),
                                "newWindow": i.is(":checked")
                            }), b.modal("hide")
                        })
                    }).one("hidden.bs.modal", function() {
                        f.off("input"), g.off("input"), h.off("click"), "pending" === a.state() && a.reject()
                    }).modal("show")
                }).promise()
            }, this.show = function(a) {
                var c = a.editor(),
                    d = a.dialog(),
                    e = a.editable(),
                    f = a.popover(),
                    g = b.invoke("editor.getLinkInfo", e),
                    h = c.data("options");
                b.invoke("editor.saveRange", e), this.showLinkDialog(e, d, g).then(function(a) {
                    b.invoke("editor.restoreRange", e), b.invoke("editor.createLink", e, a, h), b.invoke("popover.hide", f)
                }).fail(function() {
                    b.invoke("editor.restoreRange", e)
                })
            }
        },
        F = function(b) {
            var c = function(a, b) {
                a.toggleClass("disabled", !b), a.attr("disabled", !b)
            };
            this.show = function(a) {
                var c = a.dialog(),
                    d = a.editable();
                b.invoke("editor.saveRange", d), this.showImageDialog(d, c).then(function(c) {
                    b.invoke("editor.restoreRange", d), "string" == typeof c ? b.invoke("editor.insertImage", d, c) : b.insertImages(a, c)
                }).fail(function() {
                    b.invoke("editor.restoreRange", d)
                })
            }, this.showImageDialog = function(b, d) {
                return a.Deferred(function(a) {
                    var b = d.find(".note-image-dialog"),
                        e = d.find(".note-image-input"),
                        f = d.find(".note-image-url"),
                        g = d.find(".note-image-btn");
                    b.one("shown.bs.modal", function() {
                        e.replaceWith(e.clone().on("change", function() {
                            a.resolve(this.files || this.value), b.modal("hide")
                        }).val("")), g.click(function(c) {
                            c.preventDefault(), a.resolve(f.val()), b.modal("hide")
                        }), f.on("keyup paste", function(a) {
                            var b;
                            b = "paste" === a.type ? a.originalEvent.clipboardData.getData("text") : f.val(), c(g, b)
                        }).val("").trigger("focus")
                    }).one("hidden.bs.modal", function() {
                        e.off("change"), f.off("keyup paste"), g.off("click"), "pending" === a.state() && a.reject()
                    }).modal("show")
                })
            }
        },
        G = function(b) {
            this.showHelpDialog = function(b, c) {
                return a.Deferred(function(a) {
                    var b = c.find(".note-help-dialog");
                    b.one("hidden.bs.modal", function() {
                        a.resolve()
                    }).modal("show")
                }).promise()
            }, this.show = function(a) {
                var c = a.dialog(),
                    d = a.editable();
                b.invoke("editor.saveRange", d, !0), this.showHelpDialog(d, c).then(function() {
                    b.invoke("editor.restoreRange", d)
                })
            }
        },
        H = function() {
            var b = this.modules = {
                "editor": new t(this),
                "toolbar": new v(this),
                "statusbar": new x(this),
                "popover": new y(this),
                "handle": new z(this),
                "fullscreen": new A(this),
                "codeview": new B(this),
                "dragAndDrop": new C(this),
                "clipboard": new D(this),
                "linkDialog": new E(this),
                "imageDialog": new F(this),
                "helpDialog": new G(this)
            };
            this.invoke = function() {
                var a = g.head(g.from(arguments)),
                    b = g.tail(g.from(arguments)),
                    c = a.split("."),
                    d = c.length > 1,
                    e = d && g.head(c),
                    f = d ? g.last(c) : g.head(c),
                    h = this.getModule(e),
                    i = h[f];
                return i && i.apply(h, b)
            }, this.getModule = function(a) {
                return this.modules[a] || this.modules.editor
            }, this.insertImages = function(c, d) {
                var e = c.editor(),
                    f = c.editable(),
                    g = c.holder(),
                    h = f.data("callbacks"),
                    i = e.data("options");
                h.onImageUpload ? (h.onImageUpload(d, b.editor, f), q(g, "image.upload")([d])) : a.each(d, function(a, c) {
                    var d = c.name;
                    i.maximumImageFileSize && i.maximumImageFileSize < c.size ? h.onImageUploadError ? (h.onImageUploadError(i.langInfo.image.maximumFileSizeError), q(g, "image.upload.error")(i.langInfo.image.maximumFileSizeError)) : alert(i.langInfo.image.maximumFileSizeError) : m.readFileAsDataURL(c).then(function(a) {
                        b.editor.insertImage(f, a, d)
                    }).fail(function() {
                        h.onImageUploadError && (h.onImageUploadError(), q(g, "image.upload.error")(i.langInfo.image.maximumFileSizeError))
                    })
                })
            };
            var c = {
                    "showLinkDialog": function(a) {
                        b.linkDialog.show(a)
                    },
                    "showImageDialog": function(a) {
                        b.imageDialog.show(a)
                    },
                    "showHelpDialog": function(a) {
                        b.helpDialog.show(a)
                    },
                    "fullscreen": function(a) {
                        b.fullscreen.toggle(a)
                    },
                    "codeview": function(a) {
                        b.codeview.toggle(a)
                    }
                },
                d = function(a) {
                    j.isImg(a.target) && a.preventDefault()
                },
                f = function(a) {
                    setTimeout(function() {
                        var c = j.makeLayoutInfo(a.currentTarget || a.target),
                            d = b.editor.currentStyle(a.target);
                        if (d) {
                            var e = c.editor().data("options").airMode;
                            e || b.toolbar.update(c.toolbar(), d), b.popover.update(c.popover(), d, e), b.handle.update(c.handle(), d, e)
                        }
                    }, 0)
                },
                h = function(a) {
                    var c = j.makeLayoutInfo(a.currentTarget || a.target);
                    b.popover.hide(c.popover()), b.handle.hide(c.handle())
                },
                i = function(b) {
                    var c = a(b.target).closest("[data-event]");
                    c.length && b.preventDefault()
                },
                k = function(d) {
                    var e = a(d.target).closest("[data-event]");
                    if (e.length) {
                        var h, i = e.attr("data-event"),
                            k = e.attr("data-value"),
                            l = e.attr("data-hide"),
                            m = j.makeLayoutInfo(d.target);
                        if (-1 !== a.inArray(i, ["resize", "floatMe", "removeMedia", "imageShape"])) {
                            var n = m.handle().find(".note-control-selection");
                            h = a(n.data("target"))
                        }
                        if (l && e.parents(".popover").hide(), a.isFunction(a.summernote.pluginEvents[i])) a.summernote.pluginEvents[i](d, b.editor, m, k);
                        else if (b.editor[i]) {
                            var o = m.editable();
                            o.focus(), b.editor[i](o, k, h), d.preventDefault()
                        } else c[i] && (c[i].call(this, m), d.preventDefault());
                        if (-1 !== a.inArray(i, ["backColor", "foreColor"])) {
                            var p = m.editor().data("options", p),
                                q = p.airMode ? b.popover : b.toolbar;
                            q.updateRecentColor(g.head(e), i, k)
                        }
                        f(d)
                    }
                },
                l = 18,
                p = function(b, c) {
                    var d, e = a(b.target.parentNode),
                        f = e.next(),
                        g = e.find(".note-dimension-picker-mousecatcher"),
                        h = e.find(".note-dimension-picker-highlighted"),
                        i = e.find(".note-dimension-picker-unhighlighted");
                    if (void 0 === b.offsetX) {
                        var j = a(b.target).offset();
                        d = {
                            "x": b.pageX - j.left,
                            "y": b.pageY - j.top
                        }
                    } else d = {
                        "x": b.offsetX,
                        "y": b.offsetY
                    };
                    var k = {
                        "c": Math.ceil(d.x / l) || 1,
                        "r": Math.ceil(d.y / l) || 1
                    };
                    h.css({
                        "width": k.c + "em",
                        "height": k.r + "em"
                    }), g.attr("data-value", k.c + "x" + k.r), 3 < k.c && k.c < c.insertTableMaxSize.col && i.css({
                        "width": k.c + 1 + "em"
                    }), 3 < k.r && k.r < c.insertTableMaxSize.row && i.css({
                        "height": k.r + 1 + "em"
                    }), f.html(k.c + " x " + k.r)
                },
                q = function(a, b) {
                    return function() {
                        return a.trigger("summernote." + b, arguments)
                    }
                };
            this.bindKeyMap = function(d, e) {
                var f = d.editor(),
                    g = d.editable();
                g.on("keydown", function(h) {
                    var i = [];
                    h.metaKey && i.push("CMD"), h.ctrlKey && !h.altKey && i.push("CTRL"), h.shiftKey && i.push("SHIFT");
                    var j = n.nameFromCode[h.keyCode];
                    j && i.push(j);
                    var k = e[i.join("+")];
                    if (k)
                        if (a.summernote.pluginEvents[k]) {
                            var l = a.summernote.pluginEvents[k];
                            a.isFunction(l) && l(h, b.editor, d)
                        } else b.editor[k] ? (b.editor[k](g, f.data("options")), h.preventDefault()) : c[k] && (c[k].call(this, d), h.preventDefault());
                    else n.isEdit(h.keyCode) && b.editor.afterCommand(g)
                })
            }, this.attach = function(a, c) {
                c.shortcuts && this.bindKeyMap(a, c.keyMap[e.isMac ? "mac" : "pc"]), a.editable().on("mousedown", d), a.editable().on("keyup mouseup", f), a.editable().on("scroll", h), b.clipboard.attach(a, c), b.handle.attach(a, c), a.popover().on("click", k), a.popover().on("mousedown", i), b.dragAndDrop.attach(a, c), c.airMode || (a.toolbar().on("click", k), a.toolbar().on("mousedown", i), b.statusbar.attach(a, c));
                var l = c.airMode ? a.popover() : a.toolbar(),
                    m = l.find(".note-dimension-picker-mousecatcher");
                m.css({
                    "width": c.insertTableMaxSize.col + "em",
                    "height": c.insertTableMaxSize.row + "em"
                }).on("mousemove", function(a) {
                    p(a, c)
                }), a.editor().data("options", c), e.isMSIE || setTimeout(function() {
                    document.execCommand("styleWithCSS", 0, c.styleWithSpan)
                }, 0);
                var q = new o(a.editable());
                if (a.editable().data("NoteHistory", q), c.onenter && a.editable().keypress(function(a) {
                        a.keyCode === n.ENTER && c.onenter(a)
                    }), c.onfocus && a.editable().focus(c.onfocus), c.onblur && a.editable().blur(c.onblur), c.onkeyup && a.editable().keyup(c.onkeyup), c.onkeydown && a.editable().keydown(c.onkeydown), c.onpaste && a.editable().on("paste", c.onpaste), c.onToolbarClick && a.toolbar().click(c.onToolbarClick), c.onChange) {
                    var r = function() {
                        b.editor.triggerOnChange(a.editable())
                    };
                    if (e.isMSIE) {
                        var s = "DOMCharacterDataModified DOMSubtreeModified DOMNodeInserted";
                        a.editable().on(s, r)
                    } else a.editable().on("input", r)
                }
                a.editable().data("callbacks", {
                    "onBeforeChange": c.onBeforeChange,
                    "onChange": c.onChange,
                    "onAutoSave": c.onAutoSave,
                    "onImageUpload": c.onImageUpload,
                    "onImageUploadError": c.onImageUploadError,
                    "onFileUpload": c.onFileUpload,
                    "onFileUploadError": c.onFileUpload,
                    "onMediaDelete": c.onMediaDelete
                }), j.isTextarea(g.head(a.holder())) && a.holder().closest("form").submit(function() {
                    var b = a.holder().code();
                    a.holder().val(b), c.onsubmit && c.onsubmit(b)
                })
            }, this.attachCustomEvent = function(b, c) {
                var d = b.holder(),
                    f = b.editable();
                if (f.on("mousedown", q(d, "mousedown")), f.on("keyup mouseup", q(d, "update")), f.on("scroll", q(d, "scroll")), f.keypress(function(a) {
                        a.keyCode === n.ENTER && q(d, "enter").call(this, a)
                    }), f.focus(q(d, "focus")), f.blur(q(d, "blur")), f.keyup(q(d, "keyup")), f.keydown(q(d, "keydown")), f.on("paste", q(d, "paste")), c.airMode || (b.toolbar().click(q(d, "toolbar.click")), b.popover().click(q(d, "popover.click"))), e.isMSIE) {
                    var h = "DOMCharacterDataModified DOMSubtreeModified DOMNodeInserted";
                    f.on(h, q(d, "change"))
                } else f.on("input", q(d, "change"));
                j.isTextarea(g.head(d)) && d.closest("form").submit(function(a) {
                    var b = d.code();
                    q(d, "submit").call(this, a, b)
                }), q(d, "init")();
                for (var i = 0, k = a.summernote.plugins.length; k > i; i++) a.isFunction(a.summernote.plugins[i].init) && a.summernote.plugins[i].init(b)
            }, this.detach = function(a, b) {
                a.holder().off(), a.editable().off(), a.popover().off(), a.handle().off(), a.dialog().off(), b.airMode || (a.dropzone().off(), a.toolbar().off(), a.statusbar().off())
            }
        },
        I = function() {
            var b = function(a, b) {
                    var c = b.event,
                        d = b.value,
                        e = b.title,
                        f = b.className,
                        g = b.dropdown,
                        h = b.hide;
                    return '<button type="button" class="btn btn-default btn-sm btn-small' + (f ? " " + f : "") + (g ? " dropdown-toggle" : "") + '"' + (g ? ' data-toggle="dropdown"' : "") + (e ? ' title="' + e + '"' : "") + (c ? ' data-event="' + c + '"' : "") + (d ? " data-value='" + d + "'" : "") + (h ? " data-hide='" + h + "'" : "") + ' tabindex="-1">' + a + (g ? ' <span class="caret"></span>' : "") + "</button>" + (g || "")
                },
                c = function(a, c) {
                    var d = '<i class="' + a + '"></i>';
                    return b(d, c)
                },
                d = function(b, c) {
                    var d = a('<div class="' + b + ' popover bottom in" style="display: none;"><div class="arrow"></div><div class="popover-content"></div></div>');
                    return d.find(".popover-content").append(c), d
                },
                g = function(a, b, c, d) {
                    return '<div class="' + a + ' modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content">' + (b ? '<div class="modal-header"><button type="button" class="close" aria-hidden="true" tabindex="-1">&times;</button><h4 class="modal-title">' + b + "</h4></div>" : "") + '<form class="note-modal-form"><div class="modal-body">' + c + "</div>" + (d ? '<div class="modal-footer">' + d + "</div>" : "") + "</form></div></div></div>"
                },
                h = {
                    "picture": function(a, b) {
                        return c(b.iconPrefix + "picture-o", {
                            "event": "showImageDialog",
                            "title": a.image.image,
                            "hide": !0
                        })
                    },
                    "link": function(a, b) {
                        return c(b.iconPrefix + "link", {
                            "event": "showLinkDialog",
                            "title": a.link.link,
                            "hide": !0
                        })
                    },
                    "table": function(a, b) {
                        var d = '<ul class="note-table dropdown-menu"><div class="note-dimension-picker"><div class="note-dimension-picker-mousecatcher" data-event="insertTable" data-value="1x1"></div><div class="note-dimension-picker-highlighted"></div><div class="note-dimension-picker-unhighlighted"></div></div><div class="note-dimension-display"> 1 x 1 </div></ul>';
                        return c(b.iconPrefix + "table", {
                            "title": a.table.table,
                            "dropdown": d
                        })
                    },
                    "style": function(a, b) {
                        var d = b.styleTags.reduce(function(b, c) {
                            var d = a.style["p" === c ? "normal" : c];
                            return b + '<li><a data-event="formatBlock" href="#" data-value="' + c + '">' + ("p" === c || "pre" === c ? d : "<" + c + ">" + d + "</" + c + ">") + "</a></li>"
                        }, "");
                        return c(b.iconPrefix + "magic", {
                            "title": a.style.style,
                            "dropdown": '<ul class="dropdown-menu">' + d + "</ul>"
                        })
                    },
                    "fontname": function(a, c) {
                        var d = [],
                            f = c.fontNames.reduce(function(a, b) {
                                return e.isFontInstalled(b) || -1 !== c.fontNamesIgnoreCheck.indexOf(b) ? (d.push(b), a + '<li><a data-event="fontName" href="#" data-value="' + b + '" style="font-family:\'' + b + '\'"><i class="' + c.iconPrefix + 'check"></i> ' + b + "</a></li>") : a
                            }, ""),
                            g = e.isFontInstalled(c.defaultFontName),
                            h = g ? c.defaultFontName : d[0],
                            i = '<span class="note-current-fontname">' + h + "</span>";
                        return b(i, {
                            "title": a.font.name,
                            "dropdown": '<ul class="dropdown-menu">' + f + "</ul>"
                        })
                    },
                    "color": function(a, c) {
                        var d = '<i class="' + c.iconPrefix + 'font" style="color:black;background-color:yellow;"></i>',
                            e = b(d, {
                                "className": "note-recent-color",
                                "title": a.color.recent,
                                "event": "color",
                                "value": '{"backColor":"yellow"}'
                            }),
                            f = '<ul class="dropdown-menu"><li><div class="btn-group"><div class="note-palette-title">' + a.color.background + '</div><div class="note-color-reset" data-event="backColor" data-value="inherit" title="' + a.color.transparent + '">' + a.color.setTransparent + '</div><div class="note-color-palette" data-target-event="backColor"></div></div><div class="btn-group"><div class="note-palette-title">' + a.color.foreground + '</div><div class="note-color-reset" data-event="foreColor" data-value="inherit" title="' + a.color.reset + '">' + a.color.resetToDefault + '</div><div class="note-color-palette" data-target-event="foreColor"></div></div></li></ul>',
                            g = b("", {
                                "title": a.color.more,
                                "dropdown": f
                            });
                        return e + g
                    },
                    "bold": function(a, b) {
                        return c(b.iconPrefix + "bold", {
                            "event": "bold",
                            "title": a.font.bold
                        })
                    },
                    "italic": function(a, b) {
                        return c(b.iconPrefix + "italic", {
                            "event": "italic",
                            "title": a.font.italic
                        })
                    },
                    "underline": function(a, b) {
                        return c(b.iconPrefix + "underline", {
                            "event": "underline",
                            "title": a.font.underline
                        })
                    },
                    "clear": function(a, b) {
                        return c(b.iconPrefix + "eraser", {
                            "event": "removeFormat",
                            "title": a.font.clear
                        })
                    },
                    "ul": function(a, b) {
                        return c(b.iconPrefix + "list-ul", {
                            "event": "insertUnorderedList",
                            "title": a.lists.unordered
                        })
                    },
                    "ol": function(a, b) {
                        return c(b.iconPrefix + "list-ol", {
                            "event": "insertOrderedList",
                            "title": a.lists.ordered
                        })
                    },
                    "paragraph": function(a, b) {
                        var d = c(b.iconPrefix + "align-left", {
                                "title": a.paragraph.left,
                                "event": "justifyLeft"
                            }),
                            e = c(b.iconPrefix + "align-center", {
                                "title": a.paragraph.center,
                                "event": "justifyCenter"
                            }),
                            f = c(b.iconPrefix + "align-right", {
                                "title": a.paragraph.right,
                                "event": "justifyRight"
                            }),
                            g = c(b.iconPrefix + "align-justify", {
                                "title": a.paragraph.justify,
                                "event": "justifyFull"
                            }),
                            h = c(b.iconPrefix + "outdent", {
                                "title": a.paragraph.outdent,
                                "event": "outdent"
                            }),
                            i = c(b.iconPrefix + "indent", {
                                "title": a.paragraph.indent,
                                "event": "indent"
                            }),
                            j = '<div class="dropdown-menu"><div class="note-align btn-group">' + d + e + f + g + '</div><div class="note-list btn-group">' + i + h + "</div></div>";
                        return c(b.iconPrefix + "align-left", {
                            "title": a.paragraph.paragraph,
                            "dropdown": j
                        })
                    },
                    "height": function(a, b) {
                        var d = b.lineHeights.reduce(function(a, c) {
                            return a + '<li><a data-event="lineHeight" href="#" data-value="' + parseFloat(c) + '"><i class="' + b.iconPrefix + 'check"></i> ' + c + "</a></li>"
                        }, "");
                        return c(b.iconPrefix + "text-height", {
                            "title": a.font.height,
                            "dropdown": '<ul class="dropdown-menu">' + d + "</ul>"
                        })
                    },
                    "help": function(a, b) {
                        return c(b.iconPrefix + "question", {
                            "event": "showHelpDialog",
                            "title": a.options.help,
                            "hide": !0
                        })
                    },
                    "fullscreen": function(a, b) {
                        return c(b.iconPrefix + "arrows-alt", {
                            "event": "fullscreen",
                            "title": a.options.fullscreen
                        })
                    },
                    "codeview": function(a, b) {
                        return c(b.iconPrefix + "code", {
                            "event": "codeview",
                            "title": a.options.codeview
                        })
                    },
                    "undo": function(a, b) {
                        return c(b.iconPrefix + "undo", {
                            "event": "undo",
                            "title": a.history.undo
                        })
                    },
                    "redo": function(a, b) {
                        return c(b.iconPrefix + "repeat", {
                            "event": "redo",
                            "title": a.history.redo
                        })
                    },
                    "hr": function(a, b) {
                        return c(b.iconPrefix + "minus", {
                            "event": "insertHorizontalRule",
                            "title": a.hr.insert
                        })
                    }
                },
                i = function(e, f) {
                    var g = function() {
                            var a = c(f.iconPrefix + "edit", {
                                    "title": e.link.edit,
                                    "event": "showLinkDialog",
                                    "hide": !0
                                }),
                                b = c(f.iconPrefix + "unlink", {
                                    "title": e.link.unlink,
                                    "event": "unlink"
                                }),
                                g = '<a href="http://www.google.com" target="_blank">www.google.com</a>&nbsp;&nbsp;<div class="note-insert btn-group">' + a + b + "</div>";
                            return d("note-link-popover", g)
                        },
                        i = function() {
                            var a = b('<span class="note-fontsize-10">100%</span>', {
                                    "title": e.image.resizeFull,
                                    "event": "resize",
                                    "value": "1"
                                }),
                                g = b('<span class="note-fontsize-10">50%</span>', {
                                    "title": e.image.resizeHalf,
                                    "event": "resize",
                                    "value": "0.5"
                                }),
                                h = b('<span class="note-fontsize-10">25%</span>', {
                                    "title": e.image.resizeQuarter,
                                    "event": "resize",
                                    "value": "0.25"
                                }),
                                i = c(f.iconPrefix + "align-left", {
                                    "title": e.image.floatLeft,
                                    "event": "floatMe",
                                    "value": "left"
                                }),
                                j = c(f.iconPrefix + "align-right", {
                                    "title": e.image.floatRight,
                                    "event": "floatMe",
                                    "value": "right"
                                }),
                                k = c(f.iconPrefix + "align-justify", {
                                    "title": e.image.floatNone,
                                    "event": "floatMe",
                                    "value": "none"
                                }),
                                l = c(f.iconPrefix + "square", {
                                    "title": e.image.shapeRounded,
                                    "event": "imageShape",
                                    "value": "img-rounded"
                                }),
                                m = c(f.iconPrefix + "circle-o", {
                                    "title": e.image.shapeCircle,
                                    "event": "imageShape",
                                    "value": "img-circle"
                                }),
                                n = c(f.iconPrefix + "picture-o", {
                                    "title": e.image.shapeThumbnail,
                                    "event": "imageShape",
                                    "value": "img-thumbnail"
                                }),
                                o = c(f.iconPrefix + "times", {
                                    "title": e.image.shapeNone,
                                    "event": "imageShape",
                                    "value": ""
                                }),
                                p = c(f.iconPrefix + "trash-o", {
                                    "title": e.image.remove,
                                    "event": "removeMedia",
                                    "value": "none"
                                }),
                                q = '<div class="btn-group">' + a + g + h + '</div><div class="btn-group">' + i + j + k + '</div><div class="btn-group">' + l + m + n + o + '</div><div class="btn-group">' + p + "</div>";
                            return d("note-image-popover", q)
                        },
                        j = function() {
                            for (var b = a("<div />"), c = 0, g = f.airPopover.length; g > c; c++) {
                                for (var i = f.airPopover[c], j = a('<div class="note-' + i[0] + ' btn-group">'), k = 0, l = i[1].length; l > k; k++) {
                                    var m = a(h[i[1][k]](e, f));
                                    m.attr("data-name", i[1][k]), j.append(m)
                                }
                                b.append(j)
                            }
                            return d("note-air-popover", b.children())
                        },
                        k = a('<div class="note-popover" />');
                    return k.append(g()), k.append(i()), f.airMode && k.append(j()), k
                },
                k = function() {
                    return '<div class="note-handle"><div class="note-control-selection"><div class="note-control-selection-bg"></div><div class="note-control-holder note-control-nw"></div><div class="note-control-holder note-control-ne"></div><div class="note-control-holder note-control-sw"></div><div class="note-control-sizing note-control-se"></div><div class="note-control-selection-info"></div></div></div>'
                },
                l = function(a, b) {
                    var c = "note-shortcut-col col-xs-6 note-shortcut-",
                        d = [];
                    for (var e in b) b.hasOwnProperty(e) && d.push('<div class="' + c + 'key">' + b[e].kbd + '</div><div class="' + c + 'name">' + b[e].text + "</div>");
                    return '<div class="note-shortcut-row row"><div class="' + c + 'title col-xs-offset-6">' + a + '</div></div><div class="note-shortcut-row row">' + d.join('</div><div class="note-shortcut-row row">') + "</div>"
                },
                m = function(a) {
                    var b = [{
                        "kbd": "\u2318 + B",
                        "text": a.font.bold
                    }, {
                        "kbd": "\u2318 + I",
                        "text": a.font.italic
                    }, {
                        "kbd": "\u2318 + U",
                        "text": a.font.underline
                    }, {
                        "kbd": "\u2318 + \\",
                        "text": a.font.clear
                    }];
                    return l(a.shortcut.textFormatting, b)
                },
                n = function(a) {
                    var b = [{
                        "kbd": "\u2318 + Z",
                        "text": a.history.undo
                    }, {
                        "kbd": "\u2318 + \u21e7 + Z",
                        "text": a.history.redo
                    }, {
                        "kbd": "\u2318 + ]",
                        "text": a.paragraph.indent
                    }, {
                        "kbd": "\u2318 + [",
                        "text": a.paragraph.outdent
                    }, {
                        "kbd": "\u2318 + ENTER",
                        "text": a.hr.insert
                    }];
                    return l(a.shortcut.action, b)
                },
                o = function(a) {
                    var b = [{
                        "kbd": "\u2318 + \u21e7 + L",
                        "text": a.paragraph.left
                    }, {
                        "kbd": "\u2318 + \u21e7 + E",
                        "text": a.paragraph.center
                    }, {
                        "kbd": "\u2318 + \u21e7 + R",
                        "text": a.paragraph.right
                    }, {
                        "kbd": "\u2318 + \u21e7 + J",
                        "text": a.paragraph.justify
                    }, {
                        "kbd": "\u2318 + \u21e7 + NUM7",
                        "text": a.lists.ordered
                    }, {
                        "kbd": "\u2318 + \u21e7 + NUM8",
                        "text": a.lists.unordered
                    }];
                    return l(a.shortcut.paragraphFormatting, b)
                },
                p = function(a) {
                    var b = [{
                        "kbd": "\u2318 + NUM0",
                        "text": a.style.normal
                    }, {
                        "kbd": "\u2318 + NUM1",
                        "text": a.style.h1
                    }, {
                        "kbd": "\u2318 + NUM2",
                        "text": a.style.h2
                    }, {
                        "kbd": "\u2318 + NUM3",
                        "text": a.style.h3
                    }, {
                        "kbd": "\u2318 + NUM4",
                        "text": a.style.h4
                    }, {
                        "kbd": "\u2318 + NUM5",
                        "text": a.style.h5
                    }, {
                        "kbd": "\u2318 + NUM6",
                        "text": a.style.h6
                    }];
                    return l(a.shortcut.documentStyle, b)
                },
                q = function(a, b) {
                    var c = b.extraKeys,
                        d = [];
                    for (var e in c) c.hasOwnProperty(e) && d.push({
                        "kbd": e,
                        "text": c[e]
                    });
                    return l(a.shortcut.extraKeys, d)
                },
                r = function(a, b) {
                    var c = 'class="note-shortcut note-shortcut-col col-sm-6 col-xs-12"',
                        d = ["<div " + c + ">" + n(a, b) + "</div><div " + c + ">" + m(a, b) + "</div>", "<div " + c + ">" + p(a, b) + "</div><div " + c + ">" + o(a, b) + "</div>"];
                    return b.extraKeys && d.push("<div " + c + ">" + q(a, b) + "</div>"), '<div class="note-shortcut-row row">' + d.join('</div><div class="note-shortcut-row row">') + "</div>"
                },
                s = function(a) {
                    return a.replace(/\u2318/g, "Ctrl").replace(/\u21e7/g, "Shift")
                },
                t = {
                    "image": function(a, b) {
                        var c = "";
                        if (b.maximumImageFileSize) {
                            var d = Math.floor(Math.log(b.maximumImageFileSize) / Math.log(1024)),
                                e = 1 * (b.maximumImageFileSize / Math.pow(1024, d)).toFixed(2) + " " + " KMGTP" [d] + "B";
                            c = "<small>" + a.image.maximumFileSize + " : " + e + "</small>"
                        }
                        var f = '<div class="form-group row-fluid note-group-select-from-files"><label>' + a.image.selectFromFiles + '</label><input class="note-image-input" type="file" name="files" accept="image/*" multiple="multiple" />' + c + '</div><div class="form-group row-fluid"><label>' + a.image.url + '</label><input class="note-image-url form-control span12" type="text" /></div>',
                            h = '<button href="#" class="btn btn-primary note-image-btn disabled" disabled>' + a.image.insert + "</button>";
                        return g("note-image-dialog", a.image.insert, f, h)
                    },
                    "link": function(a, b) {
                        var c = '<div class="form-group row-fluid"><label>' + a.link.textToDisplay + '</label><input class="note-link-text form-control span12" type="text" /></div><div class="form-group row-fluid"><label>' + a.link.url + '</label><input class="note-link-url form-control span12" type="text" /></div>' + (b.disableLinkTarget ? "" : '<div class="checkbox"><label><input type="checkbox" checked> ' + a.link.openInNewWindow + "</label></div>"),
                            d = '<button href="#" class="btn btn-primary note-link-btn disabled" disabled>' + a.link.insert + "</button>";
                        return g("note-link-dialog", a.link.insert, c, d)
                    },
                    "help": function(a, b) {
                        var c = '<a class="modal-close pull-right" aria-hidden="true" tabindex="-1">' + a.shortcut.close + '</a><div class="title">' + a.shortcut.shortcuts + "</div>" + (e.isMac ? r(a, b) : s(r(a, b))) + '<p class="text-center"><a href="//summernote.org/" target="_blank">Summernote 0.6.4</a> \xb7 <a href="//github.com/summernote/summernote" target="_blank">Project</a> \xb7 <a href="//github.com/summernote/summernote/issues" target="_blank">Issues</a></p>';
                        return g("note-help-dialog", "", c, "")
                    }
                },
                u = function(b, c) {
                    var d = "";
                    return a.each(t, function(a, e) {
                        d += e(b, c)
                    }), '<div class="note-dialog">' + d + "</div>"
                },
                v = function() {
                    return '<div class="note-resizebar"><div class="note-icon-bar"></div><div class="note-icon-bar"></div><div class="note-icon-bar"></div></div>'
                },
                w = function(a) {
                    return e.isMac && (a = a.replace("CMD", "\u2318").replace("SHIFT", "\u21e7")), a.replace("BACKSLASH", "\\").replace("SLASH", "/").replace("LEFTBRACKET", "[").replace("RIGHTBRACKET", "]")
                },
                x = function(b, c, d) {
                    var e = f.invertObject(c),
                        g = b.find("button");
                    g.each(function(b, c) {
                        var d = a(c),
                            f = e[d.data("event")];
                        f && d.attr("title", function(a, b) {
                            return b + " (" + w(f) + ")"
                        })
                    }).tooltip({
                        "container": "body",
                        "trigger": "hover",
                        "placement": d || "top"
                    }).on("click", function() {
                        a(this).tooltip("hide")
                    })
                },
                y = function(b, c) {
                    var d = c.colors;
                    b.find(".note-color-palette").each(function() {
                        for (var b = a(this), c = b.attr("data-target-event"), e = [], f = 0, g = d.length; g > f; f++) {
                            for (var h = d[f], i = [], j = 0, k = h.length; k > j; j++) {
                                var l = h[j];
                                i.push(['<button type="button" class="note-color-btn" style="background-color:', l, ';" data-event="', c, '" data-value="', l, '" title="', l, '" data-toggle="button" tabindex="-1"></button>'].join(""))
                            }
                            e.push('<div class="note-color-row">' + i.join("") + "</div>")
                        }
                        b.html(e.join(""))
                    })
                };
            this.createLayoutByAirMode = function(b, c) {
                var d = c.langInfo,
                    g = c.keyMap[e.isMac ? "mac" : "pc"],
                    h = f.uniqueId();
                b.addClass("note-air-editor note-editable"), b.attr({
                    "id": "note-editor-" + h,
                    "contentEditable": !0
                });
                var j = document.body,
                    l = a(i(d, c));
                l.addClass("note-air-layout"), l.attr("id", "note-popover-" + h), l.appendTo(j), x(l, g), y(l, c);
                var m = a(k());
                m.addClass("note-air-layout"), m.attr("id", "note-handle-" + h), m.appendTo(j);
                var n = a(u(d, c));
                n.addClass("note-air-layout"), n.attr("id", "note-dialog-" + h), n.find("button.close, a.modal-close").click(function() {
                    a(this).closest(".modal").modal("hide")
                }), n.appendTo(j)
            }, this.createLayoutByFrame = function(b, c) {
                var d = c.langInfo,
                    f = a('<div class="note-editor"></div>');
                c.width && f.width(c.width), c.height > 0 && a('<div class="note-statusbar">' + (c.disableResizeEditor ? "" : v()) + "</div>").prependTo(f);
                var g = !b.is(":disabled"),
                    l = a('<div class="note-editable" contentEditable="' + g + '"></div>').prependTo(f);
                c.height && l.height(c.height), c.direction && l.attr("dir", c.direction);
                var m = b.attr("placeholder") || c.placeholder;
                m && l.attr("data-placeholder", m), l.html(j.html(b)), a('<textarea class="note-codable"></textarea>').prependTo(f);
                for (var n = a('<div class="note-toolbar btn-toolbar" />'), o = 0, p = c.toolbar.length; p > o; o++) {
                    for (var q = c.toolbar[o][0], r = c.toolbar[o][1], s = a('<div class="note-' + q + ' btn-group" />'), t = 0, w = r.length; w > t; t++) {
                        var z = h[r[t]];
                        if (a.isFunction(z)) {
                            var A = a(z(d, c));
                            A.attr("data-name", r[t]), s.append(A)
                        }
                    }
                    n.append(s)
                }
                n.prependTo(f);
                var B = c.keyMap[e.isMac ? "mac" : "pc"];
                y(n, c), x(n, B, "bottom");
                var C = a(i(d, c)).prependTo(f);
                y(C, c), x(C, B), a(k()).prependTo(f);
                var D = a(u(d, c)).prependTo(f);
                D.find("button.close, a.modal-close").click(function() {
                    a(this).closest(".modal").modal("hide")
                }), a('<div class="note-dropzone"><div class="note-dropzone-message"></div></div>').prependTo(f), f.insertAfter(b), b.hide()
            }, this.hasNoteEditor = function(a) {
                return this.noteEditorFromHolder(a).length > 0
            }, this.noteEditorFromHolder = function(b) {
                return b.hasClass("note-air-editor") ? b : b.next().hasClass("note-editor") ? b.next() : a()
            }, this.createLayout = function(a, b) {
                b.airMode ? this.createLayoutByAirMode(a, b) : this.createLayoutByFrame(a, b)
            }, this.layoutInfoFromHolder = function(a) {
                var b = this.noteEditorFromHolder(a);
                if (b.length) return b.data("holder", a), j.buildLayoutInfo(b)
            }, this.removeLayout = function(a, b, c) {
                c.airMode ? (a.removeClass("note-air-editor note-editable").removeAttr("id contentEditable"), b.popover().remove(), b.handle().remove(), b.dialog().remove()) : (a.html(b.editable().html()), b.editor().remove(), a.show())
            }, this.getTemplate = function() {
                return {
                    "button": b,
                    "iconButton": c,
                    "dialog": g
                }
            }, this.addButtonInfo = function(a, b) {
                h[a] = b
            }, this.addDialogInfo = function(a, b) {
                t[a] = b
            }
        };
    a.summernote = a.summernote || {}, a.extend(a.summernote, l);
    var J = new I,
        K = new H;
    a.extend(a.summernote, {
        "renderer": J,
        "eventHandler": K,
        "core": {
            "agent": e,
            "dom": j,
            "range": k
        },
        "pluginEvents": {},
        "plugins": []
    }), a.summernote.addPlugin = function(b) {
        a.summernote.plugins.push(b), b.buttons && a.each(b.buttons, function(a, b) {
            J.addButtonInfo(a, b)
        }), b.dialogs && a.each(b.dialogs, function(a, b) {
            J.addDialogInfo(a, b)
        }), b.events && a.each(b.events, function(b, c) {
            a.summernote.pluginEvents[b] = c
        }), b.langs && a.each(b.langs, function(b, c) {
            a.summernote.lang[b] && a.extend(a.summernote.lang[b], c)
        }), b.options && a.extend(a.summernote.options, b.options)
    }, a.fn.extend({
        "summernote": function() {
            var b = a.type(g.head(arguments)),
                c = "string" === b,
                d = "object" === b,
                e = d ? g.head(arguments) : {};
            e = a.extend({}, a.summernote.options, e), e.langInfo = a.extend(!0, {}, a.summernote.lang["en-US"], a.summernote.lang[e.lang]), this.each(function(b, c) {
                var d = a(c);
                if (!J.hasNoteEditor(d)) {
                    J.createLayout(d, e);
                    var f = J.layoutInfoFromHolder(d);
                    K.attach(f, e), K.attachCustomEvent(f, e)
                }
            }), !c && this.length && e.oninit && e.oninit();
            var f = this.first();
            if (f.length) {
                var h = J.layoutInfoFromHolder(f);
                if (c) {
                    var i = g.head(g.from(arguments)),
                        j = g.tail(g.from(arguments)),
                        k = [i, h.editable()].concat(j);
                    return K.invoke.apply(K, k)
                }
                e.focus && h.editable().focus()
            }
            return this
        },
        "code": function(b) {
            if (void 0 === b) {
                var c = this.first();
                if (!c.length) return;
                var d = J.layoutInfoFromHolder(c),
                    e = d && d.editable();
                if (e && e.length) {
                    var f = K.invoke("codeview.isActivated", d);
                    return K.invoke("codeview.sync", d), f ? d.codable().val() : d.editable().html()
                }
                return j.isTextarea(c[0]) ? c.val() : c.html()
            }
            return this.each(function(c, d) {
                var e = J.layoutInfoFromHolder(a(d)),
                    f = e && e.editable();
                f && f.html(b)
            }), this
        },
        "destroy": function() {
            return this.each(function(b, c) {
                var d = a(c);
                if (J.hasNoteEditor(d)) {
                    var e = J.layoutInfoFromHolder(d),
                        f = e.editor().data("options");
                    K.detach(e, f), J.removeLayout(d, e, f)
                }
            }), this
        }
    })
});
    
