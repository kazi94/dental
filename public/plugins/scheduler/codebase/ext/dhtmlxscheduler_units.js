/*

@license
dhtmlxScheduler v.5.3.9 Professional

This software can be used only as part of dhtmlx.com site.
You are not allowed to use it on any other site

(c) XB Software Ltd.

*/
Scheduler.plugin(function(e) {
    (e._props = {}),
        (e.createUnitsView = function(t, a, n, i, r, o, _) {
            function s(t) {
                return Math.round(
                    (e._correct_shift(+t, 1) - +e._min_date) / 864e5
                );
            }
            function d() {
                c ||
                    ((c = e.xy.scale_height),
                    (e.xy.scale_height = 2 * e.xy.scale_height));
            }
            function l() {
                c && ((e.xy.scale_height /= 2), (c = !1));
            }
            "object" == typeof t &&
                ((n = t.list),
                (a = t.property),
                (i = t.size || 0),
                (r = t.step || 1),
                (o = t.skip_incorrect),
                (_ = t.days || 1),
                (t = t.name)),
                (e._props[t] = {
                    map_to: a,
                    options: n,
                    step: r,
                    position: 0,
                    days: _
                }),
                i > e._props[t].options.length &&
                    ((e._props[t]._original_size = i), (i = 0)),
                (e._props[t].size = i),
                (e._props[t].skip_incorrect = o || !1),
                (e.date[t + "_start"] = e.date.day_start),
                (e.templates[t + "_date"] = function(a, n) {
                    return e._props[t].days > 1
                        ? e.templates.week_date(a, n)
                        : e.templates.day_date(a);
                }),
                (e._get_unit_index = function(e, t) {
                    var a = e.position || 0,
                        n = s(t),
                        i = e.size || e.options.length;
                    return n >= i && (n %= i), a + n;
                }),
                (e.templates[t + "_scale_text"] = function(e, t, a) {
                    return a.css
                        ? "<span class='" + a.css + "'>" + t + "</span>"
                        : t;
                }),
                (e.templates[t + "_scale_date"] = function(a) {
                    var n = e._props[t],
                        i = n.options;
                    if (!i.length) return "";
                    var r = e._get_unit_index(n, a),
                        o = i[r],
                        _ = s(a),
                        d = n.size || n.options.length,
                        l = e.date.add(
                            e.getState().min_date,
                            Math.floor(_ / d),
                            "day"
                        );
                    return e.templates[t + "_scale_text"](o.key, o.label, o, l);
                }),
                (e.templates[t + "_second_scale_date"] = function(t) {
                    return e.templates.week_scale_date(t);
                }),
                (e.date["add_" + t] = function(a, n) {
                    return e.date.add(a, n * e._props[t].days, "day");
                }),
                (e.date["get_" + t + "_end"] = function(a) {
                    return e.date.add(
                        a,
                        (e._props[t].size || e._props[t].options.length) *
                            e._props[t].days,
                        "day"
                    );
                }),
                e.attachEvent("onOptionsLoad", function() {
                    for (
                        var a = e._props[t],
                            n = (a.order = {}),
                            i = a.options,
                            r = 0;
                        r < i.length;
                        r++
                    )
                        n[i[r].key] = r;
                    a._original_size &&
                        0 === a.size &&
                        ((a.size = a._original_size), delete a._original_size),
                        a.size > i.length
                            ? ((a._original_size = a.size),
                              (a.position = 0),
                              (a.size = 0))
                            : (a.size = a._original_size || a.size),
                        e._date &&
                            e._mode == t &&
                            e.setCurrentView(e._date, e._mode);
                }),
                (e["mouse_" + t] = function(t) {
                    var a = e._props[this._mode];
                    if (a) {
                        if (
                            ((t = this._week_indexes_from_pos(t)),
                            this._drag_event || (this._drag_event = {}),
                            this._drag_id &&
                                this._drag_mode &&
                                (this._drag_event._dhx_changed = !0),
                            this._drag_mode && "new-size" == this._drag_mode)
                        ) {
                            var n = e._get_event_sday(e._events[e._drag_id]);
                            Math.floor(t.x / a.options.length) !=
                                Math.floor(n / a.options.length) && (t.x = n);
                        }
                        var i = a.size || a.options.length,
                            r = t.x % i,
                            o = Math.min(r + a.position, a.options.length - 1);
                        (t.section = (a.options[o] || {}).key),
                            (t.x = Math.floor(t.x / i));
                        var _ = this.getEvent(this._drag_id);
                        this._update_unit_section({
                            view: a,
                            event: _,
                            pos: t
                        });
                    }
                    return (t.force_redraw = !0), t;
                });
            var c = !1;
            (e[t + "_view"] = function(t) {
                var a = e._props[e._mode];
                t ? (a && a.days > 1 ? d() : l(), e._reset_scale()) : l();
            }),
                e.callEvent("onOptionsLoad", []);
        }),
        (e._update_unit_section = function(e) {
            var t = e.view,
                a = e.event,
                n = e.pos;
            a && (a[t.map_to] = n.section);
        }),
        (e.scrollUnit = function(t) {
            var a = e._props[this._mode];
            a &&
                ((a.position = Math.min(
                    Math.max(0, a.position + t),
                    a.options.length - a.size
                )),
                this.setCurrentView());
        }),
        (function() {
            var t = function(t) {
                    var a = e._props[e._mode];
                    if (a && a.order && a.skip_incorrect) {
                        for (var n = [], i = 0; i < t.length; i++)
                            void 0 !== a.order[t[i][a.map_to]] && n.push(t[i]);
                        t.splice(0, t.length), t.push.apply(t, n);
                    }
                    return t;
                },
                a = e._pre_render_events_table;
            e._pre_render_events_table = function(e, n) {
                return (e = t(e)), a.apply(this, [e, n]);
            };
            var n = e._pre_render_events_line;
            e._pre_render_events_line = function(e, a) {
                return (e = t(e)), n.apply(this, [e, a]);
            };
            var i = function(t, a) {
                    if (t && void 0 === t.order[a[t.map_to]]) {
                        var n = e,
                            i = 864e5,
                            r = Math.floor((a.end_date - n._min_date) / i);
                        return (
                            t.options.length &&
                                (a[t.map_to] =
                                    t.options[
                                        Math.min(
                                            r + t.position,
                                            t.options.length - 1
                                        )
                                    ].key),
                            !0
                        );
                    }
                },
                r = e.is_visible_events;
            e.is_visible_events = function(t) {
                var a = r.apply(this, arguments);
                if (a) {
                    var n = e._props[this._mode];
                    if (n && n.size) {
                        var i = n.order[t[n.map_to]];
                        if (i < n.position || i >= n.size + n.position)
                            return !1;
                    }
                }
                return a;
            };
            var o = e._process_ignores;
            e._process_ignores = function(t, a, n, i, r) {
                if (!e._props[this._mode])
                    return void o.call(this, t, a, n, i, r);
                (this._ignores = {}), (this._ignores_detected = 0);
                var _ = e["ignore_" + this._mode];
                if (_) {
                    var s =
                        e._props && e._props[this._mode]
                            ? e._props[this._mode].size ||
                              e._props[this._mode].options.length
                            : 1;
                    a /= s;
                    for (var d = new Date(t), l = 0; l < a; l++) {
                        if (_(d))
                            for (
                                var c = l * s, h = (l + 1) * s, u = c;
                                u < h;
                                u++
                            )
                                (this._ignores_detected += 1),
                                    (this._ignores[u] = !0),
                                    r && a++;
                        (d = e.date.add(d, i, n)),
                            e.date[n + "_start"] &&
                                (d = e.date[n + "_start"](d));
                    }
                }
            };
            var _ = e._reset_scale;
            e._reset_scale = function() {
                var t = e._props[this._mode];
                t &&
                    (t.size &&
                    t.position &&
                    t.size + t.position > t.options.length
                        ? (t.position = Math.max(0, t.options.length - t.size))
                        : t.size || (t.position = 0));
                var a = _.apply(this, arguments);
                if (t) {
                    this._max_date = this.date.add(
                        this._min_date,
                        t.days,
                        "day"
                    );
                    for (
                        var n = this._els.dhx_cal_data[0].childNodes, i = 0;
                        i < n.length;
                        i++
                    )
                        n[i].className = n[i].className.replace("_now", "");
                    var r = this._currentDate();
                    if (
                        r.valueOf() >= this._min_date &&
                        r.valueOf() < this._max_date
                    ) {
                        var o = 864e5,
                            s = Math.floor((r - e._min_date) / o),
                            d = t.size || t.options.length,
                            l = s * d,
                            c = l + d;
                        for (i = l; i < c; i++)
                            n[i] &&
                                (n[i].className = n[i].className.replace(
                                    "dhx_scale_holder",
                                    "dhx_scale_holder_now"
                                ));
                    }
                    if (t.size && t.size < t.options.length) {
                        var h = this._els.dhx_cal_header[0],
                            u = document.createElement("div");
                        t.position &&
                            (this._waiAria.headerButtonsAttributes(u, ""),
                            e.config.rtl
                                ? ((u.className = "dhx_cal_next_button"),
                                  (u.style.cssText =
                                      "left:auto; right:0px;top:2px;position:absolute;"))
                                : ((u.className = "dhx_cal_prev_button"),
                                  (u.style.cssText =
                                      "left:1px;top:2px;position:absolute;")),
                            (u.innerHTML = "&nbsp;"),
                            h.firstChild.appendChild(u),
                            (u.onclick = function() {
                                e.scrollUnit(-1 * t.step);
                            })),
                            t.position + t.size < t.options.length &&
                                (this._waiAria.headerButtonsAttributes(u, ""),
                                (u = document.createElement("div")),
                                e.config.rtl
                                    ? ((u.className = "dhx_cal_prev_button"),
                                      (u.style.cssText =
                                          "left:1px;top:2px;position:absolute;"))
                                    : ((u.className = "dhx_cal_next_button"),
                                      (u.style.cssText =
                                          "left:auto; right:0px;top:2px;position:absolute;")),
                                (u.innerHTML = "&nbsp;"),
                                h.lastChild.appendChild(u),
                                (u.onclick = function() {
                                    e.scrollUnit(t.step);
                                }));
                    }
                }
                return a;
            };
            var s = e._get_view_end;
            e._get_view_end = function() {
                var t = e._props[this._mode];
                if (t && t.days > 1) {
                    var a = this._get_timeunit_start();
                    return e.date.add(a, t.days, "day");
                }
                return s.apply(this, arguments);
            };
            var d = e._render_x_header;
            e._render_x_header = function(t, a, n, i) {
                var r = e._props[this._mode];
                if (!r || r.days <= 1) return d.apply(this, arguments);
                if (r.days > 1) {
                    var o = i.querySelector(".dhx_second_cal_header");
                    o ||
                        ((o = document.createElement("div")),
                        (o.className = "dhx_second_cal_header"),
                        i.appendChild(o));
                    var _ = e.xy.scale_height;
                    (e.xy.scale_height = Math.ceil(_ / 2)),
                        d.call(this, t, a, n, o, Math.ceil(e.xy.scale_height));
                    var s = r.size || r.options.length;
                    if ((t + 1) % s == 0) {
                        var l = document.createElement("div");
                        l.className = "dhx_scale_bar dhx_second_scale_bar";
                        var c = this.date.add(
                            this._min_date,
                            Math.floor(t / s),
                            "day"
                        );
                        this.templates[this._mode + "_second_scalex_class"] &&
                            (l.className +=
                                " " +
                                this.templates[
                                    this._mode + "_second_scalex_class"
                                ](new Date(c)));
                        var h,
                            u = this._cols[t] * s - 1;
                        (h =
                            s > 1 && this.config.rtl
                                ? this._colsS[t - (s - 1)] -
                                  this.xy.scroll_width -
                                  2
                                : s > 1
                                ? this._colsS[t - (s - 1)] -
                                  this.xy.scale_width -
                                  2
                                : a),
                            this.set_xy(l, u, this.xy.scale_height - 2, h, 0),
                            (l.innerHTML = this.templates[
                                this._mode + "_second_scale_date"
                            ](new Date(c), this._mode)),
                            o.appendChild(l);
                    }
                    e.xy.scale_height = _;
                }
            };
            var l = e._get_event_sday;
            (e._get_event_sday = function(t) {
                var a = e._props[this._mode];
                if (a) {
                    if (a.days <= 1)
                        return i(a, t), this._get_section_sday(t[a.map_to]);
                    return (
                        Math.floor(
                            (t.end_date.valueOf() -
                                1 -
                                60 * t.end_date.getTimezoneOffset() * 1e3 -
                                (e._min_date.valueOf() -
                                    60 *
                                        e._min_date.getTimezoneOffset() *
                                        1e3)) /
                                864e5
                        ) *
                            (a.size || a.options.length) +
                        a.order[t[a.map_to]] -
                        a.position
                    );
                }
                return l.call(this, t);
            }),
                (e._get_section_sday = function(t) {
                    var a = e._props[this._mode];
                    return a.order[t] - a.position;
                });
            var c = e.locate_holder_day;
            e.locate_holder_day = function(t, a, n) {
                var r = e._props[this._mode];
                if (!r) return c.apply(this, arguments);
                var o;
                return (
                    n
                        ? i(r, n)
                        : ((n = { start_date: t, end_date: t }), (o = 0)),
                    r.days <= 1
                        ? 1 * (void 0 === o ? r.order[n[r.map_to]] : o) +
                          (a ? 1 : 0) -
                          r.position
                        : Math.floor(
                              (n.start_date.valueOf() - e._min_date.valueOf()) /
                                  864e5
                          ) *
                              (r.size || r.options.length) +
                          1 * (void 0 === o ? r.order[n[r.map_to]] : o) +
                          (a ? 1 : 0) -
                          r.position
                );
            };
            var h = e._time_order;
            e._time_order = function(t) {
                var a = e._props[this._mode];
                a
                    ? t.sort(function(e, t) {
                          return a.order[e[a.map_to]] > a.order[t[a.map_to]]
                              ? 1
                              : -1;
                      })
                    : h.apply(this, arguments);
            };
            var u = e._pre_render_events_table;
            (e._pre_render_events_table = function(t, a) {
                function n(t) {
                    var a = e.date.add(t, 1, "day");
                    return (a = e.date.date_part(a));
                }
                var i = e._props[this._mode];
                if (i && i.days > 1) {
                    for (var r = {}, o = 0; o < t.length; o++) {
                        var _ = t[o];
                        if (e.isOneDayEvent(t[o])) {
                            var s = +e.date.date_part(new Date(_.start_date));
                            r[s] || (r[s] = []), r[s].push(_);
                        } else {
                            var d = new Date(
                                    Math.min(+_.end_date, +this._max_date)
                                ),
                                l = new Date(
                                    Math.max(+_.start_date, +this._min_date)
                                );
                            for (
                                l = e.date.day_start(l), t.splice(o, 1), o--;
                                +l < +d;

                            ) {
                                var c = this._copy_event(_);
                                (c.start_date = l),
                                    (c.end_date = n(c.start_date)),
                                    (l = e.date.add(l, 1, "day"));
                                var s = +e.date.date_part(new Date(l));
                                r[s] || (r[s] = []), r[s].push(c);
                            }
                        }
                    }
                    var h,
                        t = [];
                    for (var o in r) {
                        var v = u.apply(this, [r[o], a]),
                            g = this._colsS.heights;
                        (!h || g[0] > h[0]) && (h = g.slice()),
                            t.push.apply(t, v);
                    }
                    var f = this._colsS.heights;
                    f.splice(0, f.length), f.push.apply(f, h);
                    for (var o = 0; o < t.length; o++)
                        if (this._ignores[t[o]._sday]) t.splice(o, 1), o--;
                        else {
                            var p = t[o];
                            p._first_chunk = p._last_chunk = !1;
                            var m = this.getEvent(p.id);
                            m._sorder = p._sorder;
                        }
                    t.sort(function(e, t) {
                        return e.start_date.valueOf() == t.start_date.valueOf()
                            ? e.id > t.id
                                ? 1
                                : -1
                            : e.start_date > t.start_date
                            ? 1
                            : -1;
                    });
                } else t = u.apply(this, [t, a]);
                return t;
            }),
                e.attachEvent("onEventAdded", function(t, a) {
                    if (this._loading) return !0;
                    for (var n in e._props) {
                        var i = e._props[n];
                        void 0 === a[i.map_to] &&
                            i.options[0] &&
                            (a[i.map_to] = i.options[0].key);
                    }
                    return !0;
                }),
                e.attachEvent("onEventCreated", function(t, a) {
                    var n = e._props[this._mode];
                    if (n && a) {
                        var r = this.getEvent(t);
                        i(n, r);
                        var o = this._mouse_coords(a);
                        this._update_unit_section({
                            view: n,
                            event: r,
                            pos: o
                        }),
                            this.event_updated(r);
                    }
                    return !0;
                });
        })();
});
