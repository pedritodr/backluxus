/*
 Highcharts JS v4.1.7 (2015-06-26)

 (c) 2011-2014 Torstein Honsi

 License: www.highcharts.com/license
 */
(function (h) {
    var n = h.Axis, r = h.Chart, k = h.Color, x = h.Legend, t = h.LegendSymbolMixin, u = h.Series, v = h.getOptions(), i = h.each, s = h.extend, y = h.extendClass, l = h.merge, m = h.pick, p = h.seriesTypes, w = h.wrap, o = function () {
    }, q = h.ColorAxis = function () {
        this.isColorAxis = !0;
        this.init.apply(this, arguments)
    };
    s(q.prototype, n.prototype);
    s(q.prototype, {
        defaultColorAxisOptions: {
            lineWidth: 0,
            gridLineWidth: 1,
            tickPixelInterval: 72,
            startOnTick: !0,
            endOnTick: !0,
            offset: 0,
            marker: {animation: {duration: 50}, color: "gray", width: 0.01},
            labels: {overflow: "justify"},
            minColor: "#EFEFFF",
            maxColor: "#003875",
            tickLength: 5
        }, init: function (a, b) {
            var d = a.options.legend.layout !== "vertical", c;
            c = l(this.defaultColorAxisOptions, {side: d ? 2 : 1, reversed: !d}, b, {
                isX: d,
                opposite: !d,
                showEmpty: !1,
                title: null,
                isColor: !0
            });
            n.prototype.init.call(this, a, c);
            b.dataClasses && this.initDataClasses(b);
            this.initStops(b);
            this.isXAxis = !0;
            this.horiz = d;
            this.zoomEnabled = !1
        }, tweenColors: function (a, b, d) {
            var c;
            !b.rgba.length || !a.rgba.length ? a = b.raw || "none" : (a = a.rgba, b = b.rgba, c = b[3] !== 1 || a[3] !== 1, a = (c ? "rgba(" :
                    "rgb(") + Math.round(b[0] + (a[0] - b[0]) * (1 - d)) + "," + Math.round(b[1] + (a[1] - b[1]) * (1 - d)) + "," + Math.round(b[2] + (a[2] - b[2]) * (1 - d)) + (c ? "," + (b[3] + (a[3] - b[3]) * (1 - d)) : "") + ")");
            return a
        }, initDataClasses: function (a) {
            var b = this, d = this.chart, c, e = 0, f = this.options, g = a.dataClasses.length;
            this.dataClasses = c = [];
            this.legendItems = [];
            i(a.dataClasses, function (a, h) {
                var i, a = l(a);
                c.push(a);
                if (!a.color)f.dataClassColor === "category" ? (i = d.options.colors, a.color = i[e++], e === i.length && (e = 0)) : a.color = b.tweenColors(k(f.minColor), k(f.maxColor),
                    g < 2 ? 0.5 : h / (g - 1))
            })
        }, initStops: function (a) {
            this.stops = a.stops || [[0, this.options.minColor], [1, this.options.maxColor]];
            i(this.stops, function (a) {
                a.color = k(a[1])
            })
        }, setOptions: function (a) {
            n.prototype.setOptions.call(this, a);
            this.options.crosshair = this.options.marker;
            this.coll = "colorAxis"
        }, setAxisSize: function () {
            var a = this.legendSymbol, b = this.chart, d, c, e;
            if (a)this.left = d = a.attr("x"), this.top = c = a.attr("y"), this.width = e = a.attr("width"), this.height = a = a.attr("height"), this.right = b.chartWidth - d - e, this.bottom =
                b.chartHeight - c - a, this.len = this.horiz ? e : a, this.pos = this.horiz ? d : c
        }, toColor: function (a, b) {
            var d, c = this.stops, e, f = this.dataClasses, g, j;
            if (f)for (j = f.length; j--;) {
                if (g = f[j], e = g.from, c = g.to, (e === void 0 || a >= e) && (c === void 0 || a <= c)) {
                    d = g.color;
                    if (b)b.dataClass = j;
                    break
                }
            } else {
                this.isLog && (a = this.val2lin(a));
                d = 1 - (this.max - a) / (this.max - this.min || 1);
                for (j = c.length; j--;)if (d > c[j][0])break;
                e = c[j] || c[j + 1];
                c = c[j + 1] || e;
                d = 1 - (c[0] - d) / (c[0] - e[0] || 1);
                d = this.tweenColors(e.color, c.color, d)
            }
            return d
        }, getOffset: function () {
            var a =
                this.legendGroup, b = this.chart.axisOffset[this.side];
            if (a) {
                n.prototype.getOffset.call(this);
                if (!this.axisGroup.parentGroup)this.axisGroup.add(a), this.gridGroup.add(a), this.labelGroup.add(a), this.added = !0, this.labelLeft = 0, this.labelRight = this.width;
                this.chart.axisOffset[this.side] = b
            }
        }, setLegendColor: function () {
            var a, b = this.options;
            a = this.reversed;
            a = this.horiz ? [+a, 0, +!a, 0] : [0, +!a, 0, +a];
            this.legendColor = {
                linearGradient: {x1: a[0], y1: a[1], x2: a[2], y2: a[3]},
                stops: b.stops || [[0, b.minColor], [1, b.maxColor]]
            }
        },
        drawLegendSymbol: function (a, b) {
            var d = a.padding, c = a.options, e = this.horiz, f = m(c.symbolWidth, e ? 200 : 12), g = m(c.symbolHeight, e ? 12 : 200), j = m(c.labelPadding, e ? 16 : 30), c = m(c.itemDistance, 10);
            this.setLegendColor();
            b.legendSymbol = this.chart.renderer.rect(0, a.baseline - 11, f, g).attr({zIndex: 1}).add(b.legendGroup);
            b.legendSymbol.getBBox();
            this.legendItemWidth = f + d + (e ? c : j);
            this.legendItemHeight = g + d + (e ? j : 0)
        }, setState: o, visible: !0, setVisible: o, getSeriesExtremes: function () {
            var a;
            if (this.series.length)a = this.series[0],
                this.dataMin = a.valueMin, this.dataMax = a.valueMax
        }, drawCrosshair: function (a, b) {
            var d = b && b.plotX, c = b && b.plotY, e, f = this.pos, g = this.len;
            if (b)e = this.toPixels(b[b.series.colorKey]), e < f ? e = f - 2 : e > f + g && (e = f + g + 2), b.plotX = e, b.plotY = this.len - e, n.prototype.drawCrosshair.call(this, a, b), b.plotX = d, b.plotY = c, this.cross && this.cross.attr({fill: this.crosshair.color}).add(this.legendGroup)
        }, getPlotLinePath: function (a, b, d, c, e) {
            return typeof e === "number" ? this.horiz ? ["M", e - 4, this.top - 6, "L", e + 4, this.top - 6, e, this.top, "Z"] : ["M",
                this.left, e, "L", this.left - 6, e + 6, this.left - 6, e - 6, "Z"] : n.prototype.getPlotLinePath.call(this, a, b, d, c)
        }, update: function (a, b) {
            var d = this.chart, c = d.legend;
            i(this.series, function (a) {
                a.isDirtyData = !0
            });
            if (a.dataClasses)i(c.allItems, function (a) {
                a.isDataClass && a.legendGroup.destroy()
            }), d.isDirtyLegend = !0;
            d.options[this.coll] = l(this.userOptions, a);
            n.prototype.update.call(this, a, b);
            this.legendItem && (this.setLegendColor(), c.colorizeItem(this, !0))
        }, getDataClassLegendSymbols: function () {
            var a = this, b = this.chart,
                d = this.legendItems, c = b.options.legend, e = c.valueDecimals, f = c.valueSuffix || "", g;
            d.length || i(this.dataClasses, function (c, n) {
                var k = !0, l = c.from, m = c.to;
                g = "";
                l === void 0 ? g = "< " : m === void 0 && (g = "> ");
                l !== void 0 && (g += h.numberFormat(l, e) + f);
                l !== void 0 && m !== void 0 && (g += " - ");
                m !== void 0 && (g += h.numberFormat(m, e) + f);
                d.push(s({
                    chart: b,
                    name: g,
                    options: {},
                    drawLegendSymbol: t.drawRectangle,
                    visible: !0,
                    setState: o,
                    isDataClass: !0,
                    setVisible: function () {
                        k = this.visible = !k;
                        i(a.series, function (a) {
                            i(a.points, function (a) {
                                a.dataClass ===
                                n && a.setVisible(k)
                            })
                        });
                        b.legend.colorizeItem(this, k)
                    }
                }, c))
            });
            return d
        }, name: ""
    });
    i(["fill", "stroke"], function (a) {
        HighchartsAdapter.addAnimSetter(a, function (b) {
            b.elem.attr(a, q.prototype.tweenColors(k(b.start), k(b.end), b.pos))
        })
    });
    w(r.prototype, "getAxes", function (a) {
        var b = this.options.colorAxis;
        a.call(this);
        this.colorAxis = [];
        b && new q(this, b)
    });
    w(x.prototype, "getAllItems", function (a) {
        var b = [], d = this.chart.colorAxis[0];
        d && (d.options.dataClasses ? b = b.concat(d.getDataClassLegendSymbols()) : b.push(d), i(d.series,
            function (a) {
                a.options.showInLegend = !1
            }));
        return b.concat(a.call(this))
    });
    r = {
        pointAttrToOptions: {
            stroke: "borderColor",
            "stroke-width": "borderWidth",
            fill: "color",
            dashstyle: "dashStyle"
        },
        pointArrayMap: ["value"],
        axisTypes: ["xAxis", "yAxis", "colorAxis"],
        optionalAxis: "colorAxis",
        trackerGroups: ["group", "markerGroup", "dataLabelsGroup"],
        getSymbol: o,
        parallelArrays: ["x", "y", "value"],
        colorKey: "value",
        translateColors: function () {
            var a = this, b = this.options.nullColor, d = this.colorAxis, c = this.colorKey;
            i(this.data, function (e) {
                var f =
                    e[c];
                if (f = f === null ? b : d && f !== void 0 ? d.toColor(f, e) : e.color || a.color)e.color = f
            })
        }
    };
    v.plotOptions.heatmap = l(v.plotOptions.scatter, {
        animation: !1,
        borderWidth: 0,
        nullColor: "#F8F8F8",
        dataLabels: {
            formatter: function () {
                return this.point.value
            }, inside: !0, verticalAlign: "middle", crop: !1, overflow: !1, padding: 0
        },
        marker: null,
        pointRange: null,
        tooltip: {pointFormat: "{point.x}, {point.y}: {point.value}<br/>"},
        states: {normal: {animation: !0}, hover: {halo: !1, brightness: 0.2}}
    });
    p.heatmap = y(p.scatter, l(r, {
        type: "heatmap",
        pointArrayMap: ["y",
            "value"],
        hasPointSpecificOptions: !0,
        supportsDrilldown: !0,
        getExtremesFromAll: !0,
        directTouch: !0,
        init: function () {
            var a;
            p.scatter.prototype.init.apply(this, arguments);
            a = this.options;
            this.pointRange = a.pointRange = m(a.pointRange, a.colsize || 1);
            this.yAxis.axisPointRange = a.rowsize || 1
        },
        translate: function () {
            var a = this.options, b = this.xAxis, d = this.yAxis;
            this.generatePoints();
            i(this.points, function (c) {
                var e = (a.colsize || 1) / 2, f = (a.rowsize || 1) / 2, g = Math.round(b.len - b.translate(c.x - e, 0, 1, 0, 1)), e = Math.round(b.len - b.translate(c.x +
                        e, 0, 1, 0, 1)), h = Math.round(d.translate(c.y - f, 0, 1, 0, 1)), f = Math.round(d.translate(c.y + f, 0, 1, 0, 1));
                c.plotX = c.clientX = (g + e) / 2;
                c.plotY = (h + f) / 2;
                c.shapeType = "rect";
                c.shapeArgs = {x: Math.min(g, e), y: Math.min(h, f), width: Math.abs(e - g), height: Math.abs(f - h)}
            });
            this.translateColors();
            this.chart.hasRendered && i(this.points, function (a) {
                a.shapeArgs.fill = a.options.color || a.color
            })
        },
        drawPoints: p.column.prototype.drawPoints,
        animate: o,
        getBox: o,
        drawLegendSymbol: t.drawRectangle,
        getExtremes: function () {
            u.prototype.getExtremes.call(this,
                this.valueData);
            this.valueMin = this.dataMin;
            this.valueMax = this.dataMax;
            u.prototype.getExtremes.call(this)
        }
    }))
})(Highcharts);
