(function (h) {
    function r() {
        return Array.prototype.slice.call(arguments, 1)
    }

    var s = h.pick, o = h.wrap, t = h.extend, p = HighchartsAdapter.fireEvent, n = h.Axis, u = h.Series;
    t(n.prototype, {
        isInBreak: function (f, d) {
            var a = f.repeat || Infinity, c = f.from, b = f.to - f.from, a = d >= c ? (d - c) % a : a - (c - d) % a;
            return f.inclusive ? a <= b : a < b && a !== 0
        }, isInAnyBreak: function (f, d) {
            var a = this.options.breaks, c = a && a.length, b, e, q;
            if (c) {
                for (; c--;)this.isInBreak(a[c], f) && (b = !0, e || (e = s(a[c].showPoints, this.isXAxis ? !1 : !0)));
                q = b && d ? b && !e : b
            }
            return q
        }
    });
    o(n.prototype,
        "setTickPositions", function (f) {
            f.apply(this, Array.prototype.slice.call(arguments, 1));
            if (this.options.breaks) {
                var d = this.tickPositions, a = this.tickPositions.info, c = [], b;
                if (!(a && a.totalRange >= this.closestPointRange)) {
                    for (b = 0; b < d.length; b++)this.isInAnyBreak(d[b]) || c.push(d[b]);
                    this.tickPositions = c;
                    this.tickPositions.info = a
                }
            }
        });
    o(n.prototype, "init", function (f, d, a) {
        if (a.breaks && a.breaks.length)a.ordinal = !1;
        f.call(this, d, a);
        if (this.options.breaks) {
            var c = this;
            c.doPostTranslate = !0;
            this.val2lin = function (b) {
                var e =
                    b, a, d;
                for (d = 0; d < c.breakArray.length; d++)if (a = c.breakArray[d], a.to <= b)e -= a.len; else if (a.from >= b)break; else if (c.isInBreak(a, b)) {
                    e -= b - a.from;
                    break
                }
                return e
            };
            this.lin2val = function (b) {
                var e, a;
                for (a = 0; a < c.breakArray.length; a++)if (e = c.breakArray[a], e.from >= b)break; else e.to < b ? b += e.len : c.isInBreak(e, b) && (b += e.len);
                return b
            };
            this.setExtremes = function (b, c, a, d, f) {
                for (; this.isInAnyBreak(b);)b -= this.closestPointRange;
                for (; this.isInAnyBreak(c);)c -= this.closestPointRange;
                n.prototype.setExtremes.call(this, b, c,
                    a, d, f)
            };
            this.setAxisTranslation = function (b) {
                n.prototype.setAxisTranslation.call(this, b);
                var a = c.options.breaks, b = [], d = [], f = 0, j, g, k = c.userMin || c.min, l = c.userMax || c.max, i, h;
                for (h in a)g = a[h], j = g.repeat || Infinity, c.isInBreak(g, k) && (k += g.to % j - k % j), c.isInBreak(g, l) && (l -= l % j - g.from % j);
                for (h in a) {
                    g = a[h];
                    i = g.from;
                    for (j = g.repeat || Infinity; i - j > k;)i -= j;
                    for (; i < k;)i += j;
                    for (; i < l; i += j)b.push({value: i, move: "in"}), b.push({
                        value: i + (g.to - g.from),
                        move: "out",
                        size: g.breakSize
                    })
                }
                b.sort(function (a, b) {
                    return a.value === b.value ?
                    (a.move === "in" ? 0 : 1) - (b.move === "in" ? 0 : 1) : a.value - b.value
                });
                a = 0;
                i = k;
                for (h in b) {
                    g = b[h];
                    a += g.move === "in" ? 1 : -1;
                    if (a === 1 && g.move === "in")i = g.value;
                    a === 0 && (d.push({
                        from: i,
                        to: g.value,
                        len: g.value - i - (g.size || 0)
                    }), f += g.value - i - (g.size || 0))
                }
                c.breakArray = d;
                p(c, "afterBreaks");
                c.transA *= (l - c.min) / (l - k - f);
                c.min = k;
                c.max = l
            }
        }
    });
    o(u.prototype, "generatePoints", function (f) {
        f.apply(this, r(arguments));
        var d = this.xAxis, a = this.yAxis, c = this.points, b, e = c.length, h = this.options.connectNulls, m;
        if (d && a && (d.options.breaks || a.options.breaks))for (; e--;)if (b =
                c[e], m = b.y === null && h === !1, !m && (d.isInAnyBreak(b.x, !0) || a.isInAnyBreak(b.y, !0)))c.splice(e, 1), this.data[e] && this.data[e].destroyElements()
    });
    o(h.seriesTypes.column.prototype, "drawPoints", function (f) {
        f.apply(this);
        var f = this.points, d = this.yAxis, a = d.breakArray || [], c, b, e, h, m;
        for (e = 0; e < f.length; e++) {
            c = f[e];
            m = c.stackY || c.y;
            for (h = 0; h < a.length; h++)if (b = a[h], m < b.from)break; else m > b.to ? p(d, "pointBreak", {
                point: c,
                brk: b
            }) : p(d, "pointInBreak", {point: c, brk: b})
        }
    })
})(Highcharts);
