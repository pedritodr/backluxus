/*
 Highcharts JS v4.1.7 (2015-06-26)

 (c) 2014 Highsoft AS
 Authors: Jon Arild Nygard / Oystein Moseng

 License: www.highcharts.com/license
 */
(function (g) {
    var i = g.seriesTypes, m = g.merge, s = g.extend, t = g.extendClass, u = g.getOptions().plotOptions, v = function () {
    }, j = g.each, x = HighchartsAdapter.grep, n = g.pick, q = g.Series, r = g.Color;
    u.treemap = m(u.scatter, {
        showInLegend: !1,
        marker: !1,
        borderColor: "#E0E0E0",
        borderWidth: 1,
        dataLabels: {
            enabled: !0, defer: !1, verticalAlign: "middle", formatter: function () {
                return this.point.name || this.point.id
            }, inside: !0
        },
        tooltip: {headerFormat: "", pointFormat: "<b>{point.name}</b>: {point.node.val}</b><br/>"},
        layoutAlgorithm: "sliceAndDice",
        layoutStartingDirection: "vertical",
        alternateStartingDirection: !1,
        levelIsConstant: !0,
        states: {hover: {borderColor: "#A0A0A0", brightness: i.heatmap ? 0 : 0.1, shadow: !1}},
        drillUpButton: {position: {align: "left", x: 10, y: -50}}
    });
    i.treemap = t(i.scatter, m({
        pointAttrToOptions: {
            stroke: "borderColor",
            "stroke-width": "borderWidth",
            fill: "color",
            dashstyle: "borderDashStyle"
        },
        pointArrayMap: ["value"],
        axisTypes: i.heatmap ? ["xAxis", "yAxis", "colorAxis"] : ["xAxis", "yAxis"],
        optionalAxis: "colorAxis",
        getSymbol: v,
        parallelArrays: ["x", "y",
            "value", "colorValue"],
        colorKey: "colorValue",
        translateColors: i.heatmap && i.heatmap.prototype.translateColors
    }, {
        type: "treemap",
        trackerGroups: ["group", "dataLabelsGroup"],
        pointClass: t(g.Point, {
            setState: function (a, b) {
                g.Point.prototype.setState.call(this, a, b);
                a === "hover" ? this.dataLabel && this.dataLabel.attr({zIndex: 1002}) : this.dataLabel && this.dataLabel.attr({zIndex: this.pointAttr[""].zIndex + 1})
            }, setVisible: i.pie.prototype.pointClass.prototype.setVisible
        }),
        handleLayout: function () {
            var a = this.tree, b;
            if (this.points.length)this.rootNode =
                n(this.rootNode, ""), a = this.tree = this.getTree(), this.levelMap = this.getLevels(), b = this.getSeriesArea(a.val), this.calculateChildrenAreas(a, b), this.setPointValues()
        },
        getTree: function () {
            var a, b = [], c = [], d = function (a) {
                j(b[a], function (a) {
                    b[""].push(a)
                })
            };
            this.nodeMap = [];
            j(this.points, function (a, d) {
                var h = "";
                c.push(a.id);
                if (a.parent !== void 0)h = a.parent;
                b[h] === void 0 && (b[h] = []);
                b[h].push(d)
            });
            for (a in b)b.hasOwnProperty(a) && a !== "" && HighchartsAdapter.inArray(a, c) === -1 && (d(a), delete b[a]);
            a = this.buildNode("",
                -1, 0, b, null);
            this.eachParents(this.nodeMap[this.rootNode], function (a) {
                a.visible = !0
            });
            this.eachChildren(this.nodeMap[this.rootNode], function (a) {
                a.visible = !0
            });
            this.setTreeValues(a);
            return a
        },
        buildNode: function (a, b, c, d, e) {
            var f = this, h = [], w = f.points[b], g;
            j(d[a] || [], function (b) {
                g = f.buildNode(f.points[b].id, b, c + 1, d, a);
                h.push(g)
            });
            b = {id: a, i: b, children: h, level: c, parent: e, visible: !1};
            f.nodeMap[b.id] = b;
            if (w)w.node = b;
            return b
        },
        setTreeValues: function (a) {
            var b = this, c = 0, d = [], e, f = b.points[a.i];
            j(a.children, function (a) {
                a =
                    b.setTreeValues(a);
                b.insertElementSorted(d, a, function (a, b) {
                    return a.val > b.val
                });
                a.ignore ? b.eachChildren(a, function (a) {
                    s(a, {ignore: !0, isLeaf: !1, visible: !1})
                }) : c += a.val
            });
            e = n(f && f.value, c);
            s(a, {
                children: d,
                childrenTotal: c,
                ignore: !(n(f && f.visible, !0) && e > 0),
                isLeaf: a.visible && !c,
                name: n(f && f.name, ""),
                val: e
            });
            return a
        },
        eachChildren: function (a, b) {
            var c = this, d = a.children;
            b(a);
            d.length && j(d, function (a) {
                c.eachChildren(a, b)
            })
        },
        eachParents: function (a, b) {
            var c = this.nodeMap[a.parent];
            b(a);
            c && this.eachParents(c, b)
        },
        calculateChildrenAreas: function (a, b) {
            var c = this, d = c.options, e = d.levelIsConstant ? a.level : a.level - this.nodeMap[this.rootNode].level, f = this.levelMap[e + 1], h = n(c[f && f.layoutAlgorithm] && f.layoutAlgorithm, d.layoutAlgorithm), g = d.alternateStartingDirection, p = [], k, d = x(a.children, function (a) {
                return !a.ignore
            });
            if (f && f.layoutStartingDirection)b.direction = f.layoutStartingDirection === "vertical" ? 0 : 1;
            p = c[h](b, d);
            j(d, function (a, d) {
                k = c.points[a.i];
                k.level = e + 1;
                a.values = m(p[d], {
                    val: a.childrenTotal, direction: g ? 1 - b.direction :
                        b.direction
                });
                a.children.length && c.calculateChildrenAreas(a, a.values)
            })
        },
        setPointValues: function () {
            var a = this, b = a.xAxis, c = a.yAxis;
            a.nodeMap[""].values = {x: 0, y: 0, width: 100, height: 100};
            j(a.points, function (d) {
                var e = d.node.values, f, h, g;
                e ? (e.x /= a.axisRatio, e.width /= a.axisRatio, f = Math.round(b.translate(e.x, 0, 0, 0, 1)), h = Math.round(b.translate(e.x + e.width, 0, 0, 0, 1)), g = Math.round(c.translate(e.y, 0, 0, 0, 1)), e = Math.round(c.translate(e.y + e.height, 0, 0, 0, 1)), d.shapeType = "rect", d.shapeArgs = {
                    x: Math.min(f, h), y: Math.min(g,
                        e), width: Math.abs(h - f), height: Math.abs(e - g)
                }, d.plotX = d.shapeArgs.x + d.shapeArgs.width / 2, d.plotY = d.shapeArgs.y + d.shapeArgs.height / 2) : (delete d.plotX, delete d.plotY)
            })
        },
        getSeriesArea: function (a) {
            var b = this.options.layoutStartingDirection === "vertical" ? 0 : 1, a = {
                x: 0,
                y: 0,
                width: 100 * (this.axisRatio = this.xAxis.len / this.yAxis.len),
                height: 100,
                direction: b,
                val: a
            };
            return this.nodeMap[""].values = a
        },
        getLevels: function () {
            var a = [], b = this.options.levels;
            b && j(b, function (b) {
                b.level !== void 0 && (a[b.level] = b)
            });
            return a
        },
        setColorRecursive: function (a,
                                     b) {
            var c = this, d, e;
            if (a) {
                d = c.points[a.i];
                e = c.levelMap[a.level];
                b = n(d && d.options.color, e && e.color, b);
                if (d)d.color = b;
                a.children.length && j(a.children, function (a) {
                    c.setColorRecursive(a, b)
                })
            }
        },
        alg_func_group: function (a, b, c, d) {
            this.height = a;
            this.width = b;
            this.plot = d;
            this.startDirection = this.direction = c;
            this.lH = this.nH = this.lW = this.nW = this.total = 0;
            this.elArr = [];
            this.lP = {
                total: 0, lH: 0, nH: 0, lW: 0, nW: 0, nR: 0, lR: 0, aspectRatio: function (a, b) {
                    return Math.max(a / b, b / a)
                }
            };
            this.addElement = function (a) {
                this.lP.total = this.elArr[this.elArr.length -
                1];
                this.total += a;
                this.direction === 0 ? (this.lW = this.nW, this.lP.lH = this.lP.total / this.lW, this.lP.lR = this.lP.aspectRatio(this.lW, this.lP.lH), this.nW = this.total / this.height, this.lP.nH = this.lP.total / this.nW, this.lP.nR = this.lP.aspectRatio(this.nW, this.lP.nH)) : (this.lH = this.nH, this.lP.lW = this.lP.total / this.lH, this.lP.lR = this.lP.aspectRatio(this.lP.lW, this.lH), this.nH = this.total / this.width, this.lP.nW = this.lP.total / this.nH, this.lP.nR = this.lP.aspectRatio(this.lP.nW, this.nH));
                this.elArr.push(a)
            };
            this.reset = function () {
                this.lW =
                    this.nW = 0;
                this.elArr = [];
                this.total = 0
            }
        },
        alg_func_calcPoints: function (a, b, c, d) {
            var e, f, h, g, p = c.lW, k = c.lH, l = c.plot, i, o = 0, n = c.elArr.length - 1;
            b ? (p = c.nW, k = c.nH) : i = c.elArr[c.elArr.length - 1];
            j(c.elArr, function (a) {
                if (b || o < n)c.direction === 0 ? (e = l.x, f = l.y, h = p, g = a / h) : (e = l.x, f = l.y, g = k, h = a / g), d.push({
                    x: e,
                    y: f,
                    width: h,
                    height: g
                }), c.direction === 0 ? l.y += g : l.x += h;
                o += 1
            });
            c.reset();
            c.direction === 0 ? c.width -= p : c.height -= k;
            l.y = l.parent.y + (l.parent.height - c.height);
            l.x = l.parent.x + (l.parent.width - c.width);
            if (a)c.direction = 1 -
                c.direction;
            b || c.addElement(i)
        },
        alg_func_lowAspectRatio: function (a, b, c) {
            var d = [], e = this, f, h = {
                x: b.x,
                y: b.y,
                parent: b
            }, g = 0, i = c.length - 1, k = new this.alg_func_group(b.height, b.width, b.direction, h);
            j(c, function (c) {
                f = b.width * b.height * (c.val / b.val);
                k.addElement(f);
                k.lP.nR > k.lP.lR && e.alg_func_calcPoints(a, !1, k, d, h);
                g === i && e.alg_func_calcPoints(a, !0, k, d, h);
                g += 1
            });
            return d
        },
        alg_func_fill: function (a, b, c) {
            var d = [], e, f = b.direction, h = b.x, g = b.y, i = b.width, k = b.height, l, n, o, m;
            j(c, function (c) {
                e = b.width * b.height * (c.val /
                    b.val);
                l = h;
                n = g;
                f === 0 ? (m = k, o = e / m, i -= o, h += o) : (o = i, m = e / o, k -= m, g += m);
                d.push({x: l, y: n, width: o, height: m});
                a && (f = 1 - f)
            });
            return d
        },
        strip: function (a, b) {
            return this.alg_func_lowAspectRatio(!1, a, b)
        },
        squarified: function (a, b) {
            return this.alg_func_lowAspectRatio(!0, a, b)
        },
        sliceAndDice: function (a, b) {
            return this.alg_func_fill(!0, a, b)
        },
        stripes: function (a, b) {
            return this.alg_func_fill(!1, a, b)
        },
        translate: function () {
            q.prototype.translate.call(this);
            this.handleLayout();
            this.colorAxis ? this.translateColors() : this.options.colorByPoint ||
            this.setColorRecursive(this.tree, void 0)
        },
        drawDataLabels: function () {
            var a = this, b = a.dataLabelsGroup, c, d;
            j(a.points, function (b) {
                d = a.levelMap[b.level];
                c = {style: {}};
                if (!b.node.isLeaf)c.enabled = !1;
                if (d && d.dataLabels)c = m(c, d.dataLabels), a._hasPointLabels = !0;
                if (b.shapeArgs)c.style.width = b.shapeArgs.width;
                b.dlOptions = m(c, b.options.dataLabels)
            });
            this.dataLabelsGroup = this.group;
            q.prototype.drawDataLabels.call(this);
            this.dataLabelsGroup = b
        },
        alignDataLabel: i.column.prototype.alignDataLabel,
        drawPoints: function () {
            var a =
                this, b = a.points, c = a.options, d, e, f;
            j(b, function (b) {
                f = a.levelMap[b.level];
                d = {
                    stroke: c.borderColor,
                    "stroke-width": c.borderWidth,
                    dashstyle: c.borderDashStyle,
                    r: 0,
                    fill: n(b.color, a.color)
                };
                if (f)d.stroke = f.borderColor || d.stroke, d["stroke-width"] = f.borderWidth || d["stroke-width"], d.dashstyle = f.borderDashStyle || d.dashstyle;
                d.stroke = b.borderColor || d.stroke;
                d["stroke-width"] = b.borderWidth || d["stroke-width"];
                d.dashstyle = b.borderDashStyle || d.dashstyle;
                d.zIndex = 1E3 - b.level * 2;
                b.pointAttr = m(b.pointAttr);
                e = b.pointAttr.hover;
                e.zIndex = 1001;
                e.fill = r(d.fill).brighten(c.states.hover.brightness).get();
                if (!b.node.isLeaf)n(c.interactByLeaf, !c.allowDrillToNode) ? (d.fill = "none", delete e.fill) : (d.fill = r(d.fill).setOpacity(0.15).get(), e.fill = r(e.fill).setOpacity(0.75).get());
                if (b.node.level <= a.nodeMap[a.rootNode].level)d.fill = "none", d.zIndex = 0, delete e.fill;
                b.pointAttr[""] = g.extend(b.pointAttr[""], d);
                b.dataLabel && b.dataLabel.attr({zIndex: b.pointAttr[""].zIndex + 1})
            });
            i.column.prototype.drawPoints.call(this);
            j(b, function (a) {
                a.graphic &&
                a.graphic.attr(a.pointAttr[""])
            });
            c.allowDrillToNode && a.drillTo()
        },
        insertElementSorted: function (a, b, c) {
            var d = 0, e = !1;
            a.length !== 0 && j(a, function (f) {
                c(b, f) && !e && (a.splice(d, 0, b), e = !0);
                d += 1
            });
            e || a.push(b)
        },
        drillTo: function () {
            var a = this;
            j(a.points, function (b) {
                var c, d;
                g.removeEvent(b, "click.drillTo");
                b.graphic && b.graphic.css({cursor: "default"});
                if (c = a.options.interactByLeaf ? a.drillToByLeaf(b) : a.drillToByGroup(b))d = a.nodeMap[a.rootNode].name || a.rootNode, b.graphic && b.graphic.css({cursor: "pointer"}), g.addEvent(b,
                    "click.drillTo", function () {
                        b.setState("");
                        a.drillToNode(c);
                        a.showDrillUpButton(d)
                    })
            })
        },
        drillToByGroup: function (a) {
            var b = !1;
            if (a.node.level - this.nodeMap[this.rootNode].level === 1 && !a.node.isLeaf)b = a.id;
            return b
        },
        drillToByLeaf: function (a) {
            var b = !1;
            if (a.node.parent !== this.rootNode && a.node.isLeaf)for (a = a.node; !b;)if (a = this.nodeMap[a.parent], a.parent === this.rootNode)b = a.id;
            return b
        },
        drillUp: function () {
            var a = null;
            this.rootNode && (a = this.nodeMap[this.rootNode], a = a.parent !== null ? this.nodeMap[a.parent] : this.nodeMap[""]);
            if (a !== null)this.drillToNode(a.id), a.id === "" ? this.drillUpButton = this.drillUpButton.destroy() : (a = this.nodeMap[a.parent], this.showDrillUpButton(a.name || a.id))
        },
        drillToNode: function (a) {
            var b = this.nodeMap[a].values;
            this.rootNode = a;
            this.xAxis.setExtremes(b.x, b.x + b.width, !1);
            this.yAxis.setExtremes(b.y, b.y + b.height, !1);
            this.isDirty = !0;
            this.chart.redraw()
        },
        showDrillUpButton: function (a) {
            var b = this, a = a || "< Back", c = b.options.drillUpButton, d, e;
            if (c.text)a = c.text;
            this.drillUpButton ? this.drillUpButton.attr({text: a}).align() :
                (e = (d = c.theme) && d.states, this.drillUpButton = this.chart.renderer.button(a, null, null, function () {
                    b.drillUp()
                }, d, e && e.hover, e && e.select).attr({
                    align: c.position.align,
                    zIndex: 9
                }).add().align(c.position, !1, c.relativeTo || "plotBox"))
        },
        buildKDTree: v,
        drawLegendSymbol: g.LegendSymbolMixin.drawRectangle,
        getExtremes: function () {
            q.prototype.getExtremes.call(this, this.colorValueData);
            this.valueMin = this.dataMin;
            this.valueMax = this.dataMax;
            q.prototype.getExtremes.call(this)
        },
        getExtremesFromAll: !0,
        bindAxes: function () {
            var a =
            {
                endOnTick: !1,
                gridLineWidth: 0,
                lineWidth: 0,
                min: 0,
                dataMin: 0,
                minPadding: 0,
                max: 100,
                dataMax: 100,
                maxPadding: 0,
                startOnTick: !1,
                title: null,
                tickPositions: []
            };
            q.prototype.bindAxes.call(this);
            g.extend(this.yAxis.options, a);
            g.extend(this.xAxis.options, a)
        }
    }))
})(Highcharts);
