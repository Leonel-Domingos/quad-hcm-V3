$(document).ready(function () {
        function a(a) {
            for (var b = [], c = 0;
                    360 >= c;
                    c += 10) {
                var d = (a + c) % 360;
                b.push({
                    "x": c, "y": Math.sin(Math.PI * d / 180).toFixed(4), "z": Math.cos(Math.PI * d / 180).toFixed(4)
                }
                )
            }
            return b
        }
        function b() {
            h++, i.setData(a(5 * h)), $("#reloadStatus").text(h + " reloads")
        }
        if ($("#sales-graph").length && Morris.Area({
            "element": "sales-graph", "data": [{
                    "period": "2010 Q1", "iphone": 2666, "ipad": null, "itouch": 2647
                }
                , {
                    "period": "2010 Q2", "iphone": 2778, "ipad": 2294, "itouch": 2441
                }
                , {
                    "period": "2010 Q3", "iphone": 4912, "ipad": 1969, "itouch": 2501
                }
                , {
                    "period": "2010 Q4", "iphone": 3767, "ipad": 3597, "itouch": 5689
                }
                , {
                    "period": "2011 Q1", "iphone": 6810, "ipad": 1914, "itouch": 2293
                }
                , {
                    "period": "2011 Q2", "iphone": 5670, "ipad": 4293, "itouch": 1881
                }
                , {
                    "period": "2011 Q3", "iphone": 4820, "ipad": 3795, "itouch": 1588
                }
                , {
                    "period": "2011 Q4", "iphone": 15073, "ipad": 5967, "itouch": 5175
                }
                , {
                    "period": "2012 Q1", "iphone": 10687, "ipad": 4460, "itouch": 2028
                }
                , {
                    "period": "2012 Q2", "iphone": 8432, "ipad": 5713, "itouch": 1791
                }
            ], "xkey": "period", "ykeys": ["iphone", "ipad", "itouch"], "labels": ["iPhone", "iPad", "iPod Touch"], "pointSize": 2, "hideHover": "auto"
        }
        ), $("#area-graph").length && Morris.Area({
            "element": "area-graph", "data": [{
                    "x": "2011 Q1", "y": 3, "z": 3
                }
                , {
                    "x": "2011 Q2", "y": 2, "z": 0
                }
                , {
                    "x": "2011 Q3", "y": 0, "z": 2
                }
                , {
                    "x": "2011 Q4", "y": 4, "z": 4
                }
            ], "xkey": "x", "ykeys": ["y", "z"], "labels": ["Y", "Z"]
        }
        ), $("#bar-graph").length && Morris.Bar({
            "element": "bar-graph", "data": [{
                    "x": "2011 Q1", "y": 0
                }
                , {
                    "x": "2011 Q2", "y": 1
                }
                , {
                    "x": "2011 Q3", "y": 2
                }
                , {
                    "x": "2011 Q4", "y": 3
                }
                , {
                    "x": "2012 Q1", "y": 4
                }
                , {
                    "x": "2012 Q2", "y": 5
                }
                , {
                    "x": "2012 Q3", "y": 6
                }
                , {
                    "x": "2012 Q4", "y": 7
                }
                , {
                    "x": "2013 Q1", "y": 8
                }
            ], "xkey": "x", "ykeys": ["y"], "labels": ["Y"], "barColors": function (a, b, c) {
                if ("bar" === c) {
                    var d = Math.ceil(255 * a.y / this.ymax);
                    return"rgb(" + d + ",0,0)"
                }
                return"#000"
            }
        }
        ), $("#normal-bar-graph").length && Morris.Bar({
            "element": "normal-bar-graph", "data": [{
                    "x": "2011 Q1", "y": 3, "z": 2, "a": 3
                }
                , {
                    "x": "2011 Q2", "y": 2, "z": null, "a": 1
                }
                , {
                    "x": "2011 Q3", "y": 0, "z": 2, "a": 4
                }
                , {
                    "x": "2011 Q4", "y": 2, "z": 4, "a": 3
                }
            ], "xkey": "x", "ykeys": ["y", "z", "a"], "labels": ["Y", "Z", "A"]
        }
        ), $("#noline-bar-graph").length && Morris.Bar({
            "element": "noline-bar-graph", "axes": !1, "data": [{
                    "x": "2011 Q1", "y": 3, "z": 2, "a": 3
                }
                , {
                    "x": "2011 Q2", "y": 2, "z": null, "a": 1
                }
                , {
                    "x": "2011 Q3", "y": 0, "z": 2, "a": 4
                }
                , {
                    "x": "2011 Q4", "y": 2, "z": 4, "a": 3
                }
            ], "xkey": "x", "ykeys": ["y", "z", "a"], "labels": ["Y", "Z", "A"]
        }
        ), $("#year-graph").length) {
            var c = [{
                    "period": "2012-10-01", "licensed": 3407, "sorned": 660
                }
                , {
                    "period": "2012-09-30", "licensed": 3351, "sorned": 629
                }
                , {
                    "period": "2012-09-29", "licensed": 3269, "sorned": 618
                }
                , {
                    "period": "2012-09-20", "licensed": 3246, "sorned": 661
                }
                , {
                    "period": "2012-09-19", "licensed": 3257, "sorned": 667
                }
                , {
                    "period": "2012-09-18", "licensed": 3248, "sorned": 627
                }
                , {
                    "period": "2012-09-17", "licensed": 3171, "sorned": 660
                }
                , {
                    "period": "2012-09-16", "licensed": 3171, "sorned": 676
                }
                , {
                    "period": "2012-09-15", "licensed": 3201, "sorned": 656
                }
                , {
                    "period": "2012-09-10", "licensed": 3215, "sorned": 622
                }
            ];
            Morris.Line({
                "element": "year-graph", "data": c, "xkey": "period", "ykeys": ["licensed", "sorned"], "labels": ["Licensed", "SORN"]
            }
            )
        }
        if ($("#decimal-graph").length) {
            for (var d = [], e = 0;
                    360 >= e;
                    e += 10)
                d.push({
                    "x": e, "y": Math.sin(Math.PI * e / 180).toFixed(4)
                }
                );
            window.m = Morris.Line({
                "element": "decimal-graph", "data": d, "xkey": "x", "ykeys": ["y"], "labels": ["sin(x)"], "parseTime": !1, "hoverCallback": function (a, b) {
                    var c = b.data[a];
                    return"sin(" + c.x + ") = " + c.y
                }
                , "xLabelMargin": 10
            }
            )
        }
        if ($("#donut-graph").length && Morris.Donut({
            "element": "donut-graph", "data": [{
                    "value": 70, "label": "foo"
                }
                , {
                    "value": 15, "label": "bar"
                }
                , {
                    "value": 10, "label": "baz"
                }
                , {
                    "value": 5, "label": "A really really long label"
                }
            ], "formatter": function (a) {
                return a + "%"
            }
        }
        ), $("#time-graph").length) {
            var f = [{
                    "period": "2011 W27", "licensed": 3407, "sorned": 660
                }
                , {
                    "period": "2011 W26", "licensed": 3351, "sorned": 629
                }
                , {
                    "period": "2011 W25", "licensed": 3269, "sorned": 618
                }
                , {
                    "period": "2011 W24", "licensed": 3246, "sorned": 661
                }
                , {
                    "period": "2011 W23", "licensed": 3257, "sorned": 667
                }
                , {
                    "period": "2011 W22", "licensed": 3248, "sorned": 627
                }
                , {
                    "period": "2011 W21", "licensed": 3171, "sorned": 660
                }
                , {
                    "period": "2011 W20", "licensed": 3171, "sorned": 676
                }
                , {
                    "period": "2011 W19", "licensed": 3201, "sorned": 656
                }
                , {
                    "period": "2011 W18", "licensed": 3215, "sorned": 622
                }
                , {
                    "period": "2011 W17", "licensed": 3148, "sorned": 632
                }
                , {
                    "period": "2011 W16", "licensed": 3155, "sorned": 681
                }
                , {
                    "period": "2011 W15", "licensed": 3190, "sorned": 667
                }
                , {
                    "period": "2011 W14", "licensed": 3226, "sorned": 620
                }
                , {
                    "period": "2011 W13", "licensed": 3245, "sorned": null
                }
                , {
                    "period": "2011 W12", "licensed": 3289, "sorned": null
                }
                , {
                    "period": "2011 W11", "licensed": 3263, "sorned": null
                }
                , {
                    "period": "2011 W10", "licensed": 3189, "sorned": null
                }
                , {
                    "period": "2011 W09", "licensed": 3079, "sorned": null
                }
                , {
                    "period": "2011 W08", "licensed": 3085, "sorned": null
                }
                , {
                    "period": "2011 W07", "licensed": 3055, "sorned": null
                }
                , {
                    "period": "2011 W06", "licensed": 3063, "sorned": null
                }
                , {
                    "period": "2011 W05", "licensed": 2943, "sorned": null
                }
                , {
                    "period": "2011 W04", "licensed": 2806, "sorned": null
                }
                , {
                    "period": "2011 W03", "licensed": 2674, "sorned": null
                }
                , {
                    "period": "2011 W02", "licensed": 1702, "sorned": null
                }
                , {
                    "period": "2011 W01", "licensed": 1732, "sorned": null
                }
            ];
            Morris.Line({
                "element": "time-graph", "data": f, "xkey": "period", "ykeys": ["licensed", "sorned"], "labels": ["Licensed", "SORN"], "events": ["2011-04", "2011-08"]
            }
            )
        }
        if ($("#graph-B").length) {
            var g = [{
                    "period": "2011-08-12", "a": 100
                }
                , {
                    "period": "2011-03-03", "a": 75
                }
                , {
                    "period": "2010-08-08", "a": 50
                }
                , {
                    "period": "2010-05-10", "a": 25
                }
                , {
                    "period": "2010-03-14", "a": 0
                }
                , {
                    "period": "2010-01-10", "a": -25
                }
                , {
                    "period": "2009-12-10", "a": -50
                }
                , {
                    "period": "2009-10-07", "a": -75
                }
                , {
                    "period": "2009-09-25", "a": -100
                }
            ];
            Morris.Line({
                "element": "graph-B", "data": g, "xkey": "period", "ykeys": ["a"], "labels": ["Series A"], "units": "%"
            }
            )
        }
        if ($("#nogrid-graph").length) {
            var c = [{
                    "period": "2012-10-01", "licensed": 3407, "sorned": 660
                }
                , {
                    "period": "2012-09-30", "licensed": 3351, "sorned": 629
                }
                , {
                    "period": "2012-09-29", "licensed": 3269, "sorned": 618
                }
                , {
                    "period": "2012-09-20", "licensed": 3246, "sorned": 661
                }
                , {
                    "period": "2012-09-19", "licensed": 3257, "sorned": 667
                }
                , {
                    "period": "2012-09-18", "licensed": 3248, "sorned": 627
                }
                , {
                    "period": "2012-09-17", "licensed": 3171, "sorned": 660
                }
                , {
                    "period": "2012-09-16", "licensed": 3171, "sorned": 676
                }
                , {
                    "period": "2012-09-15", "licensed": 3201, "sorned": 656
                }
                , {
                    "period": "2012-09-10", "licensed": 3215, "sorned": 622
                }
            ];
            Morris.Line({
                "element": "nogrid-graph", "grid": !1, "data": c, "xkey": "period", "ykeys": ["licensed", "sorned"], "labels": ["Licensed", "SORN"]
            }
            )
        }
        if ($("#non-continu-graph").length) {
            var c = [{
                    "period": "2012-10-01", "licensed": 3407
                }
                , {
                    "period": "2012-09-30", "sorned": 0
                }
                , {
                    "period": "2012-09-29", "sorned": 618
                }
                , {
                    "period": "2012-09-20", "licensed": 3246, "sorned": 661
                }
                , {
                    "period": "2012-09-19", "licensed": 3257, "sorned": null
                }
                , {
                    "period": "2012-09-18", "licensed": 3248, "other": 1e3
                }
                , {
                    "period": "2012-09-17", "sorned": 0
                }
                , {
                    "period": "2012-09-16", "sorned": 0
                }
                , {
                    "period": "2012-09-15", "licensed": 3201, "sorned": 656
                }
                , {
                    "period": "2012-09-10", "licensed": 3215
                }
            ];
            Morris.Line({
                "element": "non-continu-graph", "data": c, "xkey": "period", "ykeys": ["licensed", "sorned", "other"], "labels": ["Licensed", "SORN", "Other"], "xLabelFormat": function (a) {
                    return a.getMonth() + 1 + "/" + a.getDate() + "/" + a.getFullYear()
                }
                , "xLabels": "day"
            }
            )
        }
        if ($("#non-date-graph").length) {
            var c = [{
                    "elapsed": "I", "value": 34
                }
                , {
                    "elapsed": "II", "value": 24
                }
                , {
                    "elapsed": "III", "value": 3
                }
                , {
                    "elapsed": "IV", "value": 12
                }
                , {
                    "elapsed": "V", "value": 13
                }
                , {
                    "elapsed": "VI", "value": 22
                }
                , {
                    "elapsed": "VII", "value": 5
                }
                , {
                    "elapsed": "VIII", "value": 26
                }
                , {
                    "elapsed": "IX", "value": 12
                }
                , {
                    "elapsed": "X", "value": 19
                }
            ];
            Morris.Line({
                "element": "non-date-graph", "data": c, "xkey": "elapsed", "ykeys": ["value"], "labels": ["value"], "parseTime": !1
            }
            )
        }
        if ($("#stacked-bar-graph").length && Morris.Bar({
            "element": "stacked-bar-graph", "axes": !1, "grid": !1, "data": [{
                    "x": "2011 Q1", "y": 3, "z": 2, "a": 3
                }
                , {
                    "x": "2011 Q2", "y": 2, "z": null, "a": 1
                }
                , {
                    "x": "2011 Q3", "y": 0, "z": 2, "a": 4
                }
                , {
                    "x": "2011 Q4", "y": 2, "z": 4, "a": 3
                }
            ], "xkey": "x", "ykeys": ["y", "z", "a"], "labels": ["Y", "Z", "A"], "stacked": !0
        }
        ), $("#interval-graph").length) {
            var h = 0, i = Morris.Line({
                "element": "interval-graph", "data": a(0), "xkey": "x", "ykeys": ["y", "z"], "labels": ["sin()", "cos()"], "parseTime": !1, "ymin": -1, "ymax": 1, "hideHover": !0
            }
            );
            setInterval(b, 100)
        }
    }

);