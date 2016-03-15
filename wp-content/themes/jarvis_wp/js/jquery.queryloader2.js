(function(e) {
    jQuery.browser = {};
    jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
    jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
    jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
    jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function(e) {
            var t = this.length >>> 0;
            var n = Number(arguments[1]) || 0;
            n = n < 0 ? Math.ceil(n) : Math.floor(n);
            if (n < 0) n += t;
            for (; n < t; n++) {
                if (n in this && this[n] === e) return n
            }
            return -1
        }
    }
    var t = [];
    var n = 0;
    var r = false;
    var i = "";
    var s = "";
    var o = "";
    var u = "";
    var a = 0;
    var f = 0;
    var l = {
        onComplete: function() {},
        backgroundColor: "#000",
        barColor: "#fff",
        overlayId: "qLoverlay",
        barHeight: 1,
        percentage: false,
        deepSearch: true,
        completeAnimation: "fade",
        minimumTime: 500,
        onLoadComplete: function() {

            if (l.completeAnimation == "grow") {
                var t = 500;
                var n = new Date;
                if (n.getTime() - f < l.minimumTime) {
                    t = l.minimumTime - (n.getTime() - f)
                }
                e(o).stop().animate({
                    width: "100%"
                }, t, function() {
                    e(this).animate({
                        top: "0%",
                        width: "100%",
                        height: "100%"
                    }, 500, function() {
                        e("#" + l.overlayId).fadeOut(500, function() {
                  
                            e(this).remove();
                            l.onComplete()
                        })
                    })
                })
            } else {
                e("#" + l.overlayId).fadeOut(500, function() {

                    e("#" + l.overlayId).remove();
                    l.onComplete()
                })
            }
        }
    };
    var c = function() {
        var e = new Date;
        f = e.getTime();
        if (t.length > 0) {
            h();
            m()
        } else {
            v()
        }
    };
    var h = function() {
        i = e("<div></div>").appendTo("body").css({
            display: "none",
            width: 0,
            height: 0,
            overflow: "hidden"
        });
        for (var n = 0; t.length > n; n++) {
            e.ajax({
                url: t[n],
                type: "HEAD",
                complete: function(e) {
                    if (!r) {
                        a++;
                        p(this["url"])
                    }
                }
            })
        }
    };
    var p = function(t) {
        var n = e("<img />").attr("src", t).bind("load error", function() {
            d()
        }).appendTo(i)
    };
    var d = function() {
        n++;
        var t = n / a * 100;
        e(o).stop().animate({
            width: t + "%",
            minWidth: t + "%"
        }, 200);
        if (l.percentage == true) {
            e(u).text(Math.ceil(t) + "%")
        }
        if (n == a) {
            v()
        }
    };
    var v = function() {
        e(i).remove();
        l.onLoadComplete();
        r = true
    };



    var m = function() {
        s = e("<div id='" + l.overlayId + "'><div id='logoLoad' style='display:none;margin:0 auto;width:250px;margin-top:"+(9 + l.barHeight) + "px"+"'><img src='http://www.mediabaum.com/wp-content/uploads/2016/01/footer_logo_800.png'></div></div>").css({
            width: "100%",
            height: "100%",
            backgroundColor: l.backgroundColor,
            backgroundPosition: "fixed",
            position: "fixed",
            zIndex: 666999,
            top: 0,
            left: 0
        }).appendTo("body");
jQuery('#logoLoad').show('slow');
        o = e("<div id='qLbar'></div>").css({
            height: l.barHeight + "px",
            marginTop: "-" + l.barHeight / 2 + "px",
            backgroundColor: l.barColor,
            width: "0%",
            position: "absolute",
            top: "65%"
        }).appendTo(s);
        if (l.percentage == true) {

//jQuery('#load').html('<div style="margin:0 auto; height:250px;width:250px;"><img src="http://www.mediabaum.monkeybleu.com/wp-content/uploads/2016/01/footer_logo_800.png"></div>');
            u = e("<div id='qLpercentage'></div>").text("0%").css({
                height: "40px",
                width: "100px",
                position: "absolute",
                fontSize: "3em",
                top: "65%",
                left: "50%",
                marginTop: "-" + (59 + l.barHeight) + "px",
                textAlign: "center",
                marginLeft: "-50px",
                color: l.barColor
            }).appendTo(s)
        }
        if (!t.length) {
            v()
        }
    };
    var g = function(n) {
        var r = "";
        if (e(n).css("background-image") != "none") {
            var r = e(n).css("background-image")
        } else if (typeof e(n).attr("src") != "undefined" && n.nodeName.toLowerCase() == "img") {
            var r = e(n).attr("src")
        }
        if (r.indexOf("gradient") == -1) {
            r = r.replace(/url\(\"/g, "");
            r = r.replace(/url\(/g, "");
            r = r.replace(/\"\)/g, "");
            r = r.replace(/\)/g, "");
            var i = r.split(", ");
            for (var s = 0; s < i.length; s++) {
                if (i[s].length > 0 && t.indexOf(i[s]) == -1 && !i[s].match(/^(data:)/i)) {
                    var o = "";
                    if (e.browser.msie && e.browser.version < 9) {
                        o = "?" + Math.floor(Math.random() * 3e3)
                    }
                    t.push(i[s] + o)
                }
            }
        }
    };
    e.fn.queryLoader2 = function(t) {
        if (t) {
            e.extend(l, t)
        }
        this.each(function() {
            g(this);
            if (l.deepSearch == true) {
                e(this).find("*:not(script)").each(function() {
                    g(this)
                })
            }
        });
        c();
        return this
    };
    var y = {
        init: function() {
            this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
            this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version";
            this.OS = this.searchString(this.dataOS) || "an unknown OS"
        },
        searchString: function(e) {
            for (var t = 0; t < e.length; t++) {
                var n = e[t].string;
                var r = e[t].prop;
                this.versionSearchString = e[t].versionSearch || e[t].identity;
                if (n) {
                    if (n.indexOf(e[t].subString) != -1) return e[t].identity
                } else if (r) return e[t].identity
            }
        },
        searchVersion: function(e) {
            var t = e.indexOf(this.versionSearchString);
            if (t == -1) return;
            return parseFloat(e.substring(t + this.versionSearchString.length + 1))
        },
        dataBrowser: [{
            string: navigator.userAgent,
            subString: "Chrome",
            identity: "Chrome"
        }, {
            string: navigator.userAgent,
            subString: "OmniWeb",
            versionSearch: "OmniWeb/",
            identity: "OmniWeb"
        }, {
            string: navigator.vendor,
            subString: "Apple",
            identity: "Safari",
            versionSearch: "Version"
        }, {
            prop: window.opera,
            identity: "Opera",
            versionSearch: "Version"
        }, {
            string: navigator.vendor,
            subString: "iCab",
            identity: "iCab"
        }, {
            string: navigator.vendor,
            subString: "KDE",
            identity: "Konqueror"
        }, {
            string: navigator.userAgent,
            subString: "Firefox",
            identity: "Firefox"
        }, {
            string: navigator.vendor,
            subString: "Camino",
            identity: "Camino"
        }, {
            string: navigator.userAgent,
            subString: "Netscape",
            identity: "Netscape"
        }, {
            string: navigator.userAgent,
            subString: "MSIE",
            identity: "Explorer",
            versionSearch: "MSIE"
        }, {
            string: navigator.userAgent,
            subString: "Gecko",
            identity: "Mozilla",
            versionSearch: "rv"
        }, {
            string: navigator.userAgent,
            subString: "Mozilla",
            identity: "Netscape",
            versionSearch: "Mozilla"
        }],
        dataOS: [{
            string: navigator.platform,
            subString: "Win",
            identity: "Windows"
        }, {
            string: navigator.platform,
            subString: "Mac",
            identity: "Mac"
        }, {
            string: navigator.userAgent,
            subString: "iPhone",
            identity: "iPhone/iPod"
        }, {
            string: navigator.platform,
            subString: "Linux",
            identity: "Linux"
        }]
    };
    y.init();
    jQuery.browser.version = y.version
})(jQuery)
